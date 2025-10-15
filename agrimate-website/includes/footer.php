    <footer class="text-center py-8 border-t border-border-soft mt-12">
        <p data-translate="footer_copyright">&copy; 2025 FarmLink. Tous droits réservés.</p>
    </footer>
    <?php if (!empty($beforeMainScripts) && is_array($beforeMainScripts)): ?>
        <?php foreach ($beforeMainScripts as $script): ?>
            <?= $script ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <script src="<?= htmlspecialchars(asset_url('aos.js'), ENT_QUOTES, 'UTF-8'); ?>" defer></script>
    <script src="<?= htmlspecialchars(asset_url('script.min.js'), ENT_QUOTES, 'UTF-8'); ?>" defer></script>
    <?php if (!empty($afterMainScripts) && is_array($afterMainScripts)): ?>
        <?php foreach ($afterMainScripts as $script): ?>
            <?= $script ?>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
