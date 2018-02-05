<?php
    require_once('connection.php');
    if(!empty($_GET["name"]) && !empty($_GET["imgurl"])){
    $studentQuery = $db->query("SELECT studentname from students");
        $result = $studentQuery->fetch_assoc();
        $result = array_map('strtolower', $result);
        if(in_array(strtolower($_GET['name']), $result)) {
          $name = $_GET['name'];
          $imgurl = $_GET['imgurl'];
          $updateImage = $db->query("UPDATE students SET imgurl = '$imgurl' WHERE studentname = '$name'");
          echo "true";
        } else {
          echo "false";
        }
    }
?>
