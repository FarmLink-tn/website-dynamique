<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink - Comment ça marche';
$metaDescription = 'Comprenez étape par étape comment FarmLink installe ses solutions retrofit, connecte vos équipements agricoles au cloud et optimise vos décisions.';
$metaKeywords = 'FarmLink, fonctionnement, retrofit agricole, IoT, contrôle agricole';
$canonicalPath = '/how-it-works.php';
$activeNav = 'how';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" tabindex="-1">
        <section id="how-it-works" class="py-20">
             <div class="container mx-auto px-6 text-center">
                <h2 class="section-title" data-translate="how_it_works_title">Comment ça marche ?</h2>
                <ol class="how-it-works-steps grid md:grid-cols-3 gap-12 mt-12" role="list">
                    <li class="how-it-works-card" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-xl font-bold my-4" data-translate="step1_title">Installation "Retrofit"</h3>
                        <p data-translate="step1_desc">Nous installons nos modules sur votre équipement existant, sans remplacement coûteux.</p>
                    </li>
                    <li class="how-it-works-card" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-xl font-bold my-4" data-translate="step2_title">Connexion au Cloud</h3>
                        <p data-translate="step2_desc">Les capteurs envoient les données en temps réel à notre plateforme sécurisée.</p>
                    </li>
                    <li class="how-it-works-card" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="text-xl font-bold my-4" data-translate="step3_title">Contrôle & Optimisation</h3>
                        <p data-translate="step3_desc">Vous gérez tout depuis le panneau de contrôle et recevez des recommandations de l'IA.</p>
                    </li>
                </ol>
             </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
