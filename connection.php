<?php
<<<<<<< HEAD
	//$db = new mysqli('localhost', 'root', 'root', 'attendance_new');
    $db = new mysqli('pscscoding.com', 'rabu870', '12345', 'pscsorg_3', '3306');
=======
	//$db = new mysqli('localhost', 'root', '', 'attendance_system');
	//$db = new mysqli('localhost', 'root', '', 'elispscsorg');
	$db = new mysqli('localhost', 'root', 'root', 'elispscsorg');
    //$db = new mysqli('pscscoding.com', 'rabu870', '12345', 'pscsorg_3', '3306');
>>>>>>> angus_branch
    if($db->connect_errno > 0){
        echo 'fail';
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
?>
