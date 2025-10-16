<?php
require __DIR__ . '/includes/bootstrap.php';

$pageLang = current_language();
$content = trans('contact', $pageLang);

$pageTitle = 'FarmLink - ' . ($content['title'] ?? 'Contact');
$metaDescription = $content['intro'] ?? trans('meta.description', $pageLang);
$canonicalPath = '/contact.php';
$activeNav = 'contact';

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main">
        <section class="section">
            <div class="container">
                <div class="form-card" id="contact">
                    <header class="section__header" style="text-align:left; margin-bottom:2rem;">
                        <h1 class="section__title" style="margin-bottom:0.5rem;"><?= htmlspecialchars($content['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h1>
                        <p class="section__description" style="text-align:left;"><?= htmlspecialchars($content['intro'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                    </header>
                    <form id="contact-form" action="server/contact.php" method="POST" novalidate data-success-message="<?= htmlspecialchars($content['success'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" data-error-message="<?= htmlspecialchars($content['error'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="csrf_token" id="contact-csrf-token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="honeypot" aria-hidden="true">
                            <label for="contact-company">Company</label>
                            <input type="text" id="contact-company" name="company" tabindex="-1" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="name"><?= htmlspecialchars($content['name'] ?? 'Nom complet', ENT_QUOTES, 'UTF-8'); ?></label>
                            <input type="text" id="name" name="name" class="form-input" placeholder="<?= htmlspecialchars($content['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" autocomplete="name" minlength="2" maxlength="120" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><?= htmlspecialchars($content['email'] ?? 'Email', ENT_QUOTES, 'UTF-8'); ?></label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="<?= htmlspecialchars($content['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" autocomplete="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone"><?= htmlspecialchars($content['phone'] ?? 'Téléphone', ENT_QUOTES, 'UTF-8'); ?></label>
                            <input type="tel" id="phone" name="phone" class="form-input" placeholder="<?= htmlspecialchars($content['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" autocomplete="tel" pattern="^\+?[0-9\s.-]{6,25}$" maxlength="25">
                        </div>
                        <div class="form-group">
                            <label for="message"><?= htmlspecialchars($content['message'] ?? 'Message', ENT_QUOTES, 'UTF-8'); ?></label>
                            <textarea id="message" name="message" class="form-input" required minlength="20" maxlength="2000" placeholder="<?= htmlspecialchars($content['message'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></textarea>
                        </div>
                        <button type="submit" class="button button--primary" aria-live="polite">
                            <span><i class="fas fa-paper-plane" aria-hidden="true"></i> <?= htmlspecialchars($content['submit'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                        </button>
                        <p id="contact-form-feedback" role="status" aria-live="polite"></p>
                    </form>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
