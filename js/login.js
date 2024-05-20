function login()
{
	var phone = document.getElementById('phone').value;
	var password = document.getElementById('password').value;

	if(phone.length>0 && password.length>0)
	{
		//checking phone length
		if(phone.length == 10)
		{
			//loginwithajax
			loginWithAjax(phone,password);
		}
		else
		{
			alert('Please! Enter correct phone number.');
		}

	}
	else
	{
		alert('Please! Fill all the fields');
	}

}

function loginWithAjax(phone,password)
{

//creating HTTP Request
 var xmlHttp = new XMLHttpRequest();
 var url="modules/Login.php";
 var parameters = "&phone="+phone+
 				  "&password="+password+"";
 				 

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