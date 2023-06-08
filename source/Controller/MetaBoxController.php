<?php

namespace JustSEO\Controller;

use JustSEO\Model\SEOMetaModel;

/**
 * Responsible for rendering and handling the SEO meta box.
 * 
 * @package JustSEO\Controller
 */
class MetaBoxController {

    /**
     * Path to the meta box template within the plugin root.
     */
    const TEMPLATE_PATH = 'templates/meta-box/';

    public function __construct() {
        
        add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
        add_action( 'save_post', [ $this, 'meta_box_save' ] );

    }

    /** 
     * Add the primary category meta box to the post edit screen.
     */
    public function add_meta_boxes() {

        $just_seo_screens = [ get_post_types() ];

        /**
         * Filter the screens that the SEO meta box is shown on.
         * 
         * @param array $just_seo_screens
         */
        $just_seo_screens = apply_filters( 'just_seo_screens', $just_seo_screens );

        foreach ( $just_seo_screens as $screen ) {

            add_meta_box(
                'just_seo',
                __( 'SEO', 'just-seo' ),
                [ $this, 'meta_box_render' ], 
                $screen,
                'advanced',
                'high'
            );
        }

    }

    /**
     * Render the SEO meta box.
     * 
     * @param WP_Post $post The post object.
     */
    public function meta_box_render( $post ) {

        $seo_model = new SEOMetaModel();

        // Render the meta box template.
        require_once JUST_SEO_PLUGIN_ABSPATH . '/' . self::TEMPLATE_PATH . '/template.php';

    }

    /** 
     * Save the SEO meta box data.
     * 
     * @param int $post_id The ID of the post being saved.
     */
    public function meta_box_save( $post_id ) {

        // NOTE This is a secure way of doing this, and is the recommended way of doing it i nthe docs;
        // https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/#saving-values
        // WordPress first authenticates the user and then checks the edit page nonce before calling this
        // save_post hook.

        $robots    = $_POST['just_seo_robots'] ?? '';
        $canonical = $_POST['just_seo_canonical'] ?? '';
        $desc      = $_POST['just_seo_desc'] ?? '';

        $seo_model = new SEOMetaModel();
        $seo_model->set_robots( $robots, $post_id );
        $seo_model->set_canonical( $canonical, $post_id );
        $seo_model->set_desc( $desc, $post_id );

    }

}
