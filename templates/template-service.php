<?php
/**
 * Adult care service page (data-driven).
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

$service = shc_get_current_service();
if ( ! $service ) {
	wp_safe_redirect( shc_url( '/adult-care-at-home/' ) );
	exit;
}

shc_set_document_meta( $service['meta_description'], $service['body_class'] );
shc_set_document_title( $service['title'] );

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );

$cta_query = rawurlencode( $service['cta_service'] );
$cta_href  = shc_url( '/contact/request-an-introduction/' ) . '?service=' . $cta_query;
$slug      = shc_current_service_slug();
?>
<main id="main">

<nav class="breadcrumb container" aria-label="Breadcrumb">
  <ol>
    <li><a href="<?php echo shc_url( '/' ); ?>">Home</a></li>
    <li><a href="<?php echo shc_url( '/adult-care-at-home/' ); ?>">Adult Care at Home</a></li>
    <li><a href="<?php echo esc_url( shc_url( '/adult-care-at-home/' . $slug . '/' ) ); ?>" aria-current="page"><?php echo esc_html( $service['breadcrumb'] ); ?></a></li>
  </ol>
</nav>

<section class="page-hero page-hero--adult" aria-labelledby="page-title">
  <div class="container page-hero-grid">
    <div class="page-hero-text">
      <p class="page-hero-kicker"><?php echo esc_html( $service['kicker'] ); ?></p>
      <h1 id="page-title"><?php echo esc_html( $service['h1'] ); ?></h1>
      <p class="page-hero-support"><?php echo esc_html( $service['intro'] ); ?></p>
      <div class="page-hero-ctas">
        <a class="btn btn--blue" href="<?php echo esc_url( $cta_href ); ?>"><?php echo esc_html( $service['cta_button'] ); ?></a>
        <a class="btn btn--outline" href="<?php echo esc_url( shc_phone_href() ); ?>">Call <?php shc_echo_phone(); ?></a>
      </div>
    </div>
    <figure class="page-hero-media">
      <img src="<?php echo shc_asset( $service['hero_image'] ); ?>" width="526" height="286" alt="<?php echo esc_attr( $service['hero_alt'] ); ?>" fetchpriority="high">
    </figure>
  </div>
</section>

<nav class="jump-nav" aria-label="On this page">
  <div class="container">
    <ul>
      <li><a href="#includes">What it includes</a></li>
      <li><a href="#suits">Who it suits</a></li>
      <li><a href="#begins">How care begins</a></li>
      <li><a href="#faqs">FAQs</a></li>
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

<section class="section section--tint-blue" id="suits" aria-labelledby="suits-title">
  <div class="container split-aside">
    <div>
      <h2 id="suits-title" class="section-title section-title--blue"><?php echo esc_html( $service['suits_title'] ); ?></h2>
      <ul class="check-list">
        <?php foreach ( $service['suits'] as $line ) : ?>
        <li><?php echo esc_html( $line ); ?></li>
        <?php endforeach; ?>
      </ul>
      <?php if ( ! empty( $service['suits_footer_html'] ) ) : ?>
      <p><?php echo wp_kses_post( $service['suits_footer_html'] ); ?></p>
      <?php endif; ?>
    </div>
    <aside class="aside-card" aria-labelledby="aside-title">
      <h3 id="aside-title">Talk to the Adult Care team</h3>
      <p>Tell us what is changing and we will explain your options. There is no obligation.</p>
      <a class="btn btn--blue btn--block" href="<?php echo esc_url( $cta_href ); ?>"><?php echo esc_html( $service['cta_button'] ); ?></a>
      <a class="aside-phone" href="<?php echo esc_url( shc_phone_href() ); ?>"><?php shc_echo_phone(); ?></a>
      <p class="aside-note">Office hours <?php shc_echo_office_hours(); ?></p>
    </aside>
  </div>
</section>

<section class="section" id="begins" aria-labelledby="begins-title">
  <div class="container">
    <h2 id="begins-title" class="section-title section-title--blue">How care begins</h2>
    <ol class="chevron-steps chevron-steps--adult">
      <?php foreach ( $service['steps'] as $step ) : ?>
      <li><strong><?php echo esc_html( $step['title'] ); ?></strong><span><?php echo esc_html( $step['text'] ); ?></span></li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<section class="section section--tint-blue" id="faqs" aria-labelledby="faq-title">
  <div class="container faq-wrap">
    <h2 id="faq-title" class="section-title section-title--blue"><?php echo esc_html( $service['faq_title'] ); ?></h2>
    <div class="faq">
      <?php
      foreach ( $service['faqs'] as $i => $faq ) :
        $n       = $i + 1;
        $btn_id  = 'faq-' . $slug . '-' . $n . '-btn';
        $panel_id = 'faq-' . $slug . '-' . $n;
        ?>
      <h3><button type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $panel_id ); ?>" id="<?php echo esc_attr( $btn_id ); ?>"><?php echo esc_html( $faq['question'] ); ?></button></h3>
      <div class="faq-panel" id="<?php echo esc_attr( $panel_id ); ?>" role="region" aria-labelledby="<?php echo esc_attr( $btn_id ); ?>" hidden>
        <p><?php echo wp_kses_post( $faq['answer'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="related-title">
  <div class="container">
    <h2 id="related-title" class="section-title section-title--blue">Other ways we support adults at home</h2>
    <ul class="related-list">
      <?php foreach ( $service['related'] as $rel ) : ?>
      <li><a href="<?php echo esc_url( shc_url( '/adult-care-at-home/' . $rel['slug'] . '/' ) ); ?>"><strong><?php echo esc_html( $rel['title'] ); ?></strong><span><?php echo esc_html( $rel['text'] ); ?></span></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="cta-band" aria-labelledby="cta-title">
  <div class="container cta-inner">
    <h2 id="cta-title">Let’s talk about the support you need.</h2>
    <div class="cta-actions">
      <a class="btn btn--white" href="<?php echo esc_url( $cta_href ); ?>"><?php echo esc_html( $service['cta_button'] ); ?></a>
      <a class="cta-phone" href="<?php echo esc_url( shc_phone_href() ); ?>"><svg aria-hidden="true" viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg><span>Call <?php shc_echo_phone(); ?></span></a>
    </div>
  </div>
</section>

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
$json_ld = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => $faq_entities,
);
?>
<script type="application/ld+json"><?php echo wp_json_encode( $json_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
<?php
get_template_part( 'partials/footer' );
