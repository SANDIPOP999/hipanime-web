<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer Configuration
function getMailer() {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = getenv('MAIL_HOST') ?: 'smtp.gmail.com';           // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = getenv('MAIL_USERNAME') ?: 'your_email@gmail.com';  // SMTP username
        $mail->Password = getenv('MAIL_PASSWORD') ?: 'your_password';         // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender Information
        $mail->setFrom(
            getenv('MAIL_FROM_ADDRESS') ?: 'noreply@animesia.com',
            getenv('MAIL_FROM_NAME') ?: 'AnimeZia'
        );

        return $mail;
    } catch (Exception $e) {
        error_log("PHPMailer Error: " . $e->getMessage());
        return null;
    }
}

// Mail server options
// Option 1: Gmail SMTP
// Host: smtp.gmail.com
// Port: 587 or 465
// Username: your-email@gmail.com
// Password: your-app-specific-password (generate from Google Account)

// Option 2: Custom SMTP (from hosting provider)
// Check your hosting provider's SMTP settings

// Option 3: Sendgrid/Mailgun
// Update SMTP credentials accordingly

// Using Environment Variables (Recommended)
// Set in your hosting control panel:
// MAIL_HOST=smtp.gmail.com
// MAIL_USERNAME=your_email@gmail.com
// MAIL_PASSWORD=your_app_password
// MAIL_FROM_ADDRESS=noreply@animesia.com
// MAIL_FROM_NAME=AnimeZia
?>
