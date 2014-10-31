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
    <title><?php echo $sitename;?>- My Assignments</title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
    <?php include('top-menu.php'); ?>
    <div id="grad"></div>
          <section class="container">
                       <ul id="profilemenu">
                         <li><a href="<?php echo $serverpath;?>mygigs">My Gigs</a></li>
                         <li><a href="<?php echo $serverpath;?>assignments"><h5 id="ass">My Assigments</h5>  </a></li>
                       </ul>
               </section>
  
<section class="container">
<ul id="profilemenu">
  <li><a href="<?php echo $serverpath;?>assignments">
   <strong> In progress</strong> 
    </a></li>
  <li><a href="<?php echo $serverpath;?>bided"> My Bids </a></li>
  <li><a href="<?php echo $serverpath;?>tocompleted">My Completed</a></li>
</ul>
      <h2 id="logingigster1">My Assignments</h2>
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
<section id="firstsection" class="container">
      <div class="row">
          <div class="col-md-8">
            <h3 style="color:#753200;"><a href="<?php echo $serverpath;?>gigDetails/<?php echo urlencode($prjDetails['prjTitle']);?>/<?php echo $prjDetails['prjId'];?>" style="color:#753200;"><?php echo $prjDetails['prjTitle'];?></a></h3> 
            <br/>
            <?php if($prjDetails['status']!="3")
			{
				?>
            <p>
           <a href="#statusmodal<?php echo $prjDetails['prjId'];?>" data-toggle="modal"> <button type="button" class="btn btn-primary" >Send Status Report</button></a>
           <a href="<?php echo $serverpath;?>acceptGig/<?php echo ($mId);?>/<?php echo encrypt_str($checkSql['rows'][$i]['awardedto']);?>"><button type="button" class="btn btn-primary" >Terms</button></a>
           <a href="<?php echo $serverpath;?>markascomplete/<?php echo $prjDetails['prjId'];?>"><button type="button" class="btn btn-primary">Mark As Complete</button></a>
            <a href="#msgmodal<?php echo $gigdetails['userId'];?>" data-toggle="modal"><img src="<?=$serverpath;?>images/mail.jpg"></a>
            
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
			$updatemessage=@db_query("update btr_messages set isread='1' where msgId=".$messages['rows'][$t]['msgId']);	
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
                                            <h2 class="source"><?php echo $prjDetails['prjTitle'];?></h2>  
                                              <div class="col-md-12">
                                              <div class="form-group">
                                              <label for="inputText" class="col-sm-4 control-label newlog">Message</label>   <br/><br/> 
                                               <div class="col-sm-12">
                                                 <textarea class="form-control tinpute mtextarea" placeholder="Your Message" row="10" column="10" required name="message" id="message"></textarea>
                                               </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-md-4 control-label tfont">Completed (%)</label><Br/><br/>
                                              <div class="col-md-8">
                                                <select class="form-control" id="completed" name="completed" >
                                                	<?php for($j=00;$j<101;$j=$j+10)
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
                                              <div class="col-sm-offset-3 col-sm-10 logsign">
                                                <button type="submit" class="btn btn-warning loginbtn">Send Report</button>
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
      <div class="col-md-4">
				 <!--<img src="images/mail.jpg">-->
      </div>          
      </div>
     <div class="row">
          <div class="col-md-10">
            <h4>Completion Status</h4><div class="row">
          <div class="col-md-12">
          <?php $projectstatus=get_status_details($prjDetails['prjId'],$mUid);
		  if(!$projectstatus)
		  {
			  $projectstatus="0";
		  }
		  ?>
         <h4><?php echo convert_date($prjDetails['bidfrom']);?> <span class="c"><?php echo convert_date($prjDetails['bidto']);?></span></h4>
         <div class="progress">
             <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $projectstatus;?>%;">
               
                <span class="sr-only"></span>
         		 </div>
                 
         </div>
         
     </div>
</div>
    </div>
        <div class="col-md-2">
           <div class="mike"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1"></div><div class="tyco"><h4><?php echo $nametodisplay; ?></h4>
        </div>
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
		<p class="mandatory">Sorry, No Gigs assigned to you yet.</p>
                 <br/>
                <div class="clearfix"></div>
		<?php
	}
?>  </section>
    <?php include('footer.php'); ?>
  </body>
</html>