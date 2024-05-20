<?php require_once('modules/db_connect.php'); ?>

<?php include 'inc/header.php'; ?>

<body style="background: url(images/bg.jpg) 0px 0px no-repeat;font-family: 'Open Sans', sans-serif;background-size:cover;">

 <h1 style="color:#333;"> Smart Canteen </h1>
 
 <div class="container">
 <center><img src="images/logo.jpg" alt="center" width="150" height="150"> 
</center>
 	<h2>Students Login</h2>

 	<form method="POST" autocomplete="off">
 		
 		<input type="text" id="reg_no" name="reg_no" placeholder="Students id" required="required"/><br>
 		<input type="password" id="password" name="password" placeholder="Password" required="required"/><br><br>

	<div class="w3ls_su"><a  href="javascript:void(0)" name="login_btn" id="login_btn" onclick="login()" title="Login" >Login</a>
		<span id="ajaxDump"></span>
	</div>

	</form> 
	
	<hr><br>

	<div class="w3_acc" style="margin-top: 0px;">
		
	</div><!--close w3 acc-->

</div><!--close containerainier -->
		


<script type="text/javascript" src="js/login_student.js"></script>

<?php include 'inc/footer.php'; ?>
