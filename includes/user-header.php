<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

ini_set('session.gc_maxlifetime', 86400);
session_start();

require_once("../classes/db-class.php");
require_once("functions.php");

if(!isset($_SESSION["login"])){
redirect("{$directory}");
$_SESSION["msg"] = "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> You are not logged in. Kindly log in to continue...</div>";
}

if(isset($_REQUEST["logout"])){
unset($_SESSION["login"]);
unset($_SESSION["name"]);
unset($_SESSION["email"]);
unset($_SESSION["id"]);
$db->query("UPDATE reg_members SET logged_in = '0' WHERE email = '{$user_email}'");
$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> You are successfully loged out. Kindly log in to continue...</div>";

$activity = "Logged out of own account.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$db->insert($audit_data_array, "admin_log");

redirect("{$directory}");
}

function detectCurrUserBrowser($a,$b,$c){
$msie = stripos($_SERVER["HTTP_USER_AGENT"], "msie") ? true : false;
if($msie){
$msiePosition = stripos($_SERVER["HTTP_USER_AGENT"], "msie");
$msiePositionNew = $msiePosition+5;
$versionNumber = substr($_SERVER["HTTP_USER_AGENT"],$msiePositionNew,1);
if($versionNumber <= $c){
echo $a;
}
else{
echo $b;
}
}
else{
echo $b;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title><?php echo (basename($_SERVER["PHP_SELF"]) == "index.php")?"Dashboard":title_link(basename($_SERVER["PHP_SELF"],".php")); ?> - Use My Car</title>
<link rel="shortcut icon" href="../images/favicon.png"/>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/jquery-ui.css" rel="stylesheet">
<link href="../css/font-awesome.min.css" rel="stylesheet">
<link href="../css/open-sans.css" rel="stylesheet">
<link href="../css/font-awesome.min.css" rel="stylesheet">
<link href="../css/roboto.css" rel="stylesheet">
<link href="../css/roboto-condensed.css" rel="stylesheet">
<link href="../css/oswald.css" rel="stylesheet">
<link rel="stylesheet" href="../css/portal.css">
<link  href="../css/fotorama.css" rel="stylesheet">
<script src="../js/jquery-latest.min.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/fotorama.js"></script>
</head>
<body>
<div class="header-wrapper" id="bodyDiv">
<div class="header">
<a href="<?php directory(); ?>" class="logo-link"><img class="img-responsive" src="../images/logo.png" alt="logo"></a>
<span><?php
$file_array = glob("../images/users/{$id}pic*.jpg");
$file_name = ($file_array)?$file_array[0]:"../images/post.jpg";
?><a href="profile.php"><img src="<?php echo $file_name; ?>" ><br>
<i class="fa fa-user" aria-hidden="true"></i> <?php echo $username; ?></a>
</span>
<button class="collapse"><span></span><span></span><span></span></button>
</div>
</div>

<div class="portal-wrapper">

<div class="portal-nav portal-content">

<a href="<?php echo $directory . $users; ?>" class="<?php echo current_page("index"); ?>"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a>

<a href="../ads/sell-your-car-01.php"><i class="fa fa-car" aria-hidden="true"></i> Sell Your Car</a>
<a href="../ads/sellable-plans.php"><i class="fa fa-money" aria-hidden="true"></i> Buy a Plan</a>
<a href="my-cars-for-sales.php" class="<?php echo current_page("my-cars-for-sales"); ?>"><i class="fa fa-car" aria-hidden="true"></i> My Cars for Sale</a>
<a href="my-orders.php" class="<?php echo current_page("my-orders"); ?>"><i class="fa fa-car" aria-hidden="true"></i> My Orders</a>
<a href="payment-notifications.php" class="<?php echo current_page("payment-notifications"); ?>"><i class="fa fa-bullhorn" aria-hidden="true"></i> Pay Notifications</a>

<a href="inbox.php" class="<?php echo current_page("inbox"); ?>"><i class="fa fa-inbox" aria-hidden="true"></i> Inbox</a>
<a href="sent-messages.php" class="<?php echo current_page("sent-messages"); ?>"><i class="fa fa-envelope" aria-hidden="true"></i> Sent Messages</a>

<a href="profile.php" class="<?php echo current_page("profile"); ?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
<a href="reset-password.php" class="<?php echo current_page("reset-password"); ?>"><i class="fa fa-lock" aria-hidden="true"></i> Reset Password</a>

<a href="index.php?logout=1" onClick="javascript:return confirm('Are you sure you want to log out?');"><i class="fa fa-sign-out"></i> Log Out</a>

</div>

<div class="portal-body portal-content">
<div class="<?php echo (basename($_SERVER["PHP_SELF"],".php") == "index")?"portal-body-wrapper":"body-content form-div"; ?>">