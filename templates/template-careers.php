<?php
/**
 * Careers.
 *
 * Recruitment checks are taken from the client's current public website.
 * No vacancies, pay or benefits are listed until HR supplies them.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Careers at Super Healthcare in Westcliff-on-Sea. Find out about working in care at home and supported living, our recruitment checks and training.',
	'theme-neutral'
);
shc_set_document_title( 'Careers in Care | Super Healthcare' );

$email = shc_setting( 'email' );
$post  = get_queried_object();

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<?php shc_breadcrumb( array( array( 'Careers', '/careers/' ) ) ); ?>

<section class="page-hero" aria-labelledby="page-title">
  <div class="container page-hero-grid">
    <div class="page-hero-text">
      <p class="page-hero-kicker kicker--red">Careers</p>
      <h1 id="page-title">Work that makes a real difference</h1>
      <p class="page-hero-support">Join a local team supporting adults to live safely and independently, at home and in supported living. We look for people who are kind, reliable and respectful, and we train and support you to do your best work.</p>
      <div class="page-hero-ctas">
        <?php if ( $email ) : ?>
        <a class="btn btn--red" href="mailto:<?php echo esc_attr( $email ); ?>?subject=<?php echo rawurlencode( 'Careers enquiry' ); ?>" data-track="vacancy_apply">Email us your CV</a>
        <?php endif; ?>
        <a class="btn btn--outline" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click">Call <?php shc_echo_phone(); ?></a>
      </div>
    </div>
    <figure class="page-hero-media">
      <?php echo shc_img( 'team-summer', array( 'priority' => true, 'sizes' => '(max-width: 900px) 100vw, 45vw' ) ); // phpcs:ignore ?>
    </figure>
  </div>
</section>

<section class="section section--tint" aria-labelledby="roles-title">
  <div class="container two-col two-col--wide">
    <div>
      <h2 id="roles-title" class="section-title">The work we do</h2>
      <p>Our team supports adults in their own homes and at our supported living home in Westcliff-on-Sea. That includes personal care, help with medicines, meals, outings and building everyday independence.</p>
      <p>To ask about current vacancies, email us your CV or call the office.</p>
    </div>
    <div>
      <h2 class="section-title">What we look for</h2>
      <ul class="check-list">
        <li>Kindness, patience and respect for people’s choices</li>
        <li>Reliability and good communication</li>
        <li>Willingness to learn and follow care plans</li>
        <li>The right to work in the UK</li>
      </ul>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="process-title">
  <div class="container two-col two-col--wide">
    <div>
      <h2 id="process-title" class="section-title">Our recruitment checks</h2>
      <p>Keeping people safe starts with careful recruitment. Before anyone joins our team, we complete:</p>
      <ul class="check-list">
        <li>A full and enhanced DBS check</li>
        <li>A full work and life history</li>
        <li>At least three references</li>
        <li>A check of your right to work in the UK</li>
      </ul>
      <p>You then complete compulsory training based on your qualifications and experience.</p>
    </div>
    <div class="photo-pair">
      <?php echo shc_img( 'staff-classroom-training', array( 'sizes' => '(max-width: 900px) 100vw, 40vw' ) ); // phpcs:ignore ?>
      <?php echo shc_img( 'staff-moving-and-handling-training', array( 'sizes' => '(max-width: 900px) 100vw, 20vw' ) ); // phpcs:ignore ?>
    </div>
  </div>
</section>

<?php if ( $post instanceof WP_Post && '' !== trim( $post->post_content ) ) : ?>
<section class="section section--tint" aria-label="Vacancies">
  <div class="container"><div class="prose"><?php echo apply_filters( 'the_content', $post->post_content ); // phpcs:ignore ?></div></div>
</section>
<?php endif; ?>

<?php
shc_cta_band(
	array(
		'title'  => 'Interested in joining us?',
		'text'   => 'Send us your CV or call the office to ask about current vacancies.',
		'button' => $email ? 'Email us your CV' : 'Contact us',
		'href'   => $email ? 'mailto:' . $email . '?subject=' . rawurlencode( 'Careers enquiry' ) : shc_url( '/contact/' ),
		'track'  => 'vacancy_apply',
	)
);
?>

</main>
<?php
get_template_part( 'partials/footer' );
