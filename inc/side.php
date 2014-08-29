<aside id="side-nav">
  <ul class="list-unstyled">
    <li <?php if(getPageType() == 'home'){echo 'class="active"';}?>><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> <span class="link-txt">Dashboard</span></a></li>
    <?php if(!is_superAdmin()){ ?>
    <li <?php if(getPageType() == 'blog'){echo 'class="active"';}?>><a href="blog.php"><span class="glyphicon glyphicon-comment"></span> <span class="link-txt">Blog</span></a></li>
    <li <?php if(getPageType() == 'meetings'){echo 'class="active"';}?>><a href="meetings.php"><span class="glyphicon glyphicon-time"></span> <span class="link-txt">Meetings</span></a></li>
    <li <?php if(getPageType() == 'messages'){echo 'class="active"';}?>><a href="messages.php"><span class="glyphicon glyphicon-envelope"></span> <span class="link-txt">eMessages</span></a></li>
    <li <?php if(getPageType() == 'uploads'){echo 'class="active"';}?>><a href="uploads.php"><span class="glyphicon glyphicon-download-alt"></span> <span class="link-txt">Uploads</span></a></li>
    <?php } ?>
   	<?php if(is_admin($uEmail)) : ?>
    	<li <?php if(getPageType() == 'stats'){echo 'class="active"';}?>><a href="stats.php"><span class="glyphicon glyphicon-stats"></span> <span class="link-txt">Stats</span></a></li>
    <?php endif; ?>
     
  </ul>
</aside>
