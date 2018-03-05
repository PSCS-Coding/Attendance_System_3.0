<?
function status_update($student, $status, $old_status, $info = '', $return_time = '')
{
	global $db;
  // Update current table with new event
	$query = 'UPDATE current SET status_id = '.$status.' WHERE student_id = '.$student;
	$db->query($query);


  // TODO
	// If old status is offsite, not checked in, absent, or late? Or do it for all events?
	// UPDATE immediate prior record in history table for student’s immediate prior event with calculated duration

	// First: SELECT the timestamp AND event_ID from the last event for the $student
	// Second: Compute the elapsed time from that last event until now
	// Third: UPDATE the elapsed time (in decmial hours? minutes?) into the event_ID line of the history table

	// if (!$return_time) {
	// 	$return_time = '';
	// }
	// if (!$return_time) {
	// 	$return_time = '';
	// }
	// Add new event to history table
  $query_insert = 'INSERT INTO history (student_id, status_id) VALUES ('.$student.', '.$status.')';
	$db->query($query_insert);

  return 0;
}
function enquote($text){
	return '"'.$text.'"';
}
?>
