<header class="navbar-fixed-top bg-header">
      <div class="container" style="max-width:1200px;">
        
          
            <a href="<?php echo $serverpath;?>"><img src="<?php echo $serverpath;?>images/logo-1.png" class="logo" style="float:left;"></a>
          
         
          <nav class="navbar navbar-default hmenu" role="navigation"  style="background: transparent;border: none;box-shadow: none;">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
    		    </div>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION['uId']))
				{
					?>
                      <li><a data-toggle="modal" href="#postgigmodel" onClick="reset_post_gig()">POST GIG</a></li>
                      <?php
				}
				else
				{
					?>
                      <li><a data-toggle="modal" href="#loginmodel">POST GIG</a></li>
                      <?php
				}
					  ?>
                      <li><a href="<?php echo $serverpath;?>allgigs">BROWSE GIGS</a></li>
                <!--      <li><a href="<?php echo $serverpath;?>gigsters">GIGSTERS</a></li>-->
                   <!--  <li><a data-toggle="modal" href="#invitemodal">INVITE</a></li> -->



                      <?php if(isset($_SESSION['uId']))
					  {
						  $uInfo=get_user_Info($_SESSION['uId']);
						  $uProfilepic=$uInfo['profileimage'];
						  if(!$uProfilepic)
						  {
							  $uProfilepic=random_user_pics();
						  }
						  else{
							  $uProfilepic="uploads/profileimage/".$uProfilepic;
						  }
							$unreadbids=get_unread_bids($uInfo['userId']);
							$unreadreports=get_unread_reports($uInfo['userId']);
						  ?>                                         

						  <li><a href="<?php echo $serverpath;?>mygigs" >MY GIGS
                          <?php if($unreadbids || $unreadreports)
						  {
							  ?>
							  <i class="fa fa-circle" style="color:green;" title="New Bid / Status Report"></i>
							  <?php
						  }
						  ?></a>
                          </li> 
                          <?php
						  $unreadawards=get_unread_awards($uInfo['userId']);
						  ?>
   						  <li><a href="<?php echo $serverpath;?>assignments" >MY BIDS  <?php if($unreadawards)
						  {
							  ?>
							  <i class="fa fa-circle" style="color:green;" title="New Gig Awarded"></i>
							  <?php
						  }
						  ?></a></li>
                           
                          <?php $unread=get_user_messages($uInfo['userId']);
						  if($unread)
						  {
						  ?>
              			  <li><a  href="<?php echo $serverpath;?>inbox" >INBOX(<?php echo $unread['count'];?>)</a></li>                                          
						  <?php
						  }
						   else
						   {
							    ?>
              			  <li><a  href="<?php echo $serverpath;?>inbox" >INBOX(0)</a></li>                                          
						  <?php
						   }
						   ?>
						    <li><a href="<?php echo $serverpath;?>myaccount" style="margin-top: -4px;padding: 0px;">

                          <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $uProfilepic;?>&width=40&height=40&cropratio=1:1" style="border-radius:50px;padding: 7px;margin: 0px;" title="My Profile"/>
                          </a></li>
						   <?php
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
       
          <div class="clearfix"></div> 
       
      </div>
     
      
    </header>
    
