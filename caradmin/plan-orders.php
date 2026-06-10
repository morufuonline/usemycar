<?php include_once("../includes/admin-header.php"); ?> 

<?php
$result = $db->select("plan_orders", "", "*", "ORDER BY id DESC");

$per_view = 20;
$page_link = "plan-orders.php?pn=";
$link_suffix = "";
$style_class = "";
page_numbers();
?>

<?php
if(empty($notify)){
?>

<div class="page-title">Plan Orders</div>

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
<th>Amount</th>
<th>Date Ordered</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php
while($row = fetch_data($result)){
$c++;
if($c>$sub1*$per_view && $c<=$pn*$per_view){
$order_id = $row["id"];
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
echo "<div class='alert alert-danger alert-dismissable fade in'>No orders found at the moment.</div>";
}

}
?>

</div>
</div>

</div>

<?php require_once("../includes/portal-footer.php"); ?>