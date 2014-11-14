<?php
include('cfg/cfg.php');

$id=$_POST['id'];
 $getQuery="select * from btr_assignment where id=$id";
$getSql=@db_query($getQuery);
if($getSql['count']>0)
{
	$gigdetails=get_gig_details($getSql['rows']['0']['projectId']);
	$user=get_user_Info(encrypt_str($getSql['rows']['0']['awardedto']));
	$gigname=$gigdetails['prjTitle'];
	$uname=$user['username'];
			$ownerinfo=get_user_Info(encrypt_str($getSql['rows']['0']['projectowner']));
	 $updateQuery=@db_query("update btr_assignment set termsaccepted='1' where id=$id");
	  $updateQuery=@db_query("update btr_projects set status='2' where prjId=".$getSql['rows']['0']['projectId']);
	 $mailmatter="<p>Congratulations</p>
				<p>Terms on your project $gigname are accepted by $uname.
				<p>&nbsp;</p>
				<p>Regards</p>
				<p>$sitename</p>";
				if($ownerinfo['notify']=="1")
				{
								$mailto=filter_text($usermail);
								$mailsubject="Congratulation,Terms are accepted on $gigname.";
								
								$mail=send_my_mail($ownerinfo['usermail'],$mailmatter,$mailsubject);
				}
					?>
		<script type="text/javascript">
		window.parent.location="<?php echo $_SERVER['HTTP_REFERER'];?>";			
		</script>
		<?php
		die();
}
?>