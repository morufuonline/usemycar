<?php
function image_resize($old_file, $new_file, $extension, $intended_width, $intended_height) {
$width = $intended_width;
$height = $intended_height;
list($original_width, $original_height) = getimagesize($old_file);
$scale_ratio = $original_width / $original_height;
if($original_width <= $intended_width && $original_height <= $intended_height){
$width = $original_width;
$height = $original_height;
}else if (($intended_width / $intended_height) > $scale_ratio) {
$width = $intended_height * $scale_ratio;
} else {
$height = $intended_width / $scale_ratio;
}
	
$image = "";
$extension = strtolower($extension);
if ($extension == "gif" || $extension == "GIF"){ 
$image = imagecreatefromgif($old_file);
} else if($extension =="png" || $extension =="PNG"){ 
$image = imagecreatefrompng($old_file);
} else { 
$image = imagecreatefromjpeg($old_file);
}
$image_true_color = imagecreatetruecolor($width, $height);
imagecopyresampled($image_true_color, $image, 0, 0, 0, 0, $width, $height, $original_width, $original_height);
imagejpeg($image_true_color, $new_file, 100);
imagedestroy($image);
}
?>