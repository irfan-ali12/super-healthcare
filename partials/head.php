<?php
/**
 * Document head (no hardcoded title or asset links — handled by WordPress).
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

$description = shc_page_description();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ( '' !== $description ) : ?>
<meta name="description" content="<?php echo esc_attr( $description ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
