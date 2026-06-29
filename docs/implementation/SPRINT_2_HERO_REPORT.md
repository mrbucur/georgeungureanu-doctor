# Sprint 2 — Homepage Hero: Implementation Report

**Date:** 2026-06-29  
**Status:** Implemented — pending browser verification  
**Homepage post ID:** 38  
**URL:** `http://georgeungureanu-doctor-dev.local/`

---

## Overview

Implemented the Hero section of the homepage as the sole content on the WordPress front page. The homepage is a new `post_type=page` (ID=38, slug=`acasa`, title=`Acasă`) set as the WordPress static front page. The Elementor Theme Builder header (ID=9) and footer (ID=12) render automatically via their existing `include/general` conditions.

Photography is BLOCKING (Q7 in 05_HOMEPAGE.md). The right column shows a placeholder rectangle; the background is the dark ink color that will host the full-bleed photography overlay when photography is available.

---

## Hero Layout

```
Desktop (>1024px)  — row, 128px top/bottom padding
┌─────────────────────────────────────────────────────────────────────┐
│  section#organism-hero-homepage  bg:#231E1A (gu-ink)               │
│  128px ─────────────────────────────────────────────────────── 128px│
│  80px                                                          80px  │
│  ┌──────────────────────────────┐  ┌─────────────────────────────┐  │
│  │ TEXT COL (55% ≈ 60% after   │  │ PHOTO PLACEHOLDER (40%)     │  │
│  │ flex-shrink, desktop only)  │  │ bg:#2D2723, min-h:420px     │  │
│  │                             │  │ border-radius:8px           │  │
│  │ [H1] Neurochirurgie de      │  │                             │  │
│  │      precizie, centrată pe  │  │  "Fotografie Dr. George     │  │
│  │      recuperarea            │  │   Ungureanu"                │  │
│  │      dumneavoastră.         │  │  (dim placeholder label)    │  │
│  │ [body-lg] Consultații de    │  │                             │  │
│  │   specialitate...           │  │                             │  │
│  │ [Primary CTA] [Secondary]   │  │                             │  │
│  │ [Attribution]               │  │                             │  │
│  └──────────────────────────────┘  └─────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────────┘

Tablet/Mobile — stacks vertically, 80px top/bottom padding:
Text column (100% width) → Photo placeholder (100% width)
```

---

## Elementor Widget Tree

```
wp_posts ID=38  |  page  |  publish  |  slug: acasa
└─ [3b2e4f01] container — HERO OUTER
     html_tag=section, id="organism-hero-homepage"
     flex_direction: row (desktop), column (tablet)
     align_items: center
     bg: #231E1A (gu-ink via globals)
     padding: 128px 80px (desktop) | 80px 48px (tablet) | 80px 24px (mobile)
     gap_columns: 64px / gap_rows: 48px
     │
     ├─ [3b2e4f02] container — TEXT COLUMN
     │    flex_direction: column, align_items: flex-start
     │    width: 55% (desktop), 100% (tablet + mobile)
     │    gap_rows: 32px
     │    │
     │    ├─ [3b2e4f03] heading widget — H1 HEADLINE
     │    │    header_size: h1
     │    │    "Neurochirurgie de precizie, centrată pe recuperarea dumneavoastră."
     │    │    __globals__: typography=gu-h1, color=gu-surface
     │    │    direct fallback: #FDFBF7
     │    │    align: left
     │    │
     │    ├─ [3b2e4f04] text-editor — BODY-LG SUPPORTING TEXT
     │    │    "Consultații de specialitate, diagnostic și tratament neurochirurgical
     │    │     — alături de dumneavoastră la fiecare pas, de la evaluare la recuperare."
     │    │    __globals__: typography=gu-body-lg
     │    │    color: rgba(253,251,247,0.85) via §19 CSS override (see below)
     │    │
     │    ├─ [3b2e4f05] container — CTA BUTTONS ROW
     │    │    flex_direction: row, flex_wrap: wrap, gap: 16px
     │    │    ├─ [3b2e4f06] button — PRIMARY CTA
     │    │    │    "Programează o consultație" → /programari/
     │    │    │    bg: gu-accent (#4D7A70), text: gu-surface (#FDFBF7)
     │    │    │    padding: 14px 28px, border-radius: 4px
     │    │    │    __globals__: bg=gu-accent, text=gu-surface, typo=gu-cta
     │    │    │
     │    │    └─ [3b2e4f07] button — SECONDARY CTA (ghost, light on dark)
     │    │         "Află mai multe" → /afectiuni/
     │    │         bg: transparent, text: gu-surface (#FDFBF7)
     │    │         border: 1px solid gu-surface (#FDFBF7)
     │    │         padding: 14px 28px, border-radius: 4px
     │    │         __globals__: text=gu-surface, border=gu-surface, typo=gu-cta
     │    │
     │    └─ [3b2e4f08] text-editor — ATTRIBUTION
     │         "Dr. George Ungureanu — Medic Primar Neurochirurgie"
     │         color: rgba(253,251,247,0.85) via §19 CSS override
     │
     └─ [3b2e4f09] container — PHOTO PLACEHOLDER
          flex_direction: column, align_items: center, justify_content: center
          width: 40% (desktop), 100% (tablet + mobile)
          bg: #2D2723 (warm dark, clearly a placeholder)
          border-radius: 8px
          min_height: 420px (desktop), 320px (tablet), 260px (mobile)
          padding: 40px
          │
          └─ [3b2e4f0a] heading — PLACEHOLDER LABEL
               "Fotografie Dr. George Ungureanu"
               color: #4D4540 (barely visible — for dev use only)
               header_size: p, align: center
```

---

## CSS: §19 Added to gu-design-system.css

The hero section uses a dark (`color-ink`, #231E1A) background. The GU plugin's `§07` rule `p { color: var(--color-ink) }` (specificity 0,0,1) makes paragraph text inside `text-editor` widgets invisible on dark backgrounds — identical to the footer problem solved in Phase F.8 (§18).

**Root cause:** Elementor's text-editor widget sets color on the container `<div>`, not the `<p>`. The explicit `p {}` rule overrides inherited container colors regardless of specificity (explicit always beats inherited).

**Fix:** `§19` added to `gu-design-system.css` (before the §17 print section):

```css
#organism-hero-homepage .elementor-widget-text-editor,
#organism-hero-homepage .elementor-widget-text-editor p {
  color: rgba(253, 251, 247, 0.85) !important;
  opacity: 1 !important;
  visibility: visible !important;
}
```

- Scope: `#organism-hero-homepage` — the `_element_id` value on the outer hero container `[3b2e4f01]`
- Color: `rgba(253,251,247,0.85)` ≈ `gu-surface` (#FDFBF7) at 85% opacity over `gu-ink` background — per spec §3.3 "supporting text: color-surface at 85% opacity"
- Applies to: body-lg text `[3b2e4f04]` and attribution `[3b2e4f08]`
- Not needed for: heading widgets — `.elementor-heading-title` has specificity 0,2,0 and beats `p {}` (0,0,1)

**H1 heading widget contrast:** `__globals__.title_color = gu-surface` → Elementor generates `.elementor-element-3b2e4f03 .elementor-heading-title { color: var(--e-global-color-gu-surface) }` (specificity 0,2,0) → beats GU plugin's `h1 { color }` (0,0,1) → correct cream text on dark bg.

---

## WCAG Contrast

| Element | Foreground | Background | Contrast | WCAG AA |
|---------|-----------|-----------|----------|---------|
| H1 headline | `#FDFBF7` (gu-surface) | `#231E1A` (gu-ink) | 14.5:1 | Pass ✓ |
| Body-lg text | `rgba(253,251,247,0.85)` ≈ #D4D0CA | `#231E1A` | ~9.8:1 | Pass ✓ |
| Primary btn text | `#FDFBF7` (gu-surface) | `#4D7A70` (gu-accent) | 4.8:1 | Pass ✓ |
| Secondary btn text | `#FDFBF7` (gu-surface) | `transparent` / `#231E1A` | 14.5:1 | Pass ✓ |
| Attribution | `rgba(253,251,247,0.85)` ≈ #D4D0CA | `#231E1A` | ~9.8:1 | Pass ✓ |

---

## Database Changes

### New `wp_posts` row (homepage page)

| Field | Value |
|-------|-------|
| `ID` | 38 |
| `post_title` | `Acasă` |
| `post_status` | `publish` |
| `post_type` | `page` |
| `post_name` | `acasa` |
| `post_content` | (empty — Elementor uses `_elementor_data`) |

### New `wp_postmeta` rows (post_id=38)

| Meta key | Value |
|----------|-------|
| `_elementor_data` | Hero JSON (see widget tree above) |
| `_elementor_edit_mode` | `builder` |
| `_elementor_version` | `4.1.4` |
| `_wp_page_template` | `elementor_header_footer` |

> Note: No `_elementor_template_type` is set — this is a regular WordPress page, not a Theme Builder template. Theme Builder header/footer render via their existing `include/general` conditions regardless of page template.

### Updated `wp_options` rows

| Option | Before | After |
|--------|--------|-------|
| `show_on_front` | `posts` | `page` |
| `page_on_front` | `0` | `38` |

WordPress rewrite rules and Elementor transients were cleared to force regeneration on first request.

---

## Typography Tokens Used

| Element | Token | Value |
|---------|-------|-------|
| H1 headline | `gu-h1` | Lora 700 52px (44px tablet, 36px mobile) |
| Body-lg text | `gu-body-lg` | Inter 400 19px |
| Attribution | — | Inherits body (Inter 400 17px) — no body-sm token in kit |
| Primary CTA label | `gu-cta` | Inter 600 16px |
| Secondary CTA label | `gu-cta` | Inter 600 16px |

> **Note:** `type-body-sm` (13px, spec §3.3 for attribution) has no corresponding global token in the kit. `gu-body` (17px) is used as the closest available token. A `gu-body-sm` token can be added to the kit in a future typography pass.

---

## Content Placeholders

All text content is placeholder pending Dr. Ungureanu's input:

| Element | Placeholder | Spec constraint |
|---------|-------------|-----------------|
| H1 | "Neurochirurgie de precizie, centrată pe recuperarea dumneavoastră." | Patient-centered, no "Dr.", max 8-10 words |
| Body-lg | "Consultații de specialitate, diagnostic și tratament neurochirurgical — alături de dumneavoastră la fiecare pas, de la evaluare la recuperare." | Max 25 words |
| Photography | Dark placeholder rectangle | Q7 BLOCKING — full-bleed photography |

---

## Files Changed

| File | Change |
|------|--------|
| `wp_posts` (DB) | New row ID=38 — homepage page |
| `wp_postmeta` (DB) | 4 new rows for post_id=38 |
| `wp_options` (DB) | `show_on_front=page`, `page_on_front=38` |
| `gu-design-system.css` | §19 added — hero dark area paragraph override |

No header, footer, 404, or other pages were changed.

---

## Browser Verification Checklist

**URL:** `http://georgeungureanu-doctor-dev.local/`

### Structure
- [ ] Site header renders above the hero (navigation, logo, CTA button)
- [ ] Hero section fills the viewport with a dark (#231E1A) background
- [ ] Site footer renders below the hero (dark background, columns)

### Hero — Desktop (>1024px)
- [ ] Two-column layout: text on left (~55%), placeholder rectangle on right (~40%)
- [ ] 128px breathing space above and below hero content
- [ ] 64px gap between text column and photo placeholder column

### Hero — Tablet (≤1024px)
- [ ] Columns stack vertically: text above, photo placeholder below
- [ ] 80px padding top/bottom (reduced from desktop)
- [ ] Both columns are full width (100%)

### Hero — Mobile (≤767px)
- [ ] Single column, text then photo placeholder
- [ ] 80px padding, 24px horizontal padding
- [ ] H1 font size 36px (responsive gu-h1 token)
- [ ] Both CTAs wrap to new line if needed (flex-wrap: wrap)

### Typography and color
- [ ] H1 renders in Lora 700, cream (#FDFBF7), approximately 52px
- [ ] Body-lg text renders in Inter 400, warm cream (rgba 85% surface), approximately 19px — VISIBLE on dark background (§19 fix)
- [ ] "Programează o consultație" button — teal filled (#4D7A70), cream text, 4px radius
- [ ] "Află mai multe" button — transparent, cream text, cream border (1px solid)
- [ ] Attribution text visible below the CTAs

### Navigation
- [ ] "Programează o consultație" → navigates to `/programari/` (404 expected until page is built)
- [ ] "Află mai multe" → navigates to `/afectiuni/` (404 expected until page is built)

### No regressions
- [ ] Footer text visible (§18 CSS fix still active) — check `http://georgeungureanu-doctor-dev.local/#footer`
- [ ] 404 page still works on a non-existent URL (§G.1 fix still active)
- [ ] Header navigation links function normally

### DevTools (optional)
- `<section id="organism-hero-homepage">` should be the hero container
- `[3b2e4f01]` computed style → `background-color: rgb(35, 30, 26)` (#231E1A)
- `[3b2e4f03] .elementor-heading-title` → `color: var(--e-global-color-gu-surface)` = #FDFBF7
- `[3b2e4f04] p` → `color: rgba(253, 251, 247, 0.85)` (from §19 override)
- `[3b2e4f06]` button → `background-color: var(--e-global-color-gu-accent)` = #4D7A70
- `[3b2e4f07]` button → `background: transparent`, `border: 1px solid rgb(253,251,247)`

---

## Known Limitations / Future Steps

| Issue | Notes |
|-------|-------|
| Photography BLOCKING | Q7 must be resolved; full-bleed photography replaces the dark background. Overlay color: `rgba(35,30,26,0.65)` on image. |
| Copy is placeholder | H1 and body-lg need final Romanian copy from Dr. Ungureanu |
| `gu-body-sm` missing | Attribution should be 13px per spec; no token exists in kit yet |
| Secondary CTA target | `/afectiuni/` page does not exist yet (later sprint) |
| Primary CTA target | `/programari/` page does not exist yet (later sprint) |
| Elementor editor | Page not opened in Elementor editor — may need "Regenerate Files" to generate post-38.css |
