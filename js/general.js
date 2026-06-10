<!--
if (self!=top)
{
top.location.href=self.location.href;
}

var loading_selected_notification = "<option value=\"\">Loading...</option>";

$(document).ready(function(){
						   
$(".general-fade").hide();
	
$(".only-no").keyup(function(){
var this_val = this.value;
if(isNaN(this_val)){
this.value = this_val.replace(/[^0-9.]/gi, "");
}	
}).change(function(){
var this_val = this.value;
if(isNaN(this_val)){
this.value = this_val.replace(/[^0-9.]/gi, "");
}	
});

///////////////////////////////
$( ".general-form" ).on( "submit", function(e) {
e.preventDefault();  
var formdata = new FormData(this);
$(".general-fade").show();
var page_url = $(this).attr("action");
var page_result = $(this).attr("id");
$.ajax({
url: page_url,
type: "POST",
data: formdata,
mimeTypes:"multipart/form-data",
contentType: false,
cache: false,
processData: false,
success: function(data){
$("." + page_result).html(data);
$(".general-fade").hide();
},error: function(){
sweetAlert("Notice", "An error occured!", "error");
$(".general-fade").hide();
}
});

});

///////////////////////////////
$("body").find( ".general-form2" ).on( "submit", function(e) {
e.preventDefault();  
var formdata = new FormData(this);
$(".general-fade").show();
var page_url = $(this).attr("action");
var page_result = $(this).attr("id");
var this_name = $(this).attr("name");
var this_lang = $(this).attr("lang");
var this_title = $(this).attr("title");

document.getElementById(this_name).style.display = "none";
document.getElementById(this_lang).style.display = "block";
$.ajax({
url: page_url,
type: "POST",
data: formdata,
mimeTypes:"multipart/form-data",
contentType: false,
cache: false,
processData: false,
success: function(data){
document.getElementById(this_lang).style.display = "none";
document.getElementById(this_name).style.display = "block";
if(this_title == "add"){
$("." + page_result).append(data);
}else if(this_title == "edit"){
$("." + page_result).html(data);
}
$(".general-fade").hide();
},error: function(){
sweetAlert("Notice", "An error occured!", "error");
document.getElementById(this_lang).style.display = "none";
document.getElementById(this_name).style.display = "block";
$(".general-fade").hide();
}
});

});
////////////////////////////////

$("input:checkbox:not(.sel-group)").change(function () {
var checked_class = $(this).attr("class");
var  det_unchecked = $("input:checkbox."+checked_class+":not(:checked)").length;
var  det_unchecked_all = $("input:checkbox:not(:checked)").length;

if(det_unchecked > 0){
$("input:checkbox#"+checked_class).prop("checked", false);
}else if(det_unchecked == 0 && det_unchecked_all == 1){
$("input:checkbox#"+checked_class).prop("checked", true);
}else{
$("input:checkbox#"+checked_class).prop("checked", true);
}
});

$("input.sel-group").change(function(){
var group_id = $(this).attr("id");
$("input:checkbox."+group_id).prop("checked", $(this).prop("checked"));
var  det_unchecked_all = $("input:checkbox:not(:checked)").length;
});

///////////////////////////////////////////
$("#ufile").change(function(){
$(".img-form").submit();
});

/////////////////////////////////

$(".list-style-sell li").click(function(){
var parent_id = $(this).parent("label").parent("ul").attr("id");
$("ul#"+parent_id + " li.active").removeClass("active");
$(this).addClass("active");
});
//////////////////////////////////

$( ".gen-date" ).datepicker({
dateFormat: "yy-mm-dd",
changeMonth: true,
changeYear: true,
yearRange: "1901:2100"
});
////////////////////////////////////////

$(".vehicle-mail2").click(function(){
var this_lang = $(this).attr("lang");
var this_id = $(this).attr("id");
$(".modal-result").html("<i class=\"fa fa-spinner fa-spin fa-3x fa-fw\" aria-hidden=\"true\"></i>");
$.post(this_id, {load_contact : this_lang}, function(data){ $(".modal-result").html(data); })
.error(function() { 
sweetAlert("Notice", "An error occured!", "error");
$(".modal-result").html("Try again!");
 });
});
///////////////////////////////////////

$(".gen-save").click(function(){
var this_name = $(this).attr("name");
var this_id = $(this).attr("id");
var this_lang = $(this).attr("lang");
$(this).children("i.gen-heart").hide();
$(this).children("i.gen-spin").show();
$.post(this_lang, {save_ad : this_name}, function(data){
if(data == 1){	
$("#"+this_id).html("<i class=\"fa fa-heart-o gen-heart\"></i><i class=\"fa fa-spinner fa-spin fa-3x fa-fw gen-spin\" aria-hidden=\"true\"></i>Unsave");
}else{
$("#"+this_id).html("<i class=\"fa fa-heart-o gen-heart\"></i><i class=\"fa fa-spinner fa-spin fa-3x fa-fw gen-spin\" aria-hidden=\"true\"></i>Save");
}
})
.error(function() { 
sweetAlert("Notice", "An error occured!", "error");
$(this).children("i.gen-spin").hide();
$(this).children("i.gen-heart").show();
});
});
///////////////////////////////////////

});

function gen_load(url, par, val, result, loading_data){
document.getElementById(result).innerHTML = loading_data;
if(val != ""){
$.post(url, {parameter : par, parameter_value : val}, function(data){ document.getElementById(result).innerHTML = data; })
.error(function() { 
sweetAlert("Notice", "An error occured!", "error");
document.getElementById(result).innerHTML = "";
 });	
}else{
document.getElementById(result).innerHTML = "";
}
}

function delete_file(url, par, val, del_loader, del_result){

document.getElementById(del_loader).style.display = "block";

if(val != ""){
$.post(url, {parameter : par, parameter_value : val}, function(data){ 
if(data == 1){
document.getElementById(del_result).outerHTML = "";
}
 }).error(function() { 
sweetAlert("Notice", "An error occured!", "error");
document.getElementById(del_loader).style.display = "none";
 });	
}
}
//-->