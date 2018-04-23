<?php
  require_once('connection.php');
  if(!empty($_COOKIE['user']) || !empty($_COOKIE['login'])) {
    $user = $_COOKIE['user'];
    $loginQuery = $db->prepare("SELECT login_password FROM login");
    $loginQuery->execute();
    $loginResult = Array();
    foreach ($loginQuery->get_result() as $row)
    {
      array_push($loginResult, $row['login_password']);
      $row_cnt += 1;
    }
    $studentQuery = $db->prepare("SELECT imgurl FROM student_data WHERE active = 1");
    $studentQuery->execute();
    $imageResult = Array();
    foreach ($studentQuery->get_result() as $row)
    {
      array_push($imageResult, $row['imgurl']);
      $row_cnt += 1;
    }
    if(!in_array($user, $imageResult)) {
      $adminQuery = $db->prepare("SELECT imgurl FROM admins");
      $aImageResult = Array();
      foreach ($adminQuery->get_result() as $row)
      {
        array_push($aImageResult, $row['imgurl']);
        $row_cnt += 1;
      }
      if($row_cnt < 1) {
        if($_COOKIE['login'] != $loginResult[0]) {
          header('Location: login/?to=' . $_SERVER['REQUEST_URI']);
        }
      } else {
        //TODO somehow tell the page that this is an admin user, for the admin pages.
      }
    }
  } else {
    header('Location: login/?to=' . $_SERVER['REQUEST_URI']);
  }
?>
