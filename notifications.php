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
		header("Location: homepage.php");
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
		</style>
	</head>
	<body>
		<header id="myHeader" class="header">
			<div class="info">
				<a href="about.php">About</a>
				<a href="team.php">Team</a>
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
						echo "<a href=\"signUp.php\">Sign Up</a>
							<a href=\"login.php\">Login</a>";
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
		<div class="notifications">



			<?php
				if(Database::query("SELECT * FROM notifications WHERE receiver=:userId", array(":userId"=>$userId))) {
					$notifications = Database::query("SELECT * FROM notifications WHERE receiver=:userId ORDER BY id DESC", array(":userId"=>$userId));
					foreach($notifications as $n) {
						$sender = Database::query("SELECT username FROM users WHERE id=:id", array(":id"=>$n["sender"]))[0]["username"];
						$receiver = Database::query("SELECT username FROM users WHERE id=:id", array(":id"=>$n["receiver"]))[0]["username"];
						if($n["type"] == "follow") {
							echo "<p><a href=\"profile.php?p=".$sender."&s=overview\">".$sender."</a> started following you @ ".$n["date"]."</p>";
						}
						else if($n["type"] == "inboxMessage") {
							echo "<p><a href=\"profile.php?p=".$sender."&s=overview\">".$sender."</a> sent you a <a href=\"inbox.php?mid=".$n["extra"]."\">message</a> @ ".$n["date"]."</p>";
						}
						else if($n["type"] == "createUserPost") {
							echo "<p><a href=\"profile.php?p=".$sender."&s=overview\">".$sender."</a> created a new <a href=\"profile.php?p=".$sender."&s=posts&post=".$n["extra"]."\">post</a> @ ".$n["date"]."</p>";
						}
						else if($n["type"] == "likePost") {
							echo "<p><a href=\"profile.php?p=".$sender."&s=overview\">".$sender."</a> liked your <a href=\"profile.php?p=".$receiver."&s=posts&post=".$n["extra"]."\">post</a> @ ".$n["date"]."</p>";
						}
						else if($n["type"] == "comment") {
							$postId = Database::query("SELECT postId FROM comments WHERE id=:id", array(":id"=>$n["extra"]));
							echo "<p><a href=\"profile.php?p=".$sender."&s=overview\">".$sender."</a> commented on your <a href=\"profile.php?p=".$receiver."&s=posts&post=".$postId[0]["postId"]."\">post</a> @ ".$n["date"]."</p>";
						}
						else if($n["type"] == "likeComment") {
							$postId = Database::query("SELECT postId FROM comments WHERE id=:id", array(":id"=>$n["extra"]));
							echo "<p><a href=\"profile.php?p=".$sender."&s=overview\">".$sender."</a> liked your <a href=\"profile.php?p=".$receiver."&s=posts&post=".$postId[0]["postId"]."\">comment</a> @ ".$n["date"]."</p>";
						}
						else if($n["type"] == "createUserPoll") {
							echo "<p><a href=\"profile.php?p=".$sender."&s=overview\">".$sender."</a> created a new <a href=\"profile.php?p=".$sender."&s=polls&poll=".$n["extra"]."\">poll</a> @ ".$n["date"]."</p>";
						}
						else if($n["type"] == "answerUserPoll") {
							echo "<p><a href=\"profile.php?p=".$sender."&s=overview\">".$sender."</a> answered your <a href=\"profile.php?p=".$username."&s=polls&poll=".$n["extra"]."\">poll</a> @ ".$n["date"]."</p>";
						}
					}
				}
			?>



		</div>
		<script>
			$(function() {
				$("#notifications").css({"background-color": "#32CD32", "color": "#fff"});
			});
  		</script>
	</body>
</html>