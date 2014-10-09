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
	print_r($pr);die();
	echo '</pre>';
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


?>