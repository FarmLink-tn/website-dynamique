<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink Tunisie - Agriculture intelligente et retrofit IoT';
$metaDescription = "FarmLink transforme les exploitations agricoles tunisiennes grâce à l'IoT, l'intelligence artificielle et des solutions retrofit abordables pour connecter l'irrigation, la fertigation et la chaîne de valeur.";
$metaKeywords = 'FarmLink Tunisie, agriculture intelligente, retrofit IoT, irrigation connectée, conseiller IA, transformation digitale';
$canonicalPath = '/';
$activeNav = 'home';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main" tabindex="-1">
        <section id="home" class="hero-bg text-white min-h-screen flex items-center relative overflow-hidden">
            <picture class="hero-media" aria-hidden="true">
                <img src="image/background_im2.png" alt="Champ irrigué connecté au coucher du soleil" class="hero-image" width="1024" height="559" loading="eager" decoding="async" fetchpriority="high">
            </picture>
            <div class="absolute inset-0 bg-black bg-opacity-60 z-10" aria-hidden="true"></div>
            <div class="container mx-auto px-6 text-left md:w-1/2 relative z-20" data-aos="fade-right">
                <h1 class="text-5xl md:text-7xl font-bold mb-4 leading-tight" data-translate="hero_title">Du traditionnel au smart - connectez votre ferme à l'avenir.</h1>
                <p class="text-xl mb-8" data-translate="hero_subtitle">Solutions de modernisation abordables pour une agriculture plus efficace.</p>
                <a href="solutions.php" class="button button--glass" data-translate="hero_button">Découvrir nos solutions</a>
            </div>
        </section>

        <section class="section section--light" aria-labelledby="stats-heading">
            <div class="container">
                <div class="section__header">
                    <p class="section__eyebrow" data-translate="stats_eyebrow">Impact mesurable</p>
                    <h2 id="stats-heading" class="section__title" data-translate="stats_title">Des résultats concrets sur le terrain</h2>
                    <p class="section__description" data-translate="stats_subtitle">Les exploitations accompagnées par FarmLink réduisent les coûts hydriques, augmentent leurs rendements et sécurisent leurs certifications.</p>
                </div>
                <div class="grid grid--stats" role="list">
                    <article class="stat-card" role="listitem">
                        <h3 class="stat-card__value" data-translate="stats_irrigated_value">+40%</h3>
                        <p class="stat-card__label" data-translate="stats_irrigated_label">d'efficacité d'irrigation grâce aux vannes intelligentes et à la planification IA.</p>
                    </article>
                    <article class="stat-card" role="listitem">
                        <h3 class="stat-card__value" data-translate="stats_traceability_value">100%</h3>
                        <p class="stat-card__label" data-translate="stats_traceability_label">de traçabilité des interventions via les carnets numériques et alertes instantanées.</p>
                    </article>
                    <article class="stat-card" role="listitem">
                        <h3 class="stat-card__value" data-translate="stats_roi_value">12 mois</h3>
                        <p class="stat-card__label" data-translate="stats_roi_label">pour rentabiliser l'investissement retrofit sur les cultures arboricoles irriguées.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="features-heading">
            <div class="container">
                <div class="section__header">
                    <p class="section__eyebrow" data-translate="features_eyebrow">Suite logicielle & matérielle</p>
                    <h2 id="features-heading" class="section__title" data-translate="features_title">Une plateforme complète pour piloter l'exploitation</h2>
                    <p class="section__description" data-translate="features_subtitle">FarmLink combine des capteurs durcis, des contrôleurs retrofit, un jumeau numérique et un conseiller IA pour automatiser les décisions terrain.</p>
                </div>
                <div class="grid grid--features" role="list">
                    <article class="feature-card" role="listitem">
                        <div class="feature-card__icon" aria-hidden="true">🌦️</div>
                        <h3 class="feature-card__title" data-translate="feature_monitoring_title">Surveillance micro-climatique</h3>
                        <p class="feature-card__description" data-translate="feature_monitoring_desc">Station météo, capteurs de sol et sondes ferti intégrées pour suivre stress hydrique, ET0 et besoins nutritifs.</p>
                    </article>
                    <article class="feature-card" role="listitem">
                        <div class="feature-card__icon" aria-hidden="true">🛠️</div>
                        <h3 class="feature-card__title" data-translate="feature_retrofit_title">Retrofit sans arrêt de production</h3>
                        <p class="feature-card__description" data-translate="feature_retrofit_desc">Nos kits se fixent sur vos tableaux existants et communiquent via LoRaWAN ou 4G pour un déploiement rapide.</p>
                    </article>
                    <article class="feature-card" role="listitem">
                        <div class="feature-card__icon" aria-hidden="true">🤖</div>
                        <h3 class="feature-card__title" data-translate="feature_ai_title">Conseiller IA multilingue</h3>
                        <p class="feature-card__description" data-translate="feature_ai_desc">Analyse agronomique instantanée, scénarios d'irrigation et détection précoce des maladies en français, anglais et arabe.</p>
                    </article>
                    <article class="feature-card" role="listitem">
                        <div class="feature-card__icon" aria-hidden="true">🔗</div>
                        <h3 class="feature-card__title" data-translate="feature_integrations_title">Intégrations supply chain</h3>
                        <p class="feature-card__description" data-translate="feature_integrations_desc">Exports des données vers les coopératives, certifications GlobalG.A.P. et partenaires financiers.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section section--alt" aria-labelledby="modules-heading">
            <div class="container">
                <div class="section__header">
                    <p class="section__eyebrow" data-translate="modules_eyebrow">Modules FarmLink</p>
                    <h2 id="modules-heading" class="section__title" data-translate="modules_title">Choisissez les briques qui correspondent à vos cultures</h2>
                    <p class="section__description" data-translate="modules_subtitle">Nos solutions modulaires se combinent selon vos parcelles : arboriculture, maraîchage, serres, céréales ou élevage.</p>
                </div>
                <div class="grid grid--modules" role="list">
                    <article class="module-card" role="listitem">
                        <img src="image/about_us_im1.png" width="1200" height="800" loading="lazy" decoding="async" alt="Kit FarmLink pour l'irrigation goutte-à-goutte" class="module-card__image">
                        <div class="module-card__body">
                            <h3 class="module-card__title" data-translate="module_irrigation_title">Irrigation pilotée</h3>
                            <p class="module-card__description" data-translate="module_irrigation_desc">Automatisation des tours d'eau, équilibrage pression et alerte fuite pour pivots, goutte-à-goutte et aspersion.</p>
                            <a href="solutions.php#irrigation" class="module-card__link" data-translate="module_discover_label">Voir le module</a>
                        </div>
                    </article>
                    <article class="module-card" role="listitem">
                        <img src="image/about_us_im2.jpg" width="1200" height="800" loading="lazy" decoding="async" alt="Sonde connectée dans un champ de tomates" class="module-card__image">
                        <div class="module-card__body">
                            <h3 class="module-card__title" data-translate="module_soil_title">Diagnostic sol & fertigation</h3>
                            <p class="module-card__description" data-translate="module_soil_desc">Suivi pH, CE, humidité, NPK et recommandations ferti via scénarios IA adaptés aux cultures méditerranéennes.</p>
                            <a href="solutions.php#fertigation" class="module-card__link" data-translate="module_discover_label">Voir le module</a>
                        </div>
                    </article>
                    <article class="module-card" role="listitem">
                        <img src="image/background_im2.png" width="1200" height="800" loading="lazy" decoding="async" alt="Tablette affichant la plateforme FarmLink" class="module-card__image">
                        <div class="module-card__body">
                            <h3 class="module-card__title" data-translate="module_ops_title">Opérations & traçabilité</h3>
                            <p class="module-card__description" data-translate="module_ops_desc">Planification des interventions, traçabilité des récoltes et partage des données avec les acheteurs et bailleurs.</p>
                            <a href="solutions.php#operations" class="module-card__link" data-translate="module_discover_label">Voir le module</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="process-heading">
            <div class="container">
                <div class="section__header">
                    <p class="section__eyebrow" data-translate="process_eyebrow">Déploiement en 3 étapes</p>
                    <h2 id="process-heading" class="section__title" data-translate="process_title">Une méthodologie terrain éprouvée</h2>
                    <p class="section__description" data-translate="process_subtitle">Nos équipes accompagnent les exploitations tunisiennes, des diagnostics initiaux jusqu'au financement et à la conduite du changement.</p>
                </div>
                <ol class="process-list">
                    <li class="process-list__item">
                        <h3 class="process-list__title" data-translate="process_step1_title">Audit & co-conception</h3>
                        <p class="process-list__description" data-translate="process_step1_desc">Analyse des parcelles, connexion des compteurs existants et montage du dossier de financement (subventions, crédits verts).</p>
                    </li>
                    <li class="process-list__item">
                        <h3 class="process-list__title" data-translate="process_step2_title">Installation retrofit</h3>
                        <p class="process-list__description" data-translate="process_step2_desc">Pose des capteurs, des contrôleurs et paramétrage de la plateforme sans interrompre la production.</p>
                    </li>
                    <li class="process-list__item">
                        <h3 class="process-list__title" data-translate="process_step3_title">Coaching & optimisation</h3>
                        <p class="process-list__description" data-translate="process_step3_desc">Accompagnement saisonnier, alertes IA personnalisées et intégration avec vos partenaires de la chaîne de valeur.</p>
                    </li>
                </ol>
            </div>
        </section>

        <section class="section section--dark" aria-labelledby="testimonials-heading">
            <div class="container">
                <div class="section__header section__header--center">
                    <p class="section__eyebrow" data-translate="testimonials_eyebrow">Ils nous font confiance</p>
                    <h2 id="testimonials-heading" class="section__title" data-translate="testimonials_title">Ce que disent nos agriculteurs</h2>
                </div>
                <div class="grid grid--testimonials" role="list">
                    <article class="testimonial-card" role="listitem">
                        <img src="image/Karim A.png" width="256" height="256" loading="lazy" decoding="async" alt="Portrait de Karim A." class="testimonial-card__avatar">
                        <blockquote class="testimonial-card__quote" data-translate="testimonial_1_text">« FarmLink a transformé ma gestion de l'eau. J'économise du temps et de l'argent, et mes rendements n'ont jamais été aussi bons. »</blockquote>
                        <p class="testimonial-card__author" data-translate="testimonial_1_name">Karim A.</p>
                        <p class="testimonial-card__role" data-translate="testimonial_1_location">Agriculteur, Sidi Bouzid</p>
                    </article>
                    <article class="testimonial-card" role="listitem">
                        <img src="image/fatma.png" width="256" height="256" loading="lazy" decoding="async" alt="Portrait de Fatma M." class="testimonial-card__avatar">
                        <blockquote class="testimonial-card__quote" data-translate="testimonial_2_text">« L'installation a été incroyablement simple sur mon équipement existant. Le panneau de contrôle est très intuitif. »</blockquote>
                        <p class="testimonial-card__author" data-translate="testimonial_2_name">Fatma M.</p>
                        <p class="testimonial-card__role" data-translate="testimonial_2_location">Exploitante d'oliveraie, Sfax</p>
                    </article>
                    <article class="testimonial-card" role="listitem">
                        <img src="image/yousef.png" width="256" height="256" loading="lazy" decoding="async" alt="Portrait de Youssef B." class="testimonial-card__avatar">
                        <blockquote class="testimonial-card__quote" data-translate="testimonial_3_text">« Le conseiller IA est un véritable plus. Il m'a aidé à identifier un problème de ravageurs avant qu'il ne se propage. C'est l'avenir ! »</blockquote>
                        <p class="testimonial-card__author" data-translate="testimonial_3_name">Youssef B.</p>
                        <p class="testimonial-card__role" data-translate="testimonial_3_location">Serriste, Kairouan</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section section--cta" aria-labelledby="cta-heading">
            <div class="container section__header section__header--center">
                <p class="section__eyebrow" data-translate="cta_eyebrow">Prêts à démarrer</p>
                <h2 id="cta-heading" class="section__title" data-translate="summary_contact_title">Prêt à moderniser votre ferme ?</h2>
                <p class="section__description" data-translate="summary_contact_desc">Discutons de vos besoins. Contactez-nous dès aujourd'hui pour obtenir un devis personnalisé et découvrir comment FarmLink peut transformer votre exploitation.</p>
                <a href="contact.php" class="button button--primary" data-translate="contact_us_button">Contactez-nous</a>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
