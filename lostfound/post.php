<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
?>



<?php $root = '../'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="<?php echo $root; ?>index.php">Portal Home</a> / <a href="index.php">Lost &amp; Found</a> / <span>Post an Item</span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header center">
  <div class="container">
    <p class="hero-eyebrow">Lost &amp; Found</p>
    <h1>Post an Item</h1>
    <p class="tagline">Share clear details so the owner or finder can connect with you quickly.</p>
  </div>
</section>

<!-- FORM -->
<section class="about-block">
  <div class="container">
    <div class="form-card">

      <div class="form-success" id="form-success" style="display:none;">
        ✓ Your post has been submitted. 
      </div>

      <form id="post-item-form" method="post" enctype="multipart/form-data" novalidate>

        <!-- Lost / Found toggle -->
        <div class="form-group">
          <label>Report type</label>
          <div class="type-toggle">
            <button type="button" class="type-option active" data-type="lost">I Lost Something</button>
            <button type="button" class="type-option" data-type="found">I Found Something</button>
          </div>
          <input type="hidden" name="item_type" id="item-type" value="lost">
        </div>

        <div class="form-group">
          <label for="item-name">Item name <span class="req">*</span></label>
          <input type="text" id="item-name" name="item_name" placeholder="e.g., Black wireless earbuds, blue water bottle">
          <span class="field-error" id="err-name"></span>
        </div>

        <div class="form-group">
          <label for="item-category">Category <span class="req">*</span></label>
          <select id="item-category" name="category">
            <option value="">Select a category</option>
            <option>Electronics</option>
            <option>Accessories</option>
            <option>Documents &amp; ID</option>
            <option>Clothing</option>
            <option>Books &amp; Stationery</option>
            <option>Other</option>
          </select>
          <span class="field-error" id="err-category"></span>
        </div>

        <div class="form-group">
          <label for="item-desc">Description <span class="req">*</span> <span class="char-count"><span id="char-count">0</span>/400</span></label>
          <textarea id="item-desc" name="description" rows="4" maxlength="400" placeholder="Describe distinguishing marks, brand, color, or contents."></textarea>
          <span class="field-error" id="err-desc"></span>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="item-location"><span id="location-label">Location lost</span> <span class="req">*</span></label>
            <input type="text" id="item-location" name="location" placeholder="e.g., Library, Computer Lab">
            <span class="field-error" id="err-location"></span>
          </div>
          <div class="form-group">
            <label for="item-date"><span id="date-label">Date lost</span> <span class="req">*</span></label>
            <input type="date" id="item-date" name="item_date">
            <span class="field-error" id="err-date"></span>
          </div>
        </div>

        <!-- Photo upload -->
        <div class="form-group">
          <label>Photo <span class="optional">(optional, recommended)</span></label>
          <label for="item-photo" class="upload-zone" id="upload-zone">
            <span class="upload-icon">📷</span>
            <span><strong>Click to upload a photo</strong> or drag and drop</span>
            <span class="upload-hint">PNG, JPG or WEBP, up to 5 MB</span>
          </label>
          <input type="file" id="item-photo" name="photo" accept="image/png,image/jpeg,image/webp" hidden>
          <div class="upload-preview" id="upload-preview" style="display:none;">
            <img id="preview-img" src="" alt="Selected photo preview">
            <button type="button" class="link-btn" id="remove-photo">Remove photo</button>
          </div>
          <span class="field-error" id="err-photo"></span>
        </div>

        <div class="form-group">
          <label for="item-email">Contact email <span class="req">*</span></label>
          <input type="email" id="item-email" name="contact_email" placeholder="you@example.com">
          <span class="field-error" id="err-email"></span>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Submit Post</button>
          <button type="reset" class="link-btn" id="clear-form">Clear form</button>
          <a href="index.php" class="link-btn">Cancel</a>
        </div>

        <p class="form-note">Your contact email will be visible to other students so they can reach you.</p>
      </form>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>