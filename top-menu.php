<header>      
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <a href="<?php echo $serverpath;?>"><img src="<?php echo $serverpath;?>images/logo.png"></a>
          </div>
          <div class="col-md-8">
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                      <li><a data-toggle="modal" href="#postgigmodel">POST GIG</a></li>
                      <li><a href="<?php echo $serverpath;?>allgigs">LIST GIGS</a></li>
                      <li><a href="<?php echo $serverpath;?>gigsters">GIGSTERS</a></li>
                      <?php if(isset($_SESSION['uId']))
					  {
						  ?>
						  <li><a href="<?php echo $serverpath;?>myaccount" >My Account</a></li>                                          
   						  <li><a  href="<?php echo $serverpath;?>checkout" target="targetframe" >Logout</a></li>                                          
						  <?php
						   $uInfo=get_user_Info($_SESSION['uId']);
					  }
					  else
					  {
						  ?>
                      <li><a data-toggle="modal" href="#loginmodel" >LOGIN</a></li>                                            
                      <?php
					 
					  }
					  ?>
                 </ul>
              </div>
          </div>
          <div class="clearfix"></div> 
        </div>
      </div>
    </header>
