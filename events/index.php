<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="../index.php">Portal Home</a> / <span>Events &amp; Activities</span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow">Events &amp; Activities</p>
    <h1>Campus Events</h1>
    <p class="tagline">Discover, explore, and register for upcoming collegiate seminars, hackathons, guest lectures, and campus activities.</p>
  </div>
</section>

<!-- SEARCH -->
<section class="about-block">
  <div class="container">
    <div class="search-filter-bar">
      <div class="search-box">
        <input type="text" id="event-search" placeholder="Search events by name, venue, or topic...">
      </div>
    </div>
    <p class="results-count"><span id="results-count">4</span> upcoming events</p>

    <!-- EVENT CARDS -->
    <div class="event-grid" id="event-grid">

      <div class="event-card" data-title="annual tech fest codesphere">
        <div class="event-card-top">
          <span class="event-tag">Technical / Hackathon</span>
          <span class="seats-remaining">Seats available</span>
        </div>
        <h3>Annual Tech Fest "CodeSphere"</h3>
        <p>A coding hackathon featuring UI/UX sprints, algorithmic challenges, and collegiate project exhibitions.</p>
        <div class="event-details">
          <div>📅 To be announced</div>
          <div>🕒 Full day event</div>
          <div>📍 Atur Centre Auditorium &amp; Labs</div>
        </div>
        <div class="event-actions">
          <a href="details.php?event=codesphere" class="btn-outline-sm">View Details</a>
          <button class="btn-mark-complete" onclick="registerEvent('Annual Tech Fest \'CodeSphere\'')">Register &rarr;</button>
        </div>
      </div>

      <div class="event-card" data-title="guest lecture careers in cloud computing">
        <div class="event-card-top">
          <span class="event-tag">Industry Speaker</span>
          <span class="seats-remaining">Seats available</span>
        </div>
        <h3>Guest Lecture: Careers in Cloud Computing</h3>
        <p>An interactive session with industry professionals on cloud infrastructure, DevOps, and career pathways.</p>
        <div class="event-details">
          <div>📅 To be announced</div>
          <div>🕒 Afternoon session</div>
          <div>📍 Seminar Hall, SICSR Campus</div>
        </div>
        <div class="event-actions">
          <a href="details.php?event=cloud-lecture" class="btn-outline-sm">View Details</a>
          <button class="btn-mark-complete" onclick="registerEvent('Guest Lecture: Careers in Cloud Computing')">Register &rarr;</button>
        </div>
      </div>

      <div class="event-card" data-title="inter college sports meet">
        <div class="event-card-top">
          <span class="event-tag">Athletics &amp; Sports</span>
          <span class="seats-remaining">Team slots open</span>
        </div>
        <h3>Inter-College Sports Meet</h3>
        <p>Annual collegiate athletic championship featuring track events, badminton, basketball, and table tennis.</p>
        <div class="event-details">
          <div>📅 To be announced</div>
          <div>🕒 Multi-day event</div>
          <div>📍 University Sports Complex</div>
        </div>
        <div class="event-actions">
          <a href="details.php?event=sports-meet" class="btn-outline-sm">View Details</a>
          <button class="btn-mark-complete" onclick="registerEvent('Inter-College Sports Meet')">Register &rarr;</button>
        </div>
      </div>

      <div class="event-card" data-title="workshop intro to data science">
        <div class="event-card-top">
          <span class="event-tag">Hands-on Workshop</span>
          <span class="seats-remaining">Seats available</span>
        </div>
        <h3>Workshop: Intro to Data Science</h3>
        <p>A practical hands-on session covering foundational data science concepts and exploratory data analysis.</p>
        <div class="event-details">
          <div>📅 To be announced</div>
          <div>🕒 Morning session</div>
          <div>📍 Computer Lab, Atur Centre</div>
        </div>
        <div class="event-actions">
          <a href="details.php?event=data-science-workshop" class="btn-outline-sm">View Details</a>
          <button class="btn-mark-complete" onclick="registerEvent('Workshop: Intro to Data Science')">Register &rarr;</button>
        </div>
      </div>

    </div>

    <p class="no-results" id="no-results" style="display:none;">No events match your search.</p>
  </div>
</section>

<!-- CLOSING NOTE -->
<section class="about-block alt">
  <div class="container">
    <p>Want to propose an event or view past event galleries? Contact the Student Activities Council for more information.</p>
  </div>
</section>

<!-- CONFIRMATION TOAST (hidden by default) -->
<div id="register-toast" class="toast"></div>

<?php include '../includes/footer.php'; ?>