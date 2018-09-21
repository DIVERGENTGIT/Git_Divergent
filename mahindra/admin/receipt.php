
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
  <link href='http://fonts.googleapis.com/css?family=Signika:600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<!--<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>-->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery-2.min.js"  type="text/javascript"></script>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    
    <style type="text/css">
.well{ margin:0px 0px 0px 0px; border:0px; border-radius:0px; padding:12px 9px; background-color:#fff; box-shadow:none;}	
.first-colom{  /*font-family:font-family: 'Droid Serif', serif !important;*/ 
font-size:14px; font-weight:bold; font-family: 'Monda', sans-serif; color:#5c5c5c;}
.2nd-colom{ font-size:12px; font-family: 'Signika', sans-serif; color:#5c5c5c;}
  
    </style>
 
  </head>
  <body>
  
  
  <div class="container" style="max-width:900px ; margin-top:140px; padding-left:20px; ">
  <div class="row" >
  <div class="col-md-12 col-sm-12 col-xs-12 ">
      <div class="col-md-5 col-sm-5 col-xs-5 well"><span></span></div>
      <div class="col-md-3 col-sm-3 col-xs-3 well"><span class="first-colom">FEE RECEIPT</span></div>
      <div class="col-md-4 col-sm-4 col-xs-4 well"><span>
	  <!--<button type="button" class="btn btn-primary" >Print</button>-->
	  <input type="button" value="Print" onClick="window.print();hideprint();" id="printid"  class="btn btn-primary"/></span></div>

 </div>
  
 <div class="col-md-12 col-sm-12 col-xs-12 ">
  <div class="col-md-1 col-sm-1 col-xs-1 well"><span class="first-colom"></span></div>
      <div class="col-md-2 col-sm-2 col-xs-2 	 well"><span class="first-colom">Receipt SNo:</span></div>
      <div class="col-md-4 col-sm-4 col-xs-4 well"><span <span class="2nd-colom"><?php echo $row['roll_no'];?></span></div>
      <div class="col-md-3 col-sm-3 col-xs-3 well"><span class="first-colom">Date &nbsp;&nbsp;:</span> &nbsp;&nbsp;<span >
      <?php echo $row['create_date'];?></span></div>
      

 </div>
   <div class="col-md-12 col-sm-12 col-xs-12 " >
    <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-3 col-sm-3 col-xs-3 well" ><span class="first-colom">Application No:</span></div>
      <div class="col-md-7 col-sm-7 col-xs-7 well"><span  class="2nd-colom"><?php echo $row['app_no'];?></span></div>
      </div>
  
      <div class="col-md-12 col-sm-12 col-xs-12 " 
      style=" ">
       <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-6 col-sm-6 col-xs-6 well" style="border-right:1px solid #d3d8f0; background-color:#edf0ff;"><span class="first-colom">Name of Student </span></div>
      <div class="col-md-5 col-sm-5 col-xs-5 well" style="background-color:#edf0ff; "><span class="first-colom">Branch Name</span></div>
      
      
      </div>
      
       <div class="col-md-12 col-sm-12 col-xs-12" style=" 
        ">
         <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-6 col-sm-6 col-xs-6 well" style="border-right:1px solid #d3d8f0;"><span  class="2nd-colom"><?php echo $row['from_name'];?></span></div>
      <div class="col-md-5 col-sm-5 col-xs-5 well" ><span class="2nd-colom"><?php echo $row['branch'];?></span></div>
      </div>
      
      
       <div class="col-md-12 col-sm-12 col-xs-12 " >
        <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-3 col-sm-3 col-xs-3 well" ><span class="first-colom">Fee  Paid Rs :</span></div>
      <div class="col-md-8 col-sm-8 col-xs-8 well"><span  class="2nd-colom"><?php echo number_format($row['received_amount'], 2); ?></span></div>
      
      </div>
      
      
    <!--   <div class="col-md-12 col-sm-12 col-xs-12 " >
        <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-3 col-sm-3 col-xs-3 well" style="background-color:#edf0ff; "><span class="first-colom">Amount in Rs.&nbsp;:</span></div>
      <div class="col-md-8 col-sm-8 col-xs-8 well" style="background-color:#edf0ff; "><span  class="2nd-colom">dfhdfghdgh</span></div>
      </div>-->
      
      
        <div class="col-md-12 col-sm-12 col-xs-12 " >
         <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-3 col-sm-3 col-xs-3 well" ><span class="first-colom">(words)&nbsp;:</span></div>
      <div class="col-md-8 col-sm-8 col-xs-8 well"><span  class="2nd-colom"><?php echo ucwords(convert_number_to_words(number_format($row['received_amount'],2,'.',''))); ?> Paisa.</span></div>
      </div>
      
      
       <div class="col-md-12 col-sm-12 col-xs-12 " >
        <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-3 col-sm-3 col-xs-3 well" style="background-color:#edf0ff; "><span class="first-colom	">Nature of Fee &nbsp;:</span></div>
      <div class="col-md-8 col-sm-8 col-xs-8 well" style="background-color:#edf0ff; "><span  class="2nd-colom"><?php echo $row['towards'];?></span></div>
      </div>
      
       
       <div class="col-md-12 col-sm-12 col-xs-12 " >
        <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-3 col-sm-3 col-xs-3 well"><span class="first-colom">Mode of Payment:</span></div>
      <div class="col-md-8 col-sm-8 col-xs-8 well"><span  class="2nd-colom"><?php echo $row['for_name'];?></span></div>
      </div>
      
       
       <div class="col-md-12 col-sm-12 col-xs-12 " >
        <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-3 col-sm-3 col-xs-3 well" style="background-color:#edf0ff; "><span class="first-colom">Details of Payment &nbsp;:</span></div>
      <div class="col-md-8 col-sm-8 col-xs-8 well" style="background-color:#edf0ff; "><span  class="2nd-colom">                          <?php echo $row['dd-utrno'];?>
</span></div>
      </div>
      
      
      <div class="col-md-12 col-sm-12 col-xs-12 " >
       <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-3 col-sm-3 col-xs-3 well"><span class="first-colom">DD/UTR Date  &nbsp;:</span></div>
      <div class="col-md-8 col-sm-8 col-xs-8 well" ><span  class="2nd-colom"><?php echo $row['ddutrdate'];?></span></div>
      </div>
      
      
      <div class="col-md-12 col-sm-12 col-xs-12 "  >
       <div class="col-md-1 col-sm-1 col-xs-1 	 well"><span class="first-colom"></span></div>
      <div class="col-md-4 col-sm-4 col-xs-4 well" style="background-color:#edf0ff; "><span class="first-colom">Name of Bank and Branch:</span></div>
      <div class="col-md-7 col-sm-7 col-xs-7 well" style="background-color:#edf0ff; "><span  class="2nd-colom"><?php echo $row['from_bank']." ".$row['branch_name'];?></span></div>
      </div>
      
      
      
    
      
      
      
 </div>
 </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>function hideprint(){
	alert("Hello");
	document.getElementById("printid").style.display='none';
		document.getElementById("printid").style.visibility='visible';
	
	} </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     </div>
   </div>
  </body>
</html>