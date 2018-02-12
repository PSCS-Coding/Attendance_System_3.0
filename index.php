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
	$query = 'UPDATE current SET status_id = '.$status.' WHERE student_id = '.$student;
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
		if (!empty($_POST['change']))
			status_update($_POST['student'],$_POST['new'] , $_POST['current']);
		echo '<table><tr><th>Student</th><th>Status</th></tr>';
		$query = 'SELECT * FROM current INNER JOIN student_data ON current.student_id = student_data.student_id INNER JOIN status_data ON current.status_id = status_data.status_id ORDER BY first_name DESC';
		$stati = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
		foreach($stati as &$row){
			echo '<tr><td>'.$row["first_name"].' '.$row["last_name"][0].'.</td><td><p>'.$row["status_name"].' </p> <form action="/index.php" method="POST">';
			echo '<input type="hidden" name="student" value="'.$row["student_id"].'"> <input type=hidden name=current value="'.$row["status_id"].'">';
			if($row['status_id'] != 1 ){
				echo '<input type="hidden" name="new" value=1> <input type="submit" name="change" value="P">';
				if($row['status_id'] != 7  && $row['status_id'] != 4)
					echo '<input type="hidden" name="new" value=7> <input type="submit" name="change" value="A">';
			}
			else{
				if($row['status_id'] != 4 )
					echo '<input type="hidden" name="new" value=4> <input type="submit" name="change" value="CO">';
			}
			echo '</form></td></tr>';
		}
		echo '</table>';
		?>
	</body>
</html>
