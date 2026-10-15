<?php
/**
 * Supported Accommodation hub.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Safe supported accommodation for young adults aged 18 and over, with help to build everyday skills and move towards education, training or work.',
	'theme-young'
);
shc_set_document_title( 'Supported Accommodation for Young Adults | Super Healthcare' );

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">
<?php require SHC_THEME_DIR . '/templates/content/supported-accommodation.php'; ?>
</main>
<?php
get_template_part( 'partials/footer' );
