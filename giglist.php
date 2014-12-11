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


<section class="container mclass">
  <form class="navbar-form navbar-right" role="search" action="<?php echo $serverpath;?>searchgig" method="post" style="padding: 0px;">
          <div class="form-group"><input type="text" class="form-control" placeholder="Search" name="gigsearch" style="border: 1px solid #fab518;border-radius: none;border-radius: 0px;"></div>
          <!-- <button type="submit" class="btn btn-default">Submit</button> -->
           <button type="submit" class="btn btn-default btn-lg search-submit"><span class="glyphicon glyphicon-search"></span></button>
        </form>
  <h2 id="logingigster1">Open Gigs</h2>
  <?php
	  	// Count Query
		$gigscountquery=@db_query("select * from btr_projects where status ='0'  order by postedon DESC");
		$total_pages=$gigscountquery['count'];
		$page = $_GET['page'];
		$adjacents = 1;
		$limit = 5; 
		if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
		else
		$start = 0;
		
		$gigsquery="select * from btr_projects where status ='0'  order by postedon DESC LIMIT $start,$limit";
	    $opengigs=@db_query($gigsquery);

	  if($opengigs['count']>0)
	  {
		   $mcount=$opengigs['count'];
		  
		?>
		<div style="margin-bottom:10px;">
		<?php
		  for($i=0;$i<$mcount;$i++)
		  {
			  $opengig=$opengigs['rows'][$i];
			  $gigsterInfo="";
			  $gigsterInfo=get_user_Info(encrypt_str($opengig['userId']));
			  $nametodisplay="";
			  $nametodisplay=$gigsterInfo['fname'].' '.$gigsterInfo['lname'];
			  $nametodisplay1=str_replace(" ","",$nametodisplay);;
			  if(!$nametodisplay1)
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
  <div class="row gig-detail-row">
    <div class="col-md-10" style="padding-left: 0px;">
      <h2 id="giglisth2"><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_encode($opengig['prjTitle']);?>/<?php echo $opengig['prjId'];?>" style="
    color: #45350f;"><?php echo strip_string($opengig['prjTitle'],29);?></a></h2>	
    <div>
    <span  class="myquote">Posted :<?php echo get_time($opengig['postedon']); ?></span>
    </div>
      <h2 id="map"><?php echo $gigsterInfo['city'];?></h2>
   	  <p id="gigpara" style="padding-top:0px !important;width:750px;overflow:hidden;" ><?php echo stripslashes(stripslashes(nl2br(strip_string(nl2br($opengig['prjdesc']),250))));?></p>
    </div>
    <div class="col-md-2 giginnerimg gigimg" style="margin-bottom: 0;padding-right: 0px;">     
      <div><a href="<?php echo $serverpath;?>gigsterInfo/<?php echo mera_url_encode($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1"class="img-circle"></a></div> 
       <h4><a href="<?php echo $serverpath;?>gigsterInfo/<?php echo urlencode($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"><?php echo strip_string($nametodisplay,10);?></a></h4>
      
      <div class="col-md-12" style="padding-right: 0px;">
        <?php
                              for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_3.png" style="margin-left:0px !important;"/>
        <?php
							  }
							   for($t=$gigsterrating;$t<5;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_4.png" style="margin-left:0px !important;" />
        <?php
							  }
							  
							  ?>
	
      </div>
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
                  <a data-toggle="modal" href="#bidmodal" onClick="bid_modal('<?php echo $serverpath;?>','<?php echo $opengig['prjId'];?>','<?php echo $uInfo['userId'];?>')" >
                  <button type="button" class="btn btn-bid pull-right">Bid</button>
                  </a>
                  <?php
					}
					else
					{
										  ?>
                  <!--<a href="#" onClick="javascript:alert('You have already bided on this gig');">-->
                  <a data-toggle="modal" href="#bidsent<?php echo$opengig['prjId'];?>"  >
                  <button type="button" class="btn bid-send pull-right" style="margin-bottom:10px;">Bid Sent</button>
                  </a>
                  <?php
					}
					}
					else
					{
					?>
                      <a data-toggle="modal" href="#loginmodel" >
                      <button type="button" class="btn btn-bid pull-right">Bid</button>
                      </a>
					<?php
					}
					if($_SESSION['uId'])
					{
						$userInfo=get_user_Info($_SESSION['uId']);
						$uId=$userInfo['userId'];
					}
					$gigprjId = $opengig['prjId'];
					$checkQuery="select * from btr_bids where projectId=$gigprjId and bidfrom=$uId";
					$checkSql=@db_query($checkQuery);

				  ?>
                  
                  <div id="bidsent<?php echo$opengig['prjId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content cform">
                              <div class="container">
                                <div class="col-md-12">
									<h2 id="bid-detail">Your bidding details</h2>
                                    <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>submitproposal" role="form" method="post" >
                                                                      
                                    <h2 class="source"  style="padding-bottom: 20px;"><?php echo $opengig['prjTitle'];?></h2>
                                    <div class="col-md-12" style="padding: 0px;">
                                      <div class="form-group">
                                        <label for="inputText" class="col-sm-4 control-label newlog">Bid Details :</label>
                                        <br/>
                                        <br/>
                                        <div class="col-sm-12">
                                        
										  <p style="text-align: left;word-wrap: break-word;" ><?php echo $checkSql['rows']['0']['bidcontent']; ?></p>
                                         
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-4 control-label tfont">Your bid amount : </label>
                                        <Br/>
                                        <br/>
                                        <div class="col-md-8">
                                          <p style="text-align: left;"><?php echo $checkSql['rows']['0']['bidprice']; ?></p>
                                        </div>
                                      </div>
                                      
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                  <div id="bidmodel<?php echo $opengig['prjId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
                  
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content cform">
                        
                      </div>
                    </div>
                  </div>
      <?php } 
				else
	  			{
	  ?>
		   		<a href="#" ><button type="button" class="btn btn-bid pull-right" style="background-color:#006;" onClick="javascript:alert('This Gig is already awarded');">Awarded</button></a>
		  <?php }
		  	  }	
			  
			  $m_u_Info=get_user_Info($_SESSION['uId']);
			  if(get_admin($m_u_Info['userId'],$m_list))
			  {
				  $m_ftrd=is_featured($opengig['prjId']);
				  if($m_ftrd)
				  {
?>
              <a href="<?php echo $serverpath;?>isfeatured/<?php echo $opengig['prjId'];?>/0" style="margin-bottom:5px;" class="btn btn-primary pull-right">UnFeature It!</a>
<?php
				  }
				  else
				  {
			  ?>
              <a href="<?php echo $serverpath;?>isfeatured/<?php echo $opengig['prjId'];?>/1" class="btn btn-bid pull-right">Feature It!</a>
              <?php
				  }
			  }
			  ?>
      <!-- end bid model --> 
    </div>
  </div>
  <?php
		  }
		  ?>
		  </div>
		  <?php
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
  <?php
	  }
	 ?>
</section>
<!--<section class="container giglast">
      <h2 id="login">Our Gigsters</h2>
      <div class="row">
         <div class="col-md-4">   
           <img src="images/person1.jpg">
           <div>
              <span>Mike Fisher</span>
              <span id="map">Yishun, Singapore</span>
              <span id="artist">ux, photographer, design artist</span>
           </div>           
         </div>
         <div class="col-md-4"> 
          <img src="images/person1.jpg">
           <div>
              <span>Mike Fisher</span>
              <span id="map">Yishun, Singapore</span>
              <span id="artist">ux, photographer, design artist</span>
           </div> 
         </div>
         <div class="col-md-4">
            <img src="images/person1.jpg">
           <div>
              <span>Mike Fisher</span>
              <span id="map">Yishun, Singapore</span>
              <span id="artist">ux, photographer, design artist</span>
           </div> 
         </div>
      </div>

    </section>-->

<?php include('footer.php'); ?>
</body>
</html>