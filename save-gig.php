<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 
$prjTitle=filter_text($_POST['prjTitle']);
$prjdesc=filter_text($_POST['prjdesc']);
$jobtype=filter_text($_POST['jobtype'][0]);
$proposedprice=filter_text($_POST['proposedprice']);
$inviteusers=filter_text($_POST['inviteusers'][0]);
$enddate=filter_text($_POST['enddate']);
$userInfo=get_user_Info($_SESSION['uId']);
$uId=$userInfo['userId'];
$gigtitle=filter_text($prjTitle);
$description=filter_text($prjdesc);
$price=$proposedprice;
$bidto=$enddate;
$keyword='';

if($prjTitle && $proposedprice)
{
	$insertQuery="insert into btr_projects(userId,prjTitle,prjdesc,postedon,proposedbudget,bidfrom,bidto,keywords,jobtype)";
	$insertQuery.="values($uId,'$gigtitle','$description',".gmmktime().",$price,'".date('Y-m-d')."','$bidto','$keywords','$jobtype')";	
	$insertSql=@db_query($insertQuery,3);

	?>

    <?php
	if($insertSql)
	{
		//add_keywords($keywords)
		?>
		<script type="text/javascript">
			window.parent.location="<?=$serverpath;?>allgigs";
		</script>
		<?php
	}
	else{
		print_r($GLOBALS['debug_sql']);
	}
	
}
?>