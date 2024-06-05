<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../db.php';

    session_start();
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $phone = $_POST['phone'];
    $content = $_POST['content'];


    
    //if user logged in has the role 'prof' send email to the director email
    if ($_SESSION['role'] === 'prof') {

    
       $dep = $_SESSION['department'];
       $query = "SELECT email 
                 FROM users
                 WHERE role='director'
                 && department = $dep";
       if ($stmt = $con -> prepare($query)) {
            $stmt->bind_result($mail);
            $stmt->execute();
            while ($stmt->fetch())
                $emailTo = $mail;
            $stmt->close();
       }
       
 
    }
    //if user logged in has the role 'director' send email to the admin email
    if ($_SESSION['role'] === 'director') {
       $query = "SELECT email 
                 FROM users
                 WHERE role='admin'
                 && department = $dep";

       if ($stmt = $con -> prepare($query)) {
            $stmt->bind_result($mail);
            $stmt->execute();
            while ($stmt->fetch())
                $emailTo = $mail;
            $stmt->close();
       }
    }

    
	
	
	
	

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

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
        $mail->setFrom($_SESSION['email'], $first_name . ' ' . $last_name); // from who? 
        $mail->addAddress($emailTo, 'Destinatar');     // Add a recipient

        $mail->addReplyTo('no-replay@example.com', 'No Replay');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Mesaj de contact';
        $mail->Body    = "<h1>  </h1>
                          <p>Continut: $content</p> <p> Telefonul expeditorului: $phone </p> ";
        
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
        exit(); // to stop user from submitting more than once 
    } catch (Exception $e) {
        echo 'Mail-ul nu a fost trimis. Eroare: ', $mail->ErrorInfo;
        exit(); // to stop user from submitting more than once 
    }


    echo "Eroare 9200 la trimiterea mail-ului!";
    exit(); // to stop user from submitting more than once 

?>

