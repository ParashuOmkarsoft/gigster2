<?php

require("twitter/twitteroauth.php");
require 'twitter/twconfig.php';
include('cfg/cfg.php');
if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {

    $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
    $_SESSION['access_token'] = $access_token;

    $user_info = $twitteroauth->get('account/verify_credentials');

    if (isset($user_info->error)) {
        header('Location: twittlogin');
    } else {
	   $twitter_otoken=$_SESSION['oauth_token'];
	   $twitter_otoken_secret=$_SESSION['oauth_token_secret'];
	   $email='';
	  
        $uid = $user_info->id;
        $username = $user_info->name;
		$fbImage = $user_info->profile_image_url;
		
       $checkQuery="select * from btr_users where twitid=$uid";
	   $checkSql=@db_query($checkQuery);
	   if($checksql['count']>0)
	   {
		      if($fbImage)
		  {
			  $ext=get_extension($fbImage);
			  $ext=explode("?",$ext);
			  $ext=$ext[0];
			  $newname=$checkSql['rows']['0']['userId'].".$ext";
			  if(file_exists("uploads/profileimage/$newname"))
			  {
				  unlink("uploads/profileimage/$newname");
			  }
			  $mcopy=copy($fbImage,"uploads/profileimage/$newname");
			  if($mcopy)
			  {
				  $upQuery="update btr_users set profileimage='$newname' where userId=".$checkSql['rows']['0']['userId'];
				  $upQuery=@db_query($upQuery);
			  }
		  }
		   $_SESSION['uId']=encrypt_str($checkSql['rows']['0']['userId']);
			?>
			<script type="text/javascript">
			window.location="<?=$serverpath;?>allgigs";
			</script>
			<?php
	   }
	   else{
		 
		 
		   $insertQuery=@db_query("insert into btr_users(joinedon,twittid)values(".gmmktime().",'$uid')",3);
		   if($insertQuery)
		   {
			   $updateQuery=@db_query("update btr_users set authkey='".encrypt_str($insertQuery)."' where userId=$insertQuery");
			   if($fbImage)
		  {
			  $ext=get_extension($fbImage);
			  $ext=explode("?",$ext);
			  $ext=$ext[0];
			  $newname=$insertQuery.".$ext";
			  if(file_exists("uploads/profileimage/$newname"))
			  {
				  unlink("uploads/profileimage/$newname");
			  }
			  $mcopy=copy($fbImage,"uploads/profileimage/$newname");
			  if($mcopy)
			  {
				  $upQuery="update btr_users set profileimage='$newname' where userId=".$insertQuery;
				  $upQuery=@db_query($upQuery);
			  }
		  }
				$_SESSION['uId']=encrypt_str($insertQuery);
				?>
			<script type="text/javascript">
			window.location="<?=$serverpath;?>";
			</script>
			<?php
		   }
	   }
    }
} else {
    // Something's missing, go back to square 1
    header('Location: twittlogin');
}
?>
