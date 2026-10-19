<?php
/**
 * Site header and primary navigation.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

$services   = shc_get_services();
$care_cur   = shc_in_section( '/care-at-home/' ) ? ' is-current' : '';
$about_cur  = shc_in_section( '/about-us/' ) ? ' is-current' : '';
?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to main content', 'super-healthcare' ); ?></a>

<header class="site-header">
  <div class="container header-inner">
    <a class="logo" href="<?php echo shc_url( '/' ); ?>">
      <img class="site-logo-image" src="<?php echo shc_asset( 'img/new-images/superhealthcare-logo.jpg' ); ?>" width="1208" height="296" alt="Super Healthcare home">
    </a>

    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
      <span class="menu-toggle-bars" aria-hidden="true"></span>
      Menu
    </button>

    <nav class="primary-nav" id="primary-nav" aria-label="Main">
      <ul class="nav-list">
        <li class="has-dropdown">
          <button class="nav-link dropdown-toggle<?php echo esc_attr( $care_cur ); ?>" type="button" aria-expanded="false" aria-controls="dd-care">Care at Home</button>
          <div class="dropdown dropdown--mega" id="dd-care">
            <div class="mega-services">
              <p class="mega-heading"><a href="<?php echo shc_url( '/care-at-home/' ); ?>"<?php echo shc_in_section( '/care-at-home/' ) && '/care-at-home/' === shc_current_path() ? ' aria-current="page"' : ''; ?>>Care at Home overview</a></p>
              <ul class="mega-list">
                <?php foreach ( $services as $slug => $svc ) : ?>
                <li><a href="<?php echo shc_url( '/care-at-home/' . $slug . '/' ); ?>"<?php echo shc_nav_current_attr( '/care-at-home/' . $slug . '/' ); ?>><strong><?php echo esc_html( $svc['nav'] ); ?></strong><span><?php echo esc_html( $svc['card'] ); ?></span></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="mega-aside">
              <p class="mega-aside-title">Not sure what you need?</p>
              <p>We will listen, explain your options and arrange an assessment.</p>
              <a class="btn btn--blue btn--sm" href="<?php echo shc_url( '/contact/?service=domcare#enquiry-form' ); ?>" data-track="cta_care_assessment">Arrange a free care assessment</a>
              <a class="mega-phone" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php echo shc_phone_icon( 16 ); // phpcs:ignore ?> <?php shc_echo_phone(); ?></a>
            </div>
          </div>
        </li>
        <li><a class="nav-link" href="<?php echo shc_url( '/supported-living/' ); ?>"<?php echo shc_nav_current_attr( '/supported-living/' ); ?>>Supported Living</a></li>
        <li><a class="nav-link" href="<?php echo shc_url( '/referrals/' ); ?>"<?php echo shc_nav_current_attr( '/referrals/' ); ?>>Referrals</a></li>
        <li><a class="nav-link" href="<?php echo shc_url( '/our-community/' ); ?>"<?php echo shc_nav_current_attr( '/our-community/' ); ?>>Our Community</a></li>
        <li class="has-dropdown">
          <button class="nav-link dropdown-toggle<?php echo esc_attr( $about_cur ); ?>" type="button" aria-expanded="false" aria-controls="dd-about">About Us</button>
          <div class="dropdown dropdown--list" id="dd-about">
            <ul>
              <li><a href="<?php echo shc_url( '/about-us/' ); ?>"<?php echo '/about-us/' === shc_current_path() ? ' aria-current="page"' : ''; ?>>About Super Healthcare</a></li>
              <li><a href="<?php echo shc_url( '/about-us/quality-and-cqc/' ); ?>"<?php echo shc_nav_current_attr( '/about-us/quality-and-cqc/' ); ?>>Quality &amp; CQC</a></li>
              <li><a href="<?php echo shc_url( '/about-us/safeguarding/' ); ?>"<?php echo shc_nav_current_attr( '/about-us/safeguarding/' ); ?>>Safeguarding</a></li>
              <li><a href="<?php echo shc_url( '/about-us/complaints/' ); ?>"<?php echo shc_nav_current_attr( '/about-us/complaints/' ); ?>>Complaints</a></li>
              <li><a href="<?php echo shc_url( '/about-us/policies/' ); ?>"<?php echo shc_nav_current_attr( '/about-us/policies/' ); ?>>Policies</a></li>
            </ul>
          </div>
        </li>
        <li><a class="nav-link" href="<?php echo shc_url( '/careers/' ); ?>"<?php echo shc_nav_current_attr( '/careers/' ); ?>>Careers</a></li>
        <li><a class="nav-link" href="<?php echo shc_url( '/contact/' ); ?>"<?php echo shc_nav_current_attr( '/contact/' ); ?>>Contact</a></li>
      </ul>
      <div class="nav-mobile-actions">
        <a class="btn btn--red btn--block" href="<?php echo shc_url( '/contact/#enquiry-form' ); ?>" data-track="cta_get_support">Get support</a>
        <a class="btn btn--outline btn--block" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click">Call <?php shc_echo_phone(); ?></a>
      </div>
    </nav>

    <div class="header-actions">
      <a class="header-phone" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click">
        <span class="header-phone-label">Need help?</span>
        <span class="header-phone-number"><?php echo shc_phone_icon( 16 ); // phpcs:ignore ?><?php shc_echo_phone(); ?></span>
      </a>
      <a class="header-call" href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click" aria-label="Call us on <?php echo esc_attr( shc_phone() ); ?>" title="Call <?php echo esc_attr( shc_phone() ); ?>"><?php echo shc_phone_icon( 20 ); // phpcs:ignore ?></a>
      <a class="btn btn--red btn--sm" href="<?php echo shc_url( '/contact/#enquiry-form' ); ?>" data-track="cta_get_support">Get support</a>
    </div>
  </div>
</header>
