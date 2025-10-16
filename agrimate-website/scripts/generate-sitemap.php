#!/usr/bin/env php
<?php
declare(strict_types=1);

$baseUrl = rtrim(getenv('SITE_BASE_URL') ?: 'https://farmlink.tn', '/');
$pages = [
    ['path' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
    ['path' => '/about.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['path' => '/how-it-works.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['path' => '/solutions.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['path' => '/ai-advisor.php', 'priority' => '0.7', 'changefreq' => 'weekly'],
    ['path' => '/contact.php', 'priority' => '0.7', 'changefreq' => 'weekly'],
    ['path' => '/account.php', 'priority' => '0.6', 'changefreq' => 'monthly'],
    ['path' => '/register.php', 'priority' => '0.6', 'changefreq' => 'monthly'],
];

$languages = ['fr', 'en', 'ar'];
$defaultLang = 'fr';
$today = (new DateTimeImmutable('now', new DateTimeZone('UTC')))->format('Y-m-d');

$dom = new DOMDocument('1.0', 'UTF-8');
$dom->formatOutput = true;
$urlset = $dom->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
$urlset->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xhtml', 'http://www.w3.org/1999/xhtml');
$dom->appendChild($urlset);

foreach ($pages as $page) {
    $path = $page['path'];
    $baseLoc = $path === '/' ? $baseUrl : $baseUrl . $path;
    $urlNode = $dom->createElement('url');
    $loc = $dom->createElement('loc', htmlspecialchars($baseLoc, ENT_XML1));
    $urlNode->appendChild($loc);
    $urlNode->appendChild($dom->createElement('lastmod', $today));
    $urlNode->appendChild($dom->createElement('changefreq', $page['changefreq']));
    $urlNode->appendChild($dom->createElement('priority', $page['priority']));

    foreach ($languages as $language) {
        $localizedPath = $language === $defaultLang ? $baseLoc : $baseLoc . '?lang=' . $language;
        $link = $dom->createElement('xhtml:link');
        $link->setAttribute('rel', 'alternate');
        $link->setAttribute('hreflang', $language);
        $link->setAttribute('href', $localizedPath);
        $urlNode->appendChild($link);
    }

    $linkDefault = $dom->createElement('xhtml:link');
    $linkDefault->setAttribute('rel', 'alternate');
    $linkDefault->setAttribute('hreflang', 'x-default');
    $linkDefault->setAttribute('href', $baseLoc);
    $urlNode->appendChild($linkDefault);

    $urlset->appendChild($urlNode);
}

$target = __DIR__ . '/../sitemap.xml';
if ($dom->save($target) === false) {
    fwrite(STDERR, "Unable to write sitemap to {$target}\n");
    exit(1);
}

echo "Sitemap generated at {$target}\n";
