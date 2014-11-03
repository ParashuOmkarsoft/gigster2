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
<title><?php echo $sitename;?>- My Bids</title>
<?php include('script-header.php'); ?>
<?php include('fb-login.php'); ?>
</head>
<body>
<?php include('top-menu.php'); ?>
<div id="grad"></div>
<section class="container">
  <ul id="profilemenu">
    <li><a href="<?php echo $serverpath;?>mygigs">My Gigs</a></li>
    <li><a href="<?php echo $serverpath;?>assignments">
      <h5 id="ass">My Assigments</h5>
      </a></li>
  </ul>
</section>
<section class="container">
  <ul id="profilemenu">
    <li><a href="<?php echo $serverpath;?>assignments"> In progress </a></li>
    <li><a href="<?php echo $serverpath;?>bided"> <strong>My Bids</strong> </a></li>
    <li><a href="<?php echo $serverpath;?>tocompleted">My Completed</a></li>
  </ul>
  <h2 id="logingigster1">My Bids</h2>
  <?php


$mUid=$_SESSION['uId'];
$muInfo=get_user_Info($mUid);
$mUid=filter_text($muInfo['userId']);
 $checkQuery="select * from btr_bids where  bidfrom=".$uInfo['userId']." order by bidon DESC ";
$checkSql=@db_query($checkQuery);
if($checkSql['count']>0)
{
	 $sno=1;
     for($i=0;$i<$checkSql['count'];$i++)
       {

		  $prjDetails=get_gig_details($checkSql['rows'][$i]['projectId']);
		  $muInfo=get_user_Info(encrypt_str($prjDetails['userId']));
		 // pr($prjDetails);
		  $mId=encrypt_str($checkSql['rows']['0']['id']);
		  $awardedto=$checkSql['rows']['0']['awardedto'];
		  $nametodisplay="";
		  $nametodisplay=$muInfo['fname'].' '.$muInfo['lname'];
		  $nametodisplay1=str_replace(" ","",$nametodisplay);
		  if(!$nametodisplay1)
			  {
				  $nametodisplay=$muInfo['username'];
			  }
		  $gigsterrating=0;
		
		  $profilepic="uploads/profileimage/".$muInfo['profileimage'];
		  if(file_exists($profilepic))
			{
				$profilepic=$profilepic;
			}
		  else
			{
				$profilepic="images/admin.png";
			}
?>
  <section id="firstsection" class="container">
    <div class="row">
      <div class="col-md-8">
        <h3><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($prjDetails['prjTitle']);?>/<?php echo $prjDetails['prjId'];?>"><?php echo $prjDetails['prjTitle'];?></a></h3>
      </div>
      <div class="col-md-4"> 
        <!-- <img src="images/mail.jpg">--> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-10"> 
        <!--<h4>Completion Status</h4>
            <div class="row">
              <div class="col-md-12">
                <h4>sept 10,2014 <span class="c">sept 15,2014</span></h4>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"> <span class="sr-only">0% Complete</span> </div>
                </div>
              </div>
            </div>--> 
        <?php echo $prjDetails['prjdesc']; ?> </div>
      <div class="col-md-2">
        <div class="mike"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1"></div>
        <div class="tyco">
          <h4><?php echo $nametodisplay; ?></h4>
        </div>
      </div>
    </div>
  </section>
  <?php	
	   }
}else
	{
		?>
  <div class="clearfix"></div>
  <br/>
  <p class="mandatory">Sorry, No Gigs assigned to you yet.</p>
  <br/>
  <div class="clearfix"></div>
  <?php
	}
?>
</section>
<?php include('footer.php'); ?>
</body>
</html>