<!DOCTYPE html>
<?php
	include("classes/Login.php");
	include("classes/Database.php");
	$log;
	$userId = -1;
	$username;
	if(Login::isLoggedIn()) {
		$log = true;
		if(Database::query("SELECT userId FROM loginTokens WHERE token=:token", array(":token"=>sha1($_COOKIE["SLANT_ID"])))) {
    		$userId = Database::query("SELECT userId FROM loginTokens WHERE token=:token", array(":token"=>sha1($_COOKIE["SLANT_ID"])))[0]["userId"];
    	}
    	if(Database::query("SELECT username FROM users WHERE id=:id", array(":id"=>$userId))) {
    		$username = Database::query("SELECT username FROM users WHERE id=:id", array(":id"=>$userId))[0]["username"];
    	}
    	if(Database::query("SELECT accountType FROM users WHERE id=:id", array(":id"=>$userId))) {
    		$accountType = Database::query("SELECT accountType FROM users WHERE id=:id", array(":id"=>$userId))[0]["accountType"];
    	}
	} else {
		$log = false;
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
			h3 {
				text-transform: uppercase;
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
		<!-- Subcategories: Feed (poll), Discover (discover), Hip-Hop (hip-hop), Pop (pop),
		Rock (rock), Country (country) -->
		<div class="topic">
			<div id="feed" class="subtopic">
				<h5>Feed</h5>
			</div>
			<div id="discover" class="subtopic">
				<h5>Discover</h5>
			</div>
			<div id="hip-hop" class="subtopic">
				<h5>Hip-Hop</h5>
			</div>
			<div id="pop" class="subtopic">
				<h5>Pop</h5>
			</div>
			<div id="rock" class="subtopic">
				<h5>Rock</h5>
			</div>
			<div id="country" class="subtopic">
				<h5>Country</h5>
			</div>
		</div>
		<!-- id of 1-100 for politics polls, 101-200 for sports polls, 201-300 for music polls, 301-400 for film polls -->
		<div class="content">
			<div id="politics">



				<?php
					$polls = Database::query("SELECT polls.* FROM polls WHERE polls.type='content' AND polls.topic='music' ORDER BY polls.date DESC;");
					$sliderNum = 1;
					foreach($polls as $p) {
						$user = Database::query("SELECT users.* FROM users WHERE id=:id", array(":id"=>$p["userId"]));
						$tags = Database::query("SELECT pollTags.* FROM pollTags WHERE pollTags.pollId=".$p["id"].";");
						$questions = Database::query("SELECT pollQuestions.* FROM pollQuestions WHERE pollQuestions.pollId=".$p["id"].";");
						echo "<!-- Poll ".$p["id"]." -->
							<section id='".$p["id"]."' class='poll";
						foreach($tags as $t) {
							echo " ".$t["tag"]."";
						}
						echo "'>
							<h3>".$p["headline"]."</h3>
							<br/>
							<p>Posted by <a href='team.php'>".$user[0]["firstName"]." ".$user[0]["lastName"]."</a> on ".$p["date"]." EST</p>
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
										onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", ".$sliderNum.", ".$answered.")'/>
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
						    else if($q["format"] == "yesNo") {
						    	echo "<input id='default".$q["id"]."' class='btn btn-success' type='button' name='yes' value='Yes'
						    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
						    		<input class='btn btn-danger' type='button' name='no' value='No'
						    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";
						    }
						    else if($q["format"] == "yesIdkNo" || $q["format"] == "moreIdkLess" || $q["format"] == "agreeIdkDisagree") {
						    	$one = "";
						    	$two = "";
						    	if($q["format"] == "yesIdkNo") {
						    		$one = "Yes";
						    		$two = "No";
						    	}
						    	else if($q["format"] == "moreIdkLess") {
						    		$one = "Yes";
						    		$two = "Less";
						    	}
						    	else if($q["format"] == "agreeIdkDisagree") {
						    		$one = "Agree";
						    		$two = "Disagree";
						    	}
						    	echo "<input id='default".$q["id"]."' class='btn btn-success' type='button' name='".strtolower($one)."' value='".$one."'
						    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
						    		<input class='btn btn-warning' type='button' name='idk' value='Not Sure'
						    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
						    		<input class='btn btn-danger' type='button' name='".strtolower($two)."' value='".$two."'
						    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";

						    }
						    else if($q["format"] == "moreSameLess") {
						    	echo "<input id='default".$q["id"]."' class='btn btn-success' type='button' name='more' value='More'
						    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
						    		<input class='btn btn-warning' type='button' name='same' value='Same'
						    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
						    		<input class='btn btn-danger' type='button' name='less' value='Less'
						    		onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";
						    }
						    else if($q["format"] == "rate") {
						    	echo "<img id='default".$q["id"]."' class='rate' src='photos/design/fire.png' alt='Fire' name='fire'
				        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
				        			<img class='rate' src='photos/design/decent.png' alt='Decent' name='decent'
				        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
				        			<img class='rate' src='photos/design/trash.png' alt='Trash' name='trash'
				        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";
						    }
						    else if($q["format"] == 'react') {
						    	echo "<img id='default".$q["id"]."' class='react laugh' src='photos/design/emoticons/Laugh_Static.jpg' alt='Laugh' name='laugh'
					    			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
				        			<img class='react happy' src='photos/design/emoticons/Happy_Static.jpg' alt='Happy' name='happy'
				        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
				        			<img class='react neutral' src='photos/design/emoticons/Neutral_Static.jpg' alt='Neutral' name='neutral'
				        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
				        			<img class='react sad' src='photos/design/emoticons/Sad_Static.jpg' alt='Sad' name='sad'
				        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>
				        			<img class='react mad' src='photos/design/emoticons/Mad_Static.jpg' alt='Mad' name='mad'
				        			onclick='showResult(".$userId.", ".$q["id"].", this.name, \"".$q["format"]."\", 0, ".$answered.")'/>";
						    }
						    echo "<script>
										if(".$answered." == 1) {
											$(function() {
												$('#default".$q["id"]."').trigger('click');
											});
										}
									</script>
								</div>
								<br/>								
								<br/>";
						}
						if($user[0]["accountType"] == 1) {
						    echo "<div class='submitForm'>
						    	<input type='button' value='Edit')'/>
								<input type='button' value='Delete' onclick='deletePoll(".$p["id"].")'/>
					    		</div>";
					    }
						echo "</section>";
					}
				?>



			</div>
		</div>
		<script>
			$(function() {
				$("#music").css({"background-color": "#32CD32", "color": "#fff"});
				$("#feed").css({"background-color": "#FFD700", "color": "#fff"});
			});
			$(function() {
				$("#feed").on("click", function() {
					window.location.replace("music.php?s=feed");
				});
			});
			$(function() {
				$("#discover").on("click", function() {
					window.location.replace("music.php?s=discover");
				});
			});
			$(function() {
				$("#hip-hop").on("click", function() {
					window.location.replace("music.php?s=hip-hop");
				});
			});
			$(function() {
				$("#pop").on("click", function() {
					window.location.replace("music.php?s=pop");
				});
			});
			$(function() {
				$("#rock").on("click", function() {
					window.location.replace("music.php?s=rock");
				});
			});
			$(function() {
				$("#country").on("click", function() {
					window.location.replace("music.php?s=country");
				});
			});
			<?php
				// "s" stands for "subtopic"; subtopic selection
				if(isset($_GET["s"])) {
					if($_GET["s"] == "feed") {
						echo "$(function() {
								$(\"* .poll\").show();
								$(\".subtopic\").css({\"background-color\": \"#fff\", \"color\": \"#000\"});
								$(\"#feed\").css({\"background-color\": \"#FFD700\", \"color\": \"#fff\"});
							});";
					}
					else if($_GET["s"] == "discover") {
						echo "$(function() {
								$(\"* .poll\").hide();
								$(\".discover\").show();
								$(\".subtopic\").css({\"background-color\": \"#fff\", \"color\": \"#000\"});
								$(\"#discover\").css({\"background-color\": \"#FFD700\", \"color\": \"#fff\"});
							});";
					}
					else if($_GET["s"] == "hip-hop") {
						echo "$(function() {
								$(\"* .poll\").hide();
								$(\".hip-hop\").show();
								$(\".subtopic\").css({\"background-color\": \"#fff\", \"color\": \"#000\"});
								$(\"#hip-hop\").css({\"background-color\": \"#FFD700\", \"color\": \"#fff\"});
							});";
					}
					else if($_GET["s"] == "pop") {
						echo "$(function() {
								$(\"* .poll\").hide();
								$(\".pop\").show();
								$(\".subtopic\").css({\"background-color\": \"#fff\", \"color\": \"#000\"});
								$(\"#pop\").css({\"background-color\": \"#FFD700\", \"color\": \"#fff\"});
							});";
					}
					else if($_GET["s"] == "rock") {
						echo "$(function() {
								$(\"* .poll\").hide();
								$(\".rock\").show();
								$(\".subtopic\").css({\"background-color\": \"#fff\", \"color\": \"#000\"});
								$(\"#rock\").css({\"background-color\": \"#FFD700\", \"color\": \"#fff\"});
							});";
					}
					else if($_GET["s"] == "country") {
						echo "$(function() {
								$(\"* .poll\").hide();
								$(\".country\").show();
								$(\".subtopic\").css({\"background-color\": \"#fff\", \"color\": \"#000\"});
								$(\"#country\").css({\"background-color\": \"#FFD700\", \"color\": \"#fff\"});
							});";
					}
				}
			?>
  		</script>
  		<script src="js/slant.js">
		</script>
  		<script src="js/emoticons.js">
		</script>
	</body>
</html>