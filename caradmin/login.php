<?php
if(!isset($_REQUEST["gh"])){ 
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

ini_set('session.gc_maxlifetime', 86400);
session_start();

require_once("../classes/db-class.php");
require_once("../includes/functions.php");
$db = new DB();
$db->connect();

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
<html lang="en-US" dir="ltr">
<head>
<meta charset="UTF-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>Admin Login - <?php echo $full_gen_name; ?></title>
<link rel="shortcut icon" href="../images/favicon.png"/>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/portal.css">
<script src="../js/jquery-latest.min.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script>
<!--
var img1 = new Image();
img1.src = "images/ace-maths-exams-login.jpg";
//-->
</script>
<style>
<!--
body{
padding:5px;
padding-top:150px;
background:#333 url(images/ace-maths-exams-login.jpg);
-webkit-background-size: cover; 
-moz-background-size: cover; 
-o-background-size: cover; 
background-size: cover;
}
.form-div{
max-width:400px;
margin-left:auto;
margin-right:auto;
padding:10px;
background:rgba(255,255,255,0.92);
}
-->
</style>
</head>
<?php detectCurrUserBrowser('<table width="100%"><tr><td>','',7); ?>

<body class="">
 
<div class="form-div"> 

<?php
}else{ 
require_once("../includes/gen-header.php");
}

if(isset($_SESSION["login"])){
redirect("{$directory}{$users}");
}
if(isset($_SESSION["admin_login"])){
redirect("{$directory}{$admin}");
}

$email = tp_input("email");
$password = tp_input("password");
$password2 = $password;
$conf_pass = tp_input("conf_pass");
$a2 = nr_input("a2");
$b2 = tr_input("b2");

// Login
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["login"]) && !empty($email) && !empty($password)){

$password = sha1($password);

$result = $db->select("admin_data", "Where email = '{$email}'", "*", "");

if(count_rows($result) == 1){

$row = fetch_data($result);

if($row["password"] == $password && $row["blocked"] == 0){

$id = $row["id"];
$name = $row["name"];
$_SESSION["email"] = $email;
$_SESSION["name"] = $name;
$_SESSION["id"] = $id;
$_SESSION["admin_login"] = 1;

$db->query("UPDATE admin_data SET logged_in = '1', date_time = '{$date_time}' WHERE email = '{$email}'");

$activity = "Logged in to own account.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$name'",
"email" => "'$email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$db->insert($audit_data_array, "audit_log");

$error = 0;
?>
<form name="temp" action="<?php echo $directory . $admin; ?>" method="get"></form>
<script>
<!--
document.temp.submit();
//-->
</script>
<?php
}else if($row["password"] != $password && $row["blocked"] == 0){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Incorrect Password</div>";
}else if($row["blocked"] == 1){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Your account is declined.</div>";
}

}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> This email is not registered by an admin user.</div>";
}

}

// Reset Password
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["reset"]) && !empty($email)){

$result = $db->select("admin_data", "Where email = '{$email}'", "*", "");

if(count_rows($result) == 1){

$row = fetch_data($result);
$name = $row["name"];
$reg_id = $row["id"];
$password = $row["password"];
$blocked = $row["blocked"];

if($blocked == 0){

$to = "{$email}";
$subject = "Password Reset";
$message = "<p>Dear {$name},</p>
<p>You have successfully reset your password.</p>
<p>Kindly update your new password by clicking on, or copying and pasting this link on your address bar: {$directory}{$admin}login.php?a2={$reg_id}&b2={$password}</p>";
$foot_note .= "<p>If you did not request for password reset, kindly ignore this mail.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

echo "<div class='success'>Successfully. Kindly check you mail for the next procedure.</div>";
$error = 0;
}else if($blocked == 1){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Hi {$name}! Your account is declined.</div>";
}

}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> This email is not registered by an admin user.</div>";
}

}

///////////////////////////////New Password////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update"]) && !empty($a2) && !empty($b2) && !empty($password) && !empty($conf_pass) && strlen($password) >= 5 && $password == $conf_pass ){

$new_password = sha1($password);
$username = in_table("name","admin_data","WHERE id='{$a2}'","name");
$user_email = in_table("email","admin_data","WHERE id='{$a2}'","email");

$result = $db->select("admin_data", "Where id = '{$a2}'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$password2 = $row["password"];
$blocked = $row["blocked"];
$name = $row["name"];

if($blocked == 1){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Hi {$name}! Your account is declined. Kindly contact the admin <a href='../privates/contact-us.php'>HERE</a>.</div>";
}else if($password2 == $b2){

$data_array = array(
"password" => $new_password
);
$act = $db->update($data_array, "admin_data", "id = '{$a2}'");

echo "<div class='success'>Password successfully updated. Kindly log in with your new password.</div>";
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error occured.</div>";
}

}else if($password2 != $b2){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Invalid request.</div>";
}

}

///////////////////////////////////////////////////////////////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update"]) && (empty($password2) or empty($conf_pass))){
$_SESSION["notSuccess"] = "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! All the fields are required.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update"]) && !empty($password2) && strlen($password2) < 5){
$_SESSION["notSuccess"] = "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! Password must be atleast 5 characters.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update"]) && !empty($password2) && $password2 != $conf_pass){
$_SESSION["notSuccess"] = "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! Passwords do not match.</div>";
}
/////////////////////////////////////////////////////////////

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["login"]) && (empty($email) or empty($password2))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> All the feilds are required.</div>";
}
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["reset"]) && empty($email)){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> All the feilds are required.</div>";
}
?>


<?php
if(isset($_SESSION["msg"])){
echo $_SESSION["msg"];
$_SESSION["msg"] = NULL;
session_unset();
session_destroy();
}
?>

<?php  
if(!isset($_REQUEST["a2"]) && !isset($_REQUEST["b2"])){
?>
<form action="login.php" class="login-form general-form" id="form-div" method="post" enctype="multipart/form-data">  
<div class="gen-title">
<a href="<?php directory(); ?>" class="logo-link"><i class="fa fa-home" aria-hidden="true" style="font-size:30px;"></i></a> &nbsp;&nbsp;&nbsp;
Admin Login</div>    
<input type="hidden" name="gh" value="1">
<input type="hidden" name="login" value="1">

<div>
<label for="email">Email</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
<input type="email" name="email" id="email" class="form-control" placeholder="Your Email Address" required value="<?php check_inputted("email"); ?>">
</div>
</div>

<div>
<label for="password">Password</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Your password" required value="<?php check_inputted("password"); ?>">
</div>
</div>
                     
<div class="submit-div">
<a class="toggle-forms" onclick="javascript:$('.login-form').slideToggle();$('.forgot-form').slideToggle();" class="form-link">Forgot Password?</a>
<button class="gen-btn float-right"><i class="fa fa-sign-in"></i> Login</button>
</div>
</form>

<form action="login.php" class="forgot-form general-form" id="form-div" style="display:none;" method="post" enctype="multipart/form-data">  
<div class="gen-title">Change Your Password</div>    
<input type="hidden" name="gh" value="1">
<input type="hidden" name="reset" value="1">

<div>
<label for="email">Email</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
<input type="email" name="email" id="email" class="form-control" placeholder="Your Email Address" required value="<?php check_inputted("email"); ?>">
</div>
</div>
                     
<div class="submit-div">
<a class="toggle-forms" onclick="javascript:$('.forgot-form').slideToggle();$('.login-form').slideToggle();" class="form-link">Login</a>
<button class="gen-btn float-right"><i class="fa fa-lock"></i> Reset Password</button>
</div>
</form>

<?php  
}

if(isset($_REQUEST["a2"]) && isset($_REQUEST["b2"])){

$result = $db->select("admin_data", "Where id = '{$a2}'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$password2 = $row["password"];
$blocked = $row["blocked"];
$name = $row["name"];

if($blocked == 1){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Hi {$name}! Your account is declined. Kindly contact the admin <a href='privates/contact-us/'>HERE</a>.</div>";
}else if($password2 == $b2){
?>
 
<form action="login.php" class="reset-form general-form" id="form-div" method="post" enctype="multipart/form-data">  
<div class="gen-title">Hi <?php echo $name; ?>, Your New Password</div>    

<input type="hidden" name="a2" id="a2" required value="<?php echo $a2; ?>">
<input type="hidden" name="b2" id="b2" required value="<?php echo $b2; ?>">
<input type="hidden" name="gh" value="1">
<input type="hidden" name="update" value="1">

<div>
<label for="password">New Password <i>(atleast 5 characters)</i></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Your password for login" required value="<?php check_inputted("password"); ?>">
</div>
</div>

<div>
<label for="conf_pass">Retype Password</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="conf_pass" id="conf_pass" class="form-control" placeholder="Retype your password" required value="<?php check_inputted("conf_pass"); ?>">
</div>
</div>
                     
<div class="submit-div">
<button class="gen-btn float-right"><i class="fa fa-upload"></i> Update</button>
</div>
</form>

<?php  
}else if($password2 != $b2){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Invalid request.</div>";
}

}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Invalid request.</div>";
}

}
?>
</div>

<script src="../js/general.js"></script>

</body>
</html>