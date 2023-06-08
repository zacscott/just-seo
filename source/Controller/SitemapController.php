<?php

namespace JustSEO\Controller;

/**
 * Responsible for rendering the short seo sitemap.
 * 
 * @package JustSEO\Controller
 */
class SitemapController {

    public function __construct() {
        
        add_action( 'template_redirect', [ $this, 'handle_sitemap_route' ] );
        add_filter('wp_sitemaps_enabled', '__return_false');

    }

    /** 
     * Detect and handle the sitemap route.
     * This subverts WordPress routing / permalinks entirely.
     */
    public function handle_sitemap_route() {

        $uri_path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );

        if ( preg_match( '#^/sitemap.xml#', $uri_path ) ) {
            $this->render_sitemap();
            exit;
        }

    }

    /** 
     * Render the short seo sitemap.
     */
    public function render_sitemap() {
        
        $query = $this->get_sitemap_query();

        header( 'Content-Type: application/xml; charset=utf-8' );
        require_once JUST_SEO_PLUGIN_ABSPATH . '/templates/sitemap/template.php';

    }

    /** 
     * Get the posts to include in the sitemap.
     * 
     * @return WP_Query
     */
    protected function get_sitemap_query() {

        /**
         * Filter the max number posts shown in the sitemap.
         * 
         * @param int $just_seo_sitemap_posts_per_page
         */
        $sitemap_posts_per_page = apply_filters( 'just_seo_sitemap_posts_per_page', 100 );

        $query = new \WP_Query(
            [
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => $sitemap_posts_per_page,
                'orderby'        => 'post_date',
                'order'          => 'DESC',
            ]
        );

        return $query;

    }

}
