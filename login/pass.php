<?php
  require_once('/connection.php');
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
      header('Location: ../');
    } else {
      header('Location: ../login/?wrong=true');
    }
  }
?>
