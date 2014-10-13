function visible_invisible(visible,invisible)
{
	document.getElementById(visible).style.display="block";
	document.getElementById(invisible).style.display="none";	
}
function change_image(mid,mpath)
{

	document.getElementById(mid).src=unescape(mpath);
}