<?php
// Password reset email template
// Variables available: $reset_link
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
        .warning { background: #fee; border-left: 4px solid #f44; padding: 15px; margin: 20px 0; border-radius: 4px; color: #c33; }
        .footer { text-align: center; padding: 20px; color: #999; font-size: 12px; }
        .timer { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Reset Your Password</h2>
        </div>
        
        <div class="content">
            <p>We received a request to reset your AnimeZia account password. Click the button below to create a new password:</p>
            
            <center>
                <a href="<?= htmlspecialchars($reset_link) ?>" class="button">Reset Password</a>
            </center>
            
            <p>Or copy and paste this link in your browser:</p>
            <p style="word-break: break-all; background: #f5f5f5; padding: 10px; border-radius: 4px; font-size: 12px;">
                <?= htmlspecialchars($reset_link) ?>
            </p>
            
            <div class="timer">
                <strong>⏱️ Time Sensitive:</strong> This password reset link will expire in 1 hour. If you don't use it within that time, you'll need to request a new one.
            </div>
            
            <div class="warning">
                <strong>🔒 Security Alert:</strong> If you didn't request a password reset, please ignore this email. Your account remains secure and no changes have been made.
            </div>
            
            <p style="color: #666; font-size: 14px; margin-top: 30px;">
                For security reasons, we recommend:<br>
                ✓ Use a strong password (mix of letters, numbers, symbols)<br>
                ✓ Don't share your password with anyone<br>
                ✓ Never click reset links from suspicious emails
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 AnimeZia. All rights reserved.</p>
            <p>This is an automated email. Please do not reply directly to this message.</p>
        </div>
    </div>
</body>
</html>
