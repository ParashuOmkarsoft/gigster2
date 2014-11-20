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
<title><?php echo $sitename;?>- My Gigs</title>
<?php include('script-header.php'); ?>
<?php include('fb-login.php'); ?>
</head>
<body>
<?php include('top-menu.php'); ?>

<section class="container">
 <ul id="profilemenu">
    <li><a href="<?php echo $serverpath;?>inprogress"> In progress </a></li>
    <li><a href="<?php echo $serverpath;?>bidding"> Bidding  <?php if($unreadbids)
						  {
							  ?>
							  <i class="fa fa-circle" style="color:green;"></i>
							  <?php
						  }
						  ?></a></li>
    <li><a href="<?php echo $serverpath;?>completed"><strong>Completed</strong></a></li>
  </ul>
  <h2 id="logingigster1">My Gigs - Completed</h2>
  <?php
        $uId=$uInfo['userId'];
		$gigscountquery=@db_query("select * from btr_projects where userId='$uId' and status='3' order by postedon DESC");
		$total_pages=$gigscountquery['count'];
		$page = $_GET['page'];
		$adjacents = 1;
		$limit = 5;
		if($page)
		$start = ($page - 1) * $limit; 			//first item to display on this page
		else
		$start = 0;

		$gigsquery="select * from btr_projects  where userId='$uId'  and status='3'  order by postedon DESC LIMIT $start,$limit";
	    
		$opengigs=@db_query($gigsquery);
		//pr($opengigs);
	    if($opengigs['count']>0)
	    {
		   $mcount=$opengigs['count'];
		   for($i=0;$i<$mcount;$i++)
		   {
			  $opengig=$opengigs['rows'][$i];
			  $gigsterInfo="";
			  $gigsterInfo=get_user_Info(encrypt_str($opengig['userId']));
			  $nametodisplay="";
			  $nametodisplay=$gigsterInfo['fname'].' '.$gigsterInfo['lname'];
			  if(!$nametodisplay)
			  {
				  $nametodisplay=$gigsterInfo['username'];
			  }
			  
	   ?>
  <div class="row myrow"  style="border-top: none; border-bottom:none;">
  <div class="col-md-12" style="border-bottom: 3px solid #fd8900; padding-bottom: 15px;">
    <div class="col-md-8" style="padding: 0;">
      <h2 id="giglisth2"><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($opengig['prjTitle']);?>/<?php echo $opengig['prjId'];?>"><?php echo $opengig['prjTitle'];?></a></h2>
      <!-- <h2 id="map"><?php echo $gigsterInfo['city'];?></h2> -->
        <div class="col-md-8" style="padding: 0;">
        <!-- <p id="gigpara"> -->
        <h3 class="comp-h4">Feedback</h3>
         <?php 
		 $mawardedto=project_awarded_to($opengig['prjId']);
		 $userReview="";
		 $userReview=get_project_feedback_1($opengig['prjId'],$opengig['userId']);
		 if($userReview)
		 {
		 ?>
		 <h4>Gig owner</h4><div class="row">
            <?php 
						
			?>
             <div class="col-md-10">
          <div class="col-md-12" style="padding: 0px;">
		 	<?php if($userReview['feedback'])
			{
				echo $userReview['feedback'];
			}
			?>
			<Br/>
			<?php
			$prjRating=$userReview['rating'];
		    for($t=$prjRating;$t<5;$t++) 
			{
			 ?>
		        <img src="<?php echo $serverpath;?>images/star_2.png" />
		     <?php
			}
		   for($t=0;$t<$prjRating;$t++)
			{
			?>
		        <img src="<?php echo $serverpath;?>images/star_1.png" />
			<?php
			}
			?>
          </div>
          </div>
		<?php 
		 }
		  $userReview="";
		 $userReview=get_project_feedback_1($opengig['prjId'],$mawardedto['awardedto']);
		 if($userReview)
		 {
		 ?>
		 <div class="row">
            <?php 
						
			?>
          <div class="col-md-10">
          <div class="col-md-12">
          <h4>Gigster</h4>
		 	<?php if($userReview['feedback'])
			{
				echo $userReview['feedback'];
			}
			?>
			<Br/>
			<?php
			$prjRating=$userReview['rating'];
		    for($t=$prjRating;$t<5;$t++) 
			{
			 ?>
		        <img src="<?php echo $serverpath;?>images/star_2.png" />
		     <?php
			}
		   for($t=0;$t<$prjRating;$t++)
			{
			?>
		        <img src="<?php echo $serverpath;?>images/star_1.png" />
			<?php
			}
			?>
          </div>
          </div>
		<?php 
		 }
		?>
      </div>
      
      </div>
    </div>
      <div class="col-md-4"><span id="bid"></span></div>
     <!--  <div class="col-md-8"><span class="bid">Posted :<?php echo get_time($opengig['postedon']); ?></span></div> -->
    </div>
    <div class="col-md-4" style="padding: 0;"> 
		<?php $awardedarray=project_awarded_to($opengig['prjId']);
		 $awarded=$awardedarray['awardedto'];
		 $awardedInfo=get_user_Info(encrypt_str($awarded));
		$awardednametodisplay="";
			  $awardednametodisplay=$awardedInfo['fname'].' '.$awardedInfo['lname'];
			  $awardednametodisplay1=str_replace(" ","",$awardednametodisplay);
			  if(!$awardednametodisplay1)
			  {
				  $awardednametodisplay=$awardedInfo['username'];
			  }
			  $awardedprofilepic=$awardedInfo['profileimage'];
			  if(!$awardedprofilepic)
			  {
				  $awardedprofilepic="uploads/admin.png";
			  }
			  else
			  {
				  $awardedprofilepic="uploads/profileimage/".$awardedprofilepic;
			  }
			  $awardedrating=get_user_rating($awarded);
			  ?>
      	<div class="pull-right" style="padding-top: 20px;/* position: absolute; */float: right;/* margin-top: 132px; *//* padding-left: 0px; */margin-left: 0px;">
      	 <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $awardedprofilepic;?>&width=75&height=75&cropratio=1:1">
      		<h4><?php echo $awardednametodisplay; ?></h4>
      					<?php 
						 for($t=0;$t<$awardedrating;$t++)
							  {
								  ?>
								  <img src="<?php echo $serverpath;?>images/star_3.png" />
								  <?php
							  }
						 for($t=$awardedrating;$t<5;$t++)
							  {
								  ?>
								  <img src="<?php echo $serverpath;?>images/star_4.png" />
								  <?php
							  }
							  
							  ?>
     	 </div>               
 </div>
</div>
    
    
  <?php
	  }
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;
		$targetpage=$serverpath."allgigs";						//last page minus 1
		$pagination = "";
		if($lastpage > 1)
		{
		$pagination .= "<div class=\"lastpagination\"><ul class=\"pagination\">";
		//previous button
		if ($page > 1)
			$pagination.= "<li><a href=\"$targetpage/$prev\">« Previous</a></li>";
		else
			$pagination.= "<li class=\"disabled\"><a href='#'> Previous</a></li>";

		//pages
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li class=\"active\"><a href='#'>$counter</a></li>";
				else
					$pagination.= "<li><a href=\"$targetpage/$counter\">$counter</a></li>";
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href='#'>$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$targetpage/$counter\">$counter</a></li>";
				}
				$pagination.= "...";
				$pagination.= "<li><a href=\"$targetpage/$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage/$lastpage\">$lastpage</a></li>";
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"$targetpage/1\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage/2\">2</a></li>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href='#'>$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$targetpage/$counter\">$counter</a></li>";
				}
				$pagination.= "...";
				$pagination.= "<li><a href=\"$targetpage/$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage/$lastpage\">$lastpage</a></li>";
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li><a href=\"$targetpage/1\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage/2\">2</a></li>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href='#'>$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$targetpage/$counter\">$counter</a></li>";
				}
			}
		}
		//next button
		if ($page < $counter - 1)
			$pagination.= "<li><a href=\"$targetpage/$next\">Next</a></li>";
		else
			$pagination.= "<li class=\"disabled\"><a href='#'>Next</a></li>";
		$pagination.= "</ul></div>";
	}
?>
<!-- <div class="col-md-2 giginnerimg gigimg">
        <?php 
			$checkQuery="select a.* from btr_assignment as a ,btr_projects as p where p.userId='".$uId."' and a.projectId='".$opengig['prjId']."' and p.status='3' group by a.projectId";
			$checkSql=@db_query($checkQuery);
			for($ad=0;$ad<$checkSql['count'];$ad++)
			{
			$profilepicId = $checkSql['rows'][$ad]['awardedto'];
		    $gigsterInfo=get_user_Info(encrypt_str($profilepicId));
			
			$profilepic="uploads/profileimage/".$gigsterInfo['profileimage'];
			if(file_exists($profilepic))
			{
				$profilepic=$profilepic;
			}
			else
			{
				$profilepic="images/admin.png";
			}
			  ?>
        <div class="col-md-12"> <a href="<?php echo $serverpath;?>gigsterInfo/<?php echo mera_url_noslash($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=45&height=45&cropratio=1:1"></a>
          <div class="tyco">
            <h4><a <?php /*?>href="<?php echo $serverpath;?>gigsterInfo/<?php echo mera_url_noslash($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"<?php */?>>
              <?php //echo strip_string($nametodisplay,6);?>
              </a></h4>
             
		
          </div>
          
          <h4>&nbsp;</h4>
        </div>
        <div class="col-md-12">
              <?Php   
			  				$gigsterrating=0;
							$gigsterrating=get_user_rating($profilepicId); 
                             
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
                   
             </div>
        <?php } ?>
  </div> -->
 </div><!-- end of col-12 --> 
<div class="lastpagination">
    <ul class="pagination">
      <?php echo $pagination;?>
    </ul>
  </div>
  <?php } else  {   ?>
  <div class="row ">
    <div class="col-md-8">
      <p>Sorry , No Gigs are completed right now.</p>
    </div>
  </div>
  <?php  } ?>
</section>
<?php include('footer.php'); ?>
</body>
</html>