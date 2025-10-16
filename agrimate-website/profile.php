<?php
require __DIR__ . '/includes/bootstrap.php';
requireAuth();

$pageTitle = 'FarmLink - Tableau de bord';
$metaDescription = 'Espace sécurisé FarmLink pour le suivi des déploiements.';
$metaRobots = 'noindex, nofollow';
$canonicalPath = '/profile.php';
$activeNav = '';

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main">
        <section class="section">
            <div class="container">
                <div class="form-card" style="text-align:center;">
                    <h1 class="section__title">Bienvenue</h1>
                    <p class="section__description">Votre espace personnalisé est en cours de modernisation. Contactez votre chargé de compte pour accéder à vos rapports et indicateurs.</p>
                    <a class="button button--primary" href="contact.php">Contacter le support</a>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
