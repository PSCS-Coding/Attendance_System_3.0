<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("connection.php");
//incomplete status update function
function status_update($student, $status, $old_status, $return_time)
{
	global $db;
	if($student == 'DAILY_RESET'){
		$query = 'UPDATE current SET status_id = '.$status.', return_time = '.$return_time;
		$db->query($query);
	}else{
		if($return_time!= Null){
			$query = 'UPDATE current SET status_id = '.$status.', return_time = '.$return_time.' WHERE student_id = '.$student;
			$db->query($query);
		}else{
			$query = 'UPDATE current SET status_id = '.$status.' WHERE student_id = '.$student;
			$db->query($query);
		}
	}
    return 0;
}
function enquote($text){
	return '"'.$text.'"';
}
?>
<!DOCTYPE html>
<html>
  	<head>
    	<title>
				Attendence System
    	</title>
      <?php require_once('header.php'); ?>
	    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    	<link rel="stylesheet" type="text/css" href="style.css">
  	</head>
	<body>
	<div class="container">
	<div class="row">

  <div class="col-sm-4">
    <div class="card text-white bg-dark">
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
    <div class="card border-danger text-white bg-dark">
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
    <div class="card text-white bg-dark">
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
				<div class="label">
				<div class="front">

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
				<div class="back">
					<!-- back content -->

					<div class="card text-white bg-dark">
			      <div class="card-body">
			        <h5 class="card-title">Nic Warmenhoven</h5>
			        <p class="card-text"></p>
							<button class="btn btn-danger present" id="present" type="button">P</button>
							<button class="btn btn-danger late" type="button">L</button>
							<button class="btn btn-danger absent" type="button">A</button>
			      </div>
						<div class="card-footer">
							<button class='btn'>
			      <i class="fas fa-home"></i>
					</button>
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

$(".label").click(function (e) {
	if(!e.target.className.includes('btn')) {
   	$('.label').toggleClass("toggled");
	}
});

</script>
	</body>
</html>
