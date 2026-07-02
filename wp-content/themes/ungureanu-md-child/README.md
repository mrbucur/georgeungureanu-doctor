# Ungureanu MD Child Theme

**Version:** 1.0.0  
**Parent theme:** Hello Elementor  
**Author:** Mr. Bucur — https://puiu.bucur.info  
**Text domain:** `ungureanu-md-child`

---

## Purpose

This child theme is the frontend layout source of truth for georgeungureanu.doctor.

As PHP templates migrate from Elementor exports to native WordPress templates (see migration plan in `docs/planning/CHILD_THEME_ARCHITECTURE.md`), this theme becomes the single place to find, edit, and version-control every page layout.

---

## What lives here

| File / Directory | Purpose |
|---|---|
| `style.css` | Theme registration header + theme-level CSS |
| `functions.php` | Enqueue styles, theme support, theme-scoped hooks |
| `header.php` | *(Stage 1)* Site header — replaces Elementor header template |
| `footer.php` | *(Stage 1)* Site footer — replaces Elementor footer template |
| `404.php` | *(Stage 1)* 404 error page |
| `front-page.php` | *(Stage 2)* Homepage |
| `page-programari.php` | *(Stage 2)* Appointments page |
| `page-despre.php` | *(Stage 2)* About page |
| `page-recomandari.php` | *(Stage 2)* Recommendations page |
| `archive-afectiuni.php` | *(Stage 3)* Afecțiuni archive |
| `single-afectiuni.php` | *(Stage 3)* Afecțiune single |
| `archive-interventii.php` | *(Stage 3)* Intervenții archive |
| `single-interventii.php` | *(Stage 3)* Intervenție single |
| `archive-articole.php` | *(Stage 3)* Articole archive |
| `single-articole.php` | *(Stage 3)* Articol single |

---

## What does NOT live here

Everything below belongs in the **gu-design-system plugin**, not this theme:

- CPT and taxonomy registration (`afectiuni`, `interventii`, `articole`)
- ACF field group sync (`acf-json/`)
- Shortcodes (`[gu_*]`)
- Design token CSS (`:root` custom properties, `gu-design-system.css`)
- Component CSS (cards, buttons, FAQ, grids)
- Scroll-reveal animations (`gu-animations.js`)
- Schema.org structured data helpers
- Admin-only setup utilities

---

## Installation

### From ZIP
1. WordPress Admin → Appearance → Themes → Add New → Upload Theme
2. Upload `ungureanu-md-child.zip`
3. Activate

### Manual
1. Copy `ungureanu-md-child/` to `wp-content/themes/`
2. Ensure Hello Elementor is installed and active
3. Activate Ungureanu MD Child

---

## Development notes

- Hello Elementor must be installed (not activated — child theme activates instead)
- GU Design System plugin must be active for design tokens and shortcodes to work
- Elementor Pro must be active until all templates are migrated to PHP (Stages 1–4)
