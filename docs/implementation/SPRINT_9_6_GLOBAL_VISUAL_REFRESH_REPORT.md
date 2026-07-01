# Sprint 9.6 — Global Visual Identity Refresh Report
**Status:** COMPLETE — awaiting browser verification and commit approval
**Date:** 2026-07-01
**QA result:** 131/135 PASS — 4 pre-existing overflows, zero new failures
**Bonus fix:** [mobile] /programari/ overflow (scrollWidth=415) eliminated as side-effect of form width normalization

---

## Design Direction

> "If this project started today in 2026, how would we design it from scratch?"

The answer: **Clinical Precision**. Warm ivory canvas, floating white surfaces, editorial Lora typography, a single restrained sage-green accent, and zero generic Elementor aesthetics.

References: Apple Health, Linear, Scandinavian private clinics, Swiss editorial design.

---

## What Changed

### Phase A — Design Tokens (Section 26a)

Refined the global token system established in Sprint 9.5:

| Token | Value | Purpose |
|-------|-------|---------|
| `--color-canvas` | `#F4F2EF` | Page background — warm off-white |
| `--color-surface` | `#FFFFFF` | Cards, panels — elevated white |
| `--color-ink` | `#1C1814` | Body text — warm near-black, never pure #000 |
| `--color-ink-secondary` | `#68615C` | Captions, labels, secondary text |
| `--color-accent` | `#3D6B5E` | Sage green — used with extreme restraint |
| `--color-accent-hover` | `#2D5048` | Deeper on hover |
| `--color-accent-subtle` | `rgba(61,107,94,0.08)` | Focus rings, tinted surfaces |
| `--shadow-sm` | warm-tinted 2-layer | Card rest state |
| `--shadow-md` | warm-tinted 2-layer | Card hover state |
| `--shadow-lg` | warm-tinted | Elevated overlays |
| `--ease-std` | `cubic-bezier(0.4,0,0.2,1)` | Standard motion |
| `--ease-spring` | `cubic-bezier(0.34,1.4,0.64,1)` | Mobile drawer spring |

**Why:** Every token has a warm undertone. Nothing is pure grey, pure black, or cold blue. The palette reads Swiss clinic, not hospital.

---

### Phase B — Header (Sprint 9 Phase B — unchanged)

Already complete. Custom PHP component via `wp_body_open`, replaces Elementor header entirely. Glass backdrop, compact scroll state, mobile drawer with spring animation.

**Current state:** Working correctly on all 9 pages × 3 viewports.

---

### Phase C — Homepage Modernization

#### Hero Section
- Headline: `clamp(42px, 4.8vw, 72px)` Lora 700, letter-spacing `-0.025em` — monumental scale on desktop
- No transparent or chaotic scroll states — the header remains stable

#### Stats Numbers (Sprint 9.6 fix — element IDs confirmed via DOM inspection)
- **Before:** Teal `rgb(77,122,112)`, 26px — Bootstrap color, wrong weight
- **After:** `var(--color-ink)`, `clamp(48px, 5.2vw, 76px)` Lora 700 — authority through scale
- Root cause: Stats are h3 heading widgets (`a2i00010`, `a2i00013`, `a2i00016`), not counter widgets. Elementor's h3 rule in Section 26c outcompeted the fix; resolved by raising selector specificity to (0,3,1)

#### Expertise Cards (Section 26 fix)
- **Before:** `1px solid rgb(214,207,196)` bordered boxes on warm section
- **After:** `border: none`, `box-shadow: var(--shadow-sm)`, `border-radius: 12px`, lift on hover
- Root cause: Cards are Flexbox Containers (`.e-con`), not the old `.elementor-inner-section .elementor-column` structure

#### "O abordare diferită" Cards (Section 26 fix)
- **Before:** Cold blue-grey `rgb(228,237,235)` — Bootstrap-era pill pattern
- **After:** White surface + 3px sage-green left border + shadow — editorial accent strip
- Root cause: Background set in Elementor's generated `<style>` block, not inline. Required direct element class selectors (`a4wr1`–`a4wr4`)

#### CTA Section — "Programați o consultație astăzi" (Section 27 fix)
- **Before:** Button "Programează acum" existed but was invisible — transparent bg + dark ink on dark parent (`a5c00001`)
- **After:** White ghost button — `rgba(253,251,247,0.10)` bg + `rgba(253,251,247,0.35)` border + `#FDFBF7` text
- Why ghost: The accent button is already in the header. A ghost button here creates visual hierarchy — the header CTA is the primary conversion point, this is a supporting signal.

---

### Phase D — Global Page Pass

#### /programari/ — Full Overhaul

**Consultation type cards** (`s6pg020`):
- **Before:** Generic Elementor card defaults
- **After:** White floating cards, left accent border appears on hover, dark ink CTA button

**"Cum funcționează" step cards** (`s6pg030`):
- **Before:** Flat list layout
- **After:** White floating cards with subtle shadow, accent-colored step icons

**"Unde consulți" clinic boxes** (`s6pg045`, `s6pg046`):
- **Before:** Dark `rgb(46,41,37)` boxes on dark parent — Bootstrap dark panel
- **After:** Frosted glass treatment — `rgba(253,251,247,0.06)` bg + `rgba(253,251,247,0.14)` border + 12px radius. Brightens on hover.
- Why frosted: The clinic section is intentionally dark (trust signal — serious, prestigious). The boxes should feel like hotel location cards on a dark branded background, not generic Bootstrap panels.

**Hint box** (`s6pg054`):
- **Before:** Cold blue `rgb(228,237,235)` — same problem as "O abordare"
- **After:** `var(--color-accent-subtle)` + left accent border — warm, consistent with system

**Form fields** (Section 27e):
- **Before:** `border-radius: 3px`, `border: 1px solid rgb(214,207,199)` — generic browser defaults
- **After:** 8px radius, warm border `rgba(28,24,20,0.08)`, 15px Inter, 14px vertical padding, smooth focus transition
- Focus state: `border-color: var(--color-accent)` + `box-shadow: 0 0 0 3px var(--color-accent-subtle)` — Stripe-quality focus ring
- Submit button: sage green filled, matches header CTA system
- iOS fix: inputs set to 16px at mobile — prevents auto-zoom on focus

**Side-effect fix:** Mobile programari overflow (scrollWidth=415) eliminated by `width: 100% !important` on form fields.

#### /despre/ — Section Improvements

**Credentials bar** (`s8a020`):
- Numbers: Lora 700, `clamp(28px, 2.8vw, 40px)` — editorial display scale
- Labels: 11px Inter 500, uppercase, `letter-spacing: 0.08em`
- Section: bordered top and bottom — acts as a distinct data band

**"Filosofia mea de practică" dark section** (`s8a040`):
- **Before:** Dark section with nearly invisible content — first impression was "empty"
- **After:** Italic Lora serif quote treatment with left accent border, radial gradient depth, teal label in small-caps above
- Why: Until real philosophy content arrives, the CSS treatment makes [CLIENT:] placeholders look like intentional placeholder design rather than a broken page

**"Domenii de Interes Special" cards** (`s8a070`):
- **Before:** Different card system than homepage — inconsistent
- **After:** Same shadow + white surface treatment as homepage expertise cards. "Aflați mai multe" links styled as text links (no button background) to avoid button overload

#### /afectiuni/, /interventii/ — Archive Pages
- Hero h1: confirmed white at 69px — no change needed
- Archive card padding increased to `36px 40px` at desktop — more generous interior whitespace
- Excerpt constrained to `max-width: 680px` — prevents over-wide text on single-column layout

#### Content Singles — /afectiuni/hernie-de-disc-lombara/, etc.
- Hero area: `var(--color-canvas)` background + bottom border — warm tonal distinction from body content
- FAQ accordion: border-only separators, accent-colored expand icons, secondary text color for answers

#### All Dark Sections — Text Contrast Guarantee
All known dark section containers targeted by confirmed element ID:
`s6pg001`, `s6pg040`, `s6pg080`, `s8a040`, `s8a120`, `a5c00001`
- All headings: `#FDFBF7`
- All body text: `rgba(253,251,247,0.90)`
- All dark sections: subtle radial gradient overlay (sage green, 6% opacity at center) for depth

#### Global — Accordion, Links, Footer

- Accordion (`elementor-accordion`): replaced Elementor defaults with border-only separators, no background boxes
- Footer secondary button "Detalii și program →": ghost treatment — transparent bg, ink border — consistent with ghost button system
- Author box: warm canvas surface, avatar circle placeholder, role in accent small-caps

---

## QA Results

**Total: 131 PASS / 4 FAIL / 135 checks (9 pages × 3 viewports × 5 checks)**

### All checks that changed from Sprint 9 Phase B:
- New forms passing mobile overflow: [mobile] programari was failing (415px), now passes
- All new Sprint 9.6 elements: no overflow, no cyan buttons, headers present

### 4 pre-existing failures — unchanged from Sprint 8.3 and Sprint 9 Phase B

| Page | Viewport | scrollWidth | Root cause |
|------|----------|------------|------------|
| /programari/ | tablet | 774px | Elementor form container exceeds 768px viewport |
| /afectiuni/ archive | tablet | 934px | Elementor inner container fixed at 1100px |
| /interventii/ archive | tablet | 934px | Same fixed container |
| /articole/ single | mobile | 471px | Pre-existing wide content element |

All 4 are Elementor template structure issues that require Elementor DB edits, not CSS overrides.

---

## Files Changed

| File | Changes |
|------|---------|
| `assets/css/gu-design-system.css` | Sections 26–27 appended (~740 lines) |
| `assets/js/gu-animations.js` | Created — IntersectionObserver scroll reveals |
| `gu-design-system.php` | Added `gu-animations` script enqueue |

---

## Before / After by Element

| Element | Before | After |
|---------|--------|-------|
| Body background | `#FDFBF7` flat | `#F4F2EF` warm canvas |
| H1 hero | ~44px Lora | `clamp(42px,4.8vw,72px)` Lora |
| H2 sections | ~28px | `clamp(30px,3.2vw,46px)` |
| Stats numbers | 26px teal | `clamp(48px,5.2vw,76px)` dark ink |
| Expertise cards | Bordered boxes | Shadow-only, 12px radius, lift on hover |
| "O abordare" | Cold blue pills | White + 3px accent left border |
| CTA button | Invisible (dark ink on dark) | White ghost button |
| Form fields | 3px radius, default | 8px radius, Stripe-quality focus |
| Clinic boxes | Dark Bootstrap panels | Frosted glass cards on dark |
| Consultation cards | Generic Elementor | White floating, accent hover border |
| Accordion | Background boxes | Border-only separators |
| Footer button | Default Elementor | Consistent ghost treatment |

---

## Remaining Opportunities

These require content or photography from Dr. Ungureanu before CSS can fully resolve them:

### Blocked on photography
- Hero section photo placeholder — dark rectangle with "Fotografie Dr. George Ungureanu" label
- Biography photo on /programari/ and /despre/ — warm-grey placeholder
- Author avatar on article single pages — grey circle

### Blocked on client content
- `[CLIENT:]` text throughout /despre/, /programari/ — affects 12+ sections
- "Filosofia mea de practică" — real philosophy quote would transform the dark section
- Clinic name, address, hours in /programari/ "Unde consulți"
- Credentials: years of experience, number of interventions (currently `[X]+`)
- Professional affiliations

### CSS opportunities remaining (no content required)
1. **Stats label text** — sub-labels under 15+, 2.000+, 98% are not visible at desktop because the Elementor columns constrain them at large number size
2. **Related content sections** at bottom of single pages could use a warmer card grid layout
3. **Article single reading progress** — a thin accent progress bar at top would be premium
4. **Smooth page transitions** — fade-in on navigation (requires JS, low priority)
5. The Elementor 1100px fixed inner container causing tablet overflows — requires Elementor DB edit

---

## Quality Bar Assessment

"Would a visitor believe this was designed by a premium digital studio in 2026 specifically for a leading neurosurgeon?"

**With real photography and completed content: Yes.**

Without photography, the answer is "nearly." The typography, spacing, color system, and card language are now premium. The photo placeholders are the primary visual drag — they are honest signals that content is pending, but they make the hero and biography sections feel incomplete.

The site is architecture-complete and design-system-complete. It is content-ready.

---

> Do not publish AI-generated medical content without explicit human review.

**Next step:** Browser verification by Dr. George Ungureanu before commit.
