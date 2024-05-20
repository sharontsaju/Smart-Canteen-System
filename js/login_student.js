function login()
{
	var reg_no = document.getElementById('reg_no').value;
	var password = document.getElementById('password').value;

	if(reg_no.length>0 && password.length>0)
	{
		//checking phone length
		if(reg_no.length > 7)
		{
			//loginwithajax
			loginWithAjax(reg_no,password);
		}
		else
		{
			alert('Please! Enter correct registration number.');
		}

	}
	else
	{
		alert('Please! Fill all the fields');
	}

}

function loginWithAjax(reg_no,password)
{

//creating HTTP Request
 var xmlHttp = new XMLHttpRequest();
 var url="modules/Login_student.php";
 var parameters = "&reg_no="+reg_no+
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
  			window.location.assign('see_bill_students.php');
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