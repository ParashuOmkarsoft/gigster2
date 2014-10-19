<section class="content-header">
  <h1>Gigs Assigned To Me</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $serverpath;?>dashboard"><i class="fa fa-dashboard"></i> My Account</a></li>
    <li class="active">Gigs Assigned</li>
  </ol>
</section>


<div class="box-body table-responsive no-padding" id="myGigs"> </div>
<script type="text/javascript">
	display_assigned_gigs('<?php echo $serverpath;?>');							  
</script>