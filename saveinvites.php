<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 
$invites=$_POST['invited'];
$projectId=$_POST['projectId'];
$gigdetails=get_gig_details($projectId);
$gigownerInfo=get_user_Info(encrypt_str($gigdetails['userId']));
$from=$gigownerInfo['userId'];
$fromuser=$from;
	$fromnamedisplay=$gigownerInfo['fname']." ".$gigownerInfo['lname'];
	$fromnamedisplay1=str_replace(" ","",$fromnamedisplay);
	if(!$fromnamedisplay1)
	{
		$fromnamedisplay=$gigownerInfo['username'];
	}
foreach($invites as $invite)
{
	
	$invitedinfo=get_user_Info(encrypt_str($invite));

	$invitednametodisplay=$invitedinfo['fname']." ".$invitedinfo['lname'];
	$invitednametodisplay1=str_replace(" ","",$invitednametodisplay);
	if(!$invitednametodisplay1)
	{
		$invitednametodisplay=$invitedinfo['username'];
	}
	
	
	$mailmatter="<p>Hello ".$invitednametodisplay." </p>
	<p>".$fromnamedisplay." has invited you to submit proposal on his gig <Br/><b>
	<a href='".$serverpath."gigDetails/".mera_url_encode($gigdetails['prjTitle'])."/".$gigdetails['prjId']."'>
	".$gigdetails['prjTitle']."</a></b>.</p>
											  <p>Please let the client know if you will accept the offer.</p>
											  <p>Proposed Budget- ".$gigdetails['proposedbudget']."</p>
											  <p>&nbsp;</p>
											  <p>Regards</p>
											  <p>$sitename</p>";
								$mailto=filter_text($invitedinfo['usermail']);
								$from="noreply@gigster.com";
								$mailsubject="You are invited to submit bid on ".$gigdetails['prjTitle'];
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
								$headers .= "From: $sitename <$from>" . "\r\n";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
								$mailmatter=strip_tags($mailmatter);
								$mailmatter=nl2br($mailmatter);
				$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				 $msgquery.="values($fromuser,$invite,'$mailmatter',".gmmktime().",".$gigdetails['prjId'].",'0','r')";
				$msgsql=@db_query($msgquery);										  
	
	
}
?>
<script type="text/javascript">
window.parent.location="<?php echo $_SERVER['HTTP_REFERER'];?>";
</script>