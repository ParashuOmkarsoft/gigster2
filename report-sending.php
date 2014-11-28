<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 

$projectId=filter_text($_POST['projectId']);
$reportfrom=filter_text($_POST['reportfrom']);
$reportto=filter_text($_POST['reportto']);
$message=filter_text($_POST['message']);
$completed=filter_text($_POST['completed']);
$insertQuery="insert into btr_reports(rpdate,projectId,reportto,reportfrom,description,isapproved,completion)values(".time().",$projectId,$reportto,$reportfrom,'$message','0',$completed)";
$insertSql=@db_query($insertQuery,3);
if($insertSql)
{
	$projectowner=get_user_Info(encrypt_str($reportto));
	$projectbidder=get_user_Info(encrypt_str($reportfrom));
	$projectdetails=get_gig_details($projectId);
	$messagecontent="<p>Hello ".$projectowner['username']."</p><br/>";
	$messagecontent.="<p>You have recieved a new status report on your Gig <strong>".$projectdetails['prjTitle']."</strong> from <strong>".$projectbidder['username']."</strong>.</p><br/>";
	$messagecontent.="<p><strong>Message</strong><br/>$message</p><br/>";
	$messagecontent.="<p><strong>Completion Status </strong><br/>$completed %</p>";	
	$messagecontent=htmlentities($messagecontent);
	$messagequery="insert into btr_messages(msgfrom,msgto,msgcontent,haveattachment,msgon,projectId,isread,msgtype,reportid)";
	$messagequery.="values($reportfrom,$reportto,'$messagecontent','0',".time().",$projectId,'0','s',$insertSql)";	
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
else{
	print_r($GLOBALS['debug_sql']);
}
?>