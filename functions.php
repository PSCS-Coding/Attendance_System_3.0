<?php

require_once('connection.php');

function mins_used($student_id) {
		global $db;

		$lastEventTimeQuery = $db->query("SELECT timestamp FROM history WHERE student_id = '$student_id' ORDER BY event_id DESC LIMIT 1");
		$time1 = new DateTime($lastEventTimeQuery->fetch_array()[0]); // last event in the history table
		if (isWeekend($time1->format('Y-m-d'))) {
			return 0;
		}
		$holQuery = $db->query("SELECT COUNT(*) FROM holidays WHERE holiday_date =" . $time1->format('Y-m-d'));
		if ($holQuery->fetch_array()[0] != 0) {
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



function status_update($student, $status, $info = '', $return_time = '') {

	global $db;
  // Update current table with new event
	$query = 'UPDATE current SET status_id = '.$status.', info = "'.$info.'", return_time = "'.$return_time.'" WHERE student_id = '.$student;
	// $query = 'UPDATE current SET status_id = '.$status.', return_time = "'.$return_time.'" WHERE student_id = '.$student;
	$db->query($query);

	// Update immediate prior record in history table with calculated duration
	$minutes_used = mins_used($student);
  $query = "UPDATE history SET elapsed = '$minutes_used' WHERE student_id = '$student' ORDER BY event_id DESC LIMIT 1";
  $db->query($query);

	// Add new event to history table
  $query_insert = 'INSERT INTO history (student_id, status_id, info, return_time) VALUES ('.$student.', '.$status.', "'.$info.'", "'.$return_time.'")';
	$db->query($query_insert);

	  return 0;
}

function total_offsite_used($student){
		global $db;

		$query = "SELECT SUM(elapsed) FROM history WHERE student_id = ".$student." AND (status_id = 0 OR status_id = 2 OR status_id = 4 OR status_id = 5 OR status_id = 7) LIMIT 500";
	  $result = $db->query($query);
	  $sum = round($result->fetch_array()[0], 2);

		return $sum;
}

function calculateDaysRemaining($from_date = "tomorrow") { // returns integer number of days left in school year, not counting today
	global $db;

	$holidays = array();
	$query = 'SELECT holiday_date FROM holidays';
	$holidays_query = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
	foreach ($holidays_query[0] as $holiday) {
		array_push($holidays, $holiday);
	}

	$query = 'SELECT start_date, end_date FROM globals';
	$globals_query = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
	$start_date = new DateTime($globals_query[0]['start_date']);
	$end_date = new DateTime($globals_query[0]['end_date']);
	$next_date = new DateTime($from_date);
	$all_dates = array();

	while ($next_date < $end_date) {
		if ($next_date->format("w") != 0 && $next_date->format("w") != 6) {
				array_push($all_dates, $next_date->format("Y-m-d"));
		}
		date_add($next_date, date_interval_create_from_date_string('1 day'));
	}
	return count(array_diff($all_dates, $holidays));
}

function enquote($text) {
	return '"'.$text.'"';
}

function isWeekend($date) {
	return (date('N', strtotime($date)) >= 6);
}

function start_the_day() {
	// Sets all active students to not checked in
	global $db;
	$query = 'SELECT timestamp FROM history ORDER BY event_ID DESC LIMIT 1';
	$latest = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
	$latest = new DateTime($latest[0]['timestamp']);
	$midnight = new DateTime('yesterday 23:59:59');
	if ($latest < $midnight) {
	  $query = 'SELECT student_id FROM student_data WHERE active = 1';
	  $all_current_students = $db->query($query)->fetch_all();
	  foreach ($all_current_students as $key => $value) {
	    status_update($value[0],0,'');
	  }
	}
}

function pretty_time($SQLdatetime) {
	$time = new DateTime($SQLdatetime);
	return $time->format('g:i');
}
?>
