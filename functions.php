<?php
/**
 * ntronica theme functions
 *
 * @package ntronica
 */

define( 'COMPONENTS_PATH', dirname( __FILE__ ) . '/components/' );
define( 'FUNC_PATH', dirname( __FILE__ ) . '/functionality/' );
define( 'WIDGET_PATH', dirname( __FILE__ ) . '/widget/' );
define( 'TEMPLATE_PATH', dirname( __FILE__ ) . '/components/templates-parts/' );
define( 'ASSETS_PATH', get_stylesheet_directory_uri() . '/assets' );
define( 'JS_PATH', get_stylesheet_directory_uri() . '/assets/js' );
define( 'STYLES_PATH', get_stylesheet_directory_uri() . '/assets/css' );
define( 'FONTS_PATH', get_stylesheet_directory_uri() . '/assets/fonts' );
define( 'IMG_PATH', get_stylesheet_directory_uri() . '/assets/img' );
define( 'FAV_PATH', get_stylesheet_directory_uri() . '/assets' );
define( 'FAV_DIR', get_template_directory() . '/assets' );
define( 'JS_DIR', get_template_directory() . '/assets/js' );
define( 'STYLES_DIR', get_template_directory() . '/assets/css' );

require_once FUNC_PATH . 'setup.php';
require_once FUNC_PATH . 'cleanup.php';
require_once FUNC_PATH . 'enqueue.php';
require_once FUNC_PATH . 'helpers.php';
require_once FUNC_PATH . 'integrations.php';
