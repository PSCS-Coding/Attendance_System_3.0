<!DOCTYPE html>
<html>
	<head>
    <title>Hello</title>
  </head>
  <body>
    <?php
		//TODO make this into function form
		// TODO weekend or holiday if condition
    function FunctionName($value='')
    {
    	# code...
    }
		$time1 = new DateTime("today 8:00");
    $time2 = new DateTime("today 18:33");
		$start = new DateTime($time1->format('Y-m-d') . "9:00");
		$end = new DateTime($time2->format('Y-m-d') . "15:40");

		if ($time1 <= $start){
            $time1 = $start;
        }
        //is event 2 after the end of the school day of the same day of event 1?
        if ($time2 >= $end){
            $time2 = $end;
        }

    echo $time1->format('Y-m-d H:i:s') . "<br/>";
    $time_elapsed = ($time2->getTimestamp()-$time1->getTimestamp())/60;   echo round($time_elapsed, 3) . " Decimal Minutes<br/>";
		$time_seconds = round(($time_elapsed-floor($time_elapsed))*0.6, 2)*100;
		$time_minutes = floor($time_elapsed);

		echo $time_minutes . ":" . $time_seconds . " Minutes Seconds Time";
      ?>

    </body>
</html>
