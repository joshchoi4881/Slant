<!DOCTYPE html>
<?php
include("database.php");
if(isset($_GET["id"])) {
	if(database::query("SELECT id FROM posts WHERE id=:id", array(":id"=>$_GET["id"]))) {
        $id = database::query("SELECT id FROM posts WHERE id=:id", array(":id"=>$_GET["id"]))[0]["id"];
    }
}
if(isset($_POST["yes"])) {
	if(database::query("SELECT yes FROM posts WHERE id=:id", array(":id"=>$id))) {
		$update = database::query("SELECT yes FROM posts WHERE id=:id", array(":id"=>$id))[0]["yes"];
		$update += 1;
		database::query("UPDATE posts SET yes=".$update." WHERE id=:id", array(":id"=>$id));
	} else {
		echo "Error";
	}
}
if(isset($_POST["no"])) {
	if(database::query("SELECT no FROM posts WHERE id=:id", array(":id"=>$id))) {
		$update = database::query("SELECT no FROM posts WHERE id=:id", array(":id"=>$id))[0]["no"];
		$update += 1;
		database::query("UPDATE posts SET no=".$update." WHERE id=:id", array(":id"=>$id));
	} else {
		echo "Error";
	}
}
?>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Slant</title>
	    <style>
	    	body {
				background-size: cover;
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-position: center;
	    	}
			#logo {
	    		display: block;
	    		margin-left: auto;
	    		margin-right: auto;
	    		height: 50%;
	    		width: 30%;
	    	}
	    	#video {
	    		display: block;
	    		margin-left: auto;
	    		margin-right: auto;
	    		width: 40%;
	    	}
			#button {
				display: block;
				margin-left: auto;
				margin-right: auto;
				width: 40%;
			}
		</style>
		<!--
		<script src="http://code.jquery.com/jquery-1.9.1.js">
		</script>
		<script>
			function check() {
				var yes = document.getElementById("yes").value;
				var no = document.getElementById("no").value;
				var dataString = "yes=" + yes + "&no=" + no;
				$.ajax({
					type: "post",
					url: "homepage.php",
					data: dataString,
					cache: false,
					success: function(html) {
						$("#msg").html(html);
					}
				});
				return false;
			}
		</script>
		-->
	</head>
	<body>
		<!--
		<script>
			function showResult() {
				document.getElementsByClassName("result").style.display = "block";
			}
			function test() {
				document.getElementById("button").innerHTML = "hello";
			}
		</script>
	    -->
	    <div>
	    	<center><h1 id="title">Slant</h1></center>
	        <form action="homepage.php?id=1" method="POST">
	        	<center><h3>Topic</h3></center>
	        	<center><p>Explanation</p></center>
	        	<br>
	        	<center><p>Question</p></center>
	        	<br>
	            <center>
	            	<input onclick="document.getElementById('result1').style.display='block';" id="button" type="submit" name="yes" value="Yes">
	            	<p id="result1" style="display:none;">
	            		<?php
	            			if(database::query("SELECT yes FROM posts WHERE id=:id", array(":id"=>1))) {
								$yes = database::query("SELECT yes FROM posts WHERE id=:id", array(":id"=>1))[0]["yes"];
								echo $yes;
							} else {
								echo "Error";
							}
	            		?>
	        		</p>
	    	        <br>
	    	        <input onclick="showResult()" id="button" type="submit" name="no" value="No">
	    	        <p id="result2" style="display:none;">
	    	        	<?php
	    	        		if(database::query("SELECT no FROM posts WHERE id=:id", array(":id"=>1))) {
								$no = database::query("SELECT no FROM posts WHERE id=:id", array(":id"=>1))[0]["no"];
								echo $no;
							} else {
								echo "Error";
							}
	    	        	?>
	    	        </p>
	            </center>
	        </form>
	        <br>
	        <input onclick="document.getElementById('result1').style.display='block';" id="button" type="submit" name="test" value="Test">
	    </div>
	</body>
</html>