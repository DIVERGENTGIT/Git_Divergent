<html>
<script language="javascript">
function check()
{
	if(document.frmlogin.txtusername.value=="")
	{
		alert("Please enter username.");
		document.frmlogin.txtusername.focus();
		return false;
	}
	else if(document.frmlogin.txtpass.value=="")
	{
		alert("Please enter password.");
		document.frmlogin.txtpass.focus();
		return false;
	}
}

</script>
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
        <td colspan="3" style="background:url(images/mainboxbg.gif) repeat-x; height:531px; border-left:#942e2a 2px solid; border-right:#942e2a 2px solid;"><table width="921" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="139" colspan="2"></td>
          </tr>
          <tr>
            <td width="389" align="center" valign="middle">&nbsp;</td>
            <td width="532" align="right" valign="top"><table width="532" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td align="right" valign="top"><img src="images/top1.gif" width="532" height="37" alt=""></td>
              </tr>
              <tr>
                <td align="right" valign="top" style="background:url(images/middlebg.gif) repeat-x; height:187px;border-left:#942e2a 2px solid;"><form name="frmlogin" id="frmlogin" method="post" action="admin_auth.php" onSubmit="return check();">
                  <table width="466" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="271" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td colspan="3" style="height:10px;"></td>
                          </tr>
						  <tr>
                            <td colspan="3" valign="top"  ><?php
		if(@$_GET['msg']=='n'){
			print "<font color='black'><center>Invalid Username/Password</center></font>";
		}
		 
		
	?></td>
                          </tr>
						   <tr>
                            <td colspan="3" style="height:10px;"></td>
                          </tr>
                          <tr>
                            <td width="29%" class="textblackblod">User Name </td>
                            <td width="3%" class="textblackblod">:</td>
                            <td width="68%"><input name="txtusername" type="text" class="manditoryfield" style="width:168px; height:19px;" id="txtusername"></td>
                          </tr>
                          <tr>
                            <td class="textblackblod" style="height:10px;"></td>
                            <td class="textblackblod"></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td class="textblackblod">Password</td>
                            <td class="textblackblod">:</td>
                            <td><input name="txtpass" type="password" class="manditoryfield" style="width:168px; height:19px;" id="txtpass"></td>
                          </tr>
                          <tr>
                            <td class="textblackblod" style="height:10px;"></td>
                            <td class="textblackblod"></td>
                            <td></td>
                          </tr>
                           
                          <tr>
                            <td class="textblackblod"></td>
                            <td class="textblackblod"></td>
                            <td><table width="185" border="0" cellspacing="0" cellpadding="0">
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
                                        <td width="59" align="center" valign="middle"><input name="Submit2" type="reset" class="black" value="Reset" /></td>
                                        <td width="9" align="left" valign="top"><img src="images/blackrt.jpg" width="9" alt=""></td>
                                      </tr>
                                  </table></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan="3" style="height:15px;"></td>
                          </tr>
                      </table></td>
                      <td width="195" align="center" valign="top"></td>
                    </tr>
                  </table>
                                </form>
                </td>
              </tr>
              <tr>
                <td align="right" valign="top" style="background:url(images/bottom2.gif) no-repeat; height:21px;"></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="145" colspan="2"></td>
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