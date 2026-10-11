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
    <h1>Add Calendar Entry</h1>
  </div>
</section>

<section class="about-block">
  <div class="container">
    <div class="form-card">
      <form method="post" action="create_submit.php">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
          <label for="category">Type</label>
          <select id="category" name="category" required>
            <option value="academic">Academic</option>
            <option value="exam">Examination</option>
            <option value="holiday">Holiday</option>
            <option value="event">Event</option>
          </select>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="start_date">Start date</label>
            <input type="date" id="start_date" name="start_date" required>
          </div>
          <div class="form-group">
            <label for="end_date">End date (optional)</label>
            <input type="date" id="end_date" name="end_date">
          </div>
        </div>
        <div class="form-group">
          <label for="description">Description (optional)</label>
          <textarea id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Entry</button>
      </form>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>