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
        <?php include('img-img-top-menu.php'); ?>
    
 
     
    <?php
	if(isset($_GET['pId']))
	{
		$uInfo=get_user_Info(encrypt_str($_GET['pId']));
	}
	else
	{
		die();
	}
	?>
    <section class="container secondsection">
      <div class="row" style="
    padding-bottom: 15px;">
      <div id="paraprofile">
          <div class="col-md-6">
          <?php $nametodisplay=$uInfo['fname']." ".$uInfo['lname'];
		  $nametodisplay1=str_replace(" ","",$nametodisplay);
		  if($nametodisplay1)
		  {
		  }
		  else
		  {
			  $nametodisplay=$uInfo['username'];
		  }
		  ?>
            <h3 id="headername"><?php echo $nametodisplay;
		
			?></h3>
            <h4 id="headertitle"><?php echo $uInfo['tagline']; ?></h4>
               <h4 id="headertitle"><?php echo $uInfo['skills']; ?></h4>
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
			
			if(!empty($uInfo['profileimage']))
			{
				$pfimage=$pfimage;
			}
			else
			{
				$pfimage="images/admin.png";
			}
			
			  ?>
            <img src="<?php echo $serverpath;?>image.php?image=/uploads/profileimage/<?php echo $pfimage;?>&width=113&height=113&cropratio=1:1" id="imguser" class="img-circle">
            <?php
		  }
		   else
			  {
				  ?>
				  <img src="<?php echo $serverpath;?>image.php?image=/images/admin.png&width=150&height=150&cropratio=1:1"  id="imguser">
				  <?php
			  }
			?>
			    </div>
			    <div style="margin-right:9px;"> 
			               <?php
			$gigsterrating=0;
			$gigsterrating=get_user_rating($uInfo['userId']);
			 for($t=$gigsterrating;$t<5;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_2.png" style="margin-top: 0;" />
        <?php
							  }
							  for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_1.png" style="margin-top: 0;"/>
        <?php
							  }
							  ?>
            </div>


          </div> 
            
          </div>  
        
      </div>
         
    </section>
    <section class="container secondsection">
     <div class="row">
            <div class="col-md-6"><h5 id="title">About</h5></div>
            <div class="col-md-6"></div>
      </div> 
      <p id="aboutuspara"><?php
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
            <div class="col-md-6"></div>
      </div> 
      <p id="overviewpara"><?php
	  if($uInfo['overview'])
	  {
	   echo stripslashes(nl2br($uInfo['overview'])) ; 
	   
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
        <div class="col-md-6">
        <h4><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_encode($assignedgigdetails['prjTitle']);?>/<?php echo $assignedgigdetails['prjId'];?>"><?php echo $assignedgigdetails['prjTitle'];?></a></h4>
        <p id="para"> SGD <?php echo get_final_price($assignedgigdetails['prjId'],$uInfo['userId']); ?></p>
        </div>
      </div>  
			<?php if(get_project_feedback_1($assignedgigdetails['prjId'],$uInfo['userId']))
			{
				$m_feedback="";
				$m_feedback=get_project_feedback_1($assignedgigdetails['prjId'],$uInfo['userId']);
				$m_rating=0;
				$m_rating=$m_feedback['rating'];
				 ?>
        
        
     
       <p id="para">

	   <?php
	    echo stripslashes($m_feedback['feedback']); ?>
       </p>
       <span style="float:left;">
       <?php
	     for($t=$m_rating;$t<5;$t++) 
							  {
								  
								  ?>
        <img src="<?php echo $serverpath;?>images/star_2.png" />
        <?php
							  }
							   for($t=0;$t<$m_rating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_1.png" />
        
<?php
							  }
?>
</span>
<?php				  
			}
			else
			{
				/*?>
				
				  <h4>Testimonial :</h4>
      
       <p id="para">
	   N/A
	   <?php
	   
	    //echo stripslashes($assignedgigdetails['prjdesc']); ?>
       
       </p>
       <?php*/
			}
	   ?>
       </section>
        <?php
		}
	  }
	  else
	  {
		 ?>
          <section class="container lastsection ">
		  <p id="para">Sorry, No Gigs assigned to <?php echo $nametodisplay;?>.</p>
          </section>	
		 <?php 
	  }
		?>
    
    
<?php include('footer.php'); ?>
  </body>
</html>