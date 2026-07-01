/* GU Header — scroll state + mobile drawer */
(function () {
  'use strict';

  var header    = document.getElementById('gu-header');
  var drawer    = document.getElementById('gu-mobile-drawer');
  var hamburger = document.querySelector('.gu-header__hamburger');
  var drawerClose = document.getElementById('gu-drawer-close');
  var backdrop  = document.getElementById('gu-drawer-backdrop');

  if (!header) return;

  // ── Compact scroll state ──────────────────────────────────────
  function onScroll() {
    if (window.scrollY > 60) {
      header.classList.add('is-compact');
    } else {
      header.classList.remove('is-compact');
    }
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // ── Mobile drawer ─────────────────────────────────────────────
  if (!drawer || !hamburger) return;

  function openDrawer() {
    drawer.removeAttribute('aria-hidden');
    hamburger.setAttribute('aria-expanded', 'true');
    hamburger.classList.add('is-active');
    document.body.style.overflow = 'hidden';
    var first = drawer.querySelector('a, button');
    if (first) first.focus();
  }

  function closeDrawer() {
    drawer.setAttribute('aria-hidden', 'true');
    hamburger.setAttribute('aria-expanded', 'false');
    hamburger.classList.remove('is-active');
    document.body.style.overflow = '';
    hamburger.focus();
  }

  hamburger.addEventListener('click', openDrawer);
  if (drawerClose) drawerClose.addEventListener('click', closeDrawer);
  if (backdrop)    backdrop.addEventListener('click',    closeDrawer);

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && drawer.getAttribute('aria-hidden') !== 'true') {
      closeDrawer();
    }
  });

  drawer.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', closeDrawer);
  });
})();

// ── Brand label normalisation — Sfatul Neurochirurgului ───────
// Replaces Elementor-hardcoded "Articole" labels with the public
// brand name. Runs once after DOM is ready. Targets confirmed
// element IDs from Playwright DOM audit (Sprint 9.7B).
(function () {
  'use strict';

  function normaliseBrandLabels() {
    // Archive page hero h1: "Articole pentru Pacienți" → hub brand name
    var archiveH1 = document.querySelector(
      '.elementor-element-s7ar003 h1.elementor-heading-title'
    );
    if (archiveH1 && /articole/i.test(archiveH1.textContent)) {
      archiveH1.textContent = 'Sfatul Neurochirurgului';
    }

    // Footer CTA link: "Toate articolele →" → editorial CTA
    var footerCta = document.querySelector(
      '.elementor-element-ce0da850 a'
    );
    if (footerCta && /articole/i.test(footerCta.textContent)) {
      footerCta.textContent = 'Explorează Sfatul Neurochirurgului';
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', normaliseBrandLabels);
  } else {
    normaliseBrandLabels();
  }
})();
