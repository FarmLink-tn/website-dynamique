# FarmLink Marketing Site

Ce dépôt contient la refonte complète du site vitrine FarmLink Tunisie. L’interface propose un design glassmorphism léger, une expérience trilingue (FR/EN/AR) et des contenus inspirés de la proposition de valeur de FarmLink.

## Structure

- `agrimate-website/` : racine du site PHP.
  - `includes/` : bootstrap, en-têtes, pied de page et système de traduction PHP.
  - `style.css` / `script.js` : feuille de style et interactions (thème, menu, langue, formulaire de contact).
  - `server/` : points d’entrée sécurisés (contact, auth, etc.).
  - Pages marketing : `index.php`, `about.php`, `how-it-works.php`, `solutions.php`, `ai-advisor.php`, `contact.php`.

## Fonctionnalités clés

- Navigation unique pour bureau/mobile avec sélecteur de langue et thème clair/sombre.
- Contenus marketing localisés en français, anglais et arabe via la fonction `trans()`.
- Formulaire de contact sécurisé (CSRF, honeypot, validation côté serveur) avec réponses localisées.
- Sitemap, métadonnées et robots.txt mis à jour pour le référencement.
- Design responsive avec sections héro, métriques, témoignages, process et CTA alignés sur FarmLink.

## Développement

1. Lancer un serveur PHP local :
   ```bash
   php -S localhost:8000 -t agrimate-website
   ```
2. Visiter `http://localhost:8000` dans le navigateur.
3. Ajuster les traductions dans `includes/translations.php` si nécessaire.

Les dépendances externes sont limitées aux polices et icônes chargées via CDN.
