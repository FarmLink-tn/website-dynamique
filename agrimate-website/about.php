<?php
require __DIR__ . '/includes/bootstrap.php';

$pageLang = current_language();
$hero = trans('about.hero', $pageLang);
$mission = trans('about.mission', $pageLang);
$timeline = trans('about.timeline', $pageLang);
$team = trans('about.team', $pageLang);
$values = trans('about.values', $pageLang);

$pageTitle = 'FarmLink - ' . ($hero['title'] ?? 'À propos');
$metaDescription = $hero['description'] ?? trans('meta.description', $pageLang);
$canonicalPath = '/about.php';
$activeNav = 'about';

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main">
        <section class="hero">
            <div class="container hero__layout">
                <div class="hero__content">
                    <p class="eyebrow"><?= htmlspecialchars($hero['eyebrow'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                    <h1 class="hero__title"><?= htmlspecialchars($hero['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h1>
                    <p class="hero__description"><?= htmlspecialchars($hero['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
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
