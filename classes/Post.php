<?php
	class Post {
    	public static function createContentPost($topic, $tags, $headline, $quote, $source, $sourceLink, $media, $alt, $video, $questions, $formats, $name, $dateTime) {
    		if(strlen($headline) < 1 || strlen($headline) > 500) {
	            echo "Please keep your headline between 1 and 500 characters long";
	        } else {
	        	if(strlen($quote) > 1000) {
	            	echo "Please keep your quote under 1000 characters long";
	        	} else {
	        		if(strlen($source) > 100) {
	            		echo "Please keep your source under 100 characters long";
	        		} else {
	        			if(strlen($sourceLink) > 500) {
	            			echo "Please keep your source link under 500 characters long";
	        			} else {
							$postId = Database::query("INSERT INTO posts VALUES (:id, :topic, :headline, :quote, :source, :sourceLink, :media, :image, :alt, :video, :d8, :name)", array(":id"=>null, ":topic"=>$topic, ":headline"=>$headline, ":quote"=>$quote, ":source"=>$source, ":sourceLink"=>$sourceLink, ":media"=>$media, ":image"=>null, ":alt"=>$alt, ":video"=>$video, ":d8"=>$dateTime->format("m-d-y, h:i A"), ":name"=>$name));
	#						$postId = Database::query("SELECT id FROM posts WHERE headline=:headline", array(":headline"=>$headline))[0]["id"];
							if($alt != null) {
								Image::uploadImage("image", "UPDATE posts SET image=:image WHERE id=:id", array(":id"=>$postId));
							}
							for($i = 0; $i < count(array_filter($tags)); $i++) {
								Database::query("INSERT INTO postTags VALUES (:id, :postId, :tag)", array(":id"=>null, ":postId"=>$postId, ":tag"=>$tags[$i]));
							}
							for($i = 0; $i < count(array_filter($questions)); $i++) {
								$questionId = Database::query("INSERT INTO postQuestions VALUES (:id, :postId, :question, :format)", array(":id"=>null, ":postId"=>$postId, ":question"=>$questions[$i], ":format"=>$formats[$i]));
								Database::query("INSERT INTO questionResponses VALUES (:id, :questionId, :one, :two, :three, :four, :five)", array(":id"=>null, ":questionId"=>$questionId, ":one"=>0, ":two"=>0, ":three"=>0, ":four"=>0, ":five"=>0));
							}
	        			}
	        		}
	        	}
	        }
    	}
    }
?>