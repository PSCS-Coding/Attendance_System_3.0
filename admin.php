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
  	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<?php if($_GET['page'] != '3'){
		echo '<script type="text/javascript">
			document.onkeypress = keyPress;
			function keyPress(e){
				var x = e || window.event;
				var key = (x.keyCode || x.which);
				if(key == 13 || key == 3){
					//  myFunc1();
					document.activeElement.nextSibling.click();
				}
			}
			document.onclick = select;
			function select(){
				document.activeElement.select();
			}
		</script>';
		}
	?>
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
    	<a class= "sidetext" href="admin.php?page=7">Password</a>
		<a class= "sidetext" href="admin.php?page=8">School Hours</a>
		<a class= "sidetext" href="admin.php?page=9">Student Edit View</a>
		front end
		<a class= "sidetext" href="index.php">Front Page</a>
		<a class= "sidetext" href="statusview.php">Status View</a>
	</div>
	<div>
		<?php

			if(!empty($_POST['go'])){
				$go = explode(',',$_POST['go']);
				if(empty($_POST['student']) && !empty($go[0])){
					$_POST['student'] = (int)$go[0];
				}
				$_POST['row'] = $go[1];
				$_POST['col'] = $go[2];
			}elseif(!empty($_POST['del'])){
				$del = explode(',',$_POST['del']);
				if(empty($_POST['student']) && !empty($del[0])){
					$_POST['student'] = (int)$del[0];
				}
				$_POST['row'] = $del[1];
				$_POST['col'] = $del[2];
			}if(!empty($_POST['student'])){
				$_POST['student'] = str_replace('O','0',$_POST['student']);
			}
    		$draggeble = false;
			$goodpage = false;
			//Allotted Hours
			if((string)$_GET['page'] == "0"){
				$ident = array('veteran_year','veteran_year');
				$goodpage = True;
				$index = array('veteran_year','default_offsite','default_is');
				$database = 'allotted_hours';
				$query = 'SELECT * FROM '.$database.' ORDER BY '.$index[0].' ASC;';
			}
			//Current Events
			elseif((string)$_GET['page'] == "1"){
				$ident = array('student_id','first_name');
				$goodpage = True;
				$index = array('first_name','status_name','info','return_time');
				$database = 'current';
				$query = 'SELECT * FROM '.$database.' INNER JOIN student_data ON current.student_id = student_data.student_id INNER JOIN status_data ON current.status_id = status_data.status_id WHERE student_data.active = "1" ORDER BY first_name ASC;';
			}
			//Facilitator Edit View
			elseif((string)$_GET['page'] == "2"){
				$ident = array('facilitator_name','facilitator_name');
				$goodpage = True;
				$index = array('facilitator_name');
				$database = 'facilitators';
				$query = 'SELECT * FROM '.$database.';';
			}
			//Group Edit View
			elseif((string)$_GET['page'] == "3"){
				$goodpage = True;
		      	$index = array('group_name', 'students');
		      	$database = 'groups';
			  	$query = 'SELECT * FROM '.$database.';';
			}
			//History
			elseif((string)$_GET['page'] == "4"){
				$ident = array('student_id','first_name');
				$goodpage = True;
				$index = array('first_name','timestamp','status_name','info','return_time');
				$database = 'history';
				$students = $db->query('SELECT * FROM student_data ORDER BY first_name ASC')->fetch_all($resulttype = MYSQLI_ASSOC);
				echo '<form class="reset" method="POST"><select name="student" class="newval"> <option value="">All</option>';
				foreach($students as &$stdnt){
					echo '<option value="'.str_replace('0','O',$stdnt['student_id']).'">'.$stdnt['first_name'].' '.$stdnt['last_name'].'</option>';
				}
				echo'<input type="submit" name="go" class="submit" value="￭"></select></form>';
				$query = 'SELECT * FROM '.$database.' INNER JOIN student_data ON history.student_id = student_data.student_id INNER JOIN status_data ON history.status_id = status_data.status_id ';
				if($_POST['student'] != Null){
					$query = $query.'WHERE history.student_id = '.$_POST['student'];
				}$query = $query.' ORDER BY event_id DESC';
			}
			//Holidays
			elseif((string)$_GET['page'] == "5"){
				$ident = array('holiday_name','holiday_name');
				$goodpage = True;
				$index = array('holiday_name','holiday_date');
				$database = 'holidays';
				$query = 'SELECT * FROM '.$database.';';
			}
			//Offsite Locations
			elseif((string)$_GET['page'] == "6"){
				$ident = array('location_name','location_name');
				$goodpage = True;
				$index = array('location_name');
				$database = 'offsite_locations';
				$query = 'SELECT * FROM '.$database.';';
			}
			//Passwords
			elseif((string)$_GET['page'] == "7"){
				$ident = array('login_password','login_password');
				$goodpage = True;
				$index = array('login_password');
				$database = 'login';
				$query = 'SELECT * FROM '.$database.';';
			}
			//School Hours
			elseif((string)$_GET['page'] == "8"){
				$ident = array('start_time','start_time');
				$goodpage = True;
				$index = array('start_time','end_time');
				$database = 'globals';
				$query = 'SELECT * FROM '.$database.';';
			}
			//Student Edit View
			elseif((string)$_GET['page'] == "9"){
				$ident = array('student_id','first_name');
				$goodpage = True;
				$index = array('student_id','first_name','last_name','grad_year','veteran_year','current_offsite_hours','current_is_hours','priv','active');
				$database = 'student_data';
				$query = 'SELECT * FROM '.$database.' ORDER BY first_name ASC;';
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
								$q = 'UPDATE '.$database.' SET student_id = "'.$_POST[$_POST['go']].'" WHERE student_id = "'.$values[$_POST['col']]['student_id'].'";';
							}elseif($_POST['row'] == '1'){
								$q = 'UPDATE '.$database.' SET status_id = "'.$_POST[$_POST['go']].'" WHERE student_id = "'.$values[$_POST['col']]['student_id'].'";';
							}else{
								$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.$_POST[$_POST['go']].'" WHERE student_id = "'.$values[$_POST['col']]['student_id'].'";';
							}
						}elseif((string)$_GET['page'] == "4"){
							if($_POST['row'] == '0'){
								$q = 'UPDATE '.$database.' SET student_id = "'.$_POST[$_POST['go']].'" WHERE event_id = '.$values[$_POST['col']]['event_id'].';';
							}elseif($_POST['row'] == '2'){
								$q = 'UPDATE '.$database.' SET status_id = "'.$_POST[$_POST['go']].'" WHERE event_id = '.$values[$_POST['col']]['event_id'].';';
							}else{
								$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.$_POST[$_POST['go']].'" WHERE event_id = '.$values[$_POST['col']]['event_id'].';';
							}
						}elseif((string)$_GET['page'] == "8"){
							$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.$_POST[$_POST['go']].'"';
						}elseif((string)$_GET['page'] == "5"){
							$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.$_POST[$_POST['go']].'" WHERE holiday_id = '.$values[$_POST['col']]['holiday_id'].';';
						}elseif((string)$_GET['page'] == "6"){
							$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.$_POST[$_POST['go']].'" WHERE location_id = '.$values[$_POST['col']]['location_id'].';';
						}elseif($index[$_POST['row']] == 'login_password'){
							$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.crypt($_POST[$_POST['go']], 'P9').'" WHERE `login_password` = "'.$values[$_POST['col']]['login_password'].'";';
						}elseif((string)$_GET['page'] == "9"){
							$q = 'UPDATE '.$database.' SET '.$index[$_POST['row'] + 1].' = "'.$_POST[$_POST['go']].'" WHERE '.$index[0].' = '.$values[$_POST['col']][$index[0]].';';
						}else{
							$q = 'UPDATE '.$database.' SET '.$index[$_POST['row']].' = "'.$_POST[$_POST['go']].'" WHERE '.$index[0].' = "'.$values[$_POST['col']][$index[0]].'";';
						}
						$db->query($q);
					}elseif($_POST['add'] && !empty($_POST[$ident[1]])){
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
						}if((string)$_GET['page'] != "9"){
							$id = str_replace('first_name','student_id',str_replace('status_name','status_id',$id));
						}
						$q = 'INSERT INTO '.$database.' ('.$id.') VALUES ('.$v.')';
						$db->query($q);
						if((string)$_GET['page'] == "9"){
							$values = $db->query('SELECT * FROM '.$database.';')->fetch_all($resulttype = MYSQLI_ASSOC);
							$q = 'INSERT INTO current (student_id,status_id) VALUES ("'.$values[count($values)-1]['student_id'].'", "0")';
							echo $q;
							$db->query($q);
						}
						$values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
					}
					elseif($_POST['del']){
						foreach($values as &$column){
							if(!empty($_POST[str_replace(' ','_',$column[$ident[0]])])){
								if((string)$_GET['page'] == "5"){
									$rem = 'DELETE FROM holidays WHERE holiday_id = "'.$column['holiday_id'].'"';
								}elseif((string)$_GET['page'] == "4"){
									$rem = 'DELETE FROM history WHERE event_id = "'.$column['event_id'].'"';
								}elseif((string)$_GET['page'] == "2"){
									$rem = 'DELETE FROM facilitators WHERE facilitator_id = "'.$column['facilitator_id'].'"';
								}elseif((string)$_GET['page'] == "1"){
									$rem = 'DELETE FROM current WHERE student_id = "'.$column['student_id'].'"';
								}elseif((string)$_GET['page'] == "6"){
									$rem = 'DELETE FROM offsite_locations WHERE location_id = "'.$column['location_id'].'"';
								}else{
									$rem = 'DELETE FROM '.$database.' WHERE '.$ident[0].' = "'.$column[$ident[0]].'"';
								}
								$db->query($rem.' LIMIT 1');
								$_POST[str_replace(' ','_',$column[$ident[0]])] = Null;
							}
						}
					}elseif(!empty($_POST['stus'])){
						$_POST['group'] = str_replace('0','Ø', str_replace(' ', "_", str_replace(".", '_', $_POST['group'])));
						if(!empty($db->query('SELECT group_name FROM groups WHERE group_name = "'.$_POST['group'].'" LIMIT 1')->fetch_assoc()['group_name'])){
							foreach($values as &$group){
								if($group['group_name'] == $_POST['group']){
									$gp = explode(',',$group['students']);
									foreach($_POST['stus'] as &$news){
										foreach($gp as $id => &$old){
											if($old == $news){
												$gp[$id] = '';
												break;
											}
										}
									}
									$group['students'] = trim(str_replace(',,',',',implode(',', $gp)), ',');
									if(!empty($group['students']) && !empty($_POST['stus'])){
										$group['students'] = $group['students'].',';
									}
									$db->query('UPDATE groups SET students = "'.$group['students'].implode(',', $_POST['stus']).'" WHERE group_name = "'.$_POST['group'].'";');
									break;
								}
							}
						}elseif(!empty($_POST['group'])){
							$db->query('INSERT INTO groups (`group_name`, `students`) VALUES( "'.mb_substr($_POST['group'], 0, 75).'", "'.implode($_POST['stus'], ',').'");');
						}
					}
					$values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
				}
				if($_GET['page'] != '3'){
					echo '<table class="table"><tr>';
					if($_GET['page'] != '8' && $_GET['page'] != '1' && $_GET['page'] != '7'){
						echo'<th class="del">Del.</th>';
					}
					if($_GET['page'] == '9'){
						array_shift($index);
					}
					foreach($index as &$header){
						echo '<th class="admin">'.ucwords(str_replace('_', ' ',$header)).'</th>';
					}
					echo'<form method="POST">';
					if($_GET['page'] != '8' && $_GET['page'] != '1' && $_GET['page'] != '7'){
						echo '<tr><td class="del admin color"><input value="X" name="del" type="submit"></td>';
						foreach($index as $row => &$oi){
							if($row > 0){
								echo'</td>';
							}
							if($_GET['page'] != 9 && $oi == 'first_name'){
								$statorstu = $db->query('SELECT * FROM student_data ORDER BY first_name ASC')->fetch_all($resulttype = MYSQLI_ASSOC);;
								echo '<td class="admin color"><select name="'.$oi.'" class="newval">';
								foreach($statorstu as $v){
									echo '<option value="'.$v['student_id'].'" class="newval">'.$v[$oi].' '.$v['last_name'].'</option>';
								}
							}elseif($oi == 'status_name'){
								$statorstu = $db->query('SELECT * FROM status_data ORDER BY status_name ASC')->fetch_all($resulttype = MYSQLI_ASSOC);
								echo '<td class="admin color"><select name="'.$oi.'" class="newval">';
								foreach($statorstu as $v){
									echo '<option value="'.$v['status_id'].'" class="newval">'.$v[$oi].'</option>';
								}
							}else{
								echo '<td class="admin color"><input type="text" name="'.$oi.'" class="newval" value="'.$values[0][$oi].'">';
							}
						}
						echo '<button name="add" class="submit" type="submit" value="'.$_POST['student'].','.$row.','.$col.'">+</button></td></tr>';
					}
				
				}else{
					echo '</tr><div	class="groups">';
				}
				foreach($values as $col => &$value){
					if((string)$_GET['page'] == "3"){
						$_POST[$value['group_name']] = $_POST[str_replace(' ', "_", $value['group_name'])];
						if(!empty($_POST[$value['group_name']])){
							$group = $db->query('SELECT students FROM groups WHERE group_name = "'.$value['group_name'].'"')->fetch_assoc()['students'];
							foreach($_POST[$value['group_name']] as &$rem){
								$group = str_replace($rem, "", $group);
								$group = trim(str_replace(',,', ",", $group), ',');
							}
							if(!empty($group)){
								$db->query('UPDATE groups SET students = "'.$group.'" WHERE group_name = "'.$value['group_name'].'"');
							}else{
								$db->query('DELETE FROM groups WHERE group_name = "'.$value['group_name'].'"');
							}
							$value = $db->query('SELECT * FROM groups WHERE group_name = "'.$value['group_name'].'"')->fetch_assoc();
						}
						$grp = explode(",",$value[$index[1]]);
						if($value[$index[1]] != Null){
							echo '<table class="table thin"><tr><form method="POST"><th class="admin thin"><input type="checkbox" name="'.$value['group_name'].'[]" value="'.$value[$index[1]].'"></th><th class="admin thin">'.str_replace('_', ' ', $value['group_name']).'</th></tr>';
							foreach($grp as &$stu){
								$student = $db->query('SELECT first_name,last_name FROM student_data WHERE `active` = 1 AND student_id = "'.$stu.'"')->fetch_assoc();
								echo '<tr><td class="admin thin"><input type="checkbox" name="'.$value['group_name'].'[]" value="'.$stu.'"></td><td class="admin thin">'.$student['first_name'].' '.$student['last_name'].'</td></tr>';
							}
							echo '<tr><td class="admin thin"><input value="X" name="lete" type="submit"></td><td class="admin thin"> </td></tr></form></table>';

						}
					}
					else{
						echo '<tr>';
						if($_GET['page'] != '8' && $_GET['page'] != '1' && $_GET['page'] != '7'){
							echo'<td class="del admin"><input name="'.$value[$ident[0]].'" type="checkbox"></td>';
						}foreach($index as $row => &$oi){
							if($oi == 'first_name' && $_GET['page'] != '9'){
								if($_GET['page'] != "1"){
									$statorstu = $db->query('SELECT * FROM student_data ORDER BY first_name ASC')->fetch_all($resulttype = MYSQLI_ASSOC);;
									echo '<td class="admin"><select name="'.$_POST['student'].','.$row.','.$col.'" class="newval"> <option value="'.$value['student_id'].'">'.$value[$oi].' '.$value['last_name'].'</option>';
									foreach($statorstu as $v){
										if($v[$oi] != $value[$oi]){
											echo '<option value="'.$v['student_id'].'" class="newval">'.$v[$oi].' '.$v['last_name'].'</option>';
										}
									}
									echo '</select><button name="go" class="submit" type="submit" value="'.$_POST['student'].','.$row.','.$col.'">￭</button></td>';
	
								}elseif($_GET['page'] == 1){
									echo '<td class="admin">'.$value[$oi].' '.$value['last_name'].'</td>';
								}
							}elseif($oi == 'status_name'){
								$statorstu = $db->query('SELECT * FROM status_data ORDER BY status_name ASC')->fetch_all($resulttype = MYSQLI_ASSOC);
								echo '<td class="admin"><select name="'.$_POST['student'].','.$row.','.$col.'" class="newval"> <option value="'.$value['status_id'].'">'.$value[$oi].'</option>';
								foreach($statorstu as $v){
									if($v[$oi] != $value[$oi]){
										echo '<option value="'.$v['status_id'].'" class="newval">'.$v[$oi].'</option>';
									}
								}
								echo '</select><button name="go" class="submit" type="submit" value="'.$_POST['student'].','.$row.','.$col.'">￭</button></td>';
							}else{
								echo '<td class="admin"><input type="text" name="'.$_POST['student'].','.$row.','.$col.'" class="newval" value="'.$value[$oi].'"><button name="go" class="submit" type="submit" value="'.$_POST['student'].','.$row.','.$col.'">￭</button></td>';
							}
						}
						echo '</tr>';
					}
				}if($_GET['page'] != 3){
					echo '</form></table>';
				}
				else{
					$student = $db->query('SELECT student_id,first_name,last_name FROM student_data WHERE active = "1" ORDER BY first_name ASC')->fetch_all($resulttype = MYSQLI_ASSOC);
					echo '</div><form method="POST"><table class="block"><tr><th>Add</th><th>Student</th></tr>';
					foreach($student as &$stu){
						echo '<tr><td><input type="checkbox" name="stus[]" value="'.$stu['student_id'].'"></td><td>'.$stu['first_name'].' '.$stu['last_name'].'</td></tr>';
					}
					$groups = $db->query('SELECT group_name FROM groups ORDER BY group_name ASC')->fetch_all($resulttype = MYSQLI_ASSOC);
					$grpDD = '<input name="group" type="text" list="group" maxlength="75" placeholder="Group Name" class="newval"><datalist id="group" name="group" value="nwgrp">';
					foreach($groups as &$gn){
						$grpDD = $grpDD.'<option value="'.$gn['group_name'].'">'.str_replace('_',' ', $gn['group_name']).'</option>';
					}
					echo '<tr><td>'.$grpDD.'</datalist><input value="+" type="submit"></td><td></td></tr></form></table>';

				}
			}
		 ?>
	</div>
</body>
</html>
