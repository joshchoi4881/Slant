<!DOCTYPE html>
<?php
	include("classes/Database.php");
	include("classes/Login.php");
	include("classes/Image.php");
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
	} else {
		$log = false;
	}
	// Send data to database
	// Security checks for $image, $alt, and $video
	// Fix "other" tags and formats, content link for special accounts, limit on character count, edit
	if(isset($_POST["post"])) {
		$topic = $_POST["topic"];
		$tags = $_POST["tags"];
		$headline = $_POST["headline"];
		$quote = $_POST["quote"];
		$source = $_POST["source"];
		$sourceLink = $_POST["sourceLink"];
		$media = $_POST["media"];
		$alt = $_POST["alt"];
		$video = $_POST["video"];
		$questions = $_POST["questions"];
		$formats = $_POST["formats"];
		$name = $_POST["name"];
		$timeZone = "America/New_York";
		$timeStamp = time();
		$dateTime = new DateTime("now", new DateTimeZone($timeZone));
		$dateTime->setTimestamp($timeStamp);
        if(strlen($headline) < 1 || strlen($headline) > 500) {
            echo "Please keep your headline between 1 and 500 characters long";
        } else {
        	if(strlen($quote) > 1000) {
            	echo "Please keep your quote under 1000 characters long";
        	} else {
        		if(strlen($source) > 100) {
            		echo "Please keep your source under 100 characters long";
        		} else {
        			if(strlen($sourceLink) > 500) {
            			echo "Please keep your source link under 500 characters long";
        			} else {
						$postId = Database::query("INSERT INTO posts VALUES (:id, :topic, :headline, :quote, :source, :sourceLink, :media, :image, :alt, :video, :d8, :name)", array(":id"=>null, ":topic"=>$topic, ":headline"=>$headline, ":quote"=>$quote, ":source"=>$source, ":sourceLink"=>$sourceLink, ":media"=>$media, ":image"=>null, ":alt"=>$alt, ":video"=>$video, ":d8"=>$dateTime->format("m-d-y, h:i A"), ":name"=>$name));
#						$postId = Database::query("SELECT id FROM posts WHERE headline=:headline", array(":headline"=>$headline))[0]["id"];
						if($alt != null) {
							Image::uploadImage("image", "UPDATE posts SET image=:image WHERE id=:id", array(":id"=>$postId));
						}
						for($i = 0; $i < count(array_filter($tags)); $i++) {
							Database::query("INSERT INTO postTags VALUES (:id, :postId, :tag)", array(":id"=>null, ":postId"=>$postId, ":tag"=>$tags[$i]));
						}
						for($i = 0; $i < count(array_filter($questions)); $i++) {
							$questionId = Database::query("INSERT INTO postQuestions VALUES (:id, :postId, :question, :format)", array(":id"=>null, ":postId"=>$postId, ":question"=>$questions[$i], ":format"=>$formats[$i]));
							Database::query("INSERT INTO questionResponses VALUES (:id, :questionId, :one, :two, :three, :four, :five)", array(":id"=>null, ":questionId"=>$questionId, ":one"=>0, ":two"=>0, ":three"=>0, ":four"=>0, ":five"=>0));
						}
        			}
        		}
        	}
        }
    }
	/*
	if (count(Notify::createNotify($postbody, null, 1)) != 0) {
	                    foreach (Notify::createNotify($postbody, null, 1) as $key => $n) {
	                        $s = $userId;
	                        $r = database::query('SELECT id1 FROM users WHERE username=:username', array(':username'=>$key))[0]['id1'];
	                        if ($r != 0) {
	                            database::query('INSERT INTO notifications VALUES (:id, :type, :receiver, :sender, :actgroup, :extra)', array(':id'=>null, ':type'=>$n['type'], ':receiver'=>$r, ':sender'=>$s, ':actgroup'=>$nu, ':extra'=>$n['extra']));
	                        }
	                    }
	                }
	*/
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
			.contentPage {
				text-align: center;
				margin-bottom: 50px;
			}
			.leftAlign {
				display: inline-block;
				text-align: left;
			}
			.leftAlign p {
				text-transform: uppercase;
				font-weight: bold;
				font-style: italic;
			}
			.leftAlign #note {
				text-transform: none;
				font-weight: normal;
				font-style: normal;
				color: gray;
			}
			.demo {
				text-align: center;
				margin: 30px 0px 0px 0px;
				border: 2px solid gray;
				padding: 40px 0px 30px 0px;
				width: 50%;
				height: 100%;
			}
			.slidecontainer {
				width: 40%;
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
							<a id='profile' href='profile.php'>Profile</a>
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
					<a id="politics" href="politics.php">Politics</a>
					<a id="sports" href="sports.php">Sports</a>
					<a id="music" href="music.php">Music</a>
					<a id="film" href="film.php">TV & Film</a>
					<a id="feedback" href="http://bit.ly/2X3yV0q" target="_blank">Feedback</a>
				</div>
			</nav>
		</header>
		<div class="contentPage">
			<h1>Content</h1>
			<br/>
			<form action="content.php" method="POST" enctype="multipart/form-data">
				<div class="leftAlign">
					<p>Topic:</p>
					<select id="topicSelect" name="topic" required autofocus>
  						<option value="politics">Politics</option>
  						<option value="sports">Sports</option>
  						<option value="music">Music</option>
  						<option value="film">Film</option>
  						<option value="other">Other</option>
					</select>
					<br/>
					<br/>
					<p>Tags:</p>
					<div id="politicsTags" class="tagSelect">
						<input class="check" type="checkbox" name="tags[]" value="2020">2020 Presidential Race<br/>
  						<input class="check" type="checkbox" name="tags[]" value="executive">Executive Branch<br/>
  						<input class="check" type="checkbox" name="tags[]" value="legislative">Legislative Branch<br/>
  						<input class="check" type="checkbox" name="tags[]" value="judicial">Judicial Branch<br/>
  						<input class="check" type="checkbox" name="tags[]" value="rights">Rights<br/>
  						<input class="check" type="checkbox" name="tags[]" value="foreign">Foreign Policy<br/>
  						<input class="check" type="checkbox" name="tags[]" value="other">Other<br/>
  					</div>
  					<div id="sportsTags" class="tagSelect">
						<input class="check" type="checkbox" name="tags[]" value="basketball">Basketball<br/>
  						<input class="check" type="checkbox" name="tags[]" value="football">Football<br/>
  						<input class="check" type="checkbox" name="tags[]" value="baseball">Baseball<br/>
  						<input class="check" type="checkbox" name="tags[]" value="hockey">Hockey<br/>
  						<input class="check" type="checkbox" name="tags[]" value="soccer">Soccer<br/>
  						<input class="check" type="checkbox" name="tags[]" value="other">Other<br/>
  					</div>
  					<div id="musicTags" class="tagSelect">
						<input class="check" type="checkbox" name="tags[]" value="discover">Discover<br/>
  						<input class="check" type="checkbox" name="tags[]" value="hip-hop">Hip-Hop<br/>
  						<input class="check" type="checkbox" name="tags[]" value="pop">Pop<br/>
  						<input class="check" type="checkbox" name="tags[]" value="rock">Rock<br/>
  						<input class="check" type="checkbox" name="tags[]" value="country">Country<br/>
  						<input class="check" type="checkbox" name="tags[]" value="other">Other<br/>
  					</div>
  					<div id="filmTags" class="tagSelect">
						<input class="check" type="checkbox" name="tags[]" value="announcements">Announcements<br/>
  						<input class="check" type="checkbox" name="tags[]" value="releases">New Releases<br/>
  						<input class="check" type="checkbox" name="tags[]" value="trailers">Trailers<br/>
  						<input class="check" type="checkbox" name="tags[]" value="reviews">Reviews<br/>
  						<input class="check" type="checkbox" name="tags[]" value="fun">Just For Fun<br/>
  						<input class="check" type="checkbox" name="tags[]" value="other">Other<br/>
	  					</div>
					<br/>
					<br/>
					<p>Headline:</p>
					<textarea rows="4" cols="50" name="headline" value="" placeholder="Ex: Much Awaited Stranger Things 3 Finally Released on July 4th, Breaking Netflix Viewership Records" required></textarea>
					<br/>
					<br/>
					<p>Quote:</p>
					<textarea rows="4" cols="50" name="quote" value="" placeholder="Ex: According to the company's latest selective data dump, 40.7 million member accounts have watched at least part of Stranger Things' third season. (Netflix counts a 'view' as a member account having watched 70 percent of one episode of a series or 70 percent of a film.) That's the fastest a Netflix original has ever accumulated such a large audience, according to the streamer."></textarea>
					<br/>
					<br/>
					<p>Source:</p>
					<input type="text" name="source" value="" placeholder="Ex: ESPN"/>
					<br/>
					<br/>
					<p>Source Link:</p>
					<input type="text" rows="4" cols="50" name="sourceLink" value="" placeholder="Ex: https://www.espn.com/"/>
					<br/>
					<br/>
					<p>Media:</p>
					<select id="media" name="media" required>
  						<option value="image">Image</option>
  						<option value="video">Video</option>
					</select>
					<br/>
					<br/>
					<div id="image" class="mediaSelect">
						<p>Upload Image:</p>
						<input type="file" name="image" value="" required/>
						<br/>
						<br/>
						<p>Short Description of Image:</p>
						<input id="alt" type="text" name="alt" value="" placeholder="Ex: Travis Scott Concert" required/>
					</div>
					<div id="video" class="mediaSelect">
						<p>Video:</p>
						<p id="note">Note: Currently only YouTube videos are supported.<br/> Click "Share" under the YouTube video, then <br/>the "Embed" button, then copy and paste the code below</p>
						<textarea rows="4" cols="50" name="video" value="" placeholder='Ex: <iframe width="560" height="315" src="https://www.youtube.com/embed/tvTRZJ-4EyI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' required></textarea>
					</div>
					<br/>
					<br/>
				</div>
				<div id="q1">
					<div class="leftAlign">
						<p>Question 1:</p>
						<textarea id="q1input" rows="4" cols="50" name="questions[]" value="" placeholder="Ex: What is your overall rating of the new season?" required></textarea>
						<br/>
						<br/>
						<p>Format:</p>
						<select id="format1" name="formats[]" required>
	  						<option value="num">Slider</option>
	  						<option value="yesNo">Yes, No</option>
	  						<option value="yesIdkNo">Yes, Not Sure, No</option>
	  						<option value="moreSameLess">More, Same, Less</option>
	  						<option value="moreIdkLess">More, Not Sure, Less</option>
	  						<option value="agreeIdkDisagree">Agree, Not Sure, Disagree</option>
	  						<option value="rate">Fire, Thumbs Up, Trash</option>
	  						<option value="react">Laugh, Happy, Neutral, Sad, Mad</option>
	  						<option value="other">Other</option>
						</select>
						<br/>
						<br/>
					</div>
					<p>Demo:</p>
					<center>
						<div class="demo">
							<!-- Slider -->
							<center>
								<div id="numFormat1" class="formatSelect1">
						    		<div class="slidecontainer">
										<input id="myRange1" class="slider" type="range" min="1" max="10" value="5"/>
										<br/>
										<br/>
										<span id="demo1" class="show"></span>
										<br/>
										<p class="sliderText">Drag slider left or right to choose answer</p>
										<input type="button" name="numberSlider" value="Submit"/>
									</div>
									<script>
										var slider1 = document.getElementById("myRange1");
										var output1 = document.getElementById("demo1");
										output1.innerHTML = slider1.value;
										slider1.oninput = function() {
							  				output1.innerHTML = this.value;
										}
									</script>
						    	</div>
						    </center>
					    	<!-- yesNo -->
					    	<div id="yesNoFormat1" class="formatSelect1">
					   		 	<input class="btn btn-success" type="button" name="yes" value="Yes"/>
					    		<input class="btn btn-danger" type="button" name="no" value="No"/>
					    	</div>
					    	<!-- yesIdkNo -->
					    	<div id="yesIdkNoFormat1" class="formatSelect1">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes"/>
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
					    		<input class="btn btn-danger" type="button" name="no" value="No"/>
					    	</div>
					    	<!-- moreSameLess -->
					    	<div id="moreSameLessFormat1" class="formatSelect1">
					    		<input class="btn btn-success" type="button" name="more" value="More"/>
					    		<input class="btn btn-warning" type="button" name="same" value="Same"/>
					    		<input class="btn btn-danger" type="button" name="less" value="Less"/>
					    	</div>
					    	<!-- moreIdkLess -->
					    	<div id="moreIdkLessFormat1" class="formatSelect1">
					    		<input class="btn btn-success" type="button" name="more" value="More"/>
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
					    		<input class="btn btn-danger" type="button" name="less" value="Less"/>
					    	</div>
					    	<!-- agreeIdkDisagree -->
					    	<div id="agreeIdkDisagreeFormat1" class="formatSelect1">
					    		<input class="btn btn-success" type="button" name="agree" value="Agree"/>
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
					    		<input class="btn btn-danger" type="button" name="disagree" value="Disagree"/>
					    	</div>
					    	<!-- rate -->
					    	<div id="rateFormat1" class="formatSelect1">
					        	<img class="rate" src="photos/design/fire.png" alt="Fire" name="fire"/>
					        	<img class="rate" src="photos/design/decent.png" alt="Decent" name="decent"/>
					        	<img class="rate" src="photos/design/trash.png" alt="Trash" name="trash"/>
					    	</div>
					    	<!-- react -->
					    	<div id="reactFormat1" class="formatSelect1">
						    	<img class="react laugh" src="photos/design/emoticons/Laugh_Static.jpg" alt="Laugh" name="laugh"/>
					        	<img class="react happy" src="photos/design/emoticons/Happy_Static.jpg" alt="Happy" name="happy"/>
					        	<img class="react neutral" src="photos/design/emoticons/Neutral_Static.jpg" alt="Neutral" name="neutral"/>
					        	<img class="react sad" src="photos/design/emoticons/Sad_Static.jpg" alt="Sad" name="sad"/>
					        	<img class="react mad" src="photos/design/emoticons/Mad_Static.jpg" alt="Mad" name="mad"/>
					    	</div>
					    </div>
					</center>
				    <br/>
				    <br/>
				    <div class="submitForm">
						<input id="addQ2" type="button" value="Add 2nd Question"/>
					</div>
				    <br/>
				    <br/>
				</div>
				<div id="q2">
					<div class="leftAlign">
						<p>Question 2:</p>
						<textarea id="inputQ2" rows="4" cols="50" name="questions[]" value="" placeholder="Ex: Do you agree with her statement?" required></textarea>
						<br/>
						<br/>
						<p>Format:</p>
						<select id="format2" name="formats[]" required>
	  						<option value="num">Slider</option>
	  						<option value="yesNo">Yes, No</option>
	  						<option value="yesIdkNo">Yes, Not Sure, No</option>
	  						<option value="moreSameLess">More, Same, Less</option>
	  						<option value="moreIdkLess">More, Not Sure, Less</option>
	  						<option value="agreeIdkDisagree">Agree, Not Sure, Disagree</option>
	  						<option value="rate">Fire, Thumbs Up, Trash</option>
	  						<option value="react">Laugh, Happy, Neutral, Sad, Mad</option>
	  						<option value="other">Other</option>
						</select>
						<br/>
						<br/>
					</div>
					<p>Demo:</p>
					<center>
						<div class="demo">
							<!-- Slider -->
							<center>
								<div id="numFormat2" class="formatSelect2">
						    		<div class="slidecontainer">
										<input id="myRange2" class="slider" type="range" min="1" max="10" value="5"/>
										<br/>
										<br/>
										<span id="demo2" class="show"></span>
										<br/>
										<p class="sliderText">Drag slider left or right to choose answer</p>
										<input type="button" name="numberSlider" value="Submit"/>
									</div>
									<script>
										var slider2 = document.getElementById("myRange2");
										var output2 = document.getElementById("demo2");
										output2.innerHTML = slider2.value;
										slider2.oninput = function() {
							  				output2.innerHTML = this.value;
										}
									</script>
						    	</div>
						    </center>
					    	<!-- yesNo -->
					    	<div id="yesNoFormat2" class="formatSelect2">
					   		 	<input class="btn btn-success" type="button" name="yes" value="Yes"/>
					    		<input class="btn btn-danger" type="button" name="no" value="No"/>
					    	</div>
					    	<!-- yesIdkNo -->
					    	<div id="yesIdkNoFormat2" class="formatSelect2">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes"/>
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
					    		<input class="btn btn-danger" type="button" name="no" value="No"/>
					    	</div>
					    	<!-- moreSameLess -->
					    	<div id="moreSameLessFormat2" class="formatSelect2">
					    		<input class="btn btn-success" type="button" name="more" value="More"/>
					    		<input class="btn btn-warning" type="button" name="same" value="Same"/>
					    		<input class="btn btn-danger" type="button" name="less" value="Less"/>
					    	</div>
					    	<!-- moreIdkLess -->
					    	<div id="moreIdkLessFormat2" class="formatSelect2">
					    		<input class="btn btn-success" type="button" name="more" value="More"/>
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
					    		<input class="btn btn-danger" type="button" name="less" value="Less"/>
					    	</div>
					    	<!-- agreeIdkDisagree -->
					    	<div id="agreeIdkDisagreeFormat2" class="formatSelect2">
					    		<input class="btn btn-success" type="button" name="agree" value="Agree"/>
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
					    		<input class="btn btn-danger" type="button" name="disagree" value="Disagree"/>
					    	</div>
					    	<!-- rate -->
					    	<div id="rateFormat2" class="formatSelect2">
					        	<img class="rate" src="photos/design/fire.png" alt="Fire" name="fire"/>
					        	<img class="rate" src="photos/design/decent.png" alt="Decent" name="decent"/>
					        	<img class="rate" src="photos/design/trash.png" alt="Trash" name="trash"/>
					    	</div>
					    	<!-- react -->
					    	<div id="reactFormat2" class="formatSelect2">
						    	<img class="react laugh" src="photos/design/emoticons/Laugh_Static.jpg" alt="Laugh" name="laugh"/>
					        	<img class="react happy" src="photos/design/emoticons/Happy_Static.jpg" alt="Happy" name="happy"/>
					        	<img class="react neutral" src="photos/design/emoticons/Neutral_Static.jpg" alt="Neutral" name="neutral"/>
					        	<img class="react sad" src="photos/design/emoticons/Sad_Static.jpg" alt="Sad" name="sad"/>
					        	<img class="react mad" src="photos/design/emoticons/Mad_Static.jpg" alt="Mad" name="mad"/>
					    	</div>
					    </div>
					</center>
				    <br/>
				    <br/>
				    <div class="submitForm">
						<input id="removeQ2" type="button" value="Remove 2nd Question"/>
					</div>
					<br/>
				    <div class="submitForm">
						<input id="addQ3" type="button" value="Add 3rd Question"/>
					</div>
				    <br/>
				    <br/>
				</div>
				<div id="q3">
					<div class="leftAlign">
						<p>Question 3:</p>
						<textarea id="inputQ3" rows="4" cols="50" name="questions[]" value="" placeholder="Ex: REACT:" required></textarea>
						<br/>
						<br/>
						<p>Format:</p>
						<select id="format3" name="formats[]" required>
	  						<option value="num">Slider</option>
	  						<option value="yesNo">Yes, No</option>
	  						<option value="yesIdkNo">Yes, Not Sure, No</option>
	  						<option value="moreSameLess">More, Same, Less</option>
	  						<option value="moreIdkLess">More, Not Sure, Less</option>
	  						<option value="agreeIdkDisagree">Agree, Not Sure, Disagree</option>
	  						<option value="rate">Fire, Thumbs Up, Trash</option>
	  						<option value="react">Laugh, Happy, Neutral, Sad, Mad</option>
	  						<option value="other">Other</option>
						</select>
						<br/>
						<br/>
					</div>
					<p>Demo:</p>
					<center>
						<div class="demo">
							<!-- Slider -->
							<center>
								<div id="numFormat3" class="formatSelect3">
						    		<div class="slidecontainer">
										<input id="myRange3" class="slider" type="range" min="1" max="10" value="5"/>
										<br/>
										<br/>
										<span id="demo3" class="show"></span>
										<br/>
										<p class="sliderText">Drag slider left or right to choose answer</p>
										<input type="button" name="numberSlider" value="Submit"/>
									</div>
									<script>
										var slider3 = document.getElementById("myRange3");
										var output3 = document.getElementById("demo3");
										output3.innerHTML = slider3.value;
										slider3.oninput = function() {
							  				output3.innerHTML = this.value;
										}
									</script>
						    	</div>
						    </center>
					    	<!-- yesNo -->
					    	<div id="yesNoFormat3" class="formatSelect3">
					   		 	<input class="btn btn-success" type="button" name="yes" value="Yes"/>
					    		<input class="btn btn-danger" type="button" name="no" value="No"/>
					    	</div>
					    	<!-- yesIdkNo -->
					    	<div id="yesIdkNoFormat3" class="formatSelect3">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes"/>
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
					    		<input class="btn btn-danger" type="button" name="no" value="No"/>
					    	</div>
					    	<!-- moreSameLess -->
					    	<div id="moreSameLessFormat3" class="formatSelect3">
					    		<input class="btn btn-success" type="button" name="more" value="More"/>
					    		<input class="btn btn-warning" type="button" name="same" value="Same"/>
					    		<input class="btn btn-danger" type="button" name="less" value="Less"/>
					    	</div>
					    	<!-- moreIdkLess -->
					    	<div id="moreIdkLessFormat3" class="formatSelect3">
					    		<input class="btn btn-success" type="button" name="more" value="More"/>
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
					    		<input class="btn btn-danger" type="button" name="less" value="Less"/>
					    	</div>
					    	<!-- agreeIdkDisagree -->
					    	<div id="agreeIdkDisagreeFormat3" class="formatSelect3">
					    		<input class="btn btn-success" type="button" name="agree" value="Agree"/>
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
					    		<input class="btn btn-danger" type="button" name="disagree" value="Disagree"/>
					    	</div>
					    	<!-- rate -->
					    	<div id="rateFormat3" class="formatSelect3">
					        	<img class="rate" src="photos/design/fire.png" alt="Fire" name="fire"/>
					        	<img class="rate" src="photos/design/decent.png" alt="Decent" name="decent"/>
					        	<img class="rate" src="photos/design/trash.png" alt="Trash" name="trash"/>
					    	</div>
					    	<!-- react -->
					    	<div id="reactFormat3" class="formatSelect3">
						    	<img class="react laugh" src="photos/design/emoticons/Laugh_Static.jpg" alt="Laugh" name="laugh"/>
					        	<img class="react happy" src="photos/design/emoticons/Happy_Static.jpg" alt="Happy" name="happy"/>
					        	<img class="react neutral" src="photos/design/emoticons/Neutral_Static.jpg" alt="Neutral" name="neutral"/>
					        	<img class="react sad" src="photos/design/emoticons/Sad_Static.jpg" alt="Sad" name="sad"/>
					        	<img class="react mad" src="photos/design/emoticons/Mad_Static.jpg" alt="Mad" name="mad"/>
					    	</div>
					    </div>
					</center>
				    <br/>
				    <br/>
				    <div class="submitForm">
						<input id="removeQ3" type="button" value="Remove 3rd Question"/>
					</div>
					<br/>
				</div>
				<div class="leftAlign">
					<p>Name:</p>
					<input type="text" name="name" value="" placeholder="Ex: John Appleseed" required/>
					<br/>
					<br/>
				</div>
				<div class="submitForm">
					<input type="submit" name="post" value="Post"/>
				</div>
			</form>
		</div>
		<script>
			$(function() {
				$(".tagSelect").hide();
				$("#politicsTags").show();
			});
			$(function() {
				$("#topicSelect").change(function() {
					if($(this).val() === "politics") {
        				$(".check").prop("checked", false);
        				$(".tagSelect").hide();
						$("#politicsTags").show();
					}
					else if($(this).val() === "sports") {
						$(".check").prop("checked", false);
						$(".tagSelect").hide();
						$("#sportsTags").show();
					}
					else if($(this).val() === "music") {
						$(".check").prop("checked", false);
						$(".tagSelect").hide();
						$("#musicTags").show();
					}
					else if($(this).val() === "film") {
						$(".check").prop("checked", false);
						$(".tagSelect").hide();
						$("#filmTags").show();
					}
					else if($(this).val() === "other") {
						$(".check").prop("checked", false);
						$(".tagSelect").hide();
					}
				});
			});
			$(function() {
				$("#video textarea").removeAttr("required");
				$(".mediaSelect").hide();
				$("#image").show();
			});
			$(function() {
				$("#media").change(function() {
					if($(this).val() === "image") {
						$("#video textarea").val("");
						$("#video textarea").removeAttr("required");
						$(".mediaSelect").hide();
						$("#image input").attr("required", "true");
						$("#image").show();
					}
					else if($(this).val() === "video") {
						$("#image input").val("");
						$("#image input").removeAttr("required");
						$(".mediaSelect").hide();
						$("#video textarea").attr("required", "true");
						$("#video").show();
					}
				});
			});
			$(function() {
				$(".formatSelect1").hide();
				$("#numFormat1").show();
			});
			$(function() {
				$("#format1").change(function() {
					if($(this).val() === "num") {
						$(".formatSelect1").hide();
						$("#numFormat1").show();
					}
					else if($(this).val() === "yesNo") {
						$(".formatSelect1").hide();
						$("#yesNoFormat1").show();
					}
					else if($(this).val() === "yesIdkNo") {
						$(".formatSelect1").hide();
						$("#yesIdkNoFormat1").show();
					}
					else if($(this).val() === "moreSameLess") {
						$(".formatSelect1").hide();
						$("#moreSameLessFormat1").show();
					}
					else if($(this).val() === "moreIdkLess") {
						$(".formatSelect1").hide();
						$("#moreIdkLessFormat1").show();
					}
					else if($(this).val() === "agreeIdkDisagree") {
						$(".formatSelect1").hide();
						$("#agreeIdkDisagreeFormat1").show();
					}
					else if($(this).val() === "rate") {
						$(".formatSelect1").hide();
						$("#rateFormat1").show();
					}
					else if($(this).val() === "react") {
						$(".formatSelect1").hide();
						$("#reactFormat1").show();
					}
					else if($(this).val() === "other") {
						$(".formatSelect1").hide();
					}
				});
			});
			$(function() {
				$(".formatSelect2").hide();
				$("#numFormat2").show();
			});
			$(function() {
				$("#format2").change(function() {
					if($(this).val() === "num") {
						$(".formatSelect2").hide();
						$("#numFormat2").show();
					}
					else if($(this).val() === "yesNo") {
						$(".formatSelect2").hide();
						$("#yesNoFormat2").show();
					}
					else if($(this).val() === "yesIdkNo") {
						$(".formatSelect2").hide();
						$("#yesIdkNoFormat2").show();
					}
					else if($(this).val() === "moreSameLess") {
						$(".formatSelect2").hide();
						$("#moreSameLessFormat2").show();
					}
					else if($(this).val() === "moreIdkLess") {
						$(".formatSelect2").hide();
						$("#moreIdkLessFormat2").show();
					}
					else if($(this).val() === "agreeIdkDisagree") {
						$(".formatSelect2").hide();
						$("#agreeIdkDisagreeFormat2").show();
					}
					else if($(this).val() === "rate") {
						$(".formatSelect2").hide();
						$("#rateFormat2").show();
					}
					else if($(this).val() === "react") {
						$(".formatSelect2").hide();
						$("#reactFormat2").show();
					}
					else if($(this).val() === "other") {
						$(".formatSelect2").hide();
					}
				});
			});
			$(function() {
				$(".formatSelect3").hide();
				$("#numFormat3").show();
			});
			$(function() {
				$("#format3").change(function() {
					if($(this).val() === "num") {
						$(".formatSelect3").hide();
						$("#numFormat3").show();
					}
					else if($(this).val() === "yesNo") {
						$(".formatSelect3").hide();
						$("#yesNoFormat3").show();
					}
					else if($(this).val() === "yesIdkNo") {
						$(".formatSelect3").hide();
						$("#yesIdkNoFormat3").show();
					}
					else if($(this).val() === "moreSameLess") {
						$(".formatSelect3").hide();
						$("#moreSameLessFormat3").show();
					}
					else if($(this).val() === "moreIdkLess") {
						$(".formatSelect3").hide();
						$("#moreIdkLessFormat3").show();
					}
					else if($(this).val() === "agreeIdkDisagree") {
						$(".formatSelect3").hide();
						$("#agreeIdkDisagreeFormat3").show();
					}
					else if($(this).val() === "rate") {
						$(".formatSelect3").hide();
						$("#rateFormat3").show();
					}
					else if($(this).val() === "react") {
						$(".formatSelect3").hide();
						$("#reactFormat3").show();
					}
					else if($(this).val() === "other") {
						$(".formatSelect3").hide();
					}
				});
			});
			$(function() {
				$("#inputQ2").val("");
				$("#inputQ2").removeAttr("required");
				$("#format2").val("");
				$("#format2").removeAttr("required");
				$("#q2").hide();
				$("#inputQ3").val("");
				$("#inputQ3").removeAttr("required");
				$("#format3").val("");
				$("#format3").removeAttr("required");
				$("#q3").hide();
			});
			$(function() {
				$("#addQ2").on("click", function() {
					$("#addQ2").hide();
					$("#inputQ2").attr("required", "true");
					$("#format2").attr("required", "true");
					$("#format2").val("num");
					$(".formatSelect2").hide();
					$("#numFormat2").show();
					$("#q2").show();
				});
			});
			$(function() {
				$("#removeQ2").on("click", function() {
					$("#inputQ2").val("");
					$("#inputQ2").removeAttr("required");
					$("#format2").val("");
					$("#format2").removeAttr("required");
					$("#q2").hide();
					$("#addQ2").show();
				});
			});
			$(function() {
				$("#addQ3").on("click", function() {
					$("#addQ3").hide();
					$("#inputQ3").attr("required", "true");
					$("#format3").attr("required", "true");
					$("#format3").val("num");
					$(".formatSelect3").hide();
					$("#numFormat3").show();
					$("#q3").show();
				});
			});
			$(function() {
				$("#removeQ3").on("click", function() {
					$("#inputQ3").val("");
					$("#inputQ3").removeAttr("required");
					$("#format3").val("");
					$("#format3").removeAttr("required");
					$("#q3").hide();
					$("#addQ3").show();
				});
			});
  		</script>
  		<script src="js/emoticons.js">
		</script>
	</body>
</html>