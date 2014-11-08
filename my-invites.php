<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 
$projectId=filter_text($_GET['projectId']);
$ngigdetails=get_gig_details($projectId);
if($ngigdetails)
{
	$users=get_gigsters_on_skill($ngigdetails['keywords']);
	if(sizeof($users)>0)
	{
		$users=implode(",",$users);
		$gigstersQuery="select userId from btr_users where userId in ($users) order by joinedon DESC";
		$gigsters=@db_query($gigstersQuery);	
		$msg="";
	}
	else
	{
		$gigstersQuery="select  userId from btr_users where order by joinedon DESC";
		$gigsters=@db_query($gigstersQuery);	
		$msg="Sorry, No gigster found as per your required skillset, Here is a list of other experienced gigsters.";
		
	}
	
}
?>
<div class="col-sm-10" style="height:400px;overflow:auto;">
	<?php 
	if($gigsters['count']>0)
	{
		for($i=0;$i<$gigsters['count'];$i++)
		{
			$gigsterInfo=get_user_Info(encrypt_str($gigsters['rows'][$i]['userId']));
			
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
	?>
</div>