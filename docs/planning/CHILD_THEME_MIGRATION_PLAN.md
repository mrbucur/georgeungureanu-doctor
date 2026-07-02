# Child Theme Migration Plan — Staged Template Migration

**Status:** Stage 0 complete (scaffold) — Stage 1 pending approval  
**Reference:** `docs/planning/CHILD_THEME_ARCHITECTURE.md`

---

## Overview

Each stage replaces one or more Elementor-controlled templates with native WordPress PHP templates in the child theme. Stages are independent and can be paused between deployments. Rollback at any stage is a one-step undo.

---

## Stage 1 — Global Shell: header, footer, 404

**Goal:** Replace Elementor Theme Builder header, footer, and 404 conditions with PHP templates. After Stage 1, Elementor Pro is no longer required for the global site shell.

### Files to create

| File | Replaces |
|---|---|
| `wp-content/themes/ungureanu-md-child/header.php` | Elementor header template (`header.json`) assigned via Theme Builder |
| `wp-content/themes/ungureanu-md-child/footer.php` | Elementor footer template (`footer.json`) |
| `wp-content/themes/ungureanu-md-child/404.php` | Elementor 404 template (`404-page.json`) |

### Risks

| Risk | Mitigation |
|---|---|
| Header/footer visual regression | Match computed styles from existing Elementor output before removing Theme Builder conditions |
| Missing Elementor Pro widgets in header (e.g. nav menu widget) | Implement nav with `wp_nav_menu()` in PHP |
| Logo not rendering | Use `get_custom_logo()` or `bloginfo('name')` as fallback |
| Sticky header behaviour lost | Re-implement via child theme JS or `gu-header.js` |

### Test URLs

- All 9 pages — verify header and footer render identically
- Desktop 1440px, tablet 768px, mobile 390px
- Check: logo, nav links, mobile menu, footer columns, footer text contrast

### Rollback

1. Delete `header.php`, `footer.php`, `404.php` from the child theme directory
2. WordPress falls back to Hello Elementor's template hierarchy → Elementor Theme Builder re-engages automatically
3. No database changes required

---

## Stage 2 — Static Pages: front-page, programari, despre, recomandari

**Goal:** Replace Elementor page editor content on the four main static pages with PHP templates. After Stage 2, these pages no longer require Elementor to render.

### Files to create

| File | Replaces |
|---|---|
| `front-page.php` | Elementor homepage editor content + PHP CTA injected via `wp_footer` |
| `page-programari.php` | `[gu_appointments]` shortcode page + Elementor fallback |
| `page-despre.php` | Elementor Despre page template (`sprint8-page-despre.json`) + PHP shortcodes |
| `page-recomandari.php` | `[gu_recommendations]` shortcode page |

### Risks

| Risk | Mitigation |
|---|---|
| Homepage CTA removed from `wp_footer` hook and not re-added | Move CTA HTML into `front-page.php` directly; remove `wp_footer` hook from plugin |
| Shortcode output duplicated (plugin + template) | Remove `is_page('programari')` shortcode auto-injection from plugin once `page-programari.php` is active |
| Elementor per-page CSS (`post-38.css`) no longer generated | Audit which CSS depends on Elementor post CSS; migrate to plugin or theme CSS |
| Page slug mismatch | `page-programari.php` targets page with slug `programari` — ensure the page exists with that slug |

### Test URLs

- `/` — homepage: hero, stats, cards, CTA, footer
- `/programari/` — all 3 clinic cards, online card, checklist, FAQ
- `/despre/` — credentials, biography, philosophy, media
- `/recomandari/` — colleague cards, patient cards

### Rollback

1. Delete the relevant `*.php` template file(s) from the child theme
2. WordPress falls back to page.php → Elementor re-renders from its database content
3. No database changes required

---

## Stage 3 — CPT Templates: afectiuni, interventii, articole

**Goal:** Replace Elementor Theme Builder single/archive templates for all three CPTs with PHP templates. After Stage 3, CPT rendering has no dependency on Elementor exports.

### Files to create

| File | Replaces |
|---|---|
| `archive-afectiuni.php` | `sprint4-archive-afectiuni.json` Theme Builder condition |
| `single-afectiuni.php` | `sprint4-single-afectiuni.json` Theme Builder condition |
| `archive-interventii.php` | `sprint5-archive-interventii.json` Theme Builder condition |
| `single-interventii.php` | `sprint5-single-interventii.json` Theme Builder condition |
| `archive-articole.php` | `sprint7a-archive-articole.json` Theme Builder condition |
| `single-articole.php` | `sprint7a-single-articol.json` Theme Builder condition |

### Risks

| Risk | Mitigation |
|---|---|
| ACF field output missing | Use `get_field()` in templates; verify all 12/13/33 fields render |
| Elementor Theme Builder condition still active and overriding PHP template | Remove the Theme Builder condition for each CPT after its PHP template is confirmed working |
| Related articles / cross-links broken | Rebuild cross-link logic in PHP using `WP_Query` |
| Per-post Elementor CSS (`post-N.css`) relied upon | Audit dependencies; if any, keep Elementor active or migrate rules to plugin |

### Test URLs

- `/afectiuni/` — archive card grid
- `/afectiuni/hernie-de-disc-lombara/` — single with all ACF sections
- `/interventii/` — archive card grid
- `/interventii/microdiscectomie-lombara/` — single
- `/articole/` — Sfatul hub
- `/articole/[any-slug]/` — single articol

### Rollback

1. Delete the relevant `archive-*.php` or `single-*.php` from the child theme
2. Re-add the Theme Builder condition for that CPT in Elementor → Theme Builder
3. No database changes required

---

## Stage 4 — Decouple from Elementor Template Exports

**Goal:** Archive all Elementor template exports. The site no longer depends on them for layout.

### Actions

- Move `wp-plugin/gu-design-system/elementor-templates/` → `wp-plugin/gu-design-system/elementor-templates-archived/`
- Update `docs/DEPLOYMENT.md` to remove template import steps
- Remove `is_front_page()` CTA from `wp_footer` hook in plugin (moved to `front-page.php`)
- Retain Elementor + Elementor Pro — client uses Elementor editor for content within template regions (e.g. editing post content, images, text)

### Risks

| Risk | Mitigation |
|---|---|
| Client accidentally triggers Elementor on a page with a PHP template | PHP templates take precedence — Elementor editor is still accessible but output is ignored on the frontend |
| Elementor license renewal questioned | Retain Elementor Pro for client content editing flexibility; document value in handoff notes |

### Test URLs

Full site smoke test at desktop/tablet/mobile — same as `docs/UAT_CHECKLIST.md`.

### Rollback

Restore `elementor-templates/` from Git history and re-import affected templates if needed.

---

## Stage Completion Criteria

| Stage | Done when |
|---|---|
| Stage 1 | All 9 pages have matching header/footer at 3 viewports; no visual regression |
| Stage 2 | 4 static pages render from PHP; Playwright audit passes; no shortcode duplication |
| Stage 3 | All 3 CPTs render from PHP templates; ACF fields output correctly on all singles |
| Stage 4 | Full site smoke test passes; Elementor template exports are archived; no regression |
