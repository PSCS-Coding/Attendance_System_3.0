<?php
	$db = new mysqli('localhost:8889', 'root', 'root', 'elispscsorg');
	//$db = new mysqli('sql3.freemysqlhosting.net:3306', 'sql3218514', 'fxBw214YQ4', 'sql3218514');
	if($db->connect_errno > 0){
		echo 'fail';
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
?>
