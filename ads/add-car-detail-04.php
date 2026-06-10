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
            <form action="pay-publish.html">
              <h6 class="add-car-heading">Upload Your Car Photos</h6>
              <div class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-7 control-label">Registered car owners should include a picture which shows a clear registeration plate</label>
                  <div class="col-sm-5">
                    <button class="button border marron file-input">Choose File <input type="file"></button>
                    <span class="file-input-selection">No file Chosen</span>
                  </div> <!-- end .col-sm-5 -->
                </div> <!-- end .form-group -->
              </div> <!-- end .form-horizontal -->
              <h6 class="add-car-heading margin-top">Provide A Hosted Video URL of Your Car</h6>
              <div class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-7 control-label">As per our experience and selling stats we found that listings with video available sell more faster than the one which do not have any video.</label>
                  <div class="col-sm-5">
                    <input type="text" placeholder="Video URL">
                  </div> <!-- end .col-sm-5 -->
                </div> <!-- end .form-group -->
              </div> <!-- end .form-horizontal -->
              <h6 class="add-car-heading margin-top">Add Some Comments About Your Car</h6>
              <div class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-7 control-label">Enter here some impressive wording about your car to attract more buyers ineterest in your Ad listing. this will appear on the search results page as well.</label>
                  <div class="col-sm-5">
                    <textarea rows="7" placeholder="Add your Comment"></textarea>
                  </div> <!-- end .col-sm-5 -->
                </div> <!-- end .form-group -->
              </div> <!-- end .form-horizontal -->
              <div class="row">
                <div class="col-sm-5 col-sm-offset-7">
                  <button type="submit" class="button solid marron">Save and Continue</button>
                </div> <!-- end .col-sm-5 -->
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
