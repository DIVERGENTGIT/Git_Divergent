
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
<html>
<head>
    <title>Fee Receipt</title>
    <style type="text/css">
        body {
            font-family: calibri;
            font-size: 11px;
        }

        table#particulars {
            border-right: 1px solid #999999;
            border-top: 1px solid #999999;
        }

        table#particulars th {
            background-color: #EFEFEF;
            border-left: 1px solid #999999;
            border-bottom: 1px solid #999999;
        }

        table#particulars td {
            border-left: 1px solid #999999;
            border-bottom: 1px solid #999999;
            text-align: center;
        }
    </style>
</head>
<style type="text/css" media="print">
.dontprint
{ display: none; }
</style>
<body>
    <div style="height: 100px;" align="right">
        &nbsp;	  <input type="button" value="Print" onClick="window.print();"   class="btn btn-primary dontprint"/>
    </div>
    <table align="center" width="90%" cellpadding="0" cellspacing="0">
	<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
		<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
		<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
		<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
		<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
		<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
		<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
		<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
		<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
		<tr>
            <td align="center">
<h3>Receipt of Fee  </h3>
            </td>
        </tr>
        <tr>
            <td align="right" height="80">
                <strong>Date</strong>: <?php echo $row['create_date'];?>
				<br/>
				Hyderabad.
            </td>
        </tr>
        <tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
		<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
        <tr>
  <td><strong>Receipt No</strong> : <?php echo $row['roll_no'];?></td><td height="30">&nbsp;</td>
        </tr>
        
        <tr>
<td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="100%" cellpadding="5" cellspacing="0" id="particulars">
                    <tr>
                        
                        <th>Application No</th>
                        <th>Name of Student</th>
                        <th>Branch</th>
                        <th>Fee Paid INR </th>
                        <th>Towrds</th>
                        <th>Mode of Payment</th>
                        <th>Name of Bank</th>
                        <th>Bank of Branch</th>
                        <th>DD No/Transaction No</th>
                       <th>DD/UTR Date</th>
                    </tr>
                   
                        <tr>
                          
                            <td><?php echo $row['app_no'];?></td>
                            <td><?php echo $row['from_name'];?></td>
                            <td><?php echo $row['branch'];?></td>
                             <td><?php echo number_format($row['received_amount'], 2); ?></td>
                            <td><?php echo $row['towards'];?></td>
                            <td><?php echo $row['for_name'];?></td>
                            <td><?php echo $row['from_bank'];?></td>
                            <td><?php echo $row['branch_name'];?></td>
                             <td><?php echo $row['ddutrno'];?></td>
                             <td><?php echo $row['ddutrdate'];?></td>

                            
                        </tr>
                   
                </table>
            </td>
        </tr>
		<tr>
            <td>&nbsp;
			
               
            </td>
        </tr>
        <tr>
            <td>
                <b>Amount In Words:</b> <?php echo ucwords(convert_number_to_words(number_format($row['received_amount'],2,'.','')));  ?> Only
            </td>
        </tr>
        <tr>
            <td height="30">&nbsp;</td>
        </tr>
		 <tr>
            <td height="30">&nbsp;</td>
        </tr>
		 <tr>
            <td height="30">&nbsp;</td>
        </tr>
		 <tr>
            <td height="30">&nbsp;</td>
        </tr>
       <tr>
            <td align="right">
			<strong>Authorized Signatory</strong>
               
            </td>
			  <td>
		               
            </td>

        </tr>
    </table>
</body>
</html>
