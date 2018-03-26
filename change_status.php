<?php
  	require_once("connection.php");
  	require_once("functions.php");

  	$student = $_POST['student'];
  	$status = $_POST['status'];
  	if ($_POST['time'] != 0) {
      $time = new DateTime('today' . $_POST['time']);
      $time = $time->format("Y-m-d H:i:s");
    }
    else {
      $time = '';
    }
    $info = ""; // TODO implement info handling for field trip, offsite

  // TODO error handling on the following query
  status_update($student,$status,$info,$time);

  $query = 'SELECT * FROM current JOIN status_data ON current.status_id = status_data.status_id WHERE student_id = '.$student;
  $current = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
  $output = $current[0]['status_name'];
  if ($current[0]['status_name'] == "Late") {
    $return = new DateTime($current[0]['return_time']);
    $output .= " arriving at " . $return->format('g:i');
  }
  echo $output;
?>
