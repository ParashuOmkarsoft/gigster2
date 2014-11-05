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
     <title><?php echo $sitename;?> - Inbox</title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
   <?php include('top-menu.php'); ?>
        <div id="grad"></div>
     

    </section>

<section class="container">
      <h2 id="logingigster1">Inbox</h2>
      <?php
	  	// Count Query
		$gigscountquery=@db_query("select * from btr_messages where msgto=".$uInfo['userId']." order by msgon DESC");
		$total_pages=$gigscountquery['count'];
		$page = $_GET['page'];
		$adjacents = 1;
		$limit = 5; 
		if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
		else
		$start = 0;
		
		  $gigsquery="select * from btr_messages where msgto=".$uInfo['userId']." order by msgon DESC LIMIT $start,$limit";
	    $opengigs=@db_query($gigsquery);

	  if($opengigs['count']>0)
	  {
		   $mcount=$opengigs['count'];
		  
		 
		  for($i=0;$i<$mcount;$i++)
		  {
			  $opengig=$opengigs['rows'][$i];
			  $gigsterInfo="";
			  $gigsterInfo=get_user_Info(encrypt_str($opengig['msgfrom']));
			  $nametodisplay="";
			  $nametodisplay=$gigsterInfo['fname'].' '.$gigsterInfo['lname'];
			  if(!$nametodisplay)
			  {
				  $nametodisplay=$gigsterInfo['username'];
			  }
			  
			$profilepic="uploads/profileimage/".$gigsterInfo['profileimage'];
			
			if(file_exists($profilepic))
			{
				$profilepic=$profilepic;
			}
			else
			{
				$profilepic="images/admin.png";
			}
			$mgigdetails=get_gig_details($opengig['projectId']);
	   ?>
      <div class="row ">
         <div class="col-md-8">
            <h2 id="giglisth2"><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($mgigdetails['prjTitle']);?>/<?php echo $mgigdetails['prjId'];?>"><?php echo $mgigdetails['prjTitle'];?></a></h2>
            <h2 id="map"><?php echo $gigsterInfo['city'];?></h2>
              <div class="col-md-8"><span id="bid">&nbsp;</span></div>
              <div class="col-md-4"><span class="bid">Posted :<?php echo get_time($opengig['msgon']); ?></span></div>
              <p id="gigpara"><?php echo stripslashes((html_entity_decode($opengig['msgcontent'])));?></p>
          </div>
         <div class="col-md-4 giginnerimg gigimg">
              <div class="col-md-6">
                 
                   <h4><a href="<?php echo $serverpath;?>gigsterInfo/<?php echo mera_url_noslash($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"><?php echo strip_string($nametodisplay,6);?></a></h4>
                   <h4>&nbsp;</h4>
              </div>
              <div class="col-md-6">
                   <a href="<?php echo $serverpath;?>gigsterInfo/<?php echo mera_url_noslash($nametodisplay);?>/<?php echo $gigsterInfo['userId'];?>"> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1"></a>
              </div>
             <?php if($opengig['msgtype']=="r")
			 {
				 $reportdetails=get_report_details($opengig['reportid']);

				 
			 }
			 else
			 {
				 ?>
            <a href="#msgmodal<?php echo $opengig['msgId'];?>" data-toggle="modal" ><button type="button" class="btn btn-warning">Reply</button></a>  
         <div id="msgmodal<?php echo $opengig['msgId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content cform">
              <div class="container">
                <div class="col-md-12">
                  <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>sendmessage" target="targetframe" role="form" method="post" >
                  
					  <?php 
					  $oponent=get_oponent($opengig['msgId'],$uInfo['userId']);
					  ?>
                    <input type="hidden" id="fromId" name="fromId" value="<?php echo $uInfo['userId'];?>" />
                    <input type="hidden" id="toId" name="toId" value="<?php echo $oponent;?>" />
                   
                    <input type="hidden" id="projectId" name="projectId" value="<?php echo $opengig['projectId'];?>" />
                    <?php $gigdetails=get_gig_details($opengig['projectId']); ?>
                    <h2 id="login1">Messages</h2>
                    <h2 class="source"><?php echo $gigdetails['prjTitle'];?></h2>
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
                <div class="col-md-12" style="height:250px; overflow:scroll;">
                  <?php
			$muInfo=get_user_Info($_SESSION['uId']);
			$muId=$muInfo['userId'];
			$other=get_oponent($pId,$muId);
		 	$projectMessages="select * from btr_messages where projectId=".$gigdetails['prjId']." and (msgfrom=$muId or msgto=$muId) order by msgId DESC";
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
			$updatemessage=@db_query("update btr_messages set isread='1' where msgId=".$messages['rows'][$t]['msgId']);	
			?>
                  <div class="item" <?php echo $cl;?>> <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $buserimage;?>&width=50&height=50&cropratio=1:1" alt="<?php echo get_user_name($msgfrom);?>" class="online"/> <br/>
                    <p class="message"> <a href="#" class="name"><small class="text-muted pull-right"><i class="fa fa-clock-o"></i>&nbsp; <?php echo gmstrftime("%B %d %Y, %X %p",$messages['rows'][$t]['msgon']);?></small><br/>
                      <?php echo get_user_name($msgfrom);?> </a><br/>
                      <?php echo stripslashes(stripslashes($messages['rows'][$t]['msgcontent']));?><br/>
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
          <div class="col-md-12">
          <td>
                   <a href="http://gigster2.fountaintechies.com/gigsterInfo/N-A/59">
                   <div class="artst-pic pull-left">
					
					   <img src="http://gigster2.fountaintechies.com/image.php?image=/uploads/profileimage/59.jpg&amp;width=75&amp;height=75&amp;cropratio=1:1">
                   </div>
                   <div class="artst-prfle pull-right">
                          <div class="art-title">
                              N/A                              <span class="star">
                              								  <img src="http://gigster2.fountaintechies.com/images/star_2.png">
								  								  <img src="http://gigster2.fountaintechies.com/images/star_2.png">
								  								  <img src="http://gigster2.fountaintechies.com/images/star_2.png">
								  								  <img src="http://gigster2.fountaintechies.com/images/star_2.png">
								  								  <img src="http://gigster2.fountaintechies.com/images/star_2.png">
								                                                            
                             </span>
                                                         								<span class="artst-ux">N/A</span> 
                                
                               
                            </div>
                           
                        </div>
                        </a>
                    </td>
                    </div>

        </div>
        
        
        <?php
			 }
        
			
			?>
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