<?php
    require_once('connection.php');
    if(!empty($_GET["name"]) && !empty($_GET["imgurl"])){
      //student table
        $studentQuery = $db->prepare("SELECT full_name from student_data");
        $studentQuery->execute();
        $name = $_GET['name'];
        foreach ($studentQuery->get_result() as $row)
        {
          $result[] = $row['full_name'];
        }
        $result = array_map('strtolower', $result);
        //student privileges
        $studentPriv = $db->query("SELECT privileges from student_data");
        //admin table
        $adminQuery = $db->prepare("SELECT full_name from admins");
        $studentQuery->execute();
        foreach ($adminQuery->get_result() as $row)
        {
          $adminResult[] = $row['full_name'];
        }
        $adminResult = array_map('strtolower', $result);
        //admin privileges
        $adminPriv = $db->query("SELECT privileges from admins");
        if(in_array(strtolower($name), $result)) {

          $imgurl = $_GET['imgurl'];
          $updateImage = $db->query("UPDATE student_data SET imgurl = '$imgurl' WHERE full_name = '$name'");
          //set cookie
          echo $studentPriv;
        } elseif(in_array(strtolower($name), $adminResult)) {
          //set cookie
          echo $adminPriv;
        } else {
          echo 0;
        }
    }
?>
