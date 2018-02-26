<?php
session_start();
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("connection.php");
function status_update($student, $status, $old_status, $return_time)
{
	global $db;
	if($student == 'DAILY_RESET'){
		$query = 'UPDATE current SET status_id = '.$status.', return_time = '.$return_time;
		$db->query($query);
	}else{
		if($return_time!= Null){
			$query = 'UPDATE current SET status_id = '.$status.', return_time = '.$return_time.' WHERE student_id = '.$student;
			$db->query($query);
		}else{
			$query = 'UPDATE current SET status_id = '.$status.' WHERE student_id = '.$student;
			$db->query($query);
		}
	}
    return 0;
}
function enquote($text){
	return '"'.$text.'"';
}
?>
<!DOCTYPE html>
<html>
  	<head>
    	<title>
			Atendance�Sistim�100�Persent�Compleet�Perfict�No�Virus�Downlode�Free�Affective�end�Afficient�Profetional�Git�it�Now�Easy�Set�Up�Aply�Today�Has�Enyone�Really�Been�Far�Even�as�Descided�to�Use�Evin�Go�Wunt�to�do�Look�Mor�Like�Go�Further�You�Can�Realy�be�Far�It's�Just�Commin�Sense�Low�Price�Great�Deel�No�Charge�Limited�Time�Ofter
    	</title>
	    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    	<link rel="stylesheet" type="text/css" href="style.css">
  	</head>
	<body>
		<div class ="topbar">
			<?php

			 ?>
		</div>
    	<?php
		if ($_POST && $_POST['change']){
			if(empty($_POST['return_time'])){
				$_POST['return_time'] = 0;
			}
			else{
				if(!is_numeric($_POST['return_time']) || ($_POST['return_time'] > 15.6667 && $_POST['return_time'] < 100) || $_POST['return_time'] < 0){
					$_POST['return_time'] = 15;
				}
				if($_POST['return_time'] < 100){
					$_POST['return_time'] = $_POST['return_time'] * 100;
				}
				if($_POST['return_time'] < 900){
					$_POST['return_time'] = $_POST['return_time'] + 1200;
				}
				$_POST['return_time'] = $_POST['return_time'] * 100;
			}
			status_update($_POST['student'],$_POST['new'] , $_POST['current'] , $_POST['return_time']);
		}
		echo '<form action="/index.php" method="POST"><input type="hidden" name="student" value="DAILY_RESET"><input type="hidden" name="return_time" value=0> <input type=hidden name=current value="0"><input type="hidden" name="new" value=0> <input type="submit" name="change" value="Set all to \'Not checked in\'"></form> <table><tr><th>Student</th><th>Status</th></tr>';
		$query = 'SELECT * FROM current INNER JOIN student_data ON current.student_id = student_data.student_id INNER JOIN status_data ON current.status_id = status_data.status_id ORDER BY first_name DESC';
		$stati = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
		foreach($stati as &$row){
			echo '<tr><td>'.$row["first_name"].'check"></form>'.$row["first_name"].' '.$row["last_name"][0].'.</td><td class="status"><p>'.$row["status_name"].' </p>';
			//echo $_POST["samuelcheck"];
			if($row['status_id'] != 1 ){
				echo '<form action="/index.php" method="POST"> <input type="hidden" name="student" value="'.$row["student_id"].'"> <input type=hidden name=current value="'.$row["status_id"].'"><input type="hidden" name="new" value=1> <input type="submit" name="change" value="P"></form>';
				if($row['status_id'] == 0 || $row['status_id'] == 5){
					echo '<form action="/index.php" method="POST"> <input type="hidden" name="student" value="'.$row["student_id"].'"> <input type=hidden name=current value="'.$row["status_id"].'"><input type="hidden" name="new" value=5> <input class="late" type="number" name="return_time" required placeholder="Time"> <input type="submit" name="change" value="L"></form>';
				}
				if($row['status_id'] != 7  && $row['status_id'] != 4){
					echo '<form action="/index.php" method="POST"> <input type="hidden" name="student" value="'.$row["student_id"].'"> <input type=hidden name=current value="'.$row["status_id"].'"><input type="hidden" name="new" value=7> <input type="submit" name="change" value="A"></form>';
				}
			}
			else{
				if($row['status_id'] != 4 ){
					echo '<form action="/index.php" method="POST"> <input type="hidden" name="student" value="'.$row["student_id"].'"> <input type=hidden name=current value="'.$row["status_id"].'"><input type="hidden" name="new" value=4> <input type="submit" name="change" value="CO"></form>';
				}
			}
			echo '</td></tr>';
		}
		echo '</table>';
		?>
	</body>
</html>
