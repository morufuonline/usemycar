<?php require_once("../includes/header2.php");  
check_completed("sell_car4", "sell-your-car-04.php");
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
$contact_name = tp_input("contact_name");
$contact_email = tp_input("contact_email");
$contact_phone = tp_input("contact_phone");

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($contact_name) && !empty($contact_email) && !empty($contact_phone)){

$_SESSION["portal"]["contact_name"] = $contact_name;
$_SESSION["portal"]["contact_email"] = $contact_email;
$_SESSION["portal"]["contact_phone"] = $contact_phone;
$_SESSION["portal"]["sell_car5"] = 1;

redirect("sell-your-car-06.php");
}else if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($contact_name) or empty($contact_email) or empty($contact_phone))){
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
                            <form method="post" action="sell-your-car-05.php" runat="server" autocomplete="off" enctype="multipart/form-data">

                            <?php include_once("../includes/sales-nav.php"); ?>

                                <div class="content-inner-tab photos">
                       <div class="row">
                                         <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="contact-name">Contact Name*</label>
<input type="text" name="contact_name" id="contact-name" class="form-control" placeholder="The person to be contacted for the car" required value="<?php check_inputted("contact_name", $username); ?>">
                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="contact-email">Contact Email*</label>
<input type="text" name="contact_email" id="contact-email" class="form-control" placeholder="The person&#039;s email" required value="<?php check_inputted("contact_email", $user_email); ?>">
                                               
                                            </div>
                                        </div>
                                          <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="contact-phone">Contact Mobile No.*</label>
<input type="text" name="contact_phone" id="contact-phone" class="form-control" placeholder="The person&#039;s phone no." required value="<?php $phone = in_table("phone","reg_members","WHERE email = '$user_email'","phone"); check_inputted("contact_phone", $phone); ?>">
                                               
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.row -->
                                </div>

                                <div class="box-footer">
                                    <div class="pull-left">
                                        <a href="sell-your-car-04.php"><button type="button" class="btn btn-template-main back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
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