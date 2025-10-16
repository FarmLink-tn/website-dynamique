<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink - Déploiement des solutions retrofit et IA';
$metaDescription = "Suivez la méthodologie FarmLink pour connecter votre exploitation : audit, installation retrofit, configuration cloud et coaching agronomique continu.";
$metaKeywords = 'FarmLink méthodologie, retrofit agricole, déploiement IoT, coaching agronomique';
$canonicalPath = '/how-it-works.php';
$activeNav = 'how';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main" tabindex="-1" class="page">
        <section class="page-hero" aria-labelledby="process-hero-heading">
            <div class="page-hero__media" aria-hidden="true">
                <img src="image/background_im2.png" width="1800" height="1200" loading="lazy" decoding="async" alt="Technicien FarmLink installant un coffret connecté" class="page-hero__image">
                <div class="page-hero__overlay"></div>
            </div>
            <div class="page-hero__content container">
                <p class="page-hero__eyebrow" data-translate="process_eyebrow">Déploiement en 3 étapes</p>
                <h1 id="process-hero-heading" class="page-hero__title" data-translate="process_title">Une méthodologie terrain éprouvée</h1>
                <p class="page-hero__description" data-translate="process_subtitle">Nos équipes accompagnent les exploitations tunisiennes, du diagnostic initial aux plans de progrès IA, pour un changement durable.</p>
            </div>
        </section>

        <section class="section" aria-labelledby="steps-heading">
            <div class="container">
                <div class="section__header">
                    <h2 id="steps-heading" class="section__title" data-translate="process_steps_title">Trois phases structurées et pilotées par la donnée</h2>
                </div>
                <ol class="process-list process-list--detailed" aria-labelledby="steps-heading">
                    <li class="process-list__item">
                        <span class="process-list__badge" aria-hidden="true">1</span>
                        <h3 class="process-list__title" data-translate="process_step1_title">Audit & co-conception</h3>
                        <p class="process-list__description" data-translate="process_step1_desc">Analyse des parcelles, connexion des compteurs existants et montage du dossier de financement (subventions, crédits verts).</p>
                        <ul class="process-list__bullets">
                            <li data-translate="process_step1_point1">Cartographie hydraulique et électrique de l'exploitation</li>
                            <li data-translate="process_step1_point2">Définition des KPI eau, énergie, rendement et qualité</li>
                            <li data-translate="process_step1_point3">Planification du chantier en coordination avec vos équipes</li>
                        </ul>
                    </li>
                    <li class="process-list__item">
                        <span class="process-list__badge" aria-hidden="true">2</span>
                        <h3 class="process-list__title" data-translate="process_step2_title">Installation retrofit</h3>
                        <p class="process-list__description" data-translate="process_step2_desc">Pose des capteurs, des contrôleurs et paramétrage de la plateforme sans interrompre la production.</p>
                        <ul class="process-list__bullets">
                            <li data-translate="process_step2_point1">Montage des coffrets intelligents et raccordement LoRaWAN/4G</li>
                            <li data-translate="process_step2_point2">Calibration des sondes sol, fertigation et météo locale</li>
                            <li data-translate="process_step2_point3">Formation initiale à l'usage de la plateforme et du conseiller IA</li>
                        </ul>
                    </li>
                    <li class="process-list__item">
                        <span class="process-list__badge" aria-hidden="true">3</span>
                        <h3 class="process-list__title" data-translate="process_step3_title">Coaching & optimisation</h3>
                        <p class="process-list__description" data-translate="process_step3_desc">Accompagnement saisonnier, alertes IA personnalisées et intégration avec vos partenaires de la chaîne de valeur.</p>
                        <ul class="process-list__bullets">
                            <li data-translate="process_step3_point1">Suivi mensuel des KPI et ajustements des scénarios</li>
                            <li data-translate="process_step3_point2">Support 7j/7 et visites terrain lors des périodes critiques</li>
                            <li data-translate="process_step3_point3">Connexion des données aux coopératives, financeurs et assureurs</li>
                        </ul>
                    </li>
                </ol>
            </div>
        </section>

        <section class="section section--alt" aria-labelledby="deliverables-heading">
            <div class="container">
                <div class="section__header">
                    <p class="section__eyebrow" data-translate="process_deliverables_eyebrow">Livrables clés</p>
                    <h2 id="deliverables-heading" class="section__title" data-translate="process_deliverables_title">Ce que vous recevez à chaque étape</h2>
                </div>
                <div class="grid grid--deliverables" role="list">
                    <article class="deliverable-card" role="listitem">
                        <h3 class="deliverable-card__title" data-translate="process_deliverable1_title">Dossier technique & financier</h3>
                        <p class="deliverable-card__description" data-translate="process_deliverable1_desc">Plan d'équipement, schémas d'intégration, budget détaillé et simulations ROI pour faciliter l'obtention des financements.</p>
                    </article>
                    <article class="deliverable-card" role="listitem">
                        <h3 class="deliverable-card__title" data-translate="process_deliverable2_title">Plateforme configurée & data live</h3>
                        <p class="deliverable-card__description" data-translate="process_deliverable2_desc">Dashboard multilingue, accès mobile, intégration des capteurs et alertes automatisées prêtes à l'emploi.</p>
                    </article>
                    <article class="deliverable-card" role="listitem">
                        <h3 class="deliverable-card__title" data-translate="process_deliverable3_title">Plan de progrès agronomique</h3>
                        <p class="deliverable-card__description" data-translate="process_deliverable3_desc">Calendrier des interventions, recommandations IA saisonnières et reporting destiné aux coopératives et bailleurs.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="assistance-heading">
            <div class="container">
                <div class="section__header">
                    <p class="section__eyebrow" data-translate="process_support_eyebrow">Support continu</p>
                    <h2 id="assistance-heading" class="section__title" data-translate="process_support_title">Des experts disponibles 7j/7</h2>
                    <p class="section__description" data-translate="process_support_desc">Un chargé de compte dédié, une hotline multilingue et un centre de monitoring vous accompagnent tout au long de la campagne.</p>
                </div>
                <div class="support-grid">
                    <div class="support-grid__item">
                        <h3 class="support-grid__title" data-translate="process_support_item1_title">Centre d'opérations</h3>
                        <p class="support-grid__description" data-translate="process_support_item1_desc">Supervision en temps réel des alertes, assistance à distance et recommandations IA contextualisées.</p>
                    </div>
                    <div class="support-grid__item">
                        <h3 class="support-grid__title" data-translate="process_support_item2_title">Visites agronomiques</h3>
                        <p class="support-grid__description" data-translate="process_support_item2_desc">Campagnes de mesures sur site, analyses de sol et ajustements fertigation & irrigation.</p>
                    </div>
                    <div class="support-grid__item">
                        <h3 class="support-grid__title" data-translate="process_support_item3_title">Académie FarmLink</h3>
                        <p class="support-grid__description" data-translate="process_support_item3_desc">Formations en présentiel ou en ligne, tutoriels vidéo et ressources traduites en arabe, français et anglais.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section--cta" aria-labelledby="process-cta-heading">
            <div class="container section__header section__header--center">
                <h2 id="process-cta-heading" class="section__title" data-translate="process_cta_title">Prêt à lancer l'audit de votre exploitation ?</h2>
                <p class="section__description" data-translate="process_cta_desc">Prenez rendez-vous avec nos experts pour une première estimation gratuite et un plan de modernisation sur-mesure.</p>
                <a href="contact.php" class="button button--primary" data-translate="process_cta_button">Réserver un diagnostic</a>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
