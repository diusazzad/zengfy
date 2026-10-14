<?php

if (!function_exists('zengfy_url')) {
    /**
     * Generate a URL for a specific subdomain within the Zengfy ecosystem.
     *
     * @param  string|null  $subdomain
     * @param  string|null  $path
     * @return string
     */
    function zengfy_url($subdomain = null, $path = null)
    {
        $baseDomain = config('app.base_domain', 'zengfy.top');
        $scheme = config('app.url_scheme', 'http');

        $url = $scheme . '://';

        if ($subdomain) {
            $url .= $subdomain . '.';
        }

        $url .= $baseDomain;

        if ($path) {
            $url .= '/' . ltrim($path, '/');
        }

        return $url;
    }
}
