<?php
require_once("connection.php");
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
  	<title>
	  Atendance�Sistim�100�Persent�Compleet�Perfict�No�Virus�Downlode�Free�Affective�end�Afficient�Profetional�Git�it�Now�Easy�Set�Up�Aply�Today�Has�Enyone�Really�Been�Far�Even�as�Descided�to�Use�Evin�Go�Wunt�to�do�Look�Mor�Like�Go�Further�You�Can�Realy�be�Far�It's�Just�Commin�Sense�Low�Price�Great�Deel�No�Charge�Limited�Time�Ofter
  	</title>
  	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="style.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body class="back">
	<div class = "sidebar">
		admin
		<a class= "sidetext" href="admin.php?page=0">Allotted Hours</a>
		<a class= "sidetext" href="admin.php?page=1">Current Events</a>
		<a class= "sidetext" href="admin.php?page=2">Facilitator Edit View</a>
		<a class= "sidetext" href="admin.php?page=3">Group Edit View</a>
		<a class= "sidetext" href="admin.php?page=4">History</a>
		<a class= "sidetext" href="admin.php?page=5">Holidays</a>
		<a class= "sidetext" href="admin.php?page=6">Offsite Locations</a>
		<a class= "sidetext" href="admin.php?page=7">Passwords</a>
		<a class= "sidetext" href="admin.php?page=8">School Hours</a>
		<a class= "sidetext" href="admin.php?page=9">Student Edit View</a>
		front end
		<a class= "sidetext" href="index.php">Front Page</a>
	</div>
	<div>
		<?php
    		$draggeble = false;
			$goodpage = false;
			//Allotted Hours
			if((string)$_GET['page'] == "0"){
				$goodpage = True;
				$index = array('veteran_year','default_offsite','default_is');
				$database = 'allotted_hours';
				$query = 'SELECT * FROM '.$database.';';
			}
			//Current Events
			elseif((string)$_GET['page'] == "1"){
				$goodpage = True;
				$index = array('first_name','status_name','info','return_time');
				$database = 'current';
				$query = 'SELECT * FROM '.$database.' INNER JOIN student_data ON current.student_id = student_data.student_id INNER JOIN status_data ON current.status_id = status_data.status_id ORDER BY first_name ASC;';
			}
			//Facilitator Edit View
			elseif((string)$_GET['page'] == "2"){
				$goodpage = True;
				$index = array('facilitator_name');
				$database = 'facilitators';
				$query = 'SELECT * FROM '.$database.';';
			}
			//Group Edit View
			elseif((string)$_GET['page'] == "3"){
				$goodpage = True;
		      $index = array('group_name','students');
		      $database = 'groups';
		      echo '<a class="glink" href="groups.html">Edit groups</a>';
			  $query = 'SELECT * FROM '.$database.';';
			}
			//History
			elseif((string)$_GET['page'] == "4"){
				$goodpage = True;
				$index = array('first_name','timestamp','status_name','info','return_time');
				$database = 'history';
				$students = $db->query('SELECT * FROM student_data ORDER BY first_name ASC')->fetch_all($resulttype = MYSQLI_ASSOC);
				echo '<form class="reset" method="POST"><select name="student" class="newval"> <option value="">All</option>';
				foreach($students as &$stdnt){
					echo '<option value="'.$stdnt['student_id'].'">'.$stdnt['first_name'].'</option>';
				}
				echo'<input type="submit" name="go" class="submit" value="￭"></select></form>';
				$query = 'SELECT * FROM '.$database.' INNER JOIN student_data ON history.student_id = student_data.student_id INNER JOIN status_data ON history.status_id = status_data.status_id ';
				if($_POST['student'] != Null){
					$query = $query.'WHERE history.student_id = '.$_POST['student'];
				}$query = $query.' ORDER BY event_id DESC';
			}
			//Holidays
			elseif((string)$_GET['page'] == "5"){
				$goodpage = True;
				$index = array('holiday_name','holiday_date');
				$database = 'holidays';
				$query = 'SELECT * FROM '.$database.';';
			}
			//Offsite Locations
			elseif((string)$_GET['page'] == "6"){
				$goodpage = True;
				$index = array('location_name');
				$database = 'offsite_locations';
				$query = 'SELECT * FROM '.$database.';';
			}
			//Passwords
			elseif((string)$_GET['page'] == "7"){
				$goodpage = True;
				$index = array('login_year','login_password');
				$database = 'login';
				$query = 'SELECT * FROM '.$database.';';
			}
			//School Hours
			elseif((string)$_GET['page'] == "8"){
				$goodpage = True;
				$index = array('start_time','end_time');
				$database = 'globals';
				$query = 'SELECT * FROM '.$database.';';
			}
			//Student Edit View
			elseif((string)$_GET['page'] == "9"){
				$goodpage = True;
				$index = array('student_id','first_name','last_name','grad_year','veteran_year','current_offsite_hours','current_is_hours','priv','user_id','active');
				$database = 'student_data';
				$query = 'SELECT * FROM '.$database.';';
			}
			else{
				echo "<h1>Bad URL!</h1>";
			}
			if($goodpage){
				$values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
				if(!empty($_POST)){
					if($_POST['go']){
						if((string)$_GET['page'] == "1"){
							if($_POST['row'] == '0'){
								$q = 'UPDATE '.$database.' SET student_id = "'.$_POST['new'].'" WHERE student_id = '.$values[$_POST['col']]['student_id'].';';
							}elseif($_POST['row'] == '1'){
								$q = 'UPDATE '.$database.' SET status_id = "'.$_POST['new'].'" WHERE student_id = '.$values[$_POST['col']]['student_id'].';';
							}else{
								$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.$_POST['new'].'" WHERE event_id = '.$values[$_POST['col']]['event_id'].';';
							}
						}elseif((string)$_GET['page'] == "4"){
							if($_POST['row'] == '0'){
								$q = 'UPDATE '.$database.' SET student_id = "'.$_POST['new'].'" WHERE event_id = '.$values[$_POST['col']]['event_id'].';';
							}elseif($_POST['row'] == '2'){
								$q = 'UPDATE '.$database.' SET status_id = "'.$_POST['new'].'" WHERE event_id = '.$values[$_POST['col']]['event_id'].';';
							}else{
								$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.$_POST['new'].'" WHERE event_id = '.$values[$_POST['col']]['event_id'].';';
							}
						}else{
							$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.$_POST['new'].'" WHERE '.$index[0].' = '.$values[$_POST['col']][$index[0]].';';
						}
						$db->query($q);
					}elseif($_POST['add']){
						$id = "";
						$v = "";
						foreach($index as $i => &$es){
							if($id != ""){
								if(!empty($_POST[$es])){
									$id = $id.', '.$es;
									$v = $v.', "'.$_POST[$es].'"';
								}
							}else{
								if(!empty($_POST[$es])){
									$id = $es;
									$v = '"'.$_POST[$es].'"';
								}
							}
						}
						$q = 'INSERT INTO '.$database.' ('.$id.') VALUES ('.$v.')';
						$db->query($q);
						$values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
						if((string)$_GET['page'] == "9"){
							$q = 'INSERT INTO current (student_id,status_id) VALUES ("'.$values[count($values)-1][$index[0]].'", 0)';
							$db->query($q);
						}
					}
					elseif($_POST['del']){
						foreach($values as &$column){
							if($_POST[$column[$index[0]]] == true){
								$db->query('DELETE FROM '.$database.' WHERE '.$index[0].' = "'.$column[$index[0]].'"');
							}
						}
					}
					$values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
				}
				if($_GET['page'] != '3'){
					echo '<div class="del"><form method="POST"><table><tr><th class="admin">Del.</th></tr>';
					foreach($values as &$o){
						echo '<tr><td class="admin"><input name="'.$o[$index[0]].'" type="checkbox"></td></tr>';
					}
					echo '<tr><td class="admin"><input value="X" name="del" type="submit"></td></tr></table></form></div>';
				}
				echo '<table class="table"><tr>';
				foreach($index as &$header){
					echo '<th class="admin">'.str_replace('_', ' ',$header).'</th>';
				}
				echo '</tr>';
				foreach($values as $col => &$value){
					if((string)$_GET['page'] == "3"){
						foreach($index as $row => &$oi){
			            	if ($draggeble == False) {
								echo '<td class="admin"><form method="POST"><input type="text" name="new" class="newval" value="'.$value[$oi].'"><input type="hidden" name="row" value="'.$row.'"><input type="hidden" name="col" value="'.$col.'"><input type="submit" name="go" class="submit" value="￭"></form></td>';
			  				}else {
			              		echo '<td class="admin">'.$value[$oi].'</td>';
			            	}
		          		}
						echo "</tr>";
					}
					else{
						echo '<tr>';
						foreach($index as $row => &$oi){
							if($oi == 'first_name'){
								$statorstu = $db->query('SELECT * FROM student_data ORDER BY first_name ASC')->fetch_all($resulttype = MYSQLI_ASSOC);;
								echo '<td class="admin"><form method="POST"><select name="new" class="newval"> <option value="'.$value[$oi].'">'.$value[$oi].'</option>';
								foreach($statorstu as $v){
									if($v[$oi] != $value[$oi]){
										echo '<option value="'.$v['student_id'].'" class="newval">'.$v[$oi].'</option>';
									}
								}
								echo '</select><input type="hidden" name="row" value="'.$row.'"><input type="hidden" name="col" value="'.$col.'"><input type="submit" name="go" class="submit" value="￭"></form></td>';
							}elseif($oi == 'status_name'){
								$statorstu = $db->query('SELECT * FROM status_data ORDER BY status_name ASC')->fetch_all($resulttype = MYSQLI_ASSOC);;
								echo '<td class="admin"><form method="POST"><select name="new" class="newval"> <option value="'.$value[$oi].'">'.$value[$oi].'</option>';
								foreach($statorstu as $v){
									if($v[$oi] != $value[$oi]){
										echo '<option value="'.$v['status_id'].'" class="newval">'.$v[$oi].'</option>';
									}
								}
								echo '</select><input type="hidden" name="row" value="'.$row.'"><input type="hidden" name="col" value="'.$col.'"><input type="submit" name="go" class="submit" value="￭"></form></td>';
							}else{
								echo '<td class="admin"><form method="POST"><input type="text" name="new" class="newval" placeholder="'.$value[$oi].'"><input type="hidden" name="row" value="'.$row.'"><input type="hidden" name="col" value="'.$col.'"><input type="submit" name="go" class="submit" value="￭"></form></td>';
							}
						}
						echo '</tr>';
					}
				}
				echo '<form method="POST">';
				foreach($index as $row => &$oi){
					if($row > 0){
						echo'</td>';
					}
					echo '<td class="admin"><input type="text" name="'.$oi.'" class="newval" placeholder="'.$value[$oi].'"><input type="hidden" name="row" value="'.$row.'"><input type="hidden" name="col" value="'.$col.'">';
				}
				echo '<input type="submit" name="add" class="submit" value="￭"></td></form></table>';
			}
		 ?>
	</div>
</body>
</html>
