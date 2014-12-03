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


<section class="container mclass">
 <ul id="profilemenu">
      <li><a href="<?php echo $serverpath;?>inprogress">  In progress<?php if($unreadreports)
						  {
							  ?>
							  <i class="fa fa-circle" style="color:green;" title="New Report Received"></i>
							  <?php
						  }
						  ?></a></li>
    <li>
      <h5 id="ass"> <a href="<?php echo $serverpath;?>bidding"> <strong>Bidding</strong>  <?php if($unreadbids)
						  {
							  ?>
							  <i class="fa fa-circle" style="color:green;"></i>
							  <?php
						  }
						  ?></a></h5>
    </li>
    <li><a href="<?php echo $serverpath;?>completed">Completed</a></li>
  </ul>
  <h2 id="logingigster1">My Gigs - Bidding</h2>
  <?php
        $uId=$uInfo['userId'];
	  	// Count Query
		$gigscountquery=@db_query("select * from btr_projects where userId=$uId and status='0' order by postedon DESC");
		$total_pages=$gigscountquery['count'];
		$page = $_GET['page'];
		$adjacents = 1;
		$limit = 5;
		if($page)
		$start = ($page - 1) * $limit; 			//first item to display on this page
		else
		$start = 0;

		$gigsquery="select * from btr_projects  where userId=$uId  and (status='0' or status='1') order by postedon DESC LIMIT $start,$limit";
	    $opengigs=@db_query($gigsquery);

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
			  $gigsterrating=0;
			  $gigsterrating=get_user_rating($gigsterInfo['userId']);
			  $profilepic="uploads/profileimage/".$gigsterInfo['profileimage'];
			 if(file_exists($profilepic))
			 {
				$profilepic=$profilepic;
			 }
			 else
			 {
				$profilepic="images/admin.png";
			 }
			 $gigId = $opengig['prjId'];
			 $projectbids=get_project_bids($gigId);
	   ?>
  <div class="row myrow-bidding">
    <div class="col-md-8" style="padding: 0px;">
      <h2 id="giglisth2"><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($opengig['prjTitle']);?>/<?php echo $opengig['prjId'];?>"><?php echo strip_string($opengig['prjTitle'],29);?>
      <?php if(get_unread_bids_project($opengig['prjId']))
	  {
		  ?>
		   <i class="fa fa-circle" style="color:green;" title="New Bid"></i>
		  <?php
	  }
	  ?>
      </a>
      
      </h2>
      <p id="gigpara"><?php echo stripslashes(strip_string($opengig['prjdesc'],325));?></p>
      <h2 id="map"><?php echo $gigsterInfo['city'];?></h2>
     
      <div class="col-md-8" style="padding: 0px;"><span class="budget">Budget : <?php echo $opengig['proposedbudget']; echo $currency; ?></span><span class="bid">Posted : <?php echo get_time($opengig['postedon']); ?></span></div>
    </div>
    
      
      <div class="col-md-4 giginnerimg gigimg" style="padding: 0px;">
        <?php /*?>   <div class="col-md-6">
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
                   
              </div><?php */ ?>
        <div class="col-md-12" style="padding: 0px;">
          <?php 
                  for($a=0;$a<$projectbids['count'];$a++)
					{
					$bidderinfo="";
					$bidderInfo=get_user_Info(encrypt_str($projectbids['rows'][$a]['bidfrom']));
					$bidderpic="uploads/profileimage/".$bidderInfo['profileimage'];
					if(file_exists($bidderpic))
					{
						$bidderpic=$bidderpic;
					}
					else
					{
						$bidderpic="images/admin.png";
					}
		?>
        <img style="margin-top: -18px;"src="<?php echo $serverpath;?>image.php?image=/<?php echo $bidderpic;?>&width=45&height=45&cropratio=1:1" class="img-circle">
        <?php } ?>
        </div>
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
		$targetpage=$serverpath."bidding";						//last page minus 1
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
  <div class="lastpagination">
    <ul class="pagination">
      <?php echo $pagination;?>
    </ul>
  </div>
  <?php  } else  {  ?>
  <div class="row ">
    <div class="col-md-8">
      <p>Sorry , No Gigs are is open for bidding right now.</p>
    </div>
  </div>
  <?php  } ?>
</section>
<?php include('footer.php'); ?>
</body>
</html>