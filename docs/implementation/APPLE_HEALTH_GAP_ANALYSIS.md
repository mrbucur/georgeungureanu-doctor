# Apple Health Gap Analysis
**Date:** 2026-07-02  
**Status:** IMPLEMENTATION COMPLETE — QA 9 PASS / 0 FAIL — awaiting browser review  
**Purpose:** Prove understanding of what still violates the approved visual direction before any implementation begins.

---

## Executive Summary

The site has correct tokens and a working layout system, but the **primary visual language remains Lora serif**. This single fact is responsible for approximately 85% of the violations across all 9 pages. The remaining 15% consists of: one PHP-hardcoded dark CTA section, one PHP-hardcoded black button, and scattered warm-color artifacts in component CSS.

The approved direction is: Inter sans-serif editorial typography, `#F2F2F7`/white surfaces, soft blue accents, floating white cards, calm motion. Currently, every page headline announces itself in a heavy italic serif that reads as "premium traditional clinic," not Apple Health.

**Root causes (in order of blast radius):**

| # | Root Cause | Pages affected | Fix location |
|---|-----------|----------------|--------------|
| 1 | `h1, h2, h3 { font-family: var(--font-serif) }` | ALL 9 | CSS line 297 |
| 2 | PHP shortcode inline `Lora,Georgia,serif` styles | Homepage via Elementor, Programări, Recomandări, Sfatul | PHP lines 334, 368, 1331–1332, 1557–1558, 1799–1800 |
| 3 | Dark final CTA section (`background:#1D1D1F`) | Sfatul Neurochirurgului | PHP lines 2113–2120 |
| 4 | Black hero button (`background:#1D1D1F`) | Recomandări | PHP line 1570, used at line 1583 |
| 5 | Component-level Lora rules in CSS | Despre, Archive pages, Single pages | CSS lines 857, 990–1006, 1125, 1401, 1418, 1483, 1889 |
| 6 | Warm/brown placeholder bg on Despre photo | Despre | CSS line 1383 |

---

## Page-by-Page Analysis

---

### 1. Homepage (`/`)

**Screenshot:** `screenshots_gap_analysis/home.png`

#### What still looks like the OLD design system

- **Hero headline** "Neurochirurgie de precizie, centrată pe recuperarea dumneavoastră." renders in Lora serif at approximately 52–60px. This is the first thing visitors see. It reads as a traditional luxury-clinic tagline, not an editorial Apple-grade statement.
- **Every section h2** on the page ("Neurochirurg cu peste 15 ani de experiență clinică," "Domenii de expertiză," "O abordare diferită a neurochirurgiei") renders in Lora. The page is typographically consistent with the old warm design system — just with colors swapped.
- The page's overall cadence — serif hero, stat strip, card grid, serif CTA — is a textbook medical WordPress template structure.

#### What violates Apple Health direction

- Serif as primary visual language. Apple Health and Apple.com use **editorial sans-serif** (SF Pro Display / equivalent Inter) for all display headings. The Lora italic gives a "premium clinic brochure" feel incompatible with the approved direction.
- The hero image area is an empty gray placeholder rectangle — not a design violation per se, but it reinforces the "under construction medical site" read.

#### Exact selectors/templates responsible

- **CSS line 297–298:** `h1, h2, h3 { font-family: var(--font-serif); }` — This global rule causes every Elementor heading widget (which renders semantic `<h1>`/`<h2>` tags) to display in Lora.
- **Elementor DB:** Post ID 38 (homepage). Individual heading elements may also have Lora set in their per-element typography panel (stored in `_elementor_data`). These won't be visible until we inspect the DB, but the CSS global rule alone is sufficient to cause the visible behavior.

#### Concrete changes required

1. CSS line 297–298: Change `font-family: var(--font-serif)` to `font-family: var(--font-sans)` for `h1, h2, h3`.
2. Add weight/tracking overrides so h1/h2 retain strong visual hierarchy in Inter: h1 → 700 weight, tight tracking; h2 → 600 weight.
3. Optionally: add a `.gu-display` utility class for very-large hero text that uses Inter 700 with `letter-spacing: -0.03em` (the Apple large-heading signature).

---

### 2. Programări (`/programari/`)

**Screenshot:** `screenshots_gap_analysis/programari.png`

#### What still looks like the OLD design system

- **Hero heading** "Programați o consultație" is rendered by PHP shortcode in Lora with a fluid size of `clamp(40px, 4.5vw, 60px)`. This is a full-width editorial serif hero — incompatible.
- **All PHP section headings** ("Unde consultă Dr. George Ungureanu," "Consultație Online," "Ce să aduceți la consultație," "Întrebări Frecvente," "Primul pas este cel mai ușor.") use the same Lora h2 definition from PHP.
- **`[CLIENT: ...]` placeholders** throughout — clinic names, phone numbers, Harta/Programează buttons — are empty. The page cannot be reviewed for full visual feel without real content.

#### What violates Apple Health direction

- PHP shortcode hard-codes `Lora,Georgia,serif` in inline styles. This bypasses any CSS override.
- The CTA section below the FAQ ("Primul pas este cel mai ușor.") has a white background with a blue button which is correct, but the heading is Lora and the CTA area feels typographically heavy.

#### Exact selectors/templates responsible

- **PHP line 1799:** `$s_h1 = 'font:700 clamp(40px,4.5vw,60px)/1.1 Lora,Georgia,serif;color:#1D1D1F;letter-spacing:-.025em;margin:0 0 20px;'`
- **PHP line 1800:** `$s_h2 = 'font:700 clamp(26px,3vw,38px)/1.15 Lora,Georgia,serif;color:#1D1D1F;letter-spacing:-.02em;margin:0 0 12px;'`
- **CSS line 297:** Global h1/h2/h3 rule (affects any Elementor headings that may be mixed in)

#### Concrete changes required

1. PHP line 1799: Replace `Lora,Georgia,serif` with `Inter,system-ui,sans-serif`; change weight to 700 with tracking `-0.03em` for h1.
2. PHP line 1800: Replace `Lora,Georgia,serif` with `Inter,system-ui,sans-serif`; tracking `-0.02em` for h2.
3. Content dependency: Cannot do meaningful visual QA until `[CLIENT: ...]` placeholders (clinic names, map/booking links, phone) are filled in.

---

### 3. Despre (`/despre/`)

**Screenshot:** `screenshots_gap_analysis/despre.png`

#### What still looks like the OLD design system

- **Doctor name** "Dr. George Ungureanu" in the hero bio card renders in Lora serif at 40px. The name — the brand's most prominent identity element — should be typographically modern and confident, not bookish.
- **Tagline area** uses `.gu-about-hero__tagline` which applies `font-family: var(--font-serif); font-style: italic`. This is the old warm-luxury pattern: italicized serif quote. Violates the direction.
- **All section h2s** ("Cine este Dr. George Ungureanu," "Educație & Formare," "Experiență Clinică," "Domenii de Interes Special," "Activitate Didactică," "Afilieri Profesionale") render in Lora via the global h2 rule.
- **Credentials strip stat values** (the "15+," "2.000+," numbers) use `.gu-credentials-strip__value { font-family: var(--font-serif) }`. Numerics in a serif look dated; Apple uses bold condensed sans for stats.
- **Photo placeholder background** is `#C8C0B8` — a warm brownish-gray. This is a leftover warm palette artifact.

#### What violates Apple Health direction

- The doctor's name — the most critical typographic moment on the Despre page — is in Lora. Apple Health's person/identity headings use bold modern sans.
- Italic serif tagline is a "luxury brochure" pattern explicitly listed as a violation.
- Warm brownish placeholder bg contradicts the cool-neutral direction.

#### Exact selectors/templates responsible

- **CSS line 1401:** `.gu-about-hero__name { font-family: var(--font-serif); font-size: 40px; }`
- **CSS line 1418–1420:** `.gu-about-hero__tagline { font-family: var(--font-serif); font-style: italic; }`
- **CSS line 1483:** `.gu-credentials-strip__value { font-family: var(--font-serif); font-size: 28px; }`
- **CSS line 1383:** `.gu-about-hero__photo-placeholder { background: #C8C0B8; }`
- **CSS line 297:** Global h2 → Lora (section headings)

#### Concrete changes required

1. CSS line 1401: `font-family: var(--font-sans)` — keep weight 700, size 40px.
2. CSS line 1418: `font-family: var(--font-sans); font-style: normal` — keep the size, remove italic.
3. CSS line 1483: `font-family: var(--font-sans)` — consider increasing to 32px and bold weight for Apple-style stat display.
4. CSS line 1383: Change `#C8C0B8` to `#D2D2D7` (cool neutral gray, matches `--color-border`).
5. CSS line 297: Change h1–h3 to `var(--font-sans)`.

---

### 4. Recomandări (`/recomandari/`)

**Screenshot:** `screenshots_gap_analysis/recomandari.png`

#### What still looks like the OLD design system

- **Hero heading** "Recomandări" is PHP-rendered Lora at `clamp(42px, 4.8vw, 64px)` — the largest Lora heading on any page in the site.
- **Hero CTA button** "Programează o consultație" has `background:#1D1D1F` (near-black). On a white hero section, this renders as a solid black button. This is the only page with a black button; every other page correctly shows the blue accent.
- **Colleague card names** use `font:700 18px/1.3 Lora,Georgia,serif` — card identity text in serif.
- **Section h2** "Recomandări din partea colegilor medici" and "Împărțiți experiența dumneavoastră" render in Lora via the global h2 rule.

#### What violates Apple Health direction

- Black button on a white page is the most visible single violation on the entire site. It reads as a dark/aggressive CTA incompatible with "soft blue functional accents."
- Lora at 64px for a page hero is the strongest typography violation visible in screenshots.

#### Exact selectors/templates responsible

- **PHP line 1557:** `$s_h1 = 'font:700 clamp(42px,4.8vw,64px)/1.1 Lora,Georgia,serif;color:#1D1D1F;...'`
- **PHP line 1558:** `$s_h2 = 'font:700 clamp(28px,3vw,42px)/1.15 Lora,Georgia,serif;color:#1D1D1F;...'`
- **PHP line 1570:** `$s_btn_ink = 'display:inline-block;background:#1D1D1F;color:#FFFFFF;...'` — the black button style variable
- **PHP line 1583:** `<a href="..." style="' . $s_btn_ink . '">Programează o consultație</a>` — uses the black button on the hero CTA
- **PHP line 1567:** `$s_card_name = 'font:700 18px/1.3 Lora,Georgia,serif;color:#1D1D1F;margin:0 0 4px;'`

#### Concrete changes required

1. PHP line 1557–1558: Replace `Lora,Georgia,serif` with `Inter,system-ui,sans-serif`.
2. PHP line 1570 (`$s_btn_ink`): Change `background:#1D1D1F` to `background:#0E7FC0`. Rename variable to `$s_btn_blue` to reflect intent.
3. PHP line 1583: Now uses the corrected `$s_btn_blue` — will render as blue CTA.
4. PHP line 1567 (`$s_card_name`): Replace `Lora,Georgia,serif` with `Inter,system-ui,sans-serif`.

---

### 5. Sfatul Neurochirurgului (`/articole/`)

**Screenshot:** `screenshots_gap_analysis/sfatul.png`

#### What still looks like the OLD design system

- **Hero heading** "Sfatul Neurochirurgului" PHP-rendered Lora at `clamp(42px, 4.8vw, 64px)`.
- **Article card titles** in the featured article widget use `font-family:Lora,serif` via hardcoded PHP inline style.
- **Section headings** "Prima Consultație," "Intrebari Frecvente," "Articole" all render in Lora via global CSS rule.
- **DARK FINAL CTA SECTION:** `background:#1D1D1F` — near-black full-width section containing white Lora h2 "Pregatit pentru o evaluare?" and a blue button. This is the most severe single violation on the entire site.

#### What violates Apple Health direction

- The dark final CTA directly and explicitly violates every approved direction criterion:
  - ❌ Dark section (dark hero / dark CTA forbidden)
  - ❌ White text on dark background
  - ❌ Serif heading on dark surface
  - ❌ "Ghost buttons designed for dark surfaces" pattern (the blue button reads fine but the entire section must change)
- Article card titles in Lora contradict the floating-white-card pattern (cards should use clean sans typography).

#### Exact selectors/templates responsible

- **PHP line 1331:** `$s_h1 = 'font:700 clamp(42px,4.8vw,64px)/1.1 Lora,Georgia,serif;...'`
- **PHP line 1332:** `$s_h2 = 'font:700 clamp(28px,3vw,42px)/1.15 Lora,Georgia,serif;...'`
- **PHP lines 334, 368:** `<h3 style="font-family:Lora,serif;font-size:20px;font-weight:700;...">` — article card titles
- **PHP line 2113:** `$out .= '<section style="background:#1D1D1F;">'` — the dark CTA section
- **PHP line 2115:** `color:rgba(255,255,255,.5)` — white overline text on dark
- **PHP line 2116:** `<h2 style="font:700 clamp(26px,3vw,38px)/1.15 Lora,Georgia,serif;color:#FFFFFF;...">Pregatit pentru o evaluare?</h2>`
- **PHP line 2117:** `color:rgba(255,255,255,.65)` — white body text on dark

#### Concrete changes required

1. PHP line 1331–1332: Replace `Lora,Georgia,serif` with `Inter,system-ui,sans-serif`.
2. PHP lines 334, 368 (article card h3 titles): Replace `font-family:Lora,serif` with `font-family:Inter,system-ui,sans-serif`.
3. **PHP line 2113:** Change `background:#1D1D1F` to `background:#F2F2F7`.
4. **PHP line 2115:** Change `color:rgba(255,255,255,.5)` to `color:#6E6E73`.
5. **PHP line 2116:** Change font to `Inter,system-ui,sans-serif`, change `color:#FFFFFF` to `color:#1D1D1F`.
6. **PHP line 2117:** Change `color:rgba(255,255,255,.65)` to `color:#424245`.
7. After change: the CTA section becomes a light `#F2F2F7` panel with dark text and a blue button — matches approved direction.

---

### 6. Afecțiuni Archive (`/afectiuni/`)

**Screenshot:** `screenshots_gap_analysis/afectiuni-archive.png`

#### What still looks like the OLD design system

- **Page hero heading** "Afecțiuni tratate" renders in Lora at a large size via the Elementor heading widget on the archive page template (Elementor renders it as `<h1>`, which inherits the global Lora rule).
- **Archive empty state heading** "Conținut în curs de actualizare" uses `.gu-archive-empty-state__heading { font-family: var(--font-serif) }`.
- **Archive empty state background** uses `var(--color-surface-warm)`. The rendered color in the screenshot appears warmer than `#F5F5F7` — this should be verified; if the token is resolving to a legacy warm cream value, it must be corrected.

#### What violates Apple Health direction

- Large serif h1 as page entry point — same pattern as all other pages.
- Empty state box reads like a "warm clinic placeholder" rather than an Apple-grade system state.

#### Exact selectors/templates responsible

- **CSS line 297:** Global h1 → Lora (Elementor archive hero heading inherits this)
- **CSS line 1875:** `.gu-archive-empty-state { background: var(--color-surface-warm); }`
- **CSS line 1889:** `.gu-archive-empty-state__heading { font-family: var(--font-serif); }`
- **Elementor DB:** Post ID 53 (`sprint4-archive-afectiuni.json`) — per-element typography may also specify Lora

#### Concrete changes required

1. CSS line 297: Change h1/h2/h3 to `var(--font-sans)` (fixes archive hero).
2. CSS line 1889: Change to `var(--font-sans)`.
3. CSS line 1875: Verify `var(--color-surface-warm)` resolves to `#F5F5F7`. If not, change to explicit `#F2F2F7`.

---

### 7. Afecțiuni Single (`/afectiuni/hernie-de-disc-lombara/`)

**Screenshot:** `screenshots_gap_analysis/afectiuni-single.png`

#### What still looks like the OLD design system

- **Post title** "Hernie de disc lombară" renders as a very large two-line Lora h1. This is the heaviest typographic element on the page.
- **Every article body heading** — Simptome, Cauze, Diagnostic, Tratament (conservator, chirurgical), Recuperare — is an h2/h3 in Lora. The entire article reads as a medical encyclopedia with serif academic headings.
- **Article card titles** in the "Articole pentru pacienți" section use `.gu-article-card__title { font-family: var(--font-serif) }`.
- **Related card titles** use `.gu-related-card__title { font-family: var(--font-serif) }`.

#### What violates Apple Health direction

- The page has the highest density of Lora serif of any template — approximately 12–15 distinct Lora headings on a single scroll. It is the most encyclopedic-feeling page in the site and the farthest from the Apple Health reading experience.
- Article/related card titles in serif contradict the "floating white cards" concept — Apple card headers use bold sans.

#### Exact selectors/templates responsible

- **CSS line 297:** Global h1/h2/h3 → Lora (post title + all `<h2>` section headings in post content)
- **CSS lines 990–992:** `.elementor-widget-theme-post-content h2 { font-family: var(--font-serif); font-size: 26px; }`
- **CSS lines 1000–1006:** `.elementor-widget-theme-post-content h3 { font-family: var(--font-serif); font-size: 21px; }`
- **CSS line 857:** `.gu-article-card__title { font-family: var(--font-serif); font-size: 19px; }`
- **CSS line 1125:** `.gu-related-card__title { font-family: var(--font-serif); font-size: 18px; }`

#### Concrete changes required

1. CSS line 297: Change h1/h2/h3 to `var(--font-sans)`.
2. CSS lines 990–992: Change `.elementor-widget-theme-post-content h2` to `var(--font-sans)`.
3. CSS lines 1000–1006: Change `.elementor-widget-theme-post-content h3` to `var(--font-sans)`.
4. CSS line 857: Change `.gu-article-card__title` to `var(--font-sans)`.
5. CSS line 1125: Change `.gu-related-card__title` to `var(--font-sans)`.
6. After change: article headings should read as clean bold Inter — high-contrast, structured, Apple-grade.

---

### 8. Intervenții Archive (`/interventii/`)

**Screenshot:** `screenshots_gap_analysis/interventii-archive.png`

#### What still looks like the OLD design system

- Structurally identical to Afecțiuni Archive. "Intervenții Chirurgicale" renders as a large Lora h1. Same empty state issues.

#### Exact selectors/templates responsible

- **CSS line 297:** Global h1 → Lora (Elementor archive hero)
- **CSS line 1875, 1889:** Empty state background and heading (same as Afecțiuni Archive)
- **Elementor DB:** Post ID 70 (`sprint5-archive-interventii.json`)

#### Concrete changes required

Same as Afecțiuni Archive (§6 above). Changes to CSS line 297 fix both archive pages simultaneously.

---

### 9. Intervenții Single (`/interventii/microdiscectomie-lombara/`)

**Screenshot:** `screenshots_gap_analysis/interventii-single.png`

#### What still looks like the OLD design system

- Structurally identical to Afecțiuni Single. "Microdiscectomie lombară" as a large Lora h1, followed by 10–12 Lora section headings (Indicații, Tehnica chirurgicală, Etapele intervenției, Beneficii, Riscuri și complicații, Recuperare sub-sections, Întrebări frecvente, Articole pentru pacienți).
- The final CTA section "Evaluare neurochirurgicală pentru microdiscectomie" appears on a light background with a blue button — this one is correctly light. ✅

#### Exact selectors/templates responsible

- Same as Afecțiuni Single (§7 above): CSS lines 297, 990–992, 1000–1006, 857, 1125.
- **Elementor DB:** Post ID 69 (`sprint5-single-interventii.json`)

#### Concrete changes required

Same as Afecțiuni Single (§7 above). Changes are template-level, not per-post.

---

## What Is Already Correct ✅

These elements do NOT need to change:

| Element | Status |
|---------|--------|
| Header (nav, CTA button, hamburger) | ✅ Correct |
| Footer background (`#F5F5F7`) | ✅ Correct |
| Footer brand name (mixed case "Dr. George Ungureanu") | ✅ Correct |
| Footer navigation columns | ✅ Correct |
| Card hover spring animation (`translateY(-4px) scale(1.01)`) | ✅ Correct |
| `--radius-lg: 20px` | ✅ Correct |
| Blue accent buttons on most pages | ✅ Correct (except Recomandări hero) |
| Homepage final CTA (light gradient, blue button) | ✅ Correct |
| Sfatul "Prima Consultatie" 3-step section | ✅ Correct |
| Sfatul FAQ accordion (light, clean) | ✅ Correct |
| Archive card items (white floating cards) | ✅ Correct |
| Single-page final CTA sections (Afecțiuni, Intervenții) | ✅ Correct |
| Scroll reveal IntersectionObserver + smooth anchor scroll | ✅ Correct |

---

## Implementation Order (for approval)

This is the suggested implementation sequence — **no code changes until approved:**

**Sprint A: The Single Biggest Win**
- Change `h1, h2, h3 { font-family: var(--font-serif) }` → `var(--font-sans)` at CSS line 297.
- This single line change eliminates Lora headings from ALL 9 pages in their Elementor-driven sections.
- Estimated impact: fixes ~70% of visible violations.

**Sprint B: PHP Shortcode Typography**
- Update `$s_h1`/`$s_h2` inline styles in all three PHP shortcode pages (Programări line 1799–1800, Recomandări line 1557–1558, Sfatul line 1331–1332) to use `Inter,system-ui,sans-serif`.
- Update article card h3 titles in PHP (lines 334, 368).

**Sprint C: Critical Dark Section + Black Button**
- Fix the Sfatul dark CTA: change `background:#1D1D1F` → `#F2F2F7` and all associated text colors (PHP lines 2113–2117).
- Fix the Recomandări black button: change `$s_btn_ink` → blue (PHP line 1570).

**Sprint D: Component CSS Cleanup**
- Fix component-level Lora rules: `gu-about-hero__name`, `gu-about-hero__tagline`, `gu-credentials-strip__value`, `gu-article-card__title`, `gu-related-card__title`, `gu-archive-empty-state__heading`, article body h2/h3.
- Fix Despre photo placeholder warm bg: `#C8C0B8` → `#D2D2D7`.
- Verify `--color-surface-warm` token resolves to a cool gray, not a warm beige.

**Total estimated CSS changes:** ~12 property edits across identified lines  
**Total estimated PHP changes:** ~15 inline string replacements  
**No Elementor DB changes required** (CSS overrides are sufficient for all heading typography)

---

## Implementation Results

**Completed:** 2026-07-02  
**QA result:** 9 PASS / 0 FAIL (all 9 pages, comprehensive Playwright audit)  
**Status:** Awaiting browser review — NOT committed

### Phase A — Global typography migration ✅

**Changes to `assets/css/gu-design-system.css`:**
- **Line 297:** Changed `h1, h2, h3 { font-family: var(--font-serif) }` → `var(--font-sans)`. Added `letter-spacing: -0.02em` to shared rule; added per-level overrides (h1: `-0.03em`, h2: `-0.025em`, h3: `-0.01em` semibold).
- **Section 26f (counter numbers):** Changed `var(--font-serif) !important` → `var(--font-sans) !important` on `.elementor-counter-number`.
- **Section 26 card titles:** Changed `var(--font-serif) !important` → `var(--font-sans) !important` on `.gu-afectiuni-card__title` etc.
- **Stats heading elements (a2i00010–16):** Changed `var(--font-serif) !important` → `var(--font-sans) !important`.
- **Section 31b footer brand:** Changed from serif to `var(--font-sans) !important`.
- **Section 31k (new):** Added global `.elementor-heading-title { font-family: var(--font-sans) !important }` override. This catches all Elementor heading widgets that have Lora set at the per-element level in the DB, without requiring any DB changes. Also added h1/h2/h3 level-specific tracking rules.
- **Additional component fixes:** `.gu-about-section-heading`, `.gu-hub-featured__title`, `.gu-clinic-card__name`, `.gu-guide-block__title`, `.gu-recovery-card__title`, `.gu-video-card__title` — all changed from `Lora, Georgia, serif` to `Inter, system-ui, sans-serif`.

**Unintended cascade discovery:** Section 26a `:root` (line ~2271) overrides `--color-surface-warm: #E6DFD8` (warm beige) and `--color-ink: #1C1814`, `--color-ink-secondary: #68615C` (warm browns). All three overridden in Section 31a alongside existing token fixes.

### Phase B — PHP shortcode typography ✅

**Changes to `gu-design-system.php`:**
- **Lines 1331–1332** (Sfatul `$s_h1`/`$s_h2`): `Lora,Georgia,serif` → `Inter,system-ui,sans-serif`; tracking updated to `-0.03em`/`-0.025em`.
- **Lines 1557–1558** (Recomandări `$s_h1`/`$s_h2`): same.
- **Line 1567** (`$s_card_name` — colleague card names): `Lora,Georgia,serif` → `Inter,system-ui,sans-serif`.
- **Lines 1799–1800** (Programări `$s_h1`/`$s_h2`): same.
- **Line 334** (afecțiuni archive card h3 title): `font-family:Lora,serif` → `Inter,system-ui,sans-serif`.
- **Line 368** (intervenții archive card h3 title): same.
- **Descobered in QA:** `.gu-interest-card__title` and `.gu-about-cta__heading` on Despre page also used Lora via CSS component rules — fixed in Phase D.

### Phase C — Dark sections and black buttons ✅

**Changes to `gu-design-system.php`:**
- **Sfatul final CTA (lines 2113–2118):** Changed `background:#1D1D1F` → `background:#F2F2F7;border-top:1px solid rgba(0,0,0,.06)`. Changed all text colors from white (`rgba(255,255,255,*)`) to dark (`#6E6E73`, `#1D1D1F`, `#424245`). Changed h2 font from `Lora,Georgia,serif` to `Inter,system-ui,sans-serif`. Fixed diacritics in copy ("Pregătit", "consultație").
- **Recomandări hero button (line 1570):** Renamed `$s_btn_ink` → `$s_btn_blue`, changed `background:#1D1D1F` → `background:#0E7FC0`. Updated reference at line 1583.

### Phase D — Component CSS cleanup ✅

**Changes to `assets/css/gu-design-system.css`:**
- `.gu-about-hero__name`: `var(--font-serif)` → `var(--font-sans)`
- `.gu-about-hero__tagline`: `var(--font-serif)` → `var(--font-sans)`; removed `font-style: italic`
- `.gu-credentials-strip__value`: `var(--font-serif)` → `var(--font-sans)`
- `.gu-article-card__title`: `var(--font-serif)` → `var(--font-sans)`
- `.gu-related-card__title`: `var(--font-serif)` → `var(--font-sans)`
- `.gu-archive-empty-state__heading`: `var(--font-serif)` → `var(--font-sans)`
- `.gu-archive-empty-state`: `background: var(--color-surface-warm)` → `background: #F2F2F7` (explicit cool gray, bypasses token cascade issue)
- `.elementor-widget-theme-post-content h2/h3`: `var(--font-serif)` → `var(--font-sans)` + added `letter-spacing: -0.02em` on h2
- `.gu-about-hero__photo-placeholder`: `background: #C8C0B8` → `background: #D2D2D7` (cool neutral)
- `.gu-interest-card__title`: `var(--font-serif)` → `var(--font-sans)` (discovered in QA — Sobre specialty cards)
- `.gu-about-cta__heading`: `var(--font-serif)` → `var(--font-sans)`; `color: #fff` → `color: var(--color-ink)` (section bg is now `#F5F5F7`, white text was invisible)
- `.gu-about-cta__text`: `color: rgba(255,255,255,0.82)` → `color: var(--color-ink-secondary)` (same reason)
- **Section 31a `:root`**: Added `--color-canvas: #F5F5F7`, `--color-surface-warm: #F5F5F7`, `--color-ink: #1D1D1F`, `--color-ink-secondary: #424245` to override Section 26a's warm-palette values
- **Changes to `gu-design-system.php`:** CTA button on Despre changed from `gu-btn--light` → `gu-btn--accent` (white button was designed for dark surfaces; now uses blue accent on light background)

### What changed that wasn't in the original plan

1. **`.gu-interest-card__title`** — Specialty cards on Despre used a CSS class-level Lora rule not identified in the gap analysis. Fixed during Phase D QA.
2. **`.gu-about-cta__heading` color** — White text rule remained from the dark-section era; the section background was already set to `#F5F5F7` by an earlier sprint, making the text invisible. Fixed heading font + text color + button variant.
3. **Warm ink token cascade** — Section 26a overrides `--color-ink` to `#1C1814` (warm near-black) and `--color-ink-secondary` to `#68615C` (warm brown-gray). Neither was identified in the gap analysis. Both restored to Apple values in Section 31a.
4. **Section 31k global Elementor override** — Needed because Elementor stores per-element font-family in the DB and generates higher-specificity CSS than our global h1/h2/h3 rule. A single `.elementor-heading-title { font-family: var(--font-sans) !important }` rule at file end handles all 9 pages without any DB writes.

---

*Implementation complete. DO NOT COMMIT — awaiting human browser review.*
