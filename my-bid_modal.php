<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 

$projectId=filter_text($_GET['projectId']);
$biderid=filter_text($_GET['biderid']);
$opengig=get_gig_details($projectId);
?>

<div class="container">
  <div class="col-md-12">
    <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>submitproposal" role="form" method="post">
      <input type="hidden" id="projectId" name="projectId" value="<?php echo $opengig['prjId'];?>" />
      <input type="hidden" name="bidfrom" id="bidfrom" value="<?php echo $biderid; ?>" />
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
          <div class="col-sm-12 ">
            <button type="submit" class="btn bid-now-btn">Bid Now</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
