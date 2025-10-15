<?php
require __DIR__ . '/includes/bootstrap.php';
if (isAuthenticated()) {
    header('Location: /profile.php');
    exit;
}
$pageTitle = 'FarmLink - Créer un compte';
$activeNav = 'account';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main>
        <section id="account" class="py-20">
            <div class="container mx-auto px-6 text-center">
                <h2 class="section-title" data-translate="auth_register_title">Créer un compte</h2>
                <div class="max-w-xl mx-auto control-card mt-12">

                    <div id="register-section">
                        <h3 class="text-2xl font-bold mb-6 text-brand-green-400" data-translate="auth_register_title">Créer un compte</h3>
                        <form id="register-form">
                            <div class="mb-4">
                                <input type="text" id="register-last-name" class="form-input" placeholder="Nom" data-translate-placeholder="auth_last_name_placeholder" required>
                            </div>
                            <div class="mb-4">
                                <input type="text" id="register-first-name" class="form-input" placeholder="Prénom" data-translate-placeholder="auth_first_name_placeholder" required>
                            </div>
                            <div class="mb-4">
                                <input type="email" id="register-email" class="form-input" placeholder="Email" data-translate-placeholder="auth_email_placeholder" required>
                            </div>
                            <div class="mb-4">
                                <input type="tel" id="register-phone" class="form-input" placeholder="Téléphone" data-translate-placeholder="auth_phone_placeholder" required>
                            </div>
                            <div class="mb-4">
                                <input type="text" id="register-region" class="form-input" placeholder="Région" data-translate-placeholder="auth_region_placeholder" required>
                            </div>
                            <div class="mb-4">
                                <input type="text" id="register-username" class="form-input" placeholder="Nom d'utilisateur" required>
                            </div>
                            <div class="mb-4">
                                <input type="password" id="register-password" class="form-input" placeholder="Mot de passe" required>
                            </div>
                            <button type="submit" class="button w-full" data-translate="auth_register_btn">Créer le compte</button>
                        </form>
                        <p id="register-message" class="mt-2 text-red-500"></p>
                        <p class="mt-4 text-text-300" data-translate="auth_login_prompt">Déjà un compte ? <a href="/account.php" class="text-brand-blue-500 font-bold" data-route="account">Se connecter</a></p>
                    </div>

                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
