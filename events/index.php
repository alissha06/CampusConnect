<?php
$root = '../';
require_once '../includes/db.php';
$stmt = $pdo->query("SELECT slug, category, title, description, event_date, event_time, venue, seats_info FROM events ORDER BY posted_at DESC");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
include '../includes/header.php';
include '../includes/navbar.php';
?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="<?php echo $root; ?>index.php">Portal Home</a> / <span>Events &amp; Activities</span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Events &amp; Activities</p>
    <h1>Campus Events</h1>
    <p class="tagline">Discover, explore, and register for upcoming collegiate seminars, hackathons, guest lectures, and campus activities.</p>
  </div>
</section>

<!-- SEARCH -->
<section class="about-block">
  <div class="container">
    <div class="search-filter-bar">
      <div class="search-box">
        <input type="text" id="event-search" placeholder="Search events by name, venue, or topic...">
      </div>
    </div>
    <p class="results-count"><span id="results-count"><?= count($events) ?></span> upcoming events</p>
    
<div class="event-grid" id="event-grid">
<?php foreach ($events as $e):
    $dataTitle = trim(preg_replace('/[^a-z0-9]+/', ' ', strtolower($e['title'])));
?>
  <div class="event-card" data-title="<?= htmlspecialchars($dataTitle) ?>">
    <div class="event-card-top">
      <span class="event-tag"><?= htmlspecialchars($e['category']) ?></span>
      <span class="seats-remaining"><?= htmlspecialchars($e['seats_info']) ?></span>
    </div>
    <h3><?= htmlspecialchars($e['title']) ?></h3>
    <p><?= htmlspecialchars($e['description']) ?></p>
    <div class="event-details">
      <div>📅 <?= htmlspecialchars($e['event_date']) ?></div>
      <div>🕒 <?= htmlspecialchars($e['event_time']) ?></div>
      <div>📍 <?= htmlspecialchars($e['venue']) ?></div>
    </div>
    <div class="event-actions">
      <a href="details.php?event=<?= urlencode($e['slug']) ?>" class="btn-outline-sm">View Details</a>
      <button class="btn-mark-complete" onclick="openRegisterModal('<?= addslashes($e['title']) ?>', '<?= addslashes($e['slug']) ?>')">Register &rarr;</button>
    </div>
  </div>
<?php endforeach; ?>
 <p class="no-results" id="no-results" style="display:none;">No events match your search.</p>
</div>
<!-- CLOSING NOTE -->
<section class="about-block alt">
  <div class="container">
    <p>Want to propose an event or view past event galleries? Contact the Student Activities Council for more information.</p>
  </div>
</section>

<!-- REGISTRATION MODAL -->
<div id="register-modal" class="modal-overlay">
  <div class="modal-box">
    <button class="modal-close" onclick="closeRegisterModal()">&times;</button>
    <h3>Register for <span id="modal-event-name"></span></h3>
    <p class="modal-subtext">Fill in your details to reserve your spot.</p>
    <form id="register-form" onsubmit="submitRegistration(event)">
      <div class="form-group">
        <label for="reg-name">Full Name</label>
        <input type="text" id="reg-name" required placeholder="Your full name">
      </div>
      <div class="form-group">
        <label for="reg-email">Email</label>
        <input type="email" id="reg-email" required placeholder="you@example.com">
      </div>
      <div class="form-group">
        <label for="reg-dept">Department</label>
        <select id="reg-dept" required>
          <option value="">Select department</option>
          <option>BCA</option>
          <option>BBA (IT)</option>
          <option>MSc (CA)</option>
          <option>MBA (IT)</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;">Confirm Registration</button>
    </form>
  </div>
</div>

<div id="register-toast" class="toast"></div>

<?php include '../includes/footer.php'; ?>