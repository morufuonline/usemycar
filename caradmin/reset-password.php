<?php include_once("../includes/admin-header.php"); ?> 

<?php
$error = 1;
$password = tp_input("password");
$password2 = $password;
$conf_pass = tp_input("conf_pass");

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($password) && !empty($conf_pass) && strlen($password) >= 5 && $password == $conf_pass ){

$password = sha1($password);

$data_array = array(
"password" => $password
);
$act = $db->update($data_array, "admin_data", "email = '$user_email'");

if($act){
$activity = "Reset own password.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$db->insert($audit_data_array, "audit_log");

$error = 0;

$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Password successfully updated.</div>";
redirect("reset-password.php");
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error occured.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($password2) or empty($conf_pass))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! All the fields are required.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($password2) && strlen($password2) < 5){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! Password must be atleast 5 characters.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($password2) && $password2 != $conf_pass){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! Passwords do not match.</div>";
}

if(isset($_SESSION["msg"]) && empty($password)){
echo $_SESSION["msg"];
$_SESSION["msg"] = NULL;
unset($_SESSION["msg"]);
}
?>

<form action="reset-password.php" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
<div class="gen-title">Change Password</div>    

<div>
<label for="password">New Password <i>(atleast 5 characters)</i></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Your password for login" required value="<?php echo check_inputted("password"); ?>">
</div>
</div>

<div>
<label for="conf_pass">Retype Password</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="conf_pass" id="conf_pass" class="form-control" placeholder="Retype your password" required value="<?php echo check_inputted("conf_pass"); ?>">
</div>
</div>
                     
<div class="submit-div">
<button class="btn gen-btn float-right" name="update"><i class="fa fa-upload"></i> Update</button>
</div>
</form>

</div>
</div>

</div>

<?php require_once("../includes/portal-footer.php"); ?>