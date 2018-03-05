
<html>
<head>
  <title>AJAX DB experiments</title>
</head>
<body>
  <form id="testform" role="form" method="post" action="insert.php">
    <div>
      <input type="radio" name="student" id="angus" value="4"/><label for="angus">Angus</label>
      <input type="radio" name="student" id="sam" value="2"/><label for="sam">Sam</label>
    </div>

    <div>
      <input type="radio" name="status" id="present" value="1"/><label for="present">Present</label>
      <input type="radio" name="status" id="checked_out" value="4"/><label for="checked_out">Checked Out</label>
    </div>
    <button type="submit" id="sub">Submit</button>
  </form>
  <span id="result"></span>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="insert.js"></script>

</body>

</html>
