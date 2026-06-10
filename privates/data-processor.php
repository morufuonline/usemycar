<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

ini_set('session.gc_maxlifetime', 86400);
session_start();

error_reporting(0);

require_once("../classes/db-class.php");
require_once("../includes/functions.php");
require_once("../includes/resize-image.php");

$error = 1;

$name = tp_input("name");
$bank = tp_input("bank");
$bank_account_name = tp_input("bank_account_name");
$bank_account_number = tp_input("bank_account_number");
$address = tp_input("address");
$country = tp_input("country");
$phone = np_input("phone");
$email = tp_input("email");
$password = tp_input("password");
$password2 = $password;
$confirm_password = tp_input("confirm_password");
$newsletter = tp_input("newsletter");
$spam_checker = tp_input("spam_checker");
$newsletter = (!empty($newsletter))?$newsletter:0;

$register = tp_input("register");
$login = tp_input("login");
$forgot = tp_input("forgot");
$reset = tp_input("reset");
$newsletter_subscription = tp_input("newsletter_subscription");
$load_contact = tp_input("load_contact");
$message = tp_input("message");
$save_ad = np_input("save_ad");

$parameter = tp_input("parameter");
$parameter_value = tp_input("parameter_value");

$my_ad_img = tp_input("my_ad_img");
$edit_my_ad_img = tp_input("edit_my_ad_img");
$session_ad_img = tp_input("session_ad_img");

//<p>Please confirm your registration request by following this link: {$directory}index.php?a={$reg_id}&b={$enc_email}</p>
//<p>Please confirm your registration request by following this link: {$directory}index.php?a={$reg_id}&b={$enc_email}</p>
//Kindly check your email box to activate your account.


if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($register) && !empty($name) && !empty($address) && !empty($country) && !empty($phone) && strlen($phone) >= 5 && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password) && strlen($password) >= 5 && $password == $confirm_password && $spam_checker == $_SESSION["spam_checker"]){
	
$email = strtolower($email);
$password = sha1($password);
$plan_unit = in_table("units", "plans", "WHERE id = '1'", "units");

$result = $db->select("reg_members", "WHERE email = '{$email}'", "*", "");

if(count_rows($result) < 1){

$data_array = array(
"name" => "'$name'",
"bank" => "'$bank'",
"bank_account_name" => "'$bank_account_name'",
"bank_account_number" => "'$bank_account_number'",
"address" => "'$address'",
"country" => "'$country'",
"phone" => "'$phone'",
"email" => "'$email'",
"password" => "'$password'",
"newsletter" => "'$newsletter'",
"date" => "'$date'",
"free" => "'$plan_unit'"
);
$act = $db->insert($data_array, "reg_members");

$news_result = $db->select("newsletter", "WHERE email = '{$email}'", "*", "");
if(count_rows($news_result) < 1){
$newsletter_array = array(
"email" => "'$email'"
);
$db->insert($newsletter_array, "newsletter");
}

if($act){

$reg_id = in_table("id", "users", "WHERE email = '$email'", "id");
$enc_email = sha1($email);

$to = "{$email}";
$subject = "Account Activation";
$message = "<p>Dear {$name},</p>
<p>Thank you for signing up for an account on {$domain}.</p>
<p>Please confirm your registration request by following this link: {$directory}index.php?a={$reg_id}&b={$enc_email}</p>";
$foot_note .= "<p>If you did not complete a registration form on {$domain}, it means you are getting this message in error. Please delete it. No further action is necessary.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

$error = 0;

echo "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Account successfully created. Kindly check your email box to activate your account.</div>";
$_SESSION["spam_checker"] = rand(1001,9999);

}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error occured.</div>";
$error = 0;
}

}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Email already exists. Log in instead.</div>";
$error = 0;
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && $error == 1 && !empty($register) && (empty($name) or empty($address) or empty($country) or empty($phone) or empty($email) or empty($password2) or empty($spam_checker))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Not submitted!</strong> All the required fields must be filled.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && $error == 1 && !empty($register) && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Not submitted!</strong> Invalid  email format.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && $error == 1 && !empty($register) && !empty($password2) && strlen($password2) < 5){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Not submitted!</strong> Password must be atleast 5 characters.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && $error == 1 && !empty($register) && !empty($password2) && $password2 != $confirm_password){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Not submitted!</strong> Passwords do not match.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && $error == 1 && !empty($register) && !empty($spam_checker) && $spam_checker != $_SESSION["spam_checker"]){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Not submitted!</strong> Incorrect check code.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && $error == 1 && !empty($register) && !empty($phone) && strlen($phone) < 5){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Not submitted!</strong> Phone number must be atleast 5 digits.</div>";
}

// Login
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($login) && !empty($email) && !empty($password)){

$password = sha1($password);

$result = $db->select("reg_members", "WHERE email = '{$email}'", "*", "");

if(count_rows($result) == 1){

$row = fetch_data($result);
$status = $row["status"];
$name = $row["name"];
$id = $row["id"];

if($status == 0){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Hello {$name}! Your account is not active. Kindly activate your account through the e-mail sent to you during registration OR contact the admin <a href='{$directory}privates/contact-us.php'>HERE</a></div>";	
} else if($row["password"] == $password && $row["blocked"] == 0){
$_SESSION["email"] = $email;
$_SESSION["name"] = $name;
$_SESSION["id"] = $id;
$_SESSION["login"] = 1;

$db->query("UPDATE reg_members SET logged_in = '1', date_time = '{$date_time}' WHERE email = '{$email}'");

$activity = "Logged in to own account.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$name'",
"email" => "'$email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$db->insert($audit_data_array, "admin_log");
$error = 0;
?>
<form name="temp" action="<?php echo "{$directory}members/"; ?>" method="get"></form>
<script>
<!--
document.temp.submit();
//-->
</script>
<?php
}else if($row["password"] != $password && $row["blocked"] == 0){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Incorrect Password</div>";
}else if($row["blocked"] == 1){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Your account is declined. Kindly contact the admin <a href='{$directory}privates/contact-us.php'>HERE</a></div>";
}

}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> This email is not registered. Kindly register <a data-toggle='modal' data-target='#sign-up' data-dismiss='modal' aria-label='New user'>HERE</a></div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && $error == 1 && !empty($login) && (empty($email) or empty($password))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Not submitted!</strong> All the fields are required.</div>";
}

// Reset Password
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($forgot) && !empty($email)){

$result = $db->select("reg_members", "WHERE email = '{$email}'", "*", "");

if(count_rows($result) == 1){

$row = fetch_data($result);
$name = $row["name"];
$reg_id = $row["id"];
$password = $row["password"];
$blocked = $row["blocked"];
$status = $row["status"];

if($status == 0){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Hello {$name}! Your account is not active. Kindly activate your account through the e-mail sent to you during registration OR contact the admin <a href='{$directory}privates/contact-us.php'>HERE</a></div>";	
} else if($blocked == 0){

$to = "{$email}";
$subject = "Password Reset";
$message = "<p>Dear {$name},</p>
<p>You have successfully requested for password reset.</p>
<p>Kindly update your new password by clicking on, or copying and pasting this link on your address bar: <a href='{$directory}index.php?a2={$reg_id}&b2={$password}'>{$directory}index.php?a2={$reg_id}&b2={$password}</a></p>";
$foot_note .= "<p>If you did not request for password reset, kindly ignore this mail.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

echo "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Successful. Kindly check you mail for the next procedure.</div>";
$error = 0;
}else if($blocked == 1){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Hi {$name}! Your account is declined. Kindly contact the admin <a href='{$directory}privates/contact-us.php'>HERE</a></div>";
}

}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> This email is not registered. Kindly register <a data-toggle='modal' data-target='#sign-up' data-dismiss='modal' aria-label='New user'>HERE</a></div>";
}

}

///////////////Newsletter///////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($newsletter_subscription) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){

$result = $db->select("newsletter", "WHERE email = '{$email}'", "*", "");

if(count_rows($result) < 1){

$data_array = array(
"email" => "'$email'"
);

$act = $db->insert($data_array, "newsletter");

if($act){

$to = "{$email}";
$subject = "Newsletter Subscription";
$message = "<p>Thank you for signing up for subscribing for our newsletters.</p>
<p>We will keep you updated as soon as possible.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

echo "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Newsletter subscription was successful.</div>";
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error occured.</div>";
}
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not Successful. Email already exists.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($newsletter_subscription) && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not Successful. Invalid email format.</div>";
}
///////////////////////////////////////////

// Load Models
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($parameter) && !empty($parameter_value) && $parameter == "veh_brand"){
$result = $db->select("veh_brands", "WHERE  make = '{$parameter_value}'", "DISTINCT model", "ORDER BY model ASC");
if(count_rows($result) > 0){
echo "<option value=\"\"> - - Select a model - - </option>";
while($row = fetch_data($result)){
$model = $row["model"];
echo "<option value=\"{$model}\">{$model}</option>";
}
}
}
///////////////////////////////

// Load Search Models
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($parameter) && !empty($parameter_value) && $parameter == "search_veh_brand"){
$result = $db->select("sellable_cars", "WHERE brand = '{$parameter_value}' AND status = '1'", "DISTINCT model", "ORDER BY model ASC");
if(count_rows($result) > 0){
echo "<option value=\"\"> - - Select a model - - </option>";
while($row = fetch_data($result)){
$model = $row["model"];
echo "<option value=\"{$model}\">{$model}</option>";
}
}
}
///////////////////////////////

// Load Local Government
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($parameter) && !empty($parameter_value) && $parameter == "veh_local"){
$result = $db->select("location", "WHERE  state = '{$parameter_value}'", "DISTINCT local_government", "ORDER BY local_government ASC");
if(count_rows($result) > 0){
echo "<option value=\"\"> - - Select the local government - - </option>";
while($row = fetch_data($result)){
$local_government = $row["local_government"];
echo "<option value=\"{$local_government}\">{$local_government}</option>";
}
}
}
///////////////////////////////

////////////// Upload ad image //////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_FILES["ad_img"]["tmp_name"]) && !empty($my_ad_img)){ 

$file_name = $_FILES["ad_img"]["name"]; 
$file_temp_name = $_FILES["ad_img"]["tmp_name"];
$info   = getimagesize($file_temp_name);
$file_size = $_FILES["ad_img"]["size"];
$file_error_message = $_FILES["ad_img"]["error"];
$file_name_2_array = explode(".", $file_name);
$file_extension = end($file_name_2_array);

if(!isset($_SESSION["portal"]["ad_img"]) || empty($_SESSION["portal"]["ad_img"])){
foreach (glob("../images/ads-temp/{$id}_ad_*.jpg") as $filename) {
if(file_exists($filename)){
unlink($filename);
}
}	
}

if (!$file_temp_name) {
    echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: Please browse for a file before clicking the upload button.</div>";
    exit();
} 
else if($file_size > 5242880) {
    echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: Your file was larger than 5 Megabytes in size.</div>";
    unlink($file_temp_name);
    exit();
}
else if (!preg_match("/.(gif|GIF|jpg|JPG|png|PNG|jpeg|JPEG)$/i", $file_name) ) {
     echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: Your image was not .gif, .jpg, .jpeg, or .png.</div>";
     unlink($file_temp_name);
     exit();
}
else if ($file_error_message == 1) {
    echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: An error occured while processing the file. Try again.</div>";
    exit();
}
else if ($info[2] != 1 && $info[2] != 2 && $info[2] != 3) {
     echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: Your image was not .gif, .jpg, .jpeg, or .png.</div>";
     exit();
}

$file_name = "1_{$id}_ad_displayed_{$ticket_id}_{$rand}.{$file_extension}";
$move_file = move_uploaded_file($file_temp_name, "../images/ads-temp/{$file_name}");
if ($move_file != true) {
    echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: File not uploaded. Try again.</div>";
    unlink($file_temp_name);
    exit();
}

$target_file = "../images/ads-temp/{$file_name}";
$resized_file = "../images/ads-temp/{$id}_ad_displayed_{$ticket_id}_{$rand}.jpg";
image_resize($target_file, $resized_file, $file_extension, "650", "500");

$resized_file = "../images/ads-temp/{$id}_ad_featured_{$ticket_id}_{$rand}.jpg";
image_resize($target_file, $resized_file, $file_extension, "200", "200");

unlink($target_file);

$_SESSION["portal"]["ad_img"][$ticket_id] = $ticket_id;
?>
<div>
<form action="../privates/data-processor.php" class="general-form2-<?php echo $ticket_id . $rand; ?> edit-form-<?php echo $ticket_id; ?>" name="my-add-default-<?php echo $ticket_id; ?>" id="result-<?php echo $ticket_id; ?>" lang="my-add-loading-<?php echo $ticket_id; ?>" title="edit" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
<input type="hidden" name="edit_my_ad_img" value="1" />
<input type="hidden" name="session_ad_img" value="<?php echo $ticket_id; ?>" />
<div class="new-ad-pic">
<div class="ad-pic-img"> 
<div class="relative-div">
<div class="car-image result-<?php echo $ticket_id; ?>"><img src="<?php echo $resized_file; ?>" /></div>
<div class="fileupload fileupload-new" data-provides="fileupload">
<span class="btn btn-primary btn-file">
<span class="fileupload-new">
<i class="fa fa-refresh" aria-hidden="true" id="my-add-default-<?php echo $ticket_id; ?>"></i> Change pic
<i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" aria-hidden="true" id="my-add-loading-<?php echo $ticket_id; ?>"></i>                            
</span>
<input type="file" name="edit_ad_img" onchange="javascript: $('.edit-form-<?php echo $ticket_id; ?>').submit();">
</span><span class="fileupload-preview"></span>
</div></div>
</div>
<div class="ad-pic-option"> 
<button type="button" class="btn btn-danger delete-ad-img" onclick="javascript: delete_file('../privates/data-processor.php', 'del_ad_file', '<?php echo $ticket_id; ?>', 'delete-<?php echo $ticket_id; ?>', 'result-<?php echo $ticket_id; ?>');"><i class="fa fa-trash" aria-hidden="true"></i> Delete <i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" id="delete-<?php echo $ticket_id; ?>" aria-hidden="true"></i></button>
</div>
</div>
</form>
<script>
<!--
$("body").find( ".general-form2-<?php echo $ticket_id . $rand; ?>" ).on( "submit", function(e) {
e.preventDefault();  
var formdata = new FormData(this);
var page_url = $(this).attr("action");
var page_result = $(this).attr("id");
var this_name = $(this).attr("name");
var this_lang = $(this).attr("lang");

document.getElementById(this_name).style.display = "none";
document.getElementById(this_lang).style.display = "block";
$.ajax({
url: page_url,
type: "POST",
data: formdata,
mimeTypes:"multipart/form-data",
contentType: false,
cache: false,
processData: false,
success: function(data){
document.getElementById(this_lang).style.display = "none";
document.getElementById(this_name).style.display = "block";

$("." + page_result).html(data);

},error: function(){
alert("Error occured!");
document.getElementById(this_lang).style.display = "none";
document.getElementById(this_name).style.display = "block";
}
});

});
//-->
</script>
</div>
<?php
}
//////////////////////////////////////////


////////////// Change ad image //////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_FILES["edit_ad_img"]["tmp_name"]) && !empty($edit_my_ad_img)){ 

$file_name = $_FILES["edit_ad_img"]["name"]; 
$file_temp_name = $_FILES["edit_ad_img"]["tmp_name"];
$info   = getimagesize($file_temp_name);
$file_size = $_FILES["edit_ad_img"]["size"];
$file_error_message = $_FILES["edit_ad_img"]["error"];
$file_name_2_array = explode(".", $file_name);
$file_extension = end($file_name_2_array);

if (!$file_temp_name) {
    echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: Please browse for a file before clicking the upload button.</div>";
    exit();
} 
else if($file_size > 5242880) {
    echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: Your file was larger than 5 Megabytes in size.</div>";
    unlink($file_temp_name);
    exit();
}
else if (!preg_match("/.(gif|GIF|jpg|JPG|png|PNG|jpeg|JPEG)$/i", $file_name) ) {
     echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: Your image was not .gif, .jpg, .jpeg, or .png.</div>";
     unlink($file_temp_name);
     exit();
}
else if ($file_error_message == 1) {
    echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: An error occured while processing the file. Try again.</div>";
    exit();
}
else if ($info[2] != 1 && $info[2] != 2 && $info[2] != 3) {
     echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: Your image was not .gif, .jpg, .jpeg, or .png.</div>";
     exit();
}

if(isset($_SESSION["portal"]["ad_img"][$session_ad_img]) && !empty($_SESSION["portal"]["ad_img"][$session_ad_img])){
foreach (glob("../images/ads-temp/{$id}_ad_*_{$session_ad_img}_*.jpg") as $filename) {
if(file_exists($filename)){
unlink($filename);
}
}	
}

$file_name = "1_{$id}_ad_displayed_{$session_ad_img}_{$rand}.jpg";
$move_file = move_uploaded_file($file_temp_name, "../images/ads-temp/{$file_name}");
if ($move_file != true) {
    echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> ERROR: File not uploaded. Try again.</div>";
    unlink($file_temp_name);
    exit();
}

$target_file = "../images/ads-temp/{$file_name}";
$resized_file = "../images/ads-temp/{$id}_ad_displayed_{$session_ad_img}_{$rand}.jpg";
image_resize($target_file, $resized_file, $file_extension, "650", "500");

$resized_file = "../images/ads-temp/{$id}_ad_featured_{$session_ad_img}_{$rand}.jpg";
image_resize($target_file, $resized_file, $file_extension, "200", "200");

unlink($target_file);

?>
<img src="<?php echo $resized_file; ?>" />
<?php
}
//////////////////////////////////////////

// Delete Ad File
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($parameter) && !empty($parameter_value) && $parameter == "del_ad_file"){

foreach (glob("../images/ads-temp/{$id}_ad_*_{$parameter_value}_*.jpg") as $filename) {
if(file_exists($filename)){
unlink($filename);
}
}

$_SESSION["portal"]["ad_img"][$parameter_value] = NULL;
unset($_SESSION["portal"]["ad_img"][$parameter_value]);

echo 1;
}
///////////////////////////////

//Load Contact
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($load_contact)){

$added_by = $added_by_name = $added_by_email = $brand = $model = $year = $local_government = $state = $subject2 = "";

$result = $db->select("sellable_cars", "WHERE id='$load_contact'", "*", "");
if(count_rows($result) == 1){
$row = fetch_data($result);
$added_by = $row["user_id"];
$added_by_name = in_table("name","reg_members","WHERE id = '$added_by'","name");
$added_by_email = in_table("email","reg_members","WHERE id = '$added_by'","email");
$brand = $row["brand"];
$model = $row["model"];
$year = $row["year"];
$local_government = $row["local_government"];
$state = $row["state"];
$subject2 = "{$brand} {$model} {$year} at {$local_government}, {$state}, Nigeria.";
}

if(!empty($added_by) && !empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($phone) && strlen($phone) >= 5 && !empty($message)){

$user_data_array = array(
"ticket_id" => "'$ticket_id'",
"sender_name" => "'$name'",
"sender_email" => "'$email'",
"recipient_name" => "'$added_by_name'",
"recipient_email" => "'$added_by_email'",
"subject" => "'Inquiry on $subject2'",
"message" => "'$message'",
"inbox" => "'1'",
"date_time" => "'$date_time'"
);
$db->insert($user_data_array, "users_messages");

$to = "{$email}";
$subject = "Ticket #{$ticket_id}: Inquiry on {$subject2}";
$message = "<p>Thank you for contacting {$added_by_name} on {$subject2}</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";

send_mail();

$to = "{$added_by_email}";
$subject = "Ticket #{$ticket_id}: Inquiry on {$subject}";
$message = "<p>Hi {$added_by_name}!</p>
<p>{$name} with the phone number {$phone} contacted you on {$subject2}.</p>
<p>Kindly login <a href='{$directory}'>HERE</a> to view the message.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

$error = 0;

echo "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Mail successfully sent.</div>";

}else if(!empty($added_by) && !empty($message) && (empty($name) || empty($email) || empty($phone))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not Successful. All fields are required.</div>";
}else if(!empty($added_by) && !empty($message) && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not Successful. Invalid email format.</div>";
}else if(!empty($added_by) && !empty($message) && !empty($phone) && strlen($phone) < 5){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not Successful. Phone number must be atleast 5 digits.</div>";
}
?>
<h3 style="text-align:center">Contact <?php echo $added_by_name ?></h3>
<h4 style="text-align:center"><?php echo $subject2; ?></h4>
<form action="<?php directory(); ?>privates/data-processor.php" class="general-form" id="modal-result" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
<input type="hidden" name="load_contact" value="<?php echo $load_contact; ?>">
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user"></i></span>
<input name="name" placeholder="Full Name*" value="<?php check_inputted("name", $username); ?>" class="form-control" type="text" required>
</div>

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
<input name="email" placeholder="Email Address*" value="<?php check_inputted("email", $user_email); ?>" class="form-control" type="email" required>
</div>

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-phone"></i></span>
<input name="phone" placeholder="Phone Number*" value="<?php check_inputted("phone", $user_phone); ?>" class="form-control only-no" type="text" required>
</div>

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
<textarea type="text" name="message" id="message" rows="2" class="form-control" placeholder="Your Message" required><?php check_inputted("message"); ?></textarea>
</div>

<button type="submit" class="btn btn-success modal-login-btn">Send</button>
</form>
<script>
<!--
$(document).ready(function(){

$( ".general-form" ).on( "submit", function(e) {
e.preventDefault();  
var formdata = new FormData(this);
$(".general-fade").show();
var page_url = $(this).attr("action");
var page_result = $(this).attr("id");

$.ajax({
url: page_url,
type: "POST",
data: formdata,
mimeTypes:"multipart/form-data",
contentType: false,
cache: false,
processData: false,
success: function(data){
$("." + page_result).html(data);
$(".general-fade").hide();
},error: function(){
sweetAlert("Notice", "An error occured!", "error");
$(".general-fade").hide();
}
});

});
///////////////////////////////

$(".only-no").keyup(function(){
var this_val = this.value;
if(isNaN(this_val)){
this.value = this_val.replace(/[^0-9.]/gi, "");
}	
}).change(function(){
var this_val = this.value;
if(isNaN(this_val)){
this.value = this_val.replace(/[^0-9.]/gi, "");
}	
});
/////////////////////////////////

});
//-->
</script>
<?php
}
////////////////////////////////

//Save ad
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($save_ad)){

$result = $db->select("saved_ads", "WHERE user_id='$id' AND ad_id='$save_ad'", "*", "");

if(count_rows($result) == 0){
$user_data_array = array(
"user_id" => "'$id'",
"ad_id" => "'$save_ad'",
"date_time" => "'$date_time'"
);
$db->insert($user_data_array, "saved_ads");
echo "1";
}else if(count_rows($result) == 1){
$db->delete("saved_ads","user_id='$id' AND ad_id='$save_ad'");
echo "2";
}

}
////////////////////////////////

?>