<?php
$activeNav = $activeNav ?? '';
$pageLang = $pageLang ?? current_language();
$requestedPath = $requestedPath ?? (isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/');
$baseUrl = $baseUrl ?? site_base_url();
$defaultLanguage = $defaultLanguage ?? 'fr';

$commonNavItems = [
    [
        'href' => 'index.php',
        'active' => 'home',
        'label_key' => 'nav.home',
    ],
    [
        'href' => 'about.php',
        'active' => 'about',
        'label_key' => 'nav.about',
    ],
    [
        'href' => 'how-it-works.php',
        'active' => 'how',
        'label_key' => 'nav.how',
    ],
    [
        'href' => 'solutions.php',
        'active' => 'solutions',
        'label_key' => 'nav.solutions',
    ],
    [
        'href' => 'ai-advisor.php',
        'active' => 'ai',
        'label_key' => 'nav.ai',
    ],
];

$authNavItems = [];

$ctaNavItem = [
    'href' => 'contact.php',
    'active' => 'contact',
    'label_key' => 'nav.quote',
    'variant' => 'cta',
];

$navItems = array_merge($commonNavItems, $authNavItems, [$ctaNavItem]);

$supportedLanguages = supported_languages();
$languageUrls = [];
foreach ($supportedLanguages as $langCode) {
    $languageUrls[$langCode] = localized_url(
        $baseUrl,
        $requestedPath,
        $langCode,
        $defaultLanguage
    );
}
?>
<body class="site" data-current-lang="<?= htmlspecialchars($pageLang, ENT_QUOTES, 'UTF-8'); ?>" data-default-lang="<?= htmlspecialchars($defaultLanguage, ENT_QUOTES, 'UTF-8'); ?>" data-request-path="<?= htmlspecialchars($requestedPath, ENT_QUOTES, 'UTF-8'); ?>" data-base-url="<?= htmlspecialchars(rtrim($baseUrl, '/'), ENT_QUOTES, 'UTF-8'); ?>">
    <a href="#main-content" class="skip-link"><?= htmlspecialchars(trans('a11y.skip_to_content', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a>
    <header class="site-header">
        <nav class="site-nav" role="navigation" aria-label="Navigation principale">
            <div class="nav-brand">
                <a href="index.php" class="brand-link">
                    <img src="image/logo.png" alt="FarmLink" class="brand-logo" width="180" height="56" loading="eager" decoding="async" fetchpriority="high">
                </a>
            </div>
            <ul class="nav-links" id="primary-navigation">
                <?php foreach ($navItems as $item): ?>
                    <?php
                        $isActive = $activeNav === $item['active'];
                        $isCta = ($item['variant'] ?? '') === 'cta';
                        $classes = $isCta ? 'nav-link nav-link--cta' : 'nav-link';
                        if ($isActive) {
                            $classes .= ' is-active';
                        }
                        $label = trans($item['label_key'], $pageLang);
                    ?>
                    <li>
                        <a href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>"
                           class="<?= htmlspecialchars($classes, ENT_QUOTES, 'UTF-8'); ?>"
                           <?= $isActive ? 'aria-current="page"' : ''; ?>>
                            <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="nav-actions">
                <?php if (isAuthenticated()): ?>
                    <span class="nav-user"><?= htmlspecialchars(trans('nav.logged_in', $pageLang), ENT_QUOTES, 'UTF-8'); ?> <strong><?= htmlspecialchars($currentUser['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong></span>
                <?php endif; ?>
                <label for="language-switcher" class="sr-only"><?= htmlspecialchars(trans('nav.language_label', $pageLang), ENT_QUOTES, 'UTF-8'); ?></label>
                <select id="language-switcher" class="language-switcher" aria-label="<?= htmlspecialchars(trans('nav.language_label', $pageLang), ENT_QUOTES, 'UTF-8'); ?>">
                    <?php foreach ($supportedLanguages as $langCode): ?>
                        <?php $optionHref = $languageUrls[$langCode] ?? ''; ?>
                        <option value="<?= htmlspecialchars($langCode, ENT_QUOTES, 'UTF-8'); ?>"
                                lang="<?= htmlspecialchars($langCode, ENT_QUOTES, 'UTF-8'); ?>"
                                data-href="<?= htmlspecialchars($optionHref, ENT_QUOTES, 'UTF-8'); ?>"
                                <?= $pageLang === $langCode ? 'selected' : ''; ?>>
                            <?= htmlspecialchars(strtoupper($langCode), ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="theme-toggle" id="theme-toggle" type="button" aria-label="Basculer le thème">
                    <span class="theme-toggle__sun" aria-hidden="true"><i class="fas fa-sun"></i></span>
                    <span class="theme-toggle__moon" aria-hidden="true"><i class="fas fa-moon"></i></span>
                </button>
                <button id="menu-btn" class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-menu">
                    <span class="sr-only">Menu</span>
                    <span class="menu-toggle__icon" aria-hidden="true"></span>
                </button>
            </div>
        </nav>
        <div id="mobile-menu" class="mobile-menu" role="menu" aria-label="Menu mobile">
            <?php foreach ($navItems as $item): ?>
                <?php
                    $isCta = ($item['variant'] ?? '') === 'cta';
                    $mobileClass = $isCta ? 'mobile-link mobile-link--cta' : 'mobile-link';
                    $label = trans($item['label_key'], $pageLang);
                ?>
                <a href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>"
                   class="<?= htmlspecialchars($mobileClass, ENT_QUOTES, 'UTF-8'); ?>"
                   role="menuitem">
                    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </header>
