<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css"/>
    <title>First Page</title>
  </head>
  <body>
    <?php $db = new mysqli('localhost', 'root', '', 'attendance_new');
  if($db->connect_errno > 0){
    die("<div class='center'><h1>Sorry, but we can't seem to connect to our database right now. Try again later.</h1></div>");
  }
  $stmt = $db->prepare("SELECT * FROM students WHERE active = 1");
  $stmt->execute();

  $fnames = [];
  $lnames = [];
  $id = [];


  foreach ($stmt->get_result() as $row){
    $fnames[] = $row["first_name"];
    $lnames[] = $row["last_name"];
    $id[] = $row["student_id"];
  }?>
      <table>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th></th>
        </tr>
        <?php
          for ($i = 0; $i < count($fnames); $i++) {
            echo "<tr><td>" . $fnames[$i] . "</td>";
            echo "<td>" . $lnames[$i] . "</td>";
            ?>
            <td>
            <form action="first_page.php" method="post">
              <input type="submit" name="present_button" value="P">
            </form></td></tr> <?php
            if(isset($_POST["present_button"])) {
              $stmt = $db->query("UPDATE current_stati SET status_id = 2 WHERE student_id = ". $id[$i] ."");
            }
            unset($_POST["present_button"]);
        }
        ?>
      </table>
  </body>
</html>
