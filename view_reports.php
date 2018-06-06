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

view_reports_for_student(17);


function actual_lates($student_id) {
    global $db;

    //get list of all events where the student_id is the one in question (pulled by the function input)
    $q = 'SELECT * FROM history WHERE student_id = "'. $student_id.'" ORDER BY timestamp DESC';
    $result = $db->query($q);

    $all_events = $result->fetch_all();
    $number_events = count($all_events);
    if ($number_events < 1){
        return 'what a fail';
    }
    //print_r($all_events);
    echo "count " . $number_events . '<br/><br/>';

    //print out the timestamps of each event
    $lates = 0;
    $array_of_lates = array();
    #sloppily count up all the late events and put into their own array that can reference the 'all events' array. The reason I call this sloppy is that it'd likely be more efficient if merged with some of the processes that come afterwards. But what the heck, it's a step forward.
    for ($i=0; $i < $number_events; $i++) {
      if ($all_events[$i][3] == 5) {
        //$array_of_lates[$lates] = $all_events[$i];
        array_push($array_of_lates, $all_events[$i]);
        //array_unshift($array_of_lates, $all_events[$i], $i);
        $lates++;
      }

      $REALates = 0;
      for ($j=0; $j < $number_events; $j++) {
        if ($all_events[$j][3] == 5) {
          $REALates++;
        }
      }
      echo "Event " . ($i+1) . ' Timestamp: '.$all_events[$i][2].'</br>';
    }

    $unexpectedlates = 0;
    $date1 = new DateTime ($all_events[0][2]);
    $date2 = new DateTime ($all_events[0][2]);

#the bug we had with the following loop for a SUPER long time was because we were forgetting that the date1 was constantly being reassigned right below
    $other_lates = 0;
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

      //echo $date2;
      $date1_9 = new DateTime($date1->format('Y-m-d' . '9:00:00'));
      //$date2 = new DateTime($all_events[$k][2]);
      $date2 = new DateTime($date1->format('Y-m-d' . '9:00:00'));

      if($date1 > $date2 && $date1->format("w") != 0 && $date1->format("w") != 6) {
        $unexpectedlates++;
      }
      // Simon I know you wont like this else-if condition but I had to start somewhere
      #the while loop I wrote will make sure that if someone's first and second events of the day are late (as jack's conditional is supposed to verify) that ALL of their events up until 9:00 are late to make sure that they don't have duplicate lates before 9:00 giving them a false positive.
      elseif($all_events[$k][3] == 5 && $k < count($all_events) && ($all_events[$k+1][2] >= $date2 || $all_events[$k+1][3] = 5)) {
          $eventtime = new DateTime($all_events[$k+1][2]);
          echo ' lates: '.$other_lates;
          $proceed = 1;
          $n = 0;
          do {
            $n++;
            $eventtime = new DateTime($all_events[$k+$n][2]);

            if ($all_events[$k+$n][3] == 5 && $eventtime < $date2){
              $proceed = 0; // the last event before 9 is late
            }
            else {
              $proceed = 1;
            }
          } while ($eventtime < $date2);

          if ($proceed == 1 || $n<=2){
            $other_lates++;
          }

      }
    }
    echo '<br/>' . $unexpectedlates . '<br/>' . ': ' . $other_lates;
}

    /*separate list by date
    check time of the first event of the DAY
    IF time >=9:00 then #Lates +=1 and move to next day
    else {
    if (event type(first event == event[x])=5(late)) {
      proceed to check all later events...
      while(eventtime(event[x+i]<9:00))
      if (eventtime (subsequent events == event[x+i])=) {

      } else {
        # code...
      }

    } else {
      # code...
    }

    }

    $unexpectedlates = 0;
    $date1 = new DateTime ($all_events[0][2]);
    $date2 = new DateTime ($all_events[0][2]);
    $place_time = new DateTime;
    for ($i = 1; $i < $number_events; $i++) {
      $date2 = $all_events[$i][2];
      $date1_9 -> setTime(9:00:00);
      $date2_9 -> setTime(9:00:00);
      if($date1_9 < $date2_9){
        $date1 = $all_events[$i][2];        if($date1 > $date2 && $date1 -> format("w") != 0 && $date1 -> format("w") != 6){

        }
      }
    }
*/
?>
