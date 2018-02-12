<!DOCTYPE html>
<html>
  <head>
    <meta name="google-signin-client_id" content="1049698629280-prai66q0v2fba7d4vp701jo6d4mb9kct.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
  </head>
  <body>
    <a href="login/index.php">Log Back In</a>
    <script>
      function signOut() {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", "login/auth.php", false);
        xmlHttp.send(null);
        return (xmlHttp.responseText);
      }
      function si() {
        var result = signOut();
        console.log(result);
      }
      si();
    </script>
  </body>
</html>
