<!DOCTYPE html>
<html>
	<head>
    <title>Hello</title>
  </head>
  <body>
    <?php
		require_once('connection.php');
		//TODO make this into function form
		// TODO weekend or holiday if condition
    function elapsed_time($student_id)
    {
				global $db;

				$lastEventTimeQuery = $db->query("SELECT timestamp FROM history WHERE student_id = '$student_id' LIMIT 1");
				$time1 = new DateTime($lastEventTimeQuery->fetch_array()[0]); // last event in the history table
				print_r($time1);
				$time2 = new DateTime();

				$start = new DateTime($time1->format('Y-m-d' . '9:00'));
				$end = new DateTime($time2->format('Y-m-d' . '15:30'));
				//is event 1 before the start of the school day of the same day?
				if ($time1 < $start){
		        $time1 = $start;
		    }
		        //is event 2 after the end of the school day of the same day of event 1?
		    if ($time2 > $end){
		        $time2 = $end;
		    }
				$time_elapsed = ($time2->getTimestamp()-$time1->getTimestamp())/60;
				return $time_elapsed;
    }
		echo elapsed_time(1);

    //echo $time1->format('Y-m-d H:i:s') . "<br/>";
    //$time_elapsed = ($time2->getTimestamp()-$time1->getTimestamp())/60;   //echo round($time_elapsed, 3) . " Decimal Minutes<br/>";
		//$time_seconds = round(($time_elapsed-floor($time_elapsed))*0.6, 2)*100;
		//$time_minutes = floor($time_elapsed);

		//echo $time_minutes . ":" . $time_seconds . " Minutes Seconds Time";
      ?>

    </body>
</html>
