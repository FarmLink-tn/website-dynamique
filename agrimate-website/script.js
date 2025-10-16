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
    AOS.init();
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
            hero_title: "Du traditionnel au smart - connectez votre ferme à l'avenir.",
            hero_subtitle: "Solutions de modernisation abordables pour une agriculture plus efficace.",
            hero_button: "Découvrir nos solutions",
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
            about_main_title: "L'Agriculture de Demain, Une Récolte à la Fois.",
            about_vision_title: "Notre Vision : Un futur où chaque ferme est intelligente.",
            about_intro_text: "Chez FarmLink, nous voyons l'agriculture non pas comme une industrie du passé, mais comme la technologie la plus essentielle de l'avenir. Notre mission est de démocratiser l'agriculture intelligente.",
            about_commitment_title: "Notre Engagement : Affronter les défis mondiaux avec l'innovation \"retrofit\".",
            about_commitment_text: "Dans un monde où les ressources sont limitées et les défis climatiques s'intensifient, la mission de FarmLink est plus vitale que jamais.",
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
            hero_title: "From traditional to smart – connect your farm to the future.",
            hero_subtitle: "Affordable retrofit solutions for more efficient farming.",
            hero_button: "Discover our solutions",
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
            about_main_title: "The Future of Farming, One Harvest at a Time.",
            about_vision_title: "Our Vision: A future where every farm is smart.",
            about_intro_text: "At FarmLink, we see agriculture not as an industry of the past, but as the most essential technology of the future. Our mission is to democratize smart farming.",
            about_commitment_title: "Our Commitment: Tackling global challenges with 'retrofit' innovation.",
            about_commitment_text: "In a world of limited resources and intensifying climate challenges, FarmLink's mission is more vital than ever.",
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
            hero_title: "من الزراعة التقليدية إلى الذكية – اربط مزرعتك بالمستقبل.",
            hero_subtitle: "حلول تحديث بأسعار معقولة لزراعة أكثر كفاءة.",
            hero_button: "اكتشف حلولنا",
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
            about_main_title: "زراعة الغد، حصادًا بعد حصاد.",
            about_vision_title: "رؤيتنا: مستقبل تكون فيه كل مزرعة ذكية.",
            about_intro_text: "في FarmLink، مهمتنا هي جعل الزراعة الذكية في متناول الجميع.",
            about_commitment_title: "التزامنا: مواجهة التحديات العالمية بابتكار \"التحديث\".",
            about_commitment_text: "في عالم تتزايد فيه ندرة الموارد وتتفاقم التحديات المناخية، أصبحت مهمة FarmLink أكثر أهمية من أي وقت مضى.",
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
            context_agricole: `
                ### الموضوع: الزراعة في تونس ###
                تواجه الزراعة في تونس تحديات مثل الجفاف وملوحة التربة. المحاصيل الرئيسية تشمل الزيتون والحبوب والتمور والحمضيات. الإدارة الجيدة للمياه أمر بالغ الأهمية.
            `,
        }
    };
    

    // --- SÉLECTEURS D'ÉLÉMENTS ---
    const defaultLang = 'fr';
    const htmlElement = document.documentElement;
    const body = document.body;
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
    let currentLang = savedLang || body.dataset.currentLang || defaultLang;

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

    if (!translations[currentLang]) {
        currentLang = defaultLang;
    }

    const savedTheme = localStorage.getItem('theme') || 'dark';
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
        localStorage.setItem('language', newLang);
        applyLanguage(newLang);
        const url = new URL(window.location.href);
        url.searchParams.set('lang', newLang);
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

