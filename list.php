<?php require "inc/header.php";?>
<?php require "inc/side.php";?>
<div id="main-container" class="list-page">

  <div class="container">
    <div class="row">      
      <div class="col-xs-12">
        <div class="box sha">
          <div class="form-filter">
            <form class="form-inline" role="form">
              <div class="form-group">
                <select class="form-control">
                  <option>Inactive for 7 days</option>
                  <option>Inactive for 28 days</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control">
                  <option>Messages in the last 7 days</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control">
                  <option>Without Tutor</option>
                  <option>Show All</option>
                </select>
              </div>
              <button type="submit" class="btn btn-default">Filter</button>
            </form>
          </div>
          <div class="table-responsive">
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

<?php require "inc/footer.php";?>
