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
  <h2 class="userp" style="line-height: 26px;width: 576px;" id="userp"> If you have any suggestions on how we can be better, or if you have any questions, we would love to hear from you. All you need to do is email us at contact@gigstergo.com or fill in the details below and we will get back to you within 24hrs!</h2>
  <form class="form-horizontal usercontainer" role="form" method="post" action="<?php echo $serverpath;?>mailcontact" target="targetframe" id="contactform">
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-3 control-label newlog">Name</label>
      <div class="col-sm-9">
        <input type="text" class="form-control passinpute" id="uname" name="uname" value="<?php echo $uInfo['fname'].' '.$uInfo['lname'];?>" required placeholder="">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-3 control-label newlog">Email</label>
      <div class="col-sm-9">
        <input type="email" class="form-control passinpute" id="umail" name="umail" required placeholder="" value="<?php echo $uInfo['usermail'];?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-3 control-label newlog">Contact no </label>
      <div class="col-sm-9">
        <input type="text" class="form-control passinpute" id="contactno" name="contactno" placeholder="" onkeydown="return only_numbers(event);" value="<?php echo $uInfo['contactno'];?>">
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
    <div class="col-sm-9" style="text-align:center;margin-top: 15px;">
      <button type="submit" class="btn btn-warning uploadbtn">Send</button>
    </div>
  </form>
  	<div class="mhidden" id="my_message"><Br/><br/>
    	<div class="alert alert-success">Thanks for contacting Gigster. One of our representative will contact you soon on this.</div>
    	<p>Please <a href="<?php echo $serverpath;?>contactus">click here to return back to Contact Page.</a></p>
    </div>
  </div>
</section>
<?php
include('footer.php'); 
?>
</body>
</html>