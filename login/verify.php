<?php
  $db = mysqli_connect("localhost", "root", "root", "pscsorg_3.0");
  if(!empty($_COOKIE['user']) || !empty($_COOKIE['login'])) {
    $user = $_COOKIE['user'];
    $year = date(Y);
    $loginQuery = $db->prepare("SELECT login_password FROM login WHERE login_year = '$year'");
    $loginQuery->execute();
    $loginResult = Array();
    foreach ($loginQuery->get_result() as $row)
    {
      array_push($loginResult, $row['login_password']);
    }
    $studentQuery = $db->query("SELECT imgurl FROM student_data WHERE imgurl = '$user'");
    $row_cnt = mysqli_num_rows($studentQuery);
    if($row_cnt == 0) {
      $adminQuery = $db->query("SELECT imgurl FROM admins WHERE imgurl = '$user'");
      $row_cnt = mysqli_num_rows($adminQuery);
      if($row_cnt == 0) {
        if($_COOKIE['login'] != $loginResult[0]) {
          header('Location: login/index.php?to=' . $_SERVER['REQUEST_URI']);
        }
      }
    }
  } else {
    header('Location: /login/index.php?to=' . $_SERVER['REQUEST_URI']);
  }
?>
