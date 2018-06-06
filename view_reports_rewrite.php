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
    echo "<br/>Percent Offsite Used: ",$PercentOffsiteUsed . '<br/><br/>';
    actual_lates($student_id);
}

view_reports_for_student(12);


function actual_lates($student_id) {
    global $db;

    //get list of all events where the student_id is the one in question (pulled by the function input)
    $q = 'SELECT * FROM history WHERE student_id = "'. $student_id.'" ORDER BY timestamp ASC';
    $result = $db->query($q);
    $stati = $db->query('SELECT * FROM status_data ORDER BY status_id ASC')->fetch_all();
    $all_events = $result->fetch_all();
    $number_events = count($all_events);
    if ($number_events < 1){
        return 'what a fail';
    }
    //print out the timestamps of each event
    $array_of_lates = array();
    #sloppily count up all the late events and put into their own array that can reference the 'all events' array. The reason I call this sloppy is that it'd likely be more efficient if merged with some of the processes that come afterwards. But what the heck, it's a step forward.
    for ($i=0; $i < $number_events; $i++) {
        if ($all_events[$i][3] == 5) {
            array_push($array_of_lates, $all_events[$i]);
        }
        echo "Event " . ($i+1) . ' Timestamp: '.$all_events[$i][2].' Status: '.$stati[$all_events[$i][3]][1].'</br>';
    }
    $expected_lates = 0;
    $late_arrivals = 0;
    $lastdate = null;
    //print_r($date);
    for ($k = 0; $k < $number_events; $k++) {
        $date = new DateTime($all_events[$k][2]);
        if($stati[$all_events[$k][3]][2] != 0 && $date->format('y-m-d') != $lastdate && $date->format("w")%6 != 0){
            $lastdate = $date->format('y-m-d');
            if( $date->format('H:i:s') > '09:00:00' ){
                $late_arrivals++;
                foreach($array_of_lates as $late){
                    $latedate = new DateTime($late[2]);
                    if($latedate->format('y-m-d') == $date->format('y-m-d') && $latedate->format('H:i:s') < $date->format('H:i:s')){
                        $expected_lates++;
                        break;
                    }
                }
            }
            
        }
    }
    echo '<br/> Unexpected: ' . ($late_arrivals - $expected_lates) . '<br/>' . 'Expected: ' . $expected_lates;
}

?>
