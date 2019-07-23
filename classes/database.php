<?php
	class database {
		private static function connect() {
			$pdo = new PDO("mysql:host=ls-d70ca738f55284c3d0b5e0528f91203390e1787c.cvhxfjdexada.us-east-1.rds.amazonaws.com; dbname=slant; charset=utf8", "dbmasteruser", "slantcompany");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		}
		public static function query($query, $params = array()) {
			$pdo = self()::connect();
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