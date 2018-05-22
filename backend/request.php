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
        echo '/';

        $offsite_locations = $db->query("SELECT * FROM offsite_locations")->fetch_all($resulttype = MYSQLI_ASSOC);
        $offsite_locations = array_column($offsite_locations, 'location_name', 'location_id');

        echo urlencode(json_encode($offsite_locations, JSON_PRETTY_PRINT));
        echo '/';

        $facilitators = $db->query("SELECT * FROM facilitators")->fetch_all($resulttype = MYSQLI_ASSOC);
        $facilitators = array_column($facilitators, 'facilitator_name', 'facilitator_id');

        echo urlencode(json_encode($facilitators, JSON_PRETTY_PRINT));
        echo '/';

        $school_timing = $db->query("SELECT start_time, end_time FROM globals")->fetch_all($resulttype = MYSQLI_ASSOC);
        $school_timing = array_replace(array(), $school_timing[0]);

        echo urlencode(json_encode($school_timing, JSON_PRETTY_PRINT));
        echo '/';

        $groups = $db->query("SELECT * FROM groups")->fetch_all($resulttype = MYSQLI_ASSOC);
        $groups_array = array();
        foreach ($groups as $group) {
            $group['students'] = explode(",",$group['students']);
            array_push($groups_array, $group);
        }

        echo urlencode(json_encode($groups_array, JSON_PRETTY_PRINT));
    } elseif($_GET['f'] == 'changestatus') {
        $student_ids = explode(',', $_GET['students']);
        $status_id = $_GET['status'];
        $return_time = $_GET['returntime'];
        $info = $_GET['info'];
        //angus code here
        //change status function that checks if returntime & info is set, parses the list of students, and changes the statuses in the database.
        echo $student_ids;
        echo $status_id;
        echo $return_time;
        echo $info;

    }
}

?>