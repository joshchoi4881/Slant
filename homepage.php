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
			    font-family: Arial;
			    font-size: 18px;
			    color: #000;
			}
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
	    	#abortion {
	    		border: 10px solid #d3d3d3;
	    		width: 80%;
	    		height: 80%;
	    	}
	    	#bidenTrump {
				border: 10px solid #d3d3d3;
				width: 80%;
				height:80%;
	    	}
	    	#impeachment {
	    		border: 10px solid #d3d3d3;
				width: 80%;
	    		height: 80%;
	    	}
			.button {
				display: inline;
				width: 30%;
			}
			meter {
				width: 500px;
			}
			@media screen and (max-width: 500px){
    			.post {
        			margin: 5% 15px 5% 15px;
    			}
    			meter {
    				width: 200px;
    			}
			}
		</style>
	</head>
	<body>
		<div id="myHeader" class="header">
			<img class="logo" src="photos/Slant.jpg" alt="" />
			<nav>
				<ul>
					<li><a href="#" onclick="changeTopic('politics')">Politics</a></li>
					<li><a href="#" onclick="changeTopic('sports')">Sports</a></li>
					<li><a href="#" onclick="changeTopic('music')">Music</a></li>
					<li><a href="#" onclick="changeTopic('film')">TV & Film</a></li>
					<li><a id="feedback" href="https://www.surveymonkey.com/r/SWFZV2X" target="_blank">Feedback</a></li>
				</ul>
			</nav>
		</div>
		<div class="content">
			<div id="politics">
		    	<section class="post">
		    	    <h3>ABORTION</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>“Yes, 6 out of 10 Americans support legal abortion in the first trimester of pregnancy, but nearly the same amount support the Hyde Amendment. Contrary to the loudest voices in the primary and the media, even most Democrats do not view abortion as a positive good. Just 44% of Democrats oppose the <a href="https://en.wikipedia.org/wiki/Hyde_Amendment" target="_blank">Hyde Amendment</a>, and fewer than 1 in 5 support legalizing third trimester abortion, which multiple presidential candidates have endorsed… Biden may be blasted for inconsistency, and he'll certainly come under fire from the far left, but he may be more in line with the average American on abortion than any other candidate in the race.”</blockquote><a href="https://www.washingtonexaminer.com/opinion/joe-bidens-position-on-abortion-is-upsetting-the-left-but-hes-a-lot-closer-to-americas-opinion-than-they-are" target="_blank"> - Tiana Lowe, Washington Examiner</a>
			        <br />
			        <img id="abortion" src="photos/Abortion.jpg" alt=""/>
			        <br />
			        <br />
			        <p>Do you support legal abortion in the first trimester of pregnancy?</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(1, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(1, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(1, this.name)">
			    	<p id="result1"></p>
			    	<br />
			        <p>Do you support the <a href="https://en.wikipedia.org/wiki/Hyde_Amendment" target="_blank">Hyde Amendment</a>?</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(2, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(2, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(2, this.name)">
			    	<p id="result2"></p>
			    </section>
			    <section class="post">
			        <h3>BIDEN VERSUS TRUMP</h3>
			        <img class="accent" src="photos/Accent.png" />
			        <blockquote>“Especially bleak is the fact that Trump’s approval rating is more than a dozen points underwater in Wisconsin, Michigan, and Iowa — all states he won in 2016. Of course, a lot can change between now and November of next year. And in fairness to Trump, it is true that state-level polls underestimated his support in 2016…  It’s undeniable, however, that the 2020 polling, taken in its totality, doesn’t look good for Trump right now.”</blockquote><a href="https://www.vox.com/2019/6/11/18661072/trump-campaign-internal-polling-denial" target="_blank"> - Aaron Rupar, Vox</a>
			        <br />
			        <img id="bidenTrump" src="photos/Biden vs Trump.jpg" alt="" />
			        <br />
			        <br />
			        <p>The early polls seem to indicate that the American people prefer Biden over Trump. Do you agree?</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(3, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(3, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(3, this.name)">
			    	<p id="result3"></p>
			    </section>
			    <section class="post">
			        <h3>IMPEACHMENT</h3>
			        <img class="accent" src="photos/Accent.png" />
			        <blockquote>“The longer Democrats drag this out, the less serious they look. They keep saying they need to consider impeachment without doing it. That makes them look like they’re interested in the politics of it, not the reality of it. The American public is largely ready to move on and voters think this issue can be dealt with at the ballot box… So either the Democrats must rush to do impeachment now or they must abandon it to avoid looking political and getting thrown off message… Bob Mueller may have done the President no favors, but he did not do the Democrats any favors either.”</blockquote><a href="https://theresurgent.com/2019/05/30/bob-mueller-boxes-the-democrats-in-on-impeachment/" target="_blank"> - Erick Erickson, The Resurgent</a>
			        <br />
			        <img id="impeachment" src="photos/Impeachment.jpeg" alt="" />
			        <br />
			        <br />
			        <p>Is the American public largely ready to move on?</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(4, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(4, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(4, this.name)">
			    	<p id="result4"></p>
			    </section>
			</div>
			<!-- Not ready yet -->
			<div id="sports">
		    	<section class="post">
		    	    <h3>ANTHONY DAVIS TO LA</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>Quote</blockquote><a href="">Person and Source</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Question</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(101, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(101, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(101, this.name)">
			    	<p id="result101"></p>
			    </section>
			    <section class="post">
		    	    <h3>SPORTS</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>Quote</blockquote><a href="">Person and Source</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Question</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(102, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(102, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(102, this.name)">
			    	<p id="result102"></p>
			    </section>
			    <section class="post">
		    	    <h3>SPORTS</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>Quote</blockquote><a href="">Person and Source</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Question</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(103, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(103, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(103, this.name)">
			    	<p id="result103"></p>
			    </section>
			</div>
			<div id="music">
		    	<section class="post">
		    	    <h3>CARDI B HOPS ON LIL NAS X'S "RODEO"</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <br />
		    	    <br />
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/kx0Z0B8Xox0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br />
			        <br />
			        <p>Your Reaction:</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(201, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(201, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(201, this.name)">
			    	<p id="result201"></p>
			    </section>
			    <section class="post">
		    	    <h3>RITA ORA, TIËSTO AND JONAS BLUE DROP VIDEO FOR COLLAB 'RITUAL'</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <br />
		    	    <br />
			        <iframe width="560" height="315" src="https://www.youtube.com/embed/ontU9cOg354" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			        <br />
			        <br />
			        <p>Your Reaction:</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(202, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(202, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(202, this.name)">
			    	<p id="result202"></p>
			    </section>
			    <section class="post">
		    	    <h3>KILLER MIKE: RAPPERS DESERVE CREDIT FOR PROGRESSIVE WEED LAWS</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>“We know that with national decriminalization of marijuana now, a lot of people are going to get credit for it—a lot of activists, a lot of workers […] but I can show you a line that leads straight back to Cypress Hill, that leads straight back to Snoop Dogg, that leads straight back to people like [the late R&B/funk guitarist] Rick James."</blockquote><a href="https://youtu.be/QOxzlX9BczY"> - Killer Mike, Complex</a>
			        <br />
			        <br />
			        <p>On a scale of 1 to 10, how much do you agree that rappers deserve credit for shifting cultural perceptions of marijuana?</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(203, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(203, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(203, this.name)">
			    	<p id="result203"></p>
			    </section>
			    <section class="post">
		    	    <h3>BILLIE EILISH THINKS IT'S "WEIRD" THAT SHE'S CALLED "THE NEW FACE OF POP", WANTS TO BE MORE</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>“As grateful as I am for the appreciation and the love, honestly, I've become numb to it. I remember the first couple of times people called me the face of pop or pop's new It girl or whatever the fuck... it kind of irked me. The weird thing about humans is we [think we] have to label everything, but we don't."</blockquote><a href="https://www.vogue.com.au/celebrity/interviews/how-billie-eilish-went-from-unknown-teen-to-megastar-in-two-years/image-gallery/4f656153176bac884b94ec750bb49d52?pos=7"> - Billie Eilish, Vogue</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Is Billie Eilish the new face of pop music?</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(204, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(204, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(204, this.name)">
			    	<p id="result204"></p>
			    	<br />
			        <blockquote>"I really don't want to waste my platform. I'm trying not to but I think all of us in the spotlight — or whatever you want to call it — can be more vocal about climate change and things that need to be talked about. I still think I can do more.”</blockquote><a href="https://www.vogue.com.au/celebrity/interviews/how-billie-eilish-went-from-unknown-teen-to-megastar-in-two-years/image-gallery/4f656153176bac884b94ec750bb49d52?pos=7"> - Billie Eilish, Vogue</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Should entertainers use their platform to raise awareness about social issues?</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(205, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(205, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(205, this.name)">
			    	<p id="result205"></p>
			    	<br />
			    </section>
			</div>
			<!-- Not ready yet -->
			<div id="film">
		    	<section class="post">
		    	    <h3>FILM</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>Quote</blockquote><a href="">Person and Source</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Question</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(301, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(301, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(301, this.name)">
			    	<p id="result301"></p>
			    </section>
			   <section class="post">
		    	    <h3>FILM</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>Quote</blockquote><a href="">Person and Source</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Question</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(302, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(302, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(302, this.name)">
			    	<p id="result302"></p>
			    </section>
			    <section class="post">
		    	    <h3>FILM</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>Quote</blockquote><a href="">Person and Source</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Question</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(303, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(303, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(303, this.name)">
			    	<p id="result303"></p>
			    </section>
			</div>
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
	    	function showResult(id, response) {
	    		var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
    					document.getElementById("result" + id).innerHTML = this.responseText;
    					var buttons = document.getElementsByClassName("button");
    					for(var i = (id * 3) - 3; i < (id * 3); i++) {
							buttons[i].style.display = "none";
						}
    				}
  				};
  				xhttp.open("GET", "result.php?id=" + id + "&response=" + response, true);
  				xhttp.send();
	    	}
	    </script>
	</body>
</html>