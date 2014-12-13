<?php

include('/home/gigster2/www/cfg/cfg.php'); 
include('/home/gigster2/www/cfg/functions.php');
include('/home/gigster2/www/cfg/more-functions.php'); 

$postedto=time();
$postedfrom=$postedto-(10*60*60);
$query="select * from btr_projects where bidto>=now() and notsent='0' and postedon>$postedfrom and postedon<$postedto order by prjId DESC ";

$sql=@db_query($query);


for($i=0;$i<$sql['count'];$i++)
{
	 $keywords=$sql['rows'][$i]['keywords'];
	
	$uId=$sql['rows'][$i]['userId'];
	$insertSql=$sql['rows'][$i]['prjId'];
	if($keywords && $uId && $insertSql)
	{
	
		send_notifications($keywords,$uId,$insertSql,$serverpath);
		$updateQuery="update btr_projects set notsent='1' where prjId=$insertSql";
		$updateSql=@db_query($updateQuery);
	}
}

?>