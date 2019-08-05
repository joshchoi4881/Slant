<?php
    class Notify {
        public static function createNotify($senderId, $receiverId, $type, $pollId = 0, $text = "") {
            $timeZone = "America/New_York";
            $timeStamp = time();
            $dateTime = new DateTime("now", new DateTimeZone($timeZone));
            $dateTime->setTimestamp($timeStamp);
            if($pollId == 0) {
                if($type == "follow") {
                    // Create notification when a user follows you
                    Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>"", ":d8"=>$dateTime->format("m-d-y, h:i A")));
                }
            } else {
                // Create notification when a user you follow posts a poll
                if($type == "createUserPoll") {
                    Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$pollId, ":d8"=>$dateTime->format("m-d-y, h:i A")));
                }
                // Create notification when a user answers your poll
                if($type == "answerUserPoll") {
                    Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>$pollId, ":d8"=>$dateTime->format("m-d-y, h:i A")));
                }
                // Create notification when a user mentions you in a post
                $text = explode(" ", $text);
                $notify = array();
                foreach($text as $word) {
                    if(substr($word, 0, 1) == "@") {
                        $notify[substr($word, 1)] = array("type"=>"mention", "extra"=>' { "postbody": "'.htmlentities(implode($text, " ")).'" } ');
                    }
                }
                return $notify;
            }
        }
        public static function deleteNotify($senderId, $receiverId, $type, $pollId = 0, $text = "") {
            if($pollId == 0) {
                if($type == "unfollow") {
                    // Delete notification created when a user follows you
                    Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND receiver=:receiver", array(":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId));
                }
            } else {
                // Delete notification created when a user you follow posts a poll
                if($type == "deleteUserPoll") {
                    Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND extra=:extra", array(":type"=>"createUserPoll", ":sender"=>$senderId, ":extra"=>$pollId));
                    Database::query("DELETE FROM notifications WHERE type=:type AND receiver=:receiver AND extra=:extra", array(":type"=>"answerUserPoll", ":receiver"=>$senderId, ":extra"=>$pollId));
                }
            }
        }
    }
?>