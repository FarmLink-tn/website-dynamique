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
    <main>
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
                        <p class="mt-4 text-text-300" data-translate="auth_register_prompt">Pas encore de compte ? <a href="/register.php" class="text-brand-green-400 font-bold" data-route="register">Créer un compte</a></p>
                    </div>

                    <div id="user-dashboard" class="hidden text-left">
                        <h3 id="welcome-message" class="text-2xl font-bold mb-4"></h3>
                        <div class="mb-8">
                            <h4 class="text-xl font-bold text-brand-blue-500 mb-2" data-translate="products_section_title">Mes Produits</h4>
                            <form id="add-product-form" class="grid grid-cols-1 gap-4" aria-describedby="product-instructions">
                                <p id="product-instructions" class="sr-only" data-translate="product_form_instructions">Renseignez les informations clés de votre produit pour mettre à jour le tableau de bord.</p>
                                <label class="sr-only" for="product-name" data-translate="product_name_label">Nom du produit</label>
                                <input type="text" id="product-name" name="name" class="form-input" placeholder="Nom du produit" data-translate-placeholder="product_name_placeholder" required aria-required="true" aria-describedby="product-instructions">
                                <label class="sr-only" for="product-quantity" data-translate="product_quantity_label">Quantité</label>
                                <input type="number" id="product-quantity" name="quantity" class="form-input" placeholder="Quantité" data-translate-placeholder="product_quantity_placeholder" required aria-required="true" min="0" step="1" aria-describedby="product-instructions">
                                <label class="sr-only" for="product-phone" data-translate="product_phone_label">Téléphone GSM</label>
                                <input type="tel" id="product-phone" name="phone" class="form-input" placeholder="Téléphone GSM" data-translate-placeholder="product_phone_placeholder" required aria-required="true" inputmode="tel" pattern="^\+?[0-9\s.-]{6,}$" aria-describedby="product-instructions">
                                <label class="sr-only" for="product-ph" data-translate="product_ph_label">pH</label>
                                <input type="number" step="0.01" id="product-ph" name="ph" class="form-input" placeholder="pH" data-translate-placeholder="product_ph_placeholder" min="0" max="14" aria-describedby="product-instructions">
                                <label class="sr-only" for="product-rain" data-translate="product_rain_label">Pluie</label>
                                <input type="number" step="0.01" id="product-rain" name="rain" class="form-input" placeholder="Pluie" data-translate-placeholder="product_rain_placeholder" min="0" aria-describedby="product-instructions">
                                <label class="sr-only" for="product-humidity" data-translate="product_humidity_label">Humidité</label>
                                <input type="number" step="0.01" id="product-humidity" name="humidity" class="form-input" placeholder="Humidité" data-translate-placeholder="product_humidity_placeholder" min="0" max="100" aria-describedby="product-instructions">
                                <label class="sr-only" for="product-soil_humidity" data-translate="product_soil_humidity_label">Humidité du sol</label>
                                <input type="number" step="0.01" id="product-soil_humidity" name="soil_humidity" class="form-input" placeholder="Humidité du sol" data-translate-placeholder="product_soil_humidity_placeholder" min="0" max="100" aria-describedby="product-instructions">
                                <label class="sr-only" for="product-light" data-translate="product_light_label">Lumière</label>
                                <input type="number" step="0.01" id="product-light" name="light" class="form-input" placeholder="Lumière" data-translate-placeholder="product_light_placeholder" min="0" aria-describedby="product-instructions">
                                <div class="flex items-center">
                                    <input type="checkbox" id="product-valve_open" name="valve_open" class="mr-2" aria-describedby="product-instructions">
                                    <label for="product-valve_open" data-translate="product_valve_open_label">Valve ouverte</label>
                                </div>
                                <label class="sr-only" for="product-valve_angle" data-translate="product_valve_angle_label">Angle de valve</label>
                                <input type="number" id="product-valve_angle" name="valve_angle" class="form-input" placeholder="Angle de valve" data-translate-placeholder="product_valve_angle_placeholder" min="0" max="180" aria-describedby="product-instructions">
                                <button type="submit" class="button" data-translate="add_product_btn">Ajouter</button>
                            </form>
                            <table id="product-table" class="table-auto w-full mt-4 text-text-300">
                                <thead>
                                    <tr>
                                        <th class="px-2">Nom</th>
                                        <th class="px-2">Qté</th>
                                        <th class="px-2">pH</th>
                                        <th class="px-2">Pluie</th>
                                        <th class="px-2">Humidité</th>
                                        <th class="px-2">Humidité sol</th>
                                        <th class="px-2">Lumière</th>
                                        <th class="px-2">Valve</th>
                                        <th class="px-2">Angle</th>
                                    </tr>
                                </thead>
                                <tbody id="product-list"></tbody>
                            </table>
                        </div>
                        <button id="logout-btn" class="button button--glass" data-translate="logout_btn">Se déconnecter</button>
                    </div>

                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
