<div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="alert alert-success alert-dismissable hide">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Meeting Actioned!</strong>
        </div>
        
        <div class="box sha">
          <div class="table-responsive" id="pendingMeetings">
            <h2>Request Pending</h2>
            <?php getMeeting_tu($currentUser,0)?>
          </div>
        </div>
      </div>
      <!--/ col-xs-12 --> 
    </div>
    
    
    <div class="row">
      <div class="col-xs-12">
        
        <div class="box sha">
          <div class="table-responsive" id="updateMeetings">
            <?php getMeeting_tu($currentUser,0,'Accepted')?>
          </div>
        </div>
      </div>
      <!--/ col-xs-12 --> 
    </div>
  </div>
  <!--/ container --> 

  <div class="modal-holder cancel-modal">
    <div class="modal-container">
      <div class="row">
        <div class="col-xs-12">
          <h2>Meeting Update</h2>
          <form role="form" id="meeting-update"> 
          <input type="hidden" id="meetID" />          
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Details</label>
              <div class="col-sm-8">
                <textarea class="form-control marginBtm30 details" placeholder="Enter Details..."></textarea>
              </div>
            </div>
            <!--/ form-group-->
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10 marginBtm30">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="" class="btn btn-danger cancel-modal">Cancel</a> </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--/ modal-holder --> 