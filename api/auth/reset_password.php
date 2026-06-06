<?php
require_once 'db_config.php';

$token = isset($_GET['token']) ? trim($_GET['token']) : '';
$token_valid = false;

if (!empty($token)) {
    // Check if token is valid and not expired
    $stmt = $conn->prepare("SELECT user_id FROM password_resets WHERE token = ? AND expires_at > NOW() LIMIT 1");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $token_valid = true;
        $reset_data = $result->fetch_assoc();
        $user_id = $reset_data['user_id'];
    }
}

// Handle POST request for resetting password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $token_valid) {
    header('Content-Type: application/json');
    
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if (empty($new_password) || empty($confirm_password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    if (strlen($new_password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters']);
        exit;
    }

    if ($new_password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
        exit;
    }

    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    
    // Update password
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $hashed_password, $user_id);
    
    if ($stmt->execute()) {
        // Delete used tokens
        $stmt = $conn->prepare("DELETE FROM password_resets WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        
        echo json_encode(['success' => true, 'message' => 'Password reset successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to reset password']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - AnimeZia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .reset-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .reset-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .reset-header h2 {
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .reset-header p {
            color: #666;
            font-size: 14px;
        }
        .form-group label {
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn-reset {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .alert {
            display: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .alert.show {
            display: block;
        }
        .error-message {
            background: #fee;
            color: #c33;
            padding: 20px;
            border-radius: 6px;
            text-align: center;
        }
        .error-message a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        .loading {
            display: none;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <?php if (!$token_valid): ?>
            <div class="error-message">
                <h3>Invalid or Expired Link</h3>
                <p style="margin-top: 10px; font-size: 14px;">This password reset link is invalid or has expired.</p>
                <a href="/" style="margin-top: 15px; display: inline-block;">Back to Home</a>
            </div>
        <?php else: ?>
            <div class="reset-header">
                <h2>Reset Password</h2>
                <p>Enter your new password</p>
            </div>

            <div id="message" class="alert"></div>

            <form id="resetPasswordForm">
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" 
                        placeholder="At least 6 characters" required minlength="6">
                    <small class="form-text text-muted">Min 6 characters</small>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                        placeholder="Confirm your password" required minlength="6">
                </div>

                <button type="submit" class="btn btn-reset">
                    <span class="btn-text">Reset Password</span>
                    <span class="loading spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
                </button>
            </form>
        <?php endif; ?>
    </div>

    <script>
        document.getElementById('resetPasswordForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = this;
            const messageDiv = document.getElementById('message');
            const loading = document.querySelector('.loading');
            const btnText = document.querySelector('.btn-text');
            const submitBtn = form.querySelector('button[type="submit"]');

            loading.style.display = 'inline-block';
            btnText.textContent = 'Resetting...';
            submitBtn.disabled = true;

            try {
                const formData = new FormData(form);
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                messageDiv.classList.add('show');

                if (data.success) {
                    messageDiv.className = 'alert alert-success show';
                    messageDiv.textContent = data.message;
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                } else {
                    messageDiv.className = 'alert alert-danger show';
                    messageDiv.textContent = data.message;
                }
            } catch (error) {
                messageDiv.className = 'alert alert-danger show';
                messageDiv.textContent = 'An error occurred. Please try again.';
                console.error('Error:', error);
            } finally {
                loading.style.display = 'none';
                btnText.textContent = 'Reset Password';
                submitBtn.disabled = false;
            }
        });
    </script>
</body>
</html>
