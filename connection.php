<?php
	//$db = new mysqli('localhost', 'root', 'root', 'attendance_new');
    $db = new mysqli('pscscoding.com', 'rabu870', '12345', 'pscsorg_3');
    if($db->connect_errno > 0){
        echo 'fail';
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
?>
