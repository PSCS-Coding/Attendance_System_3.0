<?php
require_once("connection.php");
?>
<!DOCTYPE html>

<html>
<head>
  <title>
	  Atendance�Sistim�100�Persent�Compleet�Perfict�No�Virus�Downlode�Free�Affective�end�Afficient�Profetional�Git�it�Now�Easy�Set�Up�Aply�Today�Has�Enyone�Really�Been�Far�Even�as�Descided�to�Use�Evin�Go�Wunt�to�do�Look�Mor�Like�Go�Further�You�Can�Realy�be�Far�It's�Just�Commin�Sense�Low�Price�Great�Deel�No�Charge�Limited�Time�Ofter
  </title>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div class = "sidebar back">
	admin
	<a class= "sidetext" href="/admin.php?page=0">Allotted Hours</a>
	<a class= "sidetext" href="/admin.php?page=1">Current Events</a>
	<a class= "sidetext" href="/admin.php?page=2">Facilitator Edit View</a>
	</div>
	<div>
		<?php
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
		}
		//History
		elseif((string)$_GET['page'] == "4"){
			$goodpage = True;
		}
		//Holidays
		elseif((string)$_GET['page'] == "5"){
			$goodpage = True;
		}
		//Offsite Locations
		elseif((string)$_GET['page'] == "6"){
			$goodpage = True;
		}
		//Passwords
		elseif((string)$_GET['page'] == "7"){
			$goodpage = True;
		}
		//School Hours
		elseif((string)$_GET['page'] == "8"){
			$goodpage = True;
		}
		//Student Edit View
		elseif((string)$_GET['page'] == "9"){
			$goodpage = True;
		}
		else{
			echo "<h1>Bad URL!</h1>";
		}if($goodpage){
			$query = 'SELECT * FROM '.$database.';';
			echo '<table><tr>';
			foreach($index as &$header){
				echo '<th>'.str_replace('_', ' ',$header).'</th>';
			}
			$values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
			if(!empty($_POST)&&$_POST['go']){
				$db->query('UPDATE '.$database.' SET '.$index[$_POST['row']].' = '.$_POST['new'].' WHERE '.$index[0].' = '.$values[$_POST['col']][$index[0]]);
				$values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
			}
			echo '</tr>';
			foreach($values as $col => &$value){
				echo '<tr>';
				echo '<td class="admin">'.$value[$index[0]].'</td>';
				foreach($index as $row => &$oi){
					if($row != 0){
						echo '<td class="admin"><form method="POST"><input type="text" name="new" placeholder="'.$value[$oi].'"><input type="hidden" name="row" value="'.$row.'"><input type="hidden" name="col" value="'.$col.'"><input type="submit" name="go" value="✔️"></form></td>';
					}
				}
				echo '</tr>';
			}
			echo '</table>';
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