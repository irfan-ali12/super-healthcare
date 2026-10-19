<?php
/**
 * Theme helpers: URLs, assets, settings output, navigation and shared UI.
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
	$hash  = '';
	$query = '';
	if ( false !== strpos( $path, '#' ) ) {
		list( $path, $hash ) = explode( '#', $path, 2 );
		$hash                = '#' . $hash;
	}
	if ( false !== strpos( $path, '?' ) ) {
		list( $path, $query ) = explode( '?', $path, 2 );
		$query                = '?' . $query;
	}
	$path = '/' . trim( $path, '/' ) . '/';
	return esc_url( home_url( $path ) . $query . $hash );
}

/**
 * Theme asset URI under /assets/.
 *
 * @param string $path Path relative to assets/, e.g. img/foo.webp.
 * @return string Escaped URL.
 */
function shc_asset( $path ) {
	$path = ltrim( $path, '/' );
	$file = SHC_THEME_DIR . '/assets/' . $path;
	$url  = get_stylesheet_directory_uri() . '/assets/' . $path;

	if ( is_file( $file ) ) {
		$modified = filemtime( $file );
		if ( false !== $modified ) {
			$url = add_query_arg( 'ver', (string) $modified, $url );
		}
	}

	return esc_url( $url );
}

/**
 * Current request path (leading and trailing slash).
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
 * Whether the current page is the given path or inside it.
 *
 * @param string $prefix Path like /care-at-home/.
 * @return bool
 */
function shc_in_section( $prefix ) {
	$prefix = '/' . trim( $prefix, '/' ) . '/';
	return 0 === strpos( shc_current_path(), $prefix );
}

/**
 * aria-current="page" for nav links (exact page or section).
 *
 * @param string $href Internal path.
 * @return string
 */
function shc_nav_current_attr( $href ) {
	return shc_in_section( $href ) ? ' aria-current="page"' : '';
}

/**
 * Setting value, falling back to the verified default.
 *
 * @param string $key Setting key.
 * @return string
 */
function shc_setting( $key ) {
	$options = get_option( 'shc_settings', array() );
	if ( is_array( $options ) && isset( $options[ $key ] ) && '' !== trim( (string) $options[ $key ] ) ) {
		return (string) $options[ $key ];
	}
	$defaults = shc_setting_defaults();
	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/**
 * Display phone number.
 *
 * @return string
 */
function shc_phone() {
	return shc_setting( 'phone' );
}

/**
 * tel: href from the stored phone value.
 *
 * @return string
 */
function shc_phone_href() {
	$digits = preg_replace( '/[^\d+]/', '', shc_phone() );
	return '' === $digits ? '#' : 'tel:' . $digits;
}

/**
 * Echo the phone number (escaped).
 */
function shc_echo_phone() {
	echo esc_html( shc_phone() );
}

/**
 * Phone icon SVG.
 *
 * @param int $size Pixel size.
 * @return string
 */
function shc_phone_icon( $size = 18 ) {
	return sprintf(
		'<svg aria-hidden="true" viewBox="0 0 24 24" width="%1$d" height="%1$d"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg>',
		(int) $size
	);
}

/**
 * Echo an email link.
 */
function shc_echo_email_link() {
	$email = shc_setting( 'email' );
	if ( '' === $email ) {
		return;
	}
	printf( '<a href="mailto:%1$s" data-track="email_click">%2$s</a>', esc_attr( $email ), esc_html( $email ) );
}

/**
 * Echo office address with line breaks, or on one line.
 *
 * @param bool $one_line Join lines with commas.
 */
function shc_echo_address( $one_line = false ) {
	$address = shc_setting( 'office_address' );
	if ( $one_line ) {
		echo esc_html( preg_replace( '/\s*\n\s*/', ', ', trim( $address ) ) );
		return;
	}
	echo nl2br( esc_html( $address ) );
}

/**
 * Social URL or empty string.
 *
 * @param string $key Setting key.
 * @return string
 */
function shc_social_url( $key ) {
	$url = shc_setting( $key );
	return '' === $url ? '' : esc_url( $url );
}

/**
 * Google Maps URL.
 *
 * @return string
 */
function shc_map_url() {
	return esc_url( shc_setting( 'google_map_url' ) );
}

/**
 * Echo the company number.
 */
function shc_echo_company_number() {
	echo esc_html( shc_setting( 'company_number' ) );
}

/**
 * CQC profile URL.
 *
 * @return string
 */
function shc_cqc_url() {
	return shc_setting( 'cqc_url' );
}

/**
 * Back-compat alias used by 1.x templates.
 *
 * @return string
 */
function shc_cqc_url_or_default() {
	return shc_cqc_url();
}

/**
 * CQC report URL for a service.
 *
 * @param string $service supported_living|homecare.
 * @return string
 */
function shc_cqc_report_url( $service ) {
	$url = shc_setting( 'cqc_report_url_' . $service );
	return '' !== $url ? $url : shc_cqc_url();
}

/**
 * CQC publication date for a service.
 *
 * @param string $service supported_living|homecare.
 * @return string
 */
function shc_cqc_date( $service ) {
	return shc_setting( 'cqc_date_' . $service );
}

/**
 * Response commitment sentence, or empty string.
 *
 * @return string
 */
function shc_response_commitment() {
	return shc_setting( 'response_commitment' );
}

/**
 * Supported Living availability notice data, or null when not set or expired.
 *
 * @return array{status: string, updated: string}|null
 */
function shc_sl_availability() {
	$status = shc_setting( 'sl_availability_status' );
	if ( '' === $status ) {
		return null;
	}
	$expiry = shc_setting( 'sl_availability_expiry' );
	if ( '' !== $expiry ) {
		$ts = strtotime( $expiry . ' 23:59:59' );
		if ( false !== $ts && time() > $ts ) {
			return null;
		}
	}
	return array(
		'status'  => $status,
		'updated' => shc_setting( 'sl_availability_updated' ),
	);
}

/*
 * ------------------------------------------------------------------
 * Document title and meta, set by each template before the head loads.
 * ------------------------------------------------------------------
 */

$GLOBALS['shc_document_title']   = '';
$GLOBALS['shc_page_description'] = '';
$GLOBALS['shc_body_class']       = '';
$GLOBALS['shc_page_context']     = '';

/**
 * Set per-page meta description and body class.
 *
 * @param string $description Meta description.
 * @param string $body_class  Extra body class.
 */
function shc_set_document_meta( $description, $body_class = '' ) {
	$GLOBALS['shc_page_description'] = (string) $description;
	$GLOBALS['shc_body_class']       = (string) $body_class;
}

/**
 * Meta description for the current document.
 *
 * @return string
 */
function shc_page_description() {
	return (string) $GLOBALS['shc_page_description'];
}

/**
 * Set the document title.
 *
 * @param string $title Full document title.
 */
function shc_set_document_title( $title ) {
	$GLOBALS['shc_document_title'] = (string) $title;
}

/**
 * Set page context used by the mobile action bar (e.g. "referrals").
 *
 * @param string $context Context key.
 */
function shc_set_page_context( $context ) {
	$GLOBALS['shc_page_context'] = (string) $context;
}

/**
 * Current page context.
 *
 * @return string
 */
function shc_page_context() {
	return (string) $GLOBALS['shc_page_context'];
}

/**
 * Filter the document title when a template has set one.
 *
 * @param string $title Title.
 * @return string
 */
function shc_document_title_filter( $title ) {
	return '' !== $GLOBALS['shc_document_title'] ? $GLOBALS['shc_document_title'] : $title;
}
add_filter( 'pre_get_document_title', 'shc_document_title_filter', 20 );

/**
 * Append template body class.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function shc_filter_body_class( $classes ) {
	if ( '' !== $GLOBALS['shc_body_class'] ) {
		$classes[] = $GLOBALS['shc_body_class'];
	}
	return $classes;
}
add_filter( 'body_class', 'shc_filter_body_class' );

/*
 * ------------------------------------------------------------------
 * Enquiries
 * ------------------------------------------------------------------
 */

/**
 * Enquiry service options: value => label, grouped.
 *
 * @return array<string, array<string, string>>
 */
function shc_enquiry_service_groups() {
	return array(
		'Care at Home'     => array(
			'domcare'       => 'DomCare (visiting care)',
			'live-in'       => 'Live-in Care',
			'respite'       => 'Respite Care',
			'dementia'      => 'Dementia Care',
			'palliative'    => 'Palliative Care',
			'companionship' => 'Companionship',
		),
		'Supported Living' => array(
			'supported-living' => 'Supported Living (adults 18+)',
		),
		'Professionals'    => array(
			'referral' => 'Professional referral',
		),
		''                 => array(
			'unsure' => 'I’m not sure yet',
		),
	);
}

/**
 * Allowed enquiry service values.
 *
 * @return string[]
 */
function shc_allowed_enquiry_services() {
	$values = array();
	foreach ( shc_enquiry_service_groups() as $group ) {
		$values = array_merge( $values, array_keys( $group ) );
	}
	return $values;
}

/**
 * Label for an enquiry service value.
 *
 * @param string $value Service value.
 * @return string
 */
function shc_enquiry_service_label( $value ) {
	foreach ( shc_enquiry_service_groups() as $group ) {
		if ( isset( $group[ $value ] ) ) {
			return $group[ $value ];
		}
	}
	return $value;
}

/*
 * ------------------------------------------------------------------
 * Care at Home service pages
 * ------------------------------------------------------------------
 */

/**
 * Service slug when on a Care at Home service page.
 *
 * @return string|null
 */
function shc_current_service_slug() {
	if ( ! is_page() ) {
		return null;
	}
	$uri = trim( (string) get_page_uri( get_queried_object_id() ), '/' );
	if ( preg_match( '#^care-at-home/([^/]+)$#', $uri, $m ) ) {
		return $m[1];
	}
	return null;
}

/**
 * Service definition for the current page.
 *
 * @return array<string, mixed>|null
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
 * Top-level ancestor page ID.
 *
 * @param int $post_id Page ID.
 * @return int
 */
function shc_section_root_id( $post_id ) {
	$ancestors = get_post_ancestors( $post_id );
	return $ancestors ? (int) end( $ancestors ) : (int) $post_id;
}

/*
 * ------------------------------------------------------------------
 * Shared UI
 * ------------------------------------------------------------------
 */

/**
 * Breadcrumb markup plus BreadcrumbList JSON-LD.
 *
 * @param array<int, array{0: string, 1: string}> $trail Pairs of [label, path]; last item is the current page.
 */
function shc_breadcrumb( $trail ) {
	$items = array_merge( array( array( 'Home', '/' ) ), $trail );
	$count = count( $items );
	$list  = array();
	echo '<nav class="breadcrumb container" aria-label="Breadcrumb"><ol>';
	foreach ( $items as $i => $item ) {
		$url     = shc_url( $item[1] );
		$current = ( $i === $count - 1 ) ? ' aria-current="page"' : '';
		printf( '<li><a href="%1$s"%2$s>%3$s</a></li>', $url, $current, esc_html( $item[0] ) );
		$list[] = array(
			'@type'    => 'ListItem',
			'position' => $i + 1,
			'name'     => $item[0],
			'item'     => html_entity_decode( $url ),
		);
	}
	echo '</ol></nav>';
	printf(
		'<script type="application/ld+json">%s</script>',
		wp_json_encode(
			array(
				'@context'        => 'https://schema.org',
				'@type'           => 'BreadcrumbList',
				'itemListElement' => $list,
			),
			JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
		)
	);
}

/**
 * Final call-to-action band.
 *
 * @param array<string, string> $args title, text, button, href, track.
 */
function shc_cta_band( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'title'  => 'Not sure what support you need?',
			'text'   => 'Speak to our team. We will listen, explain your options and help you decide on the next step.',
			'button' => 'Get support',
			'href'   => shc_url( '/contact/' ) . '#enquiry-form',
			'track'  => 'cta_get_support',
		)
	);
	?>
<section class="cta-band" aria-labelledby="cta-title">
  <div class="container cta-inner">
    <div class="cta-copy">
      <h2 id="cta-title"><?php echo esc_html( $args['title'] ); ?></h2>
      <?php if ( '' !== $args['text'] ) : ?><p><?php echo esc_html( $args['text'] ); ?></p><?php endif; ?>
    </div>
    <div class="cta-actions">
      <a class="btn btn--white" href="<?php echo esc_url( $args['href'] ); ?>" data-track="<?php echo esc_attr( $args['track'] ); ?>"><?php echo esc_html( $args['button'] ); ?></a>
      <a class="cta-phone" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php echo shc_phone_icon( 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span>Call <?php shc_echo_phone(); ?></span></a>
    </div>
  </div>
</section>
	<?php
}

/**
 * Small CQC rated Good seal.
 *
 * @param string $class Extra classes.
 */
function shc_cqc_seal( $class = '' ) {
	printf(
		'<a class="cqc-seal %1$s" href="%2$s" target="_blank" rel="noopener" data-track="cqc_click"><span class="cqc-seal-small">CQC rated</span><span class="cqc-seal-big">Good</span><span class="visually-hidden">(opens the CQC profile in a new tab)</span></a>',
		esc_attr( $class ),
		esc_url( shc_cqc_url() )
	);
}

/**
 * homecare.co.uk review score seal (hidden when no score is set).
 *
 * @param string $class Extra classes.
 */
function shc_homecare_seal( $class = '' ) {
	$score = shc_setting( 'homecare_score' );
	if ( '' === $score ) {
		return;
	}
	printf(
		'<a class="score-seal %1$s" href="%2$s" target="_blank" rel="noopener" data-track="homecare_click"><span class="score-seal-big">%3$s</span><span class="score-seal-small">out of 10</span><span class="score-seal-src">homecare.co.uk</span><span class="visually-hidden">(opens our homecare.co.uk reviews in a new tab)</span></a>',
		esc_attr( $class ),
		esc_url( shc_setting( 'homecare_url' ) ),
		esc_html( $score )
	);
}

/**
 * The five CQC key questions.
 *
 * @return string[]
 */
function shc_cqc_key_questions() {
	return array( 'Safe', 'Effective', 'Caring', 'Responsive', 'Well-led' );
}
