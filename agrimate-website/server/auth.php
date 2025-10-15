<?php
require_once __DIR__ . '/session.php';
header('Content-Type: application/json');

// Generate a CSRF token for the session if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Validate CSRF token on all non-GET requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
        exit;
    }
}

$config = require __DIR__ . '/config.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
        $config['user'],
        $config['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

$action = $_GET['action'] ?? '';
$method = $_SERVER['REQUEST_METHOD'] ?? '';

// Helper to read JSON body
$input = json_decode(file_get_contents('php://input'), true) ?? [];
$username = trim($input['username'] ?? '');
$password = $input['password'] ?? '';
$lastName = trim($input['last_name'] ?? '');
$firstName = trim($input['first_name'] ?? '');
$email = trim($input['email'] ?? '');
$phone = trim($input['phone'] ?? '');
$region = trim($input['region'] ?? '');

switch ($action) {
    case 'register':
        if ($method !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
            break;
        }
        if (!$username || !$password || !$lastName || !$firstName || !$email || !$phone || !$region) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing fields']);
            break;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^\d{8,}$/', $phone)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid fields']);
            break;
        }
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Username or email already exists']);
            break;
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (username, password_hash, last_name, first_name, email, phone, region, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$username, $hash, $lastName, $firstName, $email, $phone, $region, 'user']);
        echo json_encode(['success' => true, 'csrfToken' => $_SESSION['csrf_token']]);
        break;

    case 'login':
        if ($method !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
            break;
        }
        if (!$username || !$password) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing fields']);
            break;
        }
        $stmt = $pdo->prepare('SELECT id, password_hash, role FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'] ?? 'user';
            echo json_encode([
                'success' => true,
                'username' => $username,
                'role' => $_SESSION['role'],
                'csrfToken' => $_SESSION['csrf_token']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
        }
        break;

    case 'check':
        if ($method !== 'GET') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
            break;
        }
        if (isset($_SESSION['username'])) {
            echo json_encode([
                'loggedIn' => true,
                'username' => $_SESSION['username'],
                'role' => $_SESSION['role'] ?? 'user',
                'csrfToken' => $_SESSION['csrf_token']
            ]);
        } else {
            echo json_encode([
                'loggedIn' => false,
                'csrfToken' => $_SESSION['csrf_token']
            ]);
        }
        break;

    case 'logout':
        if ($method !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
            break;
        }
        session_destroy();
        echo json_encode(['success' => true]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
