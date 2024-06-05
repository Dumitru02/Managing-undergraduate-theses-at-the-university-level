<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../db.php';

if (isset($_POST['email'])) {

    $emailTo = $_POST['email']; 
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    $code = uniqid(true); // true for more uniqueness 
	
	$query = 'SELECT email 
				FROM users WHERE email=?';
	
	$m = '';
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param("s", $_POST['email']);
		$stmt->bind_result($ml);
		$stmt->execute();
		while($stmt->fetch())
			$m = $ml;
		$stmt->close();
	}
	
	if (empty($m)) {
		exit('Adresa de mail nu este înregistrată!');
	}

	

    //for each sent email there'll be an entry in the resetPasswords table
    $query = mysqli_query($con,"INSERT INTO resetPasswords (code, email) VALUES('$code','$emailTo')"); 
    if (!$query) {
       exit('Error'); 
    }
    try {
        //Server settings
        $mail->SMTPDebug = 0;     // Enable verbose debug output, 1 for produciton , 2,3 for debuging in devlopment 
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication

        //username and password for the free gmail account which sends the emails
        $mail->Username = 'marianadumitru459@gmail.com';                 
        $mail->Password = 'jdqmrfeefkjjlbkj';                          

        // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        // $mail->Port = 587;   // for tls                                 // TCP port to connect to
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('office@licenta.ro', 'Resetare parolă'); // from who? 
        $mail->addAddress($emailTo, 'Utilizator');     // Add a recipient

        $mail->addReplyTo('no-replay@example.com', 'No Replay');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Content
        // this give you the exact link of you site in the right page 
        // if you are in actual web server, instead of http://" . $_SERVER['HTTP_HOST'] write your link 
        $url = "http://" . $_SERVER['HTTP_HOST'] . "/Licenta/Mail/mail.php?code=$code"; 
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Link resetare parola Licenta Cristache';
        $mail->Body    = "<h1> Solicitare resetare parola </h1>
                         Apasati pe  <a href='$url'>acest link</a> si urmariti pașii pentru o nouă parolă.";
        
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // to solve a problem 
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );


        $mail->send();
        echo 'mail_sent';
    } catch (Exception $e) {
        echo 'Mail-ul nu a fost trimis. Eroare: ', $mail->ErrorInfo;
    }

    exit(); // to stop user from submitting more than once 
}
else
    echo "Eroare 9200 la trimiterea mail-ului!";

?>
