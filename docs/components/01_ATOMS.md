# Atoms

## georgeungureanu.doctor — Level 1: Atomic Components

**Governing source:** `docs/design-system/APPROVED_VISUAL_DIRECTION.md`
**Direction:** B+ — Warm Academic Medicine
**Prerequisite:** Global design system configured per `docs/implementation/01_DESIGN_SYSTEM_SETUP.md`

---

## What Atoms Are

Atoms are the smallest possible design unit. They cannot be broken down further without losing their meaning. An atom is a single typographic style, a single button, a single input field, a single icon.

Every atom uses **Global Colors** and **Global Typography** exclusively. No atom sets a local font family, font size, or color hex value. This is the foundational constraint of the entire system.

In Elementor, atoms correspond to individual **widgets** configured with Global settings. They are saved as **Global Widgets** so that any change propagates everywhere the atom is used.

**The patient-centered test for every atom:**
> Does this element, in isolation, reduce visual noise and make it easier for a patient to read, navigate, or act?

---

## Group 1 — Typography Atoms

Typography atoms are the text elements that make up all content on the site. They are not decorative. They are the primary communication channel.

---

### `atom-overline`

**Purpose:** A short, uppercase, letter-spaced label that appears above section headlines to orient the patient to the content category below.

**Patient-centered rationale:** A patient scanning a long page needs to understand section context before committing to reading. The overline answers "what is this section about?" in a glance, before the patient reads the headline.

**Visual specification:**
```
Font:           Inter (type-overline)
Size:           12px desktop / 11px mobile
Weight:         600 (SemiBold)
Transform:      Uppercase
Letter-spacing: 0.08em
Color:          color-accent (#4D7A70)
Line height:    1.40
```

**Allowed variants:**
- Default: `color-accent` on light backgrounds
- Inverted: `color-accent-subtle` on `section-dark` backgrounds

**Composition rules:**
- Maximum 4 words
- Always appears immediately above `atom-h2` — never floating alone
- Space between overline and headline below: `space-3` (12px)
- Space above overline (from preceding content): `space-16` minimum (64px)

**Accessibility:**
- Do not rely on uppercase alone for meaning — the content must be meaningful in sentence case too
- Screen readers read uppercase text normally; letter-spacing has no accessible equivalent, so the text must be comprehensible at normal case

**Mobile behavior:** Size drops to 11px. Uppercase + letter-spacing are maintained. The visual weight is sufficient at this size.

**Elementor implementation:**
- Widget: Text Editor or Heading (set to custom class `text-overline`)
- Typography: Global "Overline"
- Color: Global "Accent"
- The `.text-overline` CSS class in `elementor/custom.css` enforces uppercase and letter-spacing

**Usage examples:**
- "CE TRATĂM" above "Condiții în care ne specializăm"
- "DESPRE DR. UNGUREANU" above "Medicul care explică, nu doar tratează"
- "PENTRU PACIENȚI" above "Ce să aștepți la prima consultație"

**Forbidden:**
- Using as a standalone element without an H2 immediately below
- More than 4 words
- Sentence case or mixed case
- Any color other than `color-accent` or the inverted variant
- Using as a navigation label or button label

---

### `atom-h1`

**Purpose:** The primary heading of a page. Establishes the page's topic for the patient before they read anything else.

**Patient-centered rationale:** A patient who arrives on a condition page must immediately understand what condition is being discussed. The H1 answers "am I in the right place?" before any scrolling.

**Visual specification:**
```
Font:           Lora (type-h1)
Size:           52px desktop / 40px tablet / 36px mobile
Weight:         700 (Bold)
Color:          color-ink (#231E1A) or color-surface on dark backgrounds
Line height:    1.15
Letter-spacing: 0
```

**Allowed variants:**
- Dark background: white (`color-surface`) text on hero photography
- Standard: `color-ink` on light page backgrounds

**Composition rules:**
- Exactly one H1 per page — this is a hard rule
- Maximum 10–12 words for readability at display size
- Lora at 52px is warm and literary — headlines should match that register; they are not marketing slogans
- Typically preceded by `atom-overline` in hero contexts

**Accessibility:**
- Must be the semantically first heading on the page
- Screen readers announce H1 as the page title
- Do not use H1 for visual effect on elements that are not the primary page heading

**Mobile behavior:** 36px. Lora at 36px remains commanding and warm. Long headlines may wrap to 3 lines on mobile — acceptable. Max 10 words prevents awkward wraps.

**Elementor implementation:**
- Widget: Heading (set to H1 tag)
- Typography: Global "H1 — Page Title"
- Color: Global "Ink" (or "Surface" on dark)
- Custom ID: `atom-h1-[page-section]`

**Usage examples:**
- Hero: "Claritate. Precizie. Îngrijire."
- Condition page: "Tumori cerebrale — ce trebuie să știi"
- About page: "Dr. George Ungureanu"

**Forbidden:**
- Using H1 more than once per page
- H1 text that is the doctor's name alone (on patient-facing pages)
- H1 text longer than 12 words
- Using Heading widget with H1 tag for visual sizing purposes on non-primary headings

---

### `atom-h2`

**Purpose:** Section headline. Announces what each major section of a page is about and what it offers the patient.

**Patient-centered rationale:** Patients frequently scan rather than read, especially on a first visit. H2 headings are the primary scanning anchors. A patient must be able to understand the full structure of a page by reading only the H2 headings.

**Visual specification:**
```
Font:           Lora (type-h2)
Size:           38px desktop / 32px tablet / 28px mobile
Weight:         700 (Bold)
Color:          color-ink or color-surface (on dark)
Line height:    1.20
```

**Allowed variants:** Standard and inverted (dark section). No decorative or highlighted variants.

**Composition rules:**
- Headings that answer patient questions are strongly preferred over category labels:
  - Preferred: "Ce să aștepți la prima consultație"
  - Avoid: "Prima Consultație"
- Typically preceded by `atom-overline` when opening a new section
- One H2 per section — multiple H2 headings compete and create confusion
- Space above H2 (from preceding body content): `space-16` (64px)
- Space below H2 (before body content): `space-6` (24px)

**Accessibility:** Used for all major section landmarks; screen reader users navigate by headings. H2 must follow H1 logically.

**Mobile behavior:** 28px. Retains Lora warmth. Wraps gracefully to 2 lines if needed.

**Elementor implementation:**
- Widget: Heading (H2 tag)
- Typography: Global "H2 — Section Headline"
- Custom ID: `atom-h2-[section-name]`

**Forbidden:**
- Multiple H2 elements in a single section
- H2 text that does not orient the patient to what follows
- Using H2 for visual decoration (large decorative text)

---

### `atom-h3`

**Purpose:** Subsection heading within a content section. Divides a long section into named, navigable chunks.

**Patient-centered rationale:** Condition pages may contain 1,000–2,000 words. A patient looking for "what does recovery look like?" must be able to navigate directly there without reading everything. H3 headings make this possible.

**Visual specification:**
```
Font:           Lora (type-h3)
Size:           28px desktop / 24px tablet / 22px mobile
Weight:         400 (Regular — not Bold)
Color:          color-ink
Line height:    1.25
```

**Important:** H3 uses Lora Regular (400), not Bold. This creates a clear visual distinction from H2 (700 Bold) at a glance. The patient can immediately see H3 is a secondary level without reading the hierarchy.

**Composition rules:**
- Space above H3 (from preceding body): `space-10` (40px)
- Space below H3 (before body): `space-4` (16px)
- No overline preceding H3 — overlines only accompany H2
- Can appear multiple times within a section

**Accessibility:** Must follow H2 logically — do not skip from H1 to H3.

**Mobile behavior:** 22px Lora Regular. Still distinctly a heading, clearly lighter than H2.

**Elementor implementation:**
- Widget: Heading (H3 tag)
- Typography: Global "H3 — Subsection Headline"

**Forbidden:**
- Using H3 Bold (weight is always Regular in this system)
- Skipping H3 and using H4 where H3 is semantically correct

---

### `atom-h4`

**Purpose:** Card headline, named sub-element heading within a section. Switches to Inter — the informational voice.

**Patient-centered rationale:** H4 marks a transition from editorial/narrative context (Lora) to functional/navigational context (Inter). On a condition card, the H4 names the condition clearly so a patient can scan all cards quickly.

**Visual specification:**
```
Font:           Inter (type-h4)
Size:           20px desktop / 19px tablet / 18px mobile
Weight:         600 (SemiBold)
Color:          color-ink
Line height:    1.30
```

**Composition rules:** Used inside cards, accordions, and named list items. Not typically preceded by an overline.

**Mobile behavior:** 18px Inter SemiBold. Compact and clear.

**Elementor implementation:**
- Widget: Heading (H4 tag)
- Typography: Global "H4 — Card Headline"

**Forbidden:**
- Using H4 as a section headline (use H2 or H3)
- Using Lora for H4

---

### `atom-h5` and `atom-h6` *(Future scope — not part of MVP)*

H5 and H6 are **deferred** from the active heading system.

**Why:** The active heading hierarchy — H1, H2, H3, H4 — covers every patient-facing content pattern in this site. H5 and H6 were originally noted for sidebar labels, metadata headings, and table column headers. After review, those cases are served more cleanly and semantically correctly by existing atoms:

| Use case | Use instead |
|----------|-------------|
| Sidebar label | `atom-label` (Inter 600, 13px, 0.02em spacing) |
| Metadata heading | `atom-overline` or `atom-label` |
| Table column header | `atom-label` styled via the table's `<th>` element |

**If H5 or H6 are ever needed** (e.g., complex tables on a publications page), they should be documented at that point with full specification. Do not introduce them speculatively.

**Active heading system:** H1, H2, H3, H4 only.

---

### `atom-body-lg`

**Purpose:** Lead paragraph. The first paragraph of a section, set larger than body text, drawing the patient into the section's key message.

**Patient-centered rationale:** A patient who is scanning may read only the first sentence of each section. Setting the first paragraph larger ensures that the most important information in each section is encountered even by scanning patients.

**Visual specification:**
```
Font:           Inter (type-body-lg)
Size:           19px desktop / 18px tablet / 17px mobile
Weight:         400 (Regular)
Color:          color-ink
Line height:    1.75
Max width:      700px (reading column)
```

**Composition rules:**
- Used exclusively as the first paragraph of a major section
- Maximum 3–4 sentences
- Must contain the most important thing the patient needs to know in this section
- Followed by `atom-body` for subsequent paragraphs

**Mobile behavior:** 17px — still visibly larger than body (16px) but the difference is subtle. The leading (1.75) maintains generous readability.

**Elementor implementation:**
- Widget: Text Editor
- Typography: Global "Body Large"
- Container: must have `reading-column` class applied

**Forbidden:**
- Using as a decorative large text element
- Multiple lead paragraphs in one section
- Width wider than 700px

---

### `atom-body`

**Purpose:** Standard body text for all patient-facing content.

**Patient-centered rationale:** This is where the actual information lives. Patients spend most of their time reading body text. Its size, line height, and color are the most consequential typographic decisions on the site.

**Visual specification:**
```
Font:           Inter (type-body)
Size:           17px desktop / 17px tablet / 16px mobile
Weight:         400 (Regular)
Color:          color-ink
Line height:    1.70
Max width:      700px (reading column)
```

**Composition rules:**
- Maximum paragraph length: 4–5 lines on desktop
- Paragraph spacing: `space-4` (16px) between paragraphs
- Every `atom-body` container must have `reading-column` class (max-width 700px)
- Strong emphasis: use Inter 600 (SemiBold) inline, never italic

**Accessibility:** 16px minimum on mobile. 4.5:1 contrast minimum — `color-ink` on `color-surface` is 14.5:1, well above requirement.

**Mobile behavior:** 16px — the minimum acceptable for sustained reading. Line height 1.70 is maintained at mobile sizes.

**Elementor implementation:**
- Widget: Text Editor
- Typography: Global "Body"
- Container must have `reading-column` class

**Forbidden:**
- Body text below 16px at any breakpoint
- Body text wider than 700px
- Justified text alignment (creates irregular word spacing that impairs reading)
- Centered body text in paragraphs (acceptable for 1–2 line captions only)

---

### `atom-body-sm`

**Purpose:** Secondary body text for supplementary information, card descriptions, and annotations.

**Visual specification:**
```
Font:           Inter (type-body-sm)
Size:           15px desktop / 15px mobile
Weight:         400 (Regular)
Color:          color-ink or color-ink-secondary
Line height:    1.65
```

**Composition rules:** Used inside cards, metadata areas, and secondary content. Never for primary patient education content — if information matters to the patient's decision, use `atom-body`.

**Forbidden:** Using as the primary content type on condition or FAQ pages. Secondary text is secondary.

---

### `atom-pull-quote`

**Purpose:** A highlighted patient statement, doctor philosophy statement, or key insight that breaks the reading rhythm intentionally.

**Patient-centered rationale:** A frightened patient who is scanning may stop at a pull-quote because it is visually distinct. A well-chosen pull-quote can deliver the emotional core of a section without the patient reading the full content around it. It is the most human element in the editorial system.

**Visual specification:**
```
Font:           Lora (type-quote)
Size:           24px desktop / 22px tablet / 20px mobile
Weight:         400 (Regular)
Style:          Italic
Color:          color-ink
Line height:    1.45
Max width:      600px
Border left:    3px solid color-accent, padding-left space-6
```

**Allowed variants:**
- Standard: `color-ink` text, `color-accent` left border
- Dark section: `color-surface` text, `color-accent-subtle` left border

**Composition rules:**
- Maximum 2–3 sentences or approximately 40 words
- Always attributed (doctor name, patient first name + condition, or source)
- Attribution uses `atom-caption` style
- Never used more than once per section
- Requires `space-8` (32px) margin above and below

**Accessibility:** Blockquote element (`<blockquote>`) for semantic correctness.

**Elementor implementation:**
- Widget: Text Editor with `<blockquote>` tag
- Or: custom HTML widget with the blockquote structure
- CSS class `callout-box` provides the left border styling from `custom.css`
- Apply manually for the left-border variant

**Forbidden:**
- Pull-quotes without attribution
- Pull-quotes longer than 40 words
- More than one pull-quote per section
- Using pull-quotes for marketing claims ("Best neurosurgeon in Romania")

---

### `atom-caption`

**Purpose:** Short supporting text below images, inside cards, or attributing a pull-quote.

**Visual specification:**
```
Font:           Inter (type-caption)
Size:           13px desktop / 12px mobile
Weight:         400 (Regular)
Color:          color-ink-secondary
Line height:    1.50
```

**Forbidden:** Using as body text. Using for primary information. Any content that requires more than 2 lines.

---

### `atom-label`

**Purpose:** Form field label. Names a form input for the patient.

**Visual specification:**
```
Font:           Inter (type-label)
Size:           13px desktop / 13px mobile
Weight:         600 (SemiBold)
Color:          color-ink
Letter-spacing: 0.02em
```

**Accessibility:** Labels must be explicitly associated with their input via `for` / `id` pairing. Never use placeholder text as a substitute for a label. When the field has content, the placeholder disappears — the patient must still be able to identify the field.

**Forbidden:** Using placeholder text as the only label. Hiding labels for "cleaner" appearance.

---

## Group 2 — Interactive Atoms

---

### `atom-button-primary`

**Purpose:** The primary call to action. The single most important action available to the patient in a given section.

**Patient-centered rationale:** A patient who decides to act needs one clear, calm invitation. The primary button is that invitation. It does not shout. It is simply there, in `color-accent`, waiting. The sage-teal color communicates "when you are ready" rather than "act now."

**Visual specification:**
```
Background:     color-accent (#4D7A70)
Text color:     color-surface (#FDFBF7)
Font:           Inter (type-cta) — 16px, 600 weight
Border-radius:  6px (radius-md)
Padding:        15px top/bottom, 32px left/right
Border:         none
Hover:          background → color-accent-hover (#3A5F57), transition 200ms ease
Focus:          3px outline color-accent, 3px offset (from global CSS)
Min touch:      44px height on mobile
```

**Allowed variants:**
- Default (described above)
- Small: 12px top/bottom, 24px left/right padding — for header CTA only
- Full-width: `width: 100%` on mobile within form contexts

**Composition rules:**
- One primary button per section — never two
- Label must be specific: "Programează o consultație", "Citește despre această condiție"
- Never: "Click here", "Submit", "More", "Send"
- Icon optional: use `atom-icon` to the right of the label, `space-2` (8px) gap

**Accessibility:**
- Minimum touch target 44×44px on mobile
- Label must describe the action fully without context ("Book a consultation" not "Book")
- Loading state: show spinner inside button, never disable or grey the button
- Focus ring from global CSS is sufficient — do not add additional focus styles

**Mobile behavior:** Full-width in single-column layouts unless appearing alongside a secondary button. Padding reduces to 12px/24px to maintain 44px height without excess bulk.

**Elementor implementation:**
- Widget: Button
- Typography: Global "CTA Button"
- Background: Global Color "Accent"
- Text color: Global Color "Surface"
- Border radius: 6px
- Saved as Global Widget `atom-button-primary`

**Usage examples:**
- "Programează o consultație"
- "Trimite mesajul"
- "Citește ghidul complet"
- "Află mai multe despre această condiție"

**Forbidden:**
- Two primary buttons in one section
- Urgency language ("Acum", "Imediat", "Nu rata")
- Disabling the button during loading
- Changing color outside the defined variants
- Using primary button for navigation (use ghost button or link instead)

---

### `atom-button-secondary`

**Purpose:** A lower-commitment alternative action when two paths exist for the patient.

**Patient-centered rationale:** A patient who is not ready to book an appointment may still want to learn more. The secondary button offers that path without abandoning them. It lowers the activation energy required by presenting a less committed option alongside the primary action.

**Visual specification:**
```
Background:     transparent
Border:         1.5px solid color-accent (#4D7A70)
Text color:     color-accent (#4D7A70)
Font:           Inter (type-cta) — 16px, 600 weight
Border-radius:  6px
Padding:        14px top/bottom, 30px left/right
Hover:          background → color-accent-subtle (#E4EDEB), transition 200ms ease
```

**Composition rules:**
- Always paired with a primary button — never alone (if only one action, use primary)
- Must always be visually subordinate to the primary button
- Same label specificity rules as primary button

**Mobile behavior:** Stacks below the primary button in mobile single-column layouts.

**Elementor implementation:**
- Widget: Button
- Typography: Global "CTA Button"
- Background: none
- Border: 1.5px, Global Color "Accent"
- Text: Global Color "Accent"
- Saved as Global Widget `atom-button-secondary`

**Forbidden:**
- Using secondary button alone (without a primary button in the same section)
- Secondary button as the primary visual weight on the page
- Using for destructive or irreversible actions

---

### `atom-button-ghost`

**Purpose:** Tertiary action or inline navigation link styled as a button.

**Patient-centered rationale:** On section endings, a ghost button ("Citește ghidul complet →") allows a patient who wants more information to continue without being pressured. It is visually quiet and respects the patient's pace.

**Visual specification:**
```
Background:     none
Border:         none
Text color:     color-accent (#4D7A70)
Font:           Inter, 500 weight, current body size or 16px
Underline:      none by default, appears on hover
Arrow:          optional " →" appended to label
Hover:          underline appears, color deepens to color-accent-hover
```

**Composition rules:** Used for section-ending "read more" links, navigation-style links that aren't inside nav molecules, and inline section-to-section transitions.

**Mobile behavior:** Tap target minimum 44px height via padding. The hover underline becomes the tap indication.

**Elementor implementation:**
- Widget: Button (minimal style) or Text Editor with custom link styling
- Alternatively: standard anchor link styled via the global link CSS in `custom.css`

**Forbidden:**
- Using for primary actions
- Using where `atom-button-primary` or `atom-button-secondary` is more appropriate

---

### `atom-link-inline`

**Purpose:** A hyperlink within body text that navigates to another page or section.

**Visual specification:**
```
Color:          color-accent (#4D7A70)
Text-decoration: underline (always — inline links are always underlined)
Underline offset: 3px
Hover:          color-accent-hover, underline thickness increases to 2px
Font:           inherits body font — same size as surrounding text
```

**Patient-centered rationale:** A patient reading about a condition may encounter a link to a related condition page. The underline signals "this is clickable" without requiring the patient to hover. It is the most accessible link style.

**Accessibility:** Never remove the underline from inline body text links. Color alone is not sufficient to distinguish a link from body text.

**Elementor implementation:** Applied via standard anchor tags in the Text Editor widget. Global CSS in `custom.css` handles `p a` styling automatically.

**Forbidden:**
- Removing underline from inline body text links
- Link text of "click here," "here," or "read more" without context

---

## Group 3 — Structural Atoms

---

### `atom-divider`

**Purpose:** A visual separator between content elements within a section.

**Visual specification:**
```
Height:         1px
Color:          color-border (#D6CFC4)
Margin:         space-12 (48px) top and bottom
Width:          100% of container
```

**Patient-centered rationale:** Dividers reduce cognitive load by making section separations visible without requiring the patient to read headings. Used sparingly — background alternation handles most section separations.

**Allowed variants:**
- Standard: 1px `color-border`
- Strong: 2px `color-border-strong` (`atom-divider-strong`) — for major content separations

**Composition rules:** Maximum one divider between any two content elements. Do not use dividers as decoration. If a section background changes, a divider is redundant.

**Elementor implementation:** Widget: Divider. Color: Global "Border". Width: 100%.

**Forbidden:**
- Colored dividers (only border colors)
- Decorative dividers with patterns or icons
- Multiple dividers in quick succession

---

### `atom-icon`

**Purpose:** A single line-icon that provides visual orientation for a content element.

**Patient-centered rationale:** Icons help patients orient faster when scanning — a phone icon before a phone number, a location icon before an address. They reduce the cognitive step of parsing text to understand meaning.

**Visual specification:**
```
Style:          Phosphor Icons or Heroicons (line/outline style)
Stroke weight:  1.5px at 24px size
Size (inline):  24×24px
Size (section): 48×48px
Color:          color-accent (action context) or color-ink-secondary (info context)
```

**Composition rules:**
- Icons accompany text — never stand alone
- Icon meaning must be obvious without the accompanying text
- Medical symbols (caduceus, cross, Rod of Asclepius) are not used decoratively

**Accessibility:**
- Icons that accompany visible text: `aria-hidden="true"` on the SVG
- Icons that stand alone (icon-only buttons): must have `aria-label` on the button

**Elementor implementation:**
- Widget: Icon
- Icon set: Heroicons or Phosphor (configured via Elementor icon settings)
- Color: Global Color (Accent or Ink Secondary)

**Forbidden:**
- Icons without accompanying text (except icon-only buttons with aria-label)
- Icons as decoration alongside headings where no navigational benefit exists
- Medical emergency symbols in decorative contexts

---

### `atom-icon-box`

**Purpose:** An icon displayed within a contained background shape — a square or circle with a tint background.

**Visual specification:**
```
Container size: 48×48px (standard) or 64×64px (featured)
Background:     color-accent-subtle (#E4EDEB)
Border-radius:  8px (square with rounded corners)
Icon:           24×24px, color-accent
```

**Composition rules:** Used as the visual anchor for condition cards and process-step items. The `color-accent-subtle` background ties the icon to the accent system without using the full accent color.

**Elementor implementation:**
- Widget: Icon widget inside a Container with background set to Global Color "Accent Subtle"
- Container: 48×48px with `border-radius: 8px` via custom CSS or Elementor's border control

**Forbidden:**
- Using `color-accent` as the icon-box background (too strong; reserve for interactive states)

---

## Group 4 — Form Atoms

---

### `atom-input`

**Purpose:** A single-line text input field for patient data entry.

**Patient-centered rationale:** A patient filling out an appointment request form is taking a significant emotional step — they have decided to act. The form must not frustrate them. Input fields must be clearly labeled, adequately sized, and provide immediate feedback.

**Visual specification:**
```
Font:           Inter, 17px, color-ink
Background:     color-surface (#FDFBF7)
Border:         1px solid color-border (#D6CFC4)
Border-radius:  6px
Padding:        16px top/bottom, 20px left/right
Focus border:   color-accent (#4D7A70)
Focus shadow:   0 0 0 3px color-accent-subtle
Width:          100%
Min height:     52px (touch friendly)
Placeholder:    color-ink-secondary at 70% opacity
```

**Accessibility:**
- Always associated with an `atom-label` via `for`/`id`
- Placeholder is supplementary — never the only label
- Error state uses `color-error` border + visible error message (`atom-form-error`)
- Never remove the focus ring from inputs

**Mobile behavior:** Full-width. Padding maintained. The 52px minimum height ensures comfortable touch input.

**Elementor implementation:**
- Via Elementor Form widget (Pro feature)
- Base form styles in `elementor/custom.css` §17 apply automatically
- Form widget styled via the widget's own Style tab using Global Colors

**Forbidden:**
- Placeholder text as the only label
- Inputs smaller than 44px height (touch minimum)
- Removing focus ring from inputs

---

### `atom-textarea`

**Purpose:** Multi-line text input for the patient's message or question in the contact form.

**Visual specification:** Same as `atom-input` but `min-height: 120px` and `resize: vertical`. Patient can expand the field if needed.

**Composition rules:** Used only in the contact/appointment form for the patient's message field. Labelled "Mesajul dvs." or "Motivul consultației".

**Forbidden:** Using for short single-line responses (use `atom-input`).

---

### `atom-select`

**Purpose:** Dropdown select for choosing from a defined list of options.

**Visual specification:** Same border and padding as `atom-input`. Custom arrow indicator using `color-ink-secondary`. Appearance reset via `-webkit-appearance: none`.

**Composition rules:** Used for selecting preferred contact method, appointment type, or specialty area. Options must be clearly labeled for a non-medical patient — no medical codes or abbreviations.

---

### `atom-checkbox`

**Purpose:** Binary agreement or option selection.

**Visual specification:**
```
Checkbox size:  20×20px
Border:         1.5px solid color-border
Checked state:  color-accent fill, white checkmark
Gap to label:   space-3 (12px)
```

**Accessibility:** Checkbox must be associated with its label via `for`/`id`. The click target includes the label text, not just the checkbox square.

**Usage in this system:** GDPR consent checkbox on contact form only.

---

### `atom-form-error`

**Purpose:** Inline validation error message below a form field.

**Visual specification:**
```
Color:          color-error (#B83030)
Font:           Inter, 13px, 400
Icon:           Small warning icon (color-error) to the left
Margin-top:     space-2 (8px)
Role:           aria-live="polite" for screen reader announcement
```

**Patient-centered rationale:** A patient who makes an error in a form is already in a slightly anxious state (they are about to contact a doctor). The error message must be clear, specific, and non-judgmental. "Please enter a valid phone number" — not "Error."

**Forbidden:**
- Error messages that do not explain what is wrong and how to fix it
- Red text without an icon (color alone is not sufficient)
- Errors that appear before the patient has submitted or left the field

---

## Group 5 — Media Atoms

---

### `atom-image`

**Purpose:** A contained image element with proper aspect ratio enforcement and lazy loading.

**Visual specification:**
```
Aspect ratios:  16:9 (hero/featured), 4:3 (card images), 1:1 (avatar/icon contexts)
Object fit:     cover
Object position: center
Border-radius:  0 (standard), 8px (card context)
Format:         WebP required
Max file size:  200KB (hero), 80KB (card), 40KB (thumbnail)
```

**Patient-centered rationale:** Slow-loading images create frustration. A patient on a mobile connection who waits for a large image is a patient who may leave. Image optimization is a patient-experience decision.

**Composition rules:**
- All images require descriptive `alt` text
- Decorative images (backgrounds, texture fills) use `alt=""`
- Doctor photography requirements: see `APPROVED_VISUAL_DIRECTION.md` §03
- No autoplay video elements

**Accessibility:**
- Non-decorative images must have meaningful alt text describing the image content
- Alt text for doctor photography: "Dr. George Ungureanu în consultație cu un pacient"
- Never use images of text (text in images is inaccessible)

**Elementor implementation:**
- Widget: Image
- Lazy loading: enabled (Elementor default)
- Size: set to the appropriate registered WordPress image size
- Alt text: entered in the widget's Alt Text field

**Forbidden:**
- Images without alt text (except decorative images with `alt=""`)
- JPEG or PNG when WebP is available
- Images larger than the specified file sizes
- Auto-playing video backgrounds

---

### `atom-avatar`

**Purpose:** A circular cropped portrait image for the doctor or team member.

**Visual specification:**
```
Shape:          circle (border-radius: 50%)
Size:           80×80px (small, for testimonials), 160×160px (medium, for cards),
                full-width (up to 480px on desktop — for the doctor intro section)
Border:         none (standard), optional 2px color-border for contrast on warm backgrounds
Object fit:     cover
Object position: top center (preserves face)
```

**Composition rules:**
- Object position is always `top center` to ensure the face is visible when cropped to circle
- The doctor avatar requires original photography — no stock images
- For the homepage and about page, the avatar may be large (up to 480px wide) in a two-column layout

**Forbidden:**
- Using stock photography for the doctor's avatar
- Filters, overlays, or effects on the doctor's photo within the avatar

---

## Global Atom Rules

1. **No local color overrides.** Every color comes from a Global Color token.
2. **No local typography overrides.** Every text style comes from a Global Typography token.
3. **No decorative atoms.** If an atom exists purely for visual decoration without communicating information to the patient, it does not belong in this system.
4. **Every interactive atom must have a hover state and a focus state.** These are not optional.
5. **Every atom that is used in more than one location must be saved as a Global Widget in Elementor.**
6. **Every atom is named using the `atom-[name]` convention** in Elementor's widget label and Custom ID fields.
7. **Atoms do not know what organisms or molecules use them.** They are context-independent by design.

---

## Atom Count Summary

| Group | Atoms | Status |
|-------|-------|--------|
| Typography | 11 (`atom-overline`, `atom-h1` through `atom-h4`, `atom-body-lg`, `atom-body`, `atom-body-sm`, `atom-pull-quote`, `atom-caption`, `atom-label`) | Active |
| Typography (deferred) | 2 (`atom-h5`, `atom-h6`) | Future scope — not MVP |
| Interactive | 4 (`atom-button-primary`, `atom-button-secondary`, `atom-button-ghost`, `atom-link-inline`) | Active |
| Structural | 4 (`atom-divider`, `atom-divider-strong`, `atom-icon`, `atom-icon-box`) | Active |
| Form | 5 (`atom-input`, `atom-textarea`, `atom-select`, `atom-checkbox`, `atom-form-error`) | Active |
| Media | 2 (`atom-image`, `atom-avatar`) | Active |
| **Active total** | **26 atoms** | |
| **Including deferred** | **28 atoms** | |
