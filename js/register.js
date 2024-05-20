function register()
{
	var name = document.getElementById('name').value;
	var phone = document.getElementById('phone').value;
	var address = document.getElementById('address').value;
	var password1 = document.getElementById('password1').value;
	var password2 = document.getElementById('password2').value;
	var created_at = document.getElementById('created_at').value;
	
	if(name.length>0 && phone.length>0 && address.length>0 && password1.length>0 && password2.length>0) 
	{
		
		if(phone.length == 10)
		{

			//checking both passwords

			if(password1 == password2 )
			{
				//registering with ajax 
				registerWithAjax(name,phone,address,password1,created_at);
				
			}
			else
			{
				alert('Oops! Your two passwords donot matches.');
			}


		}
		else
		{
			alert('Please! Enter correct phone number.');
		}


	}
	else{
		alert('Please fill all the fields.');
	}


}

function registerWithAjax(name,phone,address,password,created_at)
{

 //creating HTTP Request
 var xmlHttp = new XMLHttpRequest();
 var url="modules/Register.php";
 var parameters = "name="+name+
 				  "&phone="+phone+
 				  "&address="+address+
 				  "&password="+password+
 				  "&created_at="+created_at+"";

 xmlHttp.open("POST", url, true);

 xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

 xmlHttp.onreadystatechange = function() {

  if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {

  	switch(xmlHttp.responseText)
  	{
  		case 'success':
  			//alert('Hurray!! success');
  			//redirect
  			window.location.assign('profile.php');

  			break;
  		case 'failed':
  			alert('failed');
  			break;

  		default:
  			alert(xmlHttp.responseText);
  	}

   //document.getElementById('ajaxDump').innerHTML+=xmlHttp.responseText+"<br />";
  }
 }

 xmlHttp.send(parameters);


}
