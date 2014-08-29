<?php require "inc/header.php";?>
<?php require "inc/side.php";?>
<div id="main-container" class="upload-page">

  <div class="container">
    <div class="row">
      <div class="col-xs-12"><!-- marginBtm30 -->
      <div class="alert alert-success alert-dismissable hide">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Meeting Requested!</strong>
        </div>
        
        <?php if(is_superAdmin()){ ?>
         <div class="box sha">
          <h2>Average number of messages</h2>
          <div id="chart"> <svg></svg> </div>
          <script src="js/lib/d3.v3.js"></script> 
          <script src="js/nv.d3.js"></script> 
          <script src="js/src/tooltip.js"></script> 
        </div>
        <!--/ box --> 
           <?php } ?>
      </div>
      <!--/ col-xs-12 -->
      
      <div class="col-xs-12">
      	
        
        <div class="box sha">
         
          <div class="form-filter">
            <form class="form-inline" role="form">
             <?php if(is_superAdmin()){ ?>
              <div class="form-group">
             <a href="" class="btn btn-success addIdList">Allocate Tutor</a>
              </div>
             <?php } ?>
               
               <div class="form-group"> <label><strong>Filter:</strong></label></div>
              <div class="form-group"> 
                <select class="form-control" id="day-filter">
                <option value="none" selected> -- Inactive Days Filter -- </option>
                  <option value="7">Inactive for 7 days</option>
                  <option value="28">Inactive for 28 days</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" id="message-fliter">
                  <option value="none"> -- Message Filter -- </option>
                  <option value="lastMsgSeven">Messages in the last 7 days</option>
                </select>
              </div>
               <?php if(is_superAdmin()){ ?>
              <div class="form-group">
                <select class="form-control" id="tutor-filter">
                  <option value="none"> -- Tutor Filter -- </option>
                  <option value="notutor">Without Tutor</option>
                  <option value="all">Show All</option>
                </select>
              </div>
              <?php } ?>
              
              <div class="form-group">
             <a href="" class="btn btn-default reset-filter">Reset Filter</a>
              </div>
              
            </form>
          </div>
          <div class="table-responsive" id="tutorStudentList">
            <?php listAllStudents($currentUser); ?>
          </div>
        </div>
      </div>
      <!--/ box --> 
    </div>
    <!--/ col-xs-12 --> 
  </div>
</div>
<!--/ container -->
</div>
<!--/ main-container -->

<div class="modal-holder cancel-modal">
    <div class="modal-container">
      <div class="row">
        <div class="col-xs-12">
          <h2>Allocate Tutor</h2>
          <form role="form" id="tutor-form">
          <input type="hidden" id="studIds" />
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Select tutor</label>
              <div class="col-xs-12 col-md-4 marginBtm30">
                <select class="form-control tutorOptionID">
                  <option value="none" selected="selected"> -- Select Tutor -- </option>
                 <!-- <option value="0">No Tutor</option> -->
                  <?php echo getTutorOptionList();?>
                </select>
              </div>
            </div>
            <!--/ form-group-->
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10 marginBtm30">
                <button type="submit" class="btn btn-success">Allocate</button>
                <a href="" class="btn btn-danger cancel-modal">Cancel</a> </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ modal-holder --> 

<?php require "inc/footer.php";?>
