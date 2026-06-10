<!-- No1 -->
      <div class="modal fade" id="sign-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="vertical-alignment-helper">
  <div class="modal-dialog vertical-align-center" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="closing" aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
     <div class="left-modal">
     <span class="login-head"><span><span>Login</span></span></span><p class="login-txt"><span><span>Get access to your Dream Cars</span></span></p>
     </div>
     <div class="right-modal">
<div class="modal-body-left register-div">
                     <div class="form-group visible-xs">
                       <h5> login</h5>
                       
                     </div>
                     
                     <div class="data-result1"></div>
				<form action="<?php directory(); ?>privates/data-processor.php" class="general-form" id="data-result1" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
                <input type="hidden" name="login" value="1">

                  	<div class="form-group">
                        <input name="email" placeholder="Email Address" value="" class="form-control" type="email" required>
                     </div>
      
                    
                     <div class="form-group">
                        <input name="password" placeholder="Password" value="" class="form-control" type="password" required>
                     </div>
                    
                     <div class="clearfix">
                     <div class="checked">
                    <input name="remember" id="remember" value="1" type="checkbox">
                    <label for="remember">Remember me</label>
                </div></div>
      
                     <button type="submit" class="btn btn-success modal-login-btn">Login</button>
                     </form>
                     <p>&nbsp;</p>

                     <button class="btn btn-default form-control" data-toggle="modal" data-target="#forgot" data-dismiss="modal" aria-label="New user">Lost your password?</button>
                     <div class="clearfix"><div class="form-group modal-register-btn">
              <button class="btn btn-default form-control" data-toggle="modal" data-target="#sign-up" data-dismiss="modal" aria-label="New user"> New user? Please register.</button>
            </div></div>
                  <div id="center-line"> OR </div>  
                      
               </div>
               
               <div class="modal-body-right">
                  <div class="modal-social-icons">
                     <a href="#" class="btn btn-default facebook"> <i class="fa fa-facebook modal-icons"></i> Sign In with Facebook </a>
                     <a href="#" class="btn btn-default google"> <i class="fa fa-google modal-icons"></i> Sign In with Google+ </a>
                     
                     
                   <!--   <a href="#" class="btn btn-default linkedin"> <i class="fa fa-linkedin modal-icons"></i> Sign In with Linkedin </a> -->
                  </div> 
               </div>
     </div>


      </div>
     <div class="modal-footer">
      
      </div>
    </div>
  </div>
  </div>
</div>

<!-- No 2 -->
      <div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="vertical-alignment-helper">
  <div class="modal-dialog vertical-align-center" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="closing" aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
     <div class="left-modal">
     <span class="login-head"><span><span>Reset Password</span></span></span><p class="login-txt"><span><span>Kindly fill this form to reset your password. A mail will be sent to you regarding the new password procedure.</span></span></p>
     </div>
     <div class="right-modal">
<div class="modal-body-left register-div">
                     <div class="form-group visible-xs">
                       <h5>Reset Password</h5>
                       
                     </div>
                     
                     <div class="data-result2"></div>
				<form action="<?php directory(); ?>privates/data-processor.php" class="general-form" id="data-result2" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
                <input type="hidden" name="forgot" value="1">

                  	<div class="form-group">
                        <input placeholder="Email Address" value="" class="form-control" type="text">
                     </div>
 
                     <button type="submit" class="btn btn-success modal-login-btn">Send</button>
                     </form>
                     
                     <p>&nbsp;</p>
                     <button class="btn btn-default form-control" data-toggle="modal" data-target="#sign-in" data-dismiss="modal" aria-label="Login">Log in</button>
                     <div class="clearfix"><div class="form-group modal-register-btn">
               <button class="btn btn-default form-control" data-toggle="modal" data-target="#sign-up" data-dismiss="modal" aria-label="New user"> New user? Please register.</button>
            </div></div>
                      
               </div>
               
     </div>


      </div>
     <div class="modal-footer">
      
      </div>
    </div>
  </div>
  </div>
</div>

<!-- No 3 -->  
 <div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="vertical-alignment-helper">
  <div class="modal-dialog vertical-align-center" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="closing" aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
     <div class="left-modal">
     <span class="login-head"><span><span>Register</span></span></span><p class="login-txt"><span><span>We do not share your personal details with anyone.</span></span></p>
     </div>
     <div class="right-modal">
<div class="modal-body-left register-div">
   <div class="form-group visible-xs">
                       <h5>Register</h5>
                       
                     </div>
                     
                     <div class="data-result3"></div>
				<form action="<?php directory(); ?>privates/data-processor.php" class="general-form" id="data-result3" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
                <input type="hidden" name="register" value="1">
                  	<div class="form-group">
                        <input name="name" placeholder="Full Name*" value="" class="form-control" type="text" required>
                     </div>
                     
                  	<div class="form-group">
                        <select name="bank" title="Select a bank" class="form-control">
						<option value=""> - - Select a bank - - </option>
						<?php 
						$result = $db->select("banks", "", "DISTINCT *", "ORDER BY bank_name ASC");
						if(count_rows($result) > 0){
						while($row = fetch_data($result)){
						$bank_id = $row["id"];
						$bank_name = $row["bank_name"];
						echo "<option value='{$bank_id}'>{$bank_name}</option>";
						}
						}
						?>
						</select>
                     </div>
      
                  	<div class="form-group">
                        <input name="bank_account_name" placeholder="Bank Account Name" value="" class="form-control" type="text">
                     </div>
                     
                  	<div class="form-group">
                        <input name="bank_account_number" placeholder="Bank Account Number" value="" class="form-control only-no" type="text">
                     </div>

                     <div class="form-group">
                        <textarea name="address" placeholder="Contact Address*" class="form-control" rows="2" required></textarea>
                     </div>
      
                  	<div class="form-group">
                        <select name="country" title="Select a country" class="form-control">
						<option value="">Select a country*</option>
						<?php 
						$result = $db->select("countries", "", "DISTINCT *", "ORDER BY country ASC");
						if(count_rows($result) > 0){
						while($row = fetch_data($result)){
						$country_id = $row["id"];
						$country = $row["country"];
						echo "<option value='{$country_id}'>{$country}</option>";
						}
						}
						?>
						</select>
                     </div>

                     <div class="form-group">
                        <input name="phone" placeholder="Phone Number*" value="" class="form-control only-no" type="text" required>
                     </div>

                     <div class="form-group">
                        <input name="email" placeholder="Email Address*" value="" class="form-control" type="email" required>
                     </div>
                    
                     <div class="form-group">
                        <input name="password" placeholder="Password (atleast 5 chars)*" value="" class="form-control" type="password" required>
                     </div>
                     
                     <div class="form-group">
                        <input name="confirm_password" placeholder="Confirm Password (atleast 5 chars)*" value="" class="form-control" type="password" required>
                     </div>

                     <div class="form-group">
                     <div>Check code: <span style="color:#f33;"><?php $_SESSION["spam_checker"] = rand(1001,9999); echo $_SESSION["spam_checker"]; ?></span></div>
                        <input name="spam_checker" placeholder="Type the check code*" value="" class="form-control only-no" maxlength="4" type="text" required>
                     </div>
                     
                     
                     
                     <div class="clearfix">
                     <div class="checked">
                    <input name="newsletter" id="newsletter" value="1" type="checkbox"> 
                    <label for="newsletter">Send me newsletters</label>
                </div></div>
      
                     <button type="submit" class="btn btn-success modal-login-btn">Register</button>
                    </form>
                  <div id="center-line"> OR </div>  
                      
               </div>
               
               <div class="modal-body-right">
                  <div class="modal-social-icons">
                     <a href="#" class="btn btn-default facebook"> <i class="fa fa-facebook modal-icons"></i> Sign Up with Facebook </a>
                      <a href="#" class="btn btn-default google"> <i class="fa fa-google modal-icons"></i> Sign Up with Google+ </a>
                     
                     
                   <!--   <a href="#" class="btn btn-default linkedin"> <i class="fa fa-linkedin modal-icons"></i> Sign In with Linkedin </a> -->
                  </div> 
               </div>
     </div>


      </div>
      <div class="modal-footer">
      
      </div>
     
    </div>
  </div>
  </div>
</div>

<!-- Gen Modal -->

<div class="modal fade" id="gen-modal" role="dialog">
<div class="modal-dialog">
<div class="modal-content modal-result">
</div>
</div></div>