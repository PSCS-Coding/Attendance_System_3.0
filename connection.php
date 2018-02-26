<?php
<<<<<<< HEAD
	//$db = new mysqli('localhost', 'root', '', 'elispscsorg');
=======
	//$db = new mysqli('localhost:8889', 'root', 'root', 'elispscsorg');
>>>>>>> d95f6963718f2b64c293d4dde6e15729e70eab58
    $db = new mysqli('pscscoding.com', 'rabu870', '12345', 'pscsorg_3', '3306');
    if($db->connect_errno > 0){
        echo 'fail';
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
?>
