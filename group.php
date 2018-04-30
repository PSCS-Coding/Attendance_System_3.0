<!DOCTYPE html>
<html>
  <head>
    <title>Group Edit View</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php
     require_once("connection.php");
      $query = "SELECT first_name, last_name, student_id FROM student_data WHERE active = 1";
      $values = $db->query($query)->fetch_all($resulttype = MYSQLI_ASSOC);
      $foo = count($values);
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    var group = [];

    function max( array ) {
      return Math.max.apply( Math, array );
    }

    function min( array ) {
      return Math.min.apply( Math, array );
    }

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

    function otherDrop(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      document.getElementById("addback").appendChild(document.getElementById(data));
      //alert(data);
      if(confirm("Remove " + document.getElementById(data).textContent + "from this group")) {
        for (var i=max(group); i>=0; i--) {
          if (group[i] == data) {
              group.splice(i, 1);
            // break;       //<-- Uncomment  if only the first term has to be removed
        }
      }
    }
    }

    function drop(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      if (true != checkIfThere(group, document.getElementById(data))) {
        if (confirm("Add " + document.getElementById(data).textContent + " to this group")) {
          group.push(data);
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
              data:{group:group,name:group_name},
              dataType:"text",
              url:"groupUpdate.php",
              success: function(result){
                alert(result);
              }
              /*add this code when working
              getElementById("addback").appendChild(getElementsById(group));
              group = [];
              */
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
  <form method="POST">
    <input id="form" type="text" name="gname" placeholder="Group name">
  </form>
  <button type="button" onClick="sendgroupstuff()">Finish creating group</button>
  <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"><span><p id="div1">drag students here to add to group. students added to group:</p><p id="a1"></p></span></div>
  <div id="addedpeople"></div>
  <div id="drag1">
    <table>
      <th id="t1" ondrop="otherDrop(event)" ondragover="allowDrop(event)">students</th>
      <tbody id="addback" ondrop="otherDrop(event)" ondragover="allowDrop(event)">
          <?php
            for ($i=0; $i < $foo; $i++) {
                echo "<tr id='".$values[$i]['student_id']."' draggable='true' ondragstart='drag(event)'><td>".$values[$i]['first_name']." ".$values[$i]['last_name'][0]."</td></tr>";
            }
          ?>
     </tbody>
    </table>
  </div>
  </body>
</html>
