# FarmLink Website

This directory contains the dynamic FarmLink website. Drop it into its own Git repository or use it in-place inside the `agrimate-website/` folder of the monorepo. All public pages are rendered via PHP entry points while preserving the original static design, and we keep `.html` twins for quick previews without a PHP runtime.

## Structure
- `index.php` / `index.html` – landing page
- `about.php` / `about.html` – about FarmLink
- `how-it-works.php` / `how-it-works.html` – explanation of our process
- `solutions.php` / `solutions.html` – overview of available solutions
- `ai-advisor.php` / `ai-advisor.html` – access to the AI advisor
- `account.php` / `register.php` – authentication flows
- `profile.php` – authenticated IoT dashboard
- `admin.php` – administration console (requires admin role)
- `contact.php` / `contact.html` – contact form
- `includes/` – shared layout partials and bootstrap logic
- `image/` – shared images
- `script.js`, `script.min.js`, `style.css`, `style.min.css`, `aos.css`, `aos.js` – client-side assets
- `server/` – PHP backend scripts and migrations
- `composer.json` – PHP dependencies (for future expansion)

## Configuration

The dynamic features read database connection details from environment variables:

- `DB_HOST` – Database host
- `DB_NAME` – Database name
- `DB_USER` – Database user
- `DB_PASSWORD` – Database password

Ensure these variables are available in your environment before hitting the authenticated dashboards or API endpoints.

Optional performance-related environment variables:

- `ASSET_BASE_URL` – absolute base URL for static assets (e.g. `https://cdn.farmlink.tn`) used to offload CSS/JS delivery to a CDN.

## Local development

To explore the site locally without configuring Apache or Nginx, start PHP's built-in server from this directory:

```bash
php -S localhost:8000
```

Then visit <http://localhost:8000>. All of the site entry points (`index.php`, `about.php`, etc.) live directly in this directory, so no additional document-root configuration is necessary.

## AI Provider Fallback

The `server/ai.php` endpoint attempts to contact the AI provider specified in the request. If the call fails due to a timeout or a 5xx error, it automatically falls back to the other provider. The JSON response includes the provider ultimately used so that clients can display which service handled the request.
