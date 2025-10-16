<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink - Accueil';
$metaDescription = "FarmLink modernise l'agriculture tunisienne avec des solutions IoT, IA et retrofit accessibles pour optimiser l'irrigation et les rendements.";
$metaKeywords = 'FarmLink, agriculture intelligente, IoT agricole, conseiller IA, irrigation connectée, Tunisie';
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

        <section class="summary-section py-24" data-aos="fade-up">
            <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
                <div class="summary-image">
                    <img src="image/about_us_im1.png" alt="Notre vision pour l'agriculture" class="rounded-lg shadow-2xl" width="2816" height="1536" loading="lazy" decoding="async">
                </div>
                <div class="summary-text text-left">
                    <h2 class="section-title" data-translate="summary_about_title">Notre Vision : Un Futur Intelligent</h2>
                    <p class="summary-desc" data-translate="summary_about_desc">Nous démocratisons l'agriculture intelligente. Découvrez comment notre engagement envers l'innovation "retrofit" relève les défis mondiaux et crée un avenir durable pour tous.</p>
                    <a href="about.php" class="button button--glass" data-translate="learn_more_about_us">En savoir plus sur nous</a>
                </div>
            </div>
        </section>

        <section class="summary-section bg-bg-850 py-24" data-aos="fade-up">
            <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
                <div class="summary-text text-left">
                    <h2 class="section-title" data-translate="summary_solutions_title">Solutions Modulaires Puissantes</h2>
                    <p class="summary-desc" data-translate="summary_solutions_desc">Irrigation intelligente, contrôle des pompes, surveillance environnementale. Explorez nos solutions conçues pour optimiser vos ressources et maximiser vos rendements.</p>
                    <a href="solutions.php" class="button button--glass" data-translate="explore_solutions">Explorer nos solutions</a>
                </div>
                <div class="summary-image">
                    <img src="image/background_im1.png" alt="Processus de modernisation" class="rounded-lg shadow-2xl" width="1024" height="610" loading="lazy" decoding="async">
                </div>
            </div>
        </section>

        <section class="summary-section py-24" data-aos="fade-up">
            <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
                 <div class="summary-text text-left md:order-2">
                    <h2 class="section-title" data-translate="summary_ai_advisor_title">Votre Agronome Personnel</h2>
                    <p class="summary-desc" data-translate="summary_ai_advisor_desc">Un problème avec vos cultures ? Décrivez-le à notre Conseiller IA et recevez une analyse et des recommandations instantanées pour protéger votre récolte.</p>
                    <a href="ai-advisor.php" class="button button--glass" data-translate="try_ai_advisor">Essayer le conseiller IA</a>
                </div>
                <div class="summary-image md:order-1">
                    <img src="image/about_us_im2.jpg" alt="Conseiller agricole IA" class="rounded-lg shadow-2xl" width="1024" height="640" loading="lazy" decoding="async">
                </div>
            </div>
        </section>

        <section class="summary-section bg-bg-850 py-24" data-aos="fade-up">
            <div class="container mx-auto px-6 text-center">
                <h2 class="section-title" data-translate="summary_contact_title">Prêt à moderniser votre ferme ?</h2>
                <p class="summary-desc max-w-2xl mx-auto" data-translate="summary_contact_desc">Discutons de vos besoins. Contactez-nous dès aujourd'hui pour obtenir un devis personnalisé et découvrir comment FarmLink peut transformer votre exploitation.</p>
                <a href="contact.php" class="button" data-translate="contact_us_button">Contactez-nous</a>
            </div>
        </section>

        <section class="bg-bg-950 text-white" data-aos="fade-up">
            <div class="container mx-auto px-6 text-center py-20">
                <h2 class="section-title" data-translate="testimonials_title">Ce que disent nos agriculteurs</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                    <div class="testimonial-card">
                        <img src="image/Karim A.png" alt="Photo de Karim A." class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-border-soft" width="512" height="512" loading="lazy" decoding="async">
                        <p class="text-lg italic mt-4" data-translate="testimonial_1_text">"FarmLink a transformé ma gestion de l'eau. J'économise du temps et de l'argent, et mes rendements n'ont jamais été aussi bons."</p>
                        <div class="mt-4">
                            <p class="font-bold" data-translate="testimonial_1_name">Karim A.</p>
                            <p class="text-sm text-text-500" data-translate="testimonial_1_location">Agriculteur, Sidi Bouzid</p>
                        </div>
                    </div>
                    <div class="testimonial-card">
                        <img src="image/fatma.png" alt="Photo de Fatma M." class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-border-soft" width="2048" height="2048" loading="lazy" decoding="async">
                        <p class="text-lg italic mt-4" data-translate="testimonial_2_text">"L'installation a été incroyablement simple sur mon équipement existant. Le panneau de contrôle est très intuitif."</p>
                        <div class="mt-4">
                            <p class="font-bold" data-translate="testimonial_2_name">Fatma M.</p>
                            <p class="text-sm text-text-500" data-translate="testimonial_2_location">Exploitante d'oliveraie, Sfax</p>
                        </div>
                    </div>
                    <div class="testimonial-card">
                        <img src="image/yousef.png" alt="Photo de Youssef B." class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-border-soft" width="1905" height="1909" loading="lazy" decoding="async">
                        <p class="text-lg italic mt-4" data-translate="testimonial_3_text">"Le conseiller IA est un véritable plus. Il m'a aidé à identifier un problème de ravageurs avant qu'il ne se propage. C'est l'avenir !"</p>
                        <div class="mt-4">
                            <p class="font-bold" data-translate="testimonial_3_name">Youssef B.</p>
                            <p class="text-sm text-text-500" data-translate="testimonial_3_location">Serriste, Kairouan</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
