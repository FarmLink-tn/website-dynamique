<?php
if (session_status() === PHP_SESSION_NONE) {
    $isSecure = (
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
        (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] === '443')
    );

    session_set_cookie_params([
        'httponly' => true,
        'secure' => $isSecure,
        'samesite' => 'Strict',
        'path' => '/',
    ]);

    session_start();
}

if (!isset($isSecure)) {
    $isSecure = (
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
        (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] === '443')
    );
}

if (!headers_sent()) {
    $csp = "default-src 'self'; "
        . "script-src 'self' 'unsafe-eval' https://cdn.tailwindcss.com; "
        . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; "
        . "font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com; "
        . "img-src 'self' data: blob:; "
        . "connect-src 'self'; "
        . "form-action 'self'; "
        . "frame-ancestors 'self'; "
        . "base-uri 'self'; "
        . "object-src 'none'; "
        . "upgrade-insecure-requests";

    header('Content-Security-Policy: ' . $csp);
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
    header('Cross-Origin-Opener-Policy: same-origin');
    header('Cross-Origin-Resource-Policy: same-origin');
    header('X-XSS-Protection: 0');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    if (!empty($isSecure)) {
        header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');
    }
}
