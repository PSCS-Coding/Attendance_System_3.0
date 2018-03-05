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
            echo '<tr id="'.$row["student_id"].'">';
            echo '<td>'.$row["first_name"].' '.$row["last_name"][0].'.</td>';
            echo '<td>'.$row["status_name"];
            echo '<input type="submit" name="present" value="P">';
            echo '<input type="submit" name="absent" value="A">';
            // onclick, call a PHP file that grabs the student_id and status code of the button, and sends it to a simple php file



            // echo '<input type="hidden" name="student" value="'.$row["student_id"].'"> <input type=hidden name=current value="'.$row["status_id"].'">';
            //   if ($row['status_id'] != 1 ){
            //   	echo '<input type="hidden" name="new" value=1> <input type="submit" name="change" value="P">';
            //   	if($row['status_id'] != 7  && $row['status_id'] != 4)
            //   		echo '<input type="hidden" name="new" value=7> <input type="submit" name="change" value="A">';
            //   }
            //   else {
            //   	if($row['status_id'] != 4 )
            //   		echo '<input type="hidden" name="new" value=4> <input type="submit" name="change" value="CO">';
            //   }
            echo '</td></tr>';
          }
        ?>
      </table>
    </div>
	</body>
</html>
