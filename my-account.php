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
    
 
     <section class="container">
      <ul id="profilemenu">
		<li><h5 id="pro" style="border-left:none;"> <a href="<?php echo $serverpath;?>myaccount"><strong>My Profile</strong></a></h5></li>
        <li><h5 id="pro"> <a href="javascript:void(0);">Change Password</a></h5></li>
        <li><h5 id="pro"><a href="<?php echo $serverpath;?>checkout" target="targetframe" >Logout</a></h5></li>                            
      </ul> 
    </section>
    <?php
		
	?>
    <section class="container secondsection">
      <div class="row" style="max-width: 1007px;padding-bottom: 15px;">
      <div id="paraprofile">
          <div class="col-md-6">
          <?php $nametodisplay=$uInfo['fname'].' '.$uInfo['lname'];
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
			<h4 id="headerskills"><?php echo $uInfo['skills']; ?></h4>            
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
          <div class="col-md-6" style="margin-top: 6px;" id="myprofileimage"> 
          <?php if($uInfo['profileimage'])
		  {
			  $pfimage=$uInfo['profileimage'];
			  ?>
            <img src="<?php echo $serverpath;?>image.php?image=/uploads/profileimage/<?php echo $pfimage;?>&width=150&cropratio=1:1" id="imguser" style="
    margin-right: -14px;" class="img-circle">
            <?php
		  }
		  $userRating=get_user_rating($uInfo['userId']);
			?>

      <div class="col-md-12" style="margin-left:-10px;">
            <?php
				   for($t=0;$t<$userRating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_1.png" />


        
<?php		  }
        for($t=$userRating;$t<5;$t++) 
							  {
								  
								  ?>
        <img src="<?php echo $serverpath;?>images/star_2.png" />
        <?php
							  }
					 ?>   
          
      </div>


          </div> 
            
          </div>  
          <Br/>
         
          <form id="frmprofile" method="post" action="<?php echo $serverpath;?>updateInfo" enctype="multipart/form-data" class="mhidden" target="targetframe" >
          <input type="hidden" name="frmaction" id="frmaction" value="updateinfo" />
           <div class="col-md-6">
          	<div class="form-group">
            	<label class="col-md-4 profile-inpute">First Name</label>
              <div class="col-sm-8" style="margin-bottom: 12px;">
                	<input type="text" name="fname" id="fname" class="form-control profile-text" value="<?php echo $uInfo['fname'];?>" />
              </div>    
            </div>
          	<div class="form-group">
            <label class="col-md-4 profile-inpute">Last Name</label>
            <div class="col-sm-8" style="margin-bottom: 12px;">
                	<input type="text" name="lname" id="lname" class="form-control profile-text" value="<?php echo $uInfo['lname'];?>" />
            </div>
            </div>
            <div class="form-group">
            <label class="col-md-4 profile-inpute">Username</label>
            <div class="col-sm-8" style="margin-bottom: 12px;">
                	<input type="text" name="username" id="username" class="form-control profile-text" value="<?php echo $uInfo['username'];?>" />
            </div>
            </div>
            <div class="form-group">
            <label class="col-md-4 profile-inpute">Email</label>
            <div class="col-sm-8" style="margin-bottom: 12px;">
                	<input type="text" name="usermail" id="usermail" class="form-control profile-text" value="<?php echo $uInfo['usermail'];?>" />
            </div>
            </div>
            
            <div class="form-group">
            <label class="col-md-4 profile-inpute">Phone</label>
            <div class="col-sm-8" style="margin-bottom: 12px;">
                	<input type="text" name="contactno" id="contactno" class="form-control profile-text" value="<?php echo $uInfo['contactno'];?>" />
            </div>
            </div>
            
            <div class="form-group">
            	   <label class="col-md-4 profile-inpute">Tagline</label>
                 <div class="col-sm-8" style="margin-bottom: 12px;">
                	<input type="text" name="tagline" id="tagline" class="form-control profile-text" value="<?php echo $uInfo['tagline'];?>" />
                  </div>
            </div>
             <div class="form-group">
            	   <label class="col-md-4 profile-inpute">Skills</label>
                 <div class="col-sm-8" style="margin-bottom: 12px;">
                	<input type="hidden" name="skills" id="skills" class="form-control profile-text" value="<?php echo $uInfo['skills'];?>" />
                  </div>
                     <?php $tags=get_tags();
						$tags=implode(",",$tags);
						?>
          <script type="text/javascript">$("#skills").select2({tags:[<?php echo strtolower($tags);?>]});</script>
            </div>
			<div class="form-group">
            <label class="col-md-4 profile-inpute">City</label>
            <div class="col-sm-8" style="margin-bottom: 12px;">
                	<input type="text" name="city" id="city" class="form-control profile-text" value="<?php echo $uInfo['city'];?>" />
            </div>
            </div>
            <div class="form-group">
            	   <label class="col-md-4 profile-inpute">Country</label>
                <?php 
				$country=get_countries();
			
				if($country['count']>0)
				{
				?>        
        <div class="col-md-8">
                	<select name="country" id="country" class="form-control profile-text">
                 		<?php
						for($i=0;$i<$country['count'];$i++)
						{
							?>
							<option value="<?php echo $country['rows'][$i]['id'];?>" <?php if($country['rows'][$i]['id']==$uInfo['country']){ ?> selected<?php }else{ if($country['rows'][$i]['id']==186){ ?> selected<?php }}?>><?php echo $country['rows'][$i]['countryname'];?></option>
							<?php
						}
						?>   	
                    </select>
              </div>      
                    <?php
				}
					?>
            </div>
            
            <div class="form-group">
				
            <div class="col-sm-12" style="margin-bottom: 12px; margin-top: 15px;padding-left: 9px;">
           
				    <label class="profile-inpute" style="margin-right:44px;padding:0px;margin-top: 11px;">Notifications</label>
             <input type="checkbox" class="my-checkbox"  name="notify" id="notify" value="1" <?php if($uInfo['notify']=="1"){?> checked="checked" <?php }else{ ?>checked="false"<?php  } ?>> 
                  <div class="btn-group btn-toggle" style="margin-left: 33px;"> 
                  
                  </div>
            </div>
			
            </div>
            <div class="form-group">
				
            <div class="col-sm-12" style="margin-bottom: 12px; margin-top: 15px;padding-left: 9px;">
           
				    <label class="profile-inpute" style="margin-right:57px;padding:0px;margin-top: 11px;">Sync Image</label>
                    
             <input type="checkbox" class="my-checkbox"  name="syncimage" id="syncimage" value="1" <?php if($uInfo['syncimage']=="1"){?> checked="checked" <?php }else{ ?>checked="false"<?php  }?> data-switch-state="false"> 
             	
                  <div class="btn-group btn-toggle" style="margin-left: 33px;padding-bottom: 0px;"> 
                  
                  </div>
            </div>
            
            </div>
            <script type="text/javascript">
		      
       $("[name='notify']").bootstrapSwitch('state',false,false);
	   $("[name='syncimage']").bootstrapSwitch('state',false,false);
    	
                             
			</script>
            </div>
            <div class="col-md-6" align="right" style="padding-right:0px;">
            <div class="fileinput fileinput-new" data-provides="fileinput">
  <div class="fileinput-new">
  <?php if(!$pfimage)
  {
	  ?>
    <div class="img-circle"><img data-src="holder.js/100x100%" alt="..."></div>
    <?php
  }
  else
  {
	  ?>
	     <img src="<?php echo $serverpath;?>image.php?image=/uploads/profileimage/<?php echo $pfimage;?>&width=200&height=150&cropratio=1:1" id="imguser" class="img-circle">
         <?php
  }
	?>
  </div>
  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px; border-radius:50%;"></div>
  <div>
    <span class="btn btn-default btn-file" style="background: none;box-shadow: none;border: none; padding-right:0px;"><span class="fileinput-new"></span><img src="images/pencil.png"><input type="file" name="profileimage" id="profileimage" /></span>
  
    <a href="#" class="btn btn-default fileinput-exists delete" data-dismiss="fileinput"><img src="images/delete.png"></a>
  </div>
  
  
  
</div>


            </div>
            <div class="col-md-12">
            <div class="form-group"  style="padding-left: 171px;">
  	<button class="btn update-btn" type="submit">Update</button>
    <button class="btn update-btn" type="button" onClick="visible_invisible('paraprofile','frmprofile');">Cancel</button>
  </div>
            </div>
          </form>  
          
          <a href='javascript:void(0);' onClick="visible_invisible('frmprofile','paraprofile');" ><img src="<?php echo $serverpath;?>images/pencil.png"></a>     
      </div>
         
    </section>
    <section class="container secondsection">
     <div class="row">
            <div class="col-md-6"><h5 id="title">Tagline</h5></div>
            <div class="col-md-6"><a href='javascript:void(0);' onClick="visible_invisible('frmaboutus','aboutuspara');" ><img src="<?php echo $serverpath;?>images/pencil.png"></a></div>
      </div> 
      <p id="aboutuspara"><?php
	  if($uInfo['aboutus'])
	  {
	   echo nl2br(stripslashes($uInfo['aboutus'])); 
	   
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
       <button type="submit" class="btn update-btn">Update</button>
       </div>
       </form>
       </section>
        <section class="container secondsection">
       <div class="row">
            <div class="col-md-6"><h5 id="title">About</h5></div>
            <div class="col-md-6"><a href="javascript:void(0);" onClick="visible_invisible('frmoverview','overviewpara');"><img src="images/pencil.png"></a></div>
      </div> 
      <p id="overviewpara"><?php
	  if($uInfo['overview'])
	  {
	   echo nl2br(stripslashes($uInfo['overview'])); 
	   
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
       <button type="submit" class="btn update-btn">Update</button>
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
		  if($assignedgigs['count']<=4)
		  {
			  $cnt=$assignedgigs['count'];
		  }
		  else
		  {
			  $cnt=4;
		  }
?>
    <section class="container lastsection ">
<?php
		for($i=0;$i<$cnt;$i++)
		{
			$assignedgig=$assignedgigs['rows'][$i];
			$assignedgigdetails=get_gig_details($assignedgig['projectId']);
		  ?>
      <section class="container lastsection ">

      <div class="row">
        <div class="col-md-6"><h4><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_encode($assignedgigdetails['prjTitle']);?>/<?php echo $assignedgigdetails['prjId'];?>"><?php echo $assignedgigdetails['prjTitle'];?></a></h4><span class="date"><?php echo convert_time($assignedgig['assignedon']); ?></span>
          <h4>Description :</h4>
        </div>
      </div>  
       <p id="para">
	   
	   <?php echo stripslashes($assignedgigdetails['prjdesc']); ?>
       
       </p>
 </section>
        <?php
		}
		?>
		       
		<?php
		if($assignedgigs['count']>4)
		{
		?>
        <div class="clearfix"></div>
		<span style="float:right;">
        <a href="<?=$serverpath;?>assignments" style="font-size:16px;font-weight:bold;">View All</a>
        </span>
        <div class="clearfix"></div>
		<?php			
		}
		?>
		</section>
		<?php

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
    
   

  </body>
<?php include('footer.php'); ?>


</html>