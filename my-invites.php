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
		$msg="";
	}
	else
	{
		$gigstersQuery="select  userId from btr_users  order by joinedon DESC";
		$gigsters=@db_query($gigstersQuery);	
		$msg="Sorry, No gigster found as per your required skillset, Here is a list of other experienced gigsters.";
		
	}
}
?>
<div class="col-sm-10" style="height:400px;overflow:auto;">
<form action="<?php echo $serverpath;?>saveinvites.php" method="post" target="targetframe" onSubmit=" return validate_selected();">
<input type="text" name="projectId" id="projectId" value="<?php echo $projectId;?>" />
	<?php 
	if($gigsters['count']>0)
	{
		for($i=0;$i<$gigsters['count'];$i++)
		{
			$gigsterInfo=get_user_Info(encrypt_str($gigsters['rows'][$i]['userId']));
			if($gigsterInfo['userId']==$loggedinuser[)
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
			<div class="col-sm-5">
				<img src="<?php echo $serverpath;?>image.php?image=/<?php echo $gigsterpic;?>&width=75&height=75&cropratio=1:1">
                
                <input type="checkbox" name="invited[]" id="invited" value="<?php echo $gigsterInfo['userId'];?>" />
                <h4><?php echo $gigsternametodisplay; ?></h4>
                <h4><?php echo $gigsterInfo['skills']; ?></h4>
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
    <div class="clearfix"></div>
    <button type="submit" class="btn btn-primary">Invite Gigsters</button>
    </form>
    <div class="clearfix"></div>
</div>