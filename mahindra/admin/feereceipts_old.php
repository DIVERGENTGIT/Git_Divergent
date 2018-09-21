<?php
require_once("../db/config.php");
 $qry1="select * from fee_receipt where id='".$_REQUEST['vid']."'";

$res=mysql_query($qry1);
$row=mysql_fetch_array($res);
?>

<?php
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' rupees ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MAHINDRA ECOLE CENTRALE</title>

    <!-- Bootstrap -->
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]><![endif]-->
    
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-2.min.js"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    
    <style type="text/css">
	.img-responsive{ margin:0px auto !important;}
	h4{  font-size:18px; margin:0px 0px 0px 0px; text-align:center; font-family:; font-weight:600;}
	h5{ margin:0px 0px 0px 0px;  text-align:center; font-family:calibri; font-size:16px;  font-weight:600; }
.well{ background-color:transparent !important; border-color:transparent; top:10px !important; border:0px !important; border-radius:0px !important; padding:0px 0px !important; margin: 10px 0px !important; border-color:#fff !important; -webkit-box-shadow:none;
   box-shadow:none;
}}

.my-Bot{ border:1px solid #666 !important; text-align:left; color:#ccc !important; margin-left:20px !important; font-size:15px;}
span{ font-family:calibri; font-size:12px; font-weight:500; }	
  p{ font-family:calibri; font-size:12px; font-weight:500;}  
 .font-we{ font-weight:bold; }   
   
   
   p.groove {border-bottom-style: groove; width:200px;} 
    </style>
 
  </head>
  <body >
   <div class="container" style="background-color:#f0f1f8; max-width:900px; padding-top:150px ; margin:0px auto;" >
   <div class="row" style="margin-left:10px; ">
    
   <div class="container col-md-12 col-xs-12 col-sm-12">
   <div class="row col-md-12 col-xs-12 col-sm-12"  >
   <!--top logo-->
  <div class="col-md-12 col-xs-12 col-sm-12  ">
       <div class="col-md-12 col-xs-12 col-sm-12  ">
      
         <span> <h5>Receipt of Fee</h5></span>
    
       </div>
       </div>
   <!--top logo-->
  
  
  <!--1 start-->
  
  <div class="col-md-12 col-xs-12 col-sm-12 well" style="float:right;">
            <div class="col-md-5 col-xs-5 col-sm-5 ">
             <input type="button" value="Print" onClick="window.print()"  class="btn-info">
             </div>
             <div class="col-md-2 col-xs-2 col-sm-2 ">
             
              </div>   
              <div class="col-md-2 col-xs-2 col-sm-2 "style="text-align:right !important;">
             <td class=""><span class="font-we"  >Date :</span></td>

              </div>
               <div class="col-md-3 col-xs-3 col-sm-3 "  >
             <td class="my-Bot"><span style="border-bottom:1px solid #666;"><?php echo $row['create_date'];?></span></td>
              </div>
                
  </div>
  
  
 
       <div class="col-md-12 col-xs-12 col-sm-12 well">
        <td class=""><span class="font-we">Receipt SNo: </span></td>
       <td  style="border-bottom:1px solid #036;">
       <span class="my-Bot" style=" border-bottom:1px solid #333; "><?php echo $row['roll_no'];?></span>
       </td>   <span><br/> </span>
  
             <td class=""><span class="font-we">Application No :</span></td>
             <td >
             <span class="groove" class="my-bot" style="border-bottom:1px solid #666;"><?php echo $row['app_no'];?>
            </span></td> <span><br/> </span>
            <td class=""><span class="font-we">Name of Student :</span></td>
             <td >
             <span class="groove" class="my-bot" style="border-bottom:1px solid #666;"><?php echo $row['from_name'];?>
            </span></td> <span><br/> </span>
            <td class=""><span class="font-we">Branch :</span></td>   &nbsp;&nbsp;&nbsp;
     <td ><span style="border-bottom:1px solid #666;" class="my-bot"><?php echo $row['branch'];?></span></td> <span><br/> </span>
              
     </div>
     
     
  
  
  
  
 <div class="container">
 <div class="row" style="margin-top:20px;"></div>
 </div>
  
  
  

   
   
   
   
   
 <div class="col-md-12 col-xs-12 col-sm-12 well ">
      <div  class="col-md-12 col-xs-12 col-sm-12  " style="margin:0px !important; padding:0px 0px !important;">
        <td class=""><span class="font-we">Fee  Paid Rs :</span></td> 
          <tr style="border-bottom:1px solid #666;"><td ><span class="my-bot" style="border-bottom:1px solid #666;"><?php echo $row['received_amount'];?> </span></td></tr>
          <td ><span class="my-bot" style="border-bottom:1px solid #666; ">(<?php echo ucwords(convert_number_to_words(number_format($row['received_amount'],2,'.',''))); ?> Paisa.)</span></td><span> &nbsp;&nbsp;</span>
       <td><span class="font-we" >Nature of Fee :</span></td> 
        <td ><span style="border-bottom:1px solid #666; "class="my-bot"><?php echo $row['towards'];?></span></td><span> &nbsp;&nbsp;</span>
      <td><span class="font-we">Mode of Payment:</span></td>  <td ><span style="border-bottom:1px solid #666;" class="my-bot"><?php echo $row['for_name'];?> </span></td><span> &nbsp;&nbsp;</span>
       <td><span class="font-we" >Name of Bank and Branch:</span></td> 
       <td ><span  style="border-bottom:1px solid #666;" class="my-bot"><?php echo $row['from_bank'].",".$row['branch_name'];?></span></td><span> &nbsp;&nbsp;</span>
        <!-- <td class=""><span class="font-we" > Bank Branch  :</span> </td>  
         <td ><span style="border-bottom:1px solid #666;"  class="my-bot"><?php echo $row['branch_name'];?></span></td><span> &nbsp;&nbsp;</span>-->
           <td class=""><span class="font-we" >DD No/Transacxtion No:</span></td>   
          
          <td>         <span style="border-bottom:1px solid #666;"  class="my-bot"><?php echo $row['dd-utrno'];?></span></td><span> &nbsp;&nbsp;</span>
         <td class=""><span class="font-we"  > DD/UTR Date :</span></td>   
          
          <td>        <span style="border-bottom:1px solid #666;"  class="my-bot"><?php echo $row['ddutrdate'];?></span></td>

        
     </div>
    
  </div>
 <!--  <div class="col-md-12 col-xs-12 col-sm-12 well ">
      <div  class="col-md-12 col-xs-12 col-sm-12  " style="margin:0px !important; padding:0px 0px !important;">
        <td class=""><span class="font-we" >DD No/Transacxtion No:
. :</span></td>   
          
          <td>         <div   style="border-bottom:1px solid #666; display:inline-table;"   class="my-bot"><?php echo $row['dd-utrno'];?></div></td>
         <td class=""><span class="font-we"  > DD/UTR Date :</span></td>   
          
          <td>         <div   style="border-bottom:1px solid #666; display:inline-table;"   class="my-bot"><?php echo $row['create_date'];?></div></td>
     </div>
    
  </div>-->

   
   
   <div class="col-md-12 col-xs-12 col-sm-12 well ">
      <div  class="col-md-6 col-xs-6 col-sm-6  " style="margin:0px !important; padding:0px 0px !important;">
         <p class="font-we"> for the academic year 2014-15.</p> 
       </div>
       
      <div  class="col-md-6 col-xs-6 col-sm-6  " style="margin:0px !important;">
         
      </div>
    
  </div>
   
   
   
    <div class="col-md-12 col-xs-12 col-sm-12 well " style="margin-top:30px !important;">
      <div  class="col-md-4 col-xs-4 col-sm-4  " style="margin:0px !important;">
        
       </div>
       
      <div  class="col-md-8 col-xs-8 col-sm-8 " style="margin:0px !important;">
          <p style="text-align:right; margin-right:70px; " class="font-we"> For Mahindra Ecole Centrale</p> 
      </div>
    
  </div>
   
   
   <div class="col-md-12 col-xs-12 col-sm-12 well " style="margin-top:50px !important;  margin-bottom:20px;">
      
          <p style="text-align:center; font-size:12px; " class="font-we"> Survey No. 62/1A, Bahadurpally, Jeedimetla, Hyderabad - 500043</p> 
      
    
  </div>
   
   
   
   </div>
   </div>
   
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     </div>
   </div>
  </body>
</html>