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
    <title><?php echo $sitename;?>- Completed gigs</title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
    <?php include('top-menu.php'); ?>
    
         
  
<section class="container mclass">
<ul id="profilemenu">
  <li><a href="<?php echo $serverpath;?>assignments">
   Awarded<?php if($unreadawards)
						  {
							  ?>
							  <i class="fa fa-circle" style="color:green;"></i>
							  <?php
						  }
						  ?>
    </a></li>
  <li><a href="<?php echo $serverpath;?>bided"> Bidding</a></li>
  <li><a href="<?php echo $serverpath;?>tocompleted"><strong>Completed</strong></a></li>
</ul>
      <h2 id="logingigster1">My Bids</h2>
<?php


$mUid=$_SESSION['uId'];
$muInfo=get_user_Info($mUid);
$mUid=filter_text($muInfo['userId']);
$checkQuery="select a.* from btr_assignment as a ,btr_projects as p where  a.awardedto=".$uInfo['userId']." and a.projectId=p.prjId and p.status='3' order by p.prjId DESC ";
$checkSql=@db_query($checkQuery);
if($checkSql['count']>0)
{
	 $sno=1;
     for($i=0;$i<$checkSql['count'];$i++)
       {

		  $prjDetails=get_gig_details($checkSql['rows'][$i]['projectId']);
		    $muInfo=get_user_Info(encrypt_str($prjDetails['userId']));
		  $mId=encrypt_str($checkSql['rows']['0']['id']);
		  $awardedto=$checkSql['rows']['0']['awardedto'];
			$nametodisplay="";
			  $nametodisplay=$muInfo['fname'].' '.$muInfo['lname'];
			  $nametodisplay1=str_replace(" ","",$nametodisplay);
			  if(!$nametodisplay1)
			  {
				  $nametodisplay=$muInfo['username'];
			  }
			  $gigsterrating=0;
			
			 $profilepic="uploads/profileimage/".$muInfo['profileimage'];
			
			if(file_exists($profilepic))
			{
				$profilepic=$profilepic;
			}
			else
			{
				$profilepic="images/admin.png";
			}
			
			$gigsterrating=get_user_rating($muInfo['userId']);		
			
?>
<section class="firstsection" class="container">
      <div class="row">
          <div class="col-md-8">
            <h3><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($prjDetails['prjTitle']);?>/<?php echo $prjDetails['prjId'];?>"><?php echo $prjDetails['prjTitle'];?></a></h3> 
            <div>          
			<?php $projectstatus=get_status_details($prjDetails['prjId'],$uInfo['userId']); 
				
			  if($projectstatus == '100') { 
			  if(!is_feedback_given($prjDetails['prjId'],$uInfo['userId']))
			  {
			  ?><a href="#statusmodal<?php echo $prjDetails['prjId'];?>" data-toggle="modal">
        <button type="button" class="btn markascomplete-btn1" >Send feedback</button>
        </a>
        
        <div id="statusmodal<?php echo $prjDetails['prjId'];?>" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
        <div class="modal-dialog modal-lg"style="max-width: 500px;">
          <div class="modal-content cform">
            <div class="container">
              <div class="col-md-12" style="padding: 0px;">
                <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>finalrating" role="form" method="post" onSubmit="return validate_rating('<?php echo $prjDetails['prjId'];?>')">
                  <input type="hidden" id="projectId" name="projectId" value="<?php echo $prjDetails['prjId'];?>" />

                  <h2 id="login1">Rate and Comment</h2>
                  <h2 class="source-new"style="font-size:28px;margin-bottom: 8px;"><?php echo $opengig['prjTitle'];?></h2>
                  <div class="col-md-12" style="padding: 0px;">
                  <div class="form-group">
                      <label class="col-md-2 control-label tfont" style="margin: 14px 0 20px 0;">Rating</label>
                      
                      <div class="col-md-10" style="padding: 0px; margin-top:-7px">
                      
                        <div class="form-control form-radio" >
 						<input id="rating<?php echo $prjDetails['prjId'];?>" name="rating" value="<?php echo $rt;?>" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm">
						
                         <script type="text/javascript">
						   $('.rating').rating({'showCaption':true, 'stars':'5', 'min':'0', 'max':'5', 'step':'1', 'size':'xs'});
						 </script>                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <!-- <label for="inputText" class="col-sm-6 control-label newlog" style="margin-bottom: 30px;">Feedback for gigster</label> -->
                     
                      <div class="col-sm-12">
                        <textarea class="form-control tinpute mtextarea" placeholder="Please comment here" row="10" column="10" required name="experience" id="experience"></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-sm-12 logsign"style="padding: 0px;">
                        <button type="submit" class="btn mark-btn">Send</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>     
      </div>
        <br/><br/>
         <?php 
			  }
		 }
		  ?>
      		</div>
            <div>
            <?php echo nl2br(html_entity_decode($prjDetails['prjdesc']));?>
            </div>
      	  </div>
          <div  style="float:right;margin-right:20px;">
          <table border="0" cellpadding="0" cellspacing="0" ><tr>
          <td style="text-align:center !important;">
          <img src="<?php echo $serverpath;?>image.php?image=/<?php echo $profilepic;?>&width=75&height=75&cropratio=1:1" class="img-circle"/>
          </td>
          </tr>
          <tr>
          <td style="text-align:center !important;">
         <h4> <?php echo $nametodisplay;?></h4>
          </td>
          </tr>
          <tr>
          <td style="text-align:center !important;">
            <?php 
			 
			for($t=$gigsterrating;$t<5;$t++) 
							  {
								  
								  ?>
        <img src="<?php echo $serverpath;?>images/star_2.png"  style="margin:0px !important;"/>
        <?php
							  }
							  for($t=0;$t<$gigsterrating;$t++)
							  {
								  ?>
        <img src="<?php echo $serverpath;?>images/star_1.png"  style="margin:0px !important;"/>
        
<?php
							  }
							  

         ?>
		  </td>
          </tr>
          </table>
          </div>
          
                   
      </div>
     <div class="row" style="margin-bottom:10px;margin-left:1px;">
        <h3>Feedback</h3>
         <div class="row">
          	<?php 
			 $mawardedto=project_awarded_to($prjDetails['prjId']);
			if(get_project_feedback_1($prjDetails['prjId'],$mawardedto['awardedto']))
			{
					?>
           
            <?php $userReview=get_project_feedback_1($prjDetails['prjId'],$mawardedto['awardedto']);
						
			?>
          
          <div class="col-md-10" style="margin-bottom: 20px;">
		 	<h4><?php echo get_user_name($mawardedto['awardedto']); ?></h4>
		 	<?php if($userReview['feedback'])
			{
				echo $userReview['feedback'];
			}
			?>
			<Br/>
			<div class="pull-left">
			<?php
			$prjRating=$userReview['rating'];
			
		    for($t=$prjRating;$t<5;$t++) 
			{
			 ?>
		        <img src="<?php echo $serverpath;?>images/star_2.png" style="margin-top: 0px;"/>
		     <?php
			}
		   for($t=0;$t<$prjRating;$t++)
			{
			?>
		        <img src="<?php echo $serverpath;?>images/star_1.png" style="margin-top: 0px;"/>
			<?php
			}
			?>
			</div>
          </div>
          
          <?php 
			}
			if(get_project_feedback_1($prjDetails['prjId'],$prjDetails['userId']))
			{
				?>
            
            <?php $userReview=get_project_feedback_1($prjDetails['prjId'],$prjDetails['userId']);
						
			?>


          <div class="col-md-10" >
          	 
		 	<h4><?php echo get_user_name($prjDetails['userId']); ?></h4>
		 	<?php if($userReview['feedback'])
			{
				echo $userReview['feedback'];
			}
			?>
			<Br/>
			<div class="pull-left">
			<?php
			$prjRating=$userReview['rating'];
			
		    for($t=$prjRating;$t<5;$t++) 
			{
			 ?>
		        <img src="<?php echo $serverpath;?>images/star_2.png" style="margin-top: 0px;"/>
		     <?php
			}
		   for($t=0;$t<$prjRating;$t++)
			{
			?>
		        <img src="<?php echo $serverpath;?>images/star_1.png" style="margin-top: 0px;" />
			<?php
			}
			?>
			 </div>	
     
          <?php 
			}
		  ?>

  
       
       </div>          
    </div>


		</div>
</section>
<br/>
<?php	
	   }
}else
	{
		?>
        <div class="clearfix"></div>
        <br/>
		<p class="mandatory">Sorry, there are no Gigs completed by you yet.</p>
                 <br/>
                <div class="clearfix"></div>
		<?php
	}
?>  </section>
    <?php include('footer.php'); ?>
  </body>
</html>