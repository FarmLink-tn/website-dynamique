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
    <main id="main-content" class="py-20" role="main" tabindex="-1">
        <section id="about" class="container mx-auto px-6">
            <h2 class="section-title" data-translate="about_main_title">L'Agriculture de Demain, Une Récolte à la Fois.</h2>
            <div class="grid md:grid-cols-2 gap-16 items-center mt-20">
                <div>
                    <img src="image/about_us_im2.jpg" alt="Ferme intelligente équipée de capteurs IoT" class="rounded-lg shadow-2xl w-full" width="1024" height="640" loading="lazy" decoding="async">
                </div>
                <figure class="hero__visual" aria-hidden="true">
                    <img src="image/about_us_im1.png" alt="Équipe FarmLink sur le terrain" loading="lazy" width="960" height="640">
                </figure>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <header class="section__header">
                    <p class="eyebrow"><?= htmlspecialchars($mission['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                    <h2 class="section__title"><?= htmlspecialchars($mission['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                </header>
                <div class="grid grid--three">
                    <?php foreach ($mission['items'] ?? [] as $item): ?>
                        <article class="card">
                            <h3><?= htmlspecialchars($item['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?= htmlspecialchars($item['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <header class="section__header">
                    <h2 class="section__title"><?= htmlspecialchars($timeline['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                </header>
                <div class="timeline">
                    <?php foreach ($timeline['items'] ?? [] as $event): ?>
                        <article class="timeline__item">
                            <h3><?= htmlspecialchars($event['year'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?= htmlspecialchars($event['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <header class="section__header">
                    <h2 class="section__title"><?= htmlspecialchars($team['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                </header>
                <div class="team-grid">
                    <?php foreach ($team['members'] ?? [] as $member): ?>
                        <article class="team-card">
                            <h3><?= htmlspecialchars($member['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?= htmlspecialchars($member['role'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <header class="section__header">
                    <h2 class="section__title"><?= htmlspecialchars($values['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                </header>
                <div class="grid grid--three">
                    <?php foreach ($values['items'] ?? [] as $value): ?>
                        <article class="card">
                            <h3><?= htmlspecialchars($value['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?= htmlspecialchars($value['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
