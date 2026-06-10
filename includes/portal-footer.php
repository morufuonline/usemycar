<link rel="stylesheet" type="text/css" href="css/sweetalert.css">

<div class="general-result"></div>
<div class="general-fade"></div>

<div class="footer-wrapper">
<div class="footer container">

<div class="col-sm-4 nav-link share">
<div class="title btn">GET IN TOUCH</div>
<a><i class="fa fa-map-marker" aria-hidden="true"></i> 3, Balogun Street, Off Akinremi Street, Anifowoshe, Ikeja, Lagos, Nigeria.</a>
<a><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $gen_email; ?></a>
<a><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $gen_phone; ?></a>
</div>

<div class="col-sm-4 nav-link">
<div class="title btn">QUIK LINKS</div>
<a href="<?php echo $directory; ?>" ><i class="fa fa-home" aria-hidden="true"></i> Home</a>
<a href="../privates/about-us.php" ><i class="fa fa-users" aria-hidden="true"></i> About Us</a>
<a href="../privates/contact-us.php" ><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a>
</div>

<div class="col-sm-4 subscribe">
<div class="title btn">NEWSLETTER</div>
<form action="<?php directory(); ?>privates/data-processor.php" class="general-form" id="general-result" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">

<input type="hidden" name="newsletter_subscription" value="1">

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa"><label for="email">Email</label></i></span>
<input type="email" name="email" id="email" class="form-control" value="" placeholder="Your email" required>
</div>
<div style="text-align:right">
<button  name="subscribe" id="subscribe"><i class="fa fa-send"></i> Subscribe</button>
</div>	
</form>
<div class="footer-social">
<a href="javascript:void(0);" title="Facebook" class="fa fa-facebook btn" target="_blank"></a>
<a href="javascript:void(0);" title="Twitter" class="fa fa-twitter btn"></a>
<a href="javascript:void(0);" title="Google +" class="fa fa-google-plus btn"></a>
<a href="javascript:void(0);" title="Pinterest" class="fa fa-pinterest-p btn"></a>
<a href="javascript:void(0);" title="Instagram" class="fa fa-instagram btn"></a>
</div>
</div>

</div>
</div>

<div class="copyright">Copyright &copy; <?php echo date("Y") . " " . $gen_name; ?>. All Rights Reserved.</div>

<script type="text/javascript" src="../js/general.js"></script>
<script type="text/javascript" src="../js/portal.js"></script>
<?php
$db->disconnect();
 detectCurrUserBrowser('</td></tr></table>','',7); ?>
</body>
</html>