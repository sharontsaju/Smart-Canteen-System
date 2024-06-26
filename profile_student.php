<?php include 'inc/header.php';

include 'modules/db_connect.php';

if(!isset($_SESSION['phone']))
{
	header("Location:index_student.php");
}
	
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
	$ordered_by = mysqli_real_escape_string($conn,$_POST['select_stu']);	

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

if(isset($_POST['delete_btn']))
{
	$id = $_POST['delete_id'];
	$sql = "DELETE FROM foods WHERE id ='$id'";
	$result = mysqli_query($conn,$sql);

	if($result)
	{
		$_SESSION['message'] = "Food item deleted Success";
	}
	else
	{
		$_SESSION['message'] = "Sorry! Something Error Occured.";
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
<body style="background-color: #f7f9fc;">

	<ul class="topnav">
	  <li class="left"><a href="javascript:void(0)" title="Canteen Management" style="font-size: 18px;font-weight: bold;">Canteen Management</a></li>
	  <li class="right"><a href="logout.php" title="Logout"> <i class="fa fa-sign-out"></i> Logout</a></li>
	  <?php 

	  if($is_siteadmin):

	  ?>
	  <li class="right"><a href="settings.php"  title="Settings"> <i class="fa fa-cog"></i> Settings</a></li>
	  <?php
	  	endif;
	  ?>
	  <li class="right"><a href="see_bill.php" title="See Bill"> <i class="fa fa-eye"></i> See Bill</a></li>
	  <li><a class="active" href="" title="Home"> <i class="fa fa-home"></i> Home</a></li>
	</ul>

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
							<div class='card'>

							<center><img src='images/food_menu.png' style='width:20%;margin-top:0px;' alt='Food Order'></center>

								<h2>Food Menu</h2>

								<div class='row'>";

								while($data = mysqli_fetch_assoc($result))
								{
									$food_items[] = $data;

									echo "<div class='col-md-5'>

										<div class='card' style='height:300px;'>

									<form id='myform' name='myform' method='POST' autocomplete='off'>	
										<div class='dropdown' style='float:right;'>
										  <a class='dropbtn'><i class='fa fa-caret-down'></i></a>
										  <div class='dropdown-content'>

										  <input type='hidden' name='delete_id' value='".$data['id']."'>

										    <input type='submit' class='button' name='delete_btn' value='Delete ".$data['food_name']."' style='width:180px;' title='Delete'>
										  </div>
										</div>

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
							
							<center><img src='images/food_order.png' style='width:30%;margin-top:0px;' alt='Food Order'></center>
							  
							  <h2 style='margin-bottom:15px;'>Order Food</h2>";

							if($_SESSION['message'])
							{
								echo "<p style='color:green;font-size:20px;margin-bottom:10px;'> ".$_SESSION['message']." </p>";
							}

							 echo " <form method='POST' autocomplete='off'>

							  <label style='font-size:22px;'>Enter Student Regd. No. </label>
							  		
							  	<input type='text'name='select_stu' id='select_stu' placeholder ='' required='required'/>	

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