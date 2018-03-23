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
		<input type="checkbox" id="nicstudent" hidden>
    <div class="card text-white bg-dark nicstudentc">
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
		<input type="checkbox" id="nicstudent" hidden>
		<div class="card text-white bg-dark nicstudentc">
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
		<input type="checkbox" id="nicstudent" hidden>
    <div class="card text-white bg-dark nicstudentc">
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
		<input type="checkbox" id="nicstudent" hidden>
    <div class="card text-white bg-dark nicstudentc">
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
		<input type="checkbox" id="nicstudent" hidden>
    <div class="card text-white bg-dark nicstudentc">
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
		<input type="checkbox" id="nicstudent" hidden>
    <div class="card text-white bg-dark nicstudentc">
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
		<input type="checkbox" id="nicstudent" hidden>
    <div class="card text-white bg-dark nicstudentc">
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
		<input type="checkbox" id="nicstudent" hidden>
    <div class="card text-white bg-dark nicstudentc">
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
			<input type="checkbox" id="nistudent" hidden>
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

});


$(".card").click(function (e) {
	if(!e.target.className.includes('btn') && !e.target.className.includes('form')) {
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
	}
});
</script>
	</body>
</html>
