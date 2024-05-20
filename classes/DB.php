<?php

class DB{

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
		$this->conn = false;
	}

	protected function connect()
	{
		try
		{
			//connecting to the database
			$conn = new mysqli($this->db_host,$this->username,$this->password);

			if($conn->connect_error)
			{
				die('Sorry! Unable to connect to the database.');
			}
			
			return $conn;

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}


	public function register()
	{

		if(isset($_POST['name'])&&isset($_POST['phone'])&&isset($_POST['address'])&&isset($_POST['password'])&&isset($_POST['created_at']))
		{
			$this->name = mysqli_real_escape_string($this->connect(),$_POST['name']);	
			$this->phone = mysqli_real_escape_string($this->connect(),$_POST['phone']);
			$this->address = mysqli_real_escape_string($this->connect(),$_POST['address']);
			$this->password = md5(mysqli_real_escape_string($this->connect(),$_POST['password']));
			$this->created_at = mysqli_real_escape_string($this->connect(),$_POST['created_at']);
		}

		$sql = "INSERT INTO admin(name,phone,address,password,created_at) 
					VALUES('$this->name','$this->phone','$this->address','$this->password','$this->created_at')";

		$result = $this->connect()->query($sql);

		if($result)
		{
			echo $sql;
		}
		else
		{
			echo $sql;
		}

	}


}

$obj = new DB();
//echo $obj->conn;

if(isset($_POST['name']))
{
	$obj->register();	
}
