<?php
// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['number'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtpout.secureserver.net'; // Replace with your SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'example@gmail.com'; // Replace with your SMTP username
        $mail->Password = 'pass'; // Replace with your SMTP password
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption

        // Email settings
        $mail->setFrom('example@gmail.com', 'Studio a Interior Design Contact Form'); // Replace with your email and name
        $mail->addAddress('hello@gmail.com'); // Add recipient's email

        $mail->Subject = "Message from $name";
        $mail->isHTML(true);
        $mailContent = " <div style='font-family: Arial, sans-serif; color: #333; line-height: 1.6;'>
            <h2 style='color: #2c3e50; text-align: center;'>New Contact Form Submission - Studio A interior Design</h2>
            <hr style='border: none; border-top: 1px solid #ccc; margin: 20px 0;'>
            <p><strong style='color: #d0a149;'>Name:</strong> $name</p>
            <p><strong style='color: #d0a149;'>Email:</strong> $email</p>
            <p><strong style='color: #d0a149;'>Phone:</strong> $phone</p>
            <p><strong style='color: #d0a149;'>Message:</strong><br>$message</p>
            <hr style='border: none; border-top: 1px solid #ccc; margin: 20px 0;'>
            <p style='font-size: 0.9em; text-align: center;'>This message was sent from the Studio A interior Design website contact form.</p>
          </div>";
        $mail->Body = $mailContent;

        // Send the email
        if ($mail->send()) {
            echo "Email has been sent successfully.";
            header('Location: thank-you.html'); // Redirect to 'thank-you.html'
            exit;
        } else {
            echo "Email could not be sent.";
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    // Redirect to 'index.html' if accessed without POST
    header('Location: index.html');
    exit;
}
