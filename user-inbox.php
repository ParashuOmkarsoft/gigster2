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
     <title><?php echo $sitename;?> - Inbox</title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
   <?php include('img-top-menu.php'); ?>
        
     

    </section>

<section class="container mclass" id="msgthread">

</section>
<script type="text/javascript">
get_message_thread("<?php echo $serverpath;?>","<?php echo $uInfo['userId'];?>");
</script>
<?php  ?>
<?php include('footer.php'); ?>
  </body>
</html>