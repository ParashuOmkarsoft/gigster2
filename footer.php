<?php if(isset($_SESSION['uId']))
{
	include('post-a-gig-modal.php'); 
}
?>
</div>

<!-- close postgig popup -->
<!-- start login popup -->
<?php if(!isset($_SESSION['uId'])){include('login-modal.php'); } ?>
<?php if(!isset($_SESSION['uId'])){include('signup-model.php'); } ?>
<footer>
  <div>
    <div class="col-md-8">
      <ul class="footernav">
        <li><a href="#">About</a></li>
        <li><a href="#">Help</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Terms</a></li>
        <li><a href="#">Privacy</a></li>
      </ul>
    </div>
    <div class="col-md-4">
      <div id="footerimages"> <img src="<?php echo $serverpath;?>images/facebook.png"> <img src="<?php echo $serverpath;?>images/twitter.png"> </div>
    </div>
  </div>
</footer>
  <script src="<?php echo $serverpath;?>glDatePicker.min.js"></script>
 <script src="<?php echo $serverpath;?>js/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo $serverpath;?>js/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<iframe name="targetframe" id="targetframe" style="display:none;" ></iframe>
