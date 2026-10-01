<?php $root = '../'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="<?php echo $root; ?>index.php">Portal Home</a> / <span>Login</span>
  </div>
</div>

<!-- AUTH PAGE -->
<section class="about-block auth-section">
  <div class="container">
    <div class="auth-card">
      <div class="auth-icon">🔒</div>
      <h1>Student Login</h1>
      <p class="tagline">Sign in to access your dashboard and admission checklist.</p>

      <div class="form-success" id="login-success" style="display:none;">
        ✓ Login successful. (Demo only: no real account exists yet.)
      </div>

      <form id="login-form" method="post" novalidate>

        <div class="form-group">
          <label for="login-email">College email <span class="req">*</span></label>
          <input type="email" id="login-email" name="email" placeholder="you@example.com">
          <span class="field-error" id="login-err-email"></span>
        </div>

        <div class="form-group">
          <label for="login-password">Password <span class="req">*</span></label>
          <div class="password-field">
            <input type="password" id="login-password" name="password" placeholder="Enter your password">
            <button type="button" class="show-toggle" data-target="login-password">Show</button>
          </div>
          <span class="field-error" id="login-err-password"></span>
        </div>

        <div class="auth-row">
          <label class="checkbox-label">
            <input type="checkbox" name="remember"> Remember me
          </label>
          <a href="#" class="auth-link">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%;">Login</button>

        <p class="auth-switch">New to CampusConnect? <a href="register.php">Create an account</a></p>
      </form>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>