<?php
	$db = new mysqli('localhost:8889', 'root', 'root', 'attendance_new');
//$db = new mysqli();
	if($db->connect_errno > 0){
		echo 'fail';
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
?>
