<?php
session_start();
require_once("../db/config.php"); 
if (!isset($_SESSION['ausername'])) 
{
header("location:index.php");
exit;
}
$sql="SELECT roll_no as Receipt_No,app_no as Application_No,branch as Branch, received_amount AS Received_an_amount,currency_type as Currency, from_name as Name_of_Student,towards as Towards,for_name as Mode_of_Payment ,from_bank as Name_of_the_Bank,branch_name as Bank_Branch,ddutrno as DD_UTR_NO ,ddutrdate as DD_UTR_DATE   FROM `fee_receipt`  order by id desc";
if(!empty($_GET['d'])){
$datesearch=$_GET['d'];
 $sql.=" where create_date='$datesearch'";
}



$results = mysql_query($sql);
 
$headerDisplayed = false;
 $fileName = 'student_data.csv';

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: private");
$fh = @fopen( 'php://output', 'w' );

while ($data = mysql_fetch_array($results, MYSQL_ASSOC)) { 
    // Add a header row if it hasn't been added yet
    if ( !$headerDisplayed ) {
        // Use the keys from $data as the titles
        fputcsv($fh, array_keys($data));
        $headerDisplayed = true;
    }
 
    // Put the data into the stream
    fputcsv($fh, $data);
}
// Close the file
fclose($fh);
// Make sure nothing else is sent, our file is done
exit;
?>
