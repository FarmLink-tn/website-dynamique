<?php
require __DIR__ . '/includes/bootstrap.php';
if (isAuthenticated()) {
    header('Location: profile.php');
    exit;
}
$pageTitle = 'FarmLink - Mon Compte';
$metaDescription = "Accédez à votre compte FarmLink pour gérer vos produits agricoles, consulter vos données et profiter des services connectés.";
$metaKeywords = 'FarmLink compte, tableau de bord agriculteur, gestion produits';
$metaRobots = 'noindex, nofollow';
$canonicalPath = '/account.php';
$activeNav = 'account';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main" tabindex="-1">
        <section id="account" class="py-20">
            <div class="container mx-auto px-6 text-center">
                <h2 class="section-title" data-translate="account_title">Mon Compte</h2>
                <div class="max-w-xl mx-auto control-card mt-12">
                    <div id="auth-section">
                        <h3 class="text-2xl font-bold mb-6 text-brand-blue-500" data-translate="auth_login_title">Se connecter</h3>
                        <form id="login-form" aria-describedby="login-instructions">
                            <p id="login-instructions" class="sr-only" data-translate="auth_login_instructions">Saisissez votre nom d'utilisateur et votre mot de passe pour accéder à votre espace sécurisé FarmLink.</p>
                            <div class="mb-4 text-left">
                                <label for="login-username" class="block mb-2 text-sm font-medium text-text-300" data-translate="auth_username_label">Nom d'utilisateur</label>
                                <input type="text" id="login-username" name="username" class="form-input" placeholder="Nom d'utilisateur" data-translate-placeholder="auth_username_placeholder" required aria-required="true" autocomplete="username" aria-describedby="login-instructions">
                            </div>
                            <div class="mb-6 text-left">
                                <label for="login-password" class="block mb-2 text-sm font-medium text-text-300" data-translate="auth_password_label">Mot de passe</label>
                                <input type="password" id="login-password" name="password" class="form-input" placeholder="Mot de passe" data-translate-placeholder="auth_password_placeholder" required aria-required="true" autocomplete="current-password" minlength="8" aria-describedby="login-instructions">
                            </div>
                            <button type="submit" class="button w-full" data-translate="auth_login_btn">Se connecter</button>
                        </form>
                        <p id="login-message" class="mt-2 text-red-500"></p>
                        <p class="mt-4 text-text-300" data-translate="auth_register_prompt">Pas encore de compte ? <a href="register.php" class="text-brand-green-400 font-bold" data-route="register">Créer un compte</a></p>
                    </div>

                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
