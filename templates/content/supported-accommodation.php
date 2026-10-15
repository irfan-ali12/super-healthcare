<?php
/** Auto-converted from src/supported-accommodation.html — dynamic phone/CQC/settings handled in parent template where noted. */
?>

<nav class="breadcrumb container" aria-label="Breadcrumb">
  <ol>
    <li><a href="<?php echo shc_url('/'); ?>">Home</a></li>
    <li><a href="<?php echo shc_url('/supported-accommodation/'); ?>" aria-current="page">Supported Accommodation 18+</a></li>
  </ol>
</nav>

<!-- ============ HERO (full-bleed photo, text panel) ============ -->
<section class="sa-hero" aria-labelledby="page-title">
  <img class="sa-hero-img" src="<?php echo shc_asset('img/hero-young-adults.webp'); ?>" width="994" height="470" alt="Four young adults working together on a laptop at a kitchen table" fetchpriority="high">
  <div class="container">
    <div class="sa-hero-panel">
      <p class="page-hero-kicker">Supported Accommodation 18+</p>
      <h1 id="page-title">A home. A plan. A future.</h1>
      <p class="page-hero-support">Safe supported accommodation for young adults aged 18 and over, with practical help to build confidence, everyday skills and a pathway towards education, training or employment.</p>
      <div class="page-hero-ctas">
        <a class="btn btn--red" href="<?php echo shc_url('/supported-accommodation/our-homes/'); ?>">Explore our homes</a>
        <a class="btn btn--outline" href="<?php echo shc_url('/professionals/referral-form/'); ?>">Make a referral</a>
      </div>
      <p class="easy-read-link"><a href="<?php echo shc_url('/supported-accommodation/easy-read/'); ?>">Read this page in Easy Read</a></p>
    </div>
  </div>
</section>

<!-- Availability notice: CMS managed, dated, owned, auto-expires -->
<?php if ( shc_sa_notice_visible() ) : ?>
<div class="container">
  <div class="notice" role="status">
    <p><strong>Current availability:</strong> <?php shc_echo_sa_availability_status(); ?>. Updated <?php shc_echo_sa_availability_updated(); ?>. Places are only confirmed after assessment and funding agreement.</p>
  </div>
</div>
<?php endif; ?>

<!-- ============ WHO WE SUPPORT ============ -->
<section class="section" aria-labelledby="who-title">
  <div class="container split-aside split-aside--wide">
    <div>
      <h2 id="who-title" class="section-title section-title--red">Who we support</h2>
      <p class="lead">Young adults aged 18 and over who need a safe place to live and personalised support to build their independence.</p>
      <dl class="fact-list">
        <div><dt>Age</dt><dd>18 and over <span class="placeholder-inline">[confirm upper age if any]</span></dd></div>
        <div><dt>Areas</dt><dd><span class="placeholder-inline">[approved service areas]</span></dd></div>
        <div><dt>Referrals from</dt><dd><span class="placeholder-inline">[e.g. local authorities, leaving care teams, self referral]</span></dd></div>
        <div><dt>Funding</dt><dd><span class="placeholder-inline">[approved funding routes]</span></dd></div>
        <div><dt>Not suitable for</dt><dd><span class="placeholder-inline">[approved exclusions]</span></dd></div>
      </dl>
    </div>
    <aside class="aside-card aside-card--red" aria-labelledby="pro-title">
      <h3 id="pro-title">Referring a young person?</h3>
      <p>Check eligibility, current capacity and our referral process in the professionals area.</p>
      <a class="btn btn--red btn--block" href="<?php echo shc_url('/professionals/referral-form/'); ?>">Make a referral</a>
      <a class="aside-phone" href="<?php echo esc_url( shc_phone_href() ); ?>">01702 333 120</a>
    </aside>
  </div>
</section>

<!-- ============ A PLACE TO CALL HOME (gallery) ============ -->
<section class="section section--tint-red" aria-labelledby="home-title">
  <div class="container">
    <h2 id="home-title" class="section-title section-title--red">A place to call home</h2>
    <div class="gallery">
      <figure class="gallery-main">
        <img src="<?php echo shc_asset('img/safe-accommodation.webp'); ?>" width="490" height="332" alt="A bright bedroom with a double bed, desk and plants by the window" loading="lazy">
        <figcaption>Bedroom</figcaption>
      </figure>
      <figure>
        <img src="<?php echo shc_asset('img/life-skills.webp'); ?>" width="492" height="332" alt="A shared kitchen where a young man is cooking" loading="lazy">
        <figcaption>Shared kitchen</figcaption>
      </figure>
      <figure>
        <img src="<?php echo shc_asset('img/education-employment.webp'); ?>" width="490" height="336" alt="A shared table used for studying" loading="lazy">
        <figcaption>Space to study</figcaption>
      </figure>
    </div>
    <ul class="pill-list" aria-label="Home features">
      <li>Private bedroom</li><li>Shared lounge and kitchen</li><li>Visitors policy</li><li>Close to transport</li><li>Local shops and services</li><li>Accessibility details on request</li>
    </ul>
    <p class="small-note"><span class="placeholder-inline">[Confirm features for each home]</span> For safety, we do not publish the addresses of our homes. <a href="<?php echo shc_url('/supported-accommodation/our-homes/'); ?>">See more of our homes</a>.</p>
  </div>
</section>

<!-- ============ WHAT SUPPORT LOOKS LIKE (alternating) ============ -->
<section class="section" aria-labelledby="support-title">
  <div class="container">
    <h2 id="support-title" class="section-title section-title--red">Support that builds independence</h2>

    <div class="media-row">
      <img src="<?php echo shc_asset('img/life-skills.webp'); ?>" width="492" height="332" alt="A young man cooking a meal in a shared kitchen" loading="lazy">
      <div>
        <h3>Independent living skills</h3>
        <p>Practical help with the everyday things that make independent life work.</p>
        <ul class="tag-list"><li>Cooking</li><li>Cleaning</li><li>Budgeting</li><li>Shopping</li><li>Appointments</li><li>Travel</li><li>Tenancy responsibilities</li></ul>
      </div>
    </div>

    <div class="media-row media-row--flip">
      <img src="<?php echo shc_asset('img/education-employment.webp'); ?>" width="490" height="336" alt="Two young adults working on a CV together" loading="lazy">
      <div>
        <h3>Education and employment</h3>
        <p>Support to take the next step, whether that is college, training, volunteering or a first job.</p>
        <ul class="tag-list"><li>CVs</li><li>Applications</li><li>Interview preparation</li><li>College and training</li><li>Volunteering</li></ul>
      </div>
    </div>

    <div class="media-row">
      <img src="<?php echo shc_asset('img/community-wellbeing.webp'); ?>" width="492" height="336" alt="Three young adults walking together outdoors" loading="lazy">
      <div>
        <h3>Community and wellbeing</h3>
        <p>Health, interests and relationships matter as much as practical skills.</p>
        <ul class="tag-list"><li>Health access</li><li>Exercise</li><li>Interests</li><li>Faith and culture</li><li>Social connection</li><li>Emotional wellbeing</li></ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ PLANNING + RIGHTS ============ -->
<section class="section section--tint-red" aria-label="Planning, safety and rights">
  <div class="container two-col">
    <div class="plain-card">
      <h2>A plan that belongs to you</h2>
      <p>Goals are chosen with the young adult. Regular key work sessions and reviews track progress, and we plan the move on together when the time is right.</p>
    </div>
    <div class="plain-card">
      <h2>Safety and rights</h2>
      <p>Everyone has the right to privacy, to be heard and to complain. House rules are clear, and support is available in an emergency.</p>
      <p class="trust-links"><a href="<?php echo shc_url('/about/safeguarding/'); ?>">Safeguarding</a><a href="<?php echo shc_url('/about/policies/complaints/'); ?>">Complaints</a><a href="<?php echo shc_url('/privacy/'); ?>">Privacy</a></p>
    </div>
  </div>
</section>

<!-- ============ REFERRAL PATHWAY ============ -->
<section class="section" aria-labelledby="ref-title">
  <div class="container">
    <h2 id="ref-title" class="section-title section-title--red">How a move happens</h2>
    <ol class="chevron-steps chevron-steps--young chevron-steps--7">
      <li><strong>Referral</strong></li>
      <li><strong>Initial screening</strong></li>
      <li><strong>Assessment</strong></li>
      <li><strong>Matching and funding</strong></li>
      <li><strong>Transition plan</strong></li>
      <li><strong>Move in</strong></li>
      <li><strong>Review</strong></li>
    </ol>
    <p><a class="text-link" href="<?php echo shc_url('/supported-accommodation/referral-process/'); ?>">Read the full referral process</a></p>
  </div>
</section>

<section class="cta-band" aria-labelledby="cta-title">
  <div class="container cta-inner">
    <h2 id="cta-title">Let’s talk about the support you need.</h2>
    <div class="cta-actions">
      <a class="btn btn--white" href="<?php echo shc_url('/professionals/referral-form/'); ?>">Make a referral</a>
      <a class="cta-phone" href="<?php echo esc_url( shc_phone_href() ); ?>"><svg aria-hidden="true" viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg><span>Call <?php shc_echo_phone(); ?></span></a>
    </div>
  </div>
</section>
