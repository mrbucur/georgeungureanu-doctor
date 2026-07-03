# Site Architecture — georgeungureanu.doctor

## Template Model

This site uses **Elementor Pro** throughout. There are two categories:

| Category | Templates | Managed via |
|---|---|---|
| **Static pages** | Acasă, Despre, Programări, Recomandări | Elementor Page Editor |
| **CPT archives + singles** | afectiuni, interventii, articole | Elementor Pro Theme Builder |

PHP templates in the child theme serve as **fallbacks** — they are active only when no Elementor Pro template with matching conditions is published.

---

## Static Pages (Elementor Page Editor)

| PHP Wrapper | URL | Starter JSON |
|---|---|---|
| `front-page.php` | `/` | `elementor-starters/acasa.json` |
| `page-despre.php` | `/despre/` | `elementor-starters/despre.json` |
| `page-programari.php` | `/programari/` | `elementor-starters/programari.json` |
| `page-recomandari.php` | `/recomandari/` | `elementor-starters/recomandari.json` |

Each wrapper calls `get_header()` + `the_content()` + `get_footer()`. An admin-only hint appears when no Elementor content exists yet.

**Homepage Posts widget:** `acasa.json` uses the Elementor Pro `posts` widget querying `post_type: afectiuni`, `posts_per_page: 6`, ordered by `menu_order`. Replace with the Pro Posts widget configured as needed.

**How to import and build a static page:**
1. WP Admin → Pages → open page → Edit with Elementor
2. Click folder icon (Add Template) → My Templates → Import Templates
3. Upload the starter JSON → Insert → publish

---

## CPT Archives & Singles (Elementor Pro Theme Builder)

| Starter JSON | Type | Condition to set |
|---|---|---|
| `elementor-starters/theme-builder/archive-afectiuni.json` | Archive | Post Type Archive › Afecțiuni |
| `elementor-starters/theme-builder/archive-interventii.json` | Archive | Post Type Archive › Intervenții |
| `elementor-starters/theme-builder/archive-articole.json` | Archive | Post Type Archive › Articole |
| `elementor-starters/theme-builder/single-afectiuni.json` | Single | Single › Afecțiune |
| `elementor-starters/theme-builder/single-interventii.json` | Single | Single › Intervenție |
| `elementor-starters/theme-builder/single-articole.json` | Single | Single › Articol |

**How to import and activate a Theme Builder template:**
1. WP Admin → Elementor → My Templates → Import Templates
2. Upload the JSON → it appears in the library
3. WP Admin → Elementor → Theme Builder → Add New (Archive or Single)
4. Click the imported template → Set Conditions → Post Type Archive › [CPT] (or Single › [CPT]) → Save & Close

**ACF Dynamic Tags in single templates:**
- `single-afectiuni.json` — fields accessed by name: `subtitle`, `short_summary`, `symptoms`, `causes`, `diagnosis`, `treatment`, `recovery`, `faq`, `cta_title`, `cta_text`
- `single-interventii.json` — fields accessed by key: `field_sp_subtitle`, `field_sp_short_summary`, `field_sp_indications`, `field_sp_when_surgery`, `field_sp_surgical_technique`, `field_sp_benefits`, `field_sp_risks`, `field_sp_recovery_timeline`, `field_sp_faq`, `field_sp_cta_title`
- `single-articole.json` — fields by name: `subtitle`, `short_summary`, `key_takeaways` + `post-content` widget for `the_content()`

The `__dynamic__` key in widget settings carries the ACF tag binding. After import, verify fields are connected in the Elementor editor (Dynamic Tags icon on each widget).

**Archive-posts widget:** Archive templates use `archive-posts` widget (not `posts`) — it inherits the current archive query automatically. No custom query needed.

---

## Fallback PHP Templates

If a Theme Builder template is not published for a given condition, WordPress falls back to these child theme files:

| File | Fallback for |
|---|---|
| `archive-afectiuni.php` | `/afectiuni/` |
| `archive-interventii.php` | `/interventii/` |
| `archive-articole.php` | `/articole/` |
| `single-afectiuni.php` | `/afectiuni/{slug}/` |
| `single-interventii.php` | `/interventii/{slug}/` |
| `single-articole.php` | `/articole/{slug}/` |

These are fully functional native PHP templates and can remain in production as a safety net.

---

## Plugin: gu-design-system

`wp-plugin/gu-design-system/gu-design-system.php` registers:

- Custom post types: `afectiuni`, `interventii`, `articole`
- ACF field groups (JSON sync): `acf-json/group_mc.json`, `group_sp.json`, `group_ar.json`
- Admin setup page: **GU Design System → Setup** — create core pages, flush permalinks, repair Elementor default kit

## Child Theme: ungureanu-md-child

- PHP page/archive/single templates (wrappers + fallbacks)
- `assets/css/theme.css` — design tokens, archive/single layout CSS, light footer, responsive breakpoints
- `functions.php` — enqueues theme.css, registers menus

---

## Design Tokens (Apple Health palette)

```css
--color-ink:            #1D1D1F
--color-ink-secondary:  #424245
--color-ink-tertiary:   #6E6E73
--color-surface:        #FFFFFF
--color-surface-warm:   #F5F5F7
--color-surface-gray:   #F2F2F7
--color-accent:         #0E7FC0
--color-accent-hover:   #0B6094
--font-sans:            'Inter', system-ui, -apple-system, sans-serif
```
