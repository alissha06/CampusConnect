<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/ticket_timeline.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

$root = '../';
$tickets = $pdo->query("SELECT * FROM feedback ORDER BY submitted_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Group all history rows by ticket in one query, instead of one query per ticket
$updates = [];
$rows = $pdo->query("SELECT feedback_id, status, message, created_at FROM feedback_updates ORDER BY created_at ASC, id ASC")
            ->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $r) {
    $updates[$r['feedback_id']][] = $r;
}

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
        <div><?= htmlspecialchars($t['name']) ?> (<?= htmlspecialchars($t['email']) ?>) — <?= htmlspecialchars($t['category']) ?>, <?= (int)$t['rating'] ?>★</div>
        <p style="margin:4px 0;"><?= nl2br(htmlspecialchars($t['message'])) ?></p>

        <select class="status-select" data-id="<?= (int)$t['id'] ?>">
          <option value="open" <?= $t['status'] === 'open' ? 'selected' : '' ?>>Open</option>
          <option value="in_progress" <?= $t['status'] === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
          <option value="resolved" <?= $t['status'] === 'resolved' ? 'selected' : '' ?>>Resolved</option>
        </select>

        <?php render_ticket_timeline($t, $updates[$t['id']] ?? []); ?>

        <form class="reply-form">
          <input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
          <textarea name="message" rows="2" maxlength="1000" placeholder="Write a reply the student will see..." required></textarea>
          <button type="submit" class="btn btn-primary">Send Reply</button>
        </form>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>