<?php
	include("../classes/Database.php");
	$userId = $_GET["userId"];
	$questionId = $_GET["questionId"];
	$response = $_GET["response"];
	$type = $_GET["type"];
	$answered = $_GET["answered"];
	// 2 responses
	if($type == "num" || $type == "yesNo") {
		if($type == "num") {
			$numSum = Database::query("SELECT one FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["one"];
			$numTotal = Database::query("SELECT two FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["two"];
			$message = "<p style='color: #32CD32;'>You have already officially recorded your responded to this poll</p>";
			// Only add the response if (the user is not logged in) OR (the user is logged in AND has not answered the poll yet)
			if($answered == 0) {
				// Add new response to current sum of all responses
				$newNum = intval($response);
				$numSum += $newNum;
				// Increase total number of respondents by one
				$numTotal += 1;
				// Only update the database if the user is logged in AND has not answered the poll yet
				if($userId == -1) {
					$message = "<p style='color: #FFD700;'><a href='login.php'>Log in</a> to or <a href='signUp.php'>sign up</a> for Slant to officially record your response</p>";
				} else {
					// Update userResponses table to record that the user answered the poll
					Database::query("INSERT INTO userResponses VALUES (:id, :userId, :questionId)", array(":id"=>null, ":userId"=>$userId, ":questionId"=>$questionId));
					// Update questionResponses table to record user's responses
					Database::query("UPDATE questionResponses SET one=:one WHERE questionId=:questionId", array(":one"=>$numSum, ":questionId"=>$questionId));
					Database::query("UPDATE questionResponses SET two=:two WHERE questionId=:questionId", array(":two"=>$numTotal, ":id"=>$questionId));
					$message = "<p style='color: #32CD32;'>Your response has been officially recorded";
				}
			}
			// Calculate average
			$average = number_format((float)$numSum / $numTotal, 2, ".", "");
			echo "<progress min='0' max='10' value=".$average."></progress>
				<p>Average: ".$average."
				<p>Total: ".$numTotal."</p>
				<p>".$message."</p>";
		}
		else if($type == "yesNo") {
			$one = Database::query("SELECT one FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["one"];
			$two = Database::query("SELECT two FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["two"];
			$positive = "";
			$negative = "";
			$message = "<p style='color: #32CD32;'>You have already officially recorded your responded to this poll</p>";
			// Only add the response if (the user is not logged in) OR (the user is logged in AND has not answered the poll yet)
			if($answered == 0) {
				if($response == "yes") {
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
				else if($response == "no") {
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
			}
			$total = $one + $two;
			$onePercent = number_format((float)$one / $total, 2, ".", "") * 100;
			$twoPercent = number_format((float)$two / $total, 2, ".", "") * 100;
			if($type == "yesNo") {
				$positive = "Yes";
				$negative = "No";
			}
			echo "<meter min='0' max='100' value=".$onePercent."></meter>
				<p>".$positive.": ".$one." (".$onePercent."%)</p>
				<meter min='0' max='100' value=".$twoPercent." low='.00001' high='.0001' optimum='0'></meter>
				<p>".$negative.": ".$two." (".$twoPercent."%)</p>
				<p>Total: ".$total."</p>
				<p>".$message."</p>";
		}
	}
	/* 3 responses
	$one -> positive response; $two -> neutral response; $three -> negative response */
	else if($type == "yesIdkNo" || $type == "moreSameLess" || $type == "moreIdkLess" || $type == "agreeIdkDisagree" || $type == "rate") {
		$one = Database::query("SELECT one FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["one"];
		$two = Database::query("SELECT two FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["two"];
		$three = Database::query("SELECT three FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["three"];
		$positive = "";
		$neutral = "";
		$negative = "";
		$message = "<p style='color: #32CD32;'>You have already officially recorded your responded to this poll</p>";
		// Only add the response if (the user is not logged in) OR (the user is logged in AND has not answered the poll yet)
		if($answered == 0) {
			if($response == "yes" || $response == "more" || $response == "agree" || $response == "fire") {
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
			else if($response == "idk" || $response == "same" || $response == "decent") {
				// Add one to the neutral option
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
			else if($response == "no" || $response == "less" || $response == "disagree" || $response == "trash") {
				// Add one to the negative option
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
		}
		$total = $one + $two + $three;
		$onePercent = number_format((float)$one / $total, 2, ".", "") * 100;
		$twoPercent = number_format((float)$two / $total, 2, ".", "") * 100;
		$threePercent = number_format((float)$three / $total, 2, ".", "") * 100;
		if($type == "yesIdkNo") {
			$positive = "Yes";
			$neutral = "Not Sure";
			$negative = "No";
		}
		else if($type == "moreSameLess") {
			$positive = "More";
			$neutral = "Same";
			$negative = "Less";
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
		echo "<meter min='0' max='100' value=".$onePercent."></meter>
			<p>".$positive.": ".$one." (".$onePercent."%)</p>
			<meter min='0' max='100' value=".$twoPercent." low='.00001' high='100' optimum='0'></meter>
			<p>".$neutral.": ".$two." (".$twoPercent."%)</p>
			<meter min='0' max='100' value=".$threePercent." low='.00001' high='.0001' optimum='0'></meter>
			<p>".$negative.": ".$three." (".$threePercent."%)</p>
			<p>Total: ".$total."</p>
			<p>".$message."</p>";
	}
	// 5 responses
	else if($type == "react" || $type == "nbaPredict" || $type == "nflPredict") {
		$one = Database::query("SELECT one FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["one"];
		$two = Database::query("SELECT two FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["two"];
		$three = Database::query("SELECT three FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["three"];
		$four = Database::query("SELECT four FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["four"];
		$five = Database::query("SELECT five FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$questionId))[0]["five"];
		$message = "<p style='color: #32CD32;'>You have already officially recorded your responded to this poll</p>";
		// Only add the response if (the user is not logged in) OR (the user is logged in AND has not answered the poll yet)
		if($answered == 0) {
			if($response == "laugh" || $response == "clippers" || $response == "patriots") {
				// Add one to the first option
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
			else if($response == "happy" || $response == "bucks" || $response == "saints") {
				// Add one to the second option
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
			else if($response == "neutral" || $response == "lakers" || $response == "chiefs") {
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
			else if($response == "sad" || $response == "76ers" || $response == "rams") {
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
			else if($response == "mad"  || $response == "other") {
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
			}
		}
		$total = $one + $two + $three + $four + $five;
		$onePercent = number_format((float)$one / $total, 2, ".", "") * 100;
		$twoPercent = number_format((float)$two / $total, 2, ".", "") * 100;
		$threePercent = number_format((float)$three / $total, 2, ".", "") * 100;
		$fourPercent = number_format((float)$four / $total, 2, ".", "") * 100;
		$fivePercent = number_format((float)$five / $total, 2, ".", "") * 100;
		if($type == "react") {
			$first = "Laugh";
			$second = "Happy";
			$third = "Neutral";
			$fourth = "Sad";
			$fifth = "Mad";
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
			<p>".$message."</p>";;
	}
?>