<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 

$proposal=filter_text($_POST['proposal']);
$price=filter_text($_POST['pprice']);
$projectId=filter_text($_POST['projectId']);
if($price){
$attachedfile=$_FILES['attachedfile'];
if($_SESSION['uId'])
{
	$userInfo=get_user_Info($_SESSION['uId']);
	$uId=$userInfo['userId'];
}
$checkQuery="select * from btr_bids where projectId=$projectId and bidfrom=$uId";
$checkSql=@db_query($checkQuery);
if($checkSql['count']>0)
{
	$mId=$checkSql['rows']['0']['bidId'];
	$updateQuery="update btr_bids set bidcontent='$proposal' ,bidprice=$price,updatedon=".gmmktime()." where bidId=".$checkSql['rows']['0']['bidId'];
	$updateSql=@db_query($updateQuery);
	$gigdetails=get_gig_details($projectId);
	$giguser=$gigdetails['userId'];
	$giguserinfo=get_user_Info(encrypt_str($giguser));

	$gigusername=$giguserinfo['username'];
	if($giguser)
	{
									$mailmatter="<p>Hello User </p>
											  <p>".$userInfo['username']." has updated his proposal on your gig ".$gigdetails['prjTitle'].".</p>
											  <p>Details are following</p>
											  <p>Username- ".$userInfo['username']."</p>
											  <p>Amount- $price</p>
											  <p>Content $proposal</p>
											  <p>&nbsp;</p>
											  <p>Regards</p>
											  <p>$sitename</p>";
						
								$mailto=filter_text($giguserinfo['usermail']);
								$from="rohitbanna@gmail.com";
								$mailsubject="A  proposal is updated on your gig.";
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
								$headers .= "From: $sitename <$from>" . "\r\n";
								if($giguserinfo['notify']=="1")
								{
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
								}
				
				//$mailmatter=strip_tags($mailmatter);
				$mailmatter=nl2br($mailmatter);
				$mailmatter=htmlentities($mailmatter);
				$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery.="values($uId,$giguser,'$mailmatter',".gmmktime().",".$gigdetails['prjId'].",'0','r')";
				$msgsql=@db_query($msgquery);

						

	}
}
else
{
	$insertQuery="insert into btr_bids(bidfrom,bidon,projectId,bidcontent,bidprice)";
	 $insertQuery.="values($uId,".gmmktime().",$projectId,'$proposal',$price)";	
	$insertSql=@db_query($insertQuery,3);
	$mId=$insertSql;
	$gigdetails=get_gig_details($projectId);
	$giguser=$gigdetails['userId'];
	$giguserinfo=get_user_Info(encrypt_str($giguser));
	if($giguser)
	{
		$mailto=filter_text($giguserinfo['usermail']);
	$mailmatter="<p>Hello ".$giguserinfo['username']." </p>
											  <p>You have received a new bid on your Gig <a href='".get_project_link($serverpath,$gigdetails['prjId'])."'><strong>".$gigdetails['prjTitle']."</strong></a> from ".$userInfo['username'].".</p><p>".strip_string($proposal,100)."</p><p><a href='".get_project_link($serverpath,$gigdetails['prjId'])."'>Click here to see more details and award this Gig.</a></p><p>Best regards, </p><p>GigsterGo.com </p>";

						
								$mailto=filter_text($giguserinfo['usermail']);
								$from="notifications@gigster.com";
								$mailsubject="A new proposal is submited on your gig.";
								if($giguserinfo['notify']=="1")
								{
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
								}
								
								$mailmatter="<p>Hello ".$giguserinfo['username']." </p>
											  <p>You have received a new bid on your Gig <a href='".get_project_link($serverpath,$gigdetails['prjId'])."'><strong>".$gigdetails['prjTitle']."</strong></a> from ".$userInfo['username'].".</p><p>".strip_string($proposal,100)."</p><p><a href='".get_project_link($serverpath,$gigdetails['prjId'])."'>Click here to see more details and award this Gig.</a></p>";
											 
								
								
								
$mailmatter=htmlentities($mailmatter);
$mailmatter=nl2br($mailmatter);
$mailmatter=addslashes($mailmatter);
				$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				 $msgquery.="values($uId,$giguser,'$mailmatter',".gmmktime().",".$gigdetails['prjId'].",'0','r')";
				$msgsql=@db_query($msgquery);
									
	}
	
}

if(sizeof($GLOBALS['debug_sql'])<=0)
	{ 
$gigdetails=get_gig_details($projectId);
	?>
   	
	<script type="text/javascript">
	window.parent.location="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($gigdetails['prjTitle']);?>/<?php echo $gigdetails['prjId'];?>";
	</script>
	
	<?php	
	
	}
	else
	{
		print_r($GLOBALS['debug_sql']);
	}
}
else
{
	?>
	<script type="text/javascript">
	alert("Error, You must enter a bid price to submit your bid.");
	window.parent.location="<?php echo$_SERVER['HTTP_REFERER'];?>";
	</script>
	<?php
}
?>
</body>
</html>