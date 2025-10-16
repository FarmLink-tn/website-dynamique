    <footer class="site-footer border-t border-border-soft mt-12">
        <div class="container mx-auto px-6 py-12 footer-columns">
            <div class="footer-column footer-column--brand">
                <a href="index.php" class="footer-brand">FarmLink</a>
                <p class="footer-text" data-translate="footer_mission">Nous connectons les agriculteurs tunisiens à des outils intelligents et durables.</p>
            </div>
            <div class="footer-column">
                <h2 class="footer-heading" data-translate="footer_nav_title">Navigation</h2>
                <ul class="footer-links" aria-label="Navigation secondaire">
                    <li><a href="index.php" data-translate="footer_home">Accueil</a></li>
                    <li><a href="about.php" data-translate="nav_about">À propos</a></li>
                    <li><a href="how-it-works.php" data-translate="nav_how_it_works">Comment ça marche</a></li>
                    <li><a href="solutions.php" data-translate="nav_solutions">Nos Solutions</a></li>
                    <li><a href="ai-advisor.php" data-translate="nav_ai_advisor">✨ Conseiller IA</a></li>
                    <li><a href="contact.php" data-translate="footer_contact_link">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h2 class="footer-heading" data-translate="footer_legal_title">Informations légales</h2>
                <ul class="footer-links" aria-label="Ressources légales">
                    <li><a href="privacy.php" data-translate="footer_privacy">Politique de confidentialité</a></li>
                    <li><a href="terms.php" data-translate="footer_terms">Conditions d'utilisation</a></li>
                    <li><a href="cookies.php" data-translate="footer_cookies">Politique de cookies</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h2 class="footer-heading" data-translate="footer_contact_title">Contact</h2>
                <ul class="footer-links" aria-label="Coordonnées">
                    <li><a href="mailto:contact@farmlink.tn" data-translate="footer_contact_email">Email : contact@farmlink.tn</a></li>
                    <li><a href="tel:+21612345678" data-translate="footer_contact_phone">Téléphone : +216 12 345 678</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p data-translate="footer_copyright">&copy; 2025 FarmLink. Tous droits réservés.</p>
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
