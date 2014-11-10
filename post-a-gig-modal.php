
<div id="postgigmodel" class="modal fade  bs-example-modal-lg modelw " tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <section class="postgigform" id="postgigform">
        <h2 id="login1">Post a Gig </h2>
        <h2 class="source">Post a new Gig for free. Invite Gigsters to bid on your gig.</h2>
        <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>saveGig" role="form" method="post" id="postform" target="targetframe" >
          <div class="form-group">
            <label for="creategig" class="col-sm-2 control-label labelb">Title</label>
            <div class="col-sm-10">
              <input type="text" required class="form-control" id="prjTitle" name="prjTitle" placeholder="Add title for you gig" >
            </div>
          </div>
          <div class="form-group">
            <label for="gigdescription" class="col-sm-2 control-label dis ">Description</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="prjdesc" name="prjdesc" placeholder="Describe your gig" row="5" column="10"  style="height: 150px;"></textarea>
            </div>
          </div>
          <h2 class="loginlead" >Would you like the job to be hourly or fixed ?</h2>
          <div class="form-group">
            <div class=" col-sm-10 ">
              <label class="radio-inline">
                <input type="radio" name="jobtype[]" id="jobtype"  value="h"  onChange="change_caption('h')">
                Hourly </label>
              <label class="radio-inline">
                <input type="radio" name="jobtype[]" id="jobtype" value="f" checked="checked" onChange="change_caption('f')">
                Fixed Price </label>
            </div>
          </div>
          <h2 class="loginlead" id="mlabel">Whats the best fix price you intend to pay ?</h2>
          <div class="form-group">
            <div class="col-sm-10">
              <input  required style="width:30%" type="text" name="proposedprice" id="proposedprice" class="form-control"  placeholder="" onKeyDown="return only_numbers(event);">
            </div>
          </div>
          <h2 class="loginlead" >Skills</h2>
          <div class="form-group">
            <div class="col-sm-10">
              <input  required type="hidden" name="keywords" id="keywords"  class=""    />
            </div>
          </div>
          <h2 class="loginlead">Enter expiry date of your Gig</h2>
          <div class="form-group">
            <div class="col-sm-10">
              <input type="text" id="datepic"style="width:47%" name="enddate" class="mdatepicker"/>
            </div>
          </div>
          <?php $tags=get_tags();
						$tags=implode(",",$tags);
						?>
          <script type="text/javascript">$("#keywords").select2({tags:[<?=$tags;?>]});</script>
          <h2 class="loginlead"> Would you like to invite any Gigster’s for your project ?</h2>
          <div class="form-group">
            <div class="col-sm-10 ">
              <label class="radio-inline">
                <input type="radio" name="inviteusers[]" id="inviteusers"  value="1">
                Yes </label>
              <label class="radio-inline">
                <input type="radio" name="inviteusers[]" id="inviteusers"  value="0">
                No </label>
            </div>
          </div>
          <div class="form-group submit">
            <button type="submit" class="btn btn-warning">Post Gig</button>
          </div>
        </form>
      </section>
      &nbsp;
      <section class="postgigform mhidden" id="inviteform" style="min-height:400px;overflow:auto;">
        
      </section>
    </div>
  </div>
</div>
