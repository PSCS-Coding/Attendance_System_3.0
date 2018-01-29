<?php
session_start();
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("connection.php");
function status_update($student, $status, $old_status)
{
	global $db;
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
		$query = 'SELECT * FROM current_stati INNER JOIN students ON current_stati.student_id = students.student_id INNER JOIN status ON current_stati.status_id = status.status_id ORDER BY first_name DESC';
		$stati = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
		if (!empty($_POST['change'])) {
			status_update($_POST['student'],$_POST['new'] , $_POST['current']);
			$query = 'SELECT * FROM current_stati INNER JOIN students ON current_stati.student_id = students.student_id INNER JOIN status ON current_stati.status_id = status.status_id ORDER BY first_name DESC';
			$stati = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);

		}
		echo '<table><tr><th>Student</th><th>Status</th></tr>';
		foreach($stati as &$row){
			echo '<tr><td>'.$row["first_name"].' '.$row["last_name"][0].'.</td><td><p>'.$row["status_name"].' </p> <form action="/index.php" method="POST">';
			echo '<input type="hidden" name="student" value="'.$row["student_id"].'"> <input type=hidden name=current value="'.$row["status_id"].'">';
			if($row['status_id'] != 2 ){
				echo '<input type="hidden" name="new" value=2> <input type="submit" name="change" value="P">';
				if($row['status_id'] != 7 && $row['status_id'] != 5)
					echo '<input type="hidden" name="new" value=7> <input type="submit" name="change" value="A">';
			}
			else{
				if($row['status_id'] != 5)
					echo '<input type="hidden" name="new" value=5> <input type="submit" name="change" value="SO">';
			}
			echo '</form></td></tr>';
		}
		echo '</table>';
		?>
	</body>
</html>
