<div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="alert alert-success alert-dismissable hide">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Meeting Requested!</strong>
        </div>
       
      	<p class="marginBtm30"><a href="" class="btn btn-success request-meeting">Request a meeting</a></p>
        
        <div class="box sha">
          <div class="table-responsive" id="addMeetings">
            <?php getMeeting_st($currentUser,0)?>
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
          <h2>Meeting Request</h2>
          <form role="form" id="meeting-form">
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Meeting Type</label>
              <div class="col-xs-12 col-md-4 marginBtm30">
                <select class="form-control type required">
                  <option value="none" selected="selected"> -- Select Meeting Type -- </option>
                  <option value="Virtual">Virtual</option>
                  <option value="Real">Real</option>
                </select>
              </div>
            </div>
            <!--/ form-group-->
            
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Agenda</label>
              <div class="col-sm-8">
                <textarea class="form-control marginBtm30 agenda required" placeholder="Enter Your Agenda..."></textarea>
              </div>
            </div>
            <!--/ form-group-->
            
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Meeting Date</label>
              <div class="col-sm-4">
                <input type="text" class="form-control marginBtm30 required" id="datepicker" placeholder="Select Meeting Date" />
              </div>
            </div>
            <!--/ form-group-->
            
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Meeting Time</label>
              <div class="col-sm-10">
                <div class="row">
                  <div class="col-xs-2">
                    <select id="OutwardHour" name="OutwardHour" class="form-control marginBtm30 required">
                      <?php $x = 9; while($x <= 17): ?>
                      <option value="<?php if($x < 10){ echo '0'.$x; }else{echo $x;}?>" title="">
                      <?php if($x < 10){ echo '0'.$x; }else{echo $x;}?>
                      </option>
                      <?php $x++; endwhile; ?>
                    </select>
                  </div>
                  <span class="pull-left">:</span>
                  <div class="col-xs-2">
                    <select id="OutwardMinute" name="OutwardMinute" class="form-control required">
                      <option value="00" id="OutwardMinute00" selected="selected">00</option>
                      <option value="30" id="OutwardMinute15">30</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!--/ form-group-->
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10 marginBtm30">
                <button type="submit" class="btn btn-success">Book</button>
                <a href="" class="btn btn-danger cancel-modal">Cancel</a> </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ modal-holder --> 