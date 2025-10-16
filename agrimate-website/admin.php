<?php
require __DIR__ . '/includes/bootstrap.php';
requireAdmin();

$pageTitle = 'FarmLink - Administration';
$metaDescription = 'Espace d’administration FarmLink.';
$metaRobots = 'noindex, nofollow';
$canonicalPath = '/admin.php';
$activeNav = '';

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main">
        <section class="section">
            <div class="container">
                <div class="form-card" style="text-align:center;">
                    <h1 class="section__title">Administration</h1>
                    <p class="section__description">Les outils d’administration seront intégrés à la nouvelle plateforme. Merci de contacter l’équipe support pour toute intervention.</p>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
