<?php
/**
 * Site header.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

$mega_class = 'nav-link mega-toggle';
if ( shc_nav_services_is_current() ) {
	$mega_class .= ' is-current';
}
?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to main content', 'super-healthcare' ); ?></a>

<!-- ============ HEADER ============ -->
<header class="site-header">
  <div class="container header-inner">
    <a class="logo" href="<?php echo shc_url( '/' ); ?>" aria-label="Super Healthcare home">
      <img class="site-logo-image" src="<?php echo shc_asset( 'img/new-images/superhealthcare-logo.jpg' ); ?>" width="1192" height="321" alt="Super Healthcare logo">
    </a>

    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
      <span class="menu-toggle-bars" aria-hidden="true"></span>
      Menu
    </button>

    <nav class="primary-nav" id="primary-nav" aria-label="Main">
      <ul class="nav-list">
        <li class="has-mega">
          <button class="<?php echo esc_attr( $mega_class ); ?>" type="button" aria-expanded="false" aria-controls="mega-services">Services</button>
          <div class="mega" id="mega-services">
            <div class="mega-col mega-col--adult">
              <p class="mega-heading"><a href="<?php echo shc_url( '/adult-care-at-home/' ); ?>">Adult Care at Home</a></p>
              <ul>
                <li><a href="<?php echo shc_url( '/adult-care-at-home/domcare/' ); ?>">DomCare (domiciliary care)</a></li>
                <li><a href="<?php echo shc_url( '/adult-care-at-home/live-in-care/' ); ?>">Live-in Care</a></li>
                <li><a href="<?php echo shc_url( '/adult-care-at-home/respite-care/' ); ?>">Respite Care</a></li>
                <li><a href="<?php echo shc_url( '/adult-care-at-home/dementia-care/' ); ?>">Dementia Care</a></li>
                <li><a href="<?php echo shc_url( '/adult-care-at-home/palliative-care/' ); ?>">Palliative Care</a></li>
                <li><a href="<?php echo shc_url( '/adult-care-at-home/companionship/' ); ?>">Companionship</a></li>
              </ul>
            </div>
            <div class="mega-col mega-col--young">
              <p class="mega-heading"><a href="<?php echo shc_url( '/supported-accommodation/' ); ?>">Supported Accommodation 18+</a></p>
              <ul>
                <li><a href="<?php echo shc_url( '/supported-accommodation/' ); ?>">Overview</a></li>
                <li><a href="<?php echo shc_url( '/supported-accommodation/our-homes/' ); ?>">Our homes</a></li>
                <li><a href="<?php echo shc_url( '/supported-accommodation/life-skills/' ); ?>">Life skills</a></li>
                <li><a href="<?php echo shc_url( '/supported-accommodation/education-and-employment/' ); ?>">Education and employment</a></li>
                <li><a href="<?php echo shc_url( '/supported-accommodation/referral-process/' ); ?>">Referral process</a></li>
                <li><a href="<?php echo shc_url( '/supported-accommodation/faqs/' ); ?>">FAQs</a></li>
              </ul>
            </div>
          </div>
        </li>
        <li><a class="nav-link" href="<?php echo shc_url( '/stories/' ); ?>"<?php echo shc_nav_current_attr( '/stories/' ); ?>>Stories</a></li>
        <li><a class="nav-link" href="<?php echo shc_url( '/about/' ); ?>"<?php echo shc_nav_current_attr( '/about/' ); ?>>About</a></li>
        <li><a class="nav-link" href="<?php echo shc_url( '/professionals/' ); ?>"<?php echo shc_nav_current_attr( '/professionals/' ); ?>>Professionals</a></li>
        <li><a class="nav-link" href="<?php echo shc_url( '/work-with-us/' ); ?>"<?php echo shc_nav_current_attr( '/work-with-us/' ); ?>>Work with us</a></li>
        <li><a class="nav-link" href="<?php echo shc_url( '/contact/' ); ?>"<?php echo shc_nav_current_attr( '/contact/' ); ?>>Contact</a></li>
      </ul>
    </nav>

    <div class="header-actions">
      <a class="header-phone" href="<?php echo esc_url( shc_phone_href() ); ?>">
        <svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg>
        <?php shc_echo_phone(); ?>
      </a>
      <a class="btn btn--red btn--sm" href="<?php echo shc_url( '/contact/request-an-introduction/' ); ?>">Request an introduction</a>
    </div>
  </div>
</header>
