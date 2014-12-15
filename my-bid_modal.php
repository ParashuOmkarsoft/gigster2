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
    <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>submitproposal" role="form" method="post" onsbumit="return validate_biding();">
      <input type="hidden" id="projectId" name="projectId" value="<?php echo $opengig['prjId'];?>" />
      <input type="hidden" name="bidfrom" id="bidfrom" value="<?php echo $biderid; ?>" />
      <h2 id="login1" style="padding-left: 11px;">Bid On Gig </h2>
      <h2 class="source" style="padding-left: 15px;font-size:22px; "><?php echo my_ucwords($opengig['prjTitle']);?></h2>
            <h2 class="source" style="padding-left: 15px;font-size:18px; ">Proposed budget : <?php if($opengig['proposedbudget']>0){ echo ($opengig['proposedbudget']);?> <?php echo $currency; if($opengig['jobtype']=="h") { ?>&nbsp;per hour<?php }} else{ echo "Gigster's price";} ?></h2>
<Br/>
      <div class="col-md-12">
        <div class="form-group">
        <label class="tooltips" href="#">Bid Details
        <span>Tooltip</span></label>>  
          <label for="inputText" class="col-sm-4 control-label newlog">Bid Details</label>
          <br/>
          <br/>
          <div class="col-sm-12">
            <textarea class="form-control tinpute mtextarea" placeholder="Bid Details" row="10" column="10" required name="proposal" id="proposal" style="width:400px;height:150px;" title="Other than price,sending more information usually helps.For Example, How long gig will take oe when you are available etc."></textarea>
          </div>
        </div>
        <div class="form-group">
          <?php if($opengig['jobtype']=="f") { ?>
          <label class="col-md-6 control-label tfont">Bid Price</label>
          <?php } else { ?>
          <label class="col-md-6 control-label tfont">Bid Price per hour</label>
          <?php } ?>
          <Br/>
          <br/>
          <div class="col-md-8">
            <input type="text"  required="required" class="form-control" id="pprice" name="pprice" onKeyDown="return only_numbers(event);" required />
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
