<?php
require __DIR__ . '/includes/bootstrap.php';

$pageLang = current_language();
$hero = trans('home.hero', $pageLang);
$metrics = trans('home.metrics', $pageLang);
$pillars = trans('home.pillars', $pageLang);
$solutions = trans('home.solutions', $pageLang);
$workflow = trans('home.workflow', $pageLang);
$testimonials = trans('home.testimonials', $pageLang);
$cta = trans('home.cta', $pageLang);

$pageTitle = 'FarmLink Tunisie - ' . ($hero['title'] ?? 'Agriculture intelligente');
$metaDescription = $hero['description'] ?? trans('meta.description', $pageLang);
$canonicalPath = '/index.php';
$activeNav = 'home';

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
                    <div class="hero__actions">
                        <a class="button button--primary" href="solutions.php"><?= htmlspecialchars($hero['primary'] ?? '', ENT_QUOTES, 'UTF-8'); ?></a>
                        <a class="button button--ghost" href="contact.php"><?= htmlspecialchars($hero['secondary'] ?? '', ENT_QUOTES, 'UTF-8'); ?></a>
                    </div>
                </div>
                <figure class="hero__visual" aria-hidden="true">
                    <img src="image/background_im1.png" alt="" loading="lazy" width="960" height="640">
                </figure>
            </div>
        </section>

        <?php if (is_array($metrics) && count($metrics) > 0): ?>
            <section class="metrics">
                <div class="container metrics__grid" aria-label="<?= htmlspecialchars($pillars['title'] ?? 'FarmLink impact', ENT_QUOTES, 'UTF-8'); ?>">
                    <?php foreach ($metrics as $metric): ?>
                        <article class="metric-card">
                            <p class="metric-card__value"><?= htmlspecialchars($metric['value'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="metric-card__label"><?= htmlspecialchars($metric['label'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <section class="section">
            <div class="container">
                <header class="section__header">
                    <p class="eyebrow"><?= htmlspecialchars($pillars['eyebrow'] ?? ($pillars['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                    <h2 class="section__title"><?= htmlspecialchars($pillars['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                    <?php if (!empty($pillars['description'])): ?>
                        <p class="section__description"><?= htmlspecialchars($pillars['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                </header>
                <div class="grid grid--three">
                    <?php foreach ($pillars['items'] ?? [] as $pillar): ?>
                        <article class="card">
                            <h3><?= htmlspecialchars($pillar['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?= htmlspecialchars($pillar['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <header class="section__header">
                    <p class="eyebrow"><?= htmlspecialchars($solutions['eyebrow'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                    <h2 class="section__title"><?= htmlspecialchars($solutions['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                    <?php if (!empty($solutions['description'])): ?>
                        <p class="section__description"><?= htmlspecialchars($solutions['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                </header>
                <div class="grid grid--three">
                    <?php foreach ($solutions['items'] ?? [] as $solution): ?>
                        <article class="card">
                            <h3><?= htmlspecialchars($solution['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?= htmlspecialchars($solution['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <header class="section__header">
                    <h2 class="section__title"><?= htmlspecialchars($workflow['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                    <?php if (!empty($workflow['description'])): ?>
                        <p class="section__description"><?= htmlspecialchars($workflow['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                </header>
                <div class="workflow">
                    <?php foreach ($workflow['steps'] ?? [] as $step): ?>
                        <article class="workflow__step">
                            <h3><?= htmlspecialchars($step['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>
                            <ul class="list">
                                <?php foreach ($step['points'] ?? [] as $point): ?>
                                    <li><?= htmlspecialchars($point, ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <header class="section__header">
                    <h2 class="section__title"><?= htmlspecialchars($testimonials['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                    <?php if (!empty($testimonials['description'])): ?>
                        <p class="section__description"><?= htmlspecialchars($testimonials['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                </header>
                <div class="testimonials">
                    <?php foreach ($testimonials['items'] ?? [] as $item): ?>
                        <article class="testimonial-card">
                            <p>“<?= htmlspecialchars($item['quote'] ?? '', ENT_QUOTES, 'UTF-8'); ?>”</p>
                            <strong><?= htmlspecialchars($item['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong>
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
