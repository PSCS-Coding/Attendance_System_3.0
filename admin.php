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
	<div>
		<?php
		$goodpage = false;
		//Allotted Hours
		if((string)$_GET['page'] == "0"){
			$goodpage = True;
			$index = array('veteran_year','default_offsite','default_is');
			$query = 'SELECT * FROM allotted_hours;';
		}
		//Current Events
		elseif((string)$_GET['page'] == "1"){
			$goodpage = True;
		}
		//Facilitator Edit View
		elseif((string)$_GET['page'] == "2"){
			$goodpage = True;
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
			echo '<table><tr>';
			foreach($index as &$header){
				echo '<th>'.str_replace('_', ' ',$header).'</th>';
			}
			$values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
			echo '</tr>';
			print_r($values);
			foreach($values as &$value){
				echo '<tr>';
				foreach($index as &$oi){
					echo '<td>'.$value[$oi].'<td>';
				}
				echo '</tr>';
			}
			echo '</table>';
		}
		 ?>
	</div>
</body>
</html>
