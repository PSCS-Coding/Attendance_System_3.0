<?php
require_once('connection.php');
require_once('functions.php');


function view_reports_for_student($student_id){
    global $db
    $OffsiteTimeUsed = total_offsite_used($student_id);

    $query = "SELECT "
    $OffsiteLeft = $OffsiteTimeUsed;
}
  ?>
