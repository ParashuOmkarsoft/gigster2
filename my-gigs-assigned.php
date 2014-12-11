
<?php 
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 
if(!isset($_SESSION['uId']))
{
	?>
<script type="text/javascript">
	window.location="<?php echo $serverpath;?>";
	</script>
<?php
	die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $sitename;?>- My Bidds</title>
<?php include('script-header.php'); ?>
<?php include('fb-login.php'); ?>
</head>
<body>
<?php include('top-menu.php'); ?>
<div id="grad"></div>

<section class="container mclass">
  <ul id="profilemenu">
    <li><a href="<?php echo $serverpath;?>assignments"> <strong> Awarded</strong> <?php if($unreadawards)
						  {
							  ?>
							  <i class="fa fa-circle" style="color:green;"></i>
							  <?php
						  }
						  ?></a></li>
    <li><a href="<?php echo $serverpath;?>bided"> Bidding </a></li>
    <li><a href="<?php echo $serverpath;?>tocompleted">Completed</a></li>
  </ul>
  <h2 id="my-assignment-box">My Bids</h2>
  <?php


$mUid=$_SESSION['uId'];
$muInfo=get_user_Info($mUid);
$mUid=filter_text($muInfo['userId']);
 $checkQuery="select * from btr_assignment where awardedto=$mUid order by id DESC";

$checkSql=@db_query($checkQuery);
if($checkSql['count']>0)
{
	
	 $sno=1;
     for($i=0;$i<$checkSql['count'];$i++)
       {
		   $muInfo=get_user_Info(encrypt_str($checkSql['rows'][$i]['projectowner']));
		  $prjDetails=get_gig_details($checkSql['rows'][$i]['projectId']);
		  if($prjDetails['status']<3)
		{
		  $mId=encrypt_str($checkSql['rows'][$i]['id']);
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
  <?php  //pr($prjDetails); ?>
  <section class="firstsection" class="container">
    <div class="row">
      <div class="col-md-8">
        <h3 style="color:#753200;"><a href="<?php echo $serverpath;?>gigDetails/<?php echo urlencode($prjDetails['prjTitle']);?>/<?php echo $prjDetails['prjId'];?>" style="color:#753200;"><?php echo $prjDetails['prjTitle'];?> <?php if(get_unread_awards_project($prjDetails['prjId'])){?> <i class="fa fa-circle" style="color:green;" title="New Gig Awarded"></i><?php }?></a></h3>
        <br/>
        <?php if($prjDetails['status']!="3")
			{
				?>
        <p> 
          
         
          <?php /*?><a data-toggle="modal" href="#termsmodal<?php echo $mId;?>">
          <button type="button" class="btn terms-btn" >Terms</button>
          </a><?php */?>
              <?php $projectstatus=get_status_details($prjDetails['prjId'],$uInfo['userId']); 
				
			  if($projectstatus == '100') { 
			  if(!is_feedback_given($prjDetails['prjId'],$uInfo['userId']))
			  {
			  ?>
        
        <div id="statusmodal<?php echo $prjDetails['prjId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 500px;border-radius:30px;">
          <div class="modal-content cform">
            <div class="container">
              <div class="col-md-12" style="padding: 0px;">
                <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>finalrating" role="form" method="post">
                  <input type="hidden" id="projectId" name="projectId" value="<?php echo $prjDetails['prjId'];?>" />

                  <h2 id="login1">Rate and Comment</h2>
                  <h2 class="source" style="font-size:28px;margin-bottom:20px;"><?php echo strip_string($prjDetails['prjTitle'],29);?></h2>
                   <div class="form-group" style="margin-bottom:30px;">
                      <label class="col-md-2 control-label tfont" style="margin-top: 14px;">Rating</label>
                      
                      <div class="col-md-10" style="padding: 0px; margin-top:-7px">
                      
                        <div class="form-control form-radio" >
 <input id="input-21d" name="rating" value="<?php echo $rt;?>" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm">
            
                         <script type="text/javascript">
               $('.rating').rating({'showCaption':true, 'stars':'5', 'min':'0', 'max':'5', 'step':'1', 'size':'xs'});
             </script>                        </div>
                      </div>
                    </div>

                  <div class="col-md-12" style="padding: 0px;">
                    <div class="form-group">
                        <div class="col-sm-12">
                        <textarea class="form-control tinpute mtextarea" placeholder="Please comment here" row="10" column="10" required name="experience" id="experience"></textarea>
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <div class="col-sm-12 logsign"style="padding: 0px;">
                        <button type="submit" class="btn mark-btn">Send</button>
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
		  ?>
          
        
        <div id="msgmodal<?php echo $gigdetails['userId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
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
                   <div class="col-md-12" style="margin-left: -15px;">
                      <div class="form-group">
                        <label class="col-md-4 control-label tfont">Message</label>
                        <Br/>
                        <br/>
                        <div class="col-md-12">
                          <textarea name="message" id="message" class="form-control mtextarea" ></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-warning loginbtn">Send Message</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-12" style="height:250px; overflow:scroll;">
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
				$cl="style='background-color:#f8f8f8;padding:5px;border-radius:10px;-moz-box-shadow: 0px 0px 2px #000000;
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
        
        <div id="termsmodal<?php echo $mId;?>" class="modal fade  bs-example-modal-lg modelw " tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content cform">
<?php
	  
$gigId=$mId;
$userId=encrypt_str($checkSql['rows'][$i]['awardedto']);
$checkQuery="select * from btr_assignment where md5(md5(md5(md5(id))))='$gigId' and md5(md5(md5(md5(awardedto))))='$userId'";
$checkSql2=@db_query($checkQuery);
if($checkSql2['count']>0)
{
$_SESSION['uId']=$userId;
$puInfo1=get_user_Info($userId);
$puname1=$puInfo1['username'];
$pdetails=get_gig_details($checkSql2['rows']['0']['projectId']);
$puser=$pdetails['userId'];
$puuinfo=get_user_Info(encrypt_str($puser));
$puname=$puuinfo['username'];
?>
              <section class="container mclass">
                <h2 id="logingigster1">Accept Terms</h2>
                <div class="row">
                  <div class="col-md-12">
                    <form role="form" action="<?php echo $serverpath;?>finalterms" method="post" id="termForm" target="targetframe" >
                      <div class="form-group">
                        <label >Owner</label>
                        <BR/>
                        <i class="fa fa-user"></i>&nbsp;<?php echo $puname;?> (<?php echo $puuinfo['fname']." ".$puuinfo['lname']; ?>)
                        <input type="hidden" name="id" id="id" value="<?php echo$checkSql2['rows']['0']['id'];?>" />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Awarded To</label>
                        <br/>
                        <i class="fa fa-user"></i>&nbsp;<?php echo $puname1;?>(<?php echo $puInfo1['fname']." ".$puInfo1['lname']; ?>) </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Terms (If Any)</label>
                        <textarea name="terms" id="terms" readonly class="form-control" rows="6" ><?php echo$checkSql2['rows']['0']['terms'];?>
</textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Start & End Date</label>
                        : <?php echo $checkSql2['rows']['0']['startdate'];?> to <?php echo $checkSql2['rows']['0']['completiondate'];?> </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Final Amount (<?php echo $currency ; ?>)</label>
                        <input type="text" name="amount" id="amount" class="form-control small"  style="width:300px;"required="required" value="<?php echo $checkSql2['rows']['0']['amount'];?>" readonly />
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Accept terms</button>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#rModal">Reject</a> </div>
                    </form>
                  </div>
                </div>
              </section>
              <div class="modal fade" id="rModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Rejection Reason</h4>
                    </div>
                    <form action="<?php echo $serverpath;?>rejectterms" method="post" id="rejectForm" target="targetframe"  >
                      <div class="modal-body">
                        <div id="errormodal" class="alert alert-danger mhidden"></div>
                        <div id="successmodal" class="alert alert-success mhidden"></div>
                        <label>Description <span class="mandatory"> * </span></label>
                        <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                        <input type="hidden" name="touser" id="touser" value="<?php echo$puuinfo['userId'];?>" />
                        <input type="hidden" name="fromuser" id="fromuser" value="<?php echo$puInfo1['userId'];?>" />
                        <input type="hidden" name="projectId" id="projectId" value="<?php echo$pdetails['prjId'];?>" />
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send Back</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        
        <div id="statusmodal<?php echo $prjDetails['prjId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content cform">
              <div class="container">
                <div class="col-md-12">
                  <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>sendreport" role="form" method="post" target="targetframe" >
                    <input type="hidden" id="projectId" name="projectId" value="<?php echo $prjDetails['prjId'];?>" />
                    <input type="hidden" id="reportfrom" name="reportfrom" value="<?php echo $mUid;?>" />
                    <input type="hidden" id="reportto" name="reportto" value="<?php echo $prjDetails['userId'];?>" />
                    <h2 id="login1">Status Report </h2>
                    <h2 class="source"><?php echo $prjDetails['prjTitle'];?></h2><br/>
                    <div class="col-md-12" style="margin-left: -15px;">
                      <div class="form-group">
                        <label for="inputText" class="col-sm-4 control-label newlog">Message</label>
                        <br/>
                        <br/>
                        <div class="col-sm-12">
                          <textarea class="form-control tinpute mtextarea" placeholder="Your Message" row="10" column="10" required name="message" id="message"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label tfont">Completed (%)</label>
                        <Br/>
                        <br/>
                        <div class="col-md-8">
							<?php //$jj=00;
							$jj=get_status_details($prjDetails['prjId'],$mUid);
							if(!$jj)
							{
								$jj=0;
							}
							?>
                          <select class="form-control" id="completed" name="completed" >
                            <?php for($j=$jj;$j<101;$j=$j+10)
													{
														?>
                            <option value="<?php echo $j;?>"><?php echo $j;?></option>
                            <?php
													}
													?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <button type="submit" class="btn send-report">Send Report</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        </p>
        <?php
			}
			?>
      </div>
      <div class="col-md-4"style="margin-top:30px;">
        <div class="mike"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1" class="img-circle"></div>
        <div style="clear:both"></div>
        <div class="pull-right";>
          <h4 style="float: right;"><?php echo $nametodisplay; ?></h4><br>
          <div style="float: right;">
         <?php
         for($t=0;$t<$ownerrating;$t++)
                {
                  ?>
        <img src="<?php echo $serverpath;?>images/star_1.png" style="margin: 0px 0px 1px 0px;"/>
        <?php
                }
                 for($t=$ownerrating;$t<5;$t++)
                {
                  ?>
        <img src="<?php echo $serverpath;?>images/star_2.png" style="margin: 0px 0px 1px 0px;"/>
        <?php
                }
    ?>
        </div>
          
        </div>
       
      </div>
     <?php $ownerrating=get_user_rating($prjDetails['userId']); 
	 ?>
      
          
    </div>   
    <div style="float: right;padding-left:30px;margin-right: 15px;" >
          <a href="#msgmodal<?php echo $gigdetails['userId'];?>" data-toggle="modal"><img src="<?php echo $serverpath;?>images/mail.jpg"></a>
           </div>        
 </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <h4>Completion Status</h4>
        <div class="row">
          <div class="col-md-12">
            <?php $projectstatus=get_status_details($prjDetails['prjId'],$mUid);
		  if(!$projectstatus)
		  {
			  $projectstatus="0";
		  }
		  ?>
            <h4><?php echo convert_date($prjDetails['bidfrom']);?> <span class="c"><?php echo convert_date($prjDetails['bidto']);?></span></h4>
            <a href="#statusmodal<?php echo $prjDetails['prjId'];?>" data-toggle="modal" title="Send Status Report"> <div class="progress">
             <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $projectstatus;?>%;"> <span class="sr-only"><?php echo $projectstatus; ?>%</span></div> 
            </div></a>
          </div>
        </div>
      </div>

      <div class="col-md-4" style="margin-left:-33px;"><a href="#statusmodal<?php echo $opengig['prjId'];?>" data-toggle="modal"><img src="images/feedback.png" title="Send feedback" style="float: left;margin: 0px;padding-top: 9px;"></a></div>
      
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
  <p class="mandatory">Sorry, there are no Gigs awarded to you.</p>
  <br/>
  <div class="clearfix"></div>
  <?php
	}
	$updQuery="update btr_assignment set isread='1' where awardedto=".$uInfo['userId'];
	$updSql=@db_query($updQuery);
?>
</section>

</body>
<?php include('footer.php'); ?>
</html>