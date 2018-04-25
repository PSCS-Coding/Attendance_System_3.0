<?php
  require_once("connection.php");
  echo $_POST['name'];
  //echo $_POST['group'];
  $arr = array();
  $z = -1;
  foreach ($_POST["group"] as $x => $i) {
    $z++;
    $leng = strlen($_POST["group"][$z]) - 2;
    $query = $db->query("SELECT student_id FROM student_data WHERE first_name = ".$_POST['group'][$z][$leng]." AND last_name = ".substr($_POST['group'][$z], $leng));
    array_push($arr, $query);
    //print_r($arr);
    //echo $query;
  }
$insertQuery = $db->query("INSERT INTO groups (group_name, students) VALUES (".$_POST['name'].", '42')");
?>
