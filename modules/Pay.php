<?php

include 'db_connect.php';

session_start();

if(isset($_POST['id']))
{
	$id = mysqli_real_escape_string($conn,$_POST['id']);

	//inserting

	$sql = "UPDATE orders set has_paid = 1 WHERE id = '$id'";
	$result = mysqli_query($conn,$sql);
	if($result)
	{
		echo "success";
	}
	else
	{
		echo "failed";
	}

}