<?php
/**
 * Stories: approved testimonials and case studies.
 *
 * The homepage only shows stories that are published AND have a consent
 * reference recorded, so placeholder or unapproved quotes can never appear.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the story post type.
 */
function shc_register_story_type() {
	register_post_type(
		'shc_story',
		array(
			'labels'        => array(
				'name'          => __( 'Stories', 'super-healthcare' ),
				'singular_name' => __( 'Story', 'super-healthcare' ),
				'add_new_item'  => __( 'Add story', 'super-healthcare' ),
				'edit_item'     => __( 'Edit story', 'super-healthcare' ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'menu_icon'     => 'dashicons-format-quote',
			'menu_position' => 25,
			'supports'      => array( 'title', 'excerpt' ),
		)
	);
}
add_action( 'init', 'shc_register_story_type' );

/**
 * Story field definitions.
 *
 * @return array<string, string>
 */
function shc_story_fields() {
	return array(
		'shc_story_attribution' => 'Attribution (e.g. "Daughter of a person we support" or "Anonymous")',
		'shc_story_service'     => 'Service (care-at-home or supported-living)',
		'shc_story_situation'   => 'Situation',
		'shc_story_support'     => 'Support we provided',
		'shc_story_outcome'     => 'Outcome',
		'shc_story_consent'     => 'Consent reference (required to publish on the website)',
		'shc_story_review'      => 'Review date',
	);
}

/**
 * Meta box for story fields.
 */
function shc_story_meta_box() {
	add_meta_box( 'shc_story_details', __( 'Story details', 'super-healthcare' ), 'shc_render_story_box', 'shc_story', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'shc_story_meta_box' );

/**
 * Render the story meta box.
 *
 * @param WP_Post $post Post.
 */
function shc_render_story_box( $post ) {
	wp_nonce_field( 'shc_save_story', 'shc_story_nonce' );
	echo '<p>' . esc_html__( 'Put the exact approved quotation in the Excerpt box. Only stories with a consent reference appear on the website.', 'super-healthcare' ) . '</p>';
	foreach ( shc_story_fields() as $key => $label ) {
		$val  = get_post_meta( $post->ID, $key, true );
		$long = in_array( $key, array( 'shc_story_situation', 'shc_story_support', 'shc_story_outcome' ), true );
		printf( '<p><label for="%1$s"><strong>%2$s</strong></label><br>', esc_attr( $key ), esc_html( $label ) );
		if ( $long ) {
			printf( '<textarea class="widefat" rows="3" id="%1$s" name="%1$s">%2$s</textarea></p>', esc_attr( $key ), esc_textarea( $val ) );
		} else {
			printf( '<input class="widefat" type="text" id="%1$s" name="%1$s" value="%2$s"></p>', esc_attr( $key ), esc_attr( $val ) );
		}
	}
}

/**
 * Save story fields.
 *
 * @param int $post_id Post ID.
 */
function shc_save_story( $post_id ) {
	if ( ! isset( $_POST['shc_story_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['shc_story_nonce'] ) ), 'shc_save_story' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( array_keys( shc_story_fields() ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post_shc_story', 'shc_save_story' );

/**
 * Approved stories (published with a consent reference).
 *
 * @param int    $limit   Max stories.
 * @param string $service Optional service filter.
 * @return WP_Post[]
 */
function shc_get_approved_stories( $limit = 2, $service = '' ) {
	$meta = array(
		array(
			'key'     => 'shc_story_consent',
			'value'   => '',
			'compare' => '!=',
		),
	);
	if ( $service ) {
		$meta[] = array(
			'key'   => 'shc_story_service',
			'value' => $service,
		);
	}
	return get_posts(
		array(
			'post_type'      => 'shc_story',
			'post_status'    => 'publish',
			'posts_per_page' => $limit,
			'meta_query'     => $meta, // phpcs:ignore WordPress.DB.SlowDBQuery
		)
	);
}

/**
 * Render a stories section if approved stories exist.
 *
 * @param string $title   Section title.
 * @param string $service Optional service filter.
 */
function shc_render_stories( $title = 'Real stories', $service = '' ) {
	$stories = shc_get_approved_stories( 2, $service );
	if ( ! $stories ) {
		return;
	}
	?>
<section class="section stories" aria-labelledby="stories-title">
  <div class="container">
    <h2 id="stories-title" class="section-title"><?php echo esc_html( $title ); ?></h2>
    <div class="story-grid">
      <?php foreach ( $stories as $story ) : ?>
        <?php
        $svc     = get_post_meta( $story->ID, 'shc_story_service', true );
        $outcome = get_post_meta( $story->ID, 'shc_story_outcome', true );
        ?>
      <article class="story <?php echo 'supported-living' === $svc ? 'story--living' : 'story--care'; ?>">
        <h3 class="story-title"><?php echo esc_html( get_the_title( $story ) ); ?></h3>
        <?php if ( has_excerpt( $story ) ) : ?>
        <blockquote><p><?php echo esc_html( get_the_excerpt( $story ) ); ?></p></blockquote>
        <?php endif; ?>
        <p class="story-attrib"><?php echo esc_html( get_post_meta( $story->ID, 'shc_story_attribution', true ) ); ?></p>
        <?php if ( $outcome ) : ?><p class="story-outcome"><?php echo esc_html( $outcome ); ?></p><?php endif; ?>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
	<?php
}
