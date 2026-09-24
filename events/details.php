<?php
include '../includes/header.php';
include '../includes/navbar.php';

$events = [
  'codesphere' => [
    'title' => 'Annual Tech Fest "CodeSphere"',
    'category' => 'Technical / Hackathon',
    'description' => 'CodeSphere is the flagship technical fest featuring a coding hackathon, UI/UX design sprint, algorithmic problem-solving challenges, and collegiate project exhibitions. Open to students across all years, this event brings together coding enthusiasts for a day of building, learning, and competing.',
    'date' => 'To be announced',
    'time' => 'Full day event',
    'venue' => 'Atur Centre Auditorium &amp; Labs',
    'seats' => 'Seats available',
  ],
  'cloud-lecture' => [
    'title' => 'Guest Lecture: Careers in Cloud Computing',
    'category' => 'Industry Speaker',
    'description' => 'An interactive guest lecture with industry professionals discussing cloud infrastructure, DevOps pipelines, and career pathways into cloud computing roles. A great opportunity for students to understand industry expectations and career planning.',
    'date' => 'To be announced',
    'time' => 'Afternoon session',
    'venue' => 'Seminar Hall, SICSR Campus',
    'seats' => 'Seats available',
  ],
  'sports-meet' => [
    'title' => 'Inter-College Sports Meet',
    'category' => 'Athletics &amp; Sports',
    'description' => 'The annual collegiate athletic championship featuring track events, badminton, basketball, and table tennis tournaments. Students can register individually or as part of a team representing their department.',
    'date' => 'To be announced',
    'time' => 'Multi-day event',
    'venue' => 'University Sports Complex',
    'seats' => 'Team slots open',
  ],
  'data-science-workshop' => [
    'title' => 'Workshop: Intro to Data Science',
    'category' => 'Hands-on Workshop',
    'description' => 'A practical, hands-on workshop covering foundational data science concepts, exploratory data analysis, and an introduction to basic modeling techniques. Recommended for students interested in data-driven career paths.',
    'date' => 'To be announced',
    'time' => 'Morning session',
    'venue' => 'Computer Lab, Atur Centre',
    'seats' => 'Seats available',
  ],
];

$eventKey = isset($_GET['event']) && isset($events[$_GET['event']]) ? $_GET['event'] : 'codesphere';
$event = $events[$eventKey];
?>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <div class="container">
    <a href="../index.php">Portal Home</a> / <a href="index.php">Events</a> / <span><?php echo $event['title']; ?></span>
  </div>
</div>

<!-- PAGE HEADER -->
<section class="page-header">
  <div class="container">
    <p class="hero-eyebrow"><?php echo $event['category']; ?></p>
    <h1><?php echo $event['title']; ?></h1>
  </div>
</section>

<!-- DETAILS -->
<section class="about-block">
  <div class="container">
    <div class="event-detail-grid">
      <div>
        <h2>About This Event</h2>
        <p><?php echo $event['description']; ?></p>
      </div>
      <div class="event-info-card">
        <div class="event-info-row">📅 <span><?php echo $event['date']; ?></span></div>
        <div class="event-info-row">🕒 <span><?php echo $event['time']; ?></span></div>
        <div class="event-info-row">📍 <span><?php echo $event['venue']; ?></span></div>
        <div class="event-info-row">🎟 <span><?php echo $event['seats']; ?></span></div>
        <button class="btn btn-primary" style="width:100%; margin-top:16px;" onclick="registerEvent('<?php echo addslashes($event['title']); ?>')">Register Now</button>
      </div>
    </div>
  </div>
</section>

<section class="about-block alt">
  <div class="container">
    <a href="index.php" class="back-link">&larr; Back to All Events</a>
  </div>
</section>

<div id="register-toast" class="toast"></div>

<?php include '../includes/footer.php'; ?>