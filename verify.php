<?php
    require_once 'connection.php';
    //pages that require admin access should require verify.php AFTER setting the variable $using_admin to true:
    //example:
    //$using_admin = true;
    //require_once 'verify.php';
    //pages that do NOT need admin access do not need to set $using_admin at all.
    if(!empty($_COOKIE['user'])) {
        $row_cnt = 0;
        //student google login verification
        $studentQuery = $db->prepare("SELECT id_token FROM student_data WHERE active = 1");
        $studentQuery->execute();
        foreach ($studentQuery->get_result() as $row) {
            if($row['id_token'] == $_COOKIE['user']) {
                if($using_admin !== true) {
                    $row_cnt++;
                } else {
                    die('<h1>You do not have permission to access this page.</h1>'); // let me know what you think we should put here...
                }
            }
        }
        //admin google login verification
        $adminQuery = $db->prepare("SELECT id_token FROM admins");
        $adminQuery->execute();
        foreach ($adminQuery->get_result() as $row) {
            if($row['id_token'] == $_COOKIE['user']) {
                $row_cnt++;
            }
        }
        //checking if either query had results, if not, redirect to the login page
        if($row_cnt < 1) {
            setcookie("user", $_GET['imgurl'], time() - 3600, "/");
            setcookie("login", $_GET['imgurl'], time() - 3600, "/");
            header('Location: login/?to=' . $_SERVER['REQUEST_URI']);
        }
      } elseif(!empty($_COOKIE['login'])) {
        //login verification
        $loginQuery = $db->prepare("SELECT login_password FROM login");
        $loginQuery->execute();
        $loginResult = Array();
        $row_cnt = 0;
        foreach ($loginQuery->get_result() as $row) {
            array_push($loginResult, $row['login_password']);
        }
        if($_COOKIE['login'] != $loginResult[0]) {
            setcookie("user", $_GET['imgurl'], time() - 3600, "/");
            setcookie("login", $_GET['imgurl'], time() - 3600, "/");
            header('Location: login/?to=' . $_SERVER['REQUEST_URI']);
        }
      } else {
        header('Location: login/?to=' . $_SERVER['REQUEST_URI']);
      }

?>