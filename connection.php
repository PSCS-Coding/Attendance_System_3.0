<?php
<<<<<<< HEAD
	$db = new mysqli('localhost', 'root', '', 'elispscsorg');
	//$db = new mysqli('localhost', 'root', '', 'attendance_system');
=======
	//$db = new mysqli('localhost', 'root', '', 'elispscsorg');
	$db = new mysqli('localhost', 'root', 'root', 'elispscsorg');
>>>>>>> 8a14e02f0c592a84a89ff155cbf635f06f7e2288
    //$db = new mysqli('pscscoding.com', 'rabu870', '12345', 'pscsorg_3', '3306');
    if($db->connect_errno > 0){
        echo 'fail';
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
?>
