<?php
/**
 * SEO output: meta description, Open Graph and organisation schema.
 *
 * WordPress core already provides the canonical URL, XML sitemap (wp-sitemap.xml)
 * and robots handling. No rating schema is output: the brief rules out star or
 * aggregate ratings derived from the CQC rating.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Open Graph and Twitter card tags on routed templates.
 */
function shc_output_social_meta() {
	if ( ! shc_uses_theme_shell() ) {
		return;
	}
	$title = wp_get_document_title();
	$desc  = shc_page_description();
	$url   = is_front_page() ? home_url( '/' ) : get_permalink();
	$image = get_stylesheet_directory_uri() . '/assets/img/og-image.jpg';

	$tags = array(
		'og:site_name'   => 'Super Healthcare',
		'og:type'        => 'website',
		'og:locale'      => 'en_GB',
		'og:title'       => $title,
		'og:description' => $desc,
		'og:url'         => $url,
		'og:image'       => $image,
	);
	foreach ( $tags as $property => $content ) {
		if ( '' === (string) $content ) {
			continue;
		}
		printf( '<meta property="%1$s" content="%2$s">' . "\n", esc_attr( $property ), esc_attr( $content ) );
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action( 'wp_head', 'shc_output_social_meta', 5 );

/**
 * Split the stored office address into schema parts (best effort).
 *
 * @return array<string, string>
 */
function shc_schema_address() {
	$lines = array_values( array_filter( array_map( 'trim', explode( "\n", shc_setting( 'office_address' ) ) ) ) );
	$addr  = array(
		'@type'          => 'PostalAddress',
		'addressCountry' => 'GB',
	);
	if ( empty( $lines ) ) {
		return $addr;
	}
	$addr['streetAddress'] = $lines[0];
	foreach ( array_slice( $lines, 1 ) as $line ) {
		if ( preg_match( '/^[A-Z]{1,2}\d[A-Z\d]?\s*\d[A-Z]{2}$/i', $line ) ) {
			$addr['postalCode'] = strtoupper( $line );
			continue;
		}
		$parts                   = array_map( 'trim', explode( ',', $line ) );
		$addr['addressLocality'] = $parts[0];
		if ( isset( $parts[1] ) ) {
			$addr['addressRegion'] = $parts[1];
		}
	}
	return $addr;
}

/**
 * LocalBusiness schema on the homepage and contact page.
 */
function shc_output_org_schema() {
	if ( ! is_front_page() && ! shc_in_section( '/contact/' ) ) {
		return;
	}
	$phone  = preg_replace( '/[^\d]/', '', shc_phone() );
	$logo   = get_stylesheet_directory_uri() . '/assets/img/new-images/superhealthcare-logo.jpg';
	$path   = SHC_THEME_DIR . '/assets/img/new-images/superhealthcare-logo.jpg';
	if ( is_file( $path ) ) {
		$modified = filemtime( $path );
		if ( false !== $modified ) {
			$logo = add_query_arg( 'ver', (string) $modified, $logo );
		}
	}
	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'LocalBusiness',
		'@id'         => home_url( '/#organisation' ),
		'name'        => 'Super Healthcare Ltd',
		'description' => 'Personalised care at home and supported living for adults in Westcliff-on-Sea and the surrounding area. Rated Good by the Care Quality Commission.',
		'url'         => home_url( '/' ),
		'logo'        => $logo,
		'image'       => get_stylesheet_directory_uri() . '/assets/img/og-image.jpg',
		'telephone'   => $phone ? '+44' . ltrim( $phone, '0' ) : '',
		'email'       => shc_setting( 'email' ),
		'address'     => shc_schema_address(),
		'identifier'  => array(
			'@type'      => 'PropertyValue',
			'propertyID' => 'Companies House company number',
			'value'      => shc_setting( 'company_number' ),
		),
		'sameAs'      => array_values(
			array_filter(
				array(
					shc_setting( 'facebook_url' ),
					shc_setting( 'instagram_url' ),
					shc_cqc_url(),
				)
			)
		),
	);
	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode( array_filter( $schema ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
	);
}
add_action( 'wp_head', 'shc_output_org_schema', 20 );
