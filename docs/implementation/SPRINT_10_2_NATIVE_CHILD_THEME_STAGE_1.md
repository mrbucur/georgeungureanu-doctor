# Sprint 10.2 — Native Child Theme Stage 1

**Status:** COMPLETE — awaiting review  
**Date:** 2026-07-02  
**Scope:** Implement `header.php`, `footer.php`, `front-page.php`, `404.php` in the Ungureanu MD Child theme. No Elementor template imports required for any of these.

---

## Files Created / Modified

| File | Action | Notes |
|---|---|---|
| `wp-content/themes/ungureanu-md-child/header.php` | Created | Native header — exact HTML match to plugin's `gu_render_header()` |
| `wp-content/themes/ungureanu-md-child/footer.php` | Created | Native footer with `#gu-site-footer`, `wp_footer()` |
| `wp-content/themes/ungureanu-md-child/front-page.php` | Created | 4-section homepage; CTA from plugin |
| `wp-content/themes/ungureanu-md-child/404.php` | Created | Apple Health 404 page |
| `wp-content/themes/ungureanu-md-child/assets/css/theme.css` | Created | 400 lines of theme-level CSS |
| `wp-content/themes/ungureanu-md-child/functions.php` | Updated | 3 new responsibilities added |
| `wp-content/themes/ungureanu-md-child.zip` | Rebuilt | 16 KB, 9 files + 2 empty asset dirs |

---

## Key Technical Decisions

### header.php — exact HTML match to plugin

`gu-header.js` (already enqueued by the plugin) references specific IDs and classes:
- `#gu-header` — compact scroll state
- `#gu-mobile-drawer` / `aria-hidden` — drawer open/close
- `.gu-header__hamburger` / `#gu-drawer-backdrop` / `#gu-drawer-close` — controls

The native `header.php` uses the identical element IDs, classes, and attributes as the plugin's `gu_render_header()` output. No new JS is needed — the existing plugin JS and CSS work without modification.

The plugin also enqueues `gu-header.js` globally via `wp_enqueue_scripts`. Nothing needed in the child theme for JS.

### functions.php — three additions

**1. Remove plugin header injection:**
```php
add_action('after_setup_theme', function() {
    remove_action('wp_body_open', 'gu_render_header', 1);
});
```
The plugin registers `gu_render_header()` on `wp_body_open` at priority 1. Without this removal, the native `header.php` plus the plugin's hook would produce two headers.

**2. Enqueue `assets/css/theme.css`:**
```php
wp_enqueue_style('ungureanu-md-child-theme', .../assets/css/theme.css,
    ['ungureanu-md-child-style', 'gu-design-system'], $version);
```
Declared dependency on `gu-design-system` ensures CSS variables are available when `theme.css` loads.

**3. Reposition plugin CTA for native footer:**
```php
add_action('wp_footer', function() {
    if (!is_front_page()) return;
    // inline JS: move #gu-cta-rebuilt before #gu-site-footer
}, 25);
```
Plugin injects `#gu-cta-rebuilt` via `wp_footer` priority 20, then tries to place it before `.elementor-location-footer` (which no longer exists). The child theme runs at priority 25 (after the CTA exists in the DOM) and places it before `#gu-site-footer`.

### Logo font override

The plugin defines `.gu-header__logo-name` with `var(--font-serif)` = Lora, a holdover from the Direction B+ era. `theme.css` overrides this to `var(--font-sans)` with `!important`.

### front-page.php — afectiuni WP_Query with fallback

Section 3 (Specializations) runs `WP_Query` for `afectiuni` CPT (max 6, `menu_order ASC`). If no posts exist (empty staging), 6 hardcoded static cards are shown so the homepage is never blank.

The trust strip values (15+, 3, etc.) are placeholder — flagged with `[CLIENT: update values]` comment in the source.

---

## CSS Architecture (`assets/css/theme.css` — 400 lines)

| Block | CSS classes |
|---|---|
| Header override | `.gu-header__logo-name` (font-family to Inter) |
| Native footer | `.gu-site-footer`, `__inner`, `__brand`, `__name`, `__specialty`, `__desc`, `__col`, `__col-heading`, `__bottom`, `__copyright`, `__privacy` |
| Hero | `.gu-hero`, `__inner`, `__overline`, `__name`, `__specialty`, `__body`, `__actions`, `__btn-primary`, `__btn-secondary`, `__availability` |
| Trust strip | `.gu-trust-strip`, `__inner`, `.gu-trust-item`, `__value`, `__label` |
| Specializations | `.gu-specializations`, `__inner`, `.gu-spec-grid`, `.gu-spec-card`, `__title`, `__excerpt`, `__cta`, `.gu-spec-more` |
| Approach | `.gu-approach`, `__inner`, `__body`, `.gu-approach-pillars`, `.gu-approach-pillar`, `__title`, `__text` |
| Shared headings | `.gu-section-heading`, `.gu-section-sub` |
| 404 | `.gu-404`, `__inner`, `__code`, `__heading`, `__body`, `__actions` |
| Responsive | Breakpoints at 1024px, 768px, 480px |

All CSS uses design token variables (`--color-ink`, `--color-accent`, `--font-sans`, etc.) from the plugin's `:root` block.

---

## What Still Requires Elementor

After Stage 1, the following pages still use Elementor for rendering:

| Page | Elementor Template |
|---|---|
| `/despre/` | `sprint8-page-despre.json` (Stage 2) |
| `/programari/` | PHP shortcode (Stage 2 — remove Elementor layer) |
| `/recomandari/` | PHP shortcode (Stage 2) |
| `/articole/` | PHP shortcode (Stage 2) |
| `/afectiuni/` archive | `sprint4-archive-afectiuni.json` (Stage 3) |
| `/afectiuni/[slug]/` | `sprint4-single-afectiuni.json` (Stage 3) |
| `/interventii/` archive | `sprint5-archive-interventii.json` (Stage 3) |
| `/interventii/[slug]/` | `sprint5-single-interventii.json` (Stage 3) |
| `/articole/[slug]/` | `sprint7a-single-articol.json` (Stage 3) |

Elementor Pro must remain active until Stage 3 is complete.

---

## Staging Activation

1. Upload `wp-content/themes/ungureanu-md-child.zip` via Appearance → Themes → Add New
2. Activate theme
3. Verify GU Design System plugin is active (provides tokens, JS, and the CTA section)
4. Hello Elementor must be installed (not activated)

### Smoke test checklist

- [ ] `/` — Hero with "Dr. George Ungureanu", trust strip, specialization cards, approach section, CTA from plugin, native footer
- [ ] `/` — No "My Blog" / "Archives" / "Hello world" text
- [ ] `/` — Header: logo, 6 nav links, "Programează" CTA, hamburger
- [ ] Mobile — hamburger opens/closes drawer correctly (gu-header.js)
- [ ] Header compact — scrolling down adds `.is-compact` class
- [ ] `/does-not-exist/` — Shows native 404, not WP default
- [ ] Footer — dark background, text visible (no white-on-white), 3 columns on desktop
- [ ] Footer — CTA (#gu-cta-rebuilt) appears between last section and footer
- [ ] All footer links return 200 (or expected 404 for /confidentialitate/)
- [ ] `gu-design-system.css` enqueued (Network tab)
- [ ] `theme.css` enqueued (Network tab)
- [ ] No PHP errors in source
- [ ] Inter font rendered on logo, nav, headings (no Lora)

---

*Generated: Sprint 10.2 — Native Child Theme Stage 1*
