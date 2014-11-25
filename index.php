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
    <title><?php echo $sitename;?></title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
    <?php include('top-menu.php'); ?>
        
    <div id="imgback">
      <img src="<?php echo $serverpath;?>images/grooming.png">
    </div>

  <div class="container" style="padding:40px;">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <h2 class="name-what-gigster text-center">
       What Is Gigster
      </h3>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-12 column">
      <h2 class="name-what-gigster1 text-center">
       It’s a service that connects the people who need help, with the people who can help.
       <br>Gigster is all about enabling you to live, work and play better. 
      </h2>
    </div>    
  </div>
  </div>

  <div class="row rowbg">
<div class="container">
  <div class="row clearfix">
    <div class="col-md-12"style="padding: 50px 0px 50px 0px;">
      <h2 class="name2 text-center">
       Why Use Gigster
      </h3>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-4">
      <h2 class="name1">
         Get help for anything. Done by your local Gigsters.
      </h2>
    </div>
    <div class="col-md-4">
      <h2 class="name1 ">
        No need to spend hours on searching, We will find the right Gigster for you.
      </h2>
    </div>
    <div class="col-md-4">
      <h2 class="name1 ">
       Available online and on mobile, making it easy to choose and communicate with your Gigster
      </h2>
    </div>
    <div class="col-md-6">
      <h2 class="name1 ">
      No need to spend hours on searching, We will find the right Gigster for you.
      </h2>
    </div>
    <div class="col-md-6">
      <h2 class="name1 ">
      Available online and on mobile, making it easy to choose and communicate with your Gigster
      </h2>
    </div>
  </div>
</div>
</div>


<div class="container" style="max-width: 1178px;margin-top: 45px;">
      <div class="col-md-12 column" style="margin-bottom: 50px;">
      <h2 class="name-what-gigster text-center">
       How It Works
      </h2>
      </div>
  
      <div class="box-1">
        <span class=""><img src="images/step1.png" alt=""  style="padding: 20px;float: left;padding-top: 0px;"></span>
        <h2 class="fname2">Get Anything Done </h2>
        <p>Tell us what you need help with and post a Gig.</h2>
      </div>
      <div class="box-1">
        <span class=""><img src="images/step2.png" alt=""  style="padding: 20px;float: left;padding-top: 0px;"></span>
        <h2 class="fname2">Choose the Gigster </h2>
        <p>We'll find the right local Gigsters and you just select one.</p>
      </div>   
      <div class="box-1">
        <span class=""><img src="images/step3.png" alt=""  style="padding: 20px;float: left;padding-top: 0px;"></span>
        <h2 class="fname2">All done!</h2>
        <p>Once the Gig is done, you pay directly to the Gigster. No additional charges!</p>
      </div>   
  <div style="text-align: center;padding: 16px;padding-top: 0px;"><a href="<?php echo $serverpath;?>allgigs"><button class="btn signup-btn" type="submit">Free Signup!</button></a></div>  

</div>



 	<?php $homelatest = latest_gigs();
	/*if(!empty($homelatest)){
	?>
  <div class="box1">
         <div class="box-1">
          <span class=""><img src="<?php echo $serverpath; ?>image.php?image=/<?php echo $gigsterimage; ?>&width=80&height=80&cropratio=1:1" alt=""  style="padding: 20px;float: left;" class="img-circle"></span>
          <h2 class="fname"><a href="<?php echo $serverpath;?>gigDetails/<?php echo urlencode($hmltst3['prjTitle']);?>/<?php echo $hmltst3['prjId'];?>"><?php echo $hmltst3['prjTitle']; ?></a></h2>
          <p><?php echo $stringCut; ?></p>
         </div>   
  </div>
  
  <?php }}*/ ?>


<div class="container" style="max-width: 1700px;background: rgb(225, 225, 225);margin: 0 auto;padding: 50px;">
  <?php
  foreach($homelatest['rows'] as $hmltst3 )
{
	
$gigstrimg = $hmltst3['userId'];
$gigsterimage = get_user_image($gigstrimg);	
if(file_exists($gigsterimage))
	  {
		  $gigsterimage=$gigsterimage;
	  }
	  else
	  {
		  $gigsterimage="images/admin.png";
	  }

$string = $hmltst3['prjdesc'];
if (strlen($string) > 140) {
    // truncate string
    $stringCut = substr($string, 0, 140);
    }else{ $stringCut = $string;}
	?>
      <div class="newbox">
        <a href="<?php echo $serverpath;?>gigDetails/<?php echo urlencode($hmltst3['prjTitle']);?>/<?php echo $hmltst3['prjId'];?>"><span class="">
        
        <img src="<?php echo $serverpath; ?>image.php?image=/<?php echo $gigsterimage; ?>&width=80&height=80&cropratio=1:1" class="imgbox img-circle" alt="" ></span>
        <h2 class="fname2"><?php echo strip_string($hmltst3['prjTitle'],15); ?> </h2></a>
        <p style="width: 383px;"><?php echo strip_string($stringCut,15); ?></h2>
      </div>
      <?php
}

	  ?>
  </div>
</div>
<div style="text-align: center;background: rgb(225, 225, 225);padding: 50px;padding-top: 0px;"><a href="<?php echo $serverpath;?>allgigs"><button class="btn more-btn" type="submit">MORE</button></a></div>


<?php
include('footer.php'); 
?>
  </body>
</html>
