<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}
$root = '../';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Admin</p>
    <h1>Post an Event</h1>
  </div>
</section>

<section class="about-block">
  <div class="container">
    <div class="form-card">
      <form method="post" action="create_submit.php">
        <div class="form-group">
          <label for="title">Event title</label>
          <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
          <label for="slug">URL slug</label>
          <input type="text" id="slug" name="slug" placeholder="e.g. codesphere (no spaces)" required>
          <span class="form-note" style="display:block;margin-top:4px;">Used in the event's link, lowercase letters, numbers and hyphens only.</span>
        </div>

        <div class="form-group">
          <label for="category">Category</label>
          <input type="text" id="category" name="category" placeholder="e.g. Technical / Hackathon" required>
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="event_date">Date</label>
            <input type="text" id="event_date" name="event_date" placeholder="e.g. 15 Nov 2026 or To be announced" required>
          </div>
          <div class="form-group">
            <label for="event_time">Time</label>
            <input type="text" id="event_time" name="event_time" placeholder="e.g. Full day event" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" id="venue" name="venue" required>
          </div>
          <div class="form-group">
            <label for="seats_info">Seats info</label>
            <input type="text" id="seats_info" name="seats_info" placeholder="e.g. Seats available" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Post Event</button>
      </form>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>