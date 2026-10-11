<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

function valid_date($d) {
    $dt = DateTime::createFromFormat('Y-m-d', $d);
    return $dt && $dt->format('Y-m-d') === $d;
}

// Load the entry being edited (id comes from the link, or from the form when saving)
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM academic_calendar WHERE id = :id");
$stmt->execute(['id' => $id]);
$entry = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$entry) {
    header('Location: index.php');
    exit;
}

$allowed = ['academic', 'exam', 'holiday', 'event'];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title    = trim($_POST['title'] ?? '');
    $category = $_POST['category'] ?? '';
    $start    = $_POST['start_date'] ?? '';
    $end      = trim($_POST['end_date'] ?? '');
    $desc     = trim($_POST['description'] ?? '');

    if ($title === '' || !in_array($category, $allowed, true)) {
        $error = 'Please enter a title and choose a type.';
    } elseif (!valid_date($start)) {
        $error = 'Please enter a valid start date.';
    } elseif ($end !== '' && (!valid_date($end) || $end < $start)) {
        $error = 'The end date must be a valid date on or after the start date.';
    }

    if ($error === '') {
        $upd = $pdo->prepare(
            "UPDATE academic_calendar
             SET title = :title, category = :category, start_date = :start_date,
                 end_date = :end_date, description = :description
             WHERE id = :id"
        );
        $upd->execute([
            'title'       => $title,
            'category'    => $category,
            'start_date'  => $start,
            'end_date'    => $end === '' ? null : $end,
            'description' => $desc === '' ? null : $desc,
            'id'          => $id,
        ]);
        header('Location: index.php');
        exit;
    }

    // Validation failed: keep what the admin typed so they don't lose it
    $entry = array_merge($entry, [
        'title' => $title, 'category' => $category, 'start_date' => $start,
        'end_date' => $end, 'description' => $desc,
    ]);
}

$root = '../';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Admin</p>
    <h1>Edit Calendar Entry</h1>
  </div>
</section>

<section class="about-block">
  <div class="container">
    <div class="form-card">
      <?php if ($error !== ''): ?>
        <p style="color:#b3261e; margin-bottom:12px;"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="post" action="edit.php?id=<?= (int)$id ?>">
        <input type="hidden" name="id" value="<?= (int)$id ?>">

        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" name="title" value="<?= htmlspecialchars($entry['title']) ?>" required>
        </div>

        <div class="form-group">
          <label for="category">Type</label>
          <select id="category" name="category" required>
            <?php foreach (['academic' => 'Academic', 'exam' => 'Examination', 'holiday' => 'Holiday', 'event' => 'Event'] as $val => $label): ?>
              <option value="<?= $val ?>" <?= $entry['category'] === $val ? 'selected' : '' ?>><?= $label ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="start_date">Start date</label>
            <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($entry['start_date']) ?>" required>
          </div>
          <div class="form-group">
            <label for="end_date">End date (optional)</label>
            <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($entry['end_date'] ?? '') ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="description">Description (optional)</label>
          <textarea id="description" name="description" rows="3"><?= htmlspecialchars($entry['description'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="index.php" class="link-btn">Cancel</a>
      </form>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>