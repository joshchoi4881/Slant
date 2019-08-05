<?php
	include("../classes/Notify.php");
	include("../classes/Database.php");
	$userId = $_GET["userId"];
	$questionId = $_GET["questionId"];
	$response = $_GET["response"];
	$type = $_GET["type"];
	$answered = $_GET["answered"];
	$first = Database::query("SELECT one FROM pollQuestions WHERE id=:id", array(":id"=>$questionId))[0]["one"];
	$second = Database::query("SELECT two FROM pollQuestions WHERE id=:id", array(":id"=>$questionId))[0]["two"];
	$third = Database::query("SELECT three FROM pollQuestions WHERE id=:id", array(":id"=>$questionId))[0]["three"];
	$fourth = Database::query("SELECT four FROM pollQuestions WHERE id=:id", array(":id"=>$questionId))[0]["four"];
	$fifth = Database::query("SELECT five FROM pollQuestions WHERE id=:id", array(":id"=>$questionId))[0]["five"];
	$one = Database::query("SELECT one FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["one"];
	$two = Database::query("SELECT two FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["two"];
	$three = Database::query("SELECT three FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["three"];
	$four = Database::query("SELECT four FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["four"];
	$five = Database::query("SELECT five FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["five"];
	$message = "<p style='color: #32CD32;'>You have already officially recorded your responded to this poll</p>";
	if($answered == 0) {
		if($response == "one") {
			// Add one to the positive option
			$one += 1;
			// Only update the database if the user is logged in AND has not answered the poll yet
			if($userId == -1) {
				$message = "<p style='color: #FFD700;'><a href='login.php'>Log in</a> to or <a href='signUp.php'>sign up</a> for Slant to officially record your response</p>";
			} else {
				// Update userResponses table to record that the user answered the poll
				Database::query("INSERT INTO userResponses VALUES (:id, :userId, :questionId)", array(":id"=>null, ":userId"=>$userId, ":questionId"=>$questionId));
				// Update questionResponses table to record user's responses
				Database::query("UPDATE questionResponses SET one=:one WHERE questionId=:questionId", array(":one"=>$one, ":questionId"=>$questionId));
				$message = "<p style='color: #32CD32;'>Your response has been officially recorded";
			}
		}
		else if($response == "two") {
			// Add one to the negative option
			$two += 1;
			// Only update the database if the user is logged in AND has not answered the poll yet
			if($userId == -1) {
				$message = "<p style='color: #FFD700;'><a href='login.php'>Log in</a> to or <a href='signUp.php'>sign up</a> for Slant to officially record your response</p>";
			} else {
				// Update userResponses table to record that the user answered the poll
				Database::query("INSERT INTO userResponses VALUES (:id, :userId, :questionId)", array(":id"=>null, ":userId"=>$userId, ":questionId"=>$questionId));
				// Update questionResponses table to record user's responses
				Database::query("UPDATE questionResponses SET two=:two WHERE questionId=:questionId", array(":two"=>$two, ":questionId"=>$questionId));
				$message = "<p style='color: #32CD32;'>Your response has been officially recorded";
			}
		}
		else if($response == "three") {
			// Add one to the third option
			$three += 1;
			// Only update the database if the user is logged in AND has not answered the poll yet
			if($userId == -1) {
				$message = "<p style='color: #FFD700;'><a href='login.php'>Log in</a> to or <a href='signUp.php'>sign up</a> for Slant to officially record your response</p>";
			} else {
				// Update userResponses table to record that the user answered the poll
				Database::query("INSERT INTO userResponses VALUES (:id, :userId, :questionId)", array(":id"=>null, ":userId"=>$userId, ":questionId"=>$questionId));
				// Update questionResponses table to record user's responses
				Database::query("UPDATE questionResponses SET three=:three WHERE questionId=:questionId", array(":three"=>$three, ":questionId"=>$questionId));
				$message = "<p style='color: #32CD32;'>Your response has been officially recorded";
			}
		}
		else if($response == "four") {
			// Add one to the fourth option
			$four += 1;
			// Only update the database if the user is logged in AND has not answered the poll yet
			if($userId == -1) {
				$message = "<p style='color: #FFD700;'><a href='login.php'>Log in</a> to or <a href='signUp.php'>sign up</a> for Slant to officially record your response</p>";
			} else {
				// Update userResponses table to record that the user answered the poll
				Database::query("INSERT INTO userResponses VALUES (:id, :userId, :questionId)", array(":id"=>null, ":userId"=>$userId, ":questionId"=>$questionId));
				// Update questionResponses table to record user's responses
				Database::query("UPDATE questionResponses SET four=:four WHERE questionId=:questionId", array(":four"=>$four, ":questionId"=>$questionId));
				$message = "<p style='color: #32CD32;'>Your response has been officially recorded";
			}
		}
		else if($response == "five") {
			// Add one to the fifth option
			$five += 1;
			// Only update the database if the user is logged in AND has not answered the poll yet
			if($userId == -1) {
				$message = "<p style='color: #FFD700;'><a href='login.php'>Log in</a> to or <a href='signUp.php'>sign up</a> for Slant to officially record your response</p>";
			} else {
				// Update userResponses table to record that the user answered the poll
				Database::query("INSERT INTO userResponses VALUES (:id, :userId, :questionId)", array(":id"=>null, ":userId"=>$userId, ":questionId"=>$questionId));
				// Update questionResponses table to record user's responses
				Database::query("UPDATE questionResponses SET five=:five WHERE questionId=:questionId", array(":five"=>$five, ":questionId"=>$questionId));
				$message = "<p style='color: #32CD32;'>Your response has been officially recorded";
			}
		} else {
			// Add new response to current sum of all responses
			$one += intval($response);
			// Increase total number of respondents by one
			$two += 1;
			// Only update the database if the user is logged in AND has not answered the poll yet
			if($userId == -1) {
				$message = "<p style='color: #FFD700;'><a href='login.php'>Log in</a> to or <a href='signUp.php'>sign up</a> for Slant to officially record your response</p>";
			} else {
				// Update userResponses table to record that the user answered the poll
				Database::query("INSERT INTO userResponses VALUES (:id, :userId, :questionId)", array(":id"=>null, ":userId"=>$userId, ":questionId"=>$questionId));
				// Update questionResponses table to record user's responses
				Database::query("UPDATE questionResponses SET one=:one WHERE questionId=:questionId", array(":one"=>$one, ":questionId"=>$questionId));
				Database::query("UPDATE questionResponses SET two=:two WHERE questionId=:questionId", array(":two"=>$two, ":questionId"=>$questionId));
				$message = "<p style='color: #32CD32;'>Your response has been officially recorded";
			}
		}
	}
	$total = $one + $two + $three + $four + $five;
	$bug = false;
	if($answered == 2 && $total == 0) {
		$bug = true;
		$total = 1;
	}
	$onePercent = number_format((float)$one / $total, 2, ".", "") * 100;
	$twoPercent = number_format((float)$two / $total, 2, ".", "") * 100;
	$threePercent = number_format((float)$three / $total, 2, ".", "") * 100;
	$fourPercent = number_format((float)$four / $total, 2, ".", "") * 100;
	$fivePercent = number_format((float)$five / $total, 2, ".", "") * 100;
	if($answered == 2 && $total == 1 && $bug) {
		$total = 0;
	}
	if($answered == 2) {
		$message = "<p style='color: #FFD700;'>You cannot respond to your own poll</p>";
	}
	if($type == "num") {
		$bug = false;
		if($answered == 2 && $two == 0) {
			$bug = true;
			$two = 1;
		}
		$average = number_format((float)$one / $two, 2, ".", "");
		if($answered == 2 && $two == 1 && $bug) {
			$two = 0;
		}
		echo "<progress min='0' max='10' value=".$average."></progress>
			<p>".$first.": ".$average."
			<p>Total: ".$two."</p>
			<p>".$message."</p>";
	}
	else if($type == "twoOptions") {
		echo "<meter min='0' max='100' value=".$onePercent."></meter>
			<p>".$first.": ".$one." (".$onePercent."%)</p>
			<meter min='0' max='100' value=".$twoPercent." low='.00001' high='.0001' optimum='0'></meter>
			<p>".$second.": ".$two." (".$twoPercent."%)</p>
			<p>Total: ".$total."</p>
			<p>".$message."</p>";
	}
	else if($type == "threeOptions" || $type == "rate1" || $type == "rate2") {
		echo "<meter min='0' max='100' value=".$onePercent."></meter>
			<p>".$first.": ".$one." (".$onePercent."%)</p>
			<meter min='0' max='100' value=".$twoPercent." low='.00001' high='100' optimum='0'></meter>
			<p>".$second.": ".$two." (".$twoPercent."%)</p>
			<meter min='0' max='100' value=".$threePercent." low='.00001' high='.0001' optimum='0'></meter>
			<p>".$third.": ".$three." (".$threePercent."%)</p>
			<p>Total: ".$total."</p>
			<p>".$message."</p>";
	}
	else if($type == "fourOptions") {
		echo "<meter min='0' max='100' value=".$onePercent."></meter>
			<p>".$first.": ".$one." (".$onePercent."%)</p>
			<meter min='0' max='100' value=".$twoPercent."></meter>
			<p>".$second.": ".$two." (".$twoPercent."%)</p>
			<meter min='0' max='100' value=".$threePercent."></meter>
			<p>".$third.": ".$three." (".$threePercent."%)</p>
			<meter min='0' max='100' value=".$fourPercent."></meter>
			<p>".$fourth.": ".$four." (".$fourPercent."%)</p>
			<p>Total: ".$total."</p>
			<p>".$message."</p>";
	}
	else if($type == "fiveOptions" || $type == "react") {
		echo "<meter min='0' max='100' value=".$onePercent."></meter>
			<p>".$first.": ".$one." (".$onePercent."%)</p>
			<meter min='0' max='100' value=".$twoPercent."></meter>
			<p>".$second.": ".$two." (".$twoPercent."%)</p>
			<meter min='0' max='100' value=".$threePercent."></meter>
			<p>".$third.": ".$three." (".$threePercent."%)</p>
			<meter min='0' max='100' value=".$fourPercent."></meter>
			<p>".$fourth.": ".$four." (".$fourPercent."%)</p>
			<meter min='0' max='100' value=".$fivePercent."></meter>
			<p>".$fifth.": ".$five." (".$fivePercent."%)</p>
			<p>Total: ".$total."</p>
			<p>".$message."</p>";
	}
	$info = Database::query("SELECT polls.* FROM pollQuestions, polls WHERE pollQuestions.id=".$questionId." AND polls.id=pollQuestions.pollId");
	if($info[0]["type"] == "user" && $info[0]["userId"] != $userId) {
		Notify::createNotify($userId, $info[0]["userId"], "answerUserPoll", $info[0]["id"]);
	}
?>