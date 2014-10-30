<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 
$userId=$_SESSION['uId'];
$userInfo=get_user_Info($userId);
$user=$userInfo['userId'];
$aboutus=filter_text($_POST['aboutus']);
$overview=filter_text($_POST['moverview']);

$frmaction=filter_text($_POST['frmaction']);
if($aboutus)
{
	$updateQuery="update btr_userprofile set aboutus='$aboutus' where userId=$user";
	$updateSql=@db_query($updateQuery);
	if(sizeof($GLOBALS['debug_sql'])<=0)
	{
		?>
		<script type="text/javascript">
		window.parent.document.getElementById("aboutuspara").innerHTML="<?php echo $aboutus;?>";
		window.parent.visible_invisible('aboutuspara','frmaboutus');
		</script>
		<?php
	}
}
if($overview)
{
	$updateQuery="update btr_userprofile set overview='$overview' where userId=$user";
	$updateSql=@db_query($updateQuery);
	
	if(sizeof($GLOBALS['debug_sql'])<=0)
	{
		?>
		<script type="text/javascript">
		window.parent.document.getElementById("overviewpara").innerHTML="<?php echo $overview;?>";
		window.parent.visible_invisible('overviewpara','frmoverview');
		</script>
		<?php
	}
	else
	{
		print_r($GLOBALS['debug_sql']);
	}
}
if($frmaction=="updateinfo")
{
	$fname=filter_text($_POST['fname']);
	$lname=filter_text($_POST['lname']);
	$tagline=filter_text($_POST['tagline']);
	$city=filter_text($_POST['city']);
	$country=filter_text($_POST['country']);
	$profileimage=$_FILES['profileimage'];
	if($fname)
	{
		$updateQuery="update btr_userprofile set fname='$fname' where userId=$user";
		$updateSql=@db_query($updateQuery);
	}
	if($lname)
	{
		$updateQuery="update btr_userprofile set lname='$lname' where userId=$user";
		$updateSql=@db_query($updateQuery);
	}
	if($tagline)
	{
		$updateQuery="update btr_userprofile set tagline='$tagline' where userId=$user";
		$updateSql=@db_query($updateQuery);
	}
	if($city)
	{
		$updateQuery="update btr_userprofile set city='$city' where userId=$user";
		$updateSql=@db_query($updateQuery);
	}
	if($country)
	{
		$updateQuery="update btr_userprofile set country=$country where userId=$user";
		$updateSql=@db_query($updateQuery);
	}
	$data=get_user_Info($_SESSION['uId']);
	$mloc="";
		if($data['city'])
			{
			 $mloc=$data['city'].",";
			}
			else
			{
				
			}
			if($data['country'])
			{
			 $mloc.=get_country_name($data['country']);
			}
			
			if($profileimage['size']>0)
			{
				$imagename=$user."XX".time().".".get_extension($profileimage['name']);
				$imagepath="uploads/profileimage/".$imagename;
				$move=move_uploaded_file($profileimage['tmp_name'],$imagepath);
				if($move)
				{
					$updateQuery="update btr_users set profileimage='$imagename' where userId=$user";
					$updateSql=@db_query($updateQuery);
					$mpath=$serverpath."image.php?image=/uploads/profileimage/".$imagepath."&width=150&height=113&cropratio=4:3";
					$mpath=mera_url_noslash($mpath);
					?>
                    <script type="text/javascript">
					window.parent.change_image("imguser","<?=mera_url_noslash($imagepath);?>");
					</script>
					<?php
				}
			}
	if($data['profileimage'])
	{
		$mpath=$serverpath."image.php?image=/uploads/profileimage/".$data['profileimage']."&width=150&height=113&cropratio=4:3";
		
	}
	else
	{
		$mpath="";
	}
	?>
	<script type="text/javascript">
	window.parent.document.getElementById("headername").innerHTML="<?php echo $data['fname'].' '. $data['lname'];?>";
	window.parent.document.getElementById("headertitle").innerHTML="<?php echo $data['tagline'];?>";
	window.parent.document.getElementById("map").innerHTML="<?php echo $mloc;?>";
	window.parent.change_image("imguser","<?=mera_url_noslash($mpath);?>");
	window.parent.visible_invisible('paraprofile','frmprofile');
	
	</script>
	<?php
	
		
	
}
?>