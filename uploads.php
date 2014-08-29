<?php require "inc/header.php";?>
<?php require "inc/side.php";?>
<div id="main-container">

<?php
//check if user is admin
if(is_admin($uEmail)) {
//show admin template
  	require "template/tutor_uploads.php";
}else{
//show student template 
	require "template/student_uploads.php";
} 
?>

</div>
<!--/ main-container -->

<?php require "inc/footer.php";?>
