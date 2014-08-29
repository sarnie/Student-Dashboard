<div id="loadChecker"> <img src="img/gif-load.gif" /></div>
<div id="main-container">
  <div class="container">
  	  <div class="row marginBtm30">
          <div class="col-md-6">
             
          <form role="form">
              <div class="form-group">
                <label>Select Student:</label>
                  <select class="form-control" id="optionStudent"> 
                    <option> -- Select Student -- </option>
                    <?php echo studentDropDown(); ?>  
                  </select>
              </div>
          </form> 
          </div>
           <div class="col-md-6">
           </div>
     </div><!--/ row -->
      
    <div class="row">
      <div class="col-md-6">
        <div class="box sha">
        <?php 
        if(isset($_GET['id'])){
           $stuID = $_GET['id'];
           $stuEmail = getStudentEmail($_GET['id']);
        }else{
           $stuID = 3;
           $stuEmail = getStudentEmail(3);
        }
        ?>
          <h2><span class="glyphicon glyphicon-time"></span> Meetings 
            <span class="title-txt">
            <?php  getLastMeetingDate($stuID); ?>
            </span></h2>
          <div class="table-responsive">
            <table class="table table-striped m-table">
              <tbody>
                <?php  getMeetingSummary($stuID); ?>
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
            <?php toMessageSummary($stuEmail);?>
          </div>
          <p class="the-div hidden-xs"></p>
          <div class="text-center count-box pull-left m-marginBtm">
            <?php fromMessageSummary($stuEmail); ?>
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
                <?php echo getLastThreePost($stuID);?>
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
              <?php getUploadedCWSummary($stuID);?>
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
<?php if(is_superAdmin()){?>
<div id="tutor-box" class="text-center">
  <div class="row">
    <div class="col-xs-12">
      <h3>Personal Tutor</h3>
      <?php echo getStudentTutorSummary($stuID); ?>
    </div>
  </div>
</div>
<?php } ?>

