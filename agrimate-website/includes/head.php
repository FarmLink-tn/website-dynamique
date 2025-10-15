<?php
$pageTitle = $pageTitle ?? 'FarmLink';
$pageLang = $pageLang ?? 'fr';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($pageLang, ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/aos.css">
    <style>
      [data-aos]{opacity:1 !important;transform:none !important;}
    </style>
    <link rel="stylesheet" href="/style.css">
    <?php if (!empty($extraStyles) && is_array($extraStyles)): ?>
        <?php foreach ($extraStyles as $style): ?>
            <?= $style ?>
        <?php endforeach; ?>
    <?php endif; ?>
</head>
