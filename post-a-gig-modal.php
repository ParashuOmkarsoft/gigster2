<div id="postgigmodel" class="modal fade  bs-example-modal-lg modelw " tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <section class="postgigform" id="postgigform">
        <h2 id="login1">Post a Gig </h2>
        <h2 class="source">Get help for anything and post a new Gig for free.</h2>
        <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>saveGig" role="form" method="post" id="postform" target="targetframe" >
          <div class="form-group">
              <div class="col-md-2">
              <label for="creategig" class="col-sm-2 control-label labelb">Title</label>
              </div>
            <div class="col-sm-9" style="padding-left: 12px;margin-left: 35px;">
             <input type="text" required class="form-control" id="prjTitle" name="prjTitle" placeholder="Add a headline for your Gig" maxlength="45" style="width: 70%;padding-left: 12px;">
            </div>
          </div>    
              <div class="form-group">
              <div class="col-md-2">
              <label for="gigdescription" class="col-sm-2 control-label dis ">Description</label>
            </div>  
            <div class="col-sm-9" style="padding-left:12px;margin-left: 35px;">
              <textarea class="form-control" id="prjdesc" name="prjdesc" placeholder="Details about your Gig" row="5" column="10"  style="height: 150px;padding-left: 12px;"></textarea>
            </div>
          </div>      
          <h2 class="loginlead" id="mlabel" title="Leave blank if you'd like the Gigster to quote">How much would you like to pay?</h2>
          <div class="form-group">
          <div class="col-sm-12">
            <div class="col-sm-3" style="padding:0px;">
              <input type="text" name="proposedprice" id="proposedprice" class="form-control"  placeholder="" onKeyDown="return only_numbers(event);" title="Leave blank if you'd like the Gigster to quote">
            </div>  
              <label class="radio-inline" style="line-height:22px;">

                <input type="radio" name="jobtype[]" id="jobtype"  value="f"  onChange="change_caption('f')" checked="checked">
               <span class="check-btn">Per Gig </span> </label>
              <label class="radio-inline"style="line-height:22px;">
                <input type="radio" name="jobtype[]" id="jobtype" value="h"  onChange="change_caption('h')">
                <span class="check-btn">Per Hour</span> </label>
            </div>
            
          </div>
          <h2 class="loginlead" >Skills you require</h2>
          <div class="form-group">
            <div class="col-sm-10">
              <input  required type="hidden" name="keywords" id="keywords"  class=""    />
            </div>
          </div>
          <h2 class="loginlead">Select expiry date of your Gig</h2>
          <div class="form-group">
            <div class="col-sm-10">
              <input type="text" id="datepic"style="width:47%" name="enddate" class="mdatepicker" value="<?php echo date('d/m/Y',time() + (24*3600*7));?>"/>
              <script type="text/javascript">
          $(document).ready(function(){
          var nowTemp = new Date();
          var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
          var checkin = $('.mdatepicker').datepicker({
               format: 'dd/mm/yyyy',
                 onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
                 }
               }).on('changeDate', function(ev) {
                
                 checkin.hide();   
               }).data('datepicker');
           
                });
         </script> 
            </div>
          </div>
          <?php $tags=get_tags();
            $tags=implode(",",$tags);
            ?>
          <script type="text/javascript">$("#keywords").select2({tags:[<?php echo strtolower($tags);?>]});</script>
        <?php /*?>  <h2 class="loginlead">Would you like to invite your favourite Gigsters to bid?</h2>
          <div class="form-group">
            <div class="col-sm-12 ">
              <label class="radio-inline" style="line-height:22px;padding:0px;">
                <input type="radio" name="inviteusers[]" id="inviteusers"   value="0"  checked >
                <span class="check-btn">No, please select Gigsters for me</span></label>
              <label class="radio-inline" style="line-height:22px;padding:0px;">
                <input type="radio" name="inviteusers[]" id="inviteusers"   value="1">
                <span class="check-btn">Yes, I will select which Gigsters to bid</span> </label>
            </div>
          </div>
          <div class="form-group submit">
            <button type="submit" class="btn btn-warning">Post Gig</button>
          </div><?php */?>
        </form>
      </section>
      &nbsp;
      <section class="postgigform mhidden" id="inviteform" style="min-height:400px;overflow:auto;"> </section>
    </div>
  </div>
</div>

