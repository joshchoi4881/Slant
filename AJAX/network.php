<?php
	include("../classes/Database.php");
	$status = $_GET["status"];
	$userId = $_GET["userId"];
	$followingId = $_GET["followingId"];
	if($status == "follow") {
		if(!Database::query("SELECT id FROM followers WHERE userId=:userId AND followingId=:followingId", array(":userId"=>$userId, ":followingId"=>$followingId))) {
	    	Database::query("INSERT INTO followers VALUES (:id, :userId, :followingId)", array(":id"=>null, ":userId"=>$userId, ":followingId"=>$followingId));
	    	echo "Successfully followed";
	    } else {
	       	echo "Already following";
	    }
	}
	else if($status == "unfollow") {
		if(Database::query("SELECT id FROM followers WHERE userId=:userId AND followingId=:followingId", array(":userId"=>$userId, ":followingId"=>$followingId))) {
	        Database::query("DELETE FROM followers WHERE userId=:userId AND followingId=:followingId", array(":userId"=>$userId, ":followingId"=>$followingId));
	        echo "Successfully unfollowed";
	    } else {
	        echo "Already unfollowing";
	    }
	}
?>