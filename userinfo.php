<?php
  require_once('connection.php');
  if(!empty($_COOKIE['user'])) {
    $imgurl = $_COOKIE['imgurl'];
    $user = $_COOKIE['user'];
    if(crypt($imgurl, 'P9') == $user) {
      $fnameQuery = $db->prepare("SELECT first_name FROM student_data WHERE imgurl = '$imgurl' AND active = 1");
      $fnameQuery->execute();
        foreach ($fnameQuery->get_result() as $row)
        {
          $fName = $row['first_name'];
        }
        $lnameQuery = $db->prepare("SELECT last_name FROM student_data WHERE imgurl = '$imgurl' AND active = 1");
        $lnameQuery->execute();
          foreach ($lnameQuery->get_result() as $row)
          {
            $lName = $row['last_name'];
          }
          $emailQuery = $db->prepare("SELECT email FROM student_data WHERE imgurl = '$imgurl' AND active = 1");
          $emailQuery->execute();
            foreach ($emailQuery->get_result() as $row)
            {
              $email = $row['email'];
            }
            $devQuery = $db->prepare("SELECT dev FROM student_data WHERE imgurl = '$imgurl' AND active = 1");
            $devQuery->execute();
              foreach ($devQuery->get_result() as $row)
              {
                $dev = "~" . $row['dev'];
              }
              $coinQuery = $db->prepare("SELECT coins FROM student_data WHERE imgurl = '$imgurl' AND active = 1");
              $coinQuery->execute();
                foreach ($coinQuery->get_result() as $row)
                {
                  $coin = "~" . $row['coins'];
                }
        if(isset($fName)) {
        echo $fName . "~" . $lName . "~" . $email . "~" . $imgurl . $dev . $coin;
      } else {
        $fnameQuery = $db->prepare("SELECT first_name FROM admins WHERE imgurl = '$imgurl'");
        $fnameQuery->execute();
          foreach ($fnameQuery->get_result() as $row)
          {
            $fName = $row['first_name'];
          }
          $lnameQuery = $db->prepare("SELECT last_name FROM admins WHERE imgurl = '$imgurl'");
          $lnameQuery->execute();
            foreach ($lnameQuery->get_result() as $row)
            {
              $lName = $row['last_name'];
            }
            $emailQuery = $db->prepare("SELECT email FROM admins WHERE imgurl = '$imgurl'");
            $emailQuery->execute();
              foreach ($emailQuery->get_result() as $row)
              {
                $email = $row['email'];
              }
        echo $fName . "~" . $lName . "~" . $email . "~" . $imgurl . "~admin";
    }
  }
} elseif(!empty($_COOKIE['login'])) {
  $loginQuery = $db->prepare("SELECT login_password FROM login");
  $loginQuery->execute();
  $loginResult = Array();
  foreach ($loginQuery->get_result() as $row)
  {
    array_push($loginResult, $row['login_password']);
  }
  if($loginResult[0] == $_COOKIE['login']) {
    echo 'password';
  } else {
    echo 'bad cookie password';
  }
}

?>
