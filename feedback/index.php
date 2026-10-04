<?php
session_start();
?>


<?php $root = '../'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="<?php echo $root; ?>index.php">Portal Home</a> / <span>Feedback</span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header center">
  <div class="container">
    <p class="hero-eyebrow">Feedback</p>
    <h1>Share Your Feedback</h1>
    <p class="tagline">Your feedback helps improve the portal and campus services for every student.</p>
  </div>
</section>

<!-- FORM -->
<section class="about-block">
  <div class="container">
    <div class="form-card">

      <div class="form-success" id="fb-success" style="display:none;">
         Thank you for your feedback! 
      </div>

      <form id="feedback-form" method="post" novalidate>

        <div class="form-row">
          <div class="form-group">
            <label for="fb-name">Full name <span class="req">*</span></label>
            <input type="text" id="fb-name" name="name" placeholder="Your full name">
            <span class="field-error" id="fb-err-name"></span>
          </div>
          <div class="form-group">
            <label for="fb-email">Email <span class="req">*</span></label>
            <input type="email" id="fb-email" name="email" placeholder="you@example.com">
            <span class="field-error" id="fb-err-email"></span>
          </div>
        </div>

        <div class="form-group">
          <label for="fb-category">Category <span class="req">*</span></label>
          <select id="fb-category" name="category">
            <option value="">Select a category</option>
            <option>Portal Experience</option>
            <option>Admissions Guidance</option>
            <option>Notices &amp; Events</option>
            <option>Lost &amp; Found</option>
            <option>Campus Services</option>
            <option>Other</option>
          </select>
          <span class="field-error" id="fb-err-category"></span>
        </div>

        <div class="form-group">
          <label>Overall rating <span class="req">*</span></label>
          <div class="rating-box">
            <div class="star-row" role="group" aria-label="Rating out of 5 stars">
              <button type="button" class="star-btn" aria-label="1 star out of 5">★</button>
              <button type="button" class="star-btn" aria-label="2 stars out of 5">★</button>
              <button type="button" class="star-btn" aria-label="3 stars out of 5">★</button>
              <button type="button" class="star-btn" aria-label="4 stars out of 5">★</button>
              <button type="button" class="star-btn" aria-label="5 stars out of 5">★</button>
            </div>
            <span class="rating-label" id="rating-label">Select a rating</span>
          </div>
          <input type="hidden" name="rating" id="fb-rating" value="">
          <span class="field-error" id="fb-err-rating"></span>
        </div>

        <div class="form-group">
          <label for="fb-message">Feedback message <span class="req">*</span> <span class="char-count"><span id="fb-char-count">0</span>/500</span></label>
          <textarea id="fb-message" name="message" rows="5" maxlength="500" placeholder="Tell us about your experience, report an issue, or suggest an improvement."></textarea>
          <span class="field-error" id="fb-err-message"></span>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Submit Feedback</button>
          <button type="reset" class="link-btn">Clear form</button>
        </div>

        <p class="form-note">Your feedback helps the college team improve the portal and campus services.</p>
      </form>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>