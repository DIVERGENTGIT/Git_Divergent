<?php 
    
include("dbconnect/config.php");  
        
$getUserID = $mysqli->query("select * from users where user_id not in (SELECT user_id FROM `credits_manager`) ");
  
if($getUserID->num_rows > 0)
{   
	while($userIDRes = $getUserID->fetch_array(MYSQLI_ASSOC)) {  
		$user_id =  $userIDRes['user_id'];  
		$username = $userIDRes['username'];
		$first_name = $userIDRes['first_name'];
		$mobile = $userIDRes['mobile'];  
		$email = $userIDRes['email'];  
		$previous_credits = $userIDRes['available_credits'];
		
		$getUserPrice = $mysqli->query("select price from user_payments WHERE user_id = '".$user_id."' AND no_of_sms >= '".$previous_credits."' AND payment_type = 1 AND price > 0  and  added_by = 1 ORDER BY payment_id DESC LIMIT 1 ");
		if($getUserPrice->num_rows > 0)
		{       
			$userPrice = $getUserPrice->fetch_array(MYSQLI_ASSOC);
			$prevoiusprice = $userPrice['price'];
		}  
		   
 
		if($previous_credits <= 99999) {
			$threshHoldPrice = '0.125';
		}else if($previous_credits > 99999 && $previous_credits < 999999) {
			$threshHoldPrice = '0.12';
		}else if($previous_credits > 999999 && $previous_credits < 1999999) {
			$threshHoldPrice = '0.115';
		}else if($previous_credits > 1999999) {
			$threshHoldPrice = '0.11';
		} 
		 
		if($prevoiusprice < $threshHoldPrice) {
			$newPrice = $threshHoldPrice;
		}else{
			$newPrice = $prevoiusprice; 
		}  
		   

		$newCredits = 0;
		  	
		//$addUserCreditsData = $mysqli->query("INSERT INTO credits_manager(user_id,username,previous_credits,previous_price,equivalent_amount,new_price,new_credits,email) VALUES ('".$user_id."','".$username."','".$previous_credits."','".$prevoiusprice."','".$equivalaentAmmount."','".$newPrice."','".$newCredits."','".$email."') "); 

 
 
	 	$mysqli->query("INSERT INTO user_payments (user_id,no_of_sms,price,payment_type,added_by,note) VALUES ('".$user_id."','".$newCredits."','".$newPrice."',1,1,'Deducted Credits On New SMS Price') ");  
 
 echo "INSERT INTO user_payments (user_id,no_of_sms,price,payment_type,added_by,note) VALUES ('".$user_id."','".$newCredits."','".$newPrice."',1,1,'Deducted Credits On New SMS Price') ";
 echo "</bR>"; echo "</bR>"; echo "</bR>";
		  
		//$mysqli->query("UPDATE users SET available_credits = '".$newCredits."' WHERE user_id = '".$user_id."' ");
	}
	
 
	
} 
   
 

 










       


?>
