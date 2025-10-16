<?php
$pageTitle = $pageTitle ?? 'FarmLink';
$pageLang = $pageLang ?? current_language();
$baseUrl = $baseUrl ?? site_base_url();
$pageDescription = $metaDescription ?? trans('meta.description', $pageLang);
$pageKeywords = $metaKeywords ?? trans('meta.keywords', $pageLang);
$pageRobots = $metaRobots ?? 'index, follow';
$ogImage = $metaOgImage ?? rtrim($baseUrl, '/') . '/image/logo.png';
$requestedPath = $canonicalPath ?? (isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/');

if ($requestedPath === '/index.php') {
    $requestedPath = '/';
}

$canonicalUrl = localized_url($baseUrl, $requestedPath, $pageLang, $defaultLanguage ?? 'fr');

$defaultLang = $defaultLanguage ?? 'fr';
$dir = $pageLang === 'ar' ? 'rtl' : 'ltr';
$alternateLinks = [];
foreach (supported_languages() as $lang) {
    $alternateLinks[$lang] = localized_url($baseUrl, $requestedPath, $lang, $defaultLang);
}
$alternateLinks['x-default'] = $alternateLinks[$defaultLang];
$ogLocale = $pageLang === 'ar' ? 'ar_AR' : ($pageLang === 'en' ? 'en_GB' : 'fr_FR');
$ogAlternateLocales = array_filter([
    'fr' => 'fr_FR',
    'en' => 'en_GB',
    'ar' => 'ar_AR',
], static fn ($value, $lang) => $lang !== $pageLang, ARRAY_FILTER_USE_BOTH);
$preconnectHosts = [
    'https://fonts.googleapis.com',
    'https://fonts.gstatic.com',
];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($pageLang, ENT_QUOTES, 'UTF-8'); ?>" dir="<?= htmlspecialchars($dir, ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="<?= htmlspecialchars($pageKeywords, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="<?= htmlspecialchars($pageRobots, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="author" content="FarmLink">
    <meta name="language" content="<?= htmlspecialchars($pageLang, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="<?= htmlspecialchars($metaOgType ?? 'website', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:locale" content="<?= htmlspecialchars($ogLocale, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:site_name" content="FarmLink">
    <?php foreach ($ogAlternateLocales as $alternate): ?>
        <meta property="og:locale:alternate" content="<?= htmlspecialchars($alternate, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endforeach; ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:site" content="@FarmLink">
    <meta name="theme-color" content="#0f172a">
    <?php foreach ($alternateLinks as $langCode => $href): ?>
        <link rel="alternate" hreflang="<?= htmlspecialchars($langCode, ENT_QUOTES, 'UTF-8'); ?>" href="<?= htmlspecialchars($href, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endforeach; ?>
    <?php foreach ($preconnectHosts as $host): ?>
        <link rel="preconnect" href="<?= htmlspecialchars($host, ENT_QUOTES, 'UTF-8'); ?>" crossorigin>
    <?php endforeach; ?>
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=Cairo:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941YmG9D5PcJ8y+XKxJ4tT+3btciJ2R2K+7p3u2+Q==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style.css">
    <?php if (!empty($extraStyles) && is_array($extraStyles)): ?>
        <?php foreach ($extraStyles as $style): ?>
            <?= $style ?>
        <?php endforeach; ?>
    <?php endif; ?>
</head>
