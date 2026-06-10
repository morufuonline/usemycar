<?php include_once("../includes/user-header.php"); ?> 

<?php
$view = nr_input("view");
$notify = nr_input("notify");
$pay = nr_input("pay");

$invoice_no = tp_input("invoice_no");
$plan = tp_input("plan");
$payment_date = tp_input("payment_date");
$payment_mode = np_input("payment_mode");
$bank = np_input("bank");
$bank_ref = tp_input("bank_ref");

/////////////////////////////////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($notify) && !empty($invoice_no) && !empty($plan) && !empty($payment_date) && !empty($payment_mode) && !empty($bank) && !empty($bank_ref)){

$data_array = array(
"user_id" => "'$id'",
"invoice_no" => "'$invoice_no'",
"plan" => "'$plan'",
"payment_date" => "'$payment_date'",
"payment_mode" => "'$payment_mode'",
"bank" => "'$bank'",
"bank_ref" => "'$bank_ref'"
);
$act = $db->insert($data_array, "p_notes");

$activity = "Made a notiicaion for order {$invoce_no}.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$act = $db->insert($audit_data_array, "admin_log");

$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Notificaion successfully sent.</div>";
redirect("my-orders.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($notify) && !empty($invoice_no) && !empty($plan) && (empty($payment_date) or empty($payment_mode) or empty($bank) or empty($bank_ref))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! All the fields are required.</div>";
}

////////////////////////////////////////////////////******************************//////////////

$result = $db->select("plan_orders", "WHERE user_id = '$id'", "*", "ORDER BY id DESC");

$per_view = 20;
$page_link = "my-orders.php?pn=";
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
if(empty($notify)){
?>

<div class="page-title">Plan Orders</div>

<?php
$offset = ($per_view * $pn) - $per_view;
$result = $db->select("plan_orders", "WHERE user_id = '$id'", "*", "ORDER BY id DESC", "LIMIT {$offset},{$per_view}");

if(count_rows($result) > 0){
?>
<table class="table table-striped table-hover">
<thead>
<tr class="gen-title">
<th>Invoice No.</th>
<th>Plan</th>
<th>Units</th>
<th>Amount</th>
<th>Date Ordered</th>
<th>Status</th>
<th>Payment</th>
<th>GTpay</th>
</tr>
</thead>
<tbody>
<?php
while($row = fetch_data($result)){
$ad_id = $row["id"];
$invoice_no = $row["invoice_no"];
$plan = $row["plan"];
$plan_title = in_table("plan","plans","WHERE id = '$plan'","plan");
$plan_units = in_table("units","plans","WHERE id = '$plan'","units");
$plan_amount = in_table("amount","plans","WHERE id = '$plan'","amount");
$date_time = min_full_date($row["date_time"]);
$sta = $row["confirmed"];
$status = "";
if($sta == 1){
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
<td><?php echo $date_time; ?></td>
<td><?php echo $status; ?></td>
<td><?php if($sta == 0){ ?>
<a href="my-orders.php?notify=<?php echo $ad_id; ?>&pn=<?php echo $pn; ?>" class="btn gen-btn" title="Notify us of payment for order #<?php echo $invoice_no; ?>"><i class="fa fa-bull-horn" aria-hidden="true"></i> Notify Us</a>
<?php } ?></td>
<td><?php if($sta == 0){ ?>
<a href="my-orders.php?pay=<?php echo $ad_id; ?>&pn=<?php echo $pn; ?>" class="btn gen-btn" title="Use GTPay to pay for order #<?php echo $invoice_no; ?>"><i class="fa fa-money" aria-hidden="true"></i> Pay</a>
<?php } ?></td>
</tr>
<?php 
}
?>
</tbody>
</table>
<?php
echo ($last_page>1)?"<div class=\"page-nos\">" . $center_pages . "</div>":"";
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'>No orders found at the moment.</div>";
}

}

if(!empty($notify) && $error == 1){
$invoice_no = in_table("invoice_no","plan_orders","WHERE id = '$notify' AND user_id = '$id'","invoice_no");
$plan = in_table("plan","plan_orders","WHERE id = '$notify' AND user_id = '$id'","plan");
if(!empty($invoice_no)){
$plan_title = in_table("plan","plans","WHERE id = '$plan'","plan");
$plan_units = in_table("units","plans","WHERE id = '$plan'","units");
$plan_amount = in_table("amount","plans","WHERE id = '$plan'","amount");
?>
<div><a href="my-orders.php?pn=<?php echo $pn; ?>" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back to orders list</a></div>

<form action="my-orders.php" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
<div class="gen-title">Send Payment Notification on Order <?php echo "{$invoice_no} ({$plan_title} - &#8358;" . formatNumber($plan_amount) . " for " . formatQty($plan_units) . " units)"; ?>. </div>    
<input type="hidden" name="notify" value="<?php echo $notify; ?>">
<input type="hidden" name="invoice_no" value="<?php echo $invoice_no; ?>">
<input type="hidden" name="plan" value="<?php echo $plan; ?>">
    
<div class="col-md-6">
<label for="payment_date">Payment Date*</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
<input type="text" name="payment_date" id="payment_date" class="form-control gen-date" placeholder="Format: YYYY-MM-DD" value="<?php check_inputted("payment_date"); ?>" required onClick="javascript: $(this).blur();">
</div>
</div>

<div class="col-md-6">
<label for="payment_mode">Payment Mode*</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-money"></i></span>
<select name="payment_mode" id="payment_mode" title="Select a payment mode" class="form-control" required>
<option value="">**Select a payment mode**</option>
<?php 
$result = $db->select("payment_modes", "", "DISTINCT *", "ORDER BY order_id ASC");
if(count_rows($result) > 0){
while($row = fetch_data($result)){
$mode_id = $row["id"];
$mode = $row["mode"];
echo "<option value='{$mode_id}'";
check_selected("payment_mode", $mode_id); 
echo ">{$mode}</option>";
}
}
?>
</select>
</div>
</div>

<div class="col-md-6">
<label for="bank">Bank*</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-building"></i></span>
<select name="bank" id="bank" title="Select a bank" class="form-control" required>
<option value=""> - - Select a bank - - </option>
<?php 
$result = $db->select("banks", "", "DISTINCT *", "ORDER BY bank_name ASC");
if(count_rows($result) > 0){
while($row = fetch_data($result)){
$bank_id = $row["id"];
$bank_name = $row["bank_name"];
echo "<option value='{$bank_id}'";
check_selected("bank", $bank_id); 
echo ">{$bank_name}</option>";
}
}
?>
</select>
</div>
</div>


<div class="col-md-6">
<label for="bank_ref">Bank Reference Number*</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-code"></i></span>
<input type="text" name="bank_ref" id="bank_ref" class="form-control" placeholder="" value="<?php check_inputted("bank_ref"); ?>" required>
</div>
</div>
                     
<div class="submit-div col-md-12">
<button class="btn gen-btn float-right" name="update"><i class="fa fa-upload"></i> Send</button>
</div>
</form>

<?php } } ?>






</div>
</div>

</div>

<?php require_once("../includes/portal-footer.php"); ?>