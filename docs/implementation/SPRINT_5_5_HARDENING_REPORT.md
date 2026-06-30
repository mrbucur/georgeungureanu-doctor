# Sprint 5.5 — Hardening & Deployment Readiness Report

**Date:** 2026-06-30  
**Status:** Complete — awaiting commit approval

---

## Findings

### Architecture Audit

| Component | Status | Finding |
|---|---|---|
| Plugin structure | ✓ | Single-file plugin with 6 clean sections; no external dependencies at load time |
| CPT: `afectiuni` | ✓ | Registered, rewrite rules active, archive at `/afectiuni/` |
| CPT: `interventii` | ✓ | Registered, rewrite rules active, archive at `/interventii/` |
| Taxonomy: `categorie-afectiuni` | ✓ | Hierarchical, public, REST-enabled |
| Taxonomy: `categorie-interventii` | ✓ | Hierarchical, public, REST-enabled |
| ACF group `group_mc` | ⚠ → ✓ | **Bug found & fixed**: `post_excerpt` (key) was empty for group_sp (ID=55). Fixed by setting `post_excerpt='group_sp'` |
| ACF group `group_sp` | ⚠ → ✓ | See above |
| ACF JSON exports | ⚠ → ✓ | **Gap**: Only `group_sp.json` existed. Added `group_mc.json` (Medical Condition). Copied both to live plugin `acf-json/` |
| Elementor template exports | ⚠ → ✓ | **Gap**: Only Sprint 5 templates (69, 70) were exported. Added header, footer, 404, Sprint 4 templates (9, 12, 37, 52, 53) |
| Shortcodes | ✓ | `[gu_field]`, `[gu_afectiuni_archive]`, `[gu_interventii_archive]` all registered and functional |
| Theme Builder conditions | ✓ | All 7 templates correctly assigned: header/footer (general), 404 (not_found404), afectiuni single+archive, interventii single+archive |
| Global CSS | ✓ | `gu-design-system.css` enqueued on all frontend pages; 17 sections, all tokens present |
| Design tokens | ✓ | 8 color tokens, type scale, spacing, motion — all defined in `:root` |
| Asset organization | ⚠ | `elementor/templates/` (legacy Sprint 1) and `wp-plugin/.../elementor-templates/` coexist. Consolidated exports to the latter. |

### Version Control Audit

| Asset | Versioned | Notes |
|---|---|---|
| `acf-json/group_mc.json` | ✓ (added Sprint 5.5) | Was missing before this sprint |
| `acf-json/group_sp.json` | ✓ | Already existed from Sprint 5 |
| `elementor-templates/header.json` | ✓ (added Sprint 5.5) | Was only in legacy `elementor/templates/` dir |
| `elementor-templates/footer.json` | ✓ (added Sprint 5.5) | Same |
| `elementor-templates/404-page.json` | ✓ (added Sprint 5.5) | Was not versioned at all |
| `elementor-templates/sprint4-single-afectiuni.json` | ✓ (added Sprint 5.5) | Was not versioned |
| `elementor-templates/sprint4-archive-afectiuni.json` | ✓ (added Sprint 5.5) | Was not versioned |
| `elementor-templates/sprint5-single-interventii.json` | ✓ | Already from Sprint 5 |
| `elementor-templates/sprint5-archive-interventii.json` | ✓ | Already from Sprint 5 |
| Plugin source (`gu-design-system.php`) | ✓ | Kept in sync with live |
| Design system CSS | ✓ | In `assets/css/gu-design-system.css` |
| Documentation | ✓ | All docs committed |
| **Homepage Elementor content** | ✗ | DB-only. Highest priority gap for staging. |
| ACF field values (demo posts 54, 71) | ✗ | Acceptable — demo content only |
| Elementor Kit settings | ✗ | Requires manual reconfiguration per environment |

### Bug Fixes Applied

1. **ACF `group_sp` key missing** (Critical)  
   Group ID=55 had empty `post_excerpt` and `post_content` missing `key`/`title` fields. ACF's `acf_get_field_group()` could not reliably resolve the group, and `acf-json/` sync would have silently failed.  
   Fix: Set `post_excerpt='group_sp'`; re-exported `group_sp.json` via `acf_get_fields()`.

2. **`/programari/` returns 404** (Critical for UX)  
   3 templates (header, 404, interventii single) contained links to `/programari/`. No page existed at that slug.  
   Fix: Created published placeholder page (ID=72, slug=`programari`). All CTA links now return 200.

3. **Sprint 4 templates not exported** (Version control gap)  
   Templates ID=52 (afectiuni single) and ID=53 (afectiuni archive) existed in DB but had no repo representation. Same for header/footer/404 (IDs 9, 12, 37).  
   Fix: Exported all 7 templates to `elementor-templates/`.

4. **ACF `medical-condition` group not in `acf-json/`** (Version control gap)  
   Only `group_sp.json` was in `acf-json/`. Sprint 4's `group_mc` had no Local JSON file, making it impossible to sync fields on a fresh deployment.  
   Fix: Exported `group_mc.json` via `acf_get_fields(39)`.

5. **`acf-json/` not in live plugin directory** (Deployment blocker)  
   The live plugin at `/wp-content/plugins/gu-design-system/` lacked `acf-json/`. ACF Local JSON only auto-syncs from the plugin directory.  
   Fix: Copied both JSON files to live plugin `acf-json/`.

---

## Browser QA Results

Playwright (Chromium headless) — 6 pages × 3 viewports = 18 checks.

| Page | Desktop | Tablet | Mobile |
|---|---|---|---|
| Homepage | ✓ H1 ✓ nav ✓ footer | ✓ | ✓ |
| 404 | ✓ "Pagina nu a fost găsită" | ✓ | ✓ |
| Afecțiuni Archive | ✓ "Afecțiuni tratate" | ✓ | ✓ |
| Afecțiuni Single | ✓ "Hernie de disc lombară" | ✓ | ✓ |
| Intervenții Archive | ✓ "Intervenții Chirurgicale" | ✓ | ✓ |
| Intervenții Single | ✓ "Microdiscectomie lombară" | ✓ | ✓ |

**All 18 checks passed.** Zero PHP warnings. Zero literal `[elementor-tag]` strings. Nav and footer present on every page and viewport.

CTA links to `/programari/` verified functional (5–7 per page, all returning 200 after fix).

---

## Documents Created

| File | Purpose |
|---|---|
| `docs/DEPLOYMENT.md` | Step-by-step guide for fresh deployment (LocalWP → staging → production) |
| `docs/PROJECT_STRUCTURE.md` | Folder layout, plugin architecture, naming conventions, git workflow |
| `docs/TECH_DEBT.md` | 10 known limitations, future improvements, ACF Pro opportunities, accessibility, SEO |

---

## Deployment Readiness Score: 72/100

### Breakdown

| Category | Score | Notes |
|---|---|---|
| Version control | 18/20 | All templates versioned. Homepage content still DB-only (-2) |
| Architecture | 18/20 | CPTs, taxonomies, ACF groups, templates — all clean. Kit colors not configured (-2) |
| Browser QA | 20/20 | 18/18 checks pass, 0 warnings |
| Documentation | 19/20 | DEPLOYMENT, PROJECT_STRUCTURE, TECH_DEBT created. No WP-CLI runbook (-1) |
| Deployment readiness | 15/20 | `/programari/` placeholder exists but page is blank (-3). Homepage not exported (-2) |

### Score interpretation
- **90–100**: Ready for staging
- **72**: Ready for internal review / stakeholder preview. Not ready for public staging without completing the two blocking items below.

---

## Remaining Risks

### P0 — Must fix before staging
1. **`/programari/` is a blank page** — The placeholder page exists (200) but renders nothing. Every CTA on the site leads to a dead end. Requires implementing the Programări page (Sprint 6).

2. **Homepage not in version control** — If the DB is lost, the homepage cannot be reconstructed from git. Export it via Elementor → My Templates → Save as Template.

### P1 — Fix before public launch
3. **Elementor Kit global colors not set** — Templates use hardcoded hex values. A future editor using Elementor's color picker will create inconsistencies.

4. **`sample-page` (ID=2) is published** — Default WP page accessible at `/sample-page/`. Should be deleted.

5. **No SEO plugin** — `seo_title` and `seo_description` ACF fields are not wired to `<head>`. Requires Yoast SEO or a custom hook.

### P2 — Address before production
6. **Elementor element cache permanently disabled** — Acceptable for low traffic. Enable with a short TTL (300s) or switch to full-page caching before production.

7. **No sitemap** — Configure Yoast/Rank Math to generate XML sitemaps.

8. **Featured images unused** — CPTs support thumbnails but templates don't render them. Block on photography availability (Q7a from project blockers).

---

## Recommendations Before Staging Deployment

1. Export the **homepage** as an Elementor template → add to repo
2. Implement the **Programări page** (embed Calendly or Docbook) 
3. Configure **Elementor Kit global colors** to match design tokens
4. Delete **sample-page** (ID=2)
5. Install **Yoast SEO** and wire `seo_title`/`seo_description` ACF fields via custom `wp_head` hook
6. Run a final **Playwright QA pass** after completing items 1–5
7. Set **Elementor CSS Print Method** to `External File` explicitly in Elementor settings
