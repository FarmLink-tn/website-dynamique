<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink - Politique de confidentialité';
$metaDescription = "Découvrez comment FarmLink protège vos données personnelles, vos préférences et vos communications.";
$metaKeywords = 'FarmLink, politique de confidentialité, données personnelles, sécurité, Tunisie';
$canonicalPath = '/privacy.php';
$activeNav = '';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" class="legal-main" role="main" tabindex="-1">
        <section class="legal-hero">
            <div class="container mx-auto px-6 py-16 text-center">
                <h1 class="section-title" data-translate="privacy_title">Politique de confidentialité</h1>
                <p class="legal-intro" data-translate="privacy_intro">Cette politique explique comment FarmLink collecte, utilise et protège les informations personnelles de ses utilisateurs et clients.</p>
            </div>
        </section>
        <section class="container mx-auto px-6 legal-section" aria-labelledby="privacy-collection">
            <article class="legal-card">
                <h2 id="privacy-collection" data-translate="privacy_collection_heading">Données que nous collectons</h2>
                <p data-translate="privacy_collection_text">Nous collectons uniquement les informations nécessaires pour fournir nos services et répondre à vos demandes.</p>
                <ul class="legal-list">
                    <li data-translate="privacy_collection_item_1">Données d'identité : nom, prénom, entreprise et coordonnées.</li>
                    <li data-translate="privacy_collection_item_2">Données de contact : adresse email, numéro de téléphone et préférences linguistiques.</li>
                    <li data-translate="privacy_collection_item_3">Données d'utilisation : interactions sur le site, demandes envoyées et réponses reçues.</li>
                </ul>
            </article>
            <article class="legal-card" aria-labelledby="privacy-use">
                <h2 id="privacy-use" data-translate="privacy_use_heading">Comment nous utilisons vos données</h2>
                <ul class="legal-list">
                    <li data-translate="privacy_use_item_1">Répondre à vos demandes de contact et préparer des devis personnalisés.</li>
                    <li data-translate="privacy_use_item_2">Assurer le suivi de votre compte FarmLink et sécuriser l'accès aux tableaux de bord.</li>
                    <li data-translate="privacy_use_item_3">Améliorer nos services, mesurer les performances et détecter les tentatives de fraude.</li>
                </ul>
            </article>
            <article class="legal-card" aria-labelledby="privacy-legal">
                <h2 id="privacy-legal" data-translate="privacy_legal_heading">Base légale & conservation</h2>
                <p data-translate="privacy_legal_text">Vos données sont traitées sur la base de votre consentement, de l'exécution d'un contrat ou de nos intérêts légitimes. Elles sont conservées pendant la durée de la relation commerciale, puis archivées pendant la période légale nécessaire.</p>
            </article>
            <article class="legal-card" aria-labelledby="privacy-rights">
                <h2 id="privacy-rights" data-translate="privacy_rights_heading">Vos droits</h2>
                <p data-translate="privacy_rights_intro">Conformément au RGPD et à la loi tunisienne, vous disposez des droits suivants :</p>
                <ul class="legal-list">
                    <li data-translate="privacy_rights_item_1">Accéder à vos données et en obtenir une copie.</li>
                    <li data-translate="privacy_rights_item_2">Rectifier des informations inexactes ou incomplètes.</li>
                    <li data-translate="privacy_rights_item_3">Demander l'effacement de vos données ou la limitation du traitement.</li>
                    <li data-translate="privacy_rights_item_4">Vous opposer au traitement ou retirer votre consentement à tout moment.</li>
                </ul>
            </article>
            <article class="legal-card" aria-labelledby="privacy-contact">
                <h2 id="privacy-contact" data-translate="privacy_contact_heading">Contact et réclamations</h2>
                <p data-translate="privacy_contact_text">Pour exercer vos droits ou poser une question, contactez-nous à l'adresse contact@farmlink.tn. Vous pouvez également saisir l'autorité de protection des données compétente.</p>
            </article>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
