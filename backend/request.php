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

        $onsite_q = $db->query("SELECT onsite FROM status_data")->fetch_all($resulttype = MYSQLI_ASSOC);
        $onsite_a = array();
        foreach ($onsite_q as $s) {
            array_push($onsite_a, $s['onsite']);
        }
        encodeAndEcho($onsite_a);

    } elseif($_GET['f'] == 'changestatus') {
        $student_ids = explode(',', $_GET['students']);
        $status_id = $_GET['status'];
        $info = $_GET['info'];
        $return_time = new DateTime($_GET['returntime']);
        $return_time = $return_time->format("Y-m-d H:i:s");


        //angus code here
        foreach($student_ids as $student){
            if($return_time) {
                $db->query('INSERT INTO history(`student_id`,`status_id`,`info`,`return_time`) VALUES("'.$student.'","'.$status_id.'","'.$info.'","'.$return_time.'");');
                $db->query('UPDATE current SET `status_id` = "'.$status_id.'",`info` = "'.$info.'",`return_time` = "'.$return_time.'" WHERE `student_id` = "'.$student.'";');
            } else {
                $db->query('INSERT INTO history(`student_id`,`status_id`,`info`) VALUES("'.$student.'","'.$status_id.'","'.$info.'");');
                $db->query('UPDATE current SET `status_id` = "'.$status_id.'",`info` = "'.$info.'" WHERE `student_id` = "'.$student.'";');
            }
        }
    }
}

?>