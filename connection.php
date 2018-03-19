<?php
	//$db = new mysqli('localhost', 'root', '', 'elispscsorg');
<<<<<<< HEAD

	$db = new mysqli('localhost', 'root', '', 'attendance_system');
=======
	$db = new mysqli('localhost', 'root', '', 'elispscsorg');
>>>>>>> 7b96b497300b76fb0b2744cf2b111c91057b5c3c
    //$db = new mysqli('pscscoding.com', 'rabu870', '12345', 'pscsorg_3', '3306');
    if($db->connect_errno > 0){
        echo 'fail';
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
?>
