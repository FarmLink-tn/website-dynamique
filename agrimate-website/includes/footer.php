    <footer class="text-center py-8 border-t border-border-soft mt-12">
        <p data-translate="footer_copyright">&copy; 2025 FarmLink. Tous droits réservés.</p>
    </footer>
    <?php if (!empty($beforeMainScripts) && is_array($beforeMainScripts)): ?>
        <?php foreach ($beforeMainScripts as $script): ?>
            <?= $script ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <script src="aos.js" defer></script>
    <script src="script.js" defer></script>
    <?php if (!empty($afterMainScripts) && is_array($afterMainScripts)): ?>
        <?php foreach ($afterMainScripts as $script): ?>
            <?= $script ?>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
