<?php 
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 

$gigId=$_GET['gigId'];

$gigdetails=get_gig_details($gigId);

if($gigdetails)
{
	$gigsterInfo=get_user_Info(encrypt_str($gigdetails['userId']));
	
}
else
{
	die('Oops Something went wrong');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $sitename;?> - <?php echo $gigdetails['prjTitle'];?></title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
      <?php include('top-menu.php'); ?>
    <div id="grad"></div>
	<?php 
	$nametodisplay=$gigsterInfo['fname']." ".$gigsterInfo['lname'];
	$nametodisplay1=str_replace(" ","",$nametodisplay);
	if(!$nametodisplay1)
	{
		$nametodisplay=$gigsterInfo['username'];
	}
	$profilepic="uploads/profileimage/".$gigsterInfo['profileimage'];
			
			if(file_exists($profilepic))
			{
				$profilepic=$profilepic;
			}
			else
			{
				$profilepic="images/admin.png";
			}
			$gigsterrating=0;
			$gigsterrating=get_user_rating($gigsterInfo['userId']);
	?>
    <section id="gigdetail" class="container">
      <h2 id="gigger">Gig Details</h2>
      <div class="row giginner">
         <div class="col-md-8">
            <h2 id="giglisth2"><?php echo $gigdetails['prjTitle']; ?></h2>
            <h2 id="map"><?php echo $gigsterInfo['city'];?></h2>                
          </div>
         <div id="front" class="col-md-4 giginnerimg">
                 <h2 class="mikename"><?php echo $nametodisplay;?></h2>

              <div class="col-md-6 start">
                  <?php
                              for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
								  <img src="<?php echo $serverpath;?>images/star_1.png" />
								  <?php
							  }
							   for($t=$gigsterrating;$t<5;$t++)
							  {
								  ?>
								  <img src="<?php echo $serverpath;?>images/star_2.png" />
								  <?php
							  }
							  ?>
                   <!--<h4>6 Reviews</h4>
                   <h4>10 Jobs</h4>-->
              </div>
              <div class="col-md-6">                 
                   <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=80&height=80&cropratio=1:1">                   
              </div>

            <!-- <button type="button" class="btn btn-warning">Bid</button>     -->       
         </div>
        
      </div>  

      <!-- <div class="row ">
         <div class="col-md-8">
            <h2 id="giglisth2">Lady Fashion Model Shoot</h2>
            <h2 id="map">Yishun, Singapore</h2>         
            </div>
         <div class="col-md-4 giginnerimg">
              <div class="col-md-6">
                   <img src="images/star.png">
                   <h4>6 Reviews</h4>
                   <h4>10 Jobs</h4>
              </div>
              <div class="col-md-6">
                   <img src="images/person1.jpg">
              </div>                     
         </div>
      </div> -->
          <div class="row">
                <div class="col-md-12"><h5 id="title">Overview</h5></div>
        </div> 
    </section>

        <section class="container secondsection">
          <p><?php echo nl2br(stripslashes($gigdetails['prjdesc']));?></p>

          <div class="row">
            <div class="col-md-12"><h5 id="title">Bids</h5></div>            
          </div>
        </section>
        <?php
		$projectbids=get_project_bids($gigId);
		if($projectbids['count']>0)
		{
			for($i=0;$i<$projectbids['count'];$i++)
			{
				$bidderInfo=get_user_Info(encrypt_str($projectbids['rows'][$i]['bidfrom']));
				$bidderpic="uploads/profileimage/".$bidderInfo['profileimage'];
			
			if(file_exists($bidderpic))
			{
				$bidderpic=$bidderpic;
			}
			else
			{
				$bidderpic="images/admin.png";
			}
			$biddernametodisplay=$bidderInfo['fname'].' '.$bidderInfo['lname'];
			$biddernametodisplay1=str_replace(' ','',$biddernametodisplay);
			if(!$biddernametodisplay1)
			{
				$biddernametodisplay=$bidderInfo['username'];
			}
				$biderrating=get_user_rating($bidderInfo['userId']);
		?>
        <section >
            <div class="row firstdinner container">
              <div class="col-md-10 person1">
                <div style="float:left">
                  <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $bidderpic;?>&width=80&height=80&cropratio=1:1">
                </div>
                <div>  
                <span id="bond"><?php echo $biddernametodisplay ;?></span>
                 </div>
                 <div>
                <span id="bond">Rating :</span>
                <?php
				 for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
								  <img src="<?php echo $serverpath;?>images/star_1.png" style="margin: 0px 0px 1px 0px;"/>
								  <?php
							  }
							   for($t=$gigsterrating;$t<5;$t++)
							  {
								  ?>
								  <img src="<?php echo $serverpath;?>images/star_2.png" style="margin: 0px 0px 1px 0px;"/>
								  <?php
							  }
				?>
                
                <!--<img style="margin: 0px 0px 5px 10px;" src="images/star.png"><span id="bond">Earnings :    &#36; 2000.00</span>-->
              </div>
              <div>
                <span id="alldate"><?php echo get_time($projectbids['rows'][$i]['bidon']); ?></span> 
              </div>
              </div>
              <div class="col-md-2 mailsymbol">        
               <h4 id="assigndoller"><?php echo $projectbids['rows'][$i]['bidprice']." ".$currency;?></h4>
                 <!--<div>
                   <img src="<?=$serverpath;?>images/mail.jpg">
                 </div>
                 <div>
                   <img src="<?=$serverpath;?>images/symbol.png">
                 </div>--> 
              </div>

              <div class="row">
                <div class="col-md-10"><p class="service">
                   <?php echo strip_string(nl2br(stripslashes($bidderInfo['overview'])),300);?></p>
                </div>
                <div class="col-md-02"></div>
              </div>
               <div class="clearsecond"></div>
            </div>  
        </section>        
          

  <?php
			}
		}
   include('footer.php'); ?>
  </body>
</html>
