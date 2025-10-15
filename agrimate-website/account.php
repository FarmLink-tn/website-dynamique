<?php
require __DIR__ . '/includes/bootstrap.php';
if (isAuthenticated()) {
    header('Location: profile.php');
    exit;
}
$pageTitle = 'FarmLink - Mon Compte';
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
                        <form id="login-form">
                            <div class="mb-4">
                                <input type="text" id="login-username" class="form-input" placeholder="Nom d'utilisateur" required>
                            </div>
                            <div class="mb-6">
                                <input type="password" id="login-password" class="form-input" placeholder="Mot de passe" required>
                            </div>
                            <button type="submit" class="button w-full" data-translate="auth_login_btn">Se connecter</button>
                        </form>
                        <p id="login-message" class="mt-2 text-red-500"></p>
                        <p class="mt-4 text-text-300" data-translate="auth_register_prompt">Pas encore de compte ? <a href="register.php" class="text-brand-green-400 font-bold" data-route="register">Créer un compte</a></p>
                    </div>

                    <div id="user-dashboard" class="hidden text-left">
                        <h3 id="welcome-message" class="text-2xl font-bold mb-4"></h3>
                        <div class="mb-8">
                            <h4 class="text-xl font-bold text-brand-blue-500 mb-2" data-translate="products_section_title">Mes Produits</h4>
                            <form id="add-product-form" class="grid grid-cols-1 gap-4">
                                <input type="text" id="product-name" class="form-input" placeholder="Nom du produit" required>
                                <input type="number" id="product-quantity" class="form-input" placeholder="Quantité" required>
                                <input type="tel" id="product-phone" class="form-input" placeholder="Téléphone GSM" required>
                                <input type="number" step="0.01" id="product-ph" class="form-input" placeholder="pH">
                                <input type="number" step="0.01" id="product-rain" class="form-input" placeholder="Pluie">
                                <input type="number" step="0.01" id="product-humidity" class="form-input" placeholder="Humidité">
                                <input type="number" step="0.01" id="product-soil_humidity" class="form-input" placeholder="Humidité du sol">
                                <input type="number" step="0.01" id="product-light" class="form-input" placeholder="Lumière">
                                <div class="flex items-center">
                                    <input type="checkbox" id="product-valve_open" class="mr-2">
                                    <label for="product-valve_open">Valve ouverte</label>
                                </div>
                                <input type="number" id="product-valve_angle" class="form-input" placeholder="Angle de valve">
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
