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


<section class="container mclass">
  <ul id="profilemenu">
    <li><a href="<?php echo $serverpath;?>assignments"> In progress <?php if($unreadawards)
						  {
							  ?>
							  <i class="fa fa-circle" style="color:green;"></i>
							  <?php
						  }
						  ?></a></li>
    <li><a href="<?php echo $serverpath;?>bided"> <strong>My Bids</strong> </a></li>
    <li><a href="<?php echo $serverpath;?>tocompleted">My Completed</a></li>
  </ul>
  <h2 id="logingigster1">My Bids</h2>
  <?php


$mUid=$_SESSION['uId'];
$muInfo=get_user_Info($mUid);
$mUid=filter_text($muInfo['userId']);
$checkQuery="select b.* from btr_bids as b,btr_projects as p where  b.bidfrom=".$uInfo['userId']." and b.projectId=p.prjId  order by b.bidon DESC ";
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
<?php //print_r($prjDetails); 
if(!is_project_awarded_to_user($prjDetails['prjId'],$uInfo['userId']))
{
?>
  <section class="firstsection" class="container">
    <div class="row">
      <div class="col-md-12">
        <h3><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($prjDetails['prjTitle']);?>/<?php echo $prjDetails['prjId'];?>"><?php echo $prjDetails['prjTitle'];?></a></h3>
      </div>
      <div class="col-md-12" style="padding:0px;"> 
      <div class="col-md-8"> 
       <span class="budget" style="padding-top: 20px;"><?php if($prjDetails['proposedbudget']>0){ echo ($prjDetails['proposedbudget']);?> <?php echo $currency; if($prjDetails['jobtype']=="h") { ?>&nbsp;per hour<?php }} else{ echo "Gigster's price";} ?></span>
       <div><p><?php echo $prjDetails['prjdesc']; ?></p></div> 
       <div id="msgmodal<?php echo $prjDetails['userId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content cform">
              <div class="container">
                <div class="col-md-12">
                  <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>sendmessage" target="targetframe" role="form" method="post" >
                    <input type="hidden" id="fromId" name="fromId" value="<?php echo $uInfo['userId'];?>" />
                    <input type="hidden" id="toId" name="toId" value="<?php echo $prjDetails['userId'];?>" />
                    <input type="hidden" id="projectId" name="projectId" value="<?php echo $prjDetails['prjId'];?>" />
                    <h2 id="login1">Messages</h2>
                    <h2 class="source"><?php echo $prjDetails['prjTitle'];?></h2>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="col-md-4 control-label tfont">Message</label>
                        <Br/>
                        <br/>
                        <div class="col-md-12">
                          <textarea name="message" id="message" class="form-control mtextarea" ></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10 logsign">
                          <button type="submit" class="btn btn-warning loginbtn">Send Message</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-12" style="height:250px; overflow:scroll; ">
                  <?php
			$muInfo=get_user_Info($_SESSION['uId']);
			$muId=$muInfo['userId'];
			$other=get_oponent($pId,$muId);
		 	$projectMessages="select * from btr_messages where projectId=".$prjDetails['prjId']." and (msgfrom=$muId or msgto=$muId) order by msgId DESC";
			$projectMessages=@db_query($projectMessages);
			$messages=$projectMessages;
			for($t=0;$t<$messages['count'];$t++)
			{
			$msgfrom=$messages['rows'][$t]['msgfrom'];
			$fromInfo=get_user_Info(filter_text(encrypt_str($msgfrom)));
			$fromuserimg=$fromInfo['profileimage'];
			$buserimage="";
			if(!$fromuserimg)
			{
				$buserimage=filter_text('img/avatar5.png');
			}
			else
			{
				$buserimage="uploads/profileimage/".$fromuserimg;
			}
			if($t%2==0)
			{
				$cl="style='background-color:#f8f8f8; margin-top: 3px;padding:5px;border-radius:10px;-moz-box-shadow: 0px 0px 2px #000000;
-webkit-box-shadow: 0px 0px 2px #000000;
box-shadow: 0px 0px 2px #000000;'";
			}
			else
			{
				$cl="style='background-color:white;padding:5px;border-radius:10px;-moz-box-shadow: 0px 0px 2px #000000;
-webkit-box-shadow: 0px 0px 2px #000000;
box-shadow: 0px 0px 2px #000000;'";
			}
			//$updatemessage=@db_query("update btr_messages set isread='1' where msgId=".$messages['rows'][$t]['msgId']);	
			?>
                  <div class="item" <?php echo $cl;?>> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $buserimage;?>&width=50&height=50&cropratio=1:1" alt="<?php echo get_user_name($msgfrom);?>" class="online"/> <br/>
                    <p class="message"> <a href="#" class="name"><small class="text-muted pull-right"><i class="fa fa-clock-o"></i>&nbsp; <?php echo gmstrftime("%B %d %Y, %X %p",$messages['rows'][$t]['msgon']);?></small><br/>
                      <?php echo get_user_name($msgfrom);?> </a><br/>
                      <?php echo stripslashes(stripslashes(html_entity_decode($messages['rows'][$t]['msgcontent'])));
					  ?><br/>
                    </p>
                  </div>
                  <br/>
                  <?php
		}
		  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="col-md-4"style="margin-top: -30px;">
        <div class="mike"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1" class="img-circle"></div>
        <div style="clear:both"></div>
        <div class="tyco pull-right";>
          <h4 style="float: right;"><?php echo $nametodisplay; ?></h4><br>
         <?php $ownerrating=get_user_rating($prjDetails['userId']); 
	 ?>
      <div style="float: right;">
         <?php
				
							   for($t=$ownerrating;$t<5;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_2.png" style="margin: 0px 0px 1px 0px;"/>
        <?php
							  }
							   for($t=0;$t<$ownerrating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_1.png" style="margin: 0px 0px 1px 0px;"/>
        <?php
							  }
		?>
        </div>
        </div>
         
      </div>
      <div style="float: right;padding-right:10px;" >
        <a href="#msgmodal<?php echo $prjDetails['userId'];?>" data-toggle="modal"><img src="<?php echo $serverpath;?>images/mail.jpg"></a>
        </div>
      <?php
	  $tt=project_awarded_to($prjDetails['prjId']);
	  if( ($tt) && ($tt != $uInfo['userId']))
	  {
	  ?>
      <div style="float: right;">
        <img src="<?php echo $serverpath;?>images/sad.png" width="32" height="32" title="Awarded to some on else" style="cursor:pointer;margin-top: 0;"/>
       
       </div>
       <?php
	  }
	   ?>
    </div>
    </div>   
    <div class="row">
      <div class="col-md-10" style="margin-bottom: 15px;"> 
      
    

        <?php
		if(is_project_awarded($prjDetails['prjId']))
		{
			?>
                    <br/>
                    <div class="clearfix"></div>
          
			
       
            </span>
			<?php
		}
		?>
        
        </div>
     
    </div>
  </section>
  <?php	
}
	   }
}else
	{
		?>
  <div class="clearfix"></div>
  <br/>
  <p class="mandatory">Sorry, No Bids submited by you yet.</p>
  <br/>
  <div class="clearfix"></div>
  <?php
	}
?>
</section>
<?php include('footer.php'); ?>
</body>
</html>