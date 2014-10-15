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