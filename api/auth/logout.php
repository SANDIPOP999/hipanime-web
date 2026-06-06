<?php
require_once 'db_config.php';
require_once 'User.php';

header('Content-Type: application/json');

if (!User::isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$result = User::logout();
http_response_code(200);
echo json_encode($result);
?>
