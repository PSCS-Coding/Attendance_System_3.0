
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
			}
			//Current Events
			elseif((string)$_GET['page'] == "1"){
				$goodpage = True;
				$index = array('student_id','status_id','info','return_time');
				$database = 'current';
			}
			//Facilitator Edit View
			elseif((string)$_GET['page'] == "2"){
				$goodpage = True;
				$index = array('facilitator_id','facilitator_name');
				$database = 'facilitators';
			}
			//Group Edit View
			elseif((string)$_GET['page'] == "3"){
				$goodpage = True;
	      		$index = array('first_name','last_name');
	      		$database = 'student_data';
	      		echo '<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"> <p>add to group</p> </div>';
	      		$draggeble = True;
			}
			//History
			elseif((string)$_GET['page'] == "4"){
				$goodpage = True;
				$index = array('event_id','student_id','timestamp','status_id','info','return_time','offsite_hrs_used');
				$database = 'history';
			}
			//Holidays
			elseif((string)$_GET['page'] == "5"){
				$goodpage = True;
				$index = array('holiday_id','holiday_name','holiday_date');
				$database = 'holidays';
			}
			//Offsite Locations
			elseif((string)$_GET['page'] == "6"){
				$goodpage = True;
				$index = array('location_id','location_name');
				$database = 'offsite_locations';
			}
			//Passwords
			elseif((string)$_GET['page'] == "7"){
				$goodpage = True;
				$index = array('login_year','login_password');
				$database = 'login';
			}
			//School Hours
			elseif((string)$_GET['page'] == "8"){
				$goodpage = True;
				$index = array('start_time','end_time');
				$database = 'globals';
			}
			//Student Edit View
			elseif((string)$_GET['page'] == "9"){
				$goodpage = True;
				$index = array('student_id','first_name','last_name','imgurl','grad_year','veteran_year','current_offsite_hours','current_is_hours','priv','user_id','active');
				$database = 'student_data';
			}
			else{
				echo "<h1>Bad URL!</h1>";
			}if($goodpage){
				$query = 'SELECT * FROM '.$database.';';
				$values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
				if(!empty($_POST)){
					if($_POST['go']){
						$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.$_POST['new'].'" WHERE '.$index[0].' = '.$values[$_POST['col']][$index[0]].';';
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
						foreach($index as $row => &$oi){
			            	if ($draggeble == False) {
			  				}else {
			              		echo '<td class="admin">'.$value[$index[1]].'</td>';
			              		echo "</tr>";
			            	}
		          		}
						echo '<tr>';
						if((string)$_GET['page'] != "8"){
							echo '<td class="admin">'.$value[$index[0]].'</td>';
							foreach($index as $row => &$oi){
								if($row != 0){
									echo '<td class="admin"><form method="POST"><input type="text" name="new" class="newval" placeholder="'.$value[$oi].'"><input type="hidden" name="row" value="'.$row.'"><input type="hidden" name="col" value="'.$col.'"><input type="submit" name="go" class="submit" value="￭"></form></td>';
								}
							}
						}else{
							foreach($index as $row => &$oi){
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
  <script>
    function drag(ev) {
      ev.dataTransfer.setData("text", ev.target.id);
    }
    function drop(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      ev.target.appendChild(document.getElementById(data));
    }
    function allowDrop(ev) {
      ev.preventDefault();
    }
  </script>
</body>
</html>
