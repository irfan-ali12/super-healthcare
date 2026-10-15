<?php
/** Auto-converted from src/adult-care-at-home.html — dynamic phone/CQC/settings handled in parent template where noted. */
?>

<nav class="breadcrumb container" aria-label="Breadcrumb">
  <ol>
    <li><a href="<?php echo shc_url('/'); ?>">Home</a></li>
    <li><a href="<?php echo shc_url('/adult-care-at-home/'); ?>" aria-current="page">Adult Care at Home</a></li>
  </ol>
</nav>

<!-- ============ PAGE HERO (split) ============ -->
<section class="page-hero page-hero--adult" aria-labelledby="page-title">
  <div class="container page-hero-grid">
    <div class="page-hero-text">
      <p class="page-hero-kicker">Adult Care at Home</p>
      <h1 id="page-title">Adult care that works around your life</h1>
      <p class="page-hero-support">Whether you need regular visits, temporary help or a carer living in your home, we create a personal care plan around your routines, preferences and changing needs.</p>
      <div class="page-hero-ctas">
        <a class="btn btn--blue" href="<?php echo shc_url('/contact/request-an-introduction/?service=adult-care/'); ?>">Request a home assessment</a>
        <a class="btn btn--outline" href="<?php echo esc_url( shc_phone_href() ); ?>">Call 01702 333 120</a>
      </div>
    </div>
    <figure class="page-hero-media">
      <img src="<?php echo shc_asset('img/hero-adult-care.webp'); ?>" width="1002" height="470" alt="An older man laughing over a cup of tea with his carer in his living room" fetchpriority="high">
    </figure>
  </div>
</section>

<!-- ============ CHOOSE A CARE MODEL ============ -->
<section class="section" aria-labelledby="models-title">
  <div class="container">
    <h2 id="models-title" class="section-title section-title--blue">Choose the kind of support</h2>
    <p class="section-intro">Not sure which fits? Most people start with a conversation and a home assessment, and we recommend the right mix from there.</p>

    <ul class="service-grid">
      <li class="service-card">
        <img src="<?php echo shc_asset('img/respite-care.webp'); ?>" width="526" height="286" alt="An older woman chatting with her carer on the sofa" loading="lazy">
        <div class="service-card-body">
          <h3>DomCare</h3>
          <p class="service-card-sub">Domiciliary care visits</p>
          <p>Flexible visits for personal care, medication support, meals, household tasks, errands, appointments and companionship.</p>
          <a class="text-link" href="<?php echo shc_url('/adult-care-at-home/domcare/'); ?>">Explore DomCare</a>
        </div>
      </li>
      <li class="service-card">
        <img src="<?php echo shc_asset('img/live-in-care.webp'); ?>" width="526" height="286" alt="An older man and his carer smiling in a garden" loading="lazy">
        <div class="service-card-body">
          <h3>Live-in Care</h3>
          <p class="service-card-sub">A carer who lives with you</p>
          <p>A carefully matched carer lives in your home and provides support around the clock, helping you remain in familiar surroundings.</p>
          <a class="text-link" href="<?php echo shc_url('/adult-care-at-home/live-in-care/'); ?>">Explore Live-in Care</a>
        </div>
      </li>
      <li class="service-card">
        <img src="<?php echo shc_asset('img/respite-care.webp'); ?>" width="526" height="286" alt="An older woman holding a mug and laughing with a visitor" loading="lazy">
        <div class="service-card-body">
          <h3>Respite Care</h3>
          <p class="service-card-sub">Short-term and planned cover</p>
          <p>Occasional or planned support that keeps familiar routines going while family carers take time to rest.</p>
          <a class="text-link" href="<?php echo shc_url('/adult-care-at-home/respite-care/'); ?>">Explore Respite Care</a>
        </div>
      </li>
      <li class="service-card">
        <img src="<?php echo shc_asset('img/dementia-care.webp'); ?>" width="526" height="286" alt="An older man in a flat cap walking outdoors with his carer" loading="lazy">
        <div class="service-card-body">
          <h3>Dementia Care</h3>
          <p class="service-card-sub">Specialist support at home</p>
          <p>Support designed around familiar routines, communication, safety, meaningful activity and the person’s own experience.</p>
          <a class="text-link" href="<?php echo shc_url('/adult-care-at-home/dementia-care/'); ?>">Explore Dementia Care</a>
        </div>
      </li>
      <li class="service-card">
        <img src="<?php echo shc_asset('img/palliative-care.webp'); ?>" width="526" height="286" alt="A carer sitting close beside an older woman at home" loading="lazy">
        <div class="service-card-body">
          <h3>Palliative Care</h3>
          <p class="service-card-sub">Comfort and choice at home</p>
          <p>Compassionate support focused on comfort, dignity and personal choices, working alongside family and healthcare professionals.</p>
          <a class="text-link" href="<?php echo shc_url('/adult-care-at-home/palliative-care/'); ?>">Explore Palliative Care</a>
        </div>
      </li>
      <li class="service-card">
        <img src="<?php echo shc_asset('img/dementia-care.webp'); ?>" width="526" height="286" alt="An older man enjoying a walk and conversation with his carer" loading="lazy">
        <div class="service-card-body">
          <h3>Companionship</h3>
          <p class="service-card-sub">Company and connection</p>
          <p>Meaningful company and practical help with tea, walks, shopping, appointments, hobbies and community activities.</p>
          <a class="text-link" href="<?php echo shc_url('/adult-care-at-home/companionship/'); ?>">Explore Companionship</a>
        </div>
      </li>
    </ul>
  </div>
</section>

<!-- ============ COMPARE ============ -->
<section class="section section--tint-blue" aria-labelledby="compare-title">
  <div class="container">
    <h2 id="compare-title" class="section-title section-title--blue">Which option fits your situation?</h2>
    <div class="table-wrap" role="region" aria-labelledby="compare-title" tabindex="0">
      <table class="compare-table">
        <thead>
          <tr><th scope="col">If you…</th><th scope="col">You might consider</th></tr>
        </thead>
        <tbody>
          <tr><td>Need help at certain times of day, such as mornings and evenings</td><td><a href="<?php echo shc_url('/adult-care-at-home/domcare/'); ?>">DomCare visits</a></td></tr>
          <tr><td>Need support throughout the day and night but want to stay at home</td><td><a href="<?php echo shc_url('/adult-care-at-home/live-in-care/'); ?>">Live-in Care</a></td></tr>
          <tr><td>Are a family carer who needs a break, or are coming home from hospital</td><td><a href="<?php echo shc_url('/adult-care-at-home/respite-care/'); ?>">Respite Care</a></td></tr>
          <tr><td>Are living with dementia or supporting someone who is</td><td><a href="<?php echo shc_url('/adult-care-at-home/dementia-care/'); ?>">Dementia Care</a></td></tr>
          <tr><td>Want comfort and support at home towards the end of life</td><td><a href="<?php echo shc_url('/adult-care-at-home/palliative-care/'); ?>">Palliative Care</a></td></tr>
          <tr><td>Are mostly independent but would like company and a helping hand</td><td><a href="<?php echo shc_url('/adult-care-at-home/companionship/'); ?>">Companionship</a></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ HOW CARE BEGINS (horizontal) ============ -->
<section class="section" aria-labelledby="begin-title">
  <div class="container">
    <h2 id="begin-title" class="section-title section-title--blue">How care begins</h2>
    <ol class="chevron-steps chevron-steps--adult">
      <li><strong>Talk to us</strong><span>Tell us what is changing and what matters most.</span></li>
      <li><strong>Home assessment</strong><span>We meet you at home, with family or professionals if you wish.</span></li>
      <li><strong>Personal care plan</strong><span>We agree the support, schedule and how we keep in touch.</span></li>
      <li><strong>Matched support</strong><span>Care is matched to your needs and preferences.</span></li>
      <li><strong>Regular reviews</strong><span>The plan changes when your needs or choices do.</span></li>
    </ol>
  </div>
</section>

<!-- ============ FUNDING SIGNPOST ============ -->
<section class="section section--tight" aria-labelledby="funding-title">
  <div class="container">
    <div class="info-panel">
      <div>
        <h2 id="funding-title">Paying for care</h2>
        <p>Care can be paid for privately or funded in part or in full through your local council, direct payments or NHS continuing healthcare, depending on your circumstances. We give you an individual quotation after your assessment.</p>
      </div>
      <ul class="link-list">
        <li><a href="https://www.gov.uk/apply-needs-assessment-social-services" target="_blank" rel="noopener">Apply for a needs assessment on GOV.UK<span class="visually-hidden"> (opens in a new tab)</span></a></li>
        <li><a href="https://www.nhs.uk/social-care-and-support/money-work-and-benefits/nhs-continuing-healthcare/" target="_blank" rel="noopener">NHS continuing healthcare<span class="visually-hidden"> (opens in a new tab)</span></a></li>
        <li><a href="<?php echo shc_url('/contact/request-an-introduction/?service=adult-care/'); ?>">Ask us about costs</a></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ TRUST PANEL ============ -->
<section class="section section--tint-blue" aria-labelledby="trust-title">
  <div class="container trust-panel">
    <a class="cqc-seal cqc-seal--static" href="<?php echo esc_url( shc_cqc_url_or_default() ); ?>" target="_blank" rel="noopener">
      <span class="cqc-seal-small">CQC rated</span><span class="cqc-seal-big">Good</span>
      <span class="visually-hidden">(opens the CQC report in a new tab)</span>
    </a>
    <div>
      <h2 id="trust-title">Rated Good by the Care Quality Commission</h2>
      <p>Good across Safe, Effective, Caring, Responsive and Well-led. Report published <span class="placeholder-inline"><?php shc_echo_cqc_date(); ?></span>.</p>
      <p class="trust-links"><a href="<?php echo shc_url('/about/safeguarding/'); ?>">Safeguarding</a><a href="<?php echo shc_url('/about/our-approach/'); ?>">Our approach</a><a href="<?php echo shc_url('/about/policies/complaints/'); ?>">Complaints</a></p>
    </div>
  </div>
</section>

<section class="cta-band" aria-labelledby="cta-title">
  <div class="container cta-inner">
    <h2 id="cta-title">Let’s talk about the support you need.</h2>
    <div class="cta-actions">
      <a class="btn btn--white" href="<?php echo shc_url('/contact/request-an-introduction/?service=adult-care/'); ?>">Request a home assessment</a>
      <a class="cta-phone" href="<?php echo esc_url( shc_phone_href() ); ?>"><svg aria-hidden="true" viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg><span>Call <?php shc_echo_phone(); ?></span></a>
    </div>
  </div>
</section>
