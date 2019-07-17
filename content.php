<!DOCTYPE html>
<?php
	include("classes/database.php");
	include("classes/loginFunction.php");
	$log;
	$userId = -1;
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
	}
	// Send data to database
	// Don't forget to add tags functionality
	if(isset($_POST['post'])) {
		$topic = $_POST['topic'];
		$headline = $_POST['headline'];
		$quote = $_POST['quote'];
		$source = $_POST['source'];
		$media = $_POST['media'];
		$question = $_POST['question'];
		$format = $_POST['format'];
        if(strlen($headline) > 200 || strlen($headline) < 1) {
            echo "Please keep your headline between 1 and 200 characters long";
        } else {
        	if(strlen($quote) > 1000 || strlen($quote) < 1) {
            	echo "Please keep your quote between 1 and 1000 characters long";
        	} else {
        		if(strlen($source) > 200 || strlen($source) < 1) {
            		echo "Please keep your source between 1 and 200 characters long";
        		} else {
        			if(strlen($media) > 500 || strlen($media) < 1) {
            			echo "Please keep your media between 1 and 500 characters long";
        			} else {
        				if(strlen($question) > 200 || strlen($question) < 1) {
            				echo "Please keep your question between 1 and 200 characters long";
        				} else {
        					database::query("INSERT INTO posts VALUES (:id, :topic, :headline, :quote, :source, :media, :question, :format, :tags, NOW(), :one, :two, :three, :four, :five)", array(":id"=>500, ":topic"=>$topic, ":headline"=>$headline, ":quote"=>$quote, ":source"=>$source, ":media"=>$media, ":question"=>$question, ":format"=>$format, ":tags"=>"", ":one"=>0, ":two"=>0, ":three"=>0, ":four"=>0, ":five"=>0));
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
			#leftAlign {
				display: inline-block;
				text-align: left;
			}
			#leftAlign p {
				text-transform: uppercase;
				font-weight: bold;
				font-style: italic;
			}
			#demo {
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
		<div class="contentPage">
			<h1>Content</h1>
			<br/>
			<form action="content.php" method="POST">
				<div id="leftAlign">
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
						<input class="check" type="checkbox" name="tags" value="2020">2020 Presidential Race<br/>
  						<input class="check" type="checkbox" name="tags" value="executive">Executive Branch<br/>
  						<input class="check" type="checkbox" name="tags" value="legislative">Legislative Branch<br/>
  						<input class="check" type="checkbox" name="tags" value="judicial">Judicial Branch<br/>
  						<input class="check" type="checkbox" name="tags" value="foreign">Foreign Policy<br/>
  						<input class="check" type="checkbox" name="tags" value="rights">Rights<br/>
  						<input class="check" type="checkbox" name="tags" value="other">Other<br/>
  					</div>
  					<div id="sportsTags" class="tagSelect">
						<input class="check" type="checkbox" name="tags" value="basketball">Basketball<br/>
  						<input class="check" type="checkbox" name="tags" value="football">Football<br/>
  						<input class="check" type="checkbox" name="tags" value="baseball">Baseball<br/>
  						<input class="check" type="checkbox" name="tags" value="hockey">Hockey<br/>
  						<input class="check" type="checkbox" name="tags" value="soccer">Soccer<br/>
  						<input class="check" type="checkbox" name="tags" value="other">Other<br/>
  					</div>
  					<div id="musicTags" class="tagSelect">
						<input class="check" type="checkbox" name="tags" value="discover">Discover<br/>
  						<input class="check" type="checkbox" name="tags" value="hip-hop">Hip-Hop<br/>
  						<input class="check" type="checkbox" name="tags" value="pop">Pop<br/>
  						<input class="check" type="checkbox" name="tags" value="rock">Rock<br/>
  						<input class="check" type="checkbox" name="tags" value="country">Country<br/>
  						<input class="check" type="checkbox" name="tags" value="other">Other<br/>
  					</div>
  					<div id="filmTags" class="tagSelect">
						<input class="check" type="checkbox" name="tags" value="announcements">Announcements<br/>
  						<input class="check" type="checkbox" name="tags" value="releases">New Releases<br/>
  						<input class="check" type="checkbox" name="tags" value="trailers">Trailers<br/>
  						<input class="check" type="checkbox" name="tags" value="reviews">Reviews<br/>
  						<input class="check" type="checkbox" name="tags" value="fun">Just For Fun<br/>
  						<input class="check" type="checkbox" name="tags" value="other">Other<br/>
	  					</div>
					<br/>
					<br/>
					<p>Headline:</p>
					<textarea rows="4" cols="50" name="headline" value="" required></textarea>
					<br/>
					<br/>
					<p>Quote:</p>
					<textarea rows="4" cols="50" name="quote" value="" required></textarea>
					<br/>
					<br/>
					<p>Source:</p>
					<textarea rows="4" cols="50" name="source" value="" required></textarea>
					<br/>
					<br/>
					<p>Media:</p>
					<textarea rows="4" cols="50" name="media" value="" required></textarea>
					<br/>
					<br/>
					<p>Question:</p>
					<textarea rows="4" cols="50" name="question" value="" required></textarea>
					<br/>
					<br/>
					<p>Format:</p>
					<select id="format" name="format" required autofocus>
  						<option value="num">Slider</option>
  						<option value="yesNo">Yes, No</option>
  						<option value="yesIdkNo">Yes, Not Sure, No</option>
  						<option value="moreSameLess">More, Same, Less</option>
  						<option value="moreIdkLess">More, Not Sure, Less</option>
  						<option value="agreeIdkDisagree">Agree, Not Sure, Disagree</option>
  						<option value="rate">Fire, Thumbs Up, Trash</option>
  						<option value="react">Happy, Content, Neutral, Sad, Angry</option>
  						<option value="other">Other</option>
					</select>
					<br/>
					<br/>
				</div>
				<p>Demo:</p>
				<center>
					<div id="demo">
						<!-- Slider -->
						<center>
							<div id="numFormat" class="formatSelect">
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
				    	<div id="yesNoFormat" class="formatSelect">
				   		 	<input class="btn btn-success" type="button" name="yes" value="Yes"/>
				    		<input class="btn btn-danger" type="button" name="no" value="No"/>
				    	</div>
				    	<!-- yesIdkNo -->
				    	<div id="yesIdkNoFormat" class="formatSelect">
				    		<input class="btn btn-success" type="button" name="yes" value="Yes"/>
				    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
				    		<input class="btn btn-danger" type="button" name="no" value="No"/>
				    	</div>
				    	<!-- moreSameLess -->
				    	<div id="moreSameLessFormat" class="formatSelect">
				    		<input class="btn btn-success" type="button" name="more" value="More"/>
				    		<input class="btn btn-warning" type="button" name="same" value="Same"/>
				    		<input class="btn btn-danger" type="button" name="less" value="Less"/>
				    	</div>
				    	<!-- moreIdkLess -->
				    	<div id="moreIdkLessFormat" class="formatSelect">
				    		<input class="btn btn-success" type="button" name="more" value="More"/>
				    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
				    		<input class="btn btn-danger" type="button" name="less" value="Less"/>
				    	</div>
				    	<!-- agreeIdkDisagree -->
				    	<div id="agreeIdkDisagreeFormat" class="formatSelect">
				    		<input class="btn btn-success" type="button" name="agree" value="Agree"/>
				    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"/>
				    		<input class="btn btn-danger" type="button" name="disagree" value="Disagree"/>
				    	</div>
				    	<!-- rate -->
				    	<div id="rateFormat" class="formatSelect">
				        	<img class="rate" src="photos/design/fire.png" alt="Fire" name="fire"/>
				        	<img class="rate" src="photos/design/decent.png" alt="Decent" name="decent"/>
				        	<img class="rate" src="photos/design/trash.png" alt="Trash" name="trash"/>
				    	</div>
				    	<!-- react -->
				    	<div id="reactFormat" class="formatSelect">
					    	<img class="react" src="photos/design/happy.png" alt="Happy" name="happy"/>
				        	<img class="react" src="photos/design/good.png" alt="Good" name="good"/>
				        	<img class="react" src="photos/design/neutral.png" alt="Neutral" name="neutral"/>
				        	<img class="react" src="photos/design/sad.png" alt="Sad" name="sad"/>
				        	<img class="react" src="photos/design/angry.png" alt="Angry" name="angry"/>
				    	</div>
				    </div>
				</center>
			    <br/>
			    <br/>
				<div class="submitForm">
					<input type="submit" name="post" value="Post"/>
				</div>
			</form>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
				$(".formatSelect").hide();
				$("#numFormat").show();
			});
			$(function() {
				$("#format").change(function() {
					if($(this).val() === "num") {
						$(".formatSelect").hide();
						$("#numFormat").show();
					}
					else if($(this).val() === "yesNo") {
						$(".formatSelect").hide();
						$("#yesNoFormat").show();
					}
					else if($(this).val() === "yesIdkNo") {
						$(".formatSelect").hide();
						$("#yesIdkNoFormat").show();
					}
					else if($(this).val() === "moreSameLess") {
						$(".formatSelect").hide();
						$("#moreSameLessFormat").show();
					}
					else if($(this).val() === "moreIdkLess") {
						$(".formatSelect").hide();
						$("#moreIdkLessFormat").show();
					}
					else if($(this).val() === "agreeIdkDisagree") {
						$(".formatSelect").hide();
						$("#agreeIdkDisagreeFormat").show();
					}
					else if($(this).val() === "rate") {
						$(".formatSelect").hide();
						$("#rateFormat").show();
					}
					else if($(this).val() === "react") {
						$(".formatSelect").hide();
						$("#reactFormat").show();
					}
					else if($(this).val() === "other") {
						$(".formatSelect").hide();
					}
				});
			});
  		</script>
	</body>
</html>