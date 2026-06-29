# Atomic Design Rules

## georgeungureanu.doctor

---

## Overview

This website uses Atomic Design methodology to create a scalable, consistent, and reusable component system. Every visual element is built from smaller units, and no element is built from scratch if a smaller atom or molecule can be reused.

---

## The Hierarchy

```
Atoms → Molecules → Organisms → Templates → Pages
```

Each level is composed exclusively of elements from the level below it.

---

## Level 1: Atoms

The smallest possible design unit. Cannot be broken down further without losing meaning.

Atoms use Global Colors and Global Typography exclusively. No local overrides.

### Typography Atoms

| Atom | Description |
|------|-------------|
| `atom-overline` | Section label: small, uppercase, letter-spaced, `color-accent` |
| `atom-h1` — `atom-h6` | Heading elements with global typography applied |
| `atom-body` | Standard body paragraph |
| `atom-body-lg` | Lead paragraph (first paragraph of a section, larger size) |
| `atom-caption` | Image or element caption |
| `atom-label` | Form label |

### Color Atoms

| Atom | Description |
|------|-------------|
| `atom-divider` | 1px horizontal rule, `color-border` |
| `atom-divider-strong` | 2px horizontal rule, `color-border-strong` |

### Interactive Atoms

| Atom | Description |
|------|-------------|
| `atom-button-primary` | Filled button, `color-accent` background, white text |
| `atom-button-secondary` | Outlined button, `color-accent` border, `color-accent` text |
| `atom-button-ghost` | Text-only button, `color-accent` text, underline on hover |
| `atom-link` | Inline text link, `color-accent`, underline |
| `atom-icon` | Single icon element (SVG, consistent sizing) |

### Form Atoms

| Atom | Description |
|------|-------------|
| `atom-input` | Text input field with label slot |
| `atom-textarea` | Multi-line input |
| `atom-select` | Dropdown select |
| `atom-checkbox` | Checkbox with label |
| `atom-radio` | Radio button with label |

### Media Atoms

| Atom | Description |
|------|-------------|
| `atom-image` | Image with proper aspect ratio container |
| `atom-avatar` | Circular image for doctor/team portraits |
| `atom-icon-box` | Icon in a contained background shape |

---

## Level 2: Molecules

Combinations of atoms that form a distinct, reusable UI unit.

### Navigation Molecules

| Molecule | Atoms Used |
|---------|------------|
| `molecule-nav-item` | `atom-link` + optional `atom-icon` |
| `molecule-nav-dropdown` | Multiple `atom-nav-item` elements in a container |
| `molecule-logo` | Site logo image + site name text atom |

### Content Molecules

| Molecule | Atoms Used |
|---------|------------|
| `molecule-section-header` | `atom-overline` + `atom-h2` + optional `atom-body-lg` |
| `molecule-condition-tag` | `atom-label` in a pill/badge container |
| `molecule-breadcrumb` | Multiple `atom-link` + separator atoms |
| `molecule-meta` | `atom-icon` + `atom-caption` (date, location, etc.) |
| `molecule-pull-quote` | `atom-quote` + `atom-caption` (attribution) |

### Card Molecules

| Molecule | Atoms Used |
|---------|------------|
| `molecule-card-condition` | `atom-icon-box` + `atom-h4` + `atom-body-sm` + `atom-link` |
| `molecule-card-article` | `atom-image` + `atom-overline` + `atom-h4` + `atom-body-sm` + `atom-meta` |
| `molecule-card-stat` | Large number atom + `atom-body-sm` label |

### Form Molecules

| Molecule | Atoms Used |
|---------|------------|
| `molecule-form-field` | `atom-label` + `atom-input` + optional error message |
| `molecule-form-group` | Multiple `molecule-form-field` elements |
| `molecule-form-submit` | `atom-button-primary` + optional helper text |

### CTA Molecules

| Molecule | Atoms Used |
|---------|------------|
| `molecule-cta-inline` | `atom-body` + `atom-button-primary` |
| `molecule-cta-button-group` | Primary + secondary button atoms |

---

## Level 3: Organisms

Complete, self-contained sections of the page. Can be placed in any page template.

### Global Organisms

| Organism | Description | Molecules Used |
|---------|-------------|----------------|
| `organism-header` | Main site navigation | `molecule-logo` + `molecule-nav-item` × N + `molecule-cta-button-group` |
| `organism-footer` | Site footer | Logo + nav columns + contact + copyright |
| `organism-cookie-notice` | Cookie consent bar | Text atom + button atoms |

### Hero Organisms

| Organism | Description |
|---------|-------------|
| `organism-hero-homepage` | Full-width hero with headline, sub, and dual CTAs |
| `organism-hero-page` | Standard internal page hero with title and breadcrumb |
| `organism-hero-condition` | Condition page hero with headline and intro text |

### Content Organisms

| Organism | Description |
|---------|-------------|
| `organism-intro-section` | Section header + lead body text, centered |
| `organism-condition-grid` | Section header + grid of `molecule-card-condition` |
| `organism-two-col-text-image` | Text column + image column (alternates direction) |
| `organism-stats-row` | Row of `molecule-card-stat` elements |
| `organism-pull-quote-section` | Full-width background with centered pull-quote |
| `organism-faq-accordion` | Section header + list of expandable FAQ items |
| `organism-article-grid` | Section header + grid of `molecule-card-article` |
| `organism-testimonial-section` | Section header + patient testimonials |

### Doctor / Biography Organisms

| Organism | Description |
|---------|-------------|
| `organism-doctor-intro` | Photo + name + specialty + short bio + CTA |
| `organism-credentials-list` | Structured list of education and certification |
| `organism-publications-list` | Academic publications with citation formatting |

### CTA Organisms

| Organism | Description |
|---------|-------------|
| `organism-cta-banner` | Full-width CTA section: headline + subline + button |
| `organism-contact-form` | Contact/appointment form with validation |

---

## Level 4: Templates

Page-level structures that define which organisms appear and in what order for a given page type.

| Template | Organisms |
|---------|-----------|
| `template-homepage` | header → hero-homepage → intro-section → condition-grid → two-col-doctor → stats-row → pull-quote → article-grid → cta-banner → footer |
| `template-condition-page` | header → hero-condition → intro-section → two-col-text-image → faq-accordion → cta-banner → footer |
| `template-about-page` | header → hero-page → doctor-intro → two-col-text-image → credentials-list → publications-list → cta-banner → footer |
| `template-contact-page` | header → hero-page → contact-form → footer |
| `template-article` | header → hero-page → content-body → cta-inline → article-grid → footer |

---

## Level 5: Pages

Specific page instances built from templates, with real content. Pages are the final WordPress/Elementor output.

---

## Atomic Design Rules

### Rule 1: Build Up, Never Down

Only compose elements from smaller atoms and molecules. Never manually recreate an atom inside a molecule — always reference the atom template.

### Rule 2: No One-Off Elements

If a design element appears once, question whether it belongs. If it belongs, add it to the atom or molecule library. Do not create bespoke elements for individual pages.

### Rule 3: Name with the System

All Elementor templates, sections, and widgets are named using the atom/molecule/organism naming convention from this document. This allows any future contributor to understand the system immediately.

### Rule 4: Global Tokens Only

Atoms use Global Colors and Global Typography. Molecules inherit from atoms. Organisms inherit from molecules. The global system propagates automatically. No overrides at any level.

### Rule 5: Document Every Addition

Any new component added to the system is documented here before being built in Elementor.
