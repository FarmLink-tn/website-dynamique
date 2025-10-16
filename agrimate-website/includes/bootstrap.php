<?php
if (session_status() === PHP_SESSION_NONE) {
    $httpsOn = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] === '443');

    session_set_cookie_params([
        'httponly' => true,
        'secure' => $httpsOn,
        'samesite' => 'Strict',
        'path' => '/',
    ]);
    session_start();
}

$assetBaseUrl = rtrim(getenv('ASSET_BASE_URL') ?: '', '/');

$supportedLanguages = ['fr', 'en', 'ar'];
$defaultLanguage = 'fr';
$httpsOn = $httpsOn ?? ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] === '443'));

if (isset($_GET['lang'])) {
    $requestedLang = strtolower((string) $_GET['lang']);
    if (in_array($requestedLang, $supportedLanguages, true)) {
        $_SESSION['lang'] = $requestedLang;
        setcookie('fl_lang', $requestedLang, [
            'expires' => time() + 60 * 60 * 24 * 30,
            'path' => '/',
            'secure' => $httpsOn,
            'httponly' => false,
            'samesite' => 'Lax',
        ]);
    }
}

$currentLang = $_SESSION['lang']
    ?? (isset($_COOKIE['fl_lang']) && in_array($_COOKIE['fl_lang'], $supportedLanguages, true)
        ? $_COOKIE['fl_lang']
        : $defaultLanguage);

$_SESSION['lang'] = $currentLang;

if (!function_exists('asset_url')) {
    function asset_url(string $path): string
    {
        global $assetBaseUrl;
        $normalized = ltrim($path, '/');

        if ($assetBaseUrl !== '') {
            return $assetBaseUrl . '/' . $normalized;
        }

        return $normalized;
    }
}

if (!function_exists('current_language')) {
    function current_language(): string
    {
        return $_SESSION['lang'] ?? 'fr';
    }
}

if (!function_exists('supported_languages')) {
    function supported_languages(): array
    {
        return ['fr', 'en', 'ar'];
    }
}

if (!function_exists('localized_url')) {
    function localized_url(string $baseUrl, string $path, string $lang, string $default = 'fr'): string
    {
        $normalizedBase = rtrim($baseUrl, '/');
        $normalizedPath = '/' . ltrim($path, '/');
        $query = $lang === $default ? '' : ('?lang=' . rawurlencode($lang));

        if ($normalizedPath === '/index.php') {
            $normalizedPath = '/';
        }

        return $normalizedBase . $normalizedPath . $query;
    }
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
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET') {
        header('Cache-Control: public, max-age=600, stale-while-revalidate=300');
    } else {
        header('Cache-Control: no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
    }

    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');
    }
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

function requireAuth(string $redirect = 'account.php'): void
{
    if (!isAuthenticated()) {
        header('Location: ' . $redirect);
        exit;
    }
}

function requireAdmin(string $redirect = 'account.php'): void
{
    if (!isAdmin()) {
        header('Location: ' . $redirect);
        exit;
    }
}
