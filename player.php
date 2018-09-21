<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<video width="100%" height="650" controls id="video_play" autoplay>
<source src="<?php echo $_REQUEST['path'];?>" type="video/mp4" id="video_frame"  > 
</video>

<?php
/*
for video
$shorturl_input=str_replace('strikerapp/upload_shorturl_image','strikerapp/player.php?path=upload_shorturl_image',$shorturl_input);

fore audio
$shorturl_input=str_replace('strikerapp/upload_shorturl_image','strikerapp/viewimage.php?path=upload_shorturl_image',$shorturl_input);
*/
?>
