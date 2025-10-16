<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = "FarmLink - Conditions d'utilisation";
$metaDescription = "Consultez les conditions d'utilisation de FarmLink couvrant l'accès aux services, les comptes clients et la responsabilité.";
$metaKeywords = 'FarmLink, conditions générales, CGU, Tunisie';
$canonicalPath = '/terms.php';
$activeNav = '';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" class="legal-main" role="main" tabindex="-1">
        <section class="legal-hero">
            <div class="container mx-auto px-6 py-16 text-center">
                <h1 class="section-title" data-translate="terms_title">Conditions d'utilisation</h1>
                <p class="legal-intro" data-translate="terms_intro">Ces conditions régissent l'utilisation du site et des services FarmLink par les agriculteurs, partenaires et visiteurs.</p>
            </div>
        </section>
        <section class="container mx-auto px-6 legal-section">
            <article class="legal-card" aria-labelledby="terms-usage">
                <h2 id="terms-usage" data-translate="terms_usage_heading">Utilisation du site</h2>
                <p data-translate="terms_usage_text">Vous vous engagez à utiliser FarmLink de manière conforme à la loi et à ne pas porter atteinte à l'intégrité du service ni aux droits de tiers.</p>
            </article>
            <article class="legal-card" aria-labelledby="terms-accounts">
                <h2 id="terms-accounts" data-translate="terms_accounts_heading">Comptes et sécurité</h2>
                <p data-translate="terms_accounts_text">Les accès réservés (tableau de bord, administration) sont strictement personnels. Vous devez protéger vos identifiants et signaler toute utilisation non autorisée.</p>
            </article>
            <article class="legal-card" aria-labelledby="terms-liability">
                <h2 id="terms-liability" data-translate="terms_liability_heading">Responsabilité</h2>
                <p data-translate="terms_liability_text">FarmLink met en œuvre des mesures techniques pour assurer la disponibilité du service. Nous ne pouvons toutefois être tenus responsables des dommages indirects ou causés par une mauvaise utilisation.</p>
            </article>
            <article class="legal-card" aria-labelledby="terms-changes">
                <h2 id="terms-changes" data-translate="terms_changes_heading">Modifications</h2>
                <p data-translate="terms_changes_text">Nous pouvons mettre à jour ces conditions pour refléter l'évolution de nos services ou la réglementation. Les nouvelles versions prennent effet dès leur publication.</p>
            </article>
            <article class="legal-card" aria-labelledby="terms-contact">
                <h2 id="terms-contact" data-translate="terms_contact_heading">Nous contacter</h2>
                <p data-translate="terms_contact_text">Pour toute question relative à ces conditions, écrivez-nous à contact@farmlink.tn. Nous répondrons dans les meilleurs délais.</p>
            </article>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
