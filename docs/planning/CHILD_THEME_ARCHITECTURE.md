# Child Theme Architecture — georgeungureanu.doctor

**Decision date:** 2026-07-02 (Sprint 10.1)  
**Status:** Adopted — migration in progress (Stages 1–4)

---

## The Problem

Elementor template exports (`.json`) are not a reliable single source of truth for frontend layout. During the Sprint 9 Apple Health migration, several exported templates were found to still carry old Warm Academic / beige-green styling, visual properties that had already been overridden by the plugin CSS but were silently wrong in the export files. This created two risks:

1. A fresh staging deployment following old exports would produce a broken or inconsistent design.
2. Page layout exists in three places at once — Elementor database, exported JSON, and plugin PHP shortcodes — with no single authority.

---

## The Solution

Adopt a clean separation of concerns:

| Layer | Technology | Responsibility |
|---|---|---|
| **Plugin** | `gu-design-system` v1.3.x | Functionality, data, design tokens, components |
| **Child theme** | `ungureanu-md-child` | Page layout templates, structural HTML |
| **Elementor** | Retained during transition | Visual editing layer (deprecated per template as Stage 1–4 progresses) |

### Why child theme becomes the frontend layout source of truth

- **Version control:** PHP template files live in Git. Elementor's layout is in MySQL — not diffable, not rollbackable, not reviewable in a PR.
- **No export drift:** A PHP template is always current. An Elementor export is a snapshot that decays.
- **Predictable deploys:** `git push` + plugin activation = working site. No "import templates, assign conditions, regenerate CSS" ritual.
- **Designer handoff:** A PHP file with clear HTML structure and CSS classes is easier to hand off than a collapsed Elementor widget tree.
- **Elementor stays for content:** Elementor Pro retains value for the client as a visual content editor inside template regions. Removing it is not the goal.

---

## Separation of Responsibilities

### Plugin: `gu-design-system`

| What | Why |
|---|---|
| CPT registration (`afectiuni`, `interventii`, `articole`) | Data layer — must be available regardless of active theme |
| Taxonomy registration | Same — taxonomies belong to data, not presentation |
| ACF field group sync (`acf-json/`) | Field definitions travel with the plugin, not the theme |
| Shortcodes (`[gu_*]`) | Output PHP-rendered sections; theme-independent |
| Schema.org structured data | SEO/structured data is functional, not presentational |
| Design tokens (`:root` CSS custom properties) | Tokens feed both plugin components and theme templates |
| Component CSS (cards, buttons, FAQ, grids) | Reusable components that appear across multiple templates |
| Scroll-reveal animations (`gu-animations.js`) | Behavioural JS — decoupled from template structure |
| Admin setup utilities | Backend-only — no theme dependency |

### Child theme: `ungureanu-md-child`

| What | Why |
|---|---|
| `header.php` | Global header HTML — one place, one source of truth |
| `footer.php` | Global footer HTML |
| `front-page.php` | Homepage layout — replaces Elementor homepage template |
| `page-programari.php` | Appointments page layout |
| `page-despre.php` | About page layout |
| `page-recomandari.php` | Recommendations page layout |
| `archive-afectiuni.php` | Afecțiuni archive layout |
| `single-afectiuni.php` | Afecțiune single layout |
| `archive-interventii.php` | Intervenții archive layout |
| `single-interventii.php` | Intervenție single layout |
| `archive-articole.php` | Articole (Sfatul hub) archive layout |
| `single-articole.php` | Articol single layout |
| `404.php` | 404 error page |
| `functions.php` | Enqueue styles, theme support, theme-scoped hooks only |
| `style.css` | Theme registration header + theme-level CSS overrides |

### What never moves to the theme

- CPTs, taxonomies, ACF — if the theme is deactivated, content must still exist in WordPress.
- Design tokens — tokens must be available to any theme (including a future redesign).
- Shortcode output — shortcodes are called from templates but defined in the plugin.

---

## Coexistence with Elementor During Migration

While Stages 1–4 are in progress, Elementor and PHP templates will coexist:

- Pages with a PHP template file (`front-page.php`, `page-programari.php`, etc.) will use the PHP template and bypass Elementor's page content.
- Pages without a PHP template file will continue rendering via Elementor.
- Elementor header/footer Theme Builder templates remain active until `header.php` and `footer.php` are implemented (Stage 1).

Once Stage 4 is complete, the Elementor template exports can be archived and Elementor Pro can be retained as a page builder for future client content editing only (not for layout control).

---

## File Locations

| File | Path in repo | Deploys to |
|---|---|---|
| Plugin | `wp-plugin/gu-design-system/` | `wp-content/plugins/gu-design-system/` |
| Child theme | `wp-content/themes/ungureanu-md-child/` | `wp-content/themes/ungureanu-md-child/` |
| Elementor templates (archive) | `wp-plugin/gu-design-system/elementor-templates/` | Imported via WP Admin — deprecated post-migration |
