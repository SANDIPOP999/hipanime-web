<?php
// Welcome email template
// Variables available: $username
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
        .feature-box { background: #f8f9fa; border-left: 4px solid #667eea; padding: 15px; margin: 15px 0; border-radius: 4px; }
        .feature-box h4 { margin-top: 0; color: #667eea; }
        .button { display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 30px; border-radius: 6px; text-decoration: none; margin: 20px 0; font-weight: 600; }
        .footer { text-align: center; padding: 20px; color: #999; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Welcome to AnimeZia! 🎉</h2>
        </div>
        
        <div class="content">
            <p>Hello <strong><?= htmlspecialchars($username) ?></strong>,</p>
            
            <p>Your email has been verified successfully! Your account is now fully activated and ready to use.</p>
            
            <p>Here's what you can do now:</p>
            
            <div class="feature-box">
                <h4>📺 Browse Anime</h4>
                <p>Explore our huge collection of anime series across different genres and categories.</p>
            </div>
            
            <div class="feature-box">
                <h4>📋 Create Watchlist</h4>
                <p>Add anime to your personal watchlist and track your viewing progress.</p>
            </div>
            
            <div class="feature-box">
                <h4>⭐ Rate & Review</h4>
                <p>Share your thoughts and ratings on your favorite anime series.</p>
            </div>
            
            <div class="feature-box">
                <h4>👤 Customize Profile</h4>
                <p>Update your profile picture, bio, and other personal information.</p>
            </div>
            
            <center>
                <a href="https://animesia.com" class="button">Go to AnimeZia</a>
            </center>
            
            <p style="color: #666; margin-top: 30px;">
                If you have any questions or need assistance, feel free to contact our support team.<br>
                We're here to help!
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 AnimeZia. All rights reserved.</p>
            <p>This is an automated email. Please do not reply directly to this message.</p>
        </div>
    </div>
</body>
</html>
