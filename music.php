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
				<ul>
					<li><a href="homepage.php">Home</a></li>
					<li><a href="politics.php">Politics</a></li>
					<li><a href="sports.php">Sports</a></li>
					<li><a href="music.php">Music</a></li>
					<li><a href="film.php">TV & Film</a></li>
					<li><a href="http://bit.ly/2X3yV0q" target="_blank">Feedback</a></li>
				</ul>
			</nav>
		</header>
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
		</div>
		<!-- id of 1-100 for politics polls, 101-200 for sports polls, 201-300 for music polls, 301-400 for film polls -->
		<div class="content">
			<div id="music">
		    	<section class="post hip-hop">
		    	    <h3>CARDI B HOPS ON LIL NAS X'S "RODEO"</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br />
		    	    <br />
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/kx0Z0B8Xox0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br />
			        <br />
			        <p>REACT:</p>
			        <br />
			        <div id="result201">
			        	<img class="rate" src="photos/design/fire.png" alt="Fire" name="fire" onclick="showResult(201, this.name, 'rate')"/>
			        	<img class="rate" src="photos/design/decent.png" alt="Decent" name="decent" onclick="showResult(201, this.name, 'rate')"/>
			        	<img class="rate" src="photos/design/trash.png" alt="Trash" name="trash" onclick="showResult(201, this.name, 'rate')"/>
			    	</div>
			    </section>
			    <section class="post pop">
		    	    <h3>RITA ORA, TIËSTO AND JONAS BLUE DROP VIDEO FOR COLLAB "RITUAL"</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent" />
		    	    <br />
		    	    <br />
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/ontU9cOg354" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br />
			        <br />
			        <p>REACT:</p>
			        <br />
			        <div id="result202">
				    	<img id="fireButton" class="rateButton" src="photos/design/fireButton.png" alt="Fire Button" name="fire" onclick="showResult(202, this.name, 'rate')"/>
			        	<img class="rateButton" src="photos/design/decentButton.png" alt="Decent Button" name="decent" onclick="showResult(202, this.name, 'rate')"/>
			        	<img class="rateButton" src="photos/design/trashButton.png" alt="Trash Button" name="trash" onclick="showResult(202, this.name, 'rate')"/>
			    	</div>
			    </section>
			    <section class="post hip-hop">
		    	    <h3>KILLER MIKE: RAPPERS DESERVE CREDIT FOR PROGRESSIVE WEED LAWS</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	“We know that with national decriminalization of marijuana now, a lot of people are going to get credit for it—a lot of activists, a lot of workers […] but I can show you a line that leads straight back to Cypress Hill, that leads straight back to Snoop Dogg, that leads straight back to people like [the late R&B/funk guitarist] Rick James."
		    	    </blockquote>
		    	    <a href="https://youtu.be/QOxzlX9BczY" target="_blank">
		    	    	 - Killer Mike, Complex
		    	    </a>
		    	    <br />
			        <img class="images" src="photos/music/killerMike.jpg" alt="Killer Mike"/>
			        <br />
			        <br />
			        <p>On a scale of 1 to 10, how much do you agree that rappers deserve credit for shifting cultural perceptions of marijuana?</p>
			        <br />
			        <div id="result203">
			    		<div class="slidecontainer">
								<input id="myRange3" class="slider" type="range" min="1" max="10" value="5">
								<br />
								<br />
								<span id="demo3" class="show"></span>
								<br />
								<p class="sliderText">Drag slider left or right to choose answer</p>
								<input type="button" name="numberSlider" value="Submit" onclick="showResult(203, this.name, 'num', 3)">
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
			    </section>
			    <section class="post pop">
		    	    <h3>BILLIE EILISH THINKS IT'S "WEIRD" THAT SHE'S CALLED "THE NEW FACE OF POP", WANTS TO BE MORE</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	“As grateful as I am for the appreciation and the love, honestly, I've become numb to it. I remember the first couple of times people called me the face of pop or pop's new It girl or whatever the fuck... it kind of irked me. The weird thing about humans is we [think we] have to label everything, but we don't."
		    	    </blockquote>
		    	    <a href="https://www.vogue.com.au/celebrity/interviews/how-billie-eilish-went-from-unknown-teen-to-megastar-in-two-years/image-gallery/4f656153176bac884b94ec750bb49d52?pos=7" target="_blank">
		    	    	 - Billie Eilish, Vogue
		    	    </a>
			        <br />
			        <img class="images" src="photos/music/billieEilish.jpg" alt="Billie Eilish"/>
			        <br />
			        <br />
			        <p>Is Billie Eilish the new face of pop music?</p>
			        <br />
			        <div id="result204">
			    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(204, this.name, 'yesno')">
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(204, this.name, 'yesno')">
			    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(204, this.name, 'yesno')">
			    	</div>
			    	<br />
			        <blockquote>
			        	"I really don't want to waste my platform. I'm trying not to but I think all of us in the spotlight — or whatever you want to call it — can be more vocal about climate change and things that need to be talked about. I still think I can do more.”
			        </blockquote>
			        <a href="https://www.vogue.com.au/celebrity/interviews/how-billie-eilish-went-from-unknown-teen-to-megastar-in-two-years/image-gallery/4f656153176bac884b94ec750bb49d52?pos=7" target="_blank">
			        	 - Billie Eilish, Vogue
			         </a>
			        <br />
			        <p>Should entertainers use their platform to raise awareness about social issues?</p>
			        <br />
			        <div id="result205">
			    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(205, this.name, 'yesno')">
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(205, this.name, 'yesno')">
			    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(205, this.name, 'yesno')">
			    	</div>
			    	<br />
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
				$("#discover").on("click", function() {
					$("* .post").hide();
					$(".discover").show();
				});
			});
			$(function() {
				$("#hip-hop").on("click", function() {
					$("* .post").hide();
					$(".hip-hop").show();
				});
			});
			$(function() {
				$("#pop").on("click", function() {
					$("* .post").hide();
					$(".pop").show();
				});
			});
			$(function() {
				$("#rock").on("click", function() {
					$("* .post").hide();
					$(".rock").show();
				});
			});
  		</script>
	</body>
</html>