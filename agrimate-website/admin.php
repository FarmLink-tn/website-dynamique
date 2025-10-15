<?php
require __DIR__ . '/includes/bootstrap.php';
requireAdmin('/account.php');
$pageTitle = 'FarmLink - Administration';
$activeNav = 'account';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main>
        <section id="admin-dashboard" class="py-16">
            <div class="container mx-auto px-6">
                <h2 class="section-title mb-10">Panel d'administration</h2>
                <div class="grid md:grid-cols-3 gap-6 mb-12">
                    <div class="control-card text-left">
                        <p class="text-sm text-text-500">Utilisateurs inscrits</p>
                        <p class="text-3xl font-bold" id="stat-total-users">0</p>
                    </div>
                    <div class="control-card text-left">
                        <p class="text-sm text-text-500">Modules IoT</p>
                        <p class="text-3xl font-bold" id="stat-total-products">0</p>
                    </div>
                    <div class="control-card text-left">
                        <p class="text-sm text-text-500">Valves ouvertes</p>
                        <p class="text-3xl font-bold" id="stat-open-valves">0</p>
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-10">
                    <div class="control-card overflow-x-auto">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-brand-blue-500">Utilisateurs</h3>
                            <button id="refresh-users" class="button button--glass text-sm">Actualiser</button>
                        </div>
                        <table class="table-auto w-full text-text-300">
                            <thead>
                                <tr>
                                    <th class="px-2 py-2 text-left">Nom</th>
                                    <th class="px-2 py-2 text-left">Prénom</th>
                                    <th class="px-2 py-2 text-left">Email</th>
                                    <th class="px-2 py-2 text-left">Région</th>
                                    <th class="px-2 py-2 text-left">Rôle</th>
                                </tr>
                            </thead>
                            <tbody id="admin-user-list"></tbody>
                        </table>
                    </div>

                    <div class="control-card overflow-x-auto">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-brand-green-400">Modules IoT</h3>
                            <button id="refresh-admin-products" class="button button--glass text-sm">Actualiser</button>
                        </div>
                        <table class="table-auto w-full text-text-300">
                            <thead>
                                <tr>
                                    <th class="px-2 py-2 text-left">Utilisateur</th>
                                    <th class="px-2 py-2 text-left">Module</th>
                                    <th class="px-2 py-2 text-left">Qté</th>
                                    <th class="px-2 py-2 text-left">Humidité</th>
                                    <th class="px-2 py-2 text-left">Valve</th>
                                </tr>
                            </thead>
                            <tbody id="admin-product-list"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
