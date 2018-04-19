<!DOCTYPE html>
<html>
  <head>
    <title>Group Edit View</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php
     require_once("connection.php");
      $query = "SELECT first_name, last_name FROM student_data WHERE active = 1";
      $values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
      $foo = count($values);
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    var group = [];

    function submitform() {
      document.getElementById("form").submit();
    }

    function checkIfThere(arr, val) {
      return arr.some(function(arrVal) {
        return val === arrVal;
      });
    }

    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      for (var i = 0; i < group.length; i++) {
        var x = group[i];
      }
      if (true != checkIfThere(group, document.getElementById(data).textContent)) {
        if (confirm("Add " + document.getElementById(data).textContent + " to this group")) {
          group.push(document.getElementById(data).textContent);
          ev.target.appendChild(document.getElementById(data));
        }
      } else {
        alert(document.getElementById(data).textContent + " is already in this group");
      }
    }
    function sendgroupstuff() {
      var group_name = document.getElementById("form").value;
       if(group.length != 0) {
         if (group_name.length != 0) {
           $.ajax({
              type:"POST",
              data:{group,name:group_name},
              dataType:"text",
              url:"groupUpdate.php",
              success: alert("Group successfuly added")
           });
         }else {
           alert("Name the group first");
         }
      }else {
        alert("Add people to group first");
      }
    }
  </script>
  <div class = "sidebar">
  admin
  <a class= "sidetext" href="/admin.php?page=0">Allotted Hours</a>
  <a class= "sidetext" href="/admin.php?page=1">Current Events</a>
  <a class= "sidetext" href="/admin.php?page=2">Facilitator Edit View</a>
  <a class= "sidetext" href="/admin.php?page=3">Group Edit View</a>
  <a class= "sidetext" href="/admin.php?page=4">History</a>
  <a class= "sidetext" href="/admin.php?page=5">Holidays</a>
  <a class= "sidetext" href="/admin.php?page=6">Offsite Locations</a>
  <a class= "sidetext" href="/admin.php?page=7">Passwords</a>
  <a class= "sidetext" href="/admin.php?page=8">School Hours</a>
  <a class= "sidetext" href="/admin.php?page=9">Student Edit View</a>
  front end
  <a class= "sidetext" href="/index.php">Front Page</a>
  </div>
  <form type="POST">
    <input id="form" type="text" name="gname" placeholder="Group name">
  </form>
  <button type="button" onClick="sendgroupstuff()">Finish creating group</button>
  <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"><span><p id="div1">drag students here to add to group. students added to group:</p><p id="a1"></p></span></div>
  <div id="addedpeople"></div>
  <div id="drag1">
    <table>
      <tbody>
        <th id="t1">students</th>
        <?php
          for ($i=0; $i < $foo; $i++) {
            $x = $i;
            if($i == 1) {
              $x++;
            }
              echo "<tr id='".$i."' draggable='true' ondragstart='drag(event)'><td id='".$i."'>".$values[$i]['first_name']." ".$values[$i]['last_name'][0]."</td></tr>";
          }
         ?>
     </tbody>
    </table>
  </div>
  </body>
</html>
