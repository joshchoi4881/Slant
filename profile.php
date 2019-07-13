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
	<body>
		<header id="myHeader" class="header">
			<a href="homepage.php"><img class="logo" src="photos/design/slant.jpg" alt="Slant Logo"/></a>
			<div class="account">
				<?php
					if($log) {
						echo "<p>".$username."</p>
							<a id='profile' href='profile.php'>Profile</a>
							<a id='logout' href='logout.php'>Logout</a>";
					} else {
						echo "<a href='signUp.php'>Sign Up</a>
							<a href='login.php'>Login</a>";
					}
				?>
			</div>
			<nav>
				<div>
					<a id="politics" href="politics.php">Politics</a>
					<a id="sports" href="sports.php">Sports</a>
					<a id="music" href="music.php">Music</a>
					<a id="film" href="film.php">TV & Film</a>
					<a id="feedback" href="http://bit.ly/2X3yV0q" target="_blank">Feedback</a>
				</div>
			</nav>
		</header>
		<!-- Subcategories: Overview (overview), Politics Profile (politicsProfile), Sports Profile (sportsProfile),
		Music Profile (musicProfile), Film Profile (filmProfile) -->
		<div class="topic">
			<div id="overview" class="subtopic">
				<h5>Overview</h5>
			</div>
			<div id="politicsProfile" class="subtopic">
				<h5>Politics Profile</h5>
			</div>
			<div id="sportsProfile" class="subtopic">
				<h5>Sports Profile</h5>
			</div>
			<div id="musicProfile" class="subtopic">
				<h5>Music Profile</h5>
			</div>
			<div id="filmProfile" class="subtopic">
				<h5>Film Profile</h5>
			</div>
		</div>
		<div class="profile">

		</div>
		<script src="js/slant.js">
		</script>
		<script>
			$(function() {
				$("#profile").css({"background-color": "#32CD32", "color": "#fff"});
				$("#overview").css({"background-color": "#FFD700", "color": "#fff"});
			});
			$(function() {
				$("#overview").on("click", function() {
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#overview").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#politicsProfile").on("click", function() {
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#politicsProfile").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#sportsProfile").on("click", function() {
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#sportsProfile").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#musicProfile").on("click", function() {
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#musicProfile").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#filmProfile").on("click", function() {
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#filmProfile").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
  		</script>
	</body>
</html>