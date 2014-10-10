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
    <title><?php echo $sitename;?> profile</title>
    <?php include('script-header.php'); ?>
  </head>
  <body>
        <?php include('top-menu.php'); ?>
    <div id="grad"></div>
 
     <section class="container">
      <ul id="profilemenu">
        <li><a href="#">My Profile</a></li>       
        <li><a href="#"><h5 id="pro">Settings</h5></a></li>                              
      </ul> 
    </section>
    <?php
		
	?>
    <section id="firstsection" class="container">
      <div class="row">
          <div class="col-md-6">
          <?php $nametodisplay=$uInfo['fname'].' '.$uInfo['lname'];
		  if($nametodisplay)
		  {
		  }
		  else
		  {
			  $nametodisplay=$uInfo['username'];
		  }
		  ?>
            <h3><?php echo $nametodisplay;
		
			?></h3>
            <h4><?php echo $uInfo['tagline']; ?></h4>
            <h2 id="map"><?php
			if($uInfo['city'])
			{
			 echo $uInfo['city'].",";
			}
			else
			{
				
			}
			if($uInfo['country'])
			{
			 echo get_country_name($uInfo['country']);
			}
			else
			{
				
			}
			?>
            
            </h2>
          </div>
          <div class="col-md-6">
          <?php if($uInfo['profileimage'])
		  {
			  $pfimage=$uInfo['profileimage'];
			  ?>
            <img src="<?php echo $serverpath;?>image.php?image=/uploads/profileimage/<?php echo $pfimage;?>&width=100&height=100">
            <?php
		  }
			?>
          </div>          
      </div>
         
    </section>
    <section class="container secondsection">
     <div class="row">
            <div class="col-md-6"><h5 id="title">About Us</h5></div>
            <div class="col-md-6"><img src="images/pencil.png"></div>
      </div> 
      <p><?php
	  if($uInfo['aboutus'])
	  {
	   echo stripslashes($uInfo['aboutus']); 
	   
	  }
	  else
	  {
		  echo "N/A";
	  }
	   ?></p>
       </section>
        <section class="container secondsection">
       <div class="row">
            <div class="col-md-6"><h5 id="title">Overview</h5></div>
            <div class="col-md-6"><img src="images/pencil.png"></div>
      </div> 
      <p><?php
	  if($uInfo['overview'])
	  {
	   echo stripslashes($uInfo['overview']); 
	   
	  }
	  else
	  {
		  echo "N/A";
	  }
	   ?></p>
      <div class="row">
        <div class="col-md-6"><h5 id="title">Gigs Completed</h5></div>        
      </div>  
    </section>

    <section class="container lastsection">
      <div class="row">
        <div class="col-md-6"><h4>High Length, High Quality Article</h4><span class="date">Sept 10,2013-Sept 15,2013</span>
          <h4>Feedback :</h4>
        </div>
        <div class="col-md-6"><img src="images/star.png"><h4 id="doller">&#36 420.00</h4></div>        
      </div>  
       <p id="para">A professional service, highest quality, delivered on time, exactly as specified 
        with fantastic customer service. 10/10. I would recommend this service without doubt.</p>
    </section>
    <section class="container lastsection ">
      <div class="row">
        <div class="col-md-6"><h4>High Length, High Quality Article</h4><span class="date">Sept 10,2013-Sept 15,2013</span>
          <h4>Feedback :</h4>
        </div>
        <div class="col-md-6"><img src="images/star.png"><h4 id="doller"> &#36 420.00</h4></div>        
      </div>  
       <p id="para">A professional service, highest quality, delivered on time, exactly as specified 
        with fantastic customer service. 10/10. I would recommend this service without doubt.</p>
    </section>
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
                 <div id="footerimages">
                  <img src="images/facebook.png">  <img src="images/twitter.png">
                 </div>        
              </div>          
       </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>