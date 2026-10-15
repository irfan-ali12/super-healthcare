<?php
/** Auto-converted from src/index.html — dynamic phone/CQC/settings handled in parent template where noted. */
?>

<!-- ============ HERO ============ -->
<section class="hero" aria-labelledby="hero-title">
  <div class="container hero-text">
    <h1 id="hero-title">People first. Independence always.</h1>
    <p class="hero-support">Care at home for adults and older people. Supported accommodation for young adults aged 18 and over.</p>
    <div class="hero-ctas">
      <a class="btn btn--blue" href="<?php echo shc_url('/adult-care-at-home/'); ?>">Explore Adult Care</a>
      <a class="btn btn--red" href="<?php echo shc_url('/supported-accommodation/'); ?>">Explore Supported Accommodation</a>
    </div>
  </div>

  <div class="hero-split">
    <figure class="hero-half hero-half--adult">
      <img src="<?php echo shc_asset('img/hero-adult-care.webp'); ?>" width="1002" height="470" alt="An older man laughing over a cup of tea with his carer in his living room" fetchpriority="high">
      <figcaption>Adult Care at Home</figcaption>
    </figure>
    <figure class="hero-half hero-half--young">
      <img src="<?php echo shc_asset('img/hero-young-adults.webp'); ?>" width="994" height="470" alt="Four young adults working together on a laptop at a kitchen table">
      <figcaption>Supported Accommodation 18+</figcaption>
    </figure>
    <a class="cqc-seal" href="<?php echo esc_url( shc_cqc_url_or_default() ); ?>" target="_blank" rel="noopener">
      <span class="cqc-seal-small">CQC rated</span>
      <span class="cqc-seal-big">Good</span>
      <span class="visually-hidden">(opens the CQC report in a new tab)</span>
    </a>
  </div>
</section>

<!-- ============ TRUST STRIP ============ -->
<section class="trust-strip" aria-label="Care Quality Commission rating">
  <div class="container trust-inner">
    <p class="trust-main"><strong>Rated Good by the Care Quality Commission.</strong> Good across Safe, Effective, Caring, Responsive and Well-led.</p>
    <p class="trust-meta">Report published <?php shc_echo_cqc_date(); ?></p>
    <a class="text-link" href="<?php echo esc_url( shc_cqc_url_or_default() ); ?>" target="_blank" rel="noopener">Read our CQC report<span class="visually-hidden"> (opens in a new tab)</span></a>
  </div>
</section>

<!-- ============ TWO PATHWAYS ============ -->
<section class="pathways" aria-label="Our two services">
  <div class="pathway pathway--adult">
    <div class="pathway-inner">
      <h2>Adult Care at Home</h2>
      <p class="pathway-lead">Personalised support that helps adults and older people remain safe, comfortable and independent in their own home.</p>
      <p>From regular DomCare (domiciliary care) visits to fully managed live-in care, we build support around everyday life.</p>
      <a class="btn btn--blue" href="<?php echo shc_url('/adult-care-at-home/'); ?>">Explore Adult Care at Home</a>
    </div>
  </div>
  <div class="pathway pathway--young">
    <div class="pathway-inner">
      <h2>Supported Accommodation 18+</h2>
      <p class="pathway-lead">A safe home, practical life skills and support towards education, training and work.</p>
      <p>We help young adults develop everyday skills, connect with their community and move towards the future they want.</p>
      <a class="btn btn--red" href="<?php echo shc_url('/supported-accommodation/'); ?>">Explore Supported Accommodation</a>
    </div>
  </div>
</section>

<!-- ============ ADULT CARE SERVICES + SA LIFE (paired columns) ============ -->
<div class="paired container">

  <section class="paired-col paired-col--adult" aria-labelledby="adult-services-title">
    <h2 id="adult-services-title" class="section-title section-title--blue">Adult care services</h2>
    <ul class="card-grid">
      <li class="card card--adult">
        <img src="<?php echo shc_asset('img/live-in-care.webp'); ?>" width="526" height="286" alt="An older man and his carer smiling in a garden" loading="lazy">
        <div class="card-body">
          <h3><a href="<?php echo shc_url('/adult-care-at-home/live-in-care/'); ?>">Live-in Care</a></h3>
          <p>A carefully matched carer lives in your home and provides support around the clock, helping you remain in familiar surroundings.</p>
        </div>
      </li>
      <li class="card card--adult">
        <img src="<?php echo shc_asset('img/respite-care.webp'); ?>" width="526" height="286" alt="An older woman holding a mug and chatting with a visitor on her sofa" loading="lazy">
        <div class="card-body">
          <h3><a href="<?php echo shc_url('/adult-care-at-home/respite-care/'); ?>">Respite Care</a></h3>
          <p>Short-term, occasional or planned support that keeps familiar routines going while family carers take time to rest.</p>
        </div>
      </li>
      <li class="card card--adult">
        <img src="<?php echo shc_asset('img/dementia-care.webp'); ?>" width="526" height="286" alt="An older man in a flat cap walking outdoors with his carer" loading="lazy">
        <div class="card-body">
          <h3><a href="<?php echo shc_url('/adult-care-at-home/dementia-care/'); ?>">Dementia Care</a></h3>
          <p>Specialist support designed around familiar routines, communication, safety and meaningful activity.</p>
        </div>
      </li>
      <li class="card card--adult">
        <img src="<?php echo shc_asset('img/palliative-care.webp'); ?>" width="526" height="286" alt="A carer sitting close beside an older woman at home" loading="lazy">
        <div class="card-body">
          <h3><a href="<?php echo shc_url('/adult-care-at-home/palliative-care/'); ?>">Palliative Care</a></h3>
          <p>Compassionate support focused on comfort, dignity, personal choices and working alongside family and healthcare professionals.</p>
        </div>
      </li>
    </ul>
    <p class="also-links">Also available:
      <a href="<?php echo shc_url('/adult-care-at-home/domcare/'); ?>">DomCare visits</a> and
      <a href="<?php echo shc_url('/adult-care-at-home/companionship/'); ?>">Companionship</a>
    </p>
  </section>

  <section class="paired-col paired-col--young" aria-labelledby="young-life-title">
    <h2 id="young-life-title" class="section-title section-title--red">A home. A plan. A future.</h2>
    <ul class="card-grid">
      <li class="card card--young">
        <img src="<?php echo shc_asset('img/safe-accommodation.webp'); ?>" width="490" height="332" alt="A bright, tidy bedroom with a desk by the window" loading="lazy">
        <div class="card-body">
          <h3>Safe accommodation</h3>
          <p>A private room in a well kept shared home, with clear house expectations and support nearby.</p>
        </div>
      </li>
      <li class="card card--young">
        <img src="<?php echo shc_asset('img/life-skills.webp'); ?>" width="492" height="332" alt="A young man cooking at a hob in a shared kitchen" loading="lazy">
        <div class="card-body">
          <h3>Independent living skills</h3>
          <p>Cooking, budgeting, shopping, travel and the everyday routines of running a home.</p>
        </div>
      </li>
      <li class="card card--young">
        <img src="<?php echo shc_asset('img/education-employment.webp'); ?>" width="490" height="336" alt="Two young adults working on a laptop and notebook together" loading="lazy">
        <div class="card-body">
          <h3>Education and employment</h3>
          <p>Help with college, training, CVs, applications and getting ready for work.</p>
        </div>
      </li>
      <li class="card card--young">
        <img src="<?php echo shc_asset('img/community-wellbeing.webp'); ?>" width="492" height="336" alt="Three young adults walking together outdoors" loading="lazy">
        <div class="card-body">
          <h3>Community and wellbeing</h3>
          <p>Health, exercise, interests and friendships that make somewhere feel like home.</p>
        </div>
      </li>
    </ul>
    <p class="also-links"><a href="<?php echo shc_url('/supported-accommodation/our-homes/'); ?>">See our homes</a> or <a href="<?php echo shc_url('/professionals/referral-form/'); ?>">make a referral</a></p>
  </section>

</div>

<!-- ============ EVERYDAY SUPPORT ============ -->
<section class="everyday" aria-labelledby="everyday-title">
  <div class="container">
    <h2 id="everyday-title" class="section-title section-title--blue">Support for everyday life</h2>
    <p class="section-intro">Within DomCare and Live-in Care, support is agreed with you and written into your care plan.</p>
    <ul class="activity-list">
      <li>
        <span class="activity-icon" aria-hidden="true"><svg viewBox="0 0 32 32"><path d="M8 13h16M16 5v4M12 13v-2a4 4 0 0 1 8 0v2M11 18v2M16 18v3M21 18v2M13.5 24v2M18.5 24v2"/></svg></span>
        <span class="activity-label">Personal care</span>
      </li>
      <li>
        <span class="activity-icon" aria-hidden="true"><svg viewBox="0 0 32 32"><rect x="6" y="12" width="20" height="9" rx="4.5" transform="rotate(-45 16 16.5)"/><path d="M12.8 13.3l6.4 6.4"/></svg></span>
        <span class="activity-label">Medication support</span>
      </li>
      <li>
        <span class="activity-icon" aria-hidden="true"><svg viewBox="0 0 32 32"><path d="M6 17h20a10 10 0 0 1-20 0zM12 12c0-2 2-2 2-4M16 12c0-2 2-2 2-4M20 12c0-2 2-2 2-4"/></svg></span>
        <span class="activity-label">Meals and household help</span>
      </li>
      <li>
        <span class="activity-icon" aria-hidden="true"><svg viewBox="0 0 32 32"><path d="M5 7h3l3 13h13l2-9H10"/><circle cx="13" cy="25" r="1.6"/><circle cx="22" cy="25" r="1.6"/></svg></span>
        <span class="activity-label">Shopping and appointments</span>
      </li>
      <li>
        <span class="activity-icon" aria-hidden="true"><svg viewBox="0 0 32 32"><circle cx="11" cy="11" r="3.5"/><circle cx="21" cy="11" r="3.5"/><path d="M4 25c0-4 3-7 7-7s7 3 7 7M14 25c0-4 3-7 7-7s7 3 7 7"/></svg></span>
        <span class="activity-label">Companionship</span>
      </li>
      <li>
        <span class="activity-icon" aria-hidden="true"><svg viewBox="0 0 32 32"><path d="M16 27V15M16 15c0-5 4-9 10-9 0 6-4 9-10 9zM16 19c0-4-3-7-8-7 0 5 3 7 8 7z"/></svg></span>
        <span class="activity-label">Hobbies and community</span>
      </li>
    </ul>
  </div>
</section>

<!-- ============ HOW SUPPORT STARTS ============ -->
<section class="start" aria-labelledby="start-title">
  <div class="container">
    <h2 id="start-title" class="section-title">How support starts</h2>
    <div class="start-grid">
      <div class="start-path start-path--adult">
        <h3>For adults and older people</h3>
        <ol class="steps">
          <li><strong>Talk to us</strong> Tell us what is changing and what matters most to you.</li>
          <li><strong>Home assessment</strong> We visit you at home, with family there if you wish.</li>
          <li><strong>Personal care plan</strong> Together we agree the support, the times and how we keep in touch.</li>
          <li><strong>Matched support</strong> Care begins, and we review it as your needs change.</li>
        </ol>
        <a class="btn btn--blue" href="<?php echo shc_url('/contact/request-an-introduction/?service=adult-care/'); ?>">Request a home assessment</a>
      </div>
      <div class="start-path start-path--young">
        <h3>For young adults 18+</h3>
        <ol class="steps">
          <li><strong>Referral</strong> A professional or the young person gets in touch with us.</li>
          <li><strong>Assessment</strong> We look at needs, goals and which home is the right fit.</li>
          <li><strong>Personal plan</strong> Goals are set with the young adult, not for them.</li>
          <li><strong>Move in and progress</strong> Regular key work sessions and reviews keep things moving.</li>
        </ol>
        <a class="btn btn--red" href="<?php echo shc_url('/supported-accommodation/referral-process/'); ?>">See the referral process</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ STORIES ============ -->
<section class="stories" aria-labelledby="stories-title">
  <div class="container">
    <h2 id="stories-title" class="section-title">Stories</h2>
    <div class="story-grid">
      <article class="story story--adult">
        <p class="story-audience">Adult care</p>
        <blockquote class="placeholder-block">
          <p>[Approved quotation from a person receiving care or their family. Exact wording, with consent on file.]</p>
        </blockquote>
        <p class="story-attrib placeholder-inline">[Name or anonymous, relationship]</p>
        <a class="text-link" href="<?php echo shc_url('/stories/adult-care/'); ?>">Read the story</a>
      </article>
      <article class="story story--young">
        <p class="story-audience">Supported accommodation</p>
        <blockquote class="placeholder-block">
          <p>[Approved quotation from a young adult. Exact wording, with consent and anonymity choice on file.]</p>
        </blockquote>
        <p class="story-attrib placeholder-inline">[First name or anonymous]</p>
        <a class="text-link" href="<?php echo shc_url('/stories/young-adults/'); ?>">Read the story</a>
      </article>
    </div>
  </div>
</section>

<!-- ============ QUALITY ============ -->
<section class="quality" aria-labelledby="quality-title">
  <div class="container quality-inner">
    <div class="quality-intro">
      <h2 id="quality-title" class="section-title">Quality you can check</h2>
      <p>Families and professionals should be able to see how we work, not just take our word for it.</p>
    </div>
    <ul class="quality-list">
      <li><a href="<?php echo esc_url( shc_cqc_url_or_default() ); ?>" target="_blank" rel="noopener">CQC rating and report<span class="visually-hidden"> (opens in a new tab)</span></a><span>Rated Good overall and in all five areas.</span></li>
      <li><a href="<?php echo shc_url('/about/safeguarding/'); ?>">Safeguarding</a><span>How we keep people safe and who to contact with a concern.</span></li>
      <li><a href="<?php echo esc_url( shc_url( '/about/our-approach/' ) . '#staff-checks' ); ?>">Staff checks</a><span>How carers are vetted before they start.</span></li>
      <li><a href="<?php echo shc_url('/work-with-us/standards/'); ?>">Training</a><span>How we train and support our carers.</span></li>
      <li><a href="<?php echo esc_url( shc_url( '/about/our-approach/' ) . '#reviews' ); ?>">Care plan reviews</a><span>Plans are reviewed and changed with you.</span></li>
      <li><a href="<?php echo shc_url('/about/policies/complaints/'); ?>">Complaints</a><span>A clear route to raise a concern and get a response.</span></li>
    </ul>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<section class="cta-band" aria-labelledby="cta-title">
  <div class="container cta-inner">
    <h2 id="cta-title">Let’s talk about the support you need.</h2>
    <div class="cta-actions">
      <a class="btn btn--white" href="<?php echo shc_url('/contact/request-an-introduction/'); ?>">Request an introduction</a>
      <a class="cta-phone" href="<?php echo esc_url( shc_phone_href() ); ?>">
        <svg aria-hidden="true" viewBox="0 0 24 24" width="22" height="22"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg>
        <span>Call 01702 333 120</span>
      </a>
    </div>
  </div>
</section>
