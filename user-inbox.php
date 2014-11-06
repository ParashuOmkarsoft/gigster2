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
        <div id="our">Inbox</div>
        <div></div>
<?php 
 $query="select * from btr_messages where msgto=".$uInfo['userId']." order by msgId DESC";

$sql=@db_query($query);
if($sql['count']>0)
{


?>
<table class="table table-striped" id="mydatatable">
<thead>
  <tr>
    <th>#</th>
    <th>Gig Title</th>
    <th>From</th>
    <th>Message</th>
    <th>Sent On</th>

  </tr>
  <?php
  $sno=1;
	$mprojects="";
	$mcount=0;
  for($i=0;$i<$sql['count'];$i++)
  {
	if(in_array($sql['rows'][$i]['projectId'],$mprojects))
	{
	}
	else
	{
			
	    $prjDetails=get_gig_details($sql['rows'][$i]['projectId']);
		if($prjDetails['prjId'])
		{	  
	  	$mprojects[$mcount]=$sql['rows'][$i]['projectId'];
		$fromdetails=get_user_Info(encrypt_str($sql['rows'][$i]['msgfrom']));
		$nametodisplay=$fromdetails['fname']." ".$fromdetails['lname'];
	$nametodisplay1=str_replace(" ","",$nametodisplay);
	if(!$nametodisplay1)
	{
		$nametodisplay=$fromdetails['username'];
	}
	$st="";
	if($sql['rows'][$i]['isread'])
	{
		$st="style='font-weight:bold'";
	}
	else
	{
		$st="";
	}
	  ?>
      
	  <tr <?php echo $st;?>>
      	<td><?php echo $sno;?></td>
		<td><a href="<?php echo $serverpath;?>messagethread/<?php echo $sql['rows'][$i]['msgId'];?>"><?php echo $prjDetails['prjTitle'];?></a> </td>                
		<td><?php echo $nametodisplay;?></td> 
        <td><?php echo strip_string($sql['rows'][$i]['msgcontent'],50);?></td>
        <td><?php echo get_time($sql['rows'][$i]['msgon']);?></td>                                               
      </tr>
	  <?php
	
	  $sno++;
		}
	}
  }
  ?>
  </thead>
  </table>
<?php  }
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