<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("connection.php");
//incomplete status update function
function status_update($student, $status, $old_status, $return_time)
{
	global $db;
	if($student == 'DAILY_RESET'){
		$query = 'UPDATE current SET status_id = '.$status.', return_time = '.$return_time;
		$db->query($query);
	}else{
		if($return_time != Null){
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

    	<?php
		/*
		echo "  	<head>

			    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		    	<link rel="stylesheet" type="text/css" href="style.css">
		  	</head>
			<body>
				<div class ="topbar">

				</div>";
		//updates stati if forms are submitted
		if ($_POST && !empty($_POST['change'])){
			if(empty($_POST['return_time'])){
				$_POST['return_time'] = 0;
			}
			else{
				//error handling for return times
				if ($_POST && !empty($_POST['change'])){
			status_update($_POST['student'],$_POST['new'] , $_POST['current'] , $_POST['return_time']);
		}
		//sets all students to NCI
		//querys database for main table
		$query = 'SELECT * FROM current INNER JOIN student_data ON current.student_id = student_data.student_id INNER JOIN status_data ON current.status_id = status_data.status_id ORDER BY first_name DESC';
		$stati = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
		$x = 0;
		//makes rows of the table from query results
		foreach($stati as &$row){
			$x++;
			echo '<tr><td class="name"><form id="'.$x.'" method="POST"><input type="checkbox" name="'.$x.'"></form>'.$row["first_name"].' '.$row["last_name"][0].'.</td><td class="status"><p>'.$row["status_name"];
			if($row["status_name"] == "Late"){
				echo ' @ '.$row["return_time"];
			}
			echo ' </p>';
			//adds buttons to students in table

			echo '</td></tr>';
		}
		echo '</table>';
		*/
		?>

  <head>
	<title>
  		Atendance�Sistim�100�Persent�Compleet�Perfict�耀No�Virus�Downlode�Free�Affective�end�Afficient�Profetional�Git�it�Now�Easy�Set�Up�Aply�Today�Has�Enyone�Really�Been�Far�Even�as�Descided�to�Use�Evin�Go�Wunt�to�do�Look�Mor�Like�Go�Further�You�Can�Realy�be�Far�It's�Just�Commin�Sense�Low�Price�Great�Deel�No�Charge�Limited�Time�Ofter
  	</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
	<body>
		<?php
		if ($_POST && !empty($_POST['change'])){
			status_update($_POST['student'],$_POST['new'] , $_POST['current'] , $_POST['return_time']);
		}
		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST"><input type="hidden" name="student" value="DAILY_RESET"><input type="hidden" name="return_time" value=0> <input type=hidden name=current value="0"><input type="hidden" name="new" value=0> <input type="submit" class="reset" name="change" value="Set all to \'Not checked in\'"></form>';
		?>
	<div class = "sidebar">
		admin
		<a class= "sidetext" href="/admin.php?page=hi">hi</a>
	</div>
    <div id="main-table">
      <table>
        <tr>
          <th>
            Student
          </th>
          <th>
            Status
          </th>
        </tr>
        <?php
         	$query = 'SELECT * FROM current INNER JOIN student_data ON current.student_id = student_data.student_id INNER JOIN status_data ON current.status_id = status_data.status_id ORDER BY first_name DESC';
         	$current = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
         	foreach ($current as &$row) {
            	echo '<tr class="student-row" id="'.$row["student_id"].'">';
            	echo '<td>'.$row["first_name"].' '.$row["last_name"][0].'.</td>';
            	echo '<td><span class="status">'.$row["status_name"].'</span>';
				if($row["status_name"] == "Late"){
					echo " @ ".$row["return_time"];
				}
				if($row['status_id'] != 1 ){
					echo '<input type="submit" name="1" value="P">';
  					if($row['status_id'] == 0 || $row['status_id'] == 5){
						echo '<input name="time" type="number" class="late"><input type="submit" name="5" value="L">';
  					}
  					if($row['status_id'] != 7  && $row['status_id'] != 4){
		            	echo '<input type="submit" name="7" value="A">';
  					}
  				}
  				else{
  					if($row['status_id'] != 4 ){
		            	echo '<input type="submit" name="4" value="CO">';
  					}
  				}
            	echo '</td></tr>';
          	}
        ?>
      </table>
    </div>
    <div id="result">

    </div>
    <script type="text/javascript" src="js/changeStatus.js"></script>
	</body>
</html>
