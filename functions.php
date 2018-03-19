<?php

require_once('connection.php');

function hrs_used($student_id) {
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
	$query = 'UPDATE current SET status_id = '.$status.', return_time = "'.$return_time.'" WHERE student_id = '.$student;
	$db->query($query);
	$hrs_used = hrs_used($student);
  $query = "UPDATE history SET hrs_used = '$hrs_used' WHERE student_id = '$student' ORDER BY event_id DESC LIMIT 1";
  $db->query($query);

	// Update immediate prior record in history table with calculated duration
	$hrs_used = hrs_used($student);
  $query = "UPDATE history SET hrs_used = '$hrs_used' WHERE student_id = '$student' ORDER BY event_id DESC LIMIT 1";
  $db->query($query);

	// Add new event to history table
  $query_insert = 'INSERT INTO history (student_id, status_id) VALUES ('.$student.', '.$status.')';
	$db->query($query_insert);

  return 0;
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
