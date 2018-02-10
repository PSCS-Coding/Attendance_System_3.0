<?php
    require_once('connection.php');
    if(!empty($_GET["name"]) && !empty($_GET["imgurl"])){
        $studentQuery = $db->prepare("SELECT full_name from student_data");
        $studentQuery->execute();
        $name = $_GET['name'];
        foreach ($studentQuery->get_result() as $row)
        {
          $result[] = $row['full_name'];
        }
        $result = array_map('strtolower', $result);
        if(in_array(strtolower($name), $result)) {
          $imgurl = $_GET['imgurl'];
          $updateImage = $db->query("UPDATE student_data SET imgurl = '$imgurl' WHERE full_name = '$name'");
          //set google login cookie
          echo "true";
        } else {
          echo "false";
        }
    }
?>
