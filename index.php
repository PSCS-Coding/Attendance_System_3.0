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
    	<link rel="stylesheet" type="text/css" href="BREAKstyle.css">
  	</head>
	<body>
	<div class="container">
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Location</th>
      <th scope="col">Return Time</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><input type="checkbox" class="checkbox"></th>
      <td>Anthony Reyes</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row"><input type="checkbox" class="checkbox"></th>
      <td></td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row"><input type="checkbox" class="checkbox"></th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
</div>
	</body>
</html>
