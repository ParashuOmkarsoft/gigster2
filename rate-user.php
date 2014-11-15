<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 
$gigster=filter_text($_POST['gigster']);//
$experience=filter_text($_POST['experience']);//
$experience=htmlentities($experience);
$rating=filter_text($_POST['rating']);//
if(!$rating)
{
	$rating=0;
}
$projectId=filter_text($_POST['projectId']);//
$currentuserInfo=get_user_Info($_SESSION['uId']);//
$uId=$currentuserInfo['userId'];
$gigdetails=get_gig_details($projectId);
$gigname=$gigdetails['prjTitle'];
$awardedto=project_awarded_to($projectId);
$awarded=$awardedto['awardedto'];
$awardedtoInfo=get_user_Info(encrypt_str($awarded));


if($uId==$gigdetails['userId'])
{
	
$updateQuery=@db_query("update btr_projects set status='3' where prjId=$projectId");

		$mailmatter="<p>Congratulation</p>
				<p>Gig <strong>$gigname</strong> is marked as complete.
				<p>Feedback : $experience</p>
				<p>Rating : $rating</p>				
				<p>&nbsp;</p>
				<p>Regards</p>
				<p>$sitename</p>";

if($awardedtoInfo['notify']=='1')
{

	$mailto=filter_text($awardedtoInfo['userId']);
								$mailsubject="Congratulation, you have recieved a final feedback on gig $gigname.";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
}	
			$mailmatter=strip_tags($mailmatter);
								$mailmatter=nl2br($mailmatter);
								$mailmatter=htmlentities($mailmatter);
								$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery.="values(18,$awardedto,'$mailmatter',".gmmktime().",".$prjId.",'0','t')";
				$msgsql=@db_query($msgquery);
				$insertQuery="insert into btr_reviews(ratefrom,rateto,projectId,feedback,rating,ratedon)";
				$insertQuery.="values($uId,$awarded,$projectId,'$experience','$rating',".gmmktime().")";
				$insertSql=@db_query($insertQuery,3);
				
}
else
{


	
	$mailmatter="<p>Hi </p>
				<p>Gig <strong>$gigname</strong> is requested to be marked as complete.</p>
				<p>Feedback : $experience</p>
				<p>Rating : $rating</p>				
				<p>&nbsp;</p>
				<p>Regards</p>
				<p>$sitename</p>";
		
				if($ownerInfo['notify']=="1")
				{
					$mailto=filter_text($awardedtoInfo['userId']);
								$mailsubject="You have recieved a feedback and completetion request on your gig $gigname.";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
				}
				
				$mailmatter=strip_tags($mailmatter);
								$mailmatter=nl2br($mailmatter);
								$mailmatter=htmlentities($mailmatter);
								$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery.="values(".$uInfo['userId'].",".$gigdetails['userId'].",'$mailmatter',".gmmktime().",".$projectId.",'0','t')";
				$msgsql=@db_query($msgquery);
				$insertQuery="insert into btr_reviews(ratefrom,rateto,projectId,feedback,rating,ratedon)";
				$insertQuery.="values($uId,".$gigdetails['userId'].",$projectId,'$experience','$rating',".gmmktime().")";
				$insertSql=@db_query($insertQuery,3);
}

?>
<script type="text/ecmascript">
window.parent.location="<?=$_SERVER['HTTP_REFERER'];?>";
</script>
