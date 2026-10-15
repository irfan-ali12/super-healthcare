<?php
/**
 * Super Healthcare child theme bootstrap.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

define( 'SHC_THEME_VERSION', '1.0.0' );
define( 'SHC_THEME_DIR', get_stylesheet_directory() );
define( 'SHC_THEME_URI', get_stylesheet_directory_uri() );

require SHC_THEME_DIR . '/inc/helpers.php';
require SHC_THEME_DIR . '/inc/icons.php';
require SHC_THEME_DIR . '/inc/services.php';
require SHC_THEME_DIR . '/inc/settings.php';
require SHC_THEME_DIR . '/inc/enquiry.php';
require SHC_THEME_DIR . '/inc/meta-box.php';
require SHC_THEME_DIR . '/inc/pages.php';

/**
 * Document meta set by each template before head is loaded.
 *
 * @var string
 */
$shc_page_description = '';

/**
 * Optional body class from static templates.
 *
 * @var string
 */
$shc_body_class = '';

/**
 * Set per-page meta description and optional theme body class.
 *
 * @param string $description Meta description content.
 * @param string $body_class  Extra body class from static source.
 */
function shc_set_document_meta( $description, $body_class = '' ) {
	global $shc_page_description, $shc_body_class;
	$shc_page_description = (string) $description;
	$shc_body_class         = (string) $body_class;
}

/**
 * Meta description for the current document.
 *
 * @return string
 */
function shc_page_description() {
	global $shc_page_description;
	return isset( $shc_page_description ) ? $shc_page_description : '';
}

/**
 * Append static theme body class.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function shc_filter_body_class( $classes ) {
	global $shc_body_class;
	if ( ! empty( $shc_body_class ) ) {
		$classes[] = $shc_body_class;
	}
	return $classes;
}
add_filter( 'body_class', 'shc_filter_body_class' );

/**
 * Service page slugs under Adult Care at Home.
 *
 * @return string[]
 */
function shc_get_service_slugs() {
	return array(
		'domcare',
		'live-in-care',
		'respite-care',
		'dementia-care',
		'palliative-care',
		'companionship',
	);
}

/**
 * Exact page URI (path) to template filename map.
 *
 * @return array<string, string>
 */
function shc_get_template_uri_map() {
	return array(
		'adult-care-at-home'              => 'template-hub.php',
		'supported-accommodation'         => 'template-supported.php',
		'contact'                         => 'template-contact.php',
		'contact/request-an-introduction' => 'template-contact.php',
	);
}

/**
 * Resolve the PHP template file for the current front-end request.
 *
 * @return string|null Template filename under /templates/, or null to use parent.
 */
function shc_resolve_template_file() {
	if ( is_front_page() ) {
		return 'front-page.php';
	}

	if ( ! is_page() ) {
		return null;
	}

	$page = get_queried_object();
	if ( ! $page instanceof WP_Post ) {
		return null;
	}

	$uri = trim( (string) get_page_uri( $page ), '/' );

	$map = shc_get_template_uri_map();
	if ( isset( $map[ $uri ] ) ) {
		return $map[ $uri ];
	}

	if ( preg_match( '#^adult-care-at-home/([^/]+)$#', $uri, $matches ) ) {
		if ( in_array( $matches[1], shc_get_service_slugs(), true ) ) {
			return 'template-service.php';
		}
	}

	return 'page.php';
}

/**
 * Whether the child theme shell applies.
 *
 * @return bool
 */
function shc_uses_theme_shell() {
	return null !== shc_resolve_template_file();
}

/**
 * Route pages to templates in /templates/.
 *
 * @param string $template Path to template file WordPress selected.
 * @return string
 */
function shc_template_include( $template ) {
	if ( is_admin() ) {
		return $template;
	}

	$file = shc_resolve_template_file();
	if ( null === $file ) {
		return $template;
	}

	$path = SHC_THEME_DIR . '/templates/' . $file;
	if ( is_readable( $path ) ) {
		return $path;
	}

	return $template;
}
add_filter( 'template_include', 'shc_template_include', 99 );

/**
 * Theme supports.
 */
function shc_theme_setup() {
	add_theme_support( 'title-tag' );
	load_theme_textdomain( 'super-healthcare', SHC_THEME_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'shc_theme_setup' );

/**
 * Google Fonts preconnect hints.
 *
 * @param array  $urls          URLs to print for relation type.
 * @param string $relation_type Relation type.
 * @return array
 */
function shc_resource_hints( $urls, $relation_type ) {
	if ( ! shc_uses_theme_shell() ) {
		return $urls;
	}
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'shc_resource_hints', 10, 2 );

/**
 * Enqueue theme assets; dequeue parent styles on routed templates.
 */
function shc_enqueue_assets() {
	if ( ! shc_uses_theme_shell() ) {
		return;
	}

	$css_path = SHC_THEME_DIR . '/assets/css/main.css';
	$js_path  = SHC_THEME_DIR . '/assets/js/main.js';

	wp_enqueue_style(
		'shc-google-fonts',
		'https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&family=Source+Serif+4:opsz,wght@8..60,600;8..60,700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'shc-main',
		SHC_THEME_URI . '/assets/css/main.css',
		array( 'shc-google-fonts' ),
		file_exists( $css_path ) ? (string) filemtime( $css_path ) : SHC_THEME_VERSION
	);

	wp_enqueue_script(
		'shc-main',
		SHC_THEME_URI . '/assets/js/main.js',
		array(),
		file_exists( $js_path ) ? (string) filemtime( $js_path ) : SHC_THEME_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'global-styles-inline' );
}
add_action( 'wp_enqueue_scripts', 'shc_enqueue_assets', 100 );

/**
 * Strip block library CSS that may be re-enqueued late.
 */
function shc_dequeue_parent_styles() {
	if ( ! shc_uses_theme_shell() ) {
		return;
	}
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_print_styles', 'shc_dequeue_parent_styles', 100 );
