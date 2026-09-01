<?php
// Local-only dev router for `php -S`, mirroring the account's root .htaccess
// (production serves the whole Laravel app from the domain root, not /public).
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false;
}

require __DIR__ . '/index.php';
