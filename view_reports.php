<?php
require_once('connection.php');
require_once('functions.php');


function view_reports_for_student($student_id){
    global $db;
    $OffsiteTimeUsed = total_offsite_used($student_id);
    echo "Offsite Used: ", floor(($OffsiteTimeUsed)/60), " Hours and ", $OffsiteTimeUsed%60, " Minutes<br/>";

    $query = "SELECT default_offsite FROM allotted_hours";
    $result = $db->query($query);
    $total_offsite = $result->fetch_array()[0] * 60;
    echo "<br/>Total Offsite: ", floor(($total_offsite)/60), " Hours and ", $total_offsite%60, " Minutes<br/>";
    $OffsiteLeft = $total_offsite - $OffsiteTimeUsed;
    echo "<br/>Offsite Left: ", floor(($OffsiteLeft)/60), " Hours and ", $OffsiteLeft%60, " Minutes<br/>";
    $PercentOffsiteUsed = round(($OffsiteTimeUsed/$total_offsite)*100, 2) . '%';
    echo "<br/>Percent Offsite Used: ",$PercentOffsiteUsed;

    #$NumLateEvents
}

view_reports_for_student(2);
