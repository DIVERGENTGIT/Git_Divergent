<?php
session_start();
	 date_default_timezone_set("Asia/Kolkata"); 

require_once("../db/config.php"); 
if (!isset($_SESSION['ausername'])) 
{
header("location:index.php");
exit;
}


 

 $rowsPerPage = 15; //how many rows to show per page
	$pageNum = 1; //By Default we show first page
	
	//if $_GET['page'] defined, use it as page number
	if(isset($_GET['page']))
	{
		$pageNum = $_GET['page'];
	}
	
	$offset = ($pageNum - 1) * $rowsPerPage; //Counting the offset
	
	//how many rows we have in dabase
	extract($_REQUEST);
	
if(isset($_GET['d'])){
$datesearch=$_GET['d'];
}
if(!empty($search) || !empty($datesearch)):

		$category="select Count(id) AS numrows from fee_receipt where roll_no='$search' or app_no='$search' or create_date='$datesearch' order by id desc";
	else:
		$category="select Count(id) AS numrows from fee_receipt order by id desc";

	endif;

	
	//Create a PS_Pagination object
$result = mysql_query($category) or die('Error, query Failed');
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$n_rows = $row['numrows'];	//The paginate() function returns a mysql result set 
	
	 
	
	$maxPage = ceil($n_rows/$rowsPerPage); //how many pages we have when paging?
	
	$self = $_SERVER['PHP_SELF']; // Print the link to access each page
	$nav = '';
	
	$startPage = $pageNum;
	$lastPage = $maxPage;

      if($startPage+15 < $maxPage)
      {
         $lastPage = $startPage+15;
      }

      
      for($page_ctr = $startPage; $page_ctr <= $lastPage; $page_ctr++)
      {
         if ($page_ctr == $pageNum)
         {
            $nav .= " $page_ctr "; // no need to create a link to current page
         }
         else
         {
            $nav .= " <a href=\"$self?page=$page_ctr&d=$datesearch\" style=' text-decoration:none;' >$page_ctr</a> ";
         } 
      }
// Creating Previous and next link and the link to go straight to the first and last page

	if($pageNum > 1)
	{
		$page = $pageNum - 1;
		$prev = "<a href=\"$self?page=$page&d=$datesearch\" style=' text-decoration:none;' >Prev</a>";
		$first = " <a href=\"$self?page=1&d=$datesearch\" style='text-decoration:none;'>First</a> ";
	}
	else
	{
		$prev = '&nbsp;'; //we are on page one, dont print previous link
		$first = '&nbsp;'; //nor the first page link
	}
    if ($pageNum < $maxPage)
    {
         $page = $pageNum + 1;
         $next = " <a href=\"$self?page=$page\" style=' text-decoration:none;'>Next</a> ";
         $last = " <a href=\"$self?page=$maxPage\" style=' text-decoration:none;'>Last</a> ";
    } 
    else
    {
 	      $next = '&nbsp;'; // we're on the last page, don't print next link
          $last = '&nbsp;'; // nor the last page link
    }
 
 
 
 
 
 
 if(@$_REQUEST['del']!="")
	  {
	  		 
	     
		$del_str="delete from fee_receipt where id=$_REQUEST[del]";
		$rs=mysql_query($del_str);
		
		echo "<script>alert('Fee Receipt deleted successfully.');";	 
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
<link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css">
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
    <td style="height:25px;"> </td>
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
            <td width="460" height="139" style=" padding:12px;">&nbsp;</td>
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
					<?php include("leftmenu.php"); ?>					</td>
                  </tr>
                  <tr>
                    <td style="border-bottom:#942e2a 2px solid;"><img src="images/spacer.gif" width="1" height="1"></td>
                    <td align="right" valign="top"><img src="images/3.jpg" width="8" height="10"></td>
                  </tr>
                </table></td>
                <td align="right" valign="top"><table width="665" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="8" align="left" style="background:url(images/5bg.jpg) repeat-x;" valign="top"><img src="images/2.jpg" width="8" height="10"></td>
                    <td width="657" style="background:url(images/5bg.jpg) repeat-x;"><img src="images/5bg.jpg" width="14" height="10"></td>
                  </tr>
                  <tr>
                    <td height="408" colspan="2" valign="top" style="background:url(images/middlebg3.jpg) repeat-x;border-left:#942e2a 2px solid; padding:10px;">
                      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="206" class="textredblod" style="padding-bottom:15px;">Fee Receipts <span class="textblackblod" style="padding-bottom:15px;"><img src="images/arrow1..jpg" width="7" height="6"></span></td>
                          <td width="217" align="center" class="textredblod" style="padding-bottom:15px;">&nbsp;</td>
                          <td width="220" align="left" valign="top" class="textblackblod" style="padding-bottom:15px;">
                          <table width="220" border="0" align="right" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="87" align="center" valign="middle" class="textblack">&nbsp;</td>
                                <td width="142" align="right" valign="middle"  ><span class="textblack"><a href="addfee.php" class="textblack"><img src="images/add.jpg" width="56" height="25" border="0" class="textblackblod"></a></span> </td>
                              </tr>
                             
                          </table></td>
                        </tr>
                         <tr> <td  colspan="5"   width="350"  ><span style="float:left;"><form method="post" name="searchform" action="<?php echo $_SERVER['PHP_SELF'];?>"><input type="text"   style=" width: 180px;padding: 10px;
  height: 30px; box-shadow:inset;" name="search" placeholder="Receipt no / application no" />
<input name="datesearch" id="dof" type="text" class="manditoryfield" style="width:100px; height:29px;" size="30"   />
    <input type="submit" value="Search" name="submit" class="black" /></form> </span> </td></tr>
                        <tr>

                          <td colspan="6"  height="1" align="right"><a href="download.php?d=<?php echo $datesearch; ?>" target="_self"><img src="images/excel.png"/></a></td>
                        </tr>
                        <tr>
                          <td colspan="3" style="height:15px;"></td>
                        </tr><form name="form1" method="post" action="" >
                        <tr>
                          <td colspan="3" style="height:15px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td style="border:#bc7c79 1px solid;"><table width="100%" border="0" align="left" cellpadding="2" cellspacing="2" class="normltext">
                                    <tr>
                                      <td width="75" height="35" align="center" valign="middle" bgcolor="#bc7c79" class="textwhiteblod">Sl No </td>
                                      <td width="330" align="center" valign="middle" bgcolor="#bc7c79" class="textwhiteblod" style="padding-left:15px;">Receipt No</td>
                                      <td width="300" height="35" align="center" valign="middle" bgcolor="#bc7c79" class="textwhiteblod">Application No</td>
                                      
                                                  <td width="300" height="35" align="center" valign="middle" bgcolor="#bc7c79" class="textwhiteblod">Fee Paid Date</td>
                                      
			
                                      <td width="300" colspan="3" align="center" valign="middle" bgcolor="#bc7c79" class="textwhiteblod">Action</td>
                        
                                    </tr>
 <?php
if(!empty($search) || !empty($datesearch)):
$query="select * from fee_receipt  where roll_no='$search' or app_no='$search' or create_date='$datesearch' order by id desc LIMIT ".$offset.", ".$rowsPerPage;
else:
$query="select * from fee_receipt order by id desc LIMIT ".$offset.", ".$rowsPerPage;
endif;					
									$res=mysql_query($query); 
									$fee_no=mysql_num_rows($res); 
					  				if($fee_no>0)
									{ 	$i = 0;
									 while($fee_row=mysql_fetch_array($res))
									 { $i++;
									 ?>
									 <tr>
                                      <td height="35" align="center" valign="middle" bgcolor="#f7f7f7"><?php echo $i; ?></td>
                                      
                                      <td align="left" valign="middle" bgcolor="#f7f7f7" class="textblack" style="padding-left:15px;"><?php echo $fee_row['roll_no']; ?> </td>
                                      <td align="left" valign="middle" bgcolor="#f7f7f7" class="textblack" style="padding-left:15px;"><?php echo $fee_row['app_no']; ?> </td>
                                              <td align="left" valign="middle" bgcolor="#f7f7f7" class="textblack" style="padding-left:15px;"><?php echo $fee_row['create_date']; ?> </td>
                                      
                                      
									  <td align="center" valign="middle" bgcolor="#f7f7f7">
                                      
                                   
									  <!--<a href="JavaScript:newPopup
                                      ('http://www.smsstriker.com/mahindra/admin/feereceipts_old.php?vid=<?php echo $fee_row['id']; ?>
                                     ');">
                                     Receipt1</a>|
                                       <a href="JavaScript:newPopup
                                      ('http://www.smsstriker.com/mahindra/admin/feereceipts.php?vid=<?php echo $fee_row['id']; ?>
                                     ');">
                                     Receipt2</a>|
-->
 <a href="JavaScript:newPopup
                                      ('https://www.smsstriker.com/mahindra/admin/feereceipts.php?vid=<?php echo $fee_row['id']; ?>
                                     ');">
									  
									  <img src="images/view.png" width="20" height="20" title="View"></a>


								</td>
                                      <td align="center" valign="middle" bgcolor="#f7f7f7"><a href="editfee.php?id=<?php echo $fee_row['id']; ?>"  ><img src="images/edit.png" width="20" height="20" title="Edit"></a></td>
                                      
                                      <td align="center" valign="middle" bgcolor="#f7f7f7"><a href="?del=<?php print $fee_row['id']; ?>"   onClick="return confirm('Are you sure you want to delete ..?')"><img src="images/del.png" width="20" height="20" title="Delete"></a></td>
                                    </tr>
									 <?php
									 }
									 }
									 else
									 {
									 
									 echo "<tr><td colspan='4'>No Records added.</td></tr>";
									 									 
									 }
			?>
									
									
									
									
									
                                </table></td>
                              </tr>
                               <td align="right" valign="middle" bgcolor="#bc7c79" class="textwhiteblod"  height="25"><?php
		         echo $first . $prev . $nav . $next . $last . " &nbsp;&nbsp;&nbsp;
           [ " . $n_rows . " Records in " . $maxPage . "  pages ]";
		    ?></td>
                          </table></td>
                        </tr>
                        <tr>
                          <td colspan="3" align="left" valign="top" style="height:15px;"></td>
                        </tr>
                      </table>
                                        </form>                    </td>
                  </tr>
                  <tr>
                    <td style="background:url(images/6bg.jpg) repeat-x;"><img src="images/4.jpg" width="8" height="10"></td>
                     <td style="background:url(images/6bg.jpg) repeat-x;"><img src="images/spacer.gif" width="1" height="1"></td>
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
<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}
</script>



			
</body>
</html>
