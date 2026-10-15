<?php
/**
 * Contact enquiry form handler (admin-post.php).
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register admin-post handlers.
 */
function shc_register_enquiry_handlers() {
	add_action( 'admin_post_shc_enquiry', 'shc_handle_enquiry' );
	add_action( 'admin_post_nopriv_shc_enquiry', 'shc_handle_enquiry' );
}
add_action( 'init', 'shc_register_enquiry_handlers' );

/**
 * Validation rules aligned with assets/js/main.js.
 *
 * @param array<string, mixed> $data Posted data.
 * @return array<string, string> Field ID => message.
 */
function shc_validate_enquiry( $data ) {
	$errors = array();

	$name = isset( $data['name'] ) ? trim( (string) $data['name'] ) : '';
	if ( strlen( $name ) <= 1 ) {
		$errors['name'] = 'Enter your name';
	}

	$email = isset( $data['email'] ) ? trim( (string) $data['email'] ) : '';
	if ( ! preg_match( '/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email ) ) {
		$errors['email'] = 'Enter an email address in the correct format, like name@example.com';
	}

	$phone = isset( $data['phone'] ) ? (string) $data['phone'] : '';
	if ( strlen( preg_replace( '/[^\d]/', '', $phone ) ) < 10 ) {
		$errors['phone'] = 'Enter a telephone number, like 01702 333 120';
	}

	$who = isset( $data['who'] ) ? (string) $data['who'] : '';
	if ( '' === $who ) {
		$errors['who'] = 'Select who needs support';
	}

	$service = isset( $data['service'] ) ? (string) $data['service'] : '';
	if ( '' === $service || ! in_array( $service, shc_allowed_enquiry_services(), true ) ) {
		$errors['service'] = 'Choose the service you are interested in';
	}

	$postcode = isset( $data['postcode'] ) ? trim( (string) $data['postcode'] ) : '';
	if ( ! preg_match( '/^[A-Z]{1,2}\d[A-Z\d]?\s*\d[A-Z]{2}$/i', $postcode ) ) {
		$errors['postcode'] = 'Enter a full UK postcode, like SS1 1AA';
	}

	if ( empty( $data['consent'] ) ) {
		$errors['consent'] = 'Confirm you have read the privacy notice';
	}

	return $errors;
}

/**
 * Rate limit key for client IP.
 *
 * @return string
 */
function shc_enquiry_rate_key() {
	$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	return 'shc_rate_' . md5( $ip );
}

/**
 * Redirect URL for the enquiry form.
 *
 * @return string
 */
function shc_enquiry_form_url() {
	$page = get_page_by_path( 'contact/request-an-introduction' );
	if ( $page ) {
		return get_permalink( $page );
	}
	return shc_url( '/contact/' );
}

/**
 * Handle enquiry submission.
 */
function shc_handle_enquiry() {
	if ( ! isset( $_POST['shc_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['shc_nonce'] ) ), 'shc_enquiry' ) ) {
		wp_die( esc_html__( 'Security check failed.', 'super-healthcare' ), 403 );
	}

	$redirect = shc_enquiry_form_url();

	// Honeypot: silent success.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'sent', 'SHC-HP00', $redirect ) . '#enquiry-form' );
		exit;
	}

	$rate_key = shc_enquiry_rate_key();
	$count    = (int) get_transient( $rate_key );
	if ( $count >= 5 ) {
		wp_safe_redirect( add_query_arg( 'e', 'rate', $redirect ) . '#enquiry-form' );
		exit;
	}

	$data = array(
		'name'           => isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '',
		'email'          => isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '',
		'phone'          => isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '',
		'contact_method' => isset( $_POST['contact_method'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_method'] ) ) : '',
		'who'            => isset( $_POST['who'] ) ? sanitize_text_field( wp_unslash( $_POST['who'] ) ) : '',
		'service'        => isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '',
		'postcode'       => isset( $_POST['postcode'] ) ? sanitize_text_field( wp_unslash( $_POST['postcode'] ) ) : '',
		'message'        => isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '',
		'consent'        => isset( $_POST['consent'] ) ? '1' : '',
	);

	$errors = shc_validate_enquiry( $data );
	if ( ! empty( $errors ) ) {
		$token = wp_generate_password( 12, false );
		set_transient(
			'shc_enquiry_' . $token,
			array(
				'errors' => $errors,
				'data'   => $data,
			),
			15 * MINUTE_IN_SECONDS
		);
		wp_safe_redirect( add_query_arg( 'e', $token, $redirect ) . '#enquiry-form' );
		exit;
	}

	set_transient( $rate_key, $count + 1, HOUR_IN_SECONDS );

	$ref = 'SHC-' . strtoupper( wp_generate_password( 6, false, false ) );

	$is_supported = ( 'supported-accommodation' === $data['service'] );
	$to           = $is_supported ? shc_setting( 'enquiry_email_supported' ) : shc_setting( 'enquiry_email_adult' );
	if ( '' === $to ) {
		$to = shc_setting( 'email' );
	}

	$subject = sprintf( '[Super Healthcare] Enquiry %s', $ref );
	$body    = sprintf(
		"Reference: %s\nName: %s\nEmail: %s\nPhone: %s\nContact method: %s\nWho needs support: %s\nService: %s\nPostcode: %s\n\nMessage:\n%s\n",
		$ref,
		$data['name'],
		$data['email'],
		$data['phone'],
		$data['contact_method'],
		$data['who'],
		$data['service'],
		$data['postcode'],
		$data['message']
	);

	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( is_email( $data['email'] ) ) {
		$headers[] = 'Reply-To: ' . $data['name'] . ' <' . $data['email'] . '>';
	}

	if ( is_email( $to ) ) {
		wp_mail( $to, $subject, $body, $headers );
	}

	wp_safe_redirect( add_query_arg( 'sent', rawurlencode( $ref ), $redirect ) . '#enquiry-form' );
	exit;
}

/**
 * Load enquiry error state from transient.
 *
 * @return array{errors: array<string, string>, data: array<string, string>}|null
 */
function shc_get_enquiry_state() {
	if ( ! isset( $_GET['e'] ) ) {
		return null;
	}
	$token = sanitize_text_field( wp_unslash( $_GET['e'] ) );
	if ( 'rate' === $token ) {
		return array(
			'errors' => array( '_rate' => 'Too many submissions. Please try again later or call us.' ),
			'data'   => array(),
		);
	}
	$state = get_transient( 'shc_enquiry_' . $token );
	if ( ! is_array( $state ) ) {
		return null;
	}
	delete_transient( 'shc_enquiry_' . $token );
	return $state;
}

/**
 * Old field value for repopulation.
 *
 * @param array<string, string> $data   Saved data.
 * @param string                $key    Field key.
 * @param string                $default Default.
 * @return string
 */
function shc_enquiry_old( $data, $key, $default = '' ) {
	return isset( $data[ $key ] ) ? (string) $data[ $key ] : $default;
}
