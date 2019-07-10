<!DOCTYPE html>
<?php
	include("classes/database.php");
	include("classes/loginFunction.php");
	$log;
	$userId;
	$username;
	if (Login::isLoggedIn()) {
		$log = true;
		if(database::query("SELECT userId FROM loginTokens WHERE token=:token", array(":token"=>sha1($_COOKIE["SLANT_ID"])))) {
    		$userId = database::query("SELECT userId FROM loginTokens WHERE token=:token", array(":token"=>sha1($_COOKIE["SLANT_ID"])))[0]["userId"];
    	}
    	if(database::query("SELECT username FROM users WHERE id=:id", array(":id"=>$userId))) {
    		$username = database::query("SELECT username FROM users WHERE id=:id", array(":id"=>$userId))[0]["username"];
    	}
	} else {
		$log = false;
		header("Location: homepage.php");
	}
	if (isset($_POST["confirm"])) {
		if (isset($_POST["allDevices"])) {
			database::query("DELETE FROM loginTokens WHERE userId=:userId", array(":userId"=>Login::isLoggedIn()));
			header("Location: homepage.php");
		} else {
			if (isset($_COOKIE["SLANT_ID"])) {
				database::query("DELETE FROM loginTokens WHERE token=:token", array(":token"=>sha1($_COOKIE["SLANT_ID"])));
			}
			setcookie("SLANT_ID", "1", time()-3600);
			setcookie("SLANT_ID_", "1", time()-3600);
			header("Location: homepage.php");
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
			.logout {
				text-align: center;
			}
			p, form {
				display: inline-block;
			}
		</style>
	</head>
	<body>
		<header id="myHeader" class="header">
			<img class="logo" src="photos/design/slant.jpg" alt="Slant Logo"/>
			<div class="account">
				<?php
					if($log) {
						echo "<p>".$username."</p>
							<a href='profile.php'>Profile</a>
							<a href='logout.php'>Logout</a>";
					} else {
						echo "<a href='signUp.php'>Sign Up</a>
							<a href='login.php'>Login</a>";
					}
				?>
			</div>
			<nav>
				<div>
					<a href="homepage.php">Home</a>
					<a href="politics.php">Politics</a>
					<a href="sports.php">Sports</a>
					<a href="music.php">Music</a>
					<a href="film.php">TV & Film</a>
					<a href="http://bit.ly/2X3yV0q" target="_blank">Feedback</a>
				</div>
			</nav>
		</header>
		<div class="logout">
			<center><h1>Logout?</h1></center>
			<p>Are you sure you'd like to logout?</p>
			<br/>
			<form action="logout.php" method="POST">
				<input type="checkbox" name="allDevices" value=""/>Logout of all devices?
				<br/>
				<br/>
				<input class="btn btn-primary" type="submit" name="confirm" value="Confirm"/>
			</form>
		</div>
		<script src="js/slant.js">
		</script>
	</body>
</html>