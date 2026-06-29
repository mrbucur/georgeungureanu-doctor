# Color System

## georgeungureanu.doctor — Direction B+: Warm Academic Medicine

**Status: Approved. Updated from Phase 1 draft to reflect Direction B+ selection.**
See `APPROVED_VISUAL_DIRECTION.md` and `VISUAL_DIRECTIONS.md` for context.

---

## Philosophy

The palette is built on a single foundational insight: a frightened patient forms an emotional impression before reading a single word. Color temperature is felt, not read. The palette must do emotional work before the content does cognitive work.

Direction B+ uses warm neutrals as its foundation — backgrounds that read as cream rather than clinical white, ink that reads as warm near-black rather than cold navy. Against this warm foundation, the accent is a deep muted sage-teal: calm, unexpected in a medical context, professional without being pharmaceutical, and carrying none of the associations of institutional blue.

The palette draws from: quality paper, natural materials, the consultation room of a thoughtful practitioner, and the color language of institutions that have earned trust through care rather than signage.

---

## Global Color Palette

All colors are defined as Elementor Global Colors. No local color overrides are permitted under any circumstances.

### Primary Colors

| Token Name | Hex | Usage |
|-----------|-----|-------|
| `color-ink` | `#231E1A` | Primary text, headlines, navigation, all body content |
| `color-ink-secondary` | `#5A4E47` | Secondary text, captions, metadata, labels |
| `color-surface` | `#FDFBF7` | Primary background — warm cream, not clinical white |
| `color-surface-warm` | `#F4EFE6` | Alternate section background — deeper warm cream |
| `color-surface-muted` | `#EDE8DF` | Card backgrounds, callout boxes, subtle fills |

### Accent Colors

| Token Name | Hex | Usage |
|-----------|-----|-------|
| `color-accent` | `#4D7A70` | Primary CTAs, links, active nav states, focus rings |
| `color-accent-hover` | `#3A5F57` | Hover state for all accent elements |
| `color-accent-subtle` | `#E4EDEB` | Accent background tints, highlighted sections, pull-out boxes |

### Supporting Colors

| Token Name | Hex | Usage |
|-----------|-----|-------|
| `color-border` | `#D6CFC4` | Borders, dividers, input outlines — warm taupe |
| `color-border-strong` | `#BDB3A5` | Emphasized borders, section dividers |
| `color-overlay` | `#231E1ACC` | Dark overlay on photography sections — warm, not cold |

### Functional Colors

| Token Name | Hex | Usage |
|-----------|-----|-------|
| `color-success` | `#2D7046` | Confirmation states, positive indicators |
| `color-warning` | `#A05A2C` | Important notices — warm amber, used sparingly |
| `color-error` | `#B83030` | Form errors, critical notices |

---

## Color Roles

### Background Hierarchy

```
color-surface          →  Primary page background (warm cream — #FDFBF7)
color-surface-warm     →  Alternating sections (deeper cream — #F4EFE6)
color-surface-muted    →  Cards, callout boxes, subtle containers (#EDE8DF)
color-accent-subtle    →  Featured content, CTA banner backgrounds (#E4EDEB)
color-ink              →  Dark hero sections, footer, impact moments (#231E1A)
```

### Text Hierarchy

```
color-ink              →  H1, H2, H3, all primary body text
color-ink-secondary    →  H4, H5, H6, secondary body, captions, labels, metadata
color-accent           →  Links, active interactive elements
color-surface          →  All text on dark (color-ink) backgrounds
```

### Interactive Elements

```
color-accent           →  Button background (default), link text, active nav
color-accent-hover     →  Button background (hover), link (hover)
color-border           →  Input field borders (default state)
color-accent           →  Input field borders (focused state)
color-error            →  Input field borders (error state)
```

---

## Color Usage Rules

### Rule 1: Never Use Local Color Overrides

Every color used anywhere in Elementor must be selected from the Global Color palette — never entered as a hex value directly into a widget. If a needed color does not exist in the palette, add it to the global palette with a proper token name and update this document first.

### Rule 2: Protect the Accent

`color-accent` (`#4D7A70`) is the most carefully chosen element in this palette. It is used for the primary interactive element on a section — one CTA button, one key link, one active navigation state. It signals "take action here." It is not used for decoration, illustration, or emphasis. Every unnecessary use of the accent dilutes its signal.

### Rule 3: Warm Dark Backgrounds Are Used Deliberately

Dark sections using `color-ink` as background are reserved for:
- Hero sections with photography overlays
- Pull-quote or impact statement moments
- Footer
- Maximum two sections per page

The warm near-black (`#231E1A`) is categorically different from a cool navy. On photography, the warm overlay reads as intimate and present, not institutional and cold.

### Rule 4: The Cream Backgrounds Must Alternate Perceptibly

`color-surface` (`#FDFBF7`) and `color-surface-warm` (`#F4EFE6`) are close in value. On uncalibrated monitors, they may appear nearly identical. Section rhythm must also be communicated through spacing and content structure — do not rely on color distinction alone. Add subtle borders or spacing increases at section transitions if the color shift is insufficient.

### Rule 5: Color Alone Never Conveys Information

No information that is communicated by color must rely on color alone. Form errors use both `color-error` and an error icon plus error text. Active navigation uses both `color-accent` and a typographic indicator. Status indicators use both color and a label.

### Rule 6: No Additional Colors Without Documentation

Do not introduce any color not listed in this palette. If a design genuinely requires a new color, document the token name, hex value, usage rule, and rationale here before adding it to the Elementor global palette.

---

## Section Background Rhythm

Pages use alternating backgrounds to create visual rhythm and section separation.

```
Section 1:  color-surface        (#FDFBF7) — warm cream
Section 2:  color-surface-warm   (#F4EFE6) — deeper warm cream
Section 3:  color-surface        (#FDFBF7)
Section 4:  color-surface-muted  (#EDE8DF) — for card-heavy or callout sections
Section 5:  color-surface-warm   (#F4EFE6)
...
Dark section (hero, quote, footer): color-ink (#231E1A) — used at most twice per page
```

The warmth of these backgrounds is cumulative. A patient scrolling through a page does not consciously notice the cream — but they feel it. The absence of harsh white reduces eye fatigue for patients reading long condition descriptions at night on a bright screen.

---

## What to Avoid

| Avoid | Reason |
|-------|--------|
| Pure white backgrounds (`#FFFFFF`) | Too clinical; removes the warmth that distinguishes this direction |
| Cool grey backgrounds (`#F0F0F0`, `#EEEEEE`) | Undermines the warm palette; conflicts with Direction B+ philosophy |
| Institutional or corporate blue (any hue around `#0078D4`, `#2563EB`) | Signals generic healthcare, not a personal practice |
| Pharmaceutical green or teal that reads light | The accent must stay dark and muted — lightening it breaks the system |
| Warm orange or amber accent | Too active, too energetic for this emotional register |
| Pure black text (`#000000`) | Harsh against warm cream; use `color-ink` (`#231E1A`) |
| Bright saturated secondary colors | The palette is intentionally restrained; complexity here creates anxiety |

---

## Palette Rationale

**`color-ink` (`#231E1A`)** — A warm near-black with a slight brown inflection. Reads as ink on good-quality paper rather than a digital screen imposing black on white. At this value, it is clearly dark — fully legible, high contrast — but it does not create the visual tension of pure black against cream.

**`color-accent` (`#4D7A70`)** — A deep muted sage-teal. This is the most deliberate decision in the palette and must be understood precisely. It is:
- Dark enough to carry professional gravity (not a spa or wellness green)
- Muted enough to avoid visual energy that would create anxiety
- Warm enough to belong in the warm cream environment
- Uncommon enough in medical design to be immediately distinctive
- Calm enough to invite action without demanding it

When a patient sees this accent on a button that says "Book a consultation," they should feel invited — not pushed.

**`color-surface` (`#FDFBF7`)** — Off-white with a trace of warmth. Not cream in a stylized sense — subtle enough to be perceived as "white" but with the emotional register of warmth. Like reading a document printed on quality paper rather than copy paper.

**`color-surface-warm` (`#F4EFE6`)** — The alternating background. Perceptibly warmer — the kind of surface that says "this is a considered environment." Together with `color-surface`, the alternating backgrounds create a room-like sense of moving through distinct but connected spaces.

Together, this palette says: *this is a warm, serious, considered place. A person who cares about you works here.*
