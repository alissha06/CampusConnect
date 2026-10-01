<?php
$root = '../';
require_once '../includes/db.php';

$slug = $_GET['event'] ?? 'codesphere';
$stmt = $pdo->prepare("SELECT * FROM events WHERE slug = :slug");
$stmt->execute(['slug' => $slug]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    // fall back to the first event rather than showing a broken page
    $event = $pdo->query("SELECT * FROM events ORDER BY posted_at DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
}

include '../includes/header.php';
include '../includes/navbar.php';
?>



<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="<?php echo $root; ?>index.php">Portal Home</a> / <a href="index.php">Events</a> / <span><?php echo $event['title']; ?></span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow"><?php echo $event['category']; ?></p>
    <h1><?php echo $event['title']; ?></h1>
  </div>
</section>

<!-- DETAILS -->
<section class="about-block">
  <div class="container">
    <div class="event-detail-grid">
      <div>
        <h2>About This Event</h2>
        <p><?php echo $event['description']; ?></p>
      </div>
      <div class="event-info-card">
        <div class="event-info-row">📅 <span><?php echo $event['event_date']; ?></span></div>
        <div class="event-info-row">🕒 <span><?php echo $event['event_time']; ?></span></div>
        <div class="event-info-row">📍 <span><?php echo $event['venue']; ?></span></div>
        <div class="event-info-row">🎟 <span><?php echo $event['seats_info']; ?></span></div>
        <button class="btn btn-primary" style="width:100%; margin-top:16px;" onclick="openRegisterModal('<?= htmlspecialchars(addslashes($event['title'])) ?>', '<?= htmlspecialchars(addslashes($event['slug'])) ?>')">Register Now</button>
      </div>
    </div>
  </div>
</section>

<section class="about-block alt">
  <div class="container">
    <a href="index.php" class="back-link">&larr; Back to All Events</a>
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