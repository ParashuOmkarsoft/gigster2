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
	<p>".$fromnamedisplay." has invited you to submit a bid on the Gig <b>".$gigdetails['prjTitle']."</b>.</p>
											  <p>Click here to see full details and submit a bid.</p>
											  <p><b><a href='".$serverpath."gigDetails/".mera_url_encode($gigdetails['prjTitle'])."/".$gigdetails['prjId']."'>Click Here To View Gig</a></b></p>
											  <p>&nbsp;</p>
											  <p>Best regards,</p>
											  <p>GigsterGo.com </p>";
								$mailto=filter_text($invitedinfo['usermail']);
								$from="noreply@gigster.com";
								$mailsubject="You are invited to submit bid on ".$gigdetails['prjTitle'];
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
								$headers .= "From: $sitename <$from>" . "\r\n";

								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
								$mailmatter="<p>Hello ".$invitednametodisplay." </p>
	<p>".$fromnamedisplay." has invited you to submit a bid on the Gig <b>".$gigdetails['prjTitle']."</b>.</p>
											  <p>Click here to see full details and submit a bid.</p>
											  <p><b><a href='".$serverpath."gigDetails/".mera_url_encode($gigdetails['prjTitle'])."/".$gigdetails['prjId']."'>Click Here To View Gig</a></b></p>";
								$mailmatter=strip_tags($mailmatter);
								$mailmatter=nl2br($mailmatter);
				$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				 $msgquery.="values(18,$invite,'$mailmatter',".gmmktime().",".$gigdetails['prjId'].",'0','r')";
				$msgsql=@db_query($msgquery);										  
	
	
}
?>
<script type="text/javascript">
window.parent.location="<?php echo $_SERVER['HTTP_REFERER'];?>";
</script>