<?php

namespace classes;

use PDO;

class Database
{
	protected static $pdo;

	public static function getConnection()
	{
		if (!isset(static::$pdo)) {
			static::$pdo = new PDO('mysql:host=127.0.0.1; dbname=gooddomen22;', 'gooddomen22', 'AJhCnYFL');
		}
		return static::$pdo;
	}
}