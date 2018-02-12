<?php
<<<<<<< HEAD
	$db = new mysqli('localhost:8889', 'root', 'root', 'elispscsorg');
    //$db = new mysqli('pscscoding.com', 'rabu870', '12345', 'pscsorg_3', '3306');
=======
    $db = new mysqli('pscscoding.com', 'rabu870', '12345', 'pscsorg_3', '3306');
>>>>>>> cb06d6563610f6c527c4f066485d3e938fdef1ff
    if($db->connect_errno > 0){
        echo 'fail';
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
?>
