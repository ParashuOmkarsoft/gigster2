function visible_invisible(visible,invisible)
{
	document.getElementById(visible).style.display="block";
	document.getElementById(invisible).style.display="none";	
}
function validate_login()
{
	var loginmail=document.getElementById("loginmail").value;
	var loginpass=document.getElementById("loginpass").value;
	
	loginmail=loginmail.replace(/\s+/g,'');
	loginpass=loginpass.replace(/\s+/g,'');	
	
	if(loginmail.length<=0)
	{
		alert("Error, Email for login / signup is required.");
		return false;
	}
		if(loginpass.length<=0)
	{
		alert("Error, Password for login / signup is required.");
		return false;
	}
}
function change_caption(mtype)
{

	if(mtype=="h")
	{
		document.getElementById("mlabel").innerHTML="How much would you like to pay?";
	}
	else
	{
		document.getElementById("mlabel").innerHTML="How much would you like to pay?";
	}
}
function only_numbers(evt)
{
	mykey=String.fromCharCode(evt.keyCode)
	mycode=evt.keyCode;

	var mstr="1234567890.";
	if(mycode=="32" || mycode=="13" || mycode=="8" || mycode=="46" || mycode=="37" || mycode=="39" )
	{
		return true;
	}
	
	 if(mstr.indexOf(mykey)<0)
	 {
		 return false;
	 }
	 
}
var mserverpath="";
function view_message_modal(serverpath,id)
{
	mserverpath=serverpath;
	 if (id=="") {
    document.getElementById("message-modal").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("message-modal").innerHTML=xmlhttp.responseText;
	  get_message_thread(mserverpath);
    }
  }
  m_url=serverpath+"getmessages.php?msgId="+id
  xmlhttp.open("GET",m_url,true);
  xmlhttp.send();
}
function view_message_modal_inner(serverpath,ownerid,biderid,projectId)
{
	
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp2=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp2.onreadystatechange=function() {
    if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
      document.getElementById("message-modal").innerHTML=xmlhttp2.responseText;
    }
  }
  m_url=serverpath+"getmessages1.php?ownerId="+ownerid+"&biderid="+biderid+"&projectId="+projectId
  xmlhttp2.open("GET",m_url,true);
  xmlhttp2.send();
}

function bid_modal(serverpath,projectId,userId)
{
	
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp3=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp3.onreadystatechange=function() {
    if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
      document.getElementById("bid-modal").innerHTML=xmlhttp3.responseText;
    }
  }
  m_url=serverpath+"my-bid_modal.php?projectId="+projectId+"&biderid="+userId

  xmlhttp3.open("GET",m_url,true);
  xmlhttp3.send();
}
function invite_gigsters(serverpath,projectId)
{
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp4=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp4.onreadystatechange=function() {
    if (xmlhttp4.readyState==4 && xmlhttp4.status==200) {
      document.getElementById("inviteform").innerHTML=xmlhttp4.responseText;
    }
  }
  m_url=serverpath+"my-invites.php?projectId="+projectId;
  xmlhttp4.open("GET",m_url,true);
  xmlhttp4.send();
}
function validate_selected()
{
	var mycheckboxes=document.getElementsByName("invited[]");
	var g=1;
	for(i=0;i<mycheckboxes.length;i++)
	{
		if(mycheckboxes.item(i).checked==true)
		{
			g++;	
		}
	}
	if(g>1)
	{
	}
	else
	{
		alert("Error, At least one gigster must be selected for invitation process.");
		return false;
	}
}
function reset_post_gig()
{
document.getElementById("postgigmodel").style.display="block";	
document.getElementById("postform").reset();
document.getElementById("inviteform").style.display="none";	
}

function view_profile_pic(serverpath,userId)
{
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp5=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp5=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp5.onreadystatechange=function() {
    if (xmlhttp5.readyState==4 && xmlhttp5.status==200) {
      document.getElementById("myprofileimage").innerHTML=xmlhttp5.responseText;
    }
  }
  m_url=serverpath+"my-profile-pic.php?userId="+userId;

  xmlhttp5.open("GET",m_url,true);
  xmlhttp5.send();
}

function validate_biding()
{

 var bidprice=document.getElementById("pprice").value;	
 bidprice=bidprice.replace(/\s+/g,'');
 if(bidprice.length<=0)
 {
	 alert("Error, You must enter a bid amount to continue.");
	 return false;
 }

}
function validate_rating(ratingid)
{
	var m_rating=document.getElementById("rating"+ratingid).value;
	m_rating=Math.round(m_rating);
	if(m_rating>0)
	{
	}
	else
	{
		alert("Rating Must be selected");
		return false;
	}
	
}


function get_message_thread(serverpath)
{
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp56=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp56=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp56.onreadystatechange=function() {
    if (xmlhttp56.readyState==4 && xmlhttp56.status==200) {
      document.getElementById("msgthread").innerHTML=xmlhttp56.responseText;
    }
  }
  m_url=serverpath+"messagethreads"

  xmlhttp56.open("GET",m_url,true);
  xmlhttp56.send();
}