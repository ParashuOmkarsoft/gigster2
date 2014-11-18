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
 
</section>
<section class="container">
	<ul id="profilemenu">
    <li><a href="<?php echo $serverpath;?>inprogress"> <strong> In progress</strong> </a></li>
    <li><a href="<?php echo $serverpath;?>bidding"> Bidding </a></li>
    <li><a href="<?php echo $serverpath;?>completed">Completed</a></li>
  </ul>
  <h2 id="logingigster1">My Gigs</h2>
  <?php
        $uId=$uInfo['userId'];
	  	// Count Query
		$gigscountquery=@db_query("select * from btr_projects where userId=$uId and status='2' order by postedon DESC");
		$total_pages=$gigscountquery['count'];
		$page = $_GET['page'];
		$adjacents = 1;
		$limit = 5;
		if($page)
		$start = ($page - 1) * $limit; 			//first item to display on this page
		else
		$start = 0;
		$gigsquery="select * from btr_projects  where userId=$uId  and  status='2' order by postedon DESC LIMIT $start,$limit";
		
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
			$selectedbidder="select * from btr_assignment where projectId=".$opengig['prjId'];
			$selectedbidder=@db_query($selectedbidder);
			$awardedto=$selectedbidder['rows']['0']['awardedto'];
			//pr($awardedto)

	   ?>
  <?php //pr($gigsterInfo); ?>
  <?php $projectstatus=get_status_details($opengig['prjId'],$awardedto);
		  
		  if(!$projectstatus)
		  {
			  $projectstatus="0";
		  }
		  ?>
  <div class="row mygigrow" style="border-bottom: 5px solid #fab518;">
    <div class="col-md-8" style="padding: 0px;">
      <h2 id="giglisth2"style="
      margin-top: 15px;"><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($opengig['prjTitle']);?>/<?php echo $opengig['prjId'];?>"><?php echo $opengig['prjTitle'];?></a></h2>
      <p id="gigpara"><?php echo stripslashes(strip_string($opengig['prjdesc'],500));?></p>
      <h2 id="map"><?php echo $gigsterInfo['city'];?></h2>
      <div class="col-md-12" style="padding: 0px;"> <a href="#msgmodal<?php  echo $awardedto;?>" data-toggle="modal"><img src="<?=$serverpath;?>images/mail.jpg" style="padding-top: 20px;"></a>
      <span id="bid"><?php if($projectstatus == '100' ) { if(!is_feedback_given($opengig['prjId'],$uInfo['userId'])){ ?><a href="#statusmodal<?php echo $opengig['prjId'];?>" data-toggle="modal">
        <button type="button" class="btn markascomplete-btn1" >Send feedback</button>
        </a> <?php } } ?></span></div>
      <div id="statusmodal<?php echo $opengig['prjId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
        <div class="modal-dialog modal-lg"style="max-width: 500px;">
          <div class="modal-content cform">
            <div class="container">
              <div class="col-md-12" style="padding: 0px;">
                <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>finalrating" role="form" method="post" >
                  <input type="hidden" id="projectId" name="projectId" value="<?php echo $opengig['prjId'];?>" />
                  <input type="hidden" id="gigster" name="gigster" value="<?php echo $awardedto;?>" />
                  <h2 id="login1">Mark gig as complete</h2>
                  <h2 class="source"><?php echo $opengig['prjTitle'];?></h2>
                  <div class="col-md-12" style="padding: 0px;">
                    <div class="form-group">
                      <label for="inputText" class="col-sm-6 control-label newlog" style="margin-bottom: 30px;">Feedback for gigster</label>
                     
                      <div class="col-sm-12">
                        <textarea class="form-control tinpute mtextarea" placeholder="Your Message" row="10" column="10" required name="experience" id="experience"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label tfont" style="margin-bottom: 20px;">Rating</label>
                      
                      <div class="col-md-10" style="padding: 0px; margin-top:-7px">
                      
                        <div class="form-control form-radio" >
                 
							    <input id="input-21d" name="rating" value="<?php echo $rt;?>" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm">
						
                         <script type="text/javascript">
						   $('.rating').rating({'showCaption':true, 'stars':'5', 'min':'0', 'max':'5', 'step':'1', 'size':'xs'});
						 </script>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12 logsign"style="padding: 0px;">
                        <button type="submit" class="btn mark-btn">Mark as Complete</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>     
      </div>
      <?php $mygiginprogress = ""; ?>
     
      <div id="msgmodal<?php echo $awardedto;?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content cform">
            <div class="container">
              <div class="col-md-12">
                <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>sendmessage" role="form" method="post" >
                  <input type="hidden" id="fromId" name="fromId" value="<?php echo $gigsterInfo['userId'];?>" />
                  <input type="hidden" id="toId" name="toId" value="<?php echo $awardedto;?>" />
                  <input type="hidden" id="projectId" name="projectId" value="<?php echo $opengig['prjId'];?>" />
                  <h2 id="login1">Messages</h2>
                  <h2 class="source"><?php echo $opengig['prjTitle'];?></h2>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-md-4 control-label tfont">Message</label>
                      <Br/>
                      <br/>
                      <div class="col-md-12">
                        <textarea name="message" id="message" class="form-control mtextarea" ></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-10 logsign">
                        <button type="submit" class="btn btn-warning loginbtn">Send Message</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-12" style="height:250px; overflow:scroll;padding-top: 2px;">
                <?php
			$muInfo=get_user_Info($_SESSION['uId']);
			$muId=$muInfo['userId'];
			$other=get_oponent($pId,$muId);
		 	$projectMessages="select * from btr_messages where projectId=".$opengig['prjId']." and (msgfrom=$muId or msgto=$muId) order by msgId DESC";
			$projectMessages=@db_query($projectMessages);
			$messages=$projectMessages;
			for($t=0;$t<$messages['count'];$t++)
			{
			$msgfrom=$messages['rows'][$t]['msgfrom'];
			$fromInfo=get_user_Info(filter_text(encrypt_str($msgfrom)));
			$fromuserimg=$fromInfo['profileimage'];
			$buserimage="";
			if(!$fromuserimg)
			{
				$buserimage=filter_text('img/avatar5.png');
			}
			else
			{
				$buserimage="uploads/profileimage/".$fromuserimg;
			}
			if($t%2==0)
			{
				$cl="style='background-color:#f8f8f8;padding:5px;border-radius:10px;-moz-box-shadow: 0px 0px 2px #000000;
-webkit-box-shadow: 0px 0px 2px #000000;
box-shadow: 0px 0px 2px #000000;'";
			}
			else
			{
				$cl="style='background-color:white;padding:5px;border-radius:10px;-moz-box-shadow: 0px 0px 2px #000000;
-webkit-box-shadow: 0px 0px 2px #000000;
box-shadow: 0px 0px 2px #000000;'";
			}
			//$updatemessage=@db_query("update btr_messages set isread='1' where msgId=".$messages['rows'][$t]['msgId']);	
			?>
                <div class="item" <?php echo $cl;?>> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $buserimage;?>&width=50&height=50&cropratio=1:1" alt="<?php echo get_user_name($msgfrom);?>" class="online"/> <br/>
                  <p class="message"> <a href="#" class="name"><small class="text-muted pull-right"><i class="fa fa-clock-o"></i>&nbsp; <?php echo gmstrftime("%B %d %Y, %X %p",$messages['rows'][$t]['msgon']);?></small><br/>
                    <?php echo get_user_name($msgfrom);?> </a><br/>
                    <?php echo stripslashes(stripslashes(html_entity_decode($messages['rows'][$t]['msgcontent']))); ?><br/>
                  </p>
                </div>
                <br/>
                <?php
		}
		  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8"style="padding: 0px;"><!-- <span class="bid">Posted :<?php echo get_time($opengig['postedon']); ?></span> --></div>
      <div class="col-md-12" style="padding: 0px;">
            <h4>Completion Status</h4><div class="row">
          <div class="col-md-12" style="padding-right: 0px;">
          
         <h4><?php echo convert_date($opengig['bidfrom']);?> <span class="sb pull-right"><?php echo convert_date($opengig['bidto']);?></span></h4>
         <div class="progress"  style="width: 100%;">
             <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $projectstatus;?>%;">
               
                <span class="sr-only"><?php echo $projectstatus; ?>%</span>
         		 </div>
                 
         </div>
         
     </div>
	</div>
    </div>
    <div class="col-md-8" style="padding: 0px;">
       
      </div>
 </div>
<div class="col-md-4"> 

      	<div class="pull-right" style="padding-top: 20px;float: right;margin-left: 0px;">
      	 <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1"style="float:right"><br>
      		<h4><?php echo $nametodisplay; ?></h4>
            <div id="star-1">
      		<?php
			   for($t=$gigsterrating;$t<5;$t++) 
							  {
								  
								  ?>
        <img src="<?php echo $serverpath;?>images/star_2.png" style="margin:0px !important;" style="float:left"/>
        <?php
							  }
							   for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_1.png" style="margin:0px !important;"style="float:left"/>
        
<?php
							  }

			?>
            </div>
     	 </div>               
 </div>

      
     <?php /*?> <div class="col-md-2 giginnerimg gigimg">
        <div class="col-md-12"> <a href="<?php echo $serverpath;?>gigsterInfo/<?php echo mera_url_noslash($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1"></a>
          <div class="tyco">
            <h4><a href="<?php echo $serverpath;?>gigsterInfo/<?php echo mera_url_noslash($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"><?php echo strip_string($nametodisplay,6);?></a></h4>
          </div>
          <h4>&nbsp;</h4>
        </div>
        <!-- end bid model --> 
      </div><?php */?>
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
  <div class="row ">
    <div class="col-md-8">
      <p>Sorry , No Gigs are in progress right now.</p>
    </div>
  </div>
  <?php
	  }
	 ?>
</section>
<?php include('footer.php'); ?>
</body>
</html>