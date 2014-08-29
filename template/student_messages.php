<div class="half post-list">
    <h2 class="clearfix">
      <span class="change-title" data-new-txt="Enter New Message" data-current-txt="Messages">Messages</span> 
      <span class="btn btn-success pull-right visible-xs m-marginRight10 m-viewWrite" data-new-txt="Cancel" data-current-txt="New Message">New Message</span>
    </h2>
    
    <ul id="myTab" class="nav nav-pills nav-justified">
      <li class="active"><a href="#inbox" data-toggle="tab" class="noBorderRad"><span class="glyphicon glyphicon-inbox"></span> Inbox</a></li>
      <li><a href="#outbox" data-toggle="tab" class="noBorderRad"><span class="glyphicon glyphicon-send"></span> Sent</a></li>
    </ul>
    
    <div class="post-wrap">
      <div class="tab-content">
      
        <div class="post-container tab-pane fade in active" id="inbox">
        	<?php getInboxMessage($uEmail);?>
        </div><!--/inbox-->
      
       <div class="post-container tab-pane fade in" id="outbox">
          <?php getOutboxMessage($uEmail);?>
      </div><!--/outbox-->
     
    
  </div> <!--/tab-content --> 
  </div> <!--/post-wrap --> 
  
</div>
<!--/ half -->

<div class="half pull-right post-write s-height hidden-xs">
 <div class="alert alert-success alert-dismissable hide">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Message Sent!</strong>
  </div>
          
  <h2 class="no-btm-border hidden-xs">Add a message</h2>
  <div class="form-wrap">
    <form class="form-horizontal" role="form" id="msgForm">
       <input type="hidden" id="eSlist" value="<?php echo getStaffEmail();?> " />
      <div class="form-group">
        <div class="col-xs-12">
          <textarea class="form-control" rows="10" placeholder="Enter the Message" id="messageText"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-success">Send</button>
        </div>
      </div>
    </form>
  </div>
</div>