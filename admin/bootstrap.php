<?php
if (!defined('APP_ROOT')) {
    define('APP_ROOT', realpath(__DIR__));
    define('LAYOUT_PATH', APP_ROOT . '/layout');
    define('FILES_PATH', APP_ROOT . '/files');

    $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : '';
    $docRoot = $docRoot ? str_replace('\\', '/', $docRoot) : '';
    $appPath = str_replace('\\', '/', APP_ROOT);

    if ($docRoot !== '' && strpos($appPath, $docRoot) === 0) {
        $relativePath = substr($appPath, strlen($docRoot));
        $relativePath = $relativePath !== false ? $relativePath : '';
    } else {
        $relativePath = '';
    }

    $relativePath = '/' . trim($relativePath, '/');
    if ($relativePath === '/.' || $relativePath === '//') {
        $relativePath = '/';
    }
    define('BASE_URL', $relativePath === '' ? '/' : $relativePath);

    if (!function_exists('app_url_join')) {
        function app_url_join(string $base, string $path): string
        {
            $path = trim($path, '/');
            if ($path === '') {
                return $base === '/' ? '/' : rtrim($base, '/');
            }
            if ($base === '/' || $base === '') {
                return '/' . $path;
            }
            return rtrim($base, '/') . '/' . $path;
        }
    }

    if (!function_exists('asset_url')) {
        function asset_url(string $path): string
        {
            return app_url_join(BASE_URL, 'assets/' . ltrim($path, '/'));
        }
    }

    if (!function_exists('file_url')) {
        function file_url(string $path): string
        {
            return app_url_join(BASE_URL, 'files/' . ltrim($path, '/'));
        }
    }
}
