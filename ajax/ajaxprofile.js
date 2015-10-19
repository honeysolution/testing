var x=false;
if(window.XMLHttpRequest)
{	
	//code for IE7+,FireFox,Chrome,Opera,Safari
	x=new XMLHttpRequest();
}
else if(window.ActiveXObject)
{ 
	//code for IE6,IE5
	x=new ActiveXObject("Microsoft.XMLHTTP");
}

function getprofile()
{
	if(x)
	{	
		/*var filename ="http://localhost/baphana/CMS/adminsearch.php?name="+ document.getElementById("t1").value;*/
		var filename ="adminsearch.php?name="+ document.getElementById("t1").value;

		x.open("GET",filename);
		x.onreadystatechange=function()
		{
			if(x.readyState==4 && x.status==200)
			{
				document.getElementById("resultdiv").innerHTML=x.responseText;
			}
		}
		x.send(null);
	}
}




function getproduct()
{
	if(x)
	{
		var prodname = document.getElementById("prod1").value;
		var cat_filter = document.getElementById("cat_filter").value;
		var filename ="http://localhost/baphana/CMS/prodsearch.php?prodname="+prodname+"&filter="+cat_filter; 
		x.open("GET",filename);
		x.onreadystatechange=function()
		{
			if(x.readyState==4 && x.status==200)
			{
				document.getElementById("resultdiv").innerHTML=x.responseText;
			}
		}
		x.send(null);
	}
}