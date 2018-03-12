<?php
session_start();
require_once("connection.php");
require_once("functions.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      Attendance System
    </title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
	<body>
    <div id="main-table">
      <table>
        <tr>
          <th>
            Student
          </th>
          <th>
            Status
          </th>
        </tr>
        <?php
          $query = 'SELECT * FROM current INNER JOIN student_data ON current.student_id = student_data.student_id INNER JOIN status_data ON current.status_id = status_data.status_id ORDER BY first_name DESC';
          $current = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
          foreach ($current as &$row) {
            echo '<tr class="student-row" id="'.$row["student_id"].'">';
            echo '<td>'.$row["first_name"].' '.$row["last_name"][0].'.</td>';
            echo '<td><span class="status">'.$row["status_name"].'</span>';
            echo '<input type="submit" name="1" value="P">';
            echo '<input type="submit" name="7" value="A">';
            echo '</td></tr>';
          }
        ?>
      </table>
    </div>
    <div id="result">

    </div>
    <script type="text/javascript" src="js/changeStatus.js"></script>
	</body>
</html>
