<?php session_start(); ?>
<?php require('inc/logincheck.php'); ?>
<?php require('inc/controller.php'); ?>
<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Silver Shore</title>
<meta name="description" content="">
<link rel="shortcut icon" href="img/favi.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="css/responsive.css?ver=2">
<?php if(getPageType() == 'stats'):?>
<link href="js/src/nv.d3.css" rel="stylesheet" type="text/css">
<?php elseif(getPageType() == 'messages' || getPageType() == 'meetings'):?>
    <link rel="stylesheet" href="css/jquery-ui.css">
<?php endif; ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css' />
<!--[if lt IE 9]><script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script><![endif]-->
</head>
<body>
<?php if(getPageType() != 'login'):?>
<div id="top-bar" class="navbar navbar-inverse navbar-fixed-top">
 <div class="container">
   <div class="navbar-header"> <a id="side-nav-btn" class="pull-left visible-xs"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
   <a class="navbar-brand" href="index.php"><img src="img/logo.png" /></a> </div>
   <h1 class="navbar-left hidden-xs">Welcome!</h1>
   <ul class="nav navbar-nav navbar-right">
     <li class="dropdown">
      <a href="#" class="dropdown-toggle posRel" data-toggle="dropdown">
        <img src="img/<?php getProfilePic($uEmail);?>" class="the-pic img-circle" />
           <span class="u-name"><?php getFirstName($uEmail); ?></span> <b class="caret"></b>
       </a>
       <ul class="dropdown-menu">
         <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>

       </ul>
     </li>
   </ul>
 </div>
</div>
<?php endif;?>