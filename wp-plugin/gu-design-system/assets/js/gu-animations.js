/* GU Animations — scroll reveal via IntersectionObserver */
(function () {
  'use strict';

  if (!('IntersectionObserver' in window)) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  // ── Mark sections and cards for reveal ───────────────────────
  function markElements() {
    // ── Elementor page elements ───────────────────────────────
    // Section headings (skip dark-bg sections)
    document.querySelectorAll(
      '.elementor-top-section:not([style*="background-color: rgb(35,"]):not([style*="background-color: rgb(28,"]) .elementor-widget-heading'
    ).forEach(function (el) {
      el.classList.add('gu-reveal');
    });

    // Text editor blocks
    document.querySelectorAll(
      '.elementor-top-section:not([style*="background-color: rgb(35,"]):not([style*="background-color: rgb(28,"]) .elementor-widget-text-editor'
    ).forEach(function (el) {
      el.classList.add('gu-reveal');
    });

    // Counter widgets (stats)
    document.querySelectorAll('.elementor-widget-counter').forEach(function (el) {
      el.classList.add('gu-reveal');
    });

    // Archive card grids — stagger children
    document.querySelectorAll(
      '.gu-afectiuni-grid, .gu-interventii-grid, .gu-articole-grid'
    ).forEach(function (grid) {
      grid.classList.add('gu-reveal-group');
    });

    // Inner section grids (expertise cards, "O abordare" etc.)
    document.querySelectorAll(
      '.elementor-top-section .elementor-inner-section'
    ).forEach(function (inner) {
      inner.classList.add('gu-reveal-group');
    });

    // Archive empty state
    document.querySelectorAll('.gu-archive-empty-state').forEach(function (el) {
      el.classList.add('gu-reveal');
    });

    // ── PHP shortcode content elements ────────────────────────
    // Clinic card grid (Programări) — stagger children
    document.querySelectorAll('.gu-clinic-grid').forEach(function (grid) {
      grid.classList.add('gu-reveal-group');
    });

    // Sfatul hub: featured block + guide/recovery grids
    document.querySelectorAll('.gu-hub-featured').forEach(function (el) {
      el.classList.add('gu-reveal');
    });
    document.querySelectorAll('.gu-guide-grid, .gu-recovery-grid').forEach(function (grid) {
      grid.classList.add('gu-reveal-group');
    });

    // Video cards grid
    document.querySelectorAll('.gu-video-grid').forEach(function (grid) {
      grid.classList.add('gu-reveal-group');
    });

    // Sfatul hub nav pills section
    document.querySelectorAll('.gu-hub-nav').forEach(function (el) {
      el.classList.add('gu-reveal');
    });

    // Checklist (What to bring, Programări)
    document.querySelectorAll('.gu-checklist').forEach(function (el) {
      el.classList.add('gu-reveal-group');
    });

    // FAQ sections
    document.querySelectorAll('.gu-faq').forEach(function (el) {
      el.classList.add('gu-reveal');
    });

    // Credentials strip (Despre)
    document.querySelectorAll('.gu-credentials-strip').forEach(function (el) {
      el.classList.add('gu-reveal');
    });

    // Interest cards (Despre)
    document.querySelectorAll('.gu-interests-grid').forEach(function (grid) {
      grid.classList.add('gu-reveal-group');
    });

    // Colleague + patient recommendation cards (Recomandări)
    document.querySelectorAll('.gu-cards-grid, .gu-colleague-grid').forEach(function (grid) {
      grid.classList.add('gu-reveal-group');
    });

    // Homepage rebuilt CTA
    document.querySelectorAll('.gu-final-cta__inner').forEach(function (el) {
      el.classList.add('gu-reveal');
    });

    // Related articles section (single pages)
    document.querySelectorAll('.gu-related-articles').forEach(function (el) {
      el.classList.add('gu-reveal');
    });
  }

  // ── IntersectionObserver ──────────────────────────────────────
  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('gu-visible');
        observer.unobserve(entry.target); // Fire once only
      }
    });
  }, {
    threshold: 0.08,
    rootMargin: '0px 0px -40px 0px'
  });

  function observeAll() {
    document.querySelectorAll('.gu-reveal, .gu-reveal-group').forEach(function (el) {
      observer.observe(el);
    });
  }

  // ── Smooth anchor scroll ─────────────────────────────────────
  // Polyfill for browsers that don't support scroll-behavior: smooth
  // (also covers hub nav pills and any in-page anchor links)
  document.addEventListener('click', function (e) {
    var link = e.target.closest('a[href^="#"]');
    if (!link) return;
    var id = link.getAttribute('href').slice(1);
    if (!id) return;
    var target = document.getElementById(id);
    if (!target) return;
    e.preventDefault();
    var headerH = document.getElementById('gu-header');
    var offset = headerH ? headerH.offsetHeight + 12 : 72;
    var top = target.getBoundingClientRect().top + window.scrollY - offset;
    window.scrollTo({ top: top, behavior: 'smooth' });
  });

  // ── Init ──────────────────────────────────────────────────────
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      markElements();
      observeAll();
    });
  } else {
    markElements();
    observeAll();
  }
})();
