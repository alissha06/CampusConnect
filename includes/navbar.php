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
<?php else: ?>
  <li><a href="<?php echo $root; ?>auth/login.php" class="nav-login <?php echo ($currentDir === 'auth') ? 'active' : ''; ?>">Login</a></li>
<?php endif; ?>
    </ul>
  </div>
</nav>