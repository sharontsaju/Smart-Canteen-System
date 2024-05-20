<?php

include 'db_connect.php';

session_start();

if(isset($_POST['add_btn']))
{
	$food_name = mysqli_real_escape_string($conn,$_POST['food_name']);
	$food_price = mysqli_real_escape_string($conn,$_POST['food_price']);
	$created_at = mysqli_real_escape_string($conn,$_POST['created_at']);

	//inserting 
	$sql = "INSERT INTO foods(name,price,created_at) VALUES('$food_name','$food_price','$created_at')";
	$result = mysqli_query($conn,$sql);

	if($result)
	{
		echo ""
	}

}