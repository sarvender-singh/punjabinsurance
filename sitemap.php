<?php
// sitemap.php
// Dynamic XML sitemap for Punjab Insurance

error_reporting(0);
ini_set('display_errors', '0');

$baseUrl = 'https://www.punjabinsurance.ca';

$staticPages = array(
    '/' => '1.0',
    '/contact.php' => '0.5',
    '/about-punjab-insurance.php' => '0.5',
    '/photo-gallery.php' => '0.5',
    '/media-center-press-release.php' => '0.3',
    '/privacy-policy.php' => '0.3',
    '/buy-sell-agreements.php' => '0.8',
    '/blogs.php' => '0.5',
    '/classes.php' => '0.5',
    '/our-commercials.php' => '0.5',
    '/business-ownership.php' => '0.5',
    '/companies-we-represent.php' => '0.5',
    '/our-history.php' => '0.5',
    '/life-insurance.php' => '0.8',
    '/term-life-insurance.php' => '0.8',
    '/whole-life-insurance.php' => '0.8',
    '/universal-life-insurance.php' => '0.8',
    '/permanent-life-insurance.php' => '0.8',
    '/mortgage-insurance.php' => '0.8',
    '/critical-illness-insurance.php' => '0.8',
    '/disability-insurance.php' => '0.8',
    '/super-visa-insurance.php' => '0.8',
    '/super-visa-insurance-cost.php' => '0.8',
    '/faq.php' => '0.5',
    '/terms-of-service.php' => '0.3',
    '/join-us.php' => '0.3',
);

$urls = array();

// Static pages
foreach ($staticPages as $path => $priority) {
    $urls[$baseUrl . $path] = array(
        'lastmod'  => gmdate('Y-m-d'),
        'priority' => $priority
    );
}

// ================================
// FETCH FUNCTION (cURL + fallback)
// ================================
function sitemap_fetch($url) {
    $code = 0;
    $body = false;

    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            CURLOPT_HTTPHEADER     => array('Accept: application/json'),
        ));
        $body = curl_exec($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($body === false) {
            error_log('Sitemap cURL error: ' . curl_error($ch));
        }
        curl_close($ch);
    } else {
        $context = stream_context_create(array(
            'http' => array(
                'timeout'       => 20,
                'ignore_errors' => true,
                'header'        => "Accept: application/json\r\nUser-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
            )
        ));
        $body = @file_get_contents($url, false, $context);
        if (isset($http_response_header[0]) && preg_match('/\s(\d{3})\s/', $http_response_header[0], $m)) {
            $code = (int) $m[1];
        }
    }

    return array($code, $body);
}

// ================================
// FETCH WORDPRESS POSTS
// ================================
$apiBase  = 'https://blog.punjabinsurance.ca/wp-json/wp/v2/posts';
$page     = 1;
$maxPages = 1000;

do {
    $apiUrl = $apiBase . '?' . http_build_query(array(
        'per_page' => 100,
        'page'     => $page,
        '_fields'  => 'slug,date,modified',
    ));

    $result   = sitemap_fetch($apiUrl);
    $code     = $result[0];
    $response = $result[1];

    // Page number out of range -> WP returns 400
    if ($code === 400) break;

    if ($code !== 200 || !$response) {
        error_log("Sitemap: API failed page $page, HTTP $code");
        break;
    }

    $posts = json_decode($response, true);

    if (!is_array($posts) || isset($posts['code'])) {
        error_log('Sitemap: Invalid WordPress API response.');
        break;
    }

    foreach ($posts as $post) {
        if (!is_array($post) || empty($post['slug'])) continue;

        $blogUrl   = $baseUrl . '/blog/' . rawurlencode((string) $post['slug']);
        $timestamp = !empty($post['modified']) ? strtotime($post['modified']) : false;

        $urls[$blogUrl] = array(
            'lastmod'  => ($timestamp !== false) ? gmdate('Y-m-d', $timestamp) : gmdate('Y-m-d'),
            'priority' => '0.6',
        );
    }

    if (count($posts) < 100) break;
    $page++;

} while ($page <= $maxPages);

// ================================
// OUTPUT XML
// ================================
header('Content-Type: application/xml; charset=UTF-8');
header('Cache-Control: public, max-age=300');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($urls as $loc => $data) {
    echo "  <url>\n";
    echo '    <loc>' . htmlspecialchars($loc, ENT_QUOTES, 'UTF-8') . "</loc>\n";
    echo '    <lastmod>' . $data['lastmod'] . "</lastmod>\n";
    echo '    <priority>' . $data['priority'] . "</priority>\n";
    echo "  </url>\n";
}

echo "</urlset>";