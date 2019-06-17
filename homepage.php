<!DOCTYPE html>
<?php
	include("database.php");
?>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title>Slant</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <style>
	    	.post {
	    		text-align: center;
	    		margin-top: 50px;
	    		margin-left: 200px;
	    		margin-right: 200px;
	    		margin-bottom: 50px;
	    		border-radius: 50px;
	    		padding-top: 50px;
	    		padding-left: 50px;
	    		padding-right: 50px;
	    		padding-bottom: 50px;
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
				transition: 0.3s;
	    	}
	    	.post:hover {
				box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
			}
			.button {
				display: inline;
				width: 30%;
			}
		</style>
	</head>
	<body>
		<center>
			<h1 class="text-primary">Slant</h1>
		</center>
	    <div class="post">
	        <h3>Topic</h3>
	        <p>Explanation</p>
	        <br />
	        <p>Question</p>
	        <br />
	    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(1, this.name)">
	    	<input class="button" type="button" name="no" value="No" onclick="showResult(1, this.name)">
	    	<p id="result1"></p>
	    	<br />
	        <p>Question</p>
	        <br />
	    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(2, this.name)">
	    	<input class="button" type="button" name="no" value="No" onclick="showResult(2, this.name)">
	    	<p id="result2"></p>
	    </div>
	    <div class="post">
	        <h3>Topic</h3>
	        <p>Explanation</p>
	        <br />
	        <p>Question</p>
	        <br />
	    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(3, this.name)">
	    	<input class="button" type="button" name="no" value="No" onclick="showResult(3, this.name)">
	    	<p id="result3"></p>
	    </div>
	    <div class="post">
	        <h3>Topic</h3>
	        <p>Explanation</p>
	        <br />
	        <p>Question</p>
	        <br />
	    	<input class="button" type="button" name="yes" value="Yes" onclick="showResult(4, this.name)">
	    	<input class="button" type="button" name="no" value="No" onclick="showResult(4, this.name)">
	    	<p id="result4"></p>
	    </div>
	    <script>
	    	function showResult(id, response) {
	    		var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
    					document.getElementById("result" + id).innerHTML = this.responseText;
    					var buttons = document.getElementsByClassName("button");
    					for(var i = (id * 2) - 2; i < (id * 2); i++) {
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