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

$enddate=convert_db_date($enddate);
$userInfo=get_user_Info($_SESSION['uId']);
$uId=$userInfo['userId'];
$gigtitle=filter_text($prjTitle);
$description=filter_text($prjdesc);
$price=$proposedprice;
$bidto=$enddate;
$keywords=filter_text($_POST['keywords']);
if(!$price)
{
	$price=0;
}
if(!$inviteusers)
{
	$inviteusers='0';
}else{
	$inviteusers='1';
}

if($prjTitle)
{
	$insertQuery="insert into btr_projects(userId,prjTitle,prjdesc,postedon,proposedbudget,bidfrom,bidto,keywords,jobtype,invited)";
 $insertQuery.="values($uId,'$gigtitle','$description',".gmmktime().",$price,'".date('Y-m-d')."','$bidto','$keywords','$jobtype','$inviteusers')";	

	$insertSql=@db_query($insertQuery,3);
	if($insertSql)
	{
		add_keywords($keywords);
		send_notifications($keywords,$uId,$insertSql,$serverpath);
		
		if($inviteusers != "1")
		{
		?>
		<script type="text/javascript">
			window.parent.location="<?php echo $serverpath;?>allgigs";
		</script>
		<?php
		}
		else
		{
			?>
			<script type="text/javascript">
			window.parent.document.getElementById("postgigform").style.display="none";
			window.parent.document.getElementById("postform").reset();
			window.parent.document.getElementById("inviteform").style.display="block";
			window.parent.invite_gigsters("<?php echo $serverpath;?>","<?php echo $insertSql; ?>");
			</script>
			<?php
		}
		
	}
	else{
		print_r($GLOBALS['debug_sql']);
	}
	
}
?>