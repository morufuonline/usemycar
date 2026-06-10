<?php require_once("../includes/header2.php");  ?>
      <section id="opal-breadscrumb" class="opal-breadscrumb" style=""><div class="container"><h2 class="title-page">Sell Your Car</h2>
      <ol class="breadcrumb has-title-page">
         <li><a href="../">Home</a> </li>
         <li class="active">Sell Your Car</li>

      </ol></div>
   </section>
      <div class="news-head">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
               <?php include_once("../includes/daily-news.php"); ?>
               </div>
            </div>
         </div>
      </div>

<?php
$plan = nr_input("plan");
$mode_of_payment = np_input("mode_of_payment");

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION["login"]) && !empty($plan) && !empty($mode_of_payment)){

$data_array = array(
"user_id" => "'$id'",
"plan" => "'$plan'",
"date_time" => "'$date_time'"
);
$act = $db->insert($data_array, "plan_orders");

$plan_id = in_table("id","plan_orders","WHERE user_id = '$id' AND date_time = '$date_time'","id");
$plan_invoice = plan_inv($plan_id);
$db->query("UPDATE plan_orders SET invoice_no = '$plan_invoice' WHERE id = '{$plan_id}'");

$activity = "Placed an order with invoice number {$plan_invoice}.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$act = $db->insert($audit_data_array, "admin_log");

if($mode_of_payment == 1){
$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Your order is pending. Kindly make use of the \"Notify Us\" link under the \"Payment\" column on the row where the plan invoice number exists below, to notify us of your payment for the plan after the payment has been made.<br><br> OR <br><br>Click on the \"Pay\" link under the \"GTPay\" column to make instant online payment for the plan order.<br><br><b>NOTE:</b> You must make payment before your order would be confirmed.</div>";
redirect("../members/my-orders.php");
}else if($mode_of_payment == 2){
$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Your order is pending. Kindly make use of the \"Notify Us\" link under the \"Payment\" column on the row where the plan invoice number exists below, to notify us of your payment for the plan after the payment has been made.<br><br> OR <br><br>Click on the \"Pay\" link under the \"GTPay\" column to make instant online payment for the plan order.<br><br><b>NOTE:</b> You must make payment before your order would be confirmed.</div>";
redirect("../members/my-orders.php");
}

}
?>

<style>
<!--
.units{
	font-size:25px;
	font-weight:bold;
}
input[type=radio] {
    display: none;
}
.notes{
	margin:10px;
	line-height:normal
}
.amount{
	color:#f11;
	font-size:25px;
	padding:10px;
	padding-top:0px;
	padding-bottom:20px;
}
-->
</style>

      <div class="content">
         <div class="sell-car">
          <div class="container">
            <div class="row">
             
<?php if(empty($plan)){ ?>
                    <div class="col-md-12 clearfix">
                      <div class="border-content clearfix">
                      <div class="title-section">PLEASE SELECT THE PLAN TO BUY</div>
                      <div id="checkout-div">

                        <div class="box">

                                <div class="content-inner-tab package">
                       <div class="row">
                       <div class="pricing-table three-cols margin-0">
                       
                     <div class="pricing-column">
                     <h3><?php echo in_table("plan","plans","WHERE id = '2'","plan"); ?></h3>
                     <div class="pricing-column-content">
                           <h4><span class="dollar-sign">&#8358;</span> <?php echo formatNumber(in_table("amount","plans","WHERE id = '2'","amount")); ?></h4>
                           <ul class="features">
                              <li class="units"><?php echo formatQty(in_table("units","plans","WHERE id = '2'","units")); ?> Unit(s)</li>
                           </ul>
                           <a class="btn btn-primary" href="sellable-plans.php?plan=2"><i class="fa fa-upload" aria-hidden="true"></i> Pay </a>
                        </div>
                     </div>
                     
                     <div class="pricing-column">
                     <h3><?php echo in_table("plan","plans","WHERE id = '3'","plan"); ?></h3>
                     <div class="pricing-column-content">
                           <h4><span class="dollar-sign">&#8358;</span> <?php echo formatNumber(in_table("amount","plans","WHERE id = '3'","amount")); ?></h4>
                           <ul class="features">
                              <li class="units"><?php echo formatQty(in_table("units","plans","WHERE id = '3'","units")); ?> Unit(s)</li>
                           </ul>
                           <a class="btn btn-primary" href="sellable-plans.php?plan=3"><i class="fa fa-upload" aria-hidden="true"></i> Pay </a>
                        </div>
                  </div>
                  
                    <div class="pricing-column highlight accent-color">
                        <h3><?php echo in_table("plan","plans","WHERE id = '4'","plan"); ?> <span class="highlight-reason">Most Popular</span></h3>
                        <div class="pricing-column-content">
                           <h4><span class="dollar-sign">&#8358;</span> <?php echo formatNumber(in_table("amount","plans","WHERE id = '4'","amount")); ?></h4>
                           <ul class="features">
                              <li class="units"><?php echo formatQty(in_table("units","plans","WHERE id = '4'","units")); ?> Unit(s)</li>
                           </ul>
                            <a class="btn btn-primary" href="sellable-plans.php?plan=4"><i class="fa fa-upload" aria-hidden="true"></i> Pay </a>
                        </div>
                     </div>
                     
                </div>
                                        
                                    </div>
                                    <!-- /.row -->
                                </div>
                                
                        </div>
                        <!-- /.box -->

</div>
                    </div></div>
                    <!-- /.col-md-9 -->
<?php }

if(!empty($plan)){ 
$plan_title = in_table("plan","plans","WHERE id = '$plan'","plan");
$plan_units = in_table("units","plans","WHERE id = '$plan'","units");
$plan_amount = in_table("amount","plans","WHERE id = '$plan'","amount");
?>

                    <div class="col-md-12 clearfix">
                      <div class="border-content clearfix">
                      <div class="title-section">PLEASE SELECT THE MODE OF PAYMENT</div>
                      <div id="checkout-div">

                        <div class="box">

                                <div class="content-inner-tab package">
                       <div class="row">
                       <div class="pricing-table three-cols margin-0 add-car-form">
                       
                       <p class="amount"><?php echo "{$plan_title} - &#8358;" . formatNumber($plan_amount) . " (" . formatQty($plan_units) . " units)"; ?></p>
                            <form method="post" action="sellable-plans.php" runat="server" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="plan" value="<?php echo $plan; ?>" required>
                       
                                        <div class="col-sm-4">
                <div class="checkbox">
                  <label>
                    <input type="radio" name="mode_of_payment" value="1" <?php check_checked("mode_of_payment", 1); ?> required>
                    <div></div>
                    Bank Deposit/Cheque:
                    <p class="notes">This includes payment through any of the following means:</p>
                    <p class="notes"><ul type="disc">
					<?php 
                    $result = $db->select("payment_modes", "", "DISTINCT *", "ORDER BY order_id ASC");
                    if(count_rows($result) > 0){
                    while($row = fetch_data($result)){
                    $mode = $row["mode"];
                    echo "<li>{$mode}</li>";
                    }
                    }
                    ?>
                    </ul></p>
                  </label>
                </div>
                                        </div>
                                        <div class="col-sm-4">
                <div class="checkbox">
                  <label>
                    <input type="radio" name="mode_of_payment" value="2" <?php check_checked("mode_of_payment", 2); ?> required>
                    <div></div>
                    GTPay
                    <p class="notes">This allows you to make instant payment via online payment integration.</p>
                    <p class="notes">If the payment is successful and your account has been debited with the stipulated amount, your e-wallet balance will be increased with the value of the units specified for your selected plan.</p>
                  </label>
                </div>
                                        </div>
                                        <div class="col-sm-4">

                                <div class="box-footer">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-template-main">Continue <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                    </div>
                                </div>

                                        </div>
                                        
                </div>
                </form>
                                        
                                    </div>
                                    <!-- /.row -->
                                    
                                <div class="box-footer">
                                    <div class="pull-left">
                                        <a href="sellable-plans.php"><button type="button" class="btn btn-template-main back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Choose another plan</button></a>
                                    </div>
                                </div>


                                </div>
                                
                        </div>
                        <!-- /.box -->

</div>
                    </div></div>
                    <!-- /.col-md-9 -->

<?php } ?>                    
                    
                     </div>
     
            </div>
         </div>
      
       
         
      </div>
<?php require_once("../includes/footer.php"); ?>