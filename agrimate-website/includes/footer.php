    <footer class="site-footer">
        <section class="footer-cta" aria-labelledby="footer-cta-title">
            <div class="footer-cta__content">
                <div>
                    <p id="footer-cta-title" class="footer-cta__title"><?= htmlspecialchars(trans('footer.cta_title', $pageLang), ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="footer-cta__subtitle"><?= htmlspecialchars(trans('footer.tagline', $pageLang), ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <a class="footer-cta__button" href="contact.php"><?= htmlspecialchars(trans('footer.cta_button', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a>
            </div>
        </section>
        <div class="footer-columns">
            <div class="footer-column">
                <a href="index.php" class="footer-brand">FarmLink</a>
                <p class="footer-text"><?= htmlspecialchars(trans('footer.tagline', $pageLang), ENT_QUOTES, 'UTF-8'); ?></p>
                <address class="footer-address">
                    <?= htmlspecialchars(trans('footer.address', $pageLang), ENT_QUOTES, 'UTF-8'); ?>
                </address>
            </div>
            <div class="footer-column">
                <h2 class="footer-heading"><?= htmlspecialchars(trans('nav.home', $pageLang), ENT_QUOTES, 'UTF-8'); ?></h2>
                <ul class="footer-links" aria-label="Navigation secondaire">
                    <li><a href="index.php"><?= htmlspecialchars(trans('nav.home', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <li><a href="about.php"><?= htmlspecialchars(trans('nav.about', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <li><a href="how-it-works.php"><?= htmlspecialchars(trans('nav.how', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <li><a href="solutions.php"><?= htmlspecialchars(trans('nav.solutions', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <li><a href="ai-advisor.php"><?= htmlspecialchars(trans('nav.ai', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <li><a href="contact.php"><?= htmlspecialchars(trans('nav.contact', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h2 class="footer-heading"><?= htmlspecialchars(trans('footer.legal', $pageLang), ENT_QUOTES, 'UTF-8'); ?></h2>
                <ul class="footer-links" aria-label="Ressources légales">
                    <li><a href="privacy.php"><?= htmlspecialchars(trans('footer.privacy', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <li><a href="terms.php"><?= htmlspecialchars(trans('footer.terms', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <li><a href="cookies.php"><?= htmlspecialchars(trans('footer.cookies', $pageLang), ENT_QUOTES, 'UTF-8'); ?></a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h2 class="footer-heading"><?= htmlspecialchars(trans('nav.contact', $pageLang), ENT_QUOTES, 'UTF-8'); ?></h2>
                <ul class="footer-links" aria-label="Coordonnées">
                    <li><span><?= htmlspecialchars(trans('footer.phone_label', $pageLang), ENT_QUOTES, 'UTF-8'); ?> :</span> <a href="tel:+21612345678">+216 12 345 678</a></li>
                    <li><span><?= htmlspecialchars(trans('footer.email_label', $pageLang), ENT_QUOTES, 'UTF-8'); ?> :</span> <a href="mailto:contact@farmlink.tn">contact@farmlink.tn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p><?= htmlspecialchars(trans('footer.copyright', $pageLang), ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </footer>
    <?php if (!empty($beforeMainScripts) && is_array($beforeMainScripts)): ?>
        <?php foreach ($beforeMainScripts as $script): ?>
            <?= $script ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <script src="script.js" defer></script>
    <?php if (!empty($afterMainScripts) && is_array($afterMainScripts)): ?>
        <?php foreach ($afterMainScripts as $script): ?>
            <?= $script ?>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
