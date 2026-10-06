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
    <h1>Post a Notice</h1>
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
          <label for="description">Description</label>
          <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
          <label for="category">Category</label>
          <select id="category" name="category" required>
            <option value="academic">Academic</option>
            <option value="examination">Examination</option>
            <option value="events">Events</option>
            <option value="placement">Placement</option>
            <option value="general">General</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Post Notice</button>
      </form>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>