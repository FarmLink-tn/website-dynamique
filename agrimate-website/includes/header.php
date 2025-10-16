<?php
$activeNav = $activeNav ?? '';
$pageLang = $pageLang ?? current_language();
$requestedPath = $requestedPath ?? (isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/');
$baseUrl = $baseUrl ?? site_base_url();
$navAccountPath = isAuthenticated() ? 'profile.php' : 'account.php';
$registerPath = 'register.php';
$defaultLanguage = $defaultLanguage ?? 'fr';

$commonNavItems = [
    [
        'href' => 'about.php',
        'active' => 'about',
        'translate' => 'nav_about',
        'label' => 'À propos',
        'mobile_translate' => 'nav_about_mobile',
        'mobile_label' => 'À propos',
    ],
    [
        'href' => 'how-it-works.php',
        'active' => 'how',
        'translate' => 'nav_how_it_works',
        'label' => 'Comment ça marche',
        'mobile_translate' => 'nav_how_it_works_mobile',
        'mobile_label' => 'Comment ça marche',
    ],
    [
        'href' => 'solutions.php',
        'active' => 'solutions',
        'translate' => 'nav_solutions',
        'label' => 'Nos Solutions',
        'mobile_translate' => 'nav_solutions_mobile',
        'mobile_label' => 'Nos Solutions',
    ],
    [
        'href' => 'ai-advisor.php',
        'active' => 'ai',
        'translate' => 'nav_ai_advisor',
        'label' => 'Conseiller IA',
        'mobile_translate' => 'nav_ai_advisor_mobile',
        'mobile_label' => 'Conseiller IA',
    ],
];

$authNavItems = isAuthenticated()
    ? [[
        'href' => 'profile.php',
        'active' => 'dashboard',
        'translate' => 'nav_dashboard',
        'label' => 'Tableau de bord',
        'mobile_translate' => 'nav_dashboard_mobile',
        'mobile_label' => 'Tableau de bord',
        'data_route' => 'profile',
    ]]
    : [[
        'href' => 'account.php',
        'active' => 'account',
        'translate' => 'nav_login',
        'label' => 'Se connecter',
        'mobile_translate' => 'nav_login_mobile',
        'mobile_label' => 'Se connecter',
        'data_route' => 'account',
    ], [
        'href' => 'register.php',
        'active' => 'register',
        'translate' => 'nav_register',
        'label' => 'Créer un compte',
        'mobile_translate' => 'nav_register_mobile',
        'mobile_label' => 'Créer un compte',
        'data_route' => 'register',
    ]];

$ctaNavItem = [
    'href' => 'contact.php',
    'active' => 'contact',
    'translate' => 'nav_get_quote',
    'label' => 'Obtenir un devis',
    'mobile_translate' => 'nav_get_quote_mobile',
    'mobile_label' => 'Obtenir un devis',
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
<body class="dark" data-current-lang="<?= htmlspecialchars($pageLang, ENT_QUOTES, 'UTF-8'); ?>" data-default-lang="<?= htmlspecialchars($defaultLanguage, ENT_QUOTES, 'UTF-8'); ?>" data-request-path="<?= htmlspecialchars($requestedPath, ENT_QUOTES, 'UTF-8'); ?>" data-base-url="<?= htmlspecialchars(rtrim($baseUrl, '/'), ENT_QUOTES, 'UTF-8'); ?>" data-account-link="<?= htmlspecialchars($navAccountPath, ENT_QUOTES, 'UTF-8'); ?>" data-register-link="<?= htmlspecialchars($registerPath, ENT_QUOTES, 'UTF-8'); ?>" data-profile-link="profile.php">
    <a href="#main-content" class="skip-link">Aller au contenu</a>
    <header class="sticky top-0 z-50 backdrop-blur bg-bg-950/80 supports-backdrop-blur:bg-bg-950/70">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between" role="navigation" aria-label="Navigation principale">
            <div class="flex items-center gap-3">
                <a href="index.php" class="flex items-center focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-green-400 rounded">
                    <img src="image/logo.png" alt="Logo FarmLink" class="h-14 w-auto" width="3000" height="1000" loading="eager" decoding="async" fetchpriority="high">
                    <span class="sr-only">Accueil FarmLink</span>
                </a>
            </div>
            <ul class="hidden md:flex items-center space-x-6" id="primary-navigation">
                <?php foreach ($navItems as $item): ?>
                    <?php
                        $isActive = $activeNav === $item['active'];
                        $isCta = ($item['variant'] ?? '') === 'cta';
                        $baseClass = $isCta ? 'button' : 'nav-link';
                        $classes = $baseClass . ($isActive ? ' active' : '');
                        $dataRoute = $item['data_route'] ?? null;
                    ?>
                    <li>
                        <a href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>"
                           class="<?= htmlspecialchars($classes, ENT_QUOTES, 'UTF-8'); ?>"
                           data-translate="<?= htmlspecialchars($item['translate'], ENT_QUOTES, 'UTF-8'); ?>"
                           <?= $dataRoute ? 'data-route="' . htmlspecialchars($dataRoute, ENT_QUOTES, 'UTF-8') . '"' : ''; ?>
                           <?= $isActive ? 'aria-current="page"' : ''; ?>>
                            <?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="flex items-center space-x-3">
                <?php if (isAuthenticated()): ?>
                    <span class="hidden md:inline text-sm text-text-500"><span data-translate="nav_logged_in_prefix">Connecté en tant que</span> <span class="font-semibold"><?= htmlspecialchars($currentUser['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span></span>
                <?php endif; ?>
                <label for="language-switcher" class="sr-only">Choisir la langue</label>
                <select id="language-switcher" class="mr-1" aria-label="Sélectionner la langue">
                    <?php foreach ($supportedLanguages as $langCode): ?>
                        <?php
                            $langLabel = strtoupper($langCode);
                            $optionHref = $languageUrls[$langCode] ?? '';
                        ?>
                        <option value="<?= htmlspecialchars($langCode, ENT_QUOTES, 'UTF-8'); ?>"
                                lang="<?= htmlspecialchars($langCode, ENT_QUOTES, 'UTF-8'); ?>"
                                data-href="<?= htmlspecialchars($optionHref, ENT_QUOTES, 'UTF-8'); ?>"
                                <?= $pageLang === $langCode ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($langLabel, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="flex items-center cursor-pointer" id="theme-toggle" type="button" aria-label="Basculer le thème">
                    <svg id="theme-icon-light" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg id="theme-icon-dark" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
                <button id="menu-btn" class="md:hidden ml-2 rounded focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-green-400" type="button" aria-expanded="false" aria-controls="mobile-menu">
                    <span class="sr-only">Ouvrir le menu</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </nav>
        <div id="mobile-menu" class="hidden md:hidden p-4 mt-2 mx-4 border border-border-soft rounded-lg bg-bg-900" role="menu" aria-label="Menu mobile">
            <?php foreach ($navItems as $item): ?>
                <?php
                    $isCta = ($item['variant'] ?? '') === 'cta';
                    $mobileClass = $isCta ? 'mobile-link mobile-link--cta' : 'mobile-link';
                    $dataRoute = $item['data_route'] ?? null;
                ?>
                <a href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>"
                   class="<?= htmlspecialchars($mobileClass, ENT_QUOTES, 'UTF-8'); ?>"
                   role="menuitem"
                   data-translate="<?= htmlspecialchars($item['mobile_translate'] ?? $item['translate'], ENT_QUOTES, 'UTF-8'); ?>"
                   <?= $dataRoute ? 'data-route="' . htmlspecialchars($dataRoute, ENT_QUOTES, 'UTF-8') . '"' : ''; ?>>
                    <?= htmlspecialchars($item['mobile_label'] ?? $item['label'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </header>
