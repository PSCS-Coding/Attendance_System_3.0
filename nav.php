<?php
require_once('connection.php');
require_once('verify.php');
echo '  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/index.php"><img src="/mobius.svg" style="height:2rem">&nbsp&nbspPSCS Attendance System</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent" style="cursor:auto">
  <ul class="navbar-nav ml-auto">
    <div><li class="nav-item text-white">
      <a class="nav-link navuserhome" href=""></a>
    </li></div>
    <li class="nav-item dropdown navuserdropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="navpic" src="" style="border-radius:50%;height:1.5rem;width:1.5rem;">
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <!-- Student name, links determined by js -->
        <a class="dropdown-item disabled" style="cursor:default;color:#6c757d"><img class="navpic" style="height:1.5rem;width:1.5rem;" src="">&nbsp&nbsp<span class="navname"></span>&nbsp<span class="featbadge"></a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item achievments" href="/achievments.php">Achievements</a>
        <a class="dropdown-item settings" href="/settings.php">Settings</a>
      </div>
    </li>
  </ul>
</div></nav>';
?>
