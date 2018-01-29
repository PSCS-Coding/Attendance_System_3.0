<!DOCTYPE html>
<html>
  <head>
    <title>First Page</title>
  </head>
  <body>
    <?php $db = new mysqli('localhost', 'root', '', 'Name');
  if($db->connect_errno > 0){
    die("<div class='center'><h1>Sorry, but we can't seem to connect to our database right now. Try again later.</h1></div>");
  }
  $stmt = $db->prepare("SELECT * FROM students WHERE active = 1");
  $stmt->execute();

  $fnames = [];
  $lnames = [];


  foreach ($stmt->get_result() as $row){
    $fnames[] = $row["first_name"];
    $lnames[] = $row["last_name"]
  }?>
      <table>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
        </tr>
        <?php
          for ($i = 0; $i < count($names); $i++) {
            echo "<tr><td>" . $lnames[$i] . "</td>";
            echo "<td>" . $fnames[$i] . "</td><tr>";
        }
        ?>
      </table>
  </body>
</html>
