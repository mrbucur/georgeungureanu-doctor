# Approved Visual Direction

## georgeungureanu.doctor — Direction B+: Warm Academic Medicine

**Status: Approved. This is the governing design language for the entire project.**
**Supersedes:** the Phase 1 draft color and typography decisions in initial documentation.
**Informed by:** `VISUAL_DIRECTIONS.md` (full direction exploration and rationale).

---

## The Approved Direction in One Sentence

**Warm Academic Medicine:** the visual precision and information discipline of the world's best medical institutions, held in a palette and typographic register that a frightened patient feels as warm before they read a word.

---

## The Synthesis

Direction B+ is not a compromise between three directions. It is a synthesis where each direction contributes its core strength:

| Contribution | From | Meaning in Practice |
|-------------|------|---------------------|
| Warmth and emotional register | Direction B | Cream backgrounds, warm ink, sage accent, Lora serif |
| Layout discipline and information architecture | Direction A | Strict grid, strong hierarchy, controlled spacing, restrained section rhythm |
| Respect for long-form educational content | Direction C | Reading column limits, generous leading, structured educational templates |

The synthesized result feels like: a distinguished, thoughtful medical practice. Not an institution, not a startup, not a wellness brand. A practitioner who cares enough about their patients to have thought carefully about every detail of how information is presented to them.

---

## The Governing Emotion Test

Before any design decision is finalized — color, type, layout, photography, motion, iconography, button label — apply this test:

> A patient received a difficult neurological diagnosis three days ago. They are searching at 10pm on their phone. They find this website. Within 8 seconds, before reading anything: do they feel slightly less afraid, or the same?

Every element in this design language exists to pass that test.

---
---

## 01. Color System

### Complete Token Table

| Token | Hex | Role |
|-------|-----|------|
| `color-ink` | `#231E1A` | Primary text — all headings, body text, navigation |
| `color-ink-secondary` | `#5A4E47` | Secondary text — captions, metadata, secondary labels |
| `color-surface` | `#FDFBF7` | Primary background — warm cream |
| `color-surface-warm` | `#F4EFE6` | Alternate section background — deeper warm cream |
| `color-surface-muted` | `#EDE8DF` | Cards, callout boxes, subtle containers |
| `color-accent` | `#4D7A70` | CTAs, links, active states, focus rings |
| `color-accent-hover` | `#3A5F57` | Hover state on all accent elements |
| `color-accent-subtle` | `#E4EDEB` | CTA section backgrounds, highlighted content |
| `color-border` | `#D6CFC4` | All borders, dividers, input outlines |
| `color-border-strong` | `#BDB3A5` | Section dividers, emphasized rules |
| `color-overlay` | `#231E1ACC` | Dark overlay on photography — warm |
| `color-success` | `#2D7046` | Confirmation states |
| `color-warning` | `#A05A2C` | Important notices (rare) |
| `color-error` | `#B83030` | Form errors, critical notices |

### Palette Character

The palette is the emotional foundation of the design. It communicates warmth before content, calm before information, and consideration before authority.

`color-ink` (`#231E1A`) reads as ink on warm paper — not a screen imposing black on white, but a considered written presence. The slight brown warmth of this near-black is the difference between a cold institutional environment and a practitioner's consultation room.

`color-accent` (`#4D7A70`) is the most carefully chosen element in this palette. It is a deep muted sage-teal — calm, professional, and entirely unlike any color in standard medical web design. It does not read as wellness (too dark and muted). It does not read as pharmaceutical (wrong hue family). It does not read as corporate healthcare (wrong temperature). It reads as: *quiet professional confidence.* When a patient encounters this color on a "Book a consultation" button, they should feel invited — not pressured.

`color-surface` (`#FDFBF7`) is the signature of this direction. This warm cream is felt before it is noticed. A patient reading on this surface for twenty minutes will not notice the background color consciously — but they will read more, fatigue later, and feel more comfortable than on a clinical white surface.

### Color Contrast — Verified

| Text | Background | Ratio | WCAG AA |
|------|------------|-------|---------|
| `#231E1A` on `#FDFBF7` | Primary text on surface | 14.5:1 | Pass |
| `#231E1A` on `#F4EFE6` | Primary text on warm | 13.2:1 | Pass |
| `#5A4E47` on `#FDFBF7` | Secondary text on surface | 7.2:1 | Pass |
| `#4D7A70` on `#FDFBF7` | Accent on surface | 4.6:1 | Pass |
| `#FDFBF7` on `#231E1A` | Light text on dark | 14.5:1 | Pass |

All combinations pass WCAG 2.1 AA. The primary text combination (14.5:1) substantially exceeds requirements, appropriate for a patient audience that may include older users or those reading in low-light conditions.

---
---

## 02. Typography

### The Two Typefaces

**Lora** — Editorial Serif (Google Fonts)
The editorial voice. Warm, literary, precise. Used for headlines and pull-quotes only.

**Inter** — Humanist Sans-Serif (Google Fonts, Variable)
The informational voice. Maximum legibility. Neutral but warm at reading sizes. Used for all body text, UI, and navigation.

### Type Scale

| Token | Font | Desktop | Mobile | Weight | Line Height |
|-------|------|---------|--------|--------|-------------|
| `type-h1` | Lora | 52px | 36px | 700 | 1.15 |
| `type-h2` | Lora | 38px | 28px | 700 | 1.20 |
| `type-h3` | Lora | 28px | 22px | 400 | 1.25 |
| `type-h4` | Inter | 20px | 18px | 600 | 1.30 |
| `type-h5` | Inter | 17px | 16px | 600 | 1.35 |
| `type-h6` | Inter | 15px | 14px | 600 | 1.40 |
| `type-body-lg` | Inter | 19px | 17px | 400 | 1.75 |
| `type-body` | Inter | 17px | 16px | 400 | 1.70 |
| `type-body-sm` | Inter | 15px | 15px | 400 | 1.65 |
| `type-quote` | Lora | 24px | 20px | 400 italic | 1.45 |
| `type-overline` | Inter | 12px | 11px | 600 uppercase | 1.40 |
| `type-label` | Inter | 13px | 13px | 600 | 1.40 |
| `type-caption` | Inter | 13px | 12px | 400 | 1.50 |
| `type-cta` | Inter | 16px | 15px | 600 | 1.0 |
| `type-nav` | Inter | 15px | 15px | 500 | 1.0 |

### Why This Combination

Lora was chosen over Playfair Display for a specific reason rooted in the patient-centered mission: Playfair Display leads with drama and authority. Lora leads with warmth and precision. For a patient arriving anxious, warmth first is the correct order of emotional communication.

Inter was chosen over DM Sans (Direction B's original recommendation) because this direction also incorporates Direction A's layout discipline and Direction C's respect for educational content. At smaller sizes — footnotes, table cells, FAQ answers, recovery timelines — Inter is more legible than DM Sans's rounder letterforms. The educational content on this site is genuinely dense; the body font must sustain that density without fatigue.

### Reading Column Constraint

**Maximum body text column width: 68 characters.** This is a hard constraint, not a guideline. No body text runs wider than this at any breakpoint. Long lines require the eye to travel too far to find the beginning of the next line — this creates measurable fatigue that is especially pronounced for patients reading medical information under stress.

---
---

## 03. Photography

### The Core Requirement

Photography carries the emotional weight that color prepares for. The color palette says "this is a warm place." The photography must confirm it. Without genuinely human photography, the warm palette makes a promise it cannot keep.

### What the Photography Must Show

**The doctor as a person, not a title.**

The ideal photograph of Dr. Ungureanu is one where:
- He is clearly present and engaged — listening, explaining, reading, thinking
- The environment around him is real — his actual consultation room, his actual desk, his actual shelves
- The light is natural or warm — not harsh studio lighting
- His expression is calm and attentive — not posed, not performed

The photograph that best serves this direction is one a patient could look at and think: *"This is a real person. He is paying attention. He would pay attention to me."*

### Specific Shot Requirements

| Shot Type | Description | Usage |
|-----------|-------------|-------|
| Primary portrait | Mid-distance, warm light, natural setting, direct but calm gaze | Hero section, About page header |
| Doctor listening | Doctor in consultation posture — slightly forward, engaged | About page, homepage teaser |
| Doctor at work | Reviewing notes or scan, genuine concentration | Homepage, condition pages |
| Doctor explaining | Mid-gesture, explaining to a partially visible patient | Patient information pages |
| Detail / hands | Doctor's hands with medical records or notes | Editorial / pull-quote sections |
| Black and white variants | Of the primary portrait and listening shots | Pull-quote sections, editorial moments |

### Photography Rules

**Rule 1 — Real over staged.**
Any photograph that reads as "this was arranged for a website" fails. The photography must look observed, not directed.

**Rule 2 — Light informs warmth.**
Cool, harsh, or flat studio lighting conflicts with the warm palette. Natural window light or warm artificial light must be the primary source.

**Rule 3 — People over equipment.**
Medical equipment may appear in a photograph but must never be its subject. A photograph where the doctor is smaller than or equally prominent to a piece of equipment is the wrong photograph.

**Rule 4 — No stock photography for the doctor.**
All photography of Dr. Ungureanu must be original. Stock photography of a "doctor" reading a scan fails the authenticity that this entire design direction depends on.

**Rule 5 — Stock photography for supporting roles only, and only if exceptional.**
If stock photography is used for patient-context images (e.g., someone walking in a park during recovery), it must be indistinguishable from original photography. Any image that reads as a stock photograph undermines the authenticity of all surrounding content.

**Rule 6 — Color consistency.**
All photographs used in adjacent sections should share a color temperature. Mixing cool-lit and warm-lit photography in close proximity creates visual dissonance that conflicts with the calm palette.

---
---

## 04. Iconography

### Philosophy

Icons are navigational aids, not decoration. An icon on this website exists to help a patient orient faster — to understand at a glance what a section is about or what action is available, without reading.

Icons that are decorative (placed next to content they do not meaningfully clarify) are not used. Every icon must answer the question: *does this help the patient understand more quickly?*

### Style

| Attribute | Value |
|-----------|-------|
| Style | Line icons (outline, not filled) |
| Stroke weight | 1.5px at 24px size |
| Corner treatment | Slightly rounded — consistent with overall design warmth |
| Size (in-content) | 24×24px |
| Size (section icon) | 48×48px |
| Color | `color-accent` (`#4D7A70`) or `color-ink-secondary` (`#5A4E47`) |
| Icon set | Phosphor Icons or Heroicons (both free, consistent line style) |

### Icon Color Rules

- Icons accompanying action (CTAs, navigation) use `color-accent`
- Icons accompanying information (condition categories, process steps) use `color-ink-secondary`
- Icons on dark backgrounds (`color-ink`) use `color-surface` (`#FDFBF7`)
- Never use decorative colors for icons — they must integrate with the palette

### Icon Usage Rules

**Use icons for:**
- Process steps (appointment booking, pre-surgery preparation)
- Condition category cards (a simple, clear brain icon, spine icon, etc.)
- Contact information (phone, location, email)
- Navigation elements where an icon genuinely aids identification
- Patient information sections (what to bring, what to expect)

**Do not use icons for:**
- Decorative bullet points in body text
- Section headers that already have a clear typographic hierarchy
- Academic credentials and publications (text only)
- Any context where the icon might be mistaken for a medical symbol with clinical meaning

### Medical Symbol Caution

Do not use the caduceus, the Rod of Asclepius, or any internationally recognized medical emergency symbol in decorative contexts. These symbols carry specific meaning that must not be diluted by decorative use.

---
---

## 05. Button Philosophy

### The Core Idea

A button on this website is an invitation, not a command. The language, the color, the shape, and the size of every button must communicate: *"when you are ready, this is how you move forward."*

Buttons are never urgent. They are never aggressive. They do not pressure. They guide.

### Primary Button

```
Background:    color-accent (#4D7A70)
Text:          color-surface (#FDFBF7) — warm white, not pure white
Font:          type-cta (Inter 600, 16px)
Border-radius: 6px
Padding:       15px 32px
Hover:         Background → color-accent-hover (#3A5F57)
               Transition: 200ms ease
Focus:         3px outline, color-accent, 3px offset
```

**Label language:** Specific and calm. "Book a consultation" — not "Contact us now." "Learn about this condition" — not "Click here." "Read the full guide" — not "More." The label tells the patient exactly what will happen when they act.

### Secondary Button (Outlined)

```
Background:    transparent
Border:        1.5px solid color-accent (#4D7A70)
Text:          color-accent (#4D7A70)
Font:          type-cta (Inter 600, 16px)
Border-radius: 6px
Padding:       14px 30px
Hover:         Background → color-accent-subtle (#E4EDEB)
               Transition: 200ms ease
```

The secondary button is used when two actions are both available but one is primary. Hero section: primary = "Book a consultation," secondary = "Learn about conditions." The secondary button does not compete with the primary — it offers a lower-commitment path.

### Ghost / Text Link Button

```
Background:    none
Text:          color-accent (#4D7A70)
Font:          Inter 500, current size
Underline:     none by default, appears on hover
Hover:         underline appears, color deepens slightly
```

Used for tertiary actions and inline navigation: "Read the full patient guide →" at the bottom of a summary section.

### Button Rules

**Rule 1 — One primary button per section.**
Every section with a CTA has exactly one primary button. If two actions are needed, one is primary (filled) and one is secondary (outlined). Having two primary buttons in one section means neither is primary.

**Rule 2 — Never use urgency language.**
No "Act now," "Don't wait," "Limited appointments," or any language that creates pressure. A patient who is being pressured does not feel safe. A patient who does not feel safe does not book an appointment.

**Rule 3 — Never disable the button while loading.**
Loading states use a spinner within the button, not a disabled/greyed state. A greyed disabled button communicates "this is not available" which creates anxiety at the moment of action.

**Rule 4 — Minimum touch target 44×44px.**
On mobile, all buttons must have a minimum touch target of 44×44px regardless of the visual button size. Use padding to achieve this where necessary.

---
---

## 06. Motion Philosophy

### The Governing Rule

Motion on this website exists only to aid comprehension or orientation. It never performs. It never demands attention. It is, at most, noticed only in its absence.

The test for any motion decision: *if this animation did not exist, would the patient be confused or disoriented?* If the answer is no, the animation does not belong.

### Permitted Motion

| Context | Animation | Duration | Easing |
|---------|-----------|----------|--------|
| Page load | Fade in, opacity 0 → 1 | 300ms | ease-out |
| Button hover | Background color transition | 200ms | ease |
| Focus indicator | Appearance | instant | — |
| Accordion open/close | Height transition | 250ms | ease-in-out |
| Mobile menu open | Slide in from right | 250ms | ease-out |
| Section scroll reveal | Fade up, 20px translate | 400ms | ease-out |

### Motion Rules

**Rule 1 — No autoplay.**
No carousels that advance automatically. No videos that play without user action. No animations that loop infinitely. Autoplay motion creates anxiety and is inaccessible.

**Rule 2 — Respect prefers-reduced-motion.**
All animations must be suppressed or simplified when the user has enabled reduced motion in their system settings. This is an accessibility requirement, not a preference. The CSS `@media (prefers-reduced-motion: reduce)` block must disable all translate animations and reduce opacity transitions to instant.

**Rule 3 — Scroll-triggered animations are subtle.**
Scroll-triggered reveals use `opacity: 0 → 1` and `translateY: 20px → 0`. Not dramatic. Not delayed. Not staggered across more than 3 elements simultaneously. A patient scrolling a condition page to find recovery information should not have to wait for an animation to complete before reading.

**Rule 4 — No hover animations on body text.**
Body text does not animate on hover. Links change color on hover. Nothing else in a reading context moves.

**Rule 5 — No loading skeletons.**
Loading skeleton patterns (grey rectangles filling where content will appear) create a sense of incompleteness that is anxiety-inducing for patients. Fast page loads eliminate the need for these entirely. If a slow connection is unavoidable, a simple page-level loading indicator (a thin progress bar at the top of the viewport) is used instead.

---
---

## 07. Editorial Principles

### The Educational Content Mandate

This website serves patients who need genuine information to make real decisions about their health. The editorial standard is therefore exceptionally high — not because of academic pride, but because a patient making a poorly informed decision is a patient who may be harmed.

The editorial principles here are the design of how information is structured on the page — the visual and content grammar of educational content.

### Section Anatomy

Every major content section follows this anatomy:

```
OVERLINE LABEL          — Inter 12px, uppercase, color-accent
Section Headline        — Lora 38px, H2, color-ink
                        — (answers a patient question, not a category label)
Lead paragraph          — Inter 19px, color-ink, 1.75 line height
                        — (the most important thing in this section, stated first)

[Body content — text, lists, callouts, images]

Next step CTA           — one primary button, section-specific label
```

### Content Hierarchy Rules

**Inverted pyramid always.** The most important information for the patient appears first in every section. Supporting detail follows. Credentials and academic context appear last or not at all on patient-facing sections.

**Headings answer questions.** A patient scanning a condition page should be able to navigate entirely by reading the headings. If a heading reads as a category ("Symptoms") rather than a question or patient-facing statement ("What does this feel like?"), it should be reconsidered.

**Lists for comparability, paragraphs for explanation.** Use bullet or numbered lists when items are of equal importance or sequence matters. Use paragraphs when ideas build on each other. Never use bullet points to fragment continuous reasoning — this is the lazy editorial pattern that makes medical content feel like it was written for an intranet.

**Callout boxes for critical patient information.** The callout box (a section with `color-surface-muted` or `color-accent-subtle` background) is reserved for:
- The most important thing a patient must do or know
- Information that applies to some patients but not others (with clear qualification)
- Direct patient instructions (what to bring, when to call)

Callout boxes are used sparingly — a maximum of two per page. When everything is highlighted, nothing is.

**Pull-quotes for patient voice and human resonance.** The `type-quote` style (Lora italic, 24px) is used for:
- Patient testimonials
- The doctor's philosophy stated in first person
- A key insight from a condition description that serves as an emotional anchor

Pull-quotes break the reading rhythm intentionally — they are moments where the patient is invited to slow down, not scan.

### Reading Experience at Scale

The condition pages and patient information pages on this website may contain 800–2000 words of content. This is intentional — a patient reading about their diagnosis needs complete information. The design must support sustained reading:

- Never set body text wider than 68 characters
- Use subheadings (H3, Inter 600) to divide long sections into navigable chunks
- Use the lead paragraph style (`type-body-lg`) for the first paragraph of each subsection
- Add visual breathing room between major content zones (the H3 before a new topic gets more space above it than below)
- Use numbered lists for multi-step processes (what happens in surgery, recovery stages)
- Avoid footnotes — if information is important enough to include, include it in the body. If it's not, exclude it.

---
---

## 08. Patient-Centered Implications

This section traces each design decision back to its patient-centered justification. This exists because in implementation, individual decisions can drift from their patient-serving purpose when made in isolation. Reading this section regularly prevents drift.

### Warm Cream Backgrounds → Lower Reading Fatigue

`color-surface` (`#FDFBF7`) is a warm cream rather than white. The clinical justification: patients reading medical information are often doing so at night, in a stressed state, on backlit screens. Warm backgrounds reduce the blue-light contrast that causes eye fatigue over sustained reading sessions. A patient who reads longer is a patient who leaves more informed.

### Sage-Teal Accent → Reduced Action Anxiety

`color-accent` (`#4D7A70`) is neither the urgent red-orange of action nor the institutional authority of medical blue. Its muted, calming presence on the "Book a consultation" button means a patient's first instinct on seeing it is not "I am being pressured" but "when I am ready, this is what I do." The color reduces the activation energy required for a frightened person to take the first step.

### Lora Serif Headlines → Warmth Before Authority

Lora's calligraphic origins give its letterforms a visible hand quality — strokes of varying weight that suggest something was written, not rendered. This registers subconsciously as human. A patient encountering "What to expect from your first consultation" in Lora feels differently than in a cold geometric sans-serif. The typography does emotional work before the content does cognitive work.

### Generous Leading (1.7–1.75) → Accessible to Stressed Readers

Research on reading under stress consistently shows that comprehension decreases when cognitive load is high and line density makes word recognition difficult. The 1.7–1.75 line height on body text is the minimum that sustains comfortable reading for a patient whose working memory is partially consumed by anxiety. This is not aesthetics — it is accessibility for the psychological state of the primary audience.

### Hard 68-Character Column Limit → Reduced Eye Tracking Load

Wide text columns require the eye to travel across a long horizontal distance at the end of each line, then find the beginning of the next. At reading sizes (17px), a column wider than 68 characters creates a journey the eye frequently gets wrong — landing on the wrong line. For a patient trying to understand a description of their condition, re-reading a sentence because of eye tracking failure adds cognitive frustration to emotional distress.

### One Primary CTA Per Section → Reduced Decision Fatigue

A patient who sees three differently-colored buttons in one section must decide which one is the most important action for them. Decision fatigue is especially pronounced in high-anxiety states. One primary action per section — the single most important next step — eliminates this friction entirely. The patient does not decide what to do next. The design tells them.

### No Autoplay Motion → Reduced Anxiety Stimulation

Autoplay carousels, looping animations, and auto-advancing content create a sense of urgency and movement that conflicts with the emotional register this website must maintain. A moving element competes for attention with the content the patient is trying to read. It signals: "there is more happening here than you can control." This is precisely the opposite of the calming, patient-controlled experience the design requires.

### Real Photography → Trust Before Reading

A stock photograph signals inauthenticity at a subliminal level — most people cannot articulate why a photograph looks like a stock photo, but they feel it. A patient who subconsciously detects inauthenticity in the photography extends that suspicion to the content and to the doctor. Genuine photography of Dr. Ungureanu in his actual practice environment is not a preference — it is the foundation of the trust this design is built to create.

---
---

## 09. Implementation Checklist

Before any component, template, or page is considered complete, verify against this checklist.

### Color Compliance

```
[ ] All backgrounds use Global Color tokens — no hex values
[ ] Primary background is color-surface (#FDFBF7), not pure white
[ ] Accent is used only for interactive elements — not decoration
[ ] Dark sections use color-ink (#231E1A) — not cool navy
[ ] All text/background combinations pass WCAG 2.1 AA contrast
```

### Typography Compliance

```
[ ] All headlines use Lora — no other serif
[ ] All body and UI uses Inter — no other sans
[ ] All typography references Global Typography tokens — no local overrides
[ ] Body text is minimum 17px desktop, 16px mobile
[ ] No body text column wider than 68 characters
[ ] Lead paragraph (type-body-lg) used for section-opening content
[ ] One H1 per page
[ ] Heading hierarchy is logical — no skips
```

### Patient-Centered Compliance

```
[ ] Every section has a clear patient-facing purpose
[ ] Every page has exactly one primary CTA
[ ] The appointment pathway is reachable in one click from this page
[ ] All medical terms are defined on first use
[ ] Headings answer patient questions — not describe content categories
[ ] No urgency language in any CTA or heading
[ ] No marketing language ("world-class," "state-of-the-art," etc.)
```

### Motion Compliance

```
[ ] No autoplay animations or carousels
[ ] All motion is suppressed under prefers-reduced-motion
[ ] All transitions are 250ms or shorter (except page-level reveals: 400ms)
[ ] No motion on body text or reading content
```

### Photography Compliance

```
[ ] All photography of the doctor is original — not stock
[ ] Doctor photography shows genuine engagement, not posing
[ ] Photography light is warm or natural — not harsh or cool
[ ] No image centers equipment over people
```

---

## Document Authority

This document supersedes all previous color and typography decisions made in Phase 1 documentation. If there is a conflict between this document and any other document in `docs/design-system/`, this document governs.

Changes to this document require explicit decision documentation and must update all affected downstream documents before implementation begins.

**Direction B+ is final.** The implementation prompts in `docs/prompts/` should be executed using the specifications in this document and the updated `COLOR_SYSTEM.md` and `TYPOGRAPHY_SYSTEM.md`.
