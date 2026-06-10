<?php include_once("../includes/admin-header.php"); ?> 

<?php

$view = nr_input("view");
$sold = nr_input("sold");
$approve = nr_input("approve");

/////////////////////////////////////////////////////////////////////////////////////////
if(!empty($sold)){
	
$act = $db->query("UPDATE sellable_cars SET status = '2' WHERE id = '{$sold}'");

if($act){
$activity = "Marked a car as sold.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$db->insert($audit_data_array, "audit_log");

$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Car successfully marked as sold.</div>";
redirect("cars-for-sales.php?pn={$pn}");
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error. Unable to mark car as sold.</div>";
}

}

/////////////////////////////////////////////////////////////////////////////////////////
if(!empty($approve)){
	
$act = $db->query("UPDATE sellable_cars SET status = '1' WHERE id = '{$approve}'");

if($act){
$activity = "Approved a car add.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$db->insert($audit_data_array, "audit_log");

$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Car ad successfully approved.</div>";
redirect("cars-for-sales.php?pn={$pn}");
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error. Unable to approved car ad.</div>";
}

}

////////////////////////////////////////////////////******************************//////////////

$result = $db->select("sellable_cars", "", "*", "ORDER BY id DESC");

$per_view = 20;
$page_link = "cars-for-sales.php?pn=";
$link_suffix = "";
$style_class = "";
page_numbers();

if(isset($_SESSION["msg"]) && empty($sold)){
echo $_SESSION["msg"];
$_SESSION["msg"] = NULL;
unset($_SESSION["msg"]);
}
?>

<?php
if(empty($view)){
?>

<div class="page-title">Cars for Sale</div>

<?php
$c = 0;
$d = 0;
if(count_rows($result) > 0){
?>
<table class="table table-striped table-hover">
<thead>
<tr class="gen-title">
<th style="width:100px;">Featured</th>
<th>Details</th>
<th>Plan</th>
<th>Date Posted</th>
<th>Status</th>
<th>Mark as Sold</th>
<th>Action</th>
<th>More</th>
</tr>
</thead>
<tbody>
<?php
while($row = fetch_data($result)){
$c++;
if($c>$sub1*$per_view && $c<=$pn*$per_view){
$ad_id = $row["id"];
$plan = $row["plan"];
$plan_title = in_table("plan","plans","WHERE id = '$plan'","plan");
$brand = $row["brand"];
$model = $row["model"];
$year = $row["year"];
$date_posted = min_full_date($row["date_posted"]);
$sta = $row["status"];
$status = "";
if($sta == 1){
$status = "<button type='button' class='btn btn-success'><i class='fa fa-check' aria-hidden='true'></i> Approved</button>";
}else if($sta == 2){
$status = "<button type='button' class='btn btn-warning'><i class='fa fa-trash' aria-hidden='true'></i> Sold</button>";
}else{
$status = "<button type='button' class='btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i> Not Approved</button>";
}
$file_name_aray = glob("../images/ads-featured/{$ad_id}_{$id}_ad_featured_*.jpg");
$file_name = $file_name_aray[0];
?>
<tr>
<td><img src="<?php echo $file_name ?>" /></td>
<td><?php echo "{$brand} {$model} {$year}"; ?></td>
<td><?php echo $plan_title; ?></td>
<td><?php echo $date_posted; ?></td>
<td><?php echo $status; ?></td>
<td><?php if($sta == 1){ ?>
<a onClick="javascript: return confirm('Are you sure you have sold this car?')" href="cars-for-sales.php?sold=<?php echo $ad_id; ?>&pn=<?php echo $pn; ?>" class="btn gen-btn" title="Mark ad #<?php echo $ad_id; ?> as sold"><i class="fa fa-check" aria-hidden="true"></i> Mark</a>
<?php } ?></td>
<td><?php if($sta == 0){ ?>
<a onClick="javascript: return confirm('Are you sure you want to approve this car?')" href="cars-for-sales.php?approve=<?php echo $ad_id; ?>&pn=<?php echo $pn; ?>" class="btn gen-btn" title="Approve ad #<?php echo $ad_id; ?>"><i class="fa fa-check" aria-hidden="true"></i> Approve</a>
<?php } ?></td>
<td><a href="cars-for-sales.php?view=<?php echo $ad_id; ?>&pn=<?php echo $pn; ?>" class="btn gen-btn" title="View ad #<?php echo $ad_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
</tr>
<?php 
$d++;
}
}
?>
</tbody>
</table>
<?php
echo ($last_page>1)?"<div class=\"page-nos\">" . $center_pages . "</div>":"";
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'>No messages found at the moment.</div>";
}

}

//=======================View Post==============================//
if(!empty($view)){
$result = $db->select("sellable_cars", "WHERE id='$view'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$ad_id = $row["id"];
$plan = $row["plan"];
$plan_title = in_table("plan","plans","WHERE id = '$plan'","plan");
$brand = $row["brand"];
$model = $row["model"];
$year = $row["year"];
$trim = $row["trim"];
$fuel = $row["fuel"];
$doors = $row["doors"];
$transmission = $row["transmission"];
$type = $row["type"];
$engine = $row["engine"];
$power = $row["power"];
$veh_condition = $row["veh_condition"];
$mileage = $row["mileage"];
$specs = $row["specs"];
$colour = $row["colour"];
$price = $row["price"];
$state = $row["state"];
$local_government = $row["local_government"];
$equipment = $row["equipment"];
$description = $row["description"];
$contact_name = $row["contact_name"];
$contact_email = $row["contact_email"];
$contact_phone = $row["contact_phone"];
$date_posted = min_full_date($row["date_posted"]);
$date_time = $row["date_time"];
$status = "";
if($row["status"] == 1){
$status = "<button type='button' class='btn btn-success'><i class='fa fa-check' aria-hidden='true'></i> Approved</button>";
}else if($row["status"] == 2){
$status = "<button type='button' class='btn btn-warning'><i class='fa fa-trash' aria-hidden='true'></i> Sold</button>";
}else{
$status = "<button type='button' class='btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i> Not Approved</button>";
}
$slide_aray1 = glob("../images/ads-featured/{$ad_id}_{$id}_ad_featured_*.jpg");
$slide_aray2 = glob("../images/ads-displayed/{$ad_id}_{$id}_ad_displayed_*.jpg");
$file_name = $slide_aray1[0];
?>

<style>
<!--
div table thead tr th, div table tr th, div table tbody tr td, div table tr td{
text-align:left !important;
}
-->
</style>

<div class="reply-content-wrapper ">

<div><a href="cars-for-sales.php?pn=<?php echo $pn; ?>" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back to Car Sales Ads</a></div>

<div class="view-wrapper ">

<div class="view-header ">
<div class="header-img"><img src="<?php echo $file_name; ?>" ></div>
<div class="header-content">
<div class="view-title"><?php echo "{$brand} {$model} {$year} at {$local_government}, {$state}, Nigeria"; ?></div>
<div class="view-title-details">Added for <?php echo "{$contact_name} ({$contact_email} - {$contact_phone}) on {$date_posted}"; ?></div>
</div>
</div>

<div class="view-content">

<div class="col-md-8">

<div class="price">&#8358;<?php echo formatNumber($price); ?></div>

<div class="fotorama" data-width="600" data-ratio="3/2" data-nav="thumbs" data-thumbheight="48">
<?php $c = 0;
foreach($slide_aray2 as $val){
if(file_exists($val)){
?>
<a href="<?php echo $val; ?>"><img src="<?php echo (file_exists($slide_aray1[$c]))?$slide_aray1[$c]:""; ?>"></a>
<?php
}
$c++;
}
?>
</div> 

</div>
<div class="col-md-4">
<h3>Features</h3>
<table class="table table-striped table-hover">
<tbody>
<tr><td><b>Trim</b></td><td><?php echo $trim; ?></td></tr>
<tr><td><b>Fuel</b></td><td><?php echo $fuel; ?></td></tr>
<tr><td><b>Doors</b></td><td><?php echo $doors; ?></td></tr>
<tr><td><b>Transmission</b></td><td><?php echo $transmission; ?></td></tr>
<tr><td><b>Type</b></td><td><?php echo $type; ?></td></tr>
<tr><td><b>Engine</b></td><td><?php echo $engine; ?> CC</td></tr>
<tr><td><b>Power</b></td><td><?php echo $power; ?> HP</td></tr>
<tr><td><b>Condition</b></td><td><?php echo $veh_condition; ?></td></tr>
<tr><td><b>Mileage</b></td><td><?php echo $mileage; ?> Kms</td></tr>
<tr><td><b>Specs</b></td><td><?php echo $specs; ?></td></tr>
<tr><td><b>Colour</b></td><td><?php echo $colour; ?></td></tr>
<tr><td><b>Status</b></td><td><?php echo $status; ?></td></tr>
</tbody>
</table>
</div>

<div class="details-tab">
<a class="current" id="description">Description</a>
<a class="" id="equipment">Equipment</a>
</div>

<div class="details-div" id="description-div"><?php echo $description; ?></div>

<div class="details-div" id="equipment-div">
<?php
$equipment_array = explode("+*/-", $equipment);
$equipment_val = "";
foreach($equipment_array as $val){
$equipment_val .= (!empty($val))?"{$val}, ":"";
}
echo substr($equipment_val,0,-2);
?>
</div>


</div>

</div>
</div>

<?php
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'>This ad does not exist.</div>";
}
}
?>

</div>
</div>

</div>

<?php require_once("../includes/portal-footer.php"); ?>