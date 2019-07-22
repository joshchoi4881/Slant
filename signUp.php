<!DOCTYPE html>
<?php
	include("classes/Database.php");
	if(isset($_POST["createAccount"])) {
		$firstName = $_POST["firstName"];
		$lastName = $_POST["lastName"];
		$email1 = $_POST["email1"];
		$email2 = $_POST["email2"];
		$username = $_POST["username"];
		$password1 = $_POST["password1"];
		$password2 = $_POST["password2"];
		$date = date("Y-m-d");
		if(!Database::query("SELECT username FROM users WHERE username=:username", array(":username"=>$username))) {
			if(strlen($username) >= 3 && strlen($username) <= 32) {
				if(preg_match("/[a-zA-Z0-9_]+/", $username)) {
					if(strlen($password1) >= 5 && strlen($password1) <= 32) {
						if($password1 == $password2) {
							if($email1 == $email2) {
								if(filter_var($email1, FILTER_VALIDATE_EMAIL)) {
									if(!Database::query("SELECT email FROM users WHERE email=:email", array(":email"=>$email1))) {
										Database::query("INSERT INTO users VALUES (:id, :firstName, :lastName, :email, :username, :password, :signUpDate, :accountType)", array(":id"=>null, ":firstName"=>$firstName, ":lastName"=>$lastName, ":email"=>$email1, ":username"=>$username, ":password"=>password_hash($password1, PASSWORD_BCRYPT), ":signUpDate"=>$date, ":accountType"=>0));
										die("<h1>Welcome to Slant</h1>
											<br/>
											<p><a href='login.php'>Login<a> to begin<p>");
									} else {
										echo "Email already in use";
									}
								} else {
									echo "Invalid email";
								}
							} else {
								echo "Emails don't match";
							}
						} else {
							echo "Passwords don't match";
						}
					} else {
						echo "Password must be between 5 and 32 characters long";
					}
				} else {
					echo "Username can only contain letters, numbers, and underscores";
				}
			} else {
				echo "Username must be between 3 and 32 characters long";
			}
		} else {
			echo "User already exists";
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
	</head>
	<style>
		.logo {
			display: inline-block;
			margin-left: 53px;
			width: 10%;
			height: 10%;
		}
		.signUp {
			text-align: center;
		}
		form #leftAlign {
			display: inline-block;
			text-align: left;
		}
		label {
			text-transform: uppercase;
			font-weight: bold;
			font-style: italic;
		}
	</style>
	<body>
		<header id="myHeader" class="header">
			<a href="homepage.php"><img class="logo" src="photos/design/slant.jpg" alt="Slant Logo"/></a>
			<div class="account">
				<a href="login.php">Login</a>
			</div>
		</header>
		<div class="signUp">
			<h1>Sign Up</h1>
			<br/>
			<form action="signUp.php" method="POST">
				<div id="leftAlign">
					<label>First Name</label>
					<input type="text" name="firstName" value="" placeholder="Enter first name" required autofocus/>
					<br/>
					<br/>
					<label>Last Name</label>
					<input type="text" name="lastName" value="" placeholder="Enter last name" required/>
					<br/>
					<br/>
					<label>Email</label>
					<input type="text" name="email1" value="" placeholder="Enter email" required/>
					<br/>
					<br/>
					<label>Confirm Email</label>
					<input type="text" name="email2" value="" placeholder="Re-enter email" required/>
					<br/>
					<br/>
					<label>Username</label>
					<input type="text" name="username" value="" placeholder="Enter username" required/>
					<br/>
					<br/>
					<label>Password</label>
					<input type="password" name="password1" value="" placeholder="Enter password" required/>
					<br/>
					<br/>
					<label>Confirm Password</label>
					<input type="password" name="password2" value="" placeholder="Re-enter password" required/>
					<br/>
					<br/>
				</div>
				<div class="submitForm">
					<input type="submit" name="createAccount" value="Create Account"/>
				</div>
			</form>
		</div>
		<script src="js/slant.js">
		</script>
	</body>
</html>