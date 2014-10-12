<?php 
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $sitename;?></title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
    <?php include('top-menu.php'); ?>
        <div id="grad"></div>
    <?php //include('lower-menu.php'); ?>


    <div id="imgback">
      <img src="<?php echo $serverpath;?>images/womenlap.jpg">
    </div>

<?php if(isset($_SESSION['uId']))
{
	include('post-a-gig-modal.php'); 
}
?>
  </div>

<!-- close postgig popup -->
<!-- start login popup -->
    <?php include('login-modal.php'); ?>

    </footer>

<?php
include('footer.php'); 
?>
  </body>
</html>