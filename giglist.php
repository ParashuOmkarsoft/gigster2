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
     <title><?php echo $sitename;?> - Gigs</title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
   <?php include('top-menu.php'); ?>
        <div id="grad"></div>
     

    </section>

<section class="container">
      <h2 id="logingigster1">Open Gigs</h2>
      <?php  $opengigs=get_all_projects($uId,'1');
	  
	  if($opengigs['count']>0)
	  {
		  if($opengigs['count']>10)
		  {
			  $mcount=10;
		  }
		  else
		  {
			  $mcount=$opengigs['count'];
		  }
		  print_r($opengigs);
		  for($i=0;$i<$mcount;$i++)
		  {
			  $opengig=$opengigs['rows'][$i];
			  $gigsterInfo="";
			  $gigsterInfo=get_user_Info(encrypt_str($opengig['userId']));
			  $nametodisplay="";
			  $nametodisplay=$gigsterInfo['fname'].' '.$gigsterInfo['lname'];
			  if(!$nametodisplay)
			  {
				  $nametodisplay=$gigsterInfo['username'];
			  }
			  $gigsterrating=0;
			$gigsterrating=get_user_rating($gigsterInfo['userId']);
	   ?>
      <div class="row ">
         <div class="col-md-8">
            <h2 id="giglisth2"><?php echo $opengig['prjTitle'];?></h2>
            <h2 id="map"><?php echo $gigsterInfo['city'];?></h2>
              <div class="col-md-4"><span id="bid">&nbsp;</span></div>
              <div class="col-md-8"><span class="bid">Posted :<?php echo get_time($opengig['postedon']); ?></span></div>
              <p id="gigpara"><?php echo $opengig['prjdesc'];?></p>
          </div>
         <div class="col-md-4 giginnerimg gigimg">
              <div class="col-md-6">
                   <?php
                              for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
								  <img src="<?php echo $serverpath;?>images/star_3.png" />
								  <?php
							  }
							   for($t=$gigsterrating;$t<5;$t++)
							  {
								  ?>
								  <img src="<?php echo $serverpath;?>images/star_4.png" />
								  <?php
							  }
							  ?>
                   <h4><?php echo strip_string($nametodisplay,6);?></h4>
                   <h4>&nbsp;</h4>
              </div>
              <div class="col-md-6">
                   <img src="images/person1.jpg">
              </div>
            <a data-toggle="modal" href="#" ><button type="button" class="btn btn-warning">Bid</button></a>  
<!-- start bid model -->
              <div id="bidmodel" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">          
    <div class="container modelb">
      <div class="row loginxyz">
          
            

          <div class="col-md-12">
           <div id="logjpg"><img src="images/bidongig.png"></div>
          </div>
          </div> 
  </div>
</div>
</div>
</div>
<!-- end bid model -->
          </div>
	 </div> 
     <?php
		  }
	  }
	 ?>
          
        

     
    </section>
    <!--<section class="container giglast">
      <h2 id="login">Our Gigsters</h2>
      <div class="row">
         <div class="col-md-4">   
           <img src="images/person1.jpg">
           <div>
              <span>Mike Fisher</span>
              <span id="map">Yishun, Singapore</span>
              <span id="artist">ux, photographer, design artist</span>
           </div>           
         </div>
         <div class="col-md-4"> 
          <img src="images/person1.jpg">
           <div>
              <span>Mike Fisher</span>
              <span id="map">Yishun, Singapore</span>
              <span id="artist">ux, photographer, design artist</span>
           </div> 
         </div>
         <div class="col-md-4">
            <img src="images/person1.jpg">
           <div>
              <span>Mike Fisher</span>
              <span id="map">Yishun, Singapore</span>
              <span id="artist">ux, photographer, design artist</span>
           </div> 
         </div>
      </div>

    </section>-->

<?php include('footer.php'); ?>
  </body>
</html>