<script src="../js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">

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
                      <li><a href="../"><i class="fa fa-angle-right" aria-hidden="true"></i>Home</a></li>
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
                      <li><a href="../privates/about-us.php"><i class="fa fa-angle-right" aria-hidden="true"></i>About Us</a></li>
                       <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Tips & Advise</a></li>

                      <li><a href="../privates/contact-us.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Contact Us</a></li>
                      <li><a href="../privates/terms.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Privacy Policy</a></li>


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
<?php include_once("../includes/forms.php"); ?>
      <script>
         $(document).ready(function() {
         $('.owl-carousel-new').owlCarousel({
         loop:true,
         margin:10,
         nav:true,
         autoplay:false,
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
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../bootstrap/js/bootstrap.min.js"></script>
      <script src="../owl-carousel-2/owl.carousel.min.js"></script>
      <script src="../js/jquery.newsTicker.js"></script>
      <script src="../js/general.js"></script>
     
      <script type="text/javascript">
         $(window).ready(function(){
                 $('code.language-javascript').mCustomScrollbar();
             });
               var nt_title = $('#nt-title').newsTicker({
                   row_height: 40,
                   max_rows: 1,
                   duration: 3000,
                   pauseOnHover: 0
               });
         
           
      </script>
      
      <script src="../js/bootstrap-select.js" /></script>
	  
       <script src="js/jquery.flexslider-min.js"></script>
          <script type="text/javascript">
         $(window).load(function(){
           $('#carousel-new').flexslider({
             animation: "slide",
             controlNav: false,
             animationLoop: false,
             slideshow: false,
             itemWidth: 80,
             itemMargin: 20,
             asNavFor: '#slider'
           });
         
           $('#slider').flexslider({
             animation: "slide",
             controlNav: false,
             animationLoop: false,
             slideshow: false,
             sync: "#carousel",
             start: function(slider){
               $('body').removeClass('loading');
             }
           });
         });
      </script>
      
      
   </body>
</html>

<?php $db->disconnect(); ?>