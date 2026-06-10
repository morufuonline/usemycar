<?php include_once("../includes/user-header.php"); ?> 

<?php
$view = nr_input("view");
////////////////////////////////////////////////////******************************//////////////

$result = $db->select("p_notes", "WHERE user_id = '$id'", "*", "ORDER BY id DESC");

$per_view = 20;
$page_link = "payment-notifications.php?pn=";
$link_suffix = "";
$style_class = "";
page_numbers();

if(isset($_SESSION["msg"]) && empty($sold) && empty($invoice_no)){
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
$offset = ($per_view * $pn) - $per_view;
$result = $db->select("p_notes", "WHERE user_id = '$id'", "*", "ORDER BY id DESC", "LIMIT {$offset},{$per_view}");

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
<th>More</th>
</tr>
</thead>
<tbody>
<?php
while($row = fetch_data($result)){
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
$status = "<button type='button' class='btn btn-success'><i class='fa fa-check' aria-hidden='true'></i> Approved</button>";
}else{
$status = "<button type='button' class='btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i> Not Approved</button>";
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
<td><a href="payment-notifications.php?view=<?php echo $note_id; ?>&pn=<?php echo $pn; ?>" class="btn gen-btn" title="View more on order #<?php echo $invoice_no; ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
</tr>
<?php 
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