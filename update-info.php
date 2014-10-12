<?php
include('cfg/cfg.php');
$userId=$_SESSION['uId'];
$userInfo=get_user_Info($userId);
$user=$userInfo['userId'];
$aboutus=filter_text($_POST['aboutus']);
if($aboutus)
{
	$updateQuery="update btr_userprofile set aboutus='$aboutus' where userId=$user";
	$updateSql=@db_query($updateQuery);
	if(sizeof($GLOBALS['debug_sql'])<=0)
	{
		?>
		
		<?php
	}
}
?>