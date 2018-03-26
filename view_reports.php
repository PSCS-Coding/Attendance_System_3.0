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
    get_all_lates($student_id);
}

view_reports_for_student(2);

function get_all_lates($student_id) {
    global $db;

    $query = "SELECT * FROM history WHERE status_id= 5 AND student_id = " . $student_id;
    $result = $db->query($query);
    //for ($i=0; $i < strlen($result->fetch_array()); $i++) {
    //   # code...
    //}
    /*  Milo gave us this little gem. The code below was totally copied shamelessly from him, but it gets the result of the above query
    structured line by line and printed somewhat neatly below.  */
    $statusData = array();
    while ($stat_row = $result->fetch_assoc()) {
      array_push ($statusData, $stat_row);
    }
    echo("<pre>");
    print_r($statusData);
    echo("</pre>");

    // TODO: change the above function such that it only counts ONE LATE PER DAY

    /* TODO:  add in the 'Actually Late' function below (it will only count one per day, and each one will mean that the student was
    (expectedly or no) late that day, arriving after 9:00am*/
    // IDEA: for each late event check if the prior late event was on the same day
    // IDEA: for each late event check if the next event is after the start of school
    $result = $db->query("SELECT * FROM history WHERE status_id= 5 AND student_id =" . $student_id)

    $query2 = "SELECT";
    $NumLateEvents = 0;
    return 0;

}
