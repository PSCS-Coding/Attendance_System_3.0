<?php
require_once('verify.php');
require_once('connection.php');
require_once('header.php');
?>

<!DOCTYPE html>
<html>
  	<head>
    	<title>
				Attendence System
    	</title>
	    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    	<link rel="stylesheet" type="text/css" href="style.css">
			<script type="text/javascript" src="nav.js"></script>
  	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
	  </div>
	  </nav>
	<div class="container">
	<div class="row">

  <div class="col-sm-4">
    <div class="card text-white test">
      <div class="card-body">
        <h5 class="card-title">Anthony Reyes</h5>
        <p class="card-text">Field Trip</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Nic &bull; Returning at 11:45 pm</small>
    </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card text-white bg-dark border-danger">
      <div class="card-body">
        <h5 class="card-title">Simon Egan</h5>
        <p class="card-text">Late</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Expected arrival: 10:15 am</small>
    </div>
    </div>
  </div>

<div class="col-sm-4">
    <div class="card text-white bg-dark">
      <div class="card-body">
        <h5 class="card-title">Graeme Stoney</h5>
        <p class="card-text">Present</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Arrived at 8:46 am</small>
    </div>
    </div>
  </div>

<div class="col-sm-4">
    <div class="card text-white bg-dark">
      <div class="card-body">
        <h5 class="card-title">Olivia Aaron</h5>
        <p class="card-text">Present</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Arrived at 8:31 am</small>
    </div>
    </div>
  </div>

<div class="col-sm-4">
    <div class="card text-white bg-dark">
      <div class="card-body">
        <h5 class="card-title">Angus Breon</h5>
        <p class="card-text">Field Trip</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Nic &bull; Returning at 11:45 pm</small>
    </div>
    </div>
  </div>

<div class="col-sm-4">
    <div class="card border-danger text-white bg-dark bk">
      <div class="card-body">
        <h5 class="card-title">Bradley McDougald</h5>
        <p class="card-text">Present</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Arrived at 9:02 am</small>
    </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card text-white bg-dark test bk">
      <div class="card-body">
        <h5 class="card-title">Jack Natarangelio</h5>
        <p class="card-text">Offsite</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Uwajimaya &bull; Returning at 12:15 pm</small>
    </div>
    </div>
  </div>

  <div class="col-sm-4">
		<input type="checkbox" id="nicstudent" hidden>
		<label for="nicstudent">
		<div class="flip-container">
			<div class="flipper">
				<div class="front">
					<div class="label">
					<!-- front content -->
					<div class="card text-white bg-dark">
			      <div class="card-body">
			        <h5 class="card-title">Nic Warmenhoven</h5>
			        <p class="card-text">Present</p>
			      </div>
			      <div class="card-footer">
			      <small class="text-muted">Arrived at 8:46 am</small>
			    </div>
			    </div>
</div>
				</div>
				<div class="back">
					<!-- back content -->
						<div class="label">
					<div class="card text-white bg-dark bk">
			      <div class="card-body">
			        <h5 class="card-title">Nic Warmenhoven</h5>
			        <p class="card-text"></p>
							<button class='btn'>
			      <i class="fas fa-home"></i>
					</button>
					<button class="btn btn-danger present" id="present" type="button">P</button>
					<button class="btn btn-danger absent" type="button">A</button>
							<div class="input-group mb-3 late">
  							<input type="text" class="form-control" placeholder="Arrival time" aria-label="Arrival time" aria-describedby="Arrival time">
  								<div class="input-group-append">
    								<button class="btn btn-danger" type="button">L</button>
  								</div>
							</div>
			      </div>
			    </div>
					</div>
				</div>
			</div>
		</label>
	</div>
		</div>
  </div>
</div>
</div>


<script>
$( window ).resize(function() {
	$('.card.bg-dark').width($('.test').width());
	$('.card.bg-dark').height($('.test').height());
	$('.flip-container').width($('.test').width());
	$('.flip-container').height($('.test').height());
	$('.back').width($('.test').width());
	$('.back').height($('.test').height());

});
$(".label").click(function (e) {
	if(!e.target.className.includes('btn') && !e.target.className.includes('form')) {
   	$('.label').toggleClass("toggled");
	}
});
</script>
	</body>
</html>
