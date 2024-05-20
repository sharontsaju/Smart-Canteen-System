<?php

include 'db_connect.php';

session_start();

if(isset($_SESSION['student_id']))
{
	$stu_id = $_SESSION['student_id'];

	$total_paid = 0;

	$sql = "SELECT O.id AS orders_id,O.quantity,O.has_paid,O.created_at, S.id, S.name, F.food_name, F.price
		FROM orders O 
		JOIN students S ON S.id = O.ordered_by
		JOIN foods F ON O.ordered_item = F.id
		WHERE S.id = '$stu_id'";

	$result = mysqli_query($conn,$sql);

	if(mysqli_num_rows($result)>0)
	{
		while($data = mysqli_fetch_assoc($result))
		{
			if($data['has_paid'])
			{
				$total_paid+= ($data['price'] * $data['quantity']);
			}
			
		}

		echo $total_paid;
			
	}
	else
	{
		echo 'failed';
	}
}