<?php require_once("../includes/header2.php"); ?>
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
$brand = tp_input("brand");
$model = tp_input("model");
$year = np_input("year");
$trim = tp_input("trim");
$fuel = tp_input("fuel");
$doors = tp_input("doors");
$transmission = tp_input("transmission");

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($brand) && !empty($model) && !empty($year) && strlen($year) == 4 && !empty($trim) && !empty($fuel) && !empty($doors) && !empty($transmission)){

$_SESSION["portal"]["brand"] = $brand;
$_SESSION["portal"]["model"] = $model;
$_SESSION["portal"]["year"] = $year;
$_SESSION["portal"]["trim"] = $trim;
$_SESSION["portal"]["fuel"] = $fuel;
$_SESSION["portal"]["doors"] = $doors;
$_SESSION["portal"]["transmission"] = $transmission;
$_SESSION["portal"]["sell_car1"] = 1;

redirect("sell-your-car-02.php");
}else if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($brand) or empty($model) or empty($year) or empty($trim) or empty($fuel) or empty($doors) or empty($transmission))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not saved! All the required (*) fields must be filled appropriately.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($year) && strlen($year) < 4){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not submitted! Year must in four(4) digits, e.g. 2011.</div>";
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
                            <form method="post" action="sell-your-car-01.php" runat="server" autocomplete="off" enctype="multipart/form-data">
                            
                            <?php include_once("../includes/sales-nav.php"); ?>

                                <div class="content-inner-tab">
                                    <div class="row">
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="brand">Brand*</label>
                                               <select name="brand" id="brand" title="Select a brand" required class="form-control" onchange="javascript: gen_load('../privates/data-processor.php', 'veh_brand', this.value, 'model', loading_selected_notification)">
												<option value=""> - - Select a brand - - </option>
												<?php 
												$result = $db->select("veh_brands", "", "DISTINCT make", "ORDER BY make ASC");
												if(count_rows($result) > 0){
												while($row = fetch_data($result)){
												$make = $row["make"];
												echo "<option value=\"{$make}\"";
												check_selected("brand", $make); 
												echo ">{$make}</option>";
												}
												}
												?>
												</select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="model">Model*</label>
                                               <select name="model" id="model" title="Select a model" required class="form-control">
												<?php 
												$load_model = ret_check_selected("model");
												echo (!empty($load_model))?"<option value=\"{$load_model}\">{$load_model}</option>":""; 
												?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.row -->
                                   <div class="row">
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="year">Year Manufactured*</label>
                                               <select name="year" id="year" title="Select a year" required class="form-control">
												<option value=""> - - Select a year - - </option>
												<?php 
												for($i = date("Y"); $i >= 2000; $i--){
												echo "<option value=\"{$i}\"";
												check_selected("year", $i); 
												echo ">{$i}</option>";
												}
												?>
												</select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="trim">Trim*</label>
                                                <input type="text" name="trim" id="trim" placeholder="E.g. Plastic Bumpers, Protective Add-Ons" value="<?php check_inputted("trim"); ?>" required class="form-control">
                                               
                                            </div>
                                        </div>
                                        
                                    </div>

                                        <!-- /.row -->
                                   <div class="row">
                                         <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Fuel*</label>
                                                <ul class="list-style-sell" id="fuel-group">
                                                  <label for="petrol"><li<?php echo (!empty(ret_check_checked("fuel", "Petrol", "", 1)))?" class=\"active\"":""; ?>>Petrol</li></label>
                                                   <label for="diesel"><li<?php echo (!empty(ret_check_checked("fuel", "Diesel")))?" class=\"active\"":""; ?>>Diesel</li></label>
                                                    <label for="electro"><li<?php echo (!empty(ret_check_checked("fuel", "Electro")))?" class=\"active\"":""; ?>>Electro</li></label>
                                                     <label for="hybrid"><li<?php echo (!empty(ret_check_checked("fuel", "Hybrid")))?" class=\"active\"":""; ?>>Hybrid</li></label>
                                                </ul>
                                                
                                    <input type="radio" name="fuel" id="petrol" value="Petrol" class="fade-btn"<?php check_checked("fuel", "Petrol", "", 1); ?> required>
                                    <input type="radio" name="fuel" id="diesel" value="Diesel" class="fade-btn"<?php check_checked("fuel", "Diesel"); ?> required>
                                    <input type="radio" name="fuel" id="electro" value="Electro" class="fade-btn"<?php check_checked("fuel", "Electro"); ?> required>
                                    <input type="radio" name="fuel" id="hybrid" value="Hybrid" class="fade-btn"<?php check_checked("fuel", "Hybrid"); ?> required>
                                               
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                        <div class="row">
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Doors*</label>
                                                <ul class="list-style-sell" id="doors-group">
                                                  <label for="two-three"><li<?php echo (!empty(ret_check_checked("doors", "2/3", "", 1)))?" class=\"active\"":""; ?>>2/3</li></label>
                                                  <label for="four-five"><li<?php echo (!empty(ret_check_checked("doors", "4/5")))?" class=\"active\"":""; ?>>4/5</li></label>
                                                </ul>
                                    
                                    <input type="radio" name="doors" id="two-three" value="2/3" class="fade-btn"<?php check_checked("doors", "2/3", "", 1); ?> required>
                                    <input type="radio" name="doors" id="four-five" value="4/5" class="fade-btn"<?php check_checked("doors", "4/5"); ?> required>         
                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Transmission*</label>
                                                <ul class="list-style-sell" id="transmission-group">
                                                  <label for="manual"><li<?php echo (!empty(ret_check_checked("transmission", "Manual", "", 1)))?" class=\"active\"":""; ?>>Manual</li></label>
                                                   <label for="automatic"><li<?php echo (!empty(ret_check_checked("transmission", "Automatic")))?" class=\"active\"":""; ?>>Automatic</li></label>
                                                </ul>
                                                
                                    <input type="radio" name="transmission" id="manual" value="Manual" class="fade-btn"<?php check_checked("transmission", "Manual", "", 1); ?> required>
                                    <input type="radio" name="transmission" id="automatic" value="Automatic" class="fade-btn"<?php check_checked("transmission", "Automatic"); ?> required>                                               
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                  
                               
                                    <!-- /.row -->
                                </div>

                                <div class="box-footer">
                                    
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-template-main">Continue <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
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