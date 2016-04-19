<?php
class DBConnection
{
	private static $db;

	public static function getConnection()
	{
		if(empty(self::$db)) {
			self::$db = new PDO('mysql:host=localhost;dbname=bioxentys;charset=utf8', 'root', '');
		}
		return self::$db;
	}
	
	public static function getStatement($query)
	{
		return self::getConnection()->prepare($query);
	}
}
?>