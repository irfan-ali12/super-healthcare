<?php
/**
 * About Us.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'About Super Healthcare Ltd: a CQC rated Good provider of care at home and supported living, based in Westcliff-on-Sea, Essex. Meet the team behind our support.',
	'theme-neutral'
);
shc_set_document_title( 'About Us | Super Healthcare' );

$manager = shc_setting( 'registered_manager' );
$post    = get_queried_object();

$values = array(
	array( 'heart', 'Dignity and respect', 'Every person is treated as an individual, with their privacy, choices and identity respected.' ),
	array( 'wellbeing', 'Health and wellbeing', 'Support that looks after physical and mental wellbeing, working with families and healthcare professionals.' ),
	array( 'companionship', 'Positive engagement', 'Warm, consistent relationships between the people we support, their families and our team.' ),
	array( 'hobbies-community', 'Active lives', 'Helping people enjoy regular activities and stay connected with their community, as far as they are able.' ),
);

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<?php shc_breadcrumb( array( array( 'About Us', '/about-us/' ) ) ); ?>

<section class="page-hero" aria-labelledby="page-title">
  <div class="container page-hero-grid">
    <div class="page-hero-text">
      <p class="page-hero-kicker kicker--red">About Super Healthcare</p>
      <h1 id="page-title">People first. Independence always.</h1>
      <p class="page-hero-support">Super Healthcare Ltd provides personalised care at home and supported living for adults in Westcliff-on-Sea and the surrounding area. We believe people have the right to live as independently as possible, in a safe and comfortable home, with support shaped around them.</p>
      <p class="page-hero-trust"><?php shc_icon( 'shield' ); ?> Rated Good by the Care Quality Commission</p>
    </div>
    <figure class="page-hero-media">
      <?php echo shc_img( 'team-christmas', array( 'priority' => true, 'sizes' => '(max-width: 900px) 100vw, 45vw' ) ); // phpcs:ignore ?>
    </figure>
  </div>
</section>

<section class="section section--tint" aria-labelledby="values-title">
  <div class="container">
    <h2 id="values-title" class="section-title">What we stand for</h2>
    <ul class="feature-grid feature-grid--4">
      <?php foreach ( $values as $v ) : ?>
      <li class="feature">
        <span class="feature-icon" aria-hidden="true"><?php shc_icon( $v[0] ); ?></span>
        <h3><?php echo esc_html( $v[1] ); ?></h3>
        <p><?php echo esc_html( $v[2] ); ?></p>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="section" aria-labelledby="team-title">
  <div class="container team-split">
    <div class="team-mosaic">
      <?php echo shc_img( 'team-office', array( 'class' => 'team-mosaic-a', 'sizes' => '(max-width: 900px) 100vw, 40vw' ) ); // phpcs:ignore ?>
      <?php echo shc_img( 'team-social', array( 'class' => 'team-mosaic-b', 'sizes' => '(max-width: 900px) 50vw, 20vw' ) ); // phpcs:ignore ?>
      <?php echo shc_img( 'staff-moving-and-handling-training', array( 'class' => 'team-mosaic-c', 'sizes' => '(max-width: 900px) 50vw, 20vw' ) ); // phpcs:ignore ?>
    </div>
    <div class="team-copy">
      <h2 id="team-title" class="section-title section-title--plain">Meet the team</h2>
      <p class="lead">A local team, trained and supported to do their best work.</p>
      <?php if ( $manager ) : ?>
      <div class="person-card">
        <span class="person-card-icon" aria-hidden="true"><?php shc_icon( 'person' ); ?></span>
        <div>
          <p class="person-card-name"><?php echo esc_html( $manager ); ?></p>
          <p class="person-card-role">Registered Manager and Nominated Individual</p>
        </div>
      </div>
      <?php endif; ?>
      <p>Our Registered Manager is responsible for the quality and safety of the care we provide, and is registered with the Care Quality Commission.</p>
      <div class="button-row">
        <a class="btn btn--outline" href="<?php echo shc_url( '/careers/' ); ?>">Join our team</a>
        <a class="text-link" href="<?php echo shc_url( '/our-community/#team' ); ?>">See more of our team</a>
      </div>
    </div>
  </div>
</section>

<section class="section section--tint" aria-labelledby="recruit-title">
  <div class="container two-col two-col--wide">
    <div>
      <h2 id="recruit-title" class="section-title">How we recruit and train</h2>
      <p>Before anyone joins our team, we complete:</p>
      <ul class="check-list">
        <li>A full and enhanced DBS check</li>
        <li>A full work and life history</li>
        <li>At least three references</li>
        <li>A check of their right to work in the UK</li>
      </ul>
      <p>New staff complete compulsory training based on their qualifications and experience.</p>
    </div>
    <div>
      <h2 class="section-title">Where we are</h2>
      <address class="address-block"><?php shc_echo_address(); ?></address>
      <p><a class="text-link" href="<?php echo shc_map_url(); ?>" target="_blank" rel="noopener">View on Google Maps<span class="visually-hidden"> (opens in a new tab)</span></a></p>
      <p>Company number <?php shc_echo_company_number(); ?></p>
    </div>
  </div>
</section>

<?php if ( $post instanceof WP_Post && '' !== trim( $post->post_content ) ) : ?>
<section class="section" aria-label="More about us">
  <div class="container"><div class="prose"><?php echo apply_filters( 'the_content', $post->post_content ); // phpcs:ignore ?></div></div>
</section>
<?php endif; ?>

<section class="section" aria-labelledby="more-title">
  <div class="container">
    <h2 id="more-title" class="section-title">Quality, safety and accountability</h2>
    <ul class="related-list">
      <li><a href="<?php echo shc_url( '/about-us/quality-and-cqc/' ); ?>"><strong>Quality &amp; CQC</strong><span>Our ratings and the latest CQC reports</span></a></li>
      <li><a href="<?php echo shc_url( '/about-us/safeguarding/' ); ?>"><strong>Safeguarding</strong><span>How we keep people safe and how to raise a concern</span></a></li>
      <li><a href="<?php echo shc_url( '/about-us/complaints/' ); ?>"><strong>Complaints</strong><span>How to tell us when something is not right</span></a></li>
    </ul>
  </div>
</section>

<?php shc_cta_band(); ?>

</main>
<?php
get_template_part( 'partials/footer' );
