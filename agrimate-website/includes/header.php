<?php
$activeNav = $activeNav ?? '';
?>
<body class="dark" data-account-link="/account.php" data-register-link="/register.php">
    <header class="sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="index.php">
                    <img src="image/logo.png" alt="Logo FarmLink" class="h-14 w-auto">
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="/about.php" class="nav-link<?= $activeNav === 'about' ? ' active' : ''; ?>" data-translate="nav_about">À propos</a>
                <a href="/how-it-works.php" class="nav-link<?= $activeNav === 'how' ? ' active' : ''; ?>" data-translate="nav_how_it_works">Comment ça marche</a>
                <a href="/solutions.php" class="nav-link<?= $activeNav === 'solutions' ? ' active' : ''; ?>" data-translate="nav_solutions">Nos Solutions</a>
                <a href="/ai-advisor.php" class="nav-link<?= $activeNav === 'ai' ? ' active' : ''; ?>" data-translate="nav_ai_advisor">Conseiller IA</a>
                <a href="/account.php" class="nav-link<?= $activeNav === 'account' ? ' active' : ''; ?>" data-translate="nav_account" data-route="account">Mon Compte</a>
                <a href="/contact.php" class="button<?= $activeNav === 'contact' ? ' active' : ''; ?>" data-translate="nav_get_quote">Obtenir un devis</a>
            </div>
            <div class="flex items-center space-x-3">
                <?php if (isAuthenticated()): ?>
                    <span class="hidden md:inline text-sm text-text-500">👋 <?= htmlspecialchars($currentUser['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php if (isAdmin()): ?>
                        <a href="admin.php" class="button button--glass text-xs">Admin</a>
                    <?php endif; ?>
                <?php endif; ?>
                <select id="language-switcher" class="mr-1">
                    <option value="fr">FR</option>
                    <option value="en">EN</option>
                    <option value="ar">AR</option>
                </select>
                <div class="flex items-center cursor-pointer" id="theme-toggle">
                    <svg id="theme-icon-light" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg id="theme-icon-dark" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </div>
                <div class="md:hidden ml-2">
                    <button id="menu-btn" class="focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </div>
        </nav>
        <div id="mobile-menu" class="hidden md:hidden p-4 mt-2 mx-4">
            <a href="/about.php" class="block py-2 px-4 text-sm" data-translate="nav_about_mobile">À propos</a>
            <a href="/how-it-works.php" class="block py-2 px-4 text-sm" data-translate="nav_how_it_works_mobile">Comment ça marche</a>
            <a href="/solutions.php" class="block py-2 px-4 text-sm" data-translate="nav_solutions_mobile">Nos Solutions</a>
            <a href="/ai-advisor.php" class="block py-2 px-4 text-sm" data-translate="nav_ai_advisor_mobile">Conseiller IA</a>
            <a href="/account.php" class="block py-2 px-4 text-sm" data-translate="nav_account_mobile" data-route="account">Mon Compte</a>
            <a href="/contact.php" class="block py-2 px-4 text-sm" data-translate="nav_get_quote_mobile">Obtenir un devis</a>
            <?php if (isAdmin()): ?>
                <a href="admin.php" class="block py-2 px-4 text-sm">Admin</a>
            <?php endif; ?>
        </div>
    </header>
