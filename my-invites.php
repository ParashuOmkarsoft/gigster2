<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 

$projectId=filter_text($_GET['projectId']);
$ngigdetails=get_gig_details($projectId);
$loggedinuser=$_SESSION['uId'];
$loggedinuser=get_user_Info($loggedinuser);
$loggedinuser=$loggedinuser['userId'];

if($ngigdetails)
{
	$users=get_gigsters_on_skill($ngigdetails['keywords']);
	if($users)
	{
		$users=implode(",",$users);
		$gigstersQuery="select userId from btr_users where userId in ($users) order by joinedon DESC";
		$gigsters=@db_query($gigstersQuery);	
		$msg="Here is the list of gigsters matching your gig's skill set.";
	}
	else
	{
		$gigstersQuery="select  userId from btr_users  order by joinedon DESC";
		$gigsters=@db_query($gigstersQuery);	
		$msg="Sorry, No gigster found as per your required skillset, Here is a list of other experienced gigsters.";
		
	}
}

?>


<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="row clearfix">
			<div class="col-md-6 column">
					<div class="row clearfix">
						<div class="col-md-3 column">
							<img src="images/person1.jpg">
						</div>
						<div class="col-md-9 column">
							
								<img src="http://gigster2.fountaintechies.com/images/star_4.png">
								<img src="http://gigster2.fountaintechies.com/images/star_4.png">
								<img src="http://gigster2.fountaintechies.com/images/star_4.png">
								<img src="http://gigster2.fountaintechies.com/images/star_4.png">
								<img src="http://gigster2.fountaintechies.com/images/star_4.png">
							<h4>
								saurabh undre
							</h4>
							<h2 id="map"  style="margin: 0 auto;">
								singapore
							</h2>
							<h4>
								php,html5
							</h4>
							
							<input type="checkbox" name="invited[]" id="invited" value="1">
						</div>
					</div>
				</div>
				<div class="col-md-6 column">
					<div class="row clearfix">
						<div class="col-md-3 column">
							<img src="images/person1.jpg">
						</div>
						<div class="col-md-9 column">
							
								<img src="http://gigster2.fountaintechies.com/images/star_4.png">
								<img src="http://gigster2.fountaintechies.com/images/star_4.png">
								<img src="http://gigster2.fountaintechies.com/images/star_4.png">
								<img src="http://gigster2.fountaintechies.com/images/star_4.png">
								<img src="http://gigster2.fountaintechies.com/images/star_4.png">
							<h4>
								saurabh undre
							</h4>
							<h2 id="map"  style="margin: 0 auto;">
								singapore
							</h2>
							<h4>
								php,html5
							</h4>
							
							<input type="checkbox" name="invited[]" id="invited" value="1">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<form action="<?php echo $serverpath;?>saveinvites.php" method="post" target="targetframe" onSubmit="return validate_selected();">
<input type="hidden" name="projectId" id="projectId" value="<?php echo $projectId;?>" />
<p><?php echo $msg;?></p>
	<?php 
	if($gigsters['count']>0)
	{
		for($i=0;$i<$gigsters['count'];$i++)
		{
			$gigsterInfo=get_user_Info(encrypt_str($gigsters['rows'][$i]['userId']));
			if($gigsterInfo['userId']!=$loggedinuser)
			{
			$gigsterpic="uploads/profileimage/".$gigsterInfo['profileimage'];
			
			if(!empty($gigsterInfo['profileimage']))
			{
				$gigsterpic=$gigsterpic;
			}
			else
			{
				$gigsterpic="images/admin.png";
			}
				$gigsternametodisplay="";
			    $gigsternametodisplay=$gigsterInfo['fname'].' '.$gigsterInfo['lname'];
				$gigsternametodisplay1=str_replace(" ","",$gigsternametodisplay);
			  if(!$gigsternametodisplay1)
			  {
				  $gigsternametodisplay=$gigsterInfo['username'];
			  }
			   $gigsterrating=0;
			$gigsterrating=get_user_rating($gigsterInfo['userId']);
			?>
	
			<div class="col-sm-6">
				<div><a href="<?php echo get_profile_link($serverpath,$gigsterInfo['userId']); ?>" target="_blank"><img src="<?php echo $serverpath;?>image.php?image=/<?php echo $gigsterpic;?>&width=75&height=75&cropratio=1:1"></a>
				</div>
                <div>
                <h4><a href="<?php echo get_profile_link($serverpath,$gigsterInfo['userId']); ?>" target="_blank"><?php echo $gigsternametodisplay; ?></a></h4>
                <h4><?php echo $gigsterInfo['skills']; ?></h4>
                <h2 id="map"><?php echo $gigsterInfo['city']; ?></h2>
                </div>
                 <?php
                              
							   for($t=$gigsterrating;$t<5;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_4.png" />
        <?php
							  }
							  for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_3.png" />
        <?php
							  }
							  ?>
                               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
			<?php
		}
		}
	}
	?>
	<div><input type="checkbox" name="invited[]" id="invited" value="<?php echo $gigsterInfo['userId'];?>" /></div>
</div>
   <!--  <div class="clearfix"></div> -->
    <button type="submit" class="btn invite-btn" style="margin-top=20px";>Invite Gigsters</button>
    <button type="submit" class="btn update-btn" data-dismiss="modal" style="margin-top=20px";>Leave It</button>    
    </form>
    <div class="clearfix"></div>
