<?php
// Email verification template
// Variables available: $username, $verification_link
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f8f9fa; border-radius: 8px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: white; padding: 30px; }
        .button { display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 30px; border-radius: 6px; text-decoration: none; margin: 20px 0; font-weight: 600; }
        .footer { text-align: center; padding: 20px; color: #999; font-size: 12px; }
        .note { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Verify Your Email Address</h2>
        </div>
        
        <div class="content">
            <p>Hello <strong><?= htmlspecialchars($username) ?></strong>,</p>
            
            <p>Welcome to AnimeZia! To complete your registration, please verify your email address by clicking the button below:</p>
            
            <center>
                <a href="<?= htmlspecialchars($verification_link) ?>" class="button">Verify Email Address</a>
            </center>
            
            <p>Or copy and paste this link in your browser:</p>
            <p style="word-break: break-all; background: #f5f5f5; padding: 10px; border-radius: 4px; font-size: 12px;">
                <?= htmlspecialchars($verification_link) ?>
            </p>
            
            <div class="note">
                <strong>⚠️ Security Note:</strong> If you didn't create this account, please ignore this email. This link will expire in 24 hours.
            </div>
            
            <p style="color: #666; font-size: 14px;">
                Once verified, you'll be able to enjoy all AnimeZia features.<br>
                Happy watching!
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 AnimeZia. All rights reserved.</p>
            <p>This is an automated email. Please do not reply directly to this message.</p>
        </div>
    </div>
</body>
</html>
