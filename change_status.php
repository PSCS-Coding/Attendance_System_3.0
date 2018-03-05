<?php
require_once("connection.php");
require_once("functions.php");

  $student = $_POST['student'];
  $status = $_POST['status'];

// $query_insert = 'INSERT INTO history (student_id, status_id) VALUES ('.$student.', '.$status.')';
if (status_update($student,$status,'','','')) {
    echo "Successfully inserted";
  }
  else {
    echo "Failed to insert";
  }
 ?>
