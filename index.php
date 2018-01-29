<?php
session_start();
?>
<?php
function status_update($student, $status, $old_status)
{
	$query = 'UPDATE current_stati SET status_id = '.enqute($status).' WHERE student_id = '.enquote($student);
	$stati = $db->query($query);


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
			User Panel: Free Commerce For Sale
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
		$query = 'SELECT * FROM current_stati INNER JOIN students ON current_stati.student_id = students.student_id INNER JOIN status ON current_stati.status_id = status.status_id';
		$stati = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
		if($_GET['button'] = 'yes'){
			echo 'button';
		}
		echo '<table><tr><th>Student</th><th>Status</th></tr>';
		foreach($stati as &$row){
			echo '<tr><td>'.$row["first_name"].' '.$row["last_name"][0].'.</td><td><a href="/index.php?button=yes&student='.$row["student_id"].'">'.$row["status_name"].'</a></td></tr>';
		}
		echo '</table>';
		?>
	</body>
</html>
