<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
?>
<?php $root = '../'; ?>
<?php
require_once '../includes/db.php';
$stmt = $pdo->query("SELECT id, title, description, category, posted_at FROM notices ORDER BY posted_at DESC");
$notices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="../index.php">Portal Home</a> / <span>Notices &amp; Circulars</span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Notices &amp; Official Circulars</p>
    <h1>Notices &amp; Circulars</h1>
    <p class="tagline">Stay updated with official institutional announcements, academic schedules, examination notifications, and general circulars.</p>
  </div>
</section>

<!-- SEARCH & FILTER -->
<section class="about-block">
  <div class="container">
    <div class="search-filter-bar">
      <div class="search-box">
        <input type="text" id="notice-search" placeholder="Search notices, circulars, or keywords...">
      </div>
      <div class="filter-pills" id="filter-pills">
        <button class="filter-pill active" data-filter="all">All</button>
        <button class="filter-pill" data-filter="academic">Academic</button>
        <button class="filter-pill" data-filter="examination">Examination</button>
        <button class="filter-pill" data-filter="events">Events</button>
        <button class="filter-pill" data-filter="placement">Placement</button>
        <button class="filter-pill" data-filter="general">General</button>
      </div>
    </div>

    <p class="results-count"><span id="results-count"><?= count($notices) ?></span> notices found</p>

    <!-- NOTICE LIST -->
    
      <div class="notice-list" id="notice-list">
      <?php foreach ($notices as $n):
        $cat = $n['category'];
         $dataTitle = trim(preg_replace('/[^a-z0-9]+/', ' ', strtolower($n['title'])));
        ?>
      <div class="notice-card" data-category="<?= htmlspecialchars($cat) ?>" data-title="<?= htmlspecialchars($dataTitle) ?>">
        <span class="notice-tag <?= htmlspecialchars($cat) ?>"><?= htmlspecialchars(ucfirst($cat)) ?></span>
        <h3><?= htmlspecialchars($n['title']) ?></h3>
        <p><?= htmlspecialchars($n['description']) ?></p>
        <div class="notice-meta">
          <span>📅 <?= date('d M Y', strtotime($n['posted_at'])) ?></span>
          <a href="details.php?id=<?= (int)$n['id'] ?>" class="notice-link">Read More &rarr;</a>
        </div>
      </div>
        <?php endforeach; ?>
    </div>

    <p class="no-results" id="no-results" style="display:none;">No notices match your search.</p>

  </div>
</section>

<!-- CLOSING NOTE -->
<section class="about-block alt">
  <div class="container">
    <p>Need a past circular or archival record? Contact the Registrar's Office at <strong>admissions@sicsr.ac.in</strong>.</p>
  </div>
</section>

<?php include '../includes/footer.php'; ?>