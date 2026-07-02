/* GU Animations — scroll reveal via IntersectionObserver */
(function () {
  'use strict';

  if (!('IntersectionObserver' in window)) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  // ── Mark sections and cards for reveal ───────────────────────
  function markElements() {
    // Section headings
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

    // Card grids — stagger the children
    document.querySelectorAll(
      '.gu-afectiuni-grid, .gu-interventii-grid, .gu-articole-grid'
    ).forEach(function (grid) {
      grid.classList.add('gu-reveal-group');
    });

    // Inner section grids (expertise cards, "O abordare")
    document.querySelectorAll(
      '.elementor-top-section .elementor-inner-section'
    ).forEach(function (inner) {
      inner.classList.add('gu-reveal-group');
    });

    // Archive empty state
    document.querySelectorAll('.gu-archive-empty-state').forEach(function (el) {
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
