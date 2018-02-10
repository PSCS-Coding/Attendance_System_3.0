<?php
  require_once('connection.php');
  if(!empty($_COOKIE['user'])) {
    $user = str_replace("+", " ", $_COOKIE['user']);
    $studentQuery = $db->query('SELECT full_name FROM student_data WHERE full_name = "$user"');
    $row_cnt = $studentQuery->num_rows();
    if($row_cnt == 0) {
      $adminQuery = $db->query('SELECT full_name FROM admins WHERE full_name = "$user"');
      $row_cnt = $adminQuery->num_rows();
      if($row_cnt == 0) {
        header('Location: login/index.php');
      }
    }
  } else {
    header('Location: login/index.php');
  }
?>
