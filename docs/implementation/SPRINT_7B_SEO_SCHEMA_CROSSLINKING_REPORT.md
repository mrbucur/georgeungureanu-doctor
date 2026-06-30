# Sprint 7B — Content SEO & Schema Layer
**Status:** COMPLETE — 90/90 Playwright QA PASS  
**Date:** 2026-06-30  
**Plugin version:** gu-design-system v1.2.0 (committed with Sprint 7A; 7B adds Section 9 code)

---

## Objectives

1. Wire `seo_title` / `seo_description` ACF fields to `<head>` (Yoast/Rank Math safe)
2. Schema.org JSON-LD: MedicalWebPage/Article, BreadcrumbList, Physician nodes
3. Author/Medical Review block shortcode (`[gu_article_author]`) with Dr. George credentials
4. Cross-linking: article → conditions/procedures, reverse-lookup for conditions/procedures → articles
5. Demo article ID=115 connected to condition ID=54, procedure ID=71
6. Playwright QA — Desktop/Tablet/Mobile on 4 URLs
7. Export updated Elementor templates

---

## Implementation Details

### 1. SEO Head Injection (`gu-design-system.php` Section 9)

**Title:** `pre_get_document_title` filter (priority 20). Reads `seo_title` ACF field; falls through to WordPress default if empty. Skips entirely if Yoast SEO, Rank Math, SEOPress, or The SEO Framework is active (`gu_seo_plugin_active()` guard).

**Meta description:** `wp_head` action (priority 1). Reads `seo_description`; falls back to `short_summary`. Truncated to 155 chars via `mb_substr`. Same SEO-plugin guard.

### 2. Schema.org JSON-LD

`wp_head` action (priority 10) injects a single `<script type="application/ld+json">` with a `@graph` array:

| Node | Type | Key fields |
|------|------|-----------|
| Article | `MedicalWebPage` / `Article` / `FAQPage` | name, description, datePublished, dateModified (from `medical_review_date` ACF field), author ref, breadcrumb ref |
| Navigation | `BreadcrumbList` | Acasă → Articole → current title |
| Author | `Physician` | Dr. George Ungureanu, jobTitle=Neurochirurg, worksFor=MedicalOrganization |

Schema type determined by `seo_schema_type` ACF field (or `schema_type` fallback). Allowed values: `Article`, `MedicalWebPage`, `FAQPage`. Defaults to `MedicalWebPage`.

No fake ratings, review counts, or medical claims.

### 3. Author / Medical Review Block

Shortcode: `[gu_article_author]`

Outputs `.gu-author-block` with:
- SVG avatar placeholder (no external image dependency)
- Label "Autor & Revizie medicală"
- Name from `author_display_name` ACF field (default: Dr. George Ungureanu)
- Credentials from `author_credentials` (default: MD, Neurochirurg)
- Optional short bio from `author_bio_short`
- Medical review date from `medical_review_date` (formatted `d F Y` in Romanian locale)
- Link to `/despre/`

CSS Section 22 added: responsive flex layout, collapses to column on ≤ 600px.

Elementor template 112 (Articole Single): section `s7bg010` inserted at index 3 (after article body, before FAQ section).

### 4. Cross-linking

**Article → Conditions/Procedures** (existing Sprint 7A shortcodes `[gu_related_conditions]` / `[gu_related_procedures]`): no change needed.

**Conditions/Procedures → Articles** (new `[gu_articles_for_post]`):
- `WP_Query` on `post_type=articole`, `post_status=publish`, `posts_per_page=6`
- `meta_query` with `relation=OR` across 6 fields: `related_condition_1/2/3`, `related_procedure_1/2/3`
- No new ACF fields needed; reverse-lookup uses existing `post_object` field values
- Outputs `.gu-related-grid` with `.gu-related-card` items (title, summary excerpt, category, reading time, link)

Templates updated:
- **ID=52** (Afectiuni Single): section `s4sg070` with "Articole pentru pacienți" H2 + `[gu_articles_for_post]`
- **ID=69** (Interventii Single): section `s5sg070` with same layout

### 5. Demo Relationships

Set via `update_field()` with WP loaded:

| Field | Post | Value |
|-------|------|-------|
| `related_condition_1` | 115 (hernia article) | 54 (hernie-de-disc-lombara) |
| `related_procedure_1` | 115 (hernia article) | 71 (microdiscectomie-lombara) |

Reverse-lookup confirms: condition page ID=54 and procedure page ID=71 each show 1 article card from `[gu_articles_for_post]`.

---

## Elementor Template Exports

| File | Post ID | Sections |
|------|---------|---------|
| `elementor-templates/sprint7a-single-articol.json` | 112 | 8 (added author block) |
| `elementor-templates/sprint4-single-afectiuni.json` | 52 | 6 (added articles section) |
| `elementor-templates/sprint5-single-interventii.json` | 69 | 6 (added articles section) |

---

## QA Results — 90/90 PASS

**Viewports:** Desktop 1440px, Tablet 768px, Mobile 390px  
**URLs:** `/articole/`, `/articole/hernia-de-disc-lombara/`, `/afectiuni/hernie-de-disc-lombara/`, `/interventii/microdiscectomie-lombara/`

| ID | Test | Result |
|----|------|--------|
| AR1–AR3 | Archive: load, 1 card, no overflow | PASS ×3 |
| ART1–ART2 | Single: load, H1 | PASS ×3 |
| ART3 | SEO meta description | PASS ×3 |
| ART4–ART8 | Schema: MedicalWebPage, BreadcrumbList, Physician, Dr. name, FAQPage | PASS ×15 |
| ART9–ART11 | Author block: present, name, review date | PASS ×9 |
| ART12–ART14 | Related conditions/procedures sections + cards | PASS ×9 |
| ART15 | CTA to /programari/ | PASS ×3 |
| ART16–ART17 | No overflow, mobile padding | PASS ×6 |
| COND1–COND5 | Condition: load, H1, articles section, reverse card, no overflow | PASS ×15 |
| PROC1–PROC5 | Procedure: same | PASS ×15 |

---

## Issues Resolved During Sprint

### Author block not rendering (`_elementor_element_cache` stale)

**Symptom:** `.gu-author-block` absent from HTML despite section `s7bg010` being present in `_elementor_data` and shortcode registered. `grep -c "s7bg"` returned 0 on rendered page.

**Root cause:** `_elementor_element_cache` postmeta on template post 112 stored a pre-rendered HTML snapshot from before the author section was added. Elementor served this cache instead of re-rendering from `_elementor_data`. Same issue affected the archive template (ID=113) whose element cache had stale content after plugin version bump.

**Fix:** Deleted `_elementor_element_cache`, `_elementor_page_assets`, and `_elementor_css` postmeta from all affected template posts (112, 113, 52, 69) and warmed pages via HTTP request.

**Note for future sprints:** Whenever an Elementor template's `_elementor_data` is updated directly via DB, also delete `_elementor_element_cache` and `_elementor_page_assets` on the same post. Elementor does not auto-invalidate the element cache when `_elementor_data` changes via raw SQL.

---

## Constraints Honoured

- No AI-generated medical content published without human review (demo article is clearly marked `[DEMO]`)
- No fake ratings, review counts, or medical claims in schema
- SEO injection skips gracefully if any major SEO plugin is active
- ACF Free compatible (no Pro features used)
