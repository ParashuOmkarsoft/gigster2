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
<title><?php echo $sitename;?>- Gigs</title>
<?php include('script-header.php'); ?>
<?php include('fb-login.php'); ?>
</head>
<body>
<?php include('top-menu.php'); ?>

<?php $term = $_REQUEST['gigsearch']; ?>
<section class="container mclass">
  <form class="navbar-form navbar-right" role="search" action="<?php echo $serverpath;?>searchgig" method="post" style="padding:0px;">
    <div class="form-group"><input type="text" class="form-control" placeholder="Search" name="gigname" value="<?php echo $term; ?>" style="border: 1px solid #fab518;border-radius: none;border-radius: 0px;"></div>
    <button type="submit" class="btn btn-default btn-lg search-submit"><span class="glyphicon glyphicon-search"></span></button>

  </form>
  <h2 id="logingigster1">Open Gigs</h2>
  <?php
		$sqlquery = "SELECT * FROM btr_projects WHERE prjTitle LIKE '%$term%' or prjdesc LIKE '%$term%' order by postedon DESC" ;
		$opengigs = @db_query($sqlquery);
	
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
			  if(!empty($gigsterInfo['profileimage']))
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
      <div class="col-md-12" style="padding:0px;">
        <?php
		   for($t=$gigsterrating;$t<5;$t++)
			  {
		  ?>
        		<img src="<?php echo $serverpath;?>images/star_4.png" />
        <?php  }
		   for($t=0;$t<$gigsterrating;$t++)
			  {
		  ?>
        		<img src="<?php echo $serverpath;?>images/star_3.png" />
        <?php  }  ?>
      </div>
      <h4><a href="<?php echo $serverpath;?>gigsterInfo/<?php echo urlencode($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"><?php echo strip_string($nametodisplay,6);?></a></h4>
      <h4>&nbsp;</h4>
      <div class="col-md-12" style="padding:0px;"> <a href="<?php echo $serverpath;?>gigsterInfo/<?php echo urlencode($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1" class="img-circle"></a> </div>
      <?php 
	  		if(($_SESSION['uId']!=encrypt_str($opengig['userId'])))
			  {
			  if(!is_project_awarded($opengig['prjId']))
				{
					if(isset($_SESSION['uId']))
					{
						if(!is_project_bided_by_user($opengig['prjId'],$uInfo['userId']))
						{
	  ?>
					      <a data-toggle="modal" href="#bidmodel<?php echo $opengig['prjId'];?>" ><button type="button" class="btn btn-bid pull-right">Bid</button></a>
      <?php				}
						else
						{
	  ?>
					      <a href="#" onClick="javascript:alert('You have already bided on this gig');"><button type="button" class="btn btn-bid pull-right">Bided Already</button></a>
      <?php				}
					}
					else
					{
		?>
				      <a data-toggle="modal" href="#loginmodel" ><button type="button" class="btn btn-bid pull-right">Bid</button></a>
      <?php			}  ?>
      <div id="bidmodel<?php echo $opengig['prjId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content cform">
            <div class="container">
              <div class="col-md-12">
                <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>submitproposal" role="form" method="post"  target="targetframe">
                  <input type="hidden" id="projectId" name="projectId" value="<?php echo $opengig['prjId'];?>" />
                  <input type="hidden" name="bidfrom" id="bidfrom" value="<?php echo $uInfo['userId']; ?>" />
                  <h2 id="login1">Bid On Gig </h2>
                  <h2 class="source"><?php echo $opengig['prjTitle'];?></h2>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="inputText" class="col-sm-4 control-label newlog">Bid Details</label>
                      <br/>
                      <br/>
                      <div class="col-sm-12">
                        <textarea class="form-control tinpute mtextarea" placeholder="Bid Details" row="10" column="10" required name="proposal" id="proposal"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <?php if($opengig['jobtype']=="f") { ?>
                      <label class="col-md-6 control-label tfont">Price on Fixed basis</label>
                      <?php } else { ?>
                      <label class="col-md-6 control-label tfont">Price on Hourly basis</label>
                      <?php } ?>
                      <Br/>
                      <br/>
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
      <?php } 
			else
	  		{
	  ?>
		      <a href="#" ><button type="button" class="btn btn-bid pull-right" onClick="javascript:alert('This Gig is already awarded');">Awarded</button></a>
      <?php }
	  }	?>
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
	  else
	  {
  ?>
  <br/>
  <p class="mandatory col-md-12">Sorry, No Open gigs right now. </p>
  <br/>
  <?php } ?>
</section>
<?php include('footer.php'); ?>
</body>
</html>