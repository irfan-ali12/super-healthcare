/* Super Healthcare | main.js
   Navigation, dropdowns, FAQ, enquiry form, lightbox and conversion events. */

/* ---------- Navigation and dropdowns ---------- */
(function () {
  var menuBtn = document.querySelector('.menu-toggle');
  var nav = document.getElementById('primary-nav');
  var toggles = Array.prototype.slice.call(document.querySelectorAll('.dropdown-toggle'));
  var desktop = window.matchMedia('(min-width: 1201px)');

  function panelFor(btn) { return document.getElementById(btn.getAttribute('aria-controls')); }

  function setDropdown(btn, open) {
    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    panelFor(btn).classList.toggle('is-open', open);
  }

  function closeAll(except) {
    toggles.forEach(function (b) { if (b !== except) setDropdown(b, false); });
  }

  function setMenu(open) {
    if (!menuBtn) return;
    menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    nav.classList.toggle('is-open', open);
    document.body.classList.toggle('menu-open', open);
    if (!open) closeAll();
  }

  if (menuBtn) {
    menuBtn.addEventListener('click', function () {
      setMenu(menuBtn.getAttribute('aria-expanded') !== 'true');
    });
  }

  toggles.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      var open = btn.getAttribute('aria-expanded') !== 'true';
      closeAll(btn);
      setDropdown(btn, open);
    });
    var item = btn.closest('.has-dropdown');
    item.addEventListener('focusout', function (e) {
      if (desktop.matches && !item.contains(e.relatedTarget)) setDropdown(btn, false);
    });
  });

  document.addEventListener('click', function (e) {
    if (!e.target.closest('.has-dropdown')) closeAll();
  });

  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;
    var open = toggles.filter(function (b) { return b.getAttribute('aria-expanded') === 'true'; })[0];
    if (open) { setDropdown(open, false); open.focus(); return; }
    if (nav && nav.classList.contains('is-open')) { setMenu(false); menuBtn.focus(); }
  });

  desktop.addEventListener('change', function () { setMenu(false); });
})();

/* ---------- FAQ accordion ---------- */
(function () {
  document.querySelectorAll('.faq button[aria-controls]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var open = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', open ? 'false' : 'true');
      document.getElementById(btn.getAttribute('aria-controls')).hidden = open;
    });
  });
})();

/* ---------- Contact route tiles preselect a service ---------- */
(function () {
  var select = document.getElementById('service');
  if (!select) return;
  document.querySelectorAll('[data-service]').forEach(function (tile) {
    tile.addEventListener('click', function () {
      select.value = tile.getAttribute('data-service');
      setTimeout(function () { var n = document.getElementById('name'); if (n) n.focus(); }, 350);
    });
  });
})();

/* ---------- Enquiry form: client-side validation (mirrors inc/enquiry.php) ---------- */
(function () {
  var form = document.getElementById('enquiry-form');
  if (!form) return;
  var summary = document.getElementById('error-summary');

  var rules = [
    { id: 'name', test: function (v) { return v.trim().length > 1; }, msg: 'Enter your name' },
    { id: 'email', test: function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()); }, msg: 'Enter an email address in the correct format, like name@example.com' },
    { id: 'phone', test: function (v) { return v.replace(/[^\d]/g, '').length >= 10; }, msg: 'Enter a telephone number, like 01702 333 120' },
    { id: 'who', radio: true, msg: 'Select who needs support' },
    { id: 'service', test: function (v) { return v !== ''; }, msg: 'Choose what you are interested in' },
    { id: 'postcode', test: function (v) { return /^[A-Z]{1,2}\d[A-Z\d]?\s*\d[A-Z]{2}$/i.test(v.trim()); }, msg: 'Enter a full UK postcode, like SS0 7EL' },
    { id: 'consent', check: true, msg: 'Confirm you have read the privacy notice' }
  ];

  function present(rule) {
    if (rule.radio) return !!form.querySelector('input[type="radio"][name="' + rule.id + '"]');
    return !!document.getElementById(rule.id);
  }

  function setError(rule, msg) {
    var err = document.getElementById(rule.id + '-error');
    if (err) { err.hidden = !msg; err.textContent = msg || ''; }
    if (!rule.radio) {
      var field = document.getElementById(rule.id);
      if (msg) field.setAttribute('aria-invalid', 'true'); else field.removeAttribute('aria-invalid');
    }
  }

  form.addEventListener('submit', function (e) {
    var errors = [];
    rules.filter(present).forEach(function (r) {
      var ok;
      if (r.radio) ok = !!form.querySelector('input[name="' + r.id + '"]:checked');
      else if (r.check) ok = document.getElementById(r.id).checked;
      else ok = r.test(document.getElementById(r.id).value);
      setError(r, ok ? '' : r.msg);
      if (!ok) errors.push(r);
    });

    if (errors.length) {
      e.preventDefault();
      var ul = summary.querySelector('ul');
      ul.innerHTML = '';
      errors.forEach(function (r) {
        var target = r.radio ? form.querySelector('input[name="' + r.id + '"]') : document.getElementById(r.id);
        var li = document.createElement('li');
        var a = document.createElement('a');
        a.href = '#' + target.id;
        a.textContent = r.msg;
        a.addEventListener('click', function (ev) { ev.preventDefault(); target.focus(); });
        li.appendChild(a);
        ul.appendChild(li);
      });
      summary.hidden = false;
      summary.focus();
    } else {
      summary.hidden = true;
      track('enquiry_start_submit', { form: form.getAttribute('data-variant') });
    }
  });

  // Server-side errors or success: move focus to the message.
  var success = document.getElementById('form-success');
  if (success && !success.hidden) { success.focus(); }
  else if (summary && !summary.hidden) { summary.focus(); }
})();

/* ---------- Lightbox ---------- */
(function () {
  var dlg = document.getElementById('lightbox');
  if (!dlg || typeof dlg.showModal !== 'function') return;
  var img = dlg.querySelector('.lightbox-img');
  var cap = dlg.querySelector('.lightbox-caption');
  var items = [];
  var index = 0;

  function show(i) {
    index = (i + items.length) % items.length;
    var btn = items[index];
    img.src = btn.getAttribute('data-full');
    img.alt = btn.querySelector('img') ? btn.querySelector('img').alt : '';
    cap.textContent = btn.getAttribute('data-caption') || '';
  }

  document.querySelectorAll('[data-lightbox] .gallery-open').forEach(function (btn) {
    btn.addEventListener('click', function () {
      items = Array.prototype.slice.call(btn.closest('[data-lightbox]').querySelectorAll('.gallery-open'));
      show(items.indexOf(btn));
      dlg.showModal();
      track('gallery_open');
    });
  });

  dlg.querySelector('.lightbox-close').addEventListener('click', function () { dlg.close(); });
  dlg.querySelector('.lightbox-prev').addEventListener('click', function () { show(index - 1); });
  dlg.querySelector('.lightbox-next').addEventListener('click', function () { show(index + 1); });
  dlg.addEventListener('click', function (e) { if (e.target === dlg) dlg.close(); });
  dlg.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowLeft') show(index - 1);
    if (e.key === 'ArrowRight') show(index + 1);
  });
})();

/* ---------- Conversion events ----------
   Pushes to window.dataLayer only if an analytics tool has created it
   (after cookie consent). Never sends names, emails, phone numbers or message text. */
function track(name, data) {
  if (!Array.isArray(window.dataLayer)) return;
  var payload = { event: 'shc_' + name };
  if (data) Object.keys(data).forEach(function (k) { payload[k] = data[k]; });
  window.dataLayer.push(payload);
}

(function () {
  document.addEventListener('click', function (e) {
    var el = e.target.closest('[data-track]');
    if (el) { track(el.getAttribute('data-track'), { path: window.location.pathname }); return; }
    var tel = e.target.closest('a[href^="tel:"]');
    if (tel) track('phone_click', { path: window.location.pathname });
  });
  var success = document.querySelector('[data-track-view]');
  if (success && !success.hidden) {
    var svc = new URLSearchParams(window.location.search).get('svc') || '';
    track(success.getAttribute('data-track-view'), { service: svc });
  }
})();
