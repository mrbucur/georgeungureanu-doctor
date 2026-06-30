# Sprint 7A — Articole CPT (Knowledge Center) Implementation Report

**Date:** 2026-06-30  
**Status:** QA COMPLETE — 72/72 PASS — Awaiting browser verification before commit  
**Environment:** LocalWP `http://georgeungureanu-doctor-dev.local`

---

## Scope

Sprint 7A implements the foundational **Knowledge Center** content engine: a `articole` Custom Post Type for publishing medically-reviewed patient education articles, with full Elementor theme builder templates, ACF field group, and article card shortcodes.

**Critical constraint:** Content marked `[DEMO]` requires medical review by Dr. George Ungureanu before publication.

---

## Deliverables

### 1. CPT: `articole` + Taxonomies

Registered in `gu-design-system.php` (Section 7):

| Item | Key | Slug |
|---|---|---|
| CPT | `articole` | `/articole/{slug}/` |
| Category taxonomy (hierarchical) | `categorie-articole` | `/articole/categorie/{slug}/` |
| Tag taxonomy (flat) | `eticheta-articole` | `/articole/eticheta/{slug}/` |

- Flat URL structure: `/articole/{slug}/` (no category prefix)
- `show_in_rest: true`, `has_archive: true`
- Supports: title, editor, thumbnail, excerpt, revisions

### 2. Shortcodes (Section 8)

| Shortcode | Output |
|---|---|
| `[gu_field name="X" default="Y"]` | Any ACF field value (generic helper) |
| `[gu_articole_archive]` | Card grid of published articles (supports `limit=N category=slug`) |
| `[gu_article_meta]` | Author byline + medical review date + reading time strip |
| `[gu_key_takeaways]` | Key takeaways callout box (accent border, green fill) |
| `[gu_article_faq]` | FAQ accordion + FAQPage JSON-LD schema injection |
| `[gu_related_conditions]` | Related `afectiuni` card grid (via ACF Free fallback) |
| `[gu_related_procedures]` | Related `interventii` card grid (via ACF Free fallback) |
| `[gu_related_articles]` | Related `articole` card grid (via ACF Free fallback) |

#### ACF Free/Pro compatibility (`gu_get_related_posts()` helper)
- **ACF Free:** reads `post_object` fields `related_{type}_1/2/3`
- **ACF Pro (future):** reads `relationship` field `related_{type}s`
- Helper auto-detects which is present — upgrade path is transparent

### 3. ACF Field Group: `group_ar`

- **DB ID:** 78 — **Key:** `group_ar` — **Fields:** 33
- **Location rule:** `post_type == articole`
- **Exported:** `wp-plugin/gu-design-system/acf-json/group_ar.json` (20.7 KB)

| Field group | Count | Notes |
|---|---|---|
| Core content | 4 | subtitle, short_summary, key_takeaways, reading_time |
| Medical authority | 4 | medical_review_date, author_display_name, author_credentials, author_bio_short |
| Relationships (post_object ×3 per type) | 9 | 3 conditions + 3 procedures + 3 articles |
| FAQ (text+textarea pairs ×5) | 10 | faq_1_question…faq_5_answer |
| CTA configuration | 3 | cta_title, cta_text, cta_button_label |
| Schema & SEO | 3 | schema_type, seo_title, seo_description |

**ACF Pro upgrade path:**
- FAQ 5×pairs → Repeater `faq_items` (question/answer sub-fields) — shortcode already handles both
- 9× post_object → 3× relationship fields — helper already handles both

### 4. Elementor Templates

| Template | DB ID | Type | Condition | File |
|---|---|---|---|---|
| Articol — Single | 112 | single | `include/singular/articole` | `sprint7a-single-articol.json` |
| Articole — Archive | 113 | archive | `include/archive/articole_archive` | `sprint7a-archive-articole.json` |

#### Single Article Template Sections (s7sg prefix)

| Section | Background | Content |
|---|---|---|
| 1. Hero | Dark `#231E1A` | `theme-post-title` (H1) + `[gu_field name="subtitle"]` + `[gu_article_meta]` |
| 2. Key Takeaways | Warm `#F4EFE6` | `[gu_key_takeaways]` |
| 3. Article Body | White `#FDFBF7` | `theme-post-content` (760px constrained) |
| 4. FAQ | Warm `#F4EFE6` | `[gu_article_faq]` (accordion + JSON-LD) |
| 5. Related Conditions | White | H2 + `[gu_related_conditions]` |
| 6. Related Procedures | Warm | H2 + `[gu_related_procedures]` |
| 7. CTA | Dark `#231E1A` | `[gu_field name="cta_title"]` + text + `/programari/` button |

#### Archive Template Sections (s7ar prefix)

| Section | Background | Content |
|---|---|---|
| 1. Hero | Dark `#231E1A` | H1 "Articole pentru Pacienți" + lead text |
| 2. Grid | White `#FDFBF7` | `[gu_articole_archive]` card grid (760px constrained) |

### 5. CSS Section 21

Added to `gu-design-system.css` (~370 lines):
- `.gu-articole-grid` — article card grid (auto-fill, minmax 280px)
- `.gu-article-card` — card layout with category badge, title, summary, footer
- `.gu-article-meta` — author/date/reading-time strip (flex, wraps on mobile)
- `.gu-key-takeaways` — callout box with accent left border
- `elementor-widget-theme-post-content` overrides — article body typography
- `.gu-faq` / `.gu-faq__question` / `.gu-faq__answer` — accessible accordion
- `.gu-related-grid` / `.gu-related-card` — related content cards
- Mobile media queries at 600px

**Additional fix:** Added `overflow-x: hidden` to `html` element (Section 02) to prevent horizontal scrollbar caused by Elementor nav dropdown menu at mobile viewports. This affected ALL pages (pre-existing issue, confirmed on `/afectiuni/` pages).

### 6. Demo Article

- **Post ID:** 115
- **Slug:** `hernia-de-disc-lombara`
- **URL:** `/articole/hernia-de-disc-lombara/`
- **Status:** Published (required for Theme Builder preview; marked `[DEMO]` in title)
- **Taxonomy:** category "Coloana vertebrală", 5 tags
- **ACF fields populated:** 24/33 (relationship fields left empty; schema_type defaults set)
- **Content:** 5 H2 sections, demo FAQ (5 Q&A pairs), key takeaways, author meta

**⚠️ IMPORTANT:** Content is medical in nature and must NOT be published on a public/staging site without explicit review by Dr. George Ungureanu.

---

## Bugs Fixed During Sprint

### Bug 1: Theme Builder conditions format
**Error:** Elementor templates not applied — single/archive pages fell through to default WP templates.  
**Root cause:** `_elementor_conditions` postmeta missing from template posts 112/113. The global `elementor_pro_theme_builder_conditions` option was also written in the wrong format (template ID as outer key instead of `single`/`archive` string key).  
**Fix:** Added `_elementor_conditions = serialize(['include/singular/articole'])` / `serialize(['include/archive/articole_archive'])` to postmeta; corrected the global conditions option to use `$conditions['single'][112]` / `$conditions['archive'][113]` format (matching existing Sprint 4/5 templates).

### Bug 2: ACF group_ar key stored as `article-knowledge-center`
**Error:** `post_excerpt` (ACF group key) set to `article-knowledge-center` (slugified title) instead of `group_ar`.  
**Root cause:** `acf_import_field_group()` appears to derive `post_excerpt` from title rather than the explicit `key` parameter in some ACF Free versions.  
**Fix:** Direct DB update: `UPDATE wp_posts SET post_excerpt='group_ar', post_name='group_ar' WHERE ID=78`; also updated serialized `post_content` to correct the embedded `key`.

### Bug 3: Mobile nav dropdown horizontal overflow (pre-existing)
**Discovered during QA** — also present on `/afectiuni/` and all other pages.  
**Root cause:** Elementor nav menu mobile dropdown positioned at `left=215px, width=390px` causing `body.scrollWidth > viewport`. `position: absolute` elements in the dropdown extended beyond viewport at 390px.  
**Fix:** Added `overflow-x: hidden` to `html { }` rule in design system CSS (standard pattern). QA updated to check `document.documentElement.clientWidth` (respects overflow-x) rather than `document.body.scrollWidth`.

### Bug 4: `[gu_field]` shortcode not registered
**Error:** CTA section used `[gu_field name="cta_title"]` but shortcode wasn't registered.  
**Fix:** Added `[gu_field name="X" default="Y"]` shortcode to Section 8 of `gu-design-system.php`.

---

## QA Results — 72/72 PASS

Playwright QA at Desktop (1440px), Tablet (768px), Mobile (390px).

| Test prefix | What | Viewports | Result |
|---|---|---|---|
| A1–A8 | Archive page: load, H1, cards, links, categories, nav, footer, overflow | 3× | 24/24 ✓ |
| S1–S16 | Single page: load, H1, meta, author, takeaways, body, FAQ, accordion, schema, related, CTA, overflow, mobile padding | 3× | 48/48 ✓ |

**Total: 72/72 PASS**

---

## Plugin Version

`gu-design-system.php` version bumped: `1.0.0` → `1.1.0`

---

## Files Changed

| File | Change |
|---|---|
| `wp-plugin/gu-design-system/gu-design-system.php` | Added Section 7 (CPT + taxonomies) and Section 8 (8 shortcodes); version → 1.1.0 |
| `wp-plugin/gu-design-system/assets/css/gu-design-system.css` | Added Section 21 (article styles, ~370 lines); `overflow-x: hidden` on `html` |
| `wp-plugin/gu-design-system/acf-json/group_ar.json` | New — ACF field group export (20.7 KB, 33 fields) |
| `wp-plugin/gu-design-system/elementor-templates/sprint7a-single-articol.json` | New — Single template export (20.5 KB) |
| `wp-plugin/gu-design-system/elementor-templates/sprint7a-archive-articole.json` | New — Archive template export (5.4 KB) |
| `docs/TECH_DEBT.md` | Updated entries 2 and "ACF Pro Opportunities" |

---

## Database Objects Created

| Object | ID | Notes |
|---|---|---|
| ACF field group | 78 | `group_ar`, 33 fields, `articole` post type |
| Elementor Single template | 112 | `_elementor_conditions: include/singular/articole` |
| Elementor Archive template | 113 | `_elementor_conditions: include/archive/articole_archive` |
| Demo article | 115 | `hernia-de-disc-lombara`, 24 ACF fields, DEMO content |
| Taxonomy term: Coloana vertebrală | 7 | `categorie-articole` |
| 5 article tags | auto | `eticheta-articole` |

---

## What's NOT Done (Sprint 7B+)

- [ ] **Photography:** Featured images not displayed (no assets yet; `thumbnail` CPT support registered)
- [ ] **SEO output:** `seo_title` / `seo_description` ACF fields stored but not wired to `<head>` (requires Yoast or custom hook)
- [ ] **Schema output:** `schema_type` field stored but MedicalWebPage/Article JSON-LD not injected (Sprint 7B)
- [ ] **Author bio section:** `author_bio_short` field populated but no display widget in template
- [ ] **Category filter UI:** Archive shows all articles; category filtering not implemented
- [ ] **Patient journey interlinking:** Demo article has no related conditions/procedures (CPTs have content but no cross-links set)
- [ ] **Nav menu update:** `/articole/` not yet added to global nav (requires WP admin → Appearance → Menus)
- [ ] **ACF Pro upgrade:** See TECH_DEBT.md for migration path when Pro license is available

---

## How to Verify (Browser Checklist)

1. Visit `http://georgeungureanu-doctor-dev.local/articole/` → should show dark hero with H1 "Articole pentru Pacienți" + article card grid
2. Click the demo article card → `/articole/hernia-de-disc-lombara/`
3. Verify: dark hero with H1 title, author/date/reading-time meta strip
4. Scroll to Key Takeaways (warm section, green border-left box with bullet list)
5. Scroll to article body (5 H2 sections with article content)
6. Scroll to FAQ accordion → click any question → answer expands/collapses
7. Check page source for `"FAQPage"` in JSON-LD
8. Scroll to "Afecțiuni conexe" and "Intervenții chirurgicale conexe" headings (empty card grids — no related content set yet)
9. Scroll to dark CTA strip → "Programează o consultație" button → links to `/programari/`
10. Verify responsive at mobile: no horizontal scrollbar, adequate text padding
