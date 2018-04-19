<?php
session_start();
require_once("head.php");
start_the_day();
?>

	<div class = "sidebar">
		admin
		<a class= "sidetext" href="admin.php?page=0">Allotted Hours</a>
		<a class= "sidetext" href="admin.php?page=1">Current Events</a>
		<a class= "sidetext" href="admin.php?page=2">Facilitator Edit View</a>
		<a class= "sidetext" href="admin.php?page=3">Group Edit View</a>
		<a class= "sidetext" href="admin.php?page=4">History</a>
		<a class= "sidetext" href="admin.php?page=5">Holidays</a>
		<a class= "sidetext" href="admin.php?page=6">Offsit Locations</a>
		<a class= "sidetext" href="admin.php?page=7">Passwords</a>
		<a class= "sidetext" href="admin.php?page=8">School Hours</a>
		<a class= "sidetext" href="admin.php?page=9">Student Edit View</a>
		front end
		<a class= "sidetext" href="index.php">Front Page</a>
		<a class= "sidetext" href="statusview.php">Status View</a>
	</div>
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
         	$query = 'SELECT * FROM current INNER JOIN student_data ON current.student_id = student_data.student_id INNER JOIN status_data ON current.status_id = status_data.status_id WHERE student_data.active = 1 ORDER BY first_name DESC';
         	$current = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
         	foreach ($current as &$row) {

            	echo '<tr class="student-row" id="'.$row["student_id"].'">';
            	echo '<td>'.$row["first_name"].' '.$row["last_name"][0].'.</td>';
            	echo '<td><div class="status">'.$row["status_name"];
							if($row["status_name"] == "Late") {
								echo " arriving at ".pretty_time($row["return_time"]);
							}
							echo '</div>';
							echo '<div class="status-button present"><input type="submit" name="1" value="P"></div>';
							echo '<div class="status-button late"><input name="time" type="text" class="late-time" placeholder="Arrival time"><input type="submit" name="5" value="L"></div>';
					    echo '<div class="status-button absent"><input type="submit" name="7" value="A"></div>';
              echo '<div class="status-button checked-out"><input type="submit" name="4" value="CO"></div>';

            	echo '</td></tr>';
          	}
        ?>
      </table>
    </div>

    <script type="text/javascript" src="js/changeStatus.js"></script>
		<script type="text/javascript">
			$('.late-time').timepicker({
		    'minTime': '9:00am',
		    'maxTime': '3:40pm',
				'step' : 5,
				'scrollDefault' : 'now'
			});
      $('#main-table tr.student-row').each(function() {
        frontPageButtons($(this).attr("id"));
      });
		</script>
	</body>
</html>
