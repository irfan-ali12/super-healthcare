<?php
/**
 * Generic inner page: editor content with section sidebar.
 *
 * Used for Safeguarding, Complaints, Policies, Privacy, Cookies, Accessibility
 * and any other page the client adds.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

$post = get_queried_object();
if ( ! $post instanceof WP_Post ) {
	return;
}

$desc = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 30, '…' );
shc_set_document_meta( $desc, 'theme-neutral' );
shc_set_document_title( get_the_title( $post ) . ' | Super Healthcare' );

$root_id  = shc_section_root_id( $post->ID );
$children = $root_id ? get_pages(
	array(
		'parent'      => $root_id,
		'sort_column' => 'menu_order,post_title',
	)
) : array();

$trail = array();
foreach ( array_reverse( get_post_ancestors( $post->ID ) ) as $ancestor_id ) {
	$trail[] = array( get_the_title( $ancestor_id ), wp_make_link_relative( get_permalink( $ancestor_id ) ) );
}
$trail[] = array( get_the_title( $post ), wp_make_link_relative( get_permalink( $post ) ) );

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<?php shc_breadcrumb( $trail ); ?>

<header class="simple-hero">
  <div class="container">
    <h1><?php echo esc_html( get_the_title( $post ) ); ?></h1>
    <?php if ( has_excerpt( $post ) ) : ?>
    <p class="page-hero-support"><?php echo esc_html( get_the_excerpt( $post ) ); ?></p>
    <?php endif; ?>
  </div>
</header>

<div class="container content-layout<?php echo $children ? '' : ' content-layout--single'; ?>">

  <?php if ( $children ) : ?>
  <aside class="section-nav" aria-label="<?php echo esc_attr( get_the_title( $root_id ) ); ?> section">
    <p class="section-nav-title"><a href="<?php echo esc_url( get_permalink( $root_id ) ); ?>"><?php echo esc_html( get_the_title( $root_id ) ); ?></a></p>
    <ul>
      <?php foreach ( $children as $child ) : ?>
      <li><a href="<?php echo esc_url( get_permalink( $child ) ); ?>"<?php echo (int) $child->ID === (int) $post->ID ? ' aria-current="page"' : ''; ?>><?php echo esc_html( get_the_title( $child ) ); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </aside>
  <?php endif; ?>

  <article class="prose">
    <?php
    if ( '' !== trim( $post->post_content ) ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	} else {
		?>
    <p>For information about <?php echo esc_html( strtolower( get_the_title( $post ) ) ); ?>, please contact our office on <a href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php shc_echo_phone(); ?></a> or email <?php shc_echo_email_link(); ?>.</p>
		<?php
	}

	$owner    = get_post_meta( $post->ID, 'shc_owner', true );
	$reviewed = get_post_meta( $post->ID, 'shc_reviewed', true );
	if ( $owner || $reviewed ) :
		?>
    <p class="page-meta">
      <?php if ( $owner ) : ?>Page owner: <?php echo esc_html( $owner ); ?>.<?php endif; ?>
      <?php if ( $reviewed ) : ?> Last reviewed <?php echo esc_html( $reviewed ); ?>.<?php endif; ?>
    </p>
    <?php endif; ?>
  </article>

</div>

<?php shc_cta_band(); ?>

</main>
<?php
get_template_part( 'partials/footer' );
