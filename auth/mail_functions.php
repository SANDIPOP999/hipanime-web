<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Get configured PHPMailer instance
 */
function getMailer() {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = getenv('MAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = getenv('MAIL_USERNAME');
        $mail->Password = getenv('MAIL_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        $mail->setFrom(
            getenv('MAIL_FROM_ADDRESS'),
            getenv('MAIL_FROM_NAME') );
        
        return $mail;
    } catch (Exception $e) {
        error_log("PHPMailer Error: " . $e->getMessage());
        return null;
    }
}

/**
 * Send email with template
 * 
 * @param string $email Recipient email
 * @param string $template Template name (without .php)
 * @param array $data Data to pass to template
 * @param string $subject Email subject
 * @return bool
 */
function sendEmail($email, $template, $data = [], $subject = 'Hipanime Notification') {
    try {
        $mail = getMailer();
        if (!$mail) return false;
        
        // Load and render template
        $template_path = __DIR__ . '/../emails/' . $template . '.php';
        if (!file_exists($template_path)) {
            error_log("Template not found: $template_path");
            return false;
        }
        
        // Extract data variables for template
        extract($data);
        
        // Render template
        ob_start();
        include $template_path;
        $html_body = ob_get_clean();
        
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $html_body;
        $mail->isHTML(true);
        
        return $mail->send();
        
    } catch (Exception $e) {
        error_log("Email error: " . $e->getMessage());
        return false;
    }
}

/**
 * Send template email with recipient name
 */
function sendTemplateEmail($email, $name, $template, $data = [], $subject = 'AnimeZia') {
    try {
        $mail = getMailer();
        if (!$mail) return false;
        
        $template_path = __DIR__ . '/../emails/' . $template . '.php';
        if (!file_exists($template_path)) {
            error_log("Template not found: $template_path");
            return false;
        }
        
        extract($data);
        ob_start();
        include $template_path;
        $html_body = ob_get_clean();
        
        $mail->addAddress($email, $name);
        $mail->Subject = $subject;
        $mail->Body = $html_body;
        $mail->isHTML(true);
        
        return $mail->send();
        
    } catch (Exception $e) {
        error_log("Email error: " . $e->getMessage());
        return false;
    }
}

/**
 * Send multiple recipients
 */
function sendEmailToMultiple($recipients, $template, $data = [], $subject = 'AnimeZia') {
    try {
        $mail = getMailer();
        if (!$mail) return false;
        
        $template_path = __DIR__ . '/../emails/' . $template . '.php';
        if (!file_exists($template_path)) {
            error_log("Template not found: $template_path");
            return false;
        }
        
        extract($data);
        ob_start();
        include $template_path;
        $html_body = ob_get_clean();
        
        $mail->Subject = $subject;
        $mail->Body = $html_body;
        $mail->isHTML(true);
        
        foreach ((array)$recipients as $recipient) {
            if (is_array($recipient)) {
                $mail->addAddress($recipient['email'], $recipient['name'] ?? '');
            } else {
                $mail->addAddress($recipient);
            }
        }
        
        return $mail->send();
        
    } catch (Exception $e) {
        error_log("Email error: " . $e->getMessage());
        return false;
    }
}
?>