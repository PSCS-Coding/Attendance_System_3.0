<?php
  require_once('../backend/connection.php');
  //verify password login and set login cookie
  if(isset($_POST['pass'])) {
    if(isset($_COOKIE['user'])) {
      setcookie("user", '', time() - 3600, "/");
    }
    $loginQuery = $db->prepare("SELECT login_password FROM login");
    $loginQuery->execute();
    $loginResult = Array();
    foreach ($loginQuery->get_result() as $row) {
      array_push($loginResult, $row['login_password']);
    }
    if($loginResult[0] == crypt($_POST['pass'], 'P9')) {
      $cook = crypt($_POST['pass'], 'P9');
      setcookie("login", $cook, time() + (86400 * 5), "/");
      if(!empty($_GET['redirect_uri'])) {
        header('Location: ' . $_GET['redirect_uri']);
      } else {
        header('Location: ../');
      }
    } else {
      header('Location: ../login/?wrong=true');
    }
  }
?>