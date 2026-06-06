<?php
require_once __DIR__ 'db_config.php';
require_once __DIR__ 'User.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// Validation
if (empty($email)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email is required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

$user = new User($conn);

// Check if email exists
if (!$user->emailExists($email)) {
    // For security, don't reveal if email exists
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'If this email exists, you will receive a password reset link']);
    exit;
}

// Generate reset token
$token = bin2hex(random_bytes(32));
$expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

// Save reset token
$stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) 
    SELECT id, ?, ? FROM users WHERE email = ?");
$stmt->bind_param("sss", $token, $expires_at, $email);

if ($stmt->execute()) {
    // Generate reset link
    $reset_url = getenv('WEBSITE_URL') . "/reset-password?token=$token";
    
    // TODO: Send email with reset link
    // $this->sendResetEmail($email, $reset_url);
    
    // For now, log the reset link (DEVELOPMENT ONLY - REMOVE IN PRODUCTION)
    error_log("Password Reset Link: $reset_url");
    
    http_response_code(200);
    echo json_encode([
        'success' => true, 
        'message' => 'Password reset link sent to your email',
        'reset_link' => $reset_url // REMOVE IN PRODUCTION
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to process request']);
}
?>
