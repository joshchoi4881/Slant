<?php
	class Login {
		public static function isLoggedIn() {
			if (isset($_COOKIE["SLANT_ID"])) {
				if (Database::query("SELECT userId FROM loginTokens WHERE token=:token", array(":token"=>sha1($_COOKIE["SLANT_ID"])))) {
					$userId = Database::query("SELECT userId FROM loginTokens WHERE token=:token", array(":token"=>sha1($_COOKIE["SLANT_ID"])))[0]["userId"];
					if (isset($_COOKIE["SLANT_ID_"])) {
						return $userId;
					} else {
						$cstrong = True;
						$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
						Database::query("INSERT INTO loginTokens VALUES (:id, :token, :userId)", array(":id"=>null, ":token"=>sha1($token), ":userId"=>$userId));
						Database::query("DELETE FROM loginTokens WHERE token=:token", array(":token"=>sha1($_COOKIE["SLANT_ID"])));
						setcookie("SLANT_ID", $token, time() + 60 * 60 * 24 * 7, "/", NULL, NULL, TRUE);
						setcookie("SLANT_ID_", "1", time() + 60 * 60 * 24 * 3, "/", NULL, NULL, TRUE);
						return $userId;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}
?>