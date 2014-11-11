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
        <div id="grad"></div>
    <div id="imgback">
      <img src="<?php echo $serverpath;?>images/grooming.png">
    </div>

<div class="container box-container">
 	<?php $homelatest = latest_gigs();
	if(!empty($homelatest)){
	//pr($homelatest);


foreach($homelatest['rows'] as $hmltst3 )
{
$string = $hmltst3['prjdesc'];
//pr($string);
if (strlen($string) > 140) {
    // truncate string
    $stringCut = substr($string, 0, 140);
    }else{ $stringCut = $string;}
	?>
  <div class="box1">
         <div class="box-1">
          <span class=""><img src="images/person1.jpg" alt=""  style="padding: 20px;float: left;" class="img-circle"></span>
          <h2 class="fname"><?php echo $hmltst3['prjTitle']; ?></h2>
          <p><?php echo $stringCut; ?></p>
         </div>   
  </div>
  
  <?php }} ?>
</div>
  <div style="text-align: center; margin-top: 50px;"><button class="btn more-btn" type="submit">MORE GIGS</button><hr class="hr"></div>




<div class="container box-container" style="max-width: 1225px;">
  <div class="step-box">
         <div class="box-1">
          <span class=""><img src="images/step3.png" alt=""  style="padding: 20px;float: left;padding-top: 0px;"></span>
          <h2 class="fname2">3. All done!</h2>
          <p>Tell us what you need help 
with and post a Gig.
</p>
         </div>   
  </div>

  <div class="step-box">
         <div class="box-1">
          <span class=""><img src="images/step2.png" alt=""  style="padding: 20px;float: left;padding-top: 0px;"></span>
          <h2 class="fname2">2. Choose the Gigster </h2>
          <p>We'll find the right local 
Gigsters and you just select 
one.</p>
         </div>   
  </div>

  <div class="step-box">
         <div class="box-1">
          <span class=""><img src="images/step1.png" alt=""  style="padding: 20px;float: left;padding-top: 0px;"></span>
          <h2 class="fname2">1. Get Anything Done </h2>
          <p>Tell us what you need help 
with and post a Gig.
</p>
         </div>   
  </div>
</div>

<div class="container box-container" style="
    background: #fab518;
margin: 0 auto;
max-width: 1349px;
padding-bottom: 70px;">
<div style="text-align: center; margin-top: 50px;background: #fab518;
margin: 0 auto;
max-width: 1349px;
"><h2 class="fname3">Why Use Gigster</h2></div>

  <div class="box3">
         <div class="box-1">
          
          <h2 class="fname4">3. Available online and on 
mobile, making it easy to 
choose and communicate 
with your Gigster </h2>
          
         </div>   
  </div>

  <div class="box3">
         <div class="box-1">
          
          <h2 class="fname4">2. No need to spend hours on
searching, We will find the right
Gigster for you.</h2>
         
         </div>   
  </div>



  <div class="box3">
         <div class="box-1">
          
          <h2 class="fname4">1. Get help for anything. 
Done by your local Gigsters.  </h2>
          
         </div>   
  </div>

  <div class="box3">
         <div class="box-1">
          
          <h2 class="fname4">
5. You decide how much you
 want to pay.</h2>
         
         </div>   
  </div>

  <div class="box3">
         <div class="box-1">
          
          <h2 class="fname4">
4. There are no service fees! 
Pay directly to the Gigster.</h2>
         
         </div>   
  </div>


<?php
include('footer.php'); 
?>
  </body>
</html>
