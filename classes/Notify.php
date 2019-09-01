<?php
    class Notify {
        public static function createNotify($type, $senderId, $receiverId, $extra = 0, $text = "") {
            $messageId = $extra;
            $postId = $extra;
            $commentId = $extra;
            $pollId = $extra;
            $timeZone = "America/New_York";
            $timeStamp = time();
            $dateTime = new DateTime("now", new DateTimeZone($timeZone));
            $dateTime->setTimestamp($timeStamp);
            // Create notification when a user follows you
            if($type == "follow") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>"", ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user messages you
            else if($type == "inboxMessage") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$messageId, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user you follow posts a post
            else if($type == "createUserPost") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$postId, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user likes your post
            else if($type == "likePost") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$postId, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user comments on your post
            else if($type == "comment") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$commentId, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user likes your comment
            else if($type == "likeComment") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$commentId, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user you follow posts a poll
            else if($type == "createUserPoll") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$pollId, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user answers your poll
            else if($type == "answerUserPoll") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$pollId, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user mentions you
            $text = explode(" ", $text);
            $notify = array();
            foreach($text as $word) {
                if(substr($word, 0, 1) == "@") {
                    $notify[substr($word, 1)] = array("type"=>"mention", "extra"=>' { "postbody": "'.htmlentities(implode($text, " ")).'" } ');
                }
            }
            return $notify;
        }
        public static function deleteNotify($type, $senderId, $receiverId, $extra = 0, $text = "") {
            $postId = $extra;
            $commentId = $extra;
            $pollId = $extra;
            // Delete notification created when a user follows you
            if($type == "follow") {
                Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND receiver=:receiver", array(":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId));
            }
            // Delete notification created when a user you follow posts a post
            else if($type == "createUserPost") {
                Database::query("DELETE FROM notifications WHERE type=:type AND extra=:extra", array(":type"=>"likeComment", ":extra"=>$postId));
                Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND receiver=:receiver AND extra=:extra", array(":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$commentId));
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"likePost", ":receiver"=>$receiverId, ":extra"=>$postId));
                Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND extra=:extra", array(":type"=>$type, ":sender"=>$senderId, ":extra"=>$postId));
            }
            // Delete notification created when a user likes your post
            else if($type == "likePost") {
                Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND receiver=:receiver AND extra=:extra", array(":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$postId));
            }
            // Delete notification created when a user comments on your post
            else if($type == "comment") {
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"likeComment", ":receiver"=>$receiverId, ":extra"=>$commentId));
                Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND receiver=:receiver AND extra=:extra", array(":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$commentId));
            }
            // Delete notification created when a user likes your comment
            else if($type == "likeComment") {
                Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND receiver=:receiver AND extra=:extra", array(":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$commentId));
            }
            // Delete notification created when a user you follow posts a poll
            else if($type == "createUserPoll") {
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"answerUserPoll", ":receiver"=>$senderId, ":extra"=>$pollId));
                Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND extra=:extra", array(":type"=>$type, ":sender"=>$senderId, ":extra"=>$pollId));
            }
        }
    }
?>