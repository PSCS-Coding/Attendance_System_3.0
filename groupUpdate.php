<?php
  require_once("connection.php");
  $_POST["group"];
  $_POST["name"];
  $arr = array();
  foreach ($_POST["group"] as $x => $i) {
    $leng = $_POST["group"][$i].length - 2;
    $query = $db->query("SELECT student_id FROM student_data WHERE first_name = ".$_POST['group'][$i][$leng]." AND last_name = ".substr($_POST['group'][$i], $leng));
    $arr.push($query);
  }
$insertQuery = $db->query("INSERT INTO groups (group_name, students) VALUES (".$_POST['name'].", ".implode(',', $arr).")");
?>
