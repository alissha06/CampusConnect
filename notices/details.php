<?php
$root = '../';
require_once '../includes/db.php';

// Read the notice id from the URL (?id=3). (int) makes sure it's a plain number.
$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT id, title, description, category, posted_at FROM notices WHERE id = :id");
$stmt->execute(['id' => $id]);
$notice = $stmt->fetch(PDO::FETCH_ASSOC);

// If the id doesn't exist, send a proper 404 status (must happen before any HTML is output)
if (!$notice) {
    http_response_code(404);
}

include '../includes/header.php';
include '../includes/navbar.php';
?>

<?php if (!$notice): ?>

<!-- NOT FOUND -->
<div class="breadcrumb">
  <div class="container">
    <a href="../index.php">Portal Home</a> / <a href="index.php">Notices</a> / <span>Not found</span>
  </div>
</div>

<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Notices &amp; Circulars</p>
    <h1>Notice not found</h1>
    <p class="tagline">This notice may have been removed, or the link is incorrect.</p>
  </div>
</section>

<section class="about-block">
  <div class="container">
    <a href="index.php" class="back-link">&larr; Back to All Notices</a>
  </div>
</section>

<?php else: ?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="../index.php">Portal Home</a> / <a href="index.php">Notices</a> / <span><?= htmlspecialchars($notice['title']) ?></span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Notices &amp; Circulars</p>
    <h1><?= htmlspecialchars($notice['title']) ?></h1>
    <p>
      <span class="notice-tag <?= htmlspecialchars($notice['category']) ?>"><?= htmlspecialchars(ucfirst($notice['category'])) ?></span>
      &nbsp; 📅 <?= date('d M Y', strtotime($notice['posted_at'])) ?>
    </p>
  </div>
</section>

<!-- NOTICE BODY -->
<section class="about-block">
  <div class="container">
    <h2>Details</h2>
    <p><?= nl2br(htmlspecialchars($notice['description'])) ?></p>
  </div>
</section>

<!-- BACK LINK -->
<section class="about-block alt">
  <div class="container">
    <a href="index.php" class="back-link">&larr; Back to All Notices</a>
  </div>
</section>

<?php endif; ?>

<?php include '../includes/footer.php'; ?>