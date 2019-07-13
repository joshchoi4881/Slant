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
		<!-- Subcategories: Feed (post), Discover (discover), Hip-Hop (hip-hop), Pop (pop), Rock (rock) -->
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
					<h3>WATCH: POST MALONE RISES FROM THE DEAD IN NEW VIDEO FOR "GOODBYES"</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/ba7mB8oueCY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result208">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>208))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<img id="default208" class="rateButton" src="photos/design/fireButton.png" alt="Fire Button" name="fire"
				    	onclick="showResult(<?php echo $userId; ?>, 208, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<img class="rateButton" src="photos/design/decentButton.png" alt="Decent Button" name="decent"
			        	onclick="showResult(<?php echo $userId; ?>, 208, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<img class="rateButton" src="photos/design/trashButton.png" alt="Trash Button" name="trash"
			        	onclick="showResult(<?php echo $userId; ?>, 208, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default208").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



				<section class="post hip-hop">
					<h3>LISTEN: RICK ROSS AND SWIZZ BEATZ DROP NEW TRACK "BIG TYME"</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/pE4Uf3DXssI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result207">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>207))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			        	<img id="default207" class="rate" src="photos/design/fire.png" alt="Fire" name="fire"
			        	onclick="showResult(<?php echo $userId; ?>, 207, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<img class="rate" src="photos/design/decent.png" alt="Decent" name="decent"
			        	onclick="showResult(<?php echo $userId; ?>, 207, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<img class="rate" src="photos/design/trash.png" alt="Trash" name="trash"
			        	onclick="showResult(<?php echo $userId; ?>, 207, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default207").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



				<section class="post hip-hop">
					<h3>WATCH: TYGA PAYS RESPECTS IN NEW "LIGHTSKIN LIL WAYNE" MUSIC VIDEO</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/5ju4JoN3ZKc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result206">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>206))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<img id="default206" class="rateButton" src="photos/design/fireButton.png" alt="Fire Button" name="fire"
				    	onclick="showResult(<?php echo $userId; ?>, 206, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<img class="rateButton" src="photos/design/decentButton.png" alt="Decent Button" name="decent"
			        	onclick="showResult(<?php echo $userId; ?>, 206, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<img class="rateButton" src="photos/design/trashButton.png" alt="Trash Button" name="trash"
			        	onclick="showResult(<?php echo $userId; ?>, 206, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default206").trigger("click");
						    	});
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
			        <br/>
			        <img class="images" src="photos/music/billieEilish.jpg" alt="Billie Eilish"/>
			        <br/>
			        <br/>
			        <p>Is Billie Eilish the new face of pop music?</p>
			        <br/>
			        <div id="result204">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>204))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default204" class="btn btn-success" type="button" name="yes" value="Yes"
			    		onclick="showResult(<?php echo $userId; ?>, 204, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 204, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="no" value="No"
			    		onclick="showResult(<?php echo $userId; ?>, 204, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default204").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    	<br/>
			        <blockquote>
			        	"I really don't want to waste my platform. I'm trying not to but I think all of us in the spotlight — or whatever you want to call it — can be more vocal about climate change and things that need to be talked about. I still think I can do more.”
			        </blockquote>
			        <a href="https://www.vogue.com.au/celebrity/interviews/how-billie-eilish-went-from-unknown-teen-to-megastar-in-two-years/image-gallery/4f656153176bac884b94ec750bb49d52?pos=7" target="_blank">
			        	 - Billie Eilish, Vogue
			         </a>
			        <br/>
			        <p>Should entertainers use their platform to raise awareness about social issues?</p>
			        <br/>
			        <div id="result205">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>205))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			    		<input id="default205" class="btn btn-success" type="button" name="yes" value="Yes"
			    		onclick="showResult(<?php echo $userId; ?>, 205, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure"
			    		onclick="showResult(<?php echo $userId; ?>, 205, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<input class="btn btn-danger" type="button" name="no" value="No"
			    		onclick="showResult(<?php echo $userId; ?>, 205, this.name, 'yesIdkNo', 0, <?php echo $answered; ?>)"/>
			    		<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default205").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    	<br/>
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
		    	    <br/>
			        <img class="images" src="photos/music/killerMike.jpg" alt="Killer Mike"/>
			        <br/>
			        <br/>
			        <p>On a scale of 1 to 10, how much do you agree that rappers deserve credit for shifting cultural perceptions of marijuana?</p>
			        <br/>
			        <div id="result203">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>203))) {
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
								<input id="default203" type="button" name="numberSlider" value="Submit"
								onclick="showResult(<?php echo $userId; ?>, 203, this.name, 'num', 1, <?php echo $answered; ?>)"/>
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
						    		$("#default203").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



				<section class="post pop">
		    	    <h3>RITA ORA, TIËSTO AND JONAS BLUE DROP VIDEO FOR COLLAB "RITUAL"</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/ontU9cOg354" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result202">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>202))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
				    	<img id="default202" class="rateButton" src="photos/design/fireButton.png" alt="Fire Button" name="fire"
				    	onclick="showResult(<?php echo $userId; ?>, 202, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<img class="rateButton" src="photos/design/decentButton.png" alt="Decent Button" name="decent"
			        	onclick="showResult(<?php echo $userId; ?>, 202, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<img class="rateButton" src="photos/design/trashButton.png" alt="Trash Button" name="trash"
			        	onclick="showResult(<?php echo $userId; ?>, 202, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default202").trigger("click");
						    	});
						    }
					    </script>
			    	</div>
			    </section>



		    	<section class="post hip-hop">
		    	    <h3>CARDI B HOPS ON LIL NAS X'S "RODEO"</h3>
		    	    <img class="accent" src="photos/design/accent.png" alt="Slant Accent"/>
		    	    <br/>
		    	    <br/>
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/kx0Z0B8Xox0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br/>
			        <br/>
			        <p>REACT:</p>
			        <br/>
			        <div id="result201">
			        	<?php
			        		if($log && database::query("SELECT id FROM postResponses WHERE userId=:userId AND postId=:postId", array(":userId"=>$userId, ":postId"=>201))) {
			        			$answered = 1;
			        		} else {
			        			$answered = 0;
			        		}
			        	?>
			        	<img id="default201" class="rate" src="photos/design/fire.png" alt="Fire" name="fire"
			        	onclick="showResult(<?php echo $userId; ?>, 201, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<img class="rate" src="photos/design/decent.png" alt="Decent" name="decent"
			        	onclick="showResult(<?php echo $userId; ?>, 201, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<img class="rate" src="photos/design/trash.png" alt="Trash" name="trash"
			        	onclick="showResult(<?php echo $userId; ?>, 201, this.name, 'rate', 0, <?php echo $answered; ?>)"/>
			        	<script>
					    	if(<?php echo $answered; ?> == 1) {
						    	$(function() {
						    		$("#default201").trigger("click");
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
				$("#music").css({"background-color": "#32CD32", "color": "#fff"});
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
				$("#discover").on("click", function() {
					$("* .post").hide();
					$(".discover").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#discover").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#hip-hop").on("click", function() {
					$("* .post").hide();
					$(".hip-hop").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#hip-hop").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#pop").on("click", function() {
					$("* .post").hide();
					$(".pop").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#pop").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
			$(function() {
				$("#rock").on("click", function() {
					$("* .post").hide();
					$(".rock").show();
					$(".subtopic").css({"background-color": "#fff", "color": "#000"});
					$("#rock").css({"background-color": "#FFD700", "color": "#fff"});
				});
			});
  		</script>
	</body>
</html>