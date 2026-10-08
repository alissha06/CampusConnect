<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$root = '../';
require_once '../includes/db.php';
$items = require '../includes/checklist_items.php';

$stmt = $pdo->prepare("SELECT item_key FROM checklist_progress WHERE user_id = :uid");
$stmt->execute(['uid' => $_SESSION['user_id']]);
$done = array_flip($stmt->fetchAll(PDO::FETCH_COLUMN));   // ['academic' => 0, ...]

$total     = count($items);
$completed = count(array_intersect_key($items, $done));
$percent   = $total ? (int)round($completed / $total * 100) : 0;

include '../includes/header.php';
include '../includes/navbar.php';
?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="../index.php">Portal Home</a> / <a href="index.php">Admissions</a> / <span>My Checklist</span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Admissions • Student Tracker</p>
    <h1>My Admission Checklist</h1>
    <p class="tagline">Track your required documents and compliance undertakings for admission completion.</p>
    <div class="student-tag">👤 Student: <?= htmlspecialchars($_SESSION['name']) ?></div>
  </div>
</section>

<!-- PROGRESS -->
<section class="about-block">
  <div class="container">
    <div class="progress-card">
      <div class="progress-card-header">
        <div>
          <h3>Admission Progress</h3>
          <p id="progress-caption"><?= $completed ?> of <?= $total ?> requirements completed</p>
        </div>
        <div class="progress-percent"><span id="progress-number"><?= $percent ?></span>%<span class="progress-label">Complete</span></div>
      </div>
      <div class="progress-bar-track">
        <div class="progress-bar-fill" id="progress-bar-fill" style="width: <?= $percent ?>%;"></div>
      </div>
    </div>
  </div>
</section>

<!-- CHECKLIST -->
<section class="about-block alt">
  <div class="container">
    <h2>Verification Tasks</h2>

    <div class="checklist">
    <?php foreach ($items as $key => $item):
        $isDone = isset($done[$key]);
    ?>
      <div class="checklist-item <?= $isDone ? 'completed' : 'pending' ?>" data-item="<?= htmlspecialchars($key) ?>">
        <span class="checklist-icon"><?= $isDone ? '✓' : '○' ?></span>
        <div class="checklist-body">
          <div class="checklist-title-row">
            <h3><?= htmlspecialchars($item['title']) ?></h3>
            <?php if ($isDone): ?>
              <span class="status-tag done">Completed</span>
            <?php else: ?>
              <span class="status-tag pending-tag">Pending</span>
            <?php endif; ?>
          </div>
          <p><?= htmlspecialchars($item['desc']) ?></p>
          <div class="checklist-actions">
            <a href="requirement_details.php?doc=<?= urlencode($key) ?>" class="btn-outline-sm">View Guide</a>
            <?php if ($isDone): ?>
              <button class="link-btn" onclick="toggleChecklist(this, 'undo')">Undo</button>
            <?php else: ?>
              <button class="btn-mark-complete" onclick="toggleChecklist(this, 'complete')">✓ Mark as Completed</button>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CLOSING NOTE -->
<section class="about-block">
  <div class="container">
    <div class="help-banner">
      <p>Have questions about any requirement? Contact the Admissions Guidance Cell at <strong>admissions@sicsr.ac.in</strong>.</p>
      <a href="index.php" class="btn btn-primary">Go to Admissions Guidance &rarr;</a>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>