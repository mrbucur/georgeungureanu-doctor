# Typography System

## georgeungureanu.doctor — Direction B+: Warm Academic Medicine

**Status: Approved. Updated from Phase 1 draft to reflect Direction B+ selection.**
See `APPROVED_VISUAL_DIRECTION.md` and `VISUAL_DIRECTIONS.md` for context.

---

## Philosophy

Typography is the primary design material on this website. It carries the weight of trust, clarity, and warmth simultaneously — and it does so for a patient who is reading under stress, often on a small screen, often at night.

Direction B+ resolves a specific typographic tension: the need for academic authority (a serif with gravity) against the need for genuine warmth (a serif that does not feel cold or stiff). The choice of Lora over Playfair Display is deliberate. Playfair Display is more dramatic — useful when authority is the primary signal. Lora is more literary — better suited when warmth and sustained readability are the primary signals, with authority delivered through precision of layout and information design rather than the letter forms themselves.

Two typefaces only. No exceptions. No additional display fonts, script accents, or decorative faces.

---

## Typeface Selection

### Primary — Serif (Headlines, Pull-Quotes, Editorial)

**Font: Lora**

- Source: Google Fonts (free, web-optimized, widely cached)
- Variable font: No — use standard weight files for predictable rendering
- Weights used: 400 (Regular), 700 (Bold)
- Italic: Yes — used for pull-quotes, patient testimonials, and publication titles
- Character: A contemporary literary serif rooted in classical calligraphic tradition. Designed by Cyril Mikhailov specifically for on-screen readability. More warmth than Playfair Display; more modernity than Times New Roman; more legibility than Cormorant Garamond. The letter forms have a human quality — they suggest a hand that wrote carefully, not a machine that composed precisely.
- Why Lora over Playfair Display: Playfair Display reads as "editorial authority." Lora reads as "knowledgeable warmth." For a patient-centered practice, the latter is the correct register.
- Why Lora over Cormorant Garamond: Cormorant is beautiful but fragile at body sizes and has a luxury quality inappropriate for this context.
- Alternative if Lora is unavailable: DM Serif Display for large headings only; Merriweather for body-adjacent heading sizes

### Secondary — Sans-Serif (Body Text, UI, Navigation, Labels)

**Font: Inter**

- Source: Google Fonts (free, web-optimized, widely cached)
- Variable font: Yes — use variable font for performance where supported
- Weights used: 400 (Regular), 500 (Medium), 600 (SemiBold)
- Character: A humanist sans-serif designed by Rasmus Andersson specifically for screen interfaces. Maximum legibility at all sizes. Neutral enough at small sizes not to compete with Lora at display sizes. Precise enough at UI sizes to communicate professional care. Inter's open apertures and humanist proportions give it a warmth at reading sizes that purely geometric sans-serifs lack.
- Why Inter over DM Sans: DM Sans is slightly rounder and more approachable but sacrifices legibility at smaller sizes. For a site with dense educational content (condition descriptions, FAQ, recovery timelines), Inter's reading-size precision is the correct trade-off.
- Why Inter over Source Sans 3: Source Sans 3 is excellent but more neutral — almost invisible. Inter has just enough personality to support brand recognition without competing with Lora.
- Alternative if Inter is unavailable: DM Sans, Source Sans 3

---

## Global Typography Scale

All type sizes are defined as Elementor Global Typography styles. No local font overrides are permitted.

### Heading Scale

| Token | Font | Desktop Size | Mobile Size | Weight | Line Height | Letter Spacing |
|-------|------|-------------|------------|--------|-------------|----------------|
| `type-h1` | Lora | 52px | 36px | 700 | 1.15 | 0 |
| `type-h2` | Lora | 38px | 28px | 700 | 1.2 | 0 |
| `type-h3` | Lora | 28px | 22px | 400 | 1.25 | 0 |
| `type-h4` | Inter | 20px | 18px | 600 | 1.3 | 0 |
| `type-h5` | Inter | 17px | 16px | 600 | 1.35 | 0 |
| `type-h6` | Inter | 15px | 14px | 600 | 1.4 | 0 |

**Note on Lora heading weights:** Lora's 700 Bold at display sizes (H1, H2) reads as confident and warm — the strokes have visible calligraphic variation that Playfair Display achieves through dramatic contrast. Lora's 400 Regular at H3 sizes reads as considered and unhurried — appropriate for subsection headings that guide a patient through a long condition page.

### Body Scale

| Token | Font | Desktop Size | Mobile Size | Weight | Line Height |
|-------|------|-------------|------------|--------|-------------|
| `type-body-lg` | Inter | 19px | 17px | 400 | 1.75 |
| `type-body` | Inter | 17px | 16px | 400 | 1.7 |
| `type-body-sm` | Inter | 15px | 15px | 400 | 1.65 |

**Note on line heights:** These line heights are intentionally generous. A patient reading about their condition under stress has reduced working memory and reads at a lower effective level than in a relaxed state. Generous leading (1.7–1.75) reduces cognitive load by making the line separation perceptible without conscious effort. This is not aesthetic preference — it is reading psychology.

### UI Scale

| Token | Font | Desktop Size | Mobile Size | Weight | Line Height |
|-------|------|-------------|------------|--------|-------------|
| `type-label` | Inter | 13px | 13px | 600 | 1.4 |
| `type-caption` | Inter | 13px | 12px | 400 | 1.5 |
| `type-cta` | Inter | 16px | 15px | 600 | 1 |
| `type-nav` | Inter | 15px | 15px | 500 | 1 |

### Special

| Token | Font | Desktop Size | Mobile Size | Weight | Style | Letter Spacing | Usage |
|-------|------|-------------|------------|--------|-------|----------------|-------|
| `type-quote` | Lora | 24px | 20px | 400 | Italic | 0 | Pull-quotes, patient statements |
| `type-overline` | Inter | 12px | 11px | 600 | Uppercase | 0.08em | Section labels above headlines |

---

## Typographic Hierarchy in Practice

The system produces a clear five-level hierarchy:

```
OVERLINE       Inter 12px / 600 / uppercase / 0.08em tracking
Headline H2    Lora 38px / 700
Body lead      Inter 19px / 400 / 1.75 line height
Body           Inter 17px / 400 / 1.7 line height
Caption        Inter 13px / 400 / 1.5 line height
```

A patient scanning a condition page can identify all five levels immediately without reading. This is the goal: the structure is visible before the content is legible.

---

## Spacing and Rhythm

### Letter Spacing

| Context | Value |
|---------|-------|
| All headings (H1–H6) | 0 (default) |
| `type-overline` | 0.08em |
| `type-label` | 0.02em |
| Body and UI | 0 (default) |

Never add letter-spacing to body text. Tracked body text is a decorative gesture at war with readability. It signals style over content — the opposite of this project's philosophy.

### Line Height

| Level | Value | Rationale |
|-------|-------|-----------|
| H1, H2 | 1.15–1.20 | Display text: tighter leading focuses the eye at large sizes |
| H3 | 1.25 | Transition heading: slightly looser than H1/H2 |
| H4–H6 | 1.30–1.40 | Subheadings: legible at smaller sizes |
| Body lead | 1.75 | Maximum legibility for stressed reading |
| Body | 1.70 | Standard legibility for educational content |
| Body small | 1.65 | Adequate for secondary content |
| Captions | 1.50 | Short-form reading |

### Paragraph Spacing

| Transition | Value |
|-----------|-------|
| Between body paragraphs | 1em |
| After heading, before body | 0.5em |
| After body, before heading | 1.5em |
| After heading, before sub-heading | 0.75em |

### Maximum Line Length

**Body text maximum: 68 characters** (approximately 700px container at body size)

This is not a guideline — it is a constraint. Lines longer than 68 characters require the eye to travel too far at the end of a line to find the beginning of the next. For a patient reading medical information, this creates measurable fatigue. No body text column is wider than this limit on any breakpoint.

Pull-quotes: 50 characters maximum.

---

## Typography Rules

### Rule 1: No Local Font Overrides

All typography comes from Global Typography tokens. Individual widgets do not set font family, font size, font weight, or line-height locally. When an Elementor widget's typography field shows a font name rather than "Default" or a global style name, it has been overridden and must be corrected.

### Rule 2: Lora for Editorial Voice, Inter for Functional Voice

The role boundary is clear and should not be violated:

**Lora (Serif):**
- All H1, H2, H3 headings
- Pull-quotes (`type-quote`)
- Doctor biography intro paragraph (displayed large)
- Patient testimonial text

**Inter (Sans-Serif):**
- All body text
- H4, H5, H6 headings
- Navigation, labels, captions, overlines
- Form fields and UI elements
- CTA button text
- All metadata (dates, categories, reading time)

The rule: Lora is the editorial voice. Inter is the informational voice.

### Rule 3: Semantic HTML First

Heading tags (H1–H6) are used for their semantic meaning, not their visual size. A section label that needs to look small does not use H6 — it uses a paragraph with `type-overline` styling. A doctor's name displayed large does not use H1 unless it is genuinely the page's primary heading.

One H1 per page. Always.

### Rule 4: Italic Is Purposeful

Lora italic is used for:
- Pull-quotes and blockquotes
- Patient testimonials (when displayed as attribution)
- Academic publication titles in running text
- Occasional single-word emphasis in editorial contexts

Lora italic is not used for:
- General emphasis (use Inter 600 weight instead)
- Decorative purposes
- Section headings

Inter italic is not used at all.

### Rule 5: All-Caps Is Rare and Bounded

The only all-caps usage in this system is `type-overline`. Overlines are short (2–4 words maximum) and appear only above section headlines. They are never used for body text, navigation, button text, headings, or any element where readability at reading speed is required. All-caps dramatically reduces reading speed and creates a formal distance inappropriate for patient communication.

### Rule 6: Bold Is Inter, Dramatic Is Lora

For emphasis in body text: use Inter 600 (SemiBold). Not italic. Not underline. Not color. Bold weight within the body text column.

For dramatic visual hierarchy: use Lora at display sizes. The visual contrast between Lora 700 at 52px and Inter 400 at 17px is the typographic drama of this system. It should not be supplemented or competed with by additional decorative choices.

---

## Responsive Behavior

### Scaling Approach

Typography scales down for mobile with the following philosophy:
- Display headings (H1, H2) scale down significantly — they are less dramatic on mobile, more legible
- Body text scales down minimally — readability cannot be sacrificed
- UI text does not scale — navigation and labels must remain consistent across breakpoints

### Mobile Minimums

**Body text minimum on mobile: 16px.** Never smaller. A 15px body on mobile requires zooming on many devices for comfortable reading.

**H1 minimum on mobile: 32px.** Smaller than this and the Lora serif loses its character at narrow widths.

---

## Long-Form Educational Content

This direction incorporates Direction C's respect for educational content. On condition pages, procedure pages, and FAQ sections, typography does additional work:

- **Lead paragraph** (`type-body-lg`, 19px): The first paragraph of each major section is set larger. This signals "start here" and rewards the patient who begins reading.
- **Numbered or bulleted lists**: Inter 17px, with 1.6 line height and additional 0.5em spacing between list items. Lists on medical information pages must never feel dense.
- **Inline callout boxes**: Use `color-accent-subtle` background with Inter 17px text, slightly indented. Callout boxes are used for the most critical patient-facing information: "What to bring to your appointment," "When to call the office."
- **FAQ items**: The question is set in Inter 17px 600 (bold). The answer uses standard `type-body`. The visual contrast between question weight and answer weight guides the patient's eye instantly.

---

## Accessibility

| Requirement | Value | Standard |
|------------|-------|----------|
| Minimum body text size (desktop) | 17px | WCAG 2.1 |
| Minimum body text size (mobile) | 16px | WCAG 2.1 |
| Body text contrast on `color-surface` | `#231E1A` on `#FDFBF7` → 14.5:1 | WCAG AA requires 4.5:1 |
| Secondary text contrast | `#5A4E47` on `#FDFBF7` → 7.2:1 | WCAG AA requires 4.5:1 |
| Accent text on white | `#4D7A70` on `#FDFBF7` → 4.6:1 | WCAG AA: pass |
| Minimum link text contrast | 4.5:1 against background | WCAG 2.1 AA |
| Font loading strategy | `font-display: swap` | Core Web Vitals |
| System font fallback (serif) | Georgia, serif | Fallback chain |
| System font fallback (sans) | system-ui, -apple-system, sans-serif | Fallback chain |

All contrast ratios verified against the B+ color palette. The warm backgrounds (`#FDFBF7`, `#F4EFE6`) have been tested to confirm that the warm near-black text (`#231E1A`) maintains compliance across all surface colors in the system.
