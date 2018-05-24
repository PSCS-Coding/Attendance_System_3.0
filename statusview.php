<?php
require_once("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
Status View
</title>
</head>
<body class="top">
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
	<?php
		$query = 'SELECT * FROM current INNER JOIN student_data ON current.student_id = student_data.student_id WHERE student_data.active = "1" ORDER BY first_name ASC';
		$current = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
		$stati = $db->query('SELECT * FROM status_data;')->fetch_all($resulttype = MYSQLI_ASSOC);
		$x = 0;
		$status_id = 0;
		foreach ($stati as &$status) {
			foreach($current as &$value){
				if($value['status_id'] == $status['status_id']){
					if($x == 0){
						echo '<div class="thin"><h1>'.ucwords(str_replace('_',' ',$status['status_name'])).'</h1>';
						$x++;
					}echo $value['first_name'].' '.$value['last_name'].'</br>';
				}
			}if($x != 0){
				echo '</div>';
			}
			$x = 0;
		}
	?>
</body>
</html>
