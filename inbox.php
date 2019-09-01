<!DOCTYPE html>
<?php
	include("classes/Notify.php");
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
	if(isset($_GET["mid"])) {
		$message = Database::query("SELECT * FROM messages WHERE id=:id AND (senderId=:senderId OR receiverId=:receiverId)", array(":id"=>$_GET["mid"], ":senderId"=>$userId, ":receiverId"=>$userId))[0];
		echo "<h1>View Message</h1>";
		echo htmlspecialchars($message["messageBody"]);
		echo "<hr/>";
		if($message["senderId"] == $userId) {
			$id = $message["receiverId"];
		} else {
			$id = $message["senderId"];
		}
		Database::query("UPDATE messages SET messageRead=1 WHERE id=:id", array(":id"=>$_GET["mid"]));
		echo "<form action=\"inbox.php?r=".$id."\" method=\"POST\">
	                <textarea name=\"messageBody\" rows=\"8\" cols=\"80\"></textarea>
	                <br/>
	                <br/>
	                <input type=\"submit\" name=\"send\" value=\"Send Message\">
	        </form>";
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
		<div class="inbox">



			<div id="search">
				<h3>Search For User</h3>
				<?php
					echo "<form action=\"inbox.php\" method=\"POST\">
				        	<input type=\"text\" name=\"searchBox\" value=\"\">
				        	<input type=\"submit\" name=\"search\" value=\"Search\">
						</form>";
					if(isset($_POST["searchBox"])) {
						$toSearch = explode(" ", $_POST["searchBox"]);
					    if(count($toSearch) == 1) {
					            $toSearch = str_split($toSearch[0], 2);
					    }
					    $whereClause = "";
					    $paramsArray = array(":username"=>"%".$_POST["searchBox"]."%");
					    for($i = 0; $i < count($toSearch); $i++) {
					        $whereClause .= " OR username LIKE :u$i ";
					        $paramsArray[":u$i"] = $toSearch[$i];
					    }
						$searchUsers = Database::query("SELECT users.* FROM users WHERE users.username LIKE :username ".$whereClause."", $paramsArray);
						foreach($searchUsers as $s) {
							echo "<a href=inbox.php?r=".$s["id"].">".$s["username"]."</a><br/>";
						}
					}
				?>
			</div>



			<div id="sendMessage">
				<h3>Send Message</h3>
				<?php
					if(isset($_GET["r"])) {
						if($_GET["r"] == $userId) {
							echo "<p>You cannot send a message to yourself</p>
								<br/>
								<p>Select a user to send a message to through the search box</p>";
						} else {
							$receiver = Database::query("SELECT username FROM users WHERE id=:id", array(":id"=>$_GET["r"]))[0]["username"];
							echo "<p>Receiver: ".$receiver."</p>";
						}
					} else {
						echo "<p>Select a user to send a message to through the search box</p>";
					}
					if(isset($_POST["send"])) {
						$senderId = $userId;
						$receiverId = $_GET["r"];
						$messageBody = $_POST["messageBody"];
						$messageRead = 0;
						$timeZone = "America/New_York";
						$timeStamp = time();
						$dateTime = new DateTime("now", new DateTimeZone($timeZone));
						$dateTime->setTimestamp($timeStamp);
						if(Database::query("SELECT id FROM users WHERE id=:receiver", array(":receiver"=>$_GET["r"]))) {
							$messageId = Database::query("INSERT INTO messages VALUES ('', :senderId, :receiverId, :messageBody, :messageRead, :d8)", array(":senderId"=>$senderId, ":receiverId"=>$receiverId, ":messageBody"=>$messageBody, ":messageRead"=>$messageRead, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
							Notify::createNotify("inboxMessage", $senderId, $receiverId, $messageId);
							echo "Message sent";
						} else {
							die("Invalid ID");
						}
					}
					echo "<form action=\"inbox.php";
					if(isset($_GET["r"])) {
						echo "?r=".$_GET["r"]."";
					}
					echo "\" method=\"POST\">
	        				<textarea name=\"messageBody\" rows=\"8\" cols=\"50\"></textarea>
	        				<br/>
	        				<br/>
	        				<input type=\"submit\" name=\"send\" value=\"Send Message\">
						</form>
						<br/>";
				?>
			</div>



			<div id="myReceivedMessages">
				<h3>My Received Messages</h3>
				<?php
					$messages = Database::query("SELECT users.username, messages.* FROM users, messages WHERE users.id=messages.senderId AND receiverId=:receiverId ORDER BY messages.date DESC", array(":receiverId"=>$userId));
					foreach($messages as $message) {
				        if(strlen($message["messageBody"]) > 10) {
				        	$m = substr($message["messageBody"], 0, 10)." ...";
				        } else {
				        	$m = $message["messageBody"];
				        }
				        if($message["messageRead"] == 0) {
				            echo "<a href=\"inbox.php?mid=".$message["id"]."\"><strong>".$m."</strong></a> sent by <a href=\"profile.php?p=".$message["username"]."&s=overview\">".$message["username"]."</a> to <a href=\"profile.php?p=".$username."&s=overview\">".$username."</a> @ ".$message["date"]."<hr />";
				        } else {
				            echo "<a href=\"inbox.php?mid=".$message["id"]."\">".$m."</a> sent by <a href=\"profile.php?p=".$message["username"]."&s=overview\">".$message["username"]."</a> to <a href=\"profile.php?p=".$username."&s=overview\">".$username."</a> @ ".$message["date"]."<hr />";
				        }
					}
				?>
			</div>



			<div id="mySentMessages">
				<h3>My Sent Messages</h3>
				<?php
					$messages = Database::query("SELECT users.username, messages.* FROM users, messages WHERE users.id=messages.receiverId AND senderId=:senderId ORDER BY messages.date DESC", array(":senderId"=>$userId));
					foreach($messages as $message) {
				        if(strlen($message["messageBody"]) > 10) {
				        	$m = substr($message["messageBody"], 0, 10)." ...";
				        } else {
				        	$m = $message["messageBody"];
				        }
				        if($message["messageRead"] == 0) {
				            echo "<a href=\"inbox.php?mid=".$message["id"]."\"><strong>".$m."</strong></a> sent by <a href=\"profile.php?p=".$username."&s=overview\">".$username."</a> to <a href=\"profile.php?p=".$message["username"]."&s=overview\">".$message["username"]."</a> @ ".$message["date"]."<hr />";
				        } else {
				            echo "<a href=\"inbox.php?mid=".$message["id"]."\">".$m."</a> sent by <a href=\"profile.php?p=".$username."&s=overview\">".$username."</a> to <a href=\"profile.php?p=".$message["username"]."&s=overview\">".$message["username"]."</a> @ ".$message["date"]."<hr />";
				        }
					}
				?>
			</div>



		</div>
		<script>
			$(function() {
				$("#inbox").css({"background-color": "#32CD32", "color": "#fff"});
			});
  		</script>
	</body>
</html>