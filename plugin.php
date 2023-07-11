<?php
/**
 * Plugin Name: Just SEO
 * Version:     1.0.3
 * Author:      Zac Scott
 * Author URI:  https://zacscott.net
 * Description: Essential SEO functionality for WordPress.
 * Text Domain: just-seo
 */

require dirname( __FILE__ ) . '/vendor/autoload.php';

define( 'JUST_SEO_PLUGIN_ABSPATH', dirname( __FILE__ ) );
define( 'JUST_SEO_PLUGIN_ABSURL', plugin_dir_url( __FILE__ )  );

// Boot each of the plugin logic controllers.
new \JustSEO\Controller\MetaBoxController();
new \JustSEO\Controller\PageSEOMetaController();
new \JustSEO\Controller\SitemapController();
new \JustSEO\Controller\AdminColumnsController();
