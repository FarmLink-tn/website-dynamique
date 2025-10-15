<?php
require_once __DIR__ . '/session.php';
header('Content-Type: application/json');

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Forbidden']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
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

$action = $_GET['action'] ?? 'stats';

switch ($action) {
    case 'stats':
        $totalUsers = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
        $totalProducts = (int)$pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
        $openValves = (int)$pdo->query('SELECT COUNT(*) FROM products WHERE valve_open = 1')->fetchColumn();

        echo json_encode([
            'success' => true,
            'csrfToken' => $_SESSION['csrf_token'],
            'data' => [
                'users' => $totalUsers,
                'products' => $totalProducts,
                'openValves' => $openValves,
            ],
        ]);
        break;

    case 'users':
        $stmt = $pdo->query('SELECT username, first_name, last_name, email, region, role FROM users ORDER BY last_name, first_name');
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'csrfToken' => $_SESSION['csrf_token'], 'data' => $users]);
        break;

    case 'products':
        $stmt = $pdo->query('SELECT p.name, p.quantity, p.humidity, p.valve_open, u.username FROM products p JOIN users u ON p.user_id = u.id ORDER BY p.id DESC');
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'csrfToken' => $_SESSION['csrf_token'], 'data' => $products]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
