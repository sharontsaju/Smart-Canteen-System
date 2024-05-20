<?php require_once('modules/db_connect.php'); ?>

<?php include 'inc/header.php'; ?>

<body style="background: url(images/bg.jpg) 0px 0px no-repeat;font-family: 'Open Sans', sans-serif;background-size:cover;">
 <h1 style="color:#333;">Canteen Management System</h1>
 
 <div class="container">
 	<h2>New Staff Registration Form</h2>

 	<form method="POST" autocomplete="off">
 		
 		<input type="text" id="name" name="name" placeholder="Name" required="required"/>
 		<input type="number" id="phone" name="phone" placeholder="Phone Number" required="required"/>
 		<input type="text" id="address" name="address" placeholder="Address" required="required"/>
 		<input type="password" id="password1" name="password1" placeholder="New Password" required="required"/>
 		<input type="password" id="password2" name="password2" placeholder="Re-enter Password" required="required"/>
 		<input type="hidden" name="created_at" id="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
	<h3 style="margin-bottom: 20px;margin-top: 10px;">By clicking Register button, I agree to the <a href="#">Terms and Conditions</a></h3>

	<div class="w3ls_su"><a  href="javascript:void(0)" name="register_btn" id="register_btn" onclick="register()" title="Register">Register</a>
		<span id="ajaxDump"></span>
	</div>

	</form> 
	
	<hr><br>

	<div class="w3_acc" style="margin-top: 0px;">
		<ul>
			<li><h4 style="margin-bottom: 15px;">Already had an Account?</h4></li>
	<li><div class="w3ls_su"><a  href="index.php" id="login_btn" title="Login">Login</a></div></li>

		</ul>
	</div><!--close w3 acc-->

</div><!--close containier -->
		
<div class="copyright">
		<p>&copy; 2018 Canteen Management System.</p>		
</div>

<script type="text/javascript" src="js/register.js"></script>
<?php include 'inc/footer.php'; ?>
	
 	