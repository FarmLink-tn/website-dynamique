<?php
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'FarmLink - Conseiller IA';
$metaDescription = "Consultez le conseiller agricole IA de FarmLink pour obtenir des recommandations instantanées sur vos cultures et diagnostiquer les problèmes courants.";
$metaKeywords = 'FarmLink IA, conseiller agricole, diagnostic cultures, intelligence artificielle';
$canonicalPath = '/ai-advisor.php';
$activeNav = 'ai';
$beforeMainScripts = [
    '<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-core@4.21.0/dist/tf-core.min.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-converter@4.21.0/dist/tf-converter.min.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-backend-webgl@4.21.0/dist/tf-backend-webgl.min.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/qna@1.7.1/dist/qna.min.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet@2.1.1/dist/mobilenet.min.js"></script>',
];
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>
    <main id="main-content" tabindex="-1">
        <section id="ai-advisor" class="py-20">
            <div class="container mx-auto px-6 text-center">
                <h2 class="section-title" data-translate="ai_advisor_title">Conseiller Agricole IA</h2>

                <div class="max-w-3xl mx-auto control-card mt-12">
                    <div id="ai-results-container" class="ai-results-container mb-4">
                        <div id="image-preview-wrapper" class="hidden">
                            <img id="previewImg" alt="Aperçu de l'image">
                            <video id="cam" autoplay playsinline muted hidden></video>
                            <button id="captureBtn" class="capture-button hidden" title="Prendre une photo"><i class="fas fa-camera"></i></button>
                        </div>
                        <div id="ai-response-text" class="ai-response-text">
                            <p data-translate="ai_welcome">Bonjour ! Posez-moi une question sur vos cultures ou envoyez-moi une photo.</p>
                        </div>
                         <div id="ai-spinner" class="spinner mx-auto hidden"></div>
                    </div>

                    <div class="progress-bar-container my-2 hidden" id="progress-container"><div class="progress-bar" id="progressBar"></div></div>

                    <form id="ai-input-form" class="ai-input-form">
                        <label for="fileInput" class="ai-action-button" title="Téléverser une image">
                            <i class="fas fa-paperclip"></i>
                        </label>
                        <input id="fileInput" type="file" class="hidden" accept="image/*" />

                        <button type="button" id="webcamBtn" class="ai-action-button" title="Utiliser la caméra">
                            <i class="fas fa-camera"></i>
                        </button>

                        <textarea id="text-input" class="form-input flex-grow" rows="4" placeholder="Posez votre question ici..."></textarea>

                        <button type="submit" class="button">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>

                     <p class="text-sm mt-4 text-text-500" data-translate="privacyNote">Confidentialité garantie : Toute l'analyse est effectuée sur votre appareil.</p>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
