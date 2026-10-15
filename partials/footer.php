<?php
/**
 * Site footer.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

$cqc_url = shc_cqc_url_or_default();
?>
<!-- ============ FOOTER ============ -->
<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <a class="logo logo--footer" href="<?php echo shc_url( '/' ); ?>" aria-label="Super Healthcare home"><img class="site-logo-image" src="<?php echo shc_asset( 'img/new-images/superhealthcare-logo.jpg' ); ?>" width="1192" height="321" alt="Super Healthcare logo"></a>
      <p>People first. Independence always.</p>
      <address>
        <?php shc_echo_address(); ?><br>
        <a href="<?php echo esc_url( shc_phone_href() ); ?>"><?php shc_echo_phone(); ?></a><br>
        <?php shc_echo_email_link(); ?>
      </address>
      <div class="footer-social">
        <a href="<?php echo shc_social_url( 'instagram_url' ); ?>" target="_blank" rel="noopener">Instagram</a>
        <a href="<?php echo shc_social_url( 'facebook_url' ); ?>" target="_blank" rel="noopener">Facebook</a>
        <a href="<?php echo shc_map_url(); ?>" target="_blank" rel="noopener">Google Maps</a>
      </div>
    </div>
    <nav aria-label="Adult care">
      <h2 class="footer-heading">Adult Care at Home</h2>
      <ul>
        <li><a href="<?php echo shc_url( '/adult-care-at-home/domcare/' ); ?>">DomCare</a></li>
        <li><a href="<?php echo shc_url( '/adult-care-at-home/live-in-care/' ); ?>">Live-in Care</a></li>
        <li><a href="<?php echo shc_url( '/adult-care-at-home/respite-care/' ); ?>">Respite Care</a></li>
        <li><a href="<?php echo shc_url( '/adult-care-at-home/dementia-care/' ); ?>">Dementia Care</a></li>
        <li><a href="<?php echo shc_url( '/adult-care-at-home/palliative-care/' ); ?>">Palliative Care</a></li>
        <li><a href="<?php echo shc_url( '/adult-care-at-home/companionship/' ); ?>">Companionship</a></li>
      </ul>
    </nav>
    <nav aria-label="Supported accommodation">
      <h2 class="footer-heading">Supported Accommodation 18+</h2>
      <ul>
        <li><a href="<?php echo shc_url( '/supported-accommodation/' ); ?>">Overview</a></li>
        <li><a href="<?php echo shc_url( '/supported-accommodation/our-homes/' ); ?>">Our homes</a></li>
        <li><a href="<?php echo shc_url( '/supported-accommodation/referral-process/' ); ?>">Referral process</a></li>
        <li><a href="<?php echo shc_url( '/professionals/' ); ?>">For professionals</a></li>
        <li><a href="<?php echo shc_url( '/work-with-us/' ); ?>">Work with us</a></li>
      </ul>
    </nav>
    <nav aria-label="Policies">
      <h2 class="footer-heading">Trust and policies</h2>
      <ul>
        <li><a href="<?php echo esc_url( $cqc_url ); ?>" target="_blank" rel="noopener">CQC report<span class="visually-hidden"> (opens in a new tab)</span></a></li>
        <li><a href="<?php echo shc_url( '/about/safeguarding/' ); ?>">Safeguarding</a></li>
        <li><a href="<?php echo shc_url( '/about/policies/complaints/' ); ?>">Complaints</a></li>
        <li><a href="<?php echo shc_url( '/privacy/' ); ?>">Privacy notice</a></li>
        <li><a href="<?php echo shc_url( '/cookies/' ); ?>">Cookies</a></li>
        <li><a href="<?php echo shc_url( '/accessibility/' ); ?>">Accessibility</a></li>
      </ul>
    </nav>
  </div>
  <div class="container footer-base">
    <p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Super Healthcare. Company number <?php shc_echo_company_number(); ?>.</p>
  </div>
</footer>

<!-- Mobile quick actions -->
<div class="mobile-actions" aria-label="Quick contact">
  <a href="<?php echo esc_url( shc_phone_href() ); ?>" class="mobile-action mobile-action--call">Call us</a>
  <a href="<?php echo shc_url( '/contact/request-an-introduction/' ); ?>" class="mobile-action mobile-action--enquire">Enquire</a>
</div>
<?php wp_footer(); ?>
</body>
</html>
