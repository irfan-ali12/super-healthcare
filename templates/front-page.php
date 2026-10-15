<?php
/**
 * Front page template.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Care at home for adults and older people, and supported accommodation for young adults aged 18 and over. CQC rated Good. Call 01702 333 120.'
);
shc_set_document_title( 'Super Healthcare | Adult Care and Supported Accommodation' );

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">
<?php require SHC_THEME_DIR . '/templates/content/index.php'; ?>
</main>
<?php
get_template_part( 'partials/footer' );
