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
						$master_array[0] = $not_checked_in;
						$master_array[1] = $present;
						$master_array[2] = $offsite;
						$master_array[3] = $field_trip;
						$master_array[4] = $checked_out;
						$master_array[5] = $late;
						$master_array[6] = $independent_study;
						$master_array[7] = $absent;
						$master_array_names[0] = "Not Checked In:";
						$master_array_names[1] = "Present:";
						$master_array_names[2] = "Offsite:";
						$master_array_names[3] = "Field Trip:";
						$master_array_names[4] = "Checked Out:";
						$master_array_names[5] = "Late:";
						$master_array_names[6] = "Independent Study:";
						$master_array_names[7] = "Absent:";
						$masterarrlength = count($master_array);
						for($b = 0; $b < $masterarrlength; $b++) {
							echo "<div>";
								echo "<h3>";
									echo $master_array_names[$b];
								echo "</h3>";
								$arrlength = count($master_array[$b]);
								for($x = 0; $x < $arrlength; $x++) {
									echo "<ul>";
    								echo "<li>".$master_array[$b][$x]."</li>";
									echo "</ul>";
								}
							echo "</div>";
						}
?>
</body>
</html>
