<?php
/**
 * Theme helpers: URLs, assets, settings output, navigation.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Internal path URL with trailing slash (except home).
 *
 * @param string $path Site path beginning with /.
 * @return string Escaped URL.
 */
function shc_url( $path ) {
	if ( '/' === $path || '' === $path ) {
		return esc_url( home_url( '/' ) );
	}
	$path = '/' . ltrim( $path, '/' );
	return esc_url( trailingslashit( home_url( $path ) ) );
}

/**
 * Theme asset URI under /assets/.
 *
 * @param string $path Path relative to assets/, e.g. img/foo.webp.
 * @return string Escaped URL.
 */
function shc_asset( $path ) {
	return esc_url( get_stylesheet_directory_uri() . '/assets/' . ltrim( $path, '/' ) );
}

/**
 * Current request path (leading slash, trailing slash).
 *
 * @return string
 */
function shc_current_path() {
	if ( is_front_page() ) {
		return '/';
	}
	if ( is_page() ) {
		$uri = get_page_uri( get_queried_object_id() );
		return '/' . trim( (string) $uri, '/' ) . '/';
	}
	return '/';
}

/**
 * Normalise a nav href for comparison.
 *
 * @param string $href Path or URL.
 * @return string
 */
function shc_normalise_path( $href ) {
	$path = wp_parse_url( $href, PHP_URL_PATH );
	if ( null === $path || false === $path ) {
		$path = $href;
	}
	if ( '/' === $path || '' === $path ) {
		return '/';
	}
	return '/' . trim( $path, '/' ) . '/';
}

/**
 * Whether a nav href matches the current page.
 *
 * @param string $href Internal path like /contact/.
 * @return bool
 */
function shc_nav_is_current( $href ) {
	$current = shc_current_path();
	$target  = shc_normalise_path( $href );
	if ( $current === $target ) {
		return true;
	}
	$section_roots = array( '/about/', '/contact/', '/professionals/', '/work-with-us/', '/stories/' );
	if ( in_array( $target, $section_roots, true ) && 0 === strpos( $current, $target ) ) {
		return true;
	}
	return false;
}

/**
 * Whether the Services mega toggle should show is-current.
 *
 * @return bool
 */
function shc_nav_services_is_current() {
	$path = shc_current_path();
	return 0 === strpos( $path, '/adult-care-at-home/' )
		|| '/adult-care-at-home/' === $path
		|| 0 === strpos( $path, '/supported-accommodation/' )
		|| '/supported-accommodation/' === $path;
}

/**
 * aria-current="page" attribute for nav links.
 *
 * @param string $href Internal path.
 * @return string Empty or attribute fragment.
 */
function shc_nav_current_attr( $href ) {
	return shc_nav_is_current( $href ) ? ' aria-current="page"' : '';
}

/**
 * Setting value from options.
 *
 * @param string $key Setting key.
 * @return string
 */
function shc_setting( $key ) {
	$options = get_option( 'shc_settings', array() );
	if ( ! is_array( $options ) ) {
		return '';
	}
	return isset( $options[ $key ] ) ? (string) $options[ $key ] : '';
}

/**
 * tel: href from stored phone display value.
 *
 * @return string
 */
function shc_phone_href() {
	$phone = shc_setting( 'phone' );
	if ( '' === $phone ) {
		return '#';
	}
	$digits = preg_replace( '/[^\d+]/', '', $phone );
	return 'tel:' . $digits;
}

/**
 * Echo formatted phone for display, or yellow placeholder.
 */
function shc_echo_phone() {
	$phone = shc_setting( 'phone' );
	if ( '' !== $phone ) {
		echo esc_html( $phone );
		return;
	}
	echo '<span class="placeholder-inline">[phone number]</span>';
}

/**
 * Echo email link or placeholder.
 */
function shc_echo_email_link() {
	$email = shc_setting( 'email' );
	if ( '' !== $email ) {
		printf(
			'<a href="mailto:%1$s">%2$s</a>',
			esc_attr( $email ),
			esc_html( $email )
		);
		return;
	}
	echo '<span class="placeholder-inline">[email address]</span>';
}

/**
 * Echo office address or placeholder (allows simple line breaks).
 */
function shc_echo_address() {
	$address = shc_setting( 'office_address' );
	if ( '' !== $address ) {
		echo nl2br( esc_html( $address ) );
		return;
	}
	echo '<span class="placeholder-inline">[Office address]</span>';
}

/**
 * Social URL from settings or empty string.
 *
 * @param string $key Setting key.
 * @return string
 */
function shc_social_url( $key ) {
	$url = shc_setting( $key );
	if ( '' === $url ) {
		return '';
	}
	return esc_url( $url );
}

/**
 * Google Maps URL with fallback to provided address.
 *
 * @return string
 */
function shc_map_url() {
	$url = shc_setting( 'google_map_url' );
	if ( '' !== $url ) {
		return esc_url( $url );
	}
	return 'https://maps.google.com/?q=201+Hamlet+Ct+Rd%2C+Westcliff-on-Sea%2C+Southend-on-Sea%2C+Westcliff-on-Sea+SS0+7EL%2C+United+Kingdom';
}

/**
 * Echo company number or placeholder.
 */
function shc_echo_company_number() {
	$num = shc_setting( 'company_number' );
	if ( '' !== $num ) {
		echo esc_html( $num );
		return;
	}
	echo '<span class="placeholder-inline">[company number]</span>';
}

/**
 * CQC report URL or empty.
 *
 * @return string
 */
function shc_cqc_url() {
	return shc_setting( 'cqc_url' );
}

/**
 * CQC URL for links (falls back when setting not yet saved).
 *
 * @return string
 */
function shc_cqc_url_or_default() {
	$url = shc_cqc_url();
	if ( '' !== $url ) {
		return $url;
	}
	return 'https://www.cqc.org.uk/location/1-6575573200';
}

/**
 * Echo CQC publication date or placeholder inline.
 */
function shc_echo_cqc_date() {
	$date = shc_setting( 'cqc_publication_date' );
	if ( '' !== $date ) {
		echo esc_html( $date );
		return;
	}
	echo '<span class="placeholder-inline">[CQC publication date]</span>';
}

/**
 * Echo office hours placeholder block.
 */
function shc_echo_office_hours() {
	$hours = shc_setting( 'office_hours' );
	if ( '' !== $hours ) {
		echo esc_html( $hours );
		return;
	}
	echo '<span class="placeholder-inline">[e.g. Monday to Friday, 9am to 5pm]</span>';
}

/**
 * Echo out-of-hours text or placeholder.
 */
function shc_echo_out_of_hours() {
	$text = shc_setting( 'out_of_hours' );
	if ( '' !== $text ) {
		echo esc_html( $text );
		return;
	}
	echo '<span class="placeholder-inline">[Out of hours wording approved by Operations]</span>';
}

/**
 * Whether SA availability notice should display.
 *
 * @return bool
 */
/**
 * Echo SA availability status or placeholder.
 */
function shc_echo_sa_availability_status() {
	$status = shc_setting( 'sa_availability_status' );
	if ( '' !== $status ) {
		echo esc_html( $status );
		return;
	}
	echo '<span class="placeholder-inline">[status set by the Supported Accommodation lead]</span>';
}

/**
 * Echo SA availability updated date or placeholder.
 */
function shc_echo_sa_availability_updated() {
	$date = shc_setting( 'sa_availability_updated' );
	if ( '' !== $date ) {
		echo esc_html( $date );
		return;
	}
	echo '<span class="placeholder-inline">[date]</span>';
}

function shc_sa_notice_visible() {
	$expiry = shc_setting( 'sa_availability_expiry' );
	if ( '' === $expiry ) {
		return true;
	}
	$ts = strtotime( $expiry );
	if ( false === $ts ) {
		return true;
	}
	return time() < $ts;
}

/**
 * Document title override stack.
 *
 * @var string
 */
$shc_document_title = '';

/**
 * Set document <title> (in addition to meta description / body class).
 *
 * @param string $title Full document title.
 */
function shc_set_document_title( $title ) {
	global $shc_document_title;
	$shc_document_title = (string) $title;
}

/**
 * Filter document title when set by template.
 *
 * @param string $title Title.
 * @return string
 */
function shc_document_title_filter( $title ) {
	global $shc_document_title;
	if ( '' !== $shc_document_title ) {
		return $shc_document_title;
	}
	return $title;
}
add_filter( 'pre_get_document_title', 'shc_document_title_filter', 20 );

/**
 * Allowed enquiry service values (must match form options and main.js).
 *
 * @return string[]
 */
function shc_allowed_enquiry_services() {
	return array(
		'domcare',
		'live-in',
		'respite',
		'dementia',
		'palliative',
		'companionship',
		'supported-accommodation',
		'unsure',
	);
}

/**
 * Get current service slug when on a service template.
 *
 * @return string|null
 */
function shc_current_service_slug() {
	if ( ! is_page() ) {
		return null;
	}
	$uri = trim( (string) get_page_uri( get_queried_object_id() ), '/' );
	if ( preg_match( '#^adult-care-at-home/([^/]+)$#', $uri, $m ) ) {
		return $m[1];
	}
	return null;
}

/**
 * Load service definition for current page.
 *
 * @return array|null
 */
function shc_get_current_service() {
	$slug = shc_current_service_slug();
	if ( null === $slug ) {
		return null;
	}
	$services = shc_get_services();
	return isset( $services[ $slug ] ) ? $services[ $slug ] : null;
}

/**
 * Top-level ancestor page ID for sidebar navigation.
 *
 * @param int $post_id Page ID.
 * @return int
 */
function shc_section_root_id( $post_id ) {
	$post = get_post( $post_id );
	if ( ! $post ) {
		return 0;
	}
	$root = $post;
	while ( $root->post_parent ) {
		$parent = get_post( $root->post_parent );
		if ( ! $parent ) {
			break;
		}
		$root = $parent;
	}
	return (int) $root->ID;
}
