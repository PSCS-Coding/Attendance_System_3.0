<?php

require_once 'connection.php';
require_once 'functions.php';
if (!empty($_GET['f'])) {
    if ($_GET['f'] == 'current') {
        $query = $db->query('SELECT * FROM current ORDER BY student_id ASC'); // eventually order by name
        $result = array();
        while ($row = $query->fetch_array()) {
            array_push($result, $row);
        }
        $current = json_encode($result, JSON_PRETTY_PRINT);
        echo $current;
    }
    if ($_GET['f'] == 'facilitatorIdToName') {
        $query = $db->query('SELECT facilitator_name FROM facilitators WHERE facilitator_id = ' . $_GET["id"]);
        $result = $query->fetch_row()[0];
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    if ($_GET['f'] == 'studentIdToName') {
        $q = 'SELECT first_name, last_name FROM student_data WHERE student_id = ' . $_GET["id"];
        $query = $db->query($q);
        $result = $query->fetch_assoc();
        $name = $result['first_name'] . ' ' . $result['last_name'];
        echo json_encode($name, JSON_PRETTY_PRINT);
    }
    if ($_GET['f'] == 'studentNameToId') {
        $q = 'SELECT student_id FROM student_data WHERE first_name = "' . $_GET["fname"] . '" AND last_name = "' . $_GET["lname"] . '"';
        $query = $db->query($q);
        $result = $query->fetch_row()[0];
        $name = $result['student_id'];
        echo json_encode($name, JSON_PRETTY_PRINT);
    }
    if ($_GET['f'] == 'locationNameToId') {
        $q = 'SELECT location_id FROM offsite_locations WHERE location_name = "' . $_GET["location"] . '"';
        $query = $db->query($q);
        $result = $query->fetch_row()[0];
        $name = $result['location_id'];
        echo json_encode($name, JSON_PRETTY_PRINT);
    }
    if ($_GET['f'] == 'facilitatorNameToId') {
        $q = 'SELECT facilitator_id FROM facilitators WHERE facilitator_name = "' . $_GET["facilitator"] . '"';
        $query = $db->query($q);
        $result = $query->fetch_row()[0];
        $name = $result['facilitator_id'];
        echo json_encode($name, JSON_PRETTY_PRINT);
    }
    if ($_GET['f'] == 'locationIdToName') {
        $query = $db->query('SELECT location_name FROM offsite_locations WHERE location_id = ' . $_GET["id"]);
        $result = $query->fetch_row()[0];
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    if ($_GET['f'] == 'statusIdToName') {
        $query = $db->query('SELECT status_name FROM status_data WHERE status_id = ' . $_GET["id"]);
        $result = $query->fetch_row()[0];
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    if ($_GET['f'] == 'getFacilitators') {
        $query = $db->query('SELECT facilitator_name FROM facilitators');
        $result = $query->fetch_all();
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    if ($_GET['f'] == 'getLocations') {
        $query = $db->query('SELECT location_name FROM offsite_locations');
        $result = $query->fetch_all();
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    if ($_GET['f'] == 'changeStatus') {
        $dateReturnTime = new DateTime($_GET['return_time']);
        $dateReturnTime = $dateReturnTime->format("Y-m-d H:i:s");
        $query = 'UPDATE current SET status_id = ' . $_GET['status_id'] . ', info = "' . $_GET['info'] . '", return_time = "' . $dateReturnTime . '" WHERE student_id = ' . $_GET['student_id'];
        $db->query($query);

        // Update immediate prior record in history table with calculated duration
        $minutes_used = mins_used($_GET['student_id']);
        $id = $_GET['student_id'];
        $query = "UPDATE history SET elapsed = '$minutes_used' WHERE student_id = '$id' ORDER BY event_id DESC LIMIT 1";
        $db->query($query);

        // Add new event to history table
        $query_insert = 'INSERT INTO history (student_id, status_id, info, return_time) VALUES (' . $id . ', ' . $_GET['status_id'] . ', "' . $_GET['info'] . '", "' . $dateReturnTime . '")';
        $db->query($query_insert);
    }
}
?>