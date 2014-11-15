<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 
$prjId=$_GET['prjId'];
$prjId=filter_text($prjId);
$uInfo=get_user_Info($_SESSION['uId']);
$projectInfo=get_gig_details($prjId);
$gigname=$projectInfo['prjTitle'];
$ownerInfo=get_user_Info(encrypt_str($projectInfo['userId']));
if($projectInfo['userId']==$uInfo['userId'])
{
$updateQuery=@db_query("update btr_projects set status='3' where prjId=$prjId");
$awardedto=project_awarded_to($prjId);
$awarded=$awardedto['awardedto'];
$awardedtoInfo=get_user_Info(encrypt_str($awarded));
		$mailmatter="<p>Congratulation</p>
				<p>Gig <strong>$gigname</strong> is marked as complete.
				<p>&nbsp;</p>
				<p>Regards</p>
				<p>$sitename</p>";

if($awardedtoInfo['notify']=='1')
{

	$mailto=filter_text($awardedtoInfo['userId']);
								$mailsubject="Congratulation, your gig is marked as complete.";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
}	
			$mailmatter=strip_tags($mailmatter);
								$mailmatter=nl2br($mailmatter);
								$mailmatter=htmlentities($mailmatter);
								$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery.="values(18,$awardedto,'$mailmatter',".gmmktime().",".$prjId.",'0','t')";
				$msgsql=@db_query($msgquery);
				
}
else{
	$mailmatter="<p>Hi </p>
				<p>Gig <strong>$gigname</strong> is requested to be marked as complete.
				<p>&nbsp;</p>
				<p>Regards</p>
				<p>$sitename</p>";
		echo $mailmatter;
				if($ownerInfo['notify']=="1")
				{
					$mailto=filter_text($awardedtoInfo['userId']);
								$mailsubject="Your gig $gigname is requested to be marked as complete.";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
				}
				
				$mailmatter=strip_tags($mailmatter);
								$mailmatter=nl2br($mailmatter);
								$mailmatter=htmlentities($mailmatter);
								$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery.="values(".$uInfo['userId'].",".$projectInfo['userId'].",'$mailmatter',".gmmktime().",".$prjId.",'0','t')";
				$msgsql=@db_query($msgquery);
				?>
				<script type="text/javascript">
				window.parent.location="<?=$_SERVER['HTTP_REFERER'];?>";
				</script>
				<?php
				
				
	
}
?>