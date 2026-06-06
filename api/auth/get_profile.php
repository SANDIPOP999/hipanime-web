<?php
require_once 'db_config.php';
require_once 'User.php';

header('Content-Type: application/json');

if (!User::isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$user = new User($conn);
$user_data = $user->getUserById($_SESSION['user_id']);

if ($user_data) {
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'user' => $user_data
    ]);
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'User not found']);
}
?>
