<?php
  require_once('connection.php');
  require_once('verify.php');
  if(!empty($_COOKIE['user'])) {
    $imgurl = $_COOKIE['user'];
    $nameQuery = $db->prepare("SELECT first_name FROM student_data WHERE imgurl = '$imgurl'");
    $nameQuery->execute();
    $nameResult = Array();
    foreach ($nameQuery->get_result() as $row)
    {
      array_push($nameResult, $row['first_name']);
    }
    if(count($nameResult) > 0) {
      echo 'Welcome, ' . $nameResult[0] . ' <img src="' . $imgurl .'">';
    } else {
      $adminNameQuery = $db->prepare("SELECT first_name FROM admins WHERE imgurl = '$imgurl'");
      $adminNameQuery->execute();
      $adminNameResult = Array();
      foreach ($adminNameQuery->get_result() as $row)
      {
        array_push($adminNameResult, $row['first_name']);
      }
      echo 'Welcome, ' . $adminNameResult[0] . ' <img src="' . $imgurl .'">';
    }
    echo '<br><a href="out.php">Sign out</a>';
  }
?>
