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
<br/>
<br/>
<section class="userloginform container" style="max-width: 743px;padding: 65px 30px 50px 82px;">
  <h2 id="userlogin">Contact us</h2>
  <h2 class="userp" style="line-height: 26px;width: 576px;"> If you have any suggestions on how we can be better, or if you have any questions, we would love to hear from you. All you need to do is email us at contact@gigstergo.com or fill in the form below and we will get back to you within 24hrs!</h2>
  <form class="form-horizontal usercontainer" role="form" method="post" action="<?=$serverpath;?>mailcontact" target="targetframe">
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-3 control-label newlog">Name</label>
      <div class="col-sm-9">
        <input type="text" class="form-control passinpute" id="uname" name="uname" required placeholder="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-3 control-label newlog">Email</label>
      <div class="col-sm-9">
        <input type="email" class="form-control passinpute" id="umail" name="umail" required placeholder="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-3 control-label newlog">Contact no </label>
      <div class="col-sm-9">
        <input type="text" class="form-control passinpute" id="contactno" name="contactno" placeholder="" onkeydown="return only_numbers(event);">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-3 control-label newlog">Subject </label>
      <div class="col-sm-9">
        <input type="text" class="form-control passinpute" required id="mailsubject" name="mailsubject" placeholder="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-3 control-label newlog">Description</label>
      <div class="col-sm-9">
        <textarea class="form-control passinpute"  name="maildesc" id="maildesc" placeholder="" row="8" column="10"></textarea>
      </div>
    </div>
    <div class="col-sm-2">
      <button type="submit" class="btn btn-warning uploadbtn">Send</button>
    </div>
  </form>
  </div>
</section>
<?php
include('footer.php'); 
?>
</body>
</html>