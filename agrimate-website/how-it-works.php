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
    <main id="main-content" role="main" tabindex="-1">
        <section id="how-it-works" class="py-20">
             <div class="container mx-auto px-6 text-center">
                <h2 class="section-title" data-translate="how_it_works_title">Comment ça marche ?</h2>
                <?php
                $steps = [
                    [
                        'title_key' => 'step1_title',
                        'title' => 'Installation "Retrofit"',
                        'desc_key' => 'step1_desc',
                        'desc' => 'Nous installons nos modules sur votre équipement existant, sans remplacement coûteux.',
                    ],
                    [
                        'title_key' => 'step2_title',
                        'title' => 'Connexion au Cloud',
                        'desc_key' => 'step2_desc',
                        'desc' => 'Les capteurs envoient les données en temps réel à notre plateforme sécurisée.',
                    ],
                    [
                        'title_key' => 'step3_title',
                        'title' => 'Contrôle & Optimisation',
                        'desc_key' => 'step3_desc',
                        'desc' => "Vous gérez tout depuis le panneau de contrôle et recevez des recommandations de l'IA.",
                    ],
                ];
                ?>
                <ol class="how-it-works-list grid md:grid-cols-3 gap-12 mt-12" role="list">
                    <?php foreach ($steps as $index => $step): ?>
                        <?php $stepNumber = $index + 1; ?>
                        <li class="how-it-works-card" data-aos="fade-up" data-aos-delay="<?= 100 * $stepNumber; ?>">
                            <div class="card-step-wrapper" aria-hidden="true">
                                <span class="card-step"><?= $stepNumber; ?></span>
                            </div>
                            <h3 class="text-xl font-bold my-4" data-translate="<?= htmlspecialchars($step['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($step['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p data-translate="<?= htmlspecialchars($step['desc_key'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($step['desc'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ol>
             </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
