<?php

include('/home/gigster2/www/cfg/cfg.php'); 
include('/home/gigster2/www/cfg/functions.php');
include('/home/gigster2/www/cfg/more-functions.php'); 
$postedfrom=mktime("0","0","0",date('m'),date('d'),date('Y'));
$postedto=mktime("23","59","59",date('m'),date('d'),date('Y'));

$query="select * from btr_projects where bidto>=now() and postedon>$postedfrom and postedon<$postedto order by prjId DESC ";
$sql=@db_query($query);
for($i=0;$i<$sql['count'];$i++)
{
	 $keywords=$sql['rows'][$i]['keywords'];
	
	$uId=$sql['rows'][$i]['userId'];
	$insertSql=$sql['rows'][$i]['prjId'];
	if($keywords && $uId && $insertSql)
	{
	send_notifications($keywords,$uId,$insertSql,$serverpath);
	}
}

?>