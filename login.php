<!DOCTYPE html>
<?php
	include("classes/database.php");
	if (isset($_POST["login"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		if (database::query("SELECT username FROM users WHERE username=:username", array(":username"=>$username))) {
			if (password_verify($password, database::query("SELECT password FROM users WHERE username=:username", array(":username"=>$username))[0]["password"])) {
				$cstrong = True;
				$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
				$userId = database::query("SELECT id FROM users WHERE username=:username", array(":username"=>$username))[0]["id"];
				database::query("INSERT INTO loginTokens VALUES (:id, :token, :userId)", array(":id"=>null, ":token"=>sha1($token), ":userId"=>$userId));
				setcookie("SLANT_ID", $token, time() + 60 * 60 * 24 * 7, "/", NULL, NULL, TRUE);
				setcookie("SLANT_ID_", "1", time() + 60 * 60 * 24 * 3, "/", NULL, NULL, TRUE);
				header("Location: homepage.php");
			} else {
				echo "Incorrect password";
			}
		} else {
			echo "User does not exist";
		}
	}
?>
<html lang="en">
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-138974831-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
  			function gtag(){dataLayer.push(arguments);}
  			gtag('js', new Date());
			gtag('config', 'UA-138974831-1');
		</script>
		<!--	-->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="The Marketplace for Public Opinion">
		<meta name="keywords" content="Slant, public opinion, polling">
		<meta name="author" content="Josh Choi">
	    <title>Slant</title>
	    <link rel="stylesheet" type="text/css" href="css/slant.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<style>
			.logo {
				display: inline-block;
				margin-left: 70px;
				width: 10%;
				height: 10%;
			}
			.login {
				text-align: center;
			}
			form {
				display: inline-block;
			}
		</style>
	</head>
	<body>
		<header id="myHeader" class="header">
			<a href="homepage.php"><img class="logo" src="photos/design/slant.jpg" alt="Slant Logo"/></a>
			<div class="account">
				<a href="signUp.php">Sign Up</a>
			</div>
		</header>
		<div class="login">
	        <form action="login.php" method="POST">
	        	<h1>Slant</h1>
	            <h2>User Login</h2>
	            <input type="text" name="username" value="" placeholder="Username" required autofocus/>
	            <br/>
	            <br/>
	            <input type="password" name="password" value="" placeholder="Password" required/>
	            <br/>
	            <br/>
	            <div class="submitForm">
					<input type="submit" name="login" value="Login"/>
				</div>
	            <br/>
	            <a href="forgotPassword.php">Forgot Password?</a>
	        	<br/>
	        	<a href="signUp.php">Sign Up</a>
	        </form>
		</div>
		<script src="js/slant.js">
		</script>
	</body>
</html>