<?php
/**
 * Super Healthcare settings (Settings API).
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register settings page and fields.
 */
function shc_register_settings() {
	register_setting(
		'shc_settings_group',
		'shc_settings',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'shc_sanitize_settings',
			'default'           => array(),
		)
	);

	add_settings_section(
		'shc_contact',
		__( 'Contact details', 'super-healthcare' ),
		'__return_false',
		'shc_settings'
	);

	$fields = array(
		'phone'                    => __( 'Phone (display)', 'super-healthcare' ),
		'email'                    => __( 'Email', 'super-healthcare' ),
		'office_address'           => __( 'Office address', 'super-healthcare' ),
		'google_map_url'           => __( 'Google Maps URL', 'super-healthcare' ),
		'facebook_url'             => __( 'Facebook URL', 'super-healthcare' ),
		'instagram_url'            => __( 'Instagram URL', 'super-healthcare' ),
		'company_number'           => __( 'Company number', 'super-healthcare' ),
		'office_hours'             => __( 'Office hours', 'super-healthcare' ),
		'out_of_hours'             => __( 'Out of hours text', 'super-healthcare' ),
		'cqc_url'                  => __( 'CQC report URL', 'super-healthcare' ),
		'cqc_publication_date'     => __( 'CQC publication date', 'super-healthcare' ),
		'sa_availability_status'   => __( 'SA availability status', 'super-healthcare' ),
		'sa_availability_updated'  => __( 'SA availability updated date', 'super-healthcare' ),
		'sa_availability_expiry'   => __( 'SA availability expiry date', 'super-healthcare' ),
		'enquiry_email_adult'      => __( 'Enquiry email — Adult Care', 'super-healthcare' ),
		'enquiry_email_supported'  => __( 'Enquiry email — Supported Accommodation', 'super-healthcare' ),
	);

	foreach ( $fields as $key => $label ) {
		add_settings_field(
			$key,
			$label,
			'shc_render_settings_field',
			'shc_settings',
			'shc_contact',
			array(
				'key'  => $key,
				'type' => in_array( $key, array( 'office_address', 'out_of_hours' ), true ) ? 'textarea' : 'text',
			)
		);
	}
}
add_action( 'admin_init', 'shc_register_settings' );

/**
 * Sanitise settings array.
 *
 * @param mixed $input Raw input.
 * @return array
 */
function shc_sanitize_settings( $input ) {
	$clean  = array();
	$keys   = array(
		'phone',
		'email',
		'office_address',
		'google_map_url',
		'facebook_url',
		'instagram_url',
		'company_number',
		'office_hours',
		'out_of_hours',
		'cqc_url',
		'cqc_publication_date',
		'sa_availability_status',
		'sa_availability_updated',
		'sa_availability_expiry',
		'enquiry_email_adult',
		'enquiry_email_supported',
	);
	$input  = is_array( $input ) ? $input : array();
	$emails = array( 'email', 'enquiry_email_adult', 'enquiry_email_supported' );
	$urls   = array( 'cqc_url', 'google_map_url', 'facebook_url', 'instagram_url' );

	foreach ( $keys as $key ) {
		$value = isset( $input[ $key ] ) ? wp_unslash( $input[ $key ] ) : '';
		if ( in_array( $key, $emails, true ) ) {
			$clean[ $key ] = sanitize_email( $value );
		} elseif ( in_array( $key, $urls, true ) ) {
			$clean[ $key ] = esc_url_raw( $value );
		} elseif ( 'office_address' === $key || 'out_of_hours' === $key ) {
			$clean[ $key ] = sanitize_textarea_field( $value );
		} else {
			$clean[ $key ] = sanitize_text_field( $value );
		}
	}
	return $clean;
}

/**
 * Render a settings field.
 *
 * @param array $args Field args.
 */
function shc_render_settings_field( $args ) {
	$key  = $args['key'];
	$type = $args['type'];
	$val  = shc_setting( $key );
	$name = 'shc_settings[' . esc_attr( $key ) . ']';
	if ( 'textarea' === $type ) {
		printf(
			'<textarea name="%1$s" id="%2$s" rows="3" class="large-text">%3$s</textarea>',
			esc_attr( $name ),
			esc_attr( $key ),
			esc_textarea( $val )
		);
	} else {
		printf(
			'<input type="text" name="%1$s" id="%2$s" value="%3$s" class="regular-text" />',
			esc_attr( $name ),
			esc_attr( $key ),
			esc_attr( $val )
		);
	}
}

/**
 * Add options page under Settings.
 */
function shc_add_settings_page() {
	add_options_page(
		__( 'Super Healthcare', 'super-healthcare' ),
		__( 'Super Healthcare', 'super-healthcare' ),
		'manage_options',
		'shc_settings',
		'shc_render_settings_page'
	);
}
add_action( 'admin_menu', 'shc_add_settings_page' );

/**
 * Settings page markup.
 */
function shc_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Super Healthcare', 'super-healthcare' ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'shc_settings_group' );
			do_settings_sections( 'shc_settings' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}
