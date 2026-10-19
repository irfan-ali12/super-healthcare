<?php
/**
 * Site footer and mobile action bar.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

$is_referrals = 'referrals' === shc_page_context();
?>
<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <a class="logo logo--footer" href="<?php echo shc_url( '/' ); ?>"><img class="site-logo-image" src="<?php echo shc_asset( 'img/new-images/superhealthcare-logo.jpg' ); ?>" width="1208" height="296" alt="Super Healthcare home" loading="lazy"></a>
      <p class="footer-about"><strong>Super Healthcare Ltd</strong> provides personalised care at home and supported living for adults aged 18 and over in Westcliff-on-Sea and the surrounding area.</p>
      <address>
        <?php shc_echo_address(); ?><br>
        <a href="<?php echo esc_url( shc_phone_href() ); ?>" data-track="phone_click"><?php shc_echo_phone(); ?></a><br>
        <?php shc_echo_email_link(); ?>
      </address>
      <ul class="footer-social">
        <?php if ( shc_social_url( 'facebook_url' ) ) : ?>
        <li><a href="<?php echo shc_social_url( 'facebook_url' ); ?>" target="_blank" rel="noopener">Facebook<span class="visually-hidden"> (opens in a new tab)</span></a></li>
        <?php endif; ?>
        <?php if ( shc_social_url( 'instagram_url' ) ) : ?>
        <li><a href="<?php echo shc_social_url( 'instagram_url' ); ?>" target="_blank" rel="noopener">Instagram<span class="visually-hidden"> (opens in a new tab)</span></a></li>
        <?php endif; ?>
        <li><a href="<?php echo shc_map_url(); ?>" target="_blank" rel="noopener">Map<span class="visually-hidden"> (opens Google Maps in a new tab)</span></a></li>
      </ul>
    </div>

    <nav aria-label="Care at Home">
      <h2 class="footer-heading">Care at Home</h2>
      <ul>
        <li><a href="<?php echo shc_url( '/care-at-home/' ); ?>">Overview</a></li>
        <?php foreach ( shc_get_services() as $slug => $svc ) : ?>
        <li><a href="<?php echo shc_url( '/care-at-home/' . $slug . '/' ); ?>"><?php echo esc_html( $svc['nav'] ); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <nav aria-label="Supported Living and more">
      <h2 class="footer-heading">Supported Living</h2>
      <ul>
        <li><a href="<?php echo shc_url( '/supported-living/' ); ?>">Supported Living 18+</a></li>
        <li><a href="<?php echo shc_url( '/supported-living/#property' ); ?>">234 Hamlet Court Road</a></li>
        <li><a href="<?php echo shc_url( '/referrals/' ); ?>">Referrals for professionals</a></li>
      </ul>
      <h2 class="footer-heading footer-heading--spaced">Super Healthcare</h2>
      <ul>
        <li><a href="<?php echo shc_url( '/about-us/' ); ?>">About Us</a></li>
        <li><a href="<?php echo shc_url( '/our-community/' ); ?>">Our Community</a></li>
        <li><a href="<?php echo shc_url( '/careers/' ); ?>">Careers</a></li>
        <li><a href="<?php echo shc_url( '/contact/' ); ?>">Contact</a></li>
      </ul>
    </nav>

    <nav aria-label="Quality and policies">
      <h2 class="footer-heading">Quality and policies</h2>
      <ul>
        <li><a href="<?php echo shc_url( '/about-us/quality-and-cqc/' ); ?>">Quality &amp; CQC</a></li>
        <li><a href="<?php echo esc_url( shc_cqc_url() ); ?>" target="_blank" rel="noopener" data-track="cqc_click">CQC profile<span class="visually-hidden"> (opens in a new tab)</span></a></li>
        <li><a href="<?php echo shc_url( '/about-us/safeguarding/' ); ?>">Safeguarding</a></li>
        <li><a href="<?php echo shc_url( '/about-us/complaints/' ); ?>">Complaints</a></li>
        <li><a href="<?php echo shc_url( '/privacy/' ); ?>">Privacy notice</a></li>
        <li><a href="<?php echo shc_url( '/cookies/' ); ?>">Cookies</a></li>
        <li><a href="<?php echo shc_url( '/accessibility/' ); ?>">Accessibility</a></li>
      </ul>
    </nav>
  </div>
  <div class="container accreditations" aria-labelledby="accreditations-title">
    <h2 class="footer-heading" id="accreditations-title">Regulated, reviewed and listed</h2>
    <ul class="accreditation-list">
      <li>
        <a class="accreditation" href="<?php echo esc_url( shc_cqc_url() ); ?>" target="_blank" rel="noopener" data-track="cqc_click">
          <img src="<?php echo shc_asset( 'img/accreditation/cqc-rated-good.webp' ); ?>" width="640" height="443" alt="Care Quality Commission: inspected and rated Good" loading="lazy">
          <span class="visually-hidden"> (opens our CQC profile in a new tab)</span>
        </a>
      </li>
      <li class="accreditation-item--stacked">
        <?php shc_homecare_seal( 'score-seal--sm' ); ?>
        <a class="accreditation" href="<?php echo esc_url( shc_setting( 'homecare_url' ) ); ?>" target="_blank" rel="noopener" data-track="homecare_click">
          <img src="<?php echo shc_asset( 'img/accreditation/homecare-co-uk.webp' ); ?>" width="486" height="76" alt="homecare.co.uk" loading="lazy">
          <span class="visually-hidden"> reviews (opens in a new tab)</span>
        </a>
      </li>
      <li>
        <a class="accreditation" href="<?php echo esc_url( shc_setting( 'nhs_url' ) ); ?>" target="_blank" rel="noopener" data-track="nhs_click">
          <img src="<?php echo shc_asset( 'img/accreditation/nhs.webp' ); ?>" width="312" height="161" alt="NHS website listing" loading="lazy">
          <span class="visually-hidden"> (opens in a new tab)</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="container footer-base">
    <p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Super Healthcare Ltd. Registered in England and Wales, company number <?php shc_echo_company_number(); ?>.</p>
    <p>Person-centred visiting home care, shaped around you.</p>
  </div>
</footer>

<nav class="mobile-actions" aria-label="Quick contact">
  <a href="<?php echo esc_url( shc_phone_href() ); ?>" class="mobile-action mobile-action--call" data-track="phone_click"><?php echo shc_phone_icon( 18 ); // phpcs:ignore ?> Call</a>
  <?php if ( $is_referrals ) : ?>
  <a href="<?php echo shc_url( '/referrals/#enquiry-form' ); ?>" class="mobile-action mobile-action--enquire" data-track="cta_referral">Refer</a>
  <?php else : ?>
  <a href="<?php echo shc_url( '/contact/#enquiry-form' ); ?>" class="mobile-action mobile-action--enquire" data-track="cta_get_support">Enquire</a>
  <?php endif; ?>
</nav>
<?php wp_footer(); ?>
</body>
</html>
