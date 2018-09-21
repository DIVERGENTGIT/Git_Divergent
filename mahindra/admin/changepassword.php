<?php
 
session_start();
if (!isset($_SESSION['ausername'])) {
header("location:index.php");
exit;
}
 

require_once("../db/config.php");
	 $qry1="select * from tbl_adminlogin where username='".$_SESSION['ausername']."'";
		$res=mysql_query($qry1);
		$row=mysql_fetch_array($res);		 
		 
	
	if(isset($_POST['Submit']))
	{
	$currentdate=date("Y/m/d"); 
	/*update the modified record*/ 
	 
    $a=  $_POST['pass']; 
	$qry2="update tbl_adminlogin set password='$a'  where username='".$_SESSION['ausername']."'";
	$res2=mysql_query($qry2);
	 
  	 echo "<script>alert('Password changed successfully.');";	 
	 echo "self.location='dispfee.php'"; 
	 echo "</script>";
	 exit();  
	}

 ?>	 
<html>
<head>
<title>MAHINDRA ECOLE CENTRALE</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css" />
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
            <td width="460" height="139" style=" padding:12px;"></td>
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
                    <td height="408" colspan="2" valign="top" style="background:url(images/middlebg3.jpg) repeat-x;border-left:#942e2a 2px solid; padding:10px;"><form name="form1" method="post" action="">
                      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="390" class="textredblod" style="padding-bottom:15px;">Change Password  <span class="textblackblod" style="padding-bottom:15px;"><img src="images/arrow1..jpg" width="7" height="6"></span></td>
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
                                    <td width="155" align="right" class="textblack" style="font-weight: bold">Username </td>
                                    <td width="6" height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td width="331" align="left" style="padding-left:5px;"><input name="username" id="username" type="text" class="manditoryfield" style="width:220px; height:19px;" size="30" value="<?php echo $row['username']; ?>" readonly /></td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="textblack" style="font-weight: bold"> Password </td>
                                    <td height="22" align="center" valign="middle" style="padding-left:5px;"><strong class="textblack">:</strong></td>
                                    <td align="left" style="padding-left:5px;"><input name="pass" id="pass" type="password" class="manditoryfield" style="width:220px; height:19px;" size="30" value="<?php echo $row['password']; ?>" /></td>
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
                                              <td width="59" align="center" valign="middle"><input name="Submit2" type="button" class="black" value="Cancel"  onclick="window.location='homepage.php'"/></td>
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