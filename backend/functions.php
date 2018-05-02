<?php

require_once '../connection.php';

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

function status_update($student, $status, $info, $return_time) {

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

function elapsed_recalc($event_id) { // recalculates and updates elapsed value for an event
  global $db;
	// Load in this event (n) and the one before it (n-1) and the one after (n+1)
	$changed_event_query = 'SELECT * from history WHERE event_id = '.$event_id;
	$changed_event = $db->query($changed_event_query)->fetch_all($resulttype = MYSQLI_ASSOC);
  $student_id = $changed_event[0]['student_id'];
  $changed_event_id = $changed_event[0]['event_id'];
  $older_event_query = 'SELECT * from history WHERE student_id = '.$student_id.' AND event_id < '.$changed_event_id.' ORDER BY event_id DESC LIMIT 1';
  $older_event = $db->query($older_event_query)->fetch_all($resulttype = MYSQLI_ASSOC);
  $older_event_id = $older_event[0]['event_id'];
  $newer_event_query = 'SELECT * from history WHERE student_id = '.$student_id.' AND event_id > '.$changed_event_id.' ORDER BY event_id ASC LIMIT 1';
  $newer_event = $db->query($newer_event_query)->fetch_all($resulttype = MYSQLI_ASSOC);
  // Calculate diff between n and n+1, update n.elapsed
  $changed_event_datetime = new DateTime($changed_event[0]['timestamp']);
  $newer_event_datetime = new DateTime($newer_event[0]['timestamp']);
  $time_elapsed = round(($newer_event_datetime->getTimestamp()-$changed_event_datetime->getTimestamp())/60, 2);
  $query = "UPDATE history SET elapsed = '$time_elapsed' WHERE event_id = '$changed_event_id'";
  $db->query($query);
	// Calculate diff between n and n-1, update n-1.elapsed
  $older_event_datetime = new DateTime($older_event[0]['timestamp']);
  $time_elapsed = round(($changed_event_datetime->getTimestamp()-$older_event_datetime->getTimestamp())/60, 2);
  $query = "UPDATE history SET elapsed = '$time_elapsed' WHERE event_id = '$older_event_id'";
  $db->query($query);
}
?>