<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 

$reportId=filter_text($_GET['reportId']);
if($reportId)
{
	$updateQuery="update btr_reports set isapproved='1' where rpId=$reportId";
	$updateSql=@db_query($updateQuery);
	if(sizeof($GLOBALS['debug_sql'])<=0)
	{
		$reportdetails=get_report_details($reportId);
		$projectowner=get_user_Info(encrypt_str($reportdetails['reportto']));
		$projectdetails=get_gig_details($reportdetails['projectId']);
		$reportfrom=get_user_Info(encrypt_str($reportdetails['reportfrom']));
		$messagecontent="<p>Hello ".$reportfrom['username']."</p><br/>";
	$messagecontent.="<p>Your status report on  project <strong>".$projectdetails['prjTitle']."</strong> is approved by <strong>".$projectbidder['username']."</strong></p><br/>";
	$messagecontent.="<p><strong>Regards</strong><br/>$sitename</p>";
	$messagecontent=htmlentities($messagecontent);
	$messagequery="insert into btr_messages(msgfrom,msgto,msgcontent,haveattachment,msgon,projectId,isread,msgtype)";
	 $messagequery.="values(".$reportdetails['reportto'].",".$reportdetails['reportfrom'].",'$messagecontent','0',".time().",".$reportdetails['projectId'].",'0','r')";	
	 $messagesql=@db_query($messagequery,3);
	 if($messagesql)
	 {
		 ?>
		 <script type="text/javascript">
		 window.parent.location="<?php echo $_SERVER['HTTP_REFERER'];?>";
		 </script>
		 <?php
	 }
	}
	else
	{
		print_r($GLOBALS['debug_sql']);
	}
}
?>