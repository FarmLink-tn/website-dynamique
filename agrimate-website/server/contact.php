<?php
session_start();
header('Content-Type: application/json');

// Ensure CSRF token exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Validate CSRF token on POST requests
$token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['csrf_token'] ?? '');
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
        exit;
    }
}

// Load dependencies if available
$autoload = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
}

$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$phone   = trim($_POST['phone']   ?? '');
$message = trim($_POST['message'] ?? '');

if (!$name || !$email || !$message || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Champs invalides ou manquants.']);
    exit;
}

// Reject potential header injection
if (preg_match("/[\r\n]/", $email)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email invalide.']);
    exit;
}

$cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
$to      = 'contact@farmlink.tn';
$subject = 'Nouveau message de contact';
$body    = "Nom: $name\nEmail: $cleanEmail\nTéléphone: $phone\nMessage:\n$message";

$mailerAvailable = class_exists(\PHPMailer\PHPMailer\PHPMailer::class);

if ($mailerAvailable) {
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true); // PHPMailer helps prevent header injection

    try {
        $mail->setFrom('contact@farmlink.tn', 'FarmLink');
        $mail->addAddress($to);
        $mail->addReplyTo($cleanEmail);

        $mail->Subject = $subject;
        $mail->Body    = $body;

        if ($mail->send()) {
            echo json_encode(['success' => true, 'message' => 'Message envoyé avec succès.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => "Échec de l'envoi du message."]);
        }
    } catch (\Throwable $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => "Erreur lors de l'envoi du message."]);
    }
    exit;
}

// Fallback to the native mail() function when PHPMailer is unavailable
$headers = [
    'From: contact@farmlink.tn',
    'Reply-To: ' . $cleanEmail,
    'Content-Type: text/plain; charset=UTF-8',
];

if (mail($to, $subject, $body, implode("\r\n", $headers))) {
    echo json_encode(['success' => true, 'message' => 'Message envoyé avec succès.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => "Erreur lors de l'envoi du message."]);
}
