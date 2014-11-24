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
	$users=get_gigsters_on_skill($ngigdetails['keywords'],$loggedinuser);
	if($users)
	{
		$users=implode(",",$users);
		$gigstersQuery="select userId from btr_users where userId in ($users)  order by joinedon DESC";
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

<form action="<?php echo $serverpath;?>saveinvites.php" method="post"  onSubmit="return validate_selected();" target="targetframe" style="max-height: 500px;overflow: auto;">
<input type="hidden" name="projectId" id="projectId" value="<?php echo $projectId;?>" />

		<div class="col-md-12 column" style="border-bottom:2px solid #fd8900;">
        <p ><?php echo $msg;?></p></div>
        <?php
		if($gigsters['count']>0)
			{
		?>
			<Table class="table"><tr>
            <?php
			$dd=0;
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
            <td>
			<div class="col-md-6 column" style="margin-top:10px;border-bottom:1px solid #fd8900;min-height:216px;" >
			
						
							
							
							<a href="<?php echo get_profile_link($serverpath,$gigsterInfo['userId']); ?>" target="_blank"><img src="<?php echo $serverpath;?>image.php?image=/<?php echo $gigsterpic;?>&width=75&height=75&cropratio=1:1"></a><br>
							<input type="checkbox" name="invited[]" id="invited" value="<?php echo $gigsterInfo['userId'];?>" style="float: left;margin-top: 10px; margin-right: 5px;">
							<h4 style="word-wrap: break-word;margin-top:5px;">
								<a href="<?php echo get_profile_link($serverpath,$gigsterInfo['userId']); ?>" target="_blank"><?php echo $gigsternametodisplay; ?></a>
							</h4>
							
						
							 <?php
                               for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
								        <img src="<?php echo $serverpath;?>images/star_3.png" />
						          <?php
							  }
							   for($t=$gigsterrating;$t<5;$t++)
							  {
								  ?>
        								<img src="<?php echo $serverpath;?>images/star_4.png" />
        						  <?php
							  }
							 
							  ?>
							<h2 id="map"  style="margin: 0 auto;">
								<?php echo $gigsterInfo['city']; ?>
							</h2>
							<h4 style="word-wrap: break-word;">
								Skills :<?php echo $gigsterInfo['skills']; ?>
							</h4>
							
							
						</div>
				</td>
            <?php
			if($dd==2)
			{
				?>
				</tr>
                <tr>
				<?php
				$dd=1;
			}
			else
			{
				$dd++;
			}
				}
			}
			?>
			</Table>
			<?php
			}
			?>
		
    <div class="form-group">
    <button type="SUBMIT" class="btn invite-btn">Invite</button>
    </div>
</form>



	