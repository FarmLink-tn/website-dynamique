<?php
require __DIR__ . '/includes/bootstrap.php';

$pageLang = current_language();
$hero = trans('how.hero', $pageLang);
$phases = trans('how.phases', $pageLang);
$cta = trans('how.cta', $pageLang);
$deliverablesLabel = trans('how.deliverables_label', $pageLang);

$pageTitle = 'FarmLink - ' . ($hero['title'] ?? 'Méthodologie');
$metaDescription = $hero['description'] ?? trans('meta.description', $pageLang);
$canonicalPath = '/how-it-works.php';
$activeNav = 'how';

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
                    <img src="image/about_us_im2.jpg" alt="Technicien FarmLink installant un capteur" loading="lazy" width="960" height="640">
                </figure>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="workflow">
                    <?php foreach ($phases ?? [] as $phase): ?>
                        <article class="workflow__step">
                            <h3><?= htmlspecialchars($phase['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?= htmlspecialchars($phase['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <h4><?= htmlspecialchars($deliverablesLabel, ENT_QUOTES, 'UTF-8'); ?></h4>
                            <ul class="list">
                                <?php foreach ($phase['deliverables'] ?? [] as $deliverable): ?>
                                    <li><?= htmlspecialchars($deliverable, ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="cta-block">
                    <h2><?= htmlspecialchars($cta['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                    <p><?= htmlspecialchars($cta['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                    <a class="button button--primary" href="contact.php"><?= htmlspecialchars($cta['button'] ?? '', ENT_QUOTES, 'UTF-8'); ?></a>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
