<?php require "inc/header.php";?>
<?php require "inc/side.php";?>
<div id="main-container" class="meeting-page">
  
<?php 
  if(is_admin($uEmail)) {
  	require "template/tutor_meeting.php";
  }else{
  	require "template/student_meeting.php";
  }
?>
  
</div>
<!--/ main-container -->

<?php require "inc/footer.php";?>
