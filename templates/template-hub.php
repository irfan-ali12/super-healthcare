<?php
/**
 * Adult Care at Home hub.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

shc_set_document_meta(
	'Care at home for adults and older people: DomCare visits, live-in care, respite, dementia, palliative care and companionship, built around your routines.',
	'theme-adult'
);
shc_set_document_title( 'Adult Care at Home | Super Healthcare' );

get_template_part( 'partials/head' );
get_template_part( 'partials/header' );
?>
<main id="main">
<?php require SHC_THEME_DIR . '/templates/content/adult-care-at-home.php'; ?>
</main>
<?php
get_template_part( 'partials/footer' );
