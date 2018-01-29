<?php
session_start();
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
function status_update($student, $status, $old_status)
{
	$db = new mysqli('localhost:8889', 'root', 'root', 'attendance_new');
	if($db->connect_errno > 0){
		echo 'fail';
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$query = 'UPDATE current_stati SET status_id = '.$status.' WHERE student_id = '.$student;
	$db->query($query);
    return 0;
}
function enquote($text){
	return '"'.$text.'"';
}
?>
<!DOCTYPE html>
<html>
  	<head>
    	<title>
			Attendance System 100% Complete Perfect No Virus Download Free Effective and Efficient
    	</title>
	    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    	<link rel="stylesheet" type="text/css" href="style.css">
  	</head>
	<body>
    	<?php
		$db = new mysqli('localhost:8889', 'root', 'root', 'attendance_new');
		if($db->connect_errno > 0){
			echo 'fail';
		    die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$query = 'SELECT * FROM current_stati INNER JOIN students ON current_stati.student_id = students.student_id INNER JOIN status ON current_stati.status_id = status.status_id ORDER BY first_name DESC';
		$stati = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
		if($_GET['button'] == 'yes'){
			status_update($_GET['student'],$_GET['new_status'] , $_GET['status']);
			$query = 'SELECT * FROM current_stati INNER JOIN students ON current_stati.student_id = students.student_id INNER JOIN status ON current_stati.status_id = status.status_id ORDER BY first_name DESC';
			$stati = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
		}
		echo '<table><tr><th>Student</th><th>Status</th></tr>';
		foreach($stati as &$row){
			echo '<tr><td>'.$row["first_name"].' '.$row["last_name"][0].'.</td><td>'.$row["status_name"].'  ';
			if($row['status_id'] != 2 ){
				echo '<a href="/index.php?button=yes&student='.$row["student_id"].'&new_status=2&status='.$row['status_id'].'">P</a> ';
				if($row['status_id'] != 7 && $row['status_id'] != 5)
					echo '<a href="/index.php?button=yes&student='.$row["student_id"].'&new_status=7&status='.$row["status_id"].'">A</a> ';
			}
			else{
				if($row['status_id'] != 5)
					echo '<a href="/index.php?button=yes&student='.$row["student_id"].'&new_status=5&status='.$row["status_id"].'">CO</a>';
			}
			echo '</td></tr>';
		}
		echo '</table>';
		?>
	</body>
</html>
