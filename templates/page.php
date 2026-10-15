<?php
/**
 * Generic inner page with editor content and section sidebar.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

$post = get_queried_object();
if ( ! $post instanceof WP_Post ) {
	return;
}

$desc = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 35, '…' );
shc_set_document_meta( $desc, 'theme-neutral' );
shc_set_document_title( get_the_title( $post ) . ' | Super Healthcare' );

$root_id   = shc_section_root_id( $post->ID );
$root_post = get_post( $root_id );
$ancestors = array_reverse( get_post_ancestors( $post->ID ) );

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">

<nav class="breadcrumb container" aria-label="Breadcrumb">
  <ol>
    <li><a href="<?php echo shc_url( '/' ); ?>">Home</a></li>
    <?php
    foreach ( $ancestors as $ancestor_id ) {
		$ancestor = get_post( $ancestor_id );
		if ( ! $ancestor ) {
			continue;
		}
		?>
    <li><a href="<?php echo esc_url( get_permalink( $ancestor ) ); ?>"><?php echo esc_html( get_the_title( $ancestor ) ); ?></a></li>
    <?php } ?>
    <li><a href="<?php echo esc_url( get_permalink( $post ) ); ?>" aria-current="page"><?php the_title(); ?></a></li>
  </ol>
</nav>

<header class="simple-hero">
  <div class="container">
    <h1><?php the_title(); ?></h1>
    <?php if ( has_excerpt( $post ) ) : ?>
    <p class="page-hero-support"><?php echo esc_html( get_the_excerpt( $post ) ); ?></p>
    <?php endif; ?>
  </div>
</header>

<div class="container content-layout">

  <?php if ( $root_post ) : ?>
  <aside class="section-nav" aria-label="<?php echo esc_attr( get_the_title( $root_post ) ); ?> section">
    <p class="section-nav-title"><?php echo esc_html( get_the_title( $root_post ) ); ?></p>
    <ul>
      <?php
      $section_pages = get_pages(
			array(
				'parent'      => $root_id,
				'sort_column' => 'menu_order,post_title',
			)
		);
      foreach ( $section_pages as $section_page ) {
			$current = ( (int) $section_page->ID === (int) $post->ID ) ? ' aria-current="page"' : '';
			printf(
				'<li><a href="%1$s"%2$s>%3$s</a></li>',
				esc_url( get_permalink( $section_page ) ),
				$current,
				esc_html( get_the_title( $section_page ) )
			);
		}
      ?>
    </ul>
  </aside>
  <?php endif; ?>

  <article class="prose">
    <?php
    while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;

		$owner    = get_post_meta( $post->ID, 'shc_owner', true );
		$reviewed = get_post_meta( $post->ID, 'shc_reviewed', true );
		if ( $owner || $reviewed ) :
			?>
    <p class="page-meta">
      <?php if ( $owner ) : ?>Page owner <?php echo esc_html( $owner ); ?>.<?php endif; ?>
      <?php if ( $reviewed ) : ?> Last reviewed <?php echo esc_html( $reviewed ); ?>.<?php endif; ?>
    </p>
    <?php endif; ?>
  </article>

</div>

<section class="cta-band" aria-labelledby="cta-title">
  <div class="container cta-inner">
    <h2 id="cta-title">Let’s talk about the support you need.</h2>
    <div class="cta-actions">
      <a class="btn btn--white" href="<?php echo shc_url( '/contact/request-an-introduction/' ); ?>">Request an introduction</a>
      <a class="cta-phone" href="<?php echo esc_url( shc_phone_href() ); ?>"><svg aria-hidden="true" viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg><span>Call <?php shc_echo_phone(); ?></span></a>
    </div>
  </div>
</section>

</main>
<?php
get_template_part( 'partials/footer' );
