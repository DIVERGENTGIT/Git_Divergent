	<?php
	define('FPDF_FONTPATH','font/');
	require('js_form.php');
	$pdf=new JS_Form();
	$pdf->SetLineWidth(1);
	function convertnumber($number)
	{
		$no = round($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => '', '1' => 'one', '2' => 'two',
		'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
		'7' => 'seven', '8' => 'eight', '9' => 'nine',
		'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
		'13' => 'thirteen', '14' => 'fourteen',
		'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
		'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
		'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
		'60' => 'sixty', '70' => 'seventy',
		'80' => 'eighty', '90' => 'ninety');
		$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_1) {
		$divider = ($i == 2) ? 10 : 100;
		$number = floor($no % $divider);
		$no = floor($no / $divider);
		$i += ($divider == 10) ? 1 : 2;
		if ($number) {
		$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
		$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
		$str [] = ($number < 21) ? $words[$number] .
		" " . $digits[$counter] . $plural . " " . $hundred
		:
		$words[floor($number / 10) * 10]
		. " " . $words[$number % 10] . " "
		. $digits[$counter] . $plural . " " . $hundred;
		} else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$points = ($point) ?
		"." . $words[$point / 10] . " " . 
		$words[$point = $point % 10] : '';
		$value = $result."Rupees " . $points ."Only";
		return ucfirst($value);
	}
	//$number = 979456;
	//echo convertnumber($number);
	$name="Mr/Mrs.".ucfirst($_REQUEST['name']);// dynamic name from url
	$trans_id=@$_REQUEST['tn'];
	$invoice_id=@$_REQUEST['invoice_id'];
	$created_on=@$_REQUEST['cd'];
	$user_id=@$_REQUEST['rid'];
	$smstype=@$_REQUEST['smstype'];
	$payment_id=@$_REQUEST['payment_id'];
	$on_date=@$_REQUEST['od'];
	$org=@$_REQUEST['org'];
	$amt=@$_REQUEST['amt'];
	$noofsms=@$_REQUEST['noofsms'];
	$total_amt=@$_REQUEST['total_amount'];
	// number to words convertion 
	//$numbertowords=convertnumber($total_amt);
	$username=@$_REQUEST['username'];
	$price_per_sms=@$_REQUEST['prices'];
	$st=@$_REQUEST['st'];
	$tax_amt=@$_REQUEST['tax_amt'];
	$unaname= 'SMS Login Username: '.$username;
	$smsadded='SMS Added on : '.$on_date;
	$pricepersms='Price Per Sms @ '.$price_per_sms ." Paisa";
	$imgsrc=@$_REQUEST['img']; //dynamic image from url if need
	$rdate=date('d-M-Y',$_REQUEST['t']);//rdate  time from url with milliseconds format
	$pdf->Open();
	$pdf->AliasNbPages();
	$pdf->AddPage("P");
	//page2
	$pdf->SetTextColor(187, 187, 187); //header
	$pdf->SetFont('Arial','',14); 
	$pdf->text(10, 15,'');
	$pdf->SetTextColor(128,129,131); //black
	$pdf->SetFont('Arial','',11);					
	//$pdf->text(200, 35,'Certificate');				
	/*
	$pdf->Image('http://smsstriker.com/striker_invoice.jpg',0,0,210);	
	*/
	 $siteurl= $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER['HTTP_HOST'];
	$pdf->Image($siteurl.'/invoice_code/images/SMSstrikerInvoiceGST.jpg',0,0,210);					
	$xc=180;
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(107, 40,$invoice_id);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(157, 40,$created_on);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(107, 55,$user_id);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(157, 55,$smstype);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(107, 70,$payment_id);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(157, 70,$on_date);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(107, 90,$name);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(13, 90,$org);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(15, 112,1);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 112,$unaname);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 117,$smsadded);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 122,$pricepersms);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(110, 112,$noofsms);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(145, 112,$price_per_sms);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(170, 112,number_format($amt,2));
	/*****  service Tax Start *****/
	$finaltx=$st;
	$finaltxamt=($amt*$finaltx/100);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(145, 178,$finaltx);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(170, 178,number_format($finaltxamt,2));
	$pdf->SetFont('Helvetica','',12);
	/*****  service Tax End *****/
	$pdf->text(175, 194,number_format($total_amt,2));
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(20, 213,convertnumber($total_amt));
	//echo convert_number_to_words($total_amt);
	//$pdf->Image('',10,190,275);
	//Form validation functionsfooter.png
	$pdf->script.="
	function Print()
	{	print();
	}
	";
	//We include all the generated JavaScript code into the PDF
	$pdf->IncludeJS($pdf->script);
	//$pdffilename = $name."_".time();
	$pdffilename = "SMSStriker_invoice_".$trans_id;
	$filepath='reports/'.$pdffilename.'.pdf';
	chmod($filepath,0755);
	$pdf->Output('reports/'.$pdffilename.'.pdf', 'F');
	/*echo '<script>window.location="reports/'.$pdffilename.'.pdf";
	</script>';*/
	//$pdf->Output();
	//header("Location:reports/".$pdffilename.".pdf");
	//$pdf->Output();	
	//unlink($pdffilename.'.pdf');


	?>
