<!DOCTYPE html>
<html>
	<head>
    <title>Hello</title>
  </head>
  <body>
    <?php
    $time1 = new DateTime("2018-02-26 12:00");
    $now = new DateTime();
    echo $time1->format('Y-m-d H:i:s') . "<br/>";
    $time_elapsed = ($now->getTimestamp()-$time1->getTimestamp())/60;   echo round($time_elapsed, 3) . " Decimal Minutes<br/>";
		$time_seconds = round(($time_elapsed-floor($time_elapsed))*0.6, 2)*100;
		$time_minutes = floor($time_elapsed);

		echo $time_minutes . ":" . $time_seconds . " Minutes Seconds Time";
      ?>

    </body>
</html>
