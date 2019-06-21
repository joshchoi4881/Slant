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
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(5, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(5, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(5, this.name)">
			    	<p id="result5"></p>
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
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(6, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(6, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(6, this.name)">
			    	<p id="result6"></p>
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
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(7, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(7, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(7, this.name)">
			    	<p id="result7"></p>
			    </section>
			</div>
			<div id="music">
		    	<section class="post">
		    	    <h3>MUSIC</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>Quote</blockquote><a href="">Person and Source</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Question</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(8, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(8, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(8, this.name)">
			    	<p id="result8"></p>
			    </section>
			    <section class="post">
		    	    <h3>MUSIC</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>Quote</blockquote><a href="">Person and Source</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Question</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(9, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(9, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(9, this.name)">
			    	<p id="result9"></p>
			    </section>
			    <section class="post">
		    	    <h3>MUSIC</h3>
		    	    <img class="accent" src="photos/Accent.png" alt="" />
		    	    <blockquote>Quote</blockquote><a href="">Person and Source</a>
			        <br />
			        <img id="" src="" alt=""/>
			        <br />
			        <br />
			        <p>Question</p>
			        <br />
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(10, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(10, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(10, this.name)">
			    	<p id="result10"></p>
			    </section>
			</div>
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
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(11, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(11, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(11, this.name)">
			    	<p id="result11"></p>
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
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(12, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(12, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(12, this.name)">
			    	<p id="result12"></p>
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
			    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(13, this.name)">
			    	<input class="button" type="button" name="idk" value="Not Sure" onclick="showResult(13, this.name)">
			    	<input class="button" type="button" name="no" value="No" onclick="showResult(13, this.name)">
			    	<p id="result13"></p>
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