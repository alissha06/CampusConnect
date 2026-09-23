<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="../index.php">Portal Home</a> / <a href="index.php">Admissions</a> / <span>My Checklist</span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Admissions • Student Tracker</p>
    <h1>My Admission Checklist</h1>
    <p class="tagline">Track your required documents and compliance undertakings for admission completion.</p>
    <div class="student-tag">👤 Student: Demo Student</div>
  </div>
</section>

<!-- PROGRESS -->
<section class="about-block">
  <div class="container">
    <div class="progress-card">
      <div class="progress-card-header">
        <div>
          <h3>Admission Progress</h3>
          <p id="progress-caption">2 of 4 requirements completed</p>
        </div>
        <div class="progress-percent"><span id="progress-number">50</span>%<span class="progress-label">Complete</span></div>
      </div>
      <div class="progress-bar-track">
        <div class="progress-bar-fill" id="progress-bar-fill" style="width: 50%;"></div>
      </div>
    </div>
  </div>
</section>

<!-- CHECKLIST -->
<section class="about-block alt">
  <div class="container">
    <h2>Verification Tasks</h2>

    <div class="checklist">

      <!-- Completed item -->
      <div class="checklist-item completed">
        <span class="checklist-icon">✓</span>
        <div class="checklist-body">
          <div class="checklist-title-row">
            <h3>Academic Marksheet</h3>
            <span class="status-tag done">Completed</span>
          </div>
          <p>Class 10th and 12th official mark statements and passing certificates uploaded and verified.</p>
        </div>
      </div>

      <!-- Completed item -->
      <div class="checklist-item completed">
        <span class="checklist-icon">✓</span>
        <div class="checklist-body">
          <div class="checklist-title-row">
            <h3>Identity Document</h3>
            <span class="status-tag done">Completed</span>
          </div>
          <p>Government-authorized photo identification verified against registered student profile.</p>
        </div>
      </div>

      <!-- Pending item -->
      <div class="checklist-item pending" data-item="anti-ragging">
        <span class="checklist-icon">○</span>
        <div class="checklist-body">
          <div class="checklist-title-row">
            <h3>Anti-Ragging Undertaking</h3>
            <span class="status-tag pending-tag">Pending</span>
          </div>
          <p>Mandatory statutory compliance declaration. Reference ID and signed parent acknowledgement required.</p>
          <div class="checklist-actions">
            <a href="requirement_details.php?doc=anti-ragging" class="btn-outline-sm">View Guide</a>
            <button class="btn-mark-complete" onclick="markCompleted(this)">✓ Mark as Completed</button>
          </div>
        </div>
      </div>

      <!-- Pending item -->
      <div class="checklist-item pending" data-item="affidavit">
        <span class="checklist-icon">○</span>
        <div class="checklist-body">
          <div class="checklist-title-row">
            <h3>Affidavit</h3>
            <span class="status-tag pending-tag">Pending</span>
          </div>
          <p>Notarized legal declaration verifying educational continuity and student code of conduct.</p>
          <div class="checklist-actions">
            <a href="requirement_details.php?doc=affidavit" class="btn-outline-sm">View Guide</a>
            <button class="btn-mark-complete" onclick="markCompleted(this)">✓ Mark as Completed</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CLOSING NOTE -->
<section class="about-block">
  <div class="container">
    <div class="help-banner">
      <p>Have questions about any requirement? Contact the Admissions Guidance Cell at <strong>admissions@sicsr.ac.in</strong>.</p>
      <a href="index.php" class="btn btn-primary">Go to Admissions Guidance &rarr;</a>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>