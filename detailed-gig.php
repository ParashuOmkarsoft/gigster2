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
<title><?php echo $sitename;?>-<?php echo $gigdetails['prjTitle'];?></title>
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
      <h2 id="giglisth2"><?php echo $gigdetails['proposedbudget']; ?>&nbsp;<?php echo $currency; ?></h2>
      <h2 id="map"><?php echo $gigsterInfo['city'];?></h2>
    </div>
    <div id="front" class="col-md-4 giginnerimg">
      <h2 class="mikename"><?php echo $nametodisplay;?></h2>
      <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=80&height=80&cropratio=1:1">
    
     <!--  <div class="col-md-6" style="width: 276px;"> -->
        <div class="col-md-6" style="width: 273px; margin-top: 10px;"> 
        <?php
		
                             for($t=$gigsterrating;$t<5;$t++) 
							  {
								  
								  ?>
        <img src="<?php echo $serverpath;?>images/star_2.png" />
        <?php
							  }
							   for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_1.png" />
        
<?php
							  }

			if($_SESSION['uId'] != encrypt_str($gigdetails['userId']))
			{
				if(!is_project_awarded($gigdetails['prjId']))
				{
					if(!is_project_bided_by_user($gigdetails['prjId'],$uInfo['userId']))
					{
						if(!is_project_awarded_to_user($gigdetails['prjId'],$uInfo['userId']))
						{
?>
             
                <div class="col-md-6" style="width: 276px;">
                       <?php if(isset($_SESSION['uId']))
					   {
						   ?>
                        <a  data-toggle="modal" href="#bidmodal" onClick="bid_modal('<?php echo $serverpath;?>','<?php echo $gigdetails['prjId'];?>','<?php echo $uInfo['userId'];?>')" >
                        <button type="button" class="btn btn-newbid pull-right">Bid</button>
                        </a>
                        <?php
					   }
					   else
					   {
						   ?>
						    <a  <a data-toggle="modal" href="#loginmodel" >
                        		<button type="button" class="btn btn-newbid pull-right">Bid</button>
                        	</a>
						   <?php
					   }
						?>
                        <div id="bidmodel<?php echo $opengig['prjId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content cform">
                              <div class="container">
                                <div class="col-md-12">
                                  <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>submitproposal" role="form" method="post" >
                                    <input type="hidden" id="projectId" name="projectId" value="<?php echo $gigdetails['prjId'];?>" />
                                    <h2 id="login1">Bid On Gig </h2>
                                    <h2 class="source"><?php echo $gigdetails['prjTitle'];?></h2>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="inputText" class="col-sm-4 control-label newlog">Bid Details</label>
                                        <br/>
                                        <br/>
                                        <div class="col-sm-12">
                                          <textarea class="form-control tinpute mtextarea" placeholder="Bid Details" row="10" column="10" required name="proposal" id="proposal"></textarea>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-4 control-label tfont">Price</label>
                                        <Br/>
                                        <br/>
                                        <div class="col-md-8">
                                          <input type="text"  required class="form-control" id="pprice" name="pprice" onKeyDown="return only_numbers(event);" />
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-sm-12">
                                          <button type="submit" class="btn btn-warning">Bid Now</button>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
<?php
						}
					}
				}
			}
?>
      </div>
     
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12" style="
    padding-left: 15px;">
      <h5 id="titleoverview">Overview</h5>
    </div>
  </div>
</section>
<section class="container secondsection">
  <p><?php echo nl2br(stripslashes($gigdetails['prjdesc']));?></p>
  <div class="row">
    <div class="col-md-12">
      <h5 id="title">Bids</h5>
    </div>
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
      <div style="float:left"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $bidderpic;?>&width=80&height=80&cropratio=1:1"> </div>
      <div> <span id="bond"><?php echo $biddernametodisplay ;?></span> </div>
      <div> <span id="bond">Rating :</span>
        <?php
				 for($t=0;$t<$biderrating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_1.png" style="margin: 0px 0px 1px 0px;"/>
        <?php
							  }
							   for($t=$biderrating;$t<5;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_2.png" style="margin: 0px 0px 1px 0px;"/>
        <?php
							  }
		?>
        
        <!--<img style="margin: 0px 0px 5px 10px;" src="images/star.png"><span id="bond">Earnings :    &#36; 2000.00</span>--> 
      </div>
      <div> <span id="alldate"><?php echo get_time($projectbids['rows'][$i]['bidon']); ?></span> </div>
    </div>
    <div class="col-md-2 mailsymbol">
 <?php 
	$uInfo=get_user_Info($_SESSION['uId']);

	
	if($uInfo['userId']==$projectbids['rows'][$i]['bidfrom']) { 
	if($gigdetails['jobtype']=="h"){
	?>
    <h4 id="assigndoller"><?php echo $projectbids['rows'][$i]['bidprice']." ".$currency;?> / hr</h4>
    <?php }
	else {
		?>
    <h4 id="assigndoller"><?php echo $projectbids['rows'][$i]['bidprice']." ".$currency;?></h4>
    <?php }
	}
	
	
			 else if($_SESSION['uId'] == encrypt_str($gigdetails['userId']))
		  { 
		  if($gigdetails['jobtype']=="h"){
	?>
    <h4 id="assigndoller"><?php echo $projectbids['rows'][$i]['bidprice']." ".$currency;?> / hr</h4>
    <?php } 
	else{
		?>
    <h4 id="assigndoller"><?php echo $projectbids['rows'][$i]['bidprice']." ".$currency;?></h4>
    <?php }
	} 
   ?>

      <div>
        <?php if((encrypt_str($gigdetails['userId'])==$_SESSION['uId']) )
				 {
			?>
     <div class="col-md-6" style="width: 140px;
margin-top: 20px;">
			<?php if(is_user_admin($gigdetails['prjId'],$_SESSION['uId']))
			{
				?>
        <a href="#messagemodal" data-toggle="modal" onClick="view_message_modal_inner('<?php echo $serverpath;?>','<?php echo $gigdetails['userId'];?>','<?php echo $bidderInfo['userId'];?> ','<?php echo $gigdetails['prjId'];?>');"><img src="<?=$serverpath;?>images/mail.jpg"></a>
        
        
        <?php
			}
		?>
         </div>
        <?php
		}
		else
		{
			$m=message_thread_started($gigdetails['prjId'],encrypt_str($bidderInfo['userId']));
			if($m==$uInfo['userId'])
			{
		 	?>
        <a href="#messagemodal" data-toggle="modal" onClick="view_message_modal_inner('<?php echo $serverpath;?>','<?php echo $gigdetails['userId'];?>','<?php echo $bidderInfo['userId'];?> ','<?php echo $gigdetails['prjId'];?>');"><img src="<?=$serverpath;?>images/mail.jpg"></a>
        	<?php
			}
		 
		}
	   if(encrypt_str($gigdetails['userId'])==$_SESSION['uId'])
				 {
					if(is_project_awarded($gigdetails['prjId']))
{
	if(is_project_awarded_to_user($gigdetails['prjId'],$projectbids['rows'][$i]['bidfrom']))
	{
	?>
      <img src="<?php echo $serverpath;?>images/symbol.png" />
      <?php
	}
}
else{?>
      <div> <a data-toggle="modal" href="#awardmodal<?php echo $projectbids['rows'][$i]['bidId'];?>" >
        <button type="button" class="btn btn-warning">Award</button>
        </a> </div>
      <?php }
				 }
				 ?>
    </div>
    </div>
    
     <div class="row">
      <div class="col-md-10">
        <p class="service"> <?php echo strip_string(nl2br(stripslashes($bidderInfo['overview'])),300);?> </p>
      </div>
      <div class="col-md-02"></div>
    </div>
    <div class="clearsecond"></div>
   
  
</section>
<?php if(is_project_awarded($gigdetails['prjId']))
{
	
}
else
{
	
	?>
<div id="awardmodal<?php echo $projectbids['rows'][$i]['bidId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content cform">
      <div class="container">
        <div class="col-md-12">
          <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>sendterms" role="form" method="post" >
            <input type="hidden" id="projectId" name="projectId" value="<?php echo $gigdetails['prjId'];?>" />
            <input type="hidden" id="awardedto" name="awardedto" value="<?php echo $projectbids['rows'][$i]['bidfrom'];?>" />
            <h2 id="login1">Award Gig</h2>
            <h2 class="source"><?php echo $opengig['prjTitle'];?></h2>
            <div class="col-md-12">
              <div class="form-group">
                <label for="inputText" class="col-sm-4 control-label newlog">Award To</label>
                <br/>
                <br/>
                <div class="col-sm-12"> <?php echo $biddernametodisplay ;?> </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label tfont">Terms (If Any)</label>
                <Br/>
                <br/>
                <div class="col-md-12">
                  <textarea name="terms" id="terms" class="form-control mtextarea" ></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label tfont">Start Date</label>
                <Br/>
                <br/>
                <div class="col-md-8">
                  <?php  echo(strftime("%B %d %Y ",mktime(0,0,0,date('m'),date('d'),date('Y')))."<br>");?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label tfont">End Date</label>
                <Br/>
                <br/>
                <div class="col-md-8">
                  <input type="text" name="enddate" id="enddate" class="form-control mdate"  required="required" value="<?=date('y-m-d');?>"   />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-8 control-label tfont">Final Amount (<?php echo $currency ; ?>)</label>
                <Br/>
                <br/>
                <div class="col-md-8">
                  <input type="text" name="amount" id="amount" class="form-control small"  style="width:300px;"required="required" value="<?=$projectbids['rows'][$i]['bidprice'];?>" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10 logsign">
                  <button type="submit" class="btn btn-warning loginbtn">Award</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}
}
}
else
{

			?>
<section>
  <div class="row firstdinner container">
    <div class="col-md-10 mandatory"> Sorry no bids submited yet.
      </p>
    </div>
    <div class="col-md-02"></div>
  </div>
  <div class="clearsecond"></div>
</section>
<?php
		}
   include('footer.php'); ?>
</body>
</html>
