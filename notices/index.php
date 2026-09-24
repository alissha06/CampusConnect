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

    <p class="results-count"><span id="results-count">6</span> notices found</p>

    <!-- NOTICE LIST -->
    <div class="notice-list" id="notice-list">

      <div class="notice-card" data-category="examination" data-title="internal examination timetable bca semesters ii iv vi">
        <span class="notice-tag examination">Examination</span>
        <h3>Internal Examination Timetable — BCA Semesters II, IV &amp; VI</h3>
        <p>Schedule for continuous internal assessments, practical submissions, and theory examination dates.</p>
        <div class="notice-meta">
          <span>📅 Latest Update</span>
          <a href="#" class="notice-link">Read More &rarr;</a>
        </div>
      </div>

      <div class="notice-card" data-category="general" data-title="admission document submission deadline">
        <span class="notice-tag general">General</span>
        <h3>Admission Document Submission Deadline</h3>
        <p>Mandatory physical document verification and anti-ragging declaration submission deadline.</p>
        <div class="notice-meta">
          <span>📅 Recent</span>
          <a href="#" class="notice-link">Read More &rarr;</a>
        </div>
      </div>

      <div class="notice-card" data-category="academic" data-title="workshop on cloud computing announced">
        <span class="notice-tag academic">Academic</span>
        <h3>Workshop on Cloud Computing Announced</h3>
        <p>Hands-on workshop on cloud architecture, open to all second and final year students.</p>
        <div class="notice-meta">
          <span>📅 Recent</span>
          <a href="#" class="notice-link">Read More &rarr;</a>
        </div>
      </div>

      <div class="notice-card" data-category="events" data-title="annual tech fest codesphere registrations open">
        <span class="notice-tag events">Events</span>
        <h3>Annual Tech Fest 'CodeSphere' Registrations Open</h3>
        <p>Hackathons, coding challenges, UI design sprint, and project exhibitions. Early bird registrations open now.</p>
        <div class="notice-meta">
          <span>📅 Recent</span>
          <a href="#" class="notice-link">Read More &rarr;</a>
        </div>
      </div>

      <div class="notice-card" data-category="placement" data-title="campus recruitment drive internship openings">
        <span class="notice-tag placement">Placement</span>
        <h3>Campus Recruitment Drive — Internship Openings</h3>
        <p>Registrations open for the upcoming placement drive. Eligible final-year students can apply through the Placement Cell.</p>
        <div class="notice-meta">
          <span>📅 Recent</span>
          <a href="#" class="notice-link">Read More &rarr;</a>
        </div>
      </div>

      <div class="notice-card" data-category="general" data-title="library timings revised for exam season">
        <span class="notice-tag general">General</span>
        <h3>Library Timings Revised for Exam Season</h3>
        <p>Reference and reading halls will have extended hours on all weekdays and Saturdays through the examination cycle.</p>
        <div class="notice-meta">
          <span>📅 Recent</span>
          <a href="#" class="notice-link">Read More &rarr;</a>
        </div>
      </div>

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