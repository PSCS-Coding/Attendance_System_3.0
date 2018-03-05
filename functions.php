<?php

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
?>
