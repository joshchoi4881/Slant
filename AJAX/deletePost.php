<?php
	include("../classes/Database.php");
	$postId = $_GET["postId"];
	$questions = Database::query("SELECT postQuestions.* FROM postQuestions WHERE postQuestions.postId=".$postId.";");
	foreach($questions as $q) {
		if(Database::query("SELECT id FROM userResponses WHERE questionId=:questionId", array(":questionId"=>$q["id"]))) {
			Database::query("DELETE FROM userResponses WHERE questionId=:questionId", array(":questionId"=>$q["id"]));
		}
		Database::query("DELETE FROM questionResponses WHERE questionId=:questionId", array(":questionId"=>$q["id"]));
	}
	Database::query("DELETE FROM postQuestions WHERE postId=:postId", array(":postId"=>$postId));
	Database::query("DELETE FROM postTags WHERE postId=:postId", array(":postId"=>$postId));
	Database::query("DELETE FROM posts WHERE id=:id", array(":id"=>$postId));
	echo "Post successfully deleted (refresh page)";
?>