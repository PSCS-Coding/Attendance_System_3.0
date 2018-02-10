<?php
  $db = mysqli_connect("localhost", "root", "root", "pscsorg_3.0");
  if(!empty($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
    $studentQuery = $db->query("SELECT imgurl FROM student_data WHERE imgurl = '$user'");
    $row_cnt = mysqli_num_rows($studentQuery);
    if($row_cnt == 0) {
      $adminQuery = $db->query("SELECT imgurl FROM admins WHERE full_name = '$user'");
      $row_cnt = mysqli_num_rows($adminQuery);
      if($row_cnt == 0) {
        header('Location: login/index.php?to=' . $_SERVER['REQUEST_URI']);
      }
    }
  } else {
    header('Location: login/index.php?to=' . $_SERVER['REQUEST_URI']);
  }
?>
