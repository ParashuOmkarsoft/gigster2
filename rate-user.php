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
$uInfo=$currentuserInfo;
$uId=$currentuserInfo['userId'];
$gigdetails=get_gig_details($projectId);
$gigname=$gigdetails['prjTitle'];
$awardedto=project_awarded_to($projectId);
$awarded=$awardedto['awardedto'];
$awardedtoInfo=get_user_Info(encrypt_str($awarded));


if($uId==$gigdetails['userId'])
{

		$mailmatter="<p>Congratulations!  </p>
				<p>Gig <strong>$gigname</strong> is now completed.</p>
				<p>Feedback : $experience</p>
				<p>Rating : ".get_rating_stars($serverpath,$rating)."</p>				
				<p><a href='".$serverpath."tocompleted'>Click here to rate this Gig.</a></p>				
				<p>Regards</p>
				<p>$sitename</p>";

if($awardedtoInfo['notify']=='1')
{

	$mailto=filter_text($awardedtoInfo['userId']);
								$mailsubject="Congratulation, you have received a final feedback on gig $gigname.";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
}	
			$mailmatter="<p>Congratulations!  </p>
				<p>Gig <strong>$gigname</strong> is now completed.</p>
				<p>Feedback : $experience</p>
				<p>Rating : ".get_rating_stars($serverpath,$rating)."</p>				
				<p><a href='".$serverpath."tocompleted'>Click here to rate this Gig.</a></p>	";
				$mailmatter=htmlentities($mailmatter);
				$mailmatter=addslashes($mailmatter);				
								
								$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery.="values(18,$awarded,'$mailmatter',".gmmktime().",".$projectId.",'0','t')";
				$msgsql=@db_query($msgquery);
				$insertQuery="insert into btr_reviews(ratefrom,rateto,projectId,feedback,rating,ratedon)";
				$insertQuery.="values($uId,$awarded,$projectId,'$experience','$rating',".gmmktime().")";
				$insertSql=@db_query($insertQuery,3);
			if(is_rated($awarded,$projectId))					
			{
				$updateQuery=@db_query("update btr_projects set status='3' where prjId=$projectId");
			}

				
}
else
{


	if(!is_feedback_given($projectId,$awarded))
	{
	$mailmatter="<p>Congratulations!  </p>
				<p>Gig <strong>$gigname</strong> is now complete.</p>
				<p>Feedback : $experience</p>
				<p>Rating : ".get_rating_stars($serverpath,$rating)."</p>				
				<p><a href='".$serverpath."mygigs'>Click here to rate the Gig</a></p>				
				<p>Regards</p>
				<p>$sitename</p>";

				if($ownerInfo['notify']=="1")
				{
								$mailto=filter_text($awardedtoInfo['userId']);
								$mailsubject="You have received a feedback and completetion request on your gig $gigname.";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
				}
				$mailmatter="<p>Congratulations!  </p>
				<p>Gig <strong>$gigname</strong> is now complete.</p>
				<p>Feedback : $experience</p>
				<p>Rating : ".get_rating_stars($serverpath,$rating)."</p>				
				<p><a href='".$serverpath."mygigs'>Click here to rate the Gig</a></p>				
				<p>&nbsp;</p>";
				
				
								$mailmatter=htmlentities($mailmatter);
				$mailmatter=addslashes($mailmatter);
								$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery.="values(".$uInfo['userId'].",".$gigdetails['userId'].",'$mailmatter',".gmmktime().",".$projectId.",'0','t')";
				$msgsql=@db_query($msgquery);
				$insertQuery="insert into btr_reviews(ratefrom,rateto,projectId,feedback,rating,ratedon)";
				$insertQuery.="values($uId,".$gigdetails['userId'].",$projectId,'$experience','$rating',".gmmktime().")";
				$insertSql=@db_query($insertQuery,3);
				if(is_rated($gigdetails['userId'],$projectId))					
					{
				$updateQuery=@db_query("update btr_projects set status='3' where prjId=$projectId");
					}
	}
	else
	{
				
	$mailmatter="<p>Congratulations!  </p>
				<p>Gig <strong>$gigname</strong> is now complete.</p>
				<p>Feedback : $experience</p>
				<p>Rating : ".get_rating_stars($serverpath,$rating)."</p>				
				<p><a href='".$serverpath."mygigs'>Click here to rate the Gig</a></p>				
				<p>Regards</p>
				<p>$sitename</p>";
		
				if($ownerInfo['notify']=="1")
				{
					$mailto=filter_text($awardedtoInfo['userId']);
								$mailsubject="You have received a feedback on your gig $gigname.";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
				}
				
				$mailmatter="<p>Congratulations!  </p>
				<p>Gig <strong>$gigname</strong> is now complete.</p>
				<p>Feedback : $experience</p>
				<p>Rating : ".get_rating_stars($serverpath,$rating)."</p>				
				<p><a href='".$serverpath."mygigs'>Click here to rate the Gig</a></p>";
				
				$mailmatter=htmlentities($mailmatter);
				$mailmatter=addslashes($mailmatter);
				
				$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				 $msgquery.="values(".$uInfo['userId'].",".$gigdetails['userId'].",'$mailmatter',".gmmktime().",".$projectId.",'0','t')";
				$msgsql=@db_query($msgquery);
				
				$insertQuery="insert into btr_reviews(ratefrom,rateto,projectId,feedback,rating,ratedon)";
				$insertQuery.="values($uId,".$gigdetails['userId'].",$projectId,'$experience','$rating',".gmmktime().")";
				$insertSql=@db_query($insertQuery,3);
				if(is_rated($gigdetails['userId'],$projectId))					
					{
				$updateQuery=@db_query("update btr_projects set status='3' where prjId=$projectId");
					}
				
				
	
	}
}

?>
<script type="text/ecmascript">
window.parent.location="<?php echo$_SERVER['HTTP_REFERER'];?>";
</script>
