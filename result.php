<?php
	include("classes/database.php");
	$id = $_GET["id"];
	$response = $_GET["response"];
	$type = $_GET["type"];
	/* 2 responses */
	if($type == "num" || $type == "yesNo") {
		if($type == "num") {
			// Add new response to current sum of all responses
			$numSum = database::query("SELECT one FROM posts WHERE id=:id", array(":id"=>$id))[0]["one"];
			$newNum = intval($response);
			$numSum += $newNum;
			database::query("UPDATE posts SET one=:one WHERE id=:id", array(":one"=>$numSum, ":id"=>$id));
			// Increase total number of respondents by one
			$numTotal = database::query("SELECT two FROM posts WHERE id=:id", array(":id"=>$id))[0]["two"];
			$numTotal += 1;
			database::query("UPDATE posts SET two=:two WHERE id=:id", array(":two"=>$numTotal, ":id"=>$id));
			// Calculate average
			$average = number_format((float)$numSum / $numTotal, 2, ".", "");
			echo "<p>Average: ".$average."<br/><progress min='0' max='10' value=".$average."></progress>
				<p>Total: ".$numTotal."</p><br/>";
		}
		else if($type == "yesNo") {
			$one = database::query("SELECT one FROM posts WHERE id=:id", array(":id"=>$id))[0]["one"];
			$two = database::query("SELECT two FROM posts WHERE id=:id", array(":id"=>$id))[0]["two"];
			$positive = "";
			$negative = "";
			if($response == "yes") {
				$one += 1;
				database::query("UPDATE posts SET one=:one WHERE id=:id", array(":one"=>$one, ":id"=>$id));
			}
			else if($response == "no") {
				$two += 1;
				database::query("UPDATE posts SET two=:two WHERE id=:id", array(":two"=>$two, ":id"=>$id));
			}
			$total = $one + $two;
			$onePercent = number_format((float)$one / $total, 2, ".", "") * 100;
			$twoPercent = number_format((float)$two / $total, 2, ".", "") * 100;
			if($type == "yesNo") {
				$positive = "Yes";
				$negative = "No";
			}
			echo "<p>".$positive.": ".$one." (".$onePercent."%)<br/><meter min='0' max='100' value=".$onePercent."></meter>
				<br/>".$negative.": ".$two." (".$twoPercent."%)<br/><meter min='0' max='100' value=".$twoPercent." low='.00001' high='.0001' optimum='0'></meter></p>
				<p>Total: ".$total."</p><br/>";
		}
	}
	/* 3 responses
	$one -> positive response; $two -> neutral response; $three -> negative response */
	else if($type == "yesIdkNo" || $type == "moreIdkLess" || $type == "agreeIdkDisagree" || $type == "rate") {
		$one = database::query("SELECT one FROM posts WHERE id=:id", array(":id"=>$id))[0]["one"];
		$two = database::query("SELECT two FROM posts WHERE id=:id", array(":id"=>$id))[0]["two"];
		$three = database::query("SELECT three FROM posts WHERE id=:id", array(":id"=>$id))[0]["three"];
		$positive = "";
		$neutral = "";
		$negative = "";
		if($response == "yes" || $response == "more" || $response == "agree" || $response == "fire") {
			$one += 1;
			database::query("UPDATE posts SET one=:one WHERE id=:id", array(":one"=>$one, ":id"=>$id));
		}
		else if($response == "idk" || $response == "decent") {
			$two += 1;
			database::query("UPDATE posts SET two=:two WHERE id=:id", array(":two"=>$two, ":id"=>$id));
		}
		else if($response == "no" || $response == "less" || $response == "disagree" || $response == "trash") {
			$three += 1;
			database::query("UPDATE posts SET three=:three WHERE id=:id", array(":three"=>$three, ":id"=>$id));
		}
		$total = $one + $two + $three;
		$onePercent = number_format((float)$one / $total, 2, ".", "") * 100;
		$twoPercent = number_format((float)$two / $total, 2, ".", "") * 100;
		$threePercent = number_format((float)$three / $total, 2, ".", "") * 100;
		if($type == "yesIdkNo") {
			$positive = "Yes";
			$neutral = "Nore Sure";
			$negative = "No";
		}
		else if($type == "moreIdkLess") {
			$positive = "More";
			$neutral = "Not Sure";
			$negative = "Less";
		}
		else if($type == "agreeIdkDisagree") {
			$positive = "Agree";
			$neutral = "Not Sure";
			$negative = "Disagree";
		}
		else if($type == "rate") {
			$positive = "Fire";
			$neutral = "Decent";
			$negative = "Trash";
		}
		echo "<p>".$positive.": ".$one." (".$onePercent."%)<br/><meter min='0' max='100' value=".$onePercent."></meter>
			<br/>".$neutral.": ".$two." (".$twoPercent."%)<br/><meter min='0' max='100' value=".$twoPercent." low='.00001' high='100' optimum='0'></meter>
			<br/>".$negative.": ".$three." (".$threePercent."%)<br/><meter min='0' max='100' value=".$threePercent." low='.00001' high='.0001' optimum='0'></meter></p>
			<p>Total: ".$total."</p><br/>";
	}
	// 5 responses
	else if($type == "react" || $type == "nbaPredict" || $type == "nflPredict") {
		$one = database::query("SELECT one FROM posts WHERE id=:id", array(":id"=>$id))[0]["one"];
		$two = database::query("SELECT two FROM posts WHERE id=:id", array(":id"=>$id))[0]["two"];
		$three = database::query("SELECT three FROM posts WHERE id=:id", array(":id"=>$id))[0]["three"];
		$four = database::query("SELECT four FROM posts WHERE id=:id", array(":id"=>$id))[0]["four"];
		$five = database::query("SELECT five FROM posts WHERE id=:id", array(":id"=>$id))[0]["five"];
		if($response == "happy" || $response == "clippers" || $response == "patriots") {
			$one += 1;
			database::query("UPDATE posts SET one=:one WHERE id=:id", array(":one"=>$one, ":id"=>$id));
		}
		else if($response == "good" || $response == "bucks" || $response == "saints") {
			$two += 1;
			database::query("UPDATE posts SET two=:two WHERE id=:id", array(":two"=>$two, ":id"=>$id));
		}
		else if($response == "neutral" || $response == "lakers" || $response == "chiefs") {
			$three += 1;
			database::query("UPDATE posts SET three=:three WHERE id=:id", array(":three"=>$three, ":id"=>$id));
		}
		else if($response == "sad" || $response == "76ers" || $response == "rams") {
			$four += 1;
			database::query("UPDATE posts SET four=:four WHERE id=:id", array(":four"=>$four, ":id"=>$id));
		}
		else if($response == "angry"  || $response == "other") {
			$five += 1;
			database::query("UPDATE posts SET five=:five WHERE id=:id", array(":five"=>$five, ":id"=>$id));
		}
		$total = $one + $two + $three + $four + $five;
		$onePercent = number_format((float)$one / $total, 2, ".", "") * 100;
		$twoPercent = number_format((float)$two / $total, 2, ".", "") * 100;
		$threePercent = number_format((float)$three / $total, 2, ".", "") * 100;
		$fourPercent = number_format((float)$four / $total, 2, ".", "") * 100;
		$fivePercent = number_format((float)$five / $total, 2, ".", "") * 100;
		if($type == "react") {
			$first = "Happy";
			$second = "Good";
			$third = "Neutral";
			$fourth = "Sad";
			$fifth = "Angry";
		}
		else if($type == "nbaPredict") {
			$first = "Clippers";
			$second = "Bucks";
			$third = "Lakers";
			$fourth = "76ers";
			$fifth = "Other";
		}
		else if($type == "nflPredict") {
			$first = "Patriots";
			$second = "Saints";
			$third = "Chiefs";
			$fourth = "Rams";
			$fifth = "Other";
		}
		echo "<p>".$first.": ".$one." (".$onePercent."%)<br/><meter min='0' max='100' value=".$onePercent."></meter>
			<br/>".$second.": ".$two." (".$twoPercent."%)<br/><meter min='0' max='100' value=".$twoPercent."></meter>
			<br/>".$third.": ".$three." (".$threePercent."%)<br/><meter min='0' max='100' value=".$threePercent."></meter>
			<br/>".$fourth.": ".$four." (".$fourPercent."%)<br/><meter min='0' max='100' value=".$fourPercent."></meter>
			<br/>".$fifth.": ".$five." (".$fivePercent."%)<br/><meter min='0' max='100' value=".$fivePercent."></meter></p>
			<p>Total: ".$total."</p><br/>";
	}
?>