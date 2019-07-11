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
			<img class="logo" src="photos/design/slant.jpg" alt="Slant Logo"/>
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
					<a id="home" href="homepage.php">Home</a>
					<a id="politics" href="politics.php">Politics</a>
					<a id="sports" href="sports.php">Sports</a>
					<a id="music" href="music.php">Music</a>
					<a id="film" href="film.php">TV & Film</a>
					<a id="feedback" href="http://bit.ly/2X3yV0q" target="_blank">Feedback</a>
				</div>
			</nav>
		</header>
		<!-- Subcategories: Feed (post), 2020 Presidential Race (2020), Executive Branch (executive), Legislative Branch (legislative),
		Judicial Branch (judicial), Foreign Policy (foreign) -->
		<div class="topic">
			<div id="feed" class="subtopic">
				<h5>Feed</h5>
			</div>
			<div id="2020" class="subtopic">
				<h5>2020 Presidential Race</h5>
			</div>
			<div id="executive" class="subtopic">
				<h5>Executive</h5>
			</div>
			<div id="legislative" class="subtopic">
				<h5>Legislative</h5>
			</div>
			<div id="judicial" class="subtopic">
				<h5>Judicial</h5>
			</div>
			<div id="foreign" class="subtopic">
				<h5>Foreign Policy</h5>
			</div>
		</div>
		<!-- id of 1-100 for politics polls, 101-200 for sports polls, 201-300 for music polls, 301-400 for film polls -->
		<div class="content">
			<div id="politics">



				<section class="post 2020">
		    	    <h3>SWALWELL BOWS OUT OF 2020 RACE</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"Presidential candidate Representative Eric Swalwell dropped out of the 2020 race, declaring 'We have to be honest about our own candidacy and viability. Today ends our presidential campaign.'”
		    	    </blockquote>
		    	    <a href="https://www.nytimes.com/2019/07/08/us/politics/steyer-swalwell-2020.html?action=click&module=Top%20Stories&pgtype=Homepage" target="_blank">
		    	    	 - The New York Times
		    	    </a>
			        <br/>
			        <img class="images" src="photos/politics/ericSwalwell.jpg" alt="Eric Swalwell"/>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result9">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>9))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<img id="default9" class="react" src="photos/design/happy.png" alt="Happy" name="happy"
				    	onclick="showResult(<?php echo $userId; ?>, 9, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/good.png" alt="Good" name="good"
			        	onclick="showResult(<?php echo $userId; ?>, 9, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/neutral.png" alt="Neutral" name="neutral"
			        	onclick="showResult(<?php echo $userId; ?>, 9, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/sad.png" alt="Sad" name="sad"
			        	onclick="showResult(<?php echo $userId; ?>, 9, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/angry.png" alt="Angry" name="angry"
			        	onclick="showResult(<?php echo $userId; ?>, 9, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default9").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



				<section class="post executive foreign">
			        <h3>US-UK DIPLOMATIC TENSIONS</h3>
			        <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
			        <blockquote>
			        	"After it was leaked that the British ambassador to the US described the President as 'inept' in internal memos, Trump tweeted, 'We will no longer deal with him.'"
			        </blockquote>
			        <a href="https://www.theguardian.com/us-news/2019/jul/08/donald-trump-we-will-no-longer-deal-with-the-british-ambassador" target="_blank">
			       		 - The Guardian
			        </a>
			        <br/>
			        <img class="images" src="photos/politics/us-uk.jpg" alt="US-UK"/>
			        <br/>
			        <br/>
			        <p>How do you feel about Trump's decision?</p>
			        <br/>
			        <div id="result8">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>8))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default8" class="btn btn-success" type="button" name="agree" value="Agree"
			    		onclick="showResult(<?php echo $userId; ?>, 8, this.name, 'agreeIdkDisagree', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 8, this.name, 'agreeIdkDisagree', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="disagree" value="Disagree"
			    		onclick="showResult(<?php echo $userId; ?>, 8, this.name, 'agreeIdkDisagree', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default8").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



				<section class="post judicial">
		    	    <h3>SUPREME COURT ON GERRYMANDERING</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"The Supreme Court concluded that gerrymandering may continue unchallenged, arguing that 'partisan gerrymandering claims present political questions beyond the reach of the federal courts.'"
		    	    </blockquote>
		    	    <a href="https://www.nytimes.com/2019/06/27/us/politics/supreme-court-gerrymandering.html" target="_blank">
		    	    	 - The New York Times
		    	    </a>
			        <br/>
			        <img class="images" src="photos/politics/gerrymandering.jpg" alt="Gerrymandering"/>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result7">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>7))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<img id="default7" class="react" src="photos/design/happy.png" alt="Happy" name="happy"
				    	onclick="showResult(<?php echo $userId; ?>, 7, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/good.png" alt="Good" name="good"
			        	onclick="showResult(<?php echo $userId; ?>, 7, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/neutral.png" alt="Neutral" name="neutral"
			        	onclick="showResult(<?php echo $userId; ?>, 7, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/sad.png" alt="Sad" name="sad"
			        	onclick="showResult(<?php echo $userId; ?>, 7, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/angry.png" alt="Angry" name="angry"
			        	onclick="showResult(<?php echo $userId; ?>, 7, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			    	</div>
			    	<script>
				    	if(<?php echo $answered; ?> == 1) {
					    	$(function() {
					    		$("#default7").trigger("click");
					    	});
					    }
				    </script>
			    </section>



				<section class="post legislative">
			        <h3>ALEXANDRIA OCASIO-CORTEZ CALLS TRUMP'S MIGRANT CENTERS CONCENTRATION CAMPS</h3>
			        <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
			        <blockquote>
			        	"The United States is running concentration camps on our southern border"
			        </blockquote>
			        <a href="https://www.cnn.com/videos/politics/2019/06/18/alexandria-ocasio-cortez-aoc-concentration-camps-border-ice-vstan-orig-js.cnn" target="_blank">
			        	 - Alexandria Ocasio-Cortez, CNN
			        </a>
			        <br/>
			        <img class="images" src="photos/politics/border.jpg" alt="Migrant Center / Concentration Camp"/>
			        <br/>
			        <br/>
			        <p>On a scale of 1 to 10, how much do you agree with her use of the term "concentration camp"?</p>
			        <br/>
			        <div id="result4">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>4))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<div class="slidecontainer">
							<input id="myRange2" class="slider" type="range" min="1" max="10" value="5"/>
							<br/>
							<br/>
							<span id="demo2" class="show"></span>
							<br/>
							<p class="sliderText">Drag slider left or right to choose answer</p>
							<input id="default4" type="button" name="numberSlider" value="Submit"
							onclick="showResult(<?php echo $userId; ?>, 4, this.name, 'num', 2, <?php echo $answered; ?>)"/>
						</div>
						<script>
							var slider2 = document.getElementById("myRange2");
							var output2 = document.getElementById("demo2");
							output2.innerHTML = slider2.value;
							slider2.oninput = function() {
				  				output2.innerHTML = this.value;
							}
						</script>
						<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default4").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    	<br/>
			    	<p>On a scale of 1 to 10, how much do you agree with the current immigration laws in the United States?</p>
			        <br/>
			        <div id="result5">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>5))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<div class="slidecontainer">
							<input id="myRange1" class="slider" type="range" min="1" max="10" value="5"/>
							<br/>
							<br/>
							<span id="demo1" class="show"></span>
							<br/>
							<p class="sliderText">Drag slider left or right to choose answer</p>
							<input id="default5" type="button" name="numberSlider" value="Submit"
							onclick="showResult(<?php echo $userId; ?>, 5, this.name, 'num', 1, <?php echo $answered; ?>)"/>
						</div>
						<script>
							var slider1 = document.getElementById("myRange1");
							var output1 = document.getElementById("demo1");
							output1.innerHTML = slider1.value;
							slider1.oninput = function() {
				  				output1.innerHTML = this.value;
							}
						</script>
						<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default5").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    	<br/>
			        <p>Does her statement make you have a more or less favorable view of AOC?</p>
			        <br/>
			        <div id="result6">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>6))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default6" class="btn btn-success" type="button" name="more" value="More"
			    		onclick="showResult(<?php echo $userId; ?>, 6, this.name, 'moreIdkLess', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 6, this.name, 'moreIdkLess', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="less" value="Less"
			    		onclick="showResult(<?php echo $userId; ?>, 6, this.name, 'moreIdkLess', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default6").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



				<section class="post 2020">
			        <h3>ELIZABETH WARREN ON PRIVATE PRISONS</h3>
			        <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
			        <blockquote>
			        	"We need significant reform in both criminal justice and in immigration, to end mass incarceration and all of the unnecessary, cruel, and punitive forms of immigration detention that have taken root in the Trump Administration... Washington works hand-in-hand with private prison companies, who spend millions on lobbyists, campaign contributions, and revolving-door hires -- all to turn our criminal and immigration policies into ones that prioritize making them rich instead of keeping us safe,"
			        </blockquote>
			        <a href="https://www.cnn.com/2019/06/21/politics/elizabeth-warren-ban-private-prisons-detention-facilities/index.html" target="_blank">
			       		 - Elizabeth Warren, CNN
			        </a>
			        <br/>
			        <img class="images" src="photos/politics/elizabethWarren.jpg" alt="Elizabeth Warren"/>
			        <br/>
			        <br/>
			        <p>Do you agree with Warren's assertion?</p>
			        <br/>
			        <div id="result2">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>2))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default2" class="btn btn-success" type="button" name="yes" value="Yes"
			    		onclick="showResult(<?php echo $userId; ?>, 2, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 2, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="no" value="No"
			    		onclick="showResult(<?php echo $userId; ?>, 2, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default2").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    	<br/>
			        <p>Does what she said make you have a more or less favorable view of the candidate?</p>
			        <br/>
			        <div id="result3">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>3))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default3" class="btn btn-success" type="button" name="more" value="More"
			    		onclick="showResult(<?php echo $userId; ?>, 3, this.name, 'moreIdkLess', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 3, this.name, 'moreIdkLess', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="less" value="Less"
			    		onclick="showResult(<?php echo $userId; ?>, 3, this.name, 'moreIdkLess', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default3").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



		    	<section class="post executive">
		    	    <h3>TRUMP DELAYS ICE RAIDS</h3>
		    	    <img class="accent executive" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"President Donald Trump announced Saturday that he's delaying for two weeks US Immigration and Customs Enforcement raids that were planned to take place Sunday in 10 major US cities, saying deportations will proceed unless Congress finds a solution on the US-Mexico border."
		    	    </blockquote>
		    	    <a href="https://www.cnn.com/2019/06/22/politics/ice-raids-sunday-10-cities-donald-trump-defends-arrests/index.html" target="_blank">
		    	    	 - CNN
		    	    </a>
			        <br/>
			        <img class="images" src="photos/politics/ICE.jpg" alt="ICE"/>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result1">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>1))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<img id="default1" class="react" src="photos/design/happy.png" alt="Happy" name="happy"
				    	onclick="showResult(<?php echo $userId; ?>, 1, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/good.png" alt="Good" name="good"
			        	onclick="showResult(<?php echo $userId; ?>, 1, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/neutral.png" alt="Neutral" name="neutral"
			        	onclick="showResult(<?php echo $userId; ?>, 1, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/sad.png" alt="Sad" name="sad"
			        	onclick="showResult(<?php echo $userId; ?>, 1, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/angry.png" alt="Angry" name="angry"
			        	onclick="showResult(<?php echo $userId; ?>, 1, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default1").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



			</div>
		</div>
		<script src="js/slant.js">
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
			$(function() {
				$("#politics").css({"background-color": "#32CD32", "color": "#fff"});
				$("#feed").css({"background-color": "#FFD700", "color": "#fff"});
			});
			$(function() {
				$("#feed").on("click", function() {
					$("* .post").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#feed").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#2020").on("click", function() {
					$("* .post").hide();
					$(".2020").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#2020").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#executive").on("click", function() {
					$("* .post").hide();
					$(".executive").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#executive").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#legislative").on("click", function() {
					$("* .post").hide();
					$(".legislative").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#legislative").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#judicial").on("click", function() {
					$("* .post").hide();
					$(".judicial").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#judicial").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#foreign").on("click", function() {
					$("* .post").hide();
					$(".foreign").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#foreign").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
  		</script>
	</body>
</html>