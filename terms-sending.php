<?php
include('cfg/cfg.php');
include('cfg/more-functions.php'); 

$projectId=filter_text($_POST['projectId']);
$ownerId=filter_text($_SESSION['uId']);
$ownerId=get_user_Info($_SESSION['uId']);
$ownerId=$ownerId['userId'];
$awardedto=filter_text($_POST['awardedto']);
$terms=filter_text($_POST['terms']);
$startdate=date('y-m-d');
$enddate=filter_text($_POST['enddate']);
$enddate=convert_db_date($enddate);
$ownerInfo=get_user_Info(encrypt_str($ownerId));
$startfrom=$startdate;
$to=$enddate;

$amount=filter_text($_POST['amount']);
$checkQuery="select * from btr_assignment where projectId=$projectId";
$checkSql=@db_query($checkQuery);
if($checkSql['count']>0)
{
	?>
		<script type="text/javascript">
	
		window.parent.document.getElementById("successmsg").style.display="none";		
		window.parent.document.getElementById("errormsg").style.display="block";				
		window.parent.document.getElementById("errormsg").innerHTML="Error, Project Already Awarded.";				
		</script>
		<?php
		die();
}
else
{
	$insertQuery="insert into btr_assignment(projectId,awardedto,assignedon,startdate,completiondate,projectowner,terms,amount,termsaccepted)";
	$insertQuery.="values($projectId,$awardedto,".gmmktime().",'$startfrom','$to',$ownerId,'$terms',$amount,'1')";	
	$insertQuery=@db_query($insertQuery,3);
	if($insertQuery)
	{
		$updateQuery=@db_query("update btr_projects set status='2' where prjId=$projectId");
		$userInfo=get_user_Info(encrypt_str($awardedto));
		$gigdetails=get_gig_details($projectId);
		$gigname=$gigdetails['prjTitle'];
		$usermail=$userInfo['usermail'];
	$usernametodisplay=$userInfo['fname']." ".$userInfo['lname'];
	$usernametodisplay1=str_replace(" ","",$usernametodisplay);
	if(!$usernametodisplay1)
	{
		$usernametodisplay=$userInfo['username'];
	}
		$mailmatter="<p>Congratulations!</p>
				<p>You have won the Gig <a href='".get_project_link($serverpath,$projectId)."'><font style='font-color:#7d2900;'>$gigname</font></a>.</p>
				<p>To update the status and see full details, please <a href='".get_project_link($serverpath,$projectId)."'>click here</a>.</p>
				<p>&nbsp;</p>
				<p>Regards</p>
				<p>$sitename</p>";
	if($userInfo['notify']=='1')
	{
	
				

				
						
								$mailto=filter_text($usermail);
								$mailsubject="Congratulation, your proposal is chosen";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
							
	}
	$mailmatter="<p>Congratulations!</p>
				<p>You have won the Gig <a href='".get_project_link($serverpath,$projectId)."'><font style='font-color:#7d2900;'>$gigname</font></a>.</p>
				<p>To update the status and see full details, please  <a href='".get_project_link($serverpath,$projectId)."'>click here</a>.</p>";
								$mailmatter=htmlentities($mailmatter);
								$mailmatter=addslashes($mailmatter);
								$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery.="values($ownerId,$awardedto,'$mailmatter',".gmmktime().",".$projectId.",'0','t')";
				$msgsql=@db_query($msgquery);
				
				// Sending mail to gig owner
				

				
				
	$mailmatter1="<p>You have awarded the Gig <a href='".get_project_link($serverpath,$projectId)."'><font style='font-color:#7d2900;'>".$gigname."</font></a> to <a href='".get_profile_link($serverpath,$awardedto)."'>".$usernametodisplay."</a>.</p>";
				
	if($ownerInfo['notify']=='1')
	{
				$mailto=filter_text($ownerInfo['usermail']);
				$mailsubject1="Congratulation, your gig is awawrded.";
				$mail1=send_my_mail($ownerInfo['usermail'],$mailmatter1,$mailsubject1);	
	}
								$mailmatter1=strip_tags($mailmatter1);
								$mailmatter1=nl2br($mailmatter1);
								$mailmatter1=htmlentities($mailmatter1);
								$msgquery1="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery1.="values(18,$ownerId,'$mailmatter1',".gmmktime().",".$projectId.",'0','t')";
				$msgsql=@db_query($msgquery1);
				// Sending mail to gig owner ends
	
		$projectbids=get_project_bids($projectId);
		if($projectbids['count']>0)
		{
			for($p=0;$p<$projectbids['count'];$p++)
			{
				$bidderInfo=get_user_Info(encrypt_str($projectbids['rows'][$p]['bidfrom']));
				$biderId=$bidderInfo['userId'];
				$biddernametodisplay=$bidderInfo['fname'].' '. $bidderInfo['lname'];
				$biddernametodisplay1=str_replace($biddernametodisplay);
				if(!$biddernametodisplay1)
				{
					$biddernametodisplay=$bidderInfo['username'];
				}
				$mailmatter2="<p>Hi ".$biddernametodisplay."</p>
				<p>Unfortunately your bid on <span style='font-color:#7d2900;'>$gigname</span> was not selected.
				<p>Better luck next time.</p>
				<p><a href='".$serverpath."allgigs'>Do check out our other Gigs here</a>.</p>
				<p>Regards</p>
				<p>$sitename</p>";
				if($bidderInfo['notify']=="1")
				{
						$mailto2=filter_text($bidderInfo['usermail']);
						$mailsubject2="Notification, gig $gigname is awawrded to someone else.";
						$mail2=send_my_mail($mailto2,$mailmatter2,$mailsubject2);	
				}
				$mailmatter2="<p>Hi ".$biddernametodisplay."</p>
				<p>Unfortunately your bid on <span style='font-color:#7d2900;'>$gigname</span> was not selected.
				<p>Better luck next time.</p>
				<p><a href='".$serverpath."allgigs'>Do check out our other Gigs here</a>.</p>";
				$mailmatter2=htmlentities($mailmatter2);
				$mailmatter2=addslashes($mailmatter2);
				if($biderId != $awardedto)
				{
				
				$msgquery3="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery3.="values(18,$biderId,'$mailmatter2',".gmmktime().",".$gigdetails['prjId'].",'0','t')";
				$msgquery3=@db_query($msgquery3);
				
				}
			}
		}
	
		?>
		<script type="text/javascript">
		window.parent.location="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($gigdetails['prjTitle']);?>/<?php echo $gigdetails['prjId'];?>";	
		</script>
		<?php
		die();
	}
	else
	{
		print_r($GLOBALS['debug_sql']);
	}
}

?>