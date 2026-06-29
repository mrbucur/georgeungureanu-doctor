# 01 — Global Design System Setup

## georgeungureanu.doctor — Elementor Pro Manual Configuration Guide

**Governing source:** `docs/design-system/APPROVED_VISUAL_DIRECTION.md`
**Direction:** B+ — Warm Academic Medicine
**Prerequisite:** WordPress installed, Hello Elementor theme active, Elementor Pro active.
**Next step after this:** Prompt 02 — Atomic Component Library

---

## What This Document Covers

This document provides exact, step-by-step instructions for manually configuring the Elementor Pro global design system. Every value here is derived from `APPROVED_VISUAL_DIRECTION.md` and the updated design system files.

After completing all four steps in this document, the global design system will be fully configured. No template or page work happens until this is done and verified.

**Steps in order:**
1. Install the Custom CSS stylesheet
2. Configure Google Fonts
3. Configure Global Colors (14 colors)
4. Configure Global Typography (15 styles)

Do not skip or reorder these steps. Typography depends on fonts. Color tokens in the CSS depend on the CSS being installed first.

---

## Before You Begin

Verify the following before starting:

```
[ ] WordPress is installed and accessible at the domain
[ ] Hello Elementor theme is active (Appearance → Themes)
[ ] Elementor Pro is active and licensed (Elementor → License)
[ ] No other page builder plugins are active
[ ] Classic Editor plugin is NOT active (Gutenberg is fine but unused for pages)
[ ] Elementor's "Improved Asset Loading" experiment is OFF
    (Elementor → Settings → Experiments → Improved Asset Loading → Inactive)
    Reason: Some experiments affect how global CSS is applied. Disable until stable.
```

---

## Step 1 — Install the Custom CSS Stylesheet

**Navigate to:** Elementor → Site Settings → Custom CSS

Paste the entire contents of `elementor/custom.css` into the Custom CSS field.

Click **Save Changes**.

**What this does:**
- Defines all 14 color tokens as CSS custom properties (`--color-ink`, `--color-accent`, etc.)
- Defines all typography scale values as CSS custom properties
- Defines all spacing tokens as CSS custom properties
- Imports Lora and Inter from Google Fonts
- Sets base body styles, link styles, and focus ring
- Establishes text selection color, print styles, and accessibility utilities
- Creates the `.reading-column` class (max-width 700px, auto-centred) for educational content

**Verification after this step:**
- View any page on the frontend
- Open browser DevTools (F12) → Console → type `getComputedStyle(document.documentElement).getPropertyValue('--color-accent').trim()`
- Result should be `#4D7A70` (with a possible leading space — that is normal)
- If you see an empty string, the CSS is not loading — check Elementor's Custom CSS field was saved

---

## Step 2 — Configure Google Fonts

Elementor needs to know about Lora and Inter before they can be selected in the Global Typography interface.

**Navigate to:** Elementor → Site Settings → Typography → (any Global Font entry)

When setting up each Global Font in Step 4, Elementor's font picker will show Google Fonts. Both Lora and Inter are in the standard Google Fonts list. No manual font upload is needed.

However, the `@import` in `custom.css` already handles the actual font loading. This means:
- The fonts will render even if Elementor's font manager hasn't registered them yet
- Elementor's font manager registration ensures the fonts appear in widget dropdowns

**If Lora or Inter do not appear in Elementor's font picker:**
1. Go to Elementor → Tools → General → Regenerate Files & Data → Regenerate
2. Clear any caching plugin
3. Return to Site Settings and try the font picker again

---

## Step 3 — Configure Global Colors

**Navigate to:** Elementor → Site Settings → Global Colors

Add each color using the **+ Add Color** button. Enter the exact Display Label and Hex Value from the table below. The order of entry determines the order they appear in the Elementor color picker — enter them in the order shown.

**Important:** After entering all 14 colors, click **Save Changes** before leaving this panel.

---

### Group 1 — Primary Colors

Enter these five first. They are the most frequently used.

---

**Color 1**
```
Display Label:   Ink
Hex Value:       #231E1A
Usage:           Primary text — all headings, body text, navigation items
```

---

**Color 2**
```
Display Label:   Ink Secondary
Hex Value:       #5A4E47
Usage:           Secondary text — captions, metadata, labels, helper text
```

---

**Color 3**
```
Display Label:   Surface
Hex Value:       #FDFBF7
Usage:           Primary page background — warm cream (not pure white)
```

---

**Color 4**
```
Display Label:   Surface Warm
Hex Value:       #F4EFE6
Usage:           Alternating section backgrounds — deeper warm cream
```

---

**Color 5**
```
Display Label:   Surface Muted
Hex Value:       #EDE8DF
Usage:           Cards, callout boxes, subtle container fills
```

---

### Group 2 — Accent Colors

Enter these three next. The accent is the most critical design decision in the palette.

---

**Color 6**
```
Display Label:   Accent
Hex Value:       #4D7A70
Usage:           Primary CTAs, links, active navigation, focus rings
                 Deep muted sage-teal — the signature colour of this direction
```

---

**Color 7**
```
Display Label:   Accent Hover
Hex Value:       #3A5F57
Usage:           Hover state on all accent elements — buttons, links
```

---

**Color 8**
```
Display Label:   Accent Subtle
Hex Value:       #E4EDEB
Usage:           CTA banner backgrounds, featured content tints
```

---

### Group 3 — Supporting Colors

---

**Color 9**
```
Display Label:   Border
Hex Value:       #D6CFC4
Usage:           All border lines, horizontal rules, input field outlines
```

---

**Color 10**
```
Display Label:   Border Strong
Hex Value:       #BDB3A5
Usage:           Section dividers, emphasized separators
```

---

**Color 11**
```
Display Label:   Overlay
Hex Value:       #231E1A
Usage:           Photography overlay colour — apply at 80% opacity in Elementor
                 Note: The hex is the same as Ink. Opacity is set per-widget.
```

---

### Group 4 — Functional Colors

---

**Color 12**
```
Display Label:   Success
Hex Value:       #2D7046
Usage:           Form confirmation states, positive indicators
```

---

**Color 13**
```
Display Label:   Warning
Hex Value:       #A05A2C
Usage:           Important notices and alerts — use sparingly
```

---

**Color 14**
```
Display Label:   Error
Hex Value:       #B83030
Usage:           Form validation errors, critical notices
```

---

### Global Colors — Verification

After saving all 14 colors:

1. Open any page in the Elementor editor
2. Add a Heading widget to the canvas
3. In the widget's Style tab, click the text color swatch
4. Switch to the **Global** tab in the color picker
5. You should see all 14 colours listed with the Display Labels above
6. Verify: "Accent" shows a muted green-teal, "Ink" shows a warm near-black, "Surface" shows warm cream

If any color is missing, return to Site Settings → Global Colors and add the missing entry.

---

## Step 4 — Configure Global Typography

**Navigate to:** Elementor → Site Settings → Typography

Add each typography style using the **+ Add Style** button. Enter the exact values from each entry below. Every field matters — do not leave fields at their defaults if a value is specified.

**How Elementor's Typography fields map to CSS:**

| Elementor Field | CSS Property | Notes |
|----------------|-------------|-------|
| Title | (internal label) | Appears in widget dropdowns |
| Font Family | `font-family` | Select from Google Fonts list |
| Font Weight | `font-weight` | Select from dropdown |
| Size | `font-size` | Enter px value; set per breakpoint |
| Line Height | `line-height` | Enter as ratio (unitless) |
| Letter Spacing | `letter-spacing` | Enter in em; "0" means default |
| Text Decoration | `text-decoration` | Leave as "Default" unless specified |
| Text Transform | `text-transform` | "Uppercase" or "None" |
| Font Style | `font-style` | "Normal" or "Italic" |

After entering all 15 styles, click **Save Changes**.

---

### Heading Styles (H1–H6)

These use **Lora** for H1–H3 and **Inter** for H4–H6.

---

**Style 1**
```
Title:           H1 — Page Title
Font Family:     Lora
Font Weight:     700 (Bold)
Font Style:      Normal
Size (Desktop):  52px
Size (Tablet):   40px
Size (Mobile):   36px
Line Height:     1.15
Letter Spacing:  0
Text Transform:  None
Usage:           Page heroes, main page titles — one per page only
```

---

**Style 2**
```
Title:           H2 — Section Headline
Font Family:     Lora
Font Weight:     700 (Bold)
Font Style:      Normal
Size (Desktop):  38px
Size (Tablet):   32px
Size (Mobile):   28px
Line Height:     1.20
Letter Spacing:  0
Text Transform:  None
Usage:           All section headlines — the primary heading in every content section
```

---

**Style 3**
```
Title:           H3 — Subsection Headline
Font Family:     Lora
Font Weight:     400 (Regular)
Font Style:      Normal
Size (Desktop):  28px
Size (Tablet):   24px
Size (Mobile):   22px
Line Height:     1.25
Letter Spacing:  0
Text Transform:  None
Usage:           Subsection headings within content — condition details, FAQ groupings
                 Note: Regular weight (not Bold) — signals a secondary level calmly
```

---

**Style 4**
```
Title:           H4 — Card Headline
Font Family:     Inter
Font Weight:     600 (SemiBold)
Font Style:      Normal
Size (Desktop):  20px
Size (Tablet):   19px
Size (Mobile):   18px
Line Height:     1.30
Letter Spacing:  0
Text Transform:  None
Usage:           Card headings, named subsections, sidebar titles
                 Switches to Inter — functional voice rather than editorial
```

---

**Style 5**
```
Title:           H5 — Minor Heading
Font Family:     Inter
Font Weight:     600 (SemiBold)
Font Style:      Normal
Size (Desktop):  17px
Size (Tablet):   16px
Size (Mobile):   16px
Line Height:     1.35
Letter Spacing:  0
Text Transform:  None
Usage:           Minor headings, sidebar labels, detail section headers
```

---

**Style 6**
```
Title:           H6 — Micro Heading
Font Family:     Inter
Font Weight:     600 (SemiBold)
Font Style:      Normal
Size (Desktop):  15px
Size (Tablet):   14px
Size (Mobile):   14px
Line Height:     1.40
Letter Spacing:  0
Text Transform:  None
Usage:           Metadata headings, table column headers
```

---

### Body Styles

---

**Style 7**
```
Title:           Body Large
Font Family:     Inter
Font Weight:     400 (Regular)
Font Style:      Normal
Size (Desktop):  19px
Size (Tablet):   18px
Size (Mobile):   17px
Line Height:     1.75
Letter Spacing:  0
Text Transform:  None
Usage:           Lead/introductory paragraph at the start of each section
                 The most important sentence in a section is set in this style
```

---

**Style 8**
```
Title:           Body
Font Family:     Inter
Font Weight:     400 (Regular)
Font Style:      Normal
Size (Desktop):  17px
Size (Tablet):   17px
Size (Mobile):   16px
Line Height:     1.70
Letter Spacing:  0
Text Transform:  None
Usage:           Standard body text — the default for all paragraph content
                 Never smaller than 16px on mobile. Line height is non-negotiable.
```

---

**Style 9**
```
Title:           Body Small
Font Family:     Inter
Font Weight:     400 (Regular)
Font Style:      Normal
Size (Desktop):  15px
Size (Tablet):   15px
Size (Mobile):   15px
Line Height:     1.65
Letter Spacing:  0
Text Transform:  None
Usage:           Secondary body text, annotations, supplementary information
```

---

### Special / UI Styles

---

**Style 10**
```
Title:           Pull Quote
Font Family:     Lora
Font Weight:     400 (Regular)
Font Style:      Italic
Size (Desktop):  24px
Size (Tablet):   22px
Size (Mobile):   20px
Line Height:     1.45
Letter Spacing:  0
Text Transform:  None
Usage:           Patient testimonials, doctor philosophy statements, key insights
                 Lora italic at this size is the warmest typographic element on the site
```

---

**Style 11**
```
Title:           Overline
Font Family:     Inter
Font Weight:     600 (SemiBold)
Font Style:      Normal
Size (Desktop):  12px
Size (Tablet):   11px
Size (Mobile):   11px
Line Height:     1.40
Letter Spacing:  0.08em   ← Enter as "0.08" in the em field
Text Transform:  Uppercase
Usage:           Section label above H2 headlines — e.g. "Ce tratăm" above "Condiții tratate"
                 Always short: 2–4 words maximum
```

---

**Style 12**
```
Title:           Label
Font Family:     Inter
Font Weight:     600 (SemiBold)
Font Style:      Normal
Size (Desktop):  13px
Size (Tablet):   13px
Size (Mobile):   13px
Line Height:     1.40
Letter Spacing:  0.02em   ← Enter as "0.02" in the em field
Text Transform:  None
Usage:           Form labels, category tags, badge text
```

---

**Style 13**
```
Title:           Caption
Font Family:     Inter
Font Weight:     400 (Regular)
Font Style:      Normal
Size (Desktop):  13px
Size (Tablet):   12px
Size (Mobile):   12px
Line Height:     1.50
Letter Spacing:  0
Text Transform:  None
Usage:           Image captions, footnotes, dates, publication references
```

---

**Style 14**
```
Title:           CTA Button
Font Family:     Inter
Font Weight:     600 (SemiBold)
Font Style:      Normal
Size (Desktop):  16px
Size (Tablet):   15px
Size (Mobile):   15px
Line Height:     1.0
Letter Spacing:  0
Text Transform:  None
Usage:           All button labels — primary, secondary, ghost
```

---

**Style 15**
```
Title:           Navigation
Font Family:     Inter
Font Weight:     500 (Medium)
Font Style:      Normal
Size (Desktop):  15px
Size (Tablet):   15px
Size (Mobile):   15px
Line Height:     1.0
Letter Spacing:  0
Text Transform:  None
Usage:           Main navigation items, footer navigation links
```

---

### Global Typography — Verification

After saving all 15 styles:

1. Open any page in the Elementor editor
2. Add a Heading widget
3. In the Style tab → Typography → click the typography control
4. Select "Global Typography" at the top of the panel
5. All 15 styles should appear in the dropdown with the exact titles above
6. Select "H1 — Page Title" and verify:
   - Font shows "Lora"
   - Size shows "52" on Desktop view
   - Weight shows "700 Bold"

---

## Spacing Reference Card

This card is used alongside Elementor's spacing inputs (padding, margin, gap). All values are multiples of the 8px base unit. Enter the pixel value directly into Elementor's spacing field.

| Token | Pixels | Primary Elementor Usage |
|-------|--------|------------------------|
| `space-1` | 4px | Micro: icon-to-label gap, badge inner padding |
| `space-2` | 8px | Tight: list item gaps, form internals |
| `space-3` | 12px | Small: label-to-input gap, icon-to-text gap |
| `space-4` | 16px | Standard: paragraph spacing, button vertical padding |
| `space-5` | 20px | Medium: small section margins, card padding mobile |
| `space-6` | 24px | Standard component: card padding, nav item gap |
| `space-8` | 32px | Section element: heading-to-body, nav-to-CTA |
| `space-10` | 40px | Section internal: between subcomponents |
| `space-12` | 48px | Section padding mobile top/bottom |
| `space-16` | 64px | Section padding desktop (standard) |
| `space-20` | 80px | Section padding desktop (large / prominent) |
| `space-24` | 96px | Section padding desktop (generous / editorial) |
| `space-32` | 128px | Hero section padding desktop only |

### Component Spacing Quick-Reference

| Component | Top/Bottom | Left/Right | Gap | Notes |
|-----------|-----------|-----------|-----|-------|
| Button (primary) | 15px | 32px | — | From APPROVED_VISUAL_DIRECTION.md §05 |
| Button (secondary) | 14px | 30px | — | Slightly less padding for visual distinction |
| Card (mobile) | 24px | 24px | 16px | Between card elements |
| Card (desktop) | 32px | 32px | 16px | Between card elements |
| Form field | 16px | 20px | — | Internal padding |
| Form field gap | — | — | 24px | Between fields |
| Nav item gap | — | — | 24px | Desktop only |
| Section (mobile) | 48px | 24px | — | Top/bottom, left/right |
| Section (desktop) | 80px | 32px–40px | — | Top/bottom, left/right |
| Section hero | 128px | 32px–40px | — | Desktop only |
| Content max-width | — | auto | — | 1200px |
| Reading column | — | auto | — | 700px (68 chars) |

### The Spacing Rule

When in doubt between two spacing values, choose the larger. Space creates calm. Compression creates anxiety.

---

## Site Settings — Additional Required Configuration

These settings in Elementor → Site Settings must also be configured before building components.

### Site Identity

**Navigate to:** Elementor → Site Settings → Site Identity

```
Site Name:     Dr. George Ungureanu
Tag Line:      Neurochirurgie   (or leave empty — do not put a marketing tagline)
Site Icon:     [upload favicon when available]
```

### Layout

**Navigate to:** Elementor → Site Settings → Layout

```
Content Width:       1200    (px)
Columns Gap:         32      (px) — matches space-8
```

### Lightbox

**Navigate to:** Elementor → Site Settings → Lightbox

```
Disable Default Lightbox:   Yes
```
Reason: The default Elementor lightbox is not needed and adds unnecessary JavaScript.

### Breakpoints

**Navigate to:** Elementor → Site Settings → Layout → Breakpoints (or Elementor → Settings → Experiments if using custom breakpoints)

```
Mobile:     767px and below
Tablet:     768px – 1024px
Desktop:    1025px and above
```

These match the breakpoints defined in `ELEMENTOR_IMPLEMENTATION_RULES.md`.

### Page Transitions

**Navigate to:** Elementor → Site Settings → Page Transitions (if available)

```
Disable all page transition effects.
```
Reason: Page transitions conflict with the `prefers-reduced-motion` accessibility requirement and add visual noise inappropriate for a medical website.

---

## Elementor Experiments — Required Settings

**Navigate to:** Elementor → Settings → Experiments

```
Container (Flexbox):            Active   ← CRITICAL — enables Flexbox Containers
Improved Asset Loading:         Inactive ← Keep off for stability
Improved CSS Loading:           Active   ← Performance improvement
Optimized DOM Output:           Active   ← Performance improvement
Additional Custom Breakpoints:  Inactive ← Not needed
```

The Container (Flexbox) experiment must be Active. The entire component architecture depends on it. If this is shown as "Stable" rather than "Experiment," it has been fully released — keep it active.

---

## WordPress Settings Required

These WordPress settings should be verified before building in Elementor.

**Navigate to:** Settings → Permalinks
```
Structure: Post name   (/sample-post/)
```
Save permalinks after any change.

**Navigate to:** Settings → General
```
Language:    Romanian   (if targeting Romanian patients as primary audience)
Timezone:    Bucharest
```

**Navigate to:** Settings → Reading
```
Search Engine Visibility:   Unchecked   (ensure site is public)
```

---

## Full Verification Checklist

Complete this checklist before declaring Step 1 (Global Design System) done.

### CSS Variables
```
[ ] Custom CSS pasted and saved in Elementor → Site Settings → Custom CSS
[ ] --color-accent returns #4D7A70 in browser DevTools
[ ] --color-surface returns #FDFBF7 in browser DevTools
[ ] --color-ink returns #231E1A in browser DevTools
[ ] Lora font loading confirmed in browser DevTools Network tab (lora.woff2 request)
[ ] Inter font loading confirmed in browser DevTools Network tab
```

### Global Colors
```
[ ] All 14 colors entered in Elementor → Site Settings → Global Colors
[ ] Colors appear in the "Global" tab of Elementor's color picker
[ ] "Accent" (#4D7A70) is visually a muted sage-teal — not blue, not green
[ ] "Surface" (#FDFBF7) is visually a warm cream — not pure white
[ ] "Ink" (#231E1A) is visually a warm near-black — not navy, not pure black
[ ] No two colors look identical in the picker
```

### Global Typography
```
[ ] All 15 styles entered in Elementor → Site Settings → Typography
[ ] H1 uses Lora 700 at 52px desktop
[ ] H3 uses Lora 400 (Regular — not Bold) at 28px desktop
[ ] H4 switches to Inter 600 — confirms the Lora/Inter role boundary
[ ] Body style shows Inter 400, 17px, line-height 1.70
[ ] Body Large shows Inter 400, 19px, line-height 1.75
[ ] Pull Quote shows Lora 400 Italic, 24px
[ ] Overline shows Inter 600, 12px, Uppercase, 0.08em letter-spacing
[ ] Navigation shows Inter 500 (Medium) — not 600
```

### Site Settings
```
[ ] Content width set to 1200px
[ ] Container (Flexbox) experiment is Active
[ ] Improved Asset Loading is Inactive
[ ] Site name and tagline correct
[ ] Default Elementor lightbox disabled
```

---

## Common Errors and Fixes

| Error | Likely Cause | Fix |
|-------|-------------|-----|
| Fonts not loading | @import blocked by caching plugin | Clear all cache; ensure CSS is not minified in a way that breaks @import |
| Lora not in font picker | Elementor hasn't registered it | Regenerate files in Elementor → Tools, then refresh |
| Global colors not appearing | CSS saved but panel not refreshed | Save, then close and reopen Elementor editor |
| Accent colour looks blue | Wrong hex entered | Verify #4D7A70 — it should read as green-teal, not blue |
| Body text too small | Elementor default overriding | Check no theme CSS sets smaller base font — Hello Elementor is neutral but verify |
| H3 looks too similar to H4 | H3 should be Lora Regular, H4 is Inter SemiBold | Confirm H3 is Lora family (serif) and H4 is Inter (sans) — they should look clearly different |

---

## What Comes Next

Once this checklist is fully complete, the global design system is configured. Every component built in Prompt 02 will inherit these settings automatically.

**Proceed to:** `docs/prompts/02_ATOMIC_COMPONENT_LIBRARY.md`

Do not build any components before this step is complete and verified. A component built before Global Colors or Typography are configured will have locally-set styles that cannot be replaced by the global system without rebuilding the component.
