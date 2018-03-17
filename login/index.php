<!DOCTYPE html>
<html>
	<head>
		<meta name="google-signin-client_id" content="1049698629280-prai66q0v2fba7d4vp701jo6d4mb9kct.apps.googleusercontent.com">
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<title>PSCS Attendance System Login</title>
	</head>
	<body>
		<div class='section'>
			<p>Students or staff:</p>
			<div class="g-signin2" data-onsuccess="onSignIn"></div>
		</div>
		<div class='section'>
			<p>Password sign-in:</p>
			<form name="login" method="post" action="pass.php">
    			<input name="pass" type="password" placeholder="Password" required>
			<input type="submit" name="submit" value="Sign In">
		</form>
		</div>
		<script>
			var sendUserData = function(name,imgurl,email,minute) {
			    var xmlHttp = new XMLHttpRequest();
			    xmlHttp.open("GET", "auth.php?name=" + name + "&imgurl=" + imgurl + "&email=" + email + "&ver=" + minute, false);
			    xmlHttp.send(null);
			    return (xmlHttp.responseText);
			}
			function signOut() {
				gapi.auth2.getAuthInstance().disconnect();
				window.location.href = window.location.href;
			}
			function findGetParameter(parameterName) {
    		var result = null,
        tmp = [];
    	location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
          tmp = item.split("=");
          if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    		return result;
			}
			function onSignIn(googleUser) {
				if(findGetParameter('out') != 'true') {
		  		var profile = googleUser.getBasicProfile();
					var d = new Date();
    		 	var n = d.getMinutes();
					console.log(profile.getEmail());
		  		var authresult = sendUserData(profile.getName(), profile.getImageUrl(), profile.getEmail(), n);
		  		if(authresult >= 1) {
						console.log(authresult);
						if(window.location.href.includes("?to=")){
			  				window.location.href = window.location.href.split("?to=")[1];
							console.log(window.location.href.split("?to=")[1]);
						} else {
							window.location.href = "../";
						}
		  		} else {
						signOut();
						alert("It looks like you're not a user in our database. Please try a different Google account or use password login.");
						console.log(authresult);
				}
			} else {
				signOut();
				var xmlHttp = new XMLHttpRequest();
				xmlHttp.open("GET", "auth.php?out=" + 'true', false);
				xmlHttp.send(null);
				window.location.href = "../login";
			}
			}
    </script>
</html>
