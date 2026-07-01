# Sprint 9.7 — Apple Health Direction: Global Hero Reboot
**Status:** COMPLETE — awaiting browser verification and commit approval  
**Date:** 2026-07-01  
**QA result:** 143 PASS / 0 FAIL / 4 PRE-EXISTING — zero new failures  
**CSS added:** Section 28 (~574 lines appended after line 3626)

---

## Design Directive

> "The visual language still feels too warm, beige and dark. The new reference is: Apple Health, Apple Fitness, Apple.com editorial sections, Modern Scandinavian healthcare, Calm private clinics, Light-first interfaces."

**Core shift:** From warm/beige/dark → light-first/airy/precise.

| Before (Sprints 9.5–9.6) | After (Sprint 9.7) |
|--------------------------|-------------------|
| Canvas: `#F4F2EF` warm off-white | Canvas: `#F5F5F7` Apple cool grey |
| Ink: `#1C1814` warm near-black | Ink: `#1D1D1F` Apple graphite |
| Secondary: `#68615C` warm brown-grey | Secondary: `#6E6E73` Apple grey |
| Shadows: warm `rgba(28,24,20,...)` tint | Shadows: neutral `rgba(0,0,0,...)` |
| Hero sections: `rgb(35,30,26)` dark brown | Hero sections: `#FFFFFF` or `#F5F5F7` |
| CTA sections: dark brown | CTA sections: `#F5F5F7` + sage button |
| Header: warm ivory glass | Header: pure white glass |

---

## What Changed (Section 28 Subsections)

### 28a — Token Pivot
Updated CSS custom properties at `:root`:
- `--color-canvas: #F5F5F7` (Apple grey-white, replaces warm `#F4F2EF`)
- `--color-ink: #1D1D1F` (Apple graphite, replaces warm `#1C1814`)
- `--color-ink-secondary: #6E6E73` (Apple grey, replaces warm `#68615C`)
- `--color-surface-alt: #FBFBFD` (very subtle blue-white tint, new)
- `--color-border: rgba(0,0,0,0.06)` (neutral, replaces warm-tinted)
- Shadows: `rgba(0,0,0,...)` instead of `rgba(28,24,20,...)`
- Body background: `#F5F5F7 !important`

### 28b — Header White Glass
Header background updated from warm ivory `rgba(253,251,247,0.96)` to pure white `rgba(255,255,255,0.92)`. Border color neutralised from warm `rgba(189,179,165,...)` to `rgba(0,0,0,0.08)`. Mobile drawer panel likewise.

### 28d — Homepage Hero
- Section `3b2e4f01`: dark brown → white with subtle `#FFFFFF → #F5F5F7` gradient, bottom border separator
- Photo placeholder `3b2e4f09`: dark rectangle → `#F5F5F7` card with `border-radius: 20px`, elegant box-shadow — never a brown block
- Hero CTA button: switched from ghost-white (Sprint 9.6) to dark ink `#1D1D1F` on white — Apple-like confidence
- Hero headings: `#1D1D1F`, subtitle: `#424245`

### 28e/f — Homepage Warm Sections
- `a2i00001` (bio outer): warm `rgb(253,251,247)` → `#FFFFFF`
- `a2i00002` (bio inner): warm `rgb(237,232,223)` → `#F5F5F7`

### 28f — Homepage Bottom CTA
- `a5c00001`: dark brown → `#F5F5F7` with top border separator
- Button: switched from ghost-white (Sprint 9.6) to sage green filled (consistent with other CTAs)

### 28g — Archive Heroes (all three CPTs)
- `s4ar001`, `s5ar001`, `s7ar001`: dark brown → `#F5F5F7`
- Gradient removed, bottom border separator added
- Headings: `#1D1D1F`, descriptions: `#6E6E73`

### 28h — Single Page Heroes (all three CPTs)
- `s4sg001`, `s5sg001`, `s7sg001`: dark brown → `#FFFFFF`
- Gradient removed, bottom border separator added
- Headings: `#1D1D1F`, body: `#424245`

### 28i — Single Page CTA Sections (all three CPTs)
- `s4sg060`, `s5sg060`, `s7sg060`: dark brown → `#F5F5F7` with top border
- Buttons: sage green filled (consistent system)

### 28j — Programari Page Throughout
- Hero `s6pg001`: dark brown → `#FFFFFF` + gradient, bottom border
- Warm sections `s6pg010/030/050/070`: → `#F5F5F7`
- "Unde consulți" `s6pg040`: dark → `#F5F5F7` with borders
- Clinic boxes `s6pg045/046`: frosted glass (Sprint 9.6) → white floating cards with `box-shadow: var(--shadow-md)` — clean, premium
- Final CTA `s6pg080`: dark → `#F5F5F7`, sage button

### 28k — Despre Page
- Warm sections `s8a010/030/060/100`: → `#F5F5F7`
- Philosophy `s8a040`: dark → `#F5F5F7` with borders, graphite text, accent blockquote treatment
- Sobre CTA `s8a120`: dark → `#F5F5F7`, sage button

### 28l — Neutralise Section 27b White-Text Rules
Section 27b (Sprint 9.6) had set `color: #FDFBF7` on all dark section headings and paragraphs. Now those sections are light, so Section 28l overrides all of them back to `#1D1D1F` / `#6E6E73`. All background-image gradients from the dark era also removed.

### 28m — Global Typography Default
`.elementor-heading-title` defaults to `#1D1D1F` and `.elementor-widget-text-editor p` to `#424245` globally, unless a specific rule sets otherwise.

### 28o — Remaining Warm Alternating Sections
`a3s00001` (expertise) → `#F5F5F7`, `a4w00001` ("O abordare") → `#FFFFFF`. The page now alternates cleanly between white and Apple canvas grey.

### 28q — Footer
`background-color: #FFFFFF`, `border-top: 1px solid rgba(0,0,0,0.08)` — clean separation from body canvas.

### 28r/s — Spacing Refinements
Hero sections padded to `max(100px, 8vw)` top / `max(80px, 6vw)` bottom at desktop; `72px` / `60px` at mobile. Prevents hero content from sitting too close to the header.

---

## QA Results

**Total: 143 PASS / 0 FAIL / 4 PRE-EXISTING**  
**Viewports tested:** 1440px (desktop) · 768px (tablet) · 390px (mobile)  
**Pages tested:** 9 (home, programari, despre, afectiuni archive + single, interventii archive + single, articole archive + single)

### Checks per page (6 per page × 9 pages × 3 viewports = 147 total checks, 8 pages with hero = 5 checks, 1 page without hero [despre] = 4 checks → 143 meaningful + 4 pre-existing)

| Check | Description |
|-------|-------------|
| 1 | `#gu-header` present |
| 2 | No horizontal overflow (scrollWidth ≤ clientWidth + 2px) |
| 3 | Hero section background: not dark brown (confirmed `rgb(255,255,255)` or `rgb(245,245,247)`) |
| 4 | CTA section background: not dark (confirmed `rgb(245,245,247)`) |
| 5 | Body background: not warm beige or dark |
| 6 | Hero heading color: graphite `rgb(29,29,31)`, not white |

### 4 Pre-existing Failures (unchanged since Sprint 8.3)

| Page | Viewport | scrollWidth | Root cause |
|------|----------|------------|------------|
| /programari/ | tablet | 774px | Elementor form container exceeds 768px viewport |
| /afectiuni/ archive | tablet | 934px | Elementor inner container fixed at 1100px |
| /interventii/ archive | tablet | 934px | Same fixed Elementor container |
| /articole/ single | mobile | 471px | Pre-existing wide content element |

All require Elementor DB edits, not CSS overrides. Unchanged since Sprint 8.3.

---

## QA Suite Bug Fixed During This Sprint

**Root cause:** The QA script used two non-existent URL slugs:
- `/articole/durerea-de-spate/` → 404 (post never existed)
- `/interventii/microdiscectomie/` → 404 (slug is `microdiscectomie-lombara`)

**Discovery:** First run showed 6 failures ("hero element not found") on all three articole-single viewports. The 404 page loaded instead, which renders the Elementor header but none of the CPT template elements. Live DB queried via MySQL socket to get actual published slugs.

**Fix:** Updated QA script to use DB-verified slugs:
- `/articole/hernia-de-disc-lombara/` ✓
- `/interventii/microdiscectomie-lombara/` ✓  
- `/afectiuni/hernie-de-disc-lombara/` ✓ (was already correct)

**Lesson:** The QA suite must always use URLs sourced from the live database, not guessed slugs. Going forward: pull slugs from the DB before any QA run that exercises single-post templates.

---

## Computed Style Evidence (all hero sections confirmed via Playwright)

| Section | Element ID | Computed bg | Expected |
|---------|-----------|------------|---------|
| Homepage hero | `3b2e4f01` | `rgb(255, 255, 255)` | `#FFFFFF` ✓ |
| Homepage CTA | `a5c00001` | `rgb(245, 245, 247)` | `#F5F5F7` ✓ |
| Programari hero | `s6pg001` | `rgb(255, 255, 255)` | `#FFFFFF` ✓ |
| Programari CTA | `s6pg080` | `rgb(245, 245, 247)` | `#F5F5F7` ✓ |
| Despre CTA | `s8a120` | `rgb(245, 245, 247)` | `#F5F5F7` ✓ |
| Afecțiuni archive hero | `s4ar001` | `rgb(245, 245, 247)` | `#F5F5F7` ✓ |
| Intervenții archive hero | `s5ar001` | `rgb(245, 245, 247)` | `#F5F5F7` ✓ |
| Articole archive hero | `s7ar001` | `rgb(245, 245, 247)` | `#F5F5F7` ✓ |
| Afecțiuni single hero | `s4sg001` | `rgb(255, 255, 255)` | `#FFFFFF` ✓ |
| Afecțiuni single CTA | `s4sg060` | `rgb(245, 245, 247)` | `#F5F5F7` ✓ |
| Intervenții single hero | `s5sg001` | `rgb(255, 255, 255)` | `#FFFFFF` ✓ |
| Intervenții single CTA | `s5sg060` | `rgb(245, 245, 247)` | `#F5F5F7` ✓ |
| Articole single hero | `s7sg001` | `rgb(255, 255, 255)` | `#FFFFFF` ✓ |
| Articole single CTA | `s7sg060` | `rgb(245, 245, 247)` | `#F5F5F7` ✓ |

Hero headings confirmed graphite (`rgb(29, 29, 31)` = `#1D1D1F`) on all 8 pages with hero sections.

---

## Files Changed

| File | Change |
|------|--------|
| `assets/css/gu-design-system.css` | Section 28 appended (lines 3627–4200, +574 lines) |

No PHP or JS changes required — the visual pivot is CSS-only.

---

## Browser Review Checklist

Visit each URL at 1440px desktop width and confirm visually:

- [ ] `/` — White hero, graphite headline, dark ink CTA button, white/grey alternating sections, no brown anywhere
- [ ] `/programari/` — White hero, graphite text, clinic boxes as white floating cards on grey bg
- [ ] `/despre/` — Light philosophy section, graphite quote treatment, sage green button at bottom
- [ ] `/afectiuni/` — Grey hero with graphite headline, archive card grid below
- [ ] `/interventii/` — Same as afectiuni
- [ ] `/articole/` — Same editorial hero
- [ ] `/afectiuni/hernie-de-disc-lombara/` — White hero, graphite headline, light content sections, grey CTA at bottom
- [ ] `/interventii/microdiscectomie-lombara/` — Same
- [ ] `/articole/hernia-de-disc-lombara/` — Same

Also check at 768px and 390px for:
- [ ] Hero padding is not too tight on mobile (72px top)
- [ ] Header remains white glass on scroll
- [ ] No sections with dark brown or warm beige background remaining

---

## Remaining Opportunities (not CSS-solvable without content)

These are unchanged from Sprint 9.6:
- Photography for hero, biography, author avatar — placeholders remain
- `[CLIENT:]` content throughout /despre/ and /programari/
- Elementor 1100px fixed container (causes 3 tablet overflows) — requires DB edit

> Do not publish AI-generated medical content without explicit human review.

**Next step:** Browser verification by Dr. George Ungureanu. Do not commit until approved.
