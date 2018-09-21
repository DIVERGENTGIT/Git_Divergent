<?php
//mysql connection
$db = mysql_connect("localhost", "root", "myadmin");
mysql_select_db("sms", $db);

$out_string = "User ID \t User Name \t Available Credits\n";
//get clients, who have balances more than zero.
$sql = "SELECT user_id, username, available_credits FROM users WHERE available_credits > 0";
$rs = mysql_query($sql, $db);
if(mysql_num_rows($rs)>0){
    while($row = mysql_fetch_array($rs)){
        $user_id = $row['user_id'];
        $user_name = $row['username'];
        $available_credits = $row['available_credits'];

        //insert deduct balance record into user_payments
        $deduct_insert_sql = "INSERT INTO user_payments SET
            user_id = '$user_id',
            no_of_sms = '$available_credits',
            service_tax = 0,
            payment_type = 3,
            added_by = 1,
            on_date = NOW(),
            note = 'Deducted In the Part of Price Hikes'
        ";

        $deduct_rs = mysql_query($deduct_insert_sql, $db) or die(mysql_error());
        if($deduct_rs){
            //update balance to 0
            $update_sql = "UPDATE users SET available_credits = available_credits - $available_credits WHERE user_id = '$user_id'";
            $rs1 = mysql_query($update_sql, $db);
            if($rs1){
                $out_string .= "$user_id \t $user_name \t $available_credits\n";
            }
        }
    }
} else {
    echo "No Users";
}
//close connection
mysql_close($db);
echo $out_string;
?>