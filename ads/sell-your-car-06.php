<?php require_once("../includes/header2.php");  
check_completed("sell_car5", "sell-your-car-05.php");
?>
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

if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_SESSION["login"]) && !empty($plan) && !empty($_SESSION["portal"]["sell_car5"])){

$brand = $_SESSION["portal"]["brand"];
$model = $_SESSION["portal"]["model"];
$year = $_SESSION["portal"]["year"];
$trim = $_SESSION["portal"]["trim"];
$fuel = $_SESSION["portal"]["fuel"];
$doors = $_SESSION["portal"]["doors"];
$transmission = $_SESSION["portal"]["transmission"];

$type = $_SESSION["portal"]["type"];
$engine = $_SESSION["portal"]["engine"];
$power = $_SESSION["portal"]["power"];
$condition = $_SESSION["portal"]["condition"];
$mileage = $_SESSION["portal"]["mileage"];
$specs = $_SESSION["portal"]["specs"];

$colour = $_SESSION["portal"]["colour"];
$price = $_SESSION["portal"]["price"];
$state = $_SESSION["portal"]["state"];
$local_government = $_SESSION["portal"]["local_government"];
$equipment = $_SESSION["portal"]["equipment"];

$description = $_SESSION["portal"]["description"];

$contact_name = $_SESSION["portal"]["contact_name"];
$contact_email = $_SESSION["portal"]["contact_email"];
$contact_phone = $_SESSION["portal"]["contact_phone"];

$tb_plan = in_table("tb_plan","plans","WHERE id = '$plan'","tb_plan");
$plan_avail = in_table("$tb_plan","reg_members","WHERE email = '$user_email'","$tb_plan");

if($plan_avail > 0){

$data_array = array(
"user_id" => "'$id'",
"plan" => "'$plan'",
"brand" => "'$brand'",
"model" => "'$model'",
"year" => "'$year'",
"trim" => "'$trim'",
"fuel" => "'$fuel'",
"doors" => "'$doors'",
"transmission" => "'$transmission'",
"type" => "'$type'",
"engine" => "'$engine'",
"power" => "'$power'",
"veh_condition" => "'$condition'",
"mileage" => "'$mileage'",
"specs" => "'$specs'",
"colour" => "'$colour'",
"price" => "'$price'",
"state" => "'$state'",
"local_government" => "'$local_government'",
"equipment" => "'$equipment'",
"description" => "'$description'",
"contact_name" => "'$contact_name'",
"contact_email" => "'$contact_email'",
"contact_phone" => "'$contact_phone'",
"date_posted" => "'$date_time'"
);
$act = $db->insert($data_array, "sellable_cars");

$db->query("UPDATE reg_members SET {$tb_plan} = {$tb_plan} - 1 WHERE id = '{$id}'");

$posted_id = in_table("id","sellable_cars","WHERE user_id = '{$id}' AND plan = '{$plan}' AND date_posted = '{$date_time}'","id");

foreach($_SESSION["portal"]["ad_img"] as $val){
$img_aray1 = glob("../images/ads-temp/{$id}_ad_displayed_{$val}_*.jpg");
$img1 = $img_aray1[0];
$img_aray2 = glob("../images/ads-temp/{$id}_ad_featured_{$val}_*.jpg");
$img2 = $img_aray2[0];
copy($img1,"../images/ads-displayed/{$posted_id}_{$id}_ad_displayed_{$val}.jpg");
copy($img2,"../images/ads-featured/{$posted_id}_{$id}_ad_featured_{$val}.jpg");
unlink($img1);
unlink($img2);
}

$activity = "Posted new {$brand} {$model} {$year} data to database.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$act = $db->insert($audit_data_array, "admin_log");

$_SESSION["portal"] = NULL;
unset($_SESSION["portal"]);

$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Congrat! You have successfully posted {$brand} {$model} {$year} data.</div>";

redirect("../members/my-cars-for-sales.php");	
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! You have zero(0) units available on this plan.</div>";
}

}else if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET["plan"])){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! Invalid access.</div>";
}
?>

      <div class="content">
         <div class="sell-car">
          <div class="container">
            <div class="row">
              <div class="col-md-3 hidden-xs">
                 <div class="border-content clearfix">
                    <?php include_once("../includes/sales-side.php"); ?>
                      </div>
                       </div>

              </div>
             
                    <div class="col-md-9 clearfix">
                      <div class="border-content clearfix">
                      <div class="title-section">PLEASE ENTER YOUR PRODUCT INFORMATION</div>
                      <div id="checkout-div">

                        <div class="box">

                            <?php include_once("../includes/sales-nav.php"); ?>

                                <div class="content-inner-tab package">
                       <div class="row">
                                       <div class="pricing-table three-cols margin-0">
                     <div class="pricing-column">
                     <h3><?php echo in_table("plan","plans","WHERE id = '3'","plan"); ?></h3>
                     <div class="pricing-column-content">
                           <h4><?php echo formatQty(in_table("silver","reg_members","WHERE id = '$id'","silver")); ?></h4>
                           <span class="interval">unit(s) remaining</span>
                           <?php $bal_avail = in_table("silver","reg_members","WHERE id = '$id'","silver"); if($bal_avail > 0){ ?>
                           <a onclick="javascript: return confirm('Are you sure you want to submit?\nYou will be allowed to edit the ad after final confirmation by the admin.');" class="btn btn-primary" href="sell-your-car-06.php?plan=3"><i class="fa fa-upload" aria-hidden="true"></i> Use plan to submit</a>
                           <?php }else{ ?>
                           <a href="sellable-plans.php?plan=3"><button type="button" class="btn btn-primary"><i class="fa fa-money" aria-hidden="true"></i> Buy more units</button></a>
                           <?php } ?>
                        </div>
                  </div>
                    <div class="pricing-column highlight accent-color">
                        <h3><?php echo in_table("plan","plans","WHERE id = '4'","plan"); ?> <span class="highlight-reason">Most Popular</span></h3>
                        <div class="pricing-column-content">
                           <h4><?php echo formatQty(in_table("gold","reg_members","WHERE id = '$id'","gold")); ?></h4>
                            <span class="interval">unit(s) remaining</span>
                           <?php $bal_avail = in_table("gold","reg_members","WHERE id = '$id'","gold"); if($bal_avail > 0){ ?>
                            <a onclick="javascript: return confirm('Are you sure you want to submit?\nYou will be allowed to edit the ad after final confirmation by the admin.');" class="btn btn-info" href="sell-your-car-06.php?plan=4"><i class="fa fa-upload" aria-hidden="true"></i> Use plan to submit </a>
                           <?php }else{ ?>
                           <a href="sellable-plans.php?plan=4"><button type="button" class="btn btn-primary"><i class="fa fa-money" aria-hidden="true"></i> Buy more units</button></a>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="pricing-column">
                     <h3><?php echo in_table("plan","plans","WHERE id = '2'","plan"); ?></h3>
                     <div class="pricing-column-content">
                           <h4><?php echo formatQty(in_table("bronze","reg_members","WHERE email = '$user_email'","bronze")); ?></h4>
                           <span class="interval">unit(s) remaining</span>
                           <?php $bal_avail = in_table("bronze","reg_members","WHERE id = '$id'","bronze"); if($bal_avail > 0){ ?>
                           <a onclick="javascript: return confirm('Are you sure you want to submit?\nYou will be allowed to edit the ad after final confirmation by the admin.');" class="btn btn-primary" href="sell-your-car-06.php?plan=2"><i class="fa fa-upload" aria-hidden="true"></i> Use plan to submit </a>
                           <?php }else{ ?>
                           <a href="sellable-plans.php?plan=2"><button type="button" class="btn btn-primary"><i class="fa fa-money" aria-hidden="true"></i> Buy more units</button></a>
                           <?php } ?>
                        </div>
                     </div>
                </div>
                                        
                                    </div>
                                    <!-- /.row -->
                                </div>
                                
                                <div class="box-footer">
                                    <div class="pull-left">
                                        <a href="sell-your-car-05.php"><button type="button" class="btn btn-template-main back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                    </div>
                                    <div class="pull-right">
                           <?php $bal_avail = in_table("free","reg_members","WHERE id = '$id'","free"); if($bal_avail > 0){ ?>
                                        <a onclick="javascript: return confirm('Are you sure you want to submit?\nYou will be allowed to edit the ad after final confirmation by the admin.');" href="sell-your-car-06.php?plan=1"><button type="submit" class="btn btn-template-main"><i class="fa fa-upload" aria-hidden="true"></i> Submit with <?php echo in_table("plan","plans","WHERE id = '1'","plan"); ?></button></a>
                           <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.box -->

</div>
                    </div></div>
                    <!-- /.col-md-9 -->
                     </div>
     
            </div>
         </div>
      
       
         
      </div>
<?php require_once("../includes/footer.php"); ?>