<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink - Politique de cookies';
$metaDescription = "Comprenez comment FarmLink utilise les cookies essentiels et analytiques ainsi que vos options de contrôle.";
$metaKeywords = 'FarmLink, cookies, politique, consentement';
$canonicalPath = '/cookies.php';
$activeNav = '';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" class="legal-main" role="main" tabindex="-1">
        <section class="legal-hero">
            <div class="container mx-auto px-6 py-16 text-center">
                <h1 class="section-title" data-translate="cookies_title">Politique de cookies</h1>
                <p class="legal-intro" data-translate="cookies_intro">Cette politique détaille les types de cookies utilisés sur FarmLink et les moyens de gérer vos préférences.</p>
            </div>
        </section>
        <section class="container mx-auto px-6 legal-section">
            <article class="legal-card" aria-labelledby="cookies-definition">
                <h2 id="cookies-definition" data-translate="cookies_definition_heading">Qu'est-ce qu'un cookie ?</h2>
                <p data-translate="cookies_definition_text">Un cookie est un petit fichier texte déposé sur votre appareil pour assurer le bon fonctionnement du site et améliorer votre expérience.</p>
            </article>
            <article class="legal-card" aria-labelledby="cookies-types">
                <h2 id="cookies-types" data-translate="cookies_types_heading">Cookies utilisés</h2>
                <ul class="legal-list">
                    <li data-translate="cookies_types_item_1">Cookies essentiels : nécessaires à la sécurité, à la gestion de session et au maintien de vos préférences linguistiques.</li>
                    <li data-translate="cookies_types_item_2">Cookies de performance : nous aident à mesurer l'utilisation du site pour améliorer nos services.</li>
                    <li data-translate="cookies_types_item_3">Aucun cookie publicitaire tiers n'est utilisé sur FarmLink.</li>
                </ul>
            </article>
            <article class="legal-card" aria-labelledby="cookies-control">
                <h2 id="cookies-control" data-translate="cookies_control_heading">Vos choix</h2>
                <p data-translate="cookies_control_text">Vous pouvez configurer votre navigateur pour bloquer ou supprimer les cookies. Certaines fonctionnalités essentielles de FarmLink peuvent toutefois ne plus fonctionner correctement.</p>
            </article>
            <article class="legal-card" aria-labelledby="cookies-contact">
                <h2 id="cookies-contact" data-translate="cookies_contact_heading">Nous contacter</h2>
                <p data-translate="cookies_contact_text">Pour toute question sur l'utilisation des cookies, écrivez-nous à contact@farmlink.tn.</p>
            </article>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
