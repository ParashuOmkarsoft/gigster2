<div id="loginmodel" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content cform">          
    <div class="container">
       <div class="row">

         <h2 id="login1">Login </h2>    
            <h2 class="source">Create a FREE account using any of your social profiles or email.</h2>  
           
        <div class="col-md-4" style="margin-top: 16px; border-right: 1px solid #febe07;"> 
              <div class="modal-social-icons">
                    <a href="javascript:voide('0');" onClick="FBLogin();"><img src="<?php echo $serverpath;?>images/facebook1.png" style="padding-bottom:10px;"> </a>
                    <a target="_parent" href="<?php echo $serverpath;?>loginwithtwitter" ><img src="<?php echo $serverpath;?>images/twitter1.png" style="padding-bottom:10px;"> </a>
                    <a href='<?php echo $serverpath;?>loginwithtlinkedin'><img src="<?php echo $serverpath;?>images/link.png" style="padding-bottom:10px;"> </a>
                    <a href='#'><img src="<?php echo $serverpath;?>images/google.png" style="padding-bottom:10px;"> </a>
              </div>
        </div>
        <div class="col-md-8">
          <form class="form-horizontal hform" >
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label newlog">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control login-passinpute" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label newlog">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control login-passinpute" id="inputPassword3" placeholder="">
                </div>
              </div>    
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10 logsign">
                <button type="submit" class="btn btn-warning loginbtn-on-model">Login</button>
                <!-- <button type="submit" class="btn btn-warning loginbtn">Signup</button> -->
                <a data-toggle="modal" data-dismiss="modal" data-target="#signupmodal" class="btn btn-warning loginbtn" /> Free Signup</a>
              </div>
            </div>
        </form>
    </div>
  </div>
</div>
</div>
</div>
</div>