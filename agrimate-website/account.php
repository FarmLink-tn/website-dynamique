<?php
require __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'FarmLink - Espace client';
$metaDescription = 'Demandez un accès à l’espace client FarmLink pour suivre vos projets et vos déploiements.';
$metaRobots = 'noindex, nofollow';
$canonicalPath = '/account.php';
$activeNav = '';

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main">
        <section class="section">
            <div class="container">
                <div class="form-card" style="text-align:center;">
                    <h1 class="section__title">Espace client FarmLink</h1>
                    <p class="section__description">L’accès au portail est réservé à nos clients déployés. Contactez notre équipe pour activer votre compte et suivre vos projets.</p>
                    <a class="button button--primary" href="contact.php">Contacter l’équipe</a>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
