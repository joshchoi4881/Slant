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
	$me = Database::query("SELECT users.* FROM users WHERE users.id=".$userId.";");
	$profile;
	$p = "";
	$myProfile;
	$following;
	if(isset($_GET["p"])) {
		if(Database::query("SELECT id FROM users WHERE username=:username", array(":username"=>$_GET["p"]))) {
			if($_GET["p"] == $username) {
				$profile = Database::query("SELECT users.* FROM users WHERE users.id=".$userId.";");
				$myProfile = true;
				$following = false;
			} else {
				$targetId = Database::query("SELECT id FROM users WHERE username=:username", array(":username"=>$_GET["p"]))[0]["id"];
				$profile = Database::query("SELECT users.* FROM users WHERE users.id=".$targetId.";");
				$myProfile = false;
				if(Database::query("SELECT id FROM followers WHERE userId=:userId AND followingId=:followingId", array(":userId"=>$userId, ":followingId"=>$targetId))) {
					$following = true;
				} else {
					$following = false;
				}
			}
		} else {
			die("User does not exist");
		}
	} else {
		$profile = Database::query("SELECT users.* FROM users WHERE users.id=".$userId.";");
		$myProfile = true;
		$following = false;
	}
	$extraInfo = Database::query("SELECT userProfiles.* FROM userProfiles WHERE userId=:userId", array(":userId"=>$profile[0]["id"]));
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
			body {
				text-align: center;
			}
			.profile {
				text-align: center;
				display: inline-block;
				border: 2px solid black;
				width: auto;
				height: auto;
			}
			#profileInfo {
				text-align: center;
				display: inline-block;
				width: 700px;
				height: auto;
				border: 2px solid black;
				vertical-align: top;
			}
			#imageContainer {
				display: inline-block;
				margin: 10px;
				float: left;
			}
			#infoContainer {
				display: inline-block;
				max-width: 400px;
				margin: 10px;
				float: left;
			}
			#network {
				display: inline-block;
				width: 300px;
				height: auto;
				border: 2px solid black;
				text-align: center;
			}
			#changeStatusButton {
				display: inline-block;
				width: 100px;
				margin: 10px;
			}
			#followers {
				display: inline-block;
				width: 300px;
				float: right;
			}
			.followerListItem {
				display: block;
				margin: 5px;
				width: 300px;
				height: 100px;
			}
			#following {
				display: inline-block;
				width: 300px;
				float: right;
			}
			.followingListItem {
				display: block;
				margin: 5px;
				width: 300px;
				height: 100px;
			}
			.iconInfo {
				width: 200px;
				padding: 10px;
				text-align: left;
			}
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
						echo "<div class=\"dropdown\">
							  <button class=\"dropbtn\">Menu</button>
							  <div class=\"dropdown-content\">
							    <a id=\"profile\" href=\"profile.php?p=".$username."&s=overview\">Profile</a><br/>
							    <a id=\"notifications\" href=\"notifications.php\">Notifications</a><br/>
							    <a id=\"inbox\" href=\"inbox.php\">Inbox</a><br/>
								<a id=\"settings\" href=\"settings.php\">Settings</a><br/>
								<a id=\"logout\" href=\"logout.php\">Logout</a>
							  </div>
							</div>";
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
		<!-- Subcategories: Overview (overview), Politics Profile (politicsProfile), Sports Profile (sportsProfile),
		Music Profile (musicProfile), Film Profile (filmProfile) -->
		<div class="topic">
			<div id="overviewButton" class="subtopic">
				<h5>Overview</h5>
			</div>
			<div id="politicsButton" class="subtopic">
				<h5>Politics</h5>
			</div>
			<div id="postsButton" class="subtopic">
				<h5>Posts</h5>
			</div>
			<div id="pollsButton" class="subtopic">
				<h5>Polls</h5>
			</div>
		</div>
		<br/>
		<br/>



		<div id="overviewPage" class="section">
			<h3>Overview</h3>
			<?php
				$followers = Database::query("SELECT followers.userId FROM followers WHERE followingId=:followingId", array(":followingId"=>$profile[0]["id"]));
				$followerCount = count($followers);
				$followings = Database::query("SELECT followers.followingId FROM followers WHERE userId=:userId", array(":userId"=>$profile[0]["id"]));
				$followingCount = count($followings);
				echo "<div id=\"profileInfo\">
						<div id=\"imageContainer\">
							<img class=\"images\" src=\"".$profile[0]["profilePicture"]."\" alt=\"".$profile[0]["firstName"]." ".$profile[0]["lastName"]."\"/>
						</div>
						<div id=\"infoContainer\">
							<h1>".$profile[0]["firstName"]." ".$profile[0]["lastName"]."</h1>
							<h3>".$profile[0]["username"]."</h3>
							<p>".$extraInfo[0]["bio"]."</p>
						</div>
					</div>
					<div id=\"network\">";
				if(!$myProfile) {
					echo "<div id=\"changeStatusButton\">";
					if(!$following) {
						echo "<input id=\"followButton\" class=\"btn btn-primary\" onclick=\"changeFollowStatus('follow', ".$userId.", ".$profile[0]["id"].", ".$followerCount.")\" type=\"button\" name=\"follow\" value=\"Follow\"/>";
					} else {
						echo "<input id=\"unfollowButton\" class=\"btn btn-primary\" onclick=\"changeFollowStatus('unfollow', ".$userId.", ".$profile[0]["id"].", ".$followerCount.")\" type=\"button\" name=\"unfollow\" value=\"Unfollow\"/>";
					}
					echo "</div>";
				}
				// Followers list
				echo "<div id=\"followers\">
						<h3>Followers (<span id=\"followerCount\">".$followerCount."</span>)</h3>";
				foreach($followers as $follower) {
					$f = Database::query("SELECT users.* FROM users WHERE id=:id", array(":id"=>$follower["userId"]));
					if($f[0]["id"] == $userId) {
						echo "<div id=\"myIcon\" class=\"followerListItem\">";
					} else {
						echo "<div class=\"followerListItem\">";
					}
					echo "<a href=\"profile.php?p=".$f[0]["username"]."&s=overview\"><img class=\"icon\" src=\"".$f[0]["profilePicture"]."\" alt=\"".$f[0]["firstName"]." ".$f[0]["lastName"]."\"/></a>
							<div class=\"iconInfo\">
								<p><a href=\"profile.php?p=".$f[0]["username"]."&s=overview\">".$f[0]["username"]."</a></p>
								<p>".$f[0]["firstName"]." ".$f[0]["lastName"]."</p>
							</div>
						</div>";
				}
				echo "<p id=\"insertIcon\"></p>
					</div>";
				// Following list
				echo "<div id=\"following\">
						<h3>Following (".$followingCount.")</h3>";
				foreach($followings as $following) {
					$f = Database::query("SELECT users.* FROM users WHERE id=:id", array(":id"=>$following["followingId"]));
					echo "<div class=\"followingListItem\">
						<a href=\"profile.php?p=".$f[0]["username"]."&s=overview\"><img class=\"icon\" src=\"".$f[0]["profilePicture"]."\" alt=\"".$f[0]["firstName"]." ".$f[0]["lastName"]."\"/></a>
							<div class=\"iconInfo\">
								<p><a href=\"profile.php?p=".$f[0]["username"]."&s=overview\">".$f[0]["username"]."</a></p>
								<p>".$f[0]["firstName"]." ".$f[0]["lastName"]."</p>
							</div>
						</div>";
				}
				echo "</div>
					</div>";
			?>
		</div>



		<div id="politicsPage" class="section">
			<h3>Politics</h3>
		</div>



		<div id="postsPage" class="section">
			<h3>Posts</h3>
		</div>



		<div id="pollsPage" class="section">
			<h3>Polls</h3>
			<?php
				if($profile[0]["id"] == $userId) {
					echo "<a href=\"content.php\">Create Poll</a>";
				}
				$polls = Database::query("SELECT polls.* FROM polls WHERE polls.userId=".$profile[0]["id"]." AND polls.type='user' AND polls.topic='politics' ORDER BY polls.date DESC;");
				$sliderNum = 1;
				foreach($polls as $p) {
					$user = Database::query("SELECT users.* FROM users WHERE id=:id", array(":id"=>$p["userId"]));
					$tags = Database::query("SELECT pollTags.* FROM pollTags WHERE pollTags.pollId=".$p["id"].";");
					$questions = Database::query("SELECT pollQuestions.* FROM pollQuestions WHERE pollQuestions.pollId=".$p["id"].";");
					echo "<!-- Poll ".$p["id"]." -->
						<section id='".$p["id"]."' class='poll ";
					foreach($tags as $t) {
						echo " ".$t["tag"]."";
					}
					echo "'>
						<h3>".$p["headline"]."</h3>
						<br/>
						<p>Posted by <a href='profile.php?p=".$user[0]["username"]."'>".$user[0]["firstName"]." ".$user[0]["lastName"]."</a> on ".$p["date"]." EST</p>
		        		<img class='accent' src='photos/design/accent.png' alt='Slant Accent'/>
		       			<br/>
		        		<br/>";
		        	if($p["quote"] != "") {
				    	echo "<blockquote>
				        		".$p["quote"]."
				        	</blockquote>";
				    }
				    if($p["source"] != "") {
				    	echo "<a href='".$p["sourceLink"]."' target='_blank'>
				       			 - ".$p["source"]."
				        	</a>
				        	<br/>
				        	<br/>";
				    }
				    if($p["media"] == "image") {
				    	echo "<img class='images' src=".$p["image"]." alt=".$p["alt"]."/>";
				    }
				    else if($p["media"] == "video") {
				    	echo $p["video"];
				    }
				    echo "<br/>
				        <br/>";
				    foreach($questions as $q) {
					    echo "<p>".$q["question"]."</p>
					        <br/>
					        <div id='result".$q["id"]."'>";
			        	if($log && Database::query("SELECT id FROM userResponses WHERE userId=:userId AND questionId=:questionId", array(":userId"=>$userId, ":questionId"=>$q["id"]))) {
			       			$answered = 1;
			       		}
			       		else if($profile[0]["id"] == $userId) {
			       			$answered = 2;
			       		} else {
			       			$answered = 0;
			       		}
					    if($q["format"] == "num") {
					    	echo "<div class='slidecontainer'>
									<input id='myRange".$sliderNum."' class='slider' type='range' min='1' max='10' value='5'/>
									<br/>
									<br/>
									<span id='demo".$sliderNum."' class='show'></span>
									<br/>
									<p class='sliderText'>Drag slider left or right to choose answer</p>
									<input id='default".$q["id"]."' type='button' name='numberSlider' value='Submit'
									onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", ".$sliderNum.", ".$answered.");'/>
								</div>
								<script>
									var slider".$sliderNum." = document.getElementById('myRange".$sliderNum."');
									var output".$sliderNum." = document.getElementById('demo".$sliderNum."');
									output".$sliderNum.".innerHTML = slider".$sliderNum.".value;
									slider".$sliderNum.".oninput = function() {
				  						output".$sliderNum.".innerHTML = this.value;
									}
								</script>";
							$sliderNum++;
					    }
					    else if($q["format"] == "rate1") {
					    	echo "<img id='default".$q["id"]."' class='rate' src='photos/design/fire.png' alt='Fire' name='one'
			        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
			        			<img class='rate' src='photos/design/decent.png' alt='Decent' name='two'
			        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
			        			<img class='rate' src='photos/design/trash.png' alt='Trash' name='three'
			        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";
					    }
					    else if($q["format"] == "rate2") {
					    	echo "<img id='default".$q["id"]."' class='rateButton' src='photos/design/fireButton.png' alt='Fire Button' name='one'
			        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
			        			<img class='rateButton' src='photos/design/decentButton.png' alt='Decent Button' name='two'
			        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
			        			<img class='rateButton' src='photos/design/trashButton.png' alt='Trash Button' name='three'
			        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";
					    }
					    else if($q["format"] == "react") {
					    	echo "<img id='default".$q["id"]."' class='react laugh' src='photos/design/emoticons/Laugh_Static.jpg' alt='Laugh' name='one'
				    			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
			        			<img class='react happy' src='photos/design/emoticons/Happy_Static.jpg' alt='Happy' name='two'
			        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
			        			<img class='react neutral' src='photos/design/emoticons/Neutral_Static.jpg' alt='Neutral' name='three'
			        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
			        			<img class='react sad' src='photos/design/emoticons/Sad_Static.jpg' alt='Sad' name='four'
			        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
			        			<img class='react mad' src='photos/design/emoticons/Mad_Static.jpg' alt='Mad' name='five'
			        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";
					    }
					    else if($q["format"] == "twoOptions") {
					    	echo "<input id='default".$q["id"]."' class='btn btn-success' type='button' name='one' value='".$q["one"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
					    		<input class='btn btn-danger' type='button' name='two' value='".$q["two"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";
					    }
					    else if($q["format"] == "threeOptions") {
					    	echo "<input id='default".$q["id"]."' class='btn btn-success' type='button' name='one' value='".$q["one"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
					    		<input class='btn btn-warning' type='button' name='two' value='".$q["two"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
					    		<input class='btn btn-danger' type='button' name='three' value='".$q["three"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";

					    }
					    else if($q["format"] == "fourOptions") {
					    	echo "<input id='default".$q["id"]."' class='btn btn-primary' type='button' name='one' value='".$q["one"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
					    		<input class='btn btn-primary' type='button' name='two' value='".$q["two"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
					    		<input class='btn btn-primary' type='button' name='three' value='".$q["three"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
					    		<input class='btn btn-primary' type='button' name='four' value='".$q["four"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";
					    }
					    else if($q["format"] == "fiveOptions") {
					    	echo "<input id='default".$q["id"]."' class='btn btn-primary' type='button' name='one' value='".$q["one"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
					    		<input class='btn btn-primary' type='button' name='two' value='".$q["two"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
					    		<input class='btn btn-primary' type='button' name='three' value='".$q["three"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
					    		<input class='btn btn-primary' type='button' name='four' value='".$q["four"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
					    		<input class='btn btn-primary' type='button' name='five' value='".$q["five"]."'
					    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";
					    }
					    echo "<script>
									if(".$answered." == 1 || ".$answered." == 2) {
										$(function() {
											$('#default".$q["id"]."').trigger('click');
										});
									}
								</script>
							</div>
							<br/>								
							<br/>";
					}
					if($me[0]["id"] == $user[0]["id"]) {
					    echo "<div class='submitForm'>
					    	<input type='button' value='Edit')'/>
							<input type='button' value='Delete' onclick='deletePoll(".$p["id"].")'/>
				    		</div>";
				    }
					echo "</section>";
				}
				echo "<p id='pract'></p>";
			?>
		</div>



		<script>
			$(function() {
				$("#profile").css({"background-color": "#32CD32", "color": "#fff"});
				$("#overviewButton").css({"background-color": "#FFD700", "color": "#fff"});
				$(".section").hide();
				$("#overviewPage").show();
			});
			<?php
				/* Subtopic selection animation */
				echo "$(function() {
						$(\"#overviewButton\").on(\"click\", function() {
							window.location.replace(\"profile.php?p=".$profile[0]["username"]."&s=overview\");
						});
					});";
				echo "$(function() {
						$(\"#politicsButton\").on(\"click\", function() {
							window.location.replace(\"profile.php?p=".$profile[0]["username"]."&s=politics\");
						});
					});";
				echo "$(function() {
						$(\"#postsButton\").on(\"click\", function() {
							window.location.replace(\"profile.php?p=".$profile[0]["username"]."&s=posts\");
						});
					});";
				echo "$(function() {
						$(\"#pollsButton\").on(\"click\", function() {
							window.location.replace(\"profile.php?p=".$profile[0]["username"]."&s=polls\");
						});
					});";
				// "s" stands for "subtopic"; subtopic selection
				if(isset($_GET["s"])) {
					if($_GET["s"] == "overview") {
						echo "$(function() {
								$(\".subtopic\").css({\"background-color\": \"#fff\", \"color\": \"#000\"});
								$(\"#overviewButton\").css({\"background-color\": \"#FFD700\", \"color\": \"#fff\"});
								$(\".section\").hide();
								$(\"#overviewPage\").show();
							});";
					}
					else if($_GET["s"] == "politics") {
						echo "$(function() {
								$(\".subtopic\").css({\"background-color\": \"#fff\", \"color\": \"#000\"});
								$(\"#politicsButton\").css({\"background-color\": \"#FFD700\", \"color\": \"#fff\"});
								$(\".section\").hide();
								$(\"#politicsPage\").show();
							});";
					}
					else if($_GET["s"] == "posts") {
						echo "$(function() {
								$(\".subtopic\").css({\"background-color\": \"#fff\", \"color\": \"#000\"});
								$(\"#postsButton\").css({\"background-color\": \"#FFD700\", \"color\": \"#fff\"});
								$(\".section\").hide();
								$(\"#postsPage\").show();
							});";
					}
					else if($_GET["s"] == "polls") {
						echo "$(function() {
								$(\".subtopic\").css({\"background-color\": \"#fff\", \"color\": \"#000\"});
								$(\"#pollsButton\").css({\"background-color\": \"#FFD700\", \"color\": \"#fff\"});
								$(\".section\").hide();
								$(\"#pollsPage\").show();
							});";
					}
				}
			?>
			<?php
				/* Select specific post */
				if(isset($_GET["e"])) {
					if(Database::query("SELECT id FROM polls WHERE id=:id", array(":id"=>$_GET["e"]))[0]["id"]) {
						echo "$(function() {
								$(\".poll\").hide();
								$(\"#".$_GET["e"]."\").show();
							});";
					}
				}
			?>
			/* Changes follow status (follow or unfollow)
			status is whether user is following or unfollowing target, userId is the id of the user, followingId is the id of the target*/
			function changeFollowStatus(status, userId, followingId, followerCount) {
				var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						if(status == "follow") {
							$("#followButton").attr({
								"id" : "unfollowButton",
								"onclick" : "changeFollowStatus('unfollow', " + userId + ", " + followingId + ")",
								"name" : "unfollow",
								"value" : "Unfollow"
							});
							<?php
								echo "$(\"#insertIcon\").append(\"<div id='myIcon' class='followerListItem'><a href='profile.php?p=".$me[0]["username"]."'><img class='icon' src='".$me[0]["profilePicture"]."' alt='".$me[0]["firstName"]." ".$me[0]["lastName"]."'/></a><div class='iconInfo'><p><a href='profile.php?p=".$me[0]["username"]."'>".$me[0]["username"]."</a></p><p>".$me[0]["firstName"]." ".$me[0]["lastName"]."</p></div></div>\");";
							?>
							$("#followerCount").html(this.responseText);
							$("#unfollowButton").attr({
								"onclick" : "changeFollowStatus('unfollow', " + <?php echo $userId; ?> + ", " + <?php echo $profile[0]["id"]; ?> + ", " + this.responseText + ")"
							});
						}
						else if(status == "unfollow") {
							$("#unfollowButton").attr({
								"id" : "followButton",
								"onclick" : "changeFollowStatus('follow', " + userId + ", " + followingId + ")",
								"name" : "follow",
								"value" : "Follow"
							});
							$("#myIcon").remove();
							$("#followerCount").html(this.responseText);
							$("#followButton").attr({
								"onclick" : "changeFollowStatus('follow', " + <?php echo $userId; ?> + ", " + <?php echo $profile[0]["id"]; ?> + ", " + this.responseText + ")"
							});
						}
					}
				};
				xhttp.open("GET", "AJAX/network.php?status=" + status + "&userId=" + userId + "&followingId=" + followingId + "&followerCount=" + followerCount, true);
				xhttp.send();
			}
  		</script>
  		<script src="js/slant.js">
		</script>
  		<script src="js/emoticons.js">
		</script>
	</body>
</html>