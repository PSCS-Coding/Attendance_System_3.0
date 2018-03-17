<?php
    require_once('../connection.php');
    if($_GET['ver'] == date('i') || $_GET['ver'] == (date('i') + 1)) {
    if(!empty($_GET["name"]) && !empty($_GET["imgurl"]) && !empty($_GET["email"])){
        //student table
        $studentQuery = $db->prepare("SELECT email from student_data");
        $studentQuery->execute();
        $name = explode(' ', $_GET['name']);
        $first = $name[0];
        $last = $name[1];
        $email = $_GET['email'];
        $result = Array();
        foreach ($studentQuery->get_result() as $row)
        {
          array_push($result, $row['email']);
        }
        //admin table
        $adminQuery = $db->prepare("SELECT email from admins");
        $adminQuery->execute();
        $adminResult = Array();
        foreach ($adminQuery->get_result() as $row)
        {
          array_push($adminResult, $row['email']);
        }
        if(in_array($email, $result)) {
          $imgurl = $_GET['imgurl'];
          $updateImage = $db->query("UPDATE student_data SET imgurl = '$imgurl' WHERE first_name = '$first' AND last_name = '$last'");

          $studentPriv = $db->query("SELECT priv FROM student_data WHERE first_name = '$first' AND last_name = '$last'");
          setcookie("user", crypt($imgurl, 'P9'), time() + (86400 * 5), "/");
          setcookie("imgurl", $imgurl, time() + (86400 * 5), "/");
          echo $studentPriv->fetch_array()[0];

        } elseif(in_array($email, $adminResult)) {
          $imgurl = $_GET['imgurl'];
          $updateImage = $db->query("UPDATE admins SET imgurl = '$imgurl' WHERE first_name = '$first' AND last_name = '$last'");


          $adminPriv = $db->query("SELECT priv FROM admins WHERE first_name = '$first' AND last_name = '$last'");
          setcookie("user", crypt($imgurl, 'P9'), time() + (86400 * 5), "/");
          setcookie("imgurl", $imgurl, time() + (86400 * 5), "/");
          echo '3';
        } else {
          echo $adminPriv->fetch_array()[0];
        }
    }
  } else {
    setcookie("user", $_GET['imgurl'], time() - 3600, "/");
    setcookie("login", $_GET['imgurl'], time() - 3600, "/");
    echo 'bad verification';
  }
?>
