<?php
require_once('connection.php');
require_once('functions.php');


function view_reports_for_student($student_id){
    global $db;
    $OffsiteTimeUsed = total_offsite_used($student_id);
    echo "Offsite Used: ", $OffsiteTimeUsed;

    $query = "SELECT default_offsite FROM allotted_hours";
    $result = $db->query($query);
    $total_offsite = $result->fetch_array()[0] * 60;
    echo "total offsite: ", $total_offsite;
    $OffsiteLeft = $total_offsite - $OffsiteTimeUsed;
    echo "<br/>Offsite Left: ", $OffsiteLeft;
    $PercentOffsiteUsed = '%'. round(($OffsiteTimeUsed/$total_offsite)*100, 2);
    echo "<br/>Percent Offsite Used: ", $PercentOffsiteUsed;

    #$NumLateEvents 
}

view_reports_for_student(2);
?>
