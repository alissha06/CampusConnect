<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header('Location: ../auth/login.php');
    exit;
}

$root = '../';
require_once '../includes/db.php';

$notices = $pdo->query("SELECT title, posted_at FROM notices ORDER BY posted_at DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);
$events  = $pdo->query("SELECT title, slug, event_date FROM events ORDER BY posted_at DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Student Dashboard</p>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h1>
  </div>
</section>

<section class="about-block">
  <div class="container">
    <h2>Recent Notices</h2>
    <div class="dashboard-list">
    <?php foreach ($notices as $n): ?>
      <div class="dashboard-item">
        <span class="dashboard-item-title"><?= htmlspecialchars($n['title']) ?></span>
        <span class="dashboard-item-date"><?= date('d M Y', strtotime($n['posted_at'])) ?></span>
      </div>
    <?php endforeach; ?>
    </div>
    <a href="../notices/index.php" class="dashboard-link">View all notices &rarr;</a>
  </div>
</section>

<section class="about-block alt">
  <div class="container">
    <h2>Upcoming Events</h2>
    <div class="dashboard-list">
    <?php foreach ($events as $e): ?>
      <div class="dashboard-item">
        <a href="../events/details.php?event=<?= urlencode($e['slug']) ?>" class="dashboard-item-title"><?= htmlspecialchars($e['title']) ?></a>
        <span class="dashboard-item-date"><?= htmlspecialchars($e['event_date']) ?></span>
      </div>
    <?php endforeach; ?>
    </div>
    <a href="../events/index.php" class="dashboard-link">View all events &rarr;</a>
  </div>
</section>

<section class="about-block">
  <div class="container">
    <h2>Quick Links</h2>
    <div class="dashboard-quicklinks">
      <a href="../lostfound/index.php" class="btn-outline-sm">Lost &amp; Found</a>
      <a href="../feedback/index.php" class="btn-outline-sm">Give Feedback</a>
      <a href="../admissions/index.php" class="btn-outline-sm">Admission Resources</a>
      <a href="../auth/logout.php" class="btn-outline-sm logout">Logout</a>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>