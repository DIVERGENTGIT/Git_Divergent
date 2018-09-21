<?php 
	extract($_POST);
	extract($_GET);
	include "shorturl.php";
	$obj = new shorturl;
?>
<html>
<head>
<title>Short Url</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">//<![CDATA[
window.onload=function(){
document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboardMsg(document.getElementById("copyTarget"), "msg");
});

document.getElementById("copyButton2").addEventListener("click", function() {
    copyToClipboardMsg(document.getElementById("copyTarget2"), "msg");
});

document.getElementById("pasteTarget").addEventListener("mousedown", function() {
    this.value = "";
});


function copyToClipboardMsg(elem, msgElem) {
	  var succeed = copyToClipboard(elem);
    var msg;
    if (!succeed) {
        msg = "Copy not supported or blocked.  Press Ctrl+c to copy."
    } else {
        msg = "Text copied to the clipboard."
    }
    if (typeof msgElem === "string") {
        msgElem = document.getElementById(msgElem);
    }
    msgElem.innerHTML = msg;
    setTimeout(function() {
        msgElem.innerHTML = "";
    }, 2000);
}

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}


}//]]> 

</script>
<script type="text/javascript">
 function showHide() {
   var div = document.getElementById("hidden_div");
   if (div.style.display == 'none') {
     div.style.display = '';
   }
   else {
     div.style.display = 'none';
   }
 }
</script>
</head>

<body>
<div class="col-sm-12 col-xs-12">
<div class="short_div">
<div class="col-sm-12 col-xs-12 logo_header">
<img src="images/logo.png">
</div>
<div class="col-sm-12 col-xs-12 padding_zero short_div_bg">
<div class="col-sm-12 col-xs-12 padding_zero header_top">
<h1>SHORTEN URL</h1>

</div>
<form class="form_container" action="" method="post" onsubmit="showHide(); autocomplete="off">
<div class="col-sm-12 col-xs-12">
<input type="text" id="input_url" name="input_url" placeholder="Paste your URL, shrink it, and share." required>
<input type="submit" name="submit_form" value="Short">
</div>
</form>
</div>

<div class="col-sm-12 col-xs-12 padding_zero short_url" id="hidden_div">
  <a href="#" id="copyTarget"><?php
	if(isset($_POST['submit_form']))
	{
		$result = $obj->generate_shortcode($input_url);
		if(isset($result))
		{
			//echo "www.ion.bz/".$result;
			echo "http://www.strikersoft.in/ion/".$result;
		}
	}
?></a> <button class="copy_url" id="copyButton">Copy</button>
  <div>
<span id="msg"></span>
</div>
</div>
</div>
</div>
</body>
</html>
