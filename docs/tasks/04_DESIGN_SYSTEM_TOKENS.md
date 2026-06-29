# Design System Tokens

## georgeungureanu.doctor

**Purpose of this document:** Freeze the complete visual language before Homepage implementation. Every decision recorded here governs every element built from this point forward. No implementation begins without this document approved.

**Source of truth:**
- `docs/design-system/APPROVED_VISUAL_DIRECTION.md` (governing — supersedes all earlier design decisions)
- `docs/design-system/COLOR_SYSTEM.md`
- `docs/design-system/TYPOGRAPHY_SYSTEM.md`
- `docs/design-system/SPACING_SYSTEM.md`
- `docs/design-system/BRAND_GUIDELINES.md`
- `docs/design-system/DESIGN_PRINCIPLES.md`
- `docs/design-system/ATOMIC_DESIGN_RULES.md`
- `docs/design-system/ELEMENTOR_IMPLEMENTATION_RULES.md`
- `docs/project/PATIENT_CENTERED_MANIFESTO.md`
- `docs/project/TARGET_AUDIENCE.md`

**Implementation constraint:** This document describes what the system is and why. It does not produce Elementor JSON, code, CSS, or plugin configuration. Those are implementation outputs that follow from this specification.

---

# 1. Design Philosophy

## 1.1 Warm Academic Medicine

Direction B+ — Warm Academic Medicine — is not a style choice. It is a response to a clinical reality: the patients who visit this website are frequently in the most frightening period of their lives. They may have received a diagnosis yesterday. They may be researching late at night, alone, trying to understand what is about to happen to their body.

This context defines every visual decision.

**The governing test** (applied before every design decision):

> A patient received a difficult neurological diagnosis three days ago. They are searching at 10pm on their phone. They find this website. Within 8 seconds, before reading anything: do they feel slightly less afraid, or the same?

Every element in this design language exists to pass that test.

**The synthesis:** Direction B+ combines three distinct strengths:

| Quality | Source | Expression |
|---------|--------|-----------|
| Warmth and emotional register | Direction B | Cream backgrounds, warm ink, sage accent, Lora serif |
| Layout discipline and clarity | Direction A | Strict grid, strong hierarchy, restrained section rhythm |
| Respect for educational content | Direction C | 68-character column limit, generous leading, structured long-form templates |

When these forces pull against each other — when discipline wants to tighten and warmth wants to breathe — warmth resolves the conflict. Warmth is the primary register. Discipline serves warmth.

## 1.2 Editorial Restraint

Sophistication on this website is expressed through what is absent, not what is added.

- Two typefaces. Not three. Not one with several weights deployed decoratively.
- Fourteen color tokens. No additional colors. No gradients. No patterns.
- One primary CTA per section. Not two competing for the patient's attention.
- No animations that demand notice. Motion exists to aid orientation, not to perform.

The reference standard is the editorial quality of the world's best medical institutions — Mayo Clinic, Johns Hopkins Medicine, New England Journal of Medicine. These institutions do not communicate authority through visual complexity. They communicate it through the precision and calm of a well-considered environment.

## 1.3 Human Over Corporate

This is a personal medical practice. One doctor. His name is on the domain. Every design decision must reflect that this is a human practice, not an institution.

- Photography shows a person listening, thinking, explaining — not a title.
- Typography (Lora) was chosen because its calligraphic origins give letterforms a visible hand quality — they suggest something was written, not rendered.
- Language is first person or direct address. Never the passive constructions of corporate communication.
- The warm cream backgrounds (`color-surface`, `#FDFBF7`) read as quality paper, not clinical tile.

**What corporate looks like — and why it fails here:**
- Cool grey or bright white backgrounds → clinical distance, institutional authority
- Institutional blue accents → generic healthcare, not a personal practice
- Dense credential walls → impresses peers, intimidates patients
- Achievement-centered content → shifts focus to ego, not to the patient's need

## 1.4 Calm Over Excitement

This website does not compete for attention. It earns it.

No element creates urgency. No animation demands notice. No color contrast creates visual tension. The design lowers the patient's heart rate before it informs their decision.

**Practical expressions of this principle:**
- `color-accent` (`#4D7A70`) — a deep, muted sage-teal that invites action without demanding it
- No marketing language in CTA labels ("Book a consultation" — not "Act now" or "Don't wait")
- Section padding (80px minimum on desktop) that gives content room to breathe
- Body text line-height (1.7 minimum) that does not rush the reader

## 1.5 Guidance Over Persuasion

A patient is not a customer. They are a person trying to make an important decision about their health. The website's job is to give them what they need to make that decision — not to persuade them of a predetermined answer.

- Every page answers patient questions before promoting the doctor's credentials.
- Content is structured inverted-pyramid: the most important information for the patient appears first.
- CTAs are directional ("Schedule a consultation") not persuasive ("Join thousands of satisfied patients").
- No countdown timers, no scarcity language, no social proof used as pressure.

## 1.6 Trust Through Clarity, Not Prestige

Trust on this website is built through comprehensibility, not through the accumulation of credentials.

A patient who reads a condition description and understands their diagnosis completely trusts the practice. A patient who reads a wall of certifications and publications does not understand their condition better — and may feel more intimidated.

**The trust hierarchy:**
1. Clear, accurate, complete information about the patient's condition
2. A doctor who communicates as a person, not as a title
3. Evidence that other patients have experienced care and felt informed
4. Credentials and professional recognition — in that order, always

## 1.7 Patient Anxiety and Accessibility

The primary audience is not a relaxed, well-rested user browsing on a calibrated monitor. The primary audience is anxious, often reading in suboptimal conditions:
- Late at night on a backlit screen
- On a mid-range smartphone with auto-brightness
- With cognitive load partially consumed by fear and uncertainty
- Potentially on an older device with a smaller viewport

These conditions define accessibility requirements that are stricter than WCAG minimum standards:

- **Reading comfort:** 68-character maximum column width (hard constraint — not a guideline)
- **Body text minimum:** 17px desktop, 16px mobile — never smaller
- **Line height:** 1.7 minimum for body text under any circumstances
- **Color contrast:** Target 7:1 or higher for primary text — the WCAG AA minimum (4.5:1) is insufficient for this population
- **Touch targets:** 44×44px minimum — more for primary actions
- **Motion:** All animation suppressed under `prefers-reduced-motion`
- **Background:** Warm cream (`#FDFBF7`) rather than pure white — warm backgrounds reduce blue-light eye fatigue over sustained reading sessions

---

# 2. Color System

## 2.1 Complete Token Table

All colors are defined as Elementor Global Colors. No local color overrides are permitted under any circumstances. If a color is not in this table, it does not exist in this system. Adding a new color requires updating this document and the Global Colors in Elementor before any implementation.

### Primary Colors

| Token | Hex | Purpose | Emotional Intent |
|-------|-----|---------|-----------------|
| `color-ink` | `#231E1A` | All primary text — headings, body, navigation | Warm near-black: ink on paper, not a screen imposing black. Carries authority with warmth. |
| `color-ink-secondary` | `#5A4E47` | Secondary text — captions, metadata, labels, secondary body | Receded warmth: present but not demanding. Signals secondary importance without clinical coldness. |

### Surface Colors

| Token | Hex | Purpose | Emotional Intent |
|-------|-----|---------|-----------------|
| `color-surface` | `#FDFBF7` | Primary page background | Signature of Direction B+. Warm cream felt before noticed. Reduces eye fatigue over sustained reading. Distinguishes this practice from generic clinical white. |
| `color-surface-warm` | `#F4EFE6` | Alternating section backgrounds | Perceptibly warmer — the distinction between two surfaces that are close but not equal. Creates section rhythm without stark contrast. |
| `color-surface-muted` | `#EDE8DF` | Card backgrounds, callout boxes, contained elements | Warm parchment: subtle depth without shadow. Signals "this is distinct content" without elevation. |

### Accent Colors

| Token | Hex | Purpose | Emotional Intent |
|-------|-----|---------|-----------------|
| `color-accent` | `#4D7A70` | Primary CTAs, links, active nav states, focus rings | The most carefully chosen element in the palette. Deep muted sage-teal — not wellness, not pharmaceutical, not corporate. Calm professional confidence. Invites action without pressuring it. |
| `color-accent-hover` | `#3A5F57` | Hover state on all accent elements | Deepens without alarming. 200ms transition. Confirms the interaction is real. |
| `color-accent-subtle` | `#E4EDEB` | CTA section backgrounds, highlighted content areas | The accent present at near-absence. Creates a relationship to interactive elements without competing with them. |

### Border Colors

| Token | Hex | Purpose | Emotional Intent |
|-------|-----|---------|-----------------|
| `color-border` | `#D6CFC4` | All standard borders, dividers, input outlines | Warm taupe — boundaries that belong to the palette, not imposed on it. |
| `color-border-strong` | `#BDB3A5` | Section dividers, emphasized rules | Stronger presence when a separation must be unambiguous. |

### Overlay

| Token | Hex | Purpose |
|-------|-----|---------|
| `color-overlay` | `#231E1ACC` | Dark overlay on photography — warm, not cool | The warm near-black at opacity. Used over hero photography and anywhere a dark surface must emerge from photography. Never a cool or pure black overlay. |

### Functional Colors

| Token | Hex | Purpose | Use Constraint |
|-------|-----|---------|---------------|
| `color-success` | `#2D7046` | Form submission confirmation, positive indicators | Used with icon + text — never color alone |
| `color-warning` | `#A05A2C` | Important notices, non-emergency callouts | Used sparingly — maximum one instance per page |
| `color-error` | `#B83030` | Form validation errors, critical notices | Always accompanied by error text and icon |

## 2.2 Contrast Ratios (Verified)

| Combination | Ratio | WCAG AA (4.5:1) | WCAG AAA (7:1) | Notes |
|------------|-------|----------------|---------------|-------|
| `color-ink` on `color-surface` | 14.5:1 | Pass | Pass | Primary reading combination |
| `color-ink` on `color-surface-warm` | 13.2:1 | Pass | Pass | Alternating sections |
| `color-ink` on `color-surface-muted` | 11.8:1 | Pass | Pass | Card backgrounds |
| `color-ink-secondary` on `color-surface` | 7.2:1 | Pass | Pass | Captions and secondary text |
| `color-accent` on `color-surface` | 4.6:1 | Pass | Borderline | Link text and active states — pass AA; do not use for body text |
| `color-surface` on `color-ink` | 14.5:1 | Pass | Pass | All text on dark sections and footer |
| `color-surface` on `color-accent` | 4.6:1 | Pass | — | CTA button text |

The primary reading combination (14.5:1) substantially exceeds WCAG AA requirements, appropriate for elderly patients and night-time reading conditions.

## 2.3 Color Rules

**No marketing gradients.** Gradients signal visual effort-to-impress. This design communicates through content quality and spatial discipline, not visual embellishment.

**No aggressive CTA colors.** Red, orange, high-saturation green, or any color that creates urgency is not part of this system. The CTA must invite, not demand.

**Warm dark is not cool dark.** `color-ink` (`#231E1A`) has a slight brown inflection. Any dark section — hero overlays, footer, impact sections — uses this token. Never use a cool navy, pure black (`#000000`), or neutral grey as a dark background.

**Accent is singular.** `color-accent` is used for the primary interactive element in any given context. Using it for decoration (borders, background fills, dividers) dilutes its interactive signal. Every unnecessary use of the accent weakens the signal of every necessary use.

**Section background rhythm:**
```
Section:  color-surface        (#FDFBF7) — primary
Section:  color-surface-warm   (#F4EFE6) — alternate
Section:  color-surface        (#FDFBF7) — return
Section:  color-surface-muted  (#EDE8DF) — card-heavy or callout
Dark:     color-ink             (#231E1A) — maximum 2 per page
```

---

# 3. Typography System

## 3.1 Typeface Selection

**Two typefaces only. No additional faces, weights outside the defined set, or decorative fonts.**

### Lora — Editorial Serif

- **Source:** Google Fonts (free, web-optimized)
- **Weights in use:** 400 (Regular), 700 (Bold), 400 Italic
- **Role:** The editorial voice. Used for all H1–H3 headings, pull-quotes, and patient testimonial text. Carries authority with warmth.
- **Character:** A contemporary literary serif rooted in classical calligraphic tradition. Its strokes have visible variation that suggests a hand that wrote carefully. This registers subconsciously as human — typography that was made, not generated.
- **Why not Playfair Display:** Playfair Display leads with drama and authority. Lora leads with warmth and precision. For a patient arriving anxious, warmth first is the correct emotional order.
- **Fallback chain:** Georgia, serif

### Inter — Humanist Sans-Serif

- **Source:** Google Fonts (variable font available)
- **Weights in use:** 400 (Regular), 500 (Medium), 600 (SemiBold)
- **Role:** The informational voice. Used for all body text, H4–H6, UI elements, navigation, labels, captions, and form elements. Maximum legibility at all sizes.
- **Character:** Designed specifically for screen interfaces. Open apertures and humanist proportions give it warmth at reading sizes that purely geometric sans-serifs lack. Sustains dense educational content (condition descriptions, recovery timelines, FAQ answers) without fatigue.
- **Why not DM Sans:** DM Sans's rounder letterforms sacrifice legibility at smaller sizes. Educational content on this site runs dense at body sizes — Inter's precision at reading scale is the correct trade-off.
- **Fallback chain:** system-ui, -apple-system, sans-serif

## 3.2 Type Scale — Complete Token Table

All typography is defined as Elementor Global Typography styles. No local font overrides are permitted. If a text style is needed that does not have a global token, create the token before building the component.

### Heading Tokens

| Token | Font | Desktop | Mobile | Weight | Style | Line Height | Letter Spacing | Usage |
|-------|------|---------|--------|--------|-------|-------------|----------------|-------|
| `type-h1` | Lora | 52px | 36px | 700 | Normal | 1.15 | 0 | Page titles, hero headlines — one per page |
| `type-h2` | Lora | 38px | 28px | 700 | Normal | 1.20 | 0 | Section headings — answers a patient question |
| `type-h3` | Lora | 28px | 22px | 400 | Normal | 1.25 | 0 | Subsection headings — guides reading within a section |
| `type-h4` | Inter | 20px | 18px | 600 | Normal | 1.30 | 0 | Card headlines, tertiary section labels |
| `type-h5` | Inter | 17px | 16px | 600 | Normal | 1.35 | 0 | Minor subheadings, sidebar-level labels |
| `type-h6` | Inter | 15px | 14px | 600 | Normal | 1.40 | 0 | Table headers, fine-level structure |

**H5 and H6 note:** These tokens are defined but deferred in the MVP component set. Use `atom-label` in preference to H5/H6 for most secondary labeling needs. If H5 or H6 is used, verify semantic necessity — heading tags carry semantic HTML meaning, not just visual styling.

### Body Tokens

| Token | Font | Desktop | Mobile | Weight | Line Height | Usage |
|-------|------|---------|--------|--------|-------------|-------|
| `type-body-lg` | Inter | 19px | 17px | 400 | 1.75 | Lead paragraphs — first paragraph of each major section. Signals "start here." |
| `type-body` | Inter | 17px | 16px | 400 | 1.70 | All standard body content. Never smaller than 17px desktop, 16px mobile. |
| `type-body-sm` | Inter | 15px | 15px | 400 | 1.65 | Card descriptions, secondary information, supporting detail not in the reading flow |

**Body text minimum is 16px on mobile — never smaller.** A mobile body text below 16px requires zooming on many devices and is inaccessible to the older patients in this audience.

### Special Tokens

| Token | Font | Desktop | Mobile | Weight | Style | Line Height | Letter Spacing | Usage |
|-------|------|---------|--------|--------|-------|-------------|----------------|-------|
| `type-quote` | Lora | 24px | 20px | 400 | Italic | 1.45 | 0 | Patient testimonials, doctor philosophy statements, pull-quotes |
| `type-overline` | Inter | 12px | 11px | 600 | Uppercase | 1.40 | 0.08em | Section labels above H2 headlines — 2–4 words maximum |

### UI Tokens

| Token | Font | Desktop | Mobile | Weight | Line Height | Usage |
|-------|------|---------|--------|--------|-------------|-------|
| `type-label` | Inter | 13px | 13px | 600 | 1.40 | Form labels, tag labels, category identifiers |
| `type-caption` | Inter | 13px | 12px | 400 | 1.50 | Image captions, attributions, metadata, dates |
| `type-cta` | Inter | 16px | 15px | 600 | 1.0 | All button labels — primary, secondary, ghost |
| `type-nav` | Inter | 15px | 15px | 500 | 1.0 | Navigation items, breadcrumbs |

### Timeline Entry Token

Timeline events on the `/despre` professional timeline use a hybrid type treatment:

| Element | Token | Notes |
|---------|-------|-------|
| Year | `type-h4` (Inter 20px / 600) | Bold, anchors the entry in time |
| Event title | `type-body` (Inter 17px / 400) | Read as prose, not a heading |
| Institution / location | `type-body-sm` (Inter 15px / 400) | `color-ink-secondary` — contextual detail |
| Category tag | `type-label` (Inter 13px / 600) | Pill/badge, `color-surface-muted` background |
| Description | `type-body-sm` (Inter 15px / 400) | Only when title alone is insufficient |

Timeline entries are not headings. They are dated prose entries arranged vertically. The year is the structural anchor; everything below it reads as body content, not as a content hierarchy.

## 3.3 Typographic Hierarchy in Practice

```
OVERLINE       Inter 12px / 600 / uppercase / 0.08em tracking     color-accent
H2 Headline    Lora 38px / 700                                     color-ink
Lead body      Inter 19px / 400 / 1.75 line height                color-ink
Body           Inter 17px / 400 / 1.70 line height                color-ink
Caption        Inter 13px / 400 / 1.50 line height                color-ink-secondary
```

A patient scanning a condition page can navigate the structure entirely by reading the headings. The contrast between Lora at 38px and Inter at 17px is the typographic drama of this system — it is not supplemented by additional decorative choices.

## 3.4 Reading Comfort Principles

**68-character maximum column width.** This is a hard constraint, not a guideline. No body text runs wider than this at any breakpoint. Long lines require the eye to travel too far at the end of a line to find the beginning of the next. For a patient reading a condition description under stress, a tracking error (landing on the wrong line) adds cognitive frustration to emotional distress.

**Generous leading.** Body text at 1.70–1.75 line height is the minimum that sustains comfortable reading for a patient whose working memory is partially consumed by anxiety. Reducing line height to 1.5 or 1.6 is a readability regression for this audience.

**Inverted pyramid.** The most important information appears first in every section. The patient who reads only the first paragraph of each section should leave with the essential information. Supporting detail follows for those who need more.

**Headings as questions.** Headings answer patient questions, not describe content categories. "What does this feel like?" not "Symptoms." "What to expect from your first consultation" not "First consultation." A patient scanning headings navigates the page without reading.

**Lists for comparability, paragraphs for explanation.** Bullet lists when items are of equal importance or sequence matters. Paragraphs when ideas build on each other. Never fragment continuous reasoning into bullets — this is the pattern that makes medical content feel like an intranet page.

## 3.5 Mobile Typography Rules

- H1 minimum on mobile: 32px — smaller loses Lora's character at narrow widths
- H2 minimum on mobile: 24px — heading must clearly differ from body size
- Body text minimum: 16px — never smaller on mobile
- `type-overline` scales to 11px on mobile — the only token that does
- `type-nav` and `type-cta` do not scale — UI text must be consistent across breakpoints
- Line heights do not change between desktop and mobile — the reading-comfort rationale applies equally to both
- Font loading: `font-display: swap` for both Lora and Inter — content-visible before web fonts load

## 3.6 Role Boundary — Lora vs. Inter

| Lora (Editorial Voice) | Inter (Informational Voice) |
|----------------------|---------------------------|
| H1, H2, H3 | H4, H5, H6 |
| Pull-quotes (`type-quote`) | Body text (all sizes) |
| Patient testimonials | Navigation, labels, captions |
| Doctor biography lead paragraph | CTA button text |
| Publication titles in running text (italic) | Form fields and UI elements |

The role boundary is not crossed. An H3 is always Lora. A button label is always Inter. An overline is always Inter. A testimonial is always Lora italic.

**Inter italic is not used.** There is no token that applies italic to Inter. Emphasis in body text uses Inter 600 (SemiBold) weight.

---

# 4. Spacing System

## 4.1 Base Unit

```
Base unit: 8px
All spacing values are multiples of 8px.
No spacing value in this system is arbitrary (e.g., 23px, 37px, 55px is not a valid value).
```

## 4.2 Semantic Spacing Tokens

The following semantic tokens map to the base scale for use in component and section documentation. They provide a human-readable shorthand for the numeric scale.

| Semantic Token | Base Token | Pixel Value | Usage |
|---------------|-----------|------------|-------|
| `spacing-xs` | `space-2` | 8px | Micro gaps: icon-to-label, badge padding, tight list item spacing |
| `spacing-sm` | `space-4` | 16px | Standard component internals: paragraph spacing, button vertical padding |
| `spacing-md` | `space-6` | 24px | Standard gaps: card padding (mobile), nav item gap, between form fields |
| `spacing-lg` | `space-10` | 40px | Section internals: between heading and body, between subcomponents |
| `spacing-xl` | `space-16` | 64px | Section padding (tight): compact sections, mobile section top/bottom |
| `spacing-2xl` | `space-20` | 80px | Section padding (standard): most content sections on desktop |
| `spacing-3xl` | `space-32` | 128px | Section padding (maximum): hero sections on desktop |

## 4.3 Full Base Scale (Reference)

| Token | Pixels | Common Use |
|-------|--------|-----------|
| `space-1` | 4px | Micro padding, very tight internal spacing |
| `space-2` | 8px | (`spacing-xs`) — icon-text gap, badge padding |
| `space-3` | 12px | Small gaps: label-to-input |
| `space-4` | 16px | (`spacing-sm`) — paragraph spacing, button vertical padding |
| `space-5` | 20px | Form field horizontal padding, small section margins |
| `space-6` | 24px | (`spacing-md`) — card padding mobile, nav gaps |
| `space-8` | 32px | Card padding desktop, heading-to-body gap, nav-to-CTA gap |
| `space-10` | 40px | (`spacing-lg`) — between sub-components |
| `space-12` | 48px | Section padding mobile (top/bottom) |
| `space-16` | 64px | (`spacing-xl`) — section padding compact |
| `space-20` | 80px | (`spacing-2xl`) — section padding standard desktop |
| `space-24` | 96px | Section padding generous |
| `space-32` | 128px | (`spacing-3xl`) — hero padding desktop |

## 4.4 Section Spacing

**Desktop section padding (standard):** `spacing-2xl` top and bottom (80px), `space-8` sides (32px)
**Desktop section padding (hero):** `spacing-3xl` top and bottom (128px), `space-8` sides (32px)
**Mobile section padding:** `spacing-xl` top and bottom (64px), `spacing-md` sides (24px)

**Section padding never falls below 64px on desktop.** Compressed section padding creates visual density that conflicts with the calm, unhurried register this design requires.

## 4.5 Card Spacing

| Context | Padding |
|---------|---------|
| Card — desktop standard | `space-8` all sides (32px) |
| Card — mobile | `space-6` all sides (24px) |
| Card — compact (small card variants) | `space-6` (24px) desktop, `space-5` (20px) mobile |
| Between card elements (heading to body) | `space-4` (16px) |
| Between card and grid neighbor | `space-6` (24px) — gap |

## 4.6 Mobile Spacing

Mobile spacing is 60–80% of desktop values on section-level padding. Component-level spacing (card internals, button padding, form field padding) does not change with breakpoint — touch targets and reading comfort require consistent internal spacing.

## 4.7 Whitespace Philosophy

**More space is almost always the correct choice.** When choosing between two spacing values, choose the larger one unless there is a specific reason to compress. Compressed layouts create anxiety. Generous spacing creates calm.

**Space communicates relationship.** Elements that belong together are spaced close. Elements that are distinct are spaced apart. A section heading belongs to the content below it — it receives more space above it than below.

**Breathing room signals importance.** A condition description that has room to breathe signals: "this information deserves your full attention." Dense, compressed content signals: "get through this quickly." The patient on this website must not feel rushed.

---

# 5. Border Radius System

Border radius in this system is minimal and consistent. The aesthetic goal is: warm and approachable, but not rounded to the point of suggesting a consumer app or startup product.

## 5.1 Token Table

| Token | Value | Applied To |
|-------|-------|-----------|
| `radius-button` | 6px | All button variants — primary, secondary, ghost |
| `radius-card` | 8px | All card types — condition, article, stat, colleague recommendation |
| `radius-input` | 6px | All form inputs, textareas, selects |
| `radius-tag` | 100px | Content tags, condition tags, content-type badges — full pill shape |
| `radius-avatar` | 50% | Circular portrait containers (doctor portrait, colleague portraits) |
| `radius-image` | 0 | All editorial photography — no radius |
| `radius-thumbnail` | 4px | Small image thumbnails within cards only |
| `radius-callout` | 6px | Callout boxes and highlighted content containers |

## 5.2 Radius Philosophy

**Photography receives no border-radius.** Images used as editorial photography are rectangular. Rounding the corners of a full-width hero or an article image signals a consumer or social media aesthetic inconsistent with Warm Academic Medicine. Photography is contained, architectural, precise.

**6px for interaction, 8px for containment.** The 2px distinction is intentional: interactive elements (buttons, inputs) are slightly less rounded than containers (cards), which suggests that containers are more permanent than the actions they hold.

**No startup-scale rounding (16px+, 24px, 50% on rectangles).** Heavily rounded cards, panels, or text containers signal app design or consumer product, not a medical practice with academic gravity.

**Tag pills (100px) are the only fully-rounded elements.** Their full-pill shape functions as a visual code — round = categorical label, not a structural container.

---

# 6. Shadows and Elevation

## 6.1 Philosophy

This design system does not use shadows to create visual depth or to signal "this is more important." Shadows are a single, restrained tool for two specific functions: indicating interactivity (hover state) and indicating floating position (sticky header, mobile drawer).

A surface with a shadow is elevated. Elevation on this website means one of two things: this element is currently interactive (you are hovering it), or this element is floating above the page content (header on scroll, drawer open). Nothing else receives a shadow.

## 6.2 Permitted Shadows

| Context | Shadow Value | Trigger | Purpose |
|---------|-------------|---------|---------|
| Sticky header on scroll | `0 2px 8px rgba(35,30,26,0.10)` | After 80px scroll | Signals header is elevated above content |
| Mobile drawer | `−4px 0 24px rgba(35,30,26,0.15)` | When drawer is open | Separates drawer from overlaid page |
| Card hover state | `0 4px 16px rgba(35,30,26,0.08)` | On mouse-over | Confirms the card is interactive |
| Form input focus | No shadow — border color change to `color-accent` | On focus | Keyboard/screen reader accessible without shadow |

**Shadow color:** All shadows use `rgba(35,30,26, ...)` — a warm near-black derived from `color-ink`. Never use cool-grey or pure-black shadows. A shadow with a blue or grey tone conflicts with the warm palette.

## 6.3 Forbidden Shadows

| Forbidden Usage | Why |
|----------------|-----|
| Persistent card shadow (not hover) | Implies elevation where none exists; creates visual noise |
| Section-level shadows | Sections are not elevated elements — they are the page |
| Button shadows | Buttons use color and border-radius to signal interactivity, not depth |
| Text shadows | Never used — typographic quality requires clean text rendering |
| Decorative box-shadow as border substitute | Use `color-border` borders; do not simulate them with shadow |
| Multiple layered shadows | One shadow per element, one state trigger — not a stacking system |

## 6.4 Card Hierarchy Without Shadow

Cards are distinguished from their backgrounds not through shadows but through:

1. Background color: `color-surface-muted` (`#EDE8DF`) on a `color-surface` section background
2. Border: 1px `color-border` (`#D6CFC4`) — warm taupe, present but unassertive
3. Internal spacing: 32px padding that creates distinct "insideness"
4. On hover: shadow appears (see permitted shadows above)

This approach keeps the default state clean and uses shadow specifically as a hover signal — not as a default style treatment.

---

# 7. Photography System

Photography is the most trust-critical element on this website. The warm palette makes a promise — *this is a human place* — that photography must confirm. Without genuinely human photography, the design cannot function as intended.

## 7.1 Required Photography

The following shots are required for the website to launch. They cannot be substituted with stock photography.

| Shot | Description | Blocking For |
|------|-------------|-------------|
| **Primary portrait** | Mid-distance, warm light, natural or warm-artificial setting. Direct but calm gaze. Doctor as a person, not a title. | Homepage hero, About page header |
| **Approachable portrait** | Slightly more relaxed than the primary portrait. May be off-center. Warm expression without being performed. | Homepage doctor-intro section, footer optional |
| **Doctor listening** | In consultation posture — slightly forward, engaged with a partially visible patient or camera. Genuine concentration visible. | About page, Educational articles |
| **Doctor reviewing** | Reading a scan, notes, or file. Genuine professional concentration. Not posed for a camera. | Condition pages, article headers |
| **Doctor explaining** | Mid-gesture or mid-sentence, engaged in explanation. A moment caught, not staged. | Patient guidance articles, hero variants |
| **Environment detail** | Consultation room, desk, bookshelves, window light. Establishes that this is a real place, not a set. | Section backgrounds, editorial support |
| **Detail / hands** | Doctor's hands with documents, scan, or writing instrument. Warm, human detail. | Pull-quote sections, editorial moments |

## 7.2 Black and White Photography

Black and white variants of the portrait and listening shots are permitted and encouraged for:
- Pull-quote sections where a full-color photo would compete with the quote text
- Editorial moments where the image is present for emotional support, not information
- Historical timeline entries if documentation photography is available

**B&W conversion rule:** Black and white photography on this site uses warm-tone conversion (slight sepia warmth retained), not cold-tone desaturation. A cold-grey B&W photograph conflicts with the warm cream backgrounds.

**B&W is not used for:** Hero sections (color photography required), any image where the doctor must be immediately recognizable at first glance.

## 7.3 Lighting Requirements

**Warm or natural light.** Window light, warm artificial light, or directional soft light with warm temperature (3200–4500K range). 

**Not acceptable:** Cool studio lighting (5000K+), harsh overhead fluorescent, flat fill lighting that removes all shadow. Cool-lit photography placed on warm cream backgrounds creates a temperature conflict visible to the eye even without color vocabulary.

**Photography taken in a real consultation environment** is always preferred over a studio. The environment (bookshelves, desk lamp, window) is itself content — it tells the patient that Dr. Ungureanu works in a real place.

## 7.4 Framing and Composition

**Doctor must be larger than any equipment in the frame.** A photograph where a scanner, monitor, or instrument is as prominent as or more prominent than the doctor communicates the wrong hierarchy: the technology is the protagonist, not the person.

**No white coat required.** The doctor's humanity is not diminished by the absence of a white coat. If a white coat is worn, it must not be the primary visual element.

**No direct-to-camera smile unless genuine.** A posed professional smile signals "this photograph was taken for a website" — which erodes authenticity. A genuine expression of calm attention or concentration is preferable to a perfect smile.

**Depth of field:** Moderate background blur is acceptable and preferred — it focuses attention on the doctor without creating an artificially shallow aesthetic.

## 7.5 Image Treatments

**On color backgrounds (surface, surface-warm):** Photography is displayed without treatment. No filters, no color overlays, no vignetting.

**On dark hero sections:** `color-overlay` (`#231E1ACC`) is applied over the photograph as a dark overlay before text is placed. This overlay is warm, not cool — it maintains the palette's temperature even over photography.

**For editorial pull-quote sections:** If a B&W photograph is used behind a quote, reduce the photograph opacity to 60–70% and apply the `color-surface-warm` tint at low opacity. The photograph should support the text, not compete with it.

**No image filters.** No desaturation, color grading, or Instagram-style treatments applied to any photograph on the site. Photography must look like itself.

**Image sizes:**
- Hero photography: minimum 1920×1080px; compressed WebP under 200KB
- Section photography: minimum 1200×800px; compressed WebP under 100KB
- Card thumbnails: 800×600px; compressed WebP under 80KB
- Portrait images (about page, colleague recs): 600×600px minimum, square or near-square; compressed WebP under 60KB

## 7.6 Forbidden Photography

| Forbidden | Why |
|-----------|-----|
| Stock photography of "a doctor" | Inauthenticity is felt before it is articulated. Erodes trust in all surrounding content. |
| Handshake images | Signals corporate partnership, not patient care |
| "Doctor with stethoscope" standing pose | Generic healthcare visual language — indistinguishable from any other medical website |
| Patients smiling directly at the camera | Stock photo cheerfulness; does not reflect the emotional reality of the target audience |
| Before/after surgical photography | Complex ethical and legal territory; excluded from scope |
| Operating theater imagery used decoratively | Clinical imagery for shock or prestige; conflicts with the patient-centered emotional register |
| Photography with cool or clinical light | Temperature conflict with the warm palette |
| Equipment as visual hero | Communicates "we have great technology" instead of "we care about you" |

---

# 8. Iconography

## 8.1 Icon Style

| Attribute | Specification |
|-----------|--------------|
| Style | Line icons (outline, not filled) |
| Stroke weight | 1.5px at 24px display size |
| Corner treatment | Slightly rounded — joins and terminals match the warmth of the typefaces |
| Recommended set | Phosphor Icons or Heroicons (consistent line style, free, well-maintained) |
| Format | SVG — scalable, color-controllable |

## 8.2 Size System

| Size | Pixel Value | Usage |
|------|------------|-------|
| Inline | 20×20px | Icons within body text or form elements |
| Standard | 24×24px | Most icon uses — nav, inline labels, metadata |
| Section | 48×48px | Icons in card headers, process step icons, large feature icons |

## 8.3 Color Rules

| Context | Color Token | Use |
|---------|------------|-----|
| Action icons (CTAs, buttons, links) | `color-accent` (`#4D7A70`) | Only interactive icons |
| Information icons (categories, steps) | `color-ink-secondary` (`#5A4E47`) | Non-interactive information aids |
| Icons on dark backgrounds | `color-surface` (`#FDFBF7`) | Footer, dark hero sections |
| Icons within `color-accent` buttons | `color-surface` (`#FDFBF7`) | Maintains button readability |

Icons must integrate with the palette — they are not imported with their own color vocabulary.

## 8.4 Usage Rules

**Use icons for:**
- Process steps (booking journey, surgical preparation)
- Contact information (phone, location pin, email)
- Condition category visual anchors in grid cards
- Patient information sections (what to bring, what to expect)
- Navigation affordances where icon genuinely aids identification

**Do not use icons for:**
- Decorative bullet points replacing standard list markers
- Section headings that already have a clear typographic hierarchy
- Academic credentials, publications, or professional memberships (text only)
- Any context where the icon might be confused with a clinical symbol with medical meaning

## 8.5 Accessibility

Every icon that carries meaning (is not purely decorative) must have an accessible text alternative:
- Icons adjacent to text labels: `aria-hidden="true"` on the SVG (text label provides the accessible name)
- Standalone icons: `aria-label` on the interactive element, `title` element inside the SVG
- Icons used as the only content of a button or link: require `aria-label` on the container

**Never rely on icon color alone to convey state.** An error icon uses color plus shape plus label text. A success icon uses color plus shape plus confirmation text.

## 8.6 Forbidden Icon Patterns

| Forbidden | Reason |
|-----------|--------|
| Filled/solid icon style | Inconsistent with the line-icon system; conflicts with the editorial restraint principle |
| Animated icon transitions | Motion that performs rather than aids — excluded by the motion philosophy |
| Icons that substitute for photography | An icon of a brain cannot replace a photograph of Dr. Ungureanu; do not use icons to fill photography gaps |
| Caduceus or Rod of Asclepius in decorative contexts | Medical emergency symbols carry specific meaning; decorative use is inappropriate |
| Emoji in any formal content | Out of tone for Warm Academic Medicine |
| Icons imported with external color styling | All icons must use this system's color tokens, not imported color values |

---

# 9. Motion Principles

## 9.1 Governing Rule

Motion on this website exists only to aid comprehension or orientation. It never performs. It never demands attention. At most, it is noticed in its absence.

**The motion test:** If this animation did not exist, would the patient be confused or disoriented? If no, the animation does not belong.

## 9.2 Permitted Motion

| Context | Animation | Duration | Easing |
|---------|-----------|----------|--------|
| Page load | Fade in, opacity 0→1 | 300ms | ease-out |
| Button hover | Background color transition | 200ms | ease |
| Link hover | Color transition (ink → accent) | 150ms | ease |
| Focus indicator | Instant appearance | instant | — |
| Card hover | Box-shadow appearance + 2px translate-Y | 200ms | ease |
| Accordion open/close | Height transition | 250ms | ease-in-out |
| Mobile nav drawer | Slide in from right | 250ms | ease-out |
| Section scroll reveal | Fade up: opacity 0→1 + translateY 20px→0 | 400ms | ease-out |
| Header scroll-reduce | Height compression + shadow appearance | 200ms | ease-out |
| Form success state | Opacity transition | 200ms | ease |

## 9.3 Forbidden Motion

| Forbidden | Reason |
|-----------|--------|
| Carousels with auto-advance | Creates urgency and competes with patient attention; inaccessible |
| Parallax scrolling | Disorienting; creates motion sickness in sensitive users; performs instead of aiding |
| Autoplay video | No video plays without explicit user action |
| Infinitely looping animations | Competes for attention; exhausts the visual field |
| Animated counter / number roll | Startup-style prestige signal; incompatible with this register |
| Loading skeleton screens | Signals incompleteness; anxiety-inducing for patients |
| Dramatic page transitions | Full-page dissolves or slide-out effects signal a consumer app, not a medical practice |
| Staggered animations across more than 3 elements | Creates performance anxiety — the patient waits for content to settle before reading |
| Hover animations on body text | Body text does not animate; reading is not disturbed |
| Flash or strobe effects | Seizure risk; categorically forbidden |

## 9.4 Reduced Motion Requirement

All animations must be suppressed or simplified when the user has enabled `prefers-reduced-motion: reduce` in their system settings. This is an accessibility requirement, not a preference.

Under `prefers-reduced-motion`:
- All `translate` animations are disabled (elements appear at their final position)
- Opacity transitions are reduced to instant (no gradual fade)
- Accordion open/close becomes instant (no height animation)
- Mobile drawer appears instantly (no slide)
- Only color transitions (hover state changes) may remain as instantaneous color switches

This behavior is implemented at the CSS level through the `@media (prefers-reduced-motion: reduce)` media query applied globally.

---

# 10. Component Aesthetics

## 10.1 Cards (General Principles)

All cards share a foundational aesthetic:
- **Background:** `color-surface-muted` (`#EDE8DF`) by default; alternatively `color-surface-warm` when the section background is already `color-surface`
- **Border:** 1px `color-border` (`#D6CFC4`) — warm taupe, present but unassertive
- **Border-radius:** `radius-card` (8px)
- **Padding:** `space-8` (32px) desktop; `space-6` (24px) mobile
- **Default shadow:** None — flat
- **Hover shadow:** `0 4px 16px rgba(35,30,26,0.08)` + `translateY(-2px)` — 200ms ease
- **Text hierarchy:** Every card has a minimum of: label/overline → H4 → body-sm → action

Cards do not exist without text hierarchy. An image-only card is not part of this system.

## 10.2 Condition Cards (`molecule-card-condition`)

| Element | Token | Notes |
|---------|-------|-------|
| Icon container | `atom-icon-box`, 48×48px, `color-accent-subtle` | Icon in `color-accent`; one clear, recognizable icon per condition |
| Condition title | `type-h4` (Inter 20px / 600) | `patient_title` value — plain Romanian |
| Short description | `type-body-sm` (Inter 15px / 400) | `card_description` — 1 sentence maximum |
| Link | `atom-button-ghost` → `/afectiuni/[slug]` | "Aflați mai multe" or condition-specific label |

Condition cards do not display medical titles, symptoms, or any clinical detail. The card's only job is to confirm that this condition is here and invite the patient to read more.

## 10.3 Article Cards (`molecule-card-article`)

| Element | Token | Notes |
|---------|-------|-------|
| Featured image | 16:9 or 3:2 ratio, WebP; if absent, section uses a tonal background block in `color-surface-muted` | No placeholder / broken image |
| Content-type tag | `atom-overline` or `type-label` in pill | Values: Article / Video / Repurposed social — shown in `color-ink-secondary` |
| Article title | `type-h4` (Inter 20px / 600) | `title` value — must be a patient question or patient benefit |
| Excerpt | `type-body-sm` | `excerpt` field — max 200 chars |
| Metadata row | `type-caption` | Reading time + publish date; `color-ink-secondary` |

## 10.4 Colleague Recommendation Blocks

| Element | Token | Notes |
|---------|-------|-------|
| Doctor portrait | `atom-avatar`, 80×80px, `radius-avatar` (50%) | Professional portrait only; no stock photography |
| Name | `type-h4` (Inter 20px / 600) | `display_name` — format: "Dr. [Prenume] [Nume]" |
| Specialty | `type-body-sm` (Inter 15px / 400) | `specialty` field |
| Institution | `type-body-sm`, `color-ink-secondary` | `institution` field |
| Professional context | `type-body-sm` italic or `type-caption` | `professional_context` — 1 sentence |
| Recommendation text | `type-body` (Inter 17px / 400) | `recommendation_text`; Lora italic (`type-quote`) only for a featured/prominent single recommendation |

Layout: portrait left + content right on desktop (flex row); stacked (portrait above content) on mobile.

Background: `color-surface-warm` or `color-surface-muted` per alternating rhythm.

No star ratings. No percentages. No metrics. The recommendation text is the content.

## 10.5 Patient Testimonials

| Element | Token | Notes |
|---------|-------|-------|
| Testimonial text | `type-body` (17px / 400) | `experience_text` — in the patient's own words |
| Attribution | `type-caption` (Inter 13px / 400), `color-ink-secondary` | "[Prenume], [Oraș]" format; city only if provided |
| Condition tag | `molecule-condition-tag` — pill style | `condition` field if provided; `type-label` in `color-surface-muted` pill |

**No carousels.** Testimonials are a vertical stack, ordered most-recent first. No slider. No rotation. No timed reveal. A patient in distress cannot control a carousel and may miss the testimonial most relevant to their situation.

**No star ratings.** A patient's experience with their health is not a consumer transaction. Star ratings reduce a human experience to a marketing metric.

**No headshots.** Patient testimonials do not display photographs. Patient privacy is the constraint — and the absence of a face prevents the experience from feeling like a social media post.

A featured testimonial may use `type-quote` (Lora italic) for the testimonial text, but only when it is visually isolated as a pull-quote — not within the standard testimonial stack.

## 10.6 Forms

| Element | Token / Value | Notes |
|---------|--------------|-------|
| Field background | `color-surface` | Slightly lighter than surrounding page — visible as a distinct input area |
| Default border | 1px solid `color-border` (`#D6CFC4`) | `radius-input` (6px) |
| Focus border | 2px solid `color-accent` (`#4D7A70`) | No shadow on focus — border change only |
| Error border | 2px solid `color-error` (`#B83030`) | Always accompanied by error message atom |
| Label | `type-label` (Inter 13px / 600) | Above the input field; `spacing-xs` gap |
| Placeholder text | `color-ink-secondary` at 60% opacity | Never used as a substitute for a label |
| Input padding | `space-4` vertical (16px) / `space-5` horizontal (20px) | Matches SPACING_SYSTEM component spec |
| Gap between fields | `spacing-md` (24px) | |
| Submit button | `atom-button-primary` — full width on mobile | Label is specific: "Trimiteți mesajul" or "Programați consultația" — not "Submit" |
| GDPR checkbox | `atom-checkbox` | Required; link to `/politica-de-confidentialitate` must be inline in label text |
| Success state | Inline message replaces form; no redirect; `color-success` with icon and confirmation text | |

**No disabled button state.** A disabled/greyed button while loading communicates "this is unavailable" — anxiety-inducing at the moment of action. Loading states use a spinner inside the active button.

**Labels are always visible.** Placeholder text is not a substitute for a label. Labels sit above their inputs at all times, visible before and after the patient begins typing.

## 10.7 FAQ Accordions

| Element | Token | Notes |
|---------|-------|-------|
| Question text | `type-h3` or Inter 17px / 600 | Written as a patient question — not a topic label |
| Expand icon | `atom-icon`, `color-accent`, 20×20px | Chevron or +/− symbol; rotates 180° on open |
| Divider between items | 1px `color-border` at bottom of each item | |
| Section background | Inherits from parent section | No separate card treatment per item |
| Answer text | `type-body` (Inter 17px / 400), `color-ink` | Revealed below the question; padding-top `spacing-sm` |
| Transition | Height: 250ms ease-in-out | Suppressed under `prefers-reduced-motion` |
| Default state | All items collapsed | Exception: the first item may be open by default if the first question is the most likely entry point |

**No nested accordions.** FAQ items do not contain further expandable content. If an answer requires sub-sections, restructure as a condition page section.

**Keyboard requirements:** Space or Enter opens/closes the currently focused accordion. Tab moves between accordion triggers. Arrow keys optionally move between accordion triggers (ARIA `listbox` pattern not required but permitted).

## 10.8 Educational Content Blocks

These appear in SN Article pages, Condition pages, and patient guidance articles. They govern how long-form content is structured and visually organized.

**Lead paragraph rule:** The first paragraph of every major section uses `type-body-lg` (Inter 19px). All subsequent paragraphs use `type-body` (Inter 17px). This creates a visible entry point to each section.

**Callout boxes:** Used for the most critical patient-facing information — "What to bring," "When to call," "Important: if you experience X, call 112." Maximum 2 callout boxes per page. Background: `color-accent-subtle` (`#E4EDEB`) or `color-surface-muted` (`#EDE8DF`). Border-left: 3px `color-accent` (signals the element is important without alarming). `radius-callout` (6px).

**Pull-quotes:** Background `color-surface-warm`. Centered text. `type-quote` (Lora italic 24px). Padding `spacing-2xl` top/bottom. Used for doctor philosophy statements, patient voice moments, or a key insight that serves as an emotional anchor. Maximum 1 per article.

**Medical term definitions:** First use of any medical term is followed by a plain-language definition in parentheses: "hernie de disc (o deplasare a discului intervertebral care poate comprima nervii)." Never assume the patient knows the term. Never link the term to a Wikipedia article or external source.

**Numbered lists for sequences:** Surgery steps, recovery stages, appointment preparation — these are numbered. Lists where order does not matter are bulleted. Never use bullet points to fragment continuous reasoning.

**Image placement within articles:** Images appear full-width of the content column, or at 50% float right/left with `spacing-md` margin. They do not break the 68-character column constraint of the text — they are either full-width or beside it.

---

# 11. Accessibility Standards

## 11.1 WCAG 2.1 AA — Minimum Compliance Level

This website targets WCAG 2.1 AA compliance as a minimum. For the primary audience (patients in distress, potential elderly users, mobile-first users), many values are stricter than AA minimum.

## 11.2 Contrast Targets

| Text Type | Token Combination | Actual Ratio | WCAG AA Minimum | Target |
|-----------|------------------|-------------|-----------------|--------|
| Primary body text | `color-ink` on `color-surface` | 14.5:1 | 4.5:1 | Exceeds AA significantly |
| Primary body on warm | `color-ink` on `color-surface-warm` | 13.2:1 | 4.5:1 | Exceeds AA |
| Secondary text | `color-ink-secondary` on `color-surface` | 7.2:1 | 4.5:1 | Exceeds AA |
| Link / accent on surface | `color-accent` on `color-surface` | 4.6:1 | 4.5:1 | Passes AA (do not reduce) |
| CTA button text | `color-surface` on `color-accent` | 4.6:1 | 4.5:1 | Passes AA (do not reduce) |
| Light on dark (footer) | `color-surface` on `color-ink` | 14.5:1 | 4.5:1 | Exceeds AA |
| Error text | `color-error` on `color-surface` | ≥4.5:1 | 4.5:1 | Verify on implementation |

**No new color combination is used without verifying contrast.** If a combination is needed that is not in this table, calculate and document the ratio before implementation.

## 11.3 Typography Minimums

| Requirement | Value | Rationale |
|------------|-------|-----------|
| Minimum body text — desktop | 17px | Below this, reading fatigue increases rapidly for the older patients in this audience |
| Minimum body text — mobile | 16px | Below this, most devices require zoom to read comfortably |
| Minimum UI text (labels, captions) | 13px | Constrained by space; sufficient at the weight (600) used |
| Minimum button label | 15px (mobile) | Touch-target readability at normal arm's length |
| Line height — body text | 1.70 minimum | Non-negotiable reading comfort under stress |
| Maximum column width — body | 68 characters | Hard constraint — not a guideline |

## 11.4 Touch Target Sizes

| Element | Minimum | Notes |
|---------|---------|-------|
| Navigation items (mobile drawer) | 48×48px | Use padding to achieve this |
| Hamburger button | 44×44px | Icon is 24×24; surrounding hit area is 44×44 |
| CTA button (mobile) | 44px height minimum | Full width on mobile — width is automatic |
| Form inputs | 44px height | Achieved by padding-top/bottom 16px on 16px text |
| Checkbox/radio | 44×44px hit area | Achieved by enlarging the label's click area |
| Accordion trigger | 48px height | Generous touch target for older patients |
| Card as link | Full card surface | All card content is within the link tap area |

## 11.5 Keyboard Navigation

Every interactive element must be reachable and operable by keyboard alone.

| Requirement | Implementation |
|------------|---------------|
| Tab order follows visual reading order | Verified per page |
| All interactive elements receive `:focus-visible` | 2px `color-accent` outline, 3px offset — never suppressed without replacement |
| Accordion: Space/Enter toggles open/close | Keyboard-accessible with ARIA `aria-expanded` |
| Mobile drawer: Escape closes | Focus returns to hamburger trigger |
| Modal focus trap (if used) | Focus stays inside the modal while open |
| Skip to content link | First focusable element on every page; visually hidden, visible on focus; routes to `#main-content` |

## 11.6 Screen Reader Requirements

| Element | ARIA Requirement |
|---------|----------------|
| Primary navigation | `<nav aria-label="Navigare principală">` |
| Hamburger button | `aria-expanded="false/true"`, `aria-controls="[drawer-id]"`, `aria-label="Deschide meniul"` |
| Accordion items | `aria-expanded` on trigger, `aria-controls` pointing to answer panel, `role="region"` on answer |
| Form fields | `<label for="[id]">` on all inputs; error messages linked with `aria-describedby` |
| Images (meaningful) | Descriptive `alt` text — describes content, not "image of" |
| Images (decorative) | `alt=""` — empty string, not absent |
| Icons (meaningful) | `aria-label` on container or `<title>` in SVG |
| Icons (decorative) | `aria-hidden="true"` |

## 11.7 Elderly Patient Considerations

The patient population for a Romanian neurosurgeon includes patients 50+ for whom digital interfaces may be unfamiliar or physically challenging. These considerations extend WCAG minimums:

**Physical:**
- Touch targets 44–48px minimum (larger than WCAG 2.5.5 advisory guideline)
- No small, tightly-spaced link clusters — patients with reduced motor precision tap wrong targets
- CTA button padding generous enough to be tapped reliably on a mid-range smartphone with a non-ideal grip

**Cognitive:**
- No hidden interaction patterns (hover-only reveals, content behind swipe gestures)
- Consistent navigation — the header looks and behaves identically on every page
- No time-limited interactions — content remains visible without requiring timed response
- Error messages appear next to the relevant field, in clear language, without technical jargon

**Visual:**
- Primary contrast ratio 14.5:1 substantially exceeds minimum — appropriate for patients with reduced contrast sensitivity
- No information conveyed by color alone
- Focus rings clearly visible (2px, `color-accent`) — not suppressed for aesthetic reasons

---

# 12. Phase 2 Opportunities

These are documented for awareness only. **None are implemented in Phase 1.** They are not placeholders in the code. They are recorded here so that Phase 2 design work begins from an informed foundation, not from scratch.

## 12.1 Dark Mode

A dark mode implementation would require a parallel color system:
- `color-surface` → deep warm background (~`#1A1714`)
- `color-ink` → warm cream text
- `color-accent` → adjusted contrast for dark background

**Condition for consideration:** Dark mode in a patient-facing medical context carries the risk of making content feel less trustworthy if not executed with the same rigor as the light mode. It requires a complete design review and separate implementation. It is not achieved by CSS `color-scheme` alone.

**Not recommended** until the light mode has established strong usage patterns and there is confirmed patient-demand evidence.

## 12.2 Multilingual Support

A language selector would require:
- A complete multilingual content strategy (all CPT content in multiple languages)
- WordPress multilingual architecture (WPML or equivalent)
- hreflang URL configuration
- A parallel content workflow for each language

**Not a toggle added to the existing site.** Multilingual is an architectural decision, not a UI addition. If Dr. Ungureanu identifies a significant non-Romanian-speaking patient population (Hungarian-speaking patients in Transylvania, international patients), this becomes a Phase 2 architecture review.

## 12.3 Richer Media Layouts

As the SN Article library grows, some articles may benefit from:
- Inline data tables for comparative treatment information
- Annotated diagram overlays on anatomy illustrations (SVG-based, accessible)
- Embedded audio (doctor's voice explaining a procedure — alternative to text)

Each of these requires content creation investment before design investment. Design the layout when the content exists.

## 12.4 Advanced Timeline

The professional timeline on `/despre` in Phase 1 is a vertical chronological list. Phase 2 possibilities:
- Category grouping with visual color-coded connectors (not filter buttons)
- Decade markers as major anchors in a longer timeline
- Milestone photographs displayed inline for milestone-category entries

**Condition:** More than 15 active timeline entries making a plain vertical list visually unwieldy. This is a content-volume trigger, not a design aspiration.

## 12.5 Interactive Educational Content

Some condition pages could benefit from:
- Anatomy diagrams with patient-accessible interactive labels (tap to expand explanation)
- Self-assessment symptom guides ("Do I have X or Y?") structured as a guided question set
- Recovery timeline with interactive checkpoints

**Condition:** These require significant content work (clinical review, plain-language writing for each interactive element) before design and development. They are not added to pages as design enhancements without verified content. Interactive educational content that is wrong or misleading is worse than no interactive content.

---

# 13. Validation Checklist

Before any component, template, or page is marked complete, verify against this checklist. The checklist is organized by the type of failure it prevents, not by technical domain.

## 13.1 Emotional Clarity

- [ ] A patient arriving anxious would feel slightly less anxious after 8 seconds on this page — before reading any content
- [ ] No element creates urgency, pressure, or a sense that the patient must act immediately
- [ ] No animation or motion competes with or interrupts the reading experience
- [ ] The primary action for this page is immediately visible without scrolling
- [ ] The CTA label is specific and calm ("Programează o consultație" — not "Contact us now")
- [ ] Every heading answers a patient question, not a content category

## 13.2 Trust

- [ ] No marketing language is used anywhere on this page ("world-class," "state-of-the-art," "best," "leading")
- [ ] All photography is genuinely human — real doctor, real environment, warm light
- [ ] No stock photographs of "a doctor" appear anywhere on this page
- [ ] Professional credentials appear after patient-relevant content, not before
- [ ] No countdown timers, scarcity signals, or social proof presented as pressure
- [ ] If colleague recommendations are shown, they carry specific professional context (not generic praise)

## 13.3 Accessibility

- [ ] All text/background combinations pass WCAG 2.1 AA (minimum 4.5:1; primary text targets 7:1+)
- [ ] All interactive elements have visible focus rings (2px `color-accent` outline, 3px offset)
- [ ] Skip to content link is present and functional (first focusable element on the page)
- [ ] All images have appropriate alt text (descriptive for meaningful, empty for decorative)
- [ ] All form fields have visible labels above the input (not placeholder-only)
- [ ] All touch targets are minimum 44×44px
- [ ] All animations are suppressed under `prefers-reduced-motion`
- [ ] No information is conveyed by color alone
- [ ] Navigation is fully keyboard-operable
- [ ] Accordion triggers have `aria-expanded` and `aria-controls` attributes

## 13.4 Consistency

- [ ] All colors come from Global Color tokens — no hex values entered locally
- [ ] All typography comes from Global Typography tokens — no local font overrides
- [ ] All spacing uses values from the spacing system — no arbitrary pixel values
- [ ] Icon style is consistent (line, 1.5px stroke, slightly rounded) throughout
- [ ] Border-radius values match token definitions (buttons: 6px, cards: 8px, tags: 100px)
- [ ] Shadow usage matches permitted rules — not applied as decoration
- [ ] Section background rhythm follows the defined alternating pattern

## 13.5 Patient Comfort

- [ ] Body text is minimum 17px desktop, 16px mobile
- [ ] Body text column width does not exceed 68 characters at any breakpoint
- [ ] Line height is minimum 1.70 for body text
- [ ] Lead paragraph (`type-body-lg`, 19px) is used for the first paragraph of each major section
- [ ] Lists are used only where items are genuinely comparable or sequential — not to fragment reasoning
- [ ] No more than 2 callout boxes per page
- [ ] Medical terms are defined in plain Romanian on first use within the page
- [ ] Recovery timelines and procedure descriptions include specific timeframes where possible

## 13.6 Editorial Quality

- [ ] All SN Article titles answer a patient question or name a patient benefit
- [ ] All condition `patient_title` values are in plain Romanian (not Latin medical terminology)
- [ ] All FAQ questions are phrased as a patient would ask them
- [ ] All biographical content leads with warmth, not credentials
- [ ] All testimonials display only the patient's first name and city (if provided) — no photographs, no surnames, no star ratings
- [ ] The photography brief was followed — genuine, warm-lit, people over equipment

---

*Design System Tokens version: 1.0 — 2026-06-28*
*Source: docs/design-system/APPROVED_VISUAL_DIRECTION.md (governing), COLOR_SYSTEM.md, TYPOGRAPHY_SYSTEM.md, SPACING_SYSTEM.md, BRAND_GUIDELINES.md, DESIGN_PRINCIPLES.md*
*Next: docs/tasks/05_HOMEPAGE.md*
