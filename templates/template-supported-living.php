<?php
/**
 * Supported Living (adults 18+, no upper age limit).
 *
 * Built from the standalone Supported Living content brief. Deliberately makes
 * no claims about en-suites, accessibility adaptations or 24-hour on-site
 * staffing until the client confirms them.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Supported living for adults aged 18 and over, with no upper age limit. Five-bedroom home at 234 Hamlet Court Road, Westcliff-on-Sea. Rated Good by CQC.',
	'theme-living'
);
shc_set_document_title( 'Supported Living for Adults 18+ in Westcliff-on-Sea | Super Healthcare' );

$availability = shc_sl_availability();
$property_map = 'https://maps.google.com/?q=234+Hamlet+Court+Road,+Westcliff-on-Sea,+SS0+7DE';

$focus = array(
	array( 'routine', 'Daily routines and household tasks' ),
	array( 'meals', 'Cooking, shopping and meal planning' ),
	array( 'budget', 'Budgeting and managing everyday money' ),
	array( 'wellbeing', 'Appointments, health and wellbeing routines' ),
	array( 'confidence', 'Building confidence and making decisions' ),
	array( 'companionship', 'Community, relationships and activities' ),
	array( 'education', 'Education, volunteering or work, where relevant' ),
	array( 'key', 'Keeping existing skills, choice and independence' ),
);

$gallery = array(
	array( 'home-lounge', 'Lounge' ),
	array( 'home-kitchen', 'Kitchen' ),
	array( 'home-dining-area', 'Dining area' ),
	array( 'home-garden-seating', 'Outdoor seating' ),
	array( 'home-garden', 'Garden' ),
);

$faqs = array(
	array( 'Is there an upper age limit?', 'No. Supported living is open for consideration to adults aged 18 and over, with no upper age limit. Age alone never decides suitability.' ),
	array( 'How do you decide if the home is right for someone?', 'We look at the person’s assessed needs, their preferences, any risks, compatibility with the people already living in the home, and whether we can provide safe and appropriate support. We always explain our decision.' ),
	array( 'Who can make an enquiry?', 'Adults looking for support, their families and representatives, social workers, commissioners, local authorities and other professionals.' ),
	array( 'How is the home staffed?', 'Staffing is planned around the assessed needs of the people living in the home. We will explain the arrangements in detail when we discuss a placement.' ),
	array( 'How is supported living funded?', 'Before any placement decision we explain the proposed support, the availability and the funding and contract arrangements. Funding eligibility is decided by the relevant body, such as the local authority.' ),
	array( 'Does CQC regulate the property?', 'CQC regulates the care and support we provide, not the housing itself. Our supported living service is rated Good by CQC.' ),
);

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<?php shc_breadcrumb( array( array( 'Supported Living', '/supported-living/' ) ) ); ?>

<section class="sl-hero" aria-labelledby="page-title">
  <div class="sl-hero-media">
    <?php echo shc_img( 'home-dining-area', array( 'priority' => true, 'sizes' => '100vw', 'class' => 'sl-hero-img', 'alt' => 'The bright, open-plan dining area at our supported living home' ) ); // phpcs:ignore ?>
  </div>
  <div class="container">
    <div class="sl-hero-panel">
      <p class="page-hero-kicker">Supported Living</p>
      <h1 id="page-title">Supported living for adults aged 18+</h1>
      <p class="sl-hero-sub">A place to call home. Support to live life your way.</p>
      <p class="page-hero-support">We provide supported living for adults aged 18 and over, with no upper age limit. Our approach is built around the individual, respecting their choices, routines, abilities and aspirations, with support tailored to their assessed needs.</p>
      <div class="page-hero-ctas">
        <a class="btn btn--red" href="#enquiry-form" data-track="cta_discuss_placement">Discuss supported living</a>
        <a class="btn btn--outline" href="<?php echo shc_url( '/referrals/' ); ?>" data-track="cta_referral">Make a referral</a>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <div class="notice notice--living" role="status">
    <span class="notice-icon" aria-hidden="true"><?php shc_icon( 'bed' ); ?></span>
    <p>
      <?php if ( $availability ) : ?>
        <strong>Current availability:</strong> <?php echo esc_html( $availability['status'] ); ?><?php echo $availability['updated'] ? '. Updated ' . esc_html( $availability['updated'] ) : ''; ?>. Places are confirmed only after assessment and agreement of funding.
      <?php else : ?>
        <strong>Check availability:</strong> contact us to discuss current availability. Every placement is subject to individual assessment and compatibility.
      <?php endif; ?>
      <a href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click">Call <?php shc_echo_phone(); ?></a>
    </p>
  </div>
</div>

<div class="container"><p class="sl-intro-more">Whether someone is looking to develop everyday living skills, build confidence or maintain greater independence, we work with them to identify meaningful goals and the support that is right for them.</p></div>

<!-- ============ PROPERTY SPOTLIGHT ============ -->
<section class="section section--tint-red" id="property" aria-labelledby="property-title">
  <div class="container">
    <h2 id="property-title" class="section-title section-title--red">Discover our five-bedroom home in Westcliff-on-Sea</h2>
    <div class="property-grid">
      <div class="property-copy">
        <p class="lead">Located at 234 Hamlet Court Road, our five-bedroom supported accommodation is a setting where adults receive personalised support while developing or maintaining independence and taking part in everyday life.</p>
        <dl class="fact-list">
          <div><dt>Address</dt><dd>234 Hamlet Court Road, Westcliff-on-Sea, SS0 7DE<br><a href="<?php echo esc_url( $property_map ); ?>" target="_blank" rel="noopener">View on map<span class="visually-hidden"> (opens Google Maps in a new tab)</span></a></dd></div>
          <div><dt>Accommodation</dt><dd>Five bedrooms</dd></div>
          <div><dt>Age eligibility</dt><dd>18+ with no upper age limit</dd></div>
          <div><dt>Admission</dt><dd>Subject to individual assessment, compatibility and service suitability</dd></div>
        </dl>
      </div>
      <div class="gallery-grid" data-lightbox>
        <?php foreach ( $gallery as $i => $g ) : ?>
        <figure class="gallery-item<?php echo 0 === $i ? ' gallery-item--main' : ''; ?>">
          <button type="button" class="gallery-open" data-full="<?php echo shc_asset( 'img/photos/' . $g[0] . '-1600.webp' ); ?>" data-caption="<?php echo esc_attr( $g[1] ); ?>" aria-label="<?php echo esc_attr( 'Enlarge photo: ' . $g[1] ); ?>">
            <?php echo shc_img( $g[0], array( 'sizes' => 0 === $i ? '(max-width: 900px) 100vw, 40vw' : '(max-width: 900px) 50vw, 20vw' ) ); // phpcs:ignore ?>
          </button>
          <figcaption><?php echo esc_html( $g[1] ); ?></figcaption>
        </figure>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ SUPPORT ============ -->
<section class="section" aria-labelledby="support-title">
  <div class="container">
    <h2 id="support-title" class="section-title section-title--red">How personalised support works</h2>
    <p class="section-intro">Support is person-centred. It may include any of the following, where it is part of the person’s assessed care and support plan.</p>
    <ul class="focus-grid">
      <?php foreach ( $focus as $f ) : ?>
      <li><span class="focus-icon" aria-hidden="true"><?php shc_icon( $f[0] ); ?></span><?php echo esc_html( $f[1] ); ?></li>
      <?php endforeach; ?>
    </ul>
    <div class="life-strip">
      <?php echo shc_img( 'supported-living-day-out', array( 'sizes' => '(max-width: 560px) 100vw, 33vw' ) ); // phpcs:ignore ?>
      <?php echo shc_img( 'supported-living-birthday', array( 'sizes' => '(max-width: 560px) 100vw, 33vw' ) ); // phpcs:ignore ?>
      <?php echo shc_img( 'client-evening-out', array( 'sizes' => '(max-width: 560px) 100vw, 33vw' ) ); // phpcs:ignore ?>
    </div>
  </div>
</section>

<!-- ============ WHO CAN ENQUIRE + QUALITY ============ -->
<section class="section section--tint-red" aria-label="Who can enquire and quality">
  <div class="container two-col">
    <div class="plain-card">
      <h2>Who can enquire?</h2>
      <p>Supported living is available for consideration for adults aged 18 and over, with no upper age limit. Suitability depends on assessed needs, our ability to provide safe and appropriate support, compatibility with the home and availability, not age alone.</p>
      <p>We welcome enquiries from:</p>
      <ul class="check-list check-list--red">
        <li>Adults looking for support</li>
        <li>Families and representatives</li>
        <li>Social workers, commissioners and local authorities</li>
        <li>NHS teams and other professionals</li>
      </ul>
    </div>
    <div class="plain-card">
      <h2>Quality and safeguarding</h2>
      <p>Our supported living service is rated Good by the Care Quality Commission<?php echo shc_cqc_date( 'supported_living' ) ? ' (report published ' . esc_html( shc_cqc_date( 'supported_living' ) ) . ')' : ''; ?>. CQC regulates the care and support we provide, not the housing itself.</p>
      <p>Everyone has the right to privacy, to be heard and to raise a concern.</p>
      <p class="trust-links">
        <a href="<?php echo esc_url( shc_cqc_report_url( 'supported_living' ) ); ?>" target="_blank" rel="noopener" data-track="cqc_click">Read the CQC report<span class="visually-hidden"> (opens in a new tab)</span></a>
        <a href="<?php echo shc_url( '/about-us/safeguarding/' ); ?>">Safeguarding</a>
        <a href="<?php echo shc_url( '/about-us/complaints/' ); ?>">Complaints</a>
      </p>
    </div>
  </div>
</section>

<!-- ============ REFERRAL PROCESS + FORM ============ -->
<section class="section" id="referral" aria-labelledby="referral-title">
  <div class="container form-split">
    <div>
      <h2 id="referral-title" class="section-title section-title--red">How the referral process works</h2>
      <ol class="step-list step-list--living">
        <li><strong>Get in touch</strong><span>Tell us about the person’s broad support needs.</span></li>
        <li><strong>Initial discussion</strong><span>We explain the service and consider basic suitability.</span></li>
        <li><strong>Assessment and matching</strong><span>We review needs, preferences, risks and compatibility.</span></li>
        <li><strong>Agree the next steps</strong><span>We explain availability, proposed support and funding or contract arrangements before any placement decision.</span></li>
      </ol>
      <div class="side-contact">
        <p>Prefer to talk?</p>
        <a class="side-contact-phone" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php echo shc_phone_icon( 20 ); // phpcs:ignore ?> <?php shc_echo_phone(); ?></a>
        <p class="small-note">Professionals can also use our <a href="<?php echo shc_url( '/referrals/' ); ?>">referrals page</a>.</p>
      </div>
    </div>
    <?php
    get_template_part(
		'partials/enquiry-form',
		null,
		array(
			'variant' => 'living',
			'title'   => 'Discuss a placement',
			'intro'   => 'Send a few details and our Supported Living team will get back to you.',
			'service' => 'supported-living',
			'button'  => 'Send my enquiry',
		)
	);
	?>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section section--tint-red" aria-labelledby="faq-title">
  <div class="container faq-wrap">
    <h2 id="faq-title" class="section-title section-title--red">Questions about supported living</h2>
    <div class="faq faq--red">
      <?php foreach ( $faqs as $i => $faq ) : ?>
      <h3><button type="button" aria-expanded="false" aria-controls="sl-faq-<?php echo (int) $i; ?>" id="sl-faq-<?php echo (int) $i; ?>-btn"><?php echo esc_html( $faq[0] ); ?></button></h3>
      <div class="faq-panel" id="sl-faq-<?php echo (int) $i; ?>" role="region" aria-labelledby="sl-faq-<?php echo (int) $i; ?>-btn" hidden><p><?php echo esc_html( $faq[1] ); ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php shc_render_stories( 'Stories from Supported Living', 'supported-living' ); ?>

<?php
shc_cta_band(
	array(
		'title'  => 'Discuss a placement',
		'text'   => 'Talk to us about suitability and current availability.',
		'button' => 'Discuss a placement',
		'href'   => shc_url( '/supported-living/#enquiry-form' ),
		'track'  => 'cta_discuss_placement',
	)
);
?>

</main>
<?php get_template_part( 'partials/lightbox' ); ?>
<?php
$faq_entities = array();
foreach ( $faqs as $faq ) {
	$faq_entities[] = array(
		'@type'          => 'Question',
		'name'           => $faq[0],
		'acceptedAnswer' => array(
			'@type' => 'Answer',
			'text'  => $faq[1],
		),
	);
}
printf(
	'<script type="application/ld+json">%s</script>',
	wp_json_encode(
		array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $faq_entities,
		),
		JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
	)
);
get_template_part( 'partials/footer' );
