<?php include_once("../includes/user-header.php"); require_once("../includes/resize-image.php"); ?>
<script>
<!--
var page_link = "profile.php";
//-->
</script>
<?php
$profile = tp_input("profile");
$upload = tp_input("upload");

$name = tp_input("name");
$address = tp_input("address");
$country = tp_input("country");
$phone = tp_input("phone");

$edit = nr_input("edit");

////////////// Upload image //////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($upload) && !empty($_FILES["ufile"]["tmp_name"])){ 

upload_single_image("ufile", "{$id}pic", "../images/users/", "150", "150");

$activity = "Changed own picture.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$db->insert($audit_data_array, "admin_log");

$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Picture successfully updated.</div>";
redirect("profile.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($profile) && !empty($name) && !empty($address) && !empty($country) && !empty($phone) && test_phone($phone) >= 5){

$data_array = array(
"name" => $name,
"address" => $address,
"country" => $country,
"phone" => $phone
);
$act = $db->update($data_array, "reg_members", "email = '$user_email'");
$_SESSION["name"] = $name;

if($act){
$activity = "Updated profile data.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$db->insert($audit_data_array, "admin_log");

$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Profile successfully updated.</div>";
redirect("profile.php");
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error occured.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($profile) && (empty($name) or empty($address) or empty($country) or empty($phone))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! All the fields are required.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($profile) && !empty($phone) && test_phone($phone) < 5){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! Phone number must be at least 5 digits.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($profile) && !empty($dob) && !test_date($dob)){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! Invalid  date of birth format.</div>";
}

if(isset($_SESSION["msg"]) && empty($edit) && empty($upload)){
echo $_SESSION["msg"];
$_SESSION["msg"] = NULL;
unset($_SESSION["msg"]);
}
?>

<?php if(empty($edit)){ 
?>

<div class="page-title">Profile</div>

<?php
$result = $db->select("reg_members", "Where email = '{$user_email}'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$id = $row["id"];
$address = (!empty($row["address"]))?$row["address"]:"Not specified";
$country = ($row["country"] > 0)?get_table_data("countries", $row["country"], "country"):"Not specified";
$phone = (!empty($row["phone"]))?$row["phone"]:"Not specified";
$gender = (!empty($row["gender"]))?$row["gender"]:"Not specified";
$date = sub_date($row["date"]);
$active = ($row["status"] == 1)?"Active":"Not active";
$date_time = full_date($row["last_login"]);
?>
<style>
<!--
div table thead tr th, div table tr th, div table tbody tr td, div table tr td{
text-align:left !important;
}
-->
</style>
<table class="table table-striped table-hover">
<tr><td style="width:160px;" class="gen-title">
<?php
$file_array = glob("../images/users/{$id}pic*.jpg");
$file_name = ($file_array)?$file_array[0]:"../images/post.jpg";
?>
<img src="<?php echo $file_name; ?>" >
</td><td>
<form action="profile.php" class="img-form" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
<input type="hidden" name="upload" value="1">                      
<p><b>Format: </b></p>
<p><i>.jpg, .gif, .png, .jpeg, Not more than 5MB</i><br /><br /></p>
<input type="file" name="ufile" id="ufile" required>
<label for="ufile" id="pic-label" class="btn gen-btn" ><i class="fa fa-upload" aria-hidden="true"></i> Change picture</label>
</form></td><td>
<p><b>User ID:</b> <?php echo $id; ?></p>
<p><b>Account Status:</b> <?php echo $active; ?></p>
<p><b>Date Registered:</b> <?php echo $date; ?></p>
<p><b>Last Login:</b> <?php echo $date_time; ?></p>
</td></tr>
<tr><td class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> Full Name</td><td colspan="2"><?php echo $username; ?></td></tr>
<tr><td class="gen-title"><i class="fa fa-envelope" aria-hidden="true"></i> Email</td><td colspan="2"><?php echo $user_email; ?></td></tr>
<tr><td class="gen-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Address</td><td colspan="2"><?php echo $address; ?></td></tr>
<tr><td class="gen-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Country</td><td colspan="2"><?php echo $country; ?></td></tr>
<tr><td class="gen-title"><i class="fa fa-phone" aria-hidden="true"></i> Mobile Number</td><td colspan="2"><?php echo $phone; ?></td></tr>
</table>
<div class="bottom-edit"><a href="profile.php?edit=<?php echo $id; ?>" class="btn gen-btn float-right">Edit Profile</a></div>
<?php
}
} 
?>

<?php if(!empty($edit)){ 
$result = $db->select("reg_members", "Where id = '{$edit}'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$name = $row["name"];
$address = $row["address"];
$country = $row["country"];
$phone = $row["phone"];
?>

<div><a href="profile.php" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back to profile</a></div>

<form action="profile.php" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
<div class="gen-title">Edit Your Profile</div>    
<input type="hidden" name="edit" value="<?php echo $edit; ?>">
<input type="hidden" name="profile" value="1">
    
<div class="col-md-6">
<label for="name">Full Name</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user"></i></span>
<input type="text" name="name" id="name" class="form-control" placeholder="Type your full name/company name" value="<?php check_inputted("name", $name); ?>" required>
</div>
</div>

<div class="col-md-6">
<label for="phone">Mobile Number</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-phone"></i></span>
<input type="text" name="phone" id="phone" maxlength="11" class="form-control only-no" placeholder="Mobile Number" required value="<?php check_inputted("phone", $phone); ?>">
</div>
</div>

<div class="col-md-6">
<label for="country">Country</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
<select name="country" id="country" title="Select a country" class="form-control" style="width:100%" required>
<option value="">**Select a country**</option>
<?php 
$result2 = $db->select("countries", "", "DISTINCT *", "ORDER BY country ASC");
if(count_rows($result2) > 0){
while($row2 = fetch_data($result2)){
$country_id = $row2["id"];
$country2 = $row2["country"];
echo "<option value='{$country_id}'";
check_selected("country", $country_id, $country); 
echo ">{$country2}</option>";
}
}
?>
</select>
</div>
</div>

<div class="col-md-6">
<label for="address">Address</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
<textarea type="text" name="address" id="address" rows="1" class="form-control" placeholder="Your Contact Address" required value=""><?php check_inputted("address", $address); ?></textarea>
</div>
</div>
                     
<div class="submit-div col-md-12">
<button class="btn gen-btn float-right" name="update"><i class="fa fa-upload"></i> Update</button>
</div>
</form>
<?php
}
} 
?>

</div>
</div>

</div>

<?php require_once("../includes/portal-footer.php"); ?>