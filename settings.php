<?php include 'inc/header.php';

include 'modules/db_connect.php';

$is_siteadmin = 0;			
$_SESSION['message'] = ''; //declaeing session message
 
if(isset($_SESSION['is_siteadmin']))
{
	$is_siteadmin = $_SESSION['is_siteadmin'];
}

if(!isset($_SESSION['phone'])&&!$is_siteadmin)
{
	header("Location:index.php");
}

if(isset($_POST['add_btn']))
{
	$food_name = mysqli_real_escape_string($conn,$_POST['food_name']);
	$food_price = mysqli_real_escape_string($conn,$_POST['food_price']);
	$created_at = mysqli_real_escape_string($conn,$_POST['created_at']);
	
	$destination = 'food menu/'.basename($_FILES['image']['name']);

	//moving to destinatio
	if(move_uploaded_file($_FILES['image']['tmp_name'], $destination))
	{
		$_SESSION['message'] = 'Image Uploaded Success.';

				//inserting 
		$sql = "INSERT INTO foods(food_name,price,picture,created_at) VALUES('$food_name','$food_price','$destination','$created_at')";

		$result = mysqli_query($conn,$sql);

		if($result)
		{
			$_SESSION['message'] =  "Hurray! Food Item Inserted Success.";
		}
		else
		{
			$_SESSION['message'] = 'Something error occured.';
		}

	}
	else
	{
		$_SESSION['message'] = 'Image Uploaded Failed.';

	}

	

}

if(isset($_POST['addstudent_btn']))
{
	$stu_name = mysqli_real_escape_string($conn,$_POST['stu_name']);
	$reg_no = mysqli_real_escape_string($conn,$_POST['reg_no']);
	$phone_no = mysqli_real_escape_string($conn,$_POST['phone_no']);
	$address = mysqli_real_escape_string($conn,$_POST['address']);
	$created_at = mysqli_real_escape_string($conn,$_POST['stu_created_at']);

	$sql = "SELECT * FROM students WHERE reg_no = '$reg_no'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$_SESSION['message'] = 'Reg. Number with '.$reg_no.' already exists.';

	}
	else
	{
		//inserting 
		$sql = "INSERT INTO students(name,reg_no,phone,address,created_at) VALUES('$stu_name','$reg_no','$phone_no','$address','$created_at')";
		$result = mysqli_query($conn,$sql);

		if($result)
		{
			$_SESSION['message'] =  "Hurray! Student added Success.";
		}
		else
		{
			$_SESSION['message'] = 'Something error occured.';
		}		
	}


}

if(isset($_POST['verify_btn']))
{
	$staff_id = mysqli_real_escape_string($conn,$_POST['staff_id']);

	$sql = "UPDATE admin SET is_verified = '1' WHERE id = '$staff_id'";
	$result = mysqli_query($conn,$sql);

	if($result)
	{
		$_SESSION['message'] = 'Verified Success.';
	}
	else
	{
		$_SESSION['message'] = 'Something Error Occured.';
	}

}

?>

<body style="background-color: #f7f9fc;">

	<ul class="topnav">
	  <li class="left"><a href="javascript:void(0)" title="Canteen Management" style="font-size: 18px;font-weight: bold;">Canteen Management</a></li>
	  <li class="right"><a href="logout.php" title="Logout"> <i class="fa fa-sign-out"></i> Logout</a></li>
	  <?php 

	  if($is_siteadmin):

	  ?>
	  <li><a href="settings.php" class="active" title="Settings"> <i class="fa fa-cog"></i> Settings</a></li>
	  <?php
	  	endif;
	  ?>
	  <li class="right"><a href="see_bill.php" title="See Bill"> <i class="fa fa-eye"></i> See Bill</a></li>
	  <li><a href="profile.php" title="Home"> <i class="fa fa-home"></i> Home</a></li> 
	</ul>

<main>
	<div class="cont">
	
		<div class="row">

			<?php
					if($_SESSION['message'])
					{
						echo "<center><p style='color:green;font-size:28px;margin-bottom:10px;margin-top:10px;'> ".$_SESSION['message']." </p></center>";
					}

					?>
		
			<div class="col-md-4">
				
				<div class='card' style="margin-top: 40px;">

					<h2>Add Food Items</h2>

					
					<form method='POST' autocomplete='off' enctype="multipart/form-data">

						<input type='text' name='food_name' id='food_name' placeholder='Name of Food' required/>

						<input type='number' name='food_price' id='food_price' placeholder='Price of Food' required/>

						<label style="font-size: 24px;">Choose Image:</label><br>
						<input type="file" name="image" id="image" accept="image/*" required/>

						<input type='hidden' name='created_at' value="<?php echo date('Y-m-d H:i:s'); ?>"> 

						<button type='submit' id="add_btn" name="add_btn" class='button' style='margin-top:30px;'><i class='fa fa-plus'></i> Add Now</button> 

					</form>

				</div><!--close  card-->

			</div><!--close col-->

			<div class="col-md-4 col-md-offset-0">
				
				<div class='card' style="margin-top: 40px;">

					<h2>Add Students</h2>
					
					<form method='POST' autocomplete='off'>

						<input type='text' name='stu_name' id='stu_name' placeholder='Name of Student' required/>

						<input type='text' name='reg_no' id='reg_no' placeholder='Registration Number' required/>

						<input type='number' name='phone_no' id='phone_no' placeholder='Phone Number' required/>

						<input type='text' name='address' id='address' placeholder='Address (Optional)' >

						<input type='hidden' name='stu_created_at' value="<?php echo date('Y-m-d H:i:s'); ?>"> 

						<button type='submit' id="addstudent_btn" name="addstudent_btn" class='button' style='margin-top:30px;'><i class='fa fa-plus'></i> Add Student</button> 

					</form>

				</div><!--close  card-->

			</div><!--close col-->

			<div class="col-md-3 col-md-offset-0">
				
				<div class='card' style="margin-top: 40px;">

					<h2>Requested Staffs</h2><hr>

					<?php 

					$sql = "SELECT * FROM admin WHERE is_verified = 0";
					$result = mysqli_query($conn,$sql);

					if(mysqli_num_rows($result)>0)
					{

						while($data = mysqli_fetch_assoc($result))
						{
							echo "<p style='font-size:18px;font-weight:bold;'><b>Name: ".$data['name']."</b>
							<br>

							</p>Address: ".$data['address']."
							<form method='post' style='margin-top:10px;'>
								<input type='hidden' name='staff_id' value='".$data['id']."'>
								<input type='submit' class='button' name='verify_btn' value='Verify'>
							</form>
							<hr>";
						}

					}
					else
					{
						echo "<p>Sorry! No request from staff.</p>";
					}

					?>

				</div><!--close  card-->

			</div><!--close col-->


		</div><!--close row -->



	</div><!--close cont-->
	
</main>
