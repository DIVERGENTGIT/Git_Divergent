<?php
require_once("../db/config.php");
session_start();
if (!isset($_SESSION['ausername'])) {
header("location:index.php");
exit;
}

 ?>	 
<html>
<head>
<title>MAHINDRA ECOLE CENTRALE</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css">
<link rel="shortcut icon" href="http://m.bestofmedia.com/i/tomshardware/favicon.png">
<script src="scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>

<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dof",
			isStripped:true,
			dateFormat:"%d-%m-%Y"
			
		});
		new JsDatePick({
			useMode:2,
			target:"ddutrdate",
			isStripped:true,
			dateFormat:"%d-%m-%Y"
			
		});
	};
	

		

</script>
</head>
<body>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td style="height:25px;"></td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="925" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="6" align="left" valign="top"><img src="images/mainboxtoplt.gif" width="6" height="7" alt=""></td>
        <td width="913" style=" background:url(images/mainboxtopbg.gif) repeat-x; height:7px;"></td>
        <td width="6" align="right" valign="top"><img src="images/mainboxtoprt.gif" width="6" height="7" alt=""></td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="top" style="height:531px; border-left:#942e2a 2px solid; border-right:#942e2a 2px solid;"><table width="921" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td width="460" height="139" style=" padding:12px;"><img src="images/admin1.jpg" width="281" height="97">&nbsp;</td>
            <td width="461" align="right" style=" padding:15px;"><img src="images/welcome.gif" width="281" height="97"></td>
          </tr>
          <tr>
            <td height="14" colspan="2"></td>
          </tr>
          <tr>
            <td height="145" colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="250" align="left" valign="top"><table width="245" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="237" align="left" valign="top" style="background:url(images/5bg.jpg) repeat-x;"><img src="images/5bg.jpg" width="14" height="10"></td>
                    <td width="8" align="right" valign="top"><img src="images/1.jpg" width="8" height="10"></td>
                  </tr>
                  <tr>
                    <td height="315" colspan="2" align="center" valign="top" style="background:url(images/middlebg3.jpg) repeat-x;border-right:#942e2a 2px solid;"> 
					<?php include("leftmenu.php"); ?></td>
                  </tr>
                  <tr>
                    <td style="border-bottom:#942e2a 2px solid;"><img src="images/spacer.gif" width="1" height="1"></td>
                    <td align="right" valign="top"><img src="images/3.jpg" width="8" height="10"></td>
                  </tr>
                </table></td>
                <td align="right" valign="top"><table width="665" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="8" align="left" valign="top"><img src="images/2.jpg" width="8" height="10"></td>
                    <td width="657" style="background:url(images/5bg.jpg) repeat-x;"><img src="images/5bg.jpg" width="14" height="10"></td>
                  </tr>
                  <tr>
                    <td height="408" colspan="2" valign="top" style="background:url(images/middlebg3.jpg) repeat-x;border-left:#942e2a 2px solid; padding:10px;">
                    <form name="frmcat" id="frmcat" method="post"  enctype="multipart/form-data"  action="fee_process.php">
                      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="390" class="textredblod" style="padding-bottom:15px;">Add Fee <span class="textblackblod" style="padding-bottom:15px;"><img src="images/arrow1..jpg" width="7" height="6"></span></td>
                          <td width="220" align="left" valign="top" class="textblackblod" style="padding-bottom:15px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" bgcolor="#999999" height="1"></td>
                        </tr>
                        <tr>
                          <td colspan="2" style="height:15px;"></td>
                        </tr>
                        <tr>
                          <td colspan="2" valign="top" style="height:15px;"><table width="575" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="21"><img src="images/innerboxtoplt.gif" width="21" height="18"></td>
                                <td width="532" style="background:url(images/innerboxtop.gif) repeat-x;"></td>
                                <td width="22"><img src="images/innerboxtoprt.gif" width="21" height="18"></td>
                              </tr>
                              <tr>
                                <td colspan="3" bgcolor="#F6ECEC" style=" border-left:#8f8f8f 1px solid;border-right:#8f8f8f 1px solid;"><table width="532" border="0" align="center" cellpadding="4" cellspacing="4" class="normltext">
                                 <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Date</td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;"><input name="paiddate" id="dof" type="text" class="manditoryfield" style="width:100px; height:29px;" size="30"   /></td>
                                  </tr>
                                  <!-- <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Roll No</td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;">
                                    <input name="roll_no" id="roll_no" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
                                  </tr>-->
                                  <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Application No</td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;">
                                    <input name="app_no" id="app_no" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
                                  </tr>
								  
								   <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Branch</td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;"><input name="branch" id="branch" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
                                  </tr>
                                <!--  <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Installment</td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;"><input name="installment" id="installment" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
                                  </tr>-->
                                     <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Received an amount</td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;"><input name="receivedamount" id="receivedamount" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
                                  </tr>
                                     <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Name of Student</td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;"><input name="from_name" id="from_name" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
                                  </tr>
                                     <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Towards </td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;">
                                    <select name="towards" style="width:320px; height:29px;" >
									<option value="Admission Fee">Admission Fee </option>  
									<option value="Hostel and Gymkhana Fee">Hostel and Gymkhana Fee </option> 
									<option value="Instalment">Instalment </option>  


									</select>
                                  <!--  <input name="towards" id="towards" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   />--></td>
                                  </tr>
                                   <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Mode of Payment  </td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;"><input name="For_Name" id="For_Name" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
                                  </tr>
                                     <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Name of the Bank  </td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;"><input name="from_bank" id="from_bank" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
                                  </tr>
                                     <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Bank Branch </td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;"><input name="branch_name" id="branch_name" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
                                  </tr>
                                     <tr>
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">DD/UTR NO</td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;"><input name="ddutrno" id="dd-utrno" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
                                  </tr>
                                  
    <tr>
    <td width="155" align="right" class="textblack" style="font-weight: bold">DD/UTR Date</td>
    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
    <td width="331" align="left" style="padding-left:5px;"><input name="ddutrdate" id="ddutrdate" type="text" class="manditoryfield" style="width:320px; height:29px;" size="30"   /></td>
    </tr>
                                   								  
								 
                                  <tr>
                                    <td align="right" style=""></td>
                                    <td height="22" align="center" valign="middle" style="padding-left:5px;"></td>
                                    <td align="left" style="padding-left:5px;"><table width="185" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="92" align="left" valign="top"><table width="64" border="0" align="left" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td width="6"><img src="images/redlt.gif" width="9" height="33" alt=""></td>
                                              <td width="52" align="center" valign="middle"><input name="Submit" type="submit" class="yellow" value="Submit" /></td>
                                              <td width="6" align="left"><img src="images/redrt.jpg" width="9" height="33" alt=""></td>
                                            </tr>
                                        </table></td>
                                        <td width="93"><table width="77" border="0" align="left" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td width="9"><img src="images/blacklt.gif" width="9" height="33" alt=""></td>
                                              <td width="59" align="center" valign="middle"><input name="Submit2" type="button" class="black" value="Cancel"  onclick="window.location='dispfee.php'" /></td>
                                              <td width="9" align="left" valign="top"><img src="images/blackrt.jpg" width="9" alt=""></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td><img src="images/innerboxdownlt.gif" width="21" height="18"></td>
                                <td width="532" style="background:url(images/innerboxdown.gif) repeat-x;"></td>
                                <td><img src="images/innerboxdownrt.gif" width="21" height="18"></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="left" valign="top" style="height:15px;"></td>
                        </tr>
                      </table>
                                        </form>
                    </td>
                  </tr>
                  <tr>
                    <td><img src="images/4.jpg" width="8" height="10"></td>
                     <td style="border-bottom:#942e2a 2px solid;"><img src="images/spacer.gif" width="1" height="1"></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
           <tr>
            <td colspan="2" style="background:url(images/bg3.gif) repeat-x bottom; height:35px;"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="images/mainboxdownlt.gif" width="6" height="7" alt=""></td>
        <td style=" background:url(images/mainboxdownbg.gif) repeat-x; height:7px;"></td>
        <td align="right" valign="top"><img src="images/mainboxdownrt.gif" width="6" height="7" alt=""></td>
      </tr>
    </table></td>
  </tr>
  <tr>
   <?php include("footer.php"); ?>
  </tr>
</table>
</body>
</html>