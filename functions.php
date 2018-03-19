<?php

require_once('connection.php');

function elapsed_time($student_id)
{
		global $db;

		function isWeekend($date) {
			return (date('N', strtotime($date)) >= 6);
		}


		$lastEventTimeQuery = $db->query("SELECT timestamp FROM history WHERE student_id = '$student_id' ORDER BY event_id DESC LIMIT 1");
		$time1 = new DateTime($lastEventTimeQuery->fetch_array()[0]); // last event in the history table
		print_r($time1);
		echo "<br/>";
		if (isWeekend($time1->format('Y-m-d'))) {
			return 0;
		}
		if ($db->query("SELECT COUNT(*) FROM holidays WHERE holiday_date =" . $time1->format('Y-m-d'))) {
			return 0;
		}

		$time2 = new DateTime();

		$start = new DateTime($time1->format('Y-m-d' . '9:00'));
		$end = new DateTime($time1->format('Y-m-d' . '15:40'));
		//is event 1 before the start of the school day of the same day?
		if ($time1 < $start){
				$time1 = $start;
		}
				//is event 2 after the end of the school day of the same day of event 1?
		if ($time2 > $end){
				$time2 = $end;
		}
		$time_elapsed = round(($time2->getTimestamp()-$time1->getTimestamp())/60, 2);
		if ($time_elapsed < 0) {
				$time_elapsed = 0;
		}
		return $time_elapsed;
}

function status_update($student, $status, $old_status, $info, $return_time)
{
		global $db;
	  // Update current table with new event
		$query = 'UPDATE current SET status_id = '.$status.' WHERE student_id = '.$student;
		$db->query($query);

	  // Add new event to history table
	  $query2 = 'INSERT INTO history (student_id, status_id, info, return_time) VALUES ('.$student.', '.$status.', '.$info.', '.$return_time.')';
		$db->query($query2);

	  // TODO
	  // (If old status is offsite, not checked in, absent, or late?) Update record in history table for student’s immediate prior event with calculated duration

	  return 0;
}
function enquote($text){
		return '"'.$text.'"';
}

function total_offsite_used($student){
		global $db;

		$query = "SELECT SUM(hrs_used) FROM history WHERE student_id = 2 AND (status_id = 0 OR status_id = 2 OR status_id = 4 OR status_id = 5 OR status_id = 7) LIMIT 500";
	  $result = $db->query($query);
	  $sum = round($result->fetch_array()[0], 2);
	  //print_r($sum);
			echo $sum;

}
total_offsite_used(2);
?>
