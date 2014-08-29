<div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-5">
        <div class="sha table-list">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Upload Type</th>
                <th>Due Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php getUploads(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="sha table-list">
          <div class="table-responsive">
            <h2>Files Uploaded</h2>
            <div id="addUploads">
              <?php getUploadedCW_st($currentUser,0)?>
            </div>
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
          <h2>Upload File</h2>
          <form role="form" id="cwForm" action="inc/view.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <div class="col-xs-12">
                <input type="hidden" name="UploadTitle" id="UploadTitle" value="" />
                <input type="hidden" name="uploadDate" id="uploadDate" value="" />
                <label for="exampleInputFile">File input</label>
                <input type="file" name="FileInput" id="FileInput" />
              </div>
            </div>
            <div class="form-group btn-sect">
              <div class="col-xs-10">
                <button type="submit" class="btn btn-success">Upload</button>
                <a href="" class="btn btn-danger cancel-upload">Cancel</a> </div>
            </div>
          </form>
          <div class="clear"></div>
          <div class="form-group" style="margin-top:30px;">
            <div class="col-xs-12"> 

              <div class="progress hide" id="progressbox">
                <div id="progressbar" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"> <span id="statustxt">0%</span> </div>
              </div>
              <!--/ progress -->
              <div class="clear"></div>
              <div id="output">
                <p></p>
              </div>
            </div>
          </div>
          <!--/ row --> 
          
        </div>
      </div>
    </div>
  </div>
  <!--/ modal-holder --> 
  