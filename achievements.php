<?php
require_once("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Achievements</title>
</head>
<body>
  <?php
  $query = 'SELECT * FROM current INNER JOIN student_data ON current.student_id = student_data.student_id INNER JOIN status_data ON current.status_id = status_data.status_id ORDER BY first_name DESC';
  $current = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
  $month = new DateTime();
  foreach ($current as $key => $value) {
    echo "<h2>".$value['first_name'].":"."</h2>";
    echo "<br>";
    if ($value['current_offsite_hours'] == 1000) {
      if ($month -> format('n') >= 01){
        echo "Offsite Keeper";
      }
    }
  }
  ?>
</body>
</html>
