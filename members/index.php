<?php require_once("../includes/user-header.php"); ?> 

<style>
<!--
.body-content2{
background:#ddd;
padding:10px;
}
.portal-body-wrapper{
width:100%;
margin-bottom:20px;
}
.portal-body-wrapper .home-nav{
width:25%;
float:left;
padding:10px;
}
.portal-body-wrapper .home-nav a{
text-decoration:none !important;
}

@media(max-width:1200px){
.portal-body-wrapper .home-nav{
width:50%;
}
}
@media(max-width:900px){
.portal-body-wrapper .home-nav{
width:100%;
}
}
@media(max-width:800px){
.portal-body-wrapper .home-nav{
width:50%;
}
}
@media(max-width:500px){
.portal-body-wrapper .home-nav{
width:100%;
}
}
.details{
margin:10px;
}
.details p{
font-size:30px;
overflow:hidden;
padding:10px;
}
.portal-body-wrapper .body-content{
display:table;
width:100%;
}
.portal-body-wrapper .body-content div.inner-content{
display:table-cell;
}
.portal-body-wrapper .body-content div.icon-div{
width:50px;
padding-left:5px;
text-align:right;
vertical-align:bottom;
}
.portal-body-wrapper .body-content div.icon-div i{
font-size:70px;
}
.portal-body-wrapper .body-content:hover{
background:#000;
color:#fff;
}
.portal-body-wrapper .body-content:hover *{
color:#fff;
}
.red{
color:#f33;
}
.green{
color:#5cb85c;
}
.purple{
color:#966;
}
-->
</style>

<div class="page-title">Dashboard</div>

<div class="home-nav">
<a href="my-cars-for-sales.php"><div class="body-content body-content2">
<div class="inner-content">
<p>Cars: <b><?php echo formatQty(in_table("COUNT(id) AS total","sellable_cars","WHERE user_id = '$id'","total")); ?></b></p>
<div style="background:#ddd;"><div style="width:70%; padding:7px; background:#966;"></div></div>
</div>
<div class="inner-content icon-div">
<i class="fa fa-car" aria-hidden="true"></i>
</div>
</div></a>
</div>

<div class="home-nav">
<a href="inbox.php"><div class="body-content body-content2">
<div class="inner-content">
<p>Inbox: <b><?php echo formatQty(in_table("COUNT(id) AS total","users_messages","WHERE recipient_email = '$user_email' AND inbox = '1' AND viewed = '0'","total")); ?></b></p>
<div style="background:#ddd;"><div style="width:70%; padding:7px; background:#5cb85c;"></div></div>
</div>
<div class="inner-content icon-div">
<i class="fa fa-inbox red" aria-hidden="true"></i>
</div>
</div></a>
</div>

<div class="home-nav">
<a href="profile.php"><div class="body-content body-content2">
<div class="inner-content">
<p>Profile</p>
<div style="background:#ddd;"><div style="width:70%; padding:7px; background:#5bc0de;"></div></div>
</div>
<div class="inner-content icon-div">
<i class="fa fa-user purple" aria-hidden="true"></i>
</div>
</div></a>
</div>

<div class="home-nav">
<a href="reset-password.php"><div class="body-content body-content2">
<div class="inner-content">
<p>Change Password</p>
<div style="background:#ddd;"><div style="width:70%; padding:7px; background:#f33;"></div></div>
</div>
<div class="inner-content icon-div">
<i class="fa fa-lock green" aria-hidden="true"></i>
</div>
</div></a>
</div>

</div>

<div class="body-content details form-div">
<p>Search for an item</p>
<form onSubmit="javascript:void(0);" action="" method="post">
<input type="text" name="" class="form-control" value="" placeholder="Type the name of the item">

<div class="submit-div">
<button class="btn gen-btn float-right" name="update"><i class="fa fa-search"></i> Search</button>
</div>

</form>
</div>
</div>

</div>

<?php require_once('../includes/portal-footer.php'); ?> 