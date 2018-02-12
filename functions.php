<?
function status_update($student, $status, $old_status)
{
	global $db;
	$query = 'UPDATE current SET status_id = '.$status.' WHERE student_id = '.$student;
	$db->query($query);
    return 0;
}
function enquote($text){
	return '"'.$text.'"';
}
?>
