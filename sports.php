<!DOCTYPE html>
<?php
	include("classes/database.php");
	include("classes/loginFunction.php");
	$log;
	$userId;
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
							<a href='profile.php'>Profile</a>
							<a href='logout.php'>Logout</a>";
					} else {
						echo "<a href='signUp.php'>Sign Up</a>
							<a href='login.php'>Login</a>";
					}
				?>
			</div>
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
			<div id="nba" class="subtopic">
				<h5>NBA</h5>
			</div>
			<div id="nfl" class="subtopic">
				<h5>NFL</h5>
			</div>
			<div id="mlb" class="subtopic">
				<h5>MLB</h5>
			</div>
			<div id="nhl" class="subtopic">
				<h5>NHL</h5>
			</div>
		</div>
		<!-- id of 1-100 for politics polls, 101-200 for sports polls, 201-300 for music polls, 301-400 for film polls -->
		<div class="content">
			<div id="sports">
		    	<section class="post nba">
		    	    <h3>ZION WILLIAMSON</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"If Zion doesn't change, I predict that he will be the first basketball athlete at 18 years old that the world is rooting for to become a billionaire. I say billionaire, very easily... He is going to have an opportunity to be the face of every company and every major corporation. He is the most marketable person I've seen, for a lot of different reasons."
		    	    </blockquote>
		    	    <a href="https://www.espn.com/nba/story/_/id/26392054/zion-williamson-get-paid" target="_blank">
		    	    	 - Sonny Vaccaro, ESPN
		    	    </a>
			        <br />
			        <img class="images" src="photos/sports/zionWilliamson.jpg" alt="Zion Williamson"/>
			        <br />
			        <br />
			        <p>Is Zion Williamson the next face of the NBA?</p>
			        <br />
			        <div id="result101">
			    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(101, this.name, 'yesno')">
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(101, this.name, 'yesno')">
			    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(101, this.name, 'yesno')">
			    	</div>
			    </section>
			    <section class="post nba">
		    	    <h3>ANTHONY DAVIS TO LA LAKERS</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"The Los Angeles Lakers’ storied penchant for acquiring elite big men when they need them most resurfaced Saturday when the glamorous but struggling franchise reached agreement on a trade to acquire Anthony Davis from the New Orleans Pelicans — thus pairing Davis, a six-time All Star, with LeBron James.""
		    	    </blockquote>
		    	    <a href="https://www.nytimes.com/2019/06/15/sports/lakers-trade-anthony-davis.html" target="_blank">
		    	    	 - New York Times
		    	    </a>
			        <br />
			        <img class="images" src="photos/sports/anthonyDavis.jpg" alt="Anthony Davis"/>
			        <br />
			        <br />
			        <p>REACT:</p>
			        <br />
			        <div id="result102">
				    	<img class="react" src="photos/design/happy.png" alt="Happy" name="happy" onclick="showResult(102, this.name, 'react')"/>
			        	<img class="react" src="photos/design/good.png" alt="Good" name="good" onclick="showResult(102, this.name, 'react')"/>
			        	<img class="react" src="photos/design/neutral.png" alt="Neutral" name="neutral" onclick="showResult(102, this.name, 'react')"/>
			        	<img class="react" src="photos/design/sad.png" alt="Sad" name="sad" onclick="showResult(102, this.name, 'react')"/>
			        	<img class="react" src="photos/design/angry.png" alt="Angry" name="angry" onclick="showResult(102, this.name, 'react')"/>
			    	</div>
			    </section>
			    <section class="post nba">
		    	    <h3>KAWHI LEONARD: TORONTO OR LA?</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"With Kawhi Leonard potentially hitting free agency next summer, the Toronto Raptors could be fighting an uphill battle to retain their superstar past this season... 'They can't change the geography,' Wojnarowski said. 'They can't change the weather in Toronto. Those were always be things against them in this. Home and L.A. has been the focus for Kawhi Leonard through all of this.'"
		    	    </blockquote>
		    	    <a href="https://bleacherreport.com/articles/2810940-kawhi-leonard-reportedly-focused-on-home-and-la-as-potential-2019-free-agent" target="_blank">
		    	    	 - Bleacher Report
		    	    </a>
			        <br />
			        <img class="images" src="photos/sports/kawhiLeonard.jpeg" alt="Kawhi Leonard"/>
			        <br />
			        <br />
			        <p>Will Kawhi stay in Toronto?</p>
			        <br />
			        <div id="result103">
			    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(103, this.name, 'yesno')">
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(103, this.name, 'yesno')">
			    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(103, this.name, 'yesno')">
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
				$("#nba").on("click", function() {
					$("* .post").hide();
					$(".nba").show();
				});
			});
			$(function() {
				$("#nfl").on("click", function() {
					$("* .post").hide();
					$(".nfl").show();
				});
			});
			$(function() {
				$("#mlb").on("click", function() {
					$("* .post").hide();
					$(".mlb").show();
				});
			});
			$(function() {
				$("#nhl").on("click", function() {
					$("* .post").hide();
					$(".nhl").show();
				});
			});
  		</script>
	</body>
</html>