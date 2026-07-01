# Sprint 9.9C — Sfatul Neurochirurgului Hub Implementation
**Status:** COMPLETE — awaiting browser verification  
**Date:** 2026-07-01  
**QA result:** 87 PASS / 0 FAIL  
**Pages × viewports tested:** /articole/ × 3 + 4 regression pages × 1 = 15 sessions

---

## Context

The `/articole/` URL was served by an Elementor Theme Builder archive template (post ID 113, `elementor_library` type). The page rendered a renamed article archive with one demo article and an empty-state block. It was not a hub — it was a flat list with a new label.

This sprint replaces the Elementor archive template with a `[gu_sfatul_hub]` shortcode, delivering the Option C Hybrid hub architecture approved in Sprint 9.9B.

---

## What Changed

### Architecture

The Elementor archive template (post ID 113) `_elementor_data` was replaced with a minimal shortcode container — identical approach to /programari/ (post ID 72) in Sprint 9.9A.

**Before:** Full Elementor archive template (`Articole pentru Pacienți` heading + text editor)  
**After:** Shortcode container → `[gu_sfatul_hub]`

### Hub structure at launch

```
/articole/
  ├── Hero (#FFFFFF)
  │     Overline: "Educatie medicala pentru pacienti"
  │     H1: "Sfatul Neurochirurgului"
  │     Lead paragraph
  │     CTA → /programari/
  │
  ├── Hub Navigation Strip (sticky, backdrop-blur)
  │     Pills (conditional — only active sections):
  │     [📄 Prima consultatie] [❓ Intrebari]
  │     (Recuperare / Mituri / Video hidden — arrays empty)
  │
  ├── Featured Article (#F5F5F7)
  │     .gu-hub-featured — shows pinned or most recent article
  │     Auto-populated from articole CPT
  │
  ├── Prima Consultatie (#FFFFFF) [id="prima-consultatie"]
  │     3-block guide grid (.gu-guide-grid):
  │       Block 1: "Ce sa aduceti" — 5-item checklist
  │       Block 2: "Cum sa va pregatiti" — 4-item list
  │       Block 3: "Ce intrebari sa puneti" — 6 questions
  │     CTA → /programari/
  │
  ├── [Recuperare — OMITTED, array empty]
  ├── [Mituri — OMITTED, array empty]
  ├── [Video — OMITTED, array empty]
  │
  ├── FAQ — Educational (#F5F5F7) [id="intrebari"]
  │     4 categories × 3 questions = 12 FAQ items
  │     Categories: Despre neurochirurgie / Prima consultatie /
  │                 Despre interventie / Recuperare
  │     Native <details>/<summary>, reuses .gu-faq CSS
  │
  ├── Article Grid (#FFFFFF)
  │     Reuses existing [gu_articole_archive] shortcode output
  │     Currently: 1 demo article + empty-state block
  │
  └── Final CTA (#1D1D1F dark)
        "Pregatit pentru o evaluare?"
        CTA → /programari/
```

### Sections that activate automatically when content is added

| Section | Trigger | Where to add content |
|---------|---------|---------------------|
| Recuperare | `$recovery_topics` array non-empty | `gu-design-system.php` line ~1797 |
| Mituri si adevaruri | `$myths` array non-empty | `gu-design-system.php` line ~1786 |
| Video | `$videos` array non-empty | `gu-design-system.php` line ~1793 |

When content is added, the section renders automatically and its pill appears in the hub nav. No other code changes needed.

### Featured article pin

To manually pin an article as the featured story:

```sql
-- Via MySQL
INSERT INTO wp_options (option_name, option_value, autoload)
VALUES ('gu_hub_pinned_article', '{POST_ID}', 'no')
ON DUPLICATE KEY UPDATE option_value = '{POST_ID}';
```

Or via WP-CLI:
```bash
wp option update gu_hub_pinned_article {POST_ID}
```

If no pin is set (or pin is invalid), the shortcode falls back to the most recently published article.

---

## Technical Details

### PHP additions (`gu-design-system.php`)

Section 14 added after Section 12 (Recomandari):

| Hook | Description |
|------|-------------|
| `body_class` filter | Adds `page-sfatul-hub` to `is_post_type_archive('articole')` |
| `[gu_sfatul_hub]` shortcode | Full hub renderer (~220 lines) |

**Key PHP patterns:**
- Content arrays (`$myths`, `$videos`, `$recovery_topics`) start empty → sections skipped
- `get_option('gu_hub_pinned_article', 0)` for manual pin with fallback to `get_posts()`
- Alternating background colors calculated dynamically based on rendered section count
- FAQ reuses `.gu-faq` / `.gu-faq__item` CSS from Section 29 (no duplication)
- Article grid: `do_shortcode('[gu_articole_archive]')` — direct call

### CSS additions (`gu-design-system.css`)

Section 30 added (~260 lines). New components:

| Component | Classes |
|-----------|---------|
| Hub nav strip | `.gu-hub-nav`, `.gu-hub-nav__inner`, `.gu-hub-nav__pill` |
| Featured article card | `.gu-hub-featured`, `__cat`, `__title`, `__excerpt`, `__link` |
| Guide grid | `.gu-guide-grid`, `.gu-guide-block`, `__over`, `__title`, `__list`, `__note` |
| Recovery cards | `.gu-recovery-grid`, `.gu-recovery-card`, `__title`, `__duration`, `__desc` |
| Myth/truth pairs | `.gu-myth-grid`, `.gu-myth-pair`, `.gu-myth-card`, `.gu-truth-card` |
| Video cards | `.gu-video-grid`, `.gu-video-card`, `__thumb`, `__play`, `__duration`, `__body`, `__cat`, `__title`, `__desc`, `__link` |
| Mobile | `.page-sfatul-hub section > div` padding + `.gu-hub-featured` + `.gu-guide-block` + `.gu-hub-nav__inner` |

### Database changes

| Table / field | Change |
|---------------|--------|
| `wp_postmeta` — `_elementor_data` (post_id=113) | Replaced Elementor archive template JSON with minimal shortcode container |
| `wp_postmeta` — `_elementor_element_cache` | Deleted (stale rendered HTML cache) |
| `wp_postmeta` — `_elementor_css` | Deleted |
| `wp_postmeta` — `_elementor_page_assets` | Deleted |
| Elementor CSS file | Deleted `wp-content/uploads/elementor/css/post-113.css` |

---

## Client Content Required

### To activate Mituri si adevaruri section

Provide 6-10 myth/truth pairs in this format:

```
Mitul: [Text as patients say it]
Adevarul: [Clinical truth in plain language, reviewed by Dr. George]
```

Add to `$myths` array in `gu-design-system.php` Section 14.

### To activate Video section

Provide YouTube video list:
- Title
- YouTube URL
- Category (e.g., "Coloana vertebrala")
- Duration (e.g., "8:24")
- Description (1-2 sentences)

### To activate Recuperare section

For each published procedure (/interventii/):
- Guide title (e.g., "Recuperare dupa microdiscectomie lombara")
- Short description (2-3 sentences)
- URL to the corresponding /interventii/ page
- Recovery duration (e.g., "4-6 saptamani")

### To pin the featured article

Provide the WordPress post ID of the article to feature. Set via MySQL or WP-CLI (instructions above).

### FAQ content status

All 12 FAQ items are written with generic clinical information. **All answers must be reviewed and approved by Dr. George before the site goes live to patients.** Particularly:
- Recovery timelines (may vary by his clinical practice)
- Conservative treatment options listed (should match what he actually offers)
- "Fara trimitere" policy (confirm this matches clinic policy)

---

## QA Results

**Total: 87 PASS / 0 FAIL**

### /articole/ — 3 viewports × 25 checks = 75 checks

| Check | Description |
|-------|-------------|
| 1 | `body.page-sfatul-hub` class present |
| 2 | H1 = "Sfatul Neurochirurgului" |
| 3 | No horizontal overflow |
| 4 | `.gu-hub-nav` present |
| 5 | Nav pills ≥ 2 active |
| 6 | `#prima-consultatie` pill in nav |
| 7 | `#intrebari` pill in nav |
| 8 | Hero CTA → /programari/ |
| 9 | `.gu-hub-featured` card present |
| 10 | Featured article title non-empty |
| 11 | Featured article link present |
| 12 | `#prima-consultatie` section present |
| 13 | Prima Consultatie H2 contains "Prima Consultatie" |
| 14 | `.gu-guide-grid` present |
| 15 | 3 guide blocks |
| 16 | Guide list items ≥ 13 |
| 17 | `#recuperare` absent (empty array) |
| 18 | `#mituri` absent (empty array) |
| 19 | `#video` absent (empty array) |
| 20 | `#intrebari` FAQ section present |
| 21 | FAQ H2 contains "Intrebari" |
| 22 | FAQ items ≥ 12 |
| 23 | Article grid or empty-state present |
| 24 | Old Elementor title absent |
| 25 | `#gu-header` present |

### Regression — 4 pages × 3 checks = 12 checks

| Page | Checks |
|------|--------|
| Homepage `/` | Header, no overflow, light background |
| /programari/ | Header, no overflow, light background |
| /recomandari/ | Header, no overflow, light background |
| /despre/ | Header, no overflow, light background |

---

## Browser Review Checklist

Open `http://georgeungureanu-doctor-dev.local/articole/` at 1440px desktop width:

- [ ] Page loads without errors
- [ ] H1 "Sfatul Neurochirurgului" visible above fold
- [ ] Hub nav strip visible below hero with 2 active pills (Prima consultatie, Intrebari)
- [ ] Nav is sticky — scrolling down keeps it at top of viewport
- [ ] Featured article card renders with title and "Citeste articolul" link
- [ ] "Prima Consultatie" section with 3 guide blocks side-by-side
- [ ] Guide blocks: background #F5F5F7, checklist items with circular checkmarks
- [ ] "Ce intrebari sa puneti" block shows italic question text (no checkmark circles)
- [ ] No Recuperare, Mituri, or Video sections visible
- [ ] FAQ section with 4 category headers and 12 expandable questions
- [ ] FAQ accordion opens/closes on click
- [ ] Article grid at bottom with 1 demo article or empty-state block
- [ ] Dark CTA section at bottom
- [ ] At 768px: guide grid collapses to 1 column
- [ ] At 390px: layout usable, no overflow, nav scrolls horizontally
- [ ] Clicking nav pill scrolls to correct section

> Do not publish AI-generated medical content without explicit human review.  
> **Do not commit automatically. Stop for browser verification.**
