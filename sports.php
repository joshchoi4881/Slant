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
		</style>
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
		<!-- Subcategories: Feed (post), NBA (nba), NFL (nfl), MLB (mlb), NHL (nhl), and FIFA (fifa) -->
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
			<div id="fifa" class="subtopic">
				<h5>FIFA</h5>
			</div>
		</div>
		<!-- id of 1-100 for politics polls, 101-200 for sports polls, 201-300 for music polls, 301-400 for film polls -->
		<div class="content">
			<div id="sports">



				<section class="post nfl">
		    	    <h3>NFL FREE AGENCY OFFICIALLY OVER</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
			        <br/>
			        <img class="images" src="photos/sports/nfl.jpg" alt="NFL"/>
			        <br/>
			        <br/>
			        <p>Who are next year’s favorites?</p>
			        <br/>
			        <div id="result108">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>108))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<img id="default108" class="predict" src="photos/design/patriots.png" alt="Patriots" name="patriots"
			    		onclick="showResult(<?php echo $userId; ?>, 108, this.name, 'nflPredict', 0, <?php echo $answered; ?>)"/>
			        	<img class="predict" src="photos/design/saints.jpg" alt="Saints" name="saints"
			        	onclick="showResult(<?php echo $userId; ?>, 108, this.name, 'nflPredict', 0, <?php echo $answered; ?>)"/>
			        	<img class="predict" src="photos/design/chiefs.png" alt="Chiefs" name="chiefs"
			        	onclick="showResult(<?php echo $userId; ?>, 108, this.name, 'nflPredict', 0, <?php echo $answered; ?>)"/>
			        	<img class="predict" src="photos/design/rams.jpg" alt="Rams" name="rams"
			        	onclick="showResult(<?php echo $userId; ?>, 108, this.name, 'nflPredict', 0, <?php echo $answered; ?>)"/>
			        	<img class="predict" src="photos/design/other.png" alt="Other" name="other"
			        	onclick="showResult(<?php echo $userId; ?>, 108, this.name, 'nflPredict', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default108").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



				<section class="post fifa">
					<h3>U.S. WOMEN'S TEAM WIN WORLD CUP, CONTINUE LEGAL BATTLE FOR EQUAL PAY</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"A comparison of the WNT and MNT pay shows that if each team played 20 friendlies in a year and each team won all twenty friendlies," the complaint says, "female WNT players would earn a maximum of $99,000 or $4,950 per game, while similarly situated male MNT players would earn an average of $263,320 or $13,166 per game against the various levels of competition they would face." In other words, a top-tier women's player would earn just 38 percent of the compensation of a similarly situated player on the men's team.”
		    	    </blockquote>
		    	    <a href="https://www.npr.org/2019/03/08/701522635/u-s-womens-soccer-team-sues-u-s-soccer-for-gender-discrimination" target="_blank">
		    	    	 - Laurel Wamsley, NPR
		    	    </a>
			        <br/>
			        <img class="images" src="photos/sports/usWomensSoccer.jpg" alt="U.S. Women's Soccer"/>
			        <br/>
			        <br/>
			        <p>Do you support the US women’s team lawsuit against US soccer?</p>
			        <br/>
			        <div id="result106">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>106))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default106" class="btn btn-success" type="button" name="yes" value="Yes"
			    		onclick="showResult(<?php echo $userId; ?>, 106, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 106, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="no" value="No"
			    		onclick="showResult(<?php echo $userId; ?>, 106, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default106").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    	<br/>
			        <p>How should the U.S. women’s team be compensated compared to the men’s?</p>
			        <br/>
			        <div id="result107">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>107))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default107" class="btn btn-success" type="button" name="more" value="More"
			    		onclick="showResult(<?php echo $userId; ?>, 107, this.name, 'moreIdkLess', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 107, this.name, 'moreIdkLess', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="less" value="Less"
			    		onclick="showResult(<?php echo $userId; ?>, 107, this.name, 'moreIdkLess', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default107").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



				<section class="post nba">
		    	    <h3>PREDICTION FOR 2019-2020 NBA SEASON</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"The Clippers are the favorite at 3-1 NBA title odds for 2019-20. The Bucks are next at 9-2 NBA championship odds, while the Lakers are 5-1 and the Philadelphia 76ers are 8-1. The Warriors, Rockets, Jazz and Nuggets are all 16-1 or lower as well. But not all NBA title team odds are value picks. Some teams are positioned far higher on the board than they should be, while others are far too low"
		    	    </blockquote>
		    	    <a href="https://www.cbssports.com/nba/news/nba-title-odds-2020-predictions-picks-teams-to-avoid-from-advanced-computer-model/" target="_blank">
		    	    	 - CBS Sports
		    	    </a>
			        <br/>
			        <img class="images" src="photos/sports/nba2019-2020Prediction.webp" alt="NBA Title Odds for 2019-2020"/>
			        <br/>
			        <br/>
			        <p>Which team do you think has the best NBA title odds for the 2019-2020 season?</p>
			        <br/>
			        <div id="result105">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>105))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<img id="default105" class="predict" src="photos/design/clippers.png" alt="Clippers" name="clippers"
			    		onclick="showResult(<?php echo $userId; ?>, 105, this.name, 'nbaPredict', 0, <?php echo $answered; ?>)"/>
			        	<img class="predict" src="photos/design/bucks.png" alt="Bucks" name="bucks"
			        	onclick="showResult(<?php echo $userId; ?>, 105, this.name, 'nbaPredict', 0, <?php echo $answered; ?>)"/>
			        	<img class="predict" src="photos/design/lakers.jpg" alt="Lakers" name="lakers"
			        	onclick="showResult(<?php echo $userId; ?>, 105, this.name, 'nbaPredict', 0, <?php echo $answered; ?>)"/>
			        	<img class="predict" src="photos/design/76ers.png" alt="76ers" name="76ers"
			        	onclick="showResult(<?php echo $userId; ?>, 105, this.name, 'nbaPredict', 0, <?php echo $answered; ?>)"/>
			        	<img class="predict" src="photos/design/other.jpg" alt="Other" name="other"
			        	onclick="showResult(<?php echo $userId; ?>, 105, this.name, 'nbaPredict', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default105").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



				<section class="post nba">
		    	    <h3>KAWHI LEONARD SIGNS TO L.A. CLIPPERS</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	“I think it’s good for basketball, good for L.A., [..] I think it’ll bring a little bit more balance to the Los Angeles basketball scene, so its good!”
		    	    </blockquote>
		    	    <a href="https://www.tmz.com/2019/07/06/blake-griffin-kawhi-leonard-nba-clippers-lakers/" target="_blank">
		    	    	 - Blake Griffin, TMZ Sports
		    	    </a>
			        <br/>
			        <img class="images" src="photos/sports/kawhiLeonardClippers.jpg" alt="Kawhi Leonard"/>
			        <br/>
			        <br/>
			        <p>Do you agree with Kawhi’s decision to sign to the clippers?</p>
			        <br/>
			        <div id="result104">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>104))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default104" class="btn btn-success" type="button" name="yes" value="Yes"
			    		onclick="showResult(<?php echo $userId; ?>, 104, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 104, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="no" value="No"
			    		onclick="showResult(<?php echo $userId; ?>, 104, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default104").trigger("click");
						    	});
						    }
					    </script>
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
			        <br/>
			        <img class="images" src="photos/sports/kawhiLeonardRaptors.jpeg" alt="Kawhi Leonard"/>
			        <br/>
			        <br/>
			        <p>Will Kawhi stay in Toronto?</p>
			        <br/>
			        <div id="result103">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>103))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default103" class="btn btn-success" type="button" name="yes" value="Yes"
			    		onclick="showResult(<?php echo $userId; ?>, 103, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 103, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="no" value="No"
			    		onclick="showResult(<?php echo $userId; ?>, 103, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default103").trigger("click");
						    	});
						    }
					    </script>
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
			        <br/>
			        <img class="images" src="photos/sports/anthonyDavis.jpg" alt="Anthony Davis"/>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result102">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>102))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<img id="default102" class="react" src="photos/design/happy.png" alt="Happy" name="happy"
				    	onclick="showResult(<?php echo $userId; ?>, 102, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/good.png" alt="Good" name="good"
			        	onclick="showResult(<?php echo $userId; ?>, 102, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/neutral.png" alt="Neutral" name="neutral"
			        	onclick="showResult(<?php echo $userId; ?>, 102, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/sad.png" alt="Sad" name="sad"
			        	onclick="showResult(<?php echo $userId; ?>, 102, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<img class="react" src="photos/design/angry.png" alt="Angry" name="angry"
			        	onclick="showResult(<?php echo $userId; ?>, 102, this.name, 'react', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default102").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



		    	<section class="post nba">
		    	    <h3>ZION WILLIAMSON</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <blockquote>
		    	    	"If Zion doesn't change, I predict that he will be the first basketball athlete at 18 years old that the world is rooting for to become a billionaire. I say billionaire, very easily... He is going to have an opportunity to be the face of every company and every major corporation. He is the most marketable person I've seen, for a lot of different reasons."
		    	    </blockquote>
		    	    <a href="https://www.espn.com/nba/story/_/id/26392054/zion-williamson-get-paid" target="_blank">
		    	    	 - Sonny Vaccaro, ESPN
		    	    </a>
			        <br/>
			        <img class="images" src="photos/sports/zionWilliamson.jpg" alt="Zion Williamson"/>
			        <br/>
			        <br/>
			        <p>Is Zion Williamson the next face of the NBA?</p>
			        <br/>
			        <div id="result101">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>101))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default101" class="btn btn-success" type="button" name="yes" value="Yes"
			    		onclick="showResult(<?php echo $userId; ?>, 101, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 101, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="no" value="No"
			    		onclick="showResult(<?php echo $userId; ?>, 101, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default101").trigger("click");
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
				$("#sports").css({"background-color": "#32CD32", "color": "#fff"});
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
				$("#nba").on("click", function() {
					$("* .post").hide();
					$(".nba").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#nba").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#nfl").on("click", function() {
					$("* .post").hide();
					$(".nfl").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#nfl").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#mlb").on("click", function() {
					$("* .post").hide();
					$(".mlb").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#mlb").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#nhl").on("click", function() {
					$("* .post").hide();
					$(".nhl").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#nhl").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#fifa").on("click", function() {
					$("* .post").hide();
					$(".fifa").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#fifa").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
  		</script>
	</body>
</html>