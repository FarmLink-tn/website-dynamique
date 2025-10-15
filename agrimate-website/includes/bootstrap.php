<?php
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'samesite' => 'Strict',
    ]);
    session_start();
}

$currentUser = [
    'id' => $_SESSION['user_id'] ?? null,
    'username' => $_SESSION['username'] ?? null,
    'role' => $_SESSION['role'] ?? null,
];

function isAuthenticated(): bool
{
    global $currentUser;
    return !empty($currentUser['id']);
}

function isAdmin(): bool
{
    global $currentUser;
    return isset($currentUser['role']) && $currentUser['role'] === 'admin';
}

function requireAuth(string $redirect = '/account.php'): void
{
    if (!isAuthenticated()) {
        header('Location: ' . $redirect);
        exit;
    }
}

function requireAdmin(string $redirect = '/account.php'): void
{
    if (!isAdmin()) {
        header('Location: ' . $redirect);
        exit;
    }
}
