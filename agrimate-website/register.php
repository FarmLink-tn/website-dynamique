<?php
require __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'FarmLink - Demander un accès';
$metaDescription = 'Demandez un accès au portail FarmLink pour suivre vos indicateurs et projets.';
$metaRobots = 'noindex, nofollow';
$canonicalPath = '/register.php';
$activeNav = '';

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main" tabindex="-1">
        <section id="account" class="py-20">
            <div class="container mx-auto px-6 text-center">
                <h2 class="section-title" data-translate="auth_register_title">Créer un compte</h2>
                <div class="max-w-xl mx-auto control-card mt-12">

                    <div id="register-section">
                        <form id="register-form" aria-describedby="register-instructions">
                            <p id="register-instructions" class="sr-only" data-translate="auth_register_instructions">Tous les champs sont obligatoires. Utilisez un mot de passe d'au moins huit caractères.</p>
                            <div class="mb-4 text-left">
                                <label for="register-last-name" class="block mb-2 text-sm font-medium text-text-300" data-translate="auth_last_name_label">Nom</label>
                                <input type="text" id="register-last-name" name="last_name" class="form-input" placeholder="Nom" data-translate-placeholder="auth_last_name_placeholder" required aria-required="true" autocomplete="family-name" aria-describedby="register-instructions">
                            </div>
                            <div class="mb-4 text-left">
                                <label for="register-first-name" class="block mb-2 text-sm font-medium text-text-300" data-translate="auth_first_name_label">Prénom</label>
                                <input type="text" id="register-first-name" name="first_name" class="form-input" placeholder="Prénom" data-translate-placeholder="auth_first_name_placeholder" required aria-required="true" autocomplete="given-name" aria-describedby="register-instructions">
                            </div>
                            <div class="mb-4 text-left">
                                <label for="register-email" class="block mb-2 text-sm font-medium text-text-300" data-translate="auth_email_label">Email</label>
                                <input type="email" id="register-email" name="email" class="form-input" placeholder="Email" data-translate-placeholder="auth_email_placeholder" required aria-required="true" autocomplete="email" aria-describedby="register-instructions">
                            </div>
                            <div class="mb-4 text-left">
                                <label for="register-phone" class="block mb-2 text-sm font-medium text-text-300" data-translate="auth_phone_label">Téléphone</label>
                                <input type="tel" id="register-phone" name="phone" class="form-input" placeholder="Téléphone" data-translate-placeholder="auth_phone_placeholder" required aria-required="true" autocomplete="tel" inputmode="tel" pattern="^\+?[0-9\s.-]{6,}$" aria-describedby="register-instructions">
                            </div>
                            <div class="mb-4 text-left">
                                <label for="register-region" class="block mb-2 text-sm font-medium text-text-300" data-translate="auth_region_label">Région</label>
                                <input type="text" id="register-region" name="region" class="form-input" placeholder="Région" data-translate-placeholder="auth_region_placeholder" required aria-required="true" autocomplete="address-level1" aria-describedby="register-instructions">
                            </div>
                            <div class="mb-4 text-left">
                                <label for="register-username" class="block mb-2 text-sm font-medium text-text-300" data-translate="auth_username_label">Nom d'utilisateur</label>
                                <input type="text" id="register-username" name="username" class="form-input" placeholder="Nom d'utilisateur" data-translate-placeholder="auth_username_placeholder" required aria-required="true" autocomplete="username" aria-describedby="register-instructions">
                            </div>
                            <div class="mb-4 text-left">
                                <label for="register-password" class="block mb-2 text-sm font-medium text-text-300" data-translate="auth_password_label">Mot de passe</label>
                                <input type="password" id="register-password" name="password" class="form-input" placeholder="Mot de passe" data-translate-placeholder="auth_password_placeholder" required aria-required="true" autocomplete="new-password" minlength="8" aria-describedby="register-instructions">
                            </div>
                            <button type="submit" class="button w-full" data-translate="auth_register_btn">Créer le compte</button>
                        </form>
                        <p id="register-message" class="mt-2 text-red-500"></p>
                        <p class="mt-4 text-text-300" data-translate="auth_login_prompt">Déjà un compte ? <a href="account.php" class="text-brand-blue-500 font-bold" data-route="account">Se connecter</a></p>
                    </div>

                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
