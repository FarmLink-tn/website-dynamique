let csrfToken = null;
let csrfTokenPromise = null;

function setCsrfToken(token) {
    csrfToken = token || null;
    document.querySelectorAll('input[name="csrf_token"]').forEach(input => {
        input.value = csrfToken || '';
    });
}

function refreshCsrfToken() {
    csrfTokenPromise = fetch('server/auth.php?action=check', { credentials: 'include' })
        .then(res => res.json())
        .then(data => {
            setCsrfToken(data.csrfToken);
            return csrfToken;
        })
        .catch(() => {
            setCsrfToken(null);
            return null;
        })
        .finally(() => {
            csrfTokenPromise = null;
        });
    return csrfTokenPromise;
}

function ensureCsrfToken() {
    if (csrfToken) {
        return Promise.resolve(csrfToken);
    }
    if (csrfTokenPromise) {
        return csrfTokenPromise;
    }
    return refreshCsrfToken();
}

function csrfFetch(url, options = {}) {
    const opts = { ...options };
    opts.credentials = opts.credentials || 'include';
    const method = (opts.method || 'GET').toUpperCase();
    if (method === 'GET') {
        return fetch(url, opts);
    }
    return ensureCsrfToken().then(() => {
        if (!csrfToken) {
            return Promise.reject(new Error('CSRF token unavailable'));
        }
        opts.headers = { ...(opts.headers || {}) };
        opts.headers['X-CSRF-Token'] = csrfToken;
        return fetch(url, opts);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    // --- DICTIONNAIRE DE TRADUCTION COMPLET ---
    const translations = {
        fr: {
            nav_about: "À propos",
            nav_how_it_works: "Comment ça marche",
            nav_solutions: "Nos Solutions",
            nav_ai_advisor: "✨ Conseiller IA",
            nav_account: "Mon Compte",
            nav_get_quote: "Obtenir un devis",
            nav_about_mobile: "À propos",
            nav_how_it_works_mobile: "Comment ça marche",
            nav_solutions_mobile: "Nos Solutions",
            nav_ai_advisor_mobile: "✨ Conseiller IA",
            nav_account_mobile: "Mon Compte",
            nav_login: "Se connecter",
            nav_register: "Créer un compte",
            nav_dashboard: "Tableau de bord",
            nav_login_mobile: "Se connecter",
            nav_register_mobile: "Créer un compte",
            nav_dashboard_mobile: "Tableau de bord",
            nav_logged_in_prefix: "Connecté en tant que",
            nav_get_quote_mobile: "Obtenir un devis",
            hero_tagline: "Plateforme agricole intelligente 100% tunisienne",
            hero_title: "Connectez votre ferme et pilotez chaque goutte d'eau.",
            hero_subtitle: "FarmLink digitalise l'irrigation, la fertigation et le suivi des cultures avec des kits retrofit et une plateforme IA pensée pour les climats du Maghreb.",
            hero_primary_cta: "Découvrir nos modules",
            hero_secondary_cta: "Parler à un conseiller",
            hero_button: "Découvrir nos modules",
            hero_metric_clients_label: "Fermes connectées",
            hero_metric_clients_value: "250+",
            hero_metric_water_label: "Eau économisée",
            hero_metric_water_value: "35%",
            hero_metric_regions_label: "Gouvernorats couverts",
            hero_metric_regions_value: "18",
            stats_eyebrow: "Impact mesurable",
            stats_title: "Des résultats concrets sur le terrain",
            stats_subtitle: "Les exploitations accompagnées par FarmLink réduisent les coûts hydriques, augmentent leurs rendements et sécurisent leurs certifications.",
            stats_irrigated_value: "+40%",
            stats_irrigated_label: "d'efficacité d'irrigation grâce aux vannes intelligentes et à la planification IA.",
            stats_traceability_value: "100%",
            stats_traceability_label: "de traçabilité des interventions via les carnets numériques et alertes instantanées.",
            stats_roi_value: "12 mois",
            stats_roi_label: "pour rentabiliser l'investissement retrofit sur les cultures arboricoles irriguées.",
            features_eyebrow: "Suite logicielle & matérielle",
            features_title: "Une plateforme complète pour piloter l'exploitation",
            features_subtitle: "FarmLink combine des capteurs durcis, des contrôleurs retrofit, un jumeau numérique et un conseiller IA pour automatiser les décisions terrain.",
            feature_monitoring_title: "Surveillance micro-climatique",
            feature_monitoring_desc: "Station météo, capteurs de sol et sondes ferti intégrées pour suivre stress hydrique, ET0 et besoins nutritifs.",
            feature_retrofit_title: "Retrofit sans arrêt de production",
            feature_retrofit_desc: "Nos kits se fixent sur vos tableaux existants et communiquent via LoRaWAN ou 4G pour un déploiement rapide.",
            feature_ai_title: "Conseiller IA multilingue",
            feature_ai_desc: "Analyse agronomique instantanée, scénarios d'irrigation et détection précoce des maladies en français, anglais et arabe.",
            feature_integrations_title: "Intégrations supply chain",
            feature_integrations_desc: "Exports des données vers les coopératives, certifications GlobalG.A.P. et partenaires financiers.",
            modules_eyebrow: "Modules FarmLink",
            modules_title: "Choisissez les briques qui correspondent à vos cultures",
            modules_subtitle: "Nos solutions modulaires se combinent selon vos parcelles : arboriculture, maraîchage, serres, céréales ou élevage.",
            module_irrigation_title: "Irrigation pilotée",
            module_irrigation_desc: "Automatisation des tours d'eau, équilibrage pression et alerte fuite pour pivots, goutte-à-goutte et aspersion.",
            module_soil_title: "Diagnostic sol & fertigation",
            module_soil_desc: "Suivi pH, CE, humidité, NPK et recommandations ferti via scénarios IA adaptés aux cultures méditerranéennes.",
            module_ops_title: "Opérations & traçabilité",
            module_ops_desc: "Planification des interventions, traçabilité des récoltes et partage des données avec les acheteurs et bailleurs.",
            module_discover_label: "Voir le module",
            process_eyebrow: "Déploiement en 3 étapes",
            process_title: "Une méthodologie terrain éprouvée",
            process_subtitle: "Nos équipes accompagnent les exploitations tunisiennes, des diagnostics initiaux jusqu'au financement et à la conduite du changement.",
            process_step1_title: "Audit & co-conception",
            process_step1_desc: "Analyse des parcelles, connexion des compteurs existants et montage du dossier de financement (subventions, crédits verts).",
            process_steps_title: "Trois phases structurées et pilotées par la donnée",
            process_step1_point1: "Cartographie hydraulique et électrique de l'exploitation",
            process_step1_point2: "Définition des KPI eau, énergie, rendement et qualité",
            process_step1_point3: "Planification du chantier en coordination avec vos équipes",
            process_step2_title: "Installation retrofit",
            process_step2_desc: "Pose des capteurs, des contrôleurs et paramétrage de la plateforme sans interrompre la production.",
            process_step2_point1: "Montage des coffrets intelligents et raccordement LoRaWAN/4G",
            process_step2_point2: "Calibration des sondes sol, fertigation et météo locale",
            process_step2_point3: "Formation initiale à l'usage de la plateforme et du conseiller IA",
            process_step3_title: "Coaching & optimisation",
            process_step3_desc: "Accompagnement saisonnier, alertes IA personnalisées et intégration avec vos partenaires de la chaîne de valeur.",
            process_step3_point1: "Suivi mensuel des KPI et ajustements des scénarios",
            process_step3_point2: "Support 7j/7 et visites terrain lors des périodes critiques",
            process_step3_point3: "Connexion des données aux coopératives, financeurs et assureurs",
            testimonials_eyebrow: "Ils nous font confiance",
            cta_eyebrow: "Prêts à démarrer",
            process_deliverables_eyebrow: "Livrables clés",
            process_deliverables_title: "Ce que vous recevez à chaque étape",
            process_deliverable1_title: "Dossier technique & financier",
            process_deliverable1_desc: "Plan d'équipement, schémas d'intégration, budget détaillé et simulations ROI pour faciliter l'obtention des financements.",
            process_deliverable2_title: "Plateforme configurée & data live",
            process_deliverable2_desc: "Dashboard multilingue, accès mobile, intégration des capteurs et alertes automatisées prêtes à l'emploi.",
            process_deliverable3_title: "Plan de progrès agronomique",
            process_deliverable3_desc: "Calendrier des interventions, recommandations IA saisonnières et reporting destiné aux coopératives et bailleurs.",
            process_support_eyebrow: "Support continu",
            process_support_title: "Des experts disponibles 7j/7",
            process_support_desc: "Un chargé de compte dédié, une hotline multilingue et un centre de monitoring vous accompagnent tout au long de la campagne.",
            process_support_item1_title: "Centre d'opérations",
            process_support_item1_desc: "Supervision en temps réel des alertes, assistance à distance et recommandations IA contextualisées.",
            process_support_item2_title: "Visites agronomiques",
            process_support_item2_desc: "Campagnes de mesures sur site, analyses de sol et ajustements fertigation & irrigation.",
            process_support_item3_title: "Académie FarmLink",
            process_support_item3_desc: "Formations en présentiel ou en ligne, tutoriels vidéo et ressources traduites en arabe, français et anglais.",
            process_cta_title: "Prêt à lancer l'audit de votre exploitation ?",
            process_cta_desc: "Prenez rendez-vous avec nos experts pour une première estimation gratuite et un plan de modernisation sur-mesure.",
            process_cta_button: "Réserver un diagnostic",
            summary_about_title: "Notre Vision : Un Futur Intelligent",
            summary_about_desc: "Nous démocratisons l'agriculture intelligente. Découvrez comment notre engagement envers l'innovation \"retrofit\" relève les défis mondiaux et crée un avenir durable pour tous.",
            learn_more_about_us: "En savoir plus sur nous",
            summary_solutions_title: "Solutions Modulaires Puissantes",
            summary_solutions_desc: "Irrigation intelligente, contrôle des pompes, surveillance environnementale. Explorez nos solutions conçues pour optimiser vos ressources et maximiser vos rendements.",
            explore_solutions: "Explorer nos solutions",
            summary_ai_advisor_title: "Votre Agronome Personnel",
            summary_ai_advisor_desc: "Un problème avec vos cultures ? Décrivez-le à notre Conseiller IA et recevez une analyse et des recommandations instantanées pour protéger votre récolte.",
            try_ai_advisor: "Essayer le conseiller IA",
            summary_contact_title: "Prêt à moderniser votre ferme ?",
            summary_contact_desc: "Discutons de vos besoins. Contactez-nous dès aujourd'hui pour obtenir un devis personnalisé et découvrir comment FarmLink peut transformer votre exploitation.",
            contact_us_button: "Contactez-nous",
            testimonials_title: "Ce que disent nos agriculteurs",
            testimonial_1_text: "\"FarmLink a transformé ma gestion de l'eau. J'économise du temps et de l'argent, et mes rendements n'ont jamais été aussi bons.\"",
            testimonial_1_name: "Karim A.",
            testimonial_1_location: "Agriculteur, Sidi Bouzid",
            testimonial_2_text: "\"L'installation a été incroyablement simple sur mon équipement existant. Le panneau de contrôle est très intuitif.\"",
            testimonial_2_name: "Fatma M.",
            testimonial_2_location: "Exploitante d'oliveraie, Sfax",
            testimonial_3_text: "\"Le conseiller IA est un véritable plus. Il m'a aidé à identifier un problème de ravageurs avant qu'il ne se propage. C'est l'avenir !\"",
            testimonial_3_name: "Youssef B.",
            testimonial_3_location: "Serriste, Kairouan",
            footer_copyright: "&copy; 2025 FarmLink. Tous droits réservés.",
            about_hero_eyebrow: "À propos",
            about_main_title: "L'agriculture de demain, une récolte à la fois.",
            about_intro_text: "Chez FarmLink, nous voyons l'agriculture comme la technologie essentielle du futur. Notre mission est de rendre l'agriculture intelligente accessible à toutes les exploitations tunisiennes.",
            about_vision_eyebrow: "Notre mission",
            about_vision_title: "Un futur où chaque ferme tunisienne est connectée",
            about_vision_text: "Nous aidons les agriculteurs à sécuriser leurs rendements face au stress hydrique et aux aléas climatiques grâce à une approche retrofit, inclusive et financée.",
            about_mission_water_title: "Gestion hydrique durable",
            about_mission_water_desc: "Réduire de 30 à 50% la consommation d'eau en modernisant l'irrigation sur les équipements existants.",
            about_mission_soil_title: "Santé des sols & nutrition",
            about_mission_soil_desc: "Diagnostiquer les sols, piloter la fertigation et assurer la conformité aux standards internationaux.",
            about_mission_support_title: "Accompagnement terrain",
            about_mission_support_desc: "Former les équipes, structurer les dossiers de financement et maintenir une présence locale dans chaque région.",
            about_values_eyebrow: "Nos valeurs",
            about_values_title: "Des principes qui guident chaque projet",
            about_value1_title: "Impact mesurable",
            about_value1_desc: "Chaque déploiement est suivi par des indicateurs hydriques, agronomiques et économiques partagés avec le producteur.",
            about_value2_title: "Retrofit responsable",
            about_value2_desc: "Nous modernisons l'existant pour limiter l'investissement initial et prolonger la durée de vie des infrastructures.",
            about_value3_title: "Technologie inclusive",
            about_value3_desc: "Interfaces en arabe, français et anglais, formation continue et assistance 7j/7 adaptées aux réalités locales.",
            about_timeline_eyebrow: "Notre histoire",
            about_timeline_title: "Des prototypes au réseau national",
            about_timeline_2020_year: "2020",
            about_timeline_2020_title: "Prototypes en irrigation goutte-à-goutte",
            about_timeline_2020_desc: "Lancement des premiers kits retrofit dans la région de Sfax avec un programme pilote sur 12 hectares.",
            about_timeline_2021_year: "2021",
            about_timeline_2021_title: "Ouverture de l'atelier d'intégration",
            about_timeline_2021_desc: "Assemblage local des coffrets de contrôle, certification CE et intégration des premiers capteurs LoRaWAN.",
            about_timeline_2022_year: "2022",
            about_timeline_2022_title: "Plateforme IA et coaching agronomique",
            about_timeline_2022_desc: "Lancement du conseiller IA multilingue et structuration de l'équipe agronomie & data science.",
            about_timeline_2024_year: "2024",
            about_timeline_2024_title: "Partenariats coopératives & bailleurs",
            about_timeline_2024_desc: "Déploiement dans 18 gouvernorats, financement vert et raccordement aux chaînes de valeur export.",
            about_team_eyebrow: "Notre équipe",
            about_team_title: "Des profils complémentaires pour vos projets",
            about_team_description: "Ingénieurs agronomes, data scientists, électroniciens et experts financement travaillent main dans la main avec vos techniciens.",
            about_team_member1_name: "Leila Gharbi",
            about_team_member1_role: "Co-fondatrice & CEO",
            about_team_member1_bio: "15 ans d'expérience en transformation digitale agricole, ex-consultante FAO, pilote les partenariats stratégiques.",
            about_team_member2_name: "Anis Ben Youssef",
            about_team_member2_role: "CTO & IoT Lead",
            about_team_member2_bio: "Ingénieur embarqué, spécialiste LoRaWAN et cybersécurité, en charge des architectures terrain.",
            about_team_member3_name: "Syrine Baccar",
            about_team_member3_role: "Directrice agronomie & IA",
            about_team_member3_bio: "Docteure en sciences agronomiques, coordonne le conseiller IA et les protocoles d'expérimentation.",
            about_partners_eyebrow: "Ils nous accompagnent",
            about_partners_title: "Un réseau d'innovation et de financement",
            about_partner1: "Ministère de l'Agriculture",
            about_partner2: "Coopératives oléicoles",
            about_partner3: "Programmes GIZ & BERD",
            about_partner4: "Instituts de recherche INRAT",
            how_it_works_title: "Comment ça marche ?",
            step1_title: "Installation \"Retrofit\"",
            step1_desc: "Nous installons nos modules sur votre équipement existant, sans remplacement coûteux.",
            step2_title: "Connexion au Cloud",
            step2_desc: "Les capteurs envoient les données en temps réel à notre plateforme sécurisée.",
            step3_title: "Contrôle & Optimisation",
            step3_desc: "Vous gérez tout depuis le panneau de contrôle et recevez des recommandations de l'IA.",
            solutions_title: "Nos Solutions Modulaires",
            solution_irrigation_title: "Irrigation Intelligente",
            solution_irrigation_desc: "Optimisez votre consommation d'eau avec des vannes intelligentes et une planification automatisée.",
            solution_pump_title: "Contrôle des Pompes",
            solution_pump_desc: "Gérez vos pompes à distance et surveillez le débit et la pression en temps réel.",
            solution_env_title: "Surveillance Environnementale",
            solution_env_desc: "Prenez des décisions éclairées grâce aux données des capteurs de température, d'humidité et de sol.",
            ai_advisor_title: "✨ Conseiller Agricole IA",
            ai_welcome: "Bonjour ! Posez-moi une question sur vos cultures ou envoyez-moi une photo.",
            privacyNote: "Confidentialité garantie : Toute l'analyse est effectuée sur votre appareil.",
            contact_title: "Contactez-nous",
            contact_intro: "Une question ? Un projet ? N'hésitez pas à nous contacter. Notre équipe est prête à vous aider à franchir le pas vers l'agriculture intelligente.",
            contact_name: "Nom",
            contact_email: "Email",
            contact_phone: "Numéro de téléphone",
            contact_name_placeholder: "Votre nom complet",
            contact_email_placeholder: "votre.email@exemple.com",
            contact_phone_placeholder: "Votre numéro de téléphone (optionnel)",
            contact_message_placeholder: "Décrivez votre projet ou votre question ici...",
            contact_message: "Message",
            contact_send: "Envoyer le message",
            contact_send_label: "Envoyer le message",
            contact_sending: "Envoi du message…",
            contact_success_message: "Votre message a été envoyé avec succès.",
            contact_error_message: "Impossible d'envoyer le message. Vérifiez les champs et réessayez.",
            contact_network_error: "Une erreur réseau est survenue. Veuillez réessayer.",
            contact_validation_name: "Veuillez saisir un nom valide (2 à 120 caractères).",
            contact_validation_email: "Veuillez saisir une adresse email valide.",
            contact_validation_phone: "Le numéro de téléphone est invalide.",
            contact_validation_message: "Votre message doit contenir au moins 20 caractères.",
            account_title: "Mon Compte",
            auth_login_title: "Se connecter",
            auth_login_btn: "Se connecter",
            auth_register_prompt: "Pas encore de compte ? <a href='register.php' data-route='register' class='text-brand-green-400 font-bold'>Créer un compte</a>",
            auth_register_title: "Créer un compte",
            auth_register_btn: "Créer le compte",
            auth_register_instructions: "Tous les champs sont obligatoires. Utilisez un mot de passe d'au moins huit caractères.",
            auth_last_name_label: "Nom",
            auth_first_name_label: "Prénom",
            auth_email_label: "Email",
            auth_phone_label: "Téléphone",
            auth_region_label: "Région",
            auth_last_name_placeholder: "Nom",
            auth_first_name_placeholder: "Prénom",
            auth_email_placeholder: "Email",
            auth_phone_placeholder: "Numéro de téléphone",
            auth_region_placeholder: "Région",
            auth_login_prompt: "Déjà un compte ? <a href='account.php' data-route='account' class='text-brand-blue-500 font-bold'>Se connecter</a>",
            products_section_title: "Mes Produits",
            product_form_instructions: "Renseignez les informations clés de votre produit pour mettre à jour le tableau de bord.",
            product_name_label: "Nom du produit",
            product_quantity_label: "Quantité",
            product_phone_label: "Téléphone GSM",
            product_ph_label: "pH",
            product_rain_label: "Pluie",
            product_humidity_label: "Humidité",
            product_soil_humidity_label: "Humidité du sol",
            product_light_label: "Lumière",
            product_valve_open_label: "Valve ouverte",
            product_valve_angle_label: "Angle de valve",
            product_name_placeholder: "Nom du produit",
            product_quantity_placeholder: "Quantité",
            product_phone_placeholder: "Téléphone GSM",
            product_ph_placeholder: "pH",
            product_rain_placeholder: "Pluie (mm)",
            product_humidity_placeholder: "Humidité (%)",
            product_soil_humidity_placeholder: "Humidité du sol (%)",
            product_light_placeholder: "Lumière (lux)",
            product_valve_angle_placeholder: "Angle de valve",
            add_product_btn: "Ajouter",
            logout_btn: "Se déconnecter",
            profile_form_instructions: "Mettez à jour vos coordonnées FarmLink. Tous les champs sont obligatoires.",
            profile_last_name_label: "Nom",
            profile_first_name_label: "Prénom",
            profile_email_label: "Email",
            profile_phone_label: "Téléphone",
            profile_region_label: "Région",
            profile_update_button: "Mettre à jour",
            footer_mission: "Nous connectons les agriculteurs tunisiens à des outils intelligents et durables.",
            footer_nav_title: "Navigation",
            footer_legal_title: "Informations légales",
            footer_home: "Accueil",
            footer_contact_link: "Contact",
            footer_privacy: "Politique de confidentialité",
            footer_terms: "Conditions d'utilisation",
            footer_cookies: "Politique de cookies",
            footer_contact_title: "Contact",
            footer_contact_email: "Email : contact@farmlink.tn",
            footer_contact_phone: "Téléphone : +216 12 345 678",
            privacy_title: "Politique de confidentialité",
            privacy_intro: "Cette politique explique comment FarmLink collecte, utilise et protège les informations personnelles de ses utilisateurs et clients.",
            privacy_collection_heading: "Données que nous collectons",
            privacy_collection_text: "Nous collectons uniquement les informations nécessaires pour fournir nos services et répondre à vos demandes.",
            privacy_collection_item_1: "Données d'identité : nom, prénom, entreprise et coordonnées.",
            privacy_collection_item_2: "Données de contact : adresse email, numéro de téléphone et préférences linguistiques.",
            privacy_collection_item_3: "Données d'utilisation : interactions sur le site, demandes envoyées et réponses reçues.",
            privacy_use_heading: "Comment nous utilisons vos données",
            privacy_use_item_1: "Répondre à vos demandes de contact et préparer des devis personnalisés.",
            privacy_use_item_2: "Assurer le suivi de votre compte FarmLink et sécuriser l'accès aux tableaux de bord.",
            privacy_use_item_3: "Améliorer nos services, mesurer les performances et détecter les tentatives de fraude.",
            privacy_legal_heading: "Base légale & conservation",
            privacy_legal_text: "Vos données sont traitées sur la base de votre consentement, de l'exécution d'un contrat ou de nos intérêts légitimes. Elles sont conservées pendant la durée de la relation commerciale, puis archivées pendant la période légale nécessaire.",
            privacy_rights_heading: "Vos droits",
            privacy_rights_intro: "Conformément au RGPD et à la loi tunisienne, vous disposez des droits suivants :",
            privacy_rights_item_1: "Accéder à vos données et en obtenir une copie.",
            privacy_rights_item_2: "Rectifier des informations inexactes ou incomplètes.",
            privacy_rights_item_3: "Demander l'effacement de vos données ou la limitation du traitement.",
            privacy_rights_item_4: "Vous opposer au traitement ou retirer votre consentement à tout moment.",
            privacy_contact_heading: "Contact et réclamations",
            privacy_contact_text: "Pour exercer vos droits ou poser une question, contactez-nous à l'adresse contact@farmlink.tn. Vous pouvez également saisir l'autorité de protection des données compétente.",
            terms_title: "Conditions d'utilisation",
            terms_intro: "Ces conditions régissent l'utilisation du site et des services FarmLink par les agriculteurs, partenaires et visiteurs.",
            terms_usage_heading: "Utilisation du site",
            terms_usage_text: "Vous vous engagez à utiliser FarmLink de manière conforme à la loi et à ne pas porter atteinte à l'intégrité du service ni aux droits de tiers.",
            terms_accounts_heading: "Comptes et sécurité",
            terms_accounts_text: "Les accès réservés (tableau de bord, administration) sont strictement personnels. Vous devez protéger vos identifiants et signaler toute utilisation non autorisée.",
            terms_liability_heading: "Responsabilité",
            terms_liability_text: "FarmLink met en œuvre des mesures techniques pour assurer la disponibilité du service. Nous ne pouvons toutefois être tenus responsables des dommages indirects ou causés par une mauvaise utilisation.",
            terms_changes_heading: "Modifications",
            terms_changes_text: "Nous pouvons mettre à jour ces conditions pour refléter l'évolution de nos services ou la réglementation. Les nouvelles versions prennent effet dès leur publication.",
            terms_contact_heading: "Nous contacter",
            terms_contact_text: "Pour toute question relative à ces conditions, écrivez-nous à contact@farmlink.tn. Nous répondrons dans les meilleurs délais.",
            cookies_title: "Politique de cookies",
            cookies_intro: "Cette politique détaille les types de cookies utilisés sur FarmLink et les moyens de gérer vos préférences.",
            cookies_definition_heading: "Qu'est-ce qu'un cookie ?",
            cookies_definition_text: "Un cookie est un petit fichier texte déposé sur votre appareil pour assurer le bon fonctionnement du site et améliorer votre expérience.",
            cookies_types_heading: "Cookies utilisés",
            cookies_types_item_1: "Cookies essentiels : nécessaires à la sécurité, à la gestion de session et au maintien de vos préférences linguistiques.",
            cookies_types_item_2: "Cookies de performance : nous aident à mesurer l'utilisation du site pour améliorer nos services.",
            cookies_types_item_3: "Aucun cookie publicitaire tiers n'est utilisé sur FarmLink.",
            cookies_control_heading: "Vos choix",
            cookies_control_text: "Vous pouvez configurer votre navigateur pour bloquer ou supprimer les cookies. Certaines fonctionnalités essentielles de FarmLink peuvent toutefois ne plus fonctionner correctement.",
            cookies_contact_heading: "Nous contacter",
            cookies_contact_text: "Pour toute question sur l'utilisation des cookies, écrivez-nous à contact@farmlink.tn.",
            context_agricole: `
                ### SUJET: AGRICULTURE EN TUNISIE ###
                L'agriculture en Tunisie fait face à des défis comme la sécheresse et la salinité des sols. Les cultures principales sont les olives, les céréales, les dattes et les agrumes. La bonne gestion de l'eau est cruciale.
                ### PROBLÈME: FEUILLES JAUNES (CHLOROSE) ###
                Les feuilles jaunes sur une plante sont souvent un signe de carence en nutriments ou de maladie.
                - Sur les tomates, des taches jaunes peuvent indiquer le mildiou, surtout si le temps est humide. Une autre cause est la carence en azote, qui fait jaunir les vieilles feuilles en premier.
                - Sur les oliviers, le jaunissement peut être causé par un manque d'eau, un sol trop calcaire, ou une maladie comme la verticilliose.
                - Sur les agrumes (citronniers, orangers), des feuilles jaunes avec des nervures vertes indiquent souvent une carence en fer (chlorose ferrique), fréquente dans les sols calcaires tunisiens. Solution : apport de chélate de fer.
                ### PROBLÈME: PARASITES COMMUNS ###
                - Les pucerons sont de petits insectes verts ou noirs qui sucent la sève, affaiblissant la plante et transmettant des maladies. Solution : savon noir dilué ou insecticide naturel.
                - La mouche de l'olivier pond ses œufs dans les olives, provoquant leur chute. Solution : surveillance avec des pièges (phéromones) et traitement si nécessaire.
                - L'araignée rouge se développe par temps chaud et sec et crée de fines toiles sous les feuilles. Solution : pulvérisation d'eau sur le feuillage pour augmenter l'humidité.
            `,
        },
        en: {
            nav_about: "About",
            nav_how_it_works: "How It Works",
            nav_solutions: "Solutions",
            nav_ai_advisor: "✨ AI Advisor",
            nav_account: "My Account",
            nav_get_quote: "Get a Quote",
            nav_about_mobile: "About",
            nav_how_it_works_mobile: "How It Works",
            nav_solutions_mobile: "Solutions",
            nav_ai_advisor_mobile: "✨ AI Advisor",
            nav_account_mobile: "My Account",
            nav_login: "Log In",
            nav_register: "Create Account",
            nav_dashboard: "Dashboard",
            nav_login_mobile: "Log In",
            nav_register_mobile: "Create Account",
            nav_dashboard_mobile: "Dashboard",
            nav_logged_in_prefix: "Signed in as",
            nav_get_quote_mobile: "Get a Quote",
            hero_tagline: "Smart farming platform built in Tunisia",
            hero_title: "Connect your farm and orchestrate every drop of water.",
            hero_subtitle: "FarmLink digitises irrigation, fertigation and crop monitoring with retrofit kits and an AI platform tuned for Maghreb climates.",
            hero_primary_cta: "Discover our modules",
            hero_secondary_cta: "Talk to an expert",
            hero_button: "Discover our modules",
            hero_metric_clients_label: "Connected farms",
            hero_metric_clients_value: "250+",
            hero_metric_water_label: "Water saved",
            hero_metric_water_value: "35%",
            hero_metric_regions_label: "Governorates covered",
            hero_metric_regions_value: "18",
            stats_eyebrow: "Measurable impact",
            stats_title: "Tangible results in the field",
            stats_subtitle: "FarmLink growers cut water costs, boost yields and secure certifications.",
            stats_irrigated_value: "+40%",
            stats_irrigated_label: "irrigation efficiency thanks to smart valves and AI planning.",
            stats_traceability_value: "100%",
            stats_traceability_label: "traceability of field work through digital logs and instant alerts.",
            stats_roi_value: "12 months",
            stats_roi_label: "to recoup retrofit investments on irrigated orchards.",
            features_eyebrow: "Hardware & software suite",
            features_title: "A full platform to run your operation",
            features_subtitle: "FarmLink blends rugged sensors, retrofit controllers, a digital twin and an AI advisor to automate field decisions.",
            feature_monitoring_title: "Micro-climate monitoring",
            feature_monitoring_desc: "Weather station, soil probes and ferti sensors to track water stress, ET0 and nutrient needs.",
            feature_retrofit_title: "Retrofit without downtime",
            feature_retrofit_desc: "Kits clip onto existing panels and communicate via LoRaWAN or 4G for rapid deployment.",
            feature_ai_title: "Multilingual AI advisor",
            feature_ai_desc: "Instant agronomic analysis, irrigation scenarios and early disease alerts in French, English and Arabic.",
            feature_integrations_title: "Supply chain integrations",
            feature_integrations_desc: "Share data with cooperatives, GlobalG.A.P. auditors and financial partners.",
            modules_eyebrow: "FarmLink modules",
            modules_title: "Pick the building blocks for your crops",
            modules_subtitle: "Combine modules for orchards, vegetables, greenhouses, grains or livestock operations.",
            module_irrigation_title: "Irrigation control",
            module_irrigation_desc: "Automate watering cycles, balance pressure and detect leaks for pivots, drip lines and sprinklers.",
            module_soil_title: "Soil & fertigation insights",
            module_soil_desc: "Track pH, EC, moisture, NPK and receive fertilisation scenarios adapted to Mediterranean crops.",
            module_ops_title: "Operations & traceability",
            module_ops_desc: "Plan interventions, trace harvests and share records with buyers and lenders.",
            module_discover_label: "View module",
            process_eyebrow: "3-step rollout",
            process_title: "A proven field methodology",
            process_subtitle: "Our teams support Tunisian farms from diagnostics to financing and change management.",
            process_step1_title: "Audit & co-design",
            process_step1_desc: "Parcel analysis, connection of existing meters and funding applications (subsidies, green loans).",
            process_steps_title: "Three data-driven phases",
            process_step1_point1: "Hydraulic and electrical mapping of the farm",
            process_step1_point2: "Definition of water, energy, yield and quality KPIs",
            process_step1_point3: "Rollout planning coordinated with your teams",
            process_step2_title: "Retrofit deployment",
            process_step2_desc: "Install sensors, controllers and configure the platform without stopping production.",
            process_step2_point1: "Install smart cabinets and connect via LoRaWAN/4G",
            process_step2_point2: "Calibrate soil, fertigation and local weather probes",
            process_step2_point3: "Initial training on the platform and AI advisor",
            process_step3_title: "Coaching & optimisation",
            process_step3_desc: "Seasonal support, personalised AI alerts and integrations across your value chain partners.",
            process_step3_point1: "Monthly KPI reviews and scenario adjustments",
            process_step3_point2: "24/7 support and on-site visits during critical periods",
            process_step3_point3: "Data sharing with cooperatives, financiers and insurers",
            testimonials_eyebrow: "Trusted by growers",
            cta_eyebrow: "Ready to get started",
            process_deliverables_eyebrow: "Key deliverables",
            process_deliverables_title: "What you receive at each step",
            process_deliverable1_title: "Technical & financial file",
            process_deliverable1_desc: "Equipment plan, integration diagrams, detailed budget and ROI simulations to secure funding.",
            process_deliverable2_title: "Configured platform & live data",
            process_deliverable2_desc: "Multilingual dashboard, mobile access, sensor integrations and ready-to-use alerts.",
            process_deliverable3_title: "Agronomic improvement plan",
            process_deliverable3_desc: "Intervention calendar, seasonal AI recommendations and reports for cooperatives and lenders.",
            process_support_eyebrow: "Continuous support",
            process_support_title: "Experts available 7 days a week",
            process_support_desc: "A dedicated account manager, multilingual hotline and monitoring centre support you throughout the season.",
            process_support_item1_title: "Operations centre",
            process_support_item1_desc: "Real-time alert supervision, remote assistance and contextual AI recommendations.",
            process_support_item2_title: "Agronomy visits",
            process_support_item2_desc: "On-site measurement campaigns, soil analyses and fertigation & irrigation fine tuning.",
            process_support_item3_title: "FarmLink Academy",
            process_support_item3_desc: "In-person or online training, video tutorials and resources translated into Arabic, French and English.",
            process_cta_title: "Ready to launch your farm audit?",
            process_cta_desc: "Book a meeting with our experts for a free first assessment and tailored modernisation roadmap.",
            process_cta_button: "Book a diagnostic",
            summary_about_title: "Our Vision: A Smart Future",
            summary_about_desc: "We are democratizing smart agriculture. Discover how our commitment to 'retrofit' innovation addresses global challenges and creates a sustainable future for all.",
            learn_more_about_us: "Learn More About Us",
            summary_solutions_title: "Powerful Modular Solutions",
            summary_solutions_desc: "Smart irrigation, pump control, environmental monitoring. Explore our solutions designed to optimize your resources and maximize your yields.",
            explore_solutions: "Explore Our Solutions",
            summary_ai_advisor_title: "Your Personal Agronomist",
            summary_ai_advisor_desc: "Have a problem with your crops? Describe it to our AI Advisor and receive an instant analysis and recommendations to protect your harvest.",
            try_ai_advisor: "Try the AI Advisor",
            summary_contact_title: "Ready to upgrade your farm?",
            summary_contact_desc: "Let's discuss your needs. Contact us today for a personalized quote and find out how FarmLink can transform your operation.",
            contact_us_button: "Contact Us",
            testimonials_title: "What Our Farmers Say",
            testimonial_1_text: "\"FarmLink has transformed my water management. I save time and money, and my yields have never been better.\"",
            testimonial_1_name: "Karim A.",
            testimonial_1_location: "Farmer, Sidi Bouzid",
            testimonial_2_text: "\"The installation was incredibly simple on my existing equipment. The control panel is very intuitive.\"",
            testimonial_2_name: "Fatma M.",
            testimonial_2_location: "Olive grove owner, Sfax",
            testimonial_3_text: "\"The AI advisor is a real game-changer. It helped me identify a pest problem before it spread. This is the future!\"",
            testimonial_3_name: "Youssef B.",
            testimonial_3_location: "Greenhouse farmer, Kairouan",
            footer_copyright: "&copy; 2025 FarmLink. All rights reserved.",
            about_hero_eyebrow: "About",
            about_main_title: "The future of farming, one harvest at a time.",
            about_intro_text: "At FarmLink we view agriculture as the essential technology of tomorrow. Our mission is to make smart farming accessible to every Tunisian operation.",
            about_vision_eyebrow: "Our mission",
            about_vision_title: "A future where every Tunisian farm is connected",
            about_vision_text: "We help growers secure yields against water stress and climate shocks through a retrofit, inclusive and financeable approach.",
            about_mission_water_title: "Sustainable water management",
            about_mission_water_desc: "Cut irrigation consumption by 30–50% by modernising existing equipment.",
            about_mission_soil_title: "Soil health & nutrition",
            about_mission_soil_desc: "Diagnose soils, steer fertigation and comply with international standards.",
            about_mission_support_title: "On-the-ground support",
            about_mission_support_desc: "Train teams, structure funding files and maintain local presence in every region.",
            about_values_eyebrow: "Our values",
            about_values_title: "Principles that guide every project",
            about_value1_title: "Measurable impact",
            about_value1_desc: "Each deployment is tracked with water, agronomic and economic KPIs shared with the producer.",
            about_value2_title: "Responsible retrofit",
            about_value2_desc: "We upgrade existing assets to reduce upfront costs and extend infrastructure lifespan.",
            about_value3_title: "Inclusive technology",
            about_value3_desc: "Arabic, French and English interfaces, continuous training and 7-day support tailored to local realities.",
            about_timeline_eyebrow: "Our journey",
            about_timeline_title: "From prototypes to a national network",
            about_timeline_2020_year: "2020",
            about_timeline_2020_title: "Drip irrigation prototypes",
            about_timeline_2020_desc: "First retrofit kits launched in Sfax with a 12-hectare pilot programme.",
            about_timeline_2021_year: "2021",
            about_timeline_2021_title: "Integration workshop opens",
            about_timeline_2021_desc: "Local assembly of control cabinets, CE certification and first LoRaWAN sensors.",
            about_timeline_2022_year: "2022",
            about_timeline_2022_title: "AI platform & agronomy coaching",
            about_timeline_2022_desc: "Multilingual AI advisor launched and the agronomy + data science team structured.",
            about_timeline_2024_year: "2024",
            about_timeline_2024_title: "Cooperative & finance partnerships",
            about_timeline_2024_desc: "Deployments across 18 governorates, green financing and value chain integrations for export.",
            about_team_eyebrow: "Our team",
            about_team_title: "Complementary profiles for your projects",
            about_team_description: "Agronomists, data scientists, electronics engineers and finance experts partner with your crews.",
            about_team_member1_name: "Leila Gharbi",
            about_team_member1_role: "Co-founder & CEO",
            about_team_member1_bio: "15 years in agri-digital transformation, ex-FAO consultant, leads strategic partnerships.",
            about_team_member2_name: "Anis Ben Youssef",
            about_team_member2_role: "CTO & IoT Lead",
            about_team_member2_bio: "Embedded engineer, LoRaWAN and cybersecurity specialist overseeing field architectures.",
            about_team_member3_name: "Syrine Baccar",
            about_team_member3_role: "Head of Agronomy & AI",
            about_team_member3_bio: "PhD in agronomic sciences, coordinates the AI advisor and experimentation protocols.",
            about_partners_eyebrow: "Our partners",
            about_partners_title: "A network of innovation and financing",
            about_partner1: "Ministry of Agriculture",
            about_partner2: "Olive cooperatives",
            about_partner3: "GIZ & EBRD programmes",
            about_partner4: "INRAT research institutes",
            how_it_works_title: "How It Works?",
            step1_title: "\"Retrofit\" Installation",
            step1_desc: "We install our modules on your existing equipment, without costly replacements.",
            step2_title: "Cloud Connection",
            step2_desc: "Sensors send real-time data to our secure platform.",
            step3_title: "Control & Optimization",
            step3_desc: "You manage everything from the control panel and receive AI-powered recommendations.",
            solutions_title: "Our Modular Solutions",
            solution_irrigation_title: "Smart Irrigation",
            solution_irrigation_desc: "Optimize your water consumption with smart valves and automated scheduling.",
            solution_pump_title: "Pump Control",
            solution_pump_desc: "Manage your pumps remotely and monitor flow and pressure in real time.",
            solution_env_title: "Environmental Monitoring",
            solution_env_desc: "Make informed decisions with data from temperature, humidity, and soil sensors.",
            ai_advisor_title: "✨ AI Farming Advisor",
            ai_welcome: "Hello! Ask me a question about your crops or send me a photo.",
            privacyNote: "Privacy guaranteed: All analysis is performed on your device.",
            contact_title: "Contact Us",
            contact_intro: "A question? A project? Don't hesitate to contact us. Our team is ready to help you take the step towards smart agriculture.",
            contact_name: "Name",
            contact_email: "Email",
            contact_phone: "Phone Number",
            contact_name_placeholder: "Your full name",
            contact_email_placeholder: "your.email@example.com",
            contact_phone_placeholder: "Your phone number (optional)",
            contact_message_placeholder: "Describe your project or question here...",
            contact_message: "Message",
            contact_send: "Send message",
            contact_send_label: "Send message",
            contact_sending: "Sending message…",
            contact_success_message: "Your message was sent successfully.",
            contact_error_message: "We couldn't send your message. Please check the fields and try again.",
            contact_network_error: "A network error occurred. Please try again.",
            contact_validation_name: "Please enter a valid name (2–120 characters).",
            contact_validation_email: "Please enter a valid email address.",
            contact_validation_phone: "The phone number looks invalid.",
            contact_validation_message: "Your message must contain at least 20 characters.",
            account_title: "My Account",
            auth_login_title: "Log In",
            auth_login_btn: "Log In",
            auth_register_prompt: "Don't have an account yet? <a href='register.php' data-route='register' class='text-brand-green-400 font-bold'>Create an account</a>",
            auth_register_title: "Create an Account",
            auth_register_btn: "Create Account",
            auth_register_instructions: "All fields are required. Use a password with at least eight characters.",
            auth_last_name_label: "Last Name",
            auth_first_name_label: "First Name",
            auth_email_label: "Email",
            auth_phone_label: "Phone",
            auth_region_label: "Region",
            auth_last_name_placeholder: "Last Name",
            auth_first_name_placeholder: "First Name",
            auth_email_placeholder: "Email",
            auth_phone_placeholder: "Phone Number",
            auth_region_placeholder: "Region",
            auth_login_prompt: "Already have an account? <a href='account.php' data-route='account' class='text-brand-blue-500 font-bold'>Log In</a>",
            products_section_title: "My Products",
            product_form_instructions: "Provide key product details to update the dashboard.",
            product_name_label: "Product Name",
            product_quantity_label: "Quantity",
            product_phone_label: "Mobile Phone",
            product_ph_label: "pH",
            product_rain_label: "Rain",
            product_humidity_label: "Humidity",
            product_soil_humidity_label: "Soil Humidity",
            product_light_label: "Light",
            product_valve_open_label: "Valve Open",
            product_valve_angle_label: "Valve Angle",
            product_name_placeholder: "Product name",
            product_quantity_placeholder: "Quantity",
            product_phone_placeholder: "Mobile phone",
            product_ph_placeholder: "pH",
            product_rain_placeholder: "Rain (mm)",
            product_humidity_placeholder: "Humidity (%)",
            product_soil_humidity_placeholder: "Soil humidity (%)",
            product_light_placeholder: "Light (lux)",
            product_valve_angle_placeholder: "Valve angle",
            add_product_btn: "Add",
            logout_btn: "Log Out",
            profile_form_instructions: "Update your FarmLink contact details. All fields are required.",
            profile_last_name_label: "Last Name",
            profile_first_name_label: "First Name",
            profile_email_label: "Email",
            profile_phone_label: "Phone",
            profile_region_label: "Region",
            profile_update_button: "Update",
            footer_mission: "We connect Tunisian farmers with smart, sustainable tools.",
            footer_nav_title: "Navigation",
            footer_legal_title: "Legal",
            footer_home: "Home",
            footer_contact_link: "Contact",
            footer_privacy: "Privacy Policy",
            footer_terms: "Terms of Use",
            footer_cookies: "Cookie Policy",
            footer_contact_title: "Get in touch",
            footer_contact_email: "Email: contact@farmlink.tn",
            footer_contact_phone: "Phone: +216 12 345 678",
            privacy_title: "Privacy Policy",
            privacy_intro: "This policy explains how FarmLink collects, uses, and protects users' and customers' personal information.",
            privacy_collection_heading: "Data We Collect",
            privacy_collection_text: "We only collect information required to deliver our services and respond to your requests.",
            privacy_collection_item_1: "Identity data: name, surname, company, and contact details.",
            privacy_collection_item_2: "Contact data: email address, phone number, and language preferences.",
            privacy_collection_item_3: "Usage data: site interactions, submitted requests, and responses provided.",
            privacy_use_heading: "How We Use Your Data",
            privacy_use_item_1: "Answer contact requests and prepare tailored proposals.",
            privacy_use_item_2: "Maintain your FarmLink account and secure dashboard access.",
            privacy_use_item_3: "Improve our services, measure performance, and detect fraud attempts.",
            privacy_legal_heading: "Legal Basis & Retention",
            privacy_legal_text: "We process data based on your consent, contract performance, or our legitimate interests. Data is kept for the duration of our relationship and archived for the legally required period.",
            privacy_rights_heading: "Your Rights",
            privacy_rights_intro: "Under GDPR and Tunisian law, you have the following rights:",
            privacy_rights_item_1: "Access your data and request a copy.",
            privacy_rights_item_2: "Correct inaccurate or incomplete information.",
            privacy_rights_item_3: "Request deletion of your data or restriction of processing.",
            privacy_rights_item_4: "Object to processing or withdraw consent at any time.",
            privacy_contact_heading: "Contact & Complaints",
            privacy_contact_text: "To exercise your rights or ask a question, email us at contact@farmlink.tn. You may also contact the relevant data protection authority.",
            terms_title: "Terms of Use",
            terms_intro: "These terms govern how farmers, partners, and visitors use the FarmLink website and services.",
            terms_usage_heading: "Use of the Website",
            terms_usage_text: "You agree to use FarmLink lawfully and to avoid any action that harms the service or third-party rights.",
            terms_accounts_heading: "Accounts & Security",
            terms_accounts_text: "Restricted areas (dashboard, admin) are personal. Protect your credentials and report unauthorised access.",
            terms_liability_heading: "Liability",
            terms_liability_text: "FarmLink implements technical safeguards to ensure availability. We cannot be held liable for indirect damages or misuse.",
            terms_changes_heading: "Changes",
            terms_changes_text: "We may update these terms to reflect service changes or regulations. Updates apply as soon as they are published.",
            terms_contact_heading: "Contact Us",
            terms_contact_text: "For any questions about these terms, email contact@farmlink.tn and we'll respond promptly.",
            cookies_title: "Cookie Policy",
            cookies_intro: "This policy describes the types of cookies used on FarmLink and how to manage your preferences.",
            cookies_definition_heading: "What Is a Cookie?",
            cookies_definition_text: "A cookie is a small text file stored on your device to keep the site running smoothly and enhance your experience.",
            cookies_types_heading: "Cookies We Use",
            cookies_types_item_1: "Essential cookies: required for security, session management, and remembering your language choice.",
            cookies_types_item_2: "Performance cookies: help us measure site usage to improve our services.",
            cookies_types_item_3: "No third-party advertising cookies are used on FarmLink.",
            cookies_control_heading: "Your Choices",
            cookies_control_text: "You can configure your browser to block or delete cookies. Some essential FarmLink features may stop working correctly.",
            cookies_contact_heading: "Contact Us",
            cookies_contact_text: "If you have questions about cookies, email contact@farmlink.tn.",
            context_agricole: `
                ### SUBJECT: AGRICULTURE IN TUNISIA ###
                Agriculture in Tunisia faces challenges like drought and soil salinity. Main crops include olives, cereals, dates, and citrus fruits. Good water management is crucial.
                ### PROBLEM: YELLOW LEAVES (CHLOROSIS) ###
                Yellow leaves on a plant are often a sign of nutrient deficiency or disease.
                - On tomatoes, yellow spots can indicate downy mildew, especially in humid weather. Another cause is nitrogen deficiency, which yellows older leaves first.
                - On olive trees, yellowing can be caused by lack of water, soil that is too calcareous, or a disease like Verticillium wilt.
                - On citrus trees (lemon, orange), yellow leaves with green veins often indicate an iron deficiency (iron chlorosis), common in Tunisian calcareous soils. Solution: apply iron chelate.
            `,
        },
        ar: {
            nav_about: "نبذة عنا",
            nav_how_it_works: "كيف نعمل",
            nav_solutions: "حلولنا",
            nav_ai_advisor: "✨ المستشار الذكي",
            nav_account: "حسابي",
            nav_get_quote: "اطلب عرض سعر",
            nav_about_mobile: "نبذة عنا",
            nav_how_it_works_mobile: "كيف نعمل",
            nav_solutions_mobile: "حلولنا",
            nav_ai_advisor_mobile: "✨ المستشار الذكي",
            nav_account_mobile: "حسابي",
            nav_login: "تسجيل الدخول",
            nav_register: "إنشاء حساب",
            nav_dashboard: "لوحة التحكم",
            nav_login_mobile: "تسجيل الدخول",
            nav_register_mobile: "إنشاء حساب",
            nav_dashboard_mobile: "لوحة التحكم",
            nav_logged_in_prefix: "متصل باسم",
            nav_get_quote_mobile: "اطلب عرض سعر",
            hero_tagline: "منصة زراعية ذكية تونسية 100%",
            hero_title: "اربط مزرعتك وتحكّم في كل قطرة ماء.",
            hero_subtitle: "تقوم FarmLink برقمنة الري والتسميد ومتابعة المحاصيل عبر أطقم تحديث سريعة ومنصة ذكاء اصطناعي مصممة لمناخات المغرب العربي.",
            hero_primary_cta: "اكتشف الوحدات",
            hero_secondary_cta: "تحدث مع خبير",
            hero_button: "اكتشف الوحدات",
            hero_metric_clients_label: "مزارع متصلة",
            hero_metric_clients_value: "250+",
            hero_metric_water_label: "نسبة التوفير في المياه",
            hero_metric_water_value: "35%",
            hero_metric_regions_label: "عدد الولايات المغطاة",
            hero_metric_regions_value: "18",
            stats_eyebrow: "أثر قابل للقياس",
            stats_title: "نتائج ملموسة على الأرض",
            stats_subtitle: "المزارع التي ترافقها FarmLink تخفض تكاليف المياه، تزيد الإنتاجية وتؤمّن شهاداتها.",
            stats_irrigated_value: "+40%",
            stats_irrigated_label: "تحسّن في كفاءة الري بفضل الصمامات الذكية والتخطيط المدعوم بالذكاء الاصطناعي.",
            stats_traceability_value: "100%",
            stats_traceability_label: "تتبع كامل للتدخلات عبر سجلات رقمية وتنبيهات فورية.",
            stats_roi_value: "12 شهرًا",
            stats_roi_label: "لاسترجاع الاستثمار في التحديث للمزارع المروية.",
            features_eyebrow: "منصة برمجيات وأجهزة",
            features_title: "منظومة متكاملة لإدارة الاستغلاليات",
            features_subtitle: "تمزج FarmLink بين مجسّات متينة، وحدات تحديث، توأم رقمي ومستشار ذكاء اصطناعي لأتمتة القرارات الميدانية.",
            feature_monitoring_title: "مراقبة المناخ الدقيق",
            feature_monitoring_desc: "محطة أرصاد، مجسّات تربة ومسابير تسميد لمتابعة إجهاد المياه واحتياجات التغذية.",
            feature_retrofit_title: "تحديث دون إيقاف الإنتاج",
            feature_retrofit_desc: "أطقمنا تُثبت على اللوحات الحالية وتتصل عبر LoRaWAN أو 4G لضمان نشر سريع.",
            feature_ai_title: "مستشار ذكاء اصطناعي متعدد اللغات",
            feature_ai_desc: "تحليل فوري، سيناريوهات ري وإنذار مبكر بالأمراض بالفرنسية والإنجليزية والعربية.",
            feature_integrations_title: "تكامل مع سلسلة التوريد",
            feature_integrations_desc: "مشاركة البيانات مع التعاونيات، شهادات GlobalG.A.P. والشركاء الماليين.",
            modules_eyebrow: "وحدات FarmLink",
            modules_title: "اختر اللبنات المناسبة لمحاصيلك",
            modules_subtitle: "حلولنا المعيارية تركّب حسب الحقول: أشجار مثمرة، خضروات، دفيئات، حبوب أو تربية مواشي.",
            module_irrigation_title: "التحكم في الري",
            module_irrigation_desc: "أتمتة دورات الري، موازنة الضغط والتنبيه عن التسريبات للبيفوت والتنقيط والرش.",
            module_soil_title: "تشخيص التربة والتسميد",
            module_soil_desc: "متابعة الحموضة، الملوحة، الرطوبة وNPK مع توصيات تسميد ملائمة للمحاصيل المتوسطية.",
            module_ops_title: "العمليات والتتبع",
            module_ops_desc: "تخطيط التدخلات، تتبع الحصاد ومشاركة البيانات مع المشترين والجهات الممولة.",
            module_discover_label: "اطلع على الوحدة",
            process_eyebrow: "نشر في 3 مراحل",
            process_title: "منهجية ميدانية مجرّبة",
            process_subtitle: "فرقنا ترافق المزارع التونسية من التشخيص الأولي إلى التمويل وتغيير طرق العمل.",
            process_step1_title: "تدقيق وتصميم مشترك",
            process_step1_desc: "تحليل القطع، ربط العدّادات الحالية وإعداد ملفات التمويل (منح، قروض خضراء).",
            process_steps_title: "ثلاث مراحل مدفوعة بالبيانات",
            process_step1_point1: "رسم الخرائط الهيدروليكية والكهربائية للاستغلالية",
            process_step1_point2: "تحديد مؤشرات المياه والطاقة والإنتاج والجودة",
            process_step1_point3: "تخطيط التنفيذ بالتنسيق مع فرقكم",
            process_step2_title: "تركيب تحديثي",
            process_step2_desc: "تركيب المجسّات ووحدات التحكم وضبط المنصة دون توقيف الإنتاج.",
            process_step2_point1: "تركيب الخزائن الذكية والربط عبر LoRaWAN/4G",
            process_step2_point2: "معايرة مجسّات التربة والتسميد والمناخ المحلي",
            process_step2_point3: "تكوين أولي على استخدام المنصة والمستشار الذكي",
            process_step3_title: "مرافقة وتحسين",
            process_step3_desc: "دعم موسمي، تنبيهات ذكاء اصطناعي مخصصة وتكامل مع شركاء سلسلة القيمة.",
            process_step3_point1: "مراجعة شهرية للمؤشرات وضبط السيناريوهات",
            process_step3_point2: "دعم متواصل وزيارات ميدانية خلال الفترات الحرجة",
            process_step3_point3: "مشاركة البيانات مع التعاونيات والجهات الممولة وشركات التأمين",
            testimonials_eyebrow: "ثقة المزارعين",
            cta_eyebrow: "جاهزون للانطلاق",
            process_deliverables_eyebrow: "مخرجات أساسية",
            process_deliverables_title: "ما تحصلون عليه في كل مرحلة",
            process_deliverable1_title: "ملف تقني ومالي",
            process_deliverable1_desc: "مخطط تجهيز، رسومات تكامل، ميزانية مفصلة ومحاكاة للعائد على الاستثمار لتسهيل التمويل.",
            process_deliverable2_title: "منصة مهيأة وبيانات مباشرة",
            process_deliverable2_desc: "لوحة معلومات متعددة اللغات، وصول عبر الهاتف، تكامل المجسّات وتنبيهات جاهزة.",
            process_deliverable3_title: "خطة تحسين زراعي",
            process_deliverable3_desc: "رزنامة التدخلات، توصيات ذكاء اصطناعي موسمية وتقارير موجهة للتعاونيات والجهات الممولة.",
            process_support_eyebrow: "دعم متواصل",
            process_support_title: "خبراء متوفرون طيلة الأسبوع",
            process_support_desc: "مدير حساب مخصص، خط مساعدة متعدد اللغات ومركز مراقبة يرافقكم طوال الموسم.",
            process_support_item1_title: "مركز العمليات",
            process_support_item1_desc: "مراقبة فورية للتنبيهات، دعم عن بعد وتوصيات ذكاء اصطناعي حسب السياق.",
            process_support_item2_title: "زيارات ميدانية",
            process_support_item2_desc: "حملات قياس في الحقول، تحاليل تربة وضبط للري والتسميد.",
            process_support_item3_title: "أكاديمية FarmLink",
            process_support_item3_desc: "دورات حضورية أو عن بعد، فيديوهات تدريبية وموارد مترجمة بالعربية والفرنسية والإنجليزية.",
            process_cta_title: "جاهزون لإطلاق تدقيق مزرعتكم؟",
            process_cta_desc: "حددوا موعدًا مع خبرائنا للحصول على تقييم أولي مجاني وخطة تحديث مخصصة.",
            process_cta_button: "احجزوا تشخيصًا",
            summary_about_title: "رؤيتنا: مستقبل ذكي",
            summary_about_desc: "نحن نعمل على نشر الزراعة الذكية. اكتشف كيف يواجه التزامنا بالابتكار \"التحديثي\" التحديات العالمية ويخلق مستقبلًا مستدامًا للجميع.",
            learn_more_about_us: "اعرف المزيد عنا",
            summary_solutions_title: "حلول معيارية قوية",
            summary_solutions_desc: "الري الذكي، التحكم في المضخات، المراقبة البيئية. استكشف حلولنا المصممة لتحسين مواردك وزيادة غلتك.",
            explore_solutions: "استكشف حلولنا",
            summary_ai_advisor_title: "مهندسك الزراعي الشخصي",
            summary_ai_advisor_desc: "هل لديك مشكلة في محاصيلك؟ صفها لمستشارنا الذكي واحصل على تحليل وتوصيات فورية لحماية محصولك.",
            try_ai_advisor: "جرب المستشار الذكي",
            summary_contact_title: "هل أنت مستعد لتحديث مزرعتك؟",
            summary_contact_desc: "دعنا نناقش احتياجاتك. اتصل بنا اليوم للحصول على عرض أسعار شخصي واكتشف كيف يمكن لـ FarmLink تحويل عملياتك الزراعية.",
            contact_us_button: "اتصل بنا",
            testimonials_title: "ماذا يقول مزارعونا",
            testimonial_1_text: "\"لقد غيرت FarmLink إدارة المياه لدي. أوفر الوقت والمال، ومحاصيلي لم تكن أفضل من أي وقت مضى.\"",
            testimonial_1_name: "كريم أ.",
            testimonial_1_location: "مزارع، سيدي بوزيد",
            testimonial_2_text: "\"كان التركيب بسيطًا بشكل لا يصدق على معداتي الحالية. لوحة التحكم سهلة الاستخدام للغاية.\"",
            testimonial_2_name: "فاطمة م.",
            testimonial_2_location: "صاحبة بستان زيتون، صفاقس",
            testimonial_3_text: "\"المستشار الذكي هو إضافة حقيقية. لقد ساعدني في تحديد مشكلة الآفات قبل انتشارها. هذا هو المستقبل!\"",
            testimonial_3_name: "يوسف ب.",
            testimonial_3_location: "مزارع صوبات، القيروان",
            footer_copyright: "&copy; 2025 FarmLink. جميع الحقوق محفوظة.",
            about_hero_eyebrow: "من نحن",
            about_main_title: "زراعة الغد، حصادًا بعد حصاد.",
            about_intro_text: "نرى في FarmLink أن الزراعة هي تكنولوجيا المستقبل الأساسية. رسالتنا أن نجعل الزراعة الذكية في متناول كل استغلالية تونسية.",
            about_vision_eyebrow: "رسالتنا",
            about_vision_title: "مستقبل ترتبط فيه كل مزرعة تونسية",
            about_vision_text: "نساعد المزارعين على تأمين محاصيلهم ضد الإجهاد المائي والاضطرابات المناخية عبر مقاربة تحديثية شاملة وممولة.",
            about_mission_water_title: "إدارة مائية مستدامة",
            about_mission_water_desc: "تقليص استهلاك المياه بنسبة 30 إلى 50٪ عبر تحديث تجهيزات الري الحالية.",
            about_mission_soil_title: "صحة التربة والتغذية",
            about_mission_soil_desc: "تشخيص التربة، قيادة التسميد والالتزام بالمعايير الدولية.",
            about_mission_support_title: "مرافقة ميدانية",
            about_mission_support_desc: "تكوين الفرق، إعداد ملفات التمويل والحضور المحلي في كل ولاية.",
            about_values_eyebrow: "قيمنا",
            about_values_title: "مبادئ توجه كل مشروع",
            about_value1_title: "أثر قابل للقياس",
            about_value1_desc: "كل مشروع يُتابع بمؤشرات مائية وزراعية واقتصادية يتقاسمها الفريق مع المنتج.",
            about_value2_title: "تحديث مسؤول",
            about_value2_desc: "نطور المعدات الموجودة للحد من الاستثمار الأولي وإطالة عمر البنية التحتية.",
            about_value3_title: "تكنولوجيا شاملة",
            about_value3_desc: "واجهات بالعربية والفرنسية والإنجليزية، تدريب مستمر ودعم متوفر طوال الأسبوع بما يلائم الواقع المحلي.",
            about_timeline_eyebrow: "مسيرتنا",
            about_timeline_title: "من النماذج الأولية إلى شبكة وطنية",
            about_timeline_2020_year: "2020",
            about_timeline_2020_title: "نماذج أولية للري بالتنقيط",
            about_timeline_2020_desc: "إطلاق أولى أطقم التحديث في صفاقس ضمن برنامج تجريبي على 12 هكتارًا.",
            about_timeline_2021_year: "2021",
            about_timeline_2021_title: "افتتاح ورشة التكامل",
            about_timeline_2021_desc: "تجميع محلي للخزائن الذكية، الحصول على شهادة CE واعتماد أوائل المجسّات LoRaWAN.",
            about_timeline_2022_year: "2022",
            about_timeline_2022_title: "منصة ذكاء اصطناعي ومرافقة زراعية",
            about_timeline_2022_desc: "إطلاق المستشار الذكي متعدد اللغات وتشكيل فريق علم الزراعة وعلوم البيانات.",
            about_timeline_2024_year: "2024",
            about_timeline_2024_title: "شراكات مع التعاونيات والجهات الممولة",
            about_timeline_2024_desc: "انتشار في 18 ولاية، تمويل أخضر وربط بسلاسل القيمة للتصدير.",
            about_team_eyebrow: "فريقنا",
            about_team_title: "كفاءات متكاملة لمشاريعكم",
            about_team_description: "مهندسون زراعيون، علماء بيانات، مختصون في الإلكترونيات وتمويل يعملون جنبًا إلى جنب مع فرقكم.",
            about_team_member1_name: "ليلى الغربي",
            about_team_member1_role: "الشريكة المؤسسة والمديرة التنفيذية",
            about_team_member1_bio: "خبرة 15 سنة في التحول الرقمي الزراعي، مستشارة سابقة لدى الفاو، تشرف على الشراكات الإستراتيجية.",
            about_team_member2_name: "أنيس بن يوسف",
            about_team_member2_role: "المدير التقني وقائد حلول إنترنت الأشياء",
            about_team_member2_bio: "مهندس أنظمة مضمنة، مختص LoRaWAN وأمن سيبراني، يشرف على البنى الميدانية.",
            about_team_member3_name: "سرين بكر",
            about_team_member3_role: "مديرة الزراعة والذكاء الاصطناعي",
            about_team_member3_bio: "دكتورة في العلوم الزراعية، تنسق المستشار الذكي وبروتوكولات التجارب.",
            about_partners_eyebrow: "شركاؤنا",
            about_partners_title: "شبكة ابتكار وتمويل",
            about_partner1: "وزارة الفلاحة",
            about_partner2: "التعاونيات الزيتونية",
            about_partner3: "برامج GIZ وEBRD",
            about_partner4: "معاهد البحث INRAT",
            how_it_works_title: "كيف نعمل؟",
            step1_title: "تركيب \"تحديثي\"",
            step1_desc: "نقوم بتركيب وحداتنا على معداتك الحالية، دون الحاجة إلى استبدالها بالكامل.",
            step2_title: "الاتصال السحابي",
            step2_desc: "ترسل المستشعرات البيانات في الوقت الفعلي إلى منصتنا الآمنة.",
            step3_title: "التحكم والتحسين",
            step3_desc: "يمكنك إدارة كل شيء من لوحة التحكم وتلقي توصيات مدعومة بالذكاء الاصطناعي.",
            solutions_title: "حلولنا المعيارية",
            solution_irrigation_title: "الري الذكي",
            solution_irrigation_desc: "حسّن استهلاكك للمياه باستخدام الصمامات الذكية والجدولة الآلية.",
            solution_pump_title: "التحكم في المضخات",
            solution_pump_desc: "أدر مضخاتك عن بعد وراقب التدفق والضغط في الوقت الفعلي.",
            solution_env_title: "المراقبة البيئية",
            solution_env_desc: "اتخذ قرارات مستنيرة بفضل بيانات مستشعرات درجة الحرارة والرطوبة والتربة.",
            ai_advisor_title: "✨ المستشار الزراعي الذكي",
            ai_welcome: "مرحباً! اسألني سؤالاً عن محاصيلك أو أرسل لي صورة.",
            privacyNote: "الخصوصية مضمونة: يتم إجراء جميع التحليلات على جهازك.",
            contact_title: "اتصل بنا",
            contact_intro: "سؤال؟ مشروع؟ لا تتردد في الاتصال بنا. فريقنا مستعد لمساعدتك على اتخاذ الخطوة نحو الزراعة الذكية.",
            contact_name: "الاسم",
            contact_email: "البريد الإلكتروني",
            contact_phone: "رقم الهاتف",
            contact_name_placeholder: "اسمك الكامل",
            contact_email_placeholder: "your.email@example.com",
            contact_phone_placeholder: "رقم هاتفك (اختياري)",
            contact_message_placeholder: "صف مشروعك أو سؤالك هنا...",
            contact_message: "الرسالة",
            contact_send: "إرسال الرسالة",
            contact_send_label: "إرسال الرسالة",
            contact_sending: "جارٍ إرسال الرسالة…",
            contact_success_message: "تم إرسال رسالتك بنجاح.",
            contact_error_message: "تعذر إرسال الرسالة. تحقق من الحقول وحاول مرة أخرى.",
            contact_network_error: "حدث خطأ في الشبكة. حاول مجددًا.",
            contact_validation_name: "يرجى إدخال اسم صالح (من 2 إلى 120 حرفًا).",
            contact_validation_email: "يرجى إدخال بريد إلكتروني صالح.",
            contact_validation_phone: "رقم الهاتف غير صالح.",
            contact_validation_message: "يجب أن يحتوي رسالتك على 20 حرفًا على الأقل.",
            account_title: "حسابي",
            auth_login_title: "تسجيل الدخول",
            auth_login_btn: "تسجيل الدخول",
            auth_register_prompt: "لا يوجد لديك حساب بعد؟ <a href='register.php' data-route='register' class='text-brand-green-400 font-bold'>إنشاء حساب</a>",
            auth_register_title: "إنشاء حساب",
            auth_register_btn: "إنشاء الحساب",
            auth_register_instructions: "جميع الحقول مطلوبة. استخدم كلمة مرور لا تقل عن ثمانية أحرف.",
            auth_last_name_label: "اللقب",
            auth_first_name_label: "الاسم",
            auth_email_label: "البريد الإلكتروني",
            auth_phone_label: "الهاتف",
            auth_region_label: "المنطقة",
            auth_last_name_placeholder: "اللقب",
            auth_first_name_placeholder: "الاسم الأول",
            auth_email_placeholder: "البريد الإلكتروني",
            auth_phone_placeholder: "رقم الهاتف",
            auth_region_placeholder: "المنطقة",
            auth_login_prompt: "لديك حساب بالفعل؟ <a href='account.php' data-route='account' class='text-brand-blue-500 font-bold'>تسجيل الدخول</a>",
            products_section_title: "منتجاتي",
            product_form_instructions: "أدخل بيانات المنتج الأساسية لتحديث لوحة التحكم.",
            product_name_label: "اسم المنتج",
            product_quantity_label: "الكمية",
            product_phone_label: "هاتف محمول",
            product_ph_label: "درجة الحموضة",
            product_rain_label: "الأمطار",
            product_humidity_label: "الرطوبة",
            product_soil_humidity_label: "رطوبة التربة",
            product_light_label: "الإضاءة",
            product_valve_open_label: "الصمام مفتوح",
            product_valve_angle_label: "زاوية الصمام",
            product_name_placeholder: "اسم المنتج",
            product_quantity_placeholder: "الكمية",
            product_phone_placeholder: "هاتف محمول",
            product_ph_placeholder: "درجة الحموضة",
            product_rain_placeholder: "الأمطار (مم)",
            product_humidity_placeholder: "الرطوبة (%)",
            product_soil_humidity_placeholder: "رطوبة التربة (%)",
            product_light_placeholder: "الإضاءة (لوكس)",
            product_valve_angle_placeholder: "زاوية الصمام",
            add_product_btn: "أضف",
            logout_btn: "تسجيل الخروج",
            profile_form_instructions: "حدّث بيانات التواصل الخاصة بك في FarmLink. جميع الحقول مطلوبة.",
            profile_last_name_label: "اللقب",
            profile_first_name_label: "الاسم",
            profile_email_label: "البريد الإلكتروني",
            profile_phone_label: "الهاتف",
            profile_region_label: "المنطقة",
            profile_update_button: "تحديث",
            footer_mission: "نربط المزارعين التونسيين بأدوات ذكية ومستدامة.",
            footer_nav_title: "التنقل",
            footer_legal_title: "الوثائق القانونية",
            footer_home: "الرئيسية",
            footer_contact_link: "اتصل بنا",
            footer_privacy: "سياسة الخصوصية",
            footer_terms: "شروط الاستخدام",
            footer_cookies: "سياسة ملفات تعريف الارتباط",
            footer_contact_title: "تواصل معنا",
            footer_contact_email: "البريد الإلكتروني: contact@farmlink.tn",
            footer_contact_phone: "الهاتف: ‎+216 12 345 678",
            privacy_title: "سياسة الخصوصية",
            privacy_intro: "توضح هذه السياسة كيفية جمع FarmLink للمعلومات الشخصية واستخدامها وحمايتها للمستخدمين والعملاء.",
            privacy_collection_heading: "البيانات التي نجمعها",
            privacy_collection_text: "نجمع فقط المعلومات اللازمة لتقديم خدماتنا والرد على طلباتك.",
            privacy_collection_item_1: "بيانات الهوية: الاسم واللقب والشركة وبيانات الاتصال.",
            privacy_collection_item_2: "بيانات الاتصال: عنوان البريد الإلكتروني، رقم الهاتف، وتفضيلات اللغة.",
            privacy_collection_item_3: "بيانات الاستخدام: التفاعلات على الموقع، الطلبات المرسلة، والردود المستلمة.",
            privacy_use_heading: "كيفية استخدامنا لبياناتك",
            privacy_use_item_1: "الرد على طلبات الاتصال وإعداد عروض مخصصة.",
            privacy_use_item_2: "متابعة حسابك على FarmLink وتأمين الوصول إلى لوحات التحكم.",
            privacy_use_item_3: "تحسين خدماتنا، قياس الأداء، واكتشاف محاولات الاحتيال.",
            privacy_legal_heading: "الأساس القانوني والاحتفاظ",
            privacy_legal_text: "نُعالج بياناتك بناءً على موافقتك أو تنفيذ عقد أو مصالحنا المشروعة. نحتفظ بالبيانات طوال العلاقة التجارية ثم نؤرشفها للمدة القانونية اللازمة.",
            privacy_rights_heading: "حقوقك",
            privacy_rights_intro: "وفقًا للائحة العامة لحماية البيانات والقانون التونسي لديك الحقوق التالية:",
            privacy_rights_item_1: "الوصول إلى بياناتك وطلب نسخة منها.",
            privacy_rights_item_2: "تصحيح المعلومات غير الدقيقة أو غير المكتملة.",
            privacy_rights_item_3: "طلب حذف بياناتك أو تقييد معالجتها.",
            privacy_rights_item_4: "الاعتراض على المعالجة أو سحب موافقتك في أي وقت.",
            privacy_contact_heading: "التواصل والشكاوى",
            privacy_contact_text: "لممارسة حقوقك أو طرح سؤال راسلنا على contact@farmlink.tn. يمكنك أيضًا التواصل مع هيئة حماية البيانات المختصة.",
            terms_title: "شروط الاستخدام",
            terms_intro: "تنظم هذه الشروط كيفية استخدام المزارعين والشركاء والزوار لموقع وخدمات FarmLink.",
            terms_usage_heading: "استخدام الموقع",
            terms_usage_text: "تتعهد باستخدام FarmLink بشكل قانوني وعدم الإضرار بالخدمة أو حقوق الآخرين.",
            terms_accounts_heading: "الحسابات والأمان",
            terms_accounts_text: "المناطق المحمية (لوحة التحكم، الإدارة) شخصية. يجب حماية بيانات الدخول والإبلاغ عن أي استخدام غير مصرح به.",
            terms_liability_heading: "المسؤولية",
            terms_liability_text: "تُطبق FarmLink تدابير تقنية لضمان توفر الخدمة. لا نتحمل مسؤولية الأضرار غير المباشرة أو سوء الاستخدام.",
            terms_changes_heading: "التعديلات",
            terms_changes_text: "قد نقوم بتحديث هذه الشروط لتواكب تطور خدماتنا أو القوانين. تصبح النسخ الجديدة سارية فور نشرها.",
            terms_contact_heading: "اتصل بنا",
            terms_contact_text: "لأي استفسار حول هذه الشروط راسلنا على contact@farmlink.tn وسنرد عليك في أقرب وقت.",
            cookies_title: "سياسة ملفات تعريف الارتباط",
            cookies_intro: "تشرح هذه السياسة أنواع ملفات تعريف الارتباط المستخدمة على FarmLink وكيفية إدارة تفضيلاتك.",
            cookies_definition_heading: "ما هو ملف تعريف الارتباط؟",
            cookies_definition_text: "ملف تعريف الارتباط هو ملف نصي صغير يُخزن على جهازك لضمان عمل الموقع وتحسين تجربتك.",
            cookies_types_heading: "ملفات تعريف الارتباط التي نستخدمها",
            cookies_types_item_1: "ملفات أساسية: ضرورية للأمان وإدارة الجلسة وتذكر تفضيلات اللغة.",
            cookies_types_item_2: "ملفات الأداء: تساعدنا على قياس استخدام الموقع لتحسين خدماتنا.",
            cookies_types_item_3: "لا نستخدم أي ملفات تعريف ارتباط إعلانية تابعة لطرف ثالث على FarmLink.",
            cookies_control_heading: "اختياراتك",
            cookies_control_text: "يمكنك ضبط متصفحك لحظر ملفات تعريف الارتباط أو حذفها. قد تتوقف بعض وظائف FarmLink الأساسية عن العمل بشكل صحيح.",
            cookies_contact_heading: "تواصل معنا",
            cookies_contact_text: "لأي سؤال حول ملفات تعريف الارتباط راسلنا على contact@farmlink.tn.",
            context_agricole: `
                ### الموضوع: الزراعة في تونس ###
                تواجه الزراعة في تونس تحديات مثل الجفاف وملوحة التربة. المحاصيل الرئيسية تشمل الزيتون والحبوب والتمور والحمضيات. الإدارة الجيدة للمياه أمر بالغ الأهمية.
            `,
        }
    };
    

    // --- SÉLECTEURS D'ÉLÉMENTS ---
    const body = document.body;
    const defaultLang = body.dataset.defaultLang || 'fr';
    const htmlElement = document.documentElement;
    const languageSwitcher = document.getElementById('language-switcher');
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const themeToggle = document.getElementById('theme-toggle');
    const themeIconLight = document.getElementById('theme-icon-light');
    const themeIconDark = document.getElementById('theme-icon-dark');
    const accountLink = body.dataset.accountLink || 'account.php';
    const registerLink = body.dataset.registerLink || 'register.php';
    const profileLink = body.dataset.profileLink || 'profile.php';
    const requestPath = body.dataset.requestPath || window.location.pathname;

    const savedLang = localStorage.getItem('language');
    const sessionLang = body.dataset.currentLang || defaultLang;
    let currentLang = savedLang && translations[savedLang] ? savedLang : sessionLang;
    if (!translations[currentLang]) {
        currentLang = defaultLang;
    }
    localStorage.setItem('language', currentLang);

    const applyDynamicLinks = () => {
        document.querySelectorAll('[data-route="account"]').forEach(link => {
            link.setAttribute('href', accountLink);
        });
        document.querySelectorAll('[data-route="register"]').forEach(link => {
            link.setAttribute('href', registerLink);
        });
        document.querySelectorAll('[data-route="profile"]').forEach(link => {
            link.setAttribute('href', profileLink);
        });
    };

    const applyLanguage = (lang) => {
        currentLang = lang;
        body.dataset.currentLang = lang;
        htmlElement.lang = lang;
        htmlElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
        if (languageSwitcher && languageSwitcher.value !== lang) {
            languageSwitcher.value = lang;
        }
        document.querySelectorAll('[data-translate]').forEach(el => {
            const key = el.getAttribute('data-translate');
            if (!el.dataset.original) {
                el.dataset.original = el.innerHTML;
            }
            const translation = translations[lang] && translations[lang][key];
            if (translation) {
                el.innerHTML = translation;
            } else if (el.dataset.original) {
                el.innerHTML = el.dataset.original;
            }
        });
        document.querySelectorAll('[data-translate-placeholder]').forEach(el => {
            const key = el.getAttribute('data-translate-placeholder');
            if (translations[lang] && translations[lang][key]) {
                el.setAttribute('placeholder', translations[lang][key]);
            }
        });
    };

    const applyTheme = (theme) => {
        if (theme === 'dark') {
            body.classList.add('dark');
            if(themeIconLight) themeIconLight.classList.add('hidden');
            if(themeIconDark) themeIconDark.classList.remove('hidden');
        } else {
            body.classList.remove('dark');
            if(themeIconLight) themeIconLight.classList.remove('hidden');
            if(themeIconDark) themeIconDark.classList.add('hidden');
        }
    };

    const savedTheme = localStorage.getItem('theme') || 'dark';
    const localeHrefMap = languageSwitcher
        ? Array.from(languageSwitcher.options).reduce((acc, option) => {
            const value = option.value.trim();
            const href = option.dataset.href;
            if (value && href) {
                acc[value] = href;
            }
            return acc;
        }, {})
        : {};

    if (languageSwitcher) {
        languageSwitcher.value = currentLang;
    }
    applyLanguage(currentLang);
    applyDynamicLinks();
    applyTheme(savedTheme);

    const currentPage = (requestPath.split("/").pop() || 'index.php') || 'index.php';
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href') === currentPage) link.classList.add('active');
    });

    if (languageSwitcher) languageSwitcher.addEventListener('change', (e) => {
        const newLang = e.target.value;
        if (translations[newLang]) {
            localStorage.setItem('language', newLang);
        } else {
            localStorage.removeItem('language');
        }
        applyLanguage(newLang);
        const targetHref = localeHrefMap[newLang];
        if (targetHref) {
            window.location.href = targetHref;
            return;
        }
        const url = new URL(window.location.href);
        if (newLang === defaultLang) {
            url.searchParams.delete('lang');
        } else {
            url.searchParams.set('lang', newLang);
        }
        window.location.href = url.toString();
    });
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden');
            menuBtn.setAttribute('aria-expanded', String(isHidden));
        });
    }
    if (themeToggle) themeToggle.addEventListener('click', () => {
        const newTheme = body.classList.contains('dark') ? 'light' : 'dark';
        localStorage.setItem('theme', newTheme);
        applyTheme(newTheme);
    });

    // --- LOGIQUE SPÉCIFIQUE À LA PAGE AI-ADVISOR ---
    if (document.getElementById('ai-advisor')) {
        let models = { image: null, ready: false };
        let stream = null;

        const aiInputForm = document.getElementById('ai-input-form');
        const textInput = document.getElementById('text-input');
        const fileInput = document.getElementById('fileInput');
        const webcamBtn = document.getElementById('webcamBtn');
        const captureBtn = document.getElementById('captureBtn');

        const imagePreviewWrapper = document.getElementById('image-preview-wrapper');
        const previewImg = document.getElementById('previewImg');
        const cam = document.getElementById('cam');
        const aiResponseText = document.getElementById('ai-response-text');
        const aiSpinner = document.getElementById('ai-spinner');

        const progressContainer = document.getElementById('progress-container');
        const progressBar = document.getElementById('progressBar');

        const showSpinner = (show) => { aiSpinner.classList.toggle('hidden', !show); };
        const updateProgressBar = (p) => { if (progressBar) progressBar.style.width = `${p}%`; };

        const setInputEnabled = (enabled) => {
            textInput.disabled = !enabled;
            aiInputForm.querySelector('button[type="submit"]').disabled = !enabled;
            textInput.placeholder = enabled ? "Posez votre question ici..." : "Chargement des modèles IA...";
        };

        const preloadModels = async () => {
            setInputEnabled(false);
            progressContainer.classList.remove('hidden');
            updateProgressBar(10);
            aiResponseText.textContent = "Chargement des modèles IA...";
            try {
                if (typeof mobilenet !== 'undefined') {
                    await tf.setBackend('webgl');
                    models.image = await mobilenet.load({ version: 2, alpha: 1.0 });
                    updateProgressBar(100);
                }
                models.ready = true;
                aiResponseText.innerHTML = `<p data-translate="ai_welcome">${translations[currentLang].ai_welcome}</p>`;
                setInputEnabled(true);
            } catch (error) {
                console.error('Échec du chargement des modèles:', error);
                aiResponseText.textContent = "Erreur lors du chargement des modèles IA.";
            } finally {
                 setTimeout(() => progressContainer.classList.add('hidden'), 1000);
            }
        };

        const handleTextAnalysis = async (question) => {
            if (!question.trim()) return;
            showSpinner(true);
            aiResponseText.textContent = '';
            imagePreviewWrapper.classList.add('hidden');

            try {
                const response = await fetch('server/ai.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ prompt: question })
                });
                const data = await response.json();
                if (data && data.answer) {
                    aiResponseText.textContent = data.answer;
                } else {
                    aiResponseText.textContent = 'Aucune réponse reçue.';
                }
            } catch (error) {
                console.error('Erreur IA:', error);
                aiResponseText.textContent = "Une erreur est survenue lors de l'analyse.";
            } finally {
                showSpinner(false);
            }
        };

        const handleImageAnalysis = async (imageElement) => {
            if (!imageElement || !imageElement.src) return;
            if (!models.ready || !models.image) {
                 aiResponseText.textContent = "Le modèle IA image n'est pas encore prêt.";
                 return;
            }
            showSpinner(true);
            aiResponseText.textContent = "Analyse de l'image en cours...";

            try {
                const predictions = await models.image.classify(imageElement);
                if (predictions && predictions.length > 0) {
                     const mainObject = predictions[0].className.split(',')[0];
                     const generatedQuestion = `Quelles sont les causes des taches sur une feuille de ${mainObject} ?`;
                     textInput.value = generatedQuestion;
                     textInput.style.height = 'auto'; textInput.style.height = textInput.scrollHeight + 'px';
                     aiResponseText.innerHTML = `<p>J'ai identifié un(e) <strong>${mainObject}</strong>. J'ai préparé une question pour vous. Appuyez sur Envoyer pour obtenir une analyse.</p>`;
                } else {
                    aiResponseText.innerHTML = "<p>Aucun objet n'a pu être identifié. Essayez une autre photo.</p>";
                }
            } catch (error) {
                console.error('Erreur MobileNet:', error);
                aiResponseText.textContent = "Une erreur est survenue lors de l'analyse de l'image.";
            } finally {
                showSpinner(false);
            }
        };

        const displayImage = (src) => {
            imagePreviewWrapper.classList.remove('hidden');
            previewImg.src = src;
            previewImg.hidden = false;
            cam.hidden = true;
            captureBtn.classList.add('hidden');
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
                webcamBtn.classList.remove('active');
            }
            handleImageAnalysis(previewImg);
        };

        const toggleCam = async () => {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
                cam.hidden = true;
                captureBtn.classList.add('hidden');
                webcamBtn.classList.remove('active');
                aiResponseText.innerHTML = `<p data-translate="ai_welcome">${translations[currentLang].ai_welcome}</p>`;
                return;
            }
            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
                cam.srcObject = stream;
                await cam.play();
                imagePreviewWrapper.classList.remove('hidden');
                cam.hidden = false;
                previewImg.hidden = true;
                webcamBtn.classList.add('active');
                captureBtn.classList.remove('hidden');
                aiResponseText.innerHTML = `<p>Caméra active. Appuyez sur le bouton <i class="fas fa-camera"></i> pour capturer.</p>`;
            } catch (err) {
                console.error('Erreur caméra:', err);
                alert("Impossible d'accéder à la caméra.");
            }
        };

        const captureImageFromCam = () => {
            if (!stream) return;
            const canvas = document.createElement('canvas');
            canvas.width = cam.videoWidth;
            canvas.height = cam.videoHeight;
            canvas.getContext('2d').drawImage(cam, 0, 0);
            const imageUrl = canvas.toDataURL('image/jpeg');
            displayImage(imageUrl);
        };

        aiInputForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleTextAnalysis(textInput.value);
            textInput.value = '';
            textInput.style.height = '40px';
        });

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => displayImage(event.target.result);
                reader.readAsDataURL(file);
            }
        });

        if(webcamBtn) webcamBtn.addEventListener('click', toggleCam);
        if(captureBtn) captureBtn.addEventListener('click', captureImageFromCam);

        if(textInput) textInput.addEventListener('input', () => {
            textInput.style.height = 'auto';
            textInput.style.height = textInput.scrollHeight + 'px';
        });

        if (document.getElementById('ai-advisor')) {
            preloadModels();
        }
    }

    const skipLink = document.querySelector('.skip-link');
    const mainContent = document.getElementById('main-content');
    if (skipLink && mainContent) {
        skipLink.addEventListener('click', () => {
            requestAnimationFrame(() => {
                mainContent.focus();
            });
        });
    }

    // Fetch CSRF token for the session
    refreshCsrfToken().catch(() => {});
    csrfFetch('server/auth.php?action=check')
        .then(res => res.json())
        .then(data => {
            csrfToken = data.csrfToken;
            document.querySelectorAll('input[name="csrf_token"]').forEach(input => {
                input.value = csrfToken;
            });
        })
        .catch(() => {});

    // --- NOUVELLE LOGIQUE POUR LA PAGE 'ACCOUNT.HTML' ---
    if (document.getElementById('account')) {
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const authSection = document.getElementById('auth-section');
        const registerSection = document.getElementById('register-section');
        const loginMessage = document.getElementById('login-message');
        const registerMessage = document.getElementById('register-message');
        const addProductForm = document.getElementById('add-product-form');
        const productList = document.getElementById('product-list');
        const logoutBtn = document.getElementById('logout-btn');

        // Gère la soumission du formulaire d'inscription
        if (registerForm) registerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const lastName = document.getElementById('register-last-name').value.trim();
            const firstName = document.getElementById('register-first-name').value.trim();
            const email = document.getElementById('register-email').value.trim();
            const phone = document.getElementById('register-phone').value.trim();
            const region = document.getElementById('register-region').value.trim();
            const username = document.getElementById('register-username').value.trim();
            const password = document.getElementById('register-password').value;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                if (registerMessage) registerMessage.textContent = 'Email invalide.';
                return;
            }
            if (!/^\d{8,}$/.test(phone)) {
                if (registerMessage) registerMessage.textContent = 'Le numéro de téléphone doit contenir au moins 8 chiffres.';
                return;
            }

            csrfFetch('server/auth.php?action=register', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, password, last_name: lastName, first_name: firstName, email, phone, region })
            })
            .then(res => res.json())
            .then(data => {
                if (data.csrfToken) setCsrfToken(data.csrfToken);
                if (data.success) {
                    // Auto-login after registration then redirect to profile
                    csrfFetch('server/auth.php?action=login', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ username, password })
                    })
                    .then(res => res.json())
                    .then(loginData => {
                        if (loginData.csrfToken) setCsrfToken(loginData.csrfToken);
                        if (loginData.success) {
                            window.location.href = profileLink;
                        } else {
                            if (registerMessage) registerMessage.textContent = 'Compte créé, mais connexion impossible.';
                        }
                    });
                } else {
                    if (registerMessage) registerMessage.textContent = data.message || 'Erreur lors de la création du compte.';
                }
            })
            .catch(() => {
                if (registerMessage) registerMessage.textContent = 'Erreur réseau.';
            });
        });

        // Gère la soumission du formulaire de connexion
        if (loginForm) loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const username = document.getElementById('login-username').value;
            const password = document.getElementById('login-password').value;
            csrfFetch('server/auth.php?action=login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, password })
            })
            .then(res => res.json())
            .then(data => {
                if (data.csrfToken) setCsrfToken(data.csrfToken);
                if (data.success) {
                    window.location.href = profileLink;
                } else {
                    if (loginMessage) loginMessage.textContent = data.message || "Nom d'utilisateur ou mot de passe incorrect.";
                }
            })
            .catch(() => {
                if (loginMessage) loginMessage.textContent = 'Erreur réseau.';
            });
        });

        csrfFetch('server/auth.php?action=check', { method: 'GET' })
            .then(res => res.json())
            .then(data => {
                setCsrfToken(data.csrfToken);
                if (data.loggedIn) {
                    window.location.href = profileLink;
                } else {
                    if (authSection) authSection.classList.remove('hidden');
                    if (registerSection) registerSection.classList.remove('hidden');
                }
            });

        // Gère la soumission du formulaire d'ajout de produit
        if (addProductForm) addProductForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const data = {
                name: document.getElementById('product-name').value,
                quantity: parseInt(document.getElementById('product-quantity').value) || 0,
                phone: document.getElementById('product-phone').value,
                ph: parseFloat(document.getElementById('product-ph').value) || null,
                rain: parseFloat(document.getElementById('product-rain').value) || null,
                humidity: parseFloat(document.getElementById('product-humidity').value) || null,
                soil_humidity: parseFloat(document.getElementById('product-soil_humidity').value) || null,
                light: parseFloat(document.getElementById('product-light').value) || null,
                valve_open: document.getElementById('product-valve_open').checked ? 1 : 0,
                valve_angle: parseInt(document.getElementById('product-valve_angle').value) || 0
            };
            csrfFetch('server/products.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(() => {
                displayProducts();
                addProductForm.reset();
            });
        });

        // Gère la déconnexion
        if (logoutBtn) logoutBtn.addEventListener('click', () => {
            csrfFetch('server/auth.php?action=logout', { method: 'POST' })
                .then(() => { window.location.href = accountLink; });
        });

        // Affiche la liste des produits de l'utilisateur
        const displayProducts = () => {
            if (!productList) return;
            csrfFetch('server/products.php')
                .then(res => res.json())
                .then(products => {
                    productList.innerHTML = '';
                    if (Array.isArray(products) && products.length > 0) {
                        products.forEach(prod => {
                            const tr = document.createElement('tr');
                            const fields = ['name','quantity','ph','rain','humidity','soil_humidity','light'];
                            fields.forEach(f => {
                                const td = document.createElement('td');
                                td.className = 'px-2';
                                td.textContent = prod[f] ?? '';
                                tr.appendChild(td);
                            });

                            const valveTd = document.createElement('td');
                            valveTd.className = 'px-2';
                            const valveBtn = document.createElement('button');
                            valveBtn.className = 'button button--glass';
                            valveBtn.textContent = prod.valve_open == 1 ? 'Fermer' : 'Ouvrir';
                            valveBtn.addEventListener('click', () => {
                                csrfFetch(`server/products.php?id=${prod.id}`, {
                                    method: 'PUT',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ valve_open: prod.valve_open == 1 ? 0 : 1 })
                                }).then(displayProducts);
                            });
                            valveTd.appendChild(valveBtn);
                            tr.appendChild(valveTd);

                            const angleTd = document.createElement('td');
                            angleTd.className = 'px-2';
                            const angleInput = document.createElement('input');
                            angleInput.type = 'number';
                            angleInput.value = prod.valve_angle;
                            angleInput.className = 'form-input w-20';
                            angleInput.addEventListener('change', () => {
                                csrfFetch(`server/products.php?id=${prod.id}`, {
                                    method: 'PUT',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ valve_angle: parseInt(angleInput.value) || 0 })
                                }).then(displayProducts);
                            });
                            angleTd.appendChild(angleInput);
                            tr.appendChild(angleTd);

                            productList.appendChild(tr);
                        });
                    } else {
                        const tr = document.createElement('tr');
                        const td = document.createElement('td');
                        td.colSpan = 9;
                        td.textContent = 'Aucun produit ajouté.';
                        tr.appendChild(td);
                        productList.appendChild(tr);
                    }
                });
        };

        displayProducts();
    }


    // --- LOGIQUE POUR LA PAGE 'PROFILE.PHP' ---
    if (document.getElementById('profile')) {
        const profileForm = document.getElementById('profile-form');
        const lastNameInput = document.getElementById('profile-last-name');
        const firstNameInput = document.getElementById('profile-first-name');
        const emailInput = document.getElementById('profile-email');
        const phoneInput = document.getElementById('profile-phone');
        const regionInput = document.getElementById('profile-region');
        const profileMessage = document.getElementById('profile-message');
        const dashboardProductList = document.getElementById('dashboard-product-list');
        const refreshProductsBtn = document.getElementById('refresh-products');
        const metricActiveModules = document.getElementById('metric-active-modules');
        const metricAvgHumidity = document.getElementById('metric-avg-humidity');
        const metricOpenValves = document.getElementById('metric-open-valves');
        const dashboardLogoutBtn = document.getElementById('logout-btn');

        const loadProfile = () => {
            csrfFetch('server/user.php')
                .then(res => {
                    if (!res.ok) throw new Error('Unauthorized');
                    return res.json();
                })
                .then(data => {
                    lastNameInput.value = data.last_name || '';
                    firstNameInput.value = data.first_name || '';
                    emailInput.value = data.email || '';
                    phoneInput.value = data.phone || '';
                    regionInput.value = data.region || '';
                })
                .catch(() => {
                    window.location.href = accountLink;
                });
        };
        const loadDashboardProducts = () => {
            if (!dashboardProductList) return;
            csrfFetch('server/products.php')
                .then(res => res.json())
                .then(products => {
                    dashboardProductList.innerHTML = '';
                    const list = Array.isArray(products) ? products : [];

                    if (metricActiveModules) metricActiveModules.textContent = list.length.toString();
                    if (metricAvgHumidity) {
                        const humidityValues = list
                            .map(p => parseFloat(p.humidity))
                            .filter(value => !Number.isNaN(value));
                        const average = humidityValues.length
                            ? humidityValues.reduce((acc, value) => acc + value, 0) / humidityValues.length
                            : 0;
                        metricAvgHumidity.textContent = `${average.toFixed(1)}%`;
                    }
                    if (metricOpenValves) {
                        metricOpenValves.textContent = list.filter(p => Number(p.valve_open) === 1).length.toString();
                    }

                    if (!list.length) {
                        const emptyRow = document.createElement('tr');
                        const emptyCell = document.createElement('td');
                        emptyCell.colSpan = 10;
                        emptyCell.textContent = 'Aucun module IoT configuré pour le moment.';
                        emptyRow.appendChild(emptyCell);
                        dashboardProductList.appendChild(emptyRow);
                        return;
                    }

                    list.forEach(prod => {
                        const tr = document.createElement('tr');
                        const fields = ['name','quantity','ph','rain','humidity','soil_humidity','light'];
                        fields.forEach(field => {
                            const td = document.createElement('td');
                            td.className = 'px-2 py-2';
                            td.textContent = prod[field] ?? '';
                            tr.appendChild(td);
                        });

                        const valveTd = document.createElement('td');
                        valveTd.className = 'px-2 py-2';
                        const valveBtn = document.createElement('button');
                        valveBtn.className = 'button button--glass text-sm';
                        valveBtn.textContent = Number(prod.valve_open) === 1 ? 'Fermer' : 'Ouvrir';
                        valveBtn.addEventListener('click', () => {
                            csrfFetch(`server/products.php?id=${prod.id}`, {
                                method: 'PUT',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ valve_open: Number(prod.valve_open) === 1 ? 0 : 1 })
                            }).then(loadDashboardProducts);
                        });
                        valveTd.appendChild(valveBtn);
                        tr.appendChild(valveTd);

                        const angleTd = document.createElement('td');
                        angleTd.className = 'px-2 py-2';
                        const angleInput = document.createElement('input');
                        angleInput.type = 'number';
                        angleInput.value = prod.valve_angle ?? 0;
                        angleInput.className = 'form-input w-20';
                        angleInput.addEventListener('change', () => {
                            csrfFetch(`server/products.php?id=${prod.id}`, {
                                method: 'PUT',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ valve_angle: parseInt(angleInput.value, 10) || 0 })
                            }).then(loadDashboardProducts);
                        });
                        angleTd.appendChild(angleInput);
                        tr.appendChild(angleTd);

                        const actionTd = document.createElement('td');
                        actionTd.className = 'px-2 py-2';
                        const deleteBtn = document.createElement('button');
                        deleteBtn.className = 'button button--glass text-sm';
                        deleteBtn.textContent = 'Supprimer';
                        deleteBtn.addEventListener('click', () => {
                            if (!confirm('Supprimer ce module ?')) return;
                            csrfFetch(`server/products.php?id=${prod.id}`, {
                                method: 'DELETE'
                            }).then(loadDashboardProducts);
                        });
                        actionTd.appendChild(deleteBtn);
                        tr.appendChild(actionTd);

                        dashboardProductList.appendChild(tr);
                    });
                });
        };

        loadProfile();
        loadDashboardProducts();

        if (refreshProductsBtn) {
            refreshProductsBtn.addEventListener('click', (event) => {
                event.preventDefault();
                loadDashboardProducts();
            });
        }

        if (dashboardLogoutBtn) {
            dashboardLogoutBtn.addEventListener('click', () => {
                csrfFetch('server/auth.php?action=logout', { method: 'POST' })
                    .then(() => { window.location.href = accountLink; });
            });
        }

        profileForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const payload = {
                last_name: lastNameInput.value.trim(),
                first_name: firstNameInput.value.trim(),
                email: emailInput.value.trim(),
                phone: phoneInput.value.trim(),
                region: regionInput.value.trim()
            };
            csrfFetch('server/user.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    profileMessage.textContent = 'Profil mis à jour';
                    profileMessage.classList.remove('text-red-500');
                    profileMessage.classList.add('text-green-500');
                } else {
                    profileMessage.textContent = data.message || 'Erreur lors de la mise à jour.';
                    profileMessage.classList.remove('text-green-500');
                    profileMessage.classList.add('text-red-500');
                }
            })
            .catch(() => {
                profileMessage.textContent = 'Erreur réseau.';
                profileMessage.classList.remove('text-green-500');
                profileMessage.classList.add('text-red-500');
            });
        });
    }

    if (document.getElementById('admin-dashboard')) {
        const statUsers = document.getElementById('stat-total-users');
        const statProducts = document.getElementById('stat-total-products');
        const statOpenValves = document.getElementById('stat-open-valves');
        const userList = document.getElementById('admin-user-list');
        const productList = document.getElementById('admin-product-list');
        const refreshUsersBtn = document.getElementById('refresh-users');
        const refreshProductsBtn = document.getElementById('refresh-admin-products');

        const renderUsers = (users = []) => {
            if (!userList) return;
            userList.innerHTML = '';
            if (!users.length) {
                const emptyRow = document.createElement('tr');
                const emptyCell = document.createElement('td');
                emptyCell.colSpan = 5;
                emptyCell.textContent = 'Aucun utilisateur enregistré.';
                emptyRow.appendChild(emptyCell);
                userList.appendChild(emptyRow);
                return;
            }
            users.forEach(user => {
                const tr = document.createElement('tr');
                ['last_name','first_name','email','region','role'].forEach(key => {
                    const td = document.createElement('td');
                    td.className = 'px-2 py-2';
                    td.textContent = user[key] ?? '';
                    tr.appendChild(td);
                });
                userList.appendChild(tr);
            });
        };

        const renderAdminProducts = (products = []) => {
            if (!productList) return;
            productList.innerHTML = '';
            if (!products.length) {
                const emptyRow = document.createElement('tr');
                const emptyCell = document.createElement('td');
                emptyCell.colSpan = 5;
                emptyCell.textContent = 'Aucun module enregistré.';
                emptyRow.appendChild(emptyCell);
                productList.appendChild(emptyRow);
                return;
            }
            products.forEach(prod => {
                const tr = document.createElement('tr');
                const values = [prod.username, prod.name, prod.quantity, prod.humidity ?? '-', Number(prod.valve_open) === 1 ? 'Ouverte' : 'Fermée'];
                values.forEach(value => {
                    const td = document.createElement('td');
                    td.className = 'px-2 py-2';
                    td.textContent = value ?? '';
                    tr.appendChild(td);
                });
                productList.appendChild(tr);
            });
        };

        const fetchStats = () => {
            csrfFetch('server/admin.php?action=stats')
                .then(res => res.json())
                .then(response => {
                    if (!response.success) return;
                    const data = response.data || {};
                    if (statUsers) statUsers.textContent = (data.users ?? 0).toString();
                    if (statProducts) statProducts.textContent = (data.products ?? 0).toString();
                    if (statOpenValves) statOpenValves.textContent = (data.openValves ?? 0).toString();
                });
        };

        const fetchUsers = () => {
            csrfFetch('server/admin.php?action=users')
                .then(res => res.json())
                .then(response => {
                    if (!response.success) return;
                    renderUsers(response.data || []);
                });
        };

        const fetchProducts = () => {
            csrfFetch('server/admin.php?action=products')
                .then(res => res.json())
                .then(response => {
                    if (!response.success) return;
                    renderAdminProducts(response.data || []);
                });
        };

        if (refreshUsersBtn) refreshUsersBtn.addEventListener('click', () => fetchUsers());
        if (refreshProductsBtn) refreshProductsBtn.addEventListener('click', () => fetchProducts());

        fetchStats();
        fetchUsers();
        fetchProducts();
    }

    // Gère la soumission du formulaire de contact
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        const contactFeedback = document.getElementById('contact-form-feedback');
        const submitButton = contactForm.querySelector('button[type="submit"]');
        const submitLabel = submitButton ? submitButton.querySelector('[data-translate="contact_send_label"]') : null;
        const translate = (key, fallback) => (translations[currentLang] && translations[currentLang][key]) || fallback;
        const setContactFeedback = (message, variant = 'neutral') => {
            if (!contactFeedback) return;
            contactFeedback.classList.remove('text-red-500', 'text-brand-green-400', 'text-text-300');
            let toneClass = 'text-text-300';
            if (variant === 'success') toneClass = 'text-brand-green-400';
            if (variant === 'error') toneClass = 'text-red-500';
            contactFeedback.classList.add(toneClass);
            contactFeedback.textContent = message;
        };
        const setSubmitting = (isSubmitting) => {
            if (!submitButton) return;
            submitButton.disabled = isSubmitting;
            submitButton.setAttribute('aria-busy', String(isSubmitting));
            if (submitLabel) {
                submitLabel.textContent = translate(isSubmitting ? 'contact_sending' : 'contact_send_label', isSubmitting ? 'Envoi du message…' : 'Envoyer le message');
            }
        };

        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(contactForm);
            setContactFeedback('');

            const name = (formData.get('name') || '').toString().trim();
            const email = (formData.get('email') || '').toString().trim();
            const phone = (formData.get('phone') || '').toString().trim();
            const message = (formData.get('message') || '').toString().trim();
            const honeypot = (formData.get('company') || '').toString().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phoneRegex = /^\+?[0-9\s.-]{6,25}$/;

            if (name.length < 2 || name.length > 120) {
                setContactFeedback(translate('contact_validation_name', 'Veuillez saisir un nom valide (2 à 120 caractères).'), 'error');
                return;
            }
            if (!emailRegex.test(email)) {
                setContactFeedback(translate('contact_validation_email', 'Veuillez saisir une adresse email valide.'), 'error');
                return;
            }
            if (phone && !phoneRegex.test(phone)) {
                setContactFeedback(translate('contact_validation_phone', 'Le numéro de téléphone est invalide.'), 'error');
                return;
            }
            if (message.length < 20 || message.length > 2000) {
                setContactFeedback(translate('contact_validation_message', 'Votre message doit contenir au moins 20 caractères.'), 'error');
                return;
            }

            if (honeypot) {
                contactForm.reset();
                setContactFeedback(translate('contact_success_message', 'Votre message a été envoyé avec succès.'), 'success');
                return;
            }

            setSubmitting(true);
            csrfFetch('server/contact.php', {
                method: 'POST',
                body: formData
            })
                .then(async (res) => {
                    if (res.status === 204) {
                        return { success: true, message: translate('contact_success_message', 'Votre message a été envoyé avec succès.') };
                    }
                    const data = await res.json();
                    return data;
                })
                .then((data) => {
                    const messageText = data && data.message ? data.message : translate(data && data.success ? 'contact_success_message' : 'contact_error_message', data && data.success ? 'Votre message a été envoyé avec succès.' : "Impossible d'envoyer le message.");
                    setContactFeedback(messageText, data && data.success ? 'success' : 'error');
                    if (data && data.success) {
                        contactForm.reset();
                    }
                })
                .catch(() => {
                    setContactFeedback(translate('contact_network_error', 'Une erreur réseau est survenue. Veuillez réessayer.'), 'error');
                })
                .finally(() => {
                    setSubmitting(false);
                });
        });
    }

    try {
        AOS.init({ duration: 800, once: true, offset: 50 });
    } catch (e) {
        console.error('AOS init failed', e);
    }
});

