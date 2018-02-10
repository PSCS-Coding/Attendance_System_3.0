<?php
  require_once("/login/connection.php");
  if(!empty($_COOKIE['user'])) {
    $user = str_replace("+", " ", $_COOKIE['user']);
    $studentQuery = $db->query("SELECT full_name FROM student_data WHERE full_name = '$user'");
    $row_cnt = mysqli_num_rows($studentQuery);
    if($row_cnt == 0) {
      $adminQuery = $db->query("SELECT full_name FROM admins WHERE full_name = '$user'");
      $row_cnt = mysqli_num_rows($adminQuery);
      if($row_cnt == 0) {
        header('Location: login/index.php');
      }
    }
  } else {
    header('Location: login/index.php');
  }
?>
