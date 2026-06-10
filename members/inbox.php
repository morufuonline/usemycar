<?php include_once("../includes/user-header.php"); ?> 

<?php
$delete = np_input("delete");
$view = nr_input("view");

/////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["delete"]) && isset($_POST["del"])){
$i = 0;
if(is_array($_POST["del"])){
foreach ($_POST["del"] as $k => $c) {
if($c != ""){ 
$c = testQty($c);
$act = $db->delete("users_messages", " id='{$c}' AND recipient_email = '$user_email' AND inbox = '1'");	
							
$activity = "Deleted received message #{$c} from database.";
$audit_data_array = array(
"user_id" => "'$id'",
"name" => "'$username'",
"email" => "'$user_email'",
"activity" => "'$activity'",
"date_time" => "'$date_time'"
);
$act = $db->insert($audit_data_array, "admin_log");
$i++;			
}else{
continue;
}
}

if($act){
$_SESSION["msg"] = "<div class='alert alert-success alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> {$i} message(s) successfully deleted.</div>";
redirect("inbox.php?pn={$pn}");
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Error. Unable to delete message(s).</div>";
}

}else{
echo "<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Atleast one field must be selected.</div>";
}
}

////////////////////////////////////////////////////******************************//////////////

$result = $db->select("users_messages", "WHERE recipient_email = '$user_email' AND inbox = '1'", "*", "ORDER BY id DESC");

$per_view = 20;
$page_link = "inbox.php?pn=";
$link_suffix = "";
$style_class = "";
page_numbers();

if(isset($_SESSION["msg"]) && empty($delete)){
echo $_SESSION["msg"];
$_SESSION["msg"] = NULL;
unset($_SESSION["msg"]);
}
?>

<?php
if(empty($view)){
?>

<div class="page-title">Inbox</div>

<?php
$d = 0;

$offset = ($per_view * $pn) - $per_view;

$result = $db->select("users_messages", "WHERE recipient_email = '$user_email' AND inbox = '1'", "*", "ORDER BY id DESC", "LIMIT {$offset},{$per_view}");

if(count_rows($result) > 0){
?>
<form action="inbox.php" method="post" runat="server" autocomplete="off" enctype="multipart/form-data" style="overflow-x:auto;">
<input type="hidden" name="pn" value="<?php echo $pn; ?>">
<input type="hidden" name="delete" value="1"> 
<table class="table table-striped table-hover">
<thead>
<tr class="gen-title">
<th>ID</th>
<th>Subject</th>
<th>Sent by</th>
<th>Date Received</th>
<th>More</th>
<th style="width:30px;"><input type="checkbox" name="sel_all" id="delG" class="sel-group" value=""></th>
</tr>
</thead>
<tbody>
<?php
while($row = fetch_data($result)){
$id = $row["id"];
$subject = $row["subject"];
$sender_name = $row["sender_name"];
$sender_email = $row["sender_email"];
$viewed = $row["viewed"];
$date = min_full_date($row["date_time"]);
?>
<tr<?php echo ($viewed == 0)?" class=\"not-viewed\" title=\"Not viewed\"":" title=\"Viewed\""; ?>>
<td><?php echo $id; ?></td>
<td><?php echo $subject; ?></td>
<td><?php echo "{$sender_name}<br>({$sender_email})"; ?></td>
<td><?php echo $date; ?></td>
<td><a href="inbox.php?view=<?php echo $id; ?>&pn=<?php echo $pn; ?>" class="btn gen-btn" title="View message #<?php echo $id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
<td><input type="checkbox" name="del[<?php echo $d; ?>]" id="del<?php echo $d; ?>" class="delG" value="<?php echo $id; ?>"></td>
</tr>
<?php 
$d++;
}
?>
<tr><td colspan="6"><button type="submit" class="btn gen-btn float-right"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete selected message(s)</button></td></tr>
</tbody>
</table>
</form>
<?php
echo ($last_page>1)?"<div class=\"page-nos\">" . $center_pages . "</div>":"";
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'>No messages found at the moment.</div>";
}

}

//=======================View Post==============================//
if(!empty($view)){
$result = $db->select("users_messages", "WHERE id='$view' AND recipient_email = '$user_email' AND inbox = '1'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$subject = $row["subject"];
$message = $row["message"];
$sender_name = $row["sender_name"];
$sender_email = $row["sender_email"];
$date = min_full_date($row["date_time"]);

$db->query("UPDATE users_messages SET viewed = '1' WHERE id = '{$view}'");
?>

<div class="reply-content-wrapper ">

<div><a href="inbox.php?pn=<?php echo $pn; ?>" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back to inbox</a></div>

<div class="view-wrapper ">

<div class="view-header ">
<div class="header-img"><img src="../images/post.jpg" ></div>
<div class="header-content">
<div class="view-title"><?php echo $subject; ?></div>
<div class="view-title-details">From: <?php echo "{$sender_name} ({$sender_email}) {$date}"; ?></div>
</div>
</div>

<div class="view-content">
<?php echo ($sender_email == $gen_email)?html_entity_decode($message):$message; ?>
</div>

</div>
</div>

<?php
}else{
echo "<div class='alert alert-danger alert-dismissable fade in'>No messages found at the moment.</div>";
}
}
?>

</div>
</div>

</div>

<?php require_once("../includes/portal-footer.php"); ?>