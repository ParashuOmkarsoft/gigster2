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
       
      
    </section>
<?php 
	   $assignedgigs=get_user_assigned_projects($uInfo['userId']);

	   ?>
    <section class="container lastsection">
      <div class="row">
        <div class="col-md-6"><h5 id="title">Gigs</h5></div>        
      </div>
       </section>
      <?php if($assignedgigs)
	  {
		for($i=0;$i<$assignedgigs['count'];$i++)
		{
			$assignedgig=$assignedgigs['rows'][$i];
			$assignedgigdetails=get_gig_details($assignedgig['projectId']);
		  ?>
      
    <section class="container lastsection ">
      <div class="row">
        <div class="col-md-6"><h4><?php echo $assignedgigdetails['prjTitle'];?></h4><span class="date"><?php echo convert_time($assignedgig['assignedon']); ?></span>
          <h4>Description :</h4>
        </div>
       <!-- <div class="col-md-6"><img src="images/star.png"><h4 id="doller"> &#36 420.00</h4></div>-->        
      </div>  
       <p id="para"><?php echo stripslashes($assignedgigdetails['prjdesc']); ?></p>
        </section>
        <?php
		}
	  }
	  else
	  {
		 ?>
          <section class="container lastsection ">
		  <p id="para">Sorry, No Gigs assigned to you.</p>
          </section>	
		 <?php 
	  }
		?>
    
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