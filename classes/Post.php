<?php
    class Post {
        public static function linkAdd($text) {
            $text = explode(" ", $text);
            $newString = "";
            foreach($text as $word) {
                if(substr($word, 0, 1) == "@") {
                    $newString .= "<a href=\"profile.php?p=".substr($word, 1)."\">".htmlspecialchars($word)."</a>";
                } else {
                    $newString .= htmlspecialchars($word)." ";
                }
            }
            return $newString;
        }
    }
?>