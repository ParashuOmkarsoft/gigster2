<?php
function toPublicId($id)
{
	return base64_encode($id * 14981488888 + 8259204988888);
}

function toInternalId($publicId) 
{
	return (base64_decode($publicId) - 8259204988888) / 14981488888;
}

function pr($pr)
{
	echo '<pre>';
	print_r($pr);
	echo '</pre>';die();
}

function get_country_name($country)
{
	$query="select countryname from btr_countries where id=$country";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return ucwords(strtolower($sql['rows']['0']['countryname']));
	}
}

function mera_url_noslash($noslashtitle)
{	$noslashtitle = str_replace(' ', '', $noslashtitle);
	$noslashtitle = str_replace('/', '-', $noslashtitle);
	$noslashurl = urlencode($noslashtitle);
	return $noslashurl;
}
function project_awarded_to($projectId)
{
	$query="select * from btr_assignment where projectId=$projectId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0'];
	}
	
	
}
?>