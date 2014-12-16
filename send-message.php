<br/><br/><br/><br/>
<?php
include('cfg/cfg.php');
print_r($_POST);
$projectId=filter_text($_POST['projectId']);
$msgfrom=filter_text($_POST['fromId']);
$msgto=filter_text($_POST['toId']);
$message=filter_text($_POST['message']);
$attachedfile=$_FILES['attachedfile'];
$messageQuery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId)";
echo $messageQuery.="values($msgfrom,$msgto,'$message',".gmmktime().",$projectId)";
$messageSql=@db_query($messageQuery,3);
print_r($GLOBALS['debug_sql']);
if($attachedfile['size']>0)
{
	$ext=get_extension($attachedfile['name']);
	$newname=$messageSql."XX".time().".$ext";
	$newpath="uploads/messages/".$newname;
	$move=move_uploaded_file($attachedfile['tmp_name'],$newpath);
	if($move)
	$updateQuery1=@db_query("update btr_messages set haveattachment='1' where msgId=$messageSql");
	$updateQuery2="insert into btr_attachments(userId,attchpath,attachmenttype,attachedon,msgId)";
	$updateQuery2.="values($msgfrom,'$newname','$ext',". gmmktime().",$messageSql)";
	$updateQuery2.=@db_query($updateQuery2,3);
}
if($messageSql)
{
	$fromInfo=get_user_Info(encrypt_str($msgfrom));
	$toInfo=get_user_Info(encrypt_str($msgto));
	$toName=$toInfo['fname'].' '.$toInfo['lname'];
	$toName1=str_replace(" ",'',$toName);
	if($toName1)
	{
	}
	else
	{
		$toName=filter_text($toInfo['username']);
	}
	$fromName=$fromInfo['fname'].' '.$fromInfo['lname'];
	$fromName1=str_replace(" ",'',$fromName);
	if($fromName1)
	{
	}
	else
	{
		$fromName=filter_text($fromInfo['username']);
	}
	
	$mailmatter="
		<p><a href='".$serverpath."'><img src='".$serverpath."'images/logo-1.png' /></a></p>
	<p>Hello $toName </p>
				<p><strong>".$fromName."</strong> has sent you a message on Gigster 
				<p>$message</p>
				<p>To respond to your messages, go straight to your <a href='".$serverpath."inbox'>Inbox</a>.</p>
				<p>GigsterGo.com</p>
				<p>________________________________________</p>
<p style='font-style:italic;'>GigsterGo sends these emails based on the preferences you set for your account. To change your communication preferences and adjust your skill matches, <a href='".$serverpath."'>login</a> and go to your <a href='".$serververpath."myaccount'>Profile</a>. </p>
				";
						if($toInfo['notify']=="1")
						{
								$mailto=filter_text($toInfo['usermail']);
								$mailsubject="You have a new message on Gigster";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
						}
?>
<script type="text/javascript">
window.parent.location="<?php echo $_SERVER['HTTP_REFERER'];?>";
</script>
<?php
}


?>