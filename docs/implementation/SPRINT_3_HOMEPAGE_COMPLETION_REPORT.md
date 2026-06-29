# Sprint 3 — Homepage Completion Report

**Date:** 2026-06-29
**Status:** COMPLETE ✓
**Sections delivered:** Doctor Introduction / Trust block, Specializations grid (6 cards), Why choose Dr. George Ungureanu, Final CTA section

---

## Sections Implemented

### Section 2 — Doctor Introduction / Trust block (`#organism-intro-doctor`)
- Two-column row (photo left 42%, text right 53%) — collapses to single column at tablet
- Photo placeholder with muted surface background (#EDE8DF), 8px border-radius, 500px min-height desktop
- Text column: overline, H2 in Lora 38px, body text in Inter 17px (19px via `.lead-paragraph`), horizontal stats row
- **Trust stats row:** Three stat cells — "15+ Ani de practică neurochirurgicală", "2.000+ Intervenții neurochirurgicale", "98% Satisfacție declarată de pacienți"
  - Stats number: Lora 44px, accent teal (#4D7A70)
  - Stats label: Inter 17px, ink color
  - Top border (#D6CFC4) separates stats from body text
  - **Desktop/Tablet:** 3 horizontal cells at 30% width each, flex-grow distributes remaining space
  - **Mobile:** Each stat stacks to 100% width

### Section 3 — Specializations Grid (`#organism-specializations`)
- Background: warm surface (#F4EFE6)
- Section header (reading-column constrained to 700px, centered) with overline, H2, body text
- 6 specialty cards in a 3×2 grid (desktop), 2×3 (tablet), 1×6 (mobile)
- Card width: 31% desktop, 46% tablet, 100% mobile — white (#FDFBF7) background with 1px #D6CFC4 border, 8px radius
- Card heading: Lora 22px, body: Inter 17px
- Specialties: Tumori cerebrale, Hernie de disc și patologie vertebrală, Neurochirurgie vasculară, Hidrocefalie, Patologie de coloană, Neurochirurgie funcțională

### Section 4 — Why Choose (`#organism-why-choose`)
- Background: surface (#FDFBF7)
- Section header (700px centered) with overline, H2, body text
- 4 reason cards in a 2×2 grid (desktop + tablet), 1×4 (mobile)
- Card width: 47% (desktop + tablet), 100% (mobile) — teal-subtle (#E4EDEB) background
- Each card: numbered overline (01–04), heading in Lora 22px, body in Inter 17px
- Reasons: Tehnici minim-invazive, Evaluare personalizată, Continuitate terapeutică, Formare internațională

### Section 5 — CTA (`#organism-cta-appointment`)
- Background: ink (#231E1A) — dark section
- Content: overline, H2 "Programați o consultație astăzi", body text, cream button "Programează acum"
- H2: Lora 38px, cream (#FDFBF7) — set via direct `title_color` in JSON
- Body text: cream at 85% opacity — applied via §20 CSS since `_css_classes:"section-dark"` does not render from direct DB JSON
- Button: cream background (#FDFBF7), ink text (#231E1A), 4px radius, 14/28px padding

---

## Key Technical Discoveries

### Elementor Container `content_width` Architecture
- `content_width:"boxed"` (default) → `e-con-boxed` → outer element hardcodes `flex-direction:column`; the `.e-con-inner` wrapper applies `flex-direction: var(--flex-direction)`, `width:100%`
- `content_width:"full"` → `e-con-full` → outer element IS the flex container; `flex-direction: var(--flex-direction)` applies directly
- **Rule:** Any flex-row layout must set `content_width:"full"` on both the row container AND the child containers

### Flex Sizing in Row Containers
- `flex-wrap:wrap` prevents flex-shrink — items wrap to new lines instead of compressing
- `flex-basis:auto` without explicit width = fill-available (full row width), causing each stat to wrap to its own line
- **Fix:** Set explicit `width:30%` on stat containers. Preferred size = 30%, flex-grow distributes the remaining 10% equally. All 3 cells fit without wrapping.
- `_flex_size:"grow"` in JSON → `--flex-grow:1; --flex-shrink:0` (generates via Group_Control_Flex_Item, group name `_flex`)

### `_css_classes` from Direct DB JSON
- Setting `_css_classes:"section-dark"` in `_elementor_data` via direct DB edit does NOT render the class in the HTML element's `class` attribute
- Elementor processes `prefix_class` controls during PHP render, but `_css_classes` is not applied for containers from raw JSON edits
- **Workaround:** Target the section's `_element_id` in CSS directly (`#organism-cta-appointment p { color: ... }`)

### `__globals__` Blocks CSS Generation
- When `__globals__.title_color` or `__globals__.typography_typography` is present on a heading widget, Elementor attempts a global variable lookup. If the global fails silently, no CSS is generated — the computed property remains at the browser default.
- **Fix:** Remove all `__globals__` entries; use direct hex values and `typography_typography:"custom"` with inline font settings

### Inter Font in Text-Editor Widgets
- Elementor's `--e-global-typography-text-font-family` resolves to `system-ui` unless the kit's "text" system typography is explicitly mapped to Inter
- `.elementor-widget-text-editor` inherits this variable, overriding the body's Inter font
- **Fix added to §20 of gu-design-system.css:** `.elementor-widget-text-editor p { font-family: var(--font-sans) }` (specificity 0,1,1 overrides inherited system-ui)

---

## Playwright Verification Results

### Desktop (1440px)
| Check | Result |
|---|---|
| Hero section | ✓ dark bg, Lora H1 cream, teal CTA |
| Intro section | ✓ 692px height, photo+text row, 3 stats horizontal |
| Specializations | ✓ warm bg, 6 cards in 3×2 grid |
| Why choose | ✓ surface bg, 4 reasons in 2×2 grid |
| CTA | ✓ dark bg, cream H2, cream body (rgba(253,251,247,0.85)) |
| Footer | ✓ visible, no overlap |

### Tablet (768px)
| Check | Result |
|---|---|
| Intro | ✓ column layout, H2 32px, stats horizontal 3-up |
| Specializations | ✓ 2×3 grid (46% card width) |
| Why choose | ✓ 2×2 grid |
| CTA H2 | ✓ 32px cream |
| CTA body | ✓ rgba(253,251,247,0.85) |

### Mobile (390px)
| Check | Result |
|---|---|
| Intro | ✓ H2 28px, all stacked |
| Stats | ✓ each stat 100% width, stacked vertically |
| Specializations | ✓ 1×6 (100% card width) |
| Why choose | ✓ 1×4 reasons stacked |
| CTA H2 | ✓ 28px cream |
| CTA body | ✓ cream 85% opacity |

---

## Files Changed

### WordPress DB (`wp_postmeta`, post_id=38, `_elementor_data`)
- Added 4 new sections (a2i, a3s, a4w, a5c element trees) to the Elementor JSON
- Fixed `content_width:"full"` on: a2i00008 (stats row), a2i00009/12/15 (stat containers), a3s00006 (spec grid), a4w00006 (why grid)
- Set `width:30%` / `width_mobile:100%` on stat containers for correct flex sizing
- Set `_flex_size:"grow"` on stat containers

### `gu-design-system.css` (§20 additions)
```css
/* Default Inter for text-editor widgets */
.elementor-widget-text-editor p { font-family: var(--font-sans); }

/* CTA dark section cream text */
#organism-cta-appointment .elementor-widget-text-editor p {
  color: rgba(253, 251, 247, 0.85) !important;
}

/* Section header reading-column constraint */
.elementor-element-a3s00002,
.elementor-element-a4w00002 { max-width: 700px !important; margin: 0 auto !important; }
```
