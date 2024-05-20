<?php

session_start();

include 'db_connect.php';

if(isset($_POST['name'])&&isset($_POST['phone'])&&isset($_POST['address'])&&isset($_POST['password'])&&isset($_POST['created_at']))
{

	$name = mysqli_real_escape_string($conn,$_POST['name']);	
	$phone = mysqli_real_escape_string($conn,$_POST['phone']);
	$address = mysqli_real_escape_string($conn,$_POST['address']);
	$password = md5(mysqli_real_escape_string($conn,$_POST['password']));
	$created_at = mysqli_real_escape_string($conn,$_POST['created_at']);

	//checking phone if exists or not
	$sql = "SELECT * FROM admin WHERE phone = '$phone'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		echo 'You already created your account with this phone number.';
	}
	else
	{
		
		//registering
		$sql = "INSERT INTO admin(name,phone,address,password,created_at) VALUES('$name','$phone','$address','$password','$created_at')";
		$result = mysqli_query($conn,$sql);

		if($result)
		{
			$_SESSION['name'] = $name;
			$_SESSION['phone'] = $phone;
			$_SESSION['address'] = $address;
			$_SESSION['is_siteadmin'] = 0;
			$_SESSION['is_verified'] = 0;

			$sql = "SELECT id FROM admin WHERE phone = '$phone'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0)
			{
				while($data = mysqli_fetch_assoc($result))
				{
					$_SESSION['user_id'] = $data['id'];
				}
			}			

			echo 'success';
		}
		else
		{
			echo 'failed';
		}


	}

}