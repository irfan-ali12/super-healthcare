<?php
/**
 * Shared enquiry form (Contact, Supported Living, Referrals).
 *
 * $args:
 *   variant  general | living | referral
 *   title    Form heading
 *   intro    Optional intro sentence
 *   service  Preselected service value
 *   button   Submit button label
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'variant' => 'general',
		'title'   => 'Send us a message',
		'intro'   => '',
		'service' => '',
		'button'  => 'Send my enquiry',
	)
);

$variant       = $args['variant'];
$state         = shc_get_enquiry_state();
$old           = $state ? $state['data'] : array();
$errors        = $state ? $state['errors'] : array();
$sent_ref      = isset( $_GET['sent'] ) ? sanitize_text_field( wp_unslash( $_GET['sent'] ) ) : '';
$show_success  = '' !== $sent_ref;
$service_old   = shc_enquiry_old( $old, 'service', $args['service'] );
$who_default   = 'referral' === $variant ? 'professional' : '';
$who_old       = shc_enquiry_old( $old, 'who', $who_default );
$method        = shc_enquiry_old( $old, 'contact_method', 'phone' );
$return_path   = shc_current_path();
$commitment    = shc_response_commitment();

/**
 * Field error message or empty string.
 *
 * @param array<string, string> $errors Errors.
 * @param string                $key    Field.
 * @return string
 */
$err = static function ( $key ) use ( $errors ) {
	return isset( $errors[ $key ] ) ? $errors[ $key ] : '';
};
$invalid = static function ( $key ) use ( $errors ) {
	return isset( $errors[ $key ] ) ? ' aria-invalid="true"' : '';
};
$hidden = static function ( $key ) use ( $errors ) {
	return isset( $errors[ $key ] ) ? '' : ' hidden';
};
?>
<div class="form-card" id="enquiry">
  <h2 id="form-title"><?php echo esc_html( $args['title'] ); ?></h2>
  <?php if ( '' !== $args['intro'] ) : ?>
  <p class="form-intro"><?php echo esc_html( $args['intro'] ); ?></p>
  <?php endif; ?>
  <p class="form-required-note">Fields marked <span aria-hidden="true">*</span><span class="visually-hidden">with an asterisk</span> are required.</p>

  <div class="error-summary" id="error-summary" tabindex="-1" role="alert"<?php echo empty( $errors ) ? ' hidden' : ''; ?>>
    <h3>Please check the form</h3>
    <ul>
      <?php foreach ( $errors as $field => $message ) : ?>
      <li><a href="#<?php echo esc_attr( '_rate' === $field ? 'name' : $field ); ?>"><?php echo esc_html( $message ); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="form-success" id="form-success" tabindex="-1"<?php echo $show_success ? '' : ' hidden'; ?> data-track-view="enquiry_submit">
    <h3>Thank you, we have your message</h3>
    <p>Your reference is <strong id="success-ref"><?php echo esc_html( $sent_ref ); ?></strong>.
      <?php echo '' !== $commitment ? esc_html( $commitment ) : 'A member of our team will contact you using your preferred method.'; ?>
    </p>
    <p>If you need to speak to someone sooner, call <a href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php shc_echo_phone(); ?></a>.</p>
  </div>

  <form id="enquiry-form" class="enquiry-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate aria-labelledby="form-title" data-variant="<?php echo esc_attr( $variant ); ?>"<?php echo $show_success ? ' hidden' : ''; ?>>
    <input type="hidden" name="action" value="shc_enquiry">
    <input type="hidden" name="return_path" value="<?php echo esc_attr( $return_path ); ?>">
    <?php wp_nonce_field( 'shc_enquiry', 'shc_nonce' ); ?>

    <div class="hp" aria-hidden="true">
      <label for="website">Leave this empty</label>
      <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
    </div>

    <div class="field">
      <label for="name">Your name <span class="req" aria-hidden="true">*</span></label>
      <input type="text" id="name" name="name" autocomplete="name" required aria-describedby="name-error" value="<?php echo esc_attr( shc_enquiry_old( $old, 'name' ) ); ?>"<?php echo $invalid( 'name' ); // phpcs:ignore ?>>
      <p class="field-error" id="name-error"<?php echo $hidden( 'name' ); // phpcs:ignore ?>><?php echo esc_html( $err( 'name' ) ); ?></p>
    </div>

    <?php if ( 'referral' === $variant ) : ?>
    <div class="field">
      <label for="organisation">Organisation and role</label>
      <p class="hint" id="organisation-hint">For example: Southend City Council, social worker.</p>
      <input type="text" id="organisation" name="organisation" autocomplete="organization" aria-describedby="organisation-hint" value="<?php echo esc_attr( shc_enquiry_old( $old, 'organisation' ) ); ?>">
    </div>
    <?php endif; ?>

    <div class="field-row">
      <div class="field">
        <label for="email">Email <span class="req" aria-hidden="true">*</span></label>
        <input type="email" id="email" name="email" autocomplete="email" required aria-describedby="email-error" value="<?php echo esc_attr( shc_enquiry_old( $old, 'email' ) ); ?>"<?php echo $invalid( 'email' ); // phpcs:ignore ?>>
        <p class="field-error" id="email-error"<?php echo $hidden( 'email' ); // phpcs:ignore ?>><?php echo esc_html( $err( 'email' ) ); ?></p>
      </div>
      <div class="field">
        <label for="phone">Telephone <span class="req" aria-hidden="true">*</span></label>
        <input type="tel" id="phone" name="phone" autocomplete="tel" required aria-describedby="phone-error" value="<?php echo esc_attr( shc_enquiry_old( $old, 'phone' ) ); ?>"<?php echo $invalid( 'phone' ); // phpcs:ignore ?>>
        <p class="field-error" id="phone-error"<?php echo $hidden( 'phone' ); // phpcs:ignore ?>><?php echo esc_html( $err( 'phone' ) ); ?></p>
      </div>
    </div>

    <fieldset class="field">
      <legend>How should we contact you?</legend>
      <div class="choice-row">
        <label class="choice"><input type="radio" name="contact_method" value="phone"<?php checked( $method, 'phone' ); ?>> Telephone</label>
        <label class="choice"><input type="radio" name="contact_method" value="email"<?php checked( $method, 'email' ); ?>> Email</label>
        <label class="choice"><input type="radio" name="contact_method" value="either"<?php checked( $method, 'either' ); ?>> Either</label>
      </div>
    </fieldset>

    <?php if ( 'referral' === $variant ) : ?>
    <input type="hidden" name="who" value="professional">
    <input type="hidden" name="is_referral" value="1">
    <?php else : ?>
    <fieldset class="field" aria-describedby="who-error">
      <legend>Who needs support? <span class="req" aria-hidden="true">*</span></legend>
      <div class="choice-grid">
        <label class="choice"><input type="radio" id="who" name="who" value="self" required<?php checked( $who_old, 'self' ); ?>> Me</label>
        <label class="choice"><input type="radio" name="who" value="family"<?php checked( $who_old, 'family' ); ?>> A family member</label>
        <label class="choice"><input type="radio" name="who" value="professional"<?php checked( $who_old, 'professional' ); ?>> Someone I support professionally</label>
        <label class="choice"><input type="radio" name="who" value="other"<?php checked( $who_old, 'other' ); ?>> Someone else</label>
      </div>
      <p class="field-error" id="who-error"<?php echo $hidden( 'who' ); // phpcs:ignore ?>><?php echo esc_html( $err( 'who' ) ); ?></p>
    </fieldset>
    <?php endif; ?>

    <div class="field">
      <label for="service"><?php echo 'referral' === $variant ? 'Service you are referring for' : 'What are you interested in?'; ?> <span class="req" aria-hidden="true">*</span></label>
      <select id="service" name="service" required aria-describedby="service-error"<?php echo $invalid( 'service' ); // phpcs:ignore ?>>
        <option value="">Choose an option</option>
        <?php foreach ( shc_enquiry_service_groups() as $group => $options ) : ?>
          <?php
          if ( 'referral' === $variant && 'Professionals' === $group ) {
            continue;
          }
          ?>
          <?php if ( '' !== $group ) : ?><optgroup label="<?php echo esc_attr( $group ); ?>"><?php endif; ?>
          <?php foreach ( $options as $value => $label ) : ?>
          <option value="<?php echo esc_attr( $value ); ?>"<?php selected( $service_old, $value ); ?>><?php echo esc_html( $label ); ?></option>
          <?php endforeach; ?>
          <?php if ( '' !== $group ) : ?></optgroup><?php endif; ?>
        <?php endforeach; ?>
      </select>
      <p class="field-error" id="service-error"<?php echo $hidden( 'service' ); // phpcs:ignore ?>><?php echo esc_html( $err( 'service' ) ); ?></p>
    </div>

    <div class="field field--narrow">
      <label for="postcode"><?php echo 'referral' === $variant ? 'Postcode area of the person' : 'Postcode'; ?> <span class="req" aria-hidden="true">*</span></label>
      <p class="hint" id="postcode-hint">So we can check we cover the area.</p>
      <input type="text" id="postcode" name="postcode" autocomplete="postal-code" required aria-describedby="postcode-hint postcode-error" value="<?php echo esc_attr( shc_enquiry_old( $old, 'postcode' ) ); ?>"<?php echo $invalid( 'postcode' ); // phpcs:ignore ?>>
      <p class="field-error" id="postcode-error"<?php echo $hidden( 'postcode' ); // phpcs:ignore ?>><?php echo esc_html( $err( 'postcode' ) ); ?></p>
    </div>

    <div class="field">
      <label for="message"><?php echo 'referral' === $variant ? 'Broad support needs and timescale' : 'Tell us a little about what you need'; ?></label>
      <p class="hint" id="message-hint">
        <?php if ( 'referral' === $variant ) : ?>
        Please do not include names, dates of birth or medical details here. We will call you to arrange a secure transfer of referral information.
        <?php else : ?>
        Please do not include detailed medical information. If someone is at immediate risk, call 999.
        <?php endif; ?>
      </p>
      <textarea id="message" name="message" rows="5" aria-describedby="message-hint"><?php echo esc_textarea( shc_enquiry_old( $old, 'message' ) ); ?></textarea>
    </div>

    <div class="field">
      <label class="choice choice--consent">
        <input type="checkbox" id="consent" name="consent" required aria-describedby="consent-error" value="1"<?php checked( ! empty( $old['consent'] ) ); ?>>
        <span>I have read the <a href="<?php echo shc_url( '/privacy/' ); ?>">privacy notice</a> and agree to Super Healthcare using these details to respond. <span class="req" aria-hidden="true">*</span></span>
      </label>
      <p class="field-error" id="consent-error"<?php echo $hidden( 'consent' ); // phpcs:ignore ?>><?php echo esc_html( $err( 'consent' ) ); ?></p>
    </div>

    <button class="btn btn--red btn--lg" type="submit"><?php echo esc_html( $args['button'] ); ?></button>
    <?php if ( '' !== $commitment ) : ?>
    <p class="form-commitment"><?php echo esc_html( $commitment ); ?></p>
    <?php endif; ?>
  </form>
</div>
