<?php
/**
 * Page tree, one-time migration from theme 1.x, and 301 redirects.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Page tree: path => title. Parents must come before children.
 *
 * @return array<string, string>
 */
function shc_get_page_tree() {
	return array(
		'home'                            => 'Home',
		'care-at-home'                    => 'Care at Home',
		'care-at-home/domcare'            => 'DomCare',
		'care-at-home/live-in-care'       => 'Live-in Care',
		'care-at-home/respite-care'       => 'Respite Care',
		'care-at-home/dementia-care'      => 'Dementia Care',
		'care-at-home/palliative-care'    => 'Palliative Care',
		'care-at-home/companionship'      => 'Companionship',
		'supported-living'                => 'Supported Living',
		'referrals'                       => 'Referrals & Professional Partnerships',
		'our-community'                   => 'Our Community',
		'about-us'                        => 'About Us',
		'about-us/quality-and-cqc'        => 'Quality & CQC',
		'about-us/safeguarding'           => 'Safeguarding',
		'about-us/complaints'             => 'Complaints',
		'about-us/policies'               => 'Policies',
		'careers'                         => 'Careers',
		'contact'                         => 'Contact',
		'contact/request-an-introduction' => 'Request an introduction',
		'privacy'                         => 'Privacy notice',
		'cookies'                         => 'Cookies',
		'accessibility'                   => 'Accessibility statement',
	);
}

/**
 * Theme 1.x page paths renamed in place (keeps IDs and any editor content).
 * old path => array( new parent path or '', new slug, new title ).
 *
 * @return array<string, array{0: string, 1: string, 2: string}>
 */
function shc_v1_page_renames() {
	return array(
		'adult-care-at-home'        => array( '', 'care-at-home', 'Care at Home' ),
		'supported-accommodation'   => array( '', 'supported-living', 'Supported Living' ),
		'professionals'             => array( '', 'referrals', 'Referrals & Professional Partnerships' ),
		'stories'                   => array( '', 'our-community', 'Our Community' ),
		'about'                     => array( '', 'about-us', 'About Us' ),
		'about-us/cqc-and-quality'  => array( 'about-us', 'quality-and-cqc', 'Quality & CQC' ),
		'about-us/policies/complaints' => array( 'about-us', 'complaints', 'Complaints' ),
		'work-with-us'              => array( '', 'careers', 'Careers' ),
	);
}

/**
 * Theme 1.x pages that no longer exist in the structure (set to draft, never deleted).
 *
 * @return string[]
 */
function shc_v1_retired_paths() {
	return array(
		'supported-living/our-homes',
		'supported-living/life-skills',
		'supported-living/education-and-employment',
		'supported-living/referral-process',
		'supported-living/faqs',
		'supported-living/easy-read',
		'referrals/referral-form',
		'about-us/our-approach',
		'about-us/team',
		'careers/standards',
	);
}

/**
 * Rename and retire theme 1.x pages. Runs once.
 */
function shc_migrate_pages_v2() {
	if ( get_option( 'shc_pages_migrated_v2' ) ) {
		return;
	}
	foreach ( shc_v1_page_renames() as $old_path => $target ) {
		$page = get_page_by_path( $old_path, OBJECT, 'page' );
		if ( ! $page ) {
			continue;
		}
		list( $parent_path, $slug, $title ) = $target;
		$new_path                           = ( $parent_path ? $parent_path . '/' : '' ) . $slug;
		if ( get_page_by_path( $new_path, OBJECT, 'page' ) ) {
			continue; // Target already exists; leave the old page alone.
		}
		$parent = 0;
		if ( $parent_path ) {
			$p      = get_page_by_path( $parent_path, OBJECT, 'page' );
			$parent = $p ? (int) $p->ID : 0;
		}
		wp_update_post(
			array(
				'ID'          => $page->ID,
				'post_name'   => $slug,
				'post_title'  => $title,
				'post_parent' => $parent,
			)
		);
	}
	foreach ( shc_v1_retired_paths() as $path ) {
		$page = get_page_by_path( $path, OBJECT, 'page' );
		if ( $page && 'publish' === $page->post_status ) {
			wp_update_post(
				array(
					'ID'          => $page->ID,
					'post_status' => 'draft',
				)
			);
		}
	}
	// Leftover 1.x policies parent: keep it as About Us > Policies.
	update_option( 'shc_pages_migrated_v2', '1', false );
}

/**
 * Create any missing pages and set the static front page. Idempotent.
 *
 * @return string Summary message.
 */
function shc_create_pages() {
	shc_migrate_pages_v2();
	$created = 0;
	foreach ( shc_get_page_tree() as $path => $title ) {
		if ( get_page_by_path( $path, OBJECT, 'page' ) ) {
			continue;
		}
		$parts  = explode( '/', $path );
		$slug   = array_pop( $parts );
		$parent = 0;
		if ( $parts ) {
			$p      = get_page_by_path( implode( '/', $parts ), OBJECT, 'page' );
			$parent = $p ? (int) $p->ID : 0;
		}
		$id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_parent'  => $parent,
				'post_content' => '',
			),
			true
		);
		if ( ! is_wp_error( $id ) ) {
			++$created;
		}
	}

	$home = get_page_by_path( 'home', OBJECT, 'page' );
	if ( $home ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home->ID );
	}
	flush_rewrite_rules( false );

	return sprintf(
		/* translators: %d: pages created */
		__( 'Super Healthcare pages are up to date (%d created). Home is the static front page.', 'super-healthcare' ),
		$created
	);
}

/**
 * Run setup on theme activation, and once after updating from 1.x.
 */
function shc_theme_activation() {
	shc_migrate_settings_v2();
	shc_create_pages();
	update_option( 'shc_theme_version', SHC_THEME_VERSION, false );
}
add_action( 'after_switch_theme', 'shc_theme_activation' );

/**
 * Upgrade path: an existing 1.x install gets the v2 structure on next admin load.
 */
function shc_maybe_upgrade() {
	if ( get_option( 'shc_theme_version' ) === SHC_THEME_VERSION ) {
		return;
	}
	shc_migrate_settings_v2();
	shc_create_pages();
	update_option( 'shc_theme_version', SHC_THEME_VERSION, false );
}
add_action( 'admin_init', 'shc_maybe_upgrade' );

/*
 * ------------------------------------------------------------------
 * 301 redirects: theme 1.x paths and the current live site's URLs.
 * ------------------------------------------------------------------
 */

/**
 * Old path (lowercase, no slashes) => new path. Prefix rules end with "/*".
 *
 * @return array<string, string>
 */
function shc_redirect_map() {
	return array(
		// Current live site (superhealthcare.co.uk).
		'home'                 => '/',
		'services'             => '/care-at-home/',
		'live-in-care'         => '/care-at-home/live-in-care/',
		'respite-care'         => '/care-at-home/respite-care/',
		'dementia-care'        => '/care-at-home/dementia-care/',
		'palliative-care'      => '/care-at-home/palliative-care/',
		'book-an-introduction' => '/contact/',
		'testimonials'         => '/our-community/',
		'recruitment'          => '/careers/',
		'contact-us'           => '/contact/',
		'privacy-policy'       => '/privacy/',
		// Theme 1.x.
		'adult-care-at-home/*' => '/care-at-home/',
		'supported-accommodation/*' => '/supported-living/',
		'professionals/*'      => '/referrals/',
		'stories/*'            => '/our-community/',
		'about/cqc-and-quality' => '/about-us/quality-and-cqc/',
		'about/safeguarding'   => '/about-us/safeguarding/',
		'about/policies/complaints' => '/about-us/complaints/',
		'about/policies'       => '/about-us/policies/',
		'about/*'              => '/about-us/',
		'work-with-us/*'       => '/careers/',
	);
}

/**
 * Resolve a request path against the redirect map.
 *
 * @param string $path Request path without leading/trailing slashes.
 * @return string|null Target path.
 */
function shc_redirect_target( $path ) {
	$path = strtolower( trim( $path, '/' ) );
	$map  = shc_redirect_map();
	if ( isset( $map[ $path ] ) ) {
		return $map[ $path ];
	}
	foreach ( $map as $from => $to ) {
		if ( '/*' !== substr( $from, -2 ) ) {
			continue;
		}
		$base = substr( $from, 0, -2 );
		if ( $path === $base ) {
			return $to;
		}
		if ( 0 === strpos( $path, $base . '/' ) ) {
			// Keep service sub-pages: /adult-care-at-home/domcare/ -> /care-at-home/domcare/.
			if ( 'adult-care-at-home' === $base ) {
				return '/care-at-home/' . substr( $path, strlen( $base ) + 1 ) . '/';
			}
			return $to;
		}
	}
	return null;
}

/**
 * Issue 301s for unknown paths that match the map.
 */
function shc_maybe_redirect() {
	if ( ! is_404() ) {
		return;
	}
	$path   = (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH );
	$target = shc_redirect_target( $path );
	if ( null !== $target ) {
		wp_safe_redirect( home_url( $target ), 301, 'Super Healthcare' );
		exit;
	}
}
add_action( 'template_redirect', 'shc_maybe_redirect', 1 );

/*
 * ------------------------------------------------------------------
 * Admin: manual sync.
 * ------------------------------------------------------------------
 */

/**
 * Handle the Tools page action.
 */
function shc_register_pages_admin_action() {
	if ( ! isset( $_GET['shc_create_pages'], $_GET['_wpnonce'] ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'shc_create_pages' ) ) {
		return;
	}
	$msg = shc_create_pages();
	wp_safe_redirect( add_query_arg( 'shc_pages_done', rawurlencode( $msg ), admin_url( 'tools.php?page=shc-pages' ) ) );
	exit;
}
add_action( 'admin_init', 'shc_register_pages_admin_action' );

/**
 * Success notice after a manual sync.
 */
function shc_pages_admin_notice() {
	if ( isset( $_GET['shc_pages_done'] ) && current_user_can( 'manage_options' ) ) {
		printf(
			'<div class="notice notice-success is-dismissible"><p>%s</p></div>',
			esc_html( sanitize_text_field( wp_unslash( $_GET['shc_pages_done'] ) ) )
		);
	}
}
add_action( 'admin_notices', 'shc_pages_admin_notice' );

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	\WP_CLI::add_command(
		'shc create-pages',
		function () {
			\WP_CLI::success( shc_create_pages() );
		}
	);
}

/**
 * Tools submenu to sync pages manually.
 */
function shc_add_tools_page() {
	add_management_page(
		__( 'Super Healthcare pages', 'super-healthcare' ),
		__( 'Super Healthcare pages', 'super-healthcare' ),
		'manage_options',
		'shc-pages',
		'shc_render_tools_page'
	);
}
add_action( 'admin_menu', 'shc_add_tools_page' );

/**
 * Tools page UI.
 */
function shc_render_tools_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$url = wp_nonce_url( admin_url( 'tools.php?page=shc-pages&shc_create_pages=1' ), 'shc_create_pages' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Super Healthcare pages', 'super-healthcare' ); ?></h1>
		<p><?php esc_html_e( 'Creates any missing pages in the site structure (safe to run more than once) and sets Home as the static front page.', 'super-healthcare' ); ?></p>
		<p><a class="button button-primary" href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Run page setup', 'super-healthcare' ); ?></a></p>
		<p><?php esc_html_e( 'WP-CLI: wp shc create-pages', 'super-healthcare' ); ?></p>
	</div>
	<?php
}
