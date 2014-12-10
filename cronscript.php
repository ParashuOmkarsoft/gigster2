<?php
include('cfg/cfg.php');
$postedfrom=mktime("0","0","0",date('m'),date('d'),date('Y'));
$postedto=mktime("23","59","59",date('m'),date('d'),date('Y'));

$query="select * from btr_projects where bidto>=now() and postedon>$postedfrom and postedon<$postedto order by prjId DESC ";
$sql=@db_query($query);
for($i=0;$i<$sql['count'];$i++)
{
	$keywords=$sql['rows'][$i]['keywords'];
	$uId=$sql['rows'][$i]['userId'];
	$insertSql=$sql['rows'][$i]['prjId'];
	send_notifications($keywords,$uId,$insertSql,$serverpath);
}

?>