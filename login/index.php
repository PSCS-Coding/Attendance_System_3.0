<!DOCTYPE html>
<html>
	<head>
		<meta name="google-signin-client_id" content="1049698629280-8vvjdoq9l4dq04263j1dkq707i7bv2a0.apps.googleusercontent.com">
	</head>
	<body>
		<?php
			require_once('connection.php');
			if(isset($_POST['pass'])) {

			}
		?>
		<div class='section'>

			<p>Students or staff:</p>
			<div class="g-signin2" data-onsuccess="onSignIn"></div>
		</div>
		<div class='section'>
			<p>Password sign-in:</p>
			<form name="login" method="post" action="index.php">
    	<input name="pass" type="password" placeholder="Password" required>
			<input type="submit" name="submit">
		</form>
		</div>
		<script>
			var sendUserData = function(name,imgurl) {
			    var xmlHttp = new XMLHttpRequest();
			    xmlHttp.open("GET", "auth.php?name=" + name+ "&imgurl=" + imgurl, false);
			    xmlHttp.send(null);
			    return (xmlHttp.responseText);
			}
			function onSignIn(googleUser) {
		  		var profile = googleUser.getBasicProfile();
		  		var authresult = sendUserData(profile.getName(), profile.getImageUrl());
		  		if(authresult == "true") {
		  			console.log("success");
		  		} else {
		  			console.log("failure");
		  		}
			}

		</script>

        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            var authresult = sendUserData(profile.getName(), profile.getImageUrl());
            if (authresult == "true") {
                console.log("success");
            } else {
                console.log("failure");
            }
        }

        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function() {
                console.log('User signed out.');
            });
        }
    </script>
</head>

<body>
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
    <a href="#" onclick="signOut();">Sign out</a>
</body>

</html>
