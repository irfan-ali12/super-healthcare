<?php
/**
 * Idempotent page creation and static front page setup.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Page tree: path => title (nested via slash).
 *
 * @return array<string, string>
 */
function shc_get_page_tree() {
	return array(
		'home'                                                      => 'Home',
		'adult-care-at-home'                                        => 'Adult Care at Home',
		'adult-care-at-home/domcare'                                => 'DomCare',
		'adult-care-at-home/live-in-care'                           => 'Live-in Care',
		'adult-care-at-home/respite-care'                           => 'Respite Care',
		'adult-care-at-home/dementia-care'                          => 'Dementia Care',
		'adult-care-at-home/palliative-care'                        => 'Palliative Care',
		'adult-care-at-home/companionship'                          => 'Companionship',
		'supported-accommodation'                                   => 'Supported Accommodation 18+',
		'supported-accommodation/our-homes'                         => 'Our homes',
		'supported-accommodation/life-skills'                       => 'Life skills',
		'supported-accommodation/education-and-employment'          => 'Education and employment',
		'supported-accommodation/referral-process'                  => 'Referral process',
		'supported-accommodation/faqs'                              => 'FAQs',
		'supported-accommodation/easy-read'                         => 'Easy Read',
		'contact'                                                   => 'Contact',
		'contact/request-an-introduction'                           => 'Request an introduction',
		'about'                                                     => 'About',
		'about/our-approach'                                        => 'Our approach',
		'about/team'                                                => 'Team',
		'about/cqc-and-quality'                                     => 'CQC and quality',
		'about/safeguarding'                                        => 'Safeguarding',
		'about/policies'                                            => 'Policies',
		'about/policies/complaints'                                 => 'Complaints',
		'stories'                                                   => 'Stories',
		'professionals'                                             => 'Professionals',
		'professionals/referral-form'                               => 'Referral form',
		'work-with-us'                                              => 'Work with us',
		'work-with-us/standards'                                    => 'Training standards',
		'privacy'                                                   => 'Privacy notice',
		'cookies'                                                   => 'Cookies',
		'accessibility'                                             => 'Accessibility',
	);
}

/**
 * Create or update all theme pages.
 *
 * @return string Summary message.
 */
function shc_create_pages() {
	$tree = shc_get_page_tree();
	$ids  = array();

	foreach ( $tree as $path => $title ) {
		$existing = get_page_by_path( $path, OBJECT, 'page' );
		if ( $existing ) {
			$ids[ $path ] = (int) $existing->ID;
			continue;
		}

		$parts    = explode( '/', $path );
		$slug     = array_pop( $parts );
		$parent   = 0;
		if ( ! empty( $parts ) ) {
			$parent_path = implode( '/', $parts );
			$parent      = isset( $ids[ $parent_path ] ) ? $ids[ $parent_path ] : 0;
			if ( ! $parent ) {
				$parent_page = get_page_by_path( $parent_path, OBJECT, 'page' );
				$parent      = $parent_page ? (int) $parent_page->ID : 0;
			}
		}

		$post_id = wp_insert_post(
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

		if ( ! is_wp_error( $post_id ) ) {
			$ids[ $path ] = (int) $post_id;
		}
	}

	$home = get_page_by_path( 'home' );
	if ( $home ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home->ID );
	}

	return sprintf(
		/* translators: %d: number of pages in tree */
		__( 'Super Healthcare pages ready (%d defined paths). Home set as static front page.', 'super-healthcare' ),
		count( $tree )
	);
}

/**
 * Admin Tools action.
 */
function shc_register_pages_admin_action() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['shc_create_pages'] ) && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'shc_create_pages' ) ) {
		$msg = shc_create_pages();
		wp_safe_redirect( add_query_arg( 'shc_pages_done', rawurlencode( $msg ), admin_url( 'themes.php' ) ) );
		exit;
	}
}
add_action( 'admin_init', 'shc_register_pages_admin_action' );

/**
 * Theme activation: offer defaults and create pages once.
 */
function shc_theme_activation() {
	$defaults = array(
		'phone'                   => '01702 333 120',
		'email'                   => 'info@superhealthcare.co.uk',
		'office_address'         => "201 Hamlet Court Road, Westcliff-on-Sea, Essex",
		'google_map_url'         => 'https://maps.google.com/?q=201+Hamlet+Ct+Rd%2C+Westcliff-on-Sea%2C+Southend-on-Sea%2C+Westcliff-on-Sea+SS0+7EL%2C+United+Kingdom',
		'facebook_url'           => 'https://www.facebook.com/superhealthcareuk',
		'instagram_url'          => 'http://instagram.com/superhealthcareuk/',
		'cqc_url'                => 'https://www.cqc.org.uk/location/1-6575573200',
		'enquiry_email_adult'    => 'info@superhealthcare.co.uk',
		'enquiry_email_supported'=> 'info@superhealthcare.co.uk',
	);
	$current  = get_option( 'shc_settings', array() );
	if ( ! is_array( $current ) ) {
		$current = array();
	}
	update_option( 'shc_settings', array_merge( $defaults, $current ) );
	shc_create_pages();
}
add_action( 'after_switch_theme', 'shc_theme_activation' );

/**
 * Admin notice with create-pages link.
 */
function shc_pages_admin_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['shc_pages_done'] ) ) {
		printf(
			'<div class="notice notice-success is-dismissible"><p>%s</p></div>',
			esc_html( wp_unslash( $_GET['shc_pages_done'] ) )
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
	$url = wp_nonce_url( admin_url( 'themes.php?shc_create_pages=1' ), 'shc_create_pages' );
	?>
	<div class="wrap">
		<h1><? esc_html_e( 'Super Healthcare pages', 'super-healthcare' ); ?></h1>
		<p><? esc_html_e( 'Create or update all pages used by the theme (idempotent). Sets Home as the static front page.', 'super-healthcare' ); ?></p>
		<p><a class="button button-primary" href="<?php echo esc_url( $url ); ?>"><? esc_html_e( 'Run page setup', 'super-healthcare' ); ?></a></p>
		<p><? esc_html_e( 'WP-CLI: wp shc create-pages', 'super-healthcare' ); ?></p>
	</div>
	<?php
}
