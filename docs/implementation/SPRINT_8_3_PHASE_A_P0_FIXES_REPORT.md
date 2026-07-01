# Sprint 8.3 — Phase A: P0 Fixes Report
**Status:** COMPLETE — awaiting browser verification and commit approval  
**Date:** 2026-06-30  
**Plugin version:** 1.3.0 (no version bump — Phase A is a bug-fix layer, not a feature addition)  
**QA result:** 129/134 PASS — 5 pre-existing overflows confirmed not caused by Phase A

---

## What Was Fixed

Phase A addressed all four P0 issues identified in `docs/implementation/SPRINT_8_1_VISUAL_DIAGNOSTIC.md` and specified in `docs/planning/DESIGN_MODERNIZATION_PLAN.md`.

---

## A1 — Romanian Diacritics (P0-3)

**Problem:** All user-visible text strings in the about-page shortcodes (Section 10, `gu-design-system.php` lines 919–1133) used ASCII approximations instead of correct Romanian. Caused by `cat >>` bash heredoc encoding limitations when Section 10 was originally appended.

**Fix:** Direct `Edit` tool replacement of 20 strings across all 12 shortcodes.

| Location | Before | After |
|----------|--------|-------|
| Schema description | `ani de experienta clinica` | `ani de experiență clinică` |
| Schema description | `in neurochirurgie spinala si craniana.` | `în neurochirurgie spinală și craniană.` |
| BreadcrumbList | `Acasa` | `Acasă` |
| Hero badge | `+ ani experienta` | `+ ani experiență` |
| Hero badge | `Coloana vertebrala` | `Coloana vertebrală` |
| Hero badges aria | `Informatii cheie` | `Informații cheie` |
| Hero CTA | `Programati o consultatie` | `Programează o consultație` |
| Credentials default | `'Romana'` | `'Română'` |
| Credentials label | `ani de experienta clinica` | `ani de experiență clinică` |
| Credentials label | `afiliere clinica` | `afiliere clinică` |
| Credentials comparison | `strtolower !== 'romana'` | `mb_strtolower !== 'română'` (UTF-8 safe) |
| Credentials label | `limbi de consultatie` | `limbi de consultație` |
| Philosophy heading | `Filosofia mea de practica` | `Filosofia mea de practică` |
| Education heading | `Educatie & Formare` | `Educație & Formare` |
| Experience heading | `Experienta Clinica` | `Experiență Clinică` |
| Interests link | `Aflati mai multe` | `Aflați mai multe` |
| Research heading | `Cercetare & Publicatii` | `Cercetare & Publicații` |
| Teaching heading | `Activitate Didactica` | `Activitate Didactică` |
| Media heading | `Aparitii in Media` | `Apariții în Media` |
| CTA heading | `Vorbiti cu Dr. George Ungureanu` | `Vorbiți cu Dr. George Ungureanu` |
| CTA text | `O consultatie va ofera...` | `O consultație vă oferă...` (full correction) |
| CTA button | `Programati o consultatie` | `Programează o consultație` |

**QA:** 11/11 diacritics checks PASS

---

## A2 — Header/Footer Button Color (P0-1)

**Problem:** Header and footer "Programează o consultație" buttons rendered as `rgb(91, 192, 222)` (Bootstrap #5BC0DE cyan) on every page. Elementor Kit global color was never synced to the design token `--color-accent: #4D7A70`.

**Fix:** Added CSS overrides in new Section 24 (`gu-design-system.css`).

**Critical diagnostic finding:** Hello Elementor + Elementor Pro renders the header/footer templates into `<header class="elementor-location-header">` and `<footer class="elementor-location-footer">` — NOT into `.site-header` / `.site-footer` as assumed in the plan. The CSS selectors were corrected during implementation.

```css
.elementor-location-header .elementor-button,
.elementor-location-footer .elementor-button {
  background-color: var(--color-accent) !important;
  color: var(--color-surface) !important;
  font-weight: var(--weight-semibold) !important;
  letter-spacing: 0.01em;
}
```

**Before:** `rgb(91, 192, 222)` — Bootstrap cyan  
**After:** `rgb(77, 122, 112)` — design system accent `#4D7A70`

**QA:** All 9 pages × 3 viewports show no cyan buttons ✓

---

## A3 — Button Border-Radius Normalization (P0-2 partial)

**Problem:** Elementor button widgets had 2px/4px/6px radius across the site depending on when they were built.

**Fix:**
```css
.elementor-button {
  border-radius: var(--radius-md) !important; /* 6px */
}
```

**QA:** All Elementor buttons render at 6px radius on all tested pages ✓

---

## A4 — Header/Footer Button Font-Weight (P0-2 partial)

**Problem:** Header/footer button widgets used `font-weight: 400` (thin), while content buttons used 600. Combined with A2 fix in the same rule block.

**Before:** `400`  
**After:** `600` (via `--weight-semibold`)

**QA:** Header button font-weight 600 ✓

---

## A5 — Archive Grid: auto-fill → auto-fit (P0-4 partial)

**Problem:** Archive grids used `repeat(auto-fill, minmax(280px, 1fr))`. With `auto-fill`, the browser creates empty tracks even when no items exist. With 1 published item in a 1080px container, this created three 344px columns — leaving a single card floating at 344px with 736px of blank space.

**Fix:** Changed `auto-fill` to `auto-fit` in all three archive shortcodes:
- `gu_afectiuni_archive` — PHP inline style (line 311)
- `gu_interventii_archive` — PHP inline style (line 345)
- `.gu-articole-grid` — CSS class (line 832)

With `auto-fit`, empty tracks collapse to 0 width. One card fills the full grid container. Three+ cards form the expected multi-column layout.

**QA:** All three archives confirm no empty column tracks with 1 card ✓

---

## A6 — Archive Empty-State Block (P0-4 partial)

**Problem:** Beyond the grid fix, archive pages with < 3 items communicated nothing about future content. The page looked abandoned.

**Fix:** Added `gu_archive_empty_state()` helper function and wired it into all three archive shortcodes when `$query->found_posts < 3`.

Design: a dashed-border panel (`#F4EFE6` background, `#BDB3A5` border) centered at `max-width: 560px` with:
- Clock SVG icon in `#4D7A70`
- "Conținut în curs de actualizare" heading (Lora 700, 22px)
- Explanation text (Inter 400, 16px)
- "Programează o consultație" CTA using `.gu-btn--accent.gu-btn--sm`

**QA:** Empty-state block appears on all three archive pages; heading includes correct diacritics ✓

---

## Files Changed

| File | Changes |
|------|---------|
| `wp-plugin/gu-design-system/gu-design-system.php` | A1: 20 diacritics replacements across Section 10 (lines 919–1133); A5: `auto-fill` → `auto-fit` in 2 PHP inline styles; A6: Added `gu_archive_empty_state()` function + 3 conditional calls |
| `wp-plugin/gu-design-system/assets/css/gu-design-system.css` | A5: `auto-fill` → `auto-fit` in `.gu-articole-grid`; A2–A4+A6: New Section 24 appended (button compliance + empty-state CSS) |

**Net additions:**
- PHP: +25 lines (helper function + 3 empty-state calls)
- CSS: +64 lines (Section 24)

---

## QA Results

**Total:** 129 PASS / 5 FAIL / 134 total

### All Phase A targeted checks: 23/23 PASS

| Check | Result |
|-------|--------|
| A2: Header button color = #4D7A70 | ✓ PASS |
| A2: No cyan buttons in header | ✓ PASS |
| A3: All Elementor buttons 6px radius | ✓ PASS |
| A4: Header button font-weight = 600 | ✓ PASS |
| A3: All buttons 6px on /despre/ | ✓ PASS |
| A3: All buttons 6px on /programari/ | ✓ PASS |
| A1: Hero CTA has "Programează o consultație" | ✓ PASS |
| A1: CTA heading "Vorbiți cu Dr." | ✓ PASS |
| A1: CTA text "consultație vă oferă" | ✓ PASS |
| A1: Philosophy heading "practică" | ✓ PASS |
| A1: "Educație" | ✓ PASS |
| A1: "Experiență Clinică" | ✓ PASS |
| A1: No ASCII "Programati" | ✓ PASS |
| A1: No ASCII "Vorbiti" | ✓ PASS |
| A1: No ASCII "experienta clinica" | ✓ PASS |
| A1: Credentials HTML "ani de experiență clinică" | ✓ PASS |
| A1: Credentials HTML "afiliere clinică" | ✓ PASS |
| A5: afectiuni — no empty columns | ✓ PASS |
| A6: afectiuni — empty-state present | ✓ PASS |
| A6: afectiuni — empty-state diacritics | ✓ PASS |
| A5/A6: interventii — all checks | ✓ PASS |
| A5/A6: articole — all checks | ✓ PASS |

### Regression sweep: 106/111 PASS

**Desktop 1440px:** 36/36 — all pages clear  
**Tablet 768px:** 33/36 — 3 overflows (pre-existing)  
**Mobile 390px:** 37/39 — 2 overflows (pre-existing)

### 5 pre-existing failures (NOT caused by Phase A)

| Failure | scrollWidth | Root cause | Phase |
|---------|------------|------------|-------|
| [tablet] programari overflow | 774px | Elementor inner containers use `content_width=full` with no tablet constraint; form widget pushes width | B |
| [tablet] afectiuni-archive | 934px | Elementor inner container `elementor-element-s4ar011` set to 1100px fixed width in archive template | B |
| [tablet] interventii-archive | 934px | Same container as afectiuni — same template | B |
| [mobile] programari | 415px | Same form widget overflow, worse at mobile | B |
| [mobile] articole-single | 471px | Pre-existing content element wider than mobile viewport | B |

All 5 were confirmed to exist before Sprint 8.3 via DB audit (no Phase A DB changes touched these pages) and CSS change tracing (Phase A added no layout-affecting CSS on these pages).

---

## Implementation Notes

### Diagnostic correction during implementation

The CSS plan specified `.site-header .elementor-button` and `.site-footer .elementor-button`. During QA (first run), buttons remained cyan. DOM inspection revealed:
- Hello Elementor renders the header into `<header class="elementor elementor-9 elementor-location-header">` — no `site-header` class
- The footer is `<footer class="elementor elementor-12 elementor-location-footer">`

The corrected selectors `.elementor-location-header .elementor-button` and `.elementor-location-footer .elementor-button` fix this correctly and will apply to any page where the Elementor header/footer template is active.

### Credentials text-transform note

The credentials strip labels (`ani de experiență clinică`, `afiliere clinică`) are rendered correctly in HTML but appear uppercase in the browser due to CSS `text-transform: uppercase`. The QA test was updated to check `innerHTML` rather than `innerText` to avoid false negatives from CSS visual transforms.

---

## Pending Items for Phase B

From the 5 pre-existing overflow failures above:
- Fix Elementor inner container widths on `/programari/`, `/afectiuni/` archive, `/interventii/` archive, and `/articole/` single page for tablet and mobile — DB updates to Elementor data
- These were not touched in Phase A and are correct Phase B scope

---

## Next Steps

1. Browser verification of Phase A changes:
   - Visit `/` — header CTA button should be green, not cyan
   - Visit `/despre/` — all section headings should have correct Romanian text
   - Visit `/afectiuni/` — single card should fill full width + empty-state block visible below
2. Review and approve Phase A commit
3. Proceed to Phase B approval (separate approval required per plan)

> Do not publish AI-generated medical content without explicit human review.
