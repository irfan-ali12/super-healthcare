<?php
/**
 * Page meta: owner and last reviewed.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register meta box on pages.
 */
function shc_add_page_meta_box() {
	add_meta_box(
		'shc_page_meta',
		__( 'Super Healthcare page meta', 'super-healthcare' ),
		'shc_render_page_meta_box',
		'page',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'shc_add_page_meta_box' );

/**
 * @param WP_Post $post Post.
 */
function shc_render_page_meta_box( $post ) {
	wp_nonce_field( 'shc_save_page_meta', 'shc_page_meta_nonce' );
	$owner    = get_post_meta( $post->ID, 'shc_owner', true );
	$reviewed = get_post_meta( $post->ID, 'shc_reviewed', true );
	?>
	<p>
		<label for="shc_owner"><? esc_html_e( 'Page owner', 'super-healthcare' ); ?></label>
		<input type="text" class="widefat" id="shc_owner" name="shc_owner" value="<?php echo esc_attr( $owner ); ?>">
	</p>
	<p>
		<label for="shc_reviewed"><? esc_html_e( 'Last reviewed', 'super-healthcare' ); ?></label>
		<input type="text" class="widefat" id="shc_reviewed" name="shc_reviewed" value="<?php echo esc_attr( $reviewed ); ?>" placeholder="e.g. 1 October 2026">
	</p>
	<?php
}

/**
 * Save meta box values.
 *
 * @param int $post_id Post ID.
 */
function shc_save_page_meta( $post_id ) {
	if ( ! isset( $_POST['shc_page_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['shc_page_meta_nonce'] ) ), 'shc_save_page_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['shc_owner'] ) ) {
		update_post_meta( $post_id, 'shc_owner', sanitize_text_field( wp_unslash( $_POST['shc_owner'] ) ) );
	}
	if ( isset( $_POST['shc_reviewed'] ) ) {
		update_post_meta( $post_id, 'shc_reviewed', sanitize_text_field( wp_unslash( $_POST['shc_reviewed'] ) ) );
	}
}
add_action( 'save_post_page', 'shc_save_page_meta' );
