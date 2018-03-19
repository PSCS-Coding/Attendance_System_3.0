<?php
    require_once('/connection.php');
    if($_GET['ver'] == date('i') || $_GET['ver'] == (date('i') + 1)) {
    if(!empty($_GET["name"]) && !empty($_GET["imgurl"])){
        //student table
        if(isset($_COOKIE['login'])) {
          setcookie("login", $_GET['imgurl'], time() - 3600, "/");
        }
        $studentQuery = $db->prepare("SELECT email from student_data");
        $studentQuery->execute();
        $name = explode(' ', $_GET['name']);
        $first = $name[0];
        $last = $name[1];
        $email = $_GET['email'];
        $result = Array();
        foreach ($studentQuery->get_result() as $row)
        {
          array_push($result, $row['full_name']);
        }
        //admin table
        $adminQuery = $db->prepare("SELECT full_name from admins");
        $adminQuery->execute();
        $adminResult = Array();
        foreach ($adminQuery->get_result() as $row)
        {
          array_push($adminResult, $row['full_name']);
        }
        if(in_array($name, $result)) {

          $imgurl = $_GET['imgurl'];
          $updateImage = $db->query("UPDATE student_data SET imgurl = '$imgurl' WHERE first_name = '$first' AND last_name = '$last'");

<<<<<<< HEAD
          $studentPriv = $db->query("SELECT priv FROM student_data WHERE full_name = '$name'");
          setcookie("user", $imgurl, time() + (86400 * 5), "/");
=======
          $studentPriv = $db->query("SELECT priv FROM student_data WHERE first_name = '$first' AND last_name = '$last'");
          setcookie("user", crypt($imgurl, 'P9'), time() + (86400 * 5), "/");
          setcookie("imgurl", $imgurl, time() + (86400 * 5), "/");
>>>>>>> master
          echo $studentPriv->fetch_array()[0];

        } elseif(in_array($name, $adminResult)) {
          $imgurl = $_GET['imgurl'];
          $updateImage = $db->query("UPDATE admins SET imgurl = '$imgurl' WHERE first_name = '$first' AND last_name = '$last'");


<<<<<<< HEAD
          $adminPriv = $db->query("SELECT priv FROM admins WHERE full_name = '$name'");
          setcookie("user", $imgurl, time() + (86400 * 5), "/");
=======
          $adminPriv = $db->query("SELECT priv FROM admins WHERE first_name = '$first' AND last_name = '$last'");
          setcookie("user", crypt($imgurl, 'P9'), time() + (86400 * 5), "/");
          setcookie("imgurl", $imgurl, time() + (86400 * 5), "/");
          echo '3';
        } else {
>>>>>>> master
          echo $adminPriv->fetch_array()[0];
        } else {
          echo 0;
        }
    }
  } else {
<<<<<<< HEAD
    setcookie("user", $imgurl, time() - 3600, "/");
=======
    setcookie("user", $_GET['imgurl'], time() - 3600, "/");
    setcookie("login", $_GET['imgurl'], time() - 3600, "/");
>>>>>>> master
    echo 'bad verification';
  }

?>
