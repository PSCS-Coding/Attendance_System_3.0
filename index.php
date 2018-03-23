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
			<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    	<link rel="stylesheet" type="text/css" href="style.css">

  	</head>
	<body>
		<div class='sticky-top'>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
	<?php require_once('nav.html');?>

</nav>
<div class="container-fluid" style="height:.4rem;background-color: #272626;z-index:-1"></div>
</div>
	<div class="container students-cards">
	<div class="row">

  <div class="col-sm-4">
    <div class="card text-white bg-dark test">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Anthony R</h5>
        <p class="card-text">Field Trip</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Nic &bull; Returning at 11:45 pm</small>
    </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card text-white bg-dark border-danger">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Simon E</h5>
        <p class="card-text">Late</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Expected arrival: 10:15 am</small>
    </div>
    </div>
  </div>

<div class="col-sm-4">
    <div class="card text-white bg-dark">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Graeme S</h5>
        <p class="card-text">Present</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Arrived at 8:46 am</small>
    </div>
    </div>
  </div>

<div class="col-sm-4">
    <div class="card text-white bg-dark">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Olivia A</h5>
        <p class="card-text">Present</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Arrived at 8:31 am</small>
    </div>
    </div>
  </div>

<div class="col-sm-4">
    <div class="card text-white bg-dark">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Angus B</h5>
        <p class="card-text">Field Trip</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Nic &bull; Returning at 11:45 pm</small>
    </div>
    </div>
  </div>

<div class="col-sm-4">
    <div class="card border-danger text-white bg-dark bk">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Bradley M</h5>
        <p class="card-text">Present</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Arrived at 9:02 am</small>
    </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card text-white bg-dark nicstudentc">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Jack N</h5>
        <p class="card-text">Offsite</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Uwajimaya &bull; Returning at 12:15 pm</small>
    </div>
    </div>
  </div>

	<div class="col-sm-4">
		<div class="card text-white bg-dark nicstudentc">
			<input type="checkbox" hidden>
			<div class="card-body">
				<h5 class="card-title">Jack N</h5>
				<p class="card-text">Offsite</p>
			</div>
			<div class="card-footer">
			<small class="text-muted">Uwajimaya &bull; Returning at 12:15 pm</small>
		</div>
		</div>
	</div>
	<div class="col-sm-4">
    <div class="card text-white bg-dark nicstudentc">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Jack N</h5>
        <p class="card-text">Offsite</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Uwajimaya &bull; Returning at 12:15 pm</small>
    </div>
    </div>
  </div>
	<div class="col-sm-4">
    <div class="card text-white bg-dark nicstudentc">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Jack N</h5>
        <p class="card-text">Offsite</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Uwajimaya &bull; Returning at 12:15 pm</small>
    </div>
    </div>
  </div>
	<div class="col-sm-4">
    <div class="card text-white bg-dark nicstudentc">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Jack N</h5>
        <p class="card-text">Offsite</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Uwajimaya &bull; Returning at 12:15 pm</small>
    </div>
    </div>
  </div>
	<div class="col-sm-4">
    <div class="card text-white bg-dark nicstudentc">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Jack N</h5>
        <p class="card-text">Offsite</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Uwajimaya &bull; Returning at 12:15 pm</small>
    </div>
    </div>
  </div>
	<div class="col-sm-4">
    <div class="card text-white bg-dark nicstudentc">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Jack N</h5>
        <p class="card-text">Offsite</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Uwajimaya &bull; Returning at 12:15 pm</small>
    </div>
    </div>
  </div>
	<div class="col-sm-4">
    <div class="card text-white bg-dark nicstudentc">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Jack N</h5>
        <p class="card-text">Offsite</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Uwajimaya &bull; Returning at 12:15 pm</small>
    </div>
    </div>
  </div>
	<div class="col-sm-4">
    <div class="card text-white bg-dark nicstudentc">
			<input type="checkbox" hidden>
      <div class="card-body">
        <h5 class="card-title">Jack N</h5>
        <p class="card-text">Offsite</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">Uwajimaya &bull; Returning at 12:15 pm</small>
    </div>
    </div>
  </div>
</div>
</div>
<script src='/js/nav.js'></script>
<script>
$(document).ready(function(){
    createNav();
		$('.index-actions').html('<li class="nav-item"><a href="#" class="nav-link">Groups</a>');

});


$(".card").click(function (e) {
	if(!e.target.className.includes('btn') && !e.target.className.includes('form')) {
		var checked = 0;
		$(".students-cards :checked").each(function() {
			checked += 1;
		});
		if(checked > 0) {
			$('.index-actions').html('<li class="nav-item"><button class="btn btn-danger testbt">Test</button></li>');
			} else {
			$('.index-actions').html('<li class="nav-item"><button class="btn btn-danger animated fadeIn testbt">Test</button></li>');
		}
		if(!$(this).find("input[type=checkbox]").is(':checked')) {

			$(this).find("input[type=checkbox]").prop('checked', true);
		} else {
			$(this).find("input[type=checkbox]").prop('checked', false);
		}
		if($(this).hasClass('border-danger')) {
			$(this).toggleClass("toggled-red");
		} else {
			$(this).toggleClass("toggled");
		}
		var checked = 0;
		$(".students-cards :checked").each(function() {
			checked += 1;
		});

		if(checked > 0) {
			if($(window).width() < 992) {
				$('.navbar-collapse').collapse('show');
			}
		}
		else {
			$('.index-actions').html('');
			if($(window).width() < 992) {
				$('.navbar-collapse').collapse('hide');
			}
		}
	}
});
</script>
	</body>
</html>
