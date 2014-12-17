<div id="loginmodel" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content cform">          
    <div class="container">
       <div class="row">

         <h2 id="login1">Login </h2>    
            <h2 class="login-name">Create a FREE account using any of your social profiles or email.</h2>  
           
        <div class="col-md-4" style="margin-top: 16px; border-right: 1px solid #febe07;"> 
              <div class="modal-social-icons">
                    <a href="javascript:voide('0');" onClick="FBLogin();"><img src="<?php echo $serverpath;?>images/facebook1.png" style="padding-bottom:10px;"> </a>
                    <a target="_parent" href="<?php echo $serverpath;?>loginwithtwitter" ><img src="<?php echo $serverpath;?>images/twitter1.png" style="padding-bottom:10px;"> </a>
                    <a href='<?php echo $serverpath;?>loginwithtlinkedin'><img src="<?php echo $serverpath;?>images/link.png" style="padding-bottom:10px;"> </a>
                   <a href="<?php echo $serverpath;?>login-with-google.php"><img src="<?php echo $serverpath;?>images/google.png" style="padding-bottom:10px;"></a>
              </div>
        </div>
        <div class="col-md-8">
          <form class="form-horizontal hform" method="post"  action="<?php echo $serverpath;?>checkLogin" target="targetframe" onSubmit="return validate_login();">
              <div class="form-group">
                <label for="inputEmail3" class="control-label newlog">Email</label>               
                  <input type="email" class="form-control login-passinpute" id="loginmail" name="loginmail" required placeholder="">                
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="control-label newlog">Password</label>
                  <input type="password" class="form-control login-passinpute" name="loginpass" id="loginpass" required placeholder="">
              </div>    
            <div class="form-group">
              <div class="logsign">
                <button type="submit" value="login" name="reqType" class="btn btn-warning loginbtn-on-model" id="btnLogin">Login</button>
                <!-- <button type="submit" class="btn btn-warning loginbtn">Signup</button> -->
               <button type="submit" value="signup" name="reqType" class="btn btn-warning loginbtn-on-model"  style=""> Free Signup</button>
              </div>
            </div>
        </form>
    </div>
  </div>
</div>
</div>
</div>
</div>