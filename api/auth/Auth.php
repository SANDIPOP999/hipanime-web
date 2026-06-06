<?php
require_once __DIR__ 'db_config.php';
require_once __DIR__ 'User.php';

class Auth {
    // Check if user is logged in
    public static function check() {
        return User::isLoggedIn();
    }

    // Get current user ID
    public static function id() {
        return $_SESSION['user_id'] ?? null;
    }

    // Get current user
    public static function user() {
        if (self::check()) {
            return [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'email' => $_SESSION['email']
            ];
        }
        return null;
    }

    // Require authentication
    public static function requireLogin($redirect = '/login') {
        if (!self::check()) {
            header("Location: $redirect");
            exit;
        }
    }

    // Check if user can access resource
    public static function canAccess($user_id) {
        return self::check() && self::id() == $user_id;
    }
}
?>
