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
	$array = $_POST;
	$name="Mr/Mrs.".ucfirst($array[0]['name']);
	//$name="Mr/Mrs.".ucfirst($_REQUEST['name']);// dynamic name from url
	//$trans_id=@$_REQUEST['tn'];
	$trans_id= @$array[0]['tn'];
	//$invoice_id=@$_REQUEST['invoice_id'];
	$invoice_id=@$array[0]['invoice_id']; 
	$created_on=@$array[0]['cd'];
	$user_id=@$array[0]['rid'];  
	$smstype=@$array[0]['smstype'];
	$payment_id=@$array[0]['payment_id'];
	$on_date=@$array[0]['od'];
	$org=@$array[0]['org']; 
	$amt=@$array[0]['amt'];
	$noofsms= @$array[0]['noofsms'];
	$total_amt=@$array[0]['total_amount'];  
	// number to words convertion 
	//$numbertowords=convertnumber($total_amt);
	$username=@$array[0]['username'];
	$price_per_sms=@$array[0]['prices'];
	$st=@$array[0]['st'];
	$tax_amt=@$array[0]['tax_amt'];
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
	$count = count($array); 
	//$package = 'Package Cost ';
	$package = 'Package Cost ';   
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 112, $package);   
	$service = 'Long Code Dedicated Numbers :';  
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 118, $service); 
	//$keywords = 'Total number of keywords :';
	if($count == 1) { 
	$package_cost = $array[0]['package_cost'];  	
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(145, 112,$package_cost);  
	$pdf->SetFont('Helvetica','',12);
	$text1 = $array[0]['longcode_number'].' @ '.$array[0]['longcode_type'].' @ '.$array[0]['subscription_duration'];
	$pdf->text(25, 122, $text1);  
	$pdf->SetFont('Helvetica','',12);
	$service = 'Long Code Hits  - ';  
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 126, $service); 
	$pdf->text(60, 126, $array[0]['no_of_sms']);  
	$pdf->SetFont('Helvetica','',12);   
	$pdf->text(145, 142,$array[0]['number_cost']);
	$keyword_num = 0;
	}else if($count == 2) {   
	$package_cost = ($array[0]['package_cost'] + $array[1]['package_cost']);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(145, 112,$package_cost);
	$pdf->SetFont('Helvetica','',12);
	$text1 = $array[0]['longcode_number'].' @ '.$array[0]['longcode_type'].' @ '.$array[0]['subscription_duration'];
	$pdf->text(25, 122, $text1);  
	$service = 'Long Code Hits  - ';  
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 126, $service); 
	$pdf->text(60, 126, $array[0]['no_of_sms']);  
	$pdf->SetFont('Helvetica','',12);   
	$pdf->text(145, 126,$array[0]['number_cost']);
	$pdf->SetFont('Helvetica','',12);
	$text2 = $array[1]['longcode_number'].' @ '.$array[1]['longcode_type'].' @ '.$array[1]['subscription_duration'];
	$pdf->text(25, 134, $text2);  
	$service = 'Long Code Hits  - ';  
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 138, $service);     
	$pdf->text(60, 138, $array[1]['no_of_sms']);  
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(145, 138,$array[1]['number_cost']); 
	$keyword_num = 0; 
	}
	else if($count == 3) { 
	$package_cost = ($array[0]['package_cost'] + $array[1]['package_cost'] + $array[2]['package_cost']);
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(145, 112,$package_cost);
	$pdf->SetFont('Helvetica','',12);
	$text1 = $array[0]['longcode_number'].' @ '.$array[0]['longcode_type'].' @ '.$array[0]['subscription_duration'];
	$pdf->text(25, 122, $text1);  
	$service = 'Long Code Hits  - ';  
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 126, $service); 
	$pdf->text(60, 126, $array[0]['no_of_sms']);  
	$pdf->SetFont('Helvetica','',12);   
	$pdf->text(145, 126,$array[0]['number_cost']);
	$pdf->SetFont('Helvetica','',12);
	$text2 = $array[1]['longcode_number'].' @ '.$array[1]['longcode_type'].' @ '.$array[1]['subscription_duration'];
	$pdf->text(25, 134, $text2);  
	$service = 'Long Code Hits  - ';  
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 138, $service);     
	$pdf->text(60, 138, $array[1]['no_of_sms']);  
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(145, 138,$array[1]['number_cost']); 
	$pdf->SetFont('Helvetica','',12);
	$text3 = $array[2]['longcode_number'].' @ '.$array[2]['longcode_type'].' @ '.$array[2]['subscription_duration'];
	$pdf->text(25, 146, $text3); 
	$service = 'Long Code Hits  - ';  
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(25, 150, $service);     
	$pdf->text(60, 150, $array[2]['no_of_sms']);  
	$pdf->SetFont('Helvetica','',12);  
	$pdf->text(145, 150,$array[2]['number_cost']); 
	}
	$pdf->SetFont('Helvetica','',12);
	$pdf->text(110, 118,$count);
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
