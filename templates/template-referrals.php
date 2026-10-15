<?php
/**
 * Referrals & Professional Partnerships.
 *
 * Decision-led journey for social workers, commissioners, NHS teams and case
 * managers: eligibility, service model, capacity, quality, funding, referral.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Referrals and professional partnerships: care at home and supported living for adults in Westcliff-on-Sea. CQC rated Good. Make a referral or discuss a placement.',
	'theme-pro'
);
shc_set_document_title( 'Referrals & Professional Partnerships | Super Healthcare' );
shc_set_page_context( 'referrals' );

$availability = shc_sl_availability();
$manager      = shc_setting( 'registered_manager' );

$specialisms = array(
	'Adults aged 65 and over',
	'Adults under 65',
	'Dementia',
	'Learning disabilities',
	'Mental health conditions',
	'Physical disabilities',
	'Sensory impairments',
);

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<?php shc_breadcrumb( array( array( 'Referrals', '/referrals/' ) ) ); ?>

<section class="pro-hero" aria-labelledby="page-title">
  <div class="container pro-hero-grid">
    <div>
      <p class="page-hero-kicker">For professionals</p>
      <h1 id="page-title">Referrals &amp; Professional Partnerships</h1>
      <p class="page-hero-support">Working with social workers, commissioners, local authorities, NHS teams and other professionals to arrange appropriate care and support.</p>
      <div class="page-hero-ctas">
        <a class="btn btn--red" href="#enquiry-form" data-track="cta_referral">Make a professional referral</a>
        <a class="btn btn--outline-light" href="<?php echo shc_url( '/supported-living/#enquiry-form' ); ?>" data-track="cta_discuss_placement">Discuss a placement</a>
      </div>
      <p class="pro-hero-phone">Speak to the referrals team: <a href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php shc_echo_phone(); ?></a></p>
    </div>
    <aside class="glance" aria-labelledby="glance-title">
      <h2 id="glance-title">At a glance</h2>
      <dl>
        <div><dt>Services</dt><dd>Care at Home (domiciliary care) and Supported Living</dd></div>
        <div><dt>Regulator</dt><dd>CQC rated Good, overall and in all five key questions</dd></div>
        <div><dt>Based in</dt><dd>Westcliff-on-Sea, Essex. We confirm coverage for each referral.</dd></div>
        <div><dt>Supported Living</dt><dd>Five-bedroom home, 234 Hamlet Court Road. Adults 18+, no upper age limit.</dd></div>
        <div><dt>Capacity</dt><dd><?php echo $availability ? esc_html( $availability['status'] ) . ( $availability['updated'] ? ' (updated ' . esc_html( $availability['updated'] ) . ')' : '' ) : 'Contact us for current capacity'; ?></dd></div>
        <?php if ( $manager ) : ?><div><dt>Registered Manager</dt><dd><?php echo esc_html( $manager ); ?></dd></div><?php endif; ?>
      </dl>
    </aside>
  </div>
</section>

<section class="section" aria-labelledby="groups-title">
  <div class="container two-col two-col--wide">
    <div>
      <h2 id="groups-title" class="section-title">Services and client groups</h2>
      <div class="service-model">
        <div class="service-model-item service-model-item--care">
          <h3><a href="<?php echo shc_url( '/care-at-home/' ); ?>">Care at Home</a></h3>
          <p>Visiting care, live-in care, respite, dementia and palliative support in a person’s own home.</p>
        </div>
        <div class="service-model-item service-model-item--living">
          <h3><a href="<?php echo shc_url( '/supported-living/' ); ?>">Supported Living</a></h3>
          <p>Individualised support for adults aged 18+ at our five-bedroom home in Westcliff-on-Sea.</p>
        </div>
      </div>
    </div>
    <div>
      <h3 class="subhead">Specialisms listed on our CQC registration</h3>
      <ul class="pill-list pill-list--ink">
        <?php foreach ( $specialisms as $s ) : ?><li><?php echo esc_html( $s ); ?></li><?php endforeach; ?>
      </ul>
      <p class="small-note">Registration shows the groups we are registered to support. Every referral is assessed individually.</p>
    </div>
  </div>
</section>

<section class="section section--tint" aria-labelledby="eligibility-title">
  <div class="container two-col two-col--wide">
    <div>
      <h2 id="eligibility-title" class="section-title">Eligibility and referral criteria</h2>
      <ul class="check-list">
        <li>Adults aged 18 and over. Supported living has no upper age limit.</li>
        <li>Acceptance depends on assessed needs, risks and our ability to meet them safely and appropriately.</li>
        <li>For supported living, we also consider compatibility with the home and the people living there.</li>
        <li>We will always be clear with you if we cannot safely meet someone’s needs.</li>
      </ul>
    </div>
    <div>
      <h2 class="section-title">Funding and contracting</h2>
      <p>Funding routes and contract arrangements are discussed and confirmed with you as part of each referral, before any placement or start date is agreed.</p>
      <p>Funding eligibility is assessed by the relevant body. We never assume or promise funding on anyone’s behalf.</p>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="onboarding-title">
  <div class="container">
    <h2 id="onboarding-title" class="section-title">Assessment and onboarding</h2>
    <ol class="step-flow step-flow--pro">
      <li><strong>Referral</strong><span>Send broad needs and timescales using the form below or by phone.</span></li>
      <li><strong>Initial discussion</strong><span>We confirm coverage, capacity and basic suitability.</span></li>
      <li><strong>Assessment</strong><span>Needs, preferences, risks and, for supported living, compatibility.</span></li>
      <li><strong>Agree the package</strong><span>Support plan, funding and contract arrangements agreed.</span></li>
      <li><strong>Start and review</strong><span>Planned transition, then regular reviews with all involved.</span></li>
    </ol>
  </div>
</section>

<section class="section quality-band" aria-labelledby="gov-title">
  <div class="container quality-grid">
    <div class="quality-head">
      <h2 id="gov-title" class="section-title section-title--plain">Quality, safeguarding and governance</h2>
      <ul class="gov-list">
        <li>Rated Good by CQC overall and for Safe, Effective, Caring, Responsive and Well-led.</li>
        <li>Person-centred assessment and review.</li>
        <li>Enhanced DBS, full work history, three references and right to work checks for all staff.</li>
        <li>Mandatory training, with competency checks for staff supporting with medicines.</li>
      </ul>
      <p class="trust-links trust-links--light">
        <a href="<?php echo shc_url( '/about-us/safeguarding/' ); ?>">Safeguarding</a>
        <a href="<?php echo shc_url( '/about-us/quality-and-cqc/' ); ?>">Quality &amp; CQC</a>
      </p>
    </div>
    <div class="report-cards">
      <a class="report-card" href="<?php echo esc_url( shc_cqc_report_url( 'homecare' ) ); ?>" target="_blank" rel="noopener" data-track="cqc_click">
        <span class="report-card-label">Care at Home (homecare)</span>
        <span class="report-card-rating">Good</span>
        <?php if ( shc_cqc_date( 'homecare' ) ) : ?><span class="report-card-date">Published <?php echo esc_html( shc_cqc_date( 'homecare' ) ); ?></span><?php endif; ?>
        <span class="report-card-link">Read the report<span class="visually-hidden"> (opens in a new tab)</span></span>
      </a>
      <a class="report-card" href="<?php echo esc_url( shc_cqc_report_url( 'supported_living' ) ); ?>" target="_blank" rel="noopener" data-track="cqc_click">
        <span class="report-card-label">Supported Living</span>
        <span class="report-card-rating">Good</span>
        <?php if ( shc_cqc_date( 'supported_living' ) ) : ?><span class="report-card-date">Published <?php echo esc_html( shc_cqc_date( 'supported_living' ) ); ?></span><?php endif; ?>
        <span class="report-card-link">Read the report<span class="visually-hidden"> (opens in a new tab)</span></span>
      </a>
    </div>
  </div>
</section>

<section class="section" id="refer" aria-labelledby="form-title">
  <div class="container form-split">
    <div>
      <h2 class="section-title">Make a referral</h2>
      <p>Use this form to start a referral or ask about capacity. Please share broad needs only. We will call you to arrange a secure transfer of personal and clinical information.</p>
      <div class="side-contact">
        <p>Speak to the referrals team</p>
        <a class="side-contact-phone" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php echo shc_phone_icon( 20 ); // phpcs:ignore ?> <?php shc_echo_phone(); ?></a>
        <p><?php shc_echo_email_link(); ?></p>
        <?php if ( shc_response_commitment() ) : ?><p class="small-note"><?php echo esc_html( shc_response_commitment() ); ?></p><?php endif; ?>
      </div>
    </div>
    <?php
    get_template_part(
		'partials/enquiry-form',
		null,
		array(
			'variant' => 'referral',
			'title'   => 'Professional referral',
			'service' => '',
			'button'  => 'Send referral enquiry',
		)
	);
	?>
  </div>
</section>

</main>
<?php
get_template_part( 'partials/footer' );
