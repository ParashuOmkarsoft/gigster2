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
  <tr style="background: rgb(255, 217, 141);">
    <th><h5 class="table-head">#</h5></th>
    <th><h5 class="table-head">Gig Title</h5></th>
    <th><h5 class="table-head">From</h5></th>
    <th><h5 class="table-head">Message</h5></th>
    <th><h5 class="table-head">Sent On</h5></th>
	 <th><h5 class="table-head">&nbsp;</h5></th>
  </tr>
  </thead>
  <tbody class="table-head">
  <?php
  $sno=1;
	$mprojects="";
	$mcount=0;
	$mstr="";
  for($i=0;$i<$sql['count'];$i++)
  {
	  $mstr=$sql['rows'][$i]['projectId']."-".$sql['rows'][$i]['msgfrom'];
	if(in_array($mstr,$mprojects))
	{

	}
	else
	{
			
	    $prjDetails=get_gig_details($sql['rows'][$i]['projectId']);
		if($prjDetails['prjId'])
		{	  
	  	$mprojects[$mcount]=$mstr;
		$fromdetails=get_user_Info(encrypt_str($sql['rows'][$i]['msgfrom']));
		$nametodisplay=$fromdetails['fname']." ".$fromdetails['lname'];
		$nametodisplay1=str_replace(" ","",$nametodisplay);
		if(!$nametodisplay1)
		{
			$nametodisplay=$fromdetails['username'];
		}
		$st="";
		$jj=user_replied($prjDetails['prjId'],$uInfo['userId'],$sql['rows'][$i]['msgId']);
		
		
		if($sql['rows'][$i]['isread'])
		{
			$st="style='background: rgb(255, 244, 219);'";
		}
		else
		{
			$st="style='background: rgb(255, 244, 219);'";
		}
	
	  ?>
      
	  <tr <?php echo $st;?> >
      	<td ><?php echo $sno;?></td>
		<td valign="top"><a href="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_encode($prjDetails['prjTitle']);?>/<?php echo $prjDetails['prjId'];?>"><?php echo $prjDetails['prjTitle'];?></a>
       
        </td>                
		<td><?php echo $nametodisplay;?></td> 
        <td><a href="#messagemodal" data-toggle="modal" onClick="view_message_modal('<?php echo $serverpath;?>','<?php echo $sql['rows'][$i]['msgId'];?>');"><?php echo strip_string(html_entity_decode($sql['rows'][$i]['msgcontent']),50);?></a></td>
        <td><?php echo get_time($sql['rows'][$i]['msgon']);?></td>     
        <td> <?php if($jj)
		{
			?>
            <span align="right">
			<i class="fa fa-mail-reply" title="You replied" style="cursor:pointer;"></i>
            </span>
            <?php 
		}
		else
		{
			?>
			<span align="right" style="visibility:hidden;">
			<i class="fa fa-mail-reply" title="You replied" style="cursor:pointer;"></i>
            </span>
			<?php
			
		}
		?>
       <a href="<?php echo $serverpath;?>delthread/<?php echo $sql['rows'][$i]['msgId'];?>" target="targetframe" > <i class="fa fa-ban" title="Remove Complete Thread" style="cursor:pointer;color:red;"></i></a>
        </td>                                          
      </tr>
	  <?php
	
	  $sno++;
		}
	}
  }
  ?>
  </body>
  </table>
<?php  }
else
{
	?>
	<p class="mandatory">Sorry , No messages for you.</p>
	<?php
}
?>
     </section>
<?php  ?>
<?php include('footer.php'); ?>
  </body>
</html>