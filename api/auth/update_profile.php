<?php
require_once 'db_config.php';
require_once 'User.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

if (!User::isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$bio = isset($_POST['bio']) ? trim($_POST['bio']) : '';
$avatar = null;

// Validation
if (empty($username)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Username is required']);
    exit;
}

if (strlen($username) < 3) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Username must be at least 3 characters']);
    exit;
}

// Handle avatar upload
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $filename = $_FILES['avatar']['name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid file type']);
        exit;
    }

    if ($_FILES['avatar']['size'] > 5 * 1024 * 1024) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'File size too large (max 5MB)']);
        exit;
    }

    $new_filename = 'avatar_' . $_SESSION['user_id'] . '_' . time() . '.' . $ext;
    $upload_path = 'uploads/avatars/' . $new_filename;

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_path)) {
        $avatar = $new_filename;
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to upload avatar']);
        exit;
    }
}

$user = new User($conn);
$result = $user->updateProfile($_SESSION['user_id'], $username, $bio, $avatar);

if ($result['success']) {
    http_response_code(200);
} else {
    http_response_code(400);
}

echo json_encode($result);
?>
