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
    <main id="main-content" role="main" tabindex="-1">
        <section id="ai-advisor" class="py-20">
            <div class="container mx-auto px-6 text-center">
                <h2 class="section-title" data-translate="ai_advisor_title">Conseiller Agricole IA</h2>

                <div class="max-w-3xl mx-auto control-card mt-12">
                    <div id="ai-results-container" class="ai-results-container mb-4">
                        <div id="image-preview-wrapper" class="hidden">
                            <img id="previewImg" alt="Aperçu de l'image">
                            <video id="cam" autoplay playsinline muted hidden></video>
                            <button id="captureBtn" class="capture-button hidden" title="Prendre une photo"><i class="fas fa-camera"></i></button>
                        </div>
                        <div id="ai-response-text" class="ai-response-text">
                            <p data-translate="ai_welcome">Bonjour ! Posez-moi une question sur vos cultures ou envoyez-moi une photo.</p>
                        </div>
                         <div id="ai-spinner" class="spinner mx-auto hidden"></div>
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
