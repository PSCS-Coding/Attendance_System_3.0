<?php
session_start();
require_once("connection.php");
require_once("functions.php");
?>
<!DOCTYPE html>
<html>
  <head>
	<title>PSCS Attendance</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="js/timepicker/jquery.timepicker.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="js/timepicker/jquery.timepicker.css" />
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
            	echo '<td><span class="status">'.$row["status_name"];
							if($row["status_name"] == "Late") {
								echo " arriving at ".pretty_time($row["return_time"]);
							}
							echo '</span>';
							if($row['status_id'] != 1 ) { // if not present, show the present button
								echo '<input type="submit" name="1" value="P">';
			  					if($row['status_id'] == 0 || $row['status_id'] == 5) { // if not checked in or late, show late fields
										echo '<input name="time" type="text" class="late" placeholder="Arrival time"><input type="submit" name="5" value="L">';
			  					}
			  					if($row['status_id'] != 7  && $row['status_id'] != 4) { // if not absent or checked out, show absent button
					            	echo '<input type="submit" name="7" value="A">';
			  					}
			  				}
		  				else { // student is present
		  					if($row['status_id'] != 4 ) { // if not checked out, show check out button
				            	echo '<input type="submit" name="4" value="CO">';
		  					}
		  				}
            	echo '</td></tr>';
          	}
        ?>
      </table>
    </div>

    <script type="text/javascript" src="js/changeStatus.js"></script>
		<script type="text/javascript">
			$('.late').timepicker({
		    'minTime': '9:00am',
		    'maxTime': '3:40pm',
				'step' : 5,
				'scrollDefault' : 'now'
			});
		</script>
	</body>
</html>
