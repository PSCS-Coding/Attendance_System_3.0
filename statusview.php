<?php
require_once("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>
Status View
</title>
</head>
<body>
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
						$x = 1;
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
							$x = $x + 1;
            }
	?>
	<h2>
		Not Checked In:
	</h2>
	<?php
		$arrlength = count($not_checked_in);
		for($x = 0; $x < $arrlength; $x++) {
    	echo $not_checked_in[$x];
    	echo "<br>";
		}
	?>
	<h2>
		Present:
	</h2>
	<?php
		$arrlength = count($present);
		for($x = 0; $x < $arrlength; $x++) {
    	echo $present[$x];
    	echo "<br>";
		}
	?>
	<h2>
		Offsite:
	</h2>
	<?php
		$arrlength = count($offsite);
		for($x = 0; $x < $arrlength; $x++) {
    	echo $offsite[$x];
    	echo "<br>";
		}
	?>
	<h2>
		Field Trip:
	</h2>
	<?php
		$arrlength = count($field_trip);
		for($x = 0; $x < $arrlength; $x++) {
    	echo $field_trip[$x];
    	echo "<br>";
		}
	?>
	<h2>
		Checked Out:
	</h2>
	<?php
		$arrlength = count($checked_out);
		for($x = 0; $x < $arrlength; $x++) {
    	echo $checked_out[$x];
    	echo "<br>";
		}
	?>
	<h2>
		Late:
	</h2>
	<?php
		$arrlength = count($late);
		for($x = 0; $x < $arrlength; $x++) {
    	echo $late[$x];
    	echo "<br>";
		}
	?>
	<h2>
		Independent Study:
	</h2>
	<?php
		$arrlength = count($independent_study);
		for($x = 0; $x < $arrlength; $x++) {
    	echo $independent_study[$x];
    	echo "<br>";
		}
	?>
	<h2>
		Absent:
	</h2>
	<?php
		$arrlength = count($absent);
		for($x = 0; $x < $arrlength; $x++) {
    	echo $absent[$x];
    	echo "<br>";
		}
	?>
</body>
</html>
