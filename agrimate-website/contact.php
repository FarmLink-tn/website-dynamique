<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink - Contact';
$metaDescription = "Contactez l'équipe FarmLink pour obtenir un devis, poser vos questions et découvrir comment moderniser votre exploitation agricole en Tunisie.";
$metaKeywords = 'FarmLink contact, devis agriculture intelligente, assistance FarmLink';
$canonicalPath = '/contact.php';
$activeNav = 'contact';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" role="main" tabindex="-1">
        <section id="contact" class="py-20">
            <div class="container mx-auto px-6 text-center">
                <h2 class="section-title" data-translate="contact_title">Contactez-nous</h2>

                <div class="max-w-2xl mx-auto control-card mt-12 text-left">
                    <p class="text-center text-text-300 mb-8" data-translate="contact_intro">
                        Une question ? Un projet ? N'hésitez pas à nous contacter. Notre équipe est prête à vous aider à franchir le pas vers l'agriculture intelligente.
                    </p>
                    <form id="contact-form" action="server/contact.php" method="POST" aria-describedby="contact-form-instructions" novalidate>
                        <p id="contact-form-instructions" class="sr-only">Tous les champs sauf le numéro de téléphone sont obligatoires.</p>
                        <input type="hidden" name="csrf_token" id="contact-csrf-token">
                        <div class="honeypot" aria-hidden="true">
                            <label for="contact-company">Entreprise</label>
                            <input type="text" id="contact-company" name="company" tabindex="-1" autocomplete="off">
                        </div>
                        <div class="mb-6">
                            <label id="contact-name-label" for="name" class="block mb-2 text-sm font-medium text-text-300" data-translate="contact_name">Nom</label>
                            <input type="text" id="name" name="name" class="form-input" placeholder="Votre nom complet" required aria-required="true" aria-labelledby="contact-name-label" autocomplete="name" minlength="2" maxlength="120">
                        </div>
                        <div class="mb-6">
                            <label id="contact-email-label" for="email" class="block mb-2 text-sm font-medium text-text-300" data-translate="contact_email">Email</label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="votre.email@exemple.com" required aria-required="true" aria-labelledby="contact-email-label" autocomplete="email">
                        </div>
                        <div class="mb-6">
                            <label id="contact-phone-label" for="phone" class="block mb-2 text-sm font-medium text-text-300" data-translate="contact_phone">Numéro de téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-input" placeholder="Votre numéro de téléphone (Optionnel)" aria-labelledby="contact-phone-label" autocomplete="tel" pattern="^\+?[0-9\s.-]{6,}$" maxlength="25">
                        </div>
                        <div class="mb-6">
                            <label id="contact-message-label" for="message" class="block mb-2 text-sm font-medium text-text-300" data-translate="contact_message">Message</label>
                            <textarea id="message" name="message" rows="4" class="form-input" placeholder="Décrivez votre projet ou votre question ici..." required aria-required="true" aria-labelledby="contact-message-label" minlength="20" maxlength="2000"></textarea>
                        </div>
                        <button type="submit" class="button w-full" aria-live="off">
                            <span class="flex items-center justify-center gap-2"><i class="fas fa-paper-plane" aria-hidden="true"></i><span data-translate="contact_send_label">Envoyer le message</span></span>
                        </button>
                        <p id="contact-form-feedback" class="mt-4 text-sm text-text-300" role="alert" aria-live="polite"></p>
                    </form>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
