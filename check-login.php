<?php

include('cfg/cfg.php');

$loginmail=filter_text($_POST['loginmail']);
$loginpass=filter_text($_POST['loginpass']);
$reqType=filter_text($_POST['reqType']);
if($reqType=="signup")
{
	if($loginpass){
	$loginpass=encrypt_str($loginpass);
	}
	$checkQuery="select * from btr_users where usermail='$loginmail'";
	$checkSql=@db_query($checkQuery);
	if($checkSql['count']>0)
	{
		?>
		<script type="text/javascript">
		alert("Error, Email already registered with us.");
		</script>
		<?php
	}
	else
	{
		$insertQuery="insert into btr_users(usermail,userpass,usertype,joinedon,isactive)";
		$insertQuery.="values('$loginmail','$loginpass','u',".time().",'1')";
		$insertSql=@db_query($insertQuery,3);
		if($insertSql)
		{
			$_SESSION['uId']=encrypt_str($insertSql);
			?>
			<script type="text/javascript">
			window.parent.location="<?php echo $serverpath;?>myaccount";
			</script>
			<?php
		}
		
	}
}
else
{
	$loginpass=encrypt_str($loginpass);
	$checkQuery="select * from btr_users where usermail='$loginmail' and userpass='$loginpass'";
	$checkSql=@db_query($checkQuery);
	if($checkSql['count']>0)
	{
		$_SESSION['uId']=encrypt_str($checkSql['rows']['0']['userId']);
		?>
		<script type="text/javascript">
		window.parent.location="<?php echo $_SERVER['HTTP_REFERER'];?>";
		</script>
		<?php
	}
	else
	{
		?>
		<script type="text/javascript">
			alert("Error, Invalid username/password.");
		</script>
		<?php
	}
}
?>