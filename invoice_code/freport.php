<?php
define('FPDF_FONTPATH','font/');
require('js_form.php');
$pdf=new JS_Form();
$pdf->SetLineWidth(1);
$red_score=@$_REQUEST['red_score']; //red
$blue_score=@$_REQUEST['blue_score'];//blue
$green_score=@$_REQUEST['green_score'];//green
$yellow_score=@$_REQUEST['yellow_score'];//yellow
$name=@$_REQUEST['name'];//name
$rdate=date('d-M-Y');//rdate

$data[] = array('score' => $red_score, 'color' => 'red');
$data[] = array('score' => $blue_score, 'color' => 'blue');
$data[] = array('score' => $green_score, 'color' => 'green');
$data[] = array('score' => $yellow_score, 'color' => 'yellow');
//print_r($data);
// Obtain a list of columns
foreach ($data as $key => $row) {
$volume[$key]  = $row['score'];
$edition[$key] = $row['color'];
}
// Sort the data with volume descending, edition ascending
// Add $data as the last parameter, to sort by the common key
array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $data);

$finalSortArry= array($data[0]['color'],$data[1]['color'],$data[2]['color'],$data[3]['color']);
// print_r($finalSortArry);
//exit;
$pdf->Open();
$pdf->AliasNbPages();
$pdf->AddPage("L"); //page1

$pdf->SetTextColor(187, 187, 187); //header
$pdf->SetFont('Arial','',14);

$pdf->text(10, 15,iconv('UTF-8', 'windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));

$pdf->SetTextColor(0, 0, 0); //black
$pdf->SetFont('Arial','',14);




$pdf->text(10, 30, iconv('UTF-8', 'windows-1252','À propos du rapport de profil personnel et du plan d\'action'));

$pdf->SetFont('Arial','',10);
$pdf->text(10, 40,iconv('UTF-8', 'windows-1252','Merci d\'avoir complété la première partie du programme sur les styles de communication : « Styles de communication : Quel est le vôtre? » . La première partie du programme'));                    



$pdf->text(10, 45,iconv('UTF-8', 'windows-1252','vous a permis de découvrir votre profil unique de style de communication – votre rapport de profil se trouve à la page suivante à des  fins de référence. La deuxième partie'));

$pdf->text(10, 50,iconv('UTF-8', 'windows-1252','de ce programme est le cours en ligne « Styles de communication : Adapter le vôtre ». Celui-ci met l’accent sur la façon dont vous pouvez adapter votre style pour établir'));
/*$pdf->SetFont('Arial','I',10);
$pdf->text(59, 70,'flex');
$pdf->SetFont('Arial','',10);*/
$pdf->text(10, 55,iconv('UTF-8', 'windows-1252','de meilleures relations. Vous pouvez considérer ce « rapport personnel et plan d’action » comme la troisième partie du programme. Il est conçu pour vous aider à'));

$pdf->text(10, 60,iconv('UTF-8', 'windows-1252','passer au niveau supérieur – de la théorie à la pratique!'));

$pdf->SetFont('Arial','',14);
$pdf->text(10, 75,iconv('UTF-8', 'windows-1252','Avant de commencer le cours en ligne « Styles de communication : Adapter le vôtre »'));

$pdf->SetFont('Arial','',10);
$pdf->Rect(10, 83, 0.3, 0.3, '');//for bullet point
$pdf->text(15, 85,iconv('UTF-8', 'windows-1252','Effectuez les activités décrites aux pages 2 à 7.'));
$pdf->Rect(10, 88, 0.3, 0.3, '');//for bullet point
$pdf->text(15, 90,iconv('UTF-8', 'windows-1252','Conservez ce « rapport de profil personnel et plan d’action » à portée de main quand vous suivez le cours en ligne, car vous en aurez besoin pour répondre au questionnaire'));
$pdf->text(15, 95,iconv('UTF-8', 'windows-1252','de la fin.'));

$pdf->SetFont('Arial','',14);
$pdf->text(10, 110,iconv('UTF-8', 'windows-1252','Après avoir terminé le cours en ligne « Styles de communication : Adapter le vôtre »'));

$pdf->SetFont('Arial','',10);
$pdf->Rect(10, 118, 0.3, 0.3, '');//for bullet point
$pdf->text(15, 120,iconv('UTF-8', 'windows-1252','Remplissez les différents plans d’action « Apprendre à adapter votre style » débutant à la page 8.'));

$pdf->Rect(10, 123, 0.3, 0.3, '');//for bullet point
$pdf->text(15, 125,iconv('UTF-8','windows-1252', 'Consultez le forum sur les styles de communication dans le CAVL, et partagez vos idées et vos expériences avec vos collègues.'));

$pdf->Image('footer.png',10,190,275);

$pdf->AddPage("L"); //page2
					$pdf->SetTextColor(187, 187, 187); //header
					$pdf->SetFont('Arial','',14); 
					$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->SetFont('Arial','',14);
					
					$pdf->text(10, 35,iconv('UTF-8','windows-1252','Votre profil de style de communication personnel'));					
					
					$pdf->SetFont('Arial','',12);
					$pdf->text(20, 50,iconv('UTF-8','windows-1252','Nom : '.$name));
					$pdf->text(20,55,iconv('UTF-8','windows-1252','Date du rapport: '.$rdate));
					$pdf->Image('circle-french.jpg',10,65,275);
					
					$xc=180;

///////////////////////////////red
$pdf->SetFont('Arial','',14);
$pdf->SetTextColor(255,255,255); 
$pdf->text(127,95,$red_score.'%');	

//////////////////////////yellow
$pdf->SetFont('Arial','',14);
$pdf->SetTextColor(255,255,255);
$pdf->text(160,95,$yellow_score.'%');	

//////////////////////////blue
$pdf->SetFont('Arial','',14);
$pdf->SetTextColor(255,255,255); 
$pdf->text(127,128,$blue_score.'%');	

//////////////////////////green
$pdf->SetFont('Arial','',14);
$pdf->SetTextColor(255,255,255); 
$pdf->text(160,128,$green_score.'%');	

//red 
$pdf->SetFont('Arial','B',12);


$pdf->text(20,80,iconv('UTF-8','windows-1252',"ROUGE – Vous dites les choses "));
$pdf->text(40,85,iconv('UTF-8','windows-1252',"avec assurance!"));

$pdf->SetFont('Arial','',10);
$pdf->text(25,90,iconv('UTF-8','windows-1252',"Votre style de communication"));
$pdf->text(25,95,iconv('UTF-8','windows-1252',"met l’accent sur ")); 
$pdf->text(25,100,iconv('UTF-8','windows-1252',"l’importance du contrôle "));
$pdf->text(25,105,iconv('UTF-8','windows-1252',"et des résultats."));

 
 

//blue 
$pdf->SetFont('Arial','B',12);
$pdf->text(20,125,iconv('UTF-8','windows-1252',"BLEU - Vous dites les choses"));
$pdf->text(35,130,iconv('UTF-8','windows-1252',"avec précision!"));

$pdf->SetFont('Arial','',10);
$pdf->text(24,135,iconv('UTF-8','windows-1252',"Votre style de communication"));
$pdf->text(24,140,iconv('UTF-8','windows-1252',"met l’accent sur")); 
$pdf->text(24,145,iconv('UTF-8','windows-1252',"l’importance de"));
$pdf->text(24,150,iconv('UTF-8','windows-1252',"l’exactitude et de la logique."));


//yellow 
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',12);
$pdf->text(200,80,iconv('UTF-8','windows-1252',"JAUNE – Vous dites les choses "));
$pdf->text(220,85,iconv('UTF-8','windows-1252',"avec style!"));
$pdf->SetFont('Arial','',10);
$pdf->text(205,90,iconv('UTF-8','windows-1252',"Votre style de "));
$pdf->text(205,95,iconv('UTF-8','windows-1252',"communication met l’accent sur ")); 
$pdf->text(205,100,iconv('UTF-8','windows-1252',"l’importance de la créativité"));
$pdf->text(205,105,iconv('UTF-8','windows-1252',"et de la célébration."));

 

//green 
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',12);
$pdf->text(200,125,iconv('UTF-8','windows-1252',"VERT – Vous dites les choses "));
$pdf->text(216,130,iconv('UTF-8','windows-1252',"avec douceur!"));
$pdf->SetFont('Arial','',10);
$pdf->text(205,135,iconv('UTF-8','windows-1252',"Votre style de communication"));
$pdf->text(205,140,iconv('UTF-8','windows-1252',"met l’accent sur")); 
$pdf->text(205,145,iconv('UTF-8','windows-1252',"l’importance des relations"));
$pdf->text(205,150,iconv('UTF-8','windows-1252',"harmonieuses et collaboratives."));


$pdf->Image('footer.png',10,190,275);
$pdf->SetTextColor(0, 0, 0); //black
					
switch($finalSortArry[0])
{
	case 'red': ///////////////////////////////////////////////////////////////////////redpage//////////////////////////////////
				
					$pdf->AddPage("L");//page3 start //red
					$pdf->SetTextColor(187, 187, 187); //header
					$pdf->SetFont('Arial','',14);
					$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
					$pdf->SetTextColor(0, 0, 0); //black
									
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication '));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(65, 30,iconv('UTF-8','windows-1252','ROUGE'));
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(86, 30,iconv('UTF-8','windows-1252','– Vous l’êtes à '.$data[0]['score'].' %'));
					
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(10, 35, 152, 62, '');//for rectangle box
										
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(15, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(70, 45,iconv('UTF-8','windows-1252','ROUGE'));
													
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->SetDrawColor(0, 0, 0);
					
					$pdf->Rect(15, 48, 0.3, 0.3, '');
					$pdf->text(20, 50,iconv('UTF-8','windows-1252','Commandant'));
					
					$pdf->Rect(15, 53, 0.3, 0.3, '');
					$pdf->text(20, 55,iconv('UTF-8','windows-1252','Valorise que le travail soit accompli'));
					
					$pdf->Rect(15, 58, 0.3, 0.3, '');
					$pdf->text(20, 60,iconv('UTF-8','windows-1252','Prend des risques de manière décisive'));
					
					$pdf->Rect(15, 63, 0.3, 0.3, '');
					$pdf->text(20, 65,iconv('UTF-8','windows-1252','Habile à déléguer du travail aux autres'));
					
					$pdf->Rect(15, 68, 0.3, 0.3, '');
					$pdf->text(20, 70,iconv('UTF-8','windows-1252','N\'est pas gêné, mais est réservé en ce qui concerne les questions personnelles;'));
					
					$pdf->text(20, 75,iconv('UTF-8','windows-1252','donne l\'impression d’être sûr de lui dans une conversation'));
					
					$pdf->Rect(15, 78, 0.3, 0.3, '');
					$pdf->text(20, 80,iconv('UTF-8','windows-1252','Aime être dans l’action'));
					
					$pdf->Rect(15, 83, 0.3, 0.3, '');
					$pdf->text(20, 85,iconv('UTF-8','windows-1252','Assume la gestion, fait preuve d’initiative, a l’esprit de compétition, a une approche efficace'));
					
					$pdf->Rect(15, 88, 0.3, 0.3, '');
					$pdf->text(20, 90,iconv('UTF-8','windows-1252','N\'a pas peur; aucun obstacle n’est insurmontable'));
					
					$pdf->Rect(15, 93, 0.3, 0.3, '');
					$pdf->text(20, 95,iconv('UTF-8','windows-1252','Axé sur les résultats'));
					
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(165, 35, 120, 62, '');//for rectangle box
					
					  
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					
					$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(212, 45,iconv('UTF-8','windows-1252','ROUGE'));
					
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->SetDrawColor(0, 0, 0);
					
					$pdf->Rect(168, 48, 0.3, 0.3, '');
					$pdf->text(173, 50,iconv('UTF-8','windows-1252','Opinions exprimées librement'));
					
					$pdf->Rect(168, 53, 0.3, 0.3, '');
					$pdf->text(173, 55,iconv('UTF-8','windows-1252','Affirmations catégoriques – Je suis certain que...'));
					$pdf->Rect(168, 58, 0.3, 0.3, '');
					$pdf->text(173, 60,iconv('UTF-8','windows-1252','Contact visuel'));
					
					$pdf->Rect(168, 63, 0.3, 0.3, '');
					$pdf->text(173, 65,iconv('UTF-8','windows-1252','Gestes amples des mains'));
					
					$pdf->Rect(168, 68, 0.3, 0.3, '');
					$pdf->text(173, 70,iconv('UTF-8','windows-1252','Parle fort, rapidement et fréquemment'));
					
					$pdf->Rect(168, 73, 0.3, 0.3, '');
					$pdf->text(173, 75,iconv('UTF-8','windows-1252','Pose des questions rhétoriques'));
					
					
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
					
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					
					$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(120, 105,iconv('UTF-8','windows-1252','ROUGE'));
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(140, 105,iconv('UTF-8','windows-1252','chez moi :'));
					
					//red box left side input text boxes
					$pdf->SetFont('Arial','',14);
					$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
					
               $pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'rtx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'rtx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'rtx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'rtx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'rtx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'rtx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
					
			   $pdf->Image('footer.png',10,190,275);
					
					///////////////////////////////////////yellowpage///////////////////////////////////////////////////////////////
	break;
	case 'green': ///////////////////////////////greenpage /////////////////////////////////////////////////////////
				$pdf->AddPage("L");//page5 start //green
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication '));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(65, 30,iconv('UTF-8','windows-1252','VERT'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(80, 30,iconv('UTF-8','windows-1252','- Vous l’êtes à '.$data[0]['score'].' %'));
				
				  
				
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(10, 35, 150, 60, '');//for rectangle box
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(70, 45,iconv('UTF-8','windows-1252','VERT'));
				
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Harmonizer'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','Fait régner l’harmonie'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Valorise l’acceptation et la stabilité dans les situations'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Prend des décisions importantes lentement; n’aime pas le changement'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Établit des réseaux d’amis pour l’aider à effectuer le travail'));
				
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','Bonne capacité d’écoute; craint de verbaliser ses opinions contraires;'));
								
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','se préoccupe des sentiments des autres'));
				 
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Bon caractère; aime le rythme lent et régulier'));
				
				$pdf->Rect(15, 88, 0.3, 0.3, '');
				$pdf->text(20, 90,iconv('UTF-8','windows-1252','Amical et sensible; tout le monde peut être apprécié'));
							
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(165, 35, 120, 60, '');//for rectangle box
			
				 
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(213, 45,iconv('UTF-8','windows-1252','VERT'));
				
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Mouvements du corps et des mains contrôlés ou limités')); 
			
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Opinions exprimées avec timidité'));
			
				
				
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Énoncés teintés de qualificatifs : Je pense que...'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65,iconv('UTF-8','windows-1252','Corps penché vers l’arrière'));
				
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Attend qu’on le présente'));
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Parle doucement et lentement'));
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Parle moins souvent'));
				
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				  			
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','VERT'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(135, 105,iconv('UTF-8','windows-1252','chez moi :'));
				
				//green box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'gtx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'gtx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'gtx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'gtx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'gtx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'gtx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
				$pdf->Image('footer.png',10,190,275);
	break;
	case 'blue'://////////////////////blue page/////////////////////////////////////////////
				$pdf->AddPage("L");//page6 start //blue
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(65, 30,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(80, 30,iconv('UTF-8','windows-1252','- Vous l’êtes à '.$data[0]['score'].' %'));
				
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(10, 35, 150, 62, '');//for rectangle box
				 
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(69, 45,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Évaluateur'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','Valorise l’exactitude des détails et le fait d’être juste'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Planifie minutieusement avant de se décider à agir'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Préfère travailler seul'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Réfléchit rapidement, mais prend son temps avant de parler;'));
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','réservé en ce qui concerne les questions personnelles'));
				 
				
				$pdf->Rect(15, 78, 0.3, 0.3, '');				
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','Très organisé; planifie même la spontanéité!!'));
				
				$pdf->Rect(15, 83, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Prudent, logique, approche économe'));
				
				$pdf->Rect(15, 88, 0.3, 0.3, '');
				$pdf->text(20, 90,iconv('UTF-8','windows-1252','Réfléchi; aucun problème à aborder n’est trop grand'));
				
				$pdf->Rect(15, 93, 0.3, 0.3, '');
				$pdf->text(20, 95,iconv('UTF-8','windows-1252','Axé sur les idées'));
										
				$pdf->SetFont('Arial','B',14);
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(165, 35, 120, 62, '');//for rectangle box
			
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue	
				$pdf->text(213, 45,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Personne orientée vers les faits et les tâches')); 
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Peu de partage des sentiments personnels'));
								
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Discours plus formel'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65, iconv('UTF-8','windows-1252','Peu d’inflexions'));
				
				
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Peu de variations dans le ton'));
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Peu de variations dans la qualité vocale'));
			
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Moins d’expressions du visage'));
				
				$pdf->Rect(168, 83, 0.3, 0.3, '');
				$pdf->text(173, 85,iconv('UTF-8','windows-1252','Mouvements du corps et des mains contrôlés ou limités'));
		
				
				$pdf->Rect(168, 88, 0.3, 0.3, '');
				$pdf->text(173, 90,iconv('UTF-8','windows-1252','Peu de contacts personnels'));
				
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				  
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','BLEU'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(135, 105,iconv('UTF-8','windows-1252','chez moi :'));
				
				//blue box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'btx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'btx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'btx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'btx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'btx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'btx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
								
				$pdf->Image('footer.png',10,190,275);
	break;
	case 'yellow':///////////////////////////yellow page////////////////////////////////////////////
				
				
				$pdf->AddPage("L");//page4 start //yellow
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
				$pdf->SetTextColor(0, 0, 0); //black
				
				  
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication'));
				
				$pdf->SetFont('Arial','B',14);				
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(64, 30,iconv('UTF-8','windows-1252','JAUNE'));
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(85, 30,iconv('UTF-8','windows-1252','– Vous l’êtes à  '.$data[0]['score'].' %'));
				
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(10, 35, 150, 60, '');//for rectangle box
								  			
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(70, 45,iconv('UTF-8','windows-1252','JAUNE'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Valorise le plaisir et le fait d’aider les autres dans un cadre agréable'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','A beaucoup d’idées et les essaie de façon spontanée'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Veut que le travail soit amusant pour tout le monde'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Volubile et ouvert aux autres; demande l’opinion des autres; aime les remue-méninges'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Souple; se lasse facilement de la routine'));
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','Intuitif, créatif, spontané, approche flamboyante'));
				
				$pdf->Rect(15, 78, 0.3, 0.3, '');
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','Optimiste; l’espoir est ce qui compte le plus'));
				
				$pdf->Rect(15, 83, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Axé sur la célébration'));
				
				
				  
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(165, 35, 120, 60, '');//for rectangle box
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(212, 45,iconv('UTF-8','windows-1252','JAUNE'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Aime raconter des histoires et des anecdotes'));
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Partage ses sentiments personnels'));
				
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Nombreuses inflexions'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65,iconv('UTF-8','windows-1252','Plus de variations dans le ton de la voix'));
								
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Plus de variations dans la qualité vocale'));
			
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Expressions du visage plus animées et nombreuses'));
		
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Mains et corps en mouvement'));
		
				
				$pdf->Rect(168, 83, 0.3, 0.3, '');
				$pdf->text(173, 85,iconv('UTF-8','windows-1252','Contact personnel'));
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				 
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','JAUNE'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(138, 105,iconv('UTF-8','windows-1252','chez moi: '));
				
				//yellow box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'ytx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'ytx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'ytx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'ytx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'ytx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'ytx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
				$pdf->Image('footer.png',10,190,275);
				break;
}
switch($finalSortArry[1])
{
	case 'red': ///////////////////////////////////////////////////////////////////////redpage//////////////////////////////////
				
					$pdf->AddPage("L");//page3 start //red
					$pdf->SetTextColor(187, 187, 187); //header
					$pdf->SetFont('Arial','',14);
					$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
					$pdf->SetTextColor(0, 0, 0); //black
									
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication '));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(65, 30,iconv('UTF-8','windows-1252','ROUGE'));
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(86, 30,iconv('UTF-8','windows-1252','– Vous l’êtes à '.$data[1]['score'].' %'));
					
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(10, 35, 152, 62, '');//for rectangle box
										
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(15, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(70, 45,iconv('UTF-8','windows-1252','ROUGE'));
													
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->SetDrawColor(0, 0, 0);
					
					$pdf->Rect(15, 48, 0.3, 0.3, '');
					$pdf->text(20, 50,iconv('UTF-8','windows-1252','Commandant'));
					
					$pdf->Rect(15, 53, 0.3, 0.3, '');
					$pdf->text(20, 55,iconv('UTF-8','windows-1252','Valorise que le travail soit accompli'));
					
					$pdf->Rect(15, 58, 0.3, 0.3, '');
					$pdf->text(20, 60,iconv('UTF-8','windows-1252','Prend des risques de manière décisive'));
					
					$pdf->Rect(15, 63, 0.3, 0.3, '');
					$pdf->text(20, 65,iconv('UTF-8','windows-1252','Habile à déléguer du travail aux autres'));
					
					$pdf->Rect(15, 68, 0.3, 0.3, '');
					$pdf->text(20, 70,iconv('UTF-8','windows-1252','N\'est pas gêné, mais est réservé en ce qui concerne les questions personnelles;'));
					
					$pdf->text(20, 75,iconv('UTF-8','windows-1252','donne l\'impression d’être sûr de lui dans une conversation'));
					
					$pdf->Rect(15, 78, 0.3, 0.3, '');
					$pdf->text(20, 80,iconv('UTF-8','windows-1252','Aime être dans l’action'));
					
					$pdf->Rect(15, 83, 0.3, 0.3, '');
					$pdf->text(20, 85,iconv('UTF-8','windows-1252','Assume la gestion, fait preuve d’initiative, a l’esprit de compétition, a une approche efficace'));
					
					$pdf->Rect(15, 88, 0.3, 0.3, '');
					$pdf->text(20, 90,iconv('UTF-8','windows-1252','N\'a pas peur; aucun obstacle n’est insurmontable'));
					
					$pdf->Rect(15, 93, 0.3, 0.3, '');
					$pdf->text(20, 95,iconv('UTF-8','windows-1252','Axé sur les résultats'));
					
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(165, 35, 120, 62, '');//for rectangle box
					
					  
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					
					$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(212, 45,iconv('UTF-8','windows-1252','ROUGE'));
					
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->SetDrawColor(0, 0, 0);
					
					$pdf->Rect(168, 48, 0.3, 0.3, '');
					$pdf->text(173, 50,iconv('UTF-8','windows-1252','Opinions exprimées librement'));
					
					$pdf->Rect(168, 53, 0.3, 0.3, '');
					$pdf->text(173, 55,iconv('UTF-8','windows-1252','Affirmations catégoriques – Je suis certain que...'));
					$pdf->Rect(168, 58, 0.3, 0.3, '');
					$pdf->text(173, 60,iconv('UTF-8','windows-1252','Contact visuel'));
					
					$pdf->Rect(168, 63, 0.3, 0.3, '');
					$pdf->text(173, 65,iconv('UTF-8','windows-1252','Gestes amples des mains'));
					
					$pdf->Rect(168, 68, 0.3, 0.3, '');
					$pdf->text(173, 70,iconv('UTF-8','windows-1252','Parle fort, rapidement et fréquemment'));
					
					$pdf->Rect(168, 73, 0.3, 0.3, '');
					$pdf->text(173, 75,iconv('UTF-8','windows-1252','Pose des questions rhétoriques'));
					
					
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
					
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					
					$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(120, 105,iconv('UTF-8','windows-1252','ROUGE'));
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(140, 105,iconv('UTF-8','windows-1252','chez moi :'));
					
					//red box left side input text boxes
					$pdf->SetFont('Arial','',14);
					$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
					
               $pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'rtx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'rtx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'rtx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'rtx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'rtx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'rtx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
					
			   $pdf->Image('footer.png',10,190,275);

					
					///////////////////////////////////////yellowpage///////////////////////////////////////////////////////////////
	break;
	case 'green': ///////////////////////////////greenpage /////////////////////////////////////////////////////////
				$pdf->AddPage("L");//page5 start //green
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication '));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(65, 30,iconv('UTF-8','windows-1252','VERT'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(80, 30,iconv('UTF-8','windows-1252','- Vous l’êtes à '.$data[1]['score'].' %'));
				
				  
				
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(10, 35, 150, 60, '');//for rectangle box
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(70, 45,iconv('UTF-8','windows-1252','VERT'));
				
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Harmonizer'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','Fait régner l’harmonie'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Valorise l’acceptation et la stabilité dans les situations'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Prend des décisions importantes lentement; n’aime pas le changement'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Établit des réseaux d’amis pour l’aider à effectuer le travail'));
				
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','Bonne capacité d’écoute; craint de verbaliser ses opinions contraires;'));
								
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','se préoccupe des sentiments des autres'));
				 
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Bon caractère; aime le rythme lent et régulier'));
				
				$pdf->Rect(15, 88, 0.3, 0.3, '');
				$pdf->text(20, 90,iconv('UTF-8','windows-1252','Amical et sensible; tout le monde peut être apprécié'));
							
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(165, 35, 120, 60, '');//for rectangle box
			
				 
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(213, 45,iconv('UTF-8','windows-1252','VERT'));
				
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Mouvements du corps et des mains contrôlés ou limités')); 
			
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Opinions exprimées avec timidité'));
			
				
				
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Énoncés teintés de qualificatifs : Je pense que...'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65,iconv('UTF-8','windows-1252','Corps penché vers l’arrière'));
				
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Attend qu’on le présente'));
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Parle doucement et lentement'));
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Parle moins souvent'));
				
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				  			
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','VERT'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(135, 105,iconv('UTF-8','windows-1252','chez moi :'));
				
				//green box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'gtx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'gtx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'gtx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'gtx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'gtx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'gtx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
				$pdf->Image('footer.png',10,190,275);
	break;
	case 'blue'://////////////////////blue page/////////////////////////////////////////////
				$pdf->AddPage("L");//page6 start //blue
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(65, 30,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(80, 30,iconv('UTF-8','windows-1252','- Vous l’êtes à '.$data[1]['score'].' %'));
				
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(10, 35, 150, 62, '');//for rectangle box
				 
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(69, 45,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Évaluateur'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','Valorise l’exactitude des détails et le fait d’être juste'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Planifie minutieusement avant de se décider à agir'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Préfère travailler seul'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Réfléchit rapidement, mais prend son temps avant de parler;'));
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','réservé en ce qui concerne les questions personnelles'));
				 
				
				$pdf->Rect(15, 78, 0.3, 0.3, '');				
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','Très organisé; planifie même la spontanéité!!'));
				
				$pdf->Rect(15, 83, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Prudent, logique, approche économe'));
				
				$pdf->Rect(15, 88, 0.3, 0.3, '');
				$pdf->text(20, 90,iconv('UTF-8','windows-1252','Réfléchi; aucun problème à aborder n’est trop grand'));
				
				$pdf->Rect(15, 93, 0.3, 0.3, '');
				$pdf->text(20, 95,iconv('UTF-8','windows-1252','Axé sur les idées'));
										
				$pdf->SetFont('Arial','B',14);
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(165, 35, 120, 62, '');//for rectangle box
			
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue	
				$pdf->text(213, 45,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Personne orientée vers les faits et les tâches')); 
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Peu de partage des sentiments personnels'));
								
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Discours plus formel'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65, iconv('UTF-8','windows-1252','Peu d’inflexions'));
				
				
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Peu de variations dans le ton'));
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Peu de variations dans la qualité vocale'));
			
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Moins d’expressions du visage'));
				
				$pdf->Rect(168, 83, 0.3, 0.3, '');
				$pdf->text(173, 85,iconv('UTF-8','windows-1252','Mouvements du corps et des mains contrôlés ou limités'));
		
				
				$pdf->Rect(168, 88, 0.3, 0.3, '');
				$pdf->text(173, 90,iconv('UTF-8','windows-1252','Peu de contacts personnels'));
				
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				  
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','BLEU'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(135, 105,iconv('UTF-8','windows-1252','chez moi :'));
				
				//blue box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'btx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'btx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'btx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'btx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'btx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'btx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
								
				$pdf->Image('footer.png',10,190,275);
	break;
	case 'yellow':///////////////////////////yellow page////////////////////////////////////////////
				
				
				$pdf->AddPage("L");//page4 start //yellow
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
				$pdf->SetTextColor(0, 0, 0); //black
				
				  
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication'));
				
				$pdf->SetFont('Arial','B',14);				
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(64, 30,iconv('UTF-8','windows-1252','JAUNE'));
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(85, 30,iconv('UTF-8','windows-1252','– Vous l’êtes à  '.$data[1]['score'].' %'));
				
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(10, 35, 150, 60, '');//for rectangle box
								  			
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(70, 45,iconv('UTF-8','windows-1252','JAUNE'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Valorise le plaisir et le fait d’aider les autres dans un cadre agréable'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','A beaucoup d’idées et les essaie de façon spontanée'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Veut que le travail soit amusant pour tout le monde'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Volubile et ouvert aux autres; demande l’opinion des autres; aime les remue-méninges'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Souple; se lasse facilement de la routine'));
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','Intuitif, créatif, spontané, approche flamboyante'));
				
				$pdf->Rect(15, 78, 0.3, 0.3, '');
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','Optimiste; l’espoir est ce qui compte le plus'));
				
				$pdf->Rect(15, 83, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Axé sur la célébration'));
				
				
				  
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(165, 35, 120, 60, '');//for rectangle box
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(212, 45,iconv('UTF-8','windows-1252','JAUNE'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Aime raconter des histoires et des anecdotes'));
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Partage ses sentiments personnels'));
				
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Nombreuses inflexions'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65,iconv('UTF-8','windows-1252','Plus de variations dans le ton de la voix'));
								
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Plus de variations dans la qualité vocale'));
			
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Expressions du visage plus animées et nombreuses'));
		
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Mains et corps en mouvement'));
		
				
				$pdf->Rect(168, 83, 0.3, 0.3, '');
				$pdf->text(173, 85,iconv('UTF-8','windows-1252','Contact personnel'));
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				 
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','JAUNE'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(138, 105,iconv('UTF-8','windows-1252','chez moi: '));
				
				//yellow box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'ytx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'ytx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'ytx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'ytx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'ytx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'ytx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
				$pdf->Image('footer.png',10,190,275);
				break;
}
switch($finalSortArry[2])
{
	case 'red': ///////////////////////////////////////////////////////////////////////redpage//////////////////////////////////
				
					$pdf->AddPage("L");//page3 start //red
					$pdf->SetTextColor(187, 187, 187); //header
					$pdf->SetFont('Arial','',14);
					$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
					$pdf->SetTextColor(0, 0, 0); //black
									
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication '));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(65, 30,iconv('UTF-8','windows-1252','ROUGE'));
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(86, 30,iconv('UTF-8','windows-1252','– Vous l’êtes à '.$data[2]['score'].' %'));
					
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(10, 35, 152, 62, '');//for rectangle box
										
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(15, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(70, 45,iconv('UTF-8','windows-1252','ROUGE'));
													
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->SetDrawColor(0, 0, 0);
					
					$pdf->Rect(15, 48, 0.3, 0.3, '');
					$pdf->text(20, 50,iconv('UTF-8','windows-1252','Commandant'));
					
					$pdf->Rect(15, 53, 0.3, 0.3, '');
					$pdf->text(20, 55,iconv('UTF-8','windows-1252','Valorise que le travail soit accompli'));
					
					$pdf->Rect(15, 58, 0.3, 0.3, '');
					$pdf->text(20, 60,iconv('UTF-8','windows-1252','Prend des risques de manière décisive'));
					
					$pdf->Rect(15, 63, 0.3, 0.3, '');
					$pdf->text(20, 65,iconv('UTF-8','windows-1252','Habile à déléguer du travail aux autres'));
					
					$pdf->Rect(15, 68, 0.3, 0.3, '');
					$pdf->text(20, 70,iconv('UTF-8','windows-1252','N\'est pas gêné, mais est réservé en ce qui concerne les questions personnelles;'));
					
					$pdf->text(20, 75,iconv('UTF-8','windows-1252','donne l\'impression d’être sûr de lui dans une conversation'));
					
					$pdf->Rect(15, 78, 0.3, 0.3, '');
					$pdf->text(20, 80,iconv('UTF-8','windows-1252','Aime être dans l’action'));
					
					$pdf->Rect(15, 83, 0.3, 0.3, '');
					$pdf->text(20, 85,iconv('UTF-8','windows-1252','Assume la gestion, fait preuve d’initiative, a l’esprit de compétition, a une approche efficace'));
					
					$pdf->Rect(15, 88, 0.3, 0.3, '');
					$pdf->text(20, 90,iconv('UTF-8','windows-1252','N\'a pas peur; aucun obstacle n’est insurmontable'));
					
					$pdf->Rect(15, 93, 0.3, 0.3, '');
					$pdf->text(20, 95,iconv('UTF-8','windows-1252','Axé sur les résultats'));
					
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(165, 35, 120, 62, '');//for rectangle box
					
					  
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					
					$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(212, 45,iconv('UTF-8','windows-1252','ROUGE'));
					
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->SetDrawColor(0, 0, 0);
					
					$pdf->Rect(168, 48, 0.3, 0.3, '');
					$pdf->text(173, 50,iconv('UTF-8','windows-1252','Opinions exprimées librement'));
					
					$pdf->Rect(168, 53, 0.3, 0.3, '');
					$pdf->text(173, 55,iconv('UTF-8','windows-1252','Affirmations catégoriques – Je suis certain que...'));
					$pdf->Rect(168, 58, 0.3, 0.3, '');
					$pdf->text(173, 60,iconv('UTF-8','windows-1252','Contact visuel'));
					
					$pdf->Rect(168, 63, 0.3, 0.3, '');
					$pdf->text(173, 65,iconv('UTF-8','windows-1252','Gestes amples des mains'));
					
					$pdf->Rect(168, 68, 0.3, 0.3, '');
					$pdf->text(173, 70,iconv('UTF-8','windows-1252','Parle fort, rapidement et fréquemment'));
					
					$pdf->Rect(168, 73, 0.3, 0.3, '');
					$pdf->text(173, 75,iconv('UTF-8','windows-1252','Pose des questions rhétoriques'));
					
					
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
					
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					
					$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(120, 105,iconv('UTF-8','windows-1252','ROUGE'));
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(140, 105,iconv('UTF-8','windows-1252','chez moi :'));
					
					//red box left side input text boxes
					$pdf->SetFont('Arial','',14);
					$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
					
               $pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'rtx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'rtx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'rtx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'rtx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'rtx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'rtx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
					
			   $pdf->Image('footer.png',10,190,275);

					
					///////////////////////////////////////yellowpage///////////////////////////////////////////////////////////////
	break;
	case 'green': ///////////////////////////////greenpage /////////////////////////////////////////////////////////
				$pdf->AddPage("L");//page5 start //green
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication '));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(65, 30,iconv('UTF-8','windows-1252','VERT'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(80, 30,iconv('UTF-8','windows-1252','- Vous l’êtes à '.$data[2]['score'].' %'));
				
				  
				
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(10, 35, 150, 60, '');//for rectangle box
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(70, 45,iconv('UTF-8','windows-1252','VERT'));
				
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Harmonizer'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','Fait régner l’harmonie'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Valorise l’acceptation et la stabilité dans les situations'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Prend des décisions importantes lentement; n’aime pas le changement'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Établit des réseaux d’amis pour l’aider à effectuer le travail'));
				
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','Bonne capacité d’écoute; craint de verbaliser ses opinions contraires;'));
								
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','se préoccupe des sentiments des autres'));
				 
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Bon caractère; aime le rythme lent et régulier'));
				
				$pdf->Rect(15, 88, 0.3, 0.3, '');
				$pdf->text(20, 90,iconv('UTF-8','windows-1252','Amical et sensible; tout le monde peut être apprécié'));
							
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(165, 35, 120, 60, '');//for rectangle box
			
				 
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(213, 45,iconv('UTF-8','windows-1252','VERT'));
				
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Mouvements du corps et des mains contrôlés ou limités')); 
			
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Opinions exprimées avec timidité'));
			
				
				
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Énoncés teintés de qualificatifs : Je pense que...'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65,iconv('UTF-8','windows-1252','Corps penché vers l’arrière'));
				
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Attend qu’on le présente'));
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Parle doucement et lentement'));
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Parle moins souvent'));
				
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				  			
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','VERT'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(135, 105,iconv('UTF-8','windows-1252','chez moi :'));
				
				//green box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'gtx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'gtx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'gtx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'gtx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'gtx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'gtx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
				$pdf->Image('footer.png',10,190,275);
	break;
	case 'blue'://////////////////////blue page/////////////////////////////////////////////
				$pdf->AddPage("L");//page6 start //blue
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(65, 30,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(80, 30,iconv('UTF-8','windows-1252','- Vous l’êtes à '.$data[2]['score'].' %'));
				
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(10, 35, 150, 62, '');//for rectangle box
				 
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(69, 45,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Évaluateur'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','Valorise l’exactitude des détails et le fait d’être juste'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Planifie minutieusement avant de se décider à agir'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Préfère travailler seul'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Réfléchit rapidement, mais prend son temps avant de parler;'));
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','réservé en ce qui concerne les questions personnelles'));
				 
				
				$pdf->Rect(15, 78, 0.3, 0.3, '');				
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','Très organisé; planifie même la spontanéité!!'));
				
				$pdf->Rect(15, 83, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Prudent, logique, approche économe'));
				
				$pdf->Rect(15, 88, 0.3, 0.3, '');
				$pdf->text(20, 90,iconv('UTF-8','windows-1252','Réfléchi; aucun problème à aborder n’est trop grand'));
				
				$pdf->Rect(15, 93, 0.3, 0.3, '');
				$pdf->text(20, 95,iconv('UTF-8','windows-1252','Axé sur les idées'));
										
				$pdf->SetFont('Arial','B',14);
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(165, 35, 120, 62, '');//for rectangle box
			
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue	
				$pdf->text(213, 45,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Personne orientée vers les faits et les tâches')); 
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Peu de partage des sentiments personnels'));
								
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Discours plus formel'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65, iconv('UTF-8','windows-1252','Peu d’inflexions'));
				
				
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Peu de variations dans le ton'));
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Peu de variations dans la qualité vocale'));
			
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Moins d’expressions du visage'));
				
				$pdf->Rect(168, 83, 0.3, 0.3, '');
				$pdf->text(173, 85,iconv('UTF-8','windows-1252','Mouvements du corps et des mains contrôlés ou limités'));
		
				
				$pdf->Rect(168, 88, 0.3, 0.3, '');
				$pdf->text(173, 90,iconv('UTF-8','windows-1252','Peu de contacts personnels'));
				
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				  
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','BLEU'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(135, 105,iconv('UTF-8','windows-1252','chez moi :'));
				
				//blue box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'btx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'btx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'btx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'btx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'btx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'btx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
								
				$pdf->Image('footer.png',10,190,275);
	break;
	case 'yellow':///////////////////////////yellow page////////////////////////////////////////////
				
				$pdf->AddPage("L");//page4 start //yellow
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
				$pdf->SetTextColor(0, 0, 0); //black
				
				  
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication'));
				
				$pdf->SetFont('Arial','B',14);				
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(64, 30,iconv('UTF-8','windows-1252','JAUNE'));
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(85, 30,iconv('UTF-8','windows-1252','– Vous l’êtes à  '.$data[2]['score'].' %'));
				
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(10, 35, 150, 60, '');//for rectangle box
								  			
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(70, 45,iconv('UTF-8','windows-1252','JAUNE'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Valorise le plaisir et le fait d’aider les autres dans un cadre agréable'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','A beaucoup d’idées et les essaie de façon spontanée'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Veut que le travail soit amusant pour tout le monde'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Volubile et ouvert aux autres; demande l’opinion des autres; aime les remue-méninges'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Souple; se lasse facilement de la routine'));
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','Intuitif, créatif, spontané, approche flamboyante'));
				
				$pdf->Rect(15, 78, 0.3, 0.3, '');
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','Optimiste; l’espoir est ce qui compte le plus'));
				
				$pdf->Rect(15, 83, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Axé sur la célébration'));
				
				
				  
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(165, 35, 120, 60, '');//for rectangle box
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(212, 45,iconv('UTF-8','windows-1252','JAUNE'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Aime raconter des histoires et des anecdotes'));
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Partage ses sentiments personnels'));
				
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Nombreuses inflexions'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65,iconv('UTF-8','windows-1252','Plus de variations dans le ton de la voix'));
								
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Plus de variations dans la qualité vocale'));
			
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Expressions du visage plus animées et nombreuses'));
		
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Mains et corps en mouvement'));
		
				
				$pdf->Rect(168, 83, 0.3, 0.3, '');
				$pdf->text(173, 85,iconv('UTF-8','windows-1252','Contact personnel'));
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				 
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','JAUNE'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(138, 105,iconv('UTF-8','windows-1252','chez moi: '));
				
				//yellow box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'ytx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'ytx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'ytx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'ytx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'ytx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'ytx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
				$pdf->Image('footer.png',10,190,275);
				
				break;
}
switch($finalSortArry[3])
{
	case 'red': ///////////////////////////////////////////////////////////////////////redpage//////////////////////////////////
				
				    $pdf->AddPage("L");//page3 start //red
					$pdf->SetTextColor(187, 187, 187); //header
					$pdf->SetFont('Arial','',14);
					$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
					$pdf->SetTextColor(0, 0, 0); //black
									
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication '));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(65, 30,iconv('UTF-8','windows-1252','ROUGE'));
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(86, 30,iconv('UTF-8','windows-1252','– Vous l’êtes à '.$data[3]['score'].' %'));
					
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(10, 35, 152, 62, '');//for rectangle box
										
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(15, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(70, 45,iconv('UTF-8','windows-1252','ROUGE'));
													
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->SetDrawColor(0, 0, 0);
					
					$pdf->Rect(15, 48, 0.3, 0.3, '');
					$pdf->text(20, 50,iconv('UTF-8','windows-1252','Commandant'));
					
					$pdf->Rect(15, 53, 0.3, 0.3, '');
					$pdf->text(20, 55,iconv('UTF-8','windows-1252','Valorise que le travail soit accompli'));
					
					$pdf->Rect(15, 58, 0.3, 0.3, '');
					$pdf->text(20, 60,iconv('UTF-8','windows-1252','Prend des risques de manière décisive'));
					
					$pdf->Rect(15, 63, 0.3, 0.3, '');
					$pdf->text(20, 65,iconv('UTF-8','windows-1252','Habile à déléguer du travail aux autres'));
					
					$pdf->Rect(15, 68, 0.3, 0.3, '');
					$pdf->text(20, 70,iconv('UTF-8','windows-1252','N\'est pas gêné, mais est réservé en ce qui concerne les questions personnelles;'));
					
					$pdf->text(20, 75,iconv('UTF-8','windows-1252','donne l\'impression d’être sûr de lui dans une conversation'));
					
					$pdf->Rect(15, 78, 0.3, 0.3, '');
					$pdf->text(20, 80,iconv('UTF-8','windows-1252','Aime être dans l’action'));
					
					$pdf->Rect(15, 83, 0.3, 0.3, '');
					$pdf->text(20, 85,iconv('UTF-8','windows-1252','Assume la gestion, fait preuve d’initiative, a l’esprit de compétition, a une approche efficace'));
					
					$pdf->Rect(15, 88, 0.3, 0.3, '');
					$pdf->text(20, 90,iconv('UTF-8','windows-1252','N\'a pas peur; aucun obstacle n’est insurmontable'));
					
					$pdf->Rect(15, 93, 0.3, 0.3, '');
					$pdf->text(20, 95,iconv('UTF-8','windows-1252','Axé sur les résultats'));
					
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(165, 35, 120, 62, '');//for rectangle box
					
					  
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetTextColor(0, 0, 0); //black
					
					$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
					
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(212, 45,iconv('UTF-8','windows-1252','ROUGE'));
					
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->SetDrawColor(0, 0, 0);
					
					$pdf->Rect(168, 48, 0.3, 0.3, '');
					$pdf->text(173, 50,iconv('UTF-8','windows-1252','Opinions exprimées librement'));
					
					$pdf->Rect(168, 53, 0.3, 0.3, '');
					$pdf->text(173, 55,iconv('UTF-8','windows-1252','Affirmations catégoriques – Je suis certain que...'));
					$pdf->Rect(168, 58, 0.3, 0.3, '');
					$pdf->text(173, 60,iconv('UTF-8','windows-1252','Contact visuel'));
					
					$pdf->Rect(168, 63, 0.3, 0.3, '');
					$pdf->text(173, 65,iconv('UTF-8','windows-1252','Gestes amples des mains'));
					
					$pdf->Rect(168, 68, 0.3, 0.3, '');
					$pdf->text(173, 70,iconv('UTF-8','windows-1252','Parle fort, rapidement et fréquemment'));
					
					$pdf->Rect(168, 73, 0.3, 0.3, '');
					$pdf->text(173, 75,iconv('UTF-8','windows-1252','Pose des questions rhétoriques'));
					
					
					
					$pdf->SetFont('Arial','',14);
					$pdf->SetDrawColor(204, 0, 0);
					$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
					
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					
					$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
					$pdf->SetFont('Arial','B',14);
					$pdf->SetTextColor(204, 0, 0); //red
					$pdf->text(120, 105,iconv('UTF-8','windows-1252','ROUGE'));
					$pdf->SetFont('Arial','',10);
					$pdf->SetTextColor(0, 0, 0); //black
					$pdf->text(140, 105,iconv('UTF-8','windows-1252','chez moi :'));
					
					//red box left side input text boxes
					$pdf->SetFont('Arial','',14);
					$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
					
               $pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'rtx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'rtx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'rtx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'rtx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'rtx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'rtx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
					
			   $pdf->Image('footer.png',10,190,275);

					
					///////////////////////////////////////yellowpage///////////////////////////////////////////////////////////////
	break;
	case 'green': ///////////////////////////////greenpage /////////////////////////////////////////////////////////
				$pdf->AddPage("L");//page5 start //green
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication '));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(65, 30,iconv('UTF-8','windows-1252','VERT'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(80, 30,iconv('UTF-8','windows-1252','- Vous l’êtes à '.$data[3]['score'].' %'));
				
				  
				
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(10, 35, 150, 60, '');//for rectangle box
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(70, 45,iconv('UTF-8','windows-1252','VERT'));
				
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Harmonizer'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','Fait régner l’harmonie'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Valorise l’acceptation et la stabilité dans les situations'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Prend des décisions importantes lentement; n’aime pas le changement'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Établit des réseaux d’amis pour l’aider à effectuer le travail'));
				
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','Bonne capacité d’écoute; craint de verbaliser ses opinions contraires;'));
								
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','se préoccupe des sentiments des autres'));
				 
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Bon caractère; aime le rythme lent et régulier'));
				
				$pdf->Rect(15, 88, 0.3, 0.3, '');
				$pdf->text(20, 90,iconv('UTF-8','windows-1252','Amical et sensible; tout le monde peut être apprécié'));
							
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(165, 35, 120, 60, '');//for rectangle box
			
				 
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(213, 45,iconv('UTF-8','windows-1252','VERT'));
				
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Mouvements du corps et des mains contrôlés ou limités')); 
			
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Opinions exprimées avec timidité'));
			
				
				
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Énoncés teintés de qualificatifs : Je pense que...'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65,iconv('UTF-8','windows-1252','Corps penché vers l’arrière'));
				
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Attend qu’on le présente'));
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Parle doucement et lentement'));
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Parle moins souvent'));
				
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(118,185,0);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				  			
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','VERT'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(135, 105,iconv('UTF-8','windows-1252','chez moi :'));
				
				//green box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'gtx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'gtx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'gtx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'gtx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'gtx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'gtx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
				$pdf->Image('footer.png',10,190,275);
	break;
	case 'blue'://////////////////////blue page/////////////////////////////////////////////
				$pdf->AddPage("L");//page6 start //blue
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(65, 30,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(80, 30,iconv('UTF-8','windows-1252','- Vous l’êtes à '.$data[3]['score'].' %'));
				
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(10, 35, 150, 62, '');//for rectangle box
				 
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(69, 45,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Évaluateur'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','Valorise l’exactitude des détails et le fait d’être juste'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Planifie minutieusement avant de se décider à agir'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Préfère travailler seul'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Réfléchit rapidement, mais prend son temps avant de parler;'));
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','réservé en ce qui concerne les questions personnelles'));
				 
				
				$pdf->Rect(15, 78, 0.3, 0.3, '');				
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','Très organisé; planifie même la spontanéité!!'));
				
				$pdf->Rect(15, 83, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Prudent, logique, approche économe'));
				
				$pdf->Rect(15, 88, 0.3, 0.3, '');
				$pdf->text(20, 90,iconv('UTF-8','windows-1252','Réfléchi; aucun problème à aborder n’est trop grand'));
				
				$pdf->Rect(15, 93, 0.3, 0.3, '');
				$pdf->text(20, 95,iconv('UTF-8','windows-1252','Axé sur les idées'));
										
				$pdf->SetFont('Arial','B',14);
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(165, 35, 120, 62, '');//for rectangle box
			
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue	
				$pdf->text(213, 45,iconv('UTF-8','windows-1252','BLEU'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Personne orientée vers les faits et les tâches')); 
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Peu de partage des sentiments personnels'));
								
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Discours plus formel'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65, iconv('UTF-8','windows-1252','Peu d’inflexions'));
				
				
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Peu de variations dans le ton'));
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Peu de variations dans la qualité vocale'));
			
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Moins d’expressions du visage'));
				
				$pdf->Rect(168, 83, 0.3, 0.3, '');
				$pdf->text(173, 85,iconv('UTF-8','windows-1252','Mouvements du corps et des mains contrôlés ou limités'));
		
				
				$pdf->Rect(168, 88, 0.3, 0.3, '');
				$pdf->text(173, 90,iconv('UTF-8','windows-1252','Peu de contacts personnels'));
				
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(0,104,179);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				  
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','BLEU'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(135, 105,iconv('UTF-8','windows-1252','chez moi :'));
				
				//blue box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'btx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'btx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'btx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'btx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'btx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'btx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
								
				$pdf->Image('footer.png',10,190,275);
	break;
	case 'yellow':///////////////////////////yellow page////////////////////////////////////////////
				
				$pdf->AddPage("L");//page4 start //yellow
				$pdf->SetTextColor(187, 187, 187); //header
				$pdf->SetFont('Arial','',14);
				$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
				$pdf->SetTextColor(0, 0, 0); //black
				
				  
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(10, 30,iconv('UTF-8','windows-1252','Style de communication'));
				
				$pdf->SetFont('Arial','B',14);				
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(64, 30,iconv('UTF-8','windows-1252','JAUNE'));
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(85, 30,iconv('UTF-8','windows-1252','– Vous l’êtes à  '.$data[3]['score'].' %'));
				
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(10, 35, 150, 60, '');//for rectangle box
								  			
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(13, 45,iconv('UTF-8','windows-1252','Caractéristiques du style'));
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(70, 45,iconv('UTF-8','windows-1252','JAUNE'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 48, 0.3, 0.3, '');
				$pdf->text(20, 50,iconv('UTF-8','windows-1252','Valorise le plaisir et le fait d’aider les autres dans un cadre agréable'));
				
				$pdf->Rect(15, 53, 0.3, 0.3, '');
				$pdf->text(20, 55,iconv('UTF-8','windows-1252','A beaucoup d’idées et les essaie de façon spontanée'));
				
				$pdf->Rect(15, 58, 0.3, 0.3, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Veut que le travail soit amusant pour tout le monde'));
				
				$pdf->Rect(15, 63, 0.3, 0.3, '');
				$pdf->text(20, 65,iconv('UTF-8','windows-1252','Volubile et ouvert aux autres; demande l’opinion des autres; aime les remue-méninges'));
				
				$pdf->Rect(15, 68, 0.3, 0.3, '');
				$pdf->text(20, 70,iconv('UTF-8','windows-1252','Souple; se lasse facilement de la routine'));
				
				$pdf->Rect(15, 73, 0.3, 0.3, '');
				$pdf->text(20, 75,iconv('UTF-8','windows-1252','Intuitif, créatif, spontané, approche flamboyante'));
				
				$pdf->Rect(15, 78, 0.3, 0.3, '');
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','Optimiste; l’espoir est ce qui compte le plus'));
				
				$pdf->Rect(15, 83, 0.3, 0.3, '');
				$pdf->text(20, 85,iconv('UTF-8','windows-1252','Axé sur la célébration'));
				
				
				  
				
				$pdf->SetFont('Arial','B',14);
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(165, 35, 120, 60, '');//for rectangle box
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(168, 45,iconv('UTF-8','windows-1252','Tendances du style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(212, 45,iconv('UTF-8','windows-1252','JAUNE'));
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(168, 48, 0.3, 0.3, '');
				$pdf->text(173, 50,iconv('UTF-8','windows-1252','Aime raconter des histoires et des anecdotes'));
				
				$pdf->Rect(168, 53, 0.3, 0.3, '');
				$pdf->text(173, 55,iconv('UTF-8','windows-1252','Partage ses sentiments personnels'));
				
				$pdf->Rect(168, 58, 0.3, 0.3, '');
				$pdf->text(173, 60,iconv('UTF-8','windows-1252','Nombreuses inflexions'));
				
				$pdf->Rect(168, 63, 0.3, 0.3, '');
				$pdf->text(173, 65,iconv('UTF-8','windows-1252','Plus de variations dans le ton de la voix'));
								
				$pdf->Rect(168, 68, 0.3, 0.3, '');
				$pdf->text(173, 70,iconv('UTF-8','windows-1252','Plus de variations dans la qualité vocale'));
			
				
				$pdf->Rect(168, 73, 0.3, 0.3, '');
				$pdf->text(173, 75,iconv('UTF-8','windows-1252','Expressions du visage plus animées et nombreuses'));
		
				
				$pdf->Rect(168, 78, 0.3, 0.3, '');
				$pdf->text(173, 80,iconv('UTF-8','windows-1252','Mains et corps en mouvement'));
		
				
				$pdf->Rect(168, 83, 0.3, 0.3, '');
				$pdf->text(173, 85,iconv('UTF-8','windows-1252','Contact personnel'));
				
				
				$pdf->SetFont('Arial','',14);
				$pdf->SetDrawColor(255,230,24);
				$pdf->Rect(10, 100, 275, 85, '');//for rectangle box
				
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				 
				$pdf->text(15, 105,iconv('UTF-8','windows-1252','Je peux voir ces caractéristiques et tendances inhérentes au style'));
				$pdf->SetFont('Arial','B',14);
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(120, 105,iconv('UTF-8','windows-1252','JAUNE'));
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->text(138, 105,iconv('UTF-8','windows-1252','chez moi: '));
				
				//yellow box left side input text boxes
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 113,iconv('UTF-8','windows-1252','Caractéristiques'));
				$pdf->SetFont('Arial','',10);
				$pdf->Ln(106);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 120, 0.3, 0.3, 'ytx1');
				$pdf->TextField('blueboxtext1',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 122,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 130, 0.3, 0.3, 'ytx2');
				$pdf->TextField('blueboxtext2',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 132,'');
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 140, 0.3, 0.3, 'ytx3');
				$pdf->TextField('blueboxtext3',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 142,'');
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 152,iconv('UTF-8','windows-1252','Tendances'));
				$pdf->SetFont('Arial','',10);
				
				$pdf->Ln(19);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 159, 0.3, 0.3, 'ytx4');
				$pdf->TextField('blueboxtext4',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 161,'');
				
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 169, 0.3, 0.3, 'ytx5');
				$pdf->TextField('blueboxtext5',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 171,'');
				
				
				$pdf->Ln(10);
				$pdf->Cell(10,2,'');
				$pdf->Rect(15, 179, 0.3, 0.3, 'ytx6');
				$pdf->TextField('blueboxtext6',262,8,array('BorderColor'=>'white'));
				$pdf->text(15, 181,'');
				$pdf->Image('footer.png',10,190,275);
				
				break;
}


$pdf->AddPage("L");//page7 start

$pdf->SetTextColor(187, 187, 187); //header
$pdf->SetFont('Arial','',14);
$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
$pdf->SetTextColor(0, 0, 0); //black


$pdf->SetFont('Arial','',14);
$pdf->text(10, 30,iconv('UTF-8','windows-1252','Pour bien retenir ce que vous avez appris'));

  
$pdf->SetFont('Arial','',10);
$pdf->text(10, 40,iconv('UTF-8','windows-1252','Pensez à un des membres de votre équipe avec lequel vous souhaiteriez améliorer vos relations. Gardez cette personne à l’esprit lorsque vous suivez'));

$pdf->text(10, 45,iconv('UTF-8','windows-1252','le cours en ligne « Styles de communication : Adapter le vôtre ».'));

$pdf->SetFont('Arial','',14);
$pdf->text(10, 65,iconv('UTF-8','windows-1252','Posez-vous les questions suivantes :'));

$pdf->SetFont('Arial','',10);
$pdf->SetDrawColor(0,0,0);
$pdf->Rect(10, 73, 0.3, 0.3, '');//for bullet point
$pdf->text(15, 75,iconv('UTF-8','windows-1252','Selon vous, quelle est la couleur dominante de cette personne?'));

$pdf->Ln(70);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx1',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 88,'____________________________________________________________________________________________________________________________________________');


$pdf->Ln(10);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx2',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 98,'____________________________________________________________________________________________________________________________________________');

$pdf->SetFont('Arial','',10);
$pdf->SetDrawColor(0,0,0);
$pdf->Rect(10, 111, 0.3, 0.3, 1, '');//for bullet point
 
$pdf->text(15, 113,iconv('UTF-8','windows-1252','Quelle que soit votre couleur dominante, vous partagez aussi des traits avec les 3 autres couleurs. Pour entretenir de meilleures relations avec cette'));

$pdf->text(15, 118,iconv('UTF-8','windows-1252','personne, qu\'avez-vous besoin de faire en plus ou en moins (voir le tableau de la page suivante pour d\'autres idées)?'));
$pdf->text(20, 123,'');

$pdf->Ln(36);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx3',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 134,'____________________________________________________________________________________________________________________________________________');
$pdf->Ln(10);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx4',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 144,'____________________________________________________________________________________________________________________________________________');
$pdf->Ln(10);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx15',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 154,'____________________________________________________________________________________________________________________________________________');
$pdf->Ln(10);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx6',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 164,'____________________________________________________________________________________________________________________________________________');
$pdf->Ln(10);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx7',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 174,'____________________________________________________________________________________________________________________________________________');

$pdf->Ln(10);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx8',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 184,'____________________________________________________________________________________________________________________________________________');


$pdf->Image('footer.png',10,190,275);

$pdf->AddPage("L");//page8 start
$pdf->SetTextColor(187, 187, 187); //header
$pdf->SetFont('Arial','',14);
$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
$pdf->SetTextColor(0, 0, 0); //black



$pdf->SetFont('Arial','',14);
$pdf->text(10, 30,iconv('UTF-8','windows-1252','Plan d’action pour apprendre à adapter votre style : 1. Passez en revue ces stratégies'));


				$pdf->SetDrawColor(204, 0, 0); //red
				$pdf->Rect(10, 35, 135, 76, '');//for rectangle box
				$pdf->SetTextColor(0, 0, 0);
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 42,iconv('UTF-8','windows-1252','Communiquer avec une personne de style'));
				$pdf->SetFont('Arial','B',14);
				
				$pdf->SetTextColor(204, 0, 0); //red
				$pdf->text(110, 42,iconv('UTF-8','windows-1252','ROUGE'));
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 47, 0.2, 0.2, '');
				$pdf->text(20, 48,iconv('UTF-8','windows-1252','Soyez clair, précis et direct. Ne vous éloignez pas du sujet en cause.'));
				
				$pdf->Rect(15, 51, 0.2, 0.2, '');
				$pdf->text(20, 52,iconv('UTF-8','windows-1252','Soyez préparé en ayant rassemblé tout ce qu\'il vous faut, tous les objectifs et tout le'));                $pdf->text(20, 56,iconv('UTF-8','windows-1252','matériel de soutien.'));
				
				$pdf->Rect(15, 59, 0.2, 0.2, '');
				$pdf->text(20, 60,iconv('UTF-8','windows-1252','Présentez les faits de manière logique; planifiez votre communication efficacement.'));
				
				$pdf->Rect(15, 63, 0.2, 0.2, '');
				$pdf->text(20, 64,iconv('UTF-8','windows-1252','Posez des questions précises (commençant de préférence par « quel »).'));
				
				$pdf->Rect(15, 67, 0.2, 0.2, '');
				$pdf->text(20, 68,iconv('UTF-8','windows-1252','Donnez des choix pour qu\'elle puisse prendre ses décisions.'));
				
				$pdf->Rect(15, 71, 0.2, 0.2, '');
				$pdf->text(20, 72,iconv('UTF-8','windows-1252','Présentez des faits et des chiffres relatifs à la probabilité de la réussite ou à l’efficacité des options'));
				
				$pdf->Rect(15, 75, 0.2, 0.2, '');
				$pdf->text(20, 76,iconv('UTF-8','windows-1252','En cas de désaccord, contestez les propos en amenant des faits.'));
				
				$pdf->Rect(15, 79, 0.2, 0.2, '');
				$pdf->text(20, 80,iconv('UTF-8','windows-1252','Faites en sorte que la situation ne fasse que des gagnants.'));
				
				$pdf->SetLineWidth(3);
				$pdf->SetDrawColor(204, 0, 0); //red
				$pdf->Rect(12, 86, 131, 2, '');//for rectangle box
				
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetLineWidth(1);
				
				$pdf->SetFont('Arial','B',12);
				$pdf->SetTextColor(255, 255, 255); //white
				$pdf->text(15, 88.5,iconv('UTF-8','windows-1252','Facteurs motivants '));
				
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 92, 0.2, 0.2, '');
				$pdf->text(20, 93,iconv('UTF-8','windows-1252','Résultats tangibles'));
				
				$pdf->Rect(15, 96, 0.2, 0.2, '');
				$pdf->text(20, 97,iconv('UTF-8','windows-1252','Défis quotidiens'));
				
				$pdf->Rect(15, 100, 0.2, 0.2, '');
				$pdf->text(20, 101,iconv('UTF-8','windows-1252','Prise de risques'));
				
				$pdf->Rect(15, 104, 0.2, 0.2, '');
				$pdf->text(20, 105,iconv('UTF-8','windows-1252','Décisions'));
				
				$pdf->Rect(15, 108, 0.2, 0.2, '');
				$pdf->text(20, 109,iconv('UTF-8','windows-1252','Réponses directes'));
				
							
				$pdf->SetFont('Arial','B',12);
				$pdf->SetTextColor(255, 255, 255); //white
				$pdf->text(80, 88.5,iconv('UTF-8','windows-1252','Facteurs démotivants'));
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(80, 92, 0.2, 0.2, '');
				$pdf->text(85, 93,iconv('UTF-8','windows-1252','Manque de défis'));
				
				$pdf->Rect(80, 96, 0.2, 0.2, '');
				$pdf->text(85, 97,iconv('UTF-8','windows-1252','Chefs hésitants'));
				
				$pdf->Rect(80, 100, 0.2, 0.2, '');
				$pdf->text(85, 101,iconv('UTF-8','windows-1252','Supervision trop serrée'));
				
				$pdf->Rect(80, 104, 0.2, 0.2, '');
				$pdf->text(85, 105,iconv('UTF-8','windows-1252','Réponses vagues'));
				
				$pdf->Rect(80, 108, 0.2, 0.2, '');
				$pdf->text(85, 109,iconv('UTF-8','windows-1252','Leadership faible'));






/*$pdf->SetDrawColor(255,230,24);// to be yellow
$pdf->Rect(150, 35, 135, 73, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);*/

/////////////////////////////////////////yellow box start///////////////////////////

$pdf->SetDrawColor(255,230,24); //yellow
				$pdf->Rect(150, 35, 135, 76, '');//for rectangle box
				$pdf->SetTextColor(0, 0, 0);
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(155, 42,iconv('UTF-8','windows-1252','Communiquer avec une personne de style'));
				$pdf->SetFont('Arial','B',14);
				
				$pdf->SetTextColor(255,230,24); //yellow
				$pdf->text(250, 42,iconv('UTF-8','windows-1252','JAUNE'));
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(155, 47, 0.2, 0.2, '');
				$pdf->text(160, 48,iconv('UTF-8','windows-1252','Planifiez une interaction qui appuie ses rêves et ses intentions.'));
				
				$pdf->Rect(155, 51, 0.2, 0.2, '');
				$pdf->text(160, 52,iconv('UTF-8','windows-1252','Allouez du temps pour établir une relation et pour socialiser.'));
				
				$pdf->Rect(155, 55, 0.2, 0.2, '');
				$pdf->text(160, 56,iconv('UTF-8','windows-1252','Parlez des gens et de leurs objectifs.'));
				
				$pdf->Rect(155, 59, 0.2, 0.2, '');
				$pdf->text(160, 60,iconv('UTF-8','windows-1252','Mettez l’accent sur les gens et les mesures à prendre. Écrivez les détails.'));
				
				$pdf->Rect(155, 63, 0.2, 0.2, '');
				$pdf->text(160, 64,iconv('UTF-8','windows-1252','Demandez-lui son opinion.'));
				
				$pdf->Rect(155, 67, 0.2, 0.2, '');
				$pdf->text(160, 68,iconv('UTF-8','windows-1252','Donnez des idées pour mettre en œuvre des mesures.'));
				
				$pdf->Rect(155, 71, 0.2, 0.2, '');
				$pdf->text(160, 72,iconv('UTF-8','windows-1252','Accordez-vous suffisamment de temps pour être stimulant, amusant et dynamique.'));
				
				$pdf->Rect(155, 75, 0.2, 0.2, '');
				$pdf->text(160, 76,iconv('UTF-8','windows-1252','Présentez des témoignages de gens qu’elle trouve importants.'));
				
				$pdf->Rect(155, 79, 0.2, 0.2, '');
				$pdf->text(160, 80,iconv('UTF-8','windows-1252','Offrez des primes spéciales, immédiates et supplémentaires pour'));
										
				$pdf->text(160, 84,iconv('UTF-8','windows-1252','récompenser sa volonté à prendre des risques.'));
				
				//$pdf->Rect(155, 83, 0.2, 0.2, '');
				//$pdf->text(160, 84,'hiiiiiiiiiiiiiiiii');
						
				
				
				$pdf->SetLineWidth(3);
				$pdf->SetDrawColor(255,230,24); //yellow
				$pdf->Rect(152, 86, 131, 2, '');//for rectangle box
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetLineWidth(1);
				
				$pdf->SetFont('Arial','B',12);
				$pdf->SetTextColor(255, 255, 255); //white
				$pdf->text(155, 88.5,iconv('UTF-8','windows-1252','Facteurs motivants'));
				
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(155, 92, 0.2, 0.2, '');
				$pdf->text(160, 93,iconv('UTF-8','windows-1252','Interaction avec les gens'));
				
				$pdf->Rect(155, 96, 0.2, 0.2, '');
				$pdf->text(160, 97,iconv('UTF-8','windows-1252','Félicitations et reconnaissance'));
				
				$pdf->Rect(155, 100, 0.2, 0.2, '');
				$pdf->text(160, 101,iconv('UTF-8','windows-1252','Esprit d’équipe'));
				
				$pdf->Rect(155, 104, 0.2, 0.2, '');
				$pdf->text(160, 105,iconv('UTF-8','windows-1252','Acceptation et appréciation'));
				
				$pdf->Rect(155, 108, 0.2, 0.2, '');
				$pdf->text(160, 109,iconv('UTF-8','windows-1252','Rencontre de nouvelles personnes'));
				
				
				
				$pdf->SetFont('Arial','B',12);
				$pdf->SetTextColor(255, 255, 255); //white
				$pdf->text(230, 88.5,iconv('UTF-8','windows-1252','Facteurs démotivants'));
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(230, 92, 0.2, 0.2, '');
				$pdf->text(235, 93,iconv('UTF-8','windows-1252','Moins d’occasions d’interagir'));
				
				$pdf->Rect(230, 96, 0.2, 0.2, '');
				$pdf->text(235, 97,iconv('UTF-8','windows-1252','Aucune reconnaissance'));
				
				$pdf->Rect(230, 100, 0.2, 0.2, '');
				$pdf->text(235, 101,iconv('UTF-8','windows-1252','Tenir à l\'écart'));
				
				$pdf->Rect(230, 104, 0.2, 0.2, '');
				$pdf->text(235, 105,iconv('UTF-8','windows-1252','Aucune appartenance à l\'équipe '));
				
			//	$pdf->Rect(230, 104, 0.2, 0.2, '');
				//$pdf->text(235, 105,'');

/////////////////////////////////////////blue box start///////////////////////////




/*$pdf->SetDrawColor(0,104,179); // to be blue
$pdf->Rect(10, 113, 135, 73, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);*/


$pdf->SetDrawColor(0,104,179); //blue
				$pdf->Rect(10, 113, 135, 75, '');//for rectangle box
				$pdf->SetTextColor(0, 0, 0);
				
				$pdf->SetFont('Arial','',14);
				$pdf->text(15, 120,iconv('UTF-8','windows-1252','Communiquer avec une personne de style'));
				$pdf->SetFont('Arial','B',14);
				
				$pdf->SetTextColor(0,104,179); //blue
				$pdf->text(110, 120,iconv('UTF-8','windows-1252','BLEU'));
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 125, 0.2, 0.2, '');
				$pdf->text(20, 126,iconv('UTF-8','windows-1252','Trouvez vos arguments à l’avance.'));
				
				$pdf->Rect(15, 129, 0.2, 0.2, '');
				$pdf->text(20, 130,iconv('UTF-8','windows-1252','Soyez clair et direct.'));
				
				$pdf->Rect(15, 133, 0.2, 0.2, '');
				$pdf->text(20, 134,iconv('UTF-8','windows-1252','Prenez votre temps, mais soyez tenace.'));
				
				$pdf->Rect(15, 137, 0.2, 0.2, '');
				$pdf->text(20, 138,iconv('UTF-8','windows-1252','En cas de désaccord, étayez votre point de vue à l’aide de données, de faits ou de '));
				$pdf->text(20, 142,iconv('UTF-8','windows-1252','témoignages de gens respectés.'));
				
				$pdf->Rect(15, 145, 0.2, 0.2, '');
				$pdf->text(20, 146,iconv('UTF-8','windows-1252','Donnez-lui les renseignements et le temps dont elle a besoin pour prendre une décision.'));
				
				$pdf->Rect(15, 149, 0.2, 0.2, '');
				$pdf->text(20, 150,iconv('UTF-8','windows-1252','Donnez-lui de l’espace.'));
				
				$pdf->Rect(15, 153, 0.2, 0.2, '');
				$pdf->text(20, 154,iconv('UTF-8','windows-1252','Utilisez une approche réfléchie. Établissez votre crédibilité en tenant compte de tous les'));
				$pdf->text(20, 158,iconv('UTF-8','windows-1252',' aspects du problème.'));
				
				//$pdf->Rect(15, 154, 0.2, 0.2, '');
				//$pdf->text(20, 155,'Provide a win/win opportunity.');
				
				//$pdf->Rect(15, 158, 0.2, 0.2, '');
				//$pdf->text(20, 159,'hiiiiiiiiiiiiiiiii');
				
				//$pdf->Rect(15, 162, 0.2, 0.2, '');
				//$pdf->text(20, 163,'hiiiiiiiiiiiiiiiii');
				
				$pdf->SetLineWidth(3);
				$pdf->SetDrawColor(0,104,179); //blue
				$pdf->Rect(12, 166, 131, 2, '');//for rectangle box
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetLineWidth(1);
				
				$pdf->SetFont('Arial','B',12);
				$pdf->SetTextColor(255, 255, 255); //white
				$pdf->text(15, 168.5,iconv('UTF-8','windows-1252','Facteurs motivants '));
				
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(15, 173, 0.2, 0.2, '');
				$pdf->text(20, 174,iconv('UTF-8','windows-1252','Environnement structuré'));
				
				
				$pdf->Rect(15, 177, 0.2, 0.2, '');
				$pdf->text(20, 178,iconv('UTF-8','windows-1252','Résultats liés aux systèmes et à la qualité'));

                $pdf->Rect(15, 181, 0.2, 0.2, '');
				$pdf->text(20, 182,iconv('UTF-8','windows-1252','Procédures normalisées d’exploitation'));

                 $pdf->Rect(15, 185, 0.2, 0.2, '');
				 $pdf->text(20, 186,iconv('UTF-8','windows-1252','Sécurité des avantages de base'));
			
				
				$pdf->SetFont('Arial','B',12);
				$pdf->SetTextColor(255, 255, 255); //white
				$pdf->text(80, 168.5,iconv('UTF-8','windows-1252','Facteurs démotivants'));
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
		        $pdf->Rect(80, 173, 0.2, 0.2, '');
				$pdf->text(85, 174,iconv('UTF-8','windows-1252','Critique constante'));
				
				
				$pdf->Rect(80, 177, 0.2, 0.2, '');
				$pdf->text(85, 178,iconv('UTF-8','windows-1252','Manque de procédures, de qualité, d\'équité'));

                $pdf->Rect(80, 181, 0.2, 0.2, '');
				$pdf->text(85, 182,iconv('UTF-8','windows-1252','Changements aux règles'));

                 $pdf->Rect(80, 185, 0.2, 0.2, '');
				 $pdf->text(85, 186,iconv('UTF-8','windows-1252','Trop peu de systèmes éprouvés'));
				
				///////////////////////green box start//////////////////////////

/*$pdf->SetDrawColor(118,185,0);//to be green
$pdf->Rect(150, 113, 135, 73, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);*/
$pdf->SetDrawColor(118,185,0); //green
				$pdf->Rect(150, 113, 135, 75, '');//for rectangle box
				$pdf->SetTextColor(0, 0, 0);
				
				$pdf->SetFont('Arial','',14);
				 
				$pdf->text(155, 120,iconv('UTF-8','windows-1252','Communiquer avec une personne de style'));
				$pdf->SetFont('Arial','B',14);
				
				$pdf->SetTextColor(118,185,0); //green
				$pdf->text(250, 120,iconv('UTF-8','windows-1252','VERT'));
				$pdf->SetFont('Arial','',14);
				$pdf->SetTextColor(0, 0, 0); //black
				
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(155, 125, 0.2, 0.2, '');
				$pdf->text(160, 126,iconv('UTF-8','windows-1252','Commencez par des commentaires personnels. Brisez la glace.'));
				
				$pdf->Rect(155, 129, 0.2, 0.2, '');
				$pdf->text(160, 130,iconv('UTF-8','windows-1252','Démontrez-lui un intérêt sincère en tant que personne.'));
				
				$pdf->Rect(155, 133, 0.2, 0.2, '');
				$pdf->text(160, 134,iconv('UTF-8','windows-1252','Cherchez à connaître ses objectifs et ses idées personnels avec patience.'));
				
				$pdf->Rect(155, 137, 0.2, 0.2, '');
				$pdf->text(160, 138,iconv('UTF-8','windows-1252','Écoutez et soyez réceptif.'));
				
				$pdf->Rect(155, 141, 0.2, 0.2, '');
				$pdf->text(160, 142,iconv('UTF-8','windows-1252','Présentez vos arguments de façon logique, à voix basse et sans l’intimider.'));
				
				$pdf->Rect(155, 145, 0.2, 0.2, '');
				$pdf->text(160, 146,iconv('UTF-8','windows-1252','Posez des questions précises (commençant de préférence par « comment »).'));
				
				$pdf->Rect(155, 149, 0.2, 0.2, '');
				$pdf->text(160, 150,iconv('UTF-8','windows-1252','Bouger naturellement, de manière informelle.'));
				
				$pdf->Rect(155, 153, 0.2, 0.2, '');
				$pdf->text(160, 154,iconv('UTF-8','windows-1252','Si la situation la touche personnellement, recherchez les sentiments qui l’ont blessée.'));
				
				
				$pdf->Rect(155, 157, 0.2, 0.2, '');
				$pdf->text(160, 158,iconv('UTF-8','windows-1252','Rassurez-la et garantissez-lui votre soutien.'));
				
				
				$pdf->Rect(155, 161, 0.2, 0.2, '');
				$pdf->text(160, 162,iconv('UTF-8','windows-1252','Si elle doit prendre une décision, accordez-lui du temps pour réfléchir.'));
				
				$pdf->SetLineWidth(3);
				$pdf->SetDrawColor(118,185,0); //green
				$pdf->Rect(152, 166, 131, 2, '');//for rectangle box
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetLineWidth(1);
				
				$pdf->SetFont('Arial','B',12);
				$pdf->SetTextColor(255, 255, 255); //white
				$pdf->text(155, 168.5,iconv('UTF-8','windows-1252','Facteurs motivants '));
				
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(155, 173, 0.2, 0.2, '');
				$pdf->text(160, 174,iconv('UTF-8','windows-1252','Harmonie et collaboration'));
				
				$pdf->Rect(155, 177, 0.2, 0.2, '');
				$pdf->text(160, 178,iconv('UTF-8','windows-1252','Rythme établi'));
				
				$pdf->Rect(155, 181, 0.2, 0.2, '');
				$pdf->text(160, 182,iconv('UTF-8','windows-1252','Contribution aux objectifs globaux'));
				
				$pdf->Rect(155, 185, 0.2, 0.2, '');
				$pdf->text(160, 186,iconv('UTF-8','windows-1252','Structure stable'));
				
				//$pdf->Rect(155, 189, 0.2, 0.2, '');
				//$pdf->text(160, 190,'Direct answers');
								
				
				$pdf->SetFont('Arial','B',12);
				$pdf->SetTextColor(255, 255, 255); //white
				$pdf->text(230, 168.5,iconv('UTF-8','windows-1252','Facteurs démotivants'));
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0, 0, 0); //black
				$pdf->SetDrawColor(0, 0, 0);
				
				$pdf->Rect(230, 173, 0.2, 0.2, '');
				$pdf->text(235, 174,iconv('UTF-8','windows-1252','	Contraintes de temps de dernière minute'));
				
				$pdf->Rect(230, 177, 0.2, 0.2, '');
				$pdf->text(235, 178,iconv('UTF-8','windows-1252','Conflits de personnalités'));
				
				$pdf->Rect(230, 181, 0.2, 0.2, '');
				$pdf->text(235, 182,iconv('UTF-8','windows-1252','Attentes trop élevées ou imprécises'));
				
				$pdf->Rect(230, 185, 0.2, 0.2, '');
				$pdf->text(235, 186,iconv('UTF-8','windows-1252','Changements soudains'));


//$pdf->Image('boxes.jpg',10,30,200);


$pdf->Image('footer.png',10,190,275);
$pdf->AddPage("L");//page9 start

$pdf->SetTextColor(187, 187, 187); //header
$pdf->SetFont('Arial','',14);
$pdf->text(10, 15,iconv('UTF-8', 'windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
$pdf->SetTextColor(0, 0, 0); //black

$pdf->text(10, 30, iconv('UTF-8', 'windows-1252','Plan d’action pour apprendre à adapter votre style : 2. Associez un visage à une couleur'));
$pdf->SetFont('Arial','',10);
 
$pdf->text(10, 40,iconv('UTF-8', 'windows-1252','Pour vous rappeler les traits clés des quatre styles de communication, pensez à certaines personnes connues (personnages historiques, célébrités ou même, personnages de fiction)'));
$pdf->text(10, 45,iconv('UTF-8', 'windows-1252',' qui présentent ces traits. En d’autres termes, associez un visage à une couleur!'));

$pdf->SetDrawColor(204, 0, 0); //red

$pdf->Rect(10, 50, 135, 60, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);


$pdf->SetDrawColor(255,230,24);// to be yellow
$pdf->Rect(150, 50, 135, 60, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);

$pdf->SetDrawColor(0,0,0); // black bullet
//for green
$pdf->SetFont('Arial','', 14);
$pdf->Rect(155, 55, 0.3, 0.3, '');
$pdf->text(160, 57,iconv('UTF-8', 'windows-1252','Jim Carrey'));

//for red

$pdf->SetFont('Arial','',14);
$pdf->Rect(15, 55, 0.3, 0.3, '');
$pdf->text(20, 57,iconv('UTF-8', 'windows-1252','Winston Churchill'));



$pdf->SetDrawColor(0,104,179); // to be blue
$pdf->Rect(10, 120, 135, 60, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);

$pdf->SetDrawColor(0,0,0); // black bullet
$pdf->SetFont('Arial','', 14);
$pdf->Rect(15, 125, 0.3, 0.3, '');
$pdf->text(20, 127,iconv('UTF-8', 'windows-1252','Capitaine Spock de Star Trek '));

//for red 
$pdf->Ln(60);
$pdf->Cell(10,2,'');
$pdf->Rect(15, 75, 0.3, 0.3, '');
$pdf->TextField('redtxin1',120,8,array('BorderColor'=>'white'));


//for green 

$pdf->Ln(0);
$pdf->Cell(150,2,'');
$pdf->Rect(155, 75, 0.3, 0.3, '');
$pdf->TextField('greentxin1',120,8,array('BorderColor'=>'white'));

//for red 
$pdf->SetDrawColor(0,0,0); // black bullet
$pdf->Ln(20);
$pdf->Cell(10,2,'');
$pdf->Rect(15, 95, 0.3, 0.3, '');
$pdf->TextField('redtxin2',120,8,array('BorderColor'=>'white'));

//for green 
$pdf->Cell(20,2,'');
$pdf->Rect(155, 95, 0.3, 0.3, '');
$pdf->TextField('greentextin2',120,8,array('BorderColor'=>'white'));


//for blue
$pdf->SetDrawColor(118,185,0);//to be green
$pdf->Rect(150, 120, 135, 60, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(0,0,0); // black bullet
$pdf->SetFont('Arial','', 14);
$pdf->Rect(155, 125, 0.3, 0.3, '');
$pdf->text(160, 127,iconv('UTF-8', 'windows-1252','Dalaï-lama'));

//for  yellow
$pdf->Ln(50);
$pdf->Cell(10,2,'');
$pdf->Rect(15, 145, 0.3, 0.3, '');
$pdf->TextField('yellowtxin1',120,8,array('BorderColor'=>'white'));

//for blue
$pdf->Cell(20,2,'');
$pdf->Rect(155, 145, 0.3, 0.3, '');
$pdf->TextField('bluetxin1',120,8,array('BorderColor'=>'white'));


//for  yellow
$pdf->Ln(20);
$pdf->Cell(10,2,'');
$pdf->Rect(15, 165, 0.3, 0.3, '');
$pdf->TextField('yellowtextin2',120,8,array('BorderColor'=>'white'));

//for blue
$pdf->Cell(20,2,'');
$pdf->Rect(155, 165, 0.3, 0.3, '');
$pdf->TextField('bluetextin2',120,8,array('BorderColor'=>'white'));


/*
$pdf->SetDrawColor(118,185,0); //green
$pdf->Rect(150, 50, 135, 60, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('Arial','', 14);
$pdf->Rect(155, 55, 0.3, 0.3, '');
$pdf->text(160, 57,'Star Trek\'s Dr. Spock');

$pdf->Ln(23);
$pdf->Cell(160,2,'');
$pdf->Rect(155, 75, 0.3, 0.3, '');
$pdf->TextField('greentxin1',120,8,array('BorderColor'=>'white'));

$pdf->Ln(10);
$pdf->Cell(160,2,'');
$pdf->Rect(155, 95, 0.3, 0.3, '');
$pdf->TextField('greentextin2',120,8,array('BorderColor'=>'white'));*/



/*$pdf->SetDrawColor(0,104,179); //blue
$pdf->Rect(150, 120, 135, 60, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('Arial','', 14);
$pdf->Rect(155, 125, 0.3, 0.3, '');
$pdf->text(160, 127,'Dalai Lama');

$pdf->Ln(0);
$pdf->Cell(160,2,'');
$pdf->Rect(155, 145, 0.3, 0.3, '');
$pdf->TextField('bluetxin1',120,8,array('BorderColor'=>'white'));


$pdf->Ln(10);
$pdf->Cell(160,2,'');
$pdf->Rect(155, 165, 0.3, 0.3, '');
$pdf->TextField('bluetextin2',262,8,array('BorderColor'=>'white'));
*/
$pdf->Image('footer.png',10,190,275);


$pdf->AddPage("L");//page10 start

$pdf->SetLineWidth(1);
$pdf->SetTextColor(187, 187, 187); //header
$pdf->SetFont('Arial','',14);
$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));


$pdf->SetLineWidth(0.10);
$pdf->SetTextColor(0, 0, 0); //black

$pdf->SetDrawColor(0, 0, 0);
$pdf->Rect(10, 35, 275, 152, '');//for rectangle box



$pdf->text(10, 30, iconv('UTF-8','windows-1252','Plan d\'action pour apprendre à adapter votre style : 3.Commencez par un petit changement'));

$pdf->SetFont('Arial','',10);


$pdf->text(15, 45,iconv('UTF-8','windows-1252','Mon style dominant, ou ma « couleur », est :['));
if($data[0]['color']=='blue'){
	
	$pdf->SetTextColor(0,104,179);
	$dominantcolor="BLEU";
	$positionset=88;
	$lastbracPos=105;
	$flextext=131;
	$flexnext=137.5;
	
	$pdf->SetTextColor(204, 0, 0);
	$dominantcolor="ROUGE";
	$positionset=86;
	$lastbracPos=105;
	$flextext=131;
	$flexnext=137.5;
	
	
	}
	if($data[0]['color']=='green'){
	$pdf->SetTextColor(0,185,0);
	$dominantcolor="VERT";
    $positionset=88;
	$lastbracPos=105;
	$flextext=131;
	$flexnext=137.5;
	}
	if($data[0]['color']=='yellow'){
	$pdf->SetTextColor(255,230,24);
	$dominantcolor="JAUNE";
	$positionset=88;
	$lastbracPos=108;
	$flextext=141;
	$flexnext=148;	
	}
	
	if($data[0]['color']=='red'){
    $pdf->SetTextColor(204, 0, 0);
	$dominantcolor="ROUGE";
	$positionset=86;
	$lastbracPos=105;
	$flextext=131;
	$flexnext=137.5;
	}
$pdf->SetFont('Arial','B',14);
$pdf->text($positionset, 45, $dominantcolor);
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('Arial','',10);
$pdf->text($lastbracPos,45,iconv('UTF-8','windows-1252',']. Une chose simple que je pourrais faire pour adapter mon style est :'));

//$pdf->SetDrawColor(204, 0, 0); //red

$pdf->Rect(10, 50, 275, 35, '');//for rectangle box
$pdf->Rect(165, 50, 0, 137, '');//for vertical line
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('Arial','',10);

$pdf->text(15, 70,iconv('UTF-8','windows-1252','Lorsque je communique avec un'));
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(204, 0, 0);
$pdf->text(65, 70,iconv('UTF-8','windows-1252',' ROUGE '));
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->text(85, 70,iconv('UTF-8','windows-1252',',  je pourrais adapter mon style « naturel » en…'));

$pdf->Ln(50);
$pdf->Cell(133,2,'');
$pdf->TextField('redtxinn1',140,8,array('BorderColor'=>'white'));

$pdf->Ln(10);
$pdf->Cell(133,2,'');

$pdf->TextField('redtxinn2',140,8,array('BorderColor'=>'white'));

//$pdf->SetDrawColor(255,230,24); //yellow
$pdf->Rect(10, 85, 275, 35, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);

$pdf->text(15, 105,iconv('UTF-8','windows-1252','Lorsque je communique avec un'));
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,230,24);
$pdf->text(67, 105,'JAUNE');
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->text(85, 105,iconv('UTF-8','windows-1252',',  je pourrais adapter mon style « naturel » en…'));

$pdf->Ln(26);
$pdf->Cell(133,2,'');

$pdf->TextField('yellowtxinn1',140,8,array('BorderColor'=>'white'));

$pdf->Ln(10);
$pdf->Cell(133,2,'');

$pdf->TextField('yellowtextinn2',140,8,array('BorderColor'=>'white'));

//$pdf->SetDrawColor(0,185,0); //green
$pdf->Rect(10, 120, 275, 35, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);
$pdf->text(15, 140,iconv('UTF-8','windows-1252','Lorsque je communique avec un'));

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(0,185,0);
$pdf->text(67, 140,'VERT');
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->text(80, 140,iconv('UTF-8','windows-1252',',  je pourrais adapter mon style « naturel » en…'));

$pdf->Ln(25);
$pdf->Cell(133,2,'');

$pdf->TextField('greentxinn1',140,8,array('BorderColor'=>'white'));

$pdf->Ln(10);
$pdf->Cell(133,2,'');

$pdf->TextField('greentextinn2',140,8,array('BorderColor'=>'white'));


//$pdf->SetDrawColor(0,104,179); //blue
$pdf->Rect(10, 155, 275, 32, '');//for rectangle box
$pdf->SetTextColor(0, 0, 0);



$pdf->text(15, 175,iconv('UTF-8','windows-1252','Lorsque je communique avec un'));

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(0,104,179);
$pdf->text(67, 175,'BLEU');
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->text(80, 175,iconv('UTF-8','windows-1252',',  je pourrais adapter mon style « naturel » en…'));

$pdf->Ln(25);
$pdf->Cell(133,2,'');

$pdf->TextField('bluetxinn1',140,8,array('BorderColor'=>'white'));

$pdf->Ln(10);
$pdf->Cell(133,2,'');

$pdf->TextField('bluetextinn2',140,8,array('BorderColor'=>'white'));


$pdf->Image('footer.png',10,190,275);
$pdf->AddPage("L");//page11 start


$pdf->SetTextColor(187, 187, 187); //header
$pdf->SetFont('Arial','',14);
$pdf->text(10, 15,iconv('UTF-8','windows-1252','Styles de communication : Rapport de profil personnel et plan d\'action'));
$pdf->SetTextColor(0, 0, 0); //black


$pdf->SetFont('Arial','',14);

$pdf->text(10, 30, iconv('UTF-8','windows-1252','Plan d’action pour apprendre à adapter votre style : 4. Prenez du recul'));

 

$pdf->SetFont('Arial','',10);
$pdf->text(10, 40,iconv('UTF-8','windows-1252','Parfois, la façon dont nous nous percevons est différente de la façon dont les autres nous perçoivent. Distribuez ce document à certains de vos collègues, des membres de votre '));
$pdf->text(10, 45,iconv('UTF-8','windows-1252','famille et de vos amis pour connaître leur point de vue sur vos styles de communication dominants. Vous pourriez être surpris de voir à quel point vous adaptez déjà votre style!'));

$pdf->SetFont('Arial','',14);
$pdf->text(10, 65,iconv('UTF-8','windows-1252','Point de vue des collègues'));


$pdf->SetFont('Arial','',10);
$pdf->SetDrawColor(0,0,0);

$pdf->text(10, 75,iconv('UTF-8','windows-1252','Quand je suis au travail, mon style de communication principal est :'));

$pdf->Ln(68);
$pdf->Cell(1,2,'');
$pdf->TextField('pagetxt11',275,8,array('BorderColor'=>'white'));

$pdf->text(11, 86,'____________________________________________________________________________________________________________________________________________');

$pdf->Ln(10);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx2',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 96,'____________________________________________________________________________________________________________________________________________');


$pdf->SetFont('Arial','',14);
$pdf->text(10, 105,iconv('UTF-8','windows-1252','Point de vue de la famille'));

$pdf->SetFont('Arial','',10);
$pdf->SetDrawColor(0,0,0);

$pdf->text(10, 115,iconv('UTF-8','windows-1252','Quand je suis à la maison, mon style de communication principal est :'));

$pdf->Ln(30);
$pdf->Cell(1,2,'');
$pdf->TextField('pagetxt11',275,8,array('BorderColor'=>'white'));

$pdf->text(11, 126,'____________________________________________________________________________________________________________________________________________');

$pdf->Ln(10);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx2',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 136,'____________________________________________________________________________________________________________________________________________');


$pdf->SetFont('Arial','',14);
$pdf->text(10, 145,iconv('UTF-8','windows-1252','Point de vue des amis'));

$pdf->SetFont('Arial','',10);
$pdf->SetDrawColor(0,0,0);

$pdf->text(10, 155,iconv('UTF-8','windows-1252','Quand je suis avec des amis, mon style de communication principal est :'));

$pdf->Ln(30);
$pdf->Cell(1,2,'');
$pdf->TextField('pagetxt11',275,8,array('BorderColor'=>'white'));

$pdf->text(11, 166,'____________________________________________________________________________________________________________________________________________');

$pdf->Ln(10);
$pdf->Cell(1,2,'');
$pdf->TextField('p7tx2',275,8,array('BorderColor'=>'white'));
$pdf->text(11, 176,'____________________________________________________________________________________________________________________________________________');

$pdf->Image('footer.png',10,190,275);
//Form validation functions
$pdf->script.="
function Print()
{	print();
}
";

//We include all the generated JavaScript code into the PDF
$pdf->IncludeJS($pdf->script);

//$pdf->Output();//by madhu to be close
//$pdffilename = $name."_".$red_score."_".$blue_score."_".$green_score."_".$yellow_score."_".time(); //v1

$pdffilename = 'report';//$name."_".$red_score."_".$blue_score."_".$green_score."_".$yellow_score;

$pdf->Output($pdffilename.'.pdf', 'F');
//$pdf->Output();
header("location:".$pdffilename.".pdf");

/*if(!empty($_REQUEST['emailid']))
{
require_once('mail-send/class.phpmailer.php');
$mail = new PHPMailer(); // create a new object
//$mail->SetFrom("noreply@commlabindia.com");
$mail->SetFrom("noreply@mindmuze.com");
$mail->Subject = "Communication Styles: Your Personalized Report";
$mail->AddAttachment($pdffilename.".pdf");
$mail->Body = "Please see the above attached file"; 
$mail->AddAddress($_REQUEST['emailid']);
$mail->AddBCC("brad.houle@mindmuze.com");
$mail->AddBCC("john.towsley@bwyze.com");
 if(!$mail->Send())
    {
    echo "Mailer Error: ". $mail->ErrorInfo;
    }
    else
    {
 echo '<p style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">Your report has been sent. Please close this window to return to the course window which is still open in another window.</p>';
    }
 }
//$pdf->Output();
*/

	
//unlink($pdffilename.'.pdf');


?>

