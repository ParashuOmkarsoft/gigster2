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
      <h2 id="giglog">My Gigs</h2>

/* -- This is amol c -- */


 $uId=$_SESSION['uId'];
 $userInfo=get_user_Info($uId);

 if($userInfo)
	 {
		 $uId=$userInfo['userId'];
	 }
 $all=$_GET['all'];
 if(!$all)
	 {
		$all='0';
	 }
 $gigs=get_all_projects($uId,$all);
 if($gigs['count']>0)
	{

?>
<div class="box">
<div class="box-body table-responsive">
<?php
 if($all)
	{

?>
<table class="table table-bordered table-striped" id="mydatatable">
<thead>
  <tr>
    <th>#</th>
    <th>Title</th>
    <th>Owner</th>
    <th>Proposed Price (<i class="fa fa-dollar"></i> )</th>
    <th>Bid Closing On</th>
    <th>Status</th>
  </tr>
  </thead>
  <tbody>
  <?php
	$sno=1;
	for($i=0;$i<$gigs['count'];$i++)
	{
		$muInfo=get_user_Info(encrypt_str($gigs['rows'][$i]['userId']));

  ?>
  <tr>
    <td><?php echo $sno++;?></td>
    <td><a href="<?php echo $serverpath;?>viewGig/<?php echo mera_url_encode($gigs['rows'][$i]['prjTitle']);?>/<?php echo $gigs['rows'][$i]['prjId'];?>" data-slidepanel="panel" onclick="view_proposals(<?php echo $serverpath;?>,'<?php echo $gigs['rows'][$i]['prjId'];?>');"> <?php echo ($gigs['rows'][$i]['prjTitle']); ?> </a></td>
    <td><a href="<?php echo $serverpath;?>viewgigster/<?php echo $muInfo['username'];?>/<?php echo ($muInfo['userId']);?>" ><?php echo $muInfo['username']; ?></a></td>
    <td><?php echo ($gigs['rows'][$i]['proposedbudget']); ?></td>
    <td><?php echo ($gigs['rows'][$i]['bidto']); ?></td>
    <td><?php echo get_p_status($gigs['rows'][$i]['prjId']); ?></td>
  </tr>
  <?php
	}
	?>
    </tbody>
</table>
<?php
}
else
{
	?>
	<table class="table table-bordered table-striped" id="mydatatable">
<thead>
  <tr>
    <th>#</th>
    <th>Title</th>
    <th>Selected Gigster</th>
    <th>Price (<i class="fa fa-dollar"></i> )</th>
    <th>Due Date</th>
    <th>Status</th>
  </tr>
  </thead>
  <tbody>
  <?php
	$sno=1;
	for($i=0;$i<$gigs['count'];$i++)
	{
		$muInfo=get_user_Info(encrypt_str($gigs['rows'][$i]['userId']));
		$isawarded=get_project_winner_details($gigs['rows'][$i]['prjId']);
  ?>
  <tr>
    <td><?php echo $sno++;?></td>
    <td><a href="<?php echo $serverpath;?>viewGig/<?php echo mera_url_encode($gigs['rows'][$i]['prjTitle']);?>/<?php echo $gigs['rows'][$i]['prjId'];?>" data-slidepanel="panel" onclick="view_proposals(<?php echo $serverpath;?>,'<?php echo $gigs['rows'][$i]['prjId'];?>');"> <?php echo ($gigs['rows'][$i]['prjTitle']); ?> </a></td>
    <td><?php echo get_project_winner_name($gigs['rows'][$i]['prjId']); ?></td>
    <td><?php
	if($isawarded['amount'])
	{
		echo $isawarded['amount'];
	}
	else
	{
	 echo ($gigs['rows'][$i]['proposedbudget']);?>(Proposed Budget)<?php
	}
	  ?></td>
    <td><?php
		if($isawarded['completiondate'])
		{
			echo $isawarded['completiondate'];
		}
		else
		{
	echo ($gigs['rows'][$i]['bidto']);
		}
	?></td>
    <td><?php echo get_p_status($gigs['rows'][$i]['prjId']); ?></td>
  </tr>
  <?php
	}
	?>
    </tbody>
</table>
	<?php
}
?>
</div>
</div>
<?php
}
else
{
?>
<br/>
<div class="alert alert-danger">Sorry , No gigs right now.</div>
<div class="clearfix"></div>
</div>
<?php
}
?>
</div>

/* -- Amol C -- */






     </section>
    <?php include('footer.php'); ?>
  </body>
</html>



