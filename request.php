<?php

  require_once('connection.php');
if(!empty($_GET['f'])) {
  if($_GET['f'] == 'current') {
    $query = $db->query('SELECT * FROM current');
    $result = Array();
    while($row = $query->fetch_array()) {
      array_push($result, $row);
    }
    $current = json_encode($result, JSON_PRETTY_PRINT);
    echo $current;
  }
  if($_GET['f'] == 'facilitatorIdToName') {
    $query = $db->query('SELECT facilitator_name FROM facilitators WHERE facilitator_id = ' . $_GET["id"]);
    $result = $query->fetch_row()[0];
    echo json_encode($result, JSON_PRETTY_PRINT);
  }
  if($_GET['f'] == 'studentIdToName') {
    $q = 'SELECT first_name, last_name FROM student_data WHERE student_id = ' . $_GET["id"];
    $query = $db->query($q);
    $result = $query->fetch_assoc();
    $name = $result['first_name'] . ' ' . $result['last_name'];
    echo json_encode($name, JSON_PRETTY_PRINT);
  }
  if($_GET['f'] == 'locationIdToName') {
    $query = $db->query('SELECT location_name FROM offsite_locations WHERE location_id = ' . $_GET["id"]);
    $result = $query->fetch_row()[0];
    echo json_encode($result, JSON_PRETTY_PRINT);
  }
  if($_GET['f'] == 'statusIdToName') {
    $query = $db->query('SELECT status_name FROM status_data WHERE status_id = ' . $_GET["id"]);
    $result = $query->fetch_row()[0];
    echo json_encode($result, JSON_PRETTY_PRINT);
  }
  if($_GET['f'] == 'getFacilitators') {
    $query = $db->query('SELECT facilitator_name FROM facilitators');
    $result = $query->fetch_all();
    echo json_encode($result, JSON_PRETTY_PRINT);
  }
  if($_GET['f'] == 'getLocations') {
    $query = $db->query('SELECT location_name FROM offsite_locations');
    $result = $query->fetch_all();
    echo json_encode($result, JSON_PRETTY_PRINT);
  }
}
?>
