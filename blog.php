<?php require "inc/header.php";?>
<?php require "inc/side.php";?>
<div id="main-container" class="blog-page clearfix">

<?php //check if user is admin
  if(is_admin($uEmail)) {
	//show admin template
  	require "template/tutor_blog.php";
  }else{
	  
	//show student template 
  	require "template/student_blog.php";
  }
?>
  
</div>
<!--/ main-container -->
  

<?php require "inc/footer.php";?>
