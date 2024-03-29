<!DOCTYPE html>
<?php
	include("classes/Login.php");
	include("classes/Database.php");
	$log;
	$userId;
	$username;
	if(Login::isLoggedIn()) {
		$log = true;
		if(Database::query("SELECT userId FROM loginTokens WHERE token=:token", array(":token"=>sha1($_COOKIE["SLANT_ID"])))) {
    		$userId = Database::query("SELECT userId FROM loginTokens WHERE token=:token", array(":token"=>sha1($_COOKIE["SLANT_ID"])))[0]["userId"];
    	}
    	if(Database::query("SELECT username FROM users WHERE id=:id", array(":id"=>$userId))) {
    		$username = Database::query("SELECT username FROM users WHERE id=:id", array(":id"=>$userId))[0]["username"];
    	}
	} else {
		$log = false;
	}
?>
<html lang="en">
	<head>
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
			.about {
				display: flex;
    			justify-content: center;
			}
			#cofounders {
				display: flex;
    			justify-content: center;
			}
			#josh {
				text-align: center;
				margin: 10px;
				width: 300px;
			}
			#josh img {
				width: 100%;
				height: 40%;
			}
			#leo {
				text-align: center;
				margin: 10px;
				width: 300px;
			}
			#leo img {
				width: 100%;
				height: 40%;
			}
			#contentCreators {
				display: flex;
    			justify-content: center;
			}
			#jasleen {
				text-align: center;
				margin: 10px;
				width: 300px;
			}
			#jasleen img {
				width: 100%;
				height: 50%;
			}
		</style>
	</head>
	<body>
		<header id="myHeader" class="header">
			<div class="info">
				<a href="about.php">About</a>
				<a id="team" href="team.php">Team</a>
			</div>
			<a href="homepage.php"><img class="logo" src="photos/design/slant.jpg" alt="Slant Logo"/></a>
			<div class="account">
				<?php
					if($log) {
						echo "<p>".$username."</p>
							<a id='profile' href='profile.php?p=".$username."&s=overview'>Profile</a>
							<a id='notifications' href='notifications.php'>Notifications</a>
							<a id='inbox' href='inbox.php'>Inbox</a>
							<a id='settings' href='settings.php'>Settings</a>
							<a id='logout' href='logout.php'>Logout</a>";
					} else {
						echo "<a href='signUp.php'>Sign Up</a>
							<a href='login.php'>Login</a>";
					}
				?>
			</div>
			<nav>
				<div>
					<a id="politics" href="politics.php?s=feed">Politics</a>
					<a id="sports" href="sports.php?s=feed">Sports</a>
					<a id="music" href="music.php?s=feed">Music</a>
					<a id="film" href="film.php?s=feed">TV & Film</a>
					<a id="feedback" href="http://bit.ly/2X3yV0q" target="_blank">Feedback</a>
				</div>
			</nav>
		</header>
		<div class="team">
			<center><h1>Team</h1></center>
			<center><h3>Cofounders</h3></center>
			<div id="cofounders">
				<div id="josh">
					<center><h5>Josh Choi</h5></center>
					<a href="https://www.youtube.com/watch?v=6jiu9TlR11o" target="_blank">
						<img class="images" src="photos/team/josh.jpg" alt="Josh Choi"/>
					</a>
					<p>Josh is a junior at Columbia University studying computer science and economics. He has previous internship experiences at the Johns Hopkins Institute of Cell Engineering Department of Neurology and at the NASA Goddard Space Flight Center, and he likes to play fingerstyle guitar in his free-time. He is also Korean Kanye.</p>
				</div>
				<div id="leo">
					<center><h5>Leo Ssemakula</h5></center>
					<img class="images" src="photos/team/leo.jpg" alt="Leo Ssemakula"/>
					<p>Archeological anthropologist by day, vibrant entrepreneur 24/7 (his words, not ours). Leonard is often said to have a knack for adventure and an eye for design, neither of which are qualifications that can be put on a resume, but he’s adamant that these play the most prominent role in his work.</p>
				</div>
			</div>
			<center><h3>Content Creators</h3></center>
			<div id="contentCreators">
				<div id="jasleen">
					<center><h5>Jasleen Chaggar</h5></center>
					<img class="images" src="photos/team/jasleen.JPG" alt="Jasleen Chaggar"/>
					<p>Jasleen is a Junior at Columbia University studying history and philosophy. She has interned with Congressman Espaillat and at the political consulting firm, Dynamic SRG. In her spare time she enjoys skiing and playing netball.</p>
				</div>
			</div>
		</div>
		<script>
			$(function() {
				$("#team").css({"background-color": "#32CD32", "color": "#fff"});
			});
		</script>
	</body>
</html>