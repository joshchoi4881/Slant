<!DOCTYPE html>
<?php
	$topic = $_GET["topic"];
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
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <style>
	    	.header {
	    		border-bottom: 2px solid gray;
	    		padding: 10px 16px;
	    		background-color: #fff;
	    	}
	    	.content {
				padding: 16px;
			}
	    	.sticky {
  				position: fixed;
  				top: 0;
  				width: 100%
			}
			.sticky + .content {
				padding-top: 102px;
			}
	    	.logo {
	    		display: block;
				margin-left: auto;
				margin-right: auto;
	    		width: 10%;
	    		height: 10%;
	    	}
	    	nav {
	    		margin-bottom: -30px;
	    		text-align: center;
	    	}
	    	nav ul {
	    		display: inline-block;
	    	}
			nav ul li {
			    display: inline-block;
			}
			nav ul li a {
				display: block;
			    padding: 10px;
			    font-family: arial;
			    font-size: 18px;
			    color: #000;
			}
			nav ul li a:hover {
				display: block;
				text-decoration: none;
			    padding: 2px;
			    font-family: arial;
			    font-size: 25px;
			    color: #000;
			}
			/*
			#politics {
				display: block;
			}
			#sports {
				display: none;
			}
			#music {
				display: none;
			}
			#film {
				display: none;
			}
			*/
	    	.post {
	    		text-align: center;
	    		margin-top: 5%;
	    		margin-left: 20%;
	    		margin-right: 20%;
	    		margin-bottom: 5%;
	    		border-radius: 5%;
	    		padding-top: 5%;
	    		padding-left: 5%;
	    		padding-right: 5%;
	    		padding-bottom: 5%;
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
				transition: 0.3s;
	    	}
	    	.post:hover {
				box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
			}
			h3 {
	    		font-family: arial;
	    		font-weight: bold;
	    		font-style: italic;
	    	}
	    	.accent {
	    		width: 50%;
	    		height: 50%;
	    	}
	    	.images {
	    		border: 10px solid #d3d3d3;
				width: 80%;
	    		height: 80%;
	    	}
			.number {
				display: inline;
				width: 5%;
			}
			.slidecontainer {
				width: 100%;
			}
			.slider {
			  	-webkit-appearance: none;
			  	width: 100%;
			  	height: 10px;
			  	border-radius: 5px;
			  	background: #d3d3d3;
			  	outline: none;
			  	opacity: 0.7;
			  	-webkit-transition: .2s;
			  	transition: opacity .2s;
			}
			.slider:hover {
			  	opacity: 1;
			}
			.slider::-webkit-slider-thumb {
			  	-webkit-appearance: none;
			  	appearance: none;
			  	width: 100px;
			  	height: 50px;
			  	border: 2px solid black;
			  	background: url("photos/Design/Slant.jpg");
			  	background-repeat: no-repeat;
  				background-size: contain;
			  	cursor: pointer;
			}
			.slider::-moz-range-thumb {
			  	width: 100px;
			  	height: 100px;
			  	border: 0;
			  	background: url("photos/Design/Slant.jpg");
			  	cursor: pointer;
			}
			.rate:hover {
				box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
			}
			.rateButton {
				border-radius: 15px;
				width: 150px;
				height: 75px;
			}
			.rateButton:hover {
				border-radius: 15px;
				box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
			}
			.react:hover {
				box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
			}
			meter {
				width: 500px;
			}
			progress {
				width: 500px;
			}
			@media screen and (max-width: 500px) {
				nav ul li a {
					display: block;
				    padding: 10px;
				    font-family: Arial;
				    font-size: 12px;
				    color: #000;
				}
				iframe {
					width: 100%;
					height: 300px;
				}
    			.post {
        			margin: 5% 15px 5% 15px;
    			}
    			meter {
    				width: 200px;
    			}
    			progress {
    				width: 200px;
    			}
			}
		</style>
	</head>
	<body>
		<header id="myHeader" class="header">
			<img class="logo" src="photos/Design/Slant.jpg" alt=""/>
			<nav>
				<ul>
					<li><a id="politics" href="?topic=politics">Politics</a></li>
					<li><a id="sports" href="?topic=sports">Sports</a></li>
					<li><a id="music" href="?topic=music">Music</a></li>
					<li><a id="film" href="?topic=film">TV & Film</a></li>
					<li><a id="feedback" href="https://www.surveymonkey.com/r/SWFZV2X" target="_blank">Feedback</a></li>
				</ul>
			</nav>
		</header>
		<!-- id of 1-100 for politics polls, 101-200 for sports polls, 201-300 for music polls, 301-400 for film polls -->
		<div class="content">
			<?php
				if($topic == "politics") {
					echo '<div id="politics">
				    	<section class="post">
				    	    <h3>ABORTION</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <blockquote>
				    	    	“Yes, 6 out of 10 Americans support legal abortion in the first trimester of pregnancy, but nearly the same amount support the Hyde Amendment. Contrary to the loudest voices in the primary and the media, even most Democrats do not view abortion as a positive good. Just 44% of Democrats oppose the 
				    	    	<a href="https://en.wikipedia.org/wiki/Hyde_Amendment" target="_blank">
				    	    		Hyde Amendment
				    	    	</a>
				    	    	, and fewer than 1 in 5 support legalizing third trimester abortion, which multiple presidential candidates have endorsed… Biden may be blasted for inconsistency, and he\'ll certainly come under fire from the far left, but he may be more in line with the average American on abortion than any other candidate in the race.”
				    	    </blockquote>
				    	    <a href="https://www.washingtonexaminer.com/opinion/joe-bidens-position-on-abortion-is-upsetting-the-left-but-hes-a-lot-closer-to-americas-opinion-than-they-are" target="_blank">
				    	    	 - Tiana Lowe, Washington Examiner
				    	    </a>
					        <br />
					        <img class="images" src="photos/Politics/Abortion.jpg" alt=""/>
					        <br />
					        <br />
					        <p>Do you support legal abortion in the first trimester of pregnancy?</p>
					        <br />
					        <div id="result1">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(1, this.name, \'yesno\')">
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(1, this.name, \'yesno\')">
					    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(1, this.name, \'yesno\')">
					    	</div>
					    	<br />
					        <p>Do you support the <a href="https://en.wikipedia.org/wiki/Hyde_Amendment" target="_blank">Hyde Amendment</a>?</p>
					        <br />
					        <div id="result2">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(2, this.name, \'yesno\')">
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(2, this.name, \'yesno\')">
					    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(2, this.name, \'yesno\')">
					    	</div>
					    </section>
					    <section class="post">
					        <h3>BIDEN VERSUS TRUMP</h3>
					        <img class="accent" src="photos/Design/Accent.png" />
					        <blockquote>
					        	“Especially bleak is the fact that Trump’s approval rating is more than a dozen points underwater in Wisconsin, Michigan, and Iowa — all states he won in 2016. Of course, a lot can change between now and November of next year. And in fairness to Trump, it is true that state-level polls underestimated his support in 2016…  It’s undeniable, however, that the 2020 polling, taken in its totality, doesn’t look good for Trump right now.”
					        	</blockquote>
					        	<a href="https://www.vox.com/2019/6/11/18661072/trump-campaign-internal-polling-denial" target="_blank">
					        		 - Aaron Rupar, Vox
					        	</a>
					        <br />
					        <img class="images" src="photos/Politics/Biden vs Trump.jpg" alt="" />
					        <br />
					        <br />
					        <p>The early polls seem to indicate that the American people prefer Biden over Trump. Do you agree?</p>
					        <br />
					        <div id="result3">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(3, this.name, \'yesno\')">
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(3, this.name, \'yesno\')">
					    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(3, this.name, \'yesno\')">
					    	</div>
					    </section>
					    <section class="post">
					        <h3>IMPEACHMENT</h3>
					        <img class="accent" src="photos/Design/Accent.png" />
					        <blockquote>
					        	“The longer Democrats drag this out, the less serious they look. They keep saying they need to consider impeachment without doing it. That makes them look like they’re interested in the politics of it, not the reality of it. The American public is largely ready to move on and voters think this issue can be dealt with at the ballot box… So either the Democrats must rush to do impeachment now or they must abandon it to avoid looking political and getting thrown off message… Bob Mueller may have done the President no favors, but he did not do the Democrats any favors either.”
					        </blockquote>
					        <a href="https://theresurgent.com/2019/05/30/bob-mueller-boxes-the-democrats-in-on-impeachment/" target="_blank">
					        	 - Erick Erickson, The Resurgent
					        </a>
					        <br />
					        <img class="images" src="photos/Politics/Impeachment.jpeg" alt="" />
					        <br />
					        <br />
					        <p>Is the American public largely ready to move on?</p>
					        <br />
					        <div id="result4">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(4, this.name, \'yesno\')">
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(4, this.name, \'yesno\')">
					    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(4, this.name, \'yesno\')">
					    	</div>
					    </section>
					</div>';
				}
				else if($topic == "sports") {
					echo '<div id="sports">
				    	<section class="post">
				    	    <h3>ZION WILLIAMSON</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <blockquote>
				    	    	"If Zion doesn\'t change, I predict that he will be the first basketball athlete at 18 years old that the world is rooting for to become a billionaire. I say billionaire, very easily... He is going to have an opportunity to be the face of every company and every major corporation. He is the most marketable person I\'ve seen, for a lot of different reasons."
				    	    </blockquote>
				    	    <a href="https://www.espn.com/nba/story/_/id/26392054/zion-williamson-get-paid" target="_blank">
				    	    	 - Sonny Vaccaro, ESPN
				    	    </a>
					        <br />
					        <img class="images" src="photos/Sports/Zion Williamson.jpg" alt=""/>
					        <br />
					        <br />
					        <p>Is Zion Williamson the next face of the NBA?</p>
					        <br />
					        <div id="result101">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(101, this.name, \'yesno\')">
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(101, this.name, \'yesno\')">
					    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(101, this.name, \'yesno\')">
					    	</div>
					    </section>
					    <section class="post">
				    	    <h3>ANTHONY DAVIS TO LA LAKERS</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <blockquote>
				    	    	"The Los Angeles Lakers’ storied penchant for acquiring elite big men when they need them most resurfaced Saturday when the glamorous but struggling franchise reached agreement on a trade to acquire Anthony Davis from the New Orleans Pelicans — thus pairing Davis, a six-time All Star, with LeBron James.""
				    	    </blockquote>
				    	    <a href="https://www.nytimes.com/2019/06/15/sports/lakers-trade-anthony-davis.html" target="_blank">
				    	    	 - New York Times
				    	    </a>
					        <br />
					        <img class="images" src="photos/Sports/Anthony Davis.jpeg" alt=""/>
					        <br />
					        <br />
					        <p>Your Reaction:</p>
					        <br />
					        <div id="result102">
						    	<img class="react" src="photos/Design/Happy.png" alt="" name="happy" onclick="showResult(102, this.name, \'react\')">
					        	<img class="react" src="photos/Design/Good.png" alt="" name="good" onclick="showResult(102, this.name, \'react\')">
					        	<img class="react" src="photos/Design/Neutral.png" alt="" name="neutral" onclick="showResult(102, this.name, \'react\')">
					        	<img class="react" src="photos/Design/Sad.png" alt="" name="sad" onclick="showResult(102, this.name, \'react\')">
					        	<img class="react" src="photos/Design/Angry.png" alt="" name="angry" onclick="showResult(102, this.name, \'react\')">
					    	</div>
					    </section>
					    <section class="post">
				    	    <h3>KAWHI LEONARD: TORONTO OR LA?</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <blockquote>
				    	    	"With Kawhi Leonard potentially hitting free agency next summer, the Toronto Raptors could be fighting an uphill battle to retain their superstar past this season... \'They can\'t change the geography,\' Wojnarowski said. \'They can\'t change the weather in Toronto. Those were always be things against them in this. Home and L.A. has been the focus for Kawhi Leonard through all of this.\'"
				    	    </blockquote>
				    	    <a href="https://bleacherreport.com/articles/2810940-kawhi-leonard-reportedly-focused-on-home-and-la-as-potential-2019-free-agent" target="_blank">
				    	    	 - Bleacher Report
				    	    </a>
					        <br />
					        <img class="images" src="photos/Sports/Kawhi Leonard.jpeg" alt=""/>
					        <br />
					        <br />
					        <p>Will Kawhi stay in Toronto?</p>
					        <br />
					        <div id="result103">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(103, this.name, \'yesno\')">
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(103, this.name, \'yesno\')">
					    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(103, this.name, \'yesno\')">
					    	</div>
					    </section>
					</div>';
				}
				else if($topic == "music") {
					echo '<div id="music">
				    	<section class="post">
				    	    <h3>CARDI B HOPS ON LIL NAS X\'S "RODEO"</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <br />
				    	    <br />
					        <iframe width="560" height="315" src="https://www.youtube.com/embed/kx0Z0B8Xox0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					        <br />
					        <br />
					        <p>Your Reaction:</p>
					        <br />
					        <div id="result201">
					        	<img class="rate" src="photos/Design/Fire.png" alt="" name="fire" onclick="showResult(201, this.name, \'rate\')">
					        	<img class="rate" src="photos/Design/Decent.png" alt="" name="decent" onclick="showResult(201, this.name, \'rate\')">
					        	<img class="rate" src="photos/Design/Trash.png" alt="" name="trash" onclick="showResult(201, this.name, \'rate\')">
					    	</div>
					    </section>
					    <section class="post">
				    	    <h3>RITA ORA, TIËSTO AND JONAS BLUE DROP VIDEO FOR COLLAB "RITUAL"</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <br />
				    	    <br />
					        <iframe width="560" height="315" src="https://www.youtube.com/embed/ontU9cOg354" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					        <br />
					        <br />
					        <p>Your Reaction:</p>
					        <br />
					        <div id="result202">
						    	<img class="rateButton" src="photos/Design/Fire Button.png" alt="" name="fire" onclick="showResult(202, this.name, \'rate\')">
					        	<img class="rateButton" src="photos/Design/Decent Button.png" alt="" name="decent" onclick="showResult(202, this.name, \'rate\')">
					        	<img class="rateButton" src="photos/Design/Trash Button.png" alt="" name="trash" onclick="showResult(202, this.name, \'rate\')">
					    	</div>
					    </section>
					    <section class="post">
				    	    <h3>KILLER MIKE: RAPPERS DESERVE CREDIT FOR PROGRESSIVE WEED LAWS</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <blockquote>
				    	    	“We know that with national decriminalization of marijuana now, a lot of people are going to get credit for it—a lot of activists, a lot of workers […] but I can show you a line that leads straight back to Cypress Hill, that leads straight back to Snoop Dogg, that leads straight back to people like [the late R&B/funk guitarist] Rick James."
				    	    </blockquote>
				    	    <a href="https://youtu.be/QOxzlX9BczY" target="_blank">
				    	    	 - Killer Mike, Complex
				    	    </a>
				    	    <br />
					        <img class="images" src="photos/Music/Killer Mike.jpeg" alt=""/>
					        <br />
					        <br />
					        <p>On a scale of 1 to 10, how much do you agree that rappers deserve credit for shifting cultural perceptions of marijuana?</p>
					        <br />
					        <div id="result203">
					    		<div class="slidecontainer">
  									<input id="myRange1" class="slider" type="range" min="1" max="10" value="5">
  									<br />
  									<br />
  									<p>Value: <span id="demo1" class="show"></span></p>
  									<br />
  									<input type="button" name="numberSlider" value="Submit" onclick="showResult(203, this.name, \'num\', 1)">
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
					    </section>
					    <section class="post">
				    	    <h3>BILLIE EILISH THINKS IT\'S "WEIRD" THAT SHE\'S CALLED "THE NEW FACE OF POP", WANTS TO BE MORE</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <blockquote>
				    	    	“As grateful as I am for the appreciation and the love, honestly, I\'ve become numb to it. I remember the first couple of times people called me the face of pop or pop\'s new It girl or whatever the fuck... it kind of irked me. The weird thing about humans is we [think we] have to label everything, but we don\'t."
				    	    </blockquote>
				    	    <a href="https://www.vogue.com.au/celebrity/interviews/how-billie-eilish-went-from-unknown-teen-to-megastar-in-two-years/image-gallery/4f656153176bac884b94ec750bb49d52?pos=7" target="_blank">
				    	    	 - Billie Eilish, Vogue
				    	    </a>
					        <br />
					        <img class="images" src="photos/Music/Billie Eilish.jpeg" alt=""/>
					        <br />
					        <br />
					        <p>Is Billie Eilish the new face of pop music?</p>
					        <br />
					        <div id="result204">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(204, this.name, \'yesno\')">
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(204, this.name, \'yesno\')">
					    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(204, this.name, \'yesno\')">
					    	</div>
					    	<br />
					        <blockquote>
					        	"I really don\'t want to waste my platform. I\'m trying not to but I think all of us in the spotlight — or whatever you want to call it — can be more vocal about climate change and things that need to be talked about. I still think I can do more.”</blockquote>
					        <a href="https://www.vogue.com.au/celebrity/interviews/how-billie-eilish-went-from-unknown-teen-to-megastar-in-two-years/image-gallery/4f656153176bac884b94ec750bb49d52?pos=7" target="_blank">
					        	 - Billie Eilish, Vogue
					         </a>
					        <br />
					        <p>Should entertainers use their platform to raise awareness about social issues?</p>
					        <br />
					        <div id="result205">
					    		<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(205, this.name, \'yesno\')">
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(205, this.name, \'yesno\')">
					    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(205, this.name, \'yesno\')">
					    	</div>
					    	<br />
					    </section>
					</div>';
				}
				else if($topic == "film") {
					echo '<div id="film">
				    	<section class="post">
				    	    <h3>AVENGERS: ENDGAME RE-RELEASE</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <blockquote>
				    	    	"Marvel honcho Kevin Feige said that the movie will be re-released on June 28 and that while the it\'s "not an extended cut," the movie will feature "a deleted scene, a little tribute, and a few surprises" at the end."
				    	    </blockquote>
				    	    <a href="https://www.wired.com/story/avengers-endgame-re-release/" target="_blank">
				    	    	- WIRED
				    	    </a>
					        <br />
					        <img class="images" src="photos/Film/Avengers.jpeg" alt=""/>
					        <br />
					        <br />
					        <p>Your Reaction:</p>
					        <br />
					        <div id="result301">
						    	<img class="react" src="photos/Design/Happy.png" alt="" name="happy" onclick="showResult(301, this.name, \'react\')">
					        	<img class="react" src="photos/Design/Good.png" alt="" name="good" onclick="showResult(301, this.name, \'react\')">
					        	<img class="react" src="photos/Design/Neutral.png" alt="" name="neutral" onclick="showResult(301, this.name, \'react\')">
					        	<img class="react" src="photos/Design/Sad.png" alt="" name="sad" onclick="showResult(301, this.name, \'react\')">
					        	<img class="react" src="photos/Design/Angry.png" alt="" name="angry" onclick="showResult(301, this.name, \'react\')">
					    	</div>
					    	<br />
					        <p>What is your overall rating of the original movie?</p>
					        <br />
					        <div id="result302">
						    	<div class="slidecontainer">
  									<input id="myRange2" class="slider" type="range" min="1" max="10" value="5">
  									<br />
  									<br />
  									<p>Value: <span id="demo2" class="show"></span></p>
  									<br />
  									<input type="button" name="numberSlider" value="Submit" onclick="showResult(302, this.name, \'num\', 2)">
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
					    </section>
					   <section class="post">
				    	    <h3>FAST AND FURIOUS 10</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <blockquote>
				    	    	"Currently, \'No plot details have been announced\'”
				    	    </blockquote>
				    	    <a href="https://www.movieinsider.com/m13609/fast--furious-10" target="_blank">
				    	    	 — Movie Insider
				    	    </a>
					        <br />
					        <img class="images" src="photos/Film/Fast and Furious.jpeg" alt=""/>
					        <br />
					        <br />
					        <p>Hype Meter:</p>
					        <br />
					        <div id="result303">
						    	<div class="slidecontainer">
  									<input id="myRange3" class="slider" type="range" min="1" max="10" value="5">
  									<br />
  									<br />
  									<p>Value: <span id="demo3" class="show"></span></p>
  									<br />
  									<input type="button" name="numberSlider" value="Submit" onclick="showResult(303, this.name, \'num\', 3)">
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
					    <section class="post">
				    	    <h3>BOOKSMART: 4 STARS?</h3>
				    	    <img class="accent" src="photos/Design/Accent.png" alt="" />
				    	    <blockquote>
				    	    	“Olivia Wilde’s electric feature debut, \'Booksmart,\' is a stellar high school comedy with an A+ cast, a brilliant script loaded with witty dialogue, eye-catching cinematography, swift editing, and a danceable soundtrack."
				    	    </blockquote>
				    	    <a href="https://www.rogerebert.com/reviews/booksmart-2019" target="_blank">
				    	    	 - Monica Castillo, Rogerebert.com
				    	    </a>
					        <br />
					        <img class="images" src="photos/Film/Booksmart.jpeg" alt=""/>
					        <br />
					        <br />
					        <p>Do you agree with the rating?</p>
					        <br />
					        <div id="result304">
					   		 	<input class="btn btn-success" type="button" name="yes" value="Yes" onclick="showResult(304, this.name, \'yesno\')">
					    		<input class="btn btn-warning" type="button" name="idk" value="Not Sure" onclick="showResult(304, this.name, \'yesno\')">
					    		<input class="btn btn-danger" type="button" name="no" value="No" onclick="showResult(304, this.name, \'yesno\')">
					    	</div>
					    </section>
					</div>';
				}
			?>
		</div>
	    <script>
			window.onscroll = function() {
				myFunction()
			};
			var header = document.getElementById("myHeader");
			var sticky = header.offsetTop;
			function myFunction() {
				if (window.pageYOffset > sticky) {
    				header.classList.add("sticky");
  				} else {
    				header.classList.remove("sticky");
  				}
			}
			/*
			function changeTopic(topic) {
				if(topic == "politics") {
					document.getElementById('politics').style.display = "block";
					document.getElementById('sports').style.display = "none";
					document.getElementById('music').style.display = "none";
					document.getElementById('film').style.display = "none";
				}
				else if(topic == "sports") {
					document.getElementById('politics').style.display = "none";
					document.getElementById('sports').style.display = "block";
					document.getElementById('music').style.display = "none";
					document.getElementById('film').style.display = "none";
				}
				else if(topic == "music") {
					document.getElementById('politics').style.display = "none";
					document.getElementById('sports').style.display = "none";
					document.getElementById('music').style.display = "block";
					document.getElementById('film').style.display = "none";
				}
				else if(topic == "film") {
					document.getElementById('politics').style.display = "none";
					document.getElementById('sports').style.display = "none";
					document.getElementById('music').style.display = "none";
					document.getElementById('film').style.display = "block";
				}
			}
			*/
			// id is the id of the poll, response is the submitted user response, type is the type of poll, sliderNum is id number of slider
			// three types: yesno, num, rate, and react
	    	function showResult(id, response, type, sliderNum) {
	    		var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
    					document.getElementById("result" + id).innerHTML = this.responseText;
    				}
  				};
  				if(response == "numberSlider") {
  					var numberSlider = document.getElementById("myRange" + sliderNum).value;
  					xhttp.open("GET", "result.php?id=" + id + "&response=" + numberSlider + "&type=" + type, true);
  				} else {
  					xhttp.open("GET", "result.php?id=" + id + "&response=" + response + "&type=" + type, true);
  				}
  				xhttp.send();
	    	}
	    </script>
	</body>
</html>