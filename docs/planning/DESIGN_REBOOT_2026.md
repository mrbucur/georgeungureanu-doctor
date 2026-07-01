# DESIGN REBOOT 2026
## georgeungureanu.doctor — Full Visual Transformation Plan

**Author role:** Award-winning Digital Art Director / Senior Healthcare UX Designer  
**Date:** 2026-06-30  
**Status:** PROPOSAL — awaiting approval before any implementation  
**Scope:** Total visual transformation, not incremental fixes

---

> **The single question that drives every decision in this document:**
> *"Would a patient in 2026 — having just received a neurosurgical diagnosis — believe this was designed by a premium digital studio specifically for a leading neurosurgeon, or would they wonder if it's safe to trust this doctor?"*

---

## PHASE 1 — CRITICAL DESIGN AUDIT

### Honest verdict, rendered with no diplomacy.

---

### 1. What makes the site feel old?

**1.1 The stripe layout — the defining pattern of 2012–2018 WordPress.**

Every section is a self-contained rectangle. White → warm → dark → white → warm → dark. This "striped" architecture is the single most identifiable signature of template-era WordPress. Premium 2026 sites use a continuous canvas with intentional whitespace and rare, purposeful landmark sections. The current site has 7 distinct background colors across the homepage alone, creating visual noise that reads as "assembled from widgets," not "designed."

**1.2 The hero is a two-column placeholder layout from 2015.**

Left column: serif headline + CTA buttons. Right column: a dark square with the text "Fotografie Dr. George Ungureanu." This is not a design — it is an unfilled template wireframe that shipped to production. The dark placeholder box is the size of a cinema screen. It signals to every visitor: *this site is unfinished*. No patient preparing for neurosurgery trusts an unfinished site.

**1.3 The stats section is the most overused design pattern in the history of web templates.**

"15+ / 2.000+ / 98%" in large teal numbers above small grey labels, positioned next to a second large placeholder image. Every SaaS landing page, every freelancer site, every clinic built on Divi or Elementor has this exact section. It communicates *"I used a template"* before communicating any information about the doctor.

**1.4 The expertise cards are Elementor defaults. Literally.**

Six white rectangles with a thin border, a short text label, and zero visual hierarchy. No icons, no category, no hover state, no visual weight. These are the cards that appear when you drag an Elementor Grid widget and forget to style it. They were shipped this way.

**1.5 The "O abordare diferită" section still reads as cold despite the Phase A fix.**

Four pale pills in a 2×2 grid. Even with the warm ivory background, the combination of small pill size, sparse text, and no supporting visual language makes this section feel like a placeholder for a real features section that was never built.

**1.6 The dark CTA strip is a 2013 pattern.**

Dark background. Large centered white serif heading. Single white outline button. "Programați o consultație astăzi." This is the exact pattern from every WordPress theme from 2013–2020. It signals "free theme." Mayo Clinic, Cleveland Clinic, and every premium private clinic have abandoned this pattern. It works against trust instead of building it.

**1.7 The footer has a partially-rendered button.**

The "Detalii și program →" button in the footer has an arrow character that renders differently across environments and has inconsistent visual weight. It looks like a technical oversight.

---

### 2. What design patterns feel like Elementor defaults?

- **The header:** Logo text floated left, single CTA button floated right. No navigation whatsoever. This is the Elementor Header template with zero customization. Every Hello Elementor site starts here.
- **The six expertise cards:** Exactly the default Elementor Posts or Loop Grid widget output with a thin border added.
- **The "Cine este Dr. George Ungureanu" section:** Left-aligned heading, body text below. No typographic hierarchy, no visual device. This is a Text widget dropped into a section.
- **The education/experience lists:** `[AN-AN]: Content` formatted with manual line breaks. No list styling, no visual differentiation between items.
- **The consultation type selector cards on /programari/:** Three boxes with heading, text, and a dark button. These look like the Elementor Pricing Table widget without prices.
- **The numbered "Cum funcționează" steps:** Each number is a large teal numeral followed by a heading and paragraph. This is the Icon Box widget with the icon replaced by text.
- **The philosophy section:** Dark background, heading, small uppercase category label, body text. This is an Elementor Text Section with a background color and nothing else.

Every one of these patterns is recognizable to any designer who has used Elementor. The site reads as assembled, not designed.

---

### 3. What visual elements reduce trust?

**This is the most important section of this audit.**

**3.1 `[CLIENT: ...]` placeholder text is live on the production site.**

The /despre/ page contains visible template instructions to the client — `[CLIENT: Biografie de completat]`, `[CLIENT: Denumire Universitate]`, `[CLIENT: ani experiență]`, `[CLIENT: Denumire spital / cabinet de completat]`, `[CLIENT: Taglinie de completat]`, and more. The /programari/ page has `[CLIENT: Denumire clinică 1]`, `[CLIENT: +40 7XX XXX XXX]`.

A patient who finds this site via search and sees `[CLIENT: Biografie de completat de Dr. Ungureanu]` will close the tab. This is not a minor issue. It is an existential trust failure. No design fix can compensate for it.

**3.2 The header has no navigation.**

A patient visiting the site cannot navigate from the header. There are no navigation links. This creates two problems: (a) the user cannot understand what the site offers or how it's organized, and (b) it makes the site feel like a single-page marketing stub, not a credible professional resource. For a neurosurgeon — a specialist who patients research intensively before trusting — no navigation is disqualifying.

**3.3 Both photo placeholders on the homepage are enormous.**

The hero has a dark box the width of half the viewport. The stats section has a warm box of the same size. These two voids together mean that roughly 40% of the homepage above the fold is visually empty space that communicates "this is a demo." A patient's first instinct is to look for the doctor's face. They see two grey boxes instead.

**3.4 The credentials strip on /despre/ shows `[X]+` for years of experience.**

Without real data, the credentials strip that was designed to convey authority ("15 years, 2000+ surgeries, Hospital X") instead shows template tokens. This inverts the intended effect — it highlights that no real data exists.

**3.5 The site has no personality or human presence.**

There is no photograph of Dr. Ungureanu. There is no voice in the copy. The text that exists is either placeholder or clinical boilerplate ("Prima vizită constă în evaluarea simptomelor..."). Premium healthcare sites in 2026 communicate a specific human being with specific values and a specific approach. This site communicates nothing about who Dr. Ungureanu is.

**3.6 The /programari/ location section is completely empty.**

"Unde consulți" is a dark section with two card slots, both containing `[CLIENT: Denumire clinică]`. A patient trying to book a consultation cannot find where to go. This section should either be filled or removed.

---

### 4. Which sections feel crowded?

- **The /despre/ credentials strip at mobile:** Four columns of data collapse to a scrolling horizontal strip that is not visible at all on mobile — it requires horizontal scroll to read.
- **The /programari/ page:** This is the longest page on the site (~6800px on desktop). It contains: stats strip, consultation type selector, how it works, locations, what to bring, the booking form, FAQ, and another CTA strip. The density is appropriate for a booking flow but there is zero visual breathing room between sections. Every section border-to-border with the next.
- **The afecțiuni-single content body:** The body text has no left margin or visual container distinguishing it from the full-width header. It flows from header to body without any typographic exhale.

---

### 5. Which sections lack hierarchy?

- **The entire /despre/ page:** All sections have the same visual weight. "Cine este Dr. George Ungureanu" (the most important section) has the same typographic treatment as "Activitate Didactică" (a minor credential). There is no visual priority system.
- **The expertise cards:** All six are identical. "Tumori cerebrale" and "Patologie de coloană" have the same visual weight even though they represent different levels of specialization and different patient profiles.
- **The homepage stats:** "15+" and "98%" have the same visual treatment even though one is an experience metric and one is an outcomes metric with very different trust implications.
- **The article single page:** The TL;DR box, headings, body text, callouts, and FAQs all use the same typographic scale. The reader's eye has nowhere to land first.

---

### 6. Which interactions feel static?

**Everything.** There are zero micro-interactions on this site.

- Buttons have no transition on hover (color snaps instantly)
- Cards have no hover state at all
- Links change color abruptly without transition
- There are no scroll-triggered reveals
- The sticky header does not change state on scroll (no compact mode, no blur)
- The FAQ accordion has no animation on open/close
- Images (when they exist) have no hover behavior
- No loading state on the booking form
- No focus ring visible on interactive elements (accessibility concern)

A site with zero transitions in 2026 reads as either unfinished or built by someone who does not think about UX. For a neurosurgeon, this communicates a level of care about detail that is the opposite of what a surgeon wants to project.

---

### 7. What makes the experience feel generic instead of premium?

**The site could belong to any doctor in any specialty in any country.**

- The typography (Lora + Inter) is correct but the scale is too small and the rhythm too compressed.
- The color palette (warm ivory + teal green) is good but used without confidence — the accent color appears on buttons, on the stats numbers, on the credentials label backgrounds, and on empty-state icons. It is not a precious accent; it is everywhere, which makes it feel cheap.
- The card design (white + thin border) is the single most used card design on the web. It has no identity.
- There is no editorial photography. There are no human faces. There is no warmth.
- The site has no art direction. No deliberate composition. No strong visual moment that makes a visitor stop and feel something.
- The footer is a navigation utility. It communicates nothing about who Dr. Ungureanu is or why a patient should trust him.
- The booking flow on /programari/ feels like a generic contact form extended with some explanatory text. It does not feel like the beginning of a relationship with a doctor.

**Final verdict:** This site would pass for a capable junior developer's first Elementor implementation. It would not pass for a $10,000+ digital studio deliverable to a leading neurosurgeon. The design tokens are good. The content architecture is thoughtful. But the execution, the visual language, the interaction design, the content completeness — all are at MVP level, not at the premium private healthcare level the doctor's caliber deserves.

---

---

## PHASE 2 — DESIGN REBOOT PROPOSAL

---

## Section 1 — New Design Philosophy

### The Direction: Quiet Clinical Authority

This is not a rebrand. The color palette, the typefaces, and the content architecture are all directionally correct. What is wrong is everything about how those elements are combined and executed.

The new visual direction has one north star:

> **Every pixel should communicate that this is a serious, experienced, internationally-trained neurosurgeon who will give you the most thoughtful care you have ever received from a physician.**

That communication happens through:

**Quiet confidence, not loud claims.**  
Premium healthcare brands do not shout "98% success rate!" in giant teal numbers. They show evidence of expertise through rich content, precise language, and a design system that itself demonstrates attention to detail. If the CSS is thoughtfully crafted, a sophisticated patient will subconsciously feel that the care will be too.

**Generous whitespace as the primary design element.**  
2026 premium design is not about adding things. It is about the courage to remove things. Apple's healthcare communications use 60–70% white space on key pages. The current site uses approximately 20%. We need to triple the breathing room.

**Editorial typography as the backbone.**  
The headline type (Lora) is excellent but undersized and underweighted. An article-single page on the New York Times or The Economist uses typography so precisely sized and spaced that the design could disappear and the page would still feel premium. That is the target.

**Human presence before clinical information.**  
The first thing a patient should encounter — after the site name — is a sense of who this doctor is as a human being. A photograph. A voice. A philosophy expressed in one sentence. Currently the site leads with "Neurochirurgie de precizie, centrată pe recuperarea dumneavoastră" — which is technically correct but emotionally inert.

**A specific sensibility: Scandinavian Clinical Minimalism**  
Think Karolinska Institute communications. Think Swedish private clinic design — Sophiahemmet, Capio's premium tier. Think the intersection of:
- Nordic restraint (nothing is there unless it earns its place)
- Clinical precision (exact spacing, exact type sizes, no accidents)
- Human warmth (warm ivory base, serif headings, photography of people not procedures)
- Contemporary craft (smooth transitions, considered motion, depth through shadow not color blocks)

This is not the design language of a WordPress site. It is the design language of a place you would trust with your spine.

---

## Section 2 — Header Redesign

### The Problem: No Navigation. No Identity. No Trust.

The current header communicates one thing: *this site was configured in 5 minutes using default Elementor settings.*

It has:
- A text logo (two lines, which means the header is 60px tall — enormous)
- A single CTA button
- No navigation links
- No visual state on scroll
- No mobile menu
- No identity

A patient arriving from search cannot understand what the site offers. There is no way to navigate to "Afecțiuni," "Intervenții," or "Despre." The site is structurally invisible.

### The Proposed Header System

**Three states. One component. Zero Elementor widgets.**

The header must be rebuilt as a pure CSS/PHP component injected via the plugin, not as an Elementor template. This gives us complete control over the sticky behavior, scroll state transitions, and mobile menu.

---

#### State 1 — Default (top of page, over hero)

```
┌──────────────────────────────────────────────────────────────────────────┐
│                                                               (transparent)│
│  Dr. George Ungureanu          Afecțiuni  Intervenții  Articole  Despre  │
│  Neurochirurg primar                                    [Programează →]  │
└──────────────────────────────────────────────────────────────────────────┘
```

- Background: transparent, blending into hero
- Logo: Dr. George Ungureanu (Lora 16px, #FDFBF7) + Neurochirurg primar (Inter 12px, rgba(253,251,247,0.65))
- Nav links: Inter 14px, font-weight 500, #FDFBF7, letter-spacing 0.01em
- CTA: `.gu-btn--accent` filled, compact (36px height), 14px
- Height: 72px
- No border, no background, no shadow

#### State 2 — Compact (after 80px scroll)

```
┌──────────────────────────────────────────────────────────────────────────┐
│  ░░░░░░░░░░░░ backdrop-blur(16px) + rgba(253,251,247,0.88) ░░░░░░░░░░░░ │
│  Dr. George Ungureanu │  Afecțiuni  Intervenții  Articole  Despre  │  [Programează]  │
└──────────────────────────────────────────────────────────────────────────┘
```

- Background: `rgba(253, 251, 247, 0.88)` + `backdrop-filter: blur(16px) saturate(180%)`
- Border-bottom: `1px solid rgba(189, 179, 165, 0.35)`
- Logo: Dr. George Ungureanu (Lora 14px, #231E1A) — one line only
- Nav links: Inter 14px, #231E1A, same hover state
- CTA: same button, now on warm bg
- Height: 56px (reduced from 72px)
- Transition: all 280ms cubic-bezier(0.4, 0, 0.2, 1)

#### State 3 — Mobile (< 768px)

```
┌────────────────────────────────┐
│  Dr. George Ungureanu    [≡]   │
└────────────────────────────────┘
```

Bottom drawer that slides up from 100vh with:
```
┌────────────────────────────────┐
│  ✕                             │
│                                │
│  Afecțiuni                     │
│  Intervenții                   │
│  Articole                      │
│  Despre                        │
│  ─────────────────             │
│  [Programează o consultație]   │
│                                │
└────────────────────────────────┘
```

- Drawer: `background: #FDFBF7`, full screen overlay
- Links: Lora 28px, #231E1A, one per line, 48px touch target
- CTA: `.gu-btn--accent` at 100% width, 52px height
- Animation: slide from bottom with cubic-bezier spring, 320ms

#### Navigation Links (all viewports)

The four navigation destinations, in priority order:
1. **Afecțiuni** → `/afectiuni/` (what patients search for first)
2. **Intervenții** → `/interventii/` (what referred patients look for)
3. **Articole** → `/articole/` (SEO + trust content)
4. **Despre** → `/despre/` (validation of expertise)

Note: "Recomandări" does not appear in navigation until content exists. The programări CTA in the header is the conversion point — it does not need a secondary navigation link.

#### Hover state for nav links

```css
.gu-nav-link::after {
  content: '';
  display: block;
  width: 0;
  height: 1.5px;
  background: currentColor;
  transition: width 200ms ease;
}
.gu-nav-link:hover::after { width: 100%; }
```

No color change. Just a 1.5px underline that grows from left. Precise. Quiet.

---

## Section 3 — Typography Reboot

### The Current Problem

The existing type scale is timid. The body text is 16px, the section headings are 30–38px, and there is almost no variation in weight or size between hierarchy levels. On a 1440px viewport with generous padding, 30px headings read like 18px headings on a 1024px viewport from 2015.

Premium sites in 2026 are not afraid of large type. They use it as the primary visual element.

### Proposed Type Scale

```
DISPLAY (hero headline only)
  Desktop: Lora 700, 72px/1.08, letter-spacing: -0.02em
  Tablet:  Lora 700, 52px/1.08, letter-spacing: -0.02em
  Mobile:  Lora 700, 38px/1.10, letter-spacing: -0.015em

H1 (page title)
  Desktop: Lora 700, 52px/1.12, letter-spacing: -0.015em
  Tablet:  Lora 700, 40px/1.14
  Mobile:  Lora 700, 30px/1.18

H2 (section heading)
  Desktop: Lora 600, 38px/1.20, letter-spacing: -0.01em
  Tablet:  Lora 600, 30px/1.22
  Mobile:  Lora 600, 24px/1.28

H3 (card title, subsection)
  Desktop: Lora 600, 24px/1.28
  Tablet:  Lora 600, 20px/1.32
  Mobile:  Lora 600, 18px/1.35

H4 (label, category)
  Desktop: Inter 600, 13px/1.4, letter-spacing: 0.08em, text-transform: uppercase
  (this is the only uppercase type allowed on the site)

BODY (primary reading text)
  Desktop: Inter 400, 18px/1.72
  Mobile:  Inter 400, 17px/1.68

BODY SMALL (meta, captions, dates)
  Inter 400, 15px/1.60, color: --color-ink-secondary (#6B6460)

OVERLINE (section category label, above headings)
  Inter 500, 12px/1.5, letter-spacing: 0.12em, text-transform: uppercase
  color: --color-accent (#4D7A70)
```

### Editorial Rhythm Rules

1. **Section headings must breathe.** Minimum 20px space between the overline and the H2. Minimum 28px between the H2 and the first body line or element below.

2. **Body paragraphs must breathe.** Line-height 1.72. Paragraph spacing: 1.5em. This is the single biggest improvement to reading comfort.

3. **No compressed headings.** Line-height for H1/H2 must be ≥ 1.12. The current `line-height: 1.0` for CPT single headings is the most visually offensive typographic choice on the site.

4. **Lora is precious.** Use it only for display text, H1, H2, H3, and the CTA heading. Not for labels, meta, navigation, or UI elements.

5. **Inter is the workhorse.** Navigation, body, UI, form labels, meta — everything else.

6. **One font size for buttons.** All `.gu-btn` elements: Inter 500, 14px, letter-spacing 0.015em. No variation.

---

## Section 4 — Section Design Language

### The Fundamental Shift: From Stripes to Canvas

The current site uses a "stripe" layout: alternating background colors create distinct horizontal bands. The new approach uses a **continuous warm canvas** (`--color-surface: #FDFBF7`) with two types of intentional deviation:

1. **Landmark sections** — dark (`#231E1A`): Hero only, and occasionally a section-closing CTA. Maximum one dark landmark per page.
2. **Inset sections** — warm (`--color-surface-warm: #F4EFE6`): Used for supplementary content (how it works steps, FAQ, related content). Not the same as the main canvas — clearly warmer and contained.

Everything else breathes on `#FDFBF7`.

### Section Padding

```
Desktop: padding-top: 120px; padding-bottom: 120px;
Tablet:  padding-top: 80px;  padding-bottom: 80px;
Mobile:  padding-top: 60px;  padding-bottom: 60px;
```

Current padding is approximately 60px desktop. This must double.

### Cards — Three Types Only

**Type 1: Content Card (afecțiuni, intervenții list items)**
```
No border.
Background: #FFFFFF
Box-shadow: 0 2px 8px rgba(35, 30, 26, 0.06), 0 0 0 1px rgba(35, 30, 26, 0.04)
Border-radius: 12px
Padding: 32px
Hover: transform: translateY(-2px); box-shadow: 0 8px 24px rgba(35,30,26,0.10)
Transition: all 240ms cubic-bezier(0.4, 0, 0.2, 1)
```

The shadow system replaces the border. The card floats slightly above the canvas instead of being drawn onto it. On hover, it lifts 2px. This is the single most impactful visual change per line of CSS.

**Type 2: Feature Pill (expertise items, "O abordare" items)**
```
No border. No shadow.
Background: transparent
Left border: 2px solid --color-accent (#4D7A70)
Padding-left: 20px
Hover: background: rgba(77, 122, 112, 0.06)
```

This replaces the generic bordered box with an editorial left-accent style. Used for short feature items — not full cards.

**Type 3: Inset Card (consultation type, step cards)**
```
Background: --color-surface-warm (#F4EFE6)
Border-radius: 16px
Padding: 40px
No shadow. No border.
```

These feel intentionally contained and warm — like a card removed from a filing cabinet, not rendered by a widget.

### Shadows

One shadow scale. Never mix.

```css
--shadow-sm:  0 1px 3px rgba(35,30,26,0.06), 0 0 0 1px rgba(35,30,26,0.04);
--shadow-md:  0 4px 12px rgba(35,30,26,0.08), 0 0 0 1px rgba(35,30,26,0.04);
--shadow-lg:  0 12px 32px rgba(35,30,26,0.12);
--shadow-xl:  0 24px 56px rgba(35,30,26,0.16);
```

Never use `box-shadow: 0px 0px 10px #ccc`. Never.

### Borders

One border color. One border weight.

```css
--border-subtle: 1px solid rgba(189, 179, 165, 0.35);
--border-strong: 1px solid rgba(189, 179, 165, 0.70);
```

`--border-subtle` for dividers and card separation. `--border-strong` for form fields and explicit containers. No colored borders except the left-accent on Feature Pills.

### Border Radius

```css
--radius-sm:   4px  (tags, small badges)
--radius-md:   8px  (buttons, form inputs — upgrade from 6px)
--radius-lg:   12px (content cards)
--radius-xl:   16px (inset cards, large containers)
--radius-full: 9999px (pill tags only)
```

Note: The current `--radius-md: 6px` for buttons is close but a touch mechanical. 8px is the sweet spot between "sharp" and "bubbly" — it reads as precise, not playful.

### Color: Precision Over Abundance

The accent color `#4D7A70` is currently overused. It appears on:
- Buttons (correct)
- Stats numbers (questionable)
- Feature pill backgrounds (incorrect — makes them cold)
- Empty-state icons (acceptable)
- Left border accents (correct)
- Category labels (correct)
- Overline text (correct)

New rule: **`--color-accent` appears only on interactive elements (buttons, links, hover states), active states, overlines, and explicit accents (left borders, icons within content areas).** It must not appear as a background color anywhere except `.gu-btn--accent`.

The stats numbers (`15+`, `2.000+`, `98%`) should be `--color-ink (#231E1A)`, not teal. Their scale (72px display type) is the emphasis. Color emphasis on top of size emphasis is redundant and makes them look like Bootstrap counters.

---

## Section 5 — Interaction Design

### The Standard: Inevitable, Not Decorative

Every interaction should feel like the UI is responding to you, not performing for you.

**Durations:**
```
Micro (hover states, active states):  160–200ms
Standard (panel open, card expand):   240–280ms
Macro (page transition, drawer open): 320–400ms
```

**Easing:**
```css
--ease-out:   cubic-bezier(0.4, 0, 0.2, 1)   /* enter — fast start, slow end */
--ease-in:    cubic-bezier(0.4, 0, 1, 1)      /* exit — slow start, fast end */
--ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1) /* drawer, modal — slight overshoot */
```

### Button States

```css
.gu-btn--accent {
  background: #4D7A70;
  transition: background 160ms var(--ease-out),
              transform  120ms var(--ease-out),
              box-shadow 160ms var(--ease-out);
}
.gu-btn--accent:hover {
  background: #3A5F57;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(77, 122, 112, 0.30);
}
.gu-btn--accent:active {
  transform: translateY(0);
  box-shadow: none;
  background: #2D4A44;
}
```

The `-1px` translateY on hover is the signature of Apple's button interactions. It is subtle enough to be invisible to a non-designer but registers subconsciously as precision.

### Card Hover States

```css
.gu-card {
  transition: transform 240ms var(--ease-out),
              box-shadow 240ms var(--ease-out);
}
.gu-card:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
}
```

Cards lift on hover. They do not change color. They do not reveal elements. They simply float.

### Scroll-Triggered Section Reveals

One pattern. One implementation. No library required.

```css
.gu-reveal {
  opacity: 0;
  transform: translateY(24px);
  transition: opacity 480ms var(--ease-out),
              transform 480ms var(--ease-out);
}
.gu-reveal.is-visible {
  opacity: 1;
  transform: translateY(0);
}
```

Applied to: section headings, card grids, the stats row. A 50ms stagger between grid items. This is implemented with a 10-line IntersectionObserver script. No GSAP, no ScrollTrigger, no external dependency.

### Sticky Header Transition

```css
.gu-header {
  transition: background 280ms var(--ease-out),
              backdrop-filter 280ms var(--ease-out),
              border-color 280ms var(--ease-out),
              height 280ms var(--ease-out);
}
```

The header does not "jump" when you scroll. It glides.

### Focus States

```css
:focus-visible {
  outline: 2px solid #4D7A70;
  outline-offset: 3px;
  border-radius: 4px;
}
```

Every interactive element must have a visible focus ring. Currently none do. This is both an accessibility failure and a trust signal — a site that handles focus states correctly signals that someone was paying attention.

### Accordion (FAQ)

```css
.gu-accordion-body {
  overflow: hidden;
  max-height: 0;
  transition: max-height 300ms var(--ease-out),
              opacity 200ms var(--ease-out);
}
.gu-accordion.is-open .gu-accordion-body {
  max-height: 480px;
  opacity: 1;
}
```

The `+` icon rotates 45° to become a `×`. The content expands smoothly. Nothing snaps.

---

## Section 6 — Image Strategy

### The Non-Negotiable: Real Photography Is the Site

No design intervention can substitute for a photograph of Dr. George Ungureanu. The site currently has:
- 2 large dark placeholder boxes on the homepage
- 1 circular avatar placeholder on /despre/
- 1 small portrait placeholder in the article author bio

Until these are filled with real photography, the site cannot be premium, regardless of CSS quality.

### Photography Art Direction

**Primary portrait (hero + /despre/ header):**
- Location: operating theater background slightly out of focus, OR a clinical office with medical books/models
- Lighting: soft, directional — medical documentary style, not corporate headshot
- Expression: serious but approachable — confident, not cold
- Framing: 3/4 body, not just face — show the person, not a passport photo
- Color treatment: true color, no filters, slightly warm temperature
- Size: minimum 2400×3000px

**Secondary portrait (article bio box, credentials section):**
- Same shoot, different frame — more close-up
- Or a candid: at a conference, reviewing a scan, explaining to a patient

**What NOT to do:**
- Generic stock photography of brains, spines, operating theaters
- Cold blue-toned medical imagery (associates with corporate healthcare)
- AI-generated medical illustrations
- Animated icon sets that look like Flaticon downloads

**For missing photography — interim solution:**
Rather than showing an empty grey box, use a full-bleed warm gradient from `#F4EFE6` to `#E8E0D4` with the doctor's initials `GU` in Lora 700 at 120px. This is intentional, premium, and does not look unfinished. It looks like a deliberate design choice. The dark placeholder box is neither of these things.

### Icons

Use a single icon system. Recommended: **Phosphor Icons** (https://phosphoricons.com) — thin weight (1.5px stroke), which matches the brand's precision. Avoid:
- Font Awesome (overused, reads as 2015)
- Heroicons (good but associated with Tailwind/SaaS)
- Custom SVG drawn inconsistently (current situation on the clock icon vs arrow icons)

Icon size: 20px in UI, 24px in content, 40px as illustration.

### Medical Illustrations

If illustrations are used (for explaining procedures, anatomy), commission them in one style:
- Line art, 1.5px stroke, `#231E1A` on transparent or warm background
- No filled shapes except subtle accent fills
- Same proportion and detail level throughout

Never mix illustration styles on a single site.

---

## Section 7 — Page-by-Page Modernization

### Homepage

**What it should feel like:** A prestigious private clinic's welcome — calm, authoritative, deeply human. The visitor should immediately understand: (1) who this person is, (2) what he specializes in, (3) why they should trust him. All three within the first viewport.

**P0 — Blocking issues (cannot ship without these):**
1. Hero: Replace the dark placeholder box with the interim GU monogram gradient until photography arrives. Or restructure the hero to be type-only (full-width headline, no image column) — a valid editorial approach.
2. Hero layout: Remove the two-column stock template. Consider a full-width editorial hero with the headline in display type and a short sub-headline below.
3. Stats section: Remove the second placeholder image entirely. The stats can stand alone in a horizontal strip — three numbers in a row — with strong typographic treatment.
4. Navigation: Add four navigation links to the header (unblocks all pages).

**P1 — High-impact improvements:**
1. Expertise cards: Redesign from white-border boxes to Feature Pill style with left accent. Add a category overline per card. Reduce from 6 to 3 featured (with a "See all →" link).
2. Stats: Change number color from teal to `#231E1A`. Increase size to 64px display. Add a 14px explanatory line under each number.
3. "O abordare" section: Redesign as a horizontal editorial strip — each differentiator as a Feature Pill with a 1-line heading and 2-line description. Remove the card boxes entirely.
4. CTA strip: Change from dark background + outline button to an inset warm card at full width — `--color-surface-warm` background, filled `.gu-btn--accent` button. Removes the "2013 WordPress" feeling immediately.

**P2 — Polish:**
1. Section reveal animations for expertise cards and stats
2. Hero button hover states with elevation
3. Footer: Add a closing sentence about Dr. Ungureanu's philosophy above the navigation columns

---

### Despre (About)

**What it should feel like:** A medical journal profile of a person you want to trust with your life. Precise, personal, extensive.

**P0 — Blocking issues:**
1. All `[CLIENT: ...]` placeholder text must be replaced with real content. This is not a design task — it is a content task. The page cannot be shown to any real patient in its current state.
2. The hero portrait placeholder must be replaced with real photography or the GU monogram interim treatment.

**P1 — High-impact improvements:**
1. Hero section redesign: Instead of a two-column "photo left, credentials right" layout, consider an editorial approach — full-width, large H1 with the doctor's name, a sub-headline with his specialty, and a large portrait below in an asymmetric layout.
2. "Cine este" section: This should be the emotional heart of the page. Not a text block — format it with pull quotes, a large photo, and a clear 3-paragraph structure: who he is, what drives him, what patients can expect.
3. Credentials strip: Redesign as a horizontal row of 4 large stats in display type, consistent with the homepage stats approach.
4. Section dividers: Instead of alternating background colors, use `<hr>` dividers with generous whitespace. Let the content breathe on a single warm canvas.

**P2 — Polish:**
1. Philosophy section: Add a pull-quote in large Lora italic — one sentence from Dr. Ungureanu's philosophy in quotation marks. This is the most impactful single-element addition possible.
2. Research & Publications: If real publications exist, format them as a proper bibliography list with journal name, year, and DOI link.

---

### Programări (Booking)

**What it should feel like:** The beginning of a medical relationship, not a SaaS signup flow.

**P0 — Blocking issues:**
1. Remove all `[CLIENT: ...]` placeholders. The phone number, location names, and experience stats must be real.
2. The "Unde consulți" section must either contain real clinic information or be removed from the page.

**P1 — High-impact improvements:**
1. Consultation type cards: Redesign as Type 3 (Inset Card) — warm background, no dark buttons. The current dark button on "Programați consultația" is too aggressive for a healthcare context.
2. Page length: The page is 6800px. Consider restructuring into a 2-step flow: Step 1 (choose consultation type) → Step 2 (contact form + location). This reduces cognitive load significantly.
3. "Cum funcționează" steps: Redesign from text numerals to a horizontal 4-step visual timeline at desktop, vertical at mobile.
4. Form design: The contact form needs visual polish — larger input fields (48px height minimum), clear label placement above inputs, a progress indicator if multi-step.

**P2 — Polish:**
1. Add a reassurance strip between the form and the submit button: "Răspundem în 24 de ore. Confidențialitate medicală garantată."
2. After-submission state: Design a success screen that confirms the request and sets expectations for next steps.

---

### Afecțiuni & Intervenții (Archives)

**What they should feel like:** A curated medical library — authoritative, navigable, content-rich.

**P0 — Blocking issues:**
1. More content is needed. Currently 1 item per archive. The empty-state block (Phase A) is a temporary measure, not a solution. The archives need a minimum of 5–8 items to feel functional.

**P1 — High-impact improvements:**
1. Archive hero: Currently dark with centered text. Redesign to a shorter warm-background hero (80px top padding, left-aligned text) that feels like a page header, not a landing page hero.
2. Card redesign: The current single-card is a wide white box with a thin border. Use Type 1 card design (floating shadow, no border, 12px radius) with the title in H3/Lora and a 2-line excerpt.
3. Add a subtle category chip to each card: "Neurochirurgie spinală" etc. in the overline style.
4. The grid at desktop: When more cards exist, use a 3-column grid with different card heights to create editorial visual rhythm.

**P2 — Polish:**
1. Filter bar above the grid: Allow filtering by category (tumori, coloană, vascular etc.)
2. "Aflați mai multe" link: Replace with a contained "Citește →" button using `.gu-btn--ghost`

---

### Afecțiuni & Intervenții (Singles)

**What they should feel like:** A medical reference a patient saves to their phone and shares with family.

**P1 — High-impact improvements:**
1. Hero: Currently dark with white text. The heading line-height is `1.0` (the most compressed possible). Fix to `1.12` minimum. The subtitle should be in the overline style, not a grey paragraph.
2. Content body: The article text is very good but visually monotonous. Add:
   - Generous `max-width: 680px` content column with auto margins
   - H3 sections with the `--color-accent` left-border treatment
   - A custom blockquote style for key callouts (e.g., "Rata de succes: 90–95%")
3. Table of contents: For single pages over 1500 words, add a sticky sidebar TOC at desktop.
4. Related content at the bottom is good — improve the card design to match Type 1.

**P2 — Polish:**
1. Reading progress bar: A 2px `--color-accent` bar at the top of the viewport that fills as the user scrolls. Signals depth of content.
2. Print styles: Patients print these pages. Add `@media print` styles.

---

### Articole (Articles)

**What they should feel like:** A medical publication from a doctor who writes for patients, not for journals.

**P1 — High-impact improvements:**
1. Archive: Redesign from the same template as afecțiuni to a more editorial layout — feature article full-width at top, then a 2-column grid below.
2. Single article: This is the most complete page on the site. Main improvements:
   - TL;DR box: Change from the cold teal-ish background to an Inset Card (warm, `#F4EFE6`)
   - Author bio box: Add a real photograph of Dr. Ungureanu when available
   - Typography: Increase body text to 18px/1.72 for comfortable reading
3. The `[DEMO]` prefix on the article title must be removed in production.

**P2 — Polish:**
1. Share buttons: native Web Share API call on mobile — just one "Distribuie" button
2. Estimated reading time: Already present — good. Make the calculation dynamic based on word count.

---

## Section 8 — Implementation Roadmap

### Principles

- Each phase is independently releasable
- Each phase is reviewed and approved before the next begins
- Content tasks (filling `[CLIENT:]` placeholders) are human tasks — they gate Phase C
- No phase touches Elementor DB unless absolutely required (prefer CSS/PHP over DB editing)

---

### Phase A: Global Visual System
**Effort: 8–12 hours | Risk: Low**

Everything that can be done in CSS alone, without touching any page template.

Tasks:
1. Typography scale — implement the full type scale as CSS overrides on `.elementor-widget-heading` and content elements
2. Section padding — increase to 120px desktop / 80px tablet / 60px mobile via CSS overrides on `.elementor-section`
3. Button redesign — radius 8px, hover elevation, transition system (extends Phase 8.3 work)
4. Card shadow system — replace all `.elementor-widget-image-box` and content cards with shadow-based cards (no border)
5. Scroll reveal system — IntersectionObserver + `.gu-reveal` class, applied to section headings and card grids
6. Focus ring system — universal `:focus-visible` styles
7. Color precision — remove accent color from stats numbers, fix "O abordare" section colors
8. Accordion animation — smooth height transition for FAQ elements

Deliverable: The site feels significantly more premium without a single Elementor DB change.

---

### Phase B: Header + Navigation Rebuild
**Effort: 10–16 hours | Risk: Medium**

Requires either:
- (a) Editing the Elementor header template in the DB (medium risk, Elementor-locked)
- (b) Replacing the Elementor header with a custom PHP/HTML header injected via the plugin (recommended — full control, no Elementor dependency)

Recommended approach (b):
1. Build `gu_header()` PHP function that outputs semantic `<header>` with logo + nav + CTA
2. Add 4 navigation links
3. Implement 3-state scroll behavior (transparent → blur → compact) in JavaScript (~30 lines)
4. Build mobile hamburger menu with bottom-drawer slide animation
5. Hook into `wp_body_open` or theme's header override to inject before Elementor renders
6. CSS for all three states

This completely replaces the Elementor header template with a custom component. The Elementor template can remain in the DB as a fallback or be deleted.

---

### Phase C: Homepage Modernization
**Effort: 6–10 hours | Risk: Medium**
**Blocked by:** Real photography (or interim GU monogram treatment decision)

Tasks:
1. Hero redesign — remove two-column template, implement editorial full-width layout
2. Stats section redesign — remove placeholder image, standalone horizontal stats strip
3. Expertise section — Feature Pill style (replaces generic card grid)
4. "O abordare" section — editorial horizontal strip
5. CTA strip — convert from dark-background to warm inset card

Requires: DB edit of the Elementor homepage template (the hero, stats, and expertise sections are Elementor widgets). High leverage — high risk of visual regression if not QA'd carefully.

---

### Phase D: Content Pages Modernization
**Effort: 8–14 hours | Risk: Low-Medium**
**Blocked by:** All `[CLIENT:]` content filled in by Dr. Ungureanu

Tasks:
1. /despre/ — hero redesign, section breathing room, pull quote, credential strip redesign
2. /programari/ — consultation card redesign, form polish, page length reduction
3. Archive pages — hero shrink, card redesign, filter bar
4. Single CPT pages — content column width, typography, blockquote styles, reading progress
5. Article single — TL;DR box warm treatment, typography upgrade

---

### Total Estimated Effort

| Phase | Scope | Hours | Risk |
|-------|-------|-------|------|
| A | Global CSS + interactions | 8–12 | Low |
| B | Header + navigation rebuild | 10–16 | Medium |
| C | Homepage modernization (Elementor DB) | 6–10 | Medium |
| D | Content pages (post photography + content) | 8–14 | Low-Medium |
| **Total** | | **32–52** | |

---

### What Must Happen Before Any Phase

**Content tasks (human, cannot be automated or designed around):**

1. Dr. Ungureanu writes or dictates his biography (3 paragraphs)
2. Dr. Ungureanu provides real clinic name(s), address(es), and phone number(s)
3. A professional photograph session — at minimum 2 usable portraits
4. The `[CLIENT:]` placeholders on /despre/ and /programari/ are filled

Until these are done, a patient finding the site via search will encounter placeholder text and no photography. No amount of CSS work compensates for this. The content is the product.

---

### Phased Priority Recommendation

If forced to choose one phase to implement first: **Phase B (Header + Navigation).**

Rationale: The complete absence of navigation is the single most damaging structural problem. A patient who arrives and cannot navigate to Afecțiuni, Intervenții, or Despre cannot evaluate the doctor. Navigation is table stakes for any professional website in 2026, and it takes 10 lines of PHP to add it. The return on investment is higher than any visual improvement.

Phase A (global CSS) is second because it improves every page simultaneously with minimal risk.

Phase C and D gate on content — no amount of implementation skill can substitute for Dr. Ungureanu writing his biography and booking a photography session.

---

> **Do not publish AI-generated medical content without explicit human review.**

---

*This document is a proposal only. No code has been changed. Await explicit approval before beginning any phase.*
