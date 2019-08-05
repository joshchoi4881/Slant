<!DOCTYPE html>
<?php
	include("classes/Image.php");
	include("classes/Notify.php");
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
	} else {
		$log = false;
		header("Location: homepage.php");
	}
	$me = Database::query("SELECT users.* FROM users WHERE users.id=".$userId.";");
	$followers = Database::query("SELECT followers.userId FROM followers WHERE followingId=:followingId", array(":followingId"=>$userId));
	// Send data to database
	// Security checks for $image, $alt, and $video
	// Fix "other" tags and formats, content link for special accounts, limit on character count, edit
	if(isset($_POST["post"])) {
		$type = $_POST["type"];
		$topic = $_POST["topic"];
		if(isset($_POST["tags"])) {
			$tags = $_POST["tags"];
		}
		$headline = $_POST["headline"];
		$quote = $_POST["quote"];
		$source = $_POST["source"];
		$sourceLink = $_POST["sourceLink"];
		$media = $_POST["media"];
		$alt = $_POST["alt"];
		$video = $_POST["video"];
		$questions = $_POST["questions"];
		$formats = $_POST["formats"];
		$one = $_POST["one"];
		$two = $_POST["two"];
		$three = $_POST["three"];
		$four = $_POST["four"];
		$five = $_POST["five"];
		$timeZone = "America/New_York";
		$timeStamp = time();
		$dateTime = new DateTime("now", new DateTimeZone($timeZone));
		$dateTime->setTimestamp($timeStamp);
        if(strlen($headline) < 1 || strlen($headline) > 500) {
            echo "Please keep your headline under 500 characters long";
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
						$pollId = Database::query("INSERT INTO polls VALUES (:id, :userId, :type, :topic, :headline, :quote, :source, :sourceLink, :media, :image, :alt, :video, :d8)", array(":id"=>null, ":userId"=>$userId, ":type"=>$type, ":topic"=>$topic, ":headline"=>$headline, ":quote"=>$quote, ":source"=>$source, ":sourceLink"=>$sourceLink, ":media"=>$media, ":image"=>null, ":alt"=>$alt, ":video"=>$video, ":d8"=>$dateTime->format("m-d-y, h:i A")));
						if($alt != null) {
							Image::uploadImage("image", "UPDATE polls SET image=:image WHERE id=:id", array(":id"=>$pollId));
						}
						if(isset($_POST["tags"])) {
							for($i = 0; $i < count(array_filter($tags)); $i++) {
								Database::query("INSERT INTO pollTags VALUES (:id, :pollId, :tag)", array(":id"=>null, ":pollId"=>$pollId, ":tag"=>$tags[$i]));
							}
						}
						for($i = 0; $i < count(array_filter($questions)); $i++) {
							$questionId = Database::query("INSERT INTO pollQuestions VALUES (:id, :pollId, :question, :format, :one, :two, :three, :four, :five)", array(":id"=>null, ":pollId"=>$pollId, ":question"=>$questions[$i], ":format"=>$formats[$i], ":one"=>$one[$i], ":two"=>$two[$i], ":three"=>$three[$i], ":four"=>$four[$i], ":five"=>$five[$i]));
							Database::query("INSERT INTO questionResponses VALUES (:id, :questionId, :one, :two, :three, :four, :five)", array(":id"=>null, ":questionId"=>$questionId, ":one"=>0, ":two"=>0, ":three"=>0, ":four"=>0, ":five"=>0));
						}
						if($type == "user") {
							foreach($followers as $f) {
								Notify::createNotify($userId, $f["userId"], "createUserPoll", $pollId);
							}
						}
        			}
        		}
        	}
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
		<script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
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
		<div class="contentPage">
			<h1>Content</h1>
			<br/>
			<form action="content.php" method="POST" enctype="multipart/form-data">
				<div id="info" class="leftAlign">



					<p>*Type:</p>
					<select id="typeSelect" name="type" required autofocus>
  						<option value="user">User Poll</option>
  						<?php
  							if($me[0]["accountType"] == 1) {
  								echo "<option id=\"contentOption\" value=\"content\">Content Poll</option>";
  							}
  						?>
					</select>
					<br/>
					<br/>



					<p>*Topic:</p>
					<select id="topicSelect" name="topic" required>
  						<option value="politics">Politics</option>
  						<option value="sports">Sports</option>
  						<option value="music">Music</option>
  						<option value="film">Film</option>
					</select>
					<br/>
					<br/>


					<div id="tagDiv">
						<p>Tags:</p>
						<div id="politicsTags" class="tagSelect">
							<input class="check" type="checkbox" name="tags[]" value="2020">2020 Presidential Race
							<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="executive">Executive Branch
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="legislative">Legislative Branch
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="judicial">Judicial Branch
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="rights">Rights
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="foreign">Foreign Policy
	  						<br/>
	  					</div>
	  					<div id="sportsTags" class="tagSelect">
							<input class="check" type="checkbox" name="tags[]" value="basketball">Basketball
							<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="football">Football
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="baseball">Baseball
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="hockey">Hockey
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="soccer">Soccer
	  						<br/>
	  					</div>
	  					<div id="musicTags" class="tagSelect">
							<input class="check" type="checkbox" name="tags[]" value="discover">Discover
							<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="hip-hop">Hip-Hop
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="pop">Pop
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="rock">Rock
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="country">Country
	  						<br/>
	  					</div>
	  					<div id="filmTags" class="tagSelect">
							<input class="check" type="checkbox" name="tags[]" value="announcements">Announcements
							<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="releases">New Releases
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="trailers">Trailers
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="reviews">Reviews
	  						<br/>
	  						<input class="check" type="checkbox" name="tags[]" value="fun">Just For Fun
	  						<br/>
		  				</div>
		  			</div>
					<br/>
					<br/>



					<p>*Headline:</p>
					<textarea v-model="headline" rows="4" cols="50" name="headline" value="" placeholder="Ex: Much Awaited Stranger Things 3 Finally Released on July 4th, Breaking Netflix Viewership Records" required></textarea>
					<p>{{ headlineCharacterCount }}/500</p>
					<br/>
					<br/>



					<p>Quote:</p>
					<textarea v-model="quote" rows="4" cols="50" name="quote" value="" placeholder="Ex: According to the company's latest selective data dump, 40.7 million member accounts have watched at least part of Stranger Things' third season. (Netflix counts a 'view' as a member account having watched 70 percent of one episode of a series or 70 percent of a film.) That's the fastest a Netflix original has ever accumulated such a large audience, according to the streamer."></textarea>
					<p>{{ quoteCharacterCount }}/1000</p>
					<br/>
					<br/>



					<p>Source:</p>
					<input v-model="source" type="text" name="source" value="" placeholder="Ex: ESPN"/>
					<p>{{ sourceCharacterCount }}/100</p>
					<br/>
					<br/>



					<p>Source Link:</p>
					<input v-model="link "type="text" rows="4" cols="50" name="sourceLink" value="" placeholder="Ex: https://www.espn.com/"/>
					<p>{{ linkCharacterCount }}/500</p>
					<br/>
					<br/>



					<p>Media:</p>
					<select id="media" v-on:click="clearMedia" name="media" required>
						<option value="none">None</option>
  						<option value="image">Image</option>
  						<option value="video">Video</option>
					</select>
					<br/>
					<br/>
					<div id="image" class="mediaSelect">
						<p>*Upload Image:</p>
						<input type="file" name="image" value="" required/>
						<br/>
						<br/>
						<p>*Short Description of Image:</p>
						<input v-model="alt" id="alt" type="text" name="alt" value="" placeholder="Ex: Travis Scott Concert" required/>
						<p>{{ altCharacterCount }}/100</p>
					</div>
					<div id="video" class="mediaSelect">
						<p>*Video:</p>
						<p id="note">Note: Currently only YouTube videos are supported.<br/> Click "Share" under the YouTube video, then <br/>the "Embed" button, then copy and paste the code below</p>
						<textarea v-model="video" rows="4" cols="50" name="video" value="" placeholder='Ex: <iframe width="560" height="315" src="https://www.youtube.com/embed/tvTRZJ-4EyI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' required></textarea>
						<p>{{ videoCharacterCount }}/500</p>
					</div>
					<br/>
					<br/>
				</div>



				<div id="q1">
					<div class="leftAlign">
						<p>*Question 1:</p>
						<textarea v-model="question1" id="q1input" rows="4" cols="50" name="questions[]" value="" placeholder="Ex: What is your overall rating of the new season?" required></textarea>
						<p>{{ question1CharacterCount }}/500</p>
						<br/>
						<br/>
						<p>*Format:</p>
						<select id="format1" v-on:click="clear1" name="formats[]" required>
	  						<option value="num">Slider</option>
	  						<option value="rate1">Fire, Decent, Trash</option>
	  						<option value="rate2">Fire Button, Decent Button, Trash Button</option>
	  						<option value="react">Laugh, Happy, Neutral, Sad, Mad</option>
	  						<option value="twoOptions">Two Options</option>
	  						<option value="threeOptions">Three Options</option>
	  						<option value="fourOptions">Four Options</option>
	  						<option value="fiveOptions">Five Options</option>
						</select>
						<input id="num1Click" style="display: none;" class="btn btn-primary" v-on:click="num1" type="button"/>
						<input id="rate1Click" style="display: none;" class="btn btn-primary" v-on:click="rate1" type="button"/>
						<input id="react1Click" style="display: none;" class="btn btn-primary" v-on:click="react1" type="button"/>
						<br/>
						<br/>
						<div id="firstOption1" class="firstOptionSet">
							<p>*First Option:</p>
							<input v-model="firstOption1" type="text" name="one[]" value="" placeholder="Ex: Yes" required/>
							<p>{{ firstOption1CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="secondOption1" class="firstOptionSet">
							<p>*Second Option:</p>
							<input v-model="secondOption1" type="text" name="two[]" value="" placeholder="Ex: Probably" required/>
							<p>{{ secondOption1CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="thirdOption1" class="firstOptionSet">
							<p>*Third Option:</p>
							<input v-model="thirdOption1" type="text" name="three[]" value="" placeholder="Ex: Not Sure" required/>
							<p>{{ thirdOption1CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="fourthOption1" class="firstOptionSet">
							<p>*Fourth Option:</p>
							<input v-model="fourthOption1" type="text" name="four[]" value="" placeholder="Ex: Probably Not" required/>
							<p>{{ fourthOption1CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="fifthOption1" class="firstOptionSet">
							<p>*Fifth Option:</p>
							<input v-model="fifthOption1" type="text" name="five[]" value="" placeholder="Ex: No" required/>
							<p>{{ fifthOption1CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
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
						    <!-- rate1 -->
					    	<div id="rate1Format1" class="formatSelect1">
					        	<img class="rate" src="photos/design/fire.png" alt="Fire" name="fire"/>
					        	<img class="rate" src="photos/design/decent.png" alt="Decent" name="decent"/>
					        	<img class="rate" src="photos/design/trash.png" alt="Trash" name="trash"/>
					    	</div>
					    	<!-- rate2 -->
					    	<div id="rate2Format1" class="formatSelect1">
					        	<img class="rateButton" src="photos/design/fireButton.png" alt="Fire Button" name="fireButton"/>
					        	<img class="rateButton" src="photos/design/decentButton.png" alt="Decent Button" name="decentButton"/>
					        	<img class="rateButton" src="photos/design/trashButton.png" alt="Trash Button" name="trashButton"/>
					    	</div>
					    	<!-- react -->
					    	<div id="reactFormat1" class="formatSelect1">
						    	<img class="react laugh" src="photos/design/emoticons/Laugh_Static.jpg" alt="Laugh" name="laugh"/>
					        	<img class="react happy" src="photos/design/emoticons/Happy_Static.jpg" alt="Happy" name="happy"/>
					        	<img class="react neutral" src="photos/design/emoticons/Neutral_Static.jpg" alt="Neutral" name="neutral"/>
					        	<img class="react sad" src="photos/design/emoticons/Sad_Static.jpg" alt="Sad" name="sad"/>
					        	<img class="react mad" src="photos/design/emoticons/Mad_Static.jpg" alt="Mad" name="mad"/>
					    	</div>
					    	<!-- Two Options -->
					    	<div id="twoOptionFormat1" class="formatSelect1">
					   		 	<input class="btn btn-success" type="button" name="one" v-bind:value="firstOption1"/>
					    		<input class="btn btn-danger" type="button" name="two" v-bind:value="secondOption1"/>
					    	</div>
					    	<!-- Three Options -->
					    	<div id="threeOptionFormat1" class="formatSelect1">
					    		<input class="btn btn-success" type="button" name="one" v-bind:value="firstOption1"/>
					    		<input class="btn btn-warning" type="button" name="two" v-bind:value="secondOption1"/>
					    		<input class="btn btn-danger" type="button" name="three" v-bind:value="thirdOption1"/>
					    	</div>
					    	<!-- Four Options -->
					    	<div id="fourOptionFormat1" class="formatSelect1">
					    		<input class="btn btn-primary" type="button" name="one" v-bind:value="firstOption1"/>
					    		<input class="btn btn-primary" type="button" name="two" v-bind:value="secondOption1"/>
					    		<input class="btn btn-primary" type="button" name="three" v-bind:value="thirdOption1"/>
					    		<input class="btn btn-primary" type="button" name="four" v-bind:value="fourthOption1"/>
					    	</div>
					    	<!-- Five Options -->
					    	<div id="fiveOptionFormat1" class="formatSelect1">
					    		<input class="btn btn-primary" type="button" name="one" v-bind:value="firstOption1"/>
					    		<input class="btn btn-primary" type="button" name="two" v-bind:value="secondOption1"/>
					    		<input class="btn btn-primary" type="button" name="three" v-bind:value="thirdOption1"/>
					    		<input class="btn btn-primary" type="button" name="four" v-bind:value="fourthOption1"/>
					    		<input class="btn btn-primary" type="button" name="five" v-bind:value="fifthOption1"/>
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
						<p>*Question 2:</p>
						<textarea v-model="question2" id="inputQ2" rows="4" cols="50" name="questions[]" value="" placeholder="Ex: Do you agree with her statement?" required></textarea>
						<p>{{ question2CharacterCount }}/500</p>
						<br/>
						<br/>
						<p>*Format:</p>
						<select id="format2" v-on:click="clear2" name="formats[]" required>
	  						<option value="num">Slider</option>
	  						<option value="rate1">Fire, Decent, Trash</option>
	  						<option value="rate2">Fire Button, Decent Button, Trash Button</option>
	  						<option value="react">Laugh, Happy, Neutral, Sad, Mad</option>
	  						<option value="twoOptions">Two Options</option>
	  						<option value="threeOptions">Three Options</option>
	  						<option value="fourOptions">Four Options</option>
	  						<option value="fiveOptions">Five Options</option>
						</select>
						<input id="num2Click" style="display: none;" class="btn btn-primary" v-on:click="num2" type="button"/>
						<input id="rate2Click" style="display: none;" class="btn btn-primary" v-on:click="rate2" type="button"/>
						<input id="react2Click" style="display: none;" class="btn btn-primary" v-on:click="react2" type="button"/>
						<br/>
						<br/>
						<div id="firstOption2" class="secondOptionSet">
							<p>*First Option:</p>
							<input v-model="firstOption2" type="text" name="one[]" value="" placeholder="Ex: George Washington" required/>
							<p>{{ firstOption2CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="secondOption2" class="secondOptionSet">
							<p>*Second Option:</p>
							<input v-model="secondOption2" type="text" name="two[]" value="" placeholder="Ex: Abraham Lincoln" required/>
							<p>{{ secondOption2CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="thirdOption2" class="secondOptionSet">
							<p>*Third Option:</p>
							<input v-model="thirdOption2" type="text" name="three[]" value="" placeholder="Ex: FDR" required/>
							<p>{{ thirdOption2CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="fourthOption2" class="secondOptionSet">
							<p>*Fourth Option:</p>
							<input v-model="fourthOption2" type="text" name="four[]" value="" placeholder="Ex: Barack Obama" required/>
							<p>{{ fourthOption2CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="fifthOption2" class="secondOptionSet">
							<p>*Fifth Option:</p>
							<input v-model="fifthOption2" type="text" name="five[]" value="" placeholder="Ex: Donald Trump" required/>
							<p>{{ fifthOption2CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
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
						    <!-- rate1 -->
					    	<div id="rate1Format2" class="formatSelect2">
					        	<img class="rate" src="photos/design/fire.png" alt="Fire" name="fire"/>
					        	<img class="rate" src="photos/design/decent.png" alt="Decent" name="decent"/>
					        	<img class="rate" src="photos/design/trash.png" alt="Trash" name="trash"/>
					    	</div>
					    	<!-- rate2 -->
					    	<div id="rate2Format2" class="formatSelect2">
					        	<img class="rateButton" src="photos/design/fireButton.png" alt="Fire Button" name="fireButton"/>
					        	<img class="rateButton" src="photos/design/decentButton.png" alt="Decent Button" name="decentButton"/>
					        	<img class="rateButton" src="photos/design/trashButton.png" alt="Trash Button" name="trashButton"/>
					    	</div>
					    	<!-- react -->
					    	<div id="reactFormat2" class="formatSelect2">
						    	<img class="react laugh" src="photos/design/emoticons/Laugh_Static.jpg" alt="Laugh" name="laugh"/>
					        	<img class="react happy" src="photos/design/emoticons/Happy_Static.jpg" alt="Happy" name="happy"/>
					        	<img class="react neutral" src="photos/design/emoticons/Neutral_Static.jpg" alt="Neutral" name="neutral"/>
					        	<img class="react sad" src="photos/design/emoticons/Sad_Static.jpg" alt="Sad" name="sad"/>
					        	<img class="react mad" src="photos/design/emoticons/Mad_Static.jpg" alt="Mad" name="mad"/>
					    	</div>
					    	<!-- Two Options -->
					    	<div id="twoOptionFormat2" class="formatSelect2">
					   		 	<input class="btn btn-success" type="button" name="one" v-bind:value="firstOption2"/>
					    		<input class="btn btn-danger" type="button" name="two" v-bind:value="secondOption2"/>
					    	</div>
					    	<!-- Three Options -->
					    	<div id="threeOptionFormat2" class="formatSelect2">
					    		<input class="btn btn-success" type="button" name="one" v-bind:value="firstOption2"/>
					    		<input class="btn btn-warning" type="button" name="two" v-bind:value="secondOption2"/>
					    		<input class="btn btn-danger" type="button" name="three" v-bind:value="thirdOption2"/>
					    	</div>
					    	<!-- Four Options -->
					    	<div id="fourOptionFormat2" class="formatSelect2">
					    		<input class="btn btn-primary" type="button" name="one" v-bind:value="firstOption2"/>
					    		<input class="btn btn-primary" type="button" name="two" v-bind:value="secondOption2"/>
					    		<input class="btn btn-primary" type="button" name="three" v-bind:value="thirdOption2"/>
					    		<input class="btn btn-primary" type="button" name="four" v-bind:value="fourthOption2"/>
					    	</div>
					    	<!-- Five Options -->
					    	<div id="fiveOptionFormat2" class="formatSelect2">
					    		<input class="btn btn-primary" type="button" name="one" v-bind:value="firstOption2"/>
					    		<input class="btn btn-primary" type="button" name="two" v-bind:value="secondOption2"/>
					    		<input class="btn btn-primary" type="button" name="three" v-bind:value="thirdOption2"/>
					    		<input class="btn btn-primary" type="button" name="four" v-bind:value="fourthOption2"/>
					    		<input class="btn btn-primary" type="button" name="five" v-bind:value="fifthOption2"/>
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
						<p>*Question 3:</p>
						<textarea v-model="question3" id="inputQ3" rows="4" cols="50" name="questions[]" value="" placeholder="Ex: REACT:" required></textarea>
						<p>{{ question3CharacterCount }}/500</p>
						<br/>
						<br/>
						<p>*Format:</p>
						<select id="format3" v-on:click="clear3" name="formats[]" required>
	  						<option value="num">Slider</option>
	  						<option value="rate1">Fire, Decent, Trash</option>
	  						<option value="rate2">Fire Button, Decent Button, Trash Button</option>
	  						<option value="react">Laugh, Happy, Neutral, Sad, Mad</option>
	  						<option value="twoOptions">Two Options</option>
	  						<option value="threeOptions">Three Options</option>
	  						<option value="fourOptions">Four Options</option>
	  						<option value="fiveOptions">Five Options</option>
						</select>
						<input id="num3Click" style="display: none;" class="btn btn-primary" v-on:click="num3" type="button"/>
						<input id="rate3Click" style="display: none;" class="btn btn-primary" v-on:click="rate3" type="button"/>
						<input id="react3Click" style="display: none;" class="btn btn-primary" v-on:click="react3" type="button"/>
						<br/>
						<br/>
						<div id="firstOption3" class="thirdOptionSet">
							<p>*First Option:</p>
							<input v-model="firstOption3" type="text" name="one[]" value="" placeholder="Ex: New York" required/>
							<p>{{ firstOption3CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="secondOption3" class="thirdOptionSet">
							<p>*Second Option:</p>
							<input v-model="secondOption3" type="text" name="two[]" value="" placeholder="Ex: Los Angeles" required/>
							<p>{{ secondOption3CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="thirdOption3" class="thirdOptionSet">
							<p>*Third Option:</p>
							<input v-model="thirdOption3" type="text" name="three[]" value="" placeholder="Ex: San Francisco" required/>
							<p>{{ thirdOption3CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="fourthOption3" class="thirdOptionSet">
							<p>*Fourth Option:</p>
							<input v-model="fourthOption3" type="text" name="four[]" value="" placeholder="Ex: Paris" required/>
							<p>{{ fourthOption3CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
						<div id="fifthOption3" class="thirdOptionSet">
							<p>*Fifth Option:</p>
							<input v-model="fifthOption3" type="text" name="five[]" value="" placeholder="Ex: Boston" required/>
							<p>{{ fifthOption3CharacterCount }}/50</p>
							<br/>
							<br/>
						</div>
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
						    <!-- rate1 -->
					    	<div id="rate1Format3" class="formatSelect3">
					        	<img class="rate" src="photos/design/fire.png" alt="Fire" name="fire"/>
					        	<img class="rate" src="photos/design/decent.png" alt="Decent" name="decent"/>
					        	<img class="rate" src="photos/design/trash.png" alt="Trash" name="trash"/>
					    	</div>
					    	<!-- rate2 -->
					    	<div id="rate2Format3" class="formatSelect3">
					        	<img class="rateButton" src="photos/design/fireButton.png" alt="Fire Button" name="fireButton"/>
					        	<img class="rateButton" src="photos/design/decentButton.png" alt="Decent Button" name="decentButton"/>
					        	<img class="rateButton" src="photos/design/trashButton.png" alt="Trash Button" name="trashButton"/>
					    	</div>
					    	<!-- react -->
					    	<div id="reactFormat3" class="formatSelect3">
						    	<img class="react laugh" src="photos/design/emoticons/Laugh_Static.jpg" alt="Laugh" name="laugh"/>
					        	<img class="react happy" src="photos/design/emoticons/Happy_Static.jpg" alt="Happy" name="happy"/>
					        	<img class="react neutral" src="photos/design/emoticons/Neutral_Static.jpg" alt="Neutral" name="neutral"/>
					        	<img class="react sad" src="photos/design/emoticons/Sad_Static.jpg" alt="Sad" name="sad"/>
					        	<img class="react mad" src="photos/design/emoticons/Mad_Static.jpg" alt="Mad" name="mad"/>
					    	</div>
					    	<!-- Two Options -->
					    	<div id="twoOptionFormat3" class="formatSelect3">
					   		 	<input class="btn btn-success" type="button" name="one" v-bind:value="firstOption3"/>
					    		<input class="btn btn-danger" type="button" name="two" v-bind:value="secondOption3"/>
					    	</div>
					    	<!-- Three Options -->
					    	<div id="threeOptionFormat3" class="formatSelect3">
					    		<input class="btn btn-success" type="button" name="one" v-bind:value="firstOption3"/>
					    		<input class="btn btn-warning" type="button" name="two" v-bind:value="secondOption3"/>
					    		<input class="btn btn-danger" type="button" name="three" v-bind:value="thirdOption3"/>
					    	</div>
					    	<!-- Four Options -->
					    	<div id="fourOptionFormat3" class="formatSelect3">
					    		<input class="btn btn-primary" type="button" name="one" v-bind:value="firstOption3"/>
					    		<input class="btn btn-primary" type="button" name="two" v-bind:value="secondOption3"/>
					    		<input class="btn btn-primary" type="button" name="three" v-bind:value="thirdOption3"/>
					    		<input class="btn btn-primary" type="button" name="four" v-bind:value="fourthOption3"/>
					    	</div>
					    	<!-- Five Options -->
					    	<div id="fiveOptionFormat3" class="formatSelect3">
					    		<input class="btn btn-primary" type="button" name="one" v-bind:value="firstOption3"/>
					    		<input class="btn btn-primary" type="button" name="two" v-bind:value="secondOption3"/>
					    		<input class="btn btn-primary" type="button" name="three" v-bind:value="thirdOption3"/>
					    		<input class="btn btn-primary" type="button" name="four" v-bind:value="fourthOption3"/>
					    		<input class="btn btn-primary" type="button" name="five" v-bind:value="fifthOption3"/>
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
				<div class="submitForm">
					<input type="submit" name="post" value="Post"/>
				</div>
			</form>
		</div>
		<script>
			$(function() {
				$("#tagDiv").hide();
			});
			$(function() {
				$("#typeSelect").change(function() {
					if($(this).val() === "user") {
						$(".check").prop("checked", false);
						$("#tagDiv").hide();
					}
					else if($(this).val() === "content") {
						$("#tagDiv").show();
					}
				});
			});



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
				$("#image input").removeAttr("required");
				$("#video textarea").removeAttr("required");
				$(".mediaSelect").hide();
			});
			$(function() {
				$("#media").change(function() {
					if($(this).val() === "none") {
						$("#image input").val("");
						$("#image input").removeAttr("required");
						$("#video textarea").val("");
						$("#video textarea").removeAttr("required");
						$(".mediaSelect").hide();
					}
					else if($(this).val() === "image") {
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
				$("#num1Click").trigger("click");
				$(".firstOptionSet input").removeAttr("required");
				$(".firstOptionSet").hide();
				$(".formatSelect1").hide();
				$("#numFormat1").show();
			});
			$(function() {
				$("#format1").change(function() {
					if($(this).val() === "num") {
						$("#num1Click").trigger("click");
						$(".firstOptionSet input").removeAttr("required");
						$(".firstOptionSet").hide();
						$(".formatSelect1").hide();
						$("#numFormat1").show();
					}
					else if($(this).val() === "rate1") {
						$("#rate1Click").trigger("click");
						$(".firstOptionSet input").removeAttr("required");
						$(".firstOptionSet").hide();
						$(".formatSelect1").hide();
						$("#rate1Format1").show();
					}
					else if($(this).val() === "rate2") {
						$("#rate1Click").trigger("click");
						$(".firstOptionSet input").removeAttr("required");
						$(".firstOptionSet").hide();
						$(".formatSelect1").hide();
						$("#rate2Format1").show();
					}
					else if($(this).val() === "react") {
						$("#react1Click").trigger("click");
						$(".firstOptionSet input").removeAttr("required");
						$(".firstOptionSet").hide();
						$(".formatSelect1").hide();
						$("#reactFormat1").show();
					}
					else if($(this).val() === "twoOptions") {
						$(".firstOptionSet input").removeAttr("required");
						$(".firstOptionSet").hide();
						$("#firstOption1 input").attr("required", "true");
						$("#firstOption1").show();
						$("#secondOption1 input").attr("required", "true");
						$("#secondOption1").show();
						$(".formatSelect1").hide();
						$("#twoOptionFormat1").show();
					}
					else if($(this).val() === "threeOptions") {
						$(".firstOptionSet input").removeAttr("required");
						$(".firstOptionSet").hide();
						$("#firstOption1 input").attr("required", "true");
						$("#firstOption1").show();
						$("#secondOption1 input").attr("required", "true");
						$("#secondOption1").show();
						$("#thirdOption1 input").attr("required", "true");
						$("#thirdOption1").show();
						$(".formatSelect1").hide();
						$("#threeOptionFormat1").show();
					}
					else if($(this).val() === "fourOptions") {
						$(".firstOptionSet input").removeAttr("required");
						$(".firstOptionSet").hide();
						$("#firstOption1 input").attr("required", "true");
						$("#firstOption1").show();
						$("#secondOption1 input").attr("required", "true");
						$("#secondOption1").show();
						$("#thirdOption1 input").attr("required", "true");
						$("#thirdOption1").show();
						$("#fourthOption1 input").attr("required", "true");
						$("#fourthOption1").show();
						$(".formatSelect1").hide();
						$("#fourOptionFormat1").show();
					}
					else if($(this).val() === "fiveOptions") {
						$(".firstOptionSet input").removeAttr("required");
						$(".firstOptionSet").hide();
						$("#firstOption1 input").attr("required", "true");
						$("#firstOption1").show();
						$("#secondOption1 input").attr("required", "true");
						$("#secondOption1").show();
						$("#thirdOption1 input").attr("required", "true");
						$("#thirdOption1").show();
						$("#fourthOption1 input").attr("required", "true");
						$("#fourthOption1").show();
						$("#fifthOption1 input").attr("required", "true");
						$("#fifthOption1").show();
						$(".formatSelect1").hide();
						$("#fiveOptionFormat1").show();
					}
				});
			});



			$(function() {
				$("#num2Click").trigger("click");
				$(".secondOptionSet input").removeAttr("required");
				$(".secondOptionSet").hide();
				$(".formatSelect2").hide();
				$("#numFormat2").show();
			});
			$(function() {
				$("#format2").change(function() {
					if($(this).val() === "num") {
						$("#num2Click").trigger("click");
						$(".secondOptionSet input").removeAttr("required");
						$(".secondOptionSet").hide();
						$(".formatSelect2").hide();
						$("#numFormat2").show();
					}
					else if($(this).val() === "rate1") {
						$("#rate2Click").trigger("click");
						$(".secondOptionSet input").removeAttr("required");
						$(".secondOptionSet").hide();
						$(".formatSelect2").hide();
						$("#rate1Format2").show();
					}
					else if($(this).val() === "rate2") {
						$("#rate2Click").trigger("click");
						$(".secondOptionSet input").removeAttr("required");
						$(".secondOptionSet").hide();
						$(".formatSelect2").hide();
						$("#rate2Format2").show();
					}
					else if($(this).val() === "react") {
						$("#react2Click").trigger("click");
						$(".secondOptionSet input").removeAttr("required");
						$(".secondOptionSet").hide();
						$(".formatSelect2").hide();
						$("#reactFormat2").show();
					}
					else if($(this).val() === "twoOptions") {
						$(".secondOptionSet input").removeAttr("required");
						$(".secondOptionSet").hide();
						$("#firstOption2 input").attr("required", "true");
						$("#firstOption2").show();
						$("#secondOption2 input").attr("required", "true");
						$("#secondOption2").show();
						$(".formatSelect2").hide();
						$("#twoOptionFormat2").show();
					}
					else if($(this).val() === "threeOptions") {
						$(".secondOptionSet input").removeAttr("required");
						$(".secondOptionSet").hide();
						$("#firstOption2 input").attr("required", "true");
						$("#firstOption2").show();
						$("#secondOption2 input").attr("required", "true");
						$("#secondOption2").show();
						$("#thirdOption2 input").attr("required", "true");
						$("#thirdOption2").show();
						$(".formatSelect2").hide();
						$("#threeOptionFormat2").show();
					}
					else if($(this).val() === "fourOptions") {
						$(".secondOptionSet input").removeAttr("required");
						$(".secondOptionSet").hide();
						$("#firstOption2 input").attr("required", "true");
						$("#firstOption2").show();
						$("#secondOption2 input").attr("required", "true");
						$("#secondOption2").show();
						$("#thirdOption2 input").attr("required", "true");
						$("#thirdOption2").show();
						$("#fourthOption2 input").attr("required", "true");
						$("#fourthOption2").show();
						$(".formatSelect2").hide();
						$("#fourOptionFormat2").show();
					}
					else if($(this).val() === "fiveOptions") {
						$(".secondOptionSet input").removeAttr("required");
						$(".secondOptionSet").hide();
						$("#firstOption2 input").attr("required", "true");
						$("#firstOption2").show();
						$("#secondOption2 input").attr("required", "true");
						$("#secondOption2").show();
						$("#thirdOption2 input").attr("required", "true");
						$("#thirdOption2").show();
						$("#fourthOption2 input").attr("required", "true");
						$("#fourthOption2").show();
						$("#fifthOption2 input").attr("required", "true");
						$("#fifthOption2").show();
						$(".formatSelect2").hide();
						$("#fiveOptionFormat2").show();
					}
				});
			});



			$(function() {
				$("#num3Click").trigger("click");
				$(".thirdOptionSet input").removeAttr("required");
				$(".thirdOptionSet").hide();
				$(".formatSelect3").hide();
				$("#numFormat3").show();
			});
			$(function() {
				$("#format3").change(function() {
					if($(this).val() === "num") {
						$("#num3Click").trigger("click");
						$(".thirdOptionSet input").removeAttr("required");
						$(".thirdOptionSet").hide();
						$(".formatSelect3").hide();
						$("#numFormat3").show();
					}
					else if($(this).val() === "rate1") {
						$("#rate3Click").trigger("click");
						$(".thirdOptionSet input").removeAttr("required");
						$(".thirdOptionSet").hide();
						$(".formatSelect3").hide();
						$("#rate1Format3").show();
					}
					else if($(this).val() === "rate2") {
						$("#rate3Click").trigger("click");
						$(".thirdOptionSet input").removeAttr("required");
						$(".thirdOptionSet").hide();
						$(".formatSelect3").hide();
						$("#rate2Format3").show();
					}
					else if($(this).val() === "react") {
						$("#react3Click").trigger("click");
						$(".thirdOptionSet input").removeAttr("required");
						$(".thirdOptionSet").hide();
						$(".formatSelect3").hide();
						$("#reactFormat3").show();
					}
					else if($(this).val() === "twoOptions") {
						$(".thirdOptionSet input").removeAttr("required");
						$(".thirdOptionSet").hide();
						$("#firstOption3 input").attr("required", "true");
						$("#firstOption3").show();
						$("#secondOption3 input").attr("required", "true");
						$("#secondOption3").show();
						$(".formatSelect3").hide();
						$("#twoOptionFormat3").show();
					}
					else if($(this).val() === "threeOptions") {
						$(".thirdOptionSet input").removeAttr("required");
						$(".thirdOptionSet").hide();
						$("#firstOption3 input").attr("required", "true");
						$("#firstOption3").show();
						$("#secondOption3 input").attr("required", "true");
						$("#secondOption3").show();
						$("#thirdOption3 input").attr("required", "true");
						$("#thirdOption3").show();
						$(".formatSelect3").hide();
						$("#threeOptionFormat3").show();
					}
					else if($(this).val() === "fourOptions") {
						$(".thirdOptionSet input").removeAttr("required");
						$(".thirdOptionSet").hide();
						$("#firstOption3 input").attr("required", "true");
						$("#firstOption3").show();
						$("#secondOption3 input").attr("required", "true");
						$("#secondOption3").show();
						$("#thirdOption3 input").attr("required", "true");
						$("#thirdOption3").show();
						$("#fourthOption3 input").attr("required", "true");
						$("#fourthOption3").show();
						$(".formatSelect3").hide();
						$("#fourOptionFormat3").show();
					}
					else if($(this).val() === "fiveOptions") {
						$(".thirdOptionSet input").removeAttr("required");
						$(".thirdOptionSet").hide();
						$("#firstOption3 input").attr("required", "true");
						$("#firstOption3").show();
						$("#secondOption3 input").attr("required", "true");
						$("#secondOption3").show();
						$("#thirdOption3 input").attr("required", "true");
						$("#thirdOption3").show();
						$("#fourthOption3 input").attr("required", "true");
						$("#fourthOption3").show();
						$("#fifthOption3 input").attr("required", "true");
						$("#fifthOption3").show();
						$(".formatSelect3").hide();
						$("#fiveOptionFormat3").show();
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
					$("#format2").trigger("click");
					$(".secondOptionSet input").removeAttr("required");
					$(".secondOptionSet").hide();
					$("#q2").hide();
					$("#addQ2").show();
				});
			});
			$(function() {
				$("#addQ3").on("click", function() {
					$("#removeQ2").hide();
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
					$("#format3").trigger("click");
					$(".thirdOptionSet input").removeAttr("required");
					$(".thirdOptionSet").hide();
					$("#q3").hide();
					$("#removeQ2").show();
					$("#addQ3").show();
				});
			});
  		</script>
  		<script>
  			var info = new Vue({
  				el: "#info",
  				data: {
					headline: "",
					quote: "",
					source: "",
					link: "",
					alt: "",
					video: ""
				},
				computed: {
					headlineCharacterCount() {
						return this.headline.length;
					},
					quoteCharacterCount() {
						return this.quote.length;
					},
					sourceCharacterCount() {
						return this.source.length;
					},
					linkCharacterCount() {
						return this.link.length;
					},
					altCharacterCount() {
						return this.alt.length;
					},
					videoCharacterCount() {
						return this.video.length;
					}
				},
				methods: {
					clearMedia: function() {
						this.alt = "";
						this.video = "";
					}
				}
			});



  			var q1 = new Vue({
  				el: "#q1",
  				data: {
  					question1: "",
					firstOption1: "",
					secondOption1: "",
					thirdOption1: "",
					fourthOption1: "",
					fifthOption1: ""
				},
				computed: {
					question1CharacterCount() {
						return this.question1.length;
					},
					firstOption1CharacterCount() {
						return this.firstOption1.length;
					},
					secondOption1CharacterCount() {
						return this.secondOption1.length;
					},
					thirdOption1CharacterCount() {
						return this.thirdOption1.length;
					},
					fourthOption1CharacterCount() {
						return this.fourthOption1.length;
					},
					fifthOption1CharacterCount() {
						return this.fifthOption1.length;
					}
				},
				methods: {
					clear1: function() {
						this.firstOption1 = "";
						this.secondOption1 = "";
						this.thirdOption1 = "";
						this.fourthOption1 = "";
						this.fifthOption1 = "";
					},
					num1: function() {
						this.firstOption1 = "Average";
					},
					rate1: function() {
						this.firstOption1 = "Fire";
						this.secondOption1 = "Decent";
						this.thirdOption1 = "Trash";
					},
					react1: function() {
						this.firstOption1 = "Laugh";
						this.secondOption1 = "Happy";
						this.thirdOption1 = "Neutral";
						this.fourthOption1 = "Sad";
						this.fifthOption1 = "Mad";
					}
				}
			});



			var q2 = new Vue({
  				el: "#q2",
  				data: {
  					question2: "",
					firstOption2: "",
					secondOption2: "",
					thirdOption2: "",
					fourthOption2: "",
					fifthOption2: ""
				},
				computed: {
					question2CharacterCount() {
						return this.question2.length;
					},
					firstOption2CharacterCount() {
						return this.firstOption2.length;
					},
					secondOption2CharacterCount() {
						return this.secondOption2.length;
					},
					thirdOption2CharacterCount() {
						return this.thirdOption2.length;
					},
					fourthOption2CharacterCount() {
						return this.fourthOption2.length;
					},
					fifthOption2CharacterCount() {
						return this.fifthOption2.length;
					}
				},
				methods: {
					clear2: function() {
						this.firstOption2 = "";
						this.secondOption2 = "";
						this.thirdOption2 = "";
						this.fourthOption2 = "";
						this.fifthOption2 = "";
					},
					num2: function() {
						this.firstOption2 = "Average";
					},
					rate2: function() {
						this.firstOption2 = "Fire";
						this.secondOption2 = "Decent";
						this.thirdOption2 = "Trash";
					},
					react2: function() {
						this.firstOption2 = "Laugh";
						this.secondOption2 = "Happy";
						this.thirdOption2 = "Neutral";
						this.fourthOption2 = "Sad";
						this.fifthOption2 = "Mad";
					}
				}
			});



			var q3 = new Vue({
  				el: "#q3",
  				data: {
  					question3: "",
					firstOption3: "",
					secondOption3: "",
					thirdOption3: "",
					fourthOption3: "",
					fifthOption3: ""
				},
				computed: {
					question3CharacterCount() {
						return this.question3.length;
					},
					firstOption3CharacterCount() {
						return this.firstOption3.length;
					},
					secondOption3CharacterCount() {
						return this.secondOption3.length;
					},
					thirdOption3CharacterCount() {
						return this.thirdOption3.length;
					},
					fourthOption3CharacterCount() {
						return this.fourthOption3.length;
					},
					fifthOption3CharacterCount() {
						return this.fifthOption3.length;
					}
				},
				methods: {
					clear3: function() {
						this.firstOption3 = "";
						this.secondOption3 = "";
						this.thirdOption3 = "";
						this.fourthOption3 = "";
						this.fifthOption3 = "";
					},
					num3: function() {
						this.firstOption3 = "Average";
					},
					rate3: function() {
						this.firstOption3 = "Fire";
						this.secondOption3 = "Decent";
						this.thirdOption3 = "Trash";
					},
					react3: function() {
						this.firstOption3 = "Laugh";
						this.secondOption3 = "Happy";
						this.thirdOption3 = "Neutral";
						this.fourthOption3 = "Sad";
						this.fifthOption3 = "Mad";
					}
				}
			});
  		</script>
  		<script src="js/emoticons.js">
		</script>
	</body>
</html>