<?php
  	require_once("connection.php");
  	require_once("functions.php");

  	$student = $_POST['student'];
  	$status = $_POST['status'];
  	$time = $_POST['time'];

  	$len = strlen((string)$time);
  	if($status == 5){
	 	$_POST['badnum'] = False;
	 	if ($time > 99) {
	  		$_POST['badnum'] = True;
	  	}else {
	  		do {
		  		$b = 1;
		  		if((int)((string)$time) > 3 && ($len - $b) % 2 == 0){
		  			$_POST['badnum'] = True;
		  		}
		  		$b++;
			} while ($b < $len);
	  	}
	  	if(!is_numeric($time) || ($time > 15.4 && $time < 100) || $time < 1 || $time > 1600 || $_POST['badnum']){
	  		if($_POST['new'] == 5){
	  			$time = 9;
	  		}
	  		else {
	  			$time = 15;
		  	}
	  	}
	  	if($time < 100){
	  		$time = $time * 100;
	  	}
	  	if($time < 900){
	  		$time = $time + 1200;
	  	}
	  	$time = $time * 100;
	}
  // need error handling on the following query
  status_update($student,$status,'','',$time);


  $query = 'SELECT * FROM current JOIN status_data ON current.status_id = status_data.status_id WHERE student_id = '.$student;
  $current = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
  echo $current[0]['status_name'];
?>
