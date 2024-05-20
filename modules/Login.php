<?php

include 'db_connect.php';

session_start();

if(isset($_POST['phone'])&&isset($_POST['password']))
{

	$phone = mysqli_real_escape_string($conn,$_POST['phone']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);

	//checking phone if exists or not
	$sql = "SELECT * FROM admin WHERE phone = '$phone' AND password = '$password'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		//getting all data
		while($data = mysqli_fetch_assoc($result))
		{
			$_SESSION['user_id'] = $data['id'];
			$_SESSION['name'] = $data['name'];
			$_SESSION['phone'] = $data['phone'];
			$_SESSION['address'] = $data['address'];
			$_SESSION['is_siteadmin'] = $data['is_siteadmin'];
			$_SESSION['is_verified'] = $data['is_verified'];
		}

		echo 'success';

	}
	else
	{
		echo 'Sorry! Invalid Informations.';
	}

}