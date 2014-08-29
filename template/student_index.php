<div id="loadChecker"> <img src="img/gif-load.gif" /></div>
<div id="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="box sha">
          <h2><span class="glyphicon glyphicon-time"></span> Meetings 
            <span class="title-txt">
            <?php getLastMeetingDate($currentUser); ?>
            </span></h2>
          <div class="table-responsive">
            <table class="table table-striped m-table">
              <tbody>
                <?php getMeetingSummary($currentUser); ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- / box --> 
        
      </div>
      <!--/ col-md-6 -->
      
      <div class="col-md-6">
        <div class="box sha clearfix">
          <h2><span class="glyphicon glyphicon-envelope"></span> eMessages</h2>
          <div class="clear"></div>
          <div class="text-center count-box pull-left m-btmBorder">
            <?php toMessageSummary($uEmail);?>
          </div>
          <p class="the-div hidden-xs"></p>
          <div class="text-center count-box pull-left m-marginBtm">
            <?php fromMessageSummary($uEmail); ?>
          </div>
        </div>
        <!-- / box --> 
        
      </div>
      <!--/ col-md-6 -->
      
      <div class="col-md-6">
        <div class="box blog-sect sha">
          <h2><span class="glyphicon glyphicon-comment"></span> Blog</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Post</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?php echo getLastThreePost($currentUser);?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- / box --> 
        
      </div>
      <!--/ col-md-6 -->
      
      <div class="col-md-6">
        <div class="box sha">
          <h2><span class="glyphicon glyphicon-download-alt"></span> Uploads</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Content</th>
                  <th>Last Upload</th>
                </tr>
              </thead>
              <?php getUploadedCWSummary($currentUser);?>
            </table>
          </div>
        </div>
        <!-- / box --> 
        
      </div>
      <!--/ col-md-6 --> 
      
    </div>
  </div>
  <!--/ container --> 
  
</div>
<!--/ main-container -->

<div id="tutor-box" class="text-center">
  <div class="row">
    <div class="col-xs-12">
      <h3>Personal Tutor</h3>
      <?php echo getStudentTutorSummary($currentUser); ?>
    </div>
  </div>
</div>
