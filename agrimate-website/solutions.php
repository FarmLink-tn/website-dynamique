<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink - Nos Solutions';
$metaDescription = "Explorez les solutions modulaires de FarmLink : irrigation intelligente, contrôle des pompes et surveillance environnementale pour booster vos rendements.";
$metaKeywords = 'FarmLink solutions, irrigation intelligente, contrôle pompe, capteurs agricoles';
$canonicalPath = '/solutions.php';
$activeNav = 'solutions';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main>
        <section id="solutions" class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="section-title" data-translate="solutions_title">Nos Solutions Modulaires</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="solution-card" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-2xl font-bold mb-4" data-translate="solution_irrigation_title">Irrigation Intelligente</h3>
                        <p data-translate="solution_irrigation_desc">Optimisez votre consommation d'eau avec des vannes intelligentes et une planification automatisée.</p>
                    </div>
                    <div class="solution-card" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-2xl font-bold mb-4" data-translate="solution_pump_title">Contrôle des Pompes</h3>
                        <p data-translate="solution_pump_desc">Gérez vos pompes à distance et surveillez le débit et la pression en temps réel.</p>
                    </div>
                    <div class="solution-card" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="text-2xl font-bold mb-4" data-translate="solution_env_title">Surveillance Environnementale</h3>
                        <p data-translate="solution_env_desc">Prenez des décisions éclairées grâce aux données des capteurs de température, d'humidité et de sol.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
