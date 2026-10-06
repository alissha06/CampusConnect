<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

$root = '../';
require_once '../includes/db.php';

$noticeCount = $pdo->query("SELECT COUNT(*) FROM notices")->fetchColumn();
$eventCount  = $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn();
$itemCount   = $pdo->query("SELECT COUNT(*) FROM lost_found WHERE status='open'")->fetchColumn();
$fbCount     = $pdo->query("SELECT COUNT(*) FROM feedback")->fetchColumn();

include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Admin Dashboard</p>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h1>
  </div>
</section>

<section class="about-block">
  <div class="container">
    <div class="dashboard-quicklinks">
      <a href="../notices/create.php" class="btn-outline-sm">+ Post a Notice</a>
      <a href="../events/create.php" class="btn-outline-sm">+ Post an Event</a>
      <a href="../lostfound/index.php" class="btn-outline-sm">View Lost &amp; Found (<?= $itemCount ?> open)</a>
      <a href="../feedback/view.php" class="btn-outline-sm">View Feedback (<?= $fbCount ?>)</a>
    </div>

    <div class="dashboard-list" style="margin-top:24px;">
      <div class="dashboard-item"><span class="dashboard-item-title">Total Notices</span><span class="dashboard-item-date"><?= $noticeCount ?></span></div>
      <div class="dashboard-item"><span class="dashboard-item-title">Total Events</span><span class="dashboard-item-date"><?= $eventCount ?></span></div>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>