<?php

    require_once 'connection.php';
    if(!empty($_COOKIE['user'])) {
        $row_cnt = 0;
        //student google login verification
        $studentQuery = $db->prepare("SELECT id_token FROM student_data WHERE active = 1");
        $studentQuery->execute();
        foreach ($studentQuery->get_result() as $row) {
            if($row['id_token'] == $_COOKIE['user']) {
                $row_cnt++;
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
          header('Location: login/?to=' . $_SERVER['REQUEST_URI']);
        }
      } else {
        header('Location: login/?to=' . $_SERVER['REQUEST_URI']);
      }

?>