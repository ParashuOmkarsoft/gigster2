<div id="postgigmodel" class="modal fade  bs-example-modal-lg modelw " tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
              <section class="postgigform ">                       
         <h2 id="login1">Post a Gig </h2>    
          <h2 class="source">Post a new Gig for free. Invite Gigsters to bid on your gig.</h2>                          
          <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>saveGig" role="form" method="post"  >
            <div class="form-group">
              <label for="creategig" class="col-sm-2 control-label labelb">Title</label>
              <div class="col-sm-10"> 
                <input type="text" required class="form-control" id="prjTitle" name="prjTitle" placeholder="Looking for a marriage photographer" >
              </div>
            </div>
            <div class="form-group">
              <label for="gigdescription" class="col-sm-2 control-label dis ">Description</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="prjdesc" name="prjdesc" placeholder="Describe your gig" row="5" column="10"></textarea>  
              </div>
            </div>
            <h2 class="loginlead">Would you like the job to be hourly or fixed ?</h2>
            <div class="form-group">
              <div class=" col-sm-10 ">
                <label class="radio-inline">
                  <input type="radio" name="jobtype[]" id="jobtype"  value="h" > Hourly
                </label>
                <label class="radio-inline">
                  <input type="radio" name="jobtype[]" id="jobtype" value="f" checked="checked">Fixed Price
                </label>                
              </div>
            </div>
            
            <h2 class="loginlead" id="mlabel">Whats the best hourly pricing you intend to pay ?</h2>
            <div class="form-group">
              <div class="col-sm-10">
                <input  required style="width:30%" type="text" name="proposedprice" id="proposedprice" class="form-control"  placeholder="">
              </div>
            </div>
            <h2 class="loginlead">Enter expiry date of your Gig</h2>
            <input type="text" id="enddate" gldp-id="mydate" name="enddate" style="width:30%"  required/>
   					<script type="text/javascript">
					  $(window).load(function()
				        {
				            $('#enddate').glDatePicker();
				        });
					</script>
            <h2 class="loginlead"> Would you like to invite any Gigster’s for your project ?</h2>
            <div class="form-group">
              <div class="col-sm-10 ">
                <label class="radio-inline">
                  <input type="radio" name="inviteusers[]" id="inviteusers"  value="y"> Yes
                </label>
                <label class="radio-inline">
                  <input type="radio" name="inviteusers[]" id="inviteusers"  value="n"> No
                </label>                   
              </div>            
              </div>
               <div class="form-group submit">
         			<button type="submit" class="btn btn-warning">Post Gig</button>
               </div>
               </form>
         </section>
      </div>
      </div>
    </div>