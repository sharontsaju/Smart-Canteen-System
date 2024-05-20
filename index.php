<?php require_once('modules/db_connect.php'); ?>

<?php include 'inc/header.php'; ?>

<body style="background: url(images/canteen.jpg) 0px 0px no-repeat;font-family: 'Open Sans', sans-serif;background-size:cover;">

 <h1 style="color:Black;font-family: 'Open Sans';">Smart Canteen</h1>

 <div class="container">
 	<center><img src="images/logo.jpg" alt="center" width="150" height="150"> 
</center>
 	<h2>Staff Login</h2>

 	<form method="POST" autocomplete="off">
 		
 		<input type="number" id="phone" name="phone" placeholder="Phone Number" required="required"/><br>
 		<input type="password" id="password" name="password" placeholder="Password" required="required"/><br><br>

	<div class="w3ls_su"><a  href="javascript:void(0)" name="login_btn" id="login_btn" onclick="login()" title="Login" >Login</a>
		<span id="ajaxDump"></span>
	</div>

	</form> 
	
	<hr><br>

	<div class="w3_acc" style="margin-top: 0px;">
		<ul>
			<li><h4 style="margin-bottom: 15px;">Don't have an Account?</h4></li>
	<li><div class="w3ls_su"><a  href="register.php" id="register_btn" title="Register">Register</a></div></li>
      
		</ul>
	<a href="index_student.php">Go to student login</a>

	</div><!--close w3 acc-->

</div><!--close containerainier -->
		


<script type="text/javascript" src="js/login.js"></script>

<?php include 'inc/footer.php'; ?>
	
 	
