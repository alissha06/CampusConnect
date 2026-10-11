<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Detect the current page so we can highlight the matching nav link
$current = basename($_SERVER['PHP_SELF']);
$currentDir = basename(dirname($_SERVER['PHP_SELF']));

function navActive($dir, $file, $currentDir, $current) {
  if ($file === 'index.php' && $dir === 'root') {
    return ($currentDir === 'CampusConnect' && $current === 'index.php') ? 'active' : '';
  }
  return ($currentDir === $dir) ? 'active' : '';
}
?>
<nav class="navbar">
  <div class="container navbar-container">
    <a href="<?php echo $root; ?>index.php" class="logo">
      <img src="<?php echo $root; ?>assets/images/sicsr-logo.png" alt="SICSR Logo">
      CampusConnect
    </a>
    <ul class="nav-links">
      <li><a href="<?php echo $root; ?>index.php" class="<?php echo ($currentDir === 'CampusConnect' && $current === 'index.php') ? 'active' : ''; ?>">Home</a></li>
      <li><a href="<?php echo $root; ?>about/index.php" class="<?php echo ($currentDir === 'about') ? 'active' : ''; ?>">About</a></li>
      <li><a href="<?php echo $root; ?>admissions/index.php" class="<?php echo ($currentDir === 'admissions') ? 'active' : ''; ?>">Admissions</a></li>
      <li><a href="<?php echo $root; ?>notices/index.php" class="<?php echo ($currentDir === 'notices') ? 'active' : ''; ?>">Notices</a></li>
      <li><a href="<?php echo $root; ?>lostfound/index.php" class="<?php echo ($currentDir === 'lostfound') ? 'active' : ''; ?>">Lost &amp; Found</a></li>

      <li class="dropdown">
        <button class="dropdown-toggle <?php echo ($currentDir === 'events' || $currentDir === 'feedback') ? 'active' : ''; ?>">More <span class="arrow">▾</span></button>
        <ul class="dropdown-menu">
          <li><a href="<?php echo $root; ?>events/index.php">Events</a></li>
          <li><a href="<?php echo $root; ?>calendar/index.php">Academic Calendar</a></li>
          <li><a href="<?php echo $root; ?>feedback/index.php">Feedback</a></li>
        </ul>
      </li>
   
      <?php if (isset($_SESSION['user_id'])): ?>
  <li class="dropdown">
    <button class="dropdown-toggle <?php echo ($currentDir === 'dashboard') ? 'active' : ''; ?>">
      <?php echo htmlspecialchars($_SESSION['name']); ?> <span class="arrow">▾</span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="<?php echo $root; ?>dashboard/<?php echo $_SESSION['role']; ?>.php">Dashboard</a></li>
      <li><a href="<?php echo $root; ?>auth/logout.php">Logout</a></li>
    </ul>
  </li>
  <li class="nav-theme">
  <button type="button" id="theme-toggle" class="theme-toggle" aria-label="Switch to dark theme" title="Switch to dark theme">
    <svg class="icon-moon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
    </svg>
    <svg class="icon-sun" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <circle cx="12" cy="12" r="5"/>
      <line x1="12" y1="1" x2="12" y2="3"/>
      <line x1="12" y1="21" x2="12" y2="23"/>
      <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
      <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
      <line x1="1" y1="12" x2="3" y2="12"/>
      <line x1="21" y1="12" x2="23" y2="12"/>
      <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
      <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
    </svg>
  </button>
</li>
<?php else: ?>
  <li><a href="<?php echo $root; ?>auth/login.php" class="nav-login <?php echo ($currentDir === 'auth') ? 'active' : ''; ?>">Login</a></li>
<?php endif; ?>
    </ul>
  </div>
</nav>

<script>
(function () {
  var btn = document.getElementById('theme-toggle');
  if (!btn) return;
  var root = document.documentElement;

  function paint() {
    var label = root.getAttribute('data-theme') === 'dark' ? 'Switch to light theme' : 'Switch to dark theme';
    btn.setAttribute('aria-label', label);
    btn.setAttribute('title', label);
  }
  paint();

  btn.addEventListener('click', function () {
    var goingLight = root.getAttribute('data-theme') === 'dark';
    if (goingLight) root.removeAttribute('data-theme');
    else root.setAttribute('data-theme', 'dark');
    try { localStorage.setItem('cc-theme', goingLight ? 'light' : 'dark'); } catch (e) {}
    paint();
  });
})();
</script>