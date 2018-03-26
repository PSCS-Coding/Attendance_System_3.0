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
    ?>
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
    <script>
      function allowDrop(ev) {
          ev.preventDefault();
      }

      function drag(ev) {
          ev.dataTransfer.setData("text", ev.target.id);
      }

      function drop(ev) {
          ev.preventDefault();
          var data = ev.dataTransfer.getData("text");
          ev.target.appendChild(document.getElementById(data));
      }
      var students = <?php echo json_encode($values); ?>;
      for (var i = 0; i < students.length; i++) {
        var td = document.createElement("td");
        var t = document.createTextNode(students[i]["first_name"] + " " + students[i]["last_name"][0] + ".");
        var tr = document.createElement("tr");
        var x = i;
      }
      td.appendChild(t);
      getElementById(x).appendChild(td);
  </script>
  <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"><p id="div1">test2</p></div>
  <div id="drag1">
    <table>
      <th id="t1">
        <td>students</td>
      </th>
      <?php
        for ($i=0; $i <= count($values); $i++) {
          echo "<tr id='".$i."' draggable='true' ondragstart='drag(event)'></tr>";
        }
       ?>
    </table>
  </div>
  </body>
</html>
