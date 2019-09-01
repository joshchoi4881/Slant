<?php
	include("../classes/Notify.php");
	include("../classes/Database.php");
	$pollId = $_GET["pollId"];
	$senderId = Database::query("SELECT userId FROM polls WHERE polls.id=".$pollId."");
	$receivers = Database::query("SELECT followers.userId FROM followers WHERE followingId=:followingId", array(":followingId"=>$senderId[0]["userId"]));
	foreach($receivers as $r) {
		Notify::deleteNotify("createUserPoll", $senderId[0]["userId"], $r["userId"], $pollId);
	}
	$questions = Database::query("SELECT pollQuestions.* FROM pollQuestions WHERE pollQuestions.pollId=".$pollId."");
	foreach($questions as $q) {
		if(Database::query("SELECT id FROM userResponses WHERE questionId=:questionId", array(":questionId"=>$q["id"]))) {
			Database::query("DELETE FROM userResponses WHERE questionId=:questionId", array(":questionId"=>$q["id"]));
		}
		Database::query("DELETE FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$q["id"]));
	}
	Database::query("DELETE FROM pollQuestions WHERE pollId=:pollId", array(":pollId"=>$pollId));
	Database::query("DELETE FROM pollTags WHERE pollId=:pollId", array(":pollId"=>$pollId));
	Database::query("DELETE FROM polls WHERE id=:id", array(":id"=>$pollId));
?>