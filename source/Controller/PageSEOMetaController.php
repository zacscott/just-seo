<?php

namespace JustSEO\Controller;

use JustSEO\Model\SEOMetaModel;

/**
 * Responsible for rendering SEO meta data into the page HTML.
 * 
 * @package JustSEO\Controller
 */
class PageSEOMetaController {

    /**
     * Path to the meta box template within the plugin root.
     */
    const TEMPLATE_PATH = 'templates/meta-html/';

    public function __construct() {
        
        add_action( 'wp_head', [ $this, 'render_page_seo_meta' ] );
        add_filter( 'wp_robots', [ $this, 'hide_wp_robots' ] );
        add_filter( 'get_canonical_url', [ $this, 'set_canonical' ] );

    }

    /** 
     * Hide WordPress default robots meta.
     */
    public function hide_wp_robots( $robots ) {

        return [];

    }

    /** 
     * Set the canonical URL.
     */
    public function set_canonical( $canonical_url ) {
        
        $seo_model = new SEOMetaModel();
        $canonical_url = $seo_model->get_canonical();

        // By default, use the permalink.
        if ( empty( $canonical_url ) ) {
            $canonical_url = get_permalink( get_the_ID() );
        }

        return $canonical_url;

    }

    /** 
     * Render the SEO meta data into the page HTML.
     */
    public function render_page_seo_meta() {
        
        $seo_model = new SEOMetaModel();

        // Render the meta box template.
        require_once JUST_SEO_PLUGIN_ABSPATH . '/' . self::TEMPLATE_PATH . '/template.php';

    }

}
