<?php include 'inc/header.php';

include 'modules/db_connect.php';
$is_verified  = 1;
$is_siteadmin = 1;		
$_SESSION['message'] = '';
$_SESSION['student_id'] = '';
$food_items = $_SESSION['students'] = array(); 

if(isset($_SESSION['is_verified']))
{
	//do something
	$is_verified = $_SESSION['is_verified'];
}

if(isset($_SESSION['is_siteadmin']))
{
	$is_siteadmin = $_SESSION['is_siteadmin'];
}

if(isset($_POST['order_btn']))
{
	$ordered_by = "2018CS501";	

	$sql = "SELECT id FROM students WHERE reg_no = '$ordered_by'";
	$result = mysqli_query($conn,$sql);

	if(@mysqli_num_rows($result)>0)
	{ 

		while($data = mysqli_fetch_assoc($result))
		{
			$ordered_by = $data['id'];
			$_SESSION['student_id'] = $ordered_by;
		}

		$given_by = mysqli_real_escape_string($conn,$_POST['given_by']);	
		$ordered_item = mysqli_real_escape_string($conn,$_POST['select_food']);	
		$quantity = mysqli_real_escape_string($conn,$_POST['food_quantiy']);	
		$created_at = mysqli_real_escape_string($conn,$_POST['created_at']);	

		//inserting 
		$sql = "INSERT INTO orders(ordered_by,given_by,ordered_item,quantity,created_at) 
		VALUES('$ordered_by','$given_by','$ordered_item','$quantity','$created_at')";
		$result = mysqli_query($conn,$sql);

		if($result)
		{
			$_SESSION['message'] = "Hurray! Ordered Success..";
		}
		else
		{
			$_SESSION['message'] = "Something!! Error Occured..";

		}

	}
	else
	{
		$_SESSION['message'] = 'Sorry! No Student found.';
	}


}

?>
<style type="text/css">
	table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
</style>
<body style="background: url(images/backgnd1.jpg) 0px 0px no-repeat;font-family: 'Open Sans', sans-serif;background-size:cover;">

	<div style="padding:0 16px;margin: 10px;">

		<?php 
			
			if(!$is_verified)
			{

			 echo " <h2 style ='margin-top:100px;font-weight:bold;'>You must be verified staff in order to perform any actions.</h2>";
			
			}
			else{

				//for verified staff

				echo "<div class = 'cont' style='margin-top:40px;'>
 
					<div class='row'>

						<div class='col-md-8 col-md-offset-0'>";

						/*getting food items menu*/
						$sql = "SELECT * FROM foods";
						$result = mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0)
						{

							echo "
							<div class='card' style= 'background :black;'>

							<center><img src='images/foodmenu.jpg' style='width:140px;height:140px;margin-top:0px;' alt='Food Order'></center>

								<h2 style='color :white';>Food Menu</h2>

								<div class='row'>";

								while($data = mysqli_fetch_assoc($result))
								{
									$food_items[] = $data;

									echo "<div class='col-md-5'>

										<div class='card' style='height:300px;;background:grey'>

									<form id='myform' name='myform' method='POST' autocomplete='off'>	

									</form>

										<center><img src='".$data['picture']."' style='width:100%;margin-top:0px;' alt='".$data['food_name']."'></center>

										<br><h2 style='font-weight:bold;margin-bottom:5px;'>".$data['food_name']."</h2>

										<center><p style='font-size:18px;'>Price: Rs.".$data['price']."</p></center>


										</div><!--close card--><br>
									</div><!--close col-->";

									
								}


								echo "

								</div><!--close row -->
								
							</div><!--close card-->

							";
						}


					echo "
					</div><!--close col md 5-->

					<div class='col-md-3' style='position:fixed;bottom:1;right:0;'>
							
							<div class='card' style='margin-bottom:100px;'>
							
							<center><img src='images/foodorder.jpg' style='width:30%;margin-top:0px;' alt='Food Order'></center>
							  
							  <h2 style='margin-bottom:15px;'>Order Food</h2>";

							if($_SESSION['message'])
							{
								echo "<p style='color:green;font-size:20px;margin-bottom:10px;'> ".$_SESSION['message']." </p>";
							}

							 echo " <form method='POST' autocomplete='off'>

							  <label style='font-size:22px;'>Enter Student Regd. No. </label>

							  	<label style='font-size:22px;'>Select Food:</label>

							  	<select id='select_food' name='select_food' required/>";

							  	for ($i = 0; $i<count($food_items); $i++) {
							  		
							  		echo "<option value='".$food_items[$i]['id']."'>" .$food_items[$i]['food_name']."</option>";

							  	}

							  	echo "</select>

							  	<input type='number' id='food_quantiy' name='food_quantiy' placeholder='Quantity' style='margin-top:30px;' required/>

							  	<input type='hidden' name='given_by' value='".$_SESSION['id']."'>
							  	<input type='hidden' name='created_at' value='".date('Y-m-d H:i:s')."'>

							  	<button type='submit' name='order_btn' class='button' style='margin-top:30px;'><i class='fa fa-shopping-cart'></i> Order Now</button> 

							  </form>
							</div><!--close card-->
						</div><!--close col-->

					</div><!--close row -->

				</div><!--close cont-->";

			}


		?>
	</div><!--close div-->


<?php include 'inc/footer.php'; ?>