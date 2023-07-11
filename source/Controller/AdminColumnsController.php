<?php

namespace JustSEO\Controller;

use JustSEO\Model\SEOMetaModel;

/**
 * Responsible for rendering SEO admin columns.
 * 
 * @package JustSEO\Controller
 */
class AdminColumnsController {

    public function __construct() {
        
        add_action( 'get_the_excerpt', [ $this, 'replace_excerpt_with_meta_desc' ], 10, 2 );

        add_filter( 'manage_post_posts_columns', [ $this, 'register_admin_columns' ] );
        add_filter( 'manage_page_posts_columns', [ $this, 'register_admin_columns' ] );
        add_action( 'manage_post_posts_custom_column' , [ $this, 'render_admin_column' ], 10, 2 );
        add_action( 'manage_page_posts_custom_column' , [ $this, 'render_admin_column' ], 10, 2 );

    }

    /**
     * Register the admin columns.
     * 
     * @param mixed $columns 
     * @return mixed 
     */
    public function register_admin_columns( $columns ) {

        $columns['seo_robots'] = __( 'SEO Robots', 'just-seo' );

        return $columns;

    }

    /**
     * Render the admin column.
     * 
     * @param mixed $column 
     * @param mixed $post_id 
     * @return mixed 
     */
    public function render_admin_column( $column, $post_id ) {

        if ( 'seo_robots' === $column ) {

            $seo_model = new SEOMetaModel();

            $robots = $seo_model->get_robots( $post_id );

            echo esc_html( $robots );

        }

    }

    /**
     * Replace the excerpt with the meta description on the edit screen.
     * 
     * @param mixed $excerpt 
     * @param mixed $post 
     * @return mixed 
     */
    public function replace_excerpt_with_meta_desc( $excerpt, $post ) {

        global $pagenow;

        if ( is_admin() &&  'edit.php' === $pagenow ) {

            $seo_model = new SEOMetaModel();

            $excerpt = $seo_model->get_desc( $post->ID );

        }

        return $excerpt;

    }

}
