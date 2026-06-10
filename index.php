<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

ini_set('session.gc_maxlifetime', 86400);
session_start();

require_once("classes/db-class.php");
require_once("includes/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Use My Car</title>
	  <link rel="shortcut icon" href="images/favicon.png"/>
      <!-- Bootstrap -->
      <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/jquery-ui.css" rel="stylesheet">
      <link rel="stylesheet" href="owl-carousel-2/owl.theme.default.min.css">
      <link href="css/style.css" rel="stylesheet">
      <link rel="stylesheet" href="css/styles_drop.css">
      <link href="css/open-sans.css" rel="stylesheet">
      <link href="css/font-awesome.min.css" rel="stylesheet">
      <link href="css/roboto.css" rel="stylesheet">
      <link href="css/roboto-condensed.css" rel="stylesheet">
      <link href="css/oswald.css" rel="stylesheet">
      <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="owl-carousel-2/owl.carousel.css">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="../js/html5shiv.min.js"></script>
      <script src="../js/respond.min.js"></script>
      <![endif]-->
      <script src="js/jquery-latest.min.js" type="text/javascript"></script>
      <script src="js/script.js" type="text/javascript"></script>
	  <script src="js/jquery-ui.js"></script>
	  <script src="js/jquery.flexslider-min.js"></script>
   </head>
   <body>
      <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-md-4 col-sm-3">
                  <div class="logo">
                     <a href="index.php"><img class="img-responsive" src="images/logo.png" alt=""></a>
                  </div>
               </div>
               <div class="col-md-8 col-sm-9">
                  <ul class="head-right-menu">
                     <li><a href="#">WIN A CAR</a></li>
                     <li><a href="#">BECOME MARKETER</a></li>
                     <li><a href="ads/sell-your-car-01.php">SELL YOUR CAR</a></li>
                     <?php if(isset($_SESSION["login"])){ ?>
                     <li><a href="<?php echo $users; ?>profile.php">My Profile</a></li>
                     <li><a href="<?php echo $users; ?>index.php?logout=1" onClick="javascript:return confirm('Are you sure you want to log out?');">Log out</a></li>
                     <?php } else { ?>
                     <li><a href="javascript:void(0);" data-toggle="modal" data-target="#sign-up">Register</a></li>
                     <li><a href="javascript:void(0);" data-toggle="modal" data-target="#sign-in">Log in</a></li>
                     <li class="profile"><a href="javascript:void(0);" data-toggle="modal" data-target="#sign-in"></a></li>
                     <?php } ?>
                  </ul>
               </div>
            </div>
         </div>
         <div class="menu">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="head_menu">
                        <div class="navigation">
                           <div id='cssmenu'>
                              <ul>
                                 <li class='active'><a href='index.php'>Home</a></li>
                                 <li><a href='#'> Buy A Car</a></li>
                                 <li><a href='privates/dealer-list.php'>Dealers</a></li>
                                 <li><a href='#'>Use My Car For Adverts</a></li>
                                 <li><a href='#'>Member Benefits</a></li>
                                 <li><a href='#'>Car Loans</a></li>
                                 <li><a href='#'>Car Insurance</a></li>
                                 <li><a href='#'>Spare Parts</a></li>
                                 <li><a href='#'>Vehicle Tracking</a></li>
                                 <li><a href='privates/about-us.php'>About Us</a></li>
                                 <li><a href='privates/contact-us.php'>Contact Us</a></li>
                              </ul>
                           </div>
                            <!--<div id="imaginary_container"> 
                <div class="input-group stylish-input-group">
                    <input class="form-control" placeholder="Search" type="text">
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </div>
            </div>-->
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php

		/////**************************************/////////////
		$search = tp_input("search");
		$brand = tp_input("brand");
		$model = tp_input("model");
		$start_year = tp_input("start_year");
		$end_year = tp_input("end_year");
		$min_price = tp_input("min_price");
		$max_price = tp_input("max_price");
		$location = tp_input("location");		
		
		$password = tp_input("password");
		$password2 = $password;
		$conf_pass = tp_input("conf_pass");
		$a2 = nr_input("a2");
		$b2 = tr_input("b2");

		//////////////////////////////////////////////////////////
		if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($search)){
		
		$where = "";
		$where .= (!empty($brand))?" AND  brand = '$brand'":"";
		$where .= (!empty($model))?" AND  model = '$model'":"";
		$where .= (!empty($start_year) && !empty($end_year))?" AND  year BETWEEN '$start_year' AND '$end_year'":"";
		$where .= (!empty($start_year) && empty($end_year))?" AND  year >= '$start_year'":"";
		$where .= (empty($start_year) && !empty($end_year))?" AND  year <= '$end_year'":"";
		$where .= (!empty($min_price) && !empty($max_price))?" AND  price BETWEEN '$min_price' AND '$max_price'":"";
		$where .= (!empty($min_price) && empty($max_price))?" AND  year >= '$min_price'":"";
		$where .= (empty($min_price) && !empty($max_price))?" AND  year <= '$max_price'":"";
		$where .= (!empty($location))?" AND  state = '$location'":"";
		$_SESSION["where"] = $where;
		redirect("privates/car-listing.php");
		}		
		////////////////////////////////////////////////////
		if(isset($_REQUEST["a"]) && isset($_REQUEST["b"])){
		$a = $b = "";
		$a = testQty($_REQUEST["a"]);
		$b = test_input($_REQUEST["b"]);
		$result = $db->select("users", "Where id = '{$a}'", "*", "");
		
		if(count_rows($result) == 1){
		$row = fetch_data($result);
		$enc_email = sha1($row["email"]);
		$active = $row["active"];
		$blocked = $row["blocked"];
		$name = $row["name"];
		
		if($blocked == 1){
		echo "<div class='not-success'>Hi {$name}! Your account is declined. Kindly contact the admin <a href='privates/contact-us/'>HERE</a>.</div>";
		}else if($enc_email == $b && $active == 0){
		$fid = $db->query("UPDATE users SET active = '1' WHERE id = '{$a}'");
		if($fid){
		echo "<div class='success'>Congrat {$name}! Your account is now activated. Kindly log in.</div>";
		}
		}else if($enc_email == $b && $active == 1){
		echo "<div class='not-success'>Hi {$name}! Your account was previously activated. Kindly log in.</div>";
		}else if($enc_email != $b){
		echo "<div class='not-success'>Invalid request.</div>";
		}
		
		}else{
		echo "<div class='not-success'>Invalid request.</div>";
		}
		
		}
		
		///////////////////////////////New Password////////////////////////
		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update"]) && !empty($a2) && !empty($b2) && !empty($password) && !empty($conf_pass) && strlen($password) >= 5 && $password == $conf_pass ){
		
		$new_password = sha1($password);
		$username = in_table("name","users","WHERE id='{$a2}'","name");
		$user_email = in_table("email","users","WHERE id='{$a2}'","email");
		
		$result = $db->select("users", "Where id = '{$a2}'", "*", "");
		
		if(count_rows($result) == 1){
		$row = fetch_data($result);
		$password2 = $row["password"];
		$blocked = $row["blocked"];
		$name = $row["name"];
		
		if($blocked == 1){
		echo "<div class='not-success'>Hi {$name}! Your account is declined. Kindly contact the admin <a href='privates/contact-us/'>HERE</a>.</div>";
		}else if($password2 == $b2){
		
		$data_array = array(
		"password" => $new_password
		);
		$act = $db->update($data_array, "users", "id = '{$a2}'");
		
		if($act){
		$activity = "Reset own password.";
		$audit_data_array = array(
		"user_id" => "'$a2'",
		"name" => "'$username'",
		"email" => "'$user_email'",
		"activity" => "'$activity'",
		"date_time" => "'$date_time'"
		);
		$db->insert($audit_data_array, "admin_log");
		
		echo "<div class='success'>Password successfully updated. Kindly log in with your new password.</div>";
		}else{
		echo "<div class='not-success'>Error occured.</div>";
		}
		
		}else if($password2 != $b2){
		echo "<div class='not-success'>Invalid request.</div>";
		}
		
		}else{
		echo "<div class='not-success'>Invalid request.</div>";
		}
		
		}
///////////////////////////////////////////////////////////////////////////
	  
	 	if(isset($_SESSION["msg"])){
		echo $_SESSION["msg"];
		$_SESSION["msg"] = NULL;
		unset($_SESSION["msg"]);
		session_destroy();
		}
	 ?>
      <div class="slider-area clearfix">
          <div class="owl-carousel owl-carousel-new">
            <div>
               <img src="images/slider-01.jpg" alt="">
             
            </div>
            <div><img src="images/slider-01.jpg" alt="">
              
            </div>
            <div> <img src="images/slider-01.jpg" alt="">
              
            </div>
            <div> <img src="images/slider-01.jpg" alt="">
               
            </div>
            <div> <img src="images/slider-01.jpg" alt="">
              
             </div>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <h1>NIGERIA'S NO.1 PREMIUM CAR WEBSITE</h1>
                  <h2>Become a Member Great Benefits</h2>
               </div>
               <div class="col-sm-12">
                  <div class="search-engine">
                     <form action="<?php directory(); ?>" class="form-horizontal" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
                     <input type="hidden" name="search" value="1">
                        <fieldset>
                           <!-- Form Name -->
                           <!-- Select Basic -->
                           <div class="clearfix col-sm-3 col-md-2">
                              <label class="control-label" for="brand">Make</label>
                              <div class="clearfix">
                                 <select id="brand" name="brand" class="form-control" onChange="javascript: gen_load('privates/data-processor.php', 'search_veh_brand', this.value, 'model', loading_selected_notification);">
                                    <option value=""> - - Select a brand - - </option>
                                    <?php 
                                    $result = $db->select("sellable_cars", "WHERE status = '1'", "DISTINCT brand", "ORDER BY brand ASC");
                                    if(count_rows($result) > 0){
                                    while($row = fetch_data($result)){
                                    $brand = $row["brand"];
                                    echo "<option value=\"{$brand}\"";
                                    check_selected("brand"); 
                                    echo ">{$brand}</option>";
                                    }
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                           <div class="clearfix col-sm-3 col-md-2">
                              <label class="control-label" for="model">Model</label>
                              <div class="clearfix">
                                 <select id="model" name="model" class="form-control">
                                 </select>
                              </div>
                           </div>
                           <div class="clearfix col-sm-6 col-md-3">
                              <label class="control-label" for="selectbasic">Year</label>
                              <div class="row">
                                 <div class="clearfix col-sm-6">
                                    <select id="start_year" name="start_year" class="form-control">
                                        <option value=""> - - Start - - </option>
										<?php 
                                        $result = $db->select("sellable_cars", "WHERE status = '1'", "DISTINCT year", "ORDER BY year ASC");
                                        if(count_rows($result) > 0){
                                        while($row = fetch_data($result)){
                                        $year = $row["year"];
                                        echo "<option value=\"{$year}\"";
                                        check_selected("year"); 
                                        echo ">{$year}</option>";
                                        }
                                        }
                                        ?>
                                    </select>
                                 </div>
                                 <div class="clearfix col-sm-6">
                                    <select id="end_year" name="end_year" class="form-control">
                                        <option value=""> - - End - - </option>
										<?php 
                                        $result = $db->select("sellable_cars", "WHERE status = '1'", "DISTINCT year", "ORDER BY year ASC");
                                        if(count_rows($result) > 0){
                                        while($row = fetch_data($result)){
                                        $year = $row["year"];
                                        echo "<option value=\"{$year}\"";
                                        check_selected("year"); 
                                        echo ">{$year}</option>";
                                        }
                                        }
                                        ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="clearfix col-sm-6 col-md-3">
                              <label class="control-label" for="selectbasic">Price</label>
                              <div class="row">
                                 <div class="clearfix col-sm-6">
                                    <select id="min_price" name="min_price" class="form-control">
                                        <option value="0">No Min</option>
                                        <option value="10000">10,000</option>
                                        <option value="50000">50,000</option>
                                        <option value="100000">100,000</option>
                                        <option value="200000">200,000</option>
                                        <option value="500000">500,000</option>
                                        <option value="1000000">1,000,000</option>
                                        <option value="2000000">2,000,000</option>
                                        <option value="5000000">5,000,000</option>
                                        <option value="10000000">10,000,000</option>
                                    </select>
                                 </div>
                                 <div class="clearfix col-sm-6">
                                    <select id="max_price" name="max_price" class="form-control">
                                        <option value="10000">10,000</option>
                                        <option value="50000">50,000</option>
                                        <option value="100000">100,000</option>
                                        <option value="200000">200,000</option>
                                        <option value="500000">500,000</option>
                                        <option value="1000000">1,000,000</option>
                                        <option value="2000000">2,000,000</option>
                                        <option value="5000000">5,000,000</option>
                                        <option value="10000000">10,000,000</option>
                                        <option value="0" selected>No Max</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="clearfix col-sm-3 col-md-2">
                              <label class="control-label" for="textinput">Location</label>  
                               		<select id="location" name="location" class="form-control">
                                        <option value=""> - - Select a location - - </option>
										<?php 
                                        $result = $db->select("sellable_cars", "WHERE status = '1'", "DISTINCT state", "ORDER BY state ASC");
                                        if(count_rows($result) > 0){
                                        while($row = fetch_data($result)){
                                        $state = $row["state"];
                                        echo "<option value=\"{$state}\"";
                                        check_selected("state"); 
                                        echo ">{$state}</option>";
                                        }
                                        }
                                        ?>
                   					</select>
                           </div>
                           <!-- Button -->
                           <div class="clearfix text-center col-sm-12">
                              <div class="relative-div">
                                 <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-search">Search Now</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <div class="news-head">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
               <?php include_once("includes/daily-news.php"); ?>
               </div>
            </div>
         </div>
      </div>


      <div class="content">
         <div class="vehicle-section">
            <div class="container">
               <div class="row">
                  <div class="col-sm-6">
                     <h3 class="heading-vehicle">FREE VEHICLES POSTS</h3>
                     <div class="row">
                        <ul class="vehicle-ul">
                        
                        <?php 
						$cars_list = "";
						$result = $db->select("sellable_cars", "WHERE plan = '1' AND status = '1'", "*", "ORDER BY id DESC", "");
						if(count_rows($result) > 0){
						while($row = fetch_data($result)){
						$cars_list .= $row["id"] . ",";
						}
						$cars_list = substr($cars_list,0,-1);
						$cars_list = explode(",",$cars_list);
						shuffle($cars_list);
						
						for($i=0;$i<2;$i++){
						if(!empty($cars_list[$i])){
						$result = $db->select("sellable_cars", "WHERE id = '" . $cars_list[$i] . "'", "*", "", "");
						$row = fetch_data($result);
						$slide_array = glob("images/ads-featured/" . $cars_list[$i] . "_*_ad_featured_*.jpg");
						$file_name = $slide_array[0];
						?>
                        <li class="col-sm-6">
                           <div class="vehicle-div clearfix">
                              <div class="vehicle-image"><a href="car-details.php?ad=<?php echo $cars_list[$i]; ?>"><img src="<?php echo $file_name; ?>" alt=""></a>
                              </div>
                              <div class="vehicle-title"><a href="car-details.php?ad=<?php echo $cars_list[$i]; ?>" class="black-link"><?php echo $row["brand"] . " " . $row["model"]; ?></a></div>
                              <div class="vehicle-price"><?php echo formatNumber($row["price"]); ?></div>
                              <div class="vehicle-info clearfix">
                                 <a class="vehicle-phone" onClick="javascript: sweetAlert('Contact Number', '<?php echo $row["contact_phone"]; ?>', 'success');"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                 <a class="vehicle-mail vehicle-mail2" id="privates/data-processor.php" lang="<?php echo $cars_list[$i]; ?>" data-toggle="modal" data-target="#gen-modal"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                              </div>
                              <div class="vehicle-detail">
                                 <ul class="vehicle-ul-inner clearfix">
                                    <li>
                                       <div class="vehicle-label">Year</div>
                                       <div class="vehicle-year"><?php echo $row["year"]; ?></div>
                                    </li>
                                    <li>
                                       <div class="vehicle-label">Mileage</div>
                                       <div class="vehicle-year"><?php echo formatQty($row["mileage"]); ?></div>
                                    </li>
                                    <li>
                                       <div class="vehicle-label">Location</div>
                                       <div class="vehicle-year"><?php echo $row["state"]; ?></div>
                                    </li>
                              </ul></div>
                           </div>
                           </li>
                           
                        <?php }} } ?>
                        
                           </ul>
                     </div>
                  </div>
                 <div class="col-sm-6">
                     <h3 class="heading-vehicle">PREMIUM VEHICLES POSTS</h3>
                     <div class="row"   id="boxshad">
                        <ul class="vehicle-ul">
                        
                        <?php 
						$cars_list = "";
						$result = $db->select("sellable_cars", "WHERE plan > '1' AND status = '1'", "*", "ORDER BY id DESC", "");
						if(count_rows($result) > 0){
						while($row = fetch_data($result)){
						$cars_list .= $row["id"] . ",";
						}
						$cars_list = substr($cars_list,0,-1);
						$cars_list = explode(",",$cars_list);
						shuffle($cars_list);
						
						for($i=0;$i<2;$i++){
						if(!empty($cars_list[$i])){
						$result = $db->select("sellable_cars", "WHERE id = '" . $cars_list[$i] . "'", "*", "", "");
						$row = fetch_data($result);
						$slide_array = glob("images/ads-featured/" . $cars_list[$i] . "_*_ad_featured_*.jpg");
						$file_name = $slide_array[0];						
						?>
                        <li class="col-sm-6">
                           <div class="vehicle-div clearfix">
                              <div class="vehicle-image"><a href="car-details.php?ad=<?php echo $cars_list[$i]; ?>"><img src="<?php echo $file_name; ?>" alt=""></a>
                              </div>
                              <div class="vehicle-title"><a href="car-details.php?ad=<?php echo $cars_list[$i]; ?>" class="black-link"><?php echo $row["brand"] . " " . $row["model"]; ?></a></div>
                              <div class="vehicle-price"><?php echo formatNumber($row["price"]); ?></div>
                              <div class="vehicle-info clearfix">
                                 <a class="vehicle-phone" onClick="javascript: sweetAlert('Contact Number', '<?php echo $row["contact_phone"]; ?>', 'success');"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                 <a class="vehicle-mail vehicle-mail2" id="privates/data-processor.php" lang="<?php echo $cars_list[$i]; ?>" data-toggle="modal" data-target="#gen-modal"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                              </div>
                              <div class="vehicle-detail">
                                 <ul class="vehicle-ul-inner clearfix">
                                    <li>
                                       <div class="vehicle-label">Year</div>
                                       <div class="vehicle-year"><?php echo $row["year"]; ?></div>
                                    </li>
                                    <li>
                                       <div class="vehicle-label">Mileage</div>
                                       <div class="vehicle-year"><?php echo formatQty($row["mileage"]); ?></div>
                                    </li>
                                    <li>
                                       <div class="vehicle-label">Location</div>
                                       <div class="vehicle-year"><?php echo $row["state"]; ?></div>
                                    </li>
                              </ul></div>
                           </div>
                           </li>
                           
                        <?php }} } ?>
                          
                           </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="benefit-add">
          <div class="container">
               <div class="row">
                  <div class="col-sm-12 col-md-9">
                    <div class="member-benefit">
                    <h3 class="heading-vehicle">CASH BENEFITS TO MEMEBRS</h3>
                    <div class="member-image">
                      <img class="img-responsive" src="images/member.jpg" alt="">
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<br><br>

There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia
<br><br>

There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, Contrary to popular belief, Lorem Ipsum is not simply random text. 
</p><div class="text-center">
<a class="read-more" href="#">Read More</a> </div>
                    </div>
                  </div>
                   <div class="col-sm-12 col-md-3">
                     <div class="clearfix">
                    <div class="special-add main-special-add">
                    <h3 class="heading-vehicle">SPECIAL MENTIONED ADS</h3>
                    </div>
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
                     </ul>
                    </div></div>
                    <div class="clearfix main-special-add">
                    <div class="special-add">
                    <h3 class="heading-vehicle">Member's Free Ads</h3>
                    </div>
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
                     </ul>
                    </div></div>


                  </div>
                  </div>
                  </div>

         </div>
         <div class="our-services">
          <div class="container">
             <div class="row">
              <div class="col-sm-12">
            <h1>  our Services</h1>
 </div> </div>
          
               <div class="row">
                  <div class="col-sm-4">
                    <div class="service-div text-center">
                      <img src="images/ic-01.png" alt="">
                      <h3>Car Loans</h3>
                      <p>Get connected to local car loan providers verified by Cheki for reliable car loan quotes</p>
                      <a href="#">Read More</a>
                    </div>

                  </div>
                     <div class="col-sm-4">
                    <div class="service-div text-center">
                      <img src="images/ic-02.png" alt="">
                      <h3>Insurance</h3>
                      <p>Get connected to local car insurance companies verified by Cheki for reliable car insurance quotes</p>
                      <a href="#">Read More</a>
                    </div>

                  </div>
                     <div class="col-sm-4">
                    <div class="service-div text-center">
                      <img src="images/ic-03.png" alt="">
                      <h3>Spare Parts</h3>
                      <p>Get connected to local spare part dealers verified by Cheki for reliable spare part quotes</p>
                      <a href="#">Read More</a>
                    </div>

                  </div>
                  </div>
                  </div>

         </div>
         <div class="job-section">
            <div class="container">
               <div class="row">
                  <div class="col-sm-6">
                     <h3 class="heading-vehicle">JOB RECRUITMENT & SEMINAR</h3>
                   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><br>
                   <h4>Car Driver</h4>
                   <p>2 Years Experts in car Drviving</p>
                   <h4>Washing Car</h4>
                   <p>It is a long established fact that a reader will be distracted by the readable .</p>
                   <h4>Car Salesman</h4>
                   <p>It is a long established fact that a reader will be distracted by the readable
content of a page when looking at its layout. The point of using
Lorem Ipsum is that it has a more-or-less normal distribution of letters, </p>
                   <div class="text-center">
<a class="read-more" href="#">Read More</a> </div>
                  </div>
                  <div class="col-sm-6">
                     <h3 class="heading-vehicle">FACEBOOK & TWITTER COMPETITIONS</h3>
                   <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.<br><br>

There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary looks reasonable. </p>
<br><br>
<div class="text-center">
<a class="read-more" href="#">Read More</a> </div>
                  </div>
                 
               </div>
            </div>
         </div>
      </div>

<div class="general-result"></div>
<div class="general-fade"></div>

      <div class="footer">
        <div class="footer-top">
           <div class="container">
               <div class="row">
                  <div class="col-sm-3">
                     <div class="footer-inner">
                    <h2>SubCribe To our newsletter</h2>
				<form action="<?php directory(); ?>privates/data-processor.php" class="general-form" id="general-result" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
                <input type="hidden" name="newsletter_subscription" value="1">
                    <div class="subscribe">
                        <div>
                           <span><input placeholder="Ener your email id" class="" size="40" value="" name="email" type="email"></span>
                           <button type="submit" class="button-newsletter"> SUBSCRIBE  </button>
                           <div class="clearfix subscribe-text">*We send great deals and latest auto news to our subscribed users very week.</div>
                        </div>
                     </div>
                     </form>
                  </div>
                  </div>
                   <div class="col-sm-5">
                    <div class="footer-inner">
                    <h2>More information</h2>
                    <ul class="footer-ul">
                      <li><a href="index.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Home</a></li>
                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Car Loans</a></li>

                      <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Buy A Car</a></li>
                      <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Car Insurance</a></li>


                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Dealers</a></li>
                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Spare Parts</a></li>

                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Use My Car For Adverts</a></li>
                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Vehicle Tracking /Speed Limiters</a></li>

                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Member Benefits</a></li>
                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Become Marketer</a></li>
                    </ul>
                  </div>
                   </div>
                   <div class="col-sm-4">
                       <div class="footer-inner">
                    <h2>About Us</h2>
                    <ul class="footer-ul">
                      <li><a href="privates/about-us.php"><i class="fa fa-angle-right" aria-hidden="true"></i>About Us</a></li>
                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Tips & Advise</a></li>

                      <li><a href="privates/contact-us.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Contact Us</a></li>
                      <li><a href="privates/terms.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Privacy Policy</a></li>


                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>news</a></li>
                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Terms and Conditions</a></li>

                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Win a Car</a></li>
                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Press Releases</a></li>

                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Careers</a></li>
                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>FAQ</a></li>
                    </ul>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>
                   <div class="footer-bottom">
                    <div class="container">
               <div class="row">
                  <div class="col-sm-6">
                    <div class="copyright">
                    Copyright 2017 @ use my car.All right reserved.
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <ul class="social-icon">
                     
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                         <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                       
                  
                    </ul>
                  </div>
                </div>
              </div>
                    </div>
      </div>
      
<?php include_once("includes/forms.php"); ?>

      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="owl-carousel-2/owl.carousel.min.js"></script>
      <script src="js/jquery.newsTicker.js"></script>
      <script src="js/general.js"></script>
<script src="js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
      <script>
         $(window).load(function(){
                 $('code.language-javascript').mCustomScrollbar();
             });
               var nt_title = $('#nt-title').newsTicker({
                   row_height: 40,
                   max_rows: 1,
                   duration: 3000,
                   pauseOnHover: 0
               });
         
           
      </script>
      
     <script>
         $(document).ready(function() {
         $('.owl-carousel-new').owlCarousel({
         loop:true,
         margin:10,
         nav:true,
         autoplay:true,
         dots:true,
         responsive:{
         0:{
         items:1,
          dots:false,
         },
         600:{
         items:1
         },
         1000:{
         items:1
         }
         }
         })
         
             
         })
         
    </script>
   </body>
</html>

