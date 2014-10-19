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
          <li><a href="mygigs-inprogress">In progress  </a></li>
          <li><a href="mygigs-bidding"><h5 id="ass">  Bidding  </h5></a></li>
          <li><a href="mygigs-completed">Completed</a></li>
        </ul> 
      </section>
      <section class="container">
      <h2 id="giglog">My Gigs</h2>
       <h2 id="giglog">TEST</h2>
      <?php $mygigs=get_user_gigs($uInfo['userId']);
	if($mygigs['count']>0)
	{
		for($i=0;$i<$mygigs['count'];$i++)
		{
			$mygig=$mygigs['rows'][$i];
			$projectbids=get_project_bids($mygig['prjId']);
			$bidcount=$projectbids['count'];
			if(!$bidcount)
			{
				$bidcount="0";
			}
			
	  ?>
        <div class="row mygig">
           <div class="col-md-10">
             <h2>
             <a href="<?php echo $serverpath;?>gigDetails/<?php echo urlencode($mygig['prjTitle']);?>/<?php echo $mygig['prjId'];?>"><?php echo $mygig['prjTitle'];?></a></h2>
             <h3 class="selectbid">Select Bidder</h3>
             <?php 
				if($projectbids['count']>0)
				{
					for($h=0;$h<$projectbids['count'];$h++)
					{
						$biduser=get_user_Info(encrypt_str($projectbids['rows'][$h]['bidfrom']));
						
						$biduserprofilepic="uploads/profileimage/".$biduser['profileimage'];
							if(file_exists($biduserprofilepic))
							{
								$biduserprofilepic=$biduserprofilepic;
							}
							else
							{
								$biduserprofilepic="images/admin.png";
							}
							 $biddernametodisplay="";
							 $biddernametodisplay=$biduser['fname'].' '.$biduser['lname'];
							 $biddernametodisplay1=str_replace(" ","",$biddernametodisplay);
							  if(!$biddernametodisplay1)
							  {
								  $biddernametodisplay=$biduser['username'];
							  }
							?>
							 <a href="<?php echo $serverpath;?>gigsterInfo/<?php echo urlencode($biddernametodisplay);?>/<?php echo $biduser['userId'];?>" title="<?php echo $biddernametodisplay;?>"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $biduserprofilepic;?>&width=80&height=80&cropratio=1:1"></a>
							<?php
					}
				}
				else
				{
					?>
					<p class="mandatory">Sorry, No Bids Submited yet.</p>
					<?php
				}
			 ?>
           </div>
           <div class="col-md-2 rightsidegig" align="right">
            <h4 class="firstbid"><?php echo $bidcount;?> Bids</h4>
            <h5>S &#36; <?php echo $mygig['proposedbudget'];?></h5>
           </div>
           <div class="clearline"></div>
        </div>
     <?php
		}
	}
	else{
		?>
		<div class="row mygig">
           <div class="col-md-10">
             <h2 class="mandatory">Sorry, No Gigs posted by you yet.</h2>
           </div>
           
           <div class="clearline"></div>
        </div>
		<?php
	}
	 ?>   
     </section>
    <?php include('footer.php'); ?>
  </body>
</html>



