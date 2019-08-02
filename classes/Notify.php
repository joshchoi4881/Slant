<?php
    class Notify {
    	public static function createNotify($senderId, $receiverId, $type, $postId = 0, $text = "") {
            $timeZone = "America/New_York";
            $timeStamp = time();
            $dateTime = new DateTime("now", new DateTimeZone($timeZone));
            $dateTime->setTimestamp($timeStamp);
            if($postId == 0) {
                if($type == "follow") {
                    // Create follow notification
                    Database::query("INSERT INTO notifications VALUES (:id, :type, :sender, :receiver, :extra, :d8)", array(":id"=>null, ":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId, ":extra"=>"", ":d8"=>$dateTime->format("m-d-y, h:i A")));
                }
            } else {
                // Create post notifications
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
        public static function deleteNotify($senderId, $receiverId, $type, $postId = 0, $text = "") {
            if($postId == 0) {
                if($type == "follow") {
                    // Delete follow notification
                    Database::query("DELETE FROM notifications WHERE type=:type AND sender=:sender AND receiver=:receiver", array(":type"=>$type, ":sender"=>$senderId, ":receiver"=>$receiverId));
                }
            } else {
                // Delete post notifications
            }
        }
    }
?>