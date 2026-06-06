<?php
require_once 'db_config.php';

class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register new user
    public function register($username, $email, $password) {
        // Check if user already exists
        $stmt = $this->conn->prepare("SELECT id FROM $this->table WHERE email = ? OR username = ?");
        if (!$stmt) {
            return ['success' => false, 'message' => 'Database error: ' . $this->conn->error];
        }
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return ['success' => false, 'message' => 'Email or username already exists'];
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Generate verification token
        $verification_token = bin2hex(random_bytes(32));

        // Insert user
        $stmt = $this->conn->prepare("INSERT INTO $this->table (username, email, password, verification_token, is_verified, created_at) VALUES (?, ?, ?, ?, 0, NOW())");
        if (!$stmt) {
            return ['success' => false, 'message' => 'Database error: ' . $this->conn->error];
        }
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $verification_token);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            
            // Send verification email
            $verification_link = getenv('WEBSITE_URL') . "/verify-email?token=$verification_token&email=" . urlencode($email);
            $send_result = $this->sendVerificationEmail($email, $username, $verification_link);
            
            if ($send_result) {
                return ['success' => true, 'message' => 'Registration successful! Please check your email to verify your account.', 'user_id' => $user_id];
            } else {
                return ['success' => true, 'message' => 'Registration successful! (Email verification could not be sent - check spam folder)', 'user_id' => $user_id];
            }
        } else {
            return ['success' => false, 'message' => 'Registration failed: ' . $this->conn->error];
        }
    }

    // Login user
    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, username, email, password FROM $this->table WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];

                // Update last login
                $this->updateLastLogin($user['id']);

                return ['success' => true, 'message' => 'Login successful'];
            } else {
                return ['success' => false, 'message' => 'Invalid password'];
            }
        } else {
            return ['success' => false, 'message' => 'User not found'];
        }
    }

    // Check if user is logged in
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    // Get user by ID
    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT id, username, email, avatar, bio, created_at FROM $this->table WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update user profile
    public function updateProfile($id, $username, $bio, $avatar = null) {
        if ($avatar) {
            $stmt = $this->conn->prepare("UPDATE $this->table SET username = ?, bio = ?, avatar = ? WHERE id = ?");
            $stmt->bind_param("sssi", $username, $bio, $avatar, $id);
        } else {
            $stmt = $this->conn->prepare("UPDATE $this->table SET username = ?, bio = ? WHERE id = ?");
            $stmt->bind_param("ssi", $username, $bio, $id);
        }

        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            return ['success' => true, 'message' => 'Profile updated successfully'];
        } else {
            return ['success' => false, 'message' => 'Failed to update profile'];
        }
    }

    // Change password
    public function changePassword($id, $old_password, $new_password) {
        $user = $this->getUserById($id);
        
        if (!password_verify($old_password, $user['password'])) {
            return ['success' => false, 'message' => 'Old password is incorrect'];
        }

        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("UPDATE $this->table SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $id);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Password changed successfully'];
        } else {
            return ['success' => false, 'message' => 'Failed to change password'];
        }
    }

    // Logout
    public static function logout() {
        session_destroy();
        return ['success' => true, 'message' => 'Logged out successfully'];
    }

    // Update last login
    private function updateLastLogin($id) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET last_login = NOW() WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    // Check email existence
    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM $this->table WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    // Check username existence
    public function usernameExists($username) {
        $stmt = $this->conn->prepare("SELECT id FROM $this->table WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    // Send verification email
    public function sendVerificationEmail($email, $username, $verification_link) {
        try {
            require_once 'mail_config.php'; // Your PHPMailer config
            
            $mail = getMailer();
            $mail->addAddress($email, $username);
            $mail->Subject = 'Verify Your AnimeZia Account';
            
            // Load template (you should have this)
            $template = $this->getEmailTemplate('verification', [
                'username' => $username,
                'verification_link' => $verification_link
            ]);
            
            $mail->Body = $template;
            $mail->isHTML(true);
            
            return $mail->send();
        } catch (Exception $e) {
            error_log("Email error: " . $e->getMessage());
            return false;
        }
    }

    // Send welcome email
    public function sendWelcomeEmail($email, $username) {
        try {
            require_once 'mail_config.php';
            
            $mail = getMailer();
            $mail->addAddress($email, $username);
            $mail->Subject = 'Welcome to AnimeZia!';
            
            $template = $this->getEmailTemplate('welcome', [
                'username' => $username
            ]);
            
            $mail->Body = $template;
            $mail->isHTML(true);
            
            return $mail->send();
        } catch (Exception $e) {
            error_log("Email error: " . $e->getMessage());
            return false;
        }
    }

    // Send password reset email
    public function sendResetEmail($email, $reset_url) {
        try {
            require_once 'mail_config.php';
            
            $mail = getMailer();
            $mail->addAddress($email);
            $mail->Subject = 'Reset Your AnimeZia Password';
            
            $template = $this->getEmailTemplate('password_reset', [
                'reset_link' => $reset_url
            ]);
            
            $mail->Body = $template;
            $mail->isHTML(true);
            
            return $mail->send();
        } catch (Exception $e) {
            error_log("Email error: " . $e->getMessage());
            return false;
        }
    }

    // Get email template
    private function getEmailTemplate($type, $data = []) {
        $templatePath = __DIR__ . "/../emails/{$type}.php";
        
        if (!file_exists($templatePath)) {
            return "Error: Template not found";
        }
        
        ob_start();
        include $templatePath;
        return ob_get_clean();
    }

    // Verify email token
    public function verifyEmail($email, $token) {
        $stmt = $this->conn->prepare("SELECT id FROM $this->table WHERE email = ? AND verification_token = ?");
        if (!$stmt) {
            return ['success' => false, 'message' => 'Database error'];
        }
        $stmt->bind_param("ss", $email, $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Mark as verified
            $update_stmt = $this->conn->prepare("UPDATE $this->table SET is_verified = 1, verification_token = NULL WHERE id = ?");
            if (!$update_stmt) {
                return ['success' => false, 'message' => 'Database error'];
            }
            $update_stmt->bind_param("i", $user['id']);
            
            if ($update_stmt->execute()) {
                // Send welcome email
                $user_data = $this->getUserById($user['id']);
                $this->sendWelcomeEmail($user_data['email'], $user_data['username']);
                
                return ['success' => true, 'message' => 'Email verified successfully!'];
            } else {
                return ['success' => false, 'message' => 'Verification failed'];
            }
        } else {
            return ['success' => false, 'message' => 'Invalid verification link'];
        }
    }
}
?>
