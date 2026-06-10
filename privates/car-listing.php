<?php require_once("../includes/header.php"); 

$where = (isset($_SESSION["where"]) && !empty($_SESSION["where"]))?$_SESSION["where"]:"";
$result = $db->select("sellable_cars", "WHERE status = '1' $where", "*", "ORDER BY plan, id");

$per_view = 20;
$page_link = "car-listing.php?pn=";
$link_suffix = "";
$style_class = "";
page_numbers();

$offset = ($per_view * $pn) - $per_view;
$result = $db->select("sellable_cars", "WHERE status = '1' $where", "*", "ORDER BY plan DESC", "LIMIT {$offset},{$per_view}");
?>
      <section id="opal-breadscrumb" class="opal-breadscrumb" style=""><div class="container"><h2 class="title-page">Cars</h2>
      <ol class="breadcrumb has-title-page">
         <li><a href="../">Home</a> </li>
         <li class="active">Cars</li>

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
      <div class="content">
         <div class="container">
            <div class="row">
               <div class="clearfix">
                  <div class="col-md-3">
                     <div class="left-content">
                     <div class="top--head">
                        <div class="accordion_inner">
                           <div class="y-search"><i class="fa fa-search"></i>Your Search</div>
                           <div class="result"><?php echo formatQty(count_rows($result)); ?> Results</div>
                        </div>
                     </div>
                     <div class="accordion_container">
                        <div class="accordion_head">Condition<span class="plusminus">+</span></div>
                        <div class="accordion_body" style="display: none;">
                           <div class="accordion_inner">
                              <ul class="checkbox-ul">
                                 <li>
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-0">
                                    New
                                    </label>
                                    <span>(29)</span>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-1" value="2" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-1">
                                    Used
                                    </label>
                                    <span>(29)</span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="accordion_head">Vehicles<span class="plusminus">+</span></div>
                        <div class="accordion_body" style="display: none;">
                           <div class="accordion_inner">
                              <ul class="checkbox-ul">
                                 <li>
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-0">
                                    Waterpark
                                    </label>
                                    <span>(29)</span>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-1" value="2" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-1">
                                    Activity Centric Resort
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-2" value="3" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-2">
                                    Getaway Resort
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-3" value="4" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-3">
                                    Farm
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-4" value="5" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-4">
                                    Bungalow
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-5" value="6" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-5">
                                    Adventure
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-6" value="7" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-6">
                                    Theme Park
                                    </label>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="accordion_head">Category<span class="plusminus">+</span></div>
                        <div class="accordion_body" style="display: none;">
                           <div class="accordion_inner">
                              <ul class="checkbox-ul">
                                 <li>
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-0">
                                    New
                                    </label>
                                    <span>(29)</span>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-1" value="2" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-1">
                                    Used
                                    </label>
                                    <span>(29)</span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="accordion_head">Seller Type<span class="plusminus">+</span></div>
                        <div class="accordion_body" style="display: none;">
                           <div class="accordion_inner">
                              <ul class="checkbox-ul">
                                 <li>
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-0">
                                    Waterpark
                                    </label>
                                    <span>(29)</span>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-1" value="2" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-1">
                                    Activity Centric Resort
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-2" value="3" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-2">
                                    Getaway Resort
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-3" value="4" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-3">
                                    Farm
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-4" value="5" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-4">
                                    Bungalow
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-5" value="6" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-5">
                                    Adventure
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-6" value="7" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-6">
                                    Theme Park
                                    </label>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="accordion_head">Seller Type<span class="plusminus">+</span></div>
                        <div class="accordion_body" style="display: none;">
                           <div class="accordion_inner">
                              <ul class="checkbox-ul">
                                 <li>
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-0">
                                    Waterpark
                                    </label>
                                    <span>(29)</span>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-1" value="2" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-1">
                                    Activity Centric Resort
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-2" value="3" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-2">
                                    Getaway Resort
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-3" value="4" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-3">
                                    Farm
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-4" value="5" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-4">
                                    Bungalow
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-5" value="6" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-5">
                                    Adventure
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-6" value="7" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-6">
                                    Theme Park
                                    </label>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="accordion_head">Seller Type<span class="plusminus">+</span></div>
                        <div class="accordion_body" style="display: none;">
                           <div class="accordion_inner">
                              <ul class="checkbox-ul">
                                 <li>
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-0">
                                    Waterpark
                                    </label>
                                    <span>(29)</span>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-1" value="2" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-1">
                                    Activity Centric Resort
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-2" value="3" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-2">
                                    Getaway Resort
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-3" value="4" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-3">
                                    Farm
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-4" value="5" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-4">
                                    Bungalow
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-5" value="6" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-5">
                                    Adventure
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-6" value="7" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-6">
                                    Theme Park
                                    </label>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="accordion_head">Seller Type<span class="plusminus">+</span></div>
                        <div class="accordion_body" style="display: none;">
                           <div class="accordion_inner">
                              <ul class="checkbox-ul">
                                 <li>
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-0">
                                    Waterpark
                                    </label>
                                    <span>(29)</span>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-1" value="2" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-1">
                                    Activity Centric Resort
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-2" value="3" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-2">
                                    Getaway Resort
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-3" value="4" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-3">
                                    Farm
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-4" value="5" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-4">
                                    Bungalow
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-5" value="6" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-5">
                                    Adventure
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-6" value="7" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-6">
                                    Theme Park
                                    </label>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="accordion_head">Seller Type<span class="plusminus">+</span></div>
                        <div class="accordion_body" style="display: none;">
                           <div class="accordion_inner">
                              <ul class="checkbox-ul">
                                 <li>
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-0">
                                    Waterpark
                                    </label>
                                    <span>(29)</span>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-1" value="2" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-1">
                                    Activity Centric Resort
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-2" value="3" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-2">
                                    Getaway Resort
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-3" value="4" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-3">
                                    Farm
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-4" value="5" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-4">
                                    Bungalow
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-5" value="6" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-5">
                                    Adventure
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-6" value="7" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-6">
                                    Theme Park
                                    </label>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="accordion_head">Seller Type<span class="plusminus">+</span></div>
                        <div class="accordion_body" style="display: none;">
                           <div class="accordion_inner">
                              <ul class="checkbox-ul">
                                 <li>
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-0">
                                    Waterpark
                                    </label>
                                    <span>(29)</span>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-1" value="2" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-1">
                                    Activity Centric Resort
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-2" value="3" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-2">
                                    Getaway Resort
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-3" value="4" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-3">
                                    Farm
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-4" value="5" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-4">
                                    Bungalow
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-5" value="6" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-5">
                                    Adventure
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-6" value="7" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-6">
                                    Theme Park
                                    </label>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="accordion_head">Build(Year)<span class="plusminus">+</span></div>
                        <div class="accordion_body" style="display: none;">
                           <div class="accordion_inner">
                              <ul class="checkbox-ul">
                                 <li>
                                    <input name="checkboxes" id="checkboxes-0" value="1" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-0">
                                    Waterpark
                                    </label>
                                    <span>(29)</span>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-1" value="2" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-1">
                                    Activity Centric Resort
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-2" value="3" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-2">
                                    Getaway Resort
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-3" value="4" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-3">
                                    Farm
                                    </label>
                                 </li>
                                 <li>
                                    <input name="checkboxes" id="checkboxes-4" value="5" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-4">
                                    Bungalow
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-5" value="6" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-5">
                                    Adventure
                                    </label>
                                 </li>
                                 <li> 
                                    <input name="checkboxes" id="checkboxes-6" value="7" type="checkbox">
                                    <label class="checkbox-inline" for="checkboxes-6">
                                    Theme Park
                                    </label>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     
                  </div>
                  <div class="clearfix main-special-add">
                  <div class="other-product">
                     <div class="heading-product">
                        <h4>Member's Free Ads</h4>
                        <a href="#">View All</a>
                     </div> <div class="special-add"  id="specialright">
                     <div class="special-add-ul">
                     <ul class="advertisement-ul">
                        <li>
                       <h3> <a href="#">Contrary to popular belief</a></h3>
                       <span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the.<a href="#" class="read-more">Read More</a></span>
                       <a class="special-web clearfix" href="#">Pixie - www.pixie.com</a> 
                    </li>
                     <li>
                       <h3> <a href="#">Contrary to popular belief</a></h3>
                       <span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the.<a href="#" class="read-more">Read More</a></span>
                       <a class="special-web clearfix" href="#">Pixie - www.pixie.com</a> 
                    </li>
                     <li>
                       <h3> <a href="#">Contrary to popular belief</a></h3>
                       <span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the.<a href="#" class="read-more">Read More</a></span>
                       <a class="special-web clearfix" href="#">Pixie - www.pixie.com</a> 
                    </li>
                    
                    <li>
                       <h3> <a href="#">Contrary to popular belief</a></h3>
                       <span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the.<a href="#" class="read-more">Read More</a></span>
                       <a class="special-web clearfix" href="#">Pixie - www.pixie.com</a> 
                    </li>
                    
                    
                    <li>
                       <h3> <a href="#">Contrary to popular belief</a></h3>
                       <span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the.<a href="#" class="read-more">Read More</a></span>
                       <a class="special-web clearfix" href="#">Pixie - www.pixie.com</a> 
                    </li>
                     </ul>
                    </div>
                     </div>
                     
                  </div>
                  </div>
                  </div>
                  <div class="col-md-9">
                     <div class="right-side-listing">
                        <div class="clearfix">
                           <div class="two-btn clearfix">
                              <!-- <a class="sort-new" href="#">Sort</a> -->
                              <div class="select-drop">
                                 <select name="ShippingMethod">
                                    <option value="ups:1">Sort</option>
                                    <option value="ups:4">low rate car</option>
                                    <option value="ups:6">low rate car</option>
                                    <option value="ups:7">low rate car</option>
                                 </select>
                              </div>
                              <a class="save-search" href="#"><i class="fa fa-star-o"></i>Save Search</a>
                           </div>
                        </div>
                        <div class="clearfix">
                       
<?php if(count_rows($result) > 0){
while($row = fetch_data($result)){
$ad_id = $row["id"];
$plan = $row["plan"];
$plan_desc = ($row["plan"] == 1)?"Free":"Premium";
$plan_title = in_table("plan","plans","WHERE id = '$plan'","plan");
$brand = $row["brand"];
$model = $row["model"];
$year = $row["year"];
$trim = $row["trim"];
$fuel = $row["fuel"];
$doors = $row["doors"];
$transmission = $row["transmission"];
$type = $row["type"];
$engine = $row["engine"];
$power = $row["power"];
$veh_condition = $row["veh_condition"];
$mileage = $row["mileage"];
$specs = $row["specs"];
$colour = $row["colour"];
$price = $row["price"];
$state = $row["state"];
$local_government = $row["local_government"];
$equipment = $row["equipment"];
$description = $row["description"];
$contact_name = $row["contact_name"];
$contact_email = $row["contact_email"];
$contact_phone = $row["contact_phone"];
$date_posted = min_full_date($row["date_posted"]);
$date_time = $row["date_time"];
$status = "";
if($row["status"] == 1){
$status = "<button type='button' class='btn btn-success'><i class='fa fa-check' aria-hidden='true'></i> Approved</button>";
}else if($row["status"] == 2){
$status = "<button type='button' class='btn btn-warning'><i class='fa fa-trash' aria-hidden='true'></i> Sold</button>";
}else{
$status = "<button type='button' class='btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i> Not Approved</button>";
}
$slide_array1 = glob("../images/ads-featured/{$ad_id}_*_ad_featured_*.jpg");
$slide_array2 = glob("../images/ads-displayed/{$ad_id}_*_ad_displayed_*.jpg");
$file_name = $slide_array1[0];
?>
                           <div class="auto-listing">
                              <a href="car-details.php?ad=<?php echo $ad_id; ?>">
                              <div class="cs-media">
                                 <img src="<?php echo $slide_array1[0] ?>" alt="">
                                 <figcaption> 
                                    <span class="auto-featured"><?php echo $plan_desc; ?></span>
                                 </figcaption>
                              </div>
                              </a>
                              <div class="auto-text">
                                 <div class="clearfix">
                                    <div class="left-carname">
                                       <h4><a href="car-details.php?ad=<?php echo $ad_id; ?>"><?php echo "{$brand} {$year} {$model}"; ?></a></h4>
                                       <div class="city-loc"><i class="fa fa-map-marker"></i> <?php echo $state; ?></div>
                                    </div>
                                    <div class="car-pricing">
                                       <div class="auto-price"><span class="cs-color">&#8358;<?php echo formatNumber($price); ?></span></div>
                                       <div class="generate-lt"><?php echo $contact_name; ?></div>
                                    </div>
                                 </div>
                                 <div class="clearfix">
                                    <div class="pricing-para"><?php echo substr($description,0,400); echo (strlen($description) > 400)?"...":""; ?></div>
                                 </div>
                                 <div class="clearfix related-image">
                                    <a href="car-details.php?ad=<?php echo $ad_id; ?>">Read more...</a>
                                 </div>
                                 <div class="row related-btn">
                                    <div class="col-sm-3">
                                    <?php if(isset($_SESSION["login"]) && !empty($_SESSION["login"])){ 
									$check_save = in_table("COUNT(id) AS Total","saved_ads","WHERE user_id='$id' AND ad_id='$ad_id'","Total");
									$save_content = ($check_save == 1)?"Unsave":"Save";
									?>
                                       <a class="save gen-save" name="<?php echo $ad_id; ?>" id="a<?php echo $ad_id; ?>" lang="data-processor.php"><i class="fa fa-heart-o gen-heart"></i><i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spin" aria-hidden="true"></i><?php echo $save_content; ?></a>
                                    <?php }else{ ?>
                                       <a class="save" onClick="javascript: sweetAlert('Notice', 'You must log in to save this ad', 'error');"><i class="fa fa-heart-o"></i>Save</a>
                                    <?php } ?>
                                    </div>
                                    <div class="col-sm-9">
                                       <div class="right-btn-sell">
                                          <a id="data-processor.php" lang="<?php echo $ad_id; ?>" data-toggle="modal" data-target="#gen-modal" class="vehicle-mail2 seller-cc"><i class="fa fa-comments-o"></i>Contact Seller</a>
                                          <a onClick="javascript: sweetAlert('Contact Number', '<?php echo $row["contact_phone"]; ?>', 'success');" class="verify-cc"><i class="fa fa-phone"></i>View Number<span><i class="fa fa-eye"></i>Show</span></a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php } } ?>

                        </div>
                        <ul class="pagination pull-right">
                           <li><a href="#">«</a></li>
                           <li class="active"><a href="#">1</a></li>
                           <li><a href="#">2</a></li>
                           <li><a href="#">3</a></li>
                           <li><a href="#">4</a></li>
                           <li><a href="#">5</a></li>
                           <li><a href="#">»</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>

       
         
      </div>
<?php require_once("../includes/footer.php"); ?>