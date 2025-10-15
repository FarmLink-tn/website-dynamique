<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink - Contact';
$activeNav = 'contact';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main>
        <section id="contact" class="py-20">
            <div class="container mx-auto px-6 text-center">
                <h2 class="section-title" data-translate="contact_title">Contactez-nous</h2>

                <div class="max-w-2xl mx-auto control-card mt-12 text-left">
                    <p class="text-center text-text-300 mb-8" data-translate="contact_intro">
                        Une question ? Un projet ? N'hésitez pas à nous contacter. Notre équipe est prête à vous aider à franchir le pas vers l'agriculture intelligente.
                    </p>
                    <form id="contact-form" action="server/contact.php" method="POST">
                        <input type="hidden" name="csrf_token" id="contact-csrf-token">
                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm font-medium text-text-300" data-translate="contact_name">Nom</label>
                            <input type="text" id="name" name="name" class="form-input" placeholder="Votre nom complet" required>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-text-300" data-translate="contact_email">Email</label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="votre.email@exemple.com" required>
                        </div>
                        <div class="mb-6">
                            <label for="phone" class="block mb-2 text-sm font-medium text-text-300" data-translate="contact_phone">Numéro de téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-input" placeholder="Votre numéro de téléphone (Optionnel)">
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block mb-2 text-sm font-medium text-text-300" data-translate="contact_message">Message</label>
                            <textarea id="message" name="message" rows="4" class="form-input" placeholder="Décrivez votre projet ou votre question ici..." required></textarea>
                        </div>
                        <button type="submit" class="button w-full" data-translate="contact_send">
                            <i class="fas fa-paper-plane mr-2"></i> Envoyer le Message
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
