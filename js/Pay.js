
function PayBill(event)
{

 var paid_to = event.target.parentNode.dataset['id'];

 //creating HTTP Request
 var xmlHttp = new XMLHttpRequest();
 var url="modules/Pay.php";
 var parameters = "&id="+paid_to+"";
 				 
 xmlHttp.open("POST", url, true);

 xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

 xmlHttp.send(parameters);
 
 xmlHttp.onreadystatechange = function() {

  if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {

  	switch(xmlHttp.responseText)
  	{
  		case 'success':
        
  			var pay_btn = document.getElementById('pay_btn'+paid_to);
  			pay_btn.style.display = 'none';
        
  			document.getElementById('result'+paid_to).innerHTML= "<i class='fa fa-check'></i> Paid";
        
        getPaidBill();

  		break;

  		case 'failed':
  			alert('Sorry! Error Occured');
  			break;

  		default:
  			alert(xmlHttp.responseText);
  	}
  }
 }

}

function getPaidBill()
{

var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

      var paid = this.responseText;

      var remaining_text = document.getElementById('remaining').innerText;

      var total_text = document.getElementById('total').innerText;

      var remaining = total_text - paid;

    document.getElementById('paid').innerHTML = "Paid = Rs."+paid;
    document.getElementById('remaining').innerHTML = remaining;

    }
  };
  

  xhttp.open("GET", "modules/GetPaidBill.php", true);
  xhttp.send();


}