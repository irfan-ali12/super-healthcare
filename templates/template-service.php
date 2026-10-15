<?php
/**
 * Care at Home service page (data from inc/services.php).
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

$service = shc_get_current_service();
if ( ! $service ) {
	wp_safe_redirect( shc_url( '/care-at-home/' ) );
	exit;
}

$slug     = shc_current_service_slug();
$services = shc_get_services();
$cta_href = shc_url( '/contact/?service=' . rawurlencode( $service['cta_service'] ) . '#enquiry-form' );

shc_set_document_meta( $service['meta_description'], 'theme-care' );
shc_set_document_title( $service['title'] );

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<?php
shc_breadcrumb(
	array(
		array( 'Care at Home', '/care-at-home/' ),
		array( $service['nav'], '/care-at-home/' . $slug . '/' ),
	)
);
?>

<section class="page-hero page-hero--care" aria-labelledby="page-title">
  <div class="container page-hero-grid">
    <div class="page-hero-text">
      <p class="page-hero-kicker"><?php echo esc_html( $service['kicker'] ); ?></p>
      <h1 id="page-title"><?php echo esc_html( $service['h1'] ); ?></h1>
      <p class="page-hero-support"><?php echo esc_html( $service['intro'] ); ?></p>
      <div class="page-hero-ctas">
        <a class="btn btn--blue" href="<?php echo esc_url( $cta_href ); ?>" data-track="cta_care_assessment">Arrange a free care assessment</a>
        <a class="btn btn--outline" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click">Speak to our care team</a>
      </div>
    </div>
    <figure class="page-hero-media">
      <?php echo shc_img( $service['image'], array( 'priority' => true, 'sizes' => '(max-width: 900px) 100vw, 45vw' ) ); // phpcs:ignore ?>
    </figure>
  </div>
</section>

<nav class="jump-nav" aria-label="On this page">
  <div class="container">
    <ul>
      <li><a href="#includes">What it includes</a></li>
      <li><a href="#suits">Who it suits</a></li>
      <li><a href="#journey">How care begins</a></li>
      <li><a href="#faqs">Questions</a></li>
    </ul>
  </div>
</nav>

<section class="section" id="includes" aria-labelledby="includes-title">
  <div class="container">
    <h2 id="includes-title" class="section-title section-title--blue"><?php echo esc_html( $service['includes_title'] ); ?></h2>
    <p class="section-intro"><?php echo esc_html( $service['includes_intro'] ); ?></p>
    <ul class="feature-grid">
      <?php foreach ( $service['includes'] as $item ) : ?>
      <li class="feature">
        <span class="feature-icon" aria-hidden="true"><?php shc_icon( $item['icon'] ); ?></span>
        <h3><?php echo esc_html( $item['title'] ); ?></h3>
        <p><?php echo esc_html( $item['text'] ); ?></p>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="section section--tint" id="suits" aria-labelledby="suits-title">
  <div class="container split-aside">
    <div>
      <h2 id="suits-title" class="section-title section-title--blue"><?php echo esc_html( $service['suits_title'] ); ?></h2>
      <ul class="check-list">
        <?php foreach ( $service['suits'] as $line ) : ?>
        <li><?php echo esc_html( $line ); ?></li>
        <?php endforeach; ?>
      </ul>
      <?php if ( ! empty( $service['suits_footer'] ) ) : ?>
      <p><?php echo wp_kses_post( $service['suits_footer'] ); ?></p>
      <?php endif; ?>
    </div>
    <aside class="aside-card" aria-labelledby="aside-title">
      <h3 id="aside-title">Talk to our care team</h3>
      <p>Tell us what is changing and we will explain your options. There is no obligation.</p>
      <a class="btn btn--blue btn--block" href="<?php echo esc_url( $cta_href ); ?>" data-track="cta_care_assessment">Arrange a free care assessment</a>
      <a class="aside-phone" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php shc_echo_phone(); ?></a>
      <?php if ( shc_setting( 'office_hours' ) ) : ?>
      <p class="aside-note"><?php echo esc_html( shc_setting( 'office_hours' ) ); ?></p>
      <?php elseif ( shc_response_commitment() ) : ?>
      <p class="aside-note"><?php echo esc_html( shc_response_commitment() ); ?></p>
      <?php endif; ?>
    </aside>
  </div>
</section>

<section class="section" id="journey" aria-labelledby="journey-title">
  <div class="container">
    <h2 id="journey-title" class="section-title section-title--blue">How care begins</h2>
    <ol class="step-flow step-flow--care">
      <?php foreach ( $service['steps'] as $step ) : ?>
      <li><strong><?php echo esc_html( $step['title'] ); ?></strong><span><?php echo esc_html( $step['text'] ); ?></span></li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<section class="section section--tint" id="faqs" aria-labelledby="faq-title">
  <div class="container faq-wrap">
    <h2 id="faq-title" class="section-title section-title--blue">Your questions answered</h2>
    <div class="faq">
      <?php
      foreach ( $service['faqs'] as $i => $faq ) :
        $panel_id = 'faq-' . $slug . '-' . ( $i + 1 );
        ?>
      <h3><button type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $panel_id ); ?>" id="<?php echo esc_attr( $panel_id ); ?>-btn"><?php echo esc_html( $faq['question'] ); ?></button></h3>
      <div class="faq-panel" id="<?php echo esc_attr( $panel_id ); ?>" role="region" aria-labelledby="<?php echo esc_attr( $panel_id ); ?>-btn" hidden>
        <p><?php echo wp_kses_post( $faq['answer'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="related-title">
  <div class="container">
    <h2 id="related-title" class="section-title section-title--blue">Other ways we support people at home</h2>
    <ul class="related-list">
      <?php foreach ( $service['related'] as $rel ) : ?>
        <?php if ( isset( $services[ $rel ] ) ) : ?>
      <li><a href="<?php echo shc_url( '/care-at-home/' . $rel . '/' ); ?>"><strong><?php echo esc_html( $services[ $rel ]['nav'] ); ?></strong><span><?php echo esc_html( $services[ $rel ]['card'] ); ?></span></a></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php
shc_cta_band(
	array(
		'title'  => 'Let’s talk about the support you need',
		'text'   => 'Arrange a free care assessment, or call and speak to our care team.',
		'button' => 'Arrange a free care assessment',
		'href'   => $cta_href,
		'track'  => 'cta_care_assessment',
	)
);
?>

</main>
<?php
$faq_entities = array();
foreach ( $service['faqs'] as $faq ) {
	$faq_entities[] = array(
		'@type'          => 'Question',
		'name'           => wp_strip_all_tags( $faq['question'] ),
		'acceptedAnswer' => array(
			'@type' => 'Answer',
			'text'  => wp_strip_all_tags( $faq['answer'] ),
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
