<?php
    class Notify {
        public static function createNotify($type, $senderId, $receiverId, $extra = 0, $text = "") {
            $timeZone = "America/New_York";
            $timeStamp = time();
            $dateTime = new DateTime("now", new DateTimeZone($timeZone));
            $dateTime->setTimestamp($timeStamp);
            // Create notification when a user follows you
            if($type == "follow") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$extra, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user you follow posts a post
            else if($type == "createUserPost") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$extra, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user likes your post
            else if($type == "likePost") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$extra, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user comments on your post
            else if($type == "comment") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$extra, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user likes your comment
            else if($type == "likeComment") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$extra, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user you follow posts a poll
            else if($type == "createUserPoll") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$extra, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
            }
            // Create notification when a user answers your poll
            else if($type == "answerUserPoll") {
                Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$extra, ":d8"=>$dateTime->format("m-d-y, h:i:s A")));
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
            // Delete notification created when a user follows you
            if($type == "unfollow") {
                Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND receiver=:receiver", array(":type"=>"follow", ":sender"=>$senderId, ":receiver"=>$receiverId));
            }
            // Delete notification created when a user you follow posts a post
            else if($type == "deleteUserPost") {
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"likeComment", ":receiver"=>$receiverId, ":extra"=>$extra));
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"comment", ":receiver"=>$receiverId, ":extra"=>$extra));
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"likePost", ":receiver"=>$receiverId, ":extra"=>$extra));
                Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND extra=:extra", array(":type"=>"createUserPost", ":sender"=>$senderId, ":extra"=>$extra));
            }
            // Delete notification created when a user likes your post
            else if($type == "unlikePost") {
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"likePost", ":receiver"=>$receiverId, ":extra"=>$extra));
            }
            // Delete notification created when a user comments on your post
            else if($type == "deleteComment") {
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"likeComment", ":receiver"=>$receiverId, ":extra"=>$extra));
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"comment", ":receiver"=>$receiverId, ":extra"=>$extra));
            }
            // Delete notification created when a user comments on your post
            else if($type == "unlikeComment") {
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"likeComment", ":receiver"=>$receiverId, ":extra"=>$extra));
            }
            // Delete notification created when a user you follow posts a poll
            else if($type == "deleteUserPoll") {
                Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"answerUserPoll", ":receiver"=>$senderId, ":extra"=>$extra));
                Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND extra=:extra", array(":type"=>"createUserPoll", ":sender"=>$senderId, ":extra"=>$extra));
            }
        }
    }
?>