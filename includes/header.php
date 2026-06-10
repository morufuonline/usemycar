<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

ini_set('session.gc_maxlifetime', 86400);
session_start();

require_once("../classes/db-class.php");
require_once("functions.php");
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
       <title><?php echo title_link(basename($_SERVER["PHP_SELF"],".php")); ?> - Use My Car</title>
	  <link rel="shortcut icon" href="../images/favicon.png"/>
      <!-- Bootstrap -->
      <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <link href="../css/jquery-ui.css" rel="stylesheet">
      <link rel="stylesheet" href="../owl-carousel-2/owl.theme.default.min.css">
      <link href="../css/style.css" rel="stylesheet">
      <link rel="stylesheet" href="../css/styles_drop.css">
    
      <link href="../css/open-sans.css" rel="stylesheet">
      <link href="../css/font-awesome.min.css" rel="stylesheet">
      <link href="../css/roboto.css" rel="stylesheet">
      <link href="../css/roboto-condensed.css" rel="stylesheet">
      <link href="../css/oswald.css" rel="stylesheet">
       <link rel="stylesheet" href="../css/flexslider.css" type="text/css" media="screen" />
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="../js/html5shiv.min.js"></script>
      <script src="../js/respond.min.js"></script>
      <![endif]-->
      <link rel="stylesheet" href="../owl-carousel-2/owl.carousel.css">
       <script src="../js/jquery-latest.min.js" type="text/javascript"></script>
      <script src="../js/script.js" type="text/javascript"></script>
	  <script src="../js/jquery-ui.js"></script>
       <script>
         $(document).ready(function(){
            $(".accordion_head").click(function(){
               var self = $(this);
               $(this).next(".accordion_body").slideToggle('600', function(){
                  self.toggleClass('active');
                  if (self.hasClass('active')) {
                     self.children(".plusminus").text('-');
                  }else{
                     self.children(".plusminus").text('+');
                  }
               }); 
            });
             $(".new_head").click(function(){
               var self = $(this);
               $(this).next(".accordion_body").slideToggle('600', function(){
                  self.toggleClass('active');
                  if (self.hasClass('active')) {
                     self.children(".plusminus").text('-');
                  }else{
                     self.children(".plusminus").text('+');
                  }
               }); 
            });
         });
      </script>
   </head>
   <body>
      <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-md-4 col-sm-3">
                  <div class="logo">
                     <a href="../"><img class="img-responsive" src="../images/logo.png" alt=""></a>
                  </div>
               </div>
               <div class="col-md-8 col-sm-9">
                  <ul class="head-right-menu">
                     <li><a href="#">WIN A CAR</a></li>
                     <li><a href="#">BECOME MARKETER</a></li>
                     <li><a href="../ads/sell-your-car-01.php">SELL YOUR CAR</a></li>
                     <?php if(isset($_SESSION["login"])){ ?>
                     <li><a href="../<?php echo $users; ?>profile.php">My Profile</a></li>
                     <li><a href="../<?php echo $users; ?>index.php?logout=1" onClick="javascript:return confirm('Are you sure you want to log out?');">Log out</a></li>
                     <?php } else { ?>
                     <li><a href="javascript:void(0);" data-toggle="modal" data-target="#sign-up">Register</a></li>
                     <li><a href="javascript:void(0);" data-toggle="modal" data-target="#sign-in">Log in</a></li>
                     <li class="profile"><a href="javascript:void(0);" data-toggle="modal" data-target="#sign-in"></a></li>
                     <?php } ?>
                  </ul>
               </div>
            </div>
         </div>
         <div class="menu">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="head_menu">
                        <div class="navigation">
                           <div id='cssmenu'>
                              <ul>
                                 <li class='active'><a href='../'>Home</a></li>
                                 <li><a href='#'> Buy A Car</a></li>
                                 <li><a href='dealer-list.php'>Dealers</a></li>
                                 <li><a href='#'>Use My Car For Adverts</a></li>
                                 <li><a href='#'>Member Benefits</a></li>
                                 <li><a href='#'>Car Loans</a></li>
                                 <li><a href='#'>Car Insurance</a></li>
                                 <li><a href='#'>Spare Parts</a></li>
                                 <li><a href='#'>Vehicle Tracking</a></li>
                              </ul>
                           </div>
                            <div id="imaginary_container"> 
                <div class="input-group stylish-input-group">
                    <input class="form-control" placeholder="Search" type="text">
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </div>
            </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>