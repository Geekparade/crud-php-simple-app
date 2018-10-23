<?php

class Database 
{

	private static $dbName         = 'crud';
	private static $dbHost         = 'localhost';
	private static $dbUserName     = 'pmauser';
	private static $dbUserPassword = 'root'; 
	private static $cont           = null;

	public function __construct() 
	{

		die('Init is not allowed');
	}

	public static function connect() 
	{

		if( null == self::$cont) 
		{

			try 
			{

				self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUserName, self::$dbUserPassword);

			}

			catch ( PDOExeption $e ) 
			{

				die( $e->getMessage() );

			}
		}

		return self::$cont;

	}

	public static function disconnect()
	{

		self::$cont = null;

	}
}