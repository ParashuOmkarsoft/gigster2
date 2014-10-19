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
                         <li><a href="mygigs"><h5 id="ass">My Gigs</h5>  </a></li>
                         <li><a href="assignments">My Assigments</a></li>
                       </ul>
               </section>
  <section class="container">
        <ul id="profilemenu">
          <li><a href="mygigs-inprogress"><h5 id="ass"> In progress </h5> </a></li>
          <li><a href="mygigs-bidding"> Bidding  </a></li>
          <li><a href="mygigs-completed">Completed</a></li>
        </ul> 
      </section>
      <section class="container">
      <h2 id="giglog">My Gigs</h2>

/* -- This is amol c -- */


 $uId=$_SESSION['uId'];
 $userInfo=get_user_Info($uId);

 if($userInfo)
	 {
		 $uId=$userInfo['userId'];
	 }
 $all=$_GET['all'];
 if(!$all)
	 {
		$all='0';
	 }

 echo $uId ;
 echo "<br>" ;
 echo $all ;

 echo $gigs=get_all_projects($uId,$all);







     </section>
    <?php include('footer.php'); ?>
  </body>
</html>



