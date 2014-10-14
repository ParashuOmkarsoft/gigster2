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
      <div id="paraprofile">
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
            <h3 id="headername"><?php echo $nametodisplay;
		
			?></h3>
            <h4 id="headertitle"><?php echo $uInfo['tagline']; ?></h4>
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
            <img src="<?php echo $serverpath;?>image.php?image=/uploads/profileimage/<?php echo $pfimage;?>&width=150&height=113&cropratio=4:3" id="imguser">
            <?php
		  }
			?>


          </div> 
            
          </div>  
          <Br/>
         
          <form id="frmprofile" method="post" action="<?php echo $serverpath;?>updateInfo" target="targetframe"  enctype="multipart/form-data" class="mhidden">
          <input type="hidden" name="frmaction" id="frmaction" value="updateinfo" />
           <div class="col-md-6">
          	<div class="form-group">
            	<label>First Name</label>
                	<input type="text" name="fname" id="fname" class="form-control" value="<?php echo $uInfo['fname'];?>" />
            </div>
          	<div class="form-group">
            	<label>Last Name</label>
                	<input type="text" name="lname" id="lname" class="form-control" value="<?php echo $uInfo['lname'];?>" />
            </div>
            <div class="form-group">
            	<label>Tagline</label>
                	<input type="text" name="tagline" id="tagline" class="form-control" value="<?php echo $uInfo['tagline'];?>" />
            </div>
			<div class="form-group">
            	<label>City</label>
                	<input type="text" name="city" id="city" class="form-control" value="<?php echo $uInfo['city'];?>" />
            </div>
            <div class="form-group">
            	<label>Country</label>
                <?php 
				$country=get_countries();
			
				if($country['count']>0)
				{
				?>
                	<select name="country" id="country" class="form-control" style="width:250px;">
                 		<?php
						for($i=0;$i<$country['count'];$i++)
						{
							?>
							<option value="<?php echo $country['rows'][$i]['id'];?>" <?php if($country['rows'][$i]['id']==$uInfo['country']){ ?> selected<?php }?>><?php echo $country['rows'][$i]['countryname'];?></option>
							<?php
						}
						?>   	
                    </select>
                    <?php
				}
					?>
            </div>
            </div>
            <div class="col-md-6" align="right">
            <div class="fileinput fileinput-new" data-provides="fileinput">
  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
  <?php if(!$pfimage)
  {
	  ?>
    <img data-src="holder.js/100%x100%" alt="...">
    <?php
  }
  else
  {
	  ?>
	     <img src="<?php echo $serverpath;?>image.php?image=/uploads/profileimage/<?php echo $pfimage;?>&width=200&height=150&cropratio=4:3" id="imguser">
         <?php
  }
	?>
  </div>
  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
  <div>
    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="profileimage" id="profileimage" /></span>
    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
  </div>
  
  
  
</div>


            </div>
            <div class="col-md-12">
            <div class="form-group">
  	<button class="btn btn-primary" type="submit">Update</button>
    <button class="btn btn-primary" type="button" onClick="visible_invisible('paraprofile','frmprofile');">Cancel</button>
  </div>
            </div>
          </form>  
          
          <a href='#' onClick="visible_invisible('frmprofile','paraprofile');" ><img src="<?php echo $serverpath;?>images/pencil.png"></a>     
      </div>
         
    </section>
    <section class="container secondsection">
     <div class="row">
            <div class="col-md-6"><h5 id="title">About Us</h5></div>
            <div class="col-md-6"><a href='#' onClick="visible_invisible('frmaboutus','aboutuspara');" ><img src="<?php echo $serverpath;?>images/pencil.png"></a></div>
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
       <form action="<?php echo $serverpath;?>updateInfo" method="post" id="frmaboutus" class="mhidden" target="targetframe">
       <input type="hidden" id="userId" name="userId" value="<?php echo $uInfo['userId'];?>" />
       <div class="form-group">
       <textarea name="aboutus" id="aboutus" class="form-control mtextarea" style="height:300px;font-size:17px;font-weight:normal !important;"><?php echo $uInfo['aboutus'];?></textarea>
       </div>
       <div class="form-group">
       <button type="submit" class="btn btn-primary">Update</button>
       </div>
       </form>
       </section>
        <section class="container secondsection">
       <div class="row">
            <div class="col-md-6"><h5 id="title">Overview</h5></div>
            <div class="col-md-6"><a href="#" onClick="visible_invisible('frmoverview','overviewpara');"><img src="images/pencil.png"></a></div>
      </div> 
      <p id="overviewpara"><?php
	  if($uInfo['overview'])
	  {
	   echo stripslashes($uInfo['overview']); 
	   
	  }
	  else
	  {
		  echo "N/A";
	  }
	   ?></p>
       
      <form action="<?php echo $serverpath;?>updateInfo" method="post" id="frmoverview" class="mhidden" target="targetframe">
       <input type="hidden" id="userId" name="userId" value="<?php echo $uInfo['userId'];?>" />
       <div class="form-group">
       <textarea name="moverview" id="moverview" class="form-control mtextarea" style="height:300px;font-size:17px;font-weight:normal !important;"><?php echo stripslashes($uInfo['overview']);?></textarea>
       </div>
       <div class="form-group">
       <button type="submit" class="btn btn-primary">Update</button>
       </div>
       </form>
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
      </div>  
       <p id="para">
	   
	   <?php echo stripslashes($assignedgigdetails['prjdescs']); ?>
       
       </p>
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
                  <img src="<?php echo $serverpath;?>images/facebook.png">  <img src="<?php echo $serverpath;?>images/twitter.png">
                 </div>        
              </div>          
       </div>
    </footer>
<?php include('footer.php'); ?>
  </body>
</html>