# Sprint 8 — About Page (/despre/)
**Status:** COMPLETE — awaiting browser verification and commit approval  
**Date:** 2026-06-30  
**Plugin version:** 1.3.0 (bumped from 1.2.0)  
**QA result:** 63/63 PASS — Desktop, Tablet (768px), Mobile (390px)

---

## What Was Built

A complete `/despre/` WordPress page for Dr. George Ungureanu, featuring:

- **12-section inverted-pyramid layout** — Human connection → credentials → depth → conversion
- **Photography placeholder** — inline SVG, clearly marked `[CLIENT: PORTRET PROFESIONAL NECESAR]`, replaced when `about_photo` ACF field is populated
- **`id="physician"` anchor** — set on the root div of `[gu_about_hero]` shortcode output; resolves the broken schema anchor `https://georgeungureanu.doctor/despre/#physician` that all article pages reference
- **Conditional sections** — Research (S8) and Media (S11) return empty string when their ACF fields are blank; zero visual impact when unused
- **Enriched Physician schema** — full node emitted from `/despre/` only (title, description, knowsAbout, knowsLanguage, worksFor)
- **16-field ACF group** `group_about` — non-developer content updates without Elementor access
- **Button component** `.gu-btn` + `.gu-btn--accent` + `.gu-btn--light` — reusable across the site

---

## Files Changed

### Plugin (repo → live synced)

| File | Change |
|------|--------|
| `gu-design-system.php` | Version 1.2.0 → 1.3.0; added Section 10 (~270 lines) |
| `assets/css/gu-design-system.css` | 1,298 → 1,824 lines; added Section 23 (526 lines) |
| `elementor-templates/sprint8-page-despre.json` | New — 23 KB export |

### Database (LocalWP — `local` DB)

| Item | ID | Details |
|------|-----|---------|
| WordPress page | 116 | `post_name=despre`, `post_status=publish`, `post_type=page` |
| ACF field group | 117 | `group_about` — 16 fields |
| ACF fields | auto | about_tagline, about_years_experience, about_hospital, about_languages, about_photo, about_bio, about_philosophy, about_education, about_experience, about_interests, about_research, about_teaching, about_memberships, about_media, about_seo_title, about_seo_description |
| Demo field values | on 116 | All content fields populated with `[CLIENT: ...]` placeholders |
| Elementor data | on 116 | 12-section JSON in `_elementor_data` |

### Documentation

| File | Content |
|------|---------|
| `docs/planning/ABOUT_PAGE_ARCHITECTURE.md` | Sprint 8 Phase 1 — architecture, wireframe, 23-question brief (pre-existing) |
| `docs/implementation/SPRINT_8_ABOUT_PAGE_REPORT.md` | This file |

---

## Page Architecture — 12 Sections

| # | Section | Background | Shortcode | Status |
|---|---------|------------|-----------|--------|
| 1 | Hero — photo + name + badges + CTA | `#F4EFE6` surface-warm | `[gu_about_hero]` | Always shown |
| 2 | Credentials Strip | `#FDFBF7` surface | `[gu_about_credentials_strip]` | Always shown |
| 3 | Biography | `#F4EFE6` surface-warm | `[gu_about_bio]` | Always shown |
| 4 | Philosophy of Care | `#231E1A` ink/dark | `[gu_about_philosophy]` | Always shown |
| 5 | Education & Training | `#FDFBF7` surface | `[gu_about_education]` | Always shown |
| 6 | Clinical Experience | `#F4EFE6` surface-warm | `[gu_about_experience]` | Always shown |
| 7 | Special Interests | `#FDFBF7` surface | `[gu_about_interests]` | Always shown (demo cards if empty) |
| 8 | Research & Publications | self-contained | `[gu_about_research]` | **CONDITIONAL** — hidden when empty |
| 9 | Teaching & Academic | `#FDFBF7` surface | `[gu_about_teaching]` | Always shown |
| 10 | Professional Memberships | `#F4EFE6` surface-warm | `[gu_about_memberships]` | Always shown |
| 11 | Media Appearances | self-contained | `[gu_about_media]` | **CONDITIONAL** — hidden when empty |
| 12 | CTA | `#231E1A` ink/dark | `[gu_about_cta]` | Always shown |

---

## Plugin Section 10 — New Code (gu-design-system.php)

### Functions
- `gu_get_about_page_id(): int` — static cache of the /despre/ page ID
- `gu_get_about_field(string $key): string` — reads an ACF field from the /despre/ page

### WordPress Hooks
- `body_class` filter — adds `.page-despre` body class
- `wp_head` (priority 0) — inline CSS to hide `.page-despre .page-header` (Hello Elementor theme adds an H1 above Elementor content; this hides it while our own H1 in the hero shortcode is the visible title)
- `pre_get_document_title` (priority 21) — SEO title from `about_seo_title` ACF field
- `wp_head` (priority 2) — meta description from `about_seo_description` ACF field
- `wp_head` (priority 11) — Physician schema JSON-LD (full enriched node) + BreadcrumbList

### Shortcodes (12 registered)
`[gu_about_hero]`, `[gu_about_credentials_strip]`, `[gu_about_bio]`, `[gu_about_philosophy]`, `[gu_about_education]`, `[gu_about_experience]`, `[gu_about_interests]`, `[gu_about_research]`, `[gu_about_teaching]`, `[gu_about_memberships]`, `[gu_about_media]`, `[gu_about_cta]`

---

## CSS Section 23 — New Components (gu-design-system.css)

| Class | Purpose |
|-------|---------|
| `.gu-btn`, `.gu-btn--accent`, `.gu-btn--light` | Shared button component (first use site-wide) |
| `.gu-about-section-heading`, `--light` modifier | Section H2 — serif, 30px, responsive |
| `.gu-about-hero` + children | 2-column flex hero; stacks at 768px |
| `.gu-credentials-strip` + children | 3–4 item scannable fact row |
| `.gu-about-bio` | Biography content + blockquote pull-quote |
| `.gu-about-philosophy` + children | Dark-section content, serif 19px, white |
| `.gu-about-education` | Timeline-style list layout |
| `.gu-about-experience`, `.gu-about-teaching`, `.gu-about-memberships` | Content blocks |
| `.gu-interests-grid` + `.gu-interest-card` | 3-col → 2-col → 1-col card grid |
| `.gu-about-conditional` + modifiers | Self-contained blocks for conditional sections |
| `.gu-about-cta` + children | Dark-section conversion block |

---

## Schema Changes

### What changed
The `/despre/` page now emits an **enriched** Physician schema node:
```json
{
  "@type": "Physician",
  "@id": "https://georgeungureanu.doctor/despre/#physician",
  "name": "Dr. George Ungureanu",
  "jobTitle": "Medic primar neurochirurg",
  "description": "Dr. George Ungureanu este medic primar neurochirurg...",
  "knowsAbout": ["Neurosurgery", "Spine Surgery", "Brain Surgery", "Minimally Invasive Neurosurgery"],
  "knowsLanguage": ["Romana", "Engleza"],
  "worksFor": {"@type": "MedicalOrganization", "@id": "...#practice", ...}
}
```

### Article schema — unchanged
Articles continue to emit the Physician node from every article page. When `about_years_experience` and `about_hospital` are populated by Dr. Ungureanu, the richer version automatically appears on `/despre/`. The article schema was not refactored in this sprint (it works and passed 90/90 QA in Sprint 7B).

---

## QA — 63/63 PASS

```
Sprint 8 QA: 63 PASS  0 FAIL  (63 total)
```

**Viewports tested:** Desktop (1440×900), Tablet (768×1024), Mobile (390×844)

**All 21 checks PASS on all 3 viewports:**
- D1: HTTP 200
- D2: H1 contains "George Ungureanu"
- D3: Meta description present
- D4: Physician schema @id contains #physician
- D5: Schema @type is Physician
- D6: BreadcrumbList schema present
- D7: id="physician" element exists on page
- D8: id="physician" wraps hero content
- D9: Hero photo or placeholder present
- D10: At least 2 links to /programari/
- D11: Credentials strip present
- D12: Credentials strip has 3+ items
- D13: Biography H2 present
- D14: Philosophy section element present
- D15: Education section present
- D16: Special interests section present
- D17: Research section absent (field empty → conditional works)
- D18: Media section absent (field empty → conditional works)
- D19: CTA heading mentions Dr. Ungureanu
- D20: Exactly 1 visible H1 on page
- D21: No horizontal overflow

---

## Issues Fixed During Sprint

| Issue | Root Cause | Fix |
|-------|-----------|-----|
| 2 H1 on page | Hello Elementor theme renders page title in `.page-header` above Elementor content | Added `body_class` filter + inline CSS `.page-despre .page-header { display: none }` in plugin |
| Tablet horizontal overflow | Inner containers set to 900px/1400px fixed width overflowed 768px viewport | Updated all inner containers to 760px via DB update |

---

## Content Requirements — Dr. Ungureanu Must Complete

All ACF fields contain `[CLIENT: ...]` placeholders. Before launch, the following fields must be completed via WordPress admin → /despre/ edit page:

| Priority | Field | Description |
|----------|-------|-------------|
| **CRITICAL** | `about_photo` | Professional portrait (triggers removal of SVG placeholder) |
| **CRITICAL** | `about_tagline` | Positioning statement — 1 sentence |
| **CRITICAL** | `about_bio` | Biography — 3–5 paragraphs |
| **CRITICAL** | `about_philosophy` | Philosophy of practice + patient approach |
| **CRITICAL** | `about_years_experience` | Integer — drives credentials strip and schema |
| **CRITICAL** | `about_hospital` | Affiliation name |
| High | `about_education` | Education timeline as UL HTML |
| High | `about_experience` | Clinical experience — 2–3 paragraphs |
| Medium | `about_memberships` | Professional society affiliations as UL |
| Medium | `about_teaching` | Teaching activity (or leave empty to hide section) |
| Optional | `about_research` | Leave empty to hide section; populate when ready |
| Optional | `about_media` | Leave empty to hide section; populate when ready |
| Medium | `about_seo_title` | Pre-filled with placeholder — refine |
| Medium | `about_seo_description` | Pre-filled with placeholder — refine to ≤155 chars |

> **Note:** Do not publish AI-generated medical content without explicit human review by Dr. Ungureanu.

---

## Approved Decisions — Applied

| Decision | Implementation |
|----------|---------------|
| Do not block on missing photography | SVG placeholder with `[CLIENT: PORTRET PROFESIONAL NECESAR]` label |
| Research and Media sections conditionally rendered | Shortcodes return `''` when ACF field is empty |
| `#physician` anchor on Hero section | `id="physician"` on root div of `[gu_about_hero]` output |
| Preserve inverted-pyramid IA | Human connection (S1–3) → credentials (S4–6) → depth (S7–11) → conversion (S12) |

---

## Pending Decisions (Not Blocking)

- **Nav menu**: `/despre/` not yet added to site navigation. Add manually via Appearance → Menus when content is ready.
- **Article schema refactor**: Articles still emit the full Physician node (unchanged from Sprint 7B). Low priority — Google resolves the canonical from the /despre/ definition.
- **Location data (Q13 blocker)**: `about_hospital` and schema `worksFor` still use `[CLIENT: ...]`. Will be resolved when Dr. Ungureanu provides clinic address and name.

---

## Next Steps

1. Dr. Ungureanu reviews the page at `http://georgeungureanu-doctor-dev.local/despre/`
2. Complete all `[CLIENT: ...]` ACF fields via WP admin
3. Upload professional portrait via `about_photo` ACF field
4. Verify typography and layout match approved design direction
5. Approve commit → git commit Sprint 8
6. Production deploy
