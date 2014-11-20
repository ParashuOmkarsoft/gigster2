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
    <title><?php echo $sitename;?></title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
    <?php include('top-menu.php'); ?>
        
    <?php 	$term = $_REQUEST['gigstername']; ?>

 <div class="container searchbox">
        <form class="navbar-form navbar-right" role="search" action="<?php echo $serverpath;?>search.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" name="gigstername" value="<?php echo $term; ?>">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>

    <div id="our">Our Gigster</div>
    <?php

	  $sqlq = "SELECT btr_users.userId as btuserID,btr_users.usermail,btr_users.username,btr_users.profileimage,btr_userprofile.* FROM btr_users, btr_userprofile WHERE 
	btr_users.userId = 	btr_userprofile.userId and (((btr_users.username LIKE '%$term%' or btr_users.usermail LIKE '%$term%') or (btr_userprofile.fname LIKE '%$term%' or btr_userprofile.lname LIKE '%$term%')) or btr_userprofile.skills LIKE '%$term%')";
	 $gigsters = @db_query($sqlq);
	
	
	

	if($gigsters['count'] > 0)
	{
		?>
		<table class="table table-striped table-bordered "  id="gigstertable" width="100%" cellpadding="2" cellspacing="2">
        <tr>
		<?php
		$cnt=1;
		for($i=0;$i<$gigsters['count'];$i++)
		{
			$gigster=$gigsters['rows'][$i];
			$profilepic="";
			$gigsterInfo=get_user_Info(encrypt_str($gigster['userId']));
			$profilepic="uploads/profileimage/".$gigsterInfo['profileimage'];
			
			if(!empty($gigsterInfo['profileimage']))
			{
				$profilepic=$profilepic;
			}
			else
			{
				$profilepic="images/admin.png";
			}
			$nametodisplay="";
			$nametodisplay=$gigsterInfo['fname'].' '.$gigsterInfo['lname'];
			$nametodisplay1=str_replace(" ","",$nametodisplay);
			if(!$nametodisplay1)
			{
				$nametodisplay=$gigsterInfo['username'];
			}
			if(!$nametodisplay)
			{
				$nametodisplay="N/A";
			}
			$gigsterrating=0;
			$gigsterrating=get_user_rating($gigsterInfo['userId']);
			
			$mloc="";
			if($gigsterInfo['city'])
			{
			 $mloc=$gigsterInfo['city'].",";
			}
			else
			{
			}
			if($gigsterInfo['country'])
			{
			 $mloc.=get_country_name($gigsterInfo['country']);
			}	
			
			?>
				
                <td>
                   <a href="<?php echo $serverpath;?>gigsterInfo/<?php echo mera_url_noslash($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>">
                   <div class="artst-pic pull-left">
					
					   <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1">
                   </div>
                   <div class="artst-prfle pull-right">
                          <div class="art-title">
                              <?php 
							  echo strip_string($nametodisplay,13);
							  ?>
                              <span class="star">
                              <?php
                              for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
								  <img src="<?php echo $serverpath;?>images/star_1.png" />
								  <?php
							  }
							   for($t=$gigsterrating;$t<5;$t++)
							  {
								  ?>
								  <img src="<?php echo $serverpath;?>images/star_2.png" />
								  <?php
							  }
							  ?>
                                                          
                             </span>
                             <?php if($gigsterInfo['city'])
							 {
								 ?>
                                <span class="artst-sub"><img src="images/map.png">  <?php echo $gigsterInfo['city'];?></span>
							<?php
							 }
							?>
                            <?php if($gigsterInfo['tagline'])
							{
								?>
                                <span class="artst-ux"><?php echo strip_string($gigsterInfo['tagline'],50);?></span> 
							<?php
							}
							else
							{
								?>
								<span class="artst-ux">N/A</span> 
                                <?php
							}
							?>

                               
                            </div>
                           
                        </div>
                        </a>
                    </td>
                    <?php if($cnt>=2)
					{
						?>

                        </tr>
                        <tr>
						<?php
						$cnt=1;
					}
					else
					{
						$cnt++;
					}
		}
		?>
		</table>
		<?php
	}
	else
	{
		?>
		  <p class="mandatory">Sorry, No Gigsters regsitered yet.</p>
		<?php
	}
	?>
                
<script type="text/javascript">
$('#gigstertable').dataTable();
</script>
<?php
include('footer.php'); 
?>
  </body>
</html>