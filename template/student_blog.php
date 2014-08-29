  <div class="half post-list">
    <h2 class="clearfix">
      <span class="change-title" data-new-txt="Enter New Blog Post" data-current-txt="Post">Post</span> 
      <span class="btn btn-success pull-right visible-xs m-marginRight10 m-viewWrite" data-new-txt="Cancel" data-current-txt="New Post">New Post</span></h2>
    <div class="post-wrap">
      <div class="post-container" id="blog-container"> </div>
    </div>
  </div>
  <!--/ half -->
  
  <div class="half pull-right post-write s-height hidden-xs">
    <h2 class="no-btm-border hidden-xs">Enter New Blog Post</h2>
    <div class="form-wrap">
      <form role="form" id="add-post">
        <div class="form-group">
          <input type="hidden" value="3" name="userid" id="userid" />
          <label class="control-label hide" for="inputWarning1"></label>
          <textarea class="form-control" rows="10" placeholder="Enter your post.." id="bp"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Publish</button>
        </div>
      </form>
    </div>
  </div>
