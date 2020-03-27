<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['email'])) {
    
    $ime_prezime = $_POST['ime_prezime'];
    $poruka = $_POST['poruka'];
    $email = $_POST['email'];

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


// Load Composer's autoloader
require 'vendor/autoload.php';


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


try {
    date_default_timezone_set('Europe/Belgrade');
    $date = date('d.m.Y - H:i', time());
    
    
//  Server settings
//  $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'mail.milosh.rs';   
    $mail->Port       = 587;                                    // TCP port to connect to

    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $to;         // SMTP username
    $mail->Password   = $pass;                         // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
 
    //Recipients
    $mail->setFrom($email, 'KONTAKT SA MILOSH.RS');
    
    $mail->addAddress($to);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = ' Kontakt - ' . $date;
    
    // Message
    $message = '
    <body style="width: 100%;height: 100%; display: flex;align-items: center; justify-content: center;">
        <h1>
            '.$ime_prezime.'<br>
            '.$email.'<br>
            '.$poruka.'
        </h1>
    </body>
    ';
    
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);
    
    if ($mail->Send()) { 
      //echo '  <script>alert("Uspešno ste pounili formu.\nKontaktiraćemo Vas u najkraćem mogućem roku.")</script> ';

    }

   

} catch (Exception $e) {
    echo $e;
    //echo ' <script>alert("Došlo je do problema prilikom slanja podataka iz forme.\nMolimo Vas da pokušajte ponovo.")</script> ';

}
    
}
  ?>
  