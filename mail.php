<?php

require_once 'sendMailD.php';
$mailF = new sendMailD();
    try
    {
		$userOtpRCode = "2345";
		$userEmail = "zalavadiaprich17ite@student.mes.ac.in"; //email id of recevr
            	$message= "
                           Hello , $userEmail
                           <br /><br />
                           We got request to rgister your email id for  if you have requested  then use the one time verfification code to verify your email id, if not just ignore this email,
                           <br /><br />
                           Your one time verification code is  $userOtpRCode
                           <br /><br />
                           
                           <br /><br />
                           Thank you 
                           <br /><br />
                           PCE 
                           ";
                        $subject = "User verification";
                
                        $retv = $mailF->sendMail($userEmail,$message,$subject);

                        if($retv == "OK"){
                           
				echo "<h1>Mail sent!<h1>";

                        }
                        else {
                            echo "Mail not sent!";
                        }
            

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }


?>

<?php
class sendMailD
{ 

  private $conn;
  
  
  
  function sendMail($email,$message,$subject)
  {           
    require_once('PHPMailer/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->IsSMTP(); 
    $mail->SMTPDebug  = 0;                     
    $mail->SMTPAuth   = true;                  
    $mail->SMTPSecure = "ssl";                 
    $mail->Host       = "smtp.gmail.com";      
    $mail->Port       = 465;             
    $mail->AddAddress($email);
      
    $mail->Username="zalavadiaprich17ite@student.mes.ac.in";  
    $mail->Password="prince-2701";   
      
    $mail->SetFrom('zalavadiaprich17ite@student.mes.ac.in','PCE Software Team');
    $mail->Subject    = $subject;
    $mail->MsgHTML($message);
    if(!$mail->send()) {
        return "FAIL";
    } else {
          return "OK";
    }
    

  } 
}

?>