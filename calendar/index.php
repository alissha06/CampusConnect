<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$root = '../';
require_once '../includes/db.php';

$isAdmin = ($_SESSION['role'] ?? '') === 'admin';

$allowed = ['academic', 'exam', 'holiday', 'event'];
$filter  = $_GET['type'] ?? 'all';
if (!in_array($filter, $allowed, true)) $filter = 'all';

$sql = "SELECT id, title, category, start_date, end_date, description FROM academic_calendar";
$params = [];
if ($filter !== 'all') {
    $sql .= " WHERE category = :c";
    $params['c'] = $filter;
}
$sql .= " ORDER BY start_date ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group the entries by month, e.g. "November 2026"
$byMonth = [];
foreach ($entries as $e) {
    $byMonth[date('F Y', strtotime($e['start_date']))][] = $e;
}

$today = date('Y-m-d');
$labels = ['academic' => 'Academic', 'exam' => 'Examination', 'holiday' => 'Holiday', 'event' => 'Event'];

function date_range($start, $end) {
    $s = date('d M Y', strtotime($start));
    if (!$end || $end === $start) return $s;
    return $s . ' - ' . date('d M Y', strtotime($end));
}

include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="breadcrumb">
  <div class="container">
    <a href="../index.php">Portal Home</a> / <span>Academic Calendar</span>
  </div>
</div>

<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Academic Calendar</p>
    <h1>Academic Calendar</h1>
    <p class="tagline">Key dates for examinations, holidays, events and the academic year.</p>
  </div>
</section>

<section class="about-block">
  <div class="container">
    <div class="filter-pills">
      <a href="index.php" class="filter-pill <?= $filter === 'all' ? 'active' : '' ?>">All</a>
      <?php foreach ($labels as $key => $label): ?>
        <a href="index.php?type=<?= $key ?>" class="filter-pill <?= $filter === $key ? 'active' : '' ?>"><?= $label ?></a>
      <?php endforeach; ?>
    </div>

    <?php if ($isAdmin): ?>
      <p style="margin-top:12px;"><a href="create.php" class="btn btn-primary">+ Add Calendar Entry</a></p>
    <?php endif; ?>

    <?php if (empty($byMonth)): ?>
      <p style="margin-top:20px;">No calendar entries found.</p>
    <?php endif; ?>

    <?php foreach ($byMonth as $month => $rows): ?>
      <h2 class="cal-month"><?= htmlspecialchars($month) ?></h2>
      <div class="dashboard-list">
      <?php foreach ($rows as $e):
          $endDate = $e['end_date'] ?: $e['start_date'];
          $state = $endDate < $today ? 'cal-past' : ($e['start_date'] <= $today ? 'cal-now' : '');
      ?>
        <div class="cal-item <?= $state ?>">
          <div class="cal-date"><?= htmlspecialchars(date_range($e['start_date'], $e['end_date'])) ?></div>
          <div class="cal-body">
            <span class="cal-tag cal-<?= htmlspecialchars($e['category']) ?>"><?= htmlspecialchars($labels[$e['category']]) ?></span>
            <?php if ($state === 'cal-now'): ?><span class="cal-tag cal-ongoing">Ongoing</span><?php endif; ?>
            <h3><?= htmlspecialchars($e['title']) ?></h3>
            <?php if (!empty($e['description'])): ?>
              <p><?= htmlspecialchars($e['description']) ?></p>
            <?php endif; ?>
          </div>

          <?php if ($isAdmin): ?>
          <div class="cal-actions">
            <a href="edit.php?id=<?= (int)$e['id'] ?>" class="btn-outline-sm">Edit</a>
            <form method="post" action="delete.php" onsubmit="return confirm('Delete this calendar entry?');">
              <input type="hidden" name="id" value="<?= (int)$e['id'] ?>">
              <button type="submit" class="btn-outline-sm cal-delete">Delete</button>
            </form>
          </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include '../includes/footer.php'; ?>