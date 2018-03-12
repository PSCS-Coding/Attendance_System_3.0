
<html>
<head>
  <title>AJAX DB experiments</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <div id="testform">
    <div>
      <input type="radio" name="student" id="student" value="4"/><label for="angus">Angus</label>
      <input type="radio" name="student" id="student" value="2"/><label for="sam">Sam</label>
    </div>

    <div>
      <input type="radio" name="status" id="status" value="1"/><label for="present">Present</label>
      <input type="radio" name="status" id="status" value="4"/><label for="checked_out">Checked Out</label>
    </div>
    <button type="submit" id="sub">Submit</button>
  </div>
  <span id="result"></span>

  <script type="text/javascript" src="insert.js"></script>
</body>

</html>
