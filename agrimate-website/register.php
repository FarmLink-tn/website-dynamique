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
    <main id="main-content" role="main">
        <section class="section">
            <div class="container">
                <div class="form-card" style="text-align:center;">
                    <h1 class="section__title">Demande d’accès</h1>
                    <p class="section__description">Nos équipes activent les comptes clients après signature du projet. Contactez-nous pour initier votre onboarding.</p>
                    <a class="button button--primary" href="contact.php">Planifier un échange</a>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
