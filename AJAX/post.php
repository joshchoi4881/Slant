<?php
	include("../classes/Image.php");
	include("../classes/Notify.php");
	include("../classes/Post.php");
	include("../classes/Database.php");
	$profileId = $_GET["profileId"];
	$profile = Database::query("SELECT users.* FROM users WHERE users.id=".$profileId."");
	$postBody = $_GET["postBody"];
	$postImage = $_GET["postImage"];
	$followers = Database::query("SELECT followers.userId FROM followers WHERE followingId=:followingId", array(":followingId"=>$profileId));
	$timeZone = "America/New_York";
	$timeStamp = time();
	$dateTime = new DateTime("now", new DateTimeZone($timeZone));
	$dateTime->setTimestamp($timeStamp);
	if(strlen($postBody) < 1 || strlen($postBody) > 200) {
		echo "Please keep your post between 1 and 200 characters long";
	} else {
		$postId = Database::query("INSERT INTO posts VALUES (:id, :userId, :body, :image, :likes, :d8)", array(":id"=>null, ":userId"=>$profileId, ":body"=>$postBody, ":image"=>null, ":likes"=>0, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
		if($_FILES["postImage"]["size"] != 0) {
			Image::uploadImage("postImage", "UPDATE posts SET postImage=:postImage WHERE id=:id", array(":id"=>$postId));
		}
		foreach($followers as $follower) {
			$f = Database::query("SELECT users.* FROM users WHERE id=:id", array(":id"=>$follower["userId"]));
			Notify::createNotify("createUserPost", $profileId, $f[0]["id"], $postId);
		}
	}
	$posts = Database::query("SELECT posts.* FROM posts WHERE id=".$postId."");
	foreach($posts as $p) {
		$myPost = false;
    	if($profileId == $p["userId"]) {
    		$myPost = true;
    	}
    	$user = Database::query("SELECT users.* FROM users WHERE id=:id", array(":id"=>$p["userId"]));
		$postLikes = Database::query("SELECT likes.* FROM likes WHERE type=\"post\" AND postId=:postId", array(":postId"=>$p["id"]));
		$comments = Database::query("SELECT users.*, comments.* FROM users, comments WHERE users.id=comments.userId AND comments.postId=".$p["id"]." ORDER BY comments.date");
		echo "<div id='post".$p["id"]."' class='post'>
				".Post::linkAdd($p["body"])."
				<br/>";
		if(Database::query("SELECT postImage FROM posts WHERE id=:id", array(":id"=>$p["id"]))[0]["postImage"] != null) {
			$postImage = Database::query("SELECT postImage FROM posts WHERE id=:id", array(":id"=>$p["id"]))[0]["postImage"];
			echo "<img class=\"images\" src=\"".$postImage."\"/>
				<br/>";
		}
		echo "~ <a href=\"profile.php?p=".$user[0]["username"]."&s=overview\">".$user[0]["firstName"]." ".$user[0]["lastName"]."</a>
    		<br/>
    		".$p["date"]."
    		<br/>
    		<form action=\"profile.php?p=".$profile[0]["username"]."&s=posts\" method=\"POST\">
    		<input style=\"display:none;\" name=\"postId\" value=\"".$p["id"]."\"/>";
        if(!Database::query("SELECT id FROM likes WHERE type=:type AND userId=:userId AND postId=:postId", array(":type"=>"post", ":userId"=>$profileId, ":postId"=>$p["id"]))) {
            echo "<input type=\"submit\" name=\"likePost\" value=\"Like\"/>";        
        } else {
            echo "<input type=\"submit\" name=\"unlikePost\" value=\"Unlike\"/>";
        }
       	echo "<span>".count($postLikes)." likes</span>
       		</form>
           	<br/>
           	<form action=\"profile.php?p=".$profile[0]["username"]."&s=posts\" method=\"POST\">";
        if($myPost) {
        	echo "<input style=\"display:none;\" name=\"postId\" value=\"".$p["id"]."\"/>
        		<input type=\"submit\" name=\"deletePost\" value=\"Delete Post\"/>
        		</form>
        		<br/>";
      	}
        echo "<form action=\"profile.php?p=".$profile[0]["username"]."&s=posts\" method=\"POST\">
       			<input style=\"display:none;\" name=\"postId\" value=\"".$p["id"]."\"/>
        		<textarea name=\"commentBody\" rows=\"3\" cols=\"20\"></textarea>
        		<br/>
           		<input type=\"submit\" name=\"comment\" value=\"Comment\"/>
           	</form>
           	<br/>";
        foreach($comments as $c) {
        	$myComment = false;
        	if($userId == $c["userId"]) {
        		$myComment = true;
        	}
        	$user = Database::query("SELECT users.* FROM users WHERE id=:id", array(":id"=>$c["userId"]));
        	$commentLikes = Database::query("SELECT likes.* FROM likes WHERE type=\"comment\" AND commentId=:commentId", array(":commentId"=>$c["id"]));
            echo "<div class=\"comment\">
            	".Post::linkAdd($c["comment"])."
            	<br/>
            	~ <a href=\"profile.php?p=".$user[0]["username"]."&s=overview\">".$user[0]["firstName"]." ".$user[0]["lastName"]."</a>
            	<br/>
            	".$c["date"]."
            	<br/>
            	<form action=\"profile.php?p=".$profile[0]["username"]."&s=posts\" method=\"POST\">
            		<input style=\"display:none;\" name=\"commentUserId\" value=\"".$user[0]["id"]."\"/>
            		<input style=\"display:none;\" name=\"postId\" value=\"".$p["id"]."\"/>
            		<input style=\"display:none;\" name=\"commentId\" value=\"".$c["id"]."\"/>";
            if(!Database::query("SELECT id FROM likes WHERE type=:type AND userId=:userId AND commentId=:commentId", array(":type"=>"comment", ":userId"=>$userId, ":commentId"=>$c["id"]))) {
                echo "<input type=\"submit\" name=\"likeComment\" value=\"Like\"/>";        
            } else {
               	echo "<input type=\"submit\" name=\"unlikeComment\" value=\"Unlike\"/>";
            }
            echo "<span>".count($commentLikes)." likes</span>
            	</form>
           		<br/>
           		<form action=\"profile.php?p=".$profile[0]["username"]."&s=posts\" method=\"POST\">";
            if($myComment) {
                echo "<input style=\"display:none;\" name=\"commentUserId\" value=\"".$user[0]["id"]."\"/>
                	<input style=\"display:none;\" name=\"postId\" value=\"".$p["id"]."\"/>
                	<input style=\"display:none;\" name=\"commentId\" value=\"".$c["id"]."\"/>
                	<input type=\"submit\" name=\"deleteComment\" value=\"Delete Comment\"/>
                	<br\>
                	<br\>";
            }
            echo "</form>
            	</div>
            	<br/>";
        }
        echo "</div>
        	<br/>";
	}
?>