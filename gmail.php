<?php
function readMail() {

    $dns = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
    $email = "krishnabati@gmail.com";
    $password = "krishna83*";

    $openmail = imap_open($dns,$email,$password ) or die("Cannot Connect ".imap_last_error());
    if ($openmail) {

        echo  "You have ".imap_num_msg($openmail). " messages in your inbox";

        for($i=1; $i <= 100; $i++) {

            $header = imap_header($openmail,$i);
            echo "
";
            echo $header->Subject." (".$header->Date.")";
        }

        $msg = imap_fetchbody($openmail,1,"","FT_PEEK");

        /*
        $msgBody = imap_fetchbody ($openmail, $i, "2.1");
        if ($msgBody == "") {
           $portNo = "2.1";
           $msgBody = imap_fetchbody ($openmail, $i, $portNo);
        }

        $msgBody = trim(substr(quoted_printable_decode($msgBody), 0, 200));

        */
        echo $msg;
		
		echo "<br>";
		
        imap_close($openmail);
        
    } else {

        echo "Failed reading messages!!";

    }

}


 readMail();




?>

