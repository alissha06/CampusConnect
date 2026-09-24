<nav class="navbar">
  <div class="container navbar-container">
    <a href="<?php echo $root; ?>index.php" class="logo">
      <img src="<?php echo $root; ?>assets/images/sicsr-logo.png" alt="SICSR Logo">
      CampusConnect
    </a>
    <ul class="nav-links">
      <li><a href="<?php echo $root; ?>index.php">Home</a></li>
      <li><a href="<?php echo $root; ?>about/index.php">About</a></li>
      <li><a href="<?php echo $root; ?>admissions/index.php">Admissions</a></li>
      <li><a href="<?php echo $root; ?>notices/index.php">Notices</a></li>
      <li><a href="<?php echo $root; ?>lostfound/index.php">Lost &amp; Found</a></li>

      <li class="dropdown">
        <button class="dropdown-toggle">More <span class="arrow">▾</span></button>
        <ul class="dropdown-menu">
          <li><a href="<?php echo $root; ?>events/index.php">Events</a></li>
          <li><a href="<?php echo $root; ?>resources/index.php">Resources</a></li>
          <li><a href="<?php echo $root; ?>feedback/index.php">Feedback</a></li>
        </ul>
      </li>

      <li><a href="<?php echo $root; ?>auth/login.php" class="btn btn-primary">Login</a></li>
    </ul>
  </div>
</nav>