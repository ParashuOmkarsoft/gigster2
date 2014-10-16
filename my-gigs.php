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
    <title><?php echo $sitename;?>- My Gigs</title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
    <?php include('top-menu.php'); ?>
    <div id="grad"></div>  
       <section class="container">
        <ul id="profilemenu">
          <li><a href="mygigs-inprogress.html">In progress  </a></li>
          <li><a href="#"><h5 id="ass">  Bidding  </h5></a></li>
          <li><a href="mygigs-completed.html">Completed</a></li>                              
        </ul> 
      </section>
      <section class="container">
      <h2 id="giglog">My Gigs</h2>
        <div class="row mygig">
           <div class="col-md-10">
             <h2>Lady Fashion Model Shoot</h2>
             <h3 class="selectbid">Select Bidder</h3>
             <img src="images/mike1.jpg">
             <img src="images/mike2.jpg">
           </div>
           <div class="col-md-2 rightsidegig">
            <h4 class="firstbid">4 Bids</h4>
            <h5>S &#36; 2100.00</h5>
           </div>
           <div class="clearline"></div>
        </div>
        <div class="row mygig">
           <div class="col-md-10">
             <h2>New Desings for Home </h2>
             <h3 class="selectbid">Select Bidder</h3>
             <img src="images/mike1.jpg">
             <img src="images/mike2.jpg">
           </div>
           <div class="col-md-2 rightsidegig">
            <h4 class="firstbid">3 Bids</h4>
            <h5>S &#36; 2100.00</h5>
           </div>
           <div class="clearline"></div>
        </div>
        <div class="row mygig">
           <div class="col-md-10">
             <h2>Home Decor </h2>
             <h3 class="selectbid">Select Bidder</h3>
             <img src="images/mike1.jpg">
             <img src="images/mike2.jpg">
           </div>
           <div class="col-md-2 rightsidegig">
            <h4 class="firstbid">4 Bids</h4>
            <h5>S &#36; 2100.00</h5>
           </div>
           <div class="clearline"></div>
        </div>
        <div class="row mygig">
           <div class="col-md-10">
             <h2>Marriage Photography</h2>
             <h3 class="selectbid">Select Bidder</h3>
             <img src="images/mike1.jpg">
             <img src="images/mike2.jpg">
           </div>
           <div class="col-md-2 rightsidegig">
            <h4 class="firstbid">4 Bids</h4>
            <h5>S &#36; 2100.00</h5>
           </div>
           <div class="clearline"></div>
        </div>
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>



