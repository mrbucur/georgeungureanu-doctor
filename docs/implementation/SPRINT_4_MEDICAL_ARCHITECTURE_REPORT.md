# Sprint 4 — Medical Content Architecture Report

**Date:** 2026-06-29
**Status:** COMPLETE — all browser verification passes

---

## Deliverables

### 1. Custom Post Type: `afectiuni`

Registered in `gu-design-system.php` via `gu_register_cpt_afectiuni()` on the `init` hook.

- **Slug:** `/afectiuni/`
- **Archive:** enabled (`has_archive: true`)
- **REST API:** enabled (`show_in_rest: true`)
- **Supports:** title, thumbnail, excerpt
- **Menu icon:** `dashicons-heart`

### 2. Taxonomy: `categorie-afectiuni`

Registered via `gu_register_taxonomy_categorie_afectiuni()` — hierarchical, public, REST-enabled.

- **Slug:** `/categorie-afectiuni/`
- **Attached to:** `afectiuni` CPT

### 3. ACF Field Group: "Medical Condition"

**Group ID:** 39 (`key: group_mc`)
**Location rule:** Post Type == `afectiuni`
**ACF version:** Free 6.8.4 (no Pro features used)

| # | Field name | Type | Purpose |
|---|-----------|------|---------|
| 1 | `subtitle` | text | Hero subtitle (e.g. "Cauze, simptome și tratament") |
| 2 | `short_summary` | textarea | Lead paragraph / archive card excerpt |
| 3 | `symptoms` | wysiwyg | Simptome section |
| 4 | `causes` | wysiwyg | Cauze section |
| 5 | `diagnosis` | wysiwyg | Diagnostic section |
| 6 | `treatment` | wysiwyg | Tratament section |
| 7 | `recovery` | wysiwyg | Recuperare section |
| 8 | `faq` | wysiwyg | Întrebări frecvente section |
| 9 | `cta_title` | text | CTA heading |
| 10 | `cta_text` | textarea | CTA sub-text |
| 11 | `seo_title` | text | SEO override title |
| 12 | `seo_description` | textarea | SEO meta description |

### 4. Shortcodes (added to `gu-design-system.php`)

**`[gu_field name="field_name"]`**
Renders any ACF field value for the current post. Bypasses ACF's `enable_shortcode` setting (disabled by default in ACF ≥ 6.3). Safe: output is passed through `wp_kses_post()`.

**`[gu_afectiuni_archive]`**
Renders a responsive CSS Grid of all published `afectiuni` posts, sorted A→Z. Each card shows: title (linked), short_summary excerpt (20 words), "Citește mai mult →" teal link.

### 5. Elementor Single Template (ID: 52)

**Title:** Afecțiune — Single
**Type:** `single` (theme builder)
**Condition:** `include/singular/afectiuni`

Layout sections (top to bottom):
1. **Hero** — dark background (`#231E1A`), H1 via `theme-post-title` dynamic tag (`post-title`), subtitle via `text-editor` + `[gu_field name="subtitle"]`
2. **Summary** — warm surface (`#F4EFE6`), `[gu_field name="short_summary"]`
3. **Simptome** — H3 + `[gu_field name="symptoms"]` wysiwyg
4. **Cauze** — H3 + `[gu_field name="causes"]` wysiwyg
5. **Diagnostic** — H3 + `[gu_field name="diagnosis"]` wysiwyg
6. **Tratament** — H3 + `[gu_field name="treatment"]` wysiwyg (contains H4 sub-headings for conservative/surgical)
7. **Recuperare** — H3 + `[gu_field name="recovery"]` wysiwyg
8. **Întrebări frecvente** — H2 + `[gu_field name="faq"]` wysiwyg (Q&A pairs)
9. **CTA** — dark background, `[gu_field name="cta_title"]` + `[gu_field name="cta_text"]` + "Programează o consultație" button

### 6. Elementor Archive Template (ID: 53)

**Title:** Afecțiuni — Archive
**Type:** `archive` (theme builder)
**Condition:** `include/archive/afectiuni_archive`

Layout:
1. **Hero** — dark background, H1 "Afecțiuni tratate", descriptive subtitle
2. **Grid section** — warm surface, `[gu_afectiuni_archive]` shortcode renders responsive card grid

### 7. Demo Entry: "Hernie de disc lombară" (ID: 54)

**Slug:** `/afectiuni/hernie-de-disc-lombara/`
**Status:** published

All 12 ACF fields populated with realistic Romanian medical copy including:
- Symptoms list (7 items with clinical detail)
- Causes (degenerative + mechanical factors)
- Diagnostic protocol (clinical + MRI + EMG)
- Treatment: conservative (6–12 weeks) and surgical (microdiscectomy, endoscopic, urgent)
- Recovery timeline with percentage outcomes
- FAQ (5 Q&A pairs)
- CTA: "Programați o consultație neurochirurgicală"

---

## Technical Issues Resolved

### ACF Shortcode Disabled (ACF ≥ 6.3)
`[acf field='...']` returns empty string when `first_activated_version ≥ 6.3` because `enable_shortcode` defaults to `false`. Fixed with custom `[gu_field]` shortcode calling `get_field()` directly.

### Elementor JSON Corruption
Initial setup script used `addslashes()` before storing JSON in DB, producing `[{\"id\":...}]`. Elementor's `json_decode()` failed silently — template rendered with no content. Fixed by re-storing JSON via PDO parameterized queries with `json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)` (no manual escaping).

### Archive Condition Wrong Sub-name
`Post_Type_Archive::get_name()` returns `$post_type->name . '_archive'`, so the required condition is `include/archive/afectiuni_archive` (not `include/archive/afectiuni`). Fixed in both the global `elementor_pro_theme_builder_conditions` option and `_elementor_conditions` postmeta on template ID 53.

### Post Title Rendering as Literal Tag Text
`theme-post-title` dynamic tag rendered literally as `[elementor-tag id="" name="post-title" settings="%7B%7D"]` despite correct `__dynamic__` settings in the JSON. Root cause: Elementor's `_elementor_element_cache` postmeta (24-hour TTL by default) held a pre-fix render of the template. The cache stored rendered HTML strings including the unresolved tag text. Fix: deleted all `_elementor_element_cache` rows and disabled element caching (`elementor_element_cache_ttl = 'disable'`) for development.

---

## Browser Verification Results

All six checks pass (2 pages × 3 viewports):

| Page | Viewport | H1 | Content | Layout |
|------|----------|----|---------|--------|
| Single | Desktop 1440px | "Hernie de disc lombară" ✓ | All 9 sections ✓ | Clean ✓ |
| Single | Tablet 768px | "Hernie de disc lombară" ✓ | All 9 sections ✓ | Stacked ✓ |
| Single | Mobile 390px | "Hernie de disc lombară" ✓ | All 9 sections ✓ | Stacked ✓ |
| Archive | Desktop 1440px | "Afecțiuni tratate" ✓ | 1 card grid ✓ | Clean ✓ |
| Archive | Tablet 768px | "Afecțiuni tratate" ✓ | 1 card grid ✓ | Clean ✓ |
| Archive | Mobile 390px | "Afecțiuni tratate" ✓ | 1 card grid ✓ | Stacked ✓ |

No `[elementor-tag]` literal text present on any viewport.

---

## URLs

- **Single demo:** `http://georgeungureanu-doctor-dev.local/afectiuni/hernie-de-disc-lombara/`
- **Archive:** `http://georgeungureanu-doctor-dev.local/afectiuni/`

---

## Files Modified

- `wp-plugin/gu-design-system/gu-design-system.php` — Sections 4 (CPT + taxonomy) and 5 (shortcodes) added
- Local copy synced to: `Local Sites/georgeungureanu-doctor-dev/app/public/wp-content/plugins/gu-design-system/gu-design-system.php`

## Database Objects Created

| ID | Type | Description |
|----|------|-------------|
| 39 | ACF field group | "Medical Condition" |
| 40–51 | ACF fields | 12 fields on group 39 |
| 52 | Elementor template | Single template (theme builder) |
| 53 | Elementor template | Archive template (theme builder) |
| 54 | `afectiuni` post | Demo: "Hernie de disc lombară" |
