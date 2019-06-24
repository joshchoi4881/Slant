<?php
	include("database.php");
	$id = $_GET["id"];
	$response = $_GET["response"];
	$type = $_GET["type"];
	if($type == "yesno") {
		$yes = database::query("SELECT yes FROM posts WHERE id=:id", array(":id"=>$id))[0]["yes"];
		$idk = database::query("SELECT idk FROM posts WHERE id=:id", array(":id"=>$id))[0]["idk"];
		$no = database::query("SELECT no FROM posts WHERE id=:id", array(":id"=>$id))[0]["no"];
		if($response == "yes") {
			$yes += 1;
			database::query("UPDATE posts SET yes=:yes WHERE id=:id", array(":yes"=>$yes, ":id"=>$id));
		}
		else if($response == "idk") {
			$idk += 1;
			database::query("UPDATE posts SET idk=:idk WHERE id=:id", array(":idk"=>$idk, ":id"=>$id));
		}
		else if($response == "no") {
			$no += 1;
			database::query("UPDATE posts SET no=:no WHERE id=:id", array(":no"=>$no, ":id"=>$id));
		}
		$total = $yes + $idk + $no;
		$yesPercent = number_format((float)$yes / $total, 2, ".", "") * 100;
		$idkPercent = number_format((float)$idk / $total, 2, ".", "") * 100;
		$noPercent = number_format((float)$no / $total, 2, ".", "") * 100;
		echo "<p>Yes: ".$yes." (".$yesPercent."%)<br /><meter min='0' max='100' value=".$yesPercent."></meter>
			<br />Not Sure: ".$idk." (".$idkPercent."%)<br /><meter min='0' max='100' value=".$idkPercent." low='.00001' high='100' optimum='0'></meter>
			<br />No: ".$no." (".$noPercent."%)<br /><meter min='0' max='100' value=".$noPercent." low='.00001' high='.0001' optimum='0'></meter></p>";
		echo "<p>Total: ".$total."</p><br>";
	}
	else if($type == "num") {
		// Add new response to current sum of all responses
		$numSum = database::query("SELECT numSum FROM posts WHERE id=:id", array(":id"=>$id))[0]["numSum"];
		$newNum = intval($response);
		$numSum += $newNum;
		database::query("UPDATE posts SET numSum=:numSum WHERE id=:id", array(":numSum"=>$numSum, ":id"=>$id));
		// Increase total number of respondents by one
		$numTotal = database::query("SELECT numTotal FROM posts WHERE id=:id", array(":id"=>$id))[0]["numTotal"];
		$numTotal += 1;
		database::query("UPDATE posts SET numTotal=:numTotal WHERE id=:id", array(":numTotal"=>$numTotal, ":id"=>$id));
		// Calculate average
		$average = number_format((float)$numSum / $numTotal, 2, ".", "");
		echo "<p>Average: ".$average."<br /><progress min='0' max='10' value=".$average."></progress>";
		echo "<p>Total: ".$numTotal."</p><br>";
	}
	else if($type == "rate") {
		$fire = database::query("SELECT fire FROM posts WHERE id=:id", array(":id"=>$id))[0]["fire"];
		$decent = database::query("SELECT decent FROM posts WHERE id=:id", array(":id"=>$id))[0]["decent"];
		$trash = database::query("SELECT trash FROM posts WHERE id=:id", array(":id"=>$id))[0]["trash"];
		if($response == "fire") {
			$fire += 1;
			database::query("UPDATE posts SET fire=:fire WHERE id=:id", array(":fire"=>$fire, ":id"=>$id));
		}
		else if($response == "decent") {
			$decent += 1;
			database::query("UPDATE posts SET decent=:decent WHERE id=:id", array(":decent"=>$decent, ":id"=>$id));
		}
		else if($response == "trash") {
			$trash += 1;
			database::query("UPDATE posts SET trash=:trash WHERE id=:id", array(":trash"=>$trash, ":id"=>$id));
		}
		$total = $fire + $decent + $trash;
		$firePercent = number_format((float)$fire / $total, 2, ".", "") * 100;
		$decentPercent = number_format((float)$decent / $total, 2, ".", "") * 100;
		$trashPercent = number_format((float)$trash / $total, 2, ".", "") * 100;
		echo "<p>Fire: ".$fire." (".$firePercent."%)<br /><meter min='0' max='100' value=".$firePercent."></meter>
			<br />Decent: ".$decent." (".$decentPercent."%)<br /><meter min='0' max='100' value=".$decentPercent." low='.00001' high='100' optimum='0'></meter>
			<br />Trash: ".$trash." (".$trashPercent."%)<br /><meter min='0' max='100' value=".$trashPercent." low='.00001' high='.0001' optimum='0'></meter></p>";
		echo "<p>Total: ".$total."</p><br>";
	}
	else if($type == "react") {
		$happy = database::query("SELECT happy FROM posts WHERE id=:id", array(":id"=>$id))[0]["happy"];
		$good = database::query("SELECT good FROM posts WHERE id=:id", array(":id"=>$id))[0]["good"];
		$neutral = database::query("SELECT neutral FROM posts WHERE id=:id", array(":id"=>$id))[0]["neutral"];
		$sad = database::query("SELECT sad FROM posts WHERE id=:id", array(":id"=>$id))[0]["sad"];
		$angry = database::query("SELECT angry FROM posts WHERE id=:id", array(":id"=>$id))[0]["angry"];
		if($response == "happy") {
			$happy += 1;
			database::query("UPDATE posts SET happy=:happy WHERE id=:id", array(":happy"=>$happy, ":id"=>$id));
		}
		else if($response == "good") {
			$good += 1;
			database::query("UPDATE posts SET good=:good WHERE id=:id", array(":good"=>$good, ":id"=>$id));
		}
		else if($response == "neutral") {
			$neutral += 1;
			database::query("UPDATE posts SET neutral=:neutral WHERE id=:id", array(":neutral"=>$neutral, ":id"=>$id));
		}
		else if($response == "sad") {
			$sad += 1;
			database::query("UPDATE posts SET sad=:sad WHERE id=:id", array(":sad"=>$sad, ":id"=>$id));
		}
		else if($response == "angry") {
			$angry += 1;
			database::query("UPDATE posts SET angry=:angry WHERE id=:id", array(":angry"=>$angry, ":id"=>$id));
		}
		$total = $happy + $good + $neutral + $sad + $angry;
		$happyPercent = number_format((float)$happy / $total, 2, ".", "") * 100;
		$goodPercent = number_format((float)$good / $total, 2, ".", "") * 100;
		$neutralPercent = number_format((float)$neutral / $total, 2, ".", "") * 100;
		$sadPercent = number_format((float)$sad / $total, 2, ".", "") * 100;
		$angryPercent = number_format((float)$angry / $total, 2, ".", "") * 100;
		echo "<p>Happy: ".$happy." (".$happyPercent."%)<br /><meter min='0' max='100' value=".$happyPercent."></meter>
			<br />Good: ".$good." (".$goodPercent."%)<br /><meter min='0' max='100' value=".$goodPercent."></meter>
			<br />Neutral: ".$neutral." (".$neutralPercent."%)<br /><meter min='0' max='100' value=".$neutralPercent."></meter>
			<br />Sad: ".$sad." (".$sadPercent."%)<br /><meter min='0' max='100' value=".$sadPercent."></meter>
			<br />Angry: ".$angry." (".$angryPercent."%)<br /><meter min='0' max='100' value=".$angryPercent."></meter></p>";
		echo "<p>Total: ".$total."</p><br>";
	}
?>