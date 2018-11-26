<?php

class DBConnection
{
	private $db_name = 'phpProject';
	private $user_name = 'root';
	private $user_password = '';
	private $conn = null;
	private static $instance = null;

	public static function connect()
	{
		if(self::$instance instanceof DBConnection)
			return self::$instance->conn;

		self::$instance = new DBConnection();
		return self::$instance->conn;
	}

	private function __construct()
	{
		$this->conn = new mysqli('localhost', $this->user_name, $this->user_password, $this->db_name);
		if($this->conn->connect_error) {
			echo "ERROR: DataBase Connection Failed : " . $this->conn->connect_error;
			die();
		}
	}
}