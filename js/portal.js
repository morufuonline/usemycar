<!--
if (self!=top)
{
top.location.href=self.location.href;
}

$(document).ready(function(){
						  
$(window).resize(function (){
						
if($("button.collapse").css("display") == "none"){
done = 0;
$(".portal-nav").show();
$(".portal-wrapper .portal-content").css({"display":"table-cell"});
}
if($("button.collapse").css("display") == "block"){
if(done == 0){
done = 1;
$(".portal-wrapper .portal-content").css({"display":"block"});
$(".portal-nav").hide();
}
}

});

////////////////////////////
$(".details-tab a").click(function(){
var this_id = $(this).attr("id");
var this_div = this_id + "-div";
$(".details-tab a").not($(this)).removeClass("current");
$(this).addClass("current");
$(".details-div").not("#" + this_div).hide("slide");
$("#" + this_div).show("slide");
});

////////////////////////////
$(".header-wrapper .collapse").click(function(){
$(".portal-wrapper .portal-nav").slideToggle();
});
///////////////////////////

$(".selectpicker").selectpicker({
style: 'btn-info',
size: 4
});
///////////////////////////

});

//-->