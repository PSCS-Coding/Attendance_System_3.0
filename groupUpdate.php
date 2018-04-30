<?php
  require_once("connection.php");
  $boom = implode(",", $_POST['group']);
  echo "the group ".$_POST['name']." was successfully created";
  $insertQuery = "INSERT INTO groups (group_name, students) VALUES ('".$_POST['name']."', ".$boom.")";
  $newinsertQuery = $db->query($insertQuery);
?>
