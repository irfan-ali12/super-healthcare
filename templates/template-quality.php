<?php
/**
 * Quality & CQC.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Super Healthcare is rated Good by the Care Quality Commission overall and for Safe, Effective, Caring, Responsive and Well-led. Read our latest reports.',
	'theme-neutral'
);
shc_set_document_title( 'Quality & CQC | Super Healthcare' );

$manager = shc_setting( 'registered_manager' );
$post    = get_queried_object();

$evidence = array(
	array( 'plan', 'Person-centred assessment and review', 'Support is planned with each person and reviewed as their needs change.' ),
	array( 'key', 'Choice and independence', 'People are supported to make their own choices and to be as independent as possible.' ),
	array( 'medication', 'Safe support with medicines', 'Staff complete mandatory training, with competency checks before they support with medicines.' ),
	array( 'vetted', 'Robust recruitment', 'Checks include an enhanced DBS check, references and right to work before anyone starts.' ),
	array( 'family-communication', 'Positive family feedback', 'Relatives gave CQC positive feedback, including about staff skills and communication.' ),
);

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<?php
shc_breadcrumb(
	array(
		array( 'About Us', '/about-us/' ),
		array( 'Quality & CQC', '/about-us/quality-and-cqc/' ),
	)
);
?>

<section class="section quality-band quality-band--hero" aria-labelledby="page-title">
  <div class="container quality-grid">
    <div class="quality-head">
      <h1 id="page-title">Independently rated Good by CQC</h1>
      <p>The Care Quality Commission (CQC) is the independent regulator of health and social care in England. It checks whether services are safe, effective, caring, responsive and well-led.</p>
      <p>Our latest assessments rate Super Healthcare Good overall and Good for all five key questions.</p>
    </div>
    <div class="rating-board" role="group" aria-label="CQC ratings">
      <div class="rating rating--overall"><span class="rating-q">Overall</span><span class="rating-v">Good</span></div>
      <?php foreach ( shc_cqc_key_questions() as $q ) : ?>
      <div class="rating"><span class="rating-q"><?php echo esc_html( $q ); ?></span><span class="rating-v">Good</span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="reports-title">
  <div class="container">
    <h2 id="reports-title" class="section-title">Our latest reports</h2>
    <div class="report-cards report-cards--light">
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
    <dl class="fact-list fact-list--compact">
      <div><dt>Registered provider</dt><dd>Super Healthcare Ltd</dd></div>
      <div><dt>CQC location ID</dt><dd>1-6575573200</dd></div>
      <?php if ( $manager ) : ?><div><dt>Registered Manager</dt><dd><?php echo esc_html( $manager ); ?></dd></div><?php endif; ?>
      <div><dt>Registered services</dt><dd>Homecare agency and supported living</dd></div>
      <div><dt>Full profile</dt><dd><a href="<?php echo esc_url( shc_cqc_url() ); ?>" target="_blank" rel="noopener" data-track="cqc_click">View our CQC profile<span class="visually-hidden"> (opens in a new tab)</span></a></dd></div>
    </dl>
  </div>
</section>

<section class="section section--tint" aria-labelledby="evidence-title">
  <div class="container">
    <h2 id="evidence-title" class="section-title">What our latest assessments found</h2>
    <p class="section-intro">A summary of themes from our 2026 CQC assessments. Please read the full reports for CQC’s own words.</p>
    <ul class="feature-grid">
      <?php foreach ( $evidence as $e ) : ?>
      <li class="feature">
        <span class="feature-icon" aria-hidden="true"><?php shc_icon( $e[0] ); ?></span>
        <h3><?php echo esc_html( $e[1] ); ?></h3>
        <p><?php echo esc_html( $e[2] ); ?></p>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php if ( $post instanceof WP_Post && '' !== trim( $post->post_content ) ) : ?>
<section class="section" aria-label="More about quality">
  <div class="container"><div class="prose"><?php echo apply_filters( 'the_content', $post->post_content ); // phpcs:ignore ?></div></div>
</section>
<?php endif; ?>

<section class="section" aria-labelledby="concern-title">
  <div class="container">
    <h2 id="concern-title" class="section-title">Raising a concern</h2>
    <ul class="related-list">
      <li><a href="<?php echo shc_url( '/about-us/safeguarding/' ); ?>"><strong>Safeguarding</strong><span>How we keep people safe and how to raise a concern</span></a></li>
      <li><a href="<?php echo shc_url( '/about-us/complaints/' ); ?>"><strong>Complaints</strong><span>How to tell us when something is not right</span></a></li>
      <li><a href="<?php echo shc_url( '/contact/' ); ?>"><strong>Contact us</strong><span>Speak to our team about any question</span></a></li>
    </ul>
  </div>
</section>

<?php shc_cta_band(); ?>

</main>
<?php
get_template_part( 'partials/footer' );
