<br/><br/><br/><br/>
<?php
include('cfg/cfg.php');

$projectId=filter_text($_POST['projectId']);
$msgfrom=filter_text($_POST['fromId']);
$msgfrominfo=get_user_Info($msgfrom);
$msgfrom=$msgfrominfo['userId'];
$msgto=filter_text($_POST['toId']);
$message=filter_text($_POST['message']);
$attachedfile=$_FILES['attachedfile'];
$messageQuery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId)";
echo $messageQuery.="values($msgfrom,$msgto,'$message',".gmmktime().",$projectId)";
$messageSql=@db_query($messageQuery,3);

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
	$mailmatter="<p>Hello User </p>
				<p>".$fromInfo['username']." has sent you a message on $sitename 
				<p>Details are following</p>
				<p>Content $message</p>
				<p>&nbsp;</p>
				<p>Regards</p>
				<p>$sitename</p>";
						
								$mailto=filter_text($toInfo['usermail']);
								$mailsubject="You have a message on $sitename";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
?>
<script type="text/javascript">
window.parent.location="<?php echo $_SERVER['HTTP_REFERER'];?>";
</script>
<?php
}


?>