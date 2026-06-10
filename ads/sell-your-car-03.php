<?php require_once("../includes/header2.php");  
check_completed("sell_car2", "sell-your-car-02.php");
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
$colour = tp_input("colour");
$price = np_input("price");
$state = tp_input("state");
$local_government = tp_input("local_government");
$equipment = (isset($_POST["equipment"]))?$_POST["equipment"]:"";

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($colour) && !empty($price) && !empty($state) && !empty($local_government) && !empty($equipment)){

$equipment_array = "";
foreach($_POST["equipment"] as $val){
$this_equipment = "";
$this_equipment = test_input($val);
$equipment_array .= (!empty($this_equipment))?"{$this_equipment}+*/-":"";
}

$_SESSION["portal"]["colour"] = $colour;
$_SESSION["portal"]["price"] = $price;
$_SESSION["portal"]["state"] = $state;
$_SESSION["portal"]["local_government"] = $local_government;
$_SESSION["portal"]["equipment"] = $equipment_array;
$_SESSION["portal"]["sell_car3"] = 1;

redirect("sell-your-car-04.php");
}else if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($colour) or empty($price) or empty($state) or empty($local_government) or empty($equipment))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not saved! All the required (*) fields must be filled appropriately.</div>";
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
                            <form method="post" action="sell-your-car-03.php" runat="server" autocomplete="off" enctype="multipart/form-data">

                            <?php include_once("../includes/sales-nav.php"); ?>

                                <div class="content-inner-tab features">
                                   
                                    <!-- /.row -->
                                         <div class="row">
                                         <div class="col-sm-6">
                                             <label for="colour">Colour*</label>
                                             <select name="colour" id="colour" title="Select your car colour" required class="form-control">
                                             	<option value=""> - - Select your car colour - - </option>
												<?php 
												$result = $db->select("colours", "", "DISTINCT colour", "ORDER BY id ASC");
												if(count_rows($result) > 0){
												while($row = fetch_data($result)){
												$colour = $row["colour"];
												echo "<option value=\"{$colour}\"";
												check_selected("colour", $colour); 
												echo ">{$colour}</option>";
												}
												}
												?>
                                             </select>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="price">Price*</label>
                                                 <div class="input-group">
                                              <input type="text" name="price" id="price" placeholder="E.g. 500000" value="<?php check_inputted("price"); ?>" required class="form-control only-no">
                                                <span class="input-group-addon">&#8358;</span>
                                               
                                               </div>
                                            </div>
                                        </div>
                                 
                                    </div>
                                    
                        	<div class="row">
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="state">State*</label>
                                             <select name="state" id="state" title="Select the state" required class="form-control" onchange="javascript: gen_load('../privates/data-processor.php', 'veh_local', this.value, 'local_government', loading_selected_notification)">
                                             	<option value=""> - - Select the state - - </option>
												<?php 
												$result = $db->select("location", "", "DISTINCT state", "ORDER BY state ASC");
												if(count_rows($result) > 0){
												while($row = fetch_data($result)){
												$state = $row["state"];
												echo "<option value=\"{$state}\"";
												check_selected("state", $state); 
												echo ">{$state}</option>";
												}
												}
												?>
                                             </select>
                                            </div>
                                        </div>
                                       <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="local_government">Local Government*</label>
                                             <select name="local_government" id="local_government" title="Select the local government" required class="form-control">
												<?php 
												$load_local_government = ret_check_selected("local_government");
												echo (!empty($load_local_government))?"<option value=\"{$load_local_government}\">{$load_local_government}</option>":""; 
												?>
                                             </select>
                                            </div>
                                        </div>
                                    </div>

                        <div class="row">
                        <div class="col-sm-12">
                        <label for="">Equipment <i>(Atleast one option must be checked)</i>*</label>
                        </div>
                        </div>
                                   
                                          <div class="row">
                                        <div class="add-car-form">
           
                <div class="col-sm-4">
                  <div class="form-group">
                  
               	<?php 
				$c = 0;
				$result = $db->select("veh_equipment", "WHERE position = '1'", "DISTINCT *", "ORDER BY id ASC");
				if(count_rows($result) > 0){
				while($row = fetch_data($result)){
				$item = $row["item"];
				?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="equipment[]" value="<?php echo $item; ?>" <?php check_arr_checked("equipment", $c, $item); ?>>
                    <div></div>
                    <?php echo $item; ?>
                  </label>
                </div>

                <?php
				if(!empty(ret_arr_checked("equipment", "equipment[]", $c, $item)) && $c <= count($_POST["equipment"]) - 2 ){
				$c++;
				}
				
				}
				}
				?>
                  </div> <!-- end .form-group -->
                </div> <!-- end .col-sm-3 -->
                <div class="col-sm-4">
                  <div class="form-group">
                  
               	<?php 
				$result = $db->select("veh_equipment", "WHERE position = '2'", "DISTINCT *", "ORDER BY id ASC");
				if(count_rows($result) > 0){
				while($row = fetch_data($result)){
				$item = $row["item"];
				?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="equipment[]" value="<?php echo $item; ?>" <?php check_arr_checked("equipment", $c, $item); ?>>
                    <div></div>
                    <?php echo $item; ?>
                  </label>
                </div>

                <?php
				if(!empty(ret_arr_checked("equipment", "equipment[]", $c, $item)) && $c <= count($_POST["equipment"]) - 2 ){
				$c++;
				}
				
				}
				}
				?>
                  </div> <!-- end .form-group -->
                </div> <!-- end .col-sm-3 -->
                <div class="col-sm-4">
                  <div class="form-group">
                  
               	<?php 
				$result = $db->select("veh_equipment", "WHERE position = '3'", "DISTINCT *", "ORDER BY id ASC");
				if(count_rows($result) > 0){
				while($row = fetch_data($result)){
				$item = $row["item"];
				?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="equipment[]" value="<?php echo $item; ?>" <?php check_arr_checked("equipment", $c, $item); ?>>
                    <div></div>
                    <?php echo $item; ?>
                  </label>
                </div>

                <?php
				if(!empty(ret_arr_checked("equipment", "equipment[]", $c, $item)) && $c <= count($_POST["equipment"]) - 2 ){
				$c++;
				}
				
				}
				}
				?>
                  </div> <!-- end .form-group -->
                </div> <!-- end .col-sm-3 -->
          <!-- end .col-sm-3 -->
              <!-- end .row -->
            
          </div> 
                                     
                                        
                                    </div>

                                        <!-- /.row -->
                               
                               
                                    <!-- /.row -->
                                </div>

                                <div class="box-footer">
                                    <div class="pull-left">
                                        <a href="sell-your-car-02.php"><button type="button" class="btn btn-template-main back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                    </div>
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