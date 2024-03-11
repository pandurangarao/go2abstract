

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\Soni-pro.github.io-main\PHPMailer\vendor\phpmailer\phpmailer\src\Exception.php';
require 'C:\xampp\htdocs\Soni-pro.github.io-main\PHPMailer\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\Soni-pro.github.io-main\PHPMailer\vendor\phpmailer\phpmailer\src\SMTP.php';

// Include or define the insert() function
// For the purpose of this example, I'll define a dummy insert() function
function insert($data) {
    // Perform database insertion here
    // Replace this with your actual database insertion logic
    return true; // Return true if insertion is successful, false otherwise
}



// //Set up the email headers
// $headers    = "From: $name <$emailHelp>\r\n";
// $headers   .= "Content-type: text/html; charset=iso-8859-1\r\n";
// $headers   .= "Message-ID: <".time().rand(1,1000)."@".$_SERVER['SERVER_NAME'].">". "\r\n"; 
   

if (isset($_POST["send"])) { // Check if the form is submitted
    if (insert($_POST)) { // Call the insert() function to insert form data into the database
    // if (isset($name) && isset($phone) && isset($emailHelp)) { // Call the insert() function to insert form data into the database
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'soniemail3397@gmail.com'; // Your Gmail
        $mail->Password = 'kupffocnofjvudih'; // Your Gmail app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        $mail->setFrom('soniemail3397@gmail.com', 'soni'); // Set sender email and name
        $mail->addAddress($_POST['email']); // Add recipient email
        $mail->isHTML(true);

        // //Set up the email headers
// $headers    = "From: $name <$emailHelp>\r\n";
// $headers   .= "Content-type: text/html; charset=iso-8859-1\r\n";
// $headers   .= "Message-ID: <".time().rand(1,1000)."@".$_SERVER['SERVER_NAME'].">". "\r\n"; 
   

//         $mail->h = headers;
        $name= $_POST['fname'];
        $emailHelp= $_POST['email'];
        $phone= $_POST['phone'];
        $comments=$_POST['comments'];
        $email_subject="Inquiry From Contact Page";

        $mail->Subject ="Inquiry From Contact Page"; // Set email subject
        $mail->Body = nl2br("Dear Admin,\n
	         The user whose detail is shown below has sent this message from ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n

	         name: ".$name."\n
	         Phone: ".$phone."\n
	         Email Address: ".$emailHelp."\n
	         Message: ".$comments."\n
	         User Ip:".getHostByName(getHostName())."\n
	         Thank You!\n\n"
        ); // Set email body

        if ($mail->send()) { // Send email
            $status='Success';
			//Displays the success message when email message is sent
			$output="Congrats ".$name.", your email message has been sent successfully! We will get back to you as soon as possible. Thanks.";
		
            echo "<script>alert('Sent Successfully');</script>";
            echo "<script>window.location.href='contact-form.php';</script>";
        } else {
            $status='error';
			 //Displays an error message when email sending fails
			$output="Sorry, your email could not be sent at the moment. Please try again or contact this website admin to report this error message if the problem persist. Thanks.";
		
            echo "<script>alert('Email sending failed.');</script>";
            echo "<script>window.location.href='contact-form.php';</script>";
        }
    } else {
        echo $name;
	    $status='error';
	    $output="please fill require fields";
        echo "<script>alert('Failed to insert data into database.');</script>";
        echo "<script>window.location.href='contact-form.php';</script>";
    }

    echo json_encode(array('status'=> $status, 'msg'=>$output));
}

?>

