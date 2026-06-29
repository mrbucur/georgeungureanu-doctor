# Elementor Implementation Rules

## georgeungureanu.doctor

---

## Overview

These rules govern how Elementor Pro is configured and used throughout this project. They are non-negotiable constraints that ensure the design system remains consistent, maintainable, and scalable. Every future prompt, template, or implementation decision must respect these rules.

---

## Elementor Version and Setup

- **Elementor Pro** is required (not Elementor Free)
- Theme: **Hello Elementor** — no modifications to the theme files
- The Hello Elementor theme is used precisely because it contributes zero styling of its own — Elementor Pro controls 100% of the visual output
- WordPress editor (Gutenberg) is not used for any content pages

---

## Container Rules (Critical)

### Rule: Flexbox Containers Only

This project uses **Elementor Flexbox Containers** exclusively.

- Do NOT use legacy Sections/Columns
- Do NOT use the classic "Section > Column > Widget" structure
- Every layout is built with `Container > Container > Widget` using Flexbox
- This is an irreversible architectural decision — mixing the two models breaks consistency

### Container Nesting Convention

```
Page
└── Container (outer / section-level)       → full-width, sets background + padding
    └── Container (inner / content-width)   → max-width constrained (1200px)
        └── Container (row / column)        → flex row or column for layout
            └── Widget                      → actual content element
```

### Container Direction Defaults

- Outer containers: `direction: column`
- Row containers: `direction: row`
- Always set `align-items` and `justify-content` explicitly — never rely on defaults

---

## Global Colors — Mandatory

### Rule: Global Colors Only

Every color value used anywhere in Elementor must be a **Global Color** selection, not a manually entered hex value.

- In the Elementor color picker, always use the "Global" tab
- Never type hex values in color fields
- If a needed color does not exist in the global palette, stop and add it to the palette first

### Global Color Setup

Global Colors are configured at: **Elementor → Site Settings → Global Colors**

Color token names must exactly match the names in `COLOR_SYSTEM.md`:
```
color-ink
color-ink-secondary
color-surface
color-surface-warm
color-surface-muted
color-accent
color-accent-hover
color-accent-subtle
color-border
color-border-strong
color-overlay
color-success
color-warning
color-error
```

---

## Global Typography — Mandatory

### Rule: Global Typography Only

Every text element uses a **Global Typography** style, not locally-set font properties.

- In any widget's typography settings, always select from "Global Typography"
- Never set font family, font size, font weight, or line-height locally
- If a text style is needed that doesn't have a global token, create one

### Global Typography Setup

Global Fonts are configured at: **Elementor → Site Settings → Global Fonts**

Font token names must exactly match the names in `TYPOGRAPHY_SYSTEM.md`:
```
type-h1 through type-h6
type-body-lg
type-body
type-body-sm
type-label
type-caption
type-cta
type-nav
type-quote
type-overline
```

---

## Template and Widget Naming

### Rule: Systematic Naming

All saved templates, global widgets, and named containers follow the naming convention from `ATOMIC_DESIGN_RULES.md`:

```
atom-[name]          — atomic elements saved as global widgets
molecule-[name]      — molecule templates
organism-[name]      — organism templates (saved as global sections)
template-[page-type] — page templates
```

### Why This Matters

Elementor's template library becomes unmanageable quickly without consistent naming. Future edits, audits, or handoffs require understanding what everything is from the name alone.

---

## Custom CSS Rules

### Rule: No Widget-Level Custom CSS

Do not add custom CSS in Elementor's "Custom CSS" field on individual widgets, containers, or sections in the standard implementation.

If CSS customization is needed:
1. First, verify it cannot be achieved with Elementor controls
2. If it truly cannot, add it to a **dedicated Custom CSS section** in the Elementor global stylesheet, documented with a comment explaining why
3. Never add CSS to individual widget fields — this creates invisible, unmaintainable overrides

### Rule: No Inline Styles in Widget Fields

The "Style" tab in Elementor widgets should be used for Global Colors and Global Typography only. Do not use it for one-off visual tweaks.

---

## Responsive Design Rules

### Breakpoints

| Breakpoint | Width | Elementor Setting |
|-----------|-------|------------------|
| Mobile Portrait | <768px | Mobile |
| Mobile Landscape | 768px | Tablet |
| Tablet | 1024px | Tablet |
| Desktop | 1025px+ | Desktop |

Note: Elementor's "Tablet" breakpoint covers both tablet and mobile landscape here.

### Mobile-First Application

- Set all values at Mobile breakpoint first
- Override upward at Tablet and Desktop
- This is the opposite of legacy web development but correct for modern Elementor workflow
- Elementor displays mobile values at mobile sizes and desktop values override down; set from smallest first

### Responsive Visibility

- Use Elementor's responsive visibility controls (not CSS display:none)
- Never hide elements from screen readers — only use visual hide
- Mobile navigation uses a dedicated mobile container, not a hidden desktop nav

---

## Performance Rules

### Images

- All images are WebP format
- Hero images: max 1920×1080px, compressed to under 200KB
- Card images: max 800×600px, compressed to under 80KB
- Elementor's built-in lazy loading is enabled
- No autoplay video backgrounds

### Widgets to Avoid

- **Avoid:** Elementor's built-in slider/carousel for primary content (use a dedicated layout instead)
- **Avoid:** Elementor's "Basic Gallery" widget (use structured image containers)
- **Avoid:** Elementor's "Flip Box" widget (accessibility concerns, not aligned with design principles)
- **Use:** Elementor's Accordion widget for FAQ (accessible, keyboard-navigable)
- **Use:** Elementor's Form widget for contact forms (Pro feature, properly styled)

---

## Global Widget Rules

### Rule: Reuse via Global Widgets

Any molecule or organism that appears on more than one page is saved as a **Global Widget** in Elementor.

When a Global Widget is edited, it updates everywhere automatically. This is the core mechanism for design system consistency.

Typical Global Widgets:
- Header (`organism-header`)
- Footer (`organism-footer`)
- CTA banner (`organism-cta-banner`)
- Appointment CTA block
- Doctor intro teaser

### Rule: No Page-Specific Hero One-Offs

Hero sections use templates from the organism library, with content customized per page. They are not rebuilt from scratch on each page.

---

## Page Template Application

Every page in WordPress is assigned the **Elementor Full Width** template (Hello Elementor provides this). No pages use the theme's default template layout.

---

## Version Control of Elementor Content

Elementor content is stored in the WordPress database as JSON. This means:

- Elementor JSON exports are the version control artifact for templates
- All Elementor templates are exported as `.json` files and committed to the project repository
- When importing templates, always import from the project-versioned JSON, not from a prior WordPress environment

---

## The Golden Rule

When in doubt about an Elementor decision, ask:

> "Is this reusable, system-consistent, and maintainable by someone who didn't build it?"

If the answer is no, rethink the approach.
