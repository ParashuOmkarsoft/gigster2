<?php
include('cfg/cfg.php');
$gigster=filter_text($_POST['gigster']);//
$experience=filter_text($_POST['experience']);//
$rating=filter_text($_POST['rating']);//
$projectId=filter_text($_POST['projectId']);//
$uInfo=get_user_Info($_SESSION['uId']);//
$uId=$uInfo['userId'];
$checkquery="select * from btr_reviews where rateto=$gigster and ratefrom=$uId and projectId=$projectId";
$checkSql=@db_query($checkquery);
if($checkSql['count']>0)
{
	
}
else
{
	$insertQuery="insert into btr_reviews(ratefrom,rateto,projectId,feedback,rating,ratedon)";
	$insertQuery.="values($uId,$gigster,$projectId,'$experience','$rating',".gmmktime().")";
	$insertSql=@db_query($insertQuery,3);
	if($insertSql)
	{
		$updateQuery="update btr_projects set status='3' where prjId=$projectId";
		$updateSql=@db_query($updateQuery);
	?>
	<script type="text/javascript">
	window.parent.location="<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
	<?php
	}
}
?>
