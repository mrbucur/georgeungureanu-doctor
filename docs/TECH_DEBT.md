# Technical Debt — georgeungureanu.doctor

**Last updated:** 2026-06-30  
**Status:** Pre-staging, LocalWP environment

---

## Known Limitations

### 1. Elementor templates built via raw DB inserts
**What:** All Elementor templates (IDs 9, 12, 37, 52, 53, 69, 70) were created by directly writing JSON to `wp_posts` and `wp_postmeta` via PHP/PDO scripts. No Elementor admin UI was used.

**Implication:** Template JSON must be maintained precisely. If Elementor's internal JSON schema changes across versions (e.g., new required fields, renamed keys), templates may fail silently or produce PHP warnings.

**Risk level:** Medium — Elementor Pro 4.x has been stable for 12+ months.

**Mitigation:** All templates exported to `elementor-templates/`. After any Elementor upgrade, run Playwright QA before deploying.

---

### 2. ACF group keys created without ACF admin UI
**What:** ACF field groups (IDs 39, 55) were inserted directly into `wp_posts`. The Sprint 5 group (ID=55) was initially created with a missing `post_excerpt` key — discovered and fixed in Sprint 5.5.

**Implication:** ACF's internal key (`post_excerpt`) must match the Local JSON filename. A key mismatch prevents auto-sync from `acf-json/`.

**Risk level:** Low (fixed). Sprint 5.5 corrected the key to `group_sp`.

**Mitigation:** After any DB recreation, run: `SELECT post_excerpt FROM wp_posts WHERE post_type='acf-field-group'` and verify keys match filenames in `acf-json/`.

---

### 3. No static homepage template in version control
**What:** The homepage (ID=38, slug=`acasa`) is a WordPress page with Elementor content stored only in the database. No standalone homepage template export exists in the repo.

**Implication:** To recreate the homepage, the DB must be imported or the homepage rebuilt manually from `docs/implementation/SPRINT_2_HERO_REPORT.md` and `SPRINT_3_HOMEPAGE_COMPLETION_REPORT.md`.

**Risk level:** Medium.

**Mitigation:** Export the homepage as an Elementor template via **My Templates → Save as Template** and add to `elementor-templates/homepage.json`.

---

### 4. `/programari/` page is an empty placeholder
**What:** The `/programari/` page (ID=72) was created as an empty published page to prevent 404 errors from CTA buttons. It has no Elementor template assigned and shows default theme output.

**Implication:** When a user clicks "Programează o consultație," they reach a blank page.

**Risk level:** High (UX). Blocks staging launch.

**Mitigation:** Implement the Programări page (Sprint 6 scope). Options: Calendly embed, WP booking plugin, or static contact form.

---

### 5. `sample-page` (ID=2) is published
**What:** WordPress default "Sample Page" is published at `/sample-page/`. No Elementor template is assigned.

**Implication:** Publicly accessible blank page; may appear in sitemaps.

**Risk level:** Low.

**Mitigation:** Trash or set to draft in WP admin before staging launch.

---

### 6. Elementor Kit global colors not configured
**What:** The Elementor Kit (ID=6) does not have `system_colors` set. Elementor's "Global Colors" panel is empty.

**Implication:** Template colors work because they are hardcoded as hex values in widget settings. If a future editor changes colors via Global Colors, it won't propagate to existing templates.

**Risk level:** Low (colors render correctly). Medium (maintainability).

**Mitigation:** Configure Global Colors in **Elementor → Site Settings → Global Colors** to match the design token values. Reference: `docs/design-system/COLOR_SYSTEM.md`.

---

### 7. No ACF taxonomy fields for CPT filtering
**What:** Both CPTs have taxonomies registered (`categorie-afectiuni`, `categorie-interventii`) but no terms have been created and no archive filtering UI exists.

**Implication:** The archive card grids cannot be filtered by category.

**Risk level:** Low (not required for Sprint 4/5).

**Mitigation:** Sprint 7+ — add category filter UI and populate taxonomy terms.

---

### 8. No featured image support in templates
**What:** Both CPTs support `thumbnail` (featured image), but neither single template renders it.

**Implication:** Featured images are stored but not displayed.

**Risk level:** Low.

**Mitigation:** Add a featured image widget to each single template's hero section when photography assets are available.

---

### 9. Elementor element cache disabled globally
**What:** `elementor_element_cache_ttl = 'disable'` was set in Sprint 4 to fix a rendering bug where cached HTML blocked dynamic tag resolution.

**Implication:** Every page render re-evaluates all dynamic tags. On a low-traffic site this is acceptable. On high-traffic, it adds 10–50ms per dynamic tag per request.

**Risk level:** Low (current traffic).

**Mitigation:** Re-enable with a short TTL (e.g., 300s) after confirming `__dynamic__` keys are correctly set in all templates. Full-page caching (e.g., LiteSpeed Cache) mitigates this more effectively.

---

### 10. CSS print method undefined (defaults to inline)
**What:** `elementor_css_print_method` is empty in `wp_options`. Elementor defaults to printing CSS inline in `<head>`. The current setup appears to produce external files (via our explicit `Post::update()` calls), which may not persist after plugin updates.

**Implication:** Potential for duplicate CSS (inline + external) or missing CSS after Elementor cache clear.

**Risk level:** Low.

**Mitigation:** Explicitly set in **Elementor → Settings → Advanced → CSS Print Method** to `External File`.

---

## Future Improvements

### ACF Pro Opportunities
- **Repeater fields**: FAQ entries (currently a single wysiwyg) would benefit from a repeater with `question`/`answer` sub-fields for structured output
- **Flexible Content**: Single page templates use fixed section order; Flexible Content would allow per-post section customization
- **Options Page**: Site-wide settings (clinic address, phone, working hours) currently hardcoded in footer template
- **Gallery field**: For surgical procedure images / case gallery
- **Relationship fields**: Link `interventii` to related `afectiuni` entries

### Performance Opportunities
- **Image optimization**: No WebP conversion configured; `wp-content/uploads/` will accumulate unoptimized images
- **CDN**: Static assets (fonts, CSS, images) should be served from a CDN in production
- **Full-page cache**: LiteSpeed Cache or WP Rocket recommended for production
- **Lazy loading**: Elementor Pro's lazy-load should be enabled for below-fold sections
- **Font subsetting**: Google Fonts loads full Latin-Extended set; subsetting to Latin would reduce ~20KB

### Accessibility Improvements
- **Skip to content**: Link is present (implemented in header template) but its visibility style should be tested with screen readers
- **ARIA labels**: Archive card grids use `<article>` but lack `aria-labelledby` pointing to the card title
- **Focus management**: No focus-trap on mobile burger menu
- **Color contrast**: `#5A4E47` on `#FDFBF7` should be tested — may fail WCAG AA for small text (<18px)
- **Alt text**: No alt text policy defined for featured images
- **Heading hierarchy**: Some pages may have H3s before H2s depending on content structure

### SEO
- **Meta description**: ACF fields `seo_title` and `seo_description` are stored but not yet wired to `<head>` (requires Yoast SEO or equivalent, or custom `wp_head` hook)
- **Structured data**: Neurosurgeon practice should have `MedicalOrganization` + `Physician` JSON-LD schema
- **Sitemap**: No XML sitemap plugin configured
- **robots.txt**: Default WP robots.txt; needs production configuration

---

## Database Dependencies

These items exist only in the database and cannot be recreated from git alone:

| Item | DB location | Recreation method |
|---|---|---|
| Homepage content | `wp_postmeta` (post_id=38, meta_key=`_elementor_data`) | Export as Elementor template → `elementor-templates/homepage.json` |
| ACF field values (demo posts 54, 71) | `wp_postmeta` | Re-enter manually or via WP import |
| Elementor kit settings | `wp_postmeta` (post_id=6) | Reconfigure via Elementor → Site Settings |
| Nav menu items | `wp_posts` + `wp_term_relationships` | Recreate via WP admin → Appearance → Menus |
| Site options (title, timezone) | `wp_options` | Set in WP admin → Settings |
| Elementor global colors | `wp_postmeta` (kit, `_elementor_page_settings`) | Reconfigure via Elementor → Site Settings → Global Colors |
