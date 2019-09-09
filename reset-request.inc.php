<?php

require_once 'sendMailD.php';
$mailF = new sendMailD();
    try
    {
    	$url= "http://localhost/prince/WEB/reset.php";
		$message = '<p>Link to reset password is below</p>';
		$message .= '<p>Here is your link: </br>';
		$message .= '<a href="' . $url . '">' . $url . '</a></p>';

		$userEmail = $_GET["email"];//email id of recevr
            	$message= "
                           Hello , $userEmail
                           <br /><br />
                           We got request to change your password, if you have requested  then use the given link to reset your password, if not done by you just ignore this email,
                           <br /><br />
                           CLick the link to reset your password $message
                           <br /><br />
                           
                           <br /><br />
                           Thank you 
                           <br /><br />
                           IGniteX 
                           ";
                        $subject = "Password-Reset link";
                
                        $retv = $mailF->sendMail($userEmail,$message,$subject);

                        if($retv == "OK"){
                           
				echo "<h1>Mail sent!<h1><br>
				<p>Go to the link sent to change your password</p>";

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
      
    $mail->SetFrom('zalavadiaprich17ite@student.mes.ac.in','IGniteX');
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

