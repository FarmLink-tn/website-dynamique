<?php
require __DIR__ . '/includes/bootstrap.php';

$pageLang = current_language();

$pageTitle = 'FarmLink - Conseiller IA';
$metaDescription = 'Explorez comment le conseiller IA FarmLink anticipe le stress hydrique et guide vos décisions agronomiques.';
$canonicalPath = '/ai-advisor.php';
$activeNav = 'ai';

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main">
        <section class="hero">
            <div class="container hero__layout">
                <div class="hero__content">
                    <p class="eyebrow">IA agronomique</p>
                    <h1 class="hero__title">Votre conseiller virtuel connecté au terrain</h1>
                    <p class="hero__description">Le moteur IA FarmLink analyse vos données de capteurs, images et journaux pour anticiper les stress, recommander des actions et alimenter vos rapports bailleurs en trois langues.</p>
                    <div class="hero__actions">
                        <a class="button button--primary" href="contact.php">Demander une démonstration</a>
                        <a class="button button--ghost" href="solutions.php">Voir les modules compatibles</a>
                    </div>
                </div>
                <figure class="hero__visual" aria-hidden="true">
                    <img src="image/karim-a.png" alt="Interface du conseiller IA FarmLink" loading="lazy" width="960" height="640">
                </figure>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="grid grid--three">
                    <article class="card">
                        <h3>Analyses multicanales</h3>
                        <p>Combinez images satellites, photos mobiles et données météo pour détecter ravageurs, stress hydrique et dérives de fertigation.</p>
                    </article>
                    <article class="card">
                        <h3>Alertes contextualisées</h3>
                        <p>Recevez des scénarios d’irrigation, recommandations phytosanitaires et consignes de sécurité adaptées à votre culture et à votre équipe.</p>
                    </article>
                    <article class="card">
                        <h3>Rapports instantanés</h3>
                        <p>Exportez des rapports prêts à partager avec les coopératives, bailleurs et certificateurs pour justifier vos actions.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="cta-block">
                    <h2>Connectons votre exploitation à l’IA FarmLink</h2>
                    <p>Nous calibrons le conseiller IA avec vos objectifs et votre historique pour délivrer des recommandations exploitables dès la première campagne.</p>
                    <a class="button button--primary" href="contact.php">Parler à un expert</a>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
