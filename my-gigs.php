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
    <div id="grad"></div>
          <section class="container">
                       <ul id="profilemenu">
                         <li><a href="mygigs"><h5 id="ass">My Gigs</h5>  </a></li>
                         <li><a href="assignments">My Assigments</a></li>
                       </ul>
               </section>
  <section class="container">
        <ul id="profilemenu">
          <li><a href="mygigs-inprogress"><h5 id="ass"> In progress </h5> </a></li>
          <li><a href="mygigs-bidding"> Bidding  </a></li>
          <li><a href="mygigs-completed">Completed</a></li>
        </ul> 
      </section>
<section class="container">
      <h2 id="logingigster1">My Gigs</h2>



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

	 echo $gigsquery="select * from btr_projects  where userId=$uId  and status='0'  order by postedon DESC LIMIT $start,$limit";
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
	   ?>
      <div class="row ">
         <div class="col-md-8">
            <h2 id="giglisth2"><a href="<?php echo $serverpath;?>gigDetails/<?php echo urlencode($opengig['prjTitle']);?>/<?php echo $opengig['prjId'];?>"><?php echo $opengig['prjTitle'];?></a></h2>
            <h2 id="map"><?php echo $gigsterInfo['city'];?></h2>
              <div class="col-md-4"><span id="bid">&nbsp;</span></div>
              <div class="col-md-8"><span class="bid">Posted :<?php echo get_time($opengig['postedon']); ?></span></div>
              <p id="gigpara"><?php echo stripslashes(strip_string($opengig['prjdesc'],325));?></p>
          </div>
         <div class="col-md-4 giginnerimg gigimg">
              <div class="col-md-6">
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
                   <h4><a href="<?php echo $serverpath;?>gigsterInfo/<?php echo urlencode($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"><?php echo strip_string($nametodisplay,6);?></a></h4>
                   <h4>&nbsp;</h4>
              </div>
              <div class="col-md-6">
                   <a href="<?php echo $serverpath;?>gigsterInfo/<?php echo urlencode($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1"></a>
              </div>
            <a data-toggle="modal" href="#bidmodel<?php echo $opengig['prjId'];?>" ><button type="button" class="btn btn-warning">Bid</button></a>
              <div id="bidmodel<?php echo $opengig['prjId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
                            <div class="modal-content cform">
                              <div class="container">

                                  <div class="col-md-12">
                                  <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>submitproposal" role="form" method="post" target="targetframe">
                                  <input type="hidden" id="projectId" name="projectId" value="<?php echo $opengig['prjId'];?>" />
											 <h2 id="login1">Bid On Gig </h2>
                                            <h2 class="source"><?php echo $opengig['prjTitle'];?></h2>
                                              <div class="col-md-12">
                                              <div class="form-group">
                                              <label for="inputText" class="col-sm-4 control-label newlog">Bid Details</label>   <br/><br/>
                                               <div class="col-sm-12">
                                                 <textarea class="form-control tinpute mtextarea" placeholder="Bid Details" row="10" column="10" required name="proposal" id="proposal"></textarea>
                                               </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-md-4 control-label tfont">Price</label><Br/><br/>
                                              <div class="col-md-8">
                                                <input type="text"  required class="form-control" id="pprice" name="pprice" onKeyDown="return only_numbers(event);" />
                                              </div>
                                            </div>

                                            <div class="form-group">
                                              <div class="col-sm-offset-3 col-sm-10 logsign">
                                                <button type="submit" class="btn btn-warning loginbtn">Bid Now</button>
                                              </div>
                                            </div>

                                            </div>

                                 </form>
                                            </div>



                               </div>
                             </div>
                           </div>
		</div>
<!-- end bid model -->
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
	<div class="lastpagination">
          <ul class="pagination">
            <?php echo $pagination;?>
          </ul>
      </div>
	<?php

	  }
	 ?>




    </section>
    <?php include('footer.php'); ?>
  </body>
</html>



