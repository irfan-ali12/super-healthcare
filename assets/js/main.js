/* Super Healthcare | main.js : mobile menu and services mega menu */
(function () {
  var menuBtn = document.querySelector('.menu-toggle');
  var nav = document.getElementById('primary-nav');
  var megaBtn = document.querySelector('.mega-toggle');
  var mega = document.getElementById('mega-services');

  function setMega(open) {
    if (!megaBtn) return;
    megaBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    mega.classList.toggle('is-open', open);
  }

  function setMenu(open) {
    if (!menuBtn) return;
    menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    nav.classList.toggle('is-open', open);
    if (!open) setMega(false);
  }

  if (menuBtn) {
    menuBtn.addEventListener('click', function () {
      setMenu(menuBtn.getAttribute('aria-expanded') !== 'true');
    });
  }

  if (megaBtn) {
    megaBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      setMega(megaBtn.getAttribute('aria-expanded') !== 'true');
    });
  }

  // Close on outside click (desktop dropdown)
  document.addEventListener('click', function (e) {
    if (mega && mega.classList.contains('is-open') && !e.target.closest('.has-mega')) {
      setMega(false);
    }
  });

  // Escape closes whatever is open and returns focus
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;
    if (mega && mega.classList.contains('is-open')) {
      setMega(false);
      megaBtn.focus();
    } else if (nav && nav.classList.contains('is-open')) {
      setMenu(false);
      menuBtn.focus();
    }
  });

  // Close the dropdown when focus leaves it (keyboard users)
  var megaItem = document.querySelector('.has-mega');
  if (megaItem) {
    megaItem.addEventListener('focusout', function (e) {
      if (!megaItem.contains(e.relatedTarget) && window.matchMedia('(min-width: 901px)').matches) {
        setMega(false);
      }
    });
  }

  // Mark the current page in the navigation
  var path = window.location.pathname.replace(/index\.html$/, '');
  document.querySelectorAll('.primary-nav a[href]').forEach(function (a) {
    if (a.getAttribute('href') === path && path !== '/') a.setAttribute('aria-current', 'page');
  });
})();

/* FAQ accordion */
(function () {
  document.querySelectorAll('.faq button[aria-controls]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var open = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', open ? 'false' : 'true');
      document.getElementById(btn.getAttribute('aria-controls')).hidden = open;
    });
  });
})();

/* Contact: route cards preselect a service */
(function () {
  var select = document.getElementById('service');
  if (!select) return;
  document.querySelectorAll('.route-card[data-service]').forEach(function (card) {
    card.addEventListener('click', function () {
      select.value = card.dataset.service === 'supported' ? 'supported-accommodation' : '';
      setTimeout(function () { document.getElementById('name').focus(); }, 300);
    });
  });
  var q = new URLSearchParams(window.location.search).get('service');
  if (q && select.querySelector('option[value="' + q + '"]')) select.value = q;
})();

/* Contact form: client-side validation with linked error summary.
   The same rules must run server-side in the child theme handler. */
(function () {
  var form = document.getElementById('enquiry-form');
  if (!form) return;
  var summary = document.getElementById('error-summary');

  var rules = [
    { id: 'name', test: function (v) { return v.trim().length > 1; }, msg: 'Enter your name' },
    { id: 'email', test: function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()); }, msg: 'Enter an email address in the correct format, like name@example.com' },
    { id: 'phone', test: function (v) { return v.replace(/[^\d]/g, '').length >= 10; }, msg: 'Enter a telephone number, like 01702 333 120' },
    { id: 'who', radio: true, msg: 'Select who needs support' },
    { id: 'service', test: function (v) { return v !== ''; }, msg: 'Choose the service you are interested in' },
    { id: 'postcode', test: function (v) { return /^[A-Z]{1,2}\d[A-Z\d]?\s*\d[A-Z]{2}$/i.test(v.trim()); }, msg: 'Enter a full UK postcode, like SS1 1AA' },
    { id: 'consent', check: true, msg: 'Confirm you have read the privacy notice' }
  ];

  function setError(rule, msg) {
    var err = document.getElementById(rule.id + '-error');
    var field = rule.radio ? null : document.getElementById(rule.id);
    err.hidden = !msg; err.textContent = msg || '';
    if (field) field.setAttribute('aria-invalid', msg ? 'true' : 'false');
  }

  form.addEventListener('submit', function (e) {
    var errors = [];
    rules.forEach(function (r) {
      var ok;
      if (r.radio) ok = !!form.querySelector('input[name="' + r.id + '"]:checked');
      else if (r.check) ok = document.getElementById(r.id).checked;
      else ok = r.test(document.getElementById(r.id).value);
      setError(r, ok ? '' : r.msg);
      if (!ok) errors.push(r);
    });

    if (errors.length) {
      e.preventDefault();
      var ul = summary.querySelector('ul'); ul.innerHTML = '';
      errors.forEach(function (r) {
        var target = r.radio ? form.querySelector('input[name="' + r.id + '"]') : document.getElementById(r.id);
        var li = document.createElement('li'); var a = document.createElement('a');
        a.href = '#' + target.id; a.textContent = r.msg;
        a.addEventListener('click', function (ev) { ev.preventDefault(); target.focus(); });
        li.appendChild(a); ul.appendChild(li);
      });
      summary.hidden = false; summary.focus();
    } else {
      summary.hidden = true;
    }
  });
})();
