<?php
  require_once("connection.php");
  require_once("functions.php");

  $student = $_POST['student'];
  $status = $_POST['status'];

  // need error handling on the following query
  status_update($student,$status,'','','');

  $query = 'SELECT * FROM current JOIN status_data ON current.status_id = status_data.status_id WHERE student_id = '.$student;
  $current = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
  echo $current[0]['status_name'];
?>
