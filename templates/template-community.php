<?php
/**
 * Our Community: original photography and everyday life.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'See everyday life at Super Healthcare: our people, activities, homes and the moments that make our community in Westcliff-on-Sea special.',
	'theme-neutral'
);
shc_set_document_title( 'Our Community | Super Healthcare' );

$groups = array(
	'life'         => array(
		'title' => 'Life at Super Healthcare',
		'text'  => 'Celebrations, good food and everyday moments together.',
		'items' => array(
			array( 'halloween-celebration', 'Halloween together' ),
			array( 'supported-living-birthday', 'A birthday at home' ),
			array( 'birthday-celebration-with-carers', 'Birthday celebrations' ),
			array( 'friends-lunch-out', 'Lunch with a friend' ),
		),
	),
	'out-and-about' => array(
		'title' => 'Out and about',
		'text'  => 'Trips, local experiences and making the most of the Southend seafront.',
		'items' => array(
			array( 'client-seafront-pier', 'By the seafront' ),
			array( 'supported-living-ice-cream-seafront', 'Ice creams by the sea' ),
			array( 'client-garden-centre-visit', 'A day among the flowers' ),
			array( 'client-cinema-trip', 'A trip to the cinema' ),
			array( 'client-seafront-gardens', 'A walk in the gardens' ),
			array( 'companionship-lunch-out', 'Lunch out' ),
			array( 'client-evening-out', 'An evening out' ),
			array( 'carer-and-client-outing', 'Out together' ),
			array( 'supported-living-day-out', 'A day out' ),
			array( 'client-cafe-visit', 'Cafe visit' ),
		),
	),
	'independence' => array(
		'title' => 'Building independence',
		'text'  => 'Getting out, doing errands and keeping up the routines that matter.',
		'items' => array(
			array( 'carer-helping-client-shopping', 'Choosing a card at the local shop' ),
			array( 'carer-with-client-mobility-scooter', 'Heading out on the scooter' ),
			array( 'carer-walking-with-client-seafront', 'A walk by the sea' ),
		),
	),
	'team'         => array(
		'title' => 'Our team',
		'text'  => 'The people behind the support, from training days to team celebrations.',
		'items' => array(
			array( 'team-christmas', 'Team Christmas celebration' ),
			array( 'team-office', 'In the office' ),
			array( 'staff-moving-and-handling-training', 'Moving and handling training' ),
			array( 'staff-classroom-training', 'Classroom training' ),
			array( 'team-summer', 'Summer get-together' ),
			array( 'team-social', 'Team social' ),
		),
	),
);

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<?php shc_breadcrumb( array( array( 'Our Community', '/our-community/' ) ) ); ?>

<header class="simple-hero community-hero">
  <div class="container">
    <h1>Our Community</h1>
    <p class="page-hero-support">See everyday life at Super Healthcare: our people, activities, homes and the moments that make our community special.</p>
    <nav class="chip-nav" aria-label="Photo categories">
      <ul>
        <?php foreach ( $groups as $id => $g ) : ?>
        <li><a href="#<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $g['title'] ); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
  </div>
</header>

<?php foreach ( $groups as $id => $g ) : ?>
<section class="section community-group" id="<?php echo esc_attr( $id ); ?>" aria-labelledby="<?php echo esc_attr( $id ); ?>-title">
  <div class="container">
    <div class="community-head">
      <h2 id="<?php echo esc_attr( $id ); ?>-title" class="section-title section-title--plain"><?php echo esc_html( $g['title'] ); ?></h2>
      <p><?php echo esc_html( $g['text'] ); ?></p>
    </div>
    <ul class="photo-grid" data-lightbox>
      <?php foreach ( $g['items'] as $item ) : ?>
      <li>
        <figure>
          <button type="button" class="gallery-open" data-full="<?php echo shc_asset( 'img/photos/' . $item[0] . '-1600.webp' ); ?>" data-caption="<?php echo esc_attr( $item[1] ); ?>" aria-label="<?php echo esc_attr( 'Enlarge photo: ' . $item[1] ); ?>">
            <?php echo shc_img( $item[0], array( 'sizes' => '(max-width: 560px) 50vw, (max-width: 1080px) 33vw, 25vw' ) ); // phpcs:ignore ?>
          </button>
          <figcaption><?php echo esc_html( $item[1] ); ?></figcaption>
        </figure>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endforeach; ?>

<?php shc_render_stories( 'Real stories' ); ?>

<?php
shc_cta_band(
	array(
		'title' => 'Would you like to be part of our community?',
		'text'  => 'Talk to us about care at home or supported living, or find out about working with us.',
	)
);
?>

</main>
<?php get_template_part( 'partials/lightbox' ); ?>
<?php
get_template_part( 'partials/footer' );
