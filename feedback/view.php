<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

$root = '../';
$tickets = $pdo->query("SELECT * FROM feedback ORDER BY submitted_at DESC")->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Admin</p>
    <h1>Feedback Tickets</h1>
  </div>
</section>

<section class="about-block">
  <div class="container">
    <div class="dashboard-list">
    <?php foreach ($tickets as $t): ?>
      <div class="dashboard-item" style="flex-direction:column; align-items:stretch; gap:6px;">
        <div style="display:flex; justify-content:space-between;">
          <strong><?= htmlspecialchars($t['ticket_number']) ?></strong>
          <span class="dashboard-item-date"><?= date('d M Y, h:i A', strtotime($t['submitted_at'])) ?></span>
        </div>
        <div><?= htmlspecialchars($t['name']) ?> (<?= htmlspecialchars($t['email']) ?>) — <?= htmlspecialchars($t['category']) ?>, <?= $t['rating'] ?>★</div>
        <p style="margin:4px 0;"><?= htmlspecialchars($t['message']) ?></p>
        <select class="status-select" data-id="<?= $t['id'] ?>">
          <option value="open" <?= $t['status'] === 'open' ? 'selected' : '' ?>>Open</option>
          <option value="in_progress" <?= $t['status'] === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
          <option value="resolved" <?= $t['status'] === 'resolved' ? 'selected' : '' ?>>Resolved</option>
        </select>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>