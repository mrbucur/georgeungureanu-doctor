# Prompt 02: Atomic Component Library

## georgeungureanu.doctor — Elementor Pro Component Templates

---

## Context for Claude Code

This is Prompt 02 in the implementation sequence for georgeungureanu.doctor.

**Prerequisites:** Prompt 01 must be fully implemented before this prompt. All Global Colors and Global Typography must be configured in Elementor.

Before using this prompt, ensure you have read:
- `docs/design-system/ATOMIC_DESIGN_RULES.md`
- `docs/design-system/ELEMENTOR_IMPLEMENTATION_RULES.md`
- `docs/design-system/COLOR_SYSTEM.md`
- `docs/design-system/TYPOGRAPHY_SYSTEM.md`
- `docs/design-system/SPACING_SYSTEM.md`

---

## Objective

Generate Elementor JSON template files for the complete atomic component library — atoms, molecules, and organisms — as defined in `ATOMIC_DESIGN_RULES.md`.

These templates are the reusable building blocks for all page templates.

---

## Deliverables

### Atoms

Generate Elementor JSON for each atom widget/container. Atoms are saved as **Global Widgets** in Elementor.

Priority atoms for Phase 1:

1. `atom-button-primary` — filled CTA button
2. `atom-button-secondary` — outlined CTA button
3. `atom-button-ghost` — text CTA button
4. `atom-overline` — section label text
5. `atom-divider` — horizontal rule

Atom JSON requirements:
- Uses Global Color references (not hex values)
- Uses Global Typography references (not local font settings)
- Padding values from the spacing system
- Border-radius: 6px for interactive elements
- Hover states configured
- Focus states configured (accessibility)

### Molecules

Generate Elementor JSON for each molecule container template.

Priority molecules for Phase 1:

1. `molecule-section-header` — overline + H2 + optional lead body
2. `molecule-card-condition` — icon + H4 + body-sm + link
3. `molecule-card-article` — image + overline + H4 + body-sm + meta
4. `molecule-cta-inline` — body text + primary button
5. `molecule-cta-button-group` — primary + secondary buttons
6. `molecule-pull-quote` — quote text + attribution

Molecule JSON requirements:
- Built from Flexbox Containers only
- All visual properties from global tokens
- Internal spacing from spacing system
- Responsive behavior defined for mobile breakpoint

### Organisms

Generate Elementor JSON for each organism section template.

Priority organisms for Phase 1:

1. `organism-header` — main navigation with logo, nav items, CTA
2. `organism-footer` — footer with links, contact, copyright
3. `organism-hero-homepage` — full hero section
4. `organism-hero-page` — standard internal page hero
5. `organism-intro-section` — centered section header + lead text
6. `organism-condition-grid` — section header + 3-column card grid
7. `organism-two-col-text-image` — text + image two-column layout
8. `organism-cta-banner` — full-width CTA section
9. `organism-faq-accordion` — section header + accordion FAQ items
10. `organism-contact-form` — appointment request form

---

## JSON File Format

Each component is exported as a separate `.json` file in the following structure:

```
elementor-templates/
├── atoms/
│   ├── atom-button-primary.json
│   ├── atom-button-secondary.json
│   └── ...
├── molecules/
│   ├── molecule-section-header.json
│   ├── molecule-card-condition.json
│   └── ...
└── organisms/
    ├── organism-header.json
    ├── organism-footer.json
    └── ...
```

---

## Implementation Rules

### Container Structure

Every component uses this nesting pattern:
```
Container (outer, full-width)
  └── Container (inner, max-width constrained)
      └── Container (row/column)
          └── Widgets
```

### Global Reference Enforcement

In every JSON file, verify:
- `"color"` values reference global IDs, not hex strings
- `"typography"` values reference global style IDs, not local font settings
- `"padding"` and `"margin"` values use the spacing system values

### Naming in Elementor

Every container and widget in the JSON has a `"custom_id"` that follows the naming convention. This ID appears in Elementor's navigator and makes the structure readable.

---

## organism-header Specification

The header organism requires special attention.

Desktop layout:
```
[Logo]                    [Nav item] [Nav item] [Nav item] [Nav item]    [Book a Consultation ▶]
```

Mobile layout:
```
[Logo]                                                          [☰ Menu]
```
Mobile menu expands to full-width overlay or side drawer.

Header behavior:
- Sticky on scroll (Elementor sticky header)
- Background: `color-surface` with `color-border` bottom border on scroll
- On scroll: subtle shadow added, background remains white (no color change)
- Logo: Doctor's name in `type-nav` weight 600, `color-ink`
- Nav items: `type-nav`, `color-ink-secondary`, hover to `color-ink`
- Active nav item: `color-accent`
- CTA button: `atom-button-primary` size small

---

## organism-footer Specification

Footer layout:

```
[Logo + tagline]    [Navigation col 1]    [Navigation col 2]    [Contact]
───────────────────────────────────────────────────────────────────────
[Copyright]                                                  [Legal links]
```

Footer background: `color-ink`
Footer text: `color-surface` (white)
Footer links: `color-surface-muted` → `color-surface` on hover

---

## organism-cta-banner Specification

Full-width section, `color-accent-subtle` background.

```
[Headline — type-h2]
[Sub-text — type-body-lg]
[atom-button-primary]   [atom-button-secondary]
```

Centered, with `space-20` vertical padding.

---

## Constraints

- All JSON must be valid Elementor Pro import format
- No custom PHP
- No CSS in individual widget style fields (only global stylesheet)
- No legacy Section/Column structures — Flexbox Containers only
- Every component is mobile-responsive in the JSON

---

## Success Criteria

After implementing this prompt:
- All atom templates are saved as Global Widgets in Elementor
- All molecule templates are in the Elementor Template Library under their correct names
- All organism templates are saved as Global Sections
- Any page template can be assembled by combining existing organisms without building new components
- The component library is sufficient to build the homepage template (Prompt 03)
