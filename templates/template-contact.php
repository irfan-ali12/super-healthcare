<?php
/**
 * Contact and request an introduction.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Contact Super Healthcare about adult care at home or supported accommodation for young adults 18+. Call 01702 333 120 or request an introduction.',
	'theme-neutral'
);
shc_set_document_title( 'Contact us | Super Healthcare' );

$enquiry_state = shc_get_enquiry_state();
$old           = $enquiry_state ? $enquiry_state['data'] : array();
$errors        = $enquiry_state ? $enquiry_state['errors'] : array();
$sent_ref      = isset( $_GET['sent'] ) ? sanitize_text_field( wp_unslash( $_GET['sent'] ) ) : '';
$show_success  = '' !== $sent_ref;
$show_form     = ! $show_success;

$crumb_current = 'Contact';
$crumb_parent  = null;
if ( is_page() && 'request-an-introduction' === get_post()->post_name ) {
	shc_set_document_title( 'Request an introduction | Super Healthcare' );
	$crumb_parent  = shc_url( '/contact/' );
	$crumb_current = 'Request an introduction';
}

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<nav class="breadcrumb container" aria-label="Breadcrumb">
  <ol>
    <li><a href="<?php echo shc_url( '/' ); ?>">Home</a></li>
    <?php if ( $crumb_parent ) : ?>
    <li><a href="<?php echo esc_url( $crumb_parent ); ?>">Contact</a></li>
    <li><a href="<?php echo esc_url( shc_url( '/contact/request-an-introduction/' ) ); ?>" aria-current="page"><?php echo esc_html( $crumb_current ); ?></a></li>
    <?php else : ?>
    <li><a href="<?php echo shc_url( '/contact/' ); ?>" aria-current="page">Contact</a></li>
    <?php endif; ?>
  </ol>
</nav>

<section class="contact-hero" aria-labelledby="page-title">
  <div class="container">
    <h1 id="page-title">Let’s talk about the support you need</h1>
    <p class="page-hero-support">Call us, or send a few details and the right team will get back to you.</p>
  </div>
</section>

<section class="container route-grid" aria-label="Choose who to contact">
  <a class="route-card route-card--adult" href="#enquiry-form" data-service="adult">
    <strong>Adult Care at Home</strong>
    <span>For yourself or a family member</span>
  </a>
  <a class="route-card route-card--young" href="#enquiry-form" data-service="supported">
    <strong>Supported Accommodation 18+</strong>
    <span>Questions about our homes and support</span>
  </a>
  <a class="route-card route-card--pro" href="<?php echo shc_url( '/professionals/referral-form/' ); ?>">
    <strong>Making a professional referral?</strong>
    <span>Use our secure referral route</span>
  </a>
</section>

<section class="section section--flush-top" aria-label="Contact form and details">
  <div class="container contact-grid">

    <div class="form-card">
      <h2 id="form-title">Request an introduction</h2>
      <p class="form-intro">Fields marked <span aria-hidden="true">*</span><span class="visually-hidden">with an asterisk</span> are required.</p>

      <div class="error-summary" id="error-summary" tabindex="-1" role="alert"<?php echo empty( $errors ) ? ' hidden' : ''; ?>>
        <h3>Please check the form</h3>
        <ul>
          <?php foreach ( $errors as $field => $message ) : ?>
          <li><a href="#<?php echo esc_attr( str_replace( '_rate', 'name', $field ) ); ?>"><?php echo esc_html( $message ); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="form-success" id="form-success" tabindex="-1"<?php echo $show_success ? '' : ' hidden'; ?>>
        <h3>Thank you, we have your enquiry</h3>
        <p>Your reference is <strong id="success-ref"><?php echo esc_html( $sent_ref ); ?></strong>. A member of the team will contact you <span class="placeholder-inline">[confirmed response time]</span> using your preferred method.</p>
      </div>

      <form id="enquiry-form" class="enquiry-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate aria-labelledby="form-title"<?php echo $show_form ? '' : ' hidden'; ?>>
        <input type="hidden" name="action" value="shc_enquiry">
        <?php wp_nonce_field( 'shc_enquiry', 'shc_nonce' ); ?>

        <div class="hp" aria-hidden="true">
          <label for="website">Leave this empty</label>
          <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
        </div>

        <?php
        $name_err = isset( $errors['name'] ) ? $errors['name'] : '';
        $name_val = shc_enquiry_old( $old, 'name' );
        ?>
        <div class="field">
          <label for="name">Your name <span class="req" aria-hidden="true">*</span></label>
          <input type="text" id="name" name="name" autocomplete="name" required aria-describedby="name-error" value="<?php echo esc_attr( $name_val ); ?>"<?php echo $name_err ? ' aria-invalid="true"' : ''; ?>>
          <p class="field-error" id="name-error"<?php echo $name_err ? '' : ' hidden'; ?>><?php echo esc_html( $name_err ); ?></p>
        </div>

        <div class="field-row">
          <?php
          $email_err = isset( $errors['email'] ) ? $errors['email'] : '';
          $phone_err = isset( $errors['phone'] ) ? $errors['phone'] : '';
          ?>
          <div class="field">
            <label for="email">Email <span class="req" aria-hidden="true">*</span></label>
            <input type="email" id="email" name="email" autocomplete="email" required aria-describedby="email-error" value="<?php echo esc_attr( shc_enquiry_old( $old, 'email' ) ); ?>"<?php echo $email_err ? ' aria-invalid="true"' : ''; ?>>
            <p class="field-error" id="email-error"<?php echo $email_err ? '' : ' hidden'; ?>><?php echo esc_html( $email_err ); ?></p>
          </div>
          <div class="field">
            <label for="phone">Telephone <span class="req" aria-hidden="true">*</span></label>
            <input type="tel" id="phone" name="phone" autocomplete="tel" required aria-describedby="phone-error" value="<?php echo esc_attr( shc_enquiry_old( $old, 'phone' ) ); ?>"<?php echo $phone_err ? ' aria-invalid="true"' : ''; ?>>
            <p class="field-error" id="phone-error"<?php echo $phone_err ? '' : ' hidden'; ?>><?php echo esc_html( $phone_err ); ?></p>
          </div>
        </div>

        <?php $method = shc_enquiry_old( $old, 'contact_method', 'phone' ); ?>
        <fieldset class="field">
          <legend>How should we contact you?</legend>
          <div class="choice-row">
            <label class="choice"><input type="radio" name="contact_method" value="phone"<?php checked( $method, 'phone' ); ?>> Telephone</label>
            <label class="choice"><input type="radio" name="contact_method" value="email"<?php checked( $method, 'email' ); ?>> Email</label>
            <label class="choice"><input type="radio" name="contact_method" value="either"<?php checked( $method, 'either' ); ?>> Either</label>
          </div>
        </fieldset>

        <?php $who_err = isset( $errors['who'] ) ? $errors['who'] : ''; $who_old = shc_enquiry_old( $old, 'who' ); ?>
        <fieldset class="field" aria-describedby="who-error">
          <legend>Who needs support? <span class="req" aria-hidden="true">*</span></legend>
          <div class="choice-grid">
            <label class="choice"><input type="radio" id="who" name="who" value="self" required<?php checked( $who_old, 'self' ); ?>> Me</label>
            <label class="choice"><input type="radio" name="who" value="family"<?php checked( $who_old, 'family' ); ?>> A family member</label>
            <label class="choice"><input type="radio" name="who" value="professional"<?php checked( $who_old, 'professional' ); ?>> Someone I support professionally</label>
            <label class="choice"><input type="radio" name="who" value="other"<?php checked( $who_old, 'other' ); ?>> Other</label>
          </div>
          <p class="field-error" id="who-error"<?php echo $who_err ? '' : ' hidden'; ?>><?php echo esc_html( $who_err ); ?></p>
        </fieldset>

        <?php $service_err = isset( $errors['service'] ) ? $errors['service'] : ''; $service_old = shc_enquiry_old( $old, 'service' ); ?>
        <div class="field">
          <label for="service">Service you are interested in <span class="req" aria-hidden="true">*</span></label>
          <select id="service" name="service" required aria-describedby="service-error"<?php echo $service_err ? ' aria-invalid="true"' : ''; ?>>
            <option value="">Choose a service</option>
            <optgroup label="Adult Care at Home">
              <option value="domcare"<?php selected( $service_old, 'domcare' ); ?>>DomCare (domiciliary care)</option>
              <option value="live-in"<?php selected( $service_old, 'live-in' ); ?>>Live-in Care</option>
              <option value="respite"<?php selected( $service_old, 'respite' ); ?>>Respite Care</option>
              <option value="dementia"<?php selected( $service_old, 'dementia' ); ?>>Dementia Care</option>
              <option value="palliative"<?php selected( $service_old, 'palliative' ); ?>>Palliative Care</option>
              <option value="companionship"<?php selected( $service_old, 'companionship' ); ?>>Companionship</option>
            </optgroup>
            <optgroup label="Young adults">
              <option value="supported-accommodation"<?php selected( $service_old, 'supported-accommodation' ); ?>>Supported Accommodation 18+</option>
            </optgroup>
            <option value="unsure"<?php selected( $service_old, 'unsure' ); ?>>I’m not sure yet</option>
          </select>
          <p class="field-error" id="service-error"<?php echo $service_err ? '' : ' hidden'; ?>><?php echo esc_html( $service_err ); ?></p>
        </div>

        <?php $postcode_err = isset( $errors['postcode'] ) ? $errors['postcode'] : ''; ?>
        <div class="field field--narrow">
          <label for="postcode">Postcode <span class="req" aria-hidden="true">*</span></label>
          <p class="hint" id="postcode-hint">So we can check we cover your area.</p>
          <input type="text" id="postcode" name="postcode" autocomplete="postal-code" required aria-describedby="postcode-hint postcode-error" value="<?php echo esc_attr( shc_enquiry_old( $old, 'postcode' ) ); ?>"<?php echo $postcode_err ? ' aria-invalid="true"' : ''; ?>>
          <p class="field-error" id="postcode-error"<?php echo $postcode_err ? '' : ' hidden'; ?>><?php echo esc_html( $postcode_err ); ?></p>
        </div>

        <div class="field">
          <label for="message">Tell us a little about what you need</label>
          <p class="hint" id="message-hint">Please do not include detailed medical information. If someone is at immediate risk, call 999.</p>
          <textarea id="message" name="message" rows="5" aria-describedby="message-hint"><?php echo esc_textarea( shc_enquiry_old( $old, 'message' ) ); ?></textarea>
        </div>

        <?php $consent_err = isset( $errors['consent'] ) ? $errors['consent'] : ''; ?>
        <div class="field">
          <label class="choice choice--consent">
            <input type="checkbox" id="consent" name="consent" required aria-describedby="consent-error" value="1"<?php checked( ! empty( $old['consent'] ) ); ?>>
            <span>I have read the <a href="<?php echo shc_url( '/privacy/' ); ?>">privacy notice</a> and agree to Super Healthcare using these details to respond to my enquiry. <span class="req" aria-hidden="true">*</span></span>
          </label>
          <p class="field-error" id="consent-error"<?php echo $consent_err ? '' : ' hidden'; ?>><?php echo esc_html( $consent_err ); ?></p>
        </div>

        <button class="btn btn--red btn--lg" type="submit">Send my enquiry</button>
      </form>
    </div>

    <aside class="contact-details" aria-label="Contact details">
      <div class="detail-block detail-block--phone">
        <h2>Call us</h2>
        <a class="big-phone" href="<?php echo esc_url( shc_phone_href() ); ?>"><?php shc_echo_phone(); ?></a>
        <p>Office hours <?php shc_echo_office_hours(); ?></p>
        <p class="small-note"><?php shc_echo_out_of_hours(); ?></p>
      </div>

      <div class="detail-block">
        <h2>Email</h2>
        <p><?php shc_echo_email_link(); ?></p>
      </div>

      <div class="detail-block">
        <h2>Office</h2>
        <address><?php shc_echo_address(); ?></address>
        <p><a href="<?php echo shc_map_url(); ?>" target="_blank" rel="noopener">View on Google Maps</a></p>
      </div>

      <div class="detail-block">
        <h2>Follow us</h2>
        <p><a href="<?php echo shc_social_url( 'instagram_url' ); ?>" target="_blank" rel="noopener">Instagram</a></p>
        <p><a href="<?php echo shc_social_url( 'facebook_url' ); ?>" target="_blank" rel="noopener">Facebook</a></p>
      </div>

      <div class="detail-block detail-block--urgent">
        <h2>Is it urgent?</h2>
        <p>If someone is in immediate danger, call <strong>999</strong>. For urgent medical advice, call <strong>NHS 111</strong>.</p>
        <p>To raise a safeguarding concern, see our <a href="<?php echo shc_url( '/about/safeguarding/' ); ?>">safeguarding page</a>.</p>
      </div>
    </aside>

  </div>
</section>

</main>
<?php
get_template_part( 'partials/footer' );
