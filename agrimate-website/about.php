<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink - À propos';
$metaDescription = "Découvrez la mission de FarmLink : rendre l'agriculture intelligente accessible grâce au retrofit, à l'IoT et à l'IA pour les exploitations tunisiennes.";
$metaKeywords = 'FarmLink, à propos, mission, retrofit agricole, innovation agricole Tunisie';
$canonicalPath = '/about.php';
$activeNav = 'about';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" class="py-20" role="main" tabindex="-1">
        <section id="about" class="container mx-auto px-6">
            <h2 class="section-title" data-translate="about_main_title">L'Agriculture de Demain, Une Récolte à la Fois.</h2>
            <div class="grid md:grid-cols-2 gap-16 items-center mt-20">
                <div>
                    <img src="image/about_us_im2.jpg" alt="Ferme intelligente équipée de capteurs IoT" class="rounded-lg shadow-2xl w-full" width="1024" height="640" loading="lazy" decoding="async">
                </div>
                <div class="text-left">
                    <h3 class="text-2xl font-bold text-brand-blue-500 mb-4" data-translate="about_vision_title">Notre Vision : Un futur où chaque ferme est intelligente.</h3>
                    <p class="text-lg text-text-300" data-translate="about_intro_text">Chez FarmLink, nous voyons l'agriculture non pas comme une industrie du passé, mais comme la technologie la plus essentielle de l'avenir. Nous croyons que la sagesse des pratiques traditionnelles et la puissance des innovations de pointe peuvent coexister pour créer quelque chose de véritablement révolutionnaire. Notre mission est de démocratiser l'agriculture intelligente.</p>
                    <h4 class="text-xl font-bold text-brand-green-400 mt-6 mb-2" data-translate="about_commitment_title">Notre Engagement : Affronter les défis mondiaux avec l'innovation "retrofit".</h4>
                    <p class="text-lg text-text-300" data-translate="about_commitment_text">Dans un monde où les ressources sont limitées et les défis climatiques s'intensifient, la mission de FarmLink est plus vitale que jamais.</p>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
