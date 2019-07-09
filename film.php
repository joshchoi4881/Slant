<!DOCTYPE html>
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
			<nav>
				<div>
					<a href="homepage.php">Home</a>
					<a href="politics.php">Politics</a>
					<a href="sports.php">Sports</a>
					<a href="music.php">Music</a>
					<a href="film.php">TV & Film</a>
					<a href="http://bit.ly/2X3yV0q" target="_blank">Feedback</a>
				</div>
			</nav>
		</header>
		<div class="topic">
			<div id="feed" class="subtopic">
				<h5>Feed</h5>
			</div>
			<div id="announcements" class="subtopic">
				<h5>Announcements</h5>
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
		    	<section class="post announcements">
		    	    <h3>AVENGERS: ENDGAME RE-RELEASE</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent" />
		    	    <blockquote>
		    	    	"Marvel honcho Kevin Feige said that the movie will be re-released on June 28 and that while the it's "not an extended cut," the movie will feature "a deleted scene, a little tribute, and a few surprises" at the end."
		    	    </blockquote>
		    	    <a href="https://www.wired.com/story/avengers-endgame-re-release/" target="_blank">
		    	    	- WIRED
		    	    </a>
			        <br />
			        <img class="images" src="photos/film/avengers.png" alt="Avengers"/>
			        <br />
			        <br />
			        <p>REACT:</p>
			        <br />
			        <div id="result301">
				    	<img class="react" src="photos/design/happy.png" alt="Happy" name="happy" onclick="showResult(301, this.name, 'react')"/>
			        	<img class="react" src="photos/design/good.png" alt="Good" name="good" onclick="showResult(301, this.name, 'react')"/>
			        	<img class="react" src="photos/design/neutral.png" alt="Neutral" name="neutral" onclick="showResult(301, this.name, 'react')"/>
			        	<img class="react" src="photos/design/sad.png" alt="Sad" name="sad" onclick="showResult(301, this.name, 'react')"/>
			        	<img class="react" src="photos/design/angry.png" alt="Angry" name="angry" onclick="showResult(301, this.name, 'react')"/>
			    	</div>
			    	<br />
			        <p>What is your overall rating of the original movie?</p>
			        <br />
			        <div id="result302">
				    	<div class="slidecontainer">
								<input id="myRange4" class="slider" type="range" min="1" max="10" value="5">
								<br />
								<br />
								<span id="demo4" class="show"></span>
								<br />
								<p class="sliderText">Drag slider left or right to choose answer</p>
								<input type="button" name="numberSlider" value="Submit" onclick="showResult(302, this.name, 'num', 4)">
						</div>
						<script>
							var slider4 = document.getElementById("myRange4");
							var output4 = document.getElementById("demo4");
							output4.innerHTML = slider4.value;
							slider4.oninput = function() {
									output4.innerHTML = this.value;
							}
						</script>
			    	</div>
			    </section>
			   <section class="post announcements">
		    	    <h3>FAST AND FURIOUS 10</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"Currently, 'No plot details have been announced'”
		    	    </blockquote>
		    	    <a href="https://www.movieinsider.com/m13609/fast--furious-10" target="_blank">
		    	    	 — Movie Insider
		    	    </a>
			        <br />
			        <img class="images" src="photos/film/fastAndFurious.jpg" alt="Fast and Furious"/>
			        <br />
			        <br />
			        <p>Hype Meter:</p>
			        <br />
			        <div id="result303">
				    	<div class="slidecontainer">
								<input id="myRange5" class="slider" type="range" min="1" max="10" value="5">
								<br />
								<br />
								<span id="demo5" class="show"></span>
								<br />
								<p class="sliderText">Drag slider left or right to choose answer</p>
								<input type="button" name="numberSlider" value="Submit" onclick="showResult(303, this.name, 'num', 5)">
						</div>
						<script>
							var slider5 = document.getElementById("myRange5");
							var output5 = document.getElementById("demo5");
							output5.innerHTML = slider5.value;
							slider5.oninput = function() {
									output5.innerHTML = this.value;
							}
						</script>
			    	</div>
			    </section>
			    <section class="post reviews">
		    	    <h3>BOOKSMART: 4 STARS?</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	“Olivia Wilde’s electric feature debut, 'Booksmart,' is a stellar high school comedy with an A+ cast, a brilliant script loaded with witty dialogue, eye-catching cinematography, swift editing, and a danceable soundtrack."
		    	    </blockquote>
		    	    <a href="https://www.rogerebert.com/reviews/booksmart-2019" target="_blank">
		    	    	 - Monica Castillo, Rogerebert.com
		    	    </a>
			        <br />
			        <img class="images" src="photos/film/booksmart.jpg" alt="Booksmart"/>
			        <br />
			        <br />
			        <p>Do you agree with the rating?</p>
			        <br />
			        <div id="result304">
			   		 	<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(304, this.name, 'yesno')">
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(304, this.name, 'yesno')">
			    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(304, this.name, 'yesno')">
			    	</div>
			    </section>
			</div>
		</div>
		<script src="js/slant.js">
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
			$(function() {
				$("#feed").on("click", function() {
					$("* .post").show();
				});
			});
			$(function() {
				$("#announcements").on("click", function() {
					$("* .post").hide();
					$(".announcements").show();
				});
			});
			$(function() {
				$("#trailers").on("click", function() {
					$("* .post").hide();
					$(".trailers").show();
				});
			});
			$(function() {
				$("#reviews").on("click", function() {
					$("* .post").hide();
					$(".reviews").show();
				});
			});
			$(function() {
				$("#fun").on("click", function() {
					$("* .post").hide();
					$(".fun").show();
				});
			});
  		</script>
	</body>
</html>