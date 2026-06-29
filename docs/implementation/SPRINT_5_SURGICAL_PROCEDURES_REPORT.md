# Sprint 5 — Surgical Procedures Architecture

**Date:** 2026-06-29  
**Status:** Complete — browser verification passed at all 3 viewports

---

## Overview

Built the complete architecture for the "Intervenții Chirurgicale" section using the same engineering standards as Sprint 4. All work uses ACF Free only. The homepage and Afecțiuni architecture were not modified.

---

## Deliverables

### 1. CPT: `interventii`

- Slug: `/interventii/`
- Labels in Romanian (add/edit/view/search)
- `has_archive: true`, `show_in_rest: true`
- Supports: `title`, `thumbnail`, `excerpt`
- Menu icon: `dashicons-clipboard`
- Registered in: `gu-design-system.php` → `gu_register_cpt_interventii()`

### 2. Taxonomy: `categorie-interventii`

- Hierarchical, public, REST-enabled
- Slug: `/categorie-interventii/`
- Attached to `interventii` CPT
- Registered in: `gu-design-system.php` → `gu_register_taxonomy_categorie_interventii()`

### 3. ACF Field Group: "Surgical Procedure"

| Field name | Type | Key |
|---|---|---|
| subtitle | text | field_subtitle |
| short_summary | textarea | field_short_summary |
| indications | wysiwyg | field_indications |
| when_surgery | wysiwyg | field_when_surgery |
| surgical_technique | wysiwyg | field_surgical_technique |
| benefits | wysiwyg | field_benefits |
| risks | wysiwyg | field_risks |
| recovery_timeline | wysiwyg | field_recovery_timeline |
| faq | wysiwyg | field_faq |
| cta_title | text | field_cta_title |
| cta_text | textarea | field_cta_text |
| seo_title | text | field_seo_title |
| seo_description | textarea | field_seo_description |

- Group DB ID: 55, key: `group_sp`
- Location rule: `post_type == interventii`
- ACF Local JSON: `wp-plugin/gu-design-system/acf-json/group_sp.json`

### 4. Elementor Single Template (ID=69)

Condition: `include/singular/interventii`

| Section | ID | Background | Content |
|---|---|---|---|
| Hero | s5sg001 | `#231E1A` | H1 (dynamic post title, Lora 48/38/32px), subtitle ACF field |
| Overview | s5sg010 | `#F4EFE6` | `short_summary` field (Inter 18px) |
| Clinical | s5sg020 | transparent | 6 sub-containers: indications, when_surgery, surgical_technique, benefits, risks, recovery_timeline |
| FAQ | s5sg050 | `#F4EFE6` | H2 "Întrebări frecvente" + `faq` field |
| CTA | s5sg060 | `#231E1A` | `cta_title`, `cta_text`, button → /programari/ |

Inner content containers constrained to 760px (at ≥768px).  
Outer section padding: 24px horizontal on all viewports.

### 5. Elementor Archive Template (ID=70)

Condition: `include/archive/interventii_archive`

| Section | ID | Background | Content |
|---|---|---|---|
| Hero | s5ar001 | `#231E1A` | H1 "Intervenții Chirurgicale" (Lora 52/40/34px), subtitle |
| Grid | s5ar010 | `#F4EFE6` | `[gu_interventii_archive]` shortcode → card grid |

### 6. Shortcode: `[gu_interventii_archive]`

Renders a responsive card grid (`auto-fill, minmax(280px,1fr)`) of all published `interventii` posts. Each card shows title (linked), `short_summary` excerpt (20 words), and "Detalii intervenție →" CTA. Registered in `gu-design-system.php`.

### 7. Demo Post: "Microdiscectomie lombară"

- ID: 71, slug: `microdiscectomie-lombara`, post_type: `interventii`
- URL: `http://georgeungureanu-doctor-dev.local/interventii/microdiscectomie-lombara/`
- All 13 ACF fields populated with realistic Romanian medical copy
- Fields cover: clinical indications, contraindications, immediate vs. elective surgery criteria, surgical technique with 7 operative steps (magnification 4K), benefits (5 bullet points with statistics), intraoperative and postoperative complications, recovery phases (hospitalisation → 1–2 weeks → 3–6 weeks → months 3–6), and 5 FAQ entries

---

## Files Modified / Created

| File | Change |
|---|---|
| `wp-plugin/gu-design-system/gu-design-system.php` | Added section 5: CPT, taxonomy, `[gu_interventii_archive]` shortcode |
| `wp-plugin/gu-design-system/acf-json/group_sp.json` | ACF Local JSON export (13 fields) |
| `wp-plugin/gu-design-system/elementor-templates/sprint5-single-interventii.json` | Single template export |
| `wp-plugin/gu-design-system/elementor-templates/sprint5-archive-interventii.json` | Archive template export |
| `docs/implementation/SPRINT_5_SURGICAL_PROCEDURES_REPORT.md` | This file |

---

## DB Objects Created

| Type | ID | Key/Slug |
|---|---|---|
| ACF field group | 55 | group_sp |
| ACF fields | 56–68 | subtitle … seo_description |
| Elementor single template | 69 | — |
| Elementor archive template | 70 | — |
| Demo interventie post | 71 | microdiscectomie-lombara |

---

## Technical Issues Fixed

### 1. `content_width` array vs. string
`content_width` is an Elementor SELECT control (values: `'boxed'` / `'full'`), not a slider. The initial setup script passed an array `{unit:'px',size:760}` instead. This caused 10 containers to use incorrect settings. Fixed by normalising all containers to `content_width:'full'` with a separate `width:{unit:'px',size:760}` slider setting.

### 2. Missing `content_width` on outer sections
Outer section containers were created without any `content_width` key. Elementor defaults to `'boxed'`, which collapsed the sections and prevented backgrounds from spanning full viewport width. Fixed by adding `content_width:'full'` to all 5 outer sections (single) and 2 outer sections (archive).

### 3. PHP "Array to string conversion" warnings
`element-base.php:815` concatenates `prefix_class` with setting value. Controls with `prefix_class` (e.g., `container_type`, `content_width`) triggered warnings when setting values were arrays. Resolved by the `content_width` fix above.

### 4. CSS not regenerating after file deletion
After clearing the `elementor/css/post-*.css` files, Elementor served references from the option table with `status:'file'` but no inline CSS. Resolved by also deleting the `_elementor_css` postmeta rows, which forces Elementor to regenerate CSS on next page load.

### 5. Zero horizontal padding on mobile
Outer section containers had `padding-left:0, padding-right:0`. On mobile (390px), where the 760px inner width constraint doesn't apply, content sat at 10px from the viewport edge (Elementor widget default). Fixed by setting outer sections to 24px horizontal padding, giving 34px total content margin on mobile.

---

## Browser Verification Results

All checks performed with Playwright (Chromium headless).

| Viewport | Single H1 | Subtitle | Literal tags | Sections | Archive H1 | Cards |
|---|---|---|---|---|---|---|
| Desktop 1440px | ✓ | ✓ | 0 | all 5 ✓ | ✓ | 1 ✓ |
| Tablet 768px | ✓ | ✓ | 0 | all 5 ✓ | ✓ | 1 ✓ |
| Mobile 390px | ✓ | ✓ | 0 | all 5 ✓ | ✓ | 1 ✓ |

Computed background colours verified via Playwright `getComputedStyle`:
- `s5sg001` hero: `rgb(35, 30, 26)` = `#231E1A` ✓
- `s5sg010` overview: `rgb(244, 239, 230)` = `#F4EFE6` ✓
- `s5sg050` FAQ: `rgb(244, 239, 230)` = `#F4EFE6` ✓
- `s5sg060` CTA: `rgb(35, 30, 26)` = `#231E1A` ✓
- Inner container at 768px: `760px` ✓

---

## URLs

| Page | URL |
|---|---|
| Single (demo) | `http://georgeungureanu-doctor-dev.local/interventii/microdiscectomie-lombara/` |
| Archive | `http://georgeungureanu-doctor-dev.local/interventii/` |
| WP Admin | `http://georgeungureanu-doctor-dev.local/wp-admin/edit.php?post_type=interventii` |
