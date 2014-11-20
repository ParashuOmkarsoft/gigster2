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
     <?php include('top-menu.php'); ?><br/><br/>
    
    <section class="userloginform container" style="max-width: 743px;padding: 65px 30px 50px 82px;">                       
         <h2 id="userlogin">Contact us</h2>    
            <h2 class="userp" style="line-height: 26px;width: 576px;">
If you have any suggestions on how we can be better, or if you have any questions, we would love to hear from you. All you need to do is email us at contact@gigstergo.com or fill in the form below and we will get back to you within 24hrs!</h2>                     
            
          		<form class="form-horizontal usercontainer" role="form" method="post">
						  <div class="fileupload fileupload-new fileup" data-provides="fileupload">
						  <!-- <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="images/3-large.jpg" /></div>
						  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						  <div>
						  <span class="btn btn-file "><span class="fileupload-new"></span><span class="fileupload-exists"></span><input type="file" /></span>
						    
						  </div> -->
						</div>

			<div class="form-group">
   				<label for="inputEmail3" class="col-sm-3 control-label newlog">Name</label>
    			<div class="col-sm-9">
      			<input type="text" class="form-control passinpute" id="inputEmail3" placeholder="">
    			</div>
  			</div>

        	<div class="form-group">
   				<label for="inputEmail3" class="col-sm-3 control-label newlog">Email</label>
    			<div class="col-sm-9">
      			<input type="email" class="form-control passinpute" id="inputEmail3" placeholder="">
    			</div>
  			</div>
            
            <div class="form-group">
   				<label for="inputEmail3" class="col-sm-3 control-label newlog">Contact no </label>
    			<div class="col-sm-9">
      			<input type="text" class="form-control passinpute" id="inputEmail3" placeholder="" onkeydown="return only_numbers(event);">
    			</div>
  			</div>

  			<!-- <div class="form-group">
   				<label for="inputEmail3" class="col-sm-2 control-label newlog">Gender</label>
    			<label class="radio-inline rd">
                  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Male
                </label>
                <label class="radio-inline rd">
                  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">Female
                </label>
  			</div>
 -->
  			

			<!-- <div class="form-group">
						   				<label for="inputEmail3" class="col-sm-2 control-label newlog">City</label>
						    			<div class="col-sm-10">
						      			<div class="btn-group indiabtn">
						  <button class="btn btn-mini ">India</button>
						  <button class="btn btn-mini dropdown-toggle " data-toggle="dropdown">
						    <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu">
						  <li>Skilanka</li>
					      <li>Singapure</li>
						  <li>Japan</li>
						  <li>Nepal</li>     
						    
						  </ul>
						</div>
    			</div>
  			</div> -->

  			<div class="form-group">
   				<label for="inputEmail3" class="col-sm-3 control-label newlog">Subject </label>
    			<div class="col-sm-9">
      			<input type="text" class="form-control passinpute" id="inputEmail3" placeholder="">
    			</div>
  			</div>

  			<div class="form-group">
   				<label for="inputEmail3" class="col-sm-3 control-label newlog">Description</label>
    			<div class="col-sm-9">
      			 <textarea class="form-control passinpute" placeholder="" row="8" column="10"></textarea>  
    			</div>
  			</div>
  			<!-- <div class="form-group">
   				<label for="inputEmail3" class="col-sm-2 control-label newlog">Skills</label>
    			<div class="col-sm-10">
      			<input type="email" class="form-control passinpute" id="inputEmail3" placeholder="" >
    			</div>
  			</div>
  			<div class="form-group"> -->
   				<!-- <label for="inputEmail3" class="col-sm-2 control-label newlog">Contact No</label>
    			<div class="col-sm-10">
      			<input type="email" class="form-control passinpute" id="inputEmail3" placeholder="" >
    			</div>
  			</div>
  			<div class="form-group">
   				<label for="inputEmail3" class="col-sm-2 control-label newlog">Overview</label>
    			<div class="col-sm-10">
      			<textarea class="form-control passinpute" placeholder="Overview" row="5" column="10"></textarea>
    			</div>
  			</div>
  			<div class="form-group">
   				<label for="inputEmail3" class="col-sm-2 control-label newlog">Services</label>
    			<div class="col-sm-10">
      			<input type="email" class="form-control passinpute" id="inputEmail3" placeholder="" >
    			</div>
  			</div> -->
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










