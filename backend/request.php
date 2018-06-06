<?php

function encodeAndEcho($val) {
    echo urlencode(json_encode($val, JSON_PRETTY_PRINT));
    echo '/';
}

require_once 'connection.php';
if (!empty($_GET['f'])) {
    if ($_GET['f'] == 'current') {
        $status_query = $db->query("SELECT status_name FROM status_data")->fetch_all($resulttype = MYSQLI_ASSOC);
        $status_array = array();
        foreach ($status_query as $status) {
            array_push($status_array, $status['status_name']);
        }
        encodeAndEcho($status_array);

        $current_events = $db->query("SELECT first_name,last_name,status_id,student_data.student_id,info,return_time 
            FROM current
            JOIN student_data
            ON current.student_id = student_data.student_id")->
            fetch_all($resulttype = MYSQLI_ASSOC);

            encodeAndEcho($current_events);

        $offsite_locations = $db->query("SELECT * FROM offsite_locations")->fetch_all($resulttype = MYSQLI_ASSOC);
        $offsite_locations = array_column($offsite_locations, 'location_name', 'location_id');

        encodeAndEcho($offsite_locations);

        $facilitators = $db->query("SELECT * FROM facilitators")->fetch_all($resulttype = MYSQLI_ASSOC);
        $facilitators = array_column($facilitators, 'facilitator_name', 'facilitator_id');

        encodeAndEcho($facilitators);

        $school_timing = $db->query("SELECT start_time, end_time FROM globals")->fetch_all($resulttype = MYSQLI_ASSOC);
        $school_timing = array_replace(array(), $school_timing[0]);

        encodeAndEcho($school_timing);

        $groups = $db->query("SELECT * FROM groups")->fetch_all($resulttype = MYSQLI_ASSOC);
        $groups_array = array();
        foreach ($groups as $group) {
            $group['students'] = explode(",",$group['students']);
            array_push($groups_array, $group);
        }

        encodeAndEcho($groups_array);

    } elseif($_GET['f'] == 'changestatus') {
        $student_ids = explode(',', $_GET['students']);
        $status_id = $_GET['status'];
        $info = $_GET['info'];
        $return_time = new DateTime($_GET['returntime']);
        $return_time = $return_time->format("Y-m-d H:i:s");

        if(!empty($_GET['returntime'])) {
            foreach($student_ids as $student){
                $db->query('INSERT INTO history(`student_id`,`status_id`,`info`,`return_time`) VALUES("'.$student.'","'.$status_id.'","'.$info.'","'.$return_time.'");');
                $db->query('UPDATE current SET `status_id` = "'.$status_id.'",`info` = "'.$info.'",`return_time` = "'.$return_time.'" WHERE `student_id` = "'.$student.'";');
            }
        } else {
            foreach($student_ids as $student){
                $db->query('INSERT INTO history(`student_id`,`status_id`,`info`) VALUES("'.$student.'","'.$status_id.'","'.$info.'","00:00:00");');
                $db->query('UPDATE current SET `status_id` = "'.$status_id.'",`info` = "'.$info.'",`return_time` = "00:00:00" WHERE `student_id` = "'.$student.'";');
            }
        }
    } elseif($_GET['f'] == 'user') {
        $student = $_GET['id'];
        $q = 'SELECT `first_name`,`last_name`,`status_id` FROM student_data INNER JOIN current ON student_data.student_id =  current.student_id WHERE student_data.student_id = "'.$student.'"';
        $student_data = $db->query($q)->fetch_all($resulttype = MYSQLI_ASSOC)[0];
        encodeAndEcho($student_data);

        $status_array = $db->query("SELECT status_name, has_return_time, has_info FROM status_data")->fetch_all($resulttype = MYSQLI_ASSOC);

        encodeAndEcho($status_array);

        $offsite_locations = $db->query("SELECT * FROM offsite_locations")->fetch_all($resulttype = MYSQLI_ASSOC);
        $offsite_locations = array_column($offsite_locations, 'location_name', 'location_id');

        encodeAndEcho($offsite_locations);

        $facilitators = $db->query("SELECT * FROM facilitators")->fetch_all($resulttype = MYSQLI_ASSOC);
        $facilitators = array_column($facilitators, 'facilitator_name', 'facilitator_id');

        encodeAndEcho($facilitators);

        $school_timing = $db->query("SELECT start_time, end_time FROM globals")->fetch_all($resulttype = MYSQLI_ASSOC);
        $school_timing = array_replace(array(), $school_timing[0]);

        encodeAndEcho($school_timing);
    }
}

?>