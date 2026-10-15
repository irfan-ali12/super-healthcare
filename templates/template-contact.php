<?php
/**
 * Contact (also serves /contact/request-an-introduction/).
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Contact Super Healthcare about care at home or supported living in Westcliff-on-Sea. Call 01702 333 120, email or send us a message.',
	'theme-neutral'
);
shc_set_document_title( 'Contact Us | Super Healthcare' );

$trail = array( array( 'Contact', '/contact/' ) );
if ( is_page() && 'request-an-introduction' === get_post()->post_name ) {
	shc_set_document_title( 'Request an introduction | Super Healthcare' );
	$trail[] = array( 'Request an introduction', '/contact/request-an-introduction/' );
}

$service = isset( $_GET['service'] ) ? sanitize_key( wp_unslash( $_GET['service'] ) ) : '';
if ( ! in_array( $service, shc_allowed_enquiry_services(), true ) ) {
	$service = '';
}

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<?php shc_breadcrumb( $trail ); ?>

<section class="contact-hero" aria-labelledby="page-title">
  <div class="container">
    <h1 id="page-title">Let’s talk about the support you need</h1>
    <p class="page-hero-support">Call us, or send a few details and the right team will get back to you.<?php echo shc_response_commitment() ? ' ' . esc_html( shc_response_commitment() ) : ''; ?></p>
  </div>
</section>

<section class="container contact-routes" aria-label="Choose who to contact">
  <a class="route-tile route-tile--care" href="#enquiry-form" data-service="domcare">
    <strong>Care at Home</strong>
    <span>Arrange a free care assessment for you or a family member</span>
  </a>
  <a class="route-tile route-tile--living" href="#enquiry-form" data-service="supported-living">
    <strong>Supported Living</strong>
    <span>Discuss a placement or check availability</span>
  </a>
  <a class="route-tile route-tile--pro" href="<?php echo shc_url( '/referrals/#enquiry-form' ); ?>">
    <strong>Professional referral</strong>
    <span>Go to Referrals &amp; Professional Partnerships</span>
  </a>
</section>

<section class="section section--flush-top" aria-label="Contact form and details">
  <div class="container contact-grid">
    <?php
    get_template_part(
		'partials/enquiry-form',
		null,
		array(
			'variant' => 'general',
			'title'   => 'Send us a message',
			'service' => $service,
		)
	);
	?>

    <aside class="contact-details" aria-label="Contact details">
      <div class="detail-block detail-block--phone">
        <h2>Call us</h2>
        <a class="big-phone" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php shc_echo_phone(); ?></a>
        <?php if ( shc_setting( 'office_hours' ) ) : ?><p><?php echo esc_html( shc_setting( 'office_hours' ) ); ?></p><?php endif; ?>
        <?php if ( shc_setting( 'out_of_hours' ) ) : ?><p class="small-note"><?php echo esc_html( shc_setting( 'out_of_hours' ) ); ?></p><?php endif; ?>
      </div>

      <div class="detail-block">
        <h2>Email</h2>
        <p><?php shc_echo_email_link(); ?></p>
      </div>

      <div class="detail-block">
        <h2>Office</h2>
        <address><?php shc_echo_address(); ?></address>
        <p><a href="<?php echo shc_map_url(); ?>" target="_blank" rel="noopener">View on Google Maps<span class="visually-hidden"> (opens in a new tab)</span></a></p>
      </div>

      <div class="detail-block detail-block--urgent">
        <h2>Is it urgent?</h2>
        <p>If someone is in immediate danger, call <strong>999</strong>. For urgent medical advice, call <strong>NHS 111</strong>.</p>
        <p>To raise a safeguarding concern, see our <a href="<?php echo shc_url( '/about-us/safeguarding/' ); ?>">safeguarding page</a>.</p>
      </div>
    </aside>
  </div>
</section>

</main>
<?php
get_template_part( 'partials/footer' );
