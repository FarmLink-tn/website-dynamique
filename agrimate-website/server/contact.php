<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/logger.php';

header('Content-Type: application/json');

$responseStrings = trans('contact', current_language());

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
    echo json_encode(['success' => false, 'message' => $responseStrings['error'] ?? 'Method not allowed']);
    exit;
}

$token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['csrf_token'] ?? '');
if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => $responseStrings['error'] ?? 'Invalid CSRF token']);
    app_log('contact_invalid_csrf', ['token' => $token !== '' ? 'provided' : 'missing']);
    exit;
}

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
    echo json_encode(['success' => false, 'message' => $responseStrings['error'] ?? 'Invalid fields']);
    app_log('contact_invalid_fields', [
        'name_length' => $nameLength,
        'name_valid' => $isNameValid,
        'email_valid' => $isEmailValid,
        'message_length' => $messageLength,
        'phone_valid' => $isPhoneValid,
    ]);
    exit;
}

if (preg_match("/[\r\n]/", $email)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $responseStrings['error'] ?? 'Invalid email']);
    app_log('contact_header_injection', ['length' => strlen($email)]);
    exit;
}

$cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
$to      = 'contact@farmlink.tn';
$subject = 'Nouveau message de contact';
$body    = "Nom: $name\nEmail: $cleanEmail\nTéléphone: $phone\nMessage:\n$message";

$mailerAvailable = class_exists(\PHPMailer\PHPMailer\PHPMailer::class);

if ($mailerAvailable) {
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->setFrom('contact@farmlink.tn', 'FarmLink');
        $mail->addAddress($to);
        $mail->addReplyTo($cleanEmail);

        $mail->Subject = $subject;
        $mail->Body    = $body;

        if ($mail->send()) {
            echo json_encode(['success' => true, 'message' => $responseStrings['success'] ?? 'Message sent successfully.']);
            app_log('contact_mail_sent', ['transport' => 'phpmailer']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $responseStrings['error'] ?? 'Unable to send message']);
            app_log('contact_mail_failed', ['transport' => 'phpmailer', 'error' => 'unknown']);
        }
    } catch (\Throwable $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $responseStrings['error'] ?? 'Unable to send message']);
        app_log('contact_mail_exception', [
            'transport' => 'phpmailer',
            'error' => $e->getMessage(),
        ]);
    }
    exit;
}

$headers = [
    'From: contact@farmlink.tn',
    'Reply-To: ' . $cleanEmail,
    'Content-Type: text/plain; charset=UTF-8',
];

if (mail($to, $subject, $body, implode("\r\n", $headers))) {
    echo json_encode(['success' => true, 'message' => $responseStrings['success'] ?? 'Message sent successfully.']);
    app_log('contact_mail_sent', ['transport' => 'mail']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $responseStrings['error'] ?? 'Unable to send message']);
    app_log('contact_mail_failed', ['transport' => 'mail']);
}
