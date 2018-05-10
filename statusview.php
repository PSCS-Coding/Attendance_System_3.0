<?php
require_once("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>
Status View
</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<a href="index.php">back</a>
	<?php
     $query = 'SELECT * FROM current INNER JOIN student_data ON current.student_id = student_data.student_id INNER JOIN status_data ON current.status_id = status_data.status_id ORDER BY first_name DESC';
     $current = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
 		 $not_checked_in = array();
 			$present = array();
						$offsite = array();
						$field_trip = array();
						$checked_out = array();
						$late = array();
						$independent_study = array();
						$absent = array();
						$x = 0;
						$status_id = 0;
						foreach ($current as $key => $value) {
						$status_id = ($value['status_id']);
							if ($status_id == 0) {
								$not_checked_in[] = $value['first_name'];
							}
							if ($status_id == 1) {
								$present[] = $value['first_name'];
							}
							if ($status_id == 2) {
								$offsite[] = $value['first_name'];
							}
							if ($status_id == 3) {
								$field_trip[] = $value['first_name'];
							}
							if ($status_id == 4) {
								$checked_out[] = $value['first_name'];
							}
							if ($status_id == 5) {
								$late[] = $value['first_name'];
							}
							if ($status_id == 6) {
								$independent_study[] = $value['first_name'];
							}
							if ($status_id == 7) {
								$absent[] = $value['first_name'];
							}
							$x++;
            }
	?>
	<div>
		<table>
		<tr>
			<th>
			Not Checked In:
			</th>
		</tr>
		<?php
			$arrlength = count($not_checked_in);
			for($x = 0; $x < $arrlength; $x++) {
    			echo "<tr><td>".$not_checked_in[$x]."</td></tr>";
			}

		?>
		</table>
	</div>
	<div>
		<table>
		<tr>
			<th>
			Present:
		</th>
		</tr>
		<?php
			$arrlength = count($present);
			for($x = 0; $x < $arrlength; $x++) {
					echo "<tr><td>"."$present[$x]"."</td></tr>";
			}
		?>
		</table>
	</div>
	<div>
		<table>
		<tr>
			<th>
			Offsite:
		</th>
		</tr>
		<?php
			$arrlength = count($offsite);
			for($x = 0; $x < $arrlength; $x++) {
					echo "<tr><td>"."$offsite[$x]"."</td></tr>";
			}
		?>
		</table>
	</div>
	<div>
		<table>
		<tr>
			<th>
			Field Trip:
		</th>
		</tr>
		<?php
			$arrlength = count($field_trip);
			for($x = 0; $x < $arrlength; $x++) {
					echo "<tr><td>"."$field_trip[$x]"."</td></tr>";
			}
		?>
		</table>
	</div>
	<div>
		<table>
		<tr>
			<th>
			Checked Out:
		</th>
		</tr>
		<?php
			$arrlength = count($checked_out);
			for($x = 0; $x < $arrlength; $x++) {
					echo "<tr><td>"."$checked_out[$x]"."</td></tr>";
			}
		?>
		</table>
	</div>
	<div>
		<table>
		<tr>
			<th>
			Late:
		</th>
		</tr>
		<?php
			$arrlength = count($late);
			for($x = 0; $x < $arrlength; $x++) {
					echo "<tr><td>"."$late[$x]"."</td></tr>";
			}
		?>
		</table>
	</div>
	<div>
		<table>
		<tr>
			<th>
			Independent Study:
		</th>
		</tr>
		<?php
			$arrlength = count($independent_study);
			for($x = 0; $x < $arrlength; $x++) {
					echo "<tr><td>"."$independent_study[$x]"."</td></tr>";
			}
		?>
		</table>
	</div>
	<div>
		<table>
		<tr>
			<th>
			Absent:
		</th>
		</tr>
		<?php
			$arrlength = count($absent);
			for($x = 0; $x < $arrlength; $x++) {
					echo "<tr><td>"."$absent[$x]"."</td></tr>";
			}
		?>
		</table>
	</div>
</body>
</html>
