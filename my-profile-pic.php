<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 

$userId=filter_text($_GET['userId']);
$userInfo=get_user_Info(encrypt_str($userId));

if($userInfo['profileimage'])
{
	 $pfimage=$userInfo['profileimage'];
			  ?>
            <img src="<?php echo $serverpath;?>image.php?image=/uploads/profileimage/<?php echo $pfimage;?>&width=150&cropratio=4:3" id="imguser" style="margin-right: -14px;"class="img-circle">
            <?php
}

?>