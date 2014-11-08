function visible_invisible(visible,invisible)
{
	document.getElementById(visible).style.display="block";
	document.getElementById(invisible).style.display="none";	
}
function change_image(mid,mpath)
{

	document.getElementById(mid).src=unescape(mpath);
}
function change_caption(mtype)
{

	if(mtype=="h")
	{
		document.getElementById("mlabel").innerHTML="Whats the best hourly pricing you intend to pay ?";
	}
	else
	{
		document.getElementById("mlabel").innerHTML="Whats the best fix price you intend to pay ?";
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
function view_message_modal(serverpath,id)
{
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