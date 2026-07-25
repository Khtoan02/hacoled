<?php
/**
 * Browser security headers owned by the theme. Server-level configuration may
 * override these values on production hosting.
 */

defined('ABSPATH') || exit;

function hacoled_send_security_headers() {
    if (headers_sent() || is_admin()) {
        return;
    }

    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), geolocation=(), microphone=()');

    $policy = "default-src 'self'; "
        . "script-src 'self' 'unsafe-inline' 'unsafe-eval'; "
        . "style-src 'self' 'unsafe-inline'; "
        . "img-src 'self' data: https:; "
        . "font-src 'self' data:; "
        . "connect-src 'self'; worker-src 'self' blob:; "
        . "frame-src 'self' https://www.youtube.com https://www.youtube-nocookie.com; "
        . "object-src 'none'; base-uri 'self'; form-action 'self' https:; frame-ancestors 'self'";
    header('Content-Security-Policy: ' . $policy);

    $host = strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));
    $is_local = $host === 'localhost' || substr($host, -5) === '.test' || substr($host, -6) === '.local';
    if (is_ssl() || $host === 'localhost') {
        header('Cross-Origin-Opener-Policy: same-origin');
    }
    if (is_ssl() && !$is_local) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
    }
}
add_action('send_headers', 'hacoled_send_security_headers');
