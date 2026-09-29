<?php $root = '../'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<?php
require_once '../includes/db.php';
$stmt = $pdo->query("SELECT * FROM lost_found WHERE status = 'open' ORDER BY posted_at DESC");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

function item_icon($category) {
    $icons = [
        'Electronics' => '🎧', 'Accessories' => '🧴', 'Documents & ID' => '🪪',
        'Clothing' => '👕', 'Books & Stationery' => '📚',
    ];
    return $icons[$category] ?? '📦';
}
?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="<?php echo $root; ?>index.php">Portal Home</a> / <span>Lost &amp; Found</span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header">
  <div class="container page-header-row">
    <div>
      <p class="hero-eyebrow">Lost &amp; Found</p>
      <h1>Campus Lost &amp; Found</h1>
      <p class="tagline">Helping students recover lost belongings and return found items across campus.</p>
    </div>
    <a href="post.php" class="btn btn-primary">+ Post an Item</a>
  </div>
</section>

<!-- SEARCH & FILTER -->
<section class="about-block">
  <div class="container">
    <div class="search-filter-bar">
      <div class="search-box">
        <input type="text" id="item-search" placeholder="Search items by name, description, or location...">
      </div>
      <div class="filter-pills" id="item-filter-pills">
        <button class="filter-pill active" data-filter="all">All</button>
        <button class="filter-pill" data-filter="lost">Lost</button>
        <button class="filter-pill" data-filter="found">Found</button>
      </div>
    </div>

   <p class="results-count"><span id="results-count"><?= count($items) ?></span> items listed</p>
   
    <!-- ITEM CARDS -->
    <div class="item-grid" id="item-grid">
<?php foreach ($items as $item): ?>
  <div class="item-card"
       data-type="<?= htmlspecialchars($item['type']) ?>"
       data-search="<?= htmlspecialchars(strtolower($item['item_name'] . ' ' . $item['description'] . ' ' . $item['location'])) ?>"
       data-name="<?= htmlspecialchars($item['item_name']) ?>"
       data-desc="<?= htmlspecialchars($item['description']) ?>"
       data-location="<?= htmlspecialchars($item['location']) ?>"
       data-date="<?= htmlspecialchars(date('d M Y', strtotime($item['item_date']))) ?>"
       data-contact="<?= htmlspecialchars($item['contact']) ?>">
    <div class="item-photo">
      <span class="item-type-tag <?= htmlspecialchars($item['type']) ?>"><?= ucfirst($item['type']) ?></span>
      <?php if (!empty($item['photo_path'])): ?>
        <img src="../<?= htmlspecialchars($item['photo_path']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>" class="item-photo-img">
      <?php else: ?>
        <span class="item-photo-icon"><?= item_icon($item['category']) ?></span>
      <?php endif; ?>
    </div>
    <div class="item-body">
      <h3><?= htmlspecialchars($item['item_name']) ?></h3>
      <p><?= htmlspecialchars($item['description']) ?></p>
      <div class="item-meta">
        <div>📍 <?= htmlspecialchars($item['location']) ?></div>
        <div>📅 <?= htmlspecialchars(date('d M Y', strtotime($item['item_date']))) ?></div>
      </div>
      <button class="btn-outline-block" onclick="openItemModal(this)">View Details</button>
    </div>
  </div>
<?php endforeach; ?>
</div>

    <p class="no-results" id="no-results" style="display:none;">No items match your search.</p>
  </div>
</section>

<!-- CLOSING NOTE -->
<section class="about-block alt">
  <div class="container">
    <p>Found something? Hand it in at the college office, and carry a valid ID when collecting an item.</p>
  </div>
</section>

<!-- ITEM DETAILS MODAL -->
<div id="item-modal" class="modal-overlay">
  <div class="modal-box">
    <button class="modal-close" onclick="closeItemModal()">&times;</button>
    <span class="item-type-tag inline" id="item-modal-tag"></span>
    <h3 id="item-modal-title"></h3>
    <p class="modal-subtext" id="item-modal-desc"></p>
    <div class="event-info-row">📍 <span id="item-modal-location"></span></div>
    <div class="event-info-row">📅 <span id="item-modal-date"></span></div>
    <div class="event-info-row">✉ <span id="item-modal-contact"></span></div>
    <p class="form-note">Contact the poster to arrange a handover. Please verify ownership before returning an item.</p>
  </div>
</div>

<?php include '../includes/footer.php'; ?>