<?php
/**
 * Central image registry: one place for file, size, alt text and focal point.
 *
 * Real photography (assets/img/photos) comes from the client's new-images folder.
 * AI imagery (assets/img/ai) comes from the client's approved infographic,
 * upscaled for web use. Homepage hero images can be replaced in
 * Settings > Super Healthcare without touching code.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Image definitions keyed by slug.
 *
 * dir:  photos | ai
 * w/h:  intrinsic size of the 1600 variant (used for width/height attributes)
 * pos:  CSS object-position focal point
 *
 * @return array<string, array<string, mixed>>
 */
function shc_get_images() {
	return array(
		// AI imagery (client-supplied infographic, upscaled). Used on the homepage.
		'ai-hero-care-at-home'                => array( 'dir' => 'ai', 'w' => 1600, 'h' => 750, 'pos' => '50% 40%', 'alt' => 'An older man laughing over a cup of tea with his carer in his living room' ),
		'ai-live-in'                          => array( 'dir' => 'ai', 'w' => 1052, 'h' => 572, 'pos' => '50% 35%', 'alt' => 'An older man and his carer smiling together in a garden' ),
		'ai-respite'                          => array( 'dir' => 'ai', 'w' => 1052, 'h' => 572, 'pos' => '50% 35%', 'alt' => 'An older woman holding a mug and chatting with her carer on the sofa' ),
		'ai-dementia'                         => array( 'dir' => 'ai', 'w' => 1052, 'h' => 572, 'pos' => '50% 30%', 'alt' => 'An older man in a flat cap walking outdoors with his carer' ),
		'ai-palliative'                       => array( 'dir' => 'ai', 'w' => 1052, 'h' => 572, 'pos' => '50% 30%', 'alt' => 'A carer sitting close beside an older woman at home' ),

		// Care at Home (real).
		'carer-helping-client-shopping'       => array( 'dir' => 'photos', 'w' => 1086, 'h' => 1448, 'pos' => '45% 45%', 'alt' => 'A carer helping a man on a mobility scooter choose a card in a local shop' ),
		'live-in-carers-with-client'          => array( 'dir' => 'photos', 'w' => 1600, 'h' => 1200, 'pos' => '60% 35%', 'alt' => 'Two carers smiling with a man they support on a day out' ),
		'carer-walking-with-client-seafront'  => array( 'dir' => 'photos', 'w' => 1200, 'h' => 1600, 'pos' => '50% 60%', 'alt' => 'A carer walking arm in arm with an older man along the seafront' ),
		'carer-with-client-mobility-scooter'  => array( 'dir' => 'photos', 'w' => 1200, 'h' => 1600, 'pos' => '45% 60%', 'alt' => 'A carer walking alongside a man on his mobility scooter' ),
		'carer-and-client-outing'             => array( 'dir' => 'photos', 'w' => 1200, 'h' => 1599, 'pos' => '50% 30%', 'alt' => 'A carer and an older woman smiling together on an outing' ),
		'companionship-lunch-out'             => array( 'dir' => 'photos', 'w' => 1600, 'h' => 1200, 'pos' => '50% 35%', 'alt' => 'A carer and a woman sharing lunch at a restaurant' ),

		// Community and outings (real).
		'client-cinema-trip'                  => array( 'dir' => 'photos', 'w' => 1536, 'h' => 2048, 'pos' => '50% 55%', 'alt' => 'A woman at the cinema in front of a film poster' ),
		'client-cafe-visit'                   => array( 'dir' => 'photos', 'w' => 1148, 'h' => 2040, 'pos' => '50% 25%', 'alt' => 'A woman enjoying a meal at a cafe' ),
		'client-garden-centre-visit'          => array( 'dir' => 'photos', 'w' => 1600, 'h' => 1200, 'pos' => '50% 45%', 'alt' => 'A woman standing among colourful flower displays on a day out' ),
		'client-seafront-pier'                => array( 'dir' => 'photos', 'w' => 1536, 'h' => 2048, 'pos' => '55% 40%', 'alt' => 'A woman enjoying the view on the seafront near the big wheel' ),
		'client-seafront-gardens'             => array( 'dir' => 'photos', 'w' => 1536, 'h' => 2048, 'pos' => '50% 45%', 'alt' => 'A woman on a garden path beside a flower-covered railing' ),
		'friends-lunch-out'                   => array( 'dir' => 'photos', 'w' => 1600, 'h' => 2133, 'pos' => '50% 55%', 'alt' => 'Two women having lunch together at a burger restaurant' ),
		'client-evening-out'                  => array( 'dir' => 'photos', 'w' => 1536, 'h' => 2048, 'pos' => '50% 45%', 'alt' => 'A man in a wheelchair waving on an evening out with a member of staff' ),
		'halloween-celebration'               => array( 'dir' => 'photos', 'w' => 1200, 'h' => 1600, 'pos' => '50% 55%', 'alt' => 'People in Halloween costumes celebrating together on a sofa' ),
		'birthday-celebration-with-carers'    => array( 'dir' => 'photos', 'w' => 1200, 'h' => 1600, 'pos' => '50% 40%', 'alt' => 'Two carers giving a thumbs up with a man celebrating his birthday' ),

		// Supported Living (real).
		'supported-living-ice-cream-seafront' => array( 'dir' => 'photos', 'w' => 1600, 'h' => 900, 'pos' => '28% 55%', 'alt' => 'A member of staff and a man enjoying ice creams at the seafront' ),
		'supported-living-day-out'            => array( 'dir' => 'photos', 'w' => 1152, 'h' => 2048, 'pos' => '50% 45%', 'alt' => 'A member of staff and a man smiling on a day out by the sea' ),
		'supported-living-birthday'           => array( 'dir' => 'photos', 'w' => 1536, 'h' => 2048, 'pos' => '50% 50%', 'alt' => 'A woman celebrating her birthday at home with a cake and cards' ),
		'home-kitchen'                        => array( 'dir' => 'photos', 'w' => 1448, 'h' => 1086, 'pos' => '50% 50%', 'alt' => 'A bright shared kitchen with fridges, worktops and a door to the garden' ),
		'home-dining-area'                    => array( 'dir' => 'photos', 'w' => 1448, 'h' => 1086, 'pos' => '50% 55%', 'alt' => 'A dining table with chairs in a light, open-plan room' ),
		'home-lounge'                         => array( 'dir' => 'photos', 'w' => 1448, 'h' => 1086, 'pos' => '50% 55%', 'alt' => 'A comfortable lounge with sofas, a rug and a television' ),
		'home-garden'                         => array( 'dir' => 'photos', 'w' => 1448, 'h' => 1086, 'pos' => '50% 55%', 'alt' => 'A garden with a lawn, potted plants and a seating area' ),
		'home-garden-seating'                 => array( 'dir' => 'photos', 'w' => 1448, 'h' => 1086, 'pos' => '50% 60%', 'alt' => 'An outdoor table and chairs under a parasol in the garden' ),

		// Team (real).
		'team-christmas'                      => array( 'dir' => 'photos', 'w' => 1448, 'h' => 1086, 'pos' => '50% 40%', 'alt' => 'The Super Healthcare team together at a Christmas celebration' ),
		'team-office'                         => array( 'dir' => 'photos', 'w' => 1086, 'h' => 1448, 'pos' => '50% 55%', 'alt' => 'Members of the Super Healthcare team in the office' ),
		'team-social'                         => array( 'dir' => 'photos', 'w' => 1600, 'h' => 1200, 'pos' => '50% 45%', 'alt' => 'Super Healthcare staff smiling together at a team social' ),
		'team-summer'                         => array( 'dir' => 'photos', 'w' => 1600, 'h' => 1200, 'pos' => '50% 40%', 'alt' => 'Super Healthcare staff together at a summer gathering' ),
		'staff-moving-and-handling-training'  => array( 'dir' => 'photos', 'w' => 1200, 'h' => 1600, 'pos' => '50% 40%', 'alt' => 'Staff practising safe moving and handling with a hoist during training' ),
		'staff-classroom-training'            => array( 'dir' => 'photos', 'w' => 1600, 'h' => 1200, 'pos' => '50% 50%', 'alt' => 'Staff taking part in a classroom training session' ),
	);
}

/**
 * Image definition or null.
 *
 * @param string $key Image key.
 * @return array<string, mixed>|null
 */
function shc_get_image( $key ) {
	$images = shc_get_images();
	return isset( $images[ $key ] ) ? $images[ $key ] : null;
}

/**
 * Build an <img> tag with srcset for a registered image.
 *
 * @param string               $key  Image key.
 * @param array<string, mixed> $args class, sizes, loading (lazy|eager), priority (bool), alt (override, '' for decorative).
 * @return string
 */
function shc_img( $key, $args = array() ) {
	$img = shc_get_image( $key );
	if ( ! $img ) {
		return '';
	}
	$args = wp_parse_args(
		$args,
		array(
			'class'    => '',
			'sizes'    => '(max-width: 900px) 100vw, 50vw',
			'loading'  => 'lazy',
			'priority' => false,
			'alt'      => null,
		)
	);

	$base   = 'img/' . $img['dir'] . '/' . $key;
	$files  = array(
		array(
			'path'  => $base . '-800.webp',
			'width' => 800,
		),
		array(
			'path'  => $base . '-1600.webp',
			'width' => (int) $img['w'],
		),
		array(
			'path'  => $base . '.webp',
			'width' => (int) $img['w'],
		),
	);
	$sources = array();
	foreach ( $files as $file ) {
		if ( is_file( SHC_THEME_DIR . '/assets/' . $file['path'] ) ) {
			$sources[] = array(
				'url'   => shc_asset( $file['path'] ),
				'width' => $file['width'],
			);
		}
	}
	if ( empty( $sources ) ) {
		return '';
	}

	$w      = (int) $img['w'];
	$h      = (int) $img['h'];
	$alt    = null === $args['alt'] ? $img['alt'] : (string) $args['alt'];
	$srcset = implode(
		', ',
		array_map(
			static function ( $source ) {
				return sprintf( '%1$s %2$dw', $source['url'], $source['width'] );
			},
			$sources
		)
	);

	$attrs = sprintf(
		'src="%1$s" srcset="%2$s" sizes="%3$s" width="%4$d" height="%5$d" alt="%6$s" style="object-position:%7$s"',
		$sources[0]['url'],
		esc_attr( $srcset ),
		esc_attr( $args['sizes'] ),
		$w,
		$h,
		esc_attr( $alt ),
		esc_attr( $img['pos'] )
	);
	if ( $args['class'] ) {
		$attrs .= ' class="' . esc_attr( $args['class'] ) . '"';
	}
	if ( $args['priority'] ) {
		$attrs .= ' fetchpriority="high" loading="eager"';
	} else {
		$attrs .= ' loading="' . esc_attr( $args['loading'] ) . '" decoding="async"';
	}
	return '<img ' . $attrs . '>';
}

/**
 * Homepage hero image: an image chosen in Settings, or the registry default.
 *
 * @param string $which care|living.
 * @return string <img> markup.
 */
function shc_hero_img( $which ) {
	$custom_url = shc_setting( 'hero_image_' . $which );
	$custom_alt = shc_setting( 'hero_image_' . $which . '_alt' );
	$sizes      = '(max-width: 900px) 100vw, 50vw';

	if ( '' !== $custom_url ) {
		$id = attachment_url_to_postid( $custom_url );
		if ( $id ) {
			return wp_get_attachment_image(
				$id,
				'full',
				false,
				array(
					'class'         => 'hero-panel-img',
					'alt'           => '' !== $custom_alt ? $custom_alt : (string) get_post_meta( $id, '_wp_attachment_image_alt', true ),
					'sizes'         => $sizes,
					'fetchpriority' => 'high',
					'loading'       => 'eager',
				)
			);
		}
		return sprintf(
			'<img class="hero-panel-img" src="%1$s" alt="%2$s" fetchpriority="high" loading="eager">',
			esc_url( $custom_url ),
			esc_attr( $custom_alt )
		);
	}

	$default = 'care' === $which ? 'ai-hero-care-at-home' : 'home-lounge';
	return shc_img(
		$default,
		array(
			'class'    => 'hero-panel-img',
			'sizes'    => $sizes,
			'priority' => true,
		)
	);
}
