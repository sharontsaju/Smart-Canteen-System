<?php

class DBConnect{

	private $db_host;
	private $db_name;
	private $username;
	private $password;
	private $conn;

	public function __construct()
	{
		$this->db_host = 'localhost';
		$this->db_name = 'canteenmgmt';
		$this->username = 'root';
		$this->password = '';
	}

	protected function connect()
	{
		try
		{
			//connecting to the database
			$conn = new mysqli($this->db_host,$this->username,$this->password,$this->db_name);

			if($conn->connect_error)
			{
				die('Sorry! Unable to connect to the database.');
			}

			return $conn;

		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
		
	}

}