<?php
/**
 * Super Healthcare settings (Settings API).
 *
 * Verified facts (brief, October 2026, checked against CQC and the existing site)
 * are built-in defaults, so the site never shows placeholders. Anything not
 * verified (office hours, availability) stays empty and its line is hidden.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Field definitions grouped by section.
 *
 * type: text | textarea | email | url | image | date
 *
 * @return array<string, array{title: string, fields: array<string, array<string, string>>}>
 */
function shc_settings_schema() {
	return array(
		'contact'  => array(
			'title'  => __( 'Contact details', 'super-healthcare' ),
			'fields' => array(
				'phone'               => array( 'label' => 'Phone (display)', 'type' => 'text' ),
				'email'               => array( 'label' => 'Email', 'type' => 'email' ),
				'office_address'      => array( 'label' => 'Office address', 'type' => 'textarea' ),
				'company_number'      => array( 'label' => 'Company number', 'type' => 'text' ),
				'office_hours'        => array( 'label' => 'Office hours', 'type' => 'text', 'help' => 'Leave empty to hide. Example: Monday to Friday, 9am to 5pm.' ),
				'out_of_hours'        => array( 'label' => 'Out of hours text', 'type' => 'textarea', 'help' => 'Leave empty to hide. Must be approved by Operations.' ),
				'response_commitment' => array( 'label' => 'Response commitment', 'type' => 'text', 'help' => 'Shown near forms and phone numbers. Clear it if Operations cannot confirm.' ),
				'google_map_url'      => array( 'label' => 'Google Maps URL', 'type' => 'url' ),
				'facebook_url'        => array( 'label' => 'Facebook URL', 'type' => 'url' ),
				'instagram_url'       => array( 'label' => 'Instagram URL', 'type' => 'url' ),
			),
		),
		'quality'  => array(
			'title'  => __( 'CQC and quality', 'super-healthcare' ),
			'fields' => array(
				'cqc_url'                         => array( 'label' => 'CQC profile URL', 'type' => 'url' ),
				'cqc_report_url_supported_living' => array( 'label' => 'CQC report URL: Supported Living', 'type' => 'url' ),
				'cqc_date_supported_living'       => array( 'label' => 'CQC publication date: Supported Living', 'type' => 'text' ),
				'cqc_report_url_homecare'         => array( 'label' => 'CQC report URL: Care at Home (homecare)', 'type' => 'url' ),
				'cqc_date_homecare'               => array( 'label' => 'CQC publication date: Care at Home (homecare)', 'type' => 'text' ),
				'registered_manager'              => array( 'label' => 'Registered Manager', 'type' => 'text', 'help' => 'Leave empty to hide the name across the site.' ),
				'homecare_url'                    => array( 'label' => 'homecare.co.uk profile URL', 'type' => 'url' ),
				'homecare_score'                  => array( 'label' => 'homecare.co.uk review score', 'type' => 'text', 'help' => 'Score out of 10, e.g. 9.5. Leave empty to hide the score badge.' ),
				'nhs_url'                         => array( 'label' => 'NHS website listing URL', 'type' => 'url' ),
			),
		),
		'living'   => array(
			'title'  => __( 'Supported Living availability', 'super-healthcare' ),
			'fields' => array(
				'sl_availability_status'  => array( 'label' => 'Availability status', 'type' => 'text', 'help' => 'Example: One room currently available. Leave empty to show "Contact us to check current availability".' ),
				'sl_availability_updated' => array( 'label' => 'Status last updated', 'type' => 'text', 'help' => 'Example: 14 October 2026.' ),
				'sl_availability_expiry'  => array( 'label' => 'Hide status after', 'type' => 'date', 'help' => 'The status is hidden automatically after this date.' ),
			),
		),
		'routing'  => array(
			'title'  => __( 'Enquiry routing', 'super-healthcare' ),
			'fields' => array(
				'enquiry_email_care'             => array( 'label' => 'Care at Home enquiries go to', 'type' => 'email' ),
				'enquiry_email_supported_living' => array( 'label' => 'Supported Living enquiries go to', 'type' => 'email' ),
				'enquiry_email_referrals'        => array( 'label' => 'Professional referrals go to', 'type' => 'email' ),
			),
		),
		'homepage' => array(
			'title'  => __( 'Homepage hero images', 'super-healthcare' ),
			'fields' => array(
				'hero_image_care'       => array( 'label' => 'Care at Home image (blue)', 'type' => 'image', 'help' => 'Landscape, at least 1600px wide. Leave empty to use the built-in image.' ),
				'hero_image_care_alt'   => array( 'label' => 'Care at Home image alt text', 'type' => 'text' ),
				'hero_image_living'     => array( 'label' => 'Supported Living image (red)', 'type' => 'image', 'help' => 'Landscape, at least 1600px wide. Leave empty to use the built-in image.' ),
				'hero_image_living_alt' => array( 'label' => 'Supported Living image alt text', 'type' => 'text' ),
			),
		),
	);
}

/**
 * Verified defaults. Used when a setting has never been saved or is empty.
 *
 * @return array<string, string>
 */
function shc_setting_defaults() {
	return array(
		'phone'                           => '01702 333 120',
		'email'                           => 'info@superhealthcare.co.uk',
		'office_address'                  => "201 Hamlet Court Road\nWestcliff-on-Sea, Essex\nSS0 7EL",
		'company_number'                  => '11085441',
		'response_commitment'             => 'We aim to respond to all requests within 24 hours.',
		'google_map_url'                  => 'https://maps.google.com/?q=201+Hamlet+Court+Road,+Westcliff-on-Sea,+SS0+7EL',
		'facebook_url'                    => 'https://www.facebook.com/superhealthcareuk',
		'instagram_url'                   => 'https://www.instagram.com/superhealthcareuk/',
		'cqc_url'                         => 'https://www.cqc.org.uk/location/1-6575573200',
		'cqc_report_url_supported_living' => 'https://www.cqc.org.uk/location/1-6575573200/reports/AP28532/overall',
		'cqc_date_supported_living'       => '11 September 2026',
		'cqc_report_url_homecare'         => 'https://www.cqc.org.uk/location/1-6575573200/reports/AP27151/overall',
		'cqc_date_homecare'               => '24 July 2026',
		'registered_manager'              => 'Mrs Kadija Michaela Ndlovu',
		'homecare_url'                    => 'https://www.homecare.co.uk/homecare/agency.cfm/id/65432233609',
		'homecare_score'                  => '9.5',
		'nhs_url'                         => 'https://www.nhs.uk/services/care-provider/superhealthcare/1-6575573200',
		'enquiry_email_care'              => 'info@superhealthcare.co.uk',
		'enquiry_email_supported_living'  => 'info@superhealthcare.co.uk',
		'enquiry_email_referrals'         => 'info@superhealthcare.co.uk',
	);
}

/**
 * All setting keys.
 *
 * @return string[]
 */
function shc_settings_keys() {
	$keys = array();
	foreach ( shc_settings_schema() as $section ) {
		$keys = array_merge( $keys, array_keys( $section['fields'] ) );
	}
	return $keys;
}

/**
 * Field type for a key.
 *
 * @param string $key Setting key.
 * @return string
 */
function shc_settings_type( $key ) {
	foreach ( shc_settings_schema() as $section ) {
		if ( isset( $section['fields'][ $key ] ) ) {
			return $section['fields'][ $key ]['type'];
		}
	}
	return 'text';
}

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

	foreach ( shc_settings_schema() as $section_id => $section ) {
		add_settings_section( 'shc_' . $section_id, $section['title'], '__return_false', 'shc_settings' );
		foreach ( $section['fields'] as $key => $field ) {
			add_settings_field(
				$key,
				esc_html( $field['label'] ),
				'shc_render_settings_field',
				'shc_settings',
				'shc_' . $section_id,
				array(
					'key'       => $key,
					'type'      => $field['type'],
					'help'      => isset( $field['help'] ) ? $field['help'] : '',
					'label_for' => $key,
				)
			);
		}
	}
}
add_action( 'admin_init', 'shc_register_settings' );

/**
 * Sanitise settings array.
 *
 * @param mixed $input Raw input.
 * @return array<string, string>
 */
function shc_sanitize_settings( $input ) {
	$input = is_array( $input ) ? $input : array();
	$clean = array();
	foreach ( shc_settings_keys() as $key ) {
		$value = isset( $input[ $key ] ) ? wp_unslash( $input[ $key ] ) : '';
		switch ( shc_settings_type( $key ) ) {
			case 'email':
				$clean[ $key ] = sanitize_email( $value );
				break;
			case 'url':
			case 'image':
				$clean[ $key ] = esc_url_raw( $value );
				break;
			case 'textarea':
				$clean[ $key ] = sanitize_textarea_field( $value );
				break;
			case 'date':
				$clean[ $key ] = preg_match( '/^\d{4}-\d{2}-\d{2}$/', $value ) ? $value : '';
				break;
			default:
				$clean[ $key ] = sanitize_text_field( $value );
		}
	}
	return $clean;
}

/**
 * Raw stored value (no defaults), for the admin form.
 *
 * @param string $key Setting key.
 * @return string
 */
function shc_setting_stored( $key ) {
	$options = get_option( 'shc_settings', array() );
	return ( is_array( $options ) && isset( $options[ $key ] ) ) ? (string) $options[ $key ] : '';
}

/**
 * Render a settings field.
 *
 * @param array<string, string> $args Field args.
 */
function shc_render_settings_field( $args ) {
	$key      = $args['key'];
	$type     = $args['type'];
	$val      = shc_setting_stored( $key );
	$defaults = shc_setting_defaults();
	$name     = 'shc_settings[' . $key . ']';
	$ph       = isset( $defaults[ $key ] ) ? str_replace( "\n", ', ', $defaults[ $key ] ) : '';

	if ( 'textarea' === $type ) {
		printf(
			'<textarea name="%1$s" id="%2$s" rows="3" class="large-text" placeholder="%4$s">%3$s</textarea>',
			esc_attr( $name ),
			esc_attr( $key ),
			esc_textarea( $val ),
			esc_attr( $ph )
		);
	} elseif ( 'image' === $type ) {
		printf(
			'<input type="url" name="%1$s" id="%2$s" value="%3$s" class="regular-text shc-image-url"> <button type="button" class="button shc-image-pick" data-target="%2$s">%4$s</button>',
			esc_attr( $name ),
			esc_attr( $key ),
			esc_attr( $val ),
			esc_html__( 'Choose image', 'super-healthcare' )
		);
		if ( '' !== $val ) {
			printf( '<p><img src="%s" alt="" style="max-width:320px;height:auto;margin-top:8px;border-radius:4px"></p>', esc_url( $val ) );
		}
	} else {
		$input_type = in_array( $type, array( 'email', 'url', 'date' ), true ) ? $type : 'text';
		printf(
			'<input type="%5$s" name="%1$s" id="%2$s" value="%3$s" class="regular-text" placeholder="%4$s">',
			esc_attr( $name ),
			esc_attr( $key ),
			esc_attr( $val ),
			esc_attr( $ph ),
			esc_attr( $input_type )
		);
	}
	if ( '' !== $ph && 'image' !== $type ) {
		echo '<p class="description">' . esc_html__( 'Leave empty to use the verified default shown.', 'super-healthcare' ) . '</p>';
	}
	if ( ! empty( $args['help'] ) ) {
		echo '<p class="description">' . esc_html( $args['help'] ) . '</p>';
	}
}

/**
 * Add options page under Settings.
 */
function shc_add_settings_page() {
	$hook = add_options_page(
		__( 'Super Healthcare', 'super-healthcare' ),
		__( 'Super Healthcare', 'super-healthcare' ),
		'manage_options',
		'shc_settings',
		'shc_render_settings_page'
	);
	add_action( 'admin_print_scripts-' . $hook, 'shc_settings_media_script' );
}
add_action( 'admin_menu', 'shc_add_settings_page' );

/**
 * Media Library picker for image fields.
 */
function shc_settings_media_script() {
	wp_enqueue_media();
	$js = <<<'JS'
document.addEventListener('click', function (e) {
  var btn = e.target.closest('.shc-image-pick');
  if (!btn) return;
  e.preventDefault();
  var frame = wp.media({ title: 'Choose image', multiple: false, library: { type: 'image' } });
  frame.on('select', function () {
    var a = frame.state().get('selection').first().toJSON();
    document.getElementById(btn.dataset.target).value = a.url;
    var alt = document.getElementById(btn.dataset.target + '_alt');
    if (alt && !alt.value && a.alt) alt.value = a.alt;
  });
  frame.open();
});
JS;
	wp_add_inline_script( 'media-editor', $js );
}

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
		<p><?php esc_html_e( 'Values shown in grey are verified defaults. Empty optional fields are hidden on the website, never shown as placeholders.', 'super-healthcare' ); ?></p>
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

/**
 * One-time migration of setting keys from theme 1.x.
 */
function shc_migrate_settings_v2() {
	if ( get_option( 'shc_settings_migrated_v2' ) ) {
		return;
	}
	update_option( 'shc_settings_migrated_v2', '1', false );
	$options = get_option( 'shc_settings', array() );
	if ( ! is_array( $options ) || empty( $options ) ) {
		return;
	}
	$map = array(
		'sa_availability_status'  => 'sl_availability_status',
		'sa_availability_updated' => 'sl_availability_updated',
		'sa_availability_expiry'  => 'sl_availability_expiry',
		'enquiry_email_adult'     => 'enquiry_email_care',
		'enquiry_email_supported' => 'enquiry_email_supported_living',
	);
	foreach ( $map as $old => $new ) {
		if ( ! empty( $options[ $old ] ) && empty( $options[ $new ] ) ) {
			$options[ $new ] = $options[ $old ];
		}
		unset( $options[ $old ] );
	}
	unset( $options['cqc_publication_date'] );
	// Clear values that were only the 1.x theme's incomplete defaults, so the
	// verified defaults apply. Anything the client typed themselves is kept.
	$legacy_defaults = array(
		'office_address' => '201 Hamlet Court Road, Westcliff-on-Sea, Essex',
		'instagram_url'  => 'http://instagram.com/superhealthcareuk/',
		'google_map_url' => 'https://maps.google.com/?q=201+Hamlet+Ct+Rd%2C+Westcliff-on-Sea%2C+Southend-on-Sea%2C+Westcliff-on-Sea+SS0+7EL%2C+United+Kingdom',
	);
	foreach ( $legacy_defaults as $key => $old_value ) {
		if ( isset( $options[ $key ] ) && trim( $options[ $key ] ) === $old_value ) {
			$options[ $key ] = '';
		}
	}
	update_option( 'shc_settings', shc_sanitize_settings( $options ) );
}
add_action( 'admin_init', 'shc_migrate_settings_v2', 5 );
