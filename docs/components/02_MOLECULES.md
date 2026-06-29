# Molecules

## georgeungureanu.doctor — Level 2: Molecular Components

**Governing source:** `docs/design-system/APPROVED_VISUAL_DIRECTION.md`
**Prerequisite:** All atoms defined in `01_ATOMS.md` must be configured before building molecules.

---

## What Molecules Are

Molecules are combinations of atoms that form a distinct, purposeful UI unit. A molecule does one thing — it does not contain sub-sections or multiple independent ideas. It is the smallest meaningful combination of atoms that recurs across the design system.

In Elementor, molecules are built as **Flexbox Containers** containing configured widgets. They are saved as **templates** in the Elementor Template Library so they can be inserted into organisms.

**The patient-centered test for every molecule:**
> Does this molecule, as a unit, clearly communicate one thing to the patient — a topic, an action, a piece of information, or a next step?

A molecule that tries to do two things should be split into two molecules.

---

## Group 1 — Navigation Molecules

---

### `molecule-logo`

**Purpose:** The site's visual identity element — the doctor's name displayed as the logo mark, linking to the homepage.

**Patient-centered rationale:** The logo anchors the patient's navigation. On every page, the patient can see whose site this is and click to return to the start. For a patient who is disoriented after reading complex medical information, the logo is a reset button.

**Composition:**
```
atom-h4 (Inter 600, color-ink) — "Dr. George Ungureanu"
atom-body-sm (Inter 400, color-ink-secondary) — "Neurochirurgie"  [optional]
Both wrapped in an anchor tag linking to /
```

**Allowed variants:**
- Standard: name + specialty subtitle, dark text on light header
- Inverted: name + subtitle in `color-surface` for dark overlays (not used in standard header)

**Elementor implementation:**
- Container: horizontal Flexbox, direction column, gap `space-1` (4px)
- Atom: Heading widget (custom H tag set to `<div>` via CSS class, styled as H4) + Text widget
- Full container is an anchor link (set link on the container in Elementor)
- Width: auto (flex-shrink: 0 to prevent compression)
- Custom ID: `molecule-logo`

**Mobile behavior:** Same as desktop. Name always visible. Subtitle may be hidden on mobile to save space (Elementor responsive visibility).

**Accessibility:** The wrapping anchor has `aria-label="Pagina principală Dr. George Ungureanu"`.

**Forbidden:**
- Using an image file as the logo (text logo is intentional — renders crisply at all sizes)
- Taglines or marketing phrases in the logo molecule

---

### `molecule-nav-item`

**Purpose:** A single navigation link — the repeating unit of the main navigation.

**Composition:**
```
atom-link-inline (type-nav — Inter 500, 15px) — link text
Optional: atom-icon (16×16px, color-ink-secondary) — for external links only
```

**States:**
```
Default:  color-ink-secondary
Hover:    color-ink, transition 200ms
Active:   color-accent (current page indicator)
```

**Composition rules:**
- Label: maximum 3 words, in Romanian
- Navigation labels must be patient-facing: "Condiții Tratate", "Despre Dr. Ungureanu", "Pacienți", "Contact"
- Do not use: "Servicii", "Portfolio", "Blog" without patient-friendly alternatives
- Gap between nav items: `space-6` (24px)

**Accessibility:**
- Active state must use `aria-current="page"` on the anchor element
- All nav items must be reachable by keyboard Tab key

**Elementor implementation:**
- Widget: Nav Menu (Elementor Pro) for the full nav, styled per these specifications
- Or: individual Button widgets set to text style with custom link
- Custom ID: `molecule-nav-item-[label]`

**Mobile behavior:** Hidden in mobile — replaced by the mobile menu drawer. The desktop nav container has responsive visibility set to "hidden on Mobile."

**Forbidden:**
- Dropdown sub-menus (they create navigation complexity that undermines patient-centered simplicity)
- Navigation labels longer than 3 words
- Navigation labels that are medical jargon

---

### `molecule-breadcrumb`

**Purpose:** Shows the patient's location within the site hierarchy and provides a back-navigation path.

**Patient-centered rationale:** A patient who has navigated from the homepage to a condition page to a specific condition needs to know where they are and how to go back. The breadcrumb answers "where am I in this site?" with a single glance.

**Composition:**
```
atom-link-inline (type-caption, color-ink-secondary) — "Acasă"
atom-caption (color-ink-secondary) — separator " / "
atom-link-inline (type-caption, color-ink-secondary) — "Condiții Tratate"
atom-caption (color-ink-secondary) — separator " / "
atom-caption (color-ink — not a link) — "Tumori cerebrale"  [current page — not linked]
```

**Composition rules:**
- Maximum 3 levels deep
- Current page is not a link (it is where the patient currently is)
- Uses `type-caption` (13px) — compact, does not compete with page headline
- Appears below the header and above the H1 in hero sections

**Accessibility:**
- Wrapped in `<nav aria-label="Breadcrumb">` element
- Current page item has `aria-current="page"`

**Elementor implementation:**
- Widget: Custom HTML or Breadcrumbs plugin output
- Container: horizontal Flexbox, gap `space-2` (8px), align items center
- Custom ID: `molecule-breadcrumb`

**Mobile behavior:** Truncated to show only parent + current page if 3 levels deep. Use ellipsis: "Acasă / … / Tumori cerebrale".

**Forbidden:**
- Breadcrumbs deeper than 3 levels
- Linking the current page in the breadcrumb
- Using breadcrumbs on the homepage (no hierarchy to show)

---

## Group 2 — Content Molecules

---

### `molecule-section-header`

**Purpose:** The opening block of every content section. Orients the patient to what the section is about before they begin reading.

**Patient-centered rationale:** This is the most reused molecule on the site. A patient scanning a page reads section headers to decide where to invest their reading attention. The overline + headline + lead paragraph structure answers three questions in sequence: "what category is this?" (overline), "what specifically?" (headline), "why does it matter to me?" (lead paragraph).

**Composition:**
```
atom-overline           — section category label (optional, but strongly recommended)
atom-h2                 — section headline (required)
atom-body-lg            — lead paragraph (optional, 2–3 sentences maximum)
```

**Allowed variants:**
- Full: overline + H2 + lead paragraph
- Compact: H2 only (for sections where context is already established)
- Centered: all three centered, max-width 760px — for intro sections on light backgrounds
- Left-aligned: default for content sections with body text following

**Composition rules:**
- Overline and H2 are always vertically stacked, gap `space-3` (12px)
- H2 and lead paragraph gap: `space-6` (24px)
- Between lead paragraph and section body: `space-8` (32px)
- Centered variant used on: homepage intro, CTA banner, standalone statement sections
- Left-aligned variant used on: condition sections, FAQ sections, doctor intro

**Mobile behavior:** Centered variant stays centered. Left-aligned stays left-aligned. The H2 scales to 28px and the lead paragraph to 17px.

**Elementor implementation:**
- Container: Flexbox, direction column, gap `space-3`
- Contains: Text widget (overline class) + Heading widget (H2) + Text Editor widget
- For centered variant: `text-align: center` on the container
- The `reading-column` class on the container constrains text width to 700px
- Custom ID: `molecule-section-header`
- Saved as Elementor Template Library entry

**Usage examples:**
- Overline: "CE TRATĂM" / H2: "Condiții în care ne specializăm" / Lead: "Fiecare condiție prezentată mai jos este explicată în limbaj simplu..."
- Overline: "PRIMA CONSULTAȚIE" / H2: "Ce să aștepți la prima vizită" / Lead: "Consultația inițială durează aproximativ 45 de minute..."

**Forbidden:**
- Overline without an H2 below it
- Lead paragraph longer than 3 sentences (move additional content to body text)
- H2 that is a category label rather than a patient-oriented statement
- Stacking two `molecule-section-header` instances without body content between them

---

### `molecule-pull-quote`

**Purpose:** A visually emphasized quote from a patient, from the doctor, or a key insight from content.

**Composition:**
```
atom-pull-quote         — the quoted text (Lora italic 24px)
atom-caption            — attribution line: "— Dr. George Ungureanu" or "— Pacient, 2024"
```

**Allowed variants:**
- Standard: left border accent, `color-surface` or `color-surface-warm` background
- Full-width: centered on `color-surface-warm` background — used in `organism-pull-quote-section`

**Composition rules:**
- Quote text: 15–40 words
- Attribution is always present — an unattributed quote is not used
- Attribution format: "— [Name/Role], [Year if patient]"
- Maximum one per section

**Patient-centered rationale:** A patient who has scrolled past dense medical information and encounters a human voice — either the doctor speaking in first person, or a patient's honest account — experiences a moment of emotional recognition. This molecule exists to create those moments without manufacturing them.

**Accessibility:** `<blockquote>` semantic element. The `cite` attribute or a visually rendered attribution addresses the source.

**Elementor implementation:**
- Custom HTML widget with `<blockquote>` + `<cite>` structure
- Apply `callout-box` CSS class for the left-border variant
- Typography applied via inline styles matching Global Typography values (since custom HTML bypasses widget typography controls)

**Forbidden:**
- Unattributed quotes
- Quotes used as marketing copy ("Cel mai bun neurochirurg!")
- Pull-quotes longer than 40 words
- Fabricated or paraphrased patient quotes presented as direct quotes

---

### `molecule-meta`

**Purpose:** A compact combination of icon + caption text for metadata like date, reading time, location, or phone number.

**Composition:**
```
atom-icon (16×16px, color-ink-secondary)
atom-caption (color-ink-secondary)
```

**Allowed variants:**
- Date: calendar icon + "27 Iunie 2025"
- Reading time: clock icon + "5 minute de citit"
- Location: pin icon + "Str. Exemplu 1, București"
- Phone: phone icon + "0721 000 000"

**Composition rules:**
- Container: horizontal Flexbox, gap `space-2` (8px), align items center
- Multiple meta items: stacked vertically with `space-2` between, or horizontal with `space-4` between
- Caption text is always `color-ink-secondary` — meta is supporting information

**Mobile behavior:** Same as desktop. Icon and text remain horizontal.

**Elementor implementation:**
- Container: Flexbox row, align center, gap 8px
- Icon widget + Text widget
- Custom ID: `molecule-meta-[type]`

**Forbidden:**
- Meta without an icon (text alone loses the quick scanability)
- More than 4 meta items together (creates visual noise)

---

### `molecule-condition-tag`

**Purpose:** A small pill/badge indicating a condition category or specialty tag.

**Composition:**
```
atom-label (Inter 600, 12px, uppercase, color-accent)
Container: pill shape with color-accent-subtle background
```

**Visual specification:**
```
Background:     color-accent-subtle (#E4EDEB)
Text:           color-accent (#4D7A70)
Padding:        4px top/bottom, 12px left/right
Border-radius:  100px (full pill)
Font:           Inter 600, 12px, uppercase, 0.04em letter-spacing
```

**Composition rules:** Used to tag condition cards or articles with their category. Maximum 2 tags per card. Labels are plain language: "Coloana vertebrală", "Creier", "Nervi periferici" — not ICD codes.

**Elementor implementation:**
- Container with background color Global "Accent Subtle", border-radius 100px
- Text widget with Global Color "Accent" and appropriate font settings
- Custom ID: `molecule-condition-tag`

**Forbidden:**
- Medical codes or abbreviations as tags
- More than 2 tags per card
- Tags used as navigation (use nav molecules for navigation)

---

## Group 3 — Card Molecules

---

### `molecule-card-condition`

**Purpose:** A compact card presenting a single medical condition to the patient, with enough information to recognize it and enough guidance to click through.

**Patient-centered rationale:** A patient does not know what conditions a neurosurgeon treats. This card answers "is my condition treated here?" in 3 seconds: the icon provides visual pattern recognition, the H4 names the condition, the body text explains it in plain language, and the link provides the next step. Every element earns its place.

**Composition:**
```
atom-icon-box           — visual category indicator (48×48px)
atom-h4                 — condition name in plain language (not medical Latin)
atom-body-sm            — 1–2 sentence plain-language description
atom-button-ghost       — "Află mai multe →" or "Citește mai mult →"
```

**Layout:**
```
Container: Flexbox, direction column, gap space-4 (16px)
Background: color-surface-muted or color-surface (alternating in grid)
Padding: space-8 (32px) desktop, space-6 (24px) mobile
Border-radius: 8px (radius-lg)
Border: 1px solid color-border (subtle — defines the card boundary)
Hover: border-color → color-border-strong, subtle background lift (no JS, CSS only)
```

**Content rules:**
- Condition name: plain language, max 4 words ("Tumoră cerebrală", not "Neoplasm intracranial")
- Description: 1–2 sentences, Grade 8 reading level, no medical jargon without explanation
- Link label: "Citește mai mult" or condition-specific: "Despre hernii de disc"
- Icon: a simple line icon representing the body region or concept — not a medical procedure icon

**Accessibility:**
- The entire card is NOT a link (anti-pattern that traps keyboard users)
- The ghost button link is the navigable element
- Card container has `role="article"` if used in a list context

**Mobile behavior:**
- Full-width single column
- Padding reduces to `space-6` (24px)
- Icon-box remains 48×48px

**Elementor implementation:**
- Outer container: Flexbox column, `space-4` gap, `space-8` padding, background Global Color "Surface Muted"
- Icon widget → Heading widget (H4) → Text Editor → Button widget
- Custom ID: `molecule-card-condition`
- Saved as Template Library entry

**Variants:**
- Featured: `color-accent-subtle` background, slightly larger padding — for the most common conditions
- Standard: `color-surface-muted` background

**Forbidden:**
- Making the entire card a link (keyboard navigation trap)
- Medical Latin or ICD codes in the condition name
- Description longer than 2 sentences
- More than one CTA link per card

---

### `molecule-card-article`

**Purpose:** A preview card for a blog article or patient information page, shown in a grid.

**Composition:**
```
atom-image              — article featured image (4:3 ratio, 100% container width)
atom-condition-tag      — category pill (optional)
atom-h4                 — article headline (patient-facing question or statement)
atom-body-sm            — 2–3 sentence excerpt
molecule-meta           — date + reading time (below excerpt)
atom-button-ghost       — "Citește articolul →"
```

**Patient-centered rationale:** A patient who has read a condition description may want more information. The article card provides a path to deeper understanding without overwhelming the current page context. The reading time indicator respects the patient's time.

**Content rules:**
- Headline: patient-facing question or plain statement — "Ce să aștepți după o operație la coloană" not "Recuperare postoperatorie spinală"
- Excerpt: 2–3 sentences, speaks directly to patient concern
- Reading time: always shown — a patient in distress needs to know if they can read this now or must return later

**Layout:**
```
Container: Flexbox column, no gap (image bleeds to edges)
Background: color-surface
Border-radius: 8px
Overflow: hidden (clips the image to card corners)
Border: 1px solid color-border
Content area padding: space-6 (24px)
Gap between content elements: space-3 (12px)
```

**Accessibility:** The article image is decorative in this context — the headline is the navigation anchor. Image `alt=""` is acceptable if the headline is descriptive. Alternatively, the image alt can describe the article topic.

**Mobile behavior:** Full-width single column. Image maintains 4:3 ratio via `aspect-ratio: 4/3; object-fit: cover`.

**Elementor implementation:**
- Container: column, `overflow: hidden`, border-radius 8px
- Image widget (no margin, full width, 4:3 ratio)
- Inner container: column, `space-6` padding, `space-3` gap
- Tag molecule + Heading + Text Editor + Meta molecule + Button
- Custom ID: `molecule-card-article`

**Forbidden:**
- Article headlines in medical jargon
- Missing reading time indicator
- Articles without a patient-facing purpose (purely academic content belongs on the publications page)

---

### `molecule-card-trust`

*Previously named `molecule-card-stat`. Renamed to clarify the patient-centered intent: this molecule exists to build trust, not announce achievements.*

**Purpose:** A paired number and plain-language context label that helps a patient understand who they are considering trusting their care to.

**Patient-centered rationale:** For a patient who is frightened and evaluating a doctor they have never met, a number can ground an otherwise abstract sense of experience. "15 ani" communicates something a credential list cannot — time, consistency, practice. But the framing is everything. This molecule answers the patient's unspoken question: "Has this doctor done this before?" It does not perform for colleagues or impress; it reassures.

**The distinction matters:**
- Reassurance: "15 ani de practică neurochirurgicală" — tells a patient this doctor has been doing this a long time
- Self-promotion: "500+ intervenții efectuate" — sounds impressive but is meaningless to a patient who does not know what the baseline is
- Forbidden: "Recunoscut internațional" — this is marketing, not trust

**Composition:**
```
Large number: Lora 700, 52px, color-accent — a meaningful, verifiable figure
atom-body-sm: color-ink-secondary — the patient-facing context (what this number means for them)
```

**Content rules:**
- The number must be honest and verifiable — do not round up aggressively or use vague ranges to seem larger
- Prefer years of experience over volume counts (volume implies throughput; experience implies care and depth)
- If a volume count is used, it must be paired with context that prevents misreading: "intervenții neurochirurgicale în 15 ani de practică", not just "500+ intervenții"
- The label completes the sentence the number starts — patient should be able to read "15 + ani de practică neurochirurgicală" as a complete thought
- Maximum 6 words in the label
- Acceptable content:
  - Years of neurosurgical practice
  - Number of years at a named hospital or institution
  - Specific fellowship or advanced training duration
- Not acceptable:
  - Conference attendances or presentations
  - Publications count as a primary trust indicator
  - Vague superlatives ("mii de pacienți")
  - Numbers that cannot be substantiated

**Layout:**
```
Container: Flexbox column, align center, gap space-3 (12px)
Padding: space-6 (24px)
Text alignment: center
```

**Elementor implementation:**
- Container: Flexbox column, centered
- Heading widget (display styled — Lora 700 52px, Global Color "Accent") + Text widget (Inter 15px, Global Color "Ink Secondary")
- Custom ID: `molecule-card-trust-[label]`

**Forbidden:**
- Exaggerated or unverifiable numbers
- Volume metrics framed as quality indicators ("5000+ surgeries")
- Numbers without patient-relevant labels
- More than one number per molecule
- Superlative language in the label ("world-class", "best", "leading")
- Using conference attendance, publication counts, or award counts as primary trust figures

---

### `molecule-card-doctor-teaser`

**Purpose:** A compact doctor introduction card for the homepage — photo, name, specialty, brief human statement, and a link to the full biography.

**Patient-centered rationale:** Trust is built person-to-person. Before a patient commits to reading a full biography page, they need a glimpse of the person: what they look like, what they do, and one human statement about why they do it.

**Composition:**
```
atom-avatar             — doctor's photo (warm, candid — 160×160px or full-column)
atom-h3                 — "Dr. George Ungureanu"
atom-body-sm (accent)   — "Neurochirurg"
atom-body               — 2–3 sentence human introduction (first person or third)
atom-button-ghost       — "Află mai multe despre Dr. Ungureanu"
```

**Layout:**
```
Two-column desktop: avatar left, content right, gap space-8 (32px)
Single-column mobile: avatar above, content below, gap space-6 (24px)
```

**Content rules:**
- The introductory text must contain one human element: a motivation, a patient-care philosophy, or a specific commitment
- Not: "Dr. Ungureanu este specialist cu experiență vastă..."
- Yes: "Înțeleg că un diagnostic neurological poate fi înfricoșător. Primul meu obiectiv este să vă explic situația în termeni pe care îi puteți înțelege."

**Elementor implementation:**
- Outer container: Flexbox row (desktop), column (mobile)
- Avatar container + Content container
- Custom ID: `molecule-card-doctor-teaser`

**Forbidden:**
- Opening with credential lists
- The word "renowned," "excellent," "expert" in the introductory text
- Photo without the human introductory sentence

---

## Group 4 — Form Molecules

---

### `molecule-form-field`

**Purpose:** A complete, self-contained form field unit — label, input, and optional error message.

**Patient-centered rationale:** A patient filling out an appointment request form is taking a significant step. Each field must be clearly labeled, obviously interactive, and respond helpfully to errors. A frustrated or confused form experience may cause the patient to abandon the contact attempt entirely.

**Composition:**
```
atom-label              — field label above the input
atom-input OR atom-textarea OR atom-select
atom-form-error         — error message (hidden by default, shown on validation failure)
```

**Layout:**
```
Container: Flexbox column, gap space-2 (8px)
Label → Input: gap space-2 (8px)
Input → Error: gap space-2 (8px), error appears below input
Full width: always 100% of parent container
```

**Field labels (Romanian):**
- Text: "Numele dvs." (not "Câmp obligatoriu")
- Email: "Adresa de email"
- Phone: "Număr de telefon"
- Message: "Mesajul dvs." or "Descrieți pe scurt motivul consultației"

**Error message rules:**
- Shown only after field has been touched (on blur or on submit)
- Text: specific and actionable: "Vă rugăm introduceți o adresă de email validă" not "Email invalid"
- Icon + text always — never color alone

**Accessibility:**
- `for`/`id` pairing between label and input — mandatory
- `aria-describedby` linking input to error message element
- `aria-required="true"` on required fields
- `aria-invalid="true"` on fields with errors

**Elementor implementation:**
- Elementor Form widget handles the field → label → validation structure natively
- Styling via widget's Style tab using Global Colors and typography
- Base styles from `elementor/custom.css` §17 apply automatically
- Custom ID: `molecule-form-field-[field-name]`

**Forbidden:**
- Removing label from any form field
- Placeholder text as the only label
- Generic error messages ("Invalid input")
- Showing errors before the patient has interacted with the field

---

### `molecule-form-submit`

**Purpose:** The submission action area of a form — button plus reassurance text.

**Composition:**
```
atom-button-primary     — "Trimite mesajul" or "Solicită o consultație"
atom-body-sm (secondary) — short reassurance: "Vă răspundem în maximum 24 de ore."
```

**Layout:**
```
Container: Flexbox column, gap space-3 (12px)
Alignment: left (aligned with form fields)
```

**Patient-centered rationale:** Submitting a medical appointment request is emotionally significant. The reassurance text ("we'll respond within 24 hours") removes the anxiety of not knowing what happens after the patient clicks submit. It converts the submit action from a jump into the unknown to a confirmed next step.

**Composition rules:**
- Reassurance text: specific about response time, never vague ("We'll get back to you soon")
- Button label: specific action, not "Submit"
- Loading state: button shows spinner, remains enabled (never disabled)
- Success state: replace form with a confirmation message (see organism-contact-form)

**Elementor implementation:**
- Elementor Form widget's Submit button, styled with Global Colors
- Reassurance text added as a Text widget below the form's button area
- Custom ID: `molecule-form-submit`

**Forbidden:**
- Generic "Submit" label
- Disabling the button during loading
- Disappearing after submit without any confirmation message

---

## Group 5 — CTA Molecules

---

### `molecule-cta-inline`

**Purpose:** An inline call to action within a content section — a brief contextual prompt that follows naturally from the content.

**Patient-centered rationale:** After a patient reads about a condition, the natural next thought is "what do I do now?" This molecule captures that moment. It is not a banner or a section — it is a natural continuation of the content flow.

**Composition:**
```
atom-body (color-ink-secondary)   — 1 sentence contextual prompt
atom-button-primary               — specific action label
```

**Layout:**
```
Container: Flexbox row (desktop), column (mobile)
Gap: space-8 (32px) between text and button
Align items: center (desktop), flex-start (mobile)
Padding: space-8 (32px) top and bottom
Background: color-surface-muted
Border-radius: radius-lg (8px)
```

**Content example:**
- Text: "Aveți întrebări despre diagnosticul dvs.?"
- Button: "Programați o consultație"

**Composition rules:**
- The text is a question or a statement that leads directly to the action
- One sentence maximum in the text element
- One primary button only

**Mobile behavior:** Stacks vertically — text above, button below.

**Elementor implementation:**
- Container: Flexbox row (desktop), `space-8` gap, background Global Color "Surface Muted"
- Text widget + Button widget
- Custom ID: `molecule-cta-inline`

**Forbidden:**
- Multiple buttons in this molecule
- Text longer than one sentence
- Using this molecule at the top of a section (it belongs at the end, after content)

---

### `molecule-cta-button-group`

**Purpose:** Two buttons side by side — primary and secondary — for contexts where two patient paths are equally valid.

**Composition:**
```
atom-button-primary     — the more committed action
atom-button-secondary   — the lower-commitment alternative
```

**Layout:**
```
Container: Flexbox row, gap space-4 (16px)
Mobile: Flexbox column, full-width buttons, gap space-3 (12px)
```

**Patient-centered rationale:** A patient who is not ready to book an appointment may still want to learn more about conditions. The button group acknowledges both states simultaneously. The patient chooses their path at their own pace.

**Composition rules:**
- Primary button always appears first (left on desktop, top on mobile)
- Maximum two buttons — this is a button *group*, not a button *menu*
- Labels must be clearly distinct — two buttons that sound similar create decision paralysis

**Elementor implementation:**
- Container: Flexbox row, `space-4` gap, no background
- Two Button widgets (primary and secondary styles)
- Custom ID: `molecule-cta-button-group`

**Forbidden:**
- Three or more buttons
- Two primary buttons (always one primary, one secondary)
- Button labels that are vague or similar to each other

---

## Group 6 — Process Molecules

---

### `molecule-process-step`

**Purpose:** A single step in a sequential process — numbered, named, and briefly explained.

**Patient-centered rationale:** A patient facing surgery or a first consultation fears the unknown. "What happens next?" is one of the most anxiety-producing questions in medicine. This molecule makes the process visible, concrete, and sequential. Seeing a numbered list of steps converts "unknown territory" to "a path I can follow."

**Composition:**
```
Step number container (circle): Inter 600, 20px, color-surface text, color-accent background
atom-h4                         — step name
atom-body-sm                    — 1–2 sentence plain-language description
```

**Layout:**
```
Container: Flexbox row, gap space-5 (20px), align items flex-start
Number container: 40×40px circle, flex-shrink 0
Content container: Flexbox column, gap space-2 (8px)
```

**Number container:**
```
Size:           40×40px
Border-radius:  50% (circle)
Background:     color-accent
Text color:     color-surface
Font:           Inter 600, 16px
```

**Content rules:**
- Step name: 2–4 words, action-oriented: "Completați formularul", "Confirmăm programarea"
- Description: 1–2 sentences, plain language, specific about what happens
- Steps are always numbered (1, 2, 3) — not bulleted

**Mobile behavior:** Horizontal layout maintained. Number circle stays left, content stacks to the right.

**Elementor implementation:**
- Outer container: Flexbox row, `space-5` gap
- Number container: 40×40px, border-radius 50%, background Global Color "Accent"
- Heading widget (H4) + Text widget inside content container
- Custom ID: `molecule-process-step-[n]`

**Forbidden:**
- More than 5 steps in a single process sequence (break into phases if needed)
- Unnumbered steps (bullets remove the sense of sequence)
- Process steps used for non-sequential content (use a list for non-sequential items)

---

## Group 7 — Location Molecules

---

### `molecule-location-card`

**Purpose:** A self-contained card representing one clinical location where Dr. Ungureanu sees patients — whether for consultations, surgical interventions, or both.

**Patient-centered rationale:** Geographic uncertainty is a hidden barrier to booking. A patient in Baia Mare who does not immediately see that this doctor also consults there will assume the doctor is inaccessible and may not proceed. A patient in Cluj-Napoca may not know which of several clinics handles which type of visit. This card answers "where, what type of visit, and how do I get there?" in a single glance — before the patient has to ask anyone.

**Composition (expanded — full /programari variant):**
```
[Required — always present:]
atom-body-sm (badge)        — visit type pill: "Consultații" / "Intervenții chirurgicale" / "Consultații și intervenții"
atom-h4                     — location name (clinic or hospital — patient-facing name only)
atom-body-sm (color-ink)    — city (bold, color-ink-secondary) + full street address
atom-divider (thin)         — visual separator before schedule block
molecule-meta (calendar)    — days of week Dr. Ungureanu is present at this location
molecule-meta (clock)       — hours of availability at this location
molecule-meta (phone)       — phone number for this location → tel: link
atom-body-sm (booking note) — appointment method: "Programare: prin formularul de contact" or "Programare: telefonic"

[Optional — shown only when data is confirmed:]
molecule-meta (email)       — email address for this location → mailto: link
molecule-meta (info)        — patient notes: what to bring, what to expect at this specific location
molecule-meta (car)         — parking information for this location
molecule-meta (accessibility) — accessibility information (wheelchair access, lift, etc.)

[Card footer — always present:]
atom-button-ghost           — "Cum ajungeți →" (links to Google Maps URL for this address)
```

**Allowed variants:**
- Consultation-only: blue/teal icon-box, type label "Consultații"
- Surgery-only: type label "Intervenții chirurgicale"
- Combined: type label "Consultații și intervenții chirurgicale"
- Featured: slightly larger, `color-accent-subtle` background — for the primary / most visited location

**Visual specification:**
```
Container: Flexbox column, gap space-4 (16px)
Background: color-surface
Border: 1px solid color-border
Border-radius: 8px (radius-lg)
Padding: space-8 (32px) desktop, space-6 (24px) mobile
Hover: border-color → color-border-strong, box-shadow 0 2px 8px rgba(35,30,26,0.06)
Width: fills grid column
```

**Content rules:**
- Location name: the common name of the clinic or hospital as patients know it (not the legal entity name)
  - Yes: "Clinica [Name]", "Spitalul Județean Cluj"
  - No: "S.C. Medical Services S.R.L."
- City must always be explicit — do not assume the patient knows the city
- Address: street + number + city on separate lines within `atom-body-sm`
- Schedule: the specific days or hours Dr. Ungureanu is present at this location, not general clinic hours
  - Example: "Luni, Miercuri · 14:00–18:00"
  - Example: "Prin programare — contactați-ne"
- Phone number: Dr. Ungureanu's booking number for this location, or the clinic reception if that's the booking path
- Appointment method note: explain exactly how to book at this location — every location may differ
  - "Programare prin formularul de pe site" (routes to /contact)
  - "Programare telefonic: [number]"
  - "Programare prin recepția [Clinic Name]"
- Patient notes: what to bring to this location, any location-specific instructions
  - Example: "Aduceți documentele medicale anterioare și buletinul."
  - Example: "Accesul se face prin intrarea principală — menționați că aveți o programare cu Dr. Ungureanu."
- Parking: practical information about parking near this specific location
  - Example: "Parcare gratuită în curtea clinicii"
  - Example: "Parcare stradală disponibilă — [strada]"
- Accessibility: wheelchair access, lift, ground floor entrance, etc.
  - Example: "Acces cu scaun cu rotile · Lift disponibil"
  - Example: "Intrare fără trepte · Parcare persoane cu dizabilități"
- Maps link: direct Google Maps link to the specific address — not the clinic's website
- If any field is not yet confirmed: omit that field entirely — do not show placeholder text in the published card for optional fields

**Accessibility:**
- The "Cum ajungeți" button: `aria-label="Direcții pentru [Location Name] în Google Maps"`
- Card container is NOT a link — the ghost button is the interactive element
- Icon-box: `aria-hidden="true"` (decorative, location type is communicated by text)

**Mobile behavior:**
- Full-width single column
- Padding reduces to `space-6` (24px)
- Icon-box remains 48×48px
- Schedule note wraps to multiple lines gracefully
- "Cum ajungeți" button: full-width on mobile

**Elementor implementation:**
- Outer container: Flexbox column, `space-4` gap, `space-8` padding, border 1px color-border, border-radius 8px
- Icon widget → Heading widget (H4) → Text widget (type/accent) → Text widget (address) → Meta molecule → Button widget
- Custom ID: `molecule-location-card-[location-slug]`
- Saved as Template Library entry — create one instance per location, customise content per location (not a dynamic template in Phase 1)

**Content to populate (current known locations):**

*Note: exact clinic names, schedules, and addresses must be confirmed with Dr. Ungureanu before implementation. The structure below uses placeholder names.*

| Location | City | Type | Notes |
|----------|------|------|-------|
| [Clinic A — primary] | Cluj-Napoca | Consultații | Primary location, most frequent |
| [Clinic B] | Cluj-Napoca | Consultații și intervenții | |
| [Hospital / OR] | Cluj-Napoca | Intervenții chirurgicale | University hospital or surgical center |
| [Clinic Baia Mare] | Baia Mare | Consultații | Periodic — confirm schedule frequency |

**Forbidden:**
- Using the legal entity name instead of the patient-facing location name
- Omitting the city
- Using general clinic hours instead of Dr. Ungureanu's specific schedule at that location
- Making the entire card a link (keyboard navigation trap; only the ghost button and tel:/mailto: links are interactive)
- Showing "TBD" or "Urmează" in published required fields — confirm all required fields before publishing a card
- Showing placeholder text in optional fields — if optional data is not confirmed, omit the field entirely
- Listing a Google Maps link that opens the wrong address (verify each Maps URL before publishing)

---

## Molecule Composition Rules (Global)

1. **Molecules are composed of atoms from `01_ATOMS.md` only.** A molecule does not contain another molecule.
2. **Every molecule has a single patient-serving purpose.** If a molecule seems to be doing two things, split it.
3. **All spacing within molecules uses values from `SPACING_SYSTEM.md`.** No arbitrary pixel values.
4. **All molecules use Global Colors and Global Typography.** No local overrides.
5. **Every molecule is saved as an Elementor Template Library entry** named `molecule-[name]`.
6. **Mobile behavior is specified for every molecule.** Mobile is not an afterthought.
7. **No molecule contains a navigation pattern, tab system, or carousel.** These are structurally forbidden.

---

## Molecule Count Summary

| Group | Molecules |
|-------|-----------|
| Navigation | 3 (`molecule-logo`, `molecule-nav-item`, `molecule-breadcrumb`) |
| Content | 4 (`molecule-section-header`, `molecule-pull-quote`, `molecule-meta`, `molecule-condition-tag`) |
| Cards | 4 (`molecule-card-condition`, `molecule-card-article`, `molecule-card-trust`, `molecule-card-doctor-teaser`) |
| Form | 2 (`molecule-form-field`, `molecule-form-submit`) |
| CTA | 2 (`molecule-cta-inline`, `molecule-cta-button-group`) |
| Process | 1 (`molecule-process-step`) |
| Location | 1 (`molecule-location-card`) |
| **Total** | **17 molecules** |
