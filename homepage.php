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
			#button {
				display: block;
				margin-left: auto;
				margin-right: auto;
				width: 40%;
			}
			.result {
				display: none;
			}
		</style>
	</head>
	<body>
	    <div>
	    	<center>
	    		<h1 class="text-primary">Slant</h1>
	    	</center>
	        <form action="homepage.php?id=1" method="POST">
	        	<center>
	        		<h3>Topic</h3>
	        	</center>
	        	<center>
	        		<p>Explanation</p>
	        	</center>
	        	<br />
	        	<center>
	        		<p>Question</p>
	        	</center>
	        	<br />
	            <center>
	            	<input id="button" type="submit" name="yes" value="Yes">
	            	<p class="result">
	            		<?php
	            			if(database::query("SELECT yes FROM posts WHERE id=:id", array(":id"=>1))) {
								$yes = database::query("SELECT yes FROM posts WHERE id=:id", array(":id"=>1))[0]["yes"];
								echo $yes;
							} else {
								echo "Error";
							}
	            		?>
	        		</p>
	    	        <br />
	    	        <input id="button" type="submit" name="no" value="No">
	    	        <p class="result">
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
	    </div>
	    <script>
	    	document.getElementById('result1').style.display='block';
	    </script>
	</body>
</html>