<?php

class Utils{

    function getToken($length=32){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
        }
        return $token;
    } // end getToken method
     
    function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    } // end crypto_rand_secure method

    function sendEmailViaPHPMailer($mail, $send_to_email, $subject, $body){
        try{

            // server settings
            $mail->SMTPDebug = "SMTP::DEBUG_SERVER";
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "flores.trimex@gmail.com";
            $mail->Password = "informationtechnology";
            $mail->SMTPSecure = "PHPMailer::ENCRYPTION_SMTPS";
            $mail->Port = "587";

            // recipient
            $mail->setFrom('flores.trimex@gmail.com' , 'E-SHOP');
            $mail->addAddress($send_to_email); 

            //content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            if($mail->send()){
                return true;
            }
            
            return false;

        }catch(Exception $e){
            echo "Message could not be sent. Mailer error: " . $mail->ErrorInfo;   
        }
    }
    

} 