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
					<li><a id="politics" href="politics.php">Politics</a></li>
					<li><a id="sports" href="sports.php">Sports</a></li>
					<li><a id="music" href="music.php">Music</a></li>
					<li><a id="film" href="film.php">TV & Film</a></li>
					<li><a id="feedback" href="http://bit.ly/2X3yV0q" target="_blank">Feedback</a></li>
				</ul>
			</nav>
		</header>
		<!-- id of 1-100 for politics polls, 101-200 for sports polls, 201-300 for music polls, 301-400 for film polls -->
		<div class="content">
			<div id="politics">
		    	<section class="post">
		    	    <h3>TRUMP DELAYS ICE RAIDS</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"President Donald Trump announced Saturday that he's delaying for two weeks US Immigration and Customs Enforcement raids that were planned to take place Sunday in 10 major US cities, saying deportations will proceed unless Congress finds a solution on the US-Mexico border."
		    	    </blockquote>
		    	    <a href="https://www.cnn.com/2019/06/22/politics/ice-raids-sunday-10-cities-donald-trump-defends-arrests/index.html" target="_blank">
		    	    	 - CNN
		    	    </a>
			        <br />
			        <img class="images" src="photos/politics/ICE.jpg" alt="ICE"/>
			        <br />
			        <br />
			        <p>REACT:</p>
			        <br />
			        <div id="result1">
				    	<img class="react" src="photos/design/happy.png" alt="Happy" name="happy" onclick="showResult(1, this.name, 'react')"/>
			        	<img class="react" src="photos/design/good.png" alt="Good" name="good" onclick="showResult(1, this.name, 'react')"/>
			        	<img class="react" src="photos/design/neutral.png" alt="Neutral" name="neutral" onclick="showResult(1, this.name, 'react')"/>
			        	<img class="react" src="photos/design/sad.png" alt="Sad" name="sad" onclick="showResult(1, this.name, 'react')"/>
			        	<img class="react" src="photos/design/angry.png" alt="Angry" name="angry" onclick="showResult(1, this.name, 'react')"/>
			    	</div>
			    </section>
			    <section class="post">
			        <h3>ELIZABETH WARREN ON PRIVATE PRISONS</h3>
			        <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
			        <blockquote>
			        	"We need significant reform in both criminal justice and in immigration, to end mass incarceration and all of the unnecessary, cruel, and punitive forms of immigration detention that have taken root in the Trump Administration... Washington works hand-in-hand with private prison companies, who spend millions on lobbyists, campaign contributions, and revolving-door hires -- all to turn our criminal and immigration policies into ones that prioritize making them rich instead of keeping us safe,"
			        	</blockquote>
			        	<a href="https://www.cnn.com/2019/06/21/politics/elizabeth-warren-ban-private-prisons-detention-facilities/index.html" target="_blank">
			        		 - Elizabeth Warren, CNN
			        	</a>
			        <br />
			        <img class="images" src="photos/politics/elizabethWarren.jpg" alt="Elizabeth Warren"/>
			        <br />
			        <br />
			        <p>Do you agree with Warren's assertion?</p>
			        <br />
			        <div id="result2">
			    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(2, this.name, 'yesno')">
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(2, this.name, 'yesno')">
			    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(2, this.name, 'yesno')">
			    	</div>
			    	<br />
			        <p>Does what she said make you have a more or less favorable view of the candidate?</p>
			        <br />
			        <div id="result3">
			    		<input class="btn btn-success" type="button" name="more" value="More" onclick="showResult(3, this.name, 'moreless')">
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(3, this.name, 'moreless')">
			    		<input class="btn btn-danger" type="button" name="less" value="Less" onclick="showResult(3, this.name, 'moreless')">
			    	</div>
			    </section>
			    <section class="post">
			        <h3>ALEXANDRIA OCASIO-CORTEZ CALLS TRUMP'S MIGRANT CENTERS CONCENTRATION CAMPS</h3>
			        <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
			        <blockquote>
			        	"The United States is running concentration camps on our southern border"
			        </blockquote>
			        <a href="https://www.cnn.com/videos/politics/2019/06/18/alexandria-ocasio-cortez-aoc-concentration-camps-border-ice-vstan-orig-js.cnn" target="_blank">
			        	 - Alexandria Ocasio-Cortez, CNN
			        </a>
			        <br />
			        <img class="images" src="photos/politics/border.jpg" alt="Migrant Center / Concentration Camp"/>
			        <br />
			        <br />
			        <p>On a scale of 1 to 10, how much do you agree with her use of the term "concentration camp"?</p>
			        <br />
			        <div id="result4">
			    		<div class="slidecontainer">
								<input id="myRange1" class="slider" type="range" min="1" max="10" value="5">
								<br />
								<br />
								<span id="demo1" class="show"></span>
								<br />
								<p class="sliderText">Drag slider left or right to choose answer</p>
								<input type="button" name="numberSlider" value="Submit" onclick="showResult(4, this.name, 'num', 1)">
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
			    	<br />
			    	<p>On a scale of 1 to 10, how much do you agree with the current immigration laws in the United States?</p>
			        <br />
			        <div id="result5">
			    		<div class="slidecontainer">
								<input id="myRange2" class="slider" type="range" min="1" max="10" value="5">
								<br />
								<br />
								<span id="demo2" class="show"></span>
								<br />
								<p class="sliderText">Drag slider left or right to choose answer</p>
								<input type="button" name="numberSlider" value="Submit" onclick="showResult(5, this.name, 'num', 2)">
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
			    	<br />
			        <p>Does her statement make you have a more or less favorable view of AOC?</p>
			        <br />
			        <div id="result6">
			    		<input class="btn btn-success" type="button" name="more" value="More" onclick="showResult(6, this.name, 'moreless')">
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(6, this.name, 'moreless')">
			    		<input class="btn btn-danger" type="button" name="less" value="Less" onclick="showResult(6, this.name, 'moreless')">
			    	</div>
			    </section>
			</div>
		</div>
		<script src="js/slant.js">
		</script>
	</body>
</html>