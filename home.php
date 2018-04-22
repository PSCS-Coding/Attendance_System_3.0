<?php
  require_once('verify.php');
  require_once('connection.php');
  require_once('header.php');
?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Attendance System: Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body class='noselect'>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar" style="box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1);">
      <?php require_once('nav.html');?>

    </nav>
    <script src='/js/nav.js'></script>
    <script type='text/javascript'>
      $(document).ready(function () {
        createNav();
        $('.index-actions').html('');
        $('.navuserhome').attr('href','index.php');
        $('.navuserhome').text('Main page');
      });
    </script>
  </body>

  </html>