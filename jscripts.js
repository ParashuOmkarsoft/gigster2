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