<?php

include 'DBConnect.php';

class Register extends DBConnect
{

	public $name = '';
	public $phone = '';
	public $address = '';
	public $password = '';	
	public $created_at = '';

	public function __construct()
	{
		if(isset($_POST['name']))
		{
			$this->name = mysqli_real_escape_string($this->connect(),$_POST['name']);	
		}
		if(isset($_POST['phone']))
		{
			$this->phone = mysqli_real_escape_string($this->connect(),$_POST['phone']);
		}
		if(isset($_POST['address']))
		{
			$this->address = mysqli_real_escape_string($this->connect(),$_POST['address']);
		}
		if(isset($_POST['password']))
		{
			$this->password = md5(mysqli_real_escape_string($this->connect(),$_POST['password']));
		}
		if(isset($_POST['created_at']))
		{
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

if(isset($_POST['name']))
{
	new Register();
}






