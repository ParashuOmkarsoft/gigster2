<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php');

$msgId=filter_text($_GET['msgId']);
$msgdetails=get_message_details($msgId);
$project=$msgdetails['projectId'];
$from=$msgdetails['msgfrom'];
$to=$msgdetails['msgto'];

$projectDetails=get_gig_details($project);
$messagethread="select * from btr_messages where projectId=$project and ((msgfrom=$from and msgto=$to) or (msgfrom=$to and msgto=$from)) order by msgId DESC";
$messagethread=@db_query($messagethread);
$uInfo=get_user_Info($_SESSION['uId']);
if($uInfo['userId']==$from)
{
	$msgfrom=$uInfo['userId'];
	$msgto=$to;
}
else
{
	$msgfrom=$to;
	$msgto=$from;
}
?>
<section class="postgigform " id="inviteform">                       
<h2 id="login1"><?php echo $projectDetails['prjTitle'];?></h2>    
<div class="col-sm-12" style="border:solid 1px red;">
	<form  action="<?php echo $serverpath;?>sendmessage" target="targetframe" role="form" method="post" >
  					 <input type="hidden" id="fromId" name="fromId" value="<?php echo $msgfrom;?>" />
                     <input type="hidden" id="toId" name="toId" value="<?php echo $msgto;?>" />
                     <input type="hidden" id="projectId" name="projectId" value="<?php echo $project;?>" />
    	<div class="form-group">
        	<label>Message</label>
            <textarea name="message" id="message" class="form-control"></textarea>
        </div>
    </form>

    <?php if($messagethread['count']>0)
	{
		?>
		<div class="col-sm-12" style="height: 400px;overflow: auto;background: #fff;padding-top: 15px;border-radius: 8px;">
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
			if($i%2==0)
			{
				$cl="style='text-align:right;background-color:#FC6;margin-top:10px;vertical-align:top;'";
			}
			else
			{
				$cl="style='background-color:#ebebeb;margin-top:10px;vertical-align:top;'";
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
	?>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</section>