<?php
require_once 'db_config.php';
require_once 'User.php';

header('Content-Type: application/json');

$token = isset($_GET['token']) ? trim($_GET['token']) : '';
$email = isset($_GET['email']) ? trim($_GET['email']) : '';

if (empty($token) || empty($email)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid verification link']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

$user = new User($conn);
$result = $user->verifyEmail($email, $token);

if ($result['success']) {
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => $result['message'],
        'redirect' => '/login'
    ]);
} else {
    http_response_code(400);
    echo json_encode($result);
}
?>
