# Sprint 10.1 — Ungureanu MD Child Theme

**Status:** SCAFFOLD COMPLETE — awaiting review  
**Date:** 2026-07-02  
**Scope:** Create child theme scaffold, architecture documentation, and staged migration plan. No template migration yet.

---

## Files Created

### Child theme scaffold

| File | Path | Notes |
|---|---|---|
| `style.css` | `wp-content/themes/ungureanu-md-child/style.css` | Theme registration header; CSS body intentionally empty at scaffold stage |
| `functions.php` | `wp-content/themes/ungureanu-md-child/functions.php` | Enqueues parent + child stylesheets; registers theme support |
| `README.md` | `wp-content/themes/ungureanu-md-child/README.md` | Installation, responsibilities, migration stage index |
| `screenshot.png` | `wp-content/themes/ungureanu-md-child/screenshot.png` | 1200×900 placeholder PNG (blue/gray, 4.4 KB) |

### Documentation

| File | Notes |
|---|---|
| `docs/planning/CHILD_THEME_ARCHITECTURE.md` | Full plugin/theme responsibility split; rationale for PHP-over-Elementor |
| `docs/planning/CHILD_THEME_MIGRATION_PLAN.md` | 4-stage migration plan with files, risks, test URLs, rollback per stage |

### ZIP

| File | Notes |
|---|---|
| `wp-content/themes/ungureanu-md-child.zip` | Installable ZIP — contains all 4 theme files in correct directory structure |

---

## Theme Metadata

```
Theme Name:  Ungureanu MD Child
Theme URI:   https://georgeungureanu.doctor
Template:    hello-elementor
Version:     1.0.0
Author:      Mr. Bucur
Author URI:  https://puiu.bucur.info
Text Domain: ungureanu-md-child
License:     Private — All rights reserved
```

---

## Enqueue Strategy

```
wp_enqueue_scripts
  └── ungureanu_child_enqueue_styles()
        ├── hello-elementor-style   (parent theme style.css)
        └── ungureanu-md-child-style (child style.css, depends on parent)

gu-design-system plugin (independent — not duplicated by theme):
  ├── gu-google-fonts    (Inter via Google Fonts CDN)
  ├── gu-design-system   (design tokens + component CSS)
  └── gu-animations      (scroll-reveal JS)
```

The child theme does not re-enqueue anything from the plugin. The plugin runs regardless of which theme is active.

---

## Plugin vs Theme Responsibilities

| Concern | Lives in |
|---|---|
| CPT: `afectiuni`, `interventii`, `articole` | Plugin |
| ACF field groups (`acf-json/`) | Plugin |
| Shortcodes (`[gu_*]`) | Plugin |
| Design tokens (CSS custom properties) | Plugin |
| Component CSS (cards, buttons, FAQ) | Plugin |
| Scroll-reveal JS | Plugin |
| Schema.org output | Plugin |
| Page layout HTML | Child theme (after migration) |
| Global header/footer | Child theme Stage 1 |
| Static page templates | Child theme Stage 2 |
| CPT single/archive templates | Child theme Stage 3 |

---

## Next Migration Stage

**Stage 1** — `header.php`, `footer.php`, `404.php`

Pre-conditions before starting Stage 1:
- Child theme is activated on staging and confirmed working (no visual regression)
- Playwright baseline screenshots captured with Elementor header/footer active
- Stage 1 PHP templates built and visually matched to Elementor output
- Elementor Theme Builder conditions for header/footer removed after PHP templates confirmed

See full details: `docs/planning/CHILD_THEME_MIGRATION_PLAN.md#stage-1`

---

## Staging Activation Instructions

### Option A — Upload ZIP
1. WordPress Admin → Appearance → Themes → Add New → Upload Theme
2. Upload `wp-content/themes/ungureanu-md-child.zip`
3. Click **Activate**
4. Confirm Hello Elementor remains installed (not activated — child theme takes over)
5. Verify GU Design System plugin is active
6. Open site — should look identical to before (scaffold adds nothing visual)

### Option B — Manual copy
1. Copy `wp-content/themes/ungureanu-md-child/` to server `wp-content/themes/`
2. Activate via WP Admin → Appearance → Themes

### Verification after activation
- [ ] Homepage loads with correct header, footer, design tokens
- [ ] All 9 pages return 200 — no blank pages
- [ ] `gu-design-system.css` still enqueued (plugin independent of theme)
- [ ] No PHP warnings in source
- [ ] Elementor editor still accessible on pages (Elementor unaffected by theme switch)

---

## QA Results

### PHP syntax
```
php -l functions.php: No syntax errors detected
```

### style.css header — required fields present
```
Theme Name:  ✓ Ungureanu MD Child
Template:    ✓ hello-elementor
Version:     ✓ 1.0.0
Author:      ✓ Mr. Bucur
Author URI:  ✓ https://puiu.bucur.info
Text Domain: ✓ ungureanu-md-child
```

### ZIP structure
```
ungureanu-md-child/
ungureanu-md-child/style.css
ungureanu-md-child/functions.php
ungureanu-md-child/README.md
ungureanu-md-child/screenshot.png
```
