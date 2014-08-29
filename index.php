<?php 
//Get the header
require "inc/header.php";

//Get the sidebar nav
require "inc/side.php";

  //check if user is admin
  if(is_admin($uEmail)) {
	
	//show admin template
  	require "template/tutor_index.php";
  }else{
	  
	//show student template 
  	require "template/student_index.php";
  }

//Get the footer
require "inc/footer.php";

?>
