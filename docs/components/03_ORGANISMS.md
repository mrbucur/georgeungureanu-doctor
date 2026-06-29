# Organisms

## georgeungureanu.doctor — Level 3: Organism Components

**Governing source:** `docs/design-system/APPROVED_VISUAL_DIRECTION.md`
**Prerequisite:** All atoms (`01_ATOMS.md`) and molecules (`02_MOLECULES.md`) must be defined before building organisms.

---

## What Organisms Are

Organisms are the complete, self-contained sections that appear on the website's pages. An organism answers one major question for the patient. It is a complete unit of patient communication.

In Elementor, organisms correspond to full-width **sections** — a Flexbox Container at the page's top level, spanning the full viewport width. Organisms are saved as **Elementor Template Library sections** so they can be inserted as complete sections into any page.

**The patient-centered test for every organism:**
> Does this section, standing alone, fully answer the question it exists to answer — so a patient who reads only this section understands their next step?

An organism that depends on another organism for its meaning has failed this test.

---

## Background Alternation System

Organisms alternate backgrounds to separate sections without visual borders:

```
Pattern A (light):      color-surface (#FDFBF7) — primary, default
Pattern B (warm):       color-surface-warm (#F4EFE6) — alternating
Pattern C (muted):      color-surface-muted (#EDE8DF) — card-heavy sections
Pattern D (dark):       color-ink (#231E1A) — used maximum once per page, for CTAs
```

Never use: white (#FFFFFF), pure black (#000000), institutional blue.

---

## Group 1 — Global Organisms (All Pages)

Group 1 contains organisms that are present on every page via Elementor Theme Builder. MVP scope includes the header and footer. The 404 page is deferred to future scope (see end of this document).

---

### `organism-site-header`

**Purpose:** The persistent global header — present at the top of every page on the site.

**Patient-centered rationale:** A frightened patient who clicks into the site from a search result needs two things immediately: confirmation they are in the right place (the doctor's name and specialty) and a clear path to the one action they probably came to take (booking a consultation). The header provides both without requiring a scroll.

**Composition:**
```
molecule-logo                   — left: doctor name + specialty
molecule-nav-item (×6)          — center or right: main navigation links
atom-button-primary (small)     — right: "Programează o consultație" → /programari
```

**Layout:**
```
Full-width container
Inner container: max-width 1200px, centered, horizontal Flexbox
Padding: space-5 (20px) top and bottom, space-8 (32px) left and right
Logo: flex-start
Nav: center or flex-end, gap space-6 (24px) between items
CTA button: flex-end, flex-shrink 0
Background: color-surface (#FDFBF7)
Border-bottom: 1px solid color-border
Position: sticky, top: 0, z-index: 100
```

**Navigation links (confirmed):**
1. "Acasă" → /
2. "Condiții tratate" → /conditii/
3. "Programări" → /programari/
4. "Resurse" → /resurse/
5. "Despre Dr. Ungureanu" → /despre/
6. "Contact" → /contact/

**Primary header CTA (confirmed):** "Programează o consultație" → /programari

**Sticky behavior:**
- Sticks to top of viewport on scroll
- On scroll: background adds `box-shadow: 0 2px 12px rgba(35, 30, 26, 0.08)` to separate from page content
- No JavaScript scroll-hide behavior — the header stays permanently visible

**Accessibility:**
- `<header>` element with `role="banner"`
- Navigation wrapped in `<nav aria-label="Navigare principală">`
- Skip-to-content link (`.skip-to-content` from `custom.css`) appears on first Tab keypress, before the logo

**Mobile behavior:**
- Molecule-nav-item items are hidden
- Logo remains visible
- CTA button text collapses to icon-only or is hidden
- Hamburger menu icon (atom-icon) appears at right — triggers mobile drawer
- Mobile header height: 64px

**Mobile menu drawer:**
- Opens from right edge, full viewport height
- Background: `color-surface`
- Navigation links: full-width, `space-8` (32px) height each, `type-body-lg` size
- CTA button: primary, full-width, at bottom of drawer
- Close button: top-right of drawer

**Elementor implementation:**
- Header section: Elementor Theme Builder → Header template
- Flexbox Container, sticky enabled, z-index 100
- Nav Menu Pro widget (Elementor Pro) for desktop navigation
- Mobile: Elementor's built-in hamburger menu for Nav Menu widget
- Custom ID: `organism-site-header`

**Forbidden:**
- Dropdown navigation menus
- Logo as an image file
- More than 6 navigation items (current confirmed structure is 6 — do not add more without a structural review)
- Hiding the CTA button on desktop
- Scroll-triggered header animations

---

### `organism-site-footer`

**Purpose:** The persistent global footer — present at the bottom of every page.

**Patient-centered rationale:** A patient who has read through an entire page and reaches the footer has either made a decision or is still gathering information. The footer must support both: provide contact information for patients who decided, and provide navigation anchors for patients who want to explore more.

**Composition:**
```
Row 1 — Main footer content:
  Column 1: molecule-logo + atom-body-sm (brief practice description, 1 sentence) + molecule-meta (address) + molecule-meta (phone)
  Column 2: Navigation group heading (atom-label "PAGINI") + 4× atom-button-ghost links
  Column 3: Navigation group heading (atom-label "CONDIȚII") + 4× atom-button-ghost links (top conditions)
  Column 4: atom-label "PROGRAM" + schedule information (atom-body-sm)

Row 2 — Legal strip:
  atom-caption (copyright) + atom-caption links (privacy policy, cookie policy)
```

**Layout:**
```
Full-width container
Background: color-surface-muted (#EDE8DF)
Row 1 inner: max-width 1200px, 4-column Flexbox grid, gap space-12 (48px)
Padding Row 1: space-16 (64px) top and bottom
Border-top: 1px solid color-border
Row 2: color-surface-warm, padding space-5 (20px), border-top 1px color-border
```

**Content rules:**
- Practice description: one sentence, human and warm — "Ajutăm pacienți și familiile lor să înțeleagă afecțiunile neurologice și să ia decizii informate."
- Phone number: visible as plain text AND as a tel: link
- Address: physical clinic address with Google Maps link (atom-button-ghost style)
- Schedule: Mon–Fri consultations; specific hours if applicable
- Copyright: "© [Year] Dr. George Ungureanu. Toate drepturile rezervate."

**Accessibility:**
- `<footer>` element with `role="contentinfo"`
- Navigation columns wrapped in `<nav aria-label="Footer navigare">`
- Phone number link: `<a href="tel:+40721000000">0721 000 000</a>`

**Mobile behavior:**
- 4 columns collapse to 1 column
- Doctor info first, then navigation columns, then schedule
- Row 2 stays a single row (wraps if needed)
- Column padding: `space-10` (40px) top and bottom

**Elementor implementation:**
- Footer section: Elementor Theme Builder → Footer template
- Flexbox Container, 4-column inner grid
- Custom ID: `organism-site-footer`

**Forbidden:**
- Social media links in the footer unless Dr. Ungureanu's accounts are officially maintained and actively monitored — unmonitored social accounts visible from a medical site create patient safety risk (patients may message expecting a response). See Prompt 05 §Social media conditional.
- Newsletter signup in the footer
- Cookie banner embedded in the footer (use dedicated cookie consent system)
- More than 6 links in each navigation column (Column 2 now follows the confirmed 6-item nav)
- A single clinic address in Column 1 — the footer must link to /programari for locations, not list one address (there are multiple locations)

---

## Group 2 — Hero Organisms

---

### `organism-hero-homepage`

**Purpose:** The above-the-fold section on the homepage — the first thing every patient sees.

**Patient-centered rationale:** This is the single most important section on the entire website. A patient who has arrived looking for help must, within 5 seconds, understand: who this doctor is, what he treats, and what to do next. Not impressed — *understood*. The hero does not announce awards or credentials. It speaks directly to the patient's situation.

**Composition:**
```
Left column (55% desktop):
  atom-overline               — "NEUROCHIRURGIE"
  atom-h1                     — Patient-centered headline (see content rules)
  atom-body-lg                — 2–3 sentence direct patient address
  molecule-cta-button-group   — "Programează o consultație" (primary → /programari) + "Condiții tratate" (secondary → /conditii)

Right column (45% desktop):
  atom-image OR atom-avatar   — Doctor photo (candid, warm, professional)
                              OR abstract warm illustration
```

**Layout:**
```
Full-width container
Background: color-surface (#FDFBF7)
Inner: max-width 1200px, centered
Desktop: 2-column Flexbox, 55/45 split, gap space-16 (64px), align center
Mobile: 1-column, image below content
Section padding: space-32 (128px) top and bottom (desktop), space-12 (48px) mobile
```

**Content rules:**
- H1: Must speak to the patient's situation, not announce credentials
  - Yes: "Claritate înainte de orice intervenție"
  - Yes: "Înțelegem că primul pas este cel mai greu"
  - No: "Cel mai bun neurochirurg din România"
  - No: "Servicii neurochirurgicale de excelență"
- Body: Addresses the patient in the second person ("dvs."), names the core value proposition in human terms
- The doctor photo: warm, candid, professionally lit — NOT a posed surgeon-in-scrubs stock photo
- Photo framing: doctor at mid-torso or seated — not standing with folded arms

**Accessibility:**
- H1 is the only H1 on the page
- Doctor photo: `alt="Dr. George Ungureanu, neurochirurg"` or specific candid description
- CTA buttons: labels are specific without context ("Programează o consultație", not "Programează")

**Mobile behavior:**
- Content stacks above image
- Image reduces to 320px height, object-fit cover
- Button group stacks vertically, full-width buttons
- Section padding reduces to `space-12` (48px)

**Elementor implementation:**
- Full-width section container with max-width inner container
- 2-column Flexbox (desktop), 1-column (mobile via responsive settings)
- Left column: Flexbox column with `space-6` gap between elements
- Right column: Image widget with fixed height and `object-fit: cover`
- Custom ID: `organism-hero-homepage`

**Forbidden:**
- Any credential, award, or achievement in the H1
- Using a background image with text overlaid (creates contrast accessibility issues)
- Autoplay video in the hero
- More than 2 CTA buttons
- Urgency language of any kind

---

### `organism-hero-interior`

**Purpose:** The hero section for all non-homepage pages — condition pages, about page, FAQ, contact, patient information.

**Patient-centered rationale:** A patient who navigates from the homepage to a condition page needs to confirm immediately that they have arrived at the correct page and understand what they will find. The interior hero is brief, orienting, and warm — it does not try to sell or persuade, only to inform and welcome.

**Composition:**
```
atom-breadcrumb (molecule-breadcrumb)   — navigation context
atom-overline                           — section category
atom-h1                                 — page title (specific to this page's content)
atom-body-lg                            — 1–2 sentence description of what this page contains
```

**Layout:**
```
Full-width container
Background: color-surface-warm (#F4EFE6)
Inner: max-width 1200px, centered, single column, max-width 800px for text
Padding: space-20 (80px) top and bottom (desktop), space-10 (40px) mobile
Text: left-aligned (always — interior pages are document-style, not centered splash pages)
```

**Content rules:**
- H1 for condition pages: "Tumori cerebrale — ce trebuie să știi" (condition name + patient value)
- H1 for about page: "Dr. George Ungureanu"
- H1 for patient guide: "Ghid pentru pacienți: prima consultație"
- Lead text: 1–2 sentences, plain language, tells the patient what they will learn

**Accessibility:**
- Breadcrumb navigation (`<nav aria-label="Breadcrumb">`) precedes the H1
- H1 is the page's primary heading — no decorative use of H1 elsewhere on the page

**Mobile behavior:** Padding reduces to `space-10` (40px). Breadcrumb is present but truncated to 2 levels.

**Elementor implementation:**
- Interior page template section (Elementor Theme Builder Page template)
- Flexbox column container, single-column content area
- Custom ID: `organism-hero-interior`

**Forbidden:**
- Background images in the interior hero (solid background colors only)
- Centered text (always left-aligned for interior pages)
- Multiple H1 headings per page

---

### `organism-hero-contact`

**Purpose:** The hero section for the contact page — shorter than the interior hero, immediately transitioning to the form.

**Composition:**
```
atom-overline           — "CONTACT"
atom-h1                 — "Luați legătura cu noi"
atom-body               — brief, warm invitation (1 sentence)
molecule-meta (phone)   — phone number for patients who prefer to call
molecule-meta (email)   — email address as a clickable mailto link
```

**Layout:**
```
Background: color-surface-warm
Inner: 2 columns (hero text left, contact meta right) on desktop
       1 column on mobile
Padding: space-16 (64px) top and bottom
```

**Content:**
- H1: "Luați legătura cu noi" — direct, warm, no medical jargon
- Body: "Vă răspundem în maximum 24 de ore. Dacă situația dvs. este urgentă, vă rugăm să apelați direct." + emergency instruction
- Phone and email displayed prominently — some patients prefer not to use a form

**Accessibility:** Phone number is a `tel:` link. Email is a `mailto:` link. Both are navigable by keyboard.

**Mobile behavior:** Phone and email stack below the text content in a single column.

**Elementor implementation:**
- Custom section for the contact page template
- Custom ID: `organism-hero-contact`

**Forbidden:**
- Hiding direct contact methods (phone, email) — the form is not the only path
- Emergency services framing ("Call 112" should be present only if the doctor explicitly handles emergencies; otherwise direct to ER)

---

## Group 3 — Content Section Organisms

**CTA routing (confirmed):** All primary buttons labeled "Programează o consultație" in this group link to `/programari` — not to `/contact`. The `/contact` page remains the destination for secondary CTAs ("Contactați-ne") and the form submission action only.

---

### `organism-conditions-grid`

**Purpose:** A grid of condition cards covering the full range of neurosurgical conditions treated.

**Patient-centered rationale:** A patient whose condition has not been formally diagnosed yet needs to find themselves in this grid. The grid is organized by recognition, not by medical taxonomy — it is how patients describe their condition, not how doctors classify it.

**Composition:**
```
molecule-section-header         — "CE TRATĂM" / "Condiții în care ne specializăm"
Grid of molecule-card-condition — 6 to 12 cards
atom-button-ghost (optional)    — "Toate condițiile tratate →" if more than 12 exist
```

**Layout:**
```
Full-width container
Background: color-surface-muted (#EDE8DF)
Inner: max-width 1200px, centered
Grid: CSS Grid, 3 columns desktop / 2 columns tablet / 1 column mobile
Gap: space-6 (24px)
Section padding: space-20 (80px) top and bottom
Section header margin-bottom: space-12 (48px)
```

**Content rules:**
- Cards in order of frequency/importance to patients — most common conditions first
- Condition names: patient language ("Hernie de disc", not "Disc herniation L4-L5")
- Grid shows 6 conditions on the homepage; full grid on the conditions page
- No "coming soon" or placeholder cards — only show real conditions

**Accessibility:**
- Grid container: `role="list"` (it is a navigable list of conditions)
- Each card: `role="listitem"`

**Mobile behavior:**
- 1-column grid
- Cards are full-width
- Section header centered in single-column layout

**Elementor implementation:**
- Outer Flexbox Container, background Global Color "Surface Muted"
- Inner Container: max-width 1200px, Flexbox column
- Section header + Grid Container
- Grid Container: Elementor Grid widget or CSS Grid via custom class
- Custom ID: `organism-conditions-grid`

**Forbidden:**
- Conditions labeled in medical Latin without a plain-language companion
- "Coming soon" placeholder cards
- More than 3 columns on desktop (4+ creates cards too narrow to be useful)
- Accordion or tab organization of conditions (flat grid for scannability)

---

### `organism-how-it-works`

**Purpose:** A step-by-step explanation of the patient journey — from first contact to treatment.

**Patient-centered rationale:** "What happens after I contact the clinic?" is one of the most anxiety-producing unknowns for a new patient. This organism makes the process concrete, numbered, and sequential. It transforms the consultation process from "unknown medical process" to "a series of steps I understand."

**Composition:**
```
molecule-section-header         — "CUM FUNCȚIONEAZĂ" / "Pașii următori pentru tine"
Sequence of molecule-process-step — typically 4 steps
atom-body-sm (optional note)    — supporting note if any step needs clarification
```

**Layout:**
```
Full-width container
Background: color-surface (#FDFBF7)
Inner: max-width 800px, centered column
Padding: space-20 (80px) top and bottom
Steps: Flexbox column, gap space-8 (32px) between steps
Vertical connector line (optional): 2px dashed color-border connecting step number circles
```

**Confirmed 4-step content (updated to reflect /programari flow):**

Step 1: H4 "Alegeți locația potrivită"
Body-sm: "Vizitați pagina Programări pentru a găsi clinica sau spitalul cel mai convenabil pentru dvs. din Cluj-Napoca sau Baia Mare."

Step 2: H4 "Solicitați programarea"
Body-sm: "Completați formularul de contact de pe pagina Programări sau sunați direct la locația aleasă. Vă confirmăm programarea în maximum 24 de ore."

Step 3: H4 "Prima consultație"
Body-sm: "Consultația inițială durează aproximativ 45–60 de minute. Dr. Ungureanu ascultă, explică și răspunde la toate întrebările dvs., fără grabă."

Step 4: H4 "Stabilim împreună planul terapeutic"
Body-sm: "Primiți o explicație clară a tuturor opțiunilor disponibile. Decizia finală vă aparține — niciodată nu vi se impune un traseu terapeutic."

**Mobile behavior:** Steps maintain their horizontal layout (number circle left, content right). Gap reduces to `space-6` (24px).

**Elementor implementation:**
- Outer Flexbox container
- Inner container: max-width 800px, column, `space-8` gap
- Section header + 4× process-step molecules
- Optional: decorative dashed vertical line via `::before` pseudo-element on the steps container
- Custom ID: `organism-how-it-works`

**Forbidden:**
- More than 5 steps (complexity defeats the purpose)
- Steps that are non-sequential or conditional
- Jargon or medical procedure names in step labels

---

### `organism-patient-journey`

**Purpose:** A patient-centered walkthrough of the complete care experience — from the moment they contact the clinic to when they receive and understand their treatment plan. It answers the patient's deepest question: "What will actually happen to me?"

**Patient-centered rationale:** `organism-how-it-works` describes the logistical process (contact → confirm → visit). `organism-patient-journey` goes deeper — it describes the *experience*: what the patient sees, hears, feels, and decides at each stage. A patient who is frightened by a diagnosis needs to be able to imagine themselves moving through this process safely. Making the journey visible in human terms is one of the most effective anxiety-reduction tools available on a medical website.

The distinction between the two organisms:
- `organism-how-it-works` → steps to get an appointment (logistics, brevity, action)
- `organism-patient-journey` → the experience of care from first contact to treatment plan (understanding, emotion, preparation)

**Composition:**
```
molecule-section-header         — "CE SE ÎNTÂMPLĂ MAI DEPARTE" / "Parcursul dvs. ca pacient"
                                   Lead: "Fiecare etapă este gândită să reducă incertitudinea, nu să o crească."

Step 1 block:
  atom-overline               — "PASUL 1"
  atom-h3                     — "Programarea"
  atom-body                   — What happens: patient fills in contact form or calls; clinic confirms within 24h; patient receives confirmation with location, what to bring, what to expect in terms of duration
  atom-body-sm (color-ink-secondary) — "Durată: 5 minute din partea dvs."

atom-divider                  — between steps

Step 2 block:
  atom-overline               — "PASUL 2"
  atom-h3                     — "Consultația inițială"
  atom-body                   — What the patient experiences: the doctor listens first, asks questions about the patient's experience (not just symptoms), explains what he observes, uses language the patient understands; 45 minutes; no rush; patient is encouraged to ask questions
  atom-body-sm (color-ink-secondary) — "Durată: 45–60 minute"

atom-divider

Step 3 block:
  atom-overline               — "PASUL 3"
  atom-h3                     — "Investigațiile și analiza documentelor"
  atom-body                   — What happens with existing documents (if any); which investigations may be recommended and why; patient will understand what each investigation shows before it is ordered; results are discussed with the patient, not announced as a verdict
  atom-body-sm (color-ink-secondary) — "Durată: variabil, în funcție de situație"

atom-divider

Step 4 block:
  atom-overline               — "PASUL 4"
  atom-h3                     — "Planul terapeutic"
  atom-body                   — How the plan is communicated: patient receives a clear explanation of options, including non-surgical options where they exist; questions are expected and welcomed; patient makes an informed decision at their own pace; nothing is decided without the patient's understanding and agreement
  atom-body-sm (color-ink-secondary) — "Decizia aparține dvs."

molecule-pull-quote (optional) — a doctor or patient statement about the consultation experience
molecule-cta-inline            — "Aveți întrebări despre proces?" + "Contactați-ne"
```

**Layout:**
```
Full-width container
Background: color-surface-warm (#F4EFE6)
Inner: max-width 900px, centered column
Padding: space-20 (80px) top and bottom
Steps: Flexbox column, gap space-0 (dividers handle visual separation)
Each step block: Flexbox column, gap space-4 (16px)
Overline → H3 gap: space-2 (8px)
H3 → Body gap: space-4 (16px)
Body → Body-sm gap: space-2 (8px)
Divider margin: space-10 (40px) top and bottom
```

**Content rules:**
- Every step must acknowledge the patient's emotional state, not just the clinical or logistical fact
  - Yes: "Consultația începe cu ascultarea dvs. — nu cu un examen."
  - No: "Medicul va efectua o examinare neurologică completă."
- Step 3 must acknowledge that not every patient has existing documents — and that this is fine
- Step 4 must explicitly state that the patient decides — this is the core fear to address (loss of control)
- The "Durată" note at each step sets expectations; do not omit these
- The pull-quote, if used, should be from the doctor in first person describing how he conducts consultations — not a patient testimonial (testimonials live in `organism-patient-testimonials`)

**Page placement:**
- Homepage: optional, as a deeper patient-education alternative to `organism-how-it-works`; the two should not appear on the same page
- Patient information page (/pacienti/): primary organism — this page exists for this content
- Contact page: optional, below the contact form, for patients who want to understand before submitting
- Condition pages: not used — conditions pages focus on the condition, not the process

**Accessibility:**
- Each step block: `<section>` element with the H3 as its heading
- Overline spans are `aria-hidden="true"` (they are decorative step labels; the H3 carries the semantic meaning)
- Dividers: `<hr>` element between steps

**Mobile behavior:**
- Single column maintained — no change needed
- Step blocks stack naturally
- Dividers maintained between steps
- Overline + H3 + Body + Body-sm pattern reads well at mobile widths
- Padding reduces to `space-12` (48px)

**Elementor implementation:**
- Outer Flexbox Container, background Global Color "Surface Warm"
- Inner Container: max-width 900px, Flexbox column
- Section header molecule + 4 step blocks interleaved with divider atoms
- Each step block: Flexbox column, `space-4` gap
- Overline: Text widget with `text-overline` class
- H3: Heading widget (H3 tag), Global Typography "H3 — Subsection Headline"
- Body: Text Editor widget, Global Typography "Body"
- Body-sm: Text widget, Global Typography "Body Small", Global Color "Ink Secondary"
- Custom ID: `organism-patient-journey`

**Forbidden:**
- Clinical language in the step descriptions (this is the patient-facing version of the care process)
- Step names that describe medical procedures rather than patient experiences ("Examinare neurologică" → "Consultația inițială")
- Presenting the plan in step 4 as already decided — the patient's role in the decision must be explicit
- Using in combination with `organism-how-it-works` on the same page (they serve similar purposes at different depths; choose one per context)
- Numbering more than 4 steps (complexity defeats the organism's purpose)

---

### `organism-doctor-credentials`

**Purpose:** A compact, patient-relevant presentation of the doctor's qualifications — framed as "why you can trust this doctor" not "this is an impressive resume."

**Patient-centered rationale:** Credentials matter to patients — they validate the doctor's ability to help. But a list of institutions and abbreviations does not communicate trust to a patient who is not a medical professional. This organism translates credentials into patient-relevant meaning.

**Composition:**
```
molecule-section-header         — "DE CE DR. UNGUREANU" / "Pregătire și experiență"
3× molecule-card-trust          — 3 trust indicators (years, context, specificity — not volume metrics)
molecule-section-header (sub)   — "Formare medicală" (smaller, H3-level)
List of credential items:
  atom-icon-box (calendar icon) + atom-h4 + atom-body-sm (each credential)
atom-button-ghost               — "Citiți biografia completă →"
```

**Layout:**
```
Full-width container
Background: color-surface-warm (#F4EFE6)
Inner: max-width 1200px, centered
Stats row: 3-column Flexbox (desktop), 1-column (mobile), gap space-8 (32px)
Credentials list: Flexbox column, gap space-6 (24px)
Padding: space-20 (80px)
```

**Trust indicator content (examples):**
- "15+" — "ani de practică neurochirurgicală" *(experience depth)*
- "10+" — "ani de specializare în chirurgie minim-invazivă" *(specific competence)*
- "3" — "centre universitare de formare" *(institutional grounding)*

**Not acceptable as trust indicators:**
- Volume counts ("500+ intervenții") without meaningful context
- Conference or publication counts
- Any figure that could not be explained to a patient in one sentence

**Credential items (plain language):**
- "Specializare în Neurochirurgie — Universitatea de Medicină și Farmacie [Orașul], [Ani]"
- "Fellowship în Neurochirurgie minim-invazivă — [Instituție], [Ani]"
- Full credential list lives on the about page; this organism shows the top 3–4

**Accessibility:**
- Credentials list: `<ul>` with `<li>` per credential item
- Stats do not need list semantics — they are display elements

**Mobile behavior:**
- Stats: single column, centered, full-width
- Credentials: single column, full-width

**Elementor implementation:**
- Custom ID: `organism-doctor-credentials`
- Stats row: Flexbox container with 3 stat-card molecules
- Credentials: Icon List widget or custom Flexbox column

**Forbidden:**
- Listing conference attendances or publications as primary credentials (mention only if they directly translate to patient benefit)
- Academic Latin abbreviations without explanation ("Prof. Dr. hab." is meaningless to most patients)
- Using a credential as the first thing a patient sees (stats first, credentials second)

---

### `organism-patient-testimonials`

**Purpose:** A selection of patient experiences that validate the emotional quality of the care — not the technical outcomes.

**Patient-centered rationale:** A patient who is considering a consultation with an unfamiliar doctor needs to know what the experience of that consultation is like. Not statistics — feelings. This organism communicates what it is like to be a patient of Dr. Ungureanu.

**Composition:**
```
molecule-section-header     — "PACIENȚI" / "Ce spun pacienții noștri"
2–3× molecule-pull-quote    — patient testimonials (attributed, with first name + condition)
```

**Layout:**
```
Full-width container
Background: color-surface (#FDFBF7)
Inner: max-width 1000px, centered, column
Padding: space-20 (80px)
Gap between testimonials: space-10 (40px)
Dividers: atom-divider between each testimonial
```

**Content rules:**
- 2–3 testimonials maximum — this is not a review section, it is a trust signal
- Attribution: "— [First name], [condition category], [year]"
  - Example: "— Maria, pacient hernii de disc, 2024"
- Content: must describe the human experience — communication, understanding, care — not just outcome
- Testimonials must be real (with patient permission) or from public sources
- Balanced: include a testimonial that describes initial fear and how it was addressed

**Content examples:**
- "Am venit speriată. Am plecat cu claritate. Dr. Ungureanu mi-a explicat totul în termeni pe care i-am înțeles, și am știut exact ce urmează."
- "Nu m-am simțit niciodată grăbit. Mi-a răspuns la toate întrebările, chiar și la cele pe care mi-era teamă să le pun."

**Accessibility:**
- Each testimonial is a `<blockquote>` element
- Attribution is a `<cite>` element within or adjacent to the blockquote
- Section does not auto-scroll or cycle — static display

**Mobile behavior:** Single column, full-width. Dividers maintained between testimonials.

**Elementor implementation:**
- Custom ID: `organism-patient-testimonials`
- Column container with pull-quote molecules and divider atoms between them

**Forbidden:**
- Carousels or sliders for testimonials
- Anonymous testimonials
- Testimonials focused exclusively on technical outcomes ("The surgery was successful")
- Star ratings or numerical review scores (too transactional for this context)
- More than 3 testimonials in this organism (use a dedicated testimonials page for more)

---

### `organism-faq`

**Purpose:** A list of patient questions with direct answers — the most important self-service content on the site.

**Patient-centered rationale:** A frightened patient who cannot reach the clinic directly will look for answers on the website. The FAQ must answer the real questions patients ask — not the questions the clinic wishes they would ask. "How much does it cost?" "Do I need a referral?" "How long is the wait?" These are the questions this organism answers.

**Composition:**
```
molecule-section-header         — "ÎNTREBĂRI FRECVENTE" / "Răspunsuri la întrebările dvs."
List of FAQ items:
  Each item:
    atom-h3                     — the patient's question (verbatim, in first person if possible)
    atom-body                   — the direct answer (no hedging, no jargon)
    atom-divider                — between items
```

**Layout:**
```
Full-width container
Background: color-surface-muted (#EDE8DF)
Inner: max-width 800px, centered column
Padding: space-20 (80px)
FAQ items: Flexbox column, gap space-0 (use divider atoms instead)
H3 (question) → Body (answer) gap: space-4 (16px)
Item → Divider gap: space-8 (32px)
```

**Content rules:**
- Questions in the patient's voice: "Cât durează o consultație?" not "Durata consultației"
- Answers: direct, specific, no medical hedging where not necessary
- Recommended questions for the neurosurgery context:
  1. "Cât durează prima consultație?"
  2. "Am nevoie de bilet de trimitere?"
  3. "Ce documente să aduc la consultație?"
  4. "Cât costă o consultație?"
  5. "Cât timp durează recuperarea după o operație?"
  6. "Cât de urgent este cazul meu?"
  7. "Pot face o programare online?"
  8. "Faceți intervenții minim-invazive?"
- Maximum 10 questions per page (link to full FAQ page if more exist)

**Accessibility:**
- FAQ items: `<dl>` / `<dt>` / `<dd>` structure, or `<section>` with H3 + paragraphs
- The `<dl>` structure is preferred for semantic clarity

**Mobile behavior:** Same layout, full-width. H3 wraps if the question is long — acceptable.

**Elementor implementation:**
- Section container with max-width 800px inner column
- Section header molecule + repeated H3/body/divider pattern
- Elementor's Accordion widget is explicitly NOT used — the questions and answers are displayed in full, no disclosure toggle needed
- Custom ID: `organism-faq`

**Forbidden:**
- Accordion/disclosure widget for FAQ items (every question and answer is visible — patients should not have to expand items to find answers)
- FAQ questions written from the clinic's perspective ("Our consultation process...")
- Vague answers ("Contact us for more information" is not an answer)
- More than 10 questions in one organism

---

### `organism-article-grid`

**Purpose:** A grid of patient information articles — the educational resource section.

**Composition:**
```
molecule-section-header     — "RESURSE" / "Informații pentru pacienți"
Grid of molecule-card-article — typically 3 cards in a row
atom-button-ghost           — "Toate articolele →" (link to full archive)
```

**Layout:**
```
Full-width container
Background: color-surface-warm (#F4EFE6)
Inner: max-width 1200px
Grid: 3 columns desktop / 2 columns tablet / 1 column mobile
Gap: space-6 (24px)
Padding: space-20 (80px)
```

**Content rules:**
- Articles are patient education content — procedure guides, condition explanations, recovery timelines
- Article headlines in patient question format: "Ce să aștepți la o RMN cranial"
- 3 articles shown in the organism — link to full archive for more

**Mobile behavior:** Single column, full-width article cards.

**Elementor implementation:**
- CSS Grid inner container
- 3× article card molecules
- Custom ID: `organism-article-grid`

**Forbidden:**
- Academic papers presented as patient articles
- Articles without reading time indicators

---

### `organism-contact-form`

**Purpose:** The primary patient contact and appointment request form.

**Patient-centered rationale:** The contact form is the final step in the patient's journey — the moment they decide to take action. This moment must be free of any friction, confusion, or anxiety. The form must be simple (few fields), reassuring (clear response expectation), and warm (human confirmation message).

**Composition:**
```
Left column (form):
  molecule-section-header         — "CONTACT" / "Trimiteți-ne un mesaj"
  molecule-form-field (name)      — "Numele dvs." (required)
  molecule-form-field (phone)     — "Număr de telefon" (required)
  molecule-form-field (email)     — "Adresa de email" (optional)
  molecule-form-field (message)   — "Descrieți pe scurt motivul consultației" (textarea, optional)
  atom-checkbox                   — GDPR consent (required)
  molecule-form-submit            — "Trimite mesajul" + "Vă răspundem în 24 de ore"

Right column (contact info):
  molecule-meta (phone)           — direct phone number
  molecule-meta (email)           — email address
  molecule-meta (address)         — clinic address
  molecule-meta (schedule)        — consultation hours
```

**Layout:**
```
Full-width container
Background: color-surface (#FDFBF7)
Inner: max-width 1200px, 2-column Flexbox (60/40 split), gap space-16 (64px)
Mobile: 1-column, contact info below form
Padding: space-20 (80px)
Form fields: Flexbox column, gap space-6 (24px)
```

**Form rules:**
- Minimum fields: name + phone (email and message optional — lower barrier)
- GDPR consent checkbox: required, with link to privacy policy
- Success state: Replace form with a warm confirmation message:
  - "Mulțumim! Vă vom contacta în cel mai scurt timp, cel mai probabil în 24 de ore."
- No CAPTCHA (use honeypot field instead — CAPTCHAs create friction for anxious patients)
- Error handling: inline errors per field, form summary at top if multiple errors

**Accessibility:**
- All fields have associated `<label>` elements
- Required fields marked with `aria-required="true"` AND a visible indicator (not just `*`)
- GDPR checkbox: `aria-required="true"`, label includes "obligatoriu"
- Form has a unique `<h2>` heading before it
- Success message receives focus after successful submission

**Mobile behavior:**
- Single column
- All fields full-width
- Contact info below form
- Padding `space-10` (40px)

**Elementor implementation:**
- Elementor Form widget (Pro) for the form column
- Contact info column: Flexbox column with meta molecules
- Honeypot field: a hidden text field that bots fill but humans ignore (Elementor Form supports this)
- Custom ID: `organism-contact-form`

**Forbidden:**
- CAPTCHA (any type)
- More than 6 form fields
- Requiring email when phone suffices
- Success state that does not replace the form (showing a banner while the form stays is confusing)
- Any urgency or marketing language in the form section

---

### `organism-cta-banner`

**Purpose:** A full-width, high-contrast section that presents the primary call to action — appears once per page, typically near the bottom.

**Patient-centered rationale:** A patient who has read through an entire condition page or about page has gathered information. They are now considering whether to act. This organism appears at the natural end of the patient's information-gathering journey and offers a calm, clear invitation to take the next step. It does not pressure. It invites.

**Composition:**
```
atom-overline               — "PASUL URMĂTOR"
atom-h2                     — "Sunteți gata să programați o consultație?"
atom-body                   — 1–2 sentences addressing the patient directly
molecule-cta-button-group   — "Programează o consultație" (primary → /programari) + "Contactați-ne" (secondary → /contact)
```

**Layout:**
```
Full-width container
Background: color-ink (#231E1A) — the single "dark" section
Text color: color-surface (#FDFBF7)
Inner: max-width 800px, centered, text centered
Padding: space-24 (96px) top and bottom
Gap between elements: space-6 (24px)
```

**Button variants on dark background:**
- Primary button: `color-surface` background, `color-ink` text — inverted for visibility
- Secondary button: transparent background, `color-surface` border and text

**Content rules:**
- H2: a warm, direct question — not a marketing headline
- Body: addresses patient concerns briefly: "Suntem alături de dvs. de la prima consultație până la recuperare completă."
- One use per page — this organism appears once, near the bottom

**Accessibility:**
- Dark background: all text must maintain WCAG AA contrast on `color-ink` background
  - `color-surface` (#FDFBF7) on `color-ink` (#231E1A): 14.5:1 — compliant
- Button focus rings: use `color-accent-subtle` (`#E4EDEB`) outline on dark background

**Mobile behavior:**
- Text centered in single column
- Button group stacks vertically, full-width buttons
- Padding: `space-12` (48px)

**Elementor implementation:**
- Full-width Flexbox section, background Global Color "Ink"
- Inner container: max-width 800px, column, centered
- Text color overrides to Global Color "Surface" (the one dark-background override allowed)
- Custom ID: `organism-cta-banner`

**Forbidden:**
- Using `organism-cta-banner` more than once per page
- Urgency language ("Acum", "Nu așteptați", "Locuri limitate")
- More than 2 buttons
- Placing it above the fold (it belongs at the end of a page's content journey)

---

## Group 4 — Doctor / Biography Organisms

---

### `organism-doctor-intro`

**Purpose:** The full doctor introduction on the About page — a complete human portrait.

**Patient-centered rationale:** Patients choose their doctor based on trust, which is built through human connection. This organism gives patients a complete, human picture of who they will meet — not a resume, but a person. It uses Lora's editorial warmth to tell a story, not announce qualifications.

**Composition:**
```
Left column: atom-avatar (large, 400–480px, warm candid photo)
Right column:
  atom-overline       — "DR. GEORGE UNGUREANU"
  atom-h2             — Human headline: "Medicul care explică, nu doar tratează"
  atom-body-lg        — Opening human statement (first person, motivational)
  atom-body           — 2–3 paragraphs: training, approach, patient philosophy
  molecule-pull-quote — A quote from the doctor in his own words
  atom-button-primary — "Programează o consultație" (→ /programari)
```

**Layout:**
```
Full-width container
Background: color-surface-warm (#F4EFE6)
Inner: max-width 1200px, 2-column Flexbox (40/60 photo/content split)
Gap: space-16 (64px)
Mobile: 1 column, photo above, content below
Padding: space-24 (96px)
```

**Content rules:**
- Opening statement: first person, warm, patient-focused
  - Yes: "Am ales neurochirurgia pentru că cred că claritatea este cea mai bună formă de îngrijire."
  - No: "Dr. Ungureanu este un specialist cu experiență vastă..."
- The pull-quote must be in the doctor's voice
- Paragraphs: human motivations first, credentials second
- End with a single CTA — the patient who has read this far is already engaged

**Mobile behavior:** Photo at 100% width, cropped to 50vh height, object-fit cover. Content below.

**Elementor implementation:**
- Custom ID: `organism-doctor-intro`
- 2-column inner Flexbox
- Photo column: Image widget, sticky (CSS `position: sticky; top: 120px`) on desktop

**Forbidden:**
- Opening paragraph that lists institutions or degrees
- Passive voice ("Dr. Ungureanu was trained at...")
- Using the doctor's photo in a clinical context (no photos of procedures, OR environments, or medical equipment as primary doctor portrait)

---

### `organism-credentials-list`

**Purpose:** Complete medical credentials and training history — the detailed professional record.

**Patient-centered rationale:** Some patients — especially those referred by other doctors, or patients making high-stakes decisions — need to see the full credential record. This organism provides it in a clear, well-organized way without overwhelming the general patient audience (who will have already read `organism-doctor-intro`).

**Composition:**
```
molecule-section-header         — "FORMARE ȘI SPECIALIZARE"
Multiple credential sections, each:
  atom-overline                 — "EDUCAȚIE", "SPECIALIZĂRI", "PUBLICAȚII"
  atom-h3                       — section name
  List of credential items:
    atom-h4                     — Credential name / Degree
    atom-body-sm                — Institution, years, specialization detail
    atom-caption (italic)       — Country, accrediting body (if relevant)
    atom-divider                — between items
```

**Layout:**
```
Full-width container
Background: color-surface (#FDFBF7)
Inner: max-width 900px, column
Padding: space-20 (80px)
```

**Content sections:**
1. Educație (undergraduate medical training)
2. Specializare în neurochirurgie (residency)
3. Fellowship / Formare suplimentară (postgraduate)
4. Afilieri profesionale (board memberships, professional societies)
5. Publicații selectate (2–3 key publications in patient-accessible terms)

**Forbidden:**
- Full publication list (link to Google Scholar or ResearchGate instead)
- Conference presentation lists as primary content
- Abbreviations without expansion ("Prof. dr." → "Professor, Doctor")

---

### `organism-philosophy-statement`

**Purpose:** The doctor's care philosophy — a dedicated section articulating how he approaches patient care.

**Patient-centered rationale:** A patient deciding between doctors is not only evaluating technical competence. They are evaluating communication style, empathy, and philosophy of care. This organism communicates explicitly: "here is how I think about patients." It is the most human section in the entire doctor biography sequence.

**Composition:**
```
atom-overline               — "FILOSOFIA MEA DE ÎNGRIJIRE"
atom-h2                     — "Claritate înainte de orice intervenție"
atom-body (editorial voice) — 3–4 paragraphs in first person, editorial register
molecule-pull-quote         — key philosophical statement, doctor-attributed
```

**Layout:**
```
Full-width container
Background: color-surface-warm (#F4EFE6)
Inner: max-width 760px, centered, reading column
Padding: space-24 (96px)
Text alignment: left
```

**Content voice:** Lora body text in this section — it is the most literary, editorial section on the site. The doctor speaks in long, thoughtful sentences. This is the closest the site comes to a personal essay.

**Note:** The body text in this organism uses Lora (type-quote register without the italic) rather than the standard Inter body. This is the one exception to the Inter body rule — justified by the editorial nature of this specific section. Implementation requires a custom CSS class `philosophy-text` that overrides the body font to Lora.

**Elementor implementation:**
- Custom CSS class `philosophy-text` on the text containers
- The philosophy-text class is defined in `elementor/custom.css`
- Custom ID: `organism-philosophy-statement`

**Forbidden:**
- Marketing language in the philosophy statement
- Third-person voice ("Dr. Ungureanu believes...")
- Credential-listing in a philosophy section

---

## Group 5 — CTA / Form Organisms

These organisms are variants of the CTA and form patterns defined above. They are listed separately because they appear in distinct page contexts.

---

### `organism-appointment-cta`

**Purpose:** A standalone page section prompting the patient to request an appointment — lighter than the full contact form.

**Patient-centered rationale:** Not every page needs a full form. Some pages (condition pages, article pages) benefit from a lighter CTA that directs the patient toward the appointment hub without embedding the full form. The patient can learn where to go, then decide whether to call or write.

**Composition:**
```
atom-h2                     — "Aveți întrebări despre [condition/topic]?"
atom-body                   — 1–2 sentences connecting the section content to the next step
molecule-cta-button-group   — "Programează o consultație" (primary → /programari) + "Contactați-ne" (secondary → /contact)
molecule-meta (phone)       — direct phone number as additional path
```

**Layout:**
```
Full-width container
Background: color-accent-subtle (#E4EDEB)
Inner: max-width 1200px, 2-column Flexbox (content left, phone right) or centered column
Padding: space-16 (64px)
```

**Elementor implementation:**
- Custom ID: `organism-appointment-cta`

**Forbidden:**
- Used more than once per page
- Urgency language

---

### `organism-location-directory`

**Purpose:** The complete directory of all locations where Dr. Ungureanu sees patients — the primary content of the `/programari` page and the definitive answer to "where can I find this doctor?"

**Patient-centered rationale:** Location uncertainty is the most underappreciated barrier to booking a medical appointment in Romania. A patient who is not from Cluj-Napoca may assume this doctor is inaccessible without checking. A patient who is in Cluj-Napoca may not know which clinic handles consultations versus surgical procedures. This organism removes all geographic uncertainty in one clear, scannable section. Before a patient can commit to booking, they need to know *where* they are committing to going. This organism makes that possible.

**This organism is the primary content of `/programari`.** All primary CTAs on the site route here first.

**Composition:**
```
molecule-section-header             — Overline: "UNDE NE GĂSIȚI"
                                      H2: "Clinici și spitale unde consultăm"
                                      Lead: "Dr. Ungureanu consultă și operează în mai multe centre medicale. Găsiți locația cea mai apropiată de dvs."

Optional city group header (if 3+ Cluj-Napoca locations):
  atom-overline                     — "CLUJ-NAPOCA"
  atom-h3                           — "Locații în Cluj-Napoca"

Grid of molecule-location-card      — one per location, in order: primary Cluj → secondary Cluj → Baia Mare

atom-divider                        — between city groups (if multiple cities)

Optional city group header:
  atom-overline                     — "BAIA MARE"
  atom-h3                           — "Locație în Baia Mare"

molecule-location-card              — Baia Mare location

atom-body-sm (centered, color-ink-secondary) — "Nu ați găsit o locație convenabilă? Contactați-ne — vom găsi împreună cea mai bună variantă."
atom-button-ghost                   — "Contactați-ne →" (→ /contact)
```

**Layout:**
```
Full-width container
Background: color-surface (#FDFBF7)
Inner: max-width 1200px, centered, Flexbox column
Section header: max-width 760px (centered), margin-bottom space-12 (48px)
Grid of cards: CSS Grid, 2 columns desktop / 1 column mobile, gap space-6 (24px)
City group headers: full-width, margin-bottom space-6 (24px) before cards, margin-top space-12 (48px)
Closing note: centered, margin-top space-10 (40px)
Padding: space-20 (80px) top and bottom
```

**City grouping rules:**
- If only 1 location in a city: no city group header needed — the location card's city label is sufficient
- If 2+ locations in the same city: use a city group header (`atom-overline` + `atom-h3`) to visually group them
- Cluj-Napoca locations listed first (primary geography)
- Other cities listed after, each with their own group header

**Location card ordering within a city group:**
1. Consultation-only locations (patients arriving for a first visit most commonly need these)
2. Combined (consultation + surgery) locations
3. Surgery-only locations

**Content rules:**
- Section header lead text: plain, informative — "Dr. Ungureanu consultă și operează în mai multe centre medicale."
- Do not editorialize: no "prestigious" or "top-tier" — simply state facts
- Closing note: warm, practical, action-oriented — gives the patient a path if their location is not listed
- All content must be confirmed with Dr. Ungureanu before going live (location names, addresses, schedules)

**Data required before implementation:**
```
For each location, confirm:
  □ Patient-facing name of the clinic or hospital
  □ Full street address + city + postal code
  □ Type of visit (consultations / surgeries / both)
  □ Dr. Ungureanu's specific days and hours at this location
  □ Booking method for this location (via website form? via clinic's own system? by phone?)
  □ Google Maps URL for the address
  □ Parking or transport notes (optional but useful)
```

**Current known locations (to be confirmed):**
- Multiple locations in Cluj-Napoca (primary city)
- One location in Baia Mare

**Page context:** This organism is the primary content organism of `/programari`. It appears below `organism-hero-interior` and above `organism-cta-banner`.

**Accessibility:**
- City group headings (H3) structure the page for screen reader navigation
- Each location card: `role="article"` within a `role="list"` grid container
- Google Maps link: `aria-label="Direcții pentru [Location Name] în Google Maps"` (opens external link — include `target="_blank"` with `rel="noopener"` and an icon indicating external)
- External link icon: `aria-hidden="true"` (decorative)

**Mobile behavior:**
- Single-column grid — each location card full-width
- City group headers remain
- Cards stack: Cluj-Napoca cards first, then divider, then Baia Mare card
- Closing note and button below all cards

**Elementor implementation:**
- Outer Flexbox Container, background Global Color "Surface"
- Inner Container: max-width 1200px, column
- Section header molecule
- City group container: Flexbox column (for each city group)
- Card grid: Elementor Grid widget (2 columns), or Flexbox row with `flex-wrap: wrap`
- `molecule-location-card` instances inserted per location
- Custom ID: `organism-location-directory`
- Save as Template Library section

**Forbidden:**
- Listing clinics before confirming location details with Dr. Ungureanu
- Generic clinic descriptions from the clinic's own marketing ("leading medical center of excellence")
- Hiding the Baia Mare location — it is a key piece of information for patients in that region
- Grouping all locations without differentiating consultation vs. surgery contexts
- Map embed (an embedded map creates loading overhead and accessibility issues; the Google Maps link per card is sufficient)

---

### `organism-emergency-notice`

**Purpose:** A clear, calm notice directing patients to emergency services when their situation may be urgent.

**Patient-centered rationale:** A patient who searches for "severe headache neurologist" or "sudden vision loss" may land on this website. If their condition is a medical emergency, the website has a responsibility to direct them to appropriate care immediately. This organism is the most important patient safety element on the site.

**Composition:**
```
atom-icon (warning icon, color-warning)
atom-h3                     — "Dacă situația dvs. este urgentă"
atom-body                   — Direct, calm emergency instructions
atom-button-primary         — "Sunați la 112" (links to tel:112)
```

**Layout:**
```
Full-width container
Background: color-warning (#A05A2C) at 8% opacity (warm amber tint)
Border-left: 4px solid color-warning
Inner: max-width 800px, Flexbox row
Padding: space-8 (32px)
Appears: at the top of relevant condition pages, ABOVE the hero
```

**Content:**
- "Dacă aveți simptome bruște și severe — durere de cap intensă, pierderea vederii, slăbiciune sau amorțeală bruscă, dificultăți de vorbire — acestea pot fi urgențe medicale. Sunați imediat la 112 sau mergeți la cel mai apropiat spital."

**When to use:**
- Stroke symptoms page
- Severe headache / intracranial pressure page
- Condition pages where acute presentations may qualify as emergencies

**Accessibility:**
- `role="alert"` on the container — screen readers announce it immediately
- The button is the first interactive element in the organism so keyboard users encounter it early

**Elementor implementation:**
- Custom ID: `organism-emergency-notice`
- Appears as the first section on applicable pages, before the hero
- Applied selectively — only on pages where emergency symptoms are relevant

**Forbidden:**
- Using this organism on every page (alert fatigue reduces its effectiveness)
- Styling that makes it look decorative rather than urgent
- Removing it from pages where emergency symptoms are relevant (patient safety)

---

## Global Organism Rules

1. **One organism, one patient question answered.** An organism that tries to serve two purposes is two organisms in disguise.
2. **Background alternation is required.** Consecutive organisms must not share the same background color.
3. **`organism-cta-banner` appears once per page, near the bottom.** It is not repeated.
4. **`organism-emergency-notice` appears above the hero on applicable pages.** It is never positioned below the fold.
5. **All organisms use the max-width inner container pattern.** Full-width background, 1200px max-width content (or narrower for reading-focused organisms).
6. **No organism contains a carousel, slider, or tab system.** Linear, scroll-based layouts only.
7. **All organisms are saved as Elementor Template Library sections** named `organism-[name]`.
8. **Mobile behavior is specified for every organism.** Section padding reduces on mobile; grid columns collapse; content stacks vertically.

---

## Organism Count Summary

| Group | Organisms | Status |
|-------|-----------|--------|
| Global | 2 (`organism-site-header`, `organism-site-footer`) | MVP |
| Heroes | 3 (`organism-hero-homepage`, `organism-hero-interior`, `organism-hero-contact`) | MVP |
| Content Sections | 11 (`organism-conditions-grid`, `organism-how-it-works`, `organism-patient-journey`, `organism-doctor-credentials`, `organism-patient-testimonials`, `organism-faq`, `organism-article-grid`, `organism-location-directory`, `organism-contact-form`, `organism-cta-banner`, `organism-appointment-cta`) | MVP |
| Doctor/Biography | 3 (`organism-doctor-intro`, `organism-credentials-list`, `organism-philosophy-statement`) | MVP |
| Safety | 1 (`organism-emergency-notice`) | MVP |
| **Active total** | **20 organisms** | |
| Future scope | 1 (`organism-page-not-found`) | Deferred |
| **Including deferred** | **21 organisms documented** | |

---

## Future Scope — Deferred Organisms

These organisms are fully documented for when they are needed, but are not part of the MVP build sequence.

---

### `organism-page-not-found` *(Deferred — post-MVP)*

**Purpose:** The 404 page — for when a patient navigates to a URL that does not exist.

**Why deferred:** The site does not have enough URL structure in Phase 1 for a 404 page to be a meaningful patient touchpoint. WordPress displays a default 404 template until a custom one is built. This is acceptable for MVP — address it when the site has published pages that could generate broken links.

**Patient-centered rationale (when built):** A patient who follows an old link or misremembers a URL and lands on a 404 page is already slightly frustrated. The response must be calm, human, and redirective — not technical. The message acknowledges the problem and gives the patient a clear path to continue.

**Composition:**
```
atom-overline       — "PAGINA NU A FOST GĂSITĂ"
atom-h1             — "Se pare că această pagină nu mai există"
atom-body           — 1–2 sentences of calm explanation and redirection
molecule-cta-button-group — "Mergeți la pagina principală" (primary) + "Contactați-ne" (secondary)
```

**Layout:**
```
Full-page centered section (min-height: 70vh)
Background: color-surface
Max-width: 600px, centered
Text alignment: center
```

**Content:**
- H1: "Se pare că această pagină nu mai există"
- Body: "Pagina pe care o căutați a fost mutată sau nu mai există. Puteți reveni la pagina principală sau ne puteți contacta direct."
- Do NOT include: error code (404), technical language, apology tone that sounds performative

**Elementor implementation:**
- WordPress 404 template → Elementor Theme Builder → 404 template
- Single centered Flexbox container
- Custom ID: `organism-page-not-found`

**Forbidden:**
- Displaying the "404" error code prominently (it is meaningless to a patient)
- Humorous or clever 404 copy (this is a medical site — patients are not in the mood)
- Leaving the patient without a clear next step
