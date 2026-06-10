<?php require_once("../includes/header.php"); ?>

      <section id="opal-breadscrumb" class="opal-breadscrumb" style=""><div class="container"><h2 class="title-page">Contact Us</h2>
      <ol class="breadcrumb has-title-page">
         <li><a href="../">Home</a> </li>
         <li class="active">Contact Us</li>

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
$error = 1;
$name = tp_input("name");
$email = tp_input("email");
$phone = np_input("phone");
$subject = tp_input("subject");
$subject2 = $subject;
$message = tp_input("message");
$message2 = $message;

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($phone) && strlen($phone) >= 5 && !empty($subject) && !empty($message)){

$to = "{$email}";
$subject = "Ticket #{$ticket_id}: Inquiry on {$subject2}";
$message = "<p>Thank you for using our customer support service.</p>
<p>We will get back to you as soon as possible.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";

$act1 = send_mail();

$to = "{$gen_email}";
$subject = "Ticket #{$ticket_id}: Inquiry on {$subject2}";
$message = "<p><b>Email:</b> {$email}</p><p><b>Phone Number:</b> {$phone}</p><p>{$message2}</p>";
$foot_note = $regards = "";
$message = message_template();
$headers = "{$name} <{$email}>";
$act2 = send_mail(1);

$error = 0;

$user_data_array = array(
"ticket_id" => "'$ticket_id'",
"sender_name" => "'$name'",
"sender_email" => "'$email'",
"recipient_name" => "'$gen_name'",
"recipient_email" => "'$gen_email'",
"subject" => "'$subject2'",
"message" => "'$message2'",
"sent" => "'1'",
"date_time" => "'$date_time'"
);
$db->insert($user_data_array, "users_messages");

$admin_data_array = array(
"ticket_id" => "'$ticket_id'",
"sender_name" => "'$name'",
"sender_email" => "'$email'",
"sender_phone" => "'$phone'",
"recipient_name" => "'$gen_name'",
"recipient_email" => "'$gen_email'",
"subject" => "'$subject2'",
"message" => "'$message2'",
"inbox" => "'1'",
"date_time" => "'$date_time'"
);
$db->insert($admin_data_array, "admin_messages");

$user_ticket_id = $ticket_id . in_table("id","users_messages","WHERE sender_email = '{$email}' AND date_time = '{$date_time}'","id");
$admin_ticket_id = $ticket_id . in_table("id","admin_messages","WHERE sender_email = '{$email}' AND date_time = '{$date_time}'","id");
$db->query("UPDATE users_messages SET ticket_id = '{$user_ticket_id}', date_time = '{$date_time}' WHERE sender_email = '{$email}' AND date_time = '{$date_time}'");
$db->query("UPDATE admin_messages SET ticket_id = '{$admin_ticket_id}', date_time = '{$date_time}' WHERE sender_email = '{$email}' AND date_time = '{$date_time}'");

$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Your message was successfully sent. We will get back to you shortly.</div>";
redirect("contact-us.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message))){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not Successful. All fields must be properly filled.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not Successful. Invalid email format.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($phone) && strlen($phone) < 5){
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Not Successful. Phone number must not be less than 5 digits.</div>";
}

if(isset($_SESSION["msg"]) && empty($email)){
echo $_SESSION["msg"];
$_SESSION["msg"] = NULL;
unset($_SESSION["msg"]);
}
?>
      
      <div class="content">
          <div class="container listing-desc">
          
            <div class="row">
            
               <div class="col-md-8">
               
                  <div class="left-car-inner">
                 
                   <h5>Contact Us</h5>
                     
                     
<hr>
<div class="embed-responsive embed-responsive-16by9">

                 

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4016722.1801997344!2d73.88528767384214!3d10.533688706107892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b0812ffd49cf55b%3A0x64bd90fbed387c99!2sKerala!5e0!3m2!1sen!2sin!4v1488006564916" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
 <hr>
<p>Use My Car <br>
3, Balogun Street,
Off Akinremi Street,
Anifowoshe, Ikeja,
Lagos, Nigeria. <br><br>

Email: sales@usemycar.com, sales@usemycar.com<br>
Phone: 08035070947, 08035070947
</p><!-- <a href="images/Flowtech-brochure.pdf" class="btn-more btn" target="_blank">Download Brochure</a>-->
 

                     
                     
                     
                    
                     
                  </div>
                  
               </div>
               <div class="col-md-4">
                  <div class="white-sidebar">
                     
                     <div class="product-info-form">
                        <form class="form-horizontal" action="contact-us.php" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
                           <fieldset>
                              <div class="contact-seling"><i class="fa fa-file-text"></i>Type your message below:</div>
                              <!-- Form Name -->
                              <div class="form-group-cc">
                                 <label for="name" class="control-label">Your Name*</label>
                                 <div class="clearfix">
<input type="text" name="name" id="name" class="form-control"<?php echo (isset($_SESSION["login"]))?" onclick='javascript: $(this).blur()'":""; ?> placeholder="Your Full Name" required value="<?php echo (isset($_POST["name"]) && $error == 1)?$_POST["name"]:$username; ?>">
                                    <p class="help-block">help</p>
                                 </div>
                              </div>

                              <div class="form-group-cc">
                                 <label for="email" class="control-label">Email*</label>
                                 <div class="clearfix">
<input type="email" name="email" id="email" class="form-control"<?php echo (isset($_SESSION["login"]))?" onclick='javascript: $(this).blur()'":""; ?> placeholder="Your E-mail Address" required value="<?php echo (isset($_POST["email"]) && $error == 1)?$_POST["email"]:$user_email; ?>">
                                    <p class="help-block">help</p>
                                 </div>
                              </div>

                              <div class="form-group-cc">
                                 <label for="phone" class="control-label">Phone*</label>
                                 <div class="clearfix">
<input type="text" name="phone" id="phone" class="form-control only-no"<?php echo (isset($_SESSION["login"]))?" onclick='javascript: $(this).blur()'":""; ?>  placeholder="Your Phone Number" required value="<?php if(isset($_SESSION["login"])){echo in_table("phone","reg_members","WHERE email = '$user_email'","phone"); }else{ echo (isset($_POST["phone"]) && $error == 1)?$_POST["phone"]:""; } ?>">
                                    <p class="help-block">help</p>
                                 </div>
                              </div>

                              <div class="form-group-cc">
                                 <label for="subject" class="control-label">Subject*</label>
                                 <div class="clearfix">
<input type="text" name="subject" id="subject" class="form-control" placeholder="Keep it short" required value="<?php echo (isset($_POST["subject"]) && $error == 1)?$_POST["subject"]:""; ?>">
                                    <p class="help-block">help</p>
                                 </div>
                              </div>

                              <div class="form-group-cc">
                                 <label class="control-label" for="message">Message*</label>
                                 <div class="clearfix">
<textarea type="text" name="message" id="message" class="form-control" placeholder="Type your message" rows="1" required value=""><?php echo (isset($_POST["message"]) && $error == 1)?$_POST["message"]:""; ?></textarea>
                                    <p class="help-block">help</p>
                                 </div>
                              </div>
                              
                              <div class="form-group-cc">
                                 <div class="clearfix">
                                    <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary-seller" aria-label="Single Button"><i class="fa fa-envelope-o"></i>Submit</button>
                                    <p class="help-block">help</p>
                                 </div>
                              </div>
                           </fieldset>
                        </form>
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
                     </ul>
                    </div>
                     </div>
                     
                  </div>
                  </div>
               </div>
            </div>
         </div>

       
         
      </div>
<?php require_once("../includes/footer.php"); ?>