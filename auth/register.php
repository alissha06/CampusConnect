<?php $root = '../'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="<?php echo $root; ?>index.php">Portal Home</a> / <span>Register</span>
  </div>
</div>

<!-- AUTH PAGE -->
<section class="about-block auth-section">
  <div class="container">
    <div class="auth-card wide">
      <div class="auth-icon">👤</div>
      <h1>Create Your Account</h1>
      <p class="tagline">Register to track your admission progress and sign up for events.</p>

      <div class="form-success" id="register-success" style="display:none;">
        ✓ Account created. (Demo only: no account is actually saved yet.)
      </div>

      <form id="register-form" method="post" novalidate>

        <div class="form-group">
          <label for="reg-full-name">Full name <span class="req">*</span></label>
          <input type="text" id="reg-full-name" name="name" placeholder="Your full name">
          <span class="field-error" id="reg-err-name"></span>
        </div>

        <div class="form-group">
          <label for="reg-full-email">Email <span class="req">*</span></label>
          <input type="email" id="reg-full-email" name="email" placeholder="you@example.com">
          <span class="field-error" id="reg-err-email"></span>
        </div>

        <div class="form-group">
          <label for="reg-dept">Department <span class="req">*</span></label>
          <select id="reg-dept" name="department">
            <option value="">Select your programme</option>
            <option>BCA</option>
            <option>BBA (IT)</option>
            <option>MSc (CA)</option>
            <option>MBA (IT)</option>
          </select>
          <span class="field-error" id="reg-err-dept"></span>
        </div>

        <div class="form-group">
          <label for="reg-password">Password <span class="req">*</span></label>
          <div class="password-field">
            <input type="password" id="reg-password" name="password" placeholder="Create a password">
            <button type="button" class="show-toggle" data-target="reg-password">Show</button>
          </div>
          <div class="strength-track">
            <div class="strength-fill" id="strength-fill"></div>
          </div>
          <div class="strength-row">
            <span id="strength-label">Password strength</span>
            <span>Min. 8 characters, letters &amp; numbers</span>
          </div>
          <span class="field-error" id="reg-err-password"></span>
        </div>

        <div class="form-group">
          <label for="reg-confirm">Confirm password <span class="req">*</span></label>
          <div class="password-field">
            <input type="password" id="reg-confirm" name="confirm_password" placeholder="Re-enter your password">
            <button type="button" class="show-toggle" data-target="reg-confirm">Show</button>
          </div>
          <span class="field-error" id="reg-err-confirm"></span>
        </div>

        <div class="form-group">
          <label class="checkbox-label">
            <input type="checkbox" id="reg-terms" name="terms"> I agree to the Terms of Use and Privacy Policy
          </label>
          <span class="field-error" id="reg-err-terms"></span>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%;">Create Account</button>

        <p class="auth-switch">Already have an account? <a href="login.php">Login</a></p>
      </form>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>