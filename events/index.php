<?php $root = '../'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="<?php echo $root; ?>index.php">Portal Home</a> / <span>Events &amp; Activities</span>
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
          <button class="btn-mark-complete" onclick="openRegisterModal('Annual Tech Fest \'CodeSphere\'')">Register &rarr;</button>
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
          <button class="btn-mark-complete" onclick="openRegisterModal('Guest Lecture: Careers in Cloud Computing')">Register &rarr;</button>
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
          <button class="btn-mark-complete" onclick="openRegisterModal('Inter-College Sports Meet')">Register &rarr;</button>
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
          <button class="btn-mark-complete" onclick="openRegisterModal('Workshop: Intro to Data Science')">Register &rarr;</button>
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

<!-- REGISTRATION MODAL -->
<div id="register-modal" class="modal-overlay">
  <div class="modal-box">
    <button class="modal-close" onclick="closeRegisterModal()">&times;</button>
    <h3>Register for <span id="modal-event-name"></span></h3>
    <p class="modal-subtext">Fill in your details to reserve your spot.</p>
    <form id="register-form" onsubmit="submitRegistration(event)">
      <div class="form-group">
        <label for="reg-name">Full Name</label>
        <input type="text" id="reg-name" required placeholder="Your full name">
      </div>
      <div class="form-group">
        <label for="reg-email">Email</label>
        <input type="email" id="reg-email" required placeholder="you@example.com">
      </div>
      <div class="form-group">
        <label for="reg-dept">Department</label>
        <select id="reg-dept" required>
          <option value="">Select department</option>
          <option>BCA</option>
          <option>BBA (IT)</option>
          <option>MSc (CA)</option>
          <option>MBA (IT)</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;">Confirm Registration</button>
    </form>
  </div>
</div>

<div id="register-toast" class="toast"></div>

<?php include '../includes/footer.php'; ?>