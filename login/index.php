<!DOCTYPE html>
<html>
	<head>
		<meta name="google-signin-client_id" content="1049698629280-prai66q0v2fba7d4vp701jo6d4mb9kct.apps.googleusercontent.com">
		<script src="https://apis.google.com/js/platform.js" async defer></script>
	</head>
	<body>
		<?php
			require_once('connection.php');
			//verify password login and set login cookie
			if(isset($_POST['pass'])) {

			}
		?>
		<div class='section'>

			<p>Students or staff:</p>
			<div class="g-signin2" data-onsuccess="onSignIn"></div>
		</div>
		<div class='section'>
			<p>Password sign-in:</p>
			<form name="login" method="post" action="#">
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
		  			window.location.href = "../index.php";
		  		} else {
		  			console.log("failure");
		  		}
			}
    </script>
</head>
</html>
