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
		<style>
			h3 {
				text-transform: uppercase;
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
		<!-- Subcategories: Feed (post), Announcements (announcements), New Releases (releases),
		Trailers (trailers), Reviews (reviews), Just For Fun (fun) -->
		<div class="topic">
			<div id="feed" class="subtopic">
				<h5>Feed</h5>
			</div>
			<div id="announcements" class="subtopic">
				<h5>Announcements</h5>
			</div>
			<div id="releases" class="subtopic">
				<h5>New Releases</h5>
			</div>
			<div id="trailers" class="subtopic">
				<h5>Trailers</h5>
			</div>
			<div id="reviews" class="subtopic">
				<h5>Reviews</h5>
			</div>
			<div id="fun" class="subtopic">
				<h5>Just For Fun</h5>
			</div>
		</div>
		<!-- id of 1-100 for politics polls, 101-200 for sports polls, 201-300 for music polls, 301-400 for film polls -->
		<div class="content">
			<div id="film">



				<!-- Post 9 -->
				<section class="post announcements">
					<h3>Disney’s The Lion King hits Theaters This Thursday</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/7TavVZMewpY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br/>
			        <br/>
			        <p>Hype Meter:</p>
			        <br/>
			        <div id="result311">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>311))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<div class="slidecontainer">
								<input id="myRange7" class="slider" type="range" min="1" max="10" value="5"/>
								<br/>
								<br/>
								<span id="demo7" class="show"></span>
								<br/>
								<p class="sliderText">Drag slider left or right to choose answer</p>
								<input id="default311" type="button" name="numberSlider" value="Submit"
								onclick="showResult(<?php echo $userId; ?>, 311, this.name, 'num', 7, <?php echo $answered; ?>)"/>
						</div>
						<script>
							var slider7 = document.getElementById("myRange7");
							var output7 = document.getElementById("demo7");
							output7.innerHTML = slider7.value;
							slider7.oninput = function() {
									output7.innerHTML = this.value;
							}
						</script>
						<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default311").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



			    <!-- Post 8 -->
				<section class="post announcements fun">
		    	    <h3>Austin Butler Beats Out Harry Styles, Miles Teller to Play Elvis in Baz Luhrmann’s Biopic</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
		    	    <blockquote>
		    	    	“After an exhaustive casting search not unlike the one that landed Carey Mulligan the role of Daisy in Luhrmann’s bombastic retelling of The Great Gatsby, it was announced today that Austin Butler will be playing Elvis Presley in Luhrmann’s long-developing biopic of the iconic recording artist, performer, and actor. [...] The film is set up at Warner Bros. and will chart Presley’s rise and zenith, putting a particular focus on his relationship with his manager Col. Tom Parker, to be played by Tom Hanks.”
		    	    </blockquote>
		    	    <a href="http://collider.com/elvis-biopic-actor-austin-butler/#images" target="_blank">
		    	    	- Collider
		    	    </a>
		    	    <br/>
			        <br/>
			        <img class="images" src="photos/film/austinButler.jpg" alt="Austin Butler"/>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result310">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>310))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<img id="default310" class="react" src="photos/design/happy.png" alt="Happy" name="happy"
				    	onclick="showResult(<?php echo $userId; ?>, 310, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/good.png" alt="Good" name="good"
			        	onclick="showResult(<?php echo $userId; ?>, 310, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/neutral.png" alt="Neutral" name="neutral"
			        	onclick="showResult(<?php echo $userId; ?>, 310, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/sad.png" alt="Sad" name="sad"
			        	onclick="showResult(<?php echo $userId; ?>, 310, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/angry.png" alt="Angry" name="angry"
			        	onclick="showResult(<?php echo $userId; ?>, 310, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default310").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



			    <!-- Post 7 -->
				<section class="post announcements">
					<h3>Space Jam 2, Starring Lebron James, Set For Release on July 16, 2021</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
			        <a href="https://www.digitalspy.com/movies/a28320202/space-jam-2-cast-release-date-trailer-plot/" target="_blank">
		    	    	Click to read the full story
		    	    </a>
			        <br/>
			        <br/>
			        <img class="images" src="photos/film/spaceJam2.jpg" alt="Space Jam 2"/>
			        <br/>
			    	<br/>
			        <p>Hype Meter:</p>
			        <br/>
			        <div id="result309">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>309))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<div class="slidecontainer">
								<input id="myRange6" class="slider" type="range" min="1" max="10" value="5"/>
								<br/>
								<br/>
								<span id="demo6" class="show"></span>
								<br/>
								<p class="sliderText">Drag slider left or right to choose answer</p>
								<input id="default309" type="button" name="numberSlider" value="Submit"
								onclick="showResult(<?php echo $userId; ?>, 309, this.name, 'num', 6, <?php echo $answered; ?>)"/>
						</div>
						<script>
							var slider6 = document.getElementById("myRange6");
							var output6 = document.getElementById("demo6");
							output6.innerHTML = slider6.value;
							slider6.oninput = function() {
									output6.innerHTML = this.value;
							}
						</script>
						<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default309").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



			    <!-- Post 6 -->
				<section class="post trailers">
					<h3>QUENTIN TARANTINO'S "ONCE UPON A TIME IN HOLLYWOOD" SLATED FOR RELEASE ON JULY 26TH</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
			        <br/>
			        <br/>
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/ELeMaP8EPAA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br/>
			    	<br/>
			        <p>Hype Meter:</p>
			        <br/>
			        <div id="result308">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>308))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<div class="slidecontainer">
								<input id="myRange5" class="slider" type="range" min="1" max="10" value="5"/>
								<br/>
								<br/>
								<span id="demo5" class="show"></span>
								<br/>
								<p class="sliderText">Drag slider left or right to choose answer</p>
								<input id="default308" type="button" name="numberSlider" value="Submit"
								onclick="showResult(<?php echo $userId; ?>, 308, this.name, 'num', 5, <?php echo $answered; ?>)"/>
						</div>
						<script>
							var slider5 = document.getElementById("myRange5");
							var output5 = document.getElementById("demo5");
							output5.innerHTML = slider5.value;
							slider5.oninput = function() {
									output5.innerHTML = this.value;
							}
						</script>
						<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default308").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



			    <!-- Post 5 -->
				<section class="post releases">
					<h3>"SPIDERMAN: FAR FROM HOME" RELEASED ON JULY 2ND</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
			        <br/>
			        <img class="images" src="photos/film/spidermanFarFromHome.jpg" alt="Spiderman: Far From Home"/>
			        <br/>
			    	<br/>
			        <p>Your Rating:</p>
			        <br/>
			        <div id="result307">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>307))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<div class="slidecontainer">
								<input id="myRange4" class="slider" type="range" min="1" max="10" value="5"/>
								<br/>
								<br/>
								<span id="demo4" class="show"></span>
								<br/>
								<p class="sliderText">Drag slider left or right to choose answer</p>
								<input id="default307" type="button" name="numberSlider" value="Submit"
								onclick="showResult(<?php echo $userId; ?>, 307, this.name, 'num', 4, <?php echo $answered; ?>)"/>
						</div>
						<script>
							var slider4 = document.getElementById("myRange4");
							var output4 = document.getElementById("demo4");
							output4.innerHTML = slider4.value;
							slider4.oninput = function() {
									output4.innerHTML = this.value;
							}
						</script>
						<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default307").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



			    <!-- Post 4 -->
				<section class="post releases">
					<h3>MUCH AWAITED STRANGER THINGS 3 FINALLY RELEASED ON JULY 4TH, BREAKING NETFLIX VIEWERSHIP RECORDS</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
		    	    <blockquote>
		    	    	“According to the company's latest selective data dump, 40.7 million member accounts have watched at least part of Stranger Things' third season. (Netflix counts a "view" as a member account having watched 70 percent of one episode of a series or 70 percent of a film.) That's the fastest a Netflix original has ever accumulated such a large audience, according to the streamer.”
		    	    </blockquote>
		    	    <a href="https://www.hollywoodreporter.com/live-feed/stranger-things-racks-up-record-viewership-netflix-1223028" target="_blank">
		    	    	 - Rick Porter, The Hollywood Reporter
		    	    </a>
		    	    <br/>
			        <br/>
			        <img class="images" src="photos/film/strangerThings.jpg" alt="Stranger Things"/>
			        <br/>
			        <br/>
			        <p>Were you a part of the 40.7 million who tuned in on the day it came out?</p>
			        <br/>
			        <div id="result305">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>305))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			   		 	<input id="default305" class="btn btn-success" type="button" name="yes" value="Yes"
			   		 	onclick="showResult(<?php echo $userId; ?>, 305, this.name, 'yesNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="no" value="No"
			    		onclick="showResult(<?php echo $userId; ?>, 305, this.name, 'yesNo', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default305").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    	<br/>
			    	<br/>
			        <p>What is your overall rating of the new season?</p>
			        <br/>
			        <div id="result306">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>306))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<div class="slidecontainer">
								<input id="myRange3" class="slider" type="range" min="1" max="10" value="5"/>
								<br/>
								<br/>
								<span id="demo3" class="show"></span>
								<br/>
								<p class="sliderText">Drag slider left or right to choose answer</p>
								<input id="default306" type="button" name="numberSlider" value="Submit"
								onclick="showResult(<?php echo $userId; ?>, 306, this.name, 'num', 3, <?php echo $answered; ?>)"/>
						</div>
						<script>
							var slider3 = document.getElementById("myRange3");
							var output3 = document.getElementById("demo3");
							output3.innerHTML = slider3.value;
							slider3.oninput = function() {
									output3.innerHTML = this.value;
							}
						</script>
						<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default306").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



			    <!-- Post 3 -->
			    <section class="post reviews">
		    	    <h3>BOOKSMART: 4 STARS?</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
		    	    <blockquote>
		    	    	“Olivia Wilde’s electric feature debut, 'Booksmart,' is a stellar high school comedy with an A+ cast, a brilliant script loaded with witty dialogue, eye-catching cinematography, swift editing, and a danceable soundtrack."
		    	    </blockquote>
		    	    <a href="https://www.rogerebert.com/reviews/booksmart-2019" target="_blank">
		    	    	 - Monica Castillo, Rogerebert.com
		    	    </a>
			        <br/>
			        <br/>
			        <img class="images" src="photos/film/booksmart.jpg" alt="Booksmart"/>
			        <br/>
			        <br/>
			        <p>Do you agree with the rating?</p>
			        <br/>
			        <div id="result304">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>304))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			   		 	<input id="default304" class="btn btn-success" type="button" name="yes" value="Yes"
			   		 	onclick="showResult(<?php echo $userId; ?>, 304, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 304, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="no" value="No"
			    		onclick="showResult(<?php echo $userId; ?>, 304, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default304").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



			   	<!-- Post 2 -->
			   	<section class="post announcements">
		    	    <h3>FAST AND FURIOUS 10</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
		    	    <blockquote>
		    	    	"Currently, 'No plot details have been announced'”
		    	    </blockquote>
		    	    <a href="https://www.movieinsider.com/m13609/fast--furious-10" target="_blank">
		    	    	 — Movie Insider
		    	    </a>
		    	    <br/>
			        <br/>
			        <img class="images" src="photos/film/fastAndFurious.jpg" alt="Fast and Furious"/>
			        <br/>
			        <br/>
			        <p>Hype Meter:</p>
			        <br/>
			        <div id="result303">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>303))) {
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
								<input id="default303" type="button" name="numberSlider" value="Submit" onclick="showResult(<?php echo $userId; ?>, 303, this.name, 'num', 2, <?php echo $answered; ?>)"/>
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
						    		$("#default303").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



			    <!-- Post 1 -->
		    	<section class="post releases">
		    	    <h3>AVENGERS: ENDGAME RE-RELEASE</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
		    	    <blockquote>
		    	    	"Marvel honcho Kevin Feige said that the movie will be re-released on June 28 and that while the it's "not an extended cut," the movie will feature "a deleted scene, a little tribute, and a few surprises" at the end."
		    	    </blockquote>
		    	    <a href="https://www.wired.com/story/avengers-endgame-re-release/" target="_blank">
		    	    	- WIRED
		    	    </a>
		    	    <br/>
			        <br/>
			        <img class="images" src="photos/film/avengers.png" alt="Avengers"/>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result301">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>301))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<img id="default301" class="react" src="photos/design/happy.png" alt="Happy" name="happy"
				    	onclick="showResult(<?php echo $userId; ?>, 301, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/good.png" alt="Good" name="good"
			        	onclick="showResult(<?php echo $userId; ?>, 301, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/neutral.png" alt="Neutral" name="neutral"
			        	onclick="showResult(<?php echo $userId; ?>, 301, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/sad.png" alt="Sad" name="sad"
			        	onclick="showResult(<?php echo $userId; ?>, 301, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/angry.png" alt="Angry" name="angry"
			        	onclick="showResult(<?php echo $userId; ?>, 301, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default301").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    	<br/>
			    	<br/>
			        <p>What is your overall rating of the original movie?</p>
			        <br/>
			        <div id="result302">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>302))) {
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
								<input id="default302" type="button" name="numberSlider" value="Submit"
								onclick="showResult(<?php echo $userId; ?>, 302, this.name, 'num', 1, <?php echo $answered; ?>)"/>
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
						    		$("#default302").trigger("click");
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
				$("#film").css({"background-color": "#32CD32", "color": "#fff"});
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
				$("#announcements").on("click", function() {
					$("* .post").hide();
					$(".announcements").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#announcements").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#releases").on("click", function() {
					$("* .post").hide();
					$(".releases").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#releases").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#trailers").on("click", function() {
					$("* .post").hide();
					$(".trailers").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#trailers").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#reviews").on("click", function() {
					$("* .post").hide();
					$(".reviews").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#reviews").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#fun").on("click", function() {
					$("* .post").hide();
					$(".fun").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#fun").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
  		</script>
	</body>
</html>