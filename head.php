<?php
  require_once("connection.php");
  require_once("functions.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>PSCS Attendance<?php if (isset($pagetitle)) { echo ": " . $pagetitle;} ?></title>
      <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" type="text/css" href="style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="js/timepicker/jquery.timepicker.min.js" type="text/javascript"></script>
      <link rel="stylesheet" type="text/css" href="js/timepicker/jquery.timepicker.css" />
  </head>
