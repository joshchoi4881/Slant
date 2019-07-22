<?php
	class Database {
		private static function connect() {
			$pdo = new PDO("mysql:host=127.0.0.1; dbname=slant; charset=utf8", "root", "");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		}
		public static function query($query, $params = array()) {
			$pdo = self::connect();
			$statement = $pdo->prepare($query);
			$statement->execute($params);
			if (explode(" ", $query)[0] == "SELECT") {
				$data = $statement->fetchAll();
				return $data;
			}
			$lastId = $pdo->lastInsertId();
			return $lastId;
		}
	}
?>