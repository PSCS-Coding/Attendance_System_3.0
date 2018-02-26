<?php
  require_once('connection.php');
  if(!empty($_COOKIE['user']) || !empty($_COOKIE['login'])) {
    $user = $_COOKIE['user'];
    $year = date('Y');
    $loginQuery = $db->prepare("SELECT login_password FROM login WHERE login_year = '$year'");
    $loginQuery->execute();
    $loginResult = Array();
    foreach ($loginQuery->get_result() as $row)
    {
      array_push($loginResult, $row['login_password']);
    }
    $studentQuery = $db->prepare("SELECT imgurl FROM student_data");
    $studentQuery->execute();
    $imageResult = Array();
    foreach ($studentQuery->get_result() as $row)
    {
      array_push($imageResult, $row['imgurl']);
    }
    if(in_array($user, $imageResult)) {
      $adminQuery = $db->prepare("SELECT imgurl FROM admins");
      $aImageResult = Array();
      foreach ($adminQuery->get_result() as $row)
      {
        array_push($aImageResult, $row['imgurl']);
      }
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
