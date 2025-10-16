<?php
$activeNav = $activeNav ?? '';
$pageLang = $pageLang ?? current_language();
$requestedPath = $requestedPath ?? (isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/');
$baseUrl = $baseUrl ?? 'https://farmlink.tn';
$navAccountPath = isAuthenticated() ? 'profile.php' : 'account.php';
$registerPath = 'register.php';
?>
<body class="dark" data-current-lang="<?= htmlspecialchars($pageLang, ENT_QUOTES, 'UTF-8'); ?>" data-request-path="<?= htmlspecialchars($requestedPath, ENT_QUOTES, 'UTF-8'); ?>" data-base-url="<?= htmlspecialchars(rtrim($baseUrl, '/'), ENT_QUOTES, 'UTF-8'); ?>" data-account-link="<?= htmlspecialchars($navAccountPath, ENT_QUOTES, 'UTF-8'); ?>" data-register-link="<?= htmlspecialchars($registerPath, ENT_QUOTES, 'UTF-8'); ?>" data-profile-link="profile.php">
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
                <li><a href="about.php" class="nav-link<?= $activeNav === 'about' ? ' active' : ''; ?>" data-translate="nav_about">À propos</a></li>
                <li><a href="how-it-works.php" class="nav-link<?= $activeNav === 'how' ? ' active' : ''; ?>" data-translate="nav_how_it_works">Comment ça marche</a></li>
                <li><a href="solutions.php" class="nav-link<?= $activeNav === 'solutions' ? ' active' : ''; ?>" data-translate="nav_solutions">Nos Solutions</a></li>
                <li><a href="ai-advisor.php" class="nav-link<?= $activeNav === 'ai' ? ' active' : ''; ?>" data-translate="nav_ai_advisor">Conseiller IA</a></li>
                <?php if (isAuthenticated()): ?>
                    <li><a href="profile.php" class="nav-link<?= $activeNav === 'dashboard' ? ' active' : ''; ?>" data-translate="nav_dashboard" data-route="profile">Tableau de bord</a></li>
                <?php else: ?>
                    <li><a href="account.php" class="nav-link<?= $activeNav === 'account' ? ' active' : ''; ?>" data-translate="nav_login" data-route="account">Se connecter</a></li>
                    <li><a href="register.php" class="nav-link<?= $activeNav === 'register' ? ' active' : ''; ?>" data-translate="nav_register" data-route="register">Créer un compte</a></li>
                <?php endif; ?>
                <li><a href="contact.php" class="button<?= $activeNav === 'contact' ? ' active' : ''; ?>" data-translate="nav_get_quote">Obtenir un devis</a></li>
            </ul>
            <div class="flex items-center space-x-3">
                <?php if (isAuthenticated()): ?>
                    <span class="hidden md:inline text-sm text-text-500"><span data-translate="nav_logged_in_prefix">Connecté en tant que</span> <span class="font-semibold"><?= htmlspecialchars($currentUser['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span></span>
                <?php endif; ?>
                <label for="language-switcher" class="sr-only">Choisir la langue</label>
                <select id="language-switcher" class="mr-1" aria-label="Sélectionner la langue">
                    <option value="fr">FR</option>
                    <option value="en">EN</option>
                    <option value="ar">AR</option>
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
            <a href="about.php" class="mobile-link" data-translate="nav_about_mobile" role="menuitem">À propos</a>
            <a href="how-it-works.php" class="mobile-link" data-translate="nav_how_it_works_mobile" role="menuitem">Comment ça marche</a>
            <a href="solutions.php" class="mobile-link" data-translate="nav_solutions_mobile" role="menuitem">Nos Solutions</a>
            <a href="ai-advisor.php" class="mobile-link" data-translate="nav_ai_advisor_mobile" role="menuitem">Conseiller IA</a>
            <?php if (isAuthenticated()): ?>
                <a href="profile.php" class="mobile-link" data-translate="nav_dashboard_mobile" data-route="profile" role="menuitem">Tableau de bord</a>
            <?php else: ?>
                <a href="account.php" class="mobile-link" data-translate="nav_login_mobile" data-route="account" role="menuitem">Se connecter</a>
                <a href="register.php" class="mobile-link" data-translate="nav_register_mobile" data-route="register" role="menuitem">Créer un compte</a>
            <?php endif; ?>
            <a href="contact.php" class="mobile-link" data-translate="nav_get_quote_mobile" role="menuitem">Obtenir un devis</a>
        </div>
    </header>
