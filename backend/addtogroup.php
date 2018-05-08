<?php
  	require_once("connection.php");
	$values = $db->query('SELECT * FROM groups WHERE group_name = "'.$_POST['group'].'"')->fetch_all($resulttype = MYSQLI_ASSOC);
	$q = 'UPDATE groups SET students = "'.$values[0]['students'].','.$_POST['student'].'" WHERE group_name = "'.$_POST['group'].'"';
	$db->query($q)->fetch_all($resulttype = MYSQLI_ASSOC);
	print_r($q);
?>
