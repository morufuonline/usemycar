<?php require_once("../includes/header2.php"); ?>
      <section id="opal-breadscrumb" class="opal-breadscrumb" style=""><div class="container"><h2 class="title-page">Add Car Detail</h2>
      <ol class="breadcrumb has-title-page">
         <li><a href="../">Home</a> </li>
         <li class="active">Add Car Detail</li>

      </ol></div>
   </section>
      <div class="news-head">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="latest-news">
                     Daily News<i class="fa fa-angle-right" aria-hidden="true"></i>
                  </div>
                  <div class="latest-news-right">
                     <ul id="nt-title">
                        <li>
                           A powerful, flexible and animated vertical news ticker plugin.
                        </li>
                        <li>
                           Provides hight flexibility thanks to numerous callbacks & methods.
                        </li>
                        <li>
                           Fully customizable to every kind of vertical scrolling need.
                        </li>
                        <li>
                           Light-weight and optimized JQuery plugin.
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="content">
 <section class="section white">
      <div class="inner">
        <div class="container">
          <div class="add-car-header clearfix">
            <div class="item active">
              <div class="icon"><i class="fa fa-car"></i></div>
              <h6>Add Car Details</h6>
              <span class="sub">Choose your car</span>
              <span class="line"></span>
            </div> <!-- end .item -->
            <div class="item">
              <div class="icon"><i class="fa fa-list" aria-hidden="true"></i>
</div>
              <h6>Choose Specifications</h6>
              <span class="sub">Specifications of your car</span>
              <span class="line"></span>
            </div> <!-- end .item -->
            <div class="item">
              <div class="icon"><i class="fa fa-phone-square" aria-hidden="true"></i>
</div>
              <h6>Contact Details</h6>
              <span class="sub">Add your contact</span>
              <span class="line"></span>
            </div> <!-- end .item -->
            <div class="item">
              <div class="icon"><i class="fa fa-picture-o" aria-hidden="true"></i>
</div>
              <h6>Photos And Videos</h6>
              <span class="sub">Add Pics and Videos</span>
              <span class="line"></span>
            </div> <!-- end .item -->
            <div class="item">
              <div class="icon"><i class="fa fa-check-square" aria-hidden="true"></i></div>
              <h6>Pay &amp; Publish</h6>
              <span class="sub">Choose your listing</span>
              <span class="line"></span>
            </div> <!-- end .item -->
          </div> <!-- end .add-car-header -->
        </div> <!-- end .container -->
      </div> <!-- end .inner -->
    </section>

   
  <section class="section lighter">
      <div class="inner">
        <div class="container">
          <div class="add-car-form">
            <h6 class="add-car-heading">Choose The Way You Want TO Sell Your Car</h6>
            <p>You can use Premium Option to get more attonetion to your listing. This way you will get more opportunity to Sell your Car. Also we offer Free Listing, where you can easily add your car for sale in FREE.</p>
            <form>
              <div class="row">
                <div class="col-sm-6">
                  <div class="radio rounded">
                    <label>
                      <input type="radio" name="radios" value="option1" checked>
                      <div></div>
                      Premium Listing <span class="green">($9 / Listing)</span>
                    </label>
                  </div> <!-- end .radio -->
                  <p>Pay with Paypal</p>
                  <div class="input-group">
                    <input type="email" placeholder="Enter your Paypal ID">
                    <span class="input-group-btn">
                      <button type="submit" class="button border green pay-publish">Pay Now</button>
                    </span>
                  </div>
                </div> <!-- end .col-sm-6 -->
                <div class="column-spacer"></div>
                <div class="col-sm-6">
                  <div class="radio rounded">
                    <label>
                      <input type="radio" name="radios" value="option1">
                      <div></div>
                      Free Listing <span class="grey">(Absolutetly Free)</span>
                    </label>
                  </div> <!-- end .radio -->
                  <p>With Free Listing Option, you dont need to Pay any Money.</p>
                  <button type="submit" class="button solid green pay-publish">Publish Now</button>
                </div> <!-- end .col-sm-6 -->
              </div> <!-- end .row -->
            </form>
          </div> <!-- end .add-car -->
        </div> <!-- end .container -->
      </div> <!-- end .inner -->
    </section> <!-- end .section -->
        
      
       
         
      </div>
<?php require_once("../includes/footer.php"); ?>
     
      <script type="text/javascript">
      window.onload=function(){
      $('.selectpicker').selectpicker();
      $('.rm-mustard').click(function() {
        $('.remove-example').find('[value=Mustard]').remove();
        $('.remove-example').selectpicker('refresh');
      });
      $('.rm-ketchup').click(function() {
        $('.remove-example').find('[value=Ketchup]').remove();
        $('.remove-example').selectpicker('refresh');
      });
      $('.rm-relish').click(function() {
        $('.remove-example').find('[value=Relish]').remove();
        $('.remove-example').selectpicker('refresh');
      });
      $('.ex-disable').click(function() {
          $('.disable-example').prop('disabled',true);
          $('.disable-example').selectpicker('refresh');
      });
      $('.ex-enable').click(function() {
          $('.disable-example').prop('disabled',false);
          $('.disable-example').selectpicker('refresh');
      });

      // scrollYou
      $('.scrollMe .dropdown-menu').scrollyou();

      prettyPrint();
      };
    </script>