<?php require_once("../includes/header2.php");  
check_completed("sell_car3", "sell-your-car-03.php");
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
$description = tp_input("description");

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($description) && isset($_SESSION["portal"]["ad_img"]) && !empty($_SESSION["portal"]["ad_img"])){

$_SESSION["portal"]["description"] = $description;
$_SESSION["portal"]["sell_car4"] = 1;

redirect("sell-your-car-05.php");
}else if($_SERVER['REQUEST_METHOD'] == "POST" && empty($description)){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not saved! Description field is required.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && (!isset($_SESSION["portal"]["ad_img"]) or empty($_SESSION["portal"]["ad_img"]))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not saved! Atleast, an image must be uploaded.</div>";
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
             
<style>
<!--
.new-ad-pic{
display:table;
width:100%;
}

.ad-pic-img, .ad-pic-option{
display:table-cell;
}
.ad-pic-img{
width:50%;
}
.ad-pic-option{
vertical-align:middle;
padding:10px;
text-align:center;
}	
-->
</style>       

                    <div class="col-md-9 clearfix">
                      <div class="border-content clearfix">
                      <div class="title-section">PLEASE ENTER YOUR PRODUCT INFORMATION</div>
                      <div id="checkout-div">

                        <div class="box">
							
                            <?php include_once("../includes/sales-nav.php"); ?>

                                <div class="content-inner-tab photos">
                            <div class="row">
                                         
                                       <div class="col-sm-6">
                                            <div class="form-group">
                            <form method="post" action="sell-your-car-04.php" class="desc-form" runat="server" autocomplete="off" enctype="multipart/form-data">
                                                <label for="description">Description*</label>
                                              
                                    	<textarea name="description" id="description" placeholder="Type your car description" rows="5" required class="form-control"><?php check_inputted("description"); ?></textarea>
                            </form>
                                            </div>
                                        </div>
                                           <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Car Image(s)*</label>
                                                <p style="color:#f11; padding-bottom:10px;">Format: .jpg, .jpeg, .png, .gif <br /> <b>Note:</b> The first image is your featured image which displays first when a search is made.</p>
                                            
                                            <div class="add-result">
                                            <?php
											if(isset($_SESSION["portal"]["ad_img"]) && !empty($_SESSION["portal"]["ad_img"])){
											foreach($_SESSION["portal"]["ad_img"] as $val){
											$file_name_aray = glob("../images/ads-temp/{$id}_ad_featured_{$val}_*.jpg");
											$file_name = $file_name_aray[0];
											?>
                            <div>
                            <form action="../privates/data-processor.php" class="general-form2 edit-form-<?php echo $val; ?>" name="my-add-default-<?php echo $val; ?>" id="result-<?php echo $val; ?>" lang="my-add-loading-<?php echo $val; ?>" title="edit" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
                            <input type="hidden" name="edit_my_ad_img" value="1" />
                            <input type="hidden" name="session_ad_img" value="<?php echo $val; ?>" />
                            <div class="new-ad-pic">
                            <div class="ad-pic-img"> 
                            <div class="relative-div">
                            <div class="car-image result-<?php echo $val; ?>"><img src="<?php echo $file_name ?>" /></div>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                            <span class="btn btn-primary btn-file">
                            <span class="fileupload-new">
                            <i class="fa fa-refresh" aria-hidden="true" id="my-add-default-<?php echo $val; ?>"></i> Change pic
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" aria-hidden="true" id="my-add-loading-<?php echo $val; ?>"></i>                            
                            </span>
                            <input type="file" name="edit_ad_img" onchange="javascript: $('.edit-form-<?php echo $val; ?>').submit();">
                            </span><span class="fileupload-preview"></span>
                            </div></div>
                            </div>
                            <div class="ad-pic-option"> 
<button type="button" class="btn btn-danger delete-ad-img" onclick="javascript: delete_file('../privates/data-processor.php', 'del_ad_file', '<?php echo $val; ?>', 'delete-<?php echo $val; ?>', 'result-<?php echo $val; ?>');"><i class="fa fa-trash" aria-hidden="true"></i> Delete <i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" id="delete-<?php echo $val; ?>" aria-hidden="true"></i></button>
                            </div>
                            </div>
                            </form>
                            </div>
                                            <?php
											}
											}
											?>
                                            </div>
                                            
                            <form action="../privates/data-processor.php" class="general-form2 add-form" name="my-add-default" id="add-result" lang="my-add-loading" title="add" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
                            <input type="hidden" name="my_ad_img" value="1" />
                            <div class="new-ad-pic">
                            <div class="ad-pic-img"> 
                            <div class="relative-div">
                            <div class="car-image">Add new picture</div>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                            <span class="btn btn-primary btn-file">
                            <span class="fileupload-new">
                            <i class="fa fa-plus-circle" aria-hidden="true" id="my-add-default"></i> 
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner my-add-loading" style="margin-left:25px;" aria-hidden="true" id="my-add-loading"></i>
                            </span>
                            <input type="file" name="ad_img" onchange="javascript: $('.add-form').submit();">
                            </span><span class="fileupload-preview"></span>
                            </div></div>
                            </div>
                            <div class="ad-pic-option"> 
                            </div>
                            </div>
                          	</form>

                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.row -->
                                </div>

                                <div class="box-footer">
                                    <div class="pull-left">
                                        <a href="sell-your-car-03.php"><button type="button" class="btn btn-template-main back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" onclick="javascript: $('.desc-form').submit();" class="btn btn-template-main">Continue <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                    </div>
                                </div>

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