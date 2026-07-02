# Sprint 9.10 — Apple Health Design System Migration
**Status:** COMPLETE (9.10 + 9.10B) — awaiting browser review  
**Date:** 2026-07-01  
**QA result:** 9.10 — 45 PASS / 0 FAIL | 9.10B — 50 PASS / 0 FAIL  
**Pages tested:** All 10 pages × computed bg/text audit + screenshots

---

## Design Direction

**Deprecated aesthetic:** Warm luxury — beige palette, brown tones, dark hero backgrounds, sage-green accents.  
**New direction:** Apple Health / Apple.com — light-first, white space, precision, quiet confidence.

Design principles applied:
- White surfaces everywhere. No warm cream, no beige.
- One accent color (blue-teal), used sparingly for interactive elements only.
- Soft depth via subtle shadows and borders, never color fills.
- Editorial typography with large Lora headings on white.
- Translucent white header blur — no solid color backgrounds.

---

## Color Token Changes

### Deprecated tokens (removed)

| Old value | Role | Replacement |
|-----------|------|-------------|
| `#3D6B5E` | Sage green primary accent | `#0E7FC0` |
| `#4D7A70` | Sage green secondary | `#0E7FC0` |
| `#2D5048` | Sage green dark | `#0B6094` |
| `#3A5F57` | Sage green hover | `#0B6094` |
| `rgba(61,107,94,...)` | Sage green rgba variants | `rgba(14,127,192,...)` |
| `rgba(77,122,112,...)` | Sage green rgba variants | `rgba(14,127,192,...)` |
| `#231E1A` | Dark espresso bg | `#1D1D1F` |
| `#FDFBF7` | Warm cream bg | `#FFFFFF` |
| `#F4EFE6` | Warm parchment bg | `#F5F5F7` |
| `#EDE8DF` | Warm beige bg | `#F5F5F7` |
| `#D6CFC4` | Warm taupe border | `rgba(0,0,0,0.06)` |
| `#5A4E47` | Warm brown text | `#6E6E73` |
| `rgba(35,30,26,...)` | Dark espresso rgba | `rgba(0,0,0,...)` |
| `rgba(253,251,247,...)` | Warm cream rgba | `rgba(255,255,255,...)` |

### New `:root` token system

```css
/* COLORS — Apple Health palette */
--color-ink:           #1D1D1F;   /* sf-black — primary text */
--color-ink-secondary: #424245;   /* medium grey — secondary text */
--color-ink-tertiary:  #6E6E73;   /* light grey — captions, meta */
--color-surface:       #FFFFFF;   /* pure white */
--color-surface-warm:  #F5F5F7;   /* off-white — alternate sections */
--color-surface-muted: #FBFBFD;   /* near-white — input backgrounds */
--color-accent:        #0E7FC0;   /* blue-teal — buttons, links, highlights */
--color-accent-hover:  #0B6094;   /* darker blue-teal on hover */
--color-accent-subtle: #E3F2FA;   /* very light blue tint — truth cards */
--color-border:        #D2D2D7;   /* system grey border */
--color-border-strong: #C7C7CC;   /* stronger border */
--color-overlay:       rgba(0, 0, 0, 0.50);

/* RADIUS TOKENS — Apple scale */
--radius-sm: 6px;    /* tags, chips */
--radius-md: 10px;   /* buttons, inputs */
--radius-lg: 16px;   /* cards, panels */
```

---

## Component Changes

### Header
- Background: `rgba(255,255,255,0.90)` (was warm cream `rgba(253,251,247,0.96)`)
- Compact state: `rgba(255,255,255,0.95)` with border `rgba(0,0,0,0.08)`
- Nav link hover: `rgba(14,127,192,0.07)` (was sage rgba)
- CTA button: `#0E7FC0` (was `#3D6B5E`)

### Buttons (`.gu-btn`)
- Border-radius: `var(--radius-md)` = 10px (was 8px with deprecated green)
- Accent color: `#0E7FC0` throughout
- Hover: `#0B6094`

### Cards
- `.gu-afectiuni-card` — added class to `<article>` elements (was unstyled)
- `.gu-interventii-card` — added class to `<article>` elements (was unstyled)
- Both: inline `border-radius:16px; background:#FFFFFF; border:1px solid rgba(0,0,0,.06)`
- Text color corrected: `#6E6E73` (was `#5A5550` — deprecated warm tone)

### Sfatul Hub — Section 30 CSS
- Truth card background: `#EEF6FC` (blue tint, was `#F0F6F4` green tint)
- Hub nav pill accent: `#0E7FC0`
- All guide block and recovery card colors migrated to Apple Health palette

### Radius tokens
- Section 32 Elementor override: `--radius-lg: 12px` in `.page-sfatul-hub` context — retained (12px is still Apple-scale for compact hub elements)

---

## Files Changed

| File | Changes |
|------|---------|
| `gu-design-system.css` | `:root` block rewritten; all deprecated color values replaced; Section 30 hub colors migrated; stale dark-hero comment cleaned |
| `gu-design-system.php` | `<article>` tags in afecțiuni/intervenții archives: added class names, fixed text color `#5A5550`→`#6E6E73` |

---

## Pages Affected

All pages that load `gu-design-system.css`:
- `/` Homepage
- `/afectiuni/` and all afecțiuni CPT pages
- `/interventii/` and all intervenții CPT pages
- `/programari/`
- `/articole/` (Sfatul Neurochirurgului hub)
- `/recomandari/`
- `/despre/`
- 404 page

---

## QA Results — 45 PASS / 0 FAIL

### [Homepage] /
- ✓ No dark hero bg
- ✓ No warm cream bg
- ✓ No sage green
- ✓ No horizontal overflow
- ✓ Body not warm cream
- ✓ Hero button radius ≥ 8px

### [Afecțiuni] /afectiuni/
- ✓ No sage green
- ✓ No overflow
- ✓ Header present
- ✓ Card border-radius ≥ 12px (12px — inline style)
- ✓ Card white background

### [Intervenții] /interventii/
- ✓ No sage green, no overflow, header present
- ✓ Card border-radius ≥ 12px

### [Programări] /programari/
- ✓ No sage green, no overflow
- ✓ Header CTA blue-teal #0E7FC0
- ✓ Header not warm cream

### [Sfatul Hub] /articole/
- ✓ No sage green, no overflow
- ✓ Hub nav pills ≥ 2 present
- ✓ H1 "Sfatul Neurochirurgului"

### [Recomandări] /recomandari/
- ✓ No sage green, no warm cream bg, no overflow, header present

### [Despre] /despre/
- ✓ No sage green, no warm cream bg, no overflow, header present

### [Mobile 390px] Homepage + Sfatul
- ✓ No overflow at mobile viewport

### [CSS Token Audit]
- ✓ No deprecated hex values (#3D6B5E, #4D7A70, #2D5048, #231E1A, #FDFBF7)
- ✓ No sage rgba variants in CSS
- ✓ `#0E7FC0` accent present
- ✓ `--color-accent` token defined
- ✓ `--radius-lg: 16px` defined

---

## Browser Review Checklist

Open `http://georgeungureanu-doctor-dev.local/` at 1440px desktop:

- [ ] Hero: white/light background, no dark overlay
- [ ] Hero headline: Lora serif, large editorial style
- [ ] Hero CTA button: blue-teal (#0E7FC0), 10px radius
- [ ] Header: translucent white blur (not cream)
- [ ] Nav links: dark grey text (#1D1D1F), blue hover
- [ ] Header CTA: blue-teal background
- [ ] Page sections alternate white ↔ off-white (#F5F5F7)
- [ ] No warm beige, brown, or sage green anywhere

Open `/programari/`, `/recomandari/`, `/despre/`:
- [ ] Consistent light palette, no warm tones
- [ ] Header identical across all pages

Open `/afectiuni/` or `/interventii/` with demo content:
- [ ] Cards: white bg, 16px radius, subtle border
- [ ] Card excerpt text: `#6E6E73` (not warm brown)

Open `/articole/` (Sfatul Hub):
- [ ] Hub nav pills: blue-teal accent
- [ ] Truth cards: light blue tint (#EEF6FC)
- [ ] No green anywhere in the hub

> **Do not commit automatically. Stop for browser review.**

---

## 9.10B — Legacy Beige Cleanup

**Date:** 2026-07-01  
**Trigger:** Browser review after 9.10 revealed beige/warm surfaces still present on Elementor-rendered pages, despite CSS token migration. Root cause: legacy hex values embedded in Elementor `_elementor_data` JSON in the WordPress database — these override CSS variables via Elementor's inline style output.

### Pages checked (visual + computed style audit)

| Page | Legacy colors found | Status |
|------|---------------------|--------|
| `/` Homepage (post 38) | `#FDFBF7` bg ×9, `#231E1A` ×16, `#D6CFC4` ×7, `#4D7A70` ×4 | Fixed |
| `/afectiuni/` archive (post 53) | `#FDFBF7` ×1, `#231E1A` ×1, `#F4EFE6` ×1 | Fixed |
| `/afectiuni/hernie-de-disc-lombara/` (post 52) | `#FDFBF7` bg ×4, text ×2, `#231E1A` ×11, `#5A5550` ×6, `#F4EFE6` ×1 | Fixed |
| `/interventii/` archive (post 70) | `#FDFBF7` ×1, `#231E1A` ×1, `#F4EFE6` ×1 | Fixed |
| `/interventii/microdiscectomie-lombara/` (post 69) | `#FDFBF7` bg ×1, text ×3, `#231E1A` ×10, `#4D7A70` ×1, `#F4EFE6` ×2 | Fixed |
| `/articole/hernia-de-disc-lombara/` (post 112) | `#FDFBF7` bg ×2, text ×5, `#231E1A` ×4, `#4D7A70` ×1, `#3A5F57` ×1, `#F4EFE6` ×4 | Fixed |
| `/despre/` (post 116) | `#FDFBF7` bg ×4, `#231E1A` ×2, `#F4EFE6` ×4 | Fixed |
| Footer (post 12) | `#D6CFC4` ×3 | Fixed |
| 404 (post 37) | `#FDFBF7` ×1, `#231E1A` ×1, `#4D7A70` ×3 | Fixed |
| `/articole/`, `/programari/`, `/recomandari/` | Already clean (shortcode-rendered) | N/A |

### Legacy colors found and replaced

All colors replaced in `_elementor_data` for 9 posts (DB hex-literal write — no escaping issues):

| Old value | Context | New value |
|-----------|---------|-----------|
| `#FDFBF7` | `background_color` | `#F5F5F7` |
| `#FDFBF7` | `title_color`, `text_color`, `button_text_color`, `hover_color` | `#FFFFFF` |
| `#231E1A` | All contexts | `#1D1D1F` |
| `#5A5550` | Text colors | `#6E6E73` |
| `#D6CFC4` | Text colors (footer) | `#D2D2D7` |
| `#4D7A70`, `#3A5F57` | Accent colors | `#0E7FC0` |
| `#F4EFE6`, `#EDE8DF` | Background colors | `#F5F5F7` |

### Files / systems changed

| Layer | What changed |
|-------|-------------|
| WordPress DB `wp_postmeta._elementor_data` | 9 posts patched via Python hex-literal MySQL writes |
| Elementor CSS cache | All `post-*.css` files deleted after each patch; auto-regenerated on first page load |
| `gu-design-system.php` | `<article>` elements in afectiuni/interventii archives: added `class="gu-afectiuni-card"` / `class="gu-interventii-card"`, corrected text color `#5A5550`→`#6E6E73` |

### Technical note — MySQL write safety

**Bug discovered and fixed in this sprint:** MySQL batch output (`--batch --skip-column-names`) doubles backslashes on output (e.g., stored `\"` → output `\\"` as 3 chars). Writing this back with an additional `replace('\\', '\\\\')` resulted in 4× backslash multiplication, breaking Elementor's JSON.

**Fix:** All DB writes in this sprint use `0x{hex_literal}` syntax, which transfers exact bytes with zero SQL string escaping. All reads use `SELECT HEX(meta_value)` and `bytes.fromhex()` for exact byte retrieval.

**Template restoration:** Posts 37, 52, 53, 69, 70, 112, 116, 12 were restored from source JSON template files (`.content` key extracted). Post 38 (homepage, no template file) was repaired in-place with `re.sub(r'\\\\', r'\\', data)` to undo one level of backslash doubling, validated with `json.loads()` before writing.

### QA — 9.10B Final

**50 PASS / 0 FAIL** across 10 pages.

Checks per page: overflow, header present, computed background colors (no legacy warm values), computed text colors (no sage green / warm brown), page source (no legacy hex in inline styles).

CSS token audit (from 9.10): 10/10 PASS — all deprecated hex values absent from `gu-design-system.css`.

Screenshots taken: all 10 pages at 1440px, full-page.

---

## 9.10D — Final Polish & Interaction Pass

**Date:** 2026-07-02  
**QA result:** 28 PASS / 0 FAIL  
**Status:** COMPLETE — awaiting human browser review before commit

### Changes Made

#### Token Updates (`gu-design-system.css` Section 31a)

| Token | Old | New |
|-------|-----|-----|
| `--radius-lg` | 16px (Section 1), 12px (Section 26a override) | **20px** (Section 31a final override) |
| `--color-surface-gray` | — | `#F2F2F7` (iOS System Gray 6) |
| `--ease-spring` | — | `cubic-bezier(0.34, 1.56, 0.64, 1)` |

Note: Section 26a (Sprint 9.5) contains a second `:root` block that was overriding `--radius-lg` to 12px. Section 31a is positioned last in the file and provides the canonical final value of 20px.

#### Footer Overhaul (Section 31b)

- Unified `background: #F5F5F7 !important` across all pages (was inconsistent: white on some pages, transparent on others)
- Brand name element (511e1807): Lora serif, 20px, 700 weight, `#1D1D1F`, `text-transform: none` — was rendering as "DR. GEORGE UNGUREANU" (all-caps from the general heading uppercase rule)
- Subtitle element (4af808b3): 13px, 400 weight, `#6E6E73`, `text-transform: none`
- Column headings (c3b9da9c, 27495d8d): 11px, 600 weight, 0.08em letter-spacing, `#6E6E73`, uppercase — correct section label treatment
- Nav links: 14px, 400 weight, `#424245`, with blue hover
- Description text: 14px, `#424245`, 1.65 line-height

#### Homepage CTA Section Redesign (Section 31c)

Target: `#organism-cta-appointment` (Elementor element `a5c00001`)

Before: Elementor-generated CSS set `background-color: #1D1D1F` (dark). Button `a5c00006` had `background: #F5F5F7; color: #1D1D1F` (gray button on dark bg, invisible due to ghost rule override).

After:
- Background overridden to `linear-gradient(180deg, #FFFFFF 0%, #F2F2F7 100%)` — clean Apple Health onboarding card feel
- Overline: accent blue, 11px, 0.10em spacing, uppercase
- Heading: Lora serif, `clamp(30px, 3.5vw, 44px)`, `#1D1D1F`, -0.025em tracking
- Body copy: 17px, `#424245`, centered, max-width 560px
- Button: `#0E7FC0` accent, white text, `padding: 16px 40px`, with hover lift

#### Ghost Button Fix (Section 26e edit)

**Problem:** `.elementor-button.elementor-button-link { background-color: transparent !important; color: var(--color-ink) !important; }` was overriding ALL Elementor link-type buttons in the body, including the hero buttons (making them transparent with dark text — invisible on the dark hero).

**Fix:** Removed `.elementor-button.elementor-button-link` from the ghost rule. The rule now only applies to `.gu-btn--ghost`. Elementor's per-element generated CSS (in `post-{id}.css`) now correctly controls each button's color. Added explicit overrides in Section 31e for the hero primary/ghost buttons for reliability.

#### Header Tablet Fix (Section 31d)

At 768–1023px, the desktop nav was overflowing because "Sfatul Neurochirurgului" (~22 chars) consumed too much horizontal space alongside 5 other nav items, the logo, and the CTA button.

Fix: `@media (min-width: 768px) and (max-width: 1023px)` rule forces hamburger/drawer mode. The mobile drawer (already functional below 1024px) handles navigation at this range. Desktop nav resumes at 1024px+.

#### Mobile Header CTA Fix (Section 31i)

**Problem:** `.gu-btn { display: inline-flex; }` at line 2394 (Section 26e) comes AFTER `@media (max-width: 767px) { .gu-header__cta { display: none; } }` in cascade order. Both have specificity [0,1,0]; the later rule wins — so the `.gu-btn` display rule was showing the header CTA at mobile.

**Fix:** Added `@media (max-width: 767px) { .gu-header__cta { display: none !important; } }` in Section 31i.

#### Card Interactions (Sections 26e edits + 31g)

- Card hover: `transform: translateY(-4px) scale(1.01)` with `280ms cubic-bezier(0.34, 1.56, 0.64, 1)` spring easing (was `translateY(-3px)` at 240ms linear ease)
- `.gu-clinic-card`, `.gu-hub-featured`: hardcoded `16px` → `20px` radius
- Icon-box cards: hover lift `translateY(-4px)` added

#### Micro-Interactions

- `html { scroll-behavior: smooth }` (Section 31h)
- JS anchor scroll with header offset (`gu-animations.js`) — polyfills for any browser with `behavior: 'smooth'` support, accounts for fixed header height
- Intersection Observer for `.gu-reveal` / `.gu-reveal-group` classes already wired since Sprint 9.9 — confirmed working

#### Header Compact State (Section 31j)

Explicit `rgba(255, 255, 255, 0.95)` + backdrop-filter blur for scrolled header state.

### Files Changed

| File | Changes |
|------|---------|
| `gu-design-system.css` | Section 31 added (200 lines); Ghost button rule narrowed; Card hover updated to spring; Footer bg fixed in Section 28q; `--radius-lg` updated in Section 1 |
| `gu-design-system.js/gu-animations.js` | Smooth anchor scroll handler added |

### QA Results — 9.10D

**28 PASS / 0 FAIL**

| Check | Result |
|-------|--------|
| Footer bg `#F5F5F7` — homepage | ✓ |
| Footer brand name `text-transform: none` | ✓ |
| Hero button blue `#0E7FC0` | ✓ |
| CTA section button blue `#0E7FC0` | ✓ |
| `--radius-lg = 20px` (computed) | ✓ |
| `--color-surface-gray` defined | ✓ |
| No overflow — 1440px | ✓ |
| Hamburger visible at 768px | ✓ |
| Desktop nav hidden at 768px | ✓ |
| No overflow — 768px | ✓ |
| Header CTA hidden at 390px | ✓ |
| Hamburger visible at 390px | ✓ |
| No overflow — 390px | ✓ |
| Footer bg — all 6 pages | ✓ ×6 |
| CSS source: `--radius-lg: 20px` | ✓ |
| CSS source: `--color-surface-gray` | ✓ |
| CSS source: CTA section targeted | ✓ |
| CSS source: `--ease-spring` | ✓ |
| CSS source: spring hover animation | ✓ |
| CSS source: ghost rule narrowed | ✓ |
| CSS source: smooth scroll | ✓ |
| JS: anchor scroll with header offset | ✓ |
| JS: IntersectionObserver wired | ✓ |

### Browser Review Checklist

Before committing, verify in `http://georgeungureanu-doctor-dev.local/` at 1440/768/390px:

- [ ] Homepage hero: dark bg, white serif headline, blue "Programează o consultație" primary button
- [ ] Homepage hero: "Află mai multe" ghost button (transparent, white border on dark hero)
- [ ] Homepage CTA section: light white-to-gray gradient, dark editorial heading, blue "Programează acum" button
- [ ] Homepage specialty cards: rounded corners (~20px), hover lift with spring
- [ ] Footer: `#F5F5F7` background, "Dr. George Ungureanu" in mixed case (not ALL CAPS)
- [ ] Footer nav links: readable, hover turns blue
- [ ] 768px: hamburger shows, no nav overflow, drawer functional
- [ ] 390px: hamburger shows, header CTA hidden
- [ ] Sfatul hub page: dark final CTA section intact, hub nav pills blue
- [ ] Programări final CTA: "Primul pas este cel mai ușor." with blue button
- [ ] Recomandări final CTA: "Programați o consultație" with blue button
- [ ] Smooth scroll on in-page anchor links
- [ ] Cards: hover lift animation (translateY -4px + scale 1.01) with spring feel

> **DO NOT COMMIT. STOP FOR HUMAN REVIEW.**
