<?php

namespace JustSEO\Controller;

/**
 * Responsible for rendering the short seo sitemap.
 * 
 * @package JustSEO\Controller
 */
class SitemapController {


    public function __construct() {
        
        add_filter('wp_sitemaps_enabled', '__return_false');
        // TODO render sitemap

    }

}
