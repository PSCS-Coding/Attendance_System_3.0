<?php

require_once 'connection.php';
if (!empty($_GET['f'])) {
    if ($_GET['f'] == 'current') {
        $status_query = $db->query("SELECT * FROM status_data")->fetch_all($resulttype = MYSQLI_ASSOC);
        $status_array = array();
        foreach ($status_query as $status) {
            array_push($status_array, $status['status_name']);
        }
        echo urlencode(json_encode($status_array, JSON_PRETTY_PRINT));
        echo '/';

        $current_events = $db->query("SELECT first_name,last_name,status_id,student_data.student_id,info,return_time 
            FROM current
            JOIN student_data
            ON current.student_id = student_data.student_id")->
            fetch_all($resulttype = MYSQLI_ASSOC);

        echo urlencode(json_encode($current_events, JSON_PRETTY_PRINT));
    } elseif($_GET['f'] == 'changestatus') {
        $student_ids = explode(',', $_GET['students']);
        $status_id = $_GET['status'];
        $return_time = $_GET['returntime'];
        $info = $_GET['info'];
        //angus code here
        //change status function that checks if returntime & info is set, parses the list of students, and changes the statuses in the database.
        //echoes 'success' or header("HTTP/1.0 404 Not Found"); for failure, so that the ajax request gets rejected
        echo $student_ids;
        echo $status_id;
        echo $return_time;
        echo $info;

    }
}

?>