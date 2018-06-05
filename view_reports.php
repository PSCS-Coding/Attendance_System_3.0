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

view_reports_for_student(11);


function actual_lates($student_id) {
    global $db;

    //get list of all events where the student_id is the one in question (pulled by the function input)
    $q = 'SELECT * FROM history WHERE student_id = "'. $student_id.'" ORDER BY timestamp DESC';
    $result = $db->query($q);
    $stati = $db->query('SELECT * FROM status_data ORDER BY status_id ASC')->fetch_all();
    $all_events = $result->fetch_all();
    $number_events = count($all_events);
    if ($number_events < 1){
        return 'what a fail';
    }
    //print_r($all_events);
    echo "count " . $number_events . '<br/><br/>';

    //print out the timestamps of each event
    $array_of_lates = array();
    #sloppily count up all the late events and put into their own array that can reference the 'all events' array. The reason I call this sloppy is that it'd likely be more efficient if merged with some of the processes that come afterwards. But what the heck, it's a step forward.
    for ($i=0; $i < $number_events; $i++) {
      if ($all_events[$i][3] == 5) {
        array_push($array_of_lates, $all_events[$i]);
      }
      echo "Event " . ($i+1) . ' Timestamp: '.$all_events[$i][2].'</br>';
    }

    $expected_lates = 0;
    $late_arrivals = 0;
    //print_r($date1);
    for ($k = 0; $k < $number_events; $k++) {

      $date1 = new DateTime($all_events[$k][2]);
      //print_r($test1);
      if ($k != 0) {
        $test = new DateTime($all_events[$k-1][2]);
        // limiting the for loop to only run only one iteration per day
        if ($date1->format('Y-m-d') == $test->format('Y-m-d')) {
          continue;
        }
      }
      if($stati[$all_events[$k][3]][2] == 0){
          for( $x = $k ; $x < $number_events - ($k + 1) ; $x++){
              $eventdate = new DateTime($all_events[$x][2]);
              if($eventdate->format('Y-m-d') != $date1->format('Y-m-d')){
                  break;
              }
              if($stati[$all_events[$k][3]][2] == 1){
                  $date1 = new DateTime($all_events[$x][2]);
                  break;
              }
          }
      }
      //$date2 = new DateTime($all_events[$k][2]);
      $date2 = new DateTime($date1->format('Y-m-d' . '9:00:00'));
      if($date1 > $date2 && $date1->format("w") != 0 && $date1->format("w") != 6) {
          $late_arrivals++;
          foreach($array_of_lates as $late){
              $latedate = new DateTime($late[2]);
              if($latedate->format('y-m-d') == $date1->format('y-m-d')){
                  $expected_lates++;
                  break;
              }
          }
      }
      // Simon I know you wont like this else-if condition but I had to start somewhere
      #the while loop I wrote will make sure that if someone's first and second events of the day are late (as jack's conditional is supposed to verify) that ALL of their events up until 9:00 are late to make sure that they don't have duplicate lates before 9:00 giving them a false positive.
    }
    echo '<br/> unexpected: ' . ($late_arrivals - $expected_lates) . '<br/>' . 'expected: ' . $expected_lates;
}

?>
