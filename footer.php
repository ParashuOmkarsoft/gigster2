<?php if(isset($_SESSION['uId']))
{
	include('post-a-gig-modal.php'); 
}
//include('invite-modal.php'); 
?>
</div>

<!-- close postgig popup -->
<!-- start login popup -->
<?php if(!isset($_SESSION['uId'])){include('login-modal.php'); } ?>
<?php if(!isset($_SESSION['uId'])){include('signup-model.php'); } ?>
<?php if(isset($_SESSION['uId'])){include('bid-modal.php'); } ?>



<footer>
  <div class="container" style="max-width: 1246px;">
    <div class="col-md-8" style="padding-left: 9px;">
      <ul class="footernav" style="padding: 15px 0px 0px 0px;">
        <li><a href="<?php echo $serverpath;?>aboutus">About</a></li>
        <!-- <li><a href="#">Help</a></li> -->
        <li><a href="<?php echo $serverpath;?>contactus">Contact</a></li>
        <li><a href="<?php echo $serverpath;?>terms">Terms</a></li>
        <li><a href="<?php echo $serverpath;?>privacy">Privacy</a></li>
      </ul>
    </div>
    <div class="col-md-4">
      <div class="footerimages pull-right"> <a href="<?php echo $fbLink;?>" target="_blank"><img src="<?php echo $serverpath;?>images/facebook.png"></a>&nbsp;<a href="<?php echo $twitterLink;?>" target="_blank"><img src="<?php echo $serverpath;?>images/twitter.png"></a></div>
    </div>
  </div>
</footer>
<?php include('message-modal.php');?>

<script src="<?php echo $serverpath;?>js/datatables/jquery.dataTables.js" type="text/javascript"></script> 
<script src="<?php echo $serverpath;?>js/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo $serverpath;?>js/classie.js" type="text/javascript"></script>
<iframe name="targetframe" id="targetframe" style="display:none;" ></iframe>
<script>

function init() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 300,
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
            classie.add(header,"smaller");
        } else {
            if (classie.has(header,"smaller")) {
                classie.remove(header,"smaller");
            }
        }
    });
}
window.onload = init();
</script>