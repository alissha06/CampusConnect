<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header('Location: ../auth/login.php');
    exit;
}

$root = '../';
require_once '../includes/db.php';
// the admission doc checklist
$checkItems = require '../includes/checklist_items.php';
$c = $pdo->prepare("SELECT item_key FROM checklist_progress WHERE user_id = :uid");
$c->execute(['uid' => $_SESSION['user_id']]);
$checkDone = count(array_intersect_key($checkItems, array_flip($c->fetchAll(PDO::FETCH_COLUMN))));
$checkTotal = count($checkItems);
$checkPercent = (int)round($checkDone / $checkTotal * 100);

require_once '../includes/ticket_timeline.php';

$notices = $pdo->query("SELECT title, posted_at FROM notices ORDER BY posted_at DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);
$events  = $pdo->query("SELECT title, slug, event_date FROM events ORDER BY posted_at DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);

// ticket diplay on the student dashboard with filter
$myTickets = $pdo->prepare("SELECT id, ticket_number, category, message, status, submitted_at FROM feedback WHERE user_id = :uid ORDER BY submitted_at DESC");
$myTickets->execute(['uid' => $_SESSION['user_id']]);
$myTickets = $myTickets->fetchAll(PDO::FETCH_ASSOC);

$myUpdates = [];
$u = $pdo->prepare("SELECT fu.feedback_id, fu.status, fu.message, fu.created_at
                    FROM feedback_updates fu
                    JOIN feedback f ON f.id = fu.feedback_id
                    WHERE f.user_id = :uid
                    ORDER BY fu.created_at ASC, fu.id ASC");
$u->execute(['uid' => $_SESSION['user_id']]);
foreach ($u->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $myUpdates[$row['feedback_id']][] = $row;
}


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
    <h2>My Feedback Tickets</h2>
    <?php if (empty($myTickets)): ?>
      <p>You haven't submitted any feedback yet.</p>
    <?php endif; ?>
    <?php foreach ($myTickets as $t): ?>
      <details class="ticket-details">
        <summary>
          <span class="dashboard-item-title"><?= htmlspecialchars($t['ticket_number']) ?> — <?= htmlspecialchars($t['category']) ?></span>
          <span class="status-pill status-<?= htmlspecialchars($t['status']) ?>"><?= htmlspecialchars(ticket_status_label($t['status'])) ?></span>
        </summary>
        <p class="ticket-message"><?= nl2br(htmlspecialchars($t['message'])) ?></p>
        <?php render_ticket_timeline($t, $myUpdates[$t['id']] ?? []); ?>
      </details>
    <?php endforeach; ?>
  </div>
</section>


<section class="about-block">
  <div class="container">
    <h2>Admission Progress</h2>
    <p><?= $checkDone ?> of <?= $checkTotal ?> requirements completed</p>
    <div class="progress-bar-track">
      <div class="progress-bar-fill" style="width: <?= $checkPercent ?>%;"></div>
    </div>
    <p style="margin-top:10px;"><a href="../admissions/checklist.php" class="dashboard-link">Open my checklist &rarr;</a></p>
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