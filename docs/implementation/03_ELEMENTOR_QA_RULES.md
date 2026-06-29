# Elementor QA Rules — Template Quality Standards

## georgeungureanu.doctor — Prompt 04 Output

**What this document is:** The definitive quality standard for every Elementor template on this site — atoms, molecules, organisms, and pages. Apply it before marking any template complete, after any significant change, and whenever a new contributor works on the project.

**Governing sources (must be read before any implementation work):**
- `docs/design-system/APPROVED_VISUAL_DIRECTION.md` — visual direction
- `docs/components/01_ATOMS.md`, `02_MOLECULES.md`, `03_ORGANISMS.md` — component library
- `docs/implementation/01_DESIGN_SYSTEM_SETUP.md` — design system foundation
- `docs/implementation/02_HOMEPAGE_TEMPLATE.md` — homepage template spec
- `docs/project/WEBSITE_GOALS.md` — CTA routing and patient goals

---

## The One Rule That Overrides Everything Else

Every template on this site is evaluated against a single test before all technical checks:

> **Would a frightened patient, reading only this section, understand their situation more clearly and know what to do next?**

If the answer is no — for any section, widget, heading, or CTA — the template is not complete regardless of technical compliance. This test is not optional and cannot be waived by technical quality alone.

---

## Part 1 — Master Template Checklist

Apply this checklist to every template before it is considered done. Each check is a binary pass/fail — partial compliance is not compliance.

---

### 1A — Design System Compliance

```
[ ] All colors reference Global Colors — zero hex values entered in widget color pickers
[ ] All typography references Global Typography — zero local font-family or font-size overrides
[ ] All spacing values are multiples of 8px — no odd values (e.g., 13px, 22px)
[ ] No CSS entered in individual widget "Custom CSS" fields
[ ] No CSS !important in any widget-level style
[ ] All containers are Flexbox Containers — zero legacy "Sections" in Navigator
[ ] No legacy Columns structure anywhere in the template
[ ] The `reading-column` class (max-width 700px) is applied to all body text containers
```

**How to verify colors:** Click any element → Style tab → Color picker → the picker should show the global color name (e.g., "Ink"), not a hex value. If it shows a hex, the override is local.

**How to verify typography:** Click any text element → Style tab → Typography → the field should show the global style name (e.g., "Body Large"), not individual font settings. If font family, size, or weight are set locally, they are overrides.

**How to verify containers:** Elementor Navigator → every item labeled "Container" (not "Section" or "Column"). The Navigator is the single source of truth for structure type.

---

### 1B — Atomic Design Compliance

```
[ ] Every visible UI element corresponds to a named atom, molecule, or organism in the component library
[ ] No one-off visual elements invented for this template — every element is in 01_ATOMS.md, 02_MOLECULES.md, or 03_ORGANISMS.md
[ ] Any new component needed has been added to the component library documentation first, before being built in Elementor
[ ] Organisms are saved as Template Library sections (not rebuilt locally per page)
[ ] Atom Global Widgets are not duplicated locally within a page
[ ] The atom-h5 and atom-h6 heading levels are not used anywhere — atom-label or atom-body-sm serve those purposes
```

**Before using any component:** Confirm it exists by name in the component library. If it does not exist, add it to the documentation, update COMPONENT_INVENTORY.md, then build it.

---

### 1C — Naming Compliance

```
[ ] The template's Custom ID follows the naming convention: organism-[name], molecule-[name], or atom-[name]
[ ] Inner containers use descriptive Custom IDs: [organism-name]-[purpose] (e.g., organism-hero-homepage-content-col)
[ ] The template is named in Elementor Template Library as: organism-[name], molecule-[name], etc.
[ ] Exported JSON files are named per the repository convention (see Part 5)
```

**Naming examples:**
- Template Library name: `organism-hero-homepage`
- Container Custom ID: `organism-hero-homepage`
- Inner content column ID: `organism-hero-homepage-content-col`
- Inner image column ID: `organism-hero-homepage-image-col`
- Button group ID: `organism-hero-homepage-cta-group`

---

### 1D — CTA Routing Compliance

This is a project-specific check that does not appear in generic Elementor QA lists.

```
[ ] Every button labeled "Programează o consultație" links to /programari — not /contact, not a form, not an external system
[ ] Every button labeled "Contactați-ne" links to /contact
[ ] No primary button on any page links directly to an appointment form (Phase 1 has no booking engine)
[ ] The /programari page exists and is live before any page with a "Programează" CTA can go live
[ ] The /programari CTA banner primary button links to /contact — not back to /programari (prevents routing loop)
```

**CTA routing reference:**
| Button label | Correct destination | Wrong destination |
|---|---|---|
| "Programează o consultație" | `/programari` | `/contact`, form anchor, external URL |
| "Contactați-ne" | `/contact` | `/programari`, phone number alone |
| "Condiții tratate →" | `/conditii` | `/conditii/` (trailing slash may cause redirect — confirm WP setting) |
| "Citește articolul →" | Article URL | Archive page |
| "Cum ajungeți →" (location card) | Google Maps URL | Clinic website URL |

---

### 1E — Background Alternation Compliance

Consecutive organisms must never share the same background. Verify the sequence on each page before marking the page complete.

```
[ ] No two adjacent organisms share the same background color
[ ] color-ink (#231E1A) appears at most once per page — always near the bottom (organism-cta-banner)
[ ] organism-cta-banner is the only dark-background section on any page
[ ] Background colors used are only from the approved set: color-surface, color-surface-warm, color-surface-muted, color-accent-subtle, color-ink
[ ] No white (#FFFFFF), no pure black (#000000), no institutional blue on any section background
```

**Approved background values:**
| Token | Hex | Typical use |
|---|---|---|
| `color-surface` | `#FDFBF7` | Default, hero, trust sections |
| `color-surface-warm` | `#F4EFE6` | Doctor sections, philosophy, how-it-works |
| `color-surface-muted` | `#EDE8DF` | Card-heavy sections, FAQ |
| `color-accent-subtle` | `#E4EDEB` | Testimonials, appointment CTA |
| `color-ink` | `#231E1A` | CTA banner only — maximum once per page |

**Homepage alternation (reference):**
Hero `color-surface` → Promise `color-surface-warm` → Conditions `color-surface-muted` → Doctor `color-surface-warm` → Trust `color-surface` → Testimonials `color-accent-subtle` (hidden) → How-It-Works `color-surface-warm` → Articles `color-surface` → CTA `color-ink`

---

### 1F — Heading Hierarchy Compliance

```
[ ] Exactly one H1 per page
[ ] H1 appears in the page hero only (organism-hero-homepage or organism-hero-interior)
[ ] Section headlines use H2
[ ] Subsection headlines within a section use H3
[ ] Card headlines use H4
[ ] atom-h5 and atom-h6 are not used — use atom-label or atom-body-sm instead
[ ] No heading levels are skipped (H1 → H3 with no H2 in between is a violation)
[ ] Heading levels are not used for visual sizing — headings communicate structure, not decoration
```

**How to verify:** Browser → Accessibility Inspector → Headings. The outline should show: 1× H1, then H2s for each major section, then H3s/H4s nested appropriately.

---

### 1G — Typography Separation Compliance

This project uses two typefaces with strict, non-overlapping roles:

```
[ ] Lora is used for: H1, H2, H3 (section/subsection), pull-quotes, and the organism-philosophy-statement body text only
[ ] Inter is used for: H4, all body text, all UI text (labels, captions, buttons, navigation, meta)
[ ] No Lora in card content (molecule-card-* components use H4 which is Inter)
[ ] No Inter in pull-quotes or editorial statements
[ ] The philosophy-text CSS class is applied only to organism-philosophy-statement body text
[ ] No font-family overrides in any widget (all font assignments are via Global Typography)
```

**When in doubt:** Lora = editorial voice (what the doctor says or thinks). Inter = informational voice (what the patient needs to read quickly).

---

### 1H — Content and Accessibility

```
[ ] Every image has an alt attribute — either descriptive text or alt="" if decorative
[ ] Doctor photos use descriptive alt text: "Dr. George Ungureanu, neurochirurg" or more specific
[ ] All SVG icons are aria-hidden="true" (they are decorative — the adjacent text carries the meaning)
[ ] All CTA buttons have descriptive labels — "Programează o consultație", not "Programează" alone
[ ] "Citește mai mult" is never used as a link label — every "read more" link names its destination
[ ] Step number circles in organism-how-it-works and organism-patient-journey are aria-hidden="true"
[ ] organism-patient-testimonials uses <blockquote> and <cite> semantic elements
[ ] organism-faq uses <dl>/<dt>/<dd> or <section> with H3 per question
[ ] organism-emergency-notice has role="alert" on its container
[ ] organism-site-header has <header> with role="banner" and <nav> with aria-label="Navigare principală"
[ ] organism-site-footer has <footer> with role="contentinfo" and <nav> with aria-label="Footer navigare"
[ ] Skip-to-content link in organism-site-header is tested (Tab on any page → link appears → Enter → focus moves past nav)
[ ] All telephone numbers use <a href="tel:+40..."> links
[ ] All email addresses use <a href="mailto:..."> links
[ ] External links (Google Maps) have target="_blank" rel="noopener" and an aria-label indicating they open externally
```

---

### 1I — Contrast Compliance

All contrast ratios verified against WCAG 2.1 AA. Large text = 18px+ regular or 14px+ bold.

| Foreground | Background | Ratio | Standard | Pass? |
|---|---|---|---|---|
| `color-ink` (#231E1A) | `color-surface` (#FDFBF7) | 14.5:1 | AA body (≥ 4.5:1) | ✓ |
| `color-ink` (#231E1A) | `color-surface-warm` (#F4EFE6) | 13.2:1 | AA body | ✓ |
| `color-ink` (#231E1A) | `color-surface-muted` (#EDE8DF) | 11.9:1 | AA body | ✓ |
| `color-accent` (#4D7A70) | `color-surface` (#FDFBF7) | 4.6:1 | AA body | ✓ (marginal — only use at 17px+) |
| `color-accent` (#4D7A70) | `color-surface-warm` (#F4EFE6) | 4.2:1 | AA large text (≥ 3:1) | ✓ at large sizes only |
| `color-surface` (#FDFBF7) | `color-ink` (#231E1A) | 14.5:1 | AA (dark section) | ✓ |
| `color-ink` (#231E1A) | `color-surface` (#FDFBF7) — button | 14.5:1 | AA button text | ✓ |
| `color-ink-secondary` (#5A4E47) | `color-surface` (#FDFBF7) | 7.1:1 | AA body | ✓ |

```
[ ] color-accent text (#4D7A70) is used at 17px minimum on light backgrounds — not for small captions
[ ] All text on color-ink dark background uses color-surface — verified in DevTools
[ ] Inverted primary button on dark background (color-ink text on color-surface background) verified
[ ] No color-ink-secondary text at sizes below 14px
```

---

### 1J — Responsive Compliance

```
[ ] Verified at 375px (iPhone SE — mobile portrait, smallest common viewport)
[ ] Verified at 390px (iPhone 14 — common mobile viewport)
[ ] Verified at 768px (tablet portrait)
[ ] Verified at 1024px (tablet landscape / small desktop)
[ ] Verified at 1280px (desktop)
[ ] Verified at 1440px (wide desktop — content centers, no stretching)
[ ] No horizontal scrollbar at any breakpoint
[ ] No text overflows its container at any breakpoint
[ ] All images scale correctly — no distortion, no cropping off critical content
[ ] All touch targets are minimum 44×44px on mobile (buttons, links, form fields)
[ ] Mobile padding uses mobile-specific values (not inheriting desktop values)
[ ] Grid columns collapse correctly: 3-col desktop → 2-col tablet → 1-col mobile
[ ] Image heights have explicit values on mobile (prevent aspect-ratio distortion)
[ ] Flexbox direction switches from row to column at the mobile breakpoint
```

**How to test:** Elementor responsive preview is not sufficient for production testing. Use Chrome DevTools → Device toolbar at the specific pixel widths listed above. Scroll the full page at each width.

---

### 1K — Motion and Animation Compliance

```
[ ] All Elementor Entrance Animations in the Motion Effects tab are set to "None" on every section and widget
[ ] No Elementor Motion Effects (parallax, scroll effects, mouse tracking) are active on any element
[ ] Verified in Chrome DevTools: Rendering → Emulate CSS media feature: prefers-reduced-motion → all animations suppressed
[ ] No CSS transitions longer than 200ms on interactive elements (hover states are allowed at 200ms or less)
[ ] Hover states use CSS transitions of 200ms ease only — not bounce, elastic, or step functions
```

---

### 1L — Patient-Centered Content Check

These checks cannot be automated. Read each section as a patient, not as a designer or developer.

```
[ ] Every section answers one specific patient question — no sections that exist for visual interest alone
[ ] The page has one clear primary action for the patient (one prominent CTA)
[ ] Medical terms appear with a plain-language explanation in the same section
[ ] Content tone is calm, clear, and empathetic throughout — no urgency language
[ ] No self-promotional language: "world-class", "cel mai bun", "excelent", "de top"
[ ] No unexplained abbreviations or credential strings (abbreviations are expanded on first use)
[ ] A new patient can identify what to do next at every point on the page without assistance
[ ] The section could stand alone and still make sense — it does not depend on the patient having read the previous section
```

---

## Part 2 — Component-Specific Rules

These rules apply to specific component types regardless of which page they appear on.

---

### Atom Rules

- **Typography atoms (atom-h1 through atom-h4, atom-body-lg, atom-body, atom-body-sm, atom-overline, atom-pull-quote, atom-caption, atom-label):** Never apply directly in Elementor widgets with local overrides. Use the Heading or Text Editor widget and assign the corresponding Global Typography style.
- **atom-h5 and atom-h6 are deferred.** If you think you need H5 or H6, use `atom-label` (for metadata/table headers) or `atom-body-sm` (for secondary descriptors) instead.
- **atom-button-primary:** Background must be Global Color "Accent" (#4D7A70). Hover state must be Global Color "Accent Hover" (#3A5F57). Border-radius: 6px. Padding: 15px/32px. Never use as a navigation link without an action destination.
- **atom-button-ghost:** Text color: Global Color "Accent". No background. No border. Includes a trailing arrow ("→") in the label. Used for "read more" type navigation — not for primary actions.
- **atom-divider:** Uses Global Color "Border". Height: 1px. Margin: space-8 (32px) per side unless the organism spec specifies otherwise.
- **atom-overline:** Text: uppercase, Global Typography "Overline" (Inter 500, 12px, 2px letter-spacing). Color: Global Color "Accent". Never use a Heading widget for overline text — use a Text widget with the `text-overline` custom class.

---

### Molecule Rules

- **molecule-section-header:** Contains atom-overline + atom-h2 + optional atom-body-lg. The H2 is always present. The overline is always present. The lead text (atom-body-lg) is optional. Never use molecule-section-header without a meaningful H2.
- **molecule-card-trust:** Numbers must be confirmed accurate facts — no placeholders in the published version. Label text explains the number in plain patient language. No volume counts without context. No superlatives. See `02_MOLECULES.md §molecule-card-trust` for the full content rules.
- **molecule-card-condition:** Condition names in patient language (Romanian plain language, not medical Latin). Icon is decorative (`aria-hidden="true"`). The card H4 is the accessible label. Every card links to a real, published condition page — no links to placeholder pages.
- **molecule-card-article:** Reading time is always shown. Article headline in patient question format. If no real articles exist, the card does not appear — no placeholder articles.
- **molecule-location-card:** All fields must be confirmed with Dr. Ungureanu before this molecule is published. See `02_MOLECULES.md §molecule-location-card` data checklist. Never publish with placeholder location data.
- **molecule-pull-quote:** Uses `<blockquote>` HTML element. Attribution uses `<cite>` element. Lora italic, 24px. A left border of 3px in color-accent. Doctor quotes: first person. Patient quotes: must be real, attributed, with permission.
- **molecule-breadcrumb:** Present on all interior pages. Two levels maximum on mobile. Aria label: "Breadcrumb navigation" (`<nav aria-label="Breadcrumb">`). Current page: `aria-current="page"`.

---

### Organism Rules

- **organism-site-header:** Sticky at top. 6 nav items (confirmed). Primary CTA: "Programează o consultație" → /programari. Drop-down menus are forbidden. Mobile: 64px height, hamburger drawer from right edge. Must be applied via Elementor Theme Builder → Header, not manually per page.
- **organism-site-footer:** 4-column layout (desktop). Columns: 1. Doctor info + contact 2. Pages nav 3. Conditions nav 4. Schedule. Applied via Elementor Theme Builder → Footer. The footer column 1 address should link to `/programari` (not a single clinic address — there are multiple locations).
- **organism-hero-homepage:** One H1. Two-column. Doctor photo in the right column. No background images with text overlaid. Primary CTA → /programari.
- **organism-hero-interior:** Left-aligned text. Breadcrumb precedes H1. Background: `color-surface-warm`. One H1 per page. Never centered.
- **organism-cta-banner:** Appears exactly once per page. Background: `color-ink`. Inverted buttons. No urgency language. Primary → /programari. If the page is /programari itself, the CTA banner primary should link to /contact.
- **organism-how-it-works and organism-patient-journey:** Never on the same page. how-it-works is logistics (homepage, contact). patient-journey is experience (patient page).
- **organism-patient-testimonials:** Hidden via display:none until real testimonials with patient permission are available. Never show placeholder or fictional testimonials.
- **organism-emergency-notice:** role="alert". First element on applicable pages (before the hero). Apply only to acute condition pages — not site-wide.
- **organism-conditions-grid:** Condition cards link to real, published condition pages only. Homepage variant: 6 cards. Full conditions page: all conditions. Never show "coming soon" cards.

---

## Part 3 — The Pre-Launch Gate

A page may not go live until every item in this gate is cleared. This is a hard stop — not a recommendation.

### Global Prerequisites (must be done once, before any page can launch)

```
[ ] Elementor custom.css is active and verified (all 14 CSS custom properties return correct values)
[ ] All 14 Global Colors are configured in Elementor → Site Settings
[ ] All 15 Global Typography styles are configured in Elementor → Site Settings
[ ] organism-site-header is complete and applied to all pages via Theme Builder
[ ] organism-site-footer is complete and applied to all pages via Theme Builder
[ ] /programari page exists and is accessible (minimum viable version — hero + location directory)
[ ] /contact page exists and is accessible
[ ] /conditii page exists and is accessible (conditions grid links to it)
[ ] /despre page exists and is accessible (doctor intro and trust sections link to it)
```

### Per-Page Prerequisites

For each page before it goes live:

```
[ ] Doctor photography is available (homepage, about, doctor sections — no placeholder silhouettes)
[ ] All trust indicator figures confirmed with Dr. Ungureanu (if molecule-card-trust appears on this page)
[ ] All condition names and descriptions confirmed (if organism-conditions-grid appears on this page)
[ ] All location data confirmed (if organism-location-directory appears on this page)
[ ] All form submission destinations configured (if organism-contact-form appears on this page)
[ ] Phone number confirmed and tested as a working tel: link
[ ] All internal links point to published pages (no 404s)
[ ] All external links open in new tab with rel="noopener" (Google Maps, etc.)
[ ] The master template checklist (Part 1) is fully cleared
[ ] Lighthouse accessibility score ≥ 90
[ ] Page load time ≤ 3 seconds on mobile (Lighthouse mobile simulation)
```

### Homepage-Specific Additional Prerequisites

```
[ ] Patient Promise text (Section 2) confirmed with Dr. Ungureanu — not placeholder text
[ ] Doctor Introduction text (Section 4) confirmed — first-person voice
[ ] Condition card descriptions confirmed for all 6 conditions
[ ] /programari page is live (Section 1 and Section 9 CTAs route there)
[ ] WordPress front page set to this page: Settings → Reading → Static page → Homepage
```

---

## Part 4 — Common Implementation Errors

A reference for errors that appear frequently during Elementor builds on this project.

| Error | How it appears | Detection method | Fix |
|---|---|---|---|
| Local hex color | Widget shows a hex like `#4D7A70` in color picker | Click element → Style → color picker — shows hex not name | Remove local value; select Global Color by name |
| Local font override | Widget shows "Inter, 18px, 400" in Typography | Click element → Style → Typography — shows font settings not "Default" | Remove all local typography; select Global Typography style |
| Legacy Section | Navigator shows "Section" or "Column" item | Open Navigator (Ctrl+I) and inspect the tree | Rebuild the section as a Flexbox Container |
| Duplicate H1 | Page has H1 in both the hero and a section heading | Browser → Accessibility → Heading outline | Change the second H1 to H2 |
| Wrong CTA destination | "Programează" button links to /contact | Click button in preview, inspect link | Change link to /programari |
| Missing alt text | Image widget has no alt text field content | Browser accessibility inspector → Images | Add descriptive alt text |
| Entrance animation active | Section or widget has an animation that plays on scroll | Elementor Motion Effects tab on the element | Set Entrance Animation to "None" |
| Spacing not a multiple of 8 | Widget padding/margin shows 13px, 22px, 7px | Widget → Advanced → Margin/Padding values | Round to nearest 8px multiple |
| H5 or H6 in use | Heading widget set to H5 or H6 tag | Navigate the heading outline in browser inspector | Replace with atom-label (Text widget) or atom-body-sm |
| Overline as heading | Atom-overline implemented as a Heading widget | Navigator shows Heading widget for overline | Replace with Text widget + `text-overline` CSS class |
| Missing reading-column class | Body text container spans full width | Inspect element — `max-width` is not 700px | Add CSS class `reading-column` to body text container |
| Card links to unpublished page | Condition card or article card has a 404 destination | Click the card link in preview | Publish the destination page first, or hide the card |
| Testimonial section visible without real content | Section shows with no quotes or placeholder text | Preview the page | Add `display: none` via Elementor Advanced → Custom CSS on the section, or use Elementor's Hide On settings |

---

## Part 5 — Template Export Protocol

### Repository Structure

All exported Elementor templates are stored here:

```
elementor-templates/
├── atoms/
│   └── atom-[name].json
├── molecules/
│   └── molecule-[name].json
├── organisms/
│   └── organism-[name].json
└── pages/
    └── template-[page-name].json
```

Examples:
```
elementor-templates/atoms/atom-button-primary.json
elementor-templates/molecules/molecule-card-trust.json
elementor-templates/organisms/organism-hero-homepage.json
elementor-templates/pages/template-homepage.json
elementor-templates/pages/template-condition-page.json
```

### When to Export

| Trigger | What to export |
|---|---|
| After completing an organism or molecule template | That template |
| After any structural change to a template | That template |
| After any content change that affects structure | That template |
| Before any WordPress or Elementor update | All templates |
| When the site is considered stable for a milestone | All templates |

Do not export after every minor content edit (text changes, etc.) — export at structural milestones.

### How to Export

1. Elementor → Templates → My Templates
2. Hover over the template name → click "Export"
3. Save the `.json` file to the correct directory in this repository
4. Commit the file with a message following the convention below

### Commit Message Convention

```
[action]: [template-name] — [what changed] — [date]
```

Actions: `feat` (new template), `fix` (bug fix), `update` (content/structural change), `refactor` (rebuild without functional change)

Examples:
```
feat: organism-hero-homepage — initial build, 2-column layout, /programari CTA
update: organism-how-it-works — updated step content to reflect /programari flow
fix: molecule-card-trust — removed local font override, using Global Typography
refactor: organism-site-header — rebuilt in Flexbox Container, removed legacy Section
```

### Import Protocol

When importing a template from this repository into a fresh Elementor install:

1. Elementor → Templates → My Templates → Import Template
2. Select the `.json` file from the correct directory
3. The template will appear in the library — verify it renders correctly before using on a page
4. Apply the master template checklist (Part 1) after import — imported templates may have color or typography drift if the global styles are not configured identically

---

## Part 6 — Adding New Components

When a new UI pattern is needed that does not exist in the current component library:

### The Rule

**Never build a new pattern in Elementor before documenting it.** The documentation defines the pattern; Elementor implements it. If Elementor leads, the documentation becomes inaccurate.

### Process for a New Atom

1. Verify the atom does not already exist or is not a variant of an existing atom
2. Add the atom definition to `docs/components/01_ATOMS.md` (use the existing atom format)
3. Add the atom to the Master Component Table in `COMPONENT_INVENTORY.md`
4. Update the Atom-to-Molecule Composition Map if the atom will be used in molecules
5. Update the component counts in COMPONENT_INVENTORY.md
6. Build the atom in Elementor
7. Apply Part 1 checklist
8. Export to `elementor-templates/atoms/`

### Process for a New Molecule

1. Verify all constituent atoms are already in the library
2. Add the molecule definition to `docs/components/02_MOLECULES.md`
3. Add to COMPONENT_INVENTORY.md: Master Table, Atom-to-Molecule Map, page usage Matrix (if applicable)
4. Build the molecule in Elementor from existing atoms
5. Apply Part 1 checklist
6. Save as Template Library entry
7. Export to `elementor-templates/molecules/`

### Process for a New Organism

1. Verify all constituent molecules and atoms are already in the library
2. Add the organism definition to `docs/components/03_ORGANISMS.md` — include: Purpose, Patient-centered rationale, Composition, Layout, Content rules, Accessibility, Mobile behavior, Elementor implementation, Forbidden
3. Add to COMPONENT_INVENTORY.md: Master Table, Molecule-to-Organism Map, page usage Matrix
4. Confirm the organism's background fits the page's alternation sequence before building
5. Build in Elementor from existing molecules and atoms
6. Apply Part 1 checklist
7. Save as Template Library section
8. Export to `elementor-templates/organisms/`

**Never create an organism that combines two independent patient questions into one section.** If a section serves two purposes, it is two organisms. Split it.

---

## Part 7 — Adding New Page Types

When a page type is needed beyond those already specified (homepage, interior, condition, contact, /programari):

### Step 1: Define in Documentation

Before opening Elementor:

1. Add the page to the page architecture in `COMPONENT_INVENTORY.md §Page-to-Organism Usage Matrix`
2. Define the section sequence: which organisms appear, in which order, with which backgrounds
3. Verify the background alternation sequence is valid
4. Verify which organisms already exist — only build new organisms for gaps
5. Document any new organisms required (per Part 6 process above)
6. Resolve the patient-centered test for the page: what one question does this page answer?

### Step 2: Build Missing Organisms

If the page requires organisms not already in the template library, build them first (per Part 6 process).

### Step 3: Build the Page

1. Create a new WordPress page with the correct slug
2. Open in Elementor
3. Assemble organisms in sequence — insert from Template Library
4. Edit content per the page spec
5. Verify background alternation on the full page
6. Apply Part 1 master checklist
7. Apply the Pre-Launch Gate (Part 3)

### Step 4: Update Documentation

1. Add any new organisms to 03_ORGANISMS.md
2. Update COMPONENT_INVENTORY.md with the new page's organism usage
3. If the new page changes navigation, update organism-site-header spec and the WordPress menu
4. Export all new or modified templates

---

## Part 8 — Elementor Settings Audit

Run this audit after any WordPress or Elementor update, and quarterly thereafter.

### Global Colors Audit

1. Elementor → Site Settings → Global Colors
2. Verify exactly 14 colors are present, named correctly, with correct hex values:

| Name | Hex |
|---|---|
| Ink | `#231E1A` |
| Ink Secondary | `#5A4E47` |
| Surface | `#FDFBF7` |
| Surface Warm | `#F4EFE6` |
| Surface Muted | `#EDE8DF` |
| Accent | `#4D7A70` |
| Accent Hover | `#3A5F57` |
| Accent Subtle | `#E4EDEB` |
| Border | `#D6CFC4` |
| Border Strong | `#BDB3A5` |
| Overlay | `rgba(35, 30, 26, 0.80)` |
| Success | `#2D7046` |
| Warning | `#A05A2C` |
| Error | `#B83030` |

3. No additional colors added without documentation — every color in the picker must appear in this list

### Global Typography Audit

1. Elementor → Site Settings → Global Fonts
2. Verify exactly 15 styles are present with correct settings:

| Name | Family | Weight | Size (desktop) | Line height |
|---|---|---|---|---|
| H1 — Page Title | Lora | 700 | 52px | 1.15 |
| H2 — Section Headline | Lora | 700 | 38px | 1.25 |
| H3 — Subsection Headline | Lora | 600 | 26px | 1.35 |
| H4 — Card Headline | Inter | 600 | 18px | 1.40 |
| Body Large | Inter | 400 | 20px | 1.65 |
| Body | Inter | 400 | 17px | 1.70 |
| Body Small | Inter | 400 | 14px | 1.60 |
| Pull Quote | Lora | 400 italic | 24px | 1.55 |
| Overline | Inter | 500 | 12px | 1.50 |
| Label | Inter | 500 | 14px | 1.40 |
| Caption | Inter | 400 | 13px | 1.50 |
| CTA Button | Inter | 600 | 15px | 1.0 |
| Navigation | Inter | 500 | 15px | 1.0 |
| H5 | — | — | — | Deferred — do not configure |
| H6 | — | — | — | Deferred — do not configure |

3. No local typography overrides in any widget in the Template Library

### Template Library Audit

1. Elementor → Templates → My Templates
2. Verify all templates from the component library are present and named correctly
3. Export any templates modified since the last export

### Custom CSS Audit

1. Elementor → Site Settings → Custom CSS
2. Verify all CSS custom properties from `elementor/custom.css` are present with correct values
3. Check that `.reading-column` max-width is 700px
4. Check that `.text-overline` class is defined with uppercase transformation
5. Check that `.philosophy-text` class overrides font-family to Lora
6. Check that `prefers-reduced-motion` block is present and suppresses all animations
7. Check that `:focus-visible` ring styles are present for keyboard navigation

---

## Part 9 — Performance Standards

After each major template addition or before any page launch:

```
[ ] Lighthouse Mobile Performance score: 85+
[ ] Lighthouse Desktop Performance score: 90+
[ ] Lighthouse Accessibility score: 90+
[ ] Largest Contentful Paint (LCP): ≤ 2.5s
[ ] Cumulative Layout Shift (CLS): ≤ 0.1
[ ] First Input Delay / INP: ≤ 200ms
[ ] Total page weight: ≤ 2MB
[ ] All images in WebP format (JPEG/PNG converted before upload)
[ ] All images resized to their display dimensions before upload (no 4000px images displayed at 400px)
[ ] Hero image: ≤ 120KB WebP
[ ] Article/condition featured images: ≤ 80KB WebP
[ ] Elementor lazy loading enabled for images below the fold
[ ] Google Fonts: loaded via Elementor's built-in Google Fonts integration (not a separate plugin)
[ ] Elementor's "Improved Asset Loading" enabled (loads only the CSS/JS needed for each page)
```

**How to run Lighthouse:** Chrome DevTools → Lighthouse tab → Mobile device → Categories: Performance + Accessibility → Analyze page load. Use Incognito mode to avoid extension interference.

---

## Part 10 — The Anti-Pattern Registry

These patterns are explicitly forbidden on this site. If you encounter them during a build or audit, remove them.

| Pattern | Why Forbidden | Compliant Alternative |
|---|---|---|
| Carousel / slider | Creates anxiety via timed content; fails keyboard users; patients cannot control reading pace | Static content with atom-divider between items |
| Tab system | Hides content from patients who do not discover all tabs; fails keyboard navigation | Full vertical content with H3 headings |
| Dropdown navigation | Adds touch complexity; obscures site structure | Flat 6-item navigation in organism-site-header |
| Sticky/floating CTA button (separate from header) | Creates visual competition; anxiety-inducing | Header CTA remains visible via sticky header |
| Countdown timer or urgency language | Medically inappropriate; creates anxiety | Calm invitation language only |
| Modal or popup on page entry | Prevents patient access to content they came to read | No modals except GDPR consent notice |
| Parallax scrolling | Causes motion sickness; fails prefers-reduced-motion | Static backgrounds, no scroll effects |
| Scroll-triggered element reveals | Elements appearing mid-scroll may be missed; jarring | All content visible on page load |
| Multiple competing primary CTAs | Creates decision paralysis | One primary CTA per section |
| Social media feed embed | Unpredictable third-party content; privacy concerns | No social media embeds |
| Chat widget / live chat popup | Intrudes on reading; adds visual weight | Contact form + phone number |
| Stock photography of patients | Inauthentic; condescending | Real doctor photography only |
| Achievement-framing trust stats | Feels like advertising; erodes trust | molecule-card-trust with honest, contextualised figures |
| Local hex color in a widget | Creates design drift; impossible to audit | Global Color only |
| Local font override in a widget | Creates typography inconsistency | Global Typography only |
| H5 or H6 heading | Not part of the active heading system | atom-label or atom-body-sm |
| Background image with text overlaid | Contrast issues; fails at smaller sizes | Solid background + adjacent image |
| White (#FFFFFF) as a background | Breaks warm visual direction | color-surface (#FDFBF7) minimum |
| "Click here" as link text | Meaningless without context; fails screen readers | Descriptive link text naming the destination |
| Placeholder/TBD content in published pages | Undermines patient trust | Hide sections until real content is available |

---

## Part 11 — Ongoing Maintenance Schedule

### After Each Session of Elementor Work

- [ ] Export any modified templates to the repository
- [ ] Commit exported files with descriptive commit messages (Part 5)
- [ ] Verify the modified pages pass the relevant sections of the master checklist

### Monthly

- [ ] Run the Elementor Settings Audit (Part 8) — verify no color or typography drift
- [ ] Run Lighthouse on the homepage and one condition page — note any score regressions
- [ ] Check all external links are still working (Google Maps URLs, any third-party references)

### Before Any WordPress or Elementor Update

- [ ] Export all templates as a pre-update backup
- [ ] Run the settings audit post-update to catch any reset or drift
- [ ] Test all pages at 375px and 1280px post-update
- [ ] Verify prefers-reduced-motion suppression is still active post-update

### When Adding a New Contributor to the Project

- [ ] Share this document as the first read
- [ ] Share `docs/implementation/01_DESIGN_SYSTEM_SETUP.md` as the second read
- [ ] Share `docs/components/COMPONENT_INVENTORY.md` as the third read
- [ ] New contributor must run the master checklist (Part 1) on their first completed template, with review

---

## Part 12 — Verification Sequence for a Complete Page

Run this sequence when a page is ready for final review. Items in grey are already covered by Part 1 — this sequence is the final end-to-end walkthrough.

1. **Open the page in a browser (not Elementor preview)** — use the actual published URL or a staging environment
2. **Tab through the page with keyboard** — verify focus rings appear on every interactive element, verify skip-to-content link works, verify no keyboard traps
3. **Check the heading outline** — Browser DevTools → Accessibility → Headings — one H1, logical H2/H3/H4 hierarchy
4. **Check every CTA link** — click each button and verify it lands on the correct destination
5. **Resize to 375px** — scroll the full page, check for overflow, image distortion, button usability
6. **Enable prefers-reduced-motion in DevTools** — verify no animations run
7. **Read every section as a patient** — apply the patient-centered test from Part 1L
8. **Run Lighthouse in incognito, mobile simulation** — verify scores meet the thresholds in Part 9
9. **Check the page in the WordPress front-end** — verify the header and footer appear correctly (Theme Builder)
10. **Clear any Elementor or caching plugin caches** — verify the page loads correctly on a hard refresh

---

*QA Rules Document Version: 1.0 — Prompt 04 output*
*Covers: all component types, all page types defined through Prompt 03*
*Next step: Build organism-site-header and organism-site-footer in Elementor Theme Builder, then begin page-by-page implementation starting with the homepage*
