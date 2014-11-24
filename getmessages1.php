<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php');

$ownerId=filter_text($_GET['ownerId']);
 $biderid=filter_text($_GET['biderid']);
$projectId=filter_text($_GET['projectId']);

$projectDetails=get_gig_details($projectId);
 $messagethread="select * from btr_messages where projectId=$projectId and ((msgfrom=$ownerId and msgto=$biderid) or (msgfrom=$biderid and msgto=$ownerId)) and msgtype<>'r' order by msgId DESC";
$messagethread=@db_query($messagethread);
$uInfo=get_user_Info($_SESSION['uId']);
if($uInfo['userId']==$ownerId)
{
	$msgfrom=$uInfo['userId'];
	$msgto=$biderid;
}
else
{
	$msgfrom=$biderid;
	$msgto=$ownerId;
}
$bidQuery="select * from btr_bids where bidfrom=$biderid and projectId=$projectId";
$bidSql=@db_query($bidQuery);
?>
<section class="postgigform " id="inviteform">                       
<h2 id="login1"><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_encode($projectDetails['prjTitle']);?>/<?php echo $projectId;?>"><?php echo strip_string($projectDetails['prjTitle'],29);?></a></h2>    
<p id="gigpara" style="width:600px;"><strong>Bid Details :</strong> <?php echo nl2br($bidSql['rows']['0']['bidcontent']);?></p>
<div class="col-sm-12" >
	<form  action="<?php echo $serverpath;?>sendmessage" target="targetframe" role="form" method="post" >
  					 <input type="hidden" id="fromId" name="fromId" value="<?php echo $msgfrom;?>" />
                     <input type="hidden" id="toId" name="toId" value="<?php echo $msgto;?>" />
                     <input type="hidden" id="projectId" name="projectId" value="<?php echo $projectId;?>" />
    	<div class="form-group">
        	<label><h5>Message</h5></label>
            <textarea rows="5" name="message" id="message" class="form-control msg-textarea"></textarea>
        </div>
        <div class="form-group">
          	<button type="submit" class="btn gig-send-btn pull-right">Send Message</button>
         </div>
         <div class="clearfix"></div>
         <Br/>
    </form>

    <?php if($messagethread['count']>0)
	{
		?>
		 <div class="col-sm-12" style="height:400px;overflow: auto;background: #f3f3f3;padding-top: 15px;border-radius: 8px;">
		<?php
	for($i=0;$i<$messagethread['count'];$i++)
	{
	
		$fromInfo=get_user_Info(encrypt_str($messagethread['rows'][$i]['msgfrom']));
		$toInfo=get_user_Info(encrypt_str($messagethread['rows'][$i]['msgto']));
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
			if($_SESSION['uId']==encrypt_str($messagethread['rows'][$i]['msgto']))
			{
				$dl="style='text-align:left;background-color:#fdebbb;margin-top:10px;vertical-align:top;border-radius: 8px;width: 470px;'";
        $cl="style='text-align:left;background-color:#fdebbb;margin-top:10px;vertical-align:top;border-radius: 8px;width: 450px;'";
			}
			else
			{
				$dl="style='background-color:#ffffff;margin-top:10px;vertical-align:top;border-radius: 8px;width: 483px;;float:right;'";
        $cl="style='background-color:#ffffff;margin-top:10px;vertical-align:top;border-radius: 8px;width: 450px;float:right;'";
			}
	?>
	<div class="col-md-12" <?php echo $cl;?> >
                  <?php
			
		 	
			
			?>       <br/>
                  <div class="form-group" <?php echo $cl;?>>
                   <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $buserimage;?>&width=50&height=50&cropratio=1:1" alt="" class="online" /> <br/>
                    <p class="message"> <a href="#" class="name"><small class="text-muted "><i class="fa fa-clock-o"></i><!-- &nbsp; --> <?php echo gmstrftime("%B %d %Y, %X %p",$messagethread['rows'][$i]['msgon']);?></small><br/>
                      <p><?php echo get_user_name($messagethread['rows'][$i]['msgfrom']);?> </a><br/>
                      <?php echo stripslashes(stripslashes(html_entity_decode($messagethread['rows'][$i]['msgcontent']))); ?><br/>
                      
                    </p>
                  </div>
                  <br/>
                  <?php
		
		  ?>
                </div>
               
    <?php
	}
	}
	?>
	</div>
	<?php

	$updatethread=@db_query("update btr_messages set isread='1' where projectId=$project  and msgto=".$uInfo['userId']);

	?>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</section>