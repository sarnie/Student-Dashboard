<?php
$query = $_SERVER['PHP_SELF'];
$path = pathinfo( $query );
$filename = $path['basename'];
		
if($filename != 'login.php'){		
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header('Location: login.php');
	exit;
	}
}

?>