<?php include_once("../includes/admin-header.php"); ?> 

<?php
$view = nr_input("view");

$confirm = nr_input("confirm");

/////////////////////////////////////////////////////////////////////////////////////////
if(!empty($confirm)){

$invoice_no = in_table("invoice_no","p_notes","WHERE id = '$confirm'","invoice_no");

$user_id = in_table("user_id","plan_orders","WHERE invoice_no = '$invoice_no'","user_id");
$plan = in_table("plan","plan_orders","WHERE invoice_no = '$invoice_no'","plan");
$confirmed = in_table("confirmed","plan_orders","WHERE invoice_no = '$invoice_no'","confirmed");

$tb_plan = in_table("tb_plan","plans","WHERE id = '$plan'","tb_plan");
$units = in_table("units","plans","WHERE id = '$plan'","units");

if($confirmed > 0){

$db->query("UPDATE p_notes SET cancelled = '1' WHERE id = '{$confirm}'");

$activity = "Cancelled payment for plan #{$invoice_no}.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$db->insert($audit_data_array, "audit_log");

$_SESSION["msg"] = "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not successful. Plan order previously approved. Payment notification has been cancelled</div>";
redirect("payment-notifications.php?pn={$pn}");

}else{
	
$act1 = $db->query("UPDATE reg_members SET $tb_plan = $tb_plan + '$units' WHERE id = '{$user_id}'");
$act2 = $db->query("UPDATE plan_orders SET confirmed = '1' WHERE invoice_no = '$invoice_no'");
$act3 = $db->query("UPDATE p_notes SET confirmed = '1' WHERE id = '{$confirm}'");

if($act1 && act2 && act3){
$activity = "Approved plan #{$invoice_no} with payment confirmation.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$db->insert($audit_data_array, "audit_log");

$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Plan order successfully approved.</div>";
redirect("payment-notifications.php?pn={$pn}");
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error. Unable to approve plan order.</div>";
}

}

}

////////////////////////////////////////////////////******************************//////////////

$result = $db->select("p_notes", "", "*", "ORDER BY id DESC");

$per_view = 20;
$page_link = "payment-notifications.php?pn=";
$link_suffix = "";
$style_class = "";
page_numbers();

if(isset($_SESSION["msg"]) && empty($confirm)){
echo $_SESSION["msg"];
$_SESSION["msg"] = NULL;
unset($_SESSION["msg"]);
}
?>

<?php
if(empty($view)){
?>

<div class="page-title">Payment Notifications</div>

<?php
$c = 0;
if(count_rows($result) > 0){
?>
<table class="table table-striped table-hover">
<thead>
<tr class="gen-title">
<th>Invoice No.</th>
<th>Plan</th>
<th>Units</th>
<th>Amount(&#8358;)</th>
<th>Payment Date</th>
<th>Notification Date</th>
<th>Status</th>
<th>Action</th>
<th>More</th>
</tr>
</thead>
<tbody>
<?php
while($row = fetch_data($result)){
$c++;
if($c>$sub1*$per_view && $c<=$pn*$per_view){
$note_id = $row["id"];
$invoice_no = $row["invoice_no"];
$plan = $row["plan"];
$plan_title = in_table("plan","plans","WHERE id = '$plan'","plan");
$plan_units = in_table("units","plans","WHERE id = '$plan'","units");
$plan_amount = in_table("amount","plans","WHERE id = '$plan'","amount");
$payment_date = min_sub_date($row["payment_date"]);
$notification_date = min_full_date($row["notification_date"]);
$cancelled = $row["cancelled"];
$sta = $row["confirmed"];
$status = "";
if($cancelled == 1){
$status = "<button type='button' class='btn btn-warning'><i class='fa fa-times' aria-hidden='true'></i> Cancelled</button>";
}else if($sta == 1){
$status = "<button type='button' class='btn btn-success'><i class='fa fa-check' aria-hidden='true'></i> Confirmed</button>";
}else{
$status = "<button type='button' class='btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i> Not Confirmed</button>";
}
?>
<tr>
<td><?php echo $invoice_no ?></td>
<td><?php echo $plan_title; ?></td>
<td><?php echo formatQty($plan_units); ?></td>
<td><?php echo formatNumber($plan_amount); ?></td>
<td><?php echo $payment_date; ?></td>
<td><?php echo $notification_date; ?></td>
<td><?php echo $status; ?></td>
<td><?php if($sta == 0 && $cancelled == 0){ ?>
<a onClick="javascript: return confirm('Are you sure you want to confirm this payment notification?')" href="payment-notifications.php?confirm=<?php echo $note_id; ?>&pn=<?php echo $pn; ?>" class="btn gen-btn" title="Confirm payment notification for inv. no. #<?php echo $invoice_no; ?>"><i class="fa fa-check" aria-hidden="true"></i> Confirm</a>
<?php } ?></td>
<td><a href="payment-notifications.php?view=<?php echo $note_id; ?>&pn=<?php echo $pn; ?>" class="btn gen-btn" title="View more on payment notification for inv. no. #<?php echo $invoice_no; ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
</tr>
<?php 
}
}
?>
</tbody>
</table>
<?php
echo ($last_page>1)?"<div class=\"page-nos\">" . $center_pages . "</div>":"";
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'>No notifications found at the moment.</div>";
}

}

if(!empty($view)){
?>

<style>
<!--
div table thead tr th, div table tr th, div table tbody tr td, div table tr td{
text-align:left !important;
}
-->
</style>
<div><a href="payment-notifications.php?pn=<?php echo $pn; ?>" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back to notifications list</a></div>

<div class="page-title">Complete Details of Payment Notification</div>

<?php
$result = $db->select("p_notes", "WHERE id = '$view' AND user_id = '$id'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);

$note_id = $row["id"];
$invoice_no = $row["invoice_no"];
$plan = $row["plan"];
$plan_title = in_table("plan","plans","WHERE id = '$plan'","plan");
$plan_units = in_table("units","plans","WHERE id = '$plan'","units");
$plan_amount = in_table("amount","plans","WHERE id = '$plan'","amount");
$payment_date = sub_date($row["payment_date"]);
$payment_mode = $row["payment_mode"];
$payment_mode = in_table("mode","payment_modes","WHERE id = '$payment_mode'","mode");
$bank = $row["bank"];
$bank = in_table("bank_name","banks","WHERE id = '$bank'","bank_name");
$bank_ref = $row["bank_ref"];
$notification_date = full_date($row["notification_date"]);
$cancelled = $row["cancelled"];
$sta = $row["confirmed"];
$status = "";
if($cancelled == 1){
$status = "<button type='button' class='btn btn-warning'><i class='fa fa-times' aria-hidden='true'></i> Cancelled</button>";
}else if($sta == 1){
$status = "<button type='button' class='btn btn-success'><i class='fa fa-check' aria-hidden='true'></i> Approved</button>";
}else{
$status = "<button type='button' class='btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i> Not Approved</button>";
}
?>
<table class="table table-striped table-hover">
<tbody>
<tr><td class="gen-title" style="width:150px;">Invoice No.</td><td><?php echo $invoice_no ?></td></tr>
<tr><td class="gen-title">Plan</td><td><?php echo $plan_title; ?></td></tr>
<tr><td class="gen-title">Units</td><td><?php echo formatQty($plan_units); ?></td></tr>
<tr><td class="gen-title">Amount(&#8358;)</td><td><?php echo formatNumber($plan_amount); ?></td></tr>
<tr><td class="gen-title">Payment Date</td><td><?php echo $payment_date; ?></td></tr>
<tr><td class="gen-title">Payment Mode</td><td><?php echo $payment_mode; ?></td></tr>
<tr><td class="gen-title">Bank</td><td><?php echo $bank; ?></td></tr>
<tr><td class="gen-title">Bank Ref.</td><td><?php echo $bank_ref; ?></td></tr>
<tr><td class="gen-title">Notification Date</td><td><?php echo $notification_date; ?></td></tr>
<tr><td class="gen-title">Status</td><td><?php echo $status; ?></td></tr>
</tbody>
</table>
<?php
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'>This notification does not exist.</div>";
}

}
?>

</div>
</div>

</div>

<?php require_once("../includes/portal-footer.php"); ?>