<?php
require_once("../connection.php");

  $student = $_POST['student'];
  $status = $_POST['status'];

$query_insert = 'INSERT INTO history (student_id, status_id) VALUES ('.$student.', '.$status.')';
if ($db->query($query_insert)) {
    echo "Successfully inserted";
  }
  else {
    echo "Failed to insert";
  }
 ?>
