<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/logger.php';
header('Content-Type: application/json');

// Ensure CSRF token exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method !== 'POST') {
    if ($method === 'OPTIONS') {
        http_response_code(204);
        exit;
    }
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
    exit;
}

// Validate CSRF token on POST requests
$token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['csrf_token'] ?? '');
if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
    app_log('contact_invalid_csrf', ['token' => $token !== '' ? 'provided' : 'missing']);
    exit;
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
$company = trim($_POST['company'] ?? '');

if ($company !== '') {
    http_response_code(204);
    app_log('contact_spam_honeypot', []);
    exit;
}

$nameLength = mb_strlen($name);
$messageLength = mb_strlen($message);
$isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
$isPhoneValid = $phone === '' || preg_match('/^\+?[0-9\s.-]{6,25}$/', $phone);
$isNameValid = (bool) preg_match("/^[\p{L}'\s-]{2,120}$/u", $name);

if (!$isNameValid || !$isEmailValid || $messageLength < 20 || $messageLength > 2000 || !$isPhoneValid) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Champs invalides ou manquants.']);
    app_log('contact_invalid_fields', [
        'name_length' => $nameLength,
        'name_valid' => $isNameValid,
        'email_valid' => $isEmailValid,
        'message_length' => $messageLength,
        'phone_valid' => $isPhoneValid,
    ]);
    exit;
}

// Reject potential header injection
if (preg_match("/[\r\n]/", $email)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email invalide.']);
    app_log('contact_header_injection', ['length' => strlen($email)]);
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
            app_log('contact_mail_sent', ['transport' => 'phpmailer']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => "Échec de l'envoi du message."]);
            app_log('contact_mail_failed', ['transport' => 'phpmailer', 'error' => 'unknown']);
        }
    } catch (\Throwable $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => "Erreur lors de l'envoi du message."]);
        app_log('contact_mail_exception', [
            'transport' => 'phpmailer',
            'error' => $e->getMessage(),
        ]);
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
    app_log('contact_mail_sent', ['transport' => 'mail']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => "Erreur lors de l'envoi du message."]);
    app_log('contact_mail_failed', ['transport' => 'mail']);
}
