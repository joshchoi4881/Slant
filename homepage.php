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
		<style>
			.homepage {
				text-align: center;
				background: black;
			}
			.row {
				display: block;
				text-align: center;
			}
			.card {
				display: inline-block;
				margin: 0px -5px 0px -5px;
				border: solid 2px black;
				width: 50vw;
				height: 50vh;
			}
			.card:hover {
				filter: brightness(50%);
				margin: 0px -5px 0px -5px;
			}
			#politicsCard {
				background-image: url("photos/politics/elizabethWarren.jpg");
				background-size: cover;
			}
			#sportsCard {
				background-image: url("photos/sports/zionWilliamson.jpg");
				background-size: cover;
			}
			#musicCard {
				background-image: url("photos/music/billieEilish.jpg");
				background-size: cover;
			}
			#filmCard {
				background-image: url("photos/film/booksmart.jpg");
				background-size: cover;
			}
			h3 {
				color: white;
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
							<a href='profile.php'>Profile</a>
							<a href='logout.php'>Logout</a>";
					} else {
						echo "<a href='signUp.php'>Sign Up</a>
							<a href='login.php'>Login</a>";
					}
				?>
			</div>
		</header>
		<div class="homepage">
			<div class="row">
				<a href="politics.php">
					<div id="politicsCard" class="card">
						<h3>POLITICS</h3>
					</div>
				</a>
				<a href="sports.php">
					<div id="sportsCard" class="card">
						<h3>SPORTS</h3>
					</div>
				</a>
			</div>
			<div class="row">
				<a href="music.php">
					<div id="musicCard" class="card">
						<h3>MUSIC</h3>
					</div>
				</a>
				<a href="film.php">
					<div id="filmCard" class="card">
						<h3>FILM</h3>
					</div>
				</a>
			</div>
		</div>
		<script src="js/slant.js">
		</script>
	</body>
</html>