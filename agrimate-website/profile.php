<?php
require __DIR__ . '/includes/bootstrap.php';
requireAuth('account.php');
$pageTitle = 'FarmLink - Tableau de bord';
$activeNav = 'account';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main>
        <section id="profile" class="py-20">
            <div class="container mx-auto px-6 text-center">
                <h2 class="section-title">Mon Profil</h2>
                <div class="max-w-xl mx-auto control-card mt-12 text-left">
                    <form id="profile-form">
                        <div class="mb-4">
                            <input type="text" id="profile-last-name" class="form-input" placeholder="Nom" required>
                        </div>
                        <div class="mb-4">
                            <input type="text" id="profile-first-name" class="form-input" placeholder="Prénom" required>
                        </div>
                        <div class="mb-4">
                            <input type="email" id="profile-email" class="form-input" placeholder="Email" required>
                        </div>
                        <div class="mb-4">
                            <input type="tel" id="profile-phone" class="form-input" placeholder="Téléphone" required>
                        </div>
                        <div class="mb-4">
                            <input type="text" id="profile-region" class="form-input" placeholder="Région" required>
                        </div>
                        <button type="submit" class="button w-full">Mettre à jour</button>
                    </form>
                    <p id="profile-message" class="mt-2 text-red-500"></p>
                </div>
            </div>
        </section>

        <section id="iot-dashboard" class="py-10 bg-bg-850">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                    <h3 class="text-2xl font-bold text-brand-blue-500">Dashboard IoT</h3>
                    <button id="logout-btn" class="button button--glass" data-translate="logout_btn">Se déconnecter</button>
                </div>
                <div class="grid md:grid-cols-3 gap-6 mb-10" id="iot-metrics">
                    <div class="control-card text-left">
                        <p class="text-sm text-text-500">Modules actifs</p>
                        <p class="text-3xl font-bold" id="metric-active-modules">0</p>
                    </div>
                    <div class="control-card text-left">
                        <p class="text-sm text-text-500">Humidité moyenne</p>
                        <p class="text-3xl font-bold" id="metric-avg-humidity">0%</p>
                    </div>
                    <div class="control-card text-left">
                        <p class="text-sm text-text-500">Ouvertures de valve</p>
                        <p class="text-3xl font-bold" id="metric-open-valves">0</p>
                    </div>
                </div>
                <div class="control-card overflow-x-auto">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-xl font-bold text-brand-green-400" data-translate="products_section_title">Mes Produits</h4>
                        <button id="refresh-products" class="button button--glass text-sm">Actualiser</button>
                    </div>
                    <table class="table-auto w-full text-text-300">
                        <thead>
                            <tr>
                                <th class="px-2 py-2">Nom</th>
                                <th class="px-2 py-2">Qté</th>
                                <th class="px-2 py-2">pH</th>
                                <th class="px-2 py-2">Pluie</th>
                                <th class="px-2 py-2">Humidité</th>
                                <th class="px-2 py-2">Humidité sol</th>
                                <th class="px-2 py-2">Lumière</th>
                                <th class="px-2 py-2">Valve</th>
                                <th class="px-2 py-2">Angle</th>
                                <th class="px-2 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="dashboard-product-list"></tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
