# Site Architecture — georgeungureanu.doctor

## Hybrid Template Model

This site uses two distinct rendering strategies depending on content type.

---

### Native PHP Templates (CPT Archives & Singles)

These templates live in `wp-content/themes/ungureanu-md-child/` and render
entirely in PHP. They are not editable in the Elementor visual editor.

| Template | URL | Purpose |
|---|---|---|
| `archive-afectiuni.php` | `/afectiuni/` | Grid of all medical conditions |
| `archive-interventii.php` | `/interventii/` | Grid of all surgical procedures |
| `archive-articole.php` | `/articole/` | Grid of all articles |
| `single-afectiuni.php` | `/afectiuni/{slug}/` | Single medical condition |
| `single-interventii.php` | `/interventii/{slug}/` | Single surgical procedure |
| `single-articole.php` | `/articole/{slug}/` | Single article |

**Why native PHP here:** These templates are query-driven — they loop over
custom post type entries, read ACF fields, and render structured medical content
(symptoms, diagnosis, treatment sections, FAQ, CTA). The layout is fixed by
design and must be consistent across all entries. There is no editorial need to
rearrange sections per-post.

**ACF field access note:**
- `afectiuni` / `articole`: fields accessed by name (e.g. `get_field('subtitle')`)
- `interventii`: fields accessed by key (e.g. `get_field('field_sp_subtitle')`)
  because the ACF group `group_sp.json` has empty `name` values

---

### Elementor-Editable Templates (Static Pages)

These templates are thin PHP wrappers that call `the_content()`. All visible
content is managed inside the Elementor visual editor.

| Template | URL | Starter JSON |
|---|---|---|
| `page-despre.php` | `/despre/` | `elementor-starters/despre.json` |
| `page-programari.php` | `/programari/` | `elementor-starters/programari.json` |
| `page-recomandari.php` | `/recomandari/` | `elementor-starters/recomandari.json` |

**Why Elementor here:** These pages contain content that will change over time
(biography, clinic addresses, phone numbers, testimonials, colleague
recommendations). The client needs to update this content without a developer.
The Elementor editor provides a safe, visual interface for those edits.

**PHP wrapper contract:**
- Calls `get_header()` and `get_footer()` — header/footer always come from the
  child theme, never from Elementor's site-wide settings
- Wraps output in `<main id="content" class="gu-elementor-page">` for
  consistent landmark and CSS targeting
- Shows an admin-only hint (visible only to logged-in editors) when no
  Elementor content has been added yet, with a direct link to the editor and
  the path to the relevant starter JSON

---

### How to import a starter template

1. In WP Admin, go to **Pages** and open the target page (Despre, Programări,
   or Recomandări)
2. Click **Edit with Elementor**
3. In the Elementor panel, click the folder icon (Import Template) or use
   **My Templates → Import**
4. Upload the corresponding `.json` file from `elementor-starters/`
5. Insert the template into the page — all sections are immediately editable
6. Replace all `[CLIENT_CONTENT: ...]` placeholders with real content
7. Click **Publish**

---

### What NOT to do

- Do not assign Elementor templates to `archive-*` or `single-*` URLs — those
  use WordPress template hierarchy, not page templates
- Do not set the Elementor "Page Layout" to "Elementor Full Width" on the three
  editable pages — the PHP wrapper already provides the `<main>` landmark and
  the child theme provides header/footer
- Do not add ACF fields to the Despre / Programări / Recomandări pages — those
  pages are content-edited directly in Elementor

---

### Plugin: gu-design-system

`wp-plugin/gu-design-system/gu-design-system.php` registers:

- Custom post types: `afectiuni`, `interventii`, `articole`
- ACF field groups (via JSON sync): `acf-json/group_mc.json`, `group_sp.json`,
  `group_ar.json`
- Admin setup page at **GU Design System → Setup** with tools to create core
  pages, flush permalinks, and repair an Elementor default kit

### Child theme: ungureanu-md-child

`wp-content/themes/ungureanu-md-child/` contains:

- All PHP templates listed above
- `assets/css/theme.css` — design tokens, archive/single/page layout CSS,
  light footer, responsive breakpoints (Apple Health palette)
- `functions.php` — enqueues theme.css, registers menus, loads plugin

---

### Design Tokens (Apple Health palette)

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
