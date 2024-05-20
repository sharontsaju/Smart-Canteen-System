<?php

include 'db_connect.php';

session_start();

if(isset($_POST['reg_no'])&&isset($_POST['password']))
{

	$reg_no = mysqli_real_escape_string($conn,$_POST['reg_no']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);

	//checking reg_no if exists or not
	$sql = "SELECT * FROM students WHERE reg_no = '$reg_no' AND password = '$password'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		//getting all data
		while($data = mysqli_fetch_assoc($result))
		{
			$_SESSION['user_id'] = $data['id'];
			$_SESSION['name'] = $data['name'];
			$_SESSION['reg_no'] = $data['reg_no'];
			$_SESSION['address'] = $data['address'];
		}

		echo 'success';

	}
	else
	{
		echo 'Sorry! Invalid Informations.';
	}

}