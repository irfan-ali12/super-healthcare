<?php
/**
 * Homepage.
 *
 * Order follows section 4 of the October 2026 brief. The page opens with two
 * photo panels (Care at Home in blue, Supported Living in red), as requested
 * in the client's feedback on the hero.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Super Healthcare provides personalised care at home and supported living for adults in Westcliff-on-Sea, Essex. Rated Good by CQC. Call 01702 333 120.'
);
shc_set_document_title( 'Super Healthcare | Care at Home and Supported Living in Westcliff-on-Sea' );

$services     = shc_get_services();
$availability = shc_sl_availability();
$manager      = shc_setting( 'registered_manager' );

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<!-- ============ HERO: two pathways ============ -->
<section class="hero-panels" aria-label="Our services">
  <div class="hero-panel hero-panel--care">
    <?php echo shc_hero_img( 'care' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
    <div class="hero-panel-label">
      <p class="hero-panel-title">Care at Home</p>
      <p class="hero-panel-text">Personalised support for adults and older people in their own homes.</p>
      <a class="hero-panel-cta" href="<?php echo shc_url( '/care-at-home/' ); ?>" data-track="pathway_select_care">Find Care at Home</a>
    </div>
  </div>
  <div class="hero-panel hero-panel--living">
    <?php echo shc_hero_img( 'living' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
    <div class="hero-panel-label">
      <p class="hero-panel-title">Supported Living</p>
      <p class="hero-panel-text">A supportive home for adults aged 18 and over, with no upper age limit.</p>
      <a class="hero-panel-cta" href="<?php echo shc_url( '/supported-living/' ); ?>" data-track="pathway_select_living">Explore Supported Living</a>
    </div>
  </div>
  <div class="hero-seals">
    <?php shc_cqc_seal(); ?>
  </div>
</section>

<!-- ============ PROPOSITION ============ -->
<section class="intro-band" aria-labelledby="hero-title">
  <div class="container intro-grid">
    <div class="intro-copy">
      <p class="brand-line">Person-centred visiting home care, shaped around you.</p>
      <h1 id="hero-title">Personalised care and support to help you live with greater independence</h1>
      <p class="intro-support">Super Healthcare provides personalised care at home and supported living, with support shaped around each person’s needs, choices, routines and goals.</p>
    </div>
    <div class="intro-contact">
      <p class="intro-contact-label">Speak to our team</p>
      <a class="intro-phone" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php echo shc_phone_icon( 24 ); // phpcs:ignore ?><span><?php shc_echo_phone(); ?></span></a>
      <?php if ( shc_response_commitment() ) : ?>
      <p class="intro-commitment"><?php echo esc_html( shc_response_commitment() ); ?></p>
      <?php endif; ?>
      <p class="intro-place"><?php echo shc_get_icons()['location']; // phpcs:ignore ?> Based in Westcliff-on-Sea, Essex</p>
    </div>
  </div>
</section>

<!-- ============ TRUST STRIP ============ -->
<section class="trust-bar" aria-label="Why families trust us">
  <ul class="container trust-bar-list">
    <li><span class="trust-bar-icon" aria-hidden="true"><?php shc_icon( 'shield' ); ?></span><a href="<?php echo esc_url( shc_cqc_url() ); ?>" target="_blank" rel="noopener" data-track="cqc_click">CQC rated Good<span class="visually-hidden"> (opens the CQC profile in a new tab)</span></a></li>
    <li><span class="trust-bar-icon" aria-hidden="true"><?php shc_icon( 'heart' ); ?></span>Person-centred support</li>
    <li><span class="trust-bar-icon" aria-hidden="true"><?php shc_icon( 'vetted' ); ?></span>Trained and vetted staff</li>
    <li><span class="trust-bar-icon" aria-hidden="true"><?php shc_icon( 'phone' ); ?></span><a href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php shc_echo_phone(); ?></a></li>
  </ul>
</section>

<!-- ============ HOW CAN WE HELP ============ -->
<section class="section" aria-labelledby="help-title">
  <div class="container">
    <h2 id="help-title" class="section-title">How can we help?</h2>
    <ul class="route-cards">
      <li class="route-card route-card--care">
        <span class="route-card-icon" aria-hidden="true"><?php shc_icon( 'home' ); ?></span>
        <h3>Care at Home</h3>
        <p>For you or a family member who wants to stay safe, comfortable and independent at home.</p>
        <ul class="route-card-points">
          <li>Visiting care, live-in and respite</li>
          <li>Dementia and palliative support</li>
          <li>A care plan built around your routines</li>
        </ul>
        <a class="btn btn--blue" href="<?php echo shc_url( '/care-at-home/' ); ?>" data-track="pathway_select_care">Find Care at Home</a>
      </li>
      <li class="route-card route-card--living">
        <span class="route-card-icon" aria-hidden="true"><?php shc_icon( 'key' ); ?></span>
        <h3>Supported Living</h3>
        <p>For adults aged 18 and over looking for a supportive home and help to live more independently.</p>
        <ul class="route-card-points">
          <li>Five-bedroom home in Westcliff-on-Sea</li>
          <li>Support with daily living and confidence</li>
          <li>No upper age limit</li>
        </ul>
        <a class="btn btn--red" href="<?php echo shc_url( '/supported-living/' ); ?>" data-track="pathway_select_living">Explore Supported Living</a>
      </li>
      <li class="route-card route-card--pro">
        <span class="route-card-icon" aria-hidden="true"><?php shc_icon( 'referral' ); ?></span>
        <h3>Professional referral</h3>
        <p>For social workers, commissioners, NHS teams and other professionals arranging support.</p>
        <ul class="route-card-points">
          <li>Services and client groups</li>
          <li>Assessment and onboarding</li>
          <li>Quality, safeguarding and CQC</li>
        </ul>
        <a class="btn btn--ink" href="<?php echo shc_url( '/referrals/' ); ?>" data-track="cta_referral">Make a referral</a>
      </li>
    </ul>
  </div>
</section>

<!-- ============ WHY SUPER HEALTHCARE ============ -->
<section class="section section--tint" aria-labelledby="why-title">
  <div class="container why-grid">
    <div class="why-intro">
      <h2 id="why-title" class="section-title section-title--plain">Why Super Healthcare?</h2>
      <p>We would rather show you than tell you. Everything here is backed by our independent CQC assessments or our own published processes.</p>
      <a class="text-link" href="<?php echo shc_url( '/about-us/quality-and-cqc/' ); ?>">See our quality and CQC information</a>
    </div>
    <ul class="why-list">
      <li>
        <span class="why-icon" aria-hidden="true"><?php shc_icon( 'shield' ); ?></span>
        <div><h3>Rated Good in all five areas</h3><p>CQC rates us Good for being safe, effective, caring, responsive and well-led.</p></div>
      </li>
      <li>
        <span class="why-icon" aria-hidden="true"><?php shc_icon( 'plan' ); ?></span>
        <div><h3>Support planned with you</h3><p>Person-centred assessments and regular reviews, so support changes when you do.</p></div>
      </li>
      <li>
        <span class="why-icon" aria-hidden="true"><?php shc_icon( 'vetted' ); ?></span>
        <div><h3>Careful recruitment</h3><p>Enhanced DBS checks, at least three references and right to work checks for every member of staff.</p></div>
      </li>
      <li>
        <span class="why-icon" aria-hidden="true"><?php shc_icon( 'training' ); ?></span>
        <div><h3>Trained and checked staff</h3><p>Mandatory training, with competency checks for staff who support with medicines.</p></div>
      </li>
    </ul>
  </div>
</section>

<!-- ============ HOW SUPPORT STARTS ============ -->
<section class="section" aria-labelledby="start-title">
  <div class="container">
    <h2 id="start-title" class="section-title">How support starts</h2>
    <ol class="step-flow">
      <?php foreach ( shc_care_journey() as $step ) : ?>
      <li><strong><?php echo esc_html( $step['title'] ); ?></strong><span><?php echo esc_html( $step['text'] ); ?></span></li>
      <?php endforeach; ?>
    </ol>
    <p class="step-flow-note">For Supported Living, assessment also looks at compatibility with the home and the people living there. <a href="<?php echo shc_url( '/supported-living/#referral' ); ?>">See how a placement works</a>.</p>
  </div>
</section>

<!-- ============ CARE AT HOME OVERVIEW ============ -->
<section class="section section--care" aria-labelledby="care-title">
  <div class="container feature-split">
    <div class="feature-split-media">
      <?php echo shc_img( 'ai-respite', array( 'class' => 'feature-split-img', 'sizes' => '(max-width: 900px) 100vw, 45vw' ) ); // phpcs:ignore ?>
    </div>
    <div class="feature-split-body">
      <h2 id="care-title" class="section-title section-title--blue">Care at Home</h2>
      <p class="lead">The right support can help you stay safe, comfortable and independent in your own home.</p>
      <ul class="service-rows">
        <?php foreach ( $services as $slug => $svc ) : ?>
        <li><a href="<?php echo shc_url( '/care-at-home/' . $slug . '/' ); ?>"><strong><?php echo esc_html( $svc['nav'] ); ?></strong><span><?php echo esc_html( $svc['card'] ); ?></span></a></li>
        <?php endforeach; ?>
      </ul>
      <div class="button-row">
        <a class="btn btn--blue" href="<?php echo shc_url( '/contact/?service=domcare#enquiry-form' ); ?>" data-track="cta_care_assessment">Arrange a free care assessment</a>
        <a class="btn btn--outline" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click">Speak to our care team</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ SUPPORTED LIVING OVERVIEW ============ -->
<section class="section section--living" aria-labelledby="living-title">
  <div class="container feature-split feature-split--flip">
    <div class="feature-split-media feature-split-media--duo">
      <?php echo shc_img( 'home-kitchen', array( 'class' => 'feature-split-img', 'sizes' => '(max-width: 900px) 100vw, 45vw' ) ); // phpcs:ignore ?>
      <?php echo shc_img( 'home-garden-seating', array( 'class' => 'feature-split-inset', 'sizes' => '(max-width: 900px) 50vw, 20vw' ) ); // phpcs:ignore ?>
    </div>
    <div class="feature-split-body">
      <h2 id="living-title" class="section-title section-title--red">Supported Living</h2>
      <p class="lead">Your own space. A supportive home. Opportunities to grow.</p>
      <p>Our five-bedroom supported living home at 234 Hamlet Court Road, Westcliff-on-Sea, is for adults aged 18 and over, with no upper age limit. Whether someone wants to develop new skills or maintain existing abilities, we work towards goals that matter to them.</p>
      <ul class="tag-list" aria-label="Support can focus on">
        <li>Daily routines</li><li>Cooking and shopping</li><li>Budgeting</li><li>Appointments</li><li>Community and friendships</li><li>Confidence</li>
      </ul>
      <p class="availability-line">
        <?php if ( $availability ) : ?>
          <strong>Availability:</strong> <?php echo esc_html( $availability['status'] ); ?><?php echo $availability['updated'] ? ' (updated ' . esc_html( $availability['updated'] ) . ')' : ''; ?>.
        <?php else : ?>
          Contact us to check current availability. Every placement is subject to individual assessment.
        <?php endif; ?>
      </p>
      <div class="button-row">
        <a class="btn btn--red" href="<?php echo shc_url( '/supported-living/#enquiry-form' ); ?>" data-track="cta_discuss_placement">Discuss a placement</a>
        <a class="btn btn--outline" href="<?php echo shc_url( '/supported-living/' ); ?>">Explore Supported Living</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ CQC AND QUALITY ============ -->
<section class="section quality-band" aria-labelledby="cqc-title">
  <div class="container quality-grid">
    <div class="quality-head">
      <h2 id="cqc-title" class="section-title section-title--plain">Independently rated Good by CQC</h2>
      <p>The Care Quality Commission is the independent regulator of health and social care in England. Our latest assessments rate us Good overall and Good in all five key questions.</p>
      <ul class="report-links">
        <li><a href="<?php echo esc_url( shc_cqc_report_url( 'homecare' ) ); ?>" target="_blank" rel="noopener" data-track="cqc_click">Care at Home report<span class="visually-hidden"> (opens in a new tab)</span></a><?php echo shc_cqc_date( 'homecare' ) ? '<span>Published ' . esc_html( shc_cqc_date( 'homecare' ) ) . '</span>' : ''; ?></li>
        <li><a href="<?php echo esc_url( shc_cqc_report_url( 'supported_living' ) ); ?>" target="_blank" rel="noopener" data-track="cqc_click">Supported Living report<span class="visually-hidden"> (opens in a new tab)</span></a><?php echo shc_cqc_date( 'supported_living' ) ? '<span>Published ' . esc_html( shc_cqc_date( 'supported_living' ) ) . '</span>' : ''; ?></li>
      </ul>
    </div>
    <div class="rating-board" role="group" aria-label="CQC ratings">
      <div class="rating rating--overall"><span class="rating-q">Overall</span><span class="rating-v">Good</span></div>
      <?php foreach ( shc_cqc_key_questions() as $q ) : ?>
      <div class="rating"><span class="rating-q"><?php echo esc_html( $q ); ?></span><span class="rating-v">Good</span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php shc_render_stories( 'Real stories' ); ?>

<!-- ============ MEET THE TEAM ============ -->
<section class="section" aria-labelledby="team-title">
  <div class="container team-split">
    <div class="team-mosaic">
      <?php echo shc_img( 'team-christmas', array( 'class' => 'team-mosaic-a', 'sizes' => '(max-width: 900px) 100vw, 40vw' ) ); // phpcs:ignore ?>
      <?php echo shc_img( 'staff-classroom-training', array( 'class' => 'team-mosaic-b', 'sizes' => '(max-width: 900px) 50vw, 20vw' ) ); // phpcs:ignore ?>
      <?php echo shc_img( 'team-summer', array( 'class' => 'team-mosaic-c', 'sizes' => '(max-width: 900px) 50vw, 20vw' ) ); // phpcs:ignore ?>
    </div>
    <div class="team-copy">
      <h2 id="team-title" class="section-title section-title--plain">Meet the team</h2>
      <p class="lead">Real people, based in Westcliff-on-Sea.</p>
      <p>Our carers and support workers are local, trained and supported to do their best work. <?php if ( $manager ) : ?>Our service is led by our Registered Manager, <?php echo esc_html( $manager ); ?>.<?php endif; ?></p>
      <div class="button-row">
        <a class="btn btn--outline" href="<?php echo shc_url( '/about-us/' ); ?>">About us</a>
        <a class="text-link" href="<?php echo shc_url( '/our-community/' ); ?>">See life at Super Healthcare</a>
      </div>
    </div>
  </div>
</section>

<?php shc_cta_band(); ?>

</main>
<?php
get_template_part( 'partials/footer' );
