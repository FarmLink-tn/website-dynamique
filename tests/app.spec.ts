import { test, expect } from '@playwright/test';

const heroButtonTranslations: Record<string, string> = {
  fr: 'Découvrir nos solutions',
  en: 'Discover our solutions',
  ar: 'اكتشف حلولنا'
};

test.describe('FarmLink experience', () => {
  test('desktop navigation contains unique destinations', async ({ page }) => {
    await page.goto('/index.php');
    const hrefs = await page.locator('header nav .nav-link').evaluateAll((anchors) =>
      anchors.map((anchor) => anchor.getAttribute('href'))
    );
    const filtered = hrefs.filter((href): href is string => !!href);
    const unique = new Set(filtered);
    expect(unique.size).toBe(filtered.length);
  });

  test('alternate hreflang links are exposed for each language', async ({ page }) => {
    await page.goto('/index.php');
    await expect(page.locator('head link[rel="alternate"][hreflang="fr"]')).toHaveCount(1);
    await expect(page.locator('head link[rel="alternate"][hreflang="en"]')).toHaveAttribute('href', /lang=en/);
    await expect(page.locator('head link[rel="alternate"][hreflang="ar"]')).toHaveAttribute('href', /lang=ar/);
    await expect(page.locator('head link[rel="alternate"][hreflang="x-default"]')).toHaveAttribute('href', /farmlink\.tn\/?$/);
  });

  test('language switcher changes translations and lang attribute', async ({ page }) => {
    await page.goto('/index.php');
    await page.selectOption('#language-switcher', 'en');
    await page.waitForURL(/lang=en/);
    await expect(page.locator('html')).toHaveAttribute('lang', 'en');
    await expect(page.locator('[data-translate="hero_button"]')).toHaveText(heroButtonTranslations.en);
  });

  test('unauthenticated navigation exposes login/register only', async ({ page }) => {
    await page.goto('/index.php');
    await expect(page.locator('[data-translate="nav_login"]')).toHaveText(/Se connecter|Log In/);
    await expect(page.locator('[data-translate="nav_register"]')).toHaveText(/Créer un compte|Create Account/);
    await expect(page.locator('[data-translate="nav_dashboard"]')).toHaveCount(0);
  });

  test('contact form prevents invalid submissions client-side', async ({ page }) => {
    let triggered = false;
    await page.route('**/server/contact.php', (route) => {
      triggered = true;
      route.fulfill({ status: 200, body: JSON.stringify({ success: true }) });
    });

    await page.goto('/contact.php');
    await page.fill('#name', 'A');
    await page.fill('#email', 'invalid-email');
    await page.fill('#message', 'Test');
    await page.click('button[type="submit"]');
    await page.waitForTimeout(200);
    expect(triggered).toBe(false);
    await expect(page.locator('#contact-form-feedback')).toContainText(/nom valide|valid name/i);
  });

  test('contact form submits successfully with valid data', async ({ page }) => {
    await page.route('**/server/contact.php', (route) => {
      route.fulfill({
        status: 200,
        contentType: 'application/json',
        body: JSON.stringify({ success: true, message: 'Message envoyé test.' })
      });
    });

    await page.goto('/contact.php');
    await page.fill('#name', 'Test User');
    await page.fill('#email', 'user@example.com');
    await page.fill('#phone', '+33123456789');
    await page.fill('#message', 'Ceci est un message de test valide de plus de vingt caractères.');
    await page.click('button[type="submit"]');
    await expect(page.locator('#contact-form-feedback')).toContainText(/Message envoyé/i);
  });
});
