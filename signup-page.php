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
  <?php include('img-top-menu.php'); ?>  
    
      <section class="container mclass">
      
  
     <div class="container signup-form">
       <div class="col-md-12">

         <h2 id="login1">Signup</h2>    
      
            <h2 class="source">Sign Up for a new free account Now. </h2>
       <div class="col-md-8"><form class="form-horizontal hform" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label newlog">Firstname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control passinpute" id="inputEmail3" placeholder="">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label newlog">Lastname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control passinpute" id="inputEmail3" placeholder="">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label newlog">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control passinpute" id="inputEmail3" placeholder="">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label newlog">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control passinpute" id="inputPassword3" placeholder="">
    </div>
  </div>
  
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 logsign">
      <button type="submit" class="btn btn-warning loginbtn">Signup</button>
      
    </div>
  </div>

</div><!-- <div class="col-md-4 fbimg"> <div class="modal-social-icons">
                            <a href='https://www.facebook.com/'><img src="images/facebook1.png" style="padding-bottom:10px;"> </a>
                            <a href='#'><img src="images/twitter1.png" style="padding-bottom:10px;"> </a>
                            <a href='#'><img src="images/link.png" style="padding-bottom:10px;"> </a>
                            <a href='#'><img src="images/google.png" style="padding-bottom:10px;"> </a>
                        </div> </div>
         
       </div>       -->  
</div>
</form>
</div>
</div>
</div>
</section>
    <?php
include('footer.php'); 
?>
  </body>
</html>










