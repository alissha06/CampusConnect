<?php $root = '../'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<?php
// Sample data. Sneha can replace this array with rows from MySQL later.
$items = [
  ['type' => 'found', 'icon' => '🎧', 'name' => 'Black Wireless Earbuds', 'desc' => 'Charging case with Bluetooth earbuds inside.', 'location' => 'Library', 'date' => 'Posted recently', 'contact' => 'demo.student@example.com'],
  ['type' => 'lost',  'icon' => '🧴', 'name' => 'Blue Water Bottle', 'desc' => 'Insulated steel bottle with a small dent near the base.', 'location' => 'Computer Lab', 'date' => 'Posted recently', 'contact' => 'demo.student@example.com'],
  ['type' => 'found', 'icon' => '🪪', 'name' => 'Student ID Card', 'desc' => 'Student ID card in a transparent lanyard sleeve.', 'location' => 'Canteen', 'date' => 'Posted recently', 'contact' => 'demo.student@example.com'],
  ['type' => 'lost',  'icon' => '🧮', 'name' => 'Scientific Calculator', 'desc' => 'Scientific calculator with a name written on the back cover.', 'location' => 'Seminar Hall', 'date' => 'Posted recently', 'contact' => 'demo.student@example.com'],
  ['type' => 'found', 'icon' => '👕', 'name' => 'Grey Hoodie', 'desc' => 'Grey zipper hoodie left on a bench.', 'location' => 'Main Corridor', 'date' => 'Posted recently', 'contact' => 'demo.student@example.com'],
  ['type' => 'lost',  'icon' => '🔑', 'name' => 'Set of Keys', 'desc' => 'Set of keys with a red keychain.', 'location' => 'Parking Area', 'date' => 'Posted recently', 'contact' => 'demo.student@example.com'],
];
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

    <p class="results-count"><span id="results-count"><?php echo count($items); ?></span> items listed</p>

    <!-- ITEM CARDS -->
    <div class="item-grid" id="item-grid">
      <?php foreach ($items as $item): ?>
      <div class="item-card"
           data-type="<?php echo $item['type']; ?>"
           data-search="<?php echo htmlspecialchars(strtolower($item['name'] . ' ' . $item['desc'] . ' ' . $item['location'])); ?>"
           data-name="<?php echo htmlspecialchars($item['name']); ?>"
           data-desc="<?php echo htmlspecialchars($item['desc']); ?>"
           data-location="<?php echo htmlspecialchars($item['location']); ?>"
           data-date="<?php echo htmlspecialchars($item['date']); ?>"
           data-contact="<?php echo htmlspecialchars($item['contact']); ?>">
        <div class="item-photo">
          <span class="item-type-tag <?php echo $item['type']; ?>"><?php echo ucfirst($item['type']); ?></span>
          <span class="item-photo-icon"><?php echo $item['icon']; ?></span>
        </div>
        <div class="item-body">
          <h3><?php echo htmlspecialchars($item['name']); ?></h3>
          <p><?php echo htmlspecialchars($item['desc']); ?></p>
          <div class="item-meta">
            <div>📍 <?php echo htmlspecialchars($item['location']); ?></div>
            <div>📅 <?php echo htmlspecialchars($item['date']); ?></div>
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