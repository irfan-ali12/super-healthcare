<?php
/**
 * Care at Home hub.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Care at home in Westcliff-on-Sea: visiting care, live-in care, respite, dementia and palliative support, planned around your routines. Rated Good by CQC.',
	'theme-care'
);
shc_set_document_title( 'Care at Home in Westcliff-on-Sea | Super Healthcare' );

$services   = shc_get_services();
$assess_url = shc_url( '/contact/?service=domcare#enquiry-form' );

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<?php shc_breadcrumb( array( array( 'Care at Home', '/care-at-home/' ) ) ); ?>

<section class="page-hero page-hero--care" aria-labelledby="page-title">
  <div class="container page-hero-grid">
    <div class="page-hero-text">
      <p class="page-hero-kicker">Care at Home</p>
      <h1 id="page-title">Care at Home in Westcliff-on-Sea</h1>
      <p class="page-hero-lead">The right support can help you stay safe, comfortable and independent in your own home.</p>
      <p class="page-hero-support">Whether you need a few visits a week, a short break for a family carer or someone living with you, we build care around your routines, your preferences and what matters to you.</p>
      <div class="page-hero-ctas">
        <a class="btn btn--blue" href="<?php echo esc_url( $assess_url ); ?>" data-track="cta_care_assessment">Arrange a free care assessment</a>
        <a class="btn btn--outline" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click">Speak to our care team</a>
      </div>
      <p class="page-hero-trust"><?php shc_icon( 'shield' ); ?> Care at Home rated Good by CQC<?php echo shc_cqc_date( 'homecare' ) ? ', report published ' . esc_html( shc_cqc_date( 'homecare' ) ) : ''; ?></p>
    </div>
    <figure class="page-hero-media">
      <?php echo shc_img( 'carer-with-client-mobility-scooter', array( 'priority' => true, 'sizes' => '(max-width: 900px) 100vw, 45vw' ) ); // phpcs:ignore ?>
    </figure>
  </div>
</section>

<section class="section" aria-labelledby="services-title">
  <div class="container">
    <h2 id="services-title" class="section-title section-title--blue">Choose the support that fits</h2>
    <p class="section-intro">Not sure which is right? Most people start with a conversation and an assessment, and we recommend the right mix from there.</p>
    <ul class="service-grid">
      <?php foreach ( $services as $slug => $svc ) : ?>
      <li class="service-card">
        <?php echo shc_img( $svc['image'], array( 'sizes' => '(max-width: 560px) 100vw, (max-width: 1080px) 50vw, 33vw' ) ); // phpcs:ignore ?>
        <div class="service-card-body">
          <h3><a href="<?php echo shc_url( '/care-at-home/' . $slug . '/' ); ?>"><?php echo esc_html( $svc['nav'] ); ?></a></h3>
          <p><?php echo esc_html( $svc['card'] ); ?></p>
          <span class="service-card-more" aria-hidden="true">Find out more</span>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="section section--tint" aria-labelledby="compare-title">
  <div class="container">
    <h2 id="compare-title" class="section-title section-title--blue">Which option fits your situation?</h2>
    <div class="table-wrap" role="region" aria-labelledby="compare-title" tabindex="0">
      <table class="compare-table">
        <thead><tr><th scope="col">If you…</th><th scope="col">You might consider</th></tr></thead>
        <tbody>
          <tr><td>Need help at certain times of day, such as mornings and evenings</td><td><a href="<?php echo shc_url( '/care-at-home/domcare/' ); ?>">DomCare visits</a></td></tr>
          <tr><td>Need support throughout the day and night but want to stay at home</td><td><a href="<?php echo shc_url( '/care-at-home/live-in-care/' ); ?>">Live-in Care</a></td></tr>
          <tr><td>Are a family carer who needs a break, during the day or overnight</td><td><a href="<?php echo shc_url( '/care-at-home/respite-care/' ); ?>">Respite Care</a></td></tr>
          <tr><td>Are living with dementia, or supporting someone who is</td><td><a href="<?php echo shc_url( '/care-at-home/dementia-care/' ); ?>">Dementia Care</a></td></tr>
          <tr><td>Want comfort and support at home towards the end of life</td><td><a href="<?php echo shc_url( '/care-at-home/palliative-care/' ); ?>">Palliative Care</a></td></tr>
          <tr><td>Are mostly independent but would like company and a helping hand</td><td><a href="<?php echo shc_url( '/care-at-home/companionship/' ); ?>">Companionship</a></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="journey-title">
  <div class="container">
    <h2 id="journey-title" class="section-title section-title--blue">Your care journey</h2>
    <ol class="step-flow step-flow--care">
      <?php foreach ( shc_care_journey() as $step ) : ?>
      <li><strong><?php echo esc_html( $step['title'] ); ?></strong><span><?php echo esc_html( $step['text'] ); ?></span></li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<section class="section section--flush-top" aria-labelledby="funding-title">
  <div class="container">
    <div class="info-panel">
      <div>
        <h2 id="funding-title">Paying for care</h2>
        <p>After your assessment we give you a written quotation, so you know what is included before support starts. Some people pay privately and some receive help from their council or the NHS. Funding eligibility is assessed by the relevant body, and we are happy to explain the next steps.</p>
      </div>
      <ul class="link-list">
        <li><a href="https://www.gov.uk/apply-needs-assessment-social-services" target="_blank" rel="noopener">Request a needs assessment on GOV.UK<span class="visually-hidden"> (opens in a new tab)</span></a></li>
        <li><a href="https://www.nhs.uk/social-care-and-support/money-work-and-benefits/nhs-continuing-healthcare/" target="_blank" rel="noopener">NHS Continuing Healthcare<span class="visually-hidden"> (opens in a new tab)</span></a></li>
        <li><a href="<?php echo shc_url( '/contact/?service=domcare#enquiry-form' ); ?>">Ask us about costs</a></li>
      </ul>
    </div>
  </div>
</section>

<?php shc_render_stories( 'Stories from Care at Home', 'care-at-home' ); ?>

<?php
shc_cta_band(
	array(
		'title'  => 'Not sure what support you need?',
		'text'   => 'Speak to our care team. We will listen, explain your options and arrange an assessment.',
		'button' => 'Arrange a free care assessment',
		'href'   => $assess_url,
		'track'  => 'cta_care_assessment',
	)
);
?>

</main>
<?php
get_template_part( 'partials/footer' );
