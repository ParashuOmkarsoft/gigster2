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


<section class="container mclass">
	<ul id="profilemenu">
    <li><a href="<?php echo $serverpath;?>inprogress"> <b> Awarded</b><?php if($unreadreports)
						  {
							  ?>
							  <i class="fa fa-circle" style="color:green;" title="New Report Received"></i>
							  <?php
						  }
						  ?></a></li>
    <li><a href="<?php echo $serverpath;?>bidding"> Bidding </a><?php if($unreadbids)
						  {
							  ?>
							  <i class="fa fa-circle" style="color:green;"></i>
							  <?php
						  }
						  ?></li>
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
				$profilepic=random_user_pics();
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
      margin-top: 15px;"><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($opengig['prjTitle']);?>/<?php echo $opengig['prjId'];?>"><?php echo $opengig['prjTitle'];?><?php 
	  if(get_unread_project_report($opengig['prjId']))
	  {
		  ?>
		  <i class="fa fa-circle" style="color:green;"></i>
		  <?php
	  }
	  ?></a></h2>
      
      <p id="gigpara" ><?php echo stripslashes(strip_string($opengig['prjdesc'],500));?></p>
      <h2 id="map"><?php echo $gigsterInfo['city'];?></h2>
      <div class="col-md-12" style="padding: 0px;"> 
      <span id="bid" style="margin-left:0px;"><?php if($projectstatus == '100' ) { if(!is_feedback_given($opengig['prjId'],$uInfo['userId'])){ ?><!-- <a href="#statusmodal<?php //echo $opengig['prjId'];?>" data-toggle="modal"> -->
        <!-- <button type="button" class="btn markascomplete-btn1" >Send feedback</button> -->
         <!-- <img src="images/feedback.png" title="Send feedback" style="float:left;margin-left:-7px;"> -->
        <!-- </a> --> <?php } } ?></span></div>
      <div id="statusmodal<?php echo $opengig['prjId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 500px;">
          <div class="modal-content cform">
            <div class="container">
              <div class="col-md-12" style="padding: 0px;">
                <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>finalrating" role="form" method="post" onSubmit="return validate_rating('<?php echo $opengig['prjId'];?>');" >
                  <input type="hidden" id="projectId" name="projectId" value="<?php echo $opengig['prjId'];?>" />
                  <input type="hidden" id="gigster" name="gigster" value="<?php echo $awardedto;?>" />
                  <h2 id="login1">Rate and Comment</h2>
                  <h2 class="source" style="font-size:28px;"><?php echo $opengig['prjTitle'];?></h2>
                  <div class="col-md-12" style="padding: 0px;margin-top: 10px;">
                    <div class="form-group" style="margin-bottom:10px;">
                      <label class="col-md-2 control-label tfont" style="margin-top:14px;">Rating</label>
                    
                      <div class="col-md-10" >
                      
                       <style type="text/css">
					   .rating-sm {
 						   font-size: .7em;
								}
					   </style>
                 
							    <input id="rating<?php echo $opengig['prjId'];?>" name="rating" value="<?php echo $rt;?>" type="number" class="rating" >
						
                         <script type="text/javascript">
						   $('.rating').rating({'showCaption':false, 'stars':'5', 'min':'0', 'max':'5', 'step':'1', 'size':'sm'});
						 </script>
                        </div>
                      </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0px;">
                      <label for="inputText" class="col-sm-6 control-label newlog"></label>
                     
                      <div class="col-sm-12"style="margin-bottom:0px;">
                        <textarea class="form-control tinpute mtextarea" placeholder="Please comment here" row="10" column="10" required name="experience" id="experience"></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-sm-12 logsign"style="padding: 0px;">
                        <button type="submit" class="btn mark-btn">Send</button>
                      </div>
                    </div>
                </form>
                  </div>
                
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
				        <label>
				        <h5>Message</h5>
				        </label>
				        <textarea rows="5" name="message" id="message" class="form-control msg-textarea" style="width:100%;"></textarea>
				      </div>
                    <div class="form-group">
				        <button type="submit" class="btn gig-send-btn pull-right">Send Message</button>
				    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-12" style="height: 400px;overflow: auto;background: #f3f3f3;padding-top: 15px;border-radius: 8px;">
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
				$cl="style='background-color:#fdebbb;margin-top:10px;vertical-align:top;border-radius: 8px;width: 470px;float:left'";
			}
			else
			{
				$cl="style='background-color:#fff;margin-top:10px;vertical-align:top;border-radius: 8px;width: 470px;float:right'";
			}
			//$updatemessage=@db_query("update btr_messages set isread='1' where msgId=".$messages['rows'][$t]['msgId']);	
			?>
                <div class="col-md-12 item" <?php echo $cl;?>> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $buserimage;?>&width=50&height=50&cropratio=1:1" alt="<?php echo get_user_name($msgfrom);?>" class="img-circle"/> 
                  <p class="message"> <a href="#" class="name"><small class="text-muted pull-right"><i class="fa fa-clock-o"></i>&nbsp; <?php echo gmstrftime("%B %d %Y, %X %p",$messages['rows'][$t]['msgon']);?></small>
                    <?php echo get_user_name($msgfrom);?> </a><br>
                    <?php echo stripslashes(stripslashes(html_entity_decode($messages['rows'][$t]['msgcontent']))); ?>
                  </p>
                </div>
                
                <?php
		}
		  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4" style="padding:0px;"> 
		<?php 

		$winningbidder=project_awarded_to($opengig['prjId']);
		$winnerInfo=get_user_Info(encrypt_str($winningbidder['awardedto']));

		$winnerprofilepic=$winnerInfo['profileimage'];
		if(!$winnerprofilepic)
		{
			$winnerprofilepic=random_user_pics();
		}
		else
		{
			$winnerprofilepic="uploads/profileimage/".$winnerprofilepic;
		}
		$winnernametodisplay=$winnerInfo['fname']." ".$winnerInfo['lname'];
		$winnernametodisplay1=str_replace(" ","",$winnernametodisplay);
		if(!$winnernametodisplay1)
		{
			$winnernametodisplay=$winnerInfo['username'];
		}
		$winnerrating=get_user_rating($winnerInfo['userId']);
		?>
      	<div class="pull-right" style="padding-top: 20px;float: right;margin-left: 0px;">
      	 <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $winnerprofilepic;?>&width=75&height=75&cropratio=1:1"style="float:right" class="img-circle"><br>
      		<h4><?php echo $winnernametodisplay; ?></h4>
            <div id="star-1" style="float:right">
      		<?php
			for($t=0;$t<$winnerrating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_1.png" style="margin:0px !important;float:left;" />
        
<?php
							  }
			   for($t=$winnerrating;$t<5;$t++) 
							  {
								  
								  ?>
        <img src="<?php echo $serverpath;?>images/star_2.png" style="margin:0px !important;float:left;" />
        <?php
							  }
							   

			?>
            </div>
     	  <div>
     	  <a href="#msgmodal<?php  echo $awardedto;?>" data-toggle="modal"><img src="<?php echo $serverpath;?>images/mail.jpg" style="float:right;margin-top:20px;margin-right: 15px;"></a>              
     	  </div>
     	 </div> 
 </div>

      <div class="col-md-8"style="padding: 0px;"><!-- <span class="bid">Posted :<?php echo get_time($opengig['postedon']); ?></span> -->
      	<div class="col-md-12" style="padding: 0px;">
         <h4>Completion Status</h4><div class="row">
         <div class="col-md-12" style="padding-right: 0px;">         
         <h4><?php echo convert_date($opengig['bidfrom']);?> <span class="sb pull-right"><?php echo convert_date($opengig['bidto']);?></span></h4>
         <div class="progress"  style="width: 100%;">
             <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $projectstatus;?>%;">                <span class="sr-only"><?php echo $projectstatus; ?>%</span>
         </div>         
        </div>
     </div> 
	</div>
    </div>
   
   </div>
 <div class="col-md-4">
 <?php if($projectstatus==100){ ?>
 	<a href="#statusmodal<?php echo $opengig['prjId'];?>" data-toggle="modal"><img src="images/feedback.png" title="Send feedback" style="position: absolute;top: 67px;"></a>
    <?php
 }
	?>
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
	  
	  $updatethread=@db_query("update btr_messages set isread='1' where msgtype='s' and msgto=".$uInfo['userId']);
	  }
	  
	  else
	  {
  ?>
  <div class="row ">
    <div class="col-md-8">
      <p>Sorry , no Gigs are in progress right now.</p>
    </div>
  </div>
  <?php
	  }
	 ?>
</section>
<?php include('footer.php'); ?>
</body>
</html>