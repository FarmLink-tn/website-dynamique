<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'À propos de FarmLink Tunisie - Notre mission et notre équipe';
$metaDescription = "Découvrez l'histoire de FarmLink, notre mission pour digitaliser l'agriculture tunisienne et l'équipe pluridisciplinaire qui accompagne les exploitations vers des performances durables.";
$metaKeywords = 'FarmLink Tunisie, mission, équipe, agriculture intelligente, retrofit, innovation agricole';
$canonicalPath = '/about.php';
$activeNav = 'about';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main" tabindex="-1" class="page">
        <section class="page-hero" aria-labelledby="about-hero-heading">
            <div class="page-hero__media" aria-hidden="true">
                <img src="image/about_us_im1.png" width="1800" height="1200" loading="lazy" decoding="async" alt="Équipe FarmLink inspectant un champ d'oliviers" class="page-hero__image">
                <div class="page-hero__overlay"></div>
            </div>
            <div class="page-hero__content container">
                <p class="page-hero__eyebrow" data-translate="about_hero_eyebrow">À propos</p>
                <h1 id="about-hero-heading" class="page-hero__title" data-translate="about_main_title">L'agriculture de demain, une récolte à la fois.</h1>
                <p class="page-hero__description" data-translate="about_intro_text">Chez FarmLink, nous voyons l'agriculture comme la technologie essentielle du futur. Notre mission est de rendre l'agriculture intelligente accessible à toutes les exploitations tunisiennes.</p>
            </div>
        </section>

        <section class="section" aria-labelledby="mission-heading">
            <div class="container">
                <div class="section__header">
                    <p class="section__eyebrow" data-translate="about_vision_eyebrow">Notre mission</p>
                    <h2 id="mission-heading" class="section__title" data-translate="about_vision_title">Un futur où chaque ferme tunisienne est connectée</h2>
                    <p class="section__description" data-translate="about_vision_text">Nous aidons les agriculteurs à sécuriser leurs rendements face au stress hydrique et aux aléas climatiques grâce à une approche retrofit, inclusive et financée.</p>
                </div>
                <div class="grid grid--features" role="list">
                    <article class="feature-card" role="listitem">
                        <div class="feature-card__icon" aria-hidden="true">💧</div>
                        <h3 class="feature-card__title" data-translate="about_mission_water_title">Gestion hydrique durable</h3>
                        <p class="feature-card__description" data-translate="about_mission_water_desc">Réduire de 30 à 50% la consommation d'eau en modernisant l'irrigation sur les équipements existants.</p>
                    </article>
                    <article class="feature-card" role="listitem">
                        <div class="feature-card__icon" aria-hidden="true">🌱</div>
                        <h3 class="feature-card__title" data-translate="about_mission_soil_title">Santé des sols & nutrition</h3>
                        <p class="feature-card__description" data-translate="about_mission_soil_desc">Diagnostiquer les sols, piloter la fertigation et assurer la conformité aux standards internationaux.</p>
                    </article>
                    <article class="feature-card" role="listitem">
                        <div class="feature-card__icon" aria-hidden="true">🤝</div>
                        <h3 class="feature-card__title" data-translate="about_mission_support_title">Accompagnement terrain</h3>
                        <p class="feature-card__description" data-translate="about_mission_support_desc">Former les équipes, structurer les dossiers de financement et maintenir une présence locale dans chaque région.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section section--alt" aria-labelledby="values-heading">
            <div class="container">
                <div class="section__header">
                    <p class="section__eyebrow" data-translate="about_values_eyebrow">Nos valeurs</p>
                    <h2 id="values-heading" class="section__title" data-translate="about_values_title">Des principes qui guident chaque projet</h2>
                </div>
                <div class="grid grid--values" role="list">
                    <article class="value-card" role="listitem">
                        <h3 class="value-card__title" data-translate="about_value1_title">Impact mesurable</h3>
                        <p class="value-card__description" data-translate="about_value1_desc">Chaque déploiement est suivi par des indicateurs hydriques, agronomiques et économiques partagés avec le producteur.</p>
                    </article>
                    <article class="value-card" role="listitem">
                        <h3 class="value-card__title" data-translate="about_value2_title">Retrofit responsable</h3>
                        <p class="value-card__description" data-translate="about_value2_desc">Nous modernisons l'existant pour limiter l'investissement initial et prolonger la durée de vie des infrastructures.</p>
                    </article>
                    <article class="value-card" role="listitem">
                        <h3 class="value-card__title" data-translate="about_value3_title">Technologie inclusive</h3>
                        <p class="value-card__description" data-translate="about_value3_desc">Interfaces en arabe, français et anglais, formation continue et assistance 7j/7 adaptées aux réalités locales.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="timeline-heading">
            <div class="container">
                <div class="section__header">
                    <p class="section__eyebrow" data-translate="about_timeline_eyebrow">Notre histoire</p>
                    <h2 id="timeline-heading" class="section__title" data-translate="about_timeline_title">Des prototypes au réseau national</h2>
                </div>
                <ol class="timeline" aria-label="Étapes clés de FarmLink">
                    <li class="timeline__item">
                        <div class="timeline__year" data-translate="about_timeline_2020_year">2020</div>
                        <h3 class="timeline__title" data-translate="about_timeline_2020_title">Prototypes en irrigation goutte-à-goutte</h3>
                        <p class="timeline__description" data-translate="about_timeline_2020_desc">Lancement des premiers kits retrofit dans la région de Sfax avec un programme pilote sur 12 hectares.</p>
                    </li>
                    <li class="timeline__item">
                        <div class="timeline__year" data-translate="about_timeline_2021_year">2021</div>
                        <h3 class="timeline__title" data-translate="about_timeline_2021_title">Ouverture de l'atelier d'intégration</h3>
                        <p class="timeline__description" data-translate="about_timeline_2021_desc">Assemblage local des coffrets de contrôle, certification CE et intégration des premiers capteurs LoRaWAN.</p>
                    </li>
                    <li class="timeline__item">
                        <div class="timeline__year" data-translate="about_timeline_2022_year">2022</div>
                        <h3 class="timeline__title" data-translate="about_timeline_2022_title">Plateforme IA et coaching agronomique</h3>
                        <p class="timeline__description" data-translate="about_timeline_2022_desc">Lancement du conseiller IA multilingue et structuration de l'équipe agronomie & data science.</p>
                    </li>
                    <li class="timeline__item">
                        <div class="timeline__year" data-translate="about_timeline_2024_year">2024</div>
                        <h3 class="timeline__title" data-translate="about_timeline_2024_title">Partenariats coopératives & bailleurs</h3>
                        <p class="timeline__description" data-translate="about_timeline_2024_desc">Déploiement dans 18 gouvernorats, financement vert et raccordement aux chaînes de valeur export.</p>
                    </li>
                </ol>
            </div>
        </section>

        <section class="section section--alt" aria-labelledby="team-heading">
            <div class="container">
                <div class="section__header">
                    <p class="section__eyebrow" data-translate="about_team_eyebrow">Notre équipe</p>
                    <h2 id="team-heading" class="section__title" data-translate="about_team_title">Des profils complémentaires pour vos projets</h2>
                    <p class="section__description" data-translate="about_team_description">Ingénieurs agronomes, data scientists, électroniciens et experts financement travaillent main dans la main avec vos techniciens.</p>
                </div>
                <div class="grid grid--team" role="list">
                    <article class="team-card" role="listitem">
                        <h3 class="team-card__name" data-translate="about_team_member1_name">Leila Gharbi</h3>
                        <p class="team-card__role" data-translate="about_team_member1_role">Co-fondatrice & CEO</p>
                        <p class="team-card__bio" data-translate="about_team_member1_bio">15 ans d'expérience en transformation digitale agricole, ex-consultante FAO, pilote les partenariats stratégiques.</p>
                    </article>
                    <article class="team-card" role="listitem">
                        <h3 class="team-card__name" data-translate="about_team_member2_name">Anis Ben Youssef</h3>
                        <p class="team-card__role" data-translate="about_team_member2_role">CTO & IoT Lead</p>
                        <p class="team-card__bio" data-translate="about_team_member2_bio">Ingénieur embarqué, spécialiste LoRaWAN et cybersécurité, en charge des architectures terrain.</p>
                    </article>
                    <article class="team-card" role="listitem">
                        <h3 class="team-card__name" data-translate="about_team_member3_name">Syrine Baccar</h3>
                        <p class="team-card__role" data-translate="about_team_member3_role">Directrice agronomie & IA</p>
                        <p class="team-card__bio" data-translate="about_team_member3_bio">Docteure en sciences agronomiques, coordonne le conseiller IA et les protocoles d'expérimentation.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="partners-heading">
            <div class="container">
                <div class="section__header section__header--center">
                    <p class="section__eyebrow" data-translate="about_partners_eyebrow">Ils nous accompagnent</p>
                    <h2 id="partners-heading" class="section__title" data-translate="about_partners_title">Un réseau d'innovation et de financement</h2>
                </div>
                <div class="partners" role="list">
                    <div class="partners__item" role="listitem" data-translate="about_partner1">Ministère de l'Agriculture</div>
                    <div class="partners__item" role="listitem" data-translate="about_partner2">Coopératives oléicoles</div>
                    <div class="partners__item" role="listitem" data-translate="about_partner3">Programmes GIZ & BERD</div>
                    <div class="partners__item" role="listitem" data-translate="about_partner4">Instituts de recherche INRAT</div>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
