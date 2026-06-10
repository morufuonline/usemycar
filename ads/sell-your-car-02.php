<?php require_once("../includes/header2.php"); 
check_completed("sell_car1", "sell-your-car-01.php");
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
$type = tp_input("type");
$engine = np_input("engine");
$power = np_input("power");
$condition = tp_input("condition");
$mileage = np_input("mileage");
$specs = tp_input("specs");

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($type) && !empty($engine) && !empty($power) && !empty($condition) && !empty($mileage) && !empty($specs)){

$_SESSION["portal"]["type"] = $type;
$_SESSION["portal"]["engine"] = $engine;
$_SESSION["portal"]["power"] = $power;
$_SESSION["portal"]["condition"] = $condition;
$_SESSION["portal"]["mileage"] = $mileage;
$_SESSION["portal"]["specs"] = $specs;
$_SESSION["portal"]["sell_car2"] = 1;

redirect("sell-your-car-03.php");
}else if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($type) or empty($engine) or empty($power) or empty($condition) or empty($mileage) or empty($specs))){
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
                            <form method="post" action="sell-your-car-02.php" runat="server" autocomplete="off" enctype="multipart/form-data">

                            <?php include_once("../includes/sales-nav.php"); ?>

                                <div class="content-inner-tab">
                                    <div class="row">
                                         <div class="col-sm-12">
                                         	<div class="form-group">
                                                <label for="">Body Type*</label>
                                            	<ul class="list-style-sell" id="type-group">
                                                  <label for="convertible"><li<?php echo (!empty(ret_check_checked("type", "Convertible", "", 1)))?" class=\"active\"":""; ?>>Convertible</li></label>
                                                  <label for="coupe"><li<?php echo (!empty(ret_check_checked("type", "Coupe")))?" class=\"active\"":""; ?>>Coupe</li></label>
                                                  <label for="crossover"><li<?php echo (!empty(ret_check_checked("type", "Crossover")))?" class=\"active\"":""; ?>>Crossover</li></label>
                                                  <label for="fastback"><li<?php echo (!empty(ret_check_checked("type", "Fastback")))?" class=\"active\"":""; ?>>Fastback</li></label>
                                                  <label for="hatchback"><li<?php echo (!empty(ret_check_checked("type", "Hatchback")))?" class=\"active\"":""; ?>>Hatchback</li></label>
                                                  <label for="pick-up"><li<?php echo (!empty(ret_check_checked("type", "Pick-up")))?" class=\"active\"":""; ?>>Pick-up</li></label>
                                                  <label for="sedan"><li<?php echo (!empty(ret_check_checked("type", "Sedan")))?" class=\"active\"":""; ?>>Sedan</li></label>
                                                  <label for="sportsback"><li<?php echo (!empty(ret_check_checked("type", "Sportsback")))?" class=\"active\"":""; ?>>Sportsback</li></label>
                                                  <label for="suv"><li<?php echo (!empty(ret_check_checked("type", "SUV")))?" class=\"active\"":""; ?>>SUV</li></label>
                                                  <label for="wagon"><li<?php echo (!empty(ret_check_checked("type", "Wagon")))?" class=\"active\"":""; ?>>Wagon</li></label>
                                                </ul>
                                                
                                    <input type="radio" name="type" id="convertible" value="Convertible" class="fade-btn"<?php check_checked("type", "Convertible", "", 1); ?> required>
                                    <input type="radio" name="type" id="coupe" value="Coupe" class="fade-btn"<?php check_checked("type", "Coupe"); ?> required>
                                    <input type="radio" name="type" id="crossover" value="Crossover" class="fade-btn"<?php check_checked("type", "Crossover"); ?> required>
                                    <input type="radio" name="type" id="fastback" value="Fastback" class="fade-btn"<?php check_checked("type", "Fastback"); ?> required>
                                    <input type="radio" name="type" id="hatchback" value="Hatchback" class="fade-btn"<?php check_checked("type", "Hatchback"); ?> required>
                                    <input type="radio" name="type" id="pick-up" value="Pick-up" class="fade-btn"<?php check_checked("type", "Pick-up"); ?> required>
                                    <input type="radio" name="type" id="sedan" value="Sedan" class="fade-btn"<?php check_checked("type", "Sedan"); ?> required>
                                    <input type="radio" name="type" id="sportsback" value="Sportsback" class="fade-btn"<?php check_checked("type", "Sportsback"); ?> required>
                                    <input type="radio" name="type" id="suv" value="SUV" class="fade-btn"<?php check_checked("type", "SUV"); ?> required>
                                    <input type="radio" name="type" id="wagon" value="Wagon" class="fade-btn"<?php check_checked("type", "Wagon"); ?> required>
                                                
                                             </div>
                                        </div>
                                    
                                        
                                    </div>
                                    <!-- /.row -->
                                   <div class="row">
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="engine">Engine*</label>
                                                 <div class="input-group">
                                              <input type="text" name="engine" id="engine" placeholder="E.g. 500" value="<?php check_inputted("engine"); ?>" required class="form-control only-no">
                                               <span class="input-group-addon" title="Cubic Centimeter">CC</span>
                                               </div>
                                            </div>
                                        </div>
                                       <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="power">Power*</label>
                                                 <div class="input-group">
                                              <input type="text" name="power" id="power" placeholder="E.g. 296" value="<?php check_inputted("power"); ?>" required class="form-control only-no">
                                               <span class="input-group-addon" title="Horsepower">HP</span>
                                               </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                            <div class="row">
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Condition*</label>
                                             	<ul class="list-style-sell" id="condition-group">
                                                  <label for="new-car"><li<?php echo (!empty(ret_check_checked("condition", "New Car", "", 1)))?" class=\"active\"":""; ?>>New Car</li></label>
                                                  <label for="used-car"><li<?php echo (!empty(ret_check_checked("condition", "Used Car")))?" class=\"active\"":""; ?>>Used Car</li></label>
                                                </ul>

                                    <input type="radio" name="condition" id="new-car" value="New Car" class="fade-btn"<?php check_checked("condition", "New Car", "", 1); ?> required>
                                    <input type="radio" name="condition" id="used-car" value="Used Car" class="fade-btn"<?php check_checked("condition", "Used Car"); ?> required>

                                            </div>
                                        </div>
                                       <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="mileage">Mileage*</label>
                                                 <div class="input-group">
                                              <input type="text" name="mileage" id="mileage" placeholder="E.g. 150" value="<?php check_inputted("mileage"); ?>" required class="form-control only-no">
                                               <span class="input-group-addon">Kms</span>
                                               </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                          <div class="row">
                                         <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="title">Specs*</label>
                                             <ul class="list-style-sell" id="specs-group">
                                                <label for="gcc"><li<?php echo (!empty(ret_check_checked("specs", "GCC", "", 1)))?" class=\"active\"":""; ?>>GCC</li></label>
                                                <label for="american"><li<?php echo (!empty(ret_check_checked("specs", "American")))?" class=\"active\"":""; ?>>American</li></label>
                                                <label for="japanese"><li<?php echo (!empty(ret_check_checked("specs", "Japanese")))?" class=\"active\"":""; ?>>Japanese</li></label>
                                                <label for="european"><li<?php echo (!empty(ret_check_checked("specs", "European")))?" class=\"active\"":""; ?>>European</li></label>
                                                <label for="other"><li<?php echo (!empty(ret_check_checked("specs", "Other")))?" class=\"active\"":""; ?>>Other</li></label>
                                             </ul>

                                    <input type="radio" name="specs" id="gcc" value="GCC" class="fade-btn"<?php check_checked("specs", "GCC", "", 1); ?> required>
                                    <input type="radio" name="specs" id="american" value="American" class="fade-btn"<?php check_checked("specs", "American"); ?> required>
                                    <input type="radio" name="specs" id="japanese" value="Japanese" class="fade-btn"<?php check_checked("specs", "Japanese"); ?> required>
                                    <input type="radio" name="specs" id="european" value="European" class="fade-btn"<?php check_checked("specs", "European"); ?> required>
                                    <input type="radio" name="specs" id="other" value="Other" class="fade-btn"<?php check_checked("specs", "Other"); ?> required>

                                            </div>
                                        </div>
                                     
                                        
                                    </div>

                                        <!-- /.row -->
                               
                                    
                                    <!-- /.row -->
                                </div>

                                <div class="box-footer">
                                    <div class="pull-left">
                                        <a href="sell-your-car-01.php"><button type="button" class="btn btn-template-main back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
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