# Homepage Template — Implementation Guide

## georgeungureanu.doctor — Prompt 03 Output

**Governing sources:**
- `docs/design-system/APPROVED_VISUAL_DIRECTION.md` — visual direction
- `docs/components/01_ATOMS.md`, `02_MOLECULES.md`, `03_ORGANISMS.md` — component library
- `docs/content/HOMEPAGE_CONTENT_STRATEGY.md` — content strategy
- `docs/project/WEBSITE_GOALS.md` §CTA Routing Decision — link destinations

**Prerequisite:** Prompt 01 (global CSS, colors, typography) and Prompt 02 (component library) must be complete in Elementor before building this page.

**What this document is not:** This is not an Elementor JSON file. It is a section-by-section manual implementation guide — the same format as `01_DESIGN_SYSTEM_SETUP.md`. Build each section by hand in Elementor, following the specifications below.

**Note on Prompt 03 original spec:** The original Prompt 03 file specified a background-image hero and an `organism-stats-row` with achievement counts. Both have been superseded by Direction B+ decisions and the `molecule-card-trust` reframing. This document reflects the current, correct specifications.

---

## The Homepage Narrative

The homepage tells a patient story, not a doctor story. The sequence is:

> **Acknowledge → Reassure → Orient → Introduce → Trust → Proof → Prepare → Resource → Direct**

A patient arrives frightened and uncertain. They leave knowing they are in the right place, understanding what this doctor does, and knowing exactly what to do next. Every section earns its scroll position by advancing this arc.

---

## Page Architecture

| # | Section | Organism | Background | CTA Destination |
|---|---------|----------|-----------|----------------|
| 1 | Hero | `organism-hero-homepage` | `color-surface` | Primary → `/programari` |
| 2 | Patient Promise | Centered statement section | `color-surface-warm` | None |
| 3 | Conditions | `organism-conditions-grid` | `color-surface-muted` | Ghost → `/conditii` |
| 4 | Doctor Introduction | Doctor teaser section | `color-surface-warm` | Ghost → `/despre` |
| 5 | Trust Indicators | `organism-doctor-credentials` (compact) | `color-surface` | Ghost → `/despre` |
| 6 | Testimonials | `organism-patient-testimonials` | `color-accent-subtle` | None (conditional) |
| 7 | How It Works | `organism-how-it-works` | `color-surface-warm` | None |
| 8 | Articles | `organism-article-grid` | `color-surface` | Ghost → `/resurse` |
| 9 | Final CTA | `organism-cta-banner` | `color-ink` | Primary → `/programari` |

Global organisms (`organism-site-header`, `organism-site-footer`) are applied via Elementor Theme Builder and do not appear as page sections.

---

## CTA Routing Map

| Button label | Route | Organism(s) |
|--------------|-------|-------------|
| "Programează o consultație" | `/programari` | Hero, Final CTA |
| "Condiții tratate" | `/conditii` | Hero (secondary) |
| "Află mai multe despre Dr. Ungureanu" | `/despre` | Doctor Introduction |
| "Vezi toate condițiile" | `/conditii` | Conditions Grid |
| "Toate articolele" | `/resurse` | Article Grid |
| "Contactați-ne" | `/contact` | Final CTA (secondary) |

---

## Background Alternation

Sequential sections must never share the same background. The homepage alternation:

```
1. color-surface         (#FDFBF7) — Hero
2. color-surface-warm    (#F4EFE6) — Promise
3. color-surface-muted   (#EDE8DF) — Conditions
4. color-surface-warm    (#F4EFE6) — Doctor
5. color-surface         (#FDFBF7) — Trust
6. color-accent-subtle   (#E4EDEB) — Testimonials [conditional — if hidden, rule 7 checks against rule 5]
7. color-surface-warm    (#F4EFE6) — How It Works  [if rule 6 hidden: different from rule 5 ✓]
8. color-surface         (#FDFBF7) — Articles      [different from rule 7 ✓]
9. color-ink             (#231E1A) — CTA Banner    [always last, always dark]
```

If the Testimonials section is hidden, the transition is Trust (`color-surface`) → How It Works (`color-surface-warm`) — different colors, rule holds.

---

## Section 1 — Hero

**Organism:** `organism-hero-homepage`
**Background:** `color-surface` (#FDFBF7)
**Padding:** `space-32` (128px) top and bottom desktop; `space-12` (48px) mobile

**Layout:** Two-column Flexbox, 55/45 split, aligned center. Text left, doctor photo right.

> **Important reconciliation:** The original Prompt 03 spec described a full-width background image with a dark overlay. This is **not** the Direction B+ approach. `organism-hero-homepage` explicitly forbids background images with text overlaid (contrast and accessibility issues). The hero uses `color-surface` as the section background and the doctor photo in the right column.

### Content Slots

```
[overline]
Placeholder: "NEUROCHIRURGIE"
Typography: Global "Overline"
Color: Global "Accent"
Note: Maximum 4 words. Appears immediately above H1.

[headline — H1]
Placeholder: "Claritate înainte de orice decizie"
Typography: Global "H1 — Page Title"
Color: Global "Ink"
Note: One H1 per page. Speaks to the patient's situation, not the doctor's achievement.
Max 10 words. Must not contain credentials, awards, or the word "best."

Alternative headlines (choose one with Dr. Ungureanu):
- "Claritate înainte de orice decizie"
- "Înțelegem că primul pas este cel mai greu"
- "Claritate. Precizie. Îngrijire."

[body-lg — lead text]
Placeholder: "Dacă aveți o afecțiune neurologică sau ați primit un diagnostic
neurochirurgical, prima consultație cu Dr. Ungureanu este locul unde
puteți pune toate întrebările și înțelege opțiunile dvs. — fără grabă."
Typography: Global "Body Large"
Color: Global "Ink"
Max 3 sentences.

[cta-primary]
Label: "Programează o consultație"
Link: /programari
Widget: Button (atom-button-primary)
Style: Global CTA button style

[cta-secondary]
Label: "Condiții tratate →"
Link: /conditii
Widget: Button (atom-button-secondary) or ghost button
Style: Global secondary button style

[image — right column]
Content: Doctor portrait (warm, candid, professional)
Alt text: "Dr. George Ungureanu, neurochirurg"
Aspect ratio: 3:4 (portrait) or 4:5
Object fit: cover, top center
Width: 100% of right column
Border-radius: 8px (optional — matches card radius in system)
Note: Must NOT be a photo of the doctor in scrubs in an OR.
      Must NOT be stock photography.
      Must be commissioned photography (placeholder until available).
```

### Elementor Implementation Steps

1. Create a new full-width Flexbox Container section.
2. Set background color to Global Color "Surface".
3. Set section padding: 128px top and bottom (desktop), 48px (mobile). Apply via Elementor's responsive padding controls.
4. Inside, create a Flexbox Container (inner): set max-width 1200px, centered (margin auto). Direction: Row (desktop), Column (mobile). Align Items: Center.
5. **Left column container** (55% width, desktop): Direction Column, gap `space-6` (24px).
   - Add Text widget → set Custom Class `text-overline` → type overline text → Color Global "Accent" → Typography Global "Overline".
   - Add Heading widget → H1 tag → type headline → Color Global "Ink" → Typography Global "H1 — Page Title".
   - Add Text Editor widget → type lead text → Color Global "Ink" → Typography Global "Body Large" → Add CSS class `reading-column`.
   - Add Flexbox Container (button group): Direction Row, gap `space-4` (16px), wrap on mobile.
     - Add Button widget → label "Programează o consultație" → link `/programari` → apply atom-button-primary styles.
     - Add Button widget → label "Condiții tratate →" → link `/conditii` → apply atom-button-secondary styles.
6. **Right column container** (45% width, desktop): overflow hidden, border-radius 8px.
   - Add Image widget → upload doctor portrait → Alt text as above → Size: Full → Image width: 100% → Object fit: Cover.
7. On mobile (Elementor responsive): set inner container to Direction Column. Right column moves below left column. Set image height: 320px with object-fit cover.
8. Custom ID: `organism-hero-homepage`.

### Mobile Behavior

- Inner container switches to single column, column-reverse not needed (text above image is correct).
- Image: height 280–320px, full-width, object-fit cover, top-center focus.
- Button group: Flexbox column, full-width buttons, stacked vertically.
- Section padding: 48px top/bottom.

### Accessibility

- This H1 is the only H1 on the page. Do not use H1 again.
- Doctor photo: descriptive alt text — "Dr. George Ungureanu, neurochirurg" or more specific if the photo has a specific context.
- Button labels are descriptive without context: "Programează o consultație" (not "Book here").
- Skip-to-content link in the global header renders before this section.

---

## Section 2 — Patient Promise

**Background:** `color-surface-warm` (#F4EFE6)
**Padding:** `space-20` (80px) top and bottom desktop; `space-10` (40px) mobile
**Layout:** Single column, centered, max-width 760px

This section is a philosophical statement — the doctor speaking directly in the voice of the site. It is not a section header for what follows. It stands alone. There is no CTA.

> **Content strategy note:** This is the most important voice statement on the site. It must be written by or with Dr. Ungureanu. A placeholder version is provided below, but this content must be replaced before launch — it should not sound generic.

### Content Slots

```
[overline]
Placeholder: "DESPRE ABORDAREA NOASTRĂ"
Typography: Global "Overline"
Color: Global "Accent"
Alignment: Center

[headline — H2]
Placeholder: "Medicul care explică, nu doar tratează"
Typography: Global "H2 — Section Headline"
Color: Global "Ink"
Alignment: Center
Note: This headline must sound like a human promise, not a marketing claim.

[body — lead text]
Placeholder: "Fiecare pacient care ajunge la mine traversează o perioadă dificilă.
Obiectivul meu nu este doar să vă tratez condiția, ci să vă explic
situația în termeni pe care îi puteți înțelege — astfel încât orice
decizie luați, să fie a dvs., informată și în pace cu ea."
Typography: Global "Body Large"
Color: Global "Ink"
Alignment: Center
Max-width: 700px (reading-column class)
Note: Written in first person (the doctor's voice).
      Maximum 3 sentences.
      Contains no credentials, no numbers, no achievements.
```

### Elementor Implementation Steps

1. Create a full-width Flexbox Container section.
2. Background: Global Color "Surface Warm".
3. Padding: 80px top/bottom (desktop), 40px (mobile).
4. Inner container: max-width 760px, Flexbox Column, align items center, text-align center, gap `space-4` (16px).
5. Add Text widget → overline → Custom Class `text-overline` → Global Color "Accent" → Global Typography "Overline" → text-align center.
6. Add Heading widget → H2 → Global Color "Ink" → Global Typography "H2 — Section Headline" → text-align center.
7. Add Text Editor widget → body text → Global Typography "Body Large" → Global Color "Ink" → CSS class `reading-column` → text-align center.
8. Custom ID: `section-patient-promise`.

### Mobile Behavior

Text remains centered at all breakpoints. Font sizes reduce per Global Typography responsive settings. Padding: 40px.

### Accessibility

No interactive elements. Ensure H2 follows H1 in the document order (it does — this is the first H2 on the page).

---

## Section 3 — Conditions Grid

**Organism:** `organism-conditions-grid` (homepage variant — 6 cards)
**Background:** `color-surface-muted` (#EDE8DF)
**Padding:** `space-20` (80px) top/bottom desktop; `space-10` (40px) mobile

### Content Slots

```
[overline]
Placeholder: "CE TRATĂM"

[headline — H2]
Placeholder: "Condiții în care ne specializăm"
Note: Section headline answers "what does this doctor treat?" directly.

[lead text]
Placeholder: "Fiecare condiție de mai jos este descrisă în limbaj accesibil.
Dacă nu vă regăsiți condiția, contactați-ne — lista de mai jos nu este exhaustivă."

[ghost CTA]
Label: "Toate condițiile tratate →"
Link: /conditii
```

**6 condition cards — placeholder content:**

All condition names must be in Romanian plain language. Descriptions at Grade 8 reading level. Confirm the final list and descriptions with Dr. Ungureanu before launch.

```
Card 1:
  Icon: Brain (outline, Heroicons/Phosphor)
  H4: "Tumori cerebrale"
  Body-sm: "Formațiuni benigne sau maligne la nivelul creierului,
             diagnosticate și tratate prin evaluare imagistică și intervenție chirurgicală."
  Link: /conditii/tumori-cerebrale

Card 2:
  Icon: Spine (or vertebra outline)
  H4: "Hernie de disc"
  Body-sm: "Deplasarea unui disc intervertebral care comprimă nervii,
             cauzând durere, amorțeală sau slăbiciune la nivelul membrelor."
  Link: /conditii/hernie-de-disc

Card 3:
  Icon: Blood vessel / circle
  H4: "Anevrism cerebral"
  Body-sm: "Dilatarea localizată a unui vas de sânge cerebral.
             Poate fi tratată prin intervenție chirurgicală sau tehnici endovasculare."
  Link: /conditii/anevrism-cerebral

Card 4:
  Icon: Droplet / flow
  H4: "Hidrocefalie"
  Body-sm: "Acumularea de lichid cefalorahidian în creier.
             Tratamentul implică plasarea unui șunt sau proceduri endoscopice."
  Link: /conditii/hidrocefalie

Card 5:
  Icon: Nerve / lightning bolt
  H4: "Nevralgie de trigemen"
  Body-sm: "Durere facială severă, bruscă, cauzată de iritarea nervului trigemen.
             Tratamentele includ medicație, proceduri percutane și intervenție chirurgicală."
  Link: /conditii/nevralgie-de-trigemen

Card 6:
  Icon: Canal / passage
  H4: "Stenoză spinală"
  Body-sm: "Îngustarea canalului spinal care comprimă măduva spinării sau rădăcinile nervoase,
             cauzând durere și dificultăți de mers."
  Link: /conditii/stenoza-spinala
```

### Elementor Implementation Steps

1. Create full-width Flexbox Container, background Global Color "Surface Muted".
2. Padding: 80px top/bottom (desktop), 40px (mobile).
3. Inner container: max-width 1200px, column.
4. Add `molecule-section-header` template from Template Library: set overline, H2, and lead text per above.
5. Section header margin-bottom: 48px (`space-12`).
6. Create a Grid Container (Elementor Grid widget or CSS Grid): 3 columns desktop, 2 tablet, 1 mobile. Gap: `space-6` (24px). Set `role="list"` via Custom Attributes.
7. Add 6 `molecule-card-condition` templates from Template Library. Edit content per placeholders above. Each card has `role="listitem"`.
8. Below grid: add `atom-button-ghost` → "Toate condițiile tratate →" → link `/conditii`.
9. Custom ID: `organism-conditions-grid`.

### Mobile Behavior

1-column grid. Cards full-width. Ghost CTA centered below grid.

### Accessibility

- Grid: `role="list"`. Each card: `role="listitem"`.
- Ghost CTA label: "Toate condițiile tratate" — descriptive without context.
- Condition icons: `aria-hidden="true"` on all SVGs (card H4 is the accessible label).

---

## Section 4 — Doctor Introduction

**Background:** `color-surface-warm` (#F4EFE6)
**Padding:** `space-20` (80px) top/bottom desktop; `space-10` (40px) mobile
**Layout:** Two-column Flexbox, 40/60 split (photo left, content right), gap `space-16` (64px)

This section provides the patient a first personal impression of the doctor before they read the full biography. It uses the `molecule-card-doctor-teaser` content pattern in a full-width section context.

> **Note:** This is a standalone section assembling existing atoms and molecules — not a named organism in the library. If this pattern recurs on other pages, formalize it as `organism-doctor-teaser-section`.

### Content Slots

```
[image — left column]
Content: Doctor portrait (different from hero photo if possible — different angle/setting)
         If only one photo is available, use the same photo cropped differently.
Alt text: "Dr. George Ungureanu în consultație"
Aspect ratio: 4:5 (portrait)
Border-radius: 8px
Object fit: cover, top center

[overline — right column]
Placeholder: "DESPRE DR. UNGUREANU"
Typography: Global "Overline"
Color: Global "Accent"

[headline — H2]
Placeholder: "Medicul care ascultă înainte să diagnosticheze"
Typography: Global "H2 — Section Headline"
Color: Global "Ink"
Note: A human-voice statement, not a title.

[body — 2–3 paragraphs]
Paragraph 1 (lead — Body Large):
  Placeholder: "Am ales neurochirurgia pentru că este specialitatea în care deciziile
  contează cel mai mult — și în care comunicarea clară cu pacientul este la fel
  de importantă ca tehnica chirurgicală."

Paragraph 2–3 (body):
  Placeholder: "La prima consultație, obiectivul meu este să înțeleg situația dvs.
  în totalitate — nu doar imaginistic și clinic, ci și din perspectiva modului
  în care afecțiunea vă afectează viața. Abia după aceea discutăm opțiunile."

  Placeholder: "Fiecare pacient primește o evaluare individualizată. Nu există o
  soluție universală în neurochirurgie — există soluția potrivită pentru situația dvs."

Typography: Global "Body" for paragraphs 2–3
Color: Global "Ink"
Max-width: reading-column (700px)

[ghost CTA]
Label: "Află mai multe despre Dr. Ungureanu →"
Link: /despre
Typography: Global "Body", Global Color "Accent"
```

### Elementor Implementation Steps

1. Create full-width Flexbox Container, background Global Color "Surface Warm".
2. Padding: 80px top/bottom (desktop), 40px (mobile).
3. Inner container: max-width 1200px, Flexbox Row (desktop) / Column (mobile), gap `space-16` (64px), align items center.
4. **Left column** (40% desktop, 100% mobile):
   - Add Image widget → doctor portrait → Alt text → border-radius 8px (via Elementor border controls or CSS class) → object-fit cover → width 100%.
   - On desktop: column is 40% flex basis. On mobile: full width, height 320px, object-fit cover.
5. **Right column** (60% desktop, 100% mobile): Flexbox Column, gap `space-5` (20px).
   - Text widget → overline → CSS class `text-overline` → Global Color "Accent" → Global Typography "Overline".
   - Heading → H2 → Global Color "Ink" → Global Typography "H2 — Section Headline".
   - Text Editor → paragraph 1 → Global Typography "Body Large" → CSS class `reading-column`.
   - Text Editor → paragraphs 2–3 → Global Typography "Body" → CSS class `reading-column`.
   - Button → ghost style → "Află mai multe despre Dr. Ungureanu →" → link `/despre`.
6. Mobile: image stacks above text. Image height 280px.
7. Custom ID: `section-doctor-intro-homepage`.

### Content Rules

- The body text must be in the first person (the doctor's voice).
- No credentials, degrees, or institution names in this section.
- The lead paragraph must contain one specific, human motivation — why this doctor chose this specialty.
- The third paragraph (if used) may be replaced by a `molecule-pull-quote` if the doctor has a well-formed philosophical statement. Pull-quote uses Lora italic, 24px.

### Accessibility

Photo alt text describes the scene, not just the person: "Dr. George Ungureanu în consultație" or "Dr. George Ungureanu în cabinetul medical".

---

## Section 5 — Trust Indicators (Doctor Credentials, Compact)

**Organism:** `organism-doctor-credentials` (homepage compact variant)
**Background:** `color-surface` (#FDFBF7)
**Padding:** `space-16` (64px) top/bottom desktop; `space-8` (32px) mobile

The homepage variant of `organism-doctor-credentials` shows **only the 3 trust indicator cards** — no credential list. The credential list is on the About page only. This section exists to give the patient numerical context for the doctor's experience without turning it into an achievement display.

> **Important:** All figures in this section must be confirmed with Dr. Ungureanu. Do not use placeholder numbers. Do not exaggerate or round up significantly. If real figures are not yet confirmed, leave this section hidden until they are. The entire purpose of this section is destroyed if the numbers are not accurate.

### Content Slots

```
[overline]
Placeholder: "EXPERIENȚĂ"

[headline — H2]
Placeholder: "Formare și practică neurochirurgicală"

[trust card 1]
Number: [CONFIRM WITH DR. UNGUREANU — e.g., "15+"]
Label: "ani de practică neurochirurgicală"
Note: Years of neurosurgical practice. Experience depth, not volume.

[trust card 2]
Number: [CONFIRM WITH DR. UNGUREANU — e.g., "10+"]
Label: "ani de specializare în chirurgie minim-invazivă"
Note: A specific competence, not a volume count.

[trust card 3]
Number: [CONFIRM WITH DR. UNGUREANU — e.g., "3"]
Label: "centre universitare de formare"
Note: Institutional grounding — where trained, not how many procedures.

[ghost CTA]
Label: "Citiți biografia completă →"
Link: /despre
```

**Figures that must NOT be used without exact confirmation:**
- "500+ intervenții" (procedure volume) — acceptable only if accurate, confirmed, and patient-contextualised
- "20+ publicații" — this is an achievement metric, not a patient reassurance metric; move to the About/credentials page
- Any superlative ("cel mai bun", "leading", "world-class")

### Elementor Implementation Steps

1. Create full-width Flexbox Container, background Global Color "Surface".
2. Padding: 64px top/bottom (desktop), 32px (mobile).
3. Inner container: max-width 1200px, Flexbox Column, gap `space-10` (40px).
4. Add `molecule-section-header` (compact — overline + H2, no lead text): set content per above.
5. Create 3-column Flexbox Container (desktop) / 1-column (mobile): gap `space-8` (32px).
6. Add 3 `molecule-card-trust` templates from Template Library. Edit figures and labels per confirmed content.
   - Each card: Flexbox column, centered, gap `space-3` (12px).
   - Number: Lora 700 52px, Global Color "Accent".
   - Label: Global Typography "Body Small", Global Color "Ink Secondary".
7. Below cards: atom-button-ghost → "Citiți biografia completă →" → `/despre`.
8. Custom ID: `organism-doctor-credentials-homepage`.

### Mobile Behavior

3-column becomes 1-column. Cards stack vertically, each full-width and centered. Padding: 32px.

---

## Section 6 — Patient Testimonials (Conditional)

**Organism:** `organism-patient-testimonials`
**Background:** `color-accent-subtle` (#E4EDEB)
**Padding:** `space-20` (80px) top/bottom desktop; `space-10` (40px) mobile
**Visibility:** Hidden by default. Show only when real testimonials are available.

> **Do not populate with placeholder or fabricated testimonials.** The value of this section depends entirely on authenticity. If testimonials are not available at launch, hide this section via Elementor's display settings. When real testimonials are collected (with explicit patient permission), populate and un-hide.

### Content Slots (when real content is available)

```
[overline]
Content: "CE SPUN PACIENȚII NOȘTRI"

[headline — H2]
Content: "Experiențe reale de la pacienți reali"

[testimonial 1 — molecule-pull-quote]
Quote: [Real patient statement in first person — 15–40 words]
Attribution: "— [First name], [condition category], [year]"
Example format: "— Maria, pacientă hernii de disc, 2024"
Content guidance: Statement describes the communication/understanding experience, not just the outcome.

[testimonial 2 — molecule-pull-quote]
Same format. Ideally addresses a different aspect (e.g., the wait time, the explanation, the follow-up).

[testimonial 3 — molecule-pull-quote — optional]
Same format. Can be omitted if only 2 real testimonials are available.
```

### Elementor Implementation Steps

1. Create full-width Flexbox Container, background Global Color "Accent Subtle".
2. Padding: 80px (desktop), 40px (mobile).
3. Inner container: max-width 1000px, Flexbox Column, gap `space-8` (32px).
4. Add `molecule-section-header`: overline + H2, no lead text.
5. Add 2–3 `molecule-pull-quote` templates. Each separated by `atom-divider`.
6. Each pull-quote: `<blockquote>` element, Lora italic 24px, left border 3px `color-accent`.
7. Attribution: `<cite>` element, `atom-caption` style.
8. **Hide this entire section** via Elementor Advanced → Responsive → Hide on all devices until real content is available.
9. Custom ID: `organism-patient-testimonials`.

### Accessibility

- `<blockquote>` for each quote, `<cite>` for attribution.
- Section is fully static — no auto-scroll or animation.
- When section is hidden, it is `display: none` — not present in the accessibility tree.

---

## Section 7 — How It Works

**Organism:** `organism-how-it-works`
**Background:** `color-surface-warm` (#F4EFE6)
**Padding:** `space-20` (80px) top/bottom desktop; `space-10` (40px) mobile

This section shows the patient the logistical path from first contact to first appointment. It reduces the anxiety of "what happens after I reach out?" The patient sees a numbered, human sequence and understands what is expected of them.

> **Relationship to `/programari`:** This section shows the *process*. The `/programari` page shows the *locations*. Together they answer "how does this work?" and "where do I go?" The CTA at the end of this page (`organism-cta-banner`) routes to `/programari`.

### Content Slots

```
[overline]
Placeholder: "CUM FUNCȚIONEAZĂ"

[headline — H2]
Placeholder: "Pașii următori spre prima consultație"

[lead text — optional]
Placeholder: "Procesul este simplu și transparent.
Începe cu alegerea locației potrivite pentru dvs."

[step 1 — molecule-process-step]
Number circle: 1
H4: "Alegeți locația potrivită"
Body-sm: "Vizitați pagina Programări pentru a găsi clinica sau spitalul
           cel mai convenabil pentru dvs. din Cluj-Napoca sau Baia Mare."

[step 2 — molecule-process-step]
Number circle: 2
H4: "Solicitați programarea"
Body-sm: "Completați formularul de contact de pe pagina Programări sau sunați direct
           la locația aleasă. Vă confirmăm programarea în maximum 24 de ore."

[step 3 — molecule-process-step]
Number circle: 3
H4: "Prima consultație"
Body-sm: "Consultația inițială durează aproximativ 45–60 de minute. Dr. Ungureanu
           ascultă, explică și răspunde la toate întrebările dvs., fără grabă."

[step 4 — molecule-process-step]
Number circle: 4
H4: "Stabilim împreună planul terapeutic"
Body-sm: "Primiți o explicație clară a tuturor opțiunilor disponibile.
           Decizia finală vă aparține — niciodată nu vi se impune un traseu terapeutic."
```

### Elementor Implementation Steps

1. Create full-width Flexbox Container, background Global Color "Surface Warm".
2. Padding: 80px (desktop), 40px (mobile).
3. Inner container: max-width 800px, centered, Flexbox Column, gap `space-8` (32px).
4. Add `molecule-section-header` template: overline + H2 + optional lead text.
5. Below section header: add 4 `molecule-process-step` templates from Template Library.
   - Edit step number, H4, and body-sm per content above.
   - Between each step: no divider needed — the gap (`space-8`) provides sufficient separation.
6. Optional: add a 2px dashed `color-border` vertical connector line between step circles via CSS class on the steps container:
   ```css
   .steps-container { position: relative; }
   .steps-container::before {
     content: '';
     position: absolute;
     left: 19px; /* center of 40px circle */
     top: 40px;
     bottom: 40px;
     width: 2px;
     background: repeating-linear-gradient(
       to bottom,
       var(--color-border) 0,
       var(--color-border) 6px,
       transparent 6px,
       transparent 12px
     );
   }
   ```
   Add class `steps-container` to the steps wrapper container.
7. Custom ID: `organism-how-it-works`.

### Mobile Behavior

Steps remain horizontal (number circle left, content right). Gap reduces to `space-6` (24px). The optional connector line is hidden on mobile via responsive CSS.

### Accessibility

Step numbers: the number circle is decorative — the H4 carries the semantic meaning. Add `aria-hidden="true"` to the number container div.

---

## Section 8 — Article Grid

**Organism:** `organism-article-grid`
**Background:** `color-surface` (#FDFBF7)
**Padding:** `space-20` (80px) top/bottom desktop; `space-10` (40px) mobile

### Content Slots

```
[overline]
Placeholder: "RESURSE PENTRU PACIENȚI"

[headline — H2]
Placeholder: "Înțelegeți mai bine condiția dvs."

[lead text — optional]
Placeholder: "Articolele de mai jos sunt scrise pentru pacienți, nu pentru medici.
               Fiecare articol răspunde la o întrebare reală."

[grid — 3 article cards]
Note: In Phase 1, populate with 3 real articles if available.
      If no articles exist at launch, hide this section (like testimonials).
      Do NOT populate with Lorem Ipsum or placeholder article titles.
      If 1–2 articles exist, show only those — do not pad with empty cards.

Article card placeholder format (for editorial team):
  Image: Featured image (4:3 ratio, WebP, max 80KB)
  Tag: Category pill — "Condiții tratate" / "Recuperare" / "Ghid pacienți"
  H4: Patient-facing question or statement (NOT medical jargon)
       Example: "Ce să aștepți după o operație la coloana vertebrală"
       NOT: "Recuperare postoperatorie spinală"
  Body-sm: 2–3 sentence excerpt in patient language
  molecule-meta: Date + reading time ("5 minute de citit")
  Ghost CTA: "Citește articolul →" → article URL

[ghost CTA — below grid]
Label: "Toate articolele →"
Link: /resurse
Note: Only show if 3+ articles exist. If fewer, omit this link.
```

### Elementor Implementation Steps

1. Create full-width Flexbox Container, background Global Color "Surface".
2. Padding: 80px (desktop), 40px (mobile).
3. Inner container: max-width 1200px, column.
4. Add `molecule-section-header`: overline + H2 + optional lead.
5. Section header margin-bottom: 48px.
6. Create 3-column Grid Container (desktop), 2-column (tablet), 1-column (mobile). Gap: `space-6` (24px).
7. Add 3 `molecule-card-article` templates. Populate with real article content.
8. Below grid: `atom-button-ghost` → "Toate articolele →" → `/resurse`.
9. If no articles available: hide entire section via Elementor Advanced → Responsive.
10. Custom ID: `organism-article-grid`.

### Mobile Behavior

1-column grid. Cards full-width. Reading time remains visible.

### Accessibility

- Article card images: if image is descriptive, use descriptive alt text. If purely illustrative, `alt=""`.
- Ghost CTA: "Toate articolele" — descriptive.
- Reading time: plain text (not an icon alone).

---

## Section 9 — Final CTA

**Organism:** `organism-cta-banner`
**Background:** `color-ink` (#231E1A) — the only dark section on the page
**Padding:** `space-24` (96px) top/bottom desktop; `space-12` (48px) mobile
**Text color:** `color-surface` (#FDFBF7) — all text inverted

This is the page's closing invitation. A patient who has scrolled through the full homepage has gathered significant information. They are ready to act or nearly so. This section does not pressure — it simply opens the door calmly and clearly.

### Content Slots

```
[overline]
Placeholder: "PASUL URMĂTOR"
Color: color-accent-subtle (#E4EDEB) — on dark background, use the subtle variant
Typography: Global "Overline"

[headline — H2]
Placeholder: "Sunteți gata să înțelegeți opțiunile dvs.?"
Typography: Global "H2 — Section Headline"
Color: color-surface
Note: A warm, direct question — not a marketing headline.
      Does not contain urgency ("acum", "nu așteptați", "locuri limitate").

[body]
Placeholder: "O consultație cu Dr. Ungureanu este primul pas.
Discutăm situația dvs. împreună, răspundem la întrebări și stabilim care este
calea potrivită — fără grabă și fără presiune."
Typography: Global "Body"
Color: color-surface (at 85% opacity for visual softness)
Max-width: reading-column (700px)

[cta-primary]
Label: "Programează o consultație"
Link: /programari
Style: Inverted primary button —
       Background: color-surface (#FDFBF7)
       Text: color-ink (#231E1A)
       Hover: background → color-surface-warm (#F4EFE6)
Note: On the dark background, the primary button is inverted.
      This is the only place the inverted button appears.

[cta-secondary]
Label: "Contactați-ne"
Link: /contact
Style: Inverted secondary button —
       Background: transparent
       Border: 1.5px solid color-surface
       Text: color-surface
       Hover: background → rgba(253, 251, 247, 0.12)
```

### Elementor Implementation Steps

1. Create full-width Flexbox Container, background Global Color "Ink".
2. Padding: 96px (desktop), 48px (mobile).
3. Inner container: max-width 800px, centered, Flexbox Column, align items center, text-align center, gap `space-6` (24px).
4. Text widget → overline → CSS class `text-overline` → color: `#E4EDEB` (manually entered — this is the one permitted local color override on dark backgrounds, as Global Color "Accent Subtle" serves the same function).
5. Heading → H2 → color: `#FDFBF7` (Global Color "Surface") → Global Typography "H2 — Section Headline" → text-align center.
6. Text Editor → body → Global Typography "Body" → color: `#FDFBF7` → CSS class `reading-column` → text-align center.
7. Flexbox Container (button group): Direction Row, gap `space-4` (16px), wrap on mobile.
   - Button 1 → "Programează o consultație" → `/programari` → Custom CSS: `background: #FDFBF7; color: #231E1A; border-radius: 6px;`
   - Button 2 → "Contactați-ne" → `/contact` → Custom CSS: `background: transparent; border: 1.5px solid #FDFBF7; color: #FDFBF7; border-radius: 6px;`
8. Focus rings on dark: `:focus-visible` outline uses `color-accent-subtle` — this is handled globally by `custom.css` but verify it renders correctly on dark backgrounds.
9. Mobile: buttons stack vertically, full-width.
10. Custom ID: `organism-cta-banner`.

### Accessibility

- Dark background: verify contrast. `color-surface` (#FDFBF7) on `color-ink` (#231E1A) = 14.5:1 — passes WCAG AA.
- Inverted primary button: `color-ink` (#231E1A) text on `color-surface` (#FDFBF7) background = 14.5:1 — passes.
- This is the one dark section allowed per page. Do not add a second.

---

## /programari Page — Minimum Viable Specification

The homepage's primary CTA routes to `/programari`. This page must exist before the homepage can go live. Below is the minimum viable page structure for `/programari` at launch.

**Page URL:** `/programari`
**Page title (SEO):** "Programări — Dr. George Ungureanu, Neurochirurg"
**Navigation label:** "Programări" (recommend adding to main nav — see COMPONENT_INVENTORY.md Open Question 14)

### /programari Page Section Sequence

```
organism-site-header (global)
organism-hero-interior:
  Breadcrumb: Acasă / Programări
  Overline: "PROGRAMĂRI"
  H1: "Unde puteți consulta Dr. Ungureanu"
  Lead: "Dr. Ungureanu consultă și operează în mai multe centre medicale din
         Cluj-Napoca și Baia Mare. Găsiți locația cea mai convenabilă pentru dvs."

organism-location-directory:
  [Location cards — REQUIRES CONFIRMED DATA FROM DR. UNGUREANU]
  See: docs/components/03_ORGANISMS.md §organism-location-directory
  See: COMPONENT_INVENTORY.md Open Question 13

organism-how-it-works (optional — if not showing on same page via homepage scroll):
  Shortened to 3 steps: Contact → Confirmare → Consultație
  Background: color-surface-warm

organism-cta-banner:
  H2: "Nu ați găsit locația potrivită?"
  Body: "Contactați-ne direct și găsim împreună soluția cea mai bună."
  Primary: "Contactați-ne" → /contact  [NOTE: on /programari, the CTA goes to /contact]
  Secondary: hidden (no second action needed here)

organism-site-footer (global)
```

> **Important:** The `/programari` page CTA banner primary button links to `/contact` — not back to `/programari`. The chain is: Any page → `/programari` (find location) → `/contact` (send message). This breaks the `/programari` → `/programari` loop.

---

## Content Inventory

Everything needed before the homepage can go live:

### Content — Required Before Launch

| Item | Source | Blocking? |
|------|--------|-----------|
| Doctor portrait — hero column | Dr. Ungureanu photography | Yes — hero cannot render without |
| Doctor portrait — Section 4 (can be same photo cropped) | Same photography session | Yes — Section 4 incomplete without |
| Patient Promise text (Section 2) — confirmed with Dr. Ungureanu | Dr. Ungureanu | Yes — must not be placeholder at launch |
| Doctor Introduction text (Section 4) — first-person voice | Dr. Ungureanu | Yes — must be authentic |
| Trust indicator figures — all 3 confirmed | Dr. Ungureanu | Yes — hide section until confirmed |
| Condition names and descriptions (6 cards) — confirmed | Dr. Ungureanu | Yes — conditions cannot be invented |
| Condition page URLs (6 links) — must exist | Site architecture | Yes — cards link to real pages |

### Content — Required Before Launch (or Section Hidden)

| Item | Blocking sections |
|------|-----------------|
| Real patient testimonials (with permission) | Section 6 |
| Published articles (3 minimum) | Section 8 |
| Location data (all /programari fields) | /programari page |

### Content — Pre-launch Acceptable Placeholders

| Item | Acceptable placeholder |
|------|----------------------|
| Hero H1 | Any of the 3 approved headline directions listed in Section 1 |
| Conditions grid H2 | "Condiții în care ne specializăm" |
| Section headers (overlines) | As specified above |
| Ghost CTA labels | As specified above |

---

## Mobile Layout Summary

| Section | Desktop layout | Mobile layout |
|---------|---------------|---------------|
| Hero | 2-column (55/45) | 1-column, text above, image below (280px height) |
| Promise | Centered, max 760px | Full-width, centered, same padding |
| Conditions | 3-column grid | 1-column grid |
| Doctor | 2-column (40/60) | 1-column, image above (280px), text below |
| Trust | 3-column cards | 1-column cards, stacked |
| Testimonials | 1-column, max 1000px | Same |
| How It Works | 1-column, max 800px | Same, gap reduced |
| Articles | 3-column grid | 1-column grid |
| CTA Banner | Centered, max 800px | Same, buttons full-width |

**Global mobile padding:** All sections reduce from desktop padding to `space-10` (40px) on mobile, except Hero (`space-12` / 48px) and Trust (`space-8` / 32px).

---

## Implementation Sequence

Build sections in this order to ensure no section references a component that hasn't been tested:

1. Verify all atoms, molecules, and organisms from Prompt 02 are in the Template Library.
2. Build `organism-site-header` in Theme Builder (if not already done).
3. Build `organism-site-footer` in Theme Builder (if not already done).
4. Create a new WordPress page: title "Acasă" / slug `/`.
5. Open in Elementor editor.
6. Build sections 1–9 in order.
7. For each section: add section container → insert organism template from Template Library → edit content → verify mobile → save.
8. Section 6 (Testimonials): add but hide.
9. Section 8 (Articles): add but hide if no articles exist.
10. Test full page on desktop and mobile.
11. Run accessibility checks (heading hierarchy, alt text, focus order).
12. Create `/programari` page (minimum viable version — hero + location directory placeholder + CTA).
13. Set the homepage as the WordPress front page: Settings → Reading → Static page → Homepage.

---

## Accessibility Verification Checklist

Complete this checklist before marking the homepage done:

**Heading hierarchy:**
- [ ] One H1 on the page (hero headline)
- [ ] All section headlines use H2
- [ ] Condition card names use H4
- [ ] Trust card labels are not headings (they are styled display text)
- [ ] No heading levels are skipped

**Images:**
- [ ] Hero doctor photo: descriptive alt text
- [ ] Section 4 doctor photo: descriptive alt text
- [ ] Condition card icons: `aria-hidden="true"`
- [ ] Article card images: alt text appropriate (descriptive or `""` if decorative)

**Interactive elements:**
- [ ] All buttons have descriptive labels (no "Click here")
- [ ] All links describe their destination
- [ ] Focus rings visible on all interactive elements (test with Tab key)
- [ ] "Programează o consultație" buttons open `/programari` (verify)
- [ ] No keyboard traps

**Motion:**
- [ ] All Entrance Animations in Elementor sections: set to None
- [ ] Verify `prefers-reduced-motion` suppression works (DevTools → Rendering → Emulate reduced motion → confirm no animations)

**Contrast:**
- [ ] All text on light backgrounds: ≥ 4.5:1 (color-ink on color-surface = 14.5:1 ✓)
- [ ] Section 9 dark background: color-surface on color-ink = 14.5:1 ✓
- [ ] Trust card numbers: color-accent on color-surface = 4.6:1 ✓ (minimum — verify at 52px size, large text rule applies: ≥ 3:1)

**Semantic structure:**
- [ ] Skip-to-content link in header works (Tab → Enter → focus moves past nav)
- [ ] Conditions grid: `role="list"` on container, `role="listitem"` on each card
- [ ] Testimonial section: `<blockquote>` and `<cite>` elements used

---

## Launch Readiness Checklist

- [ ] Doctor photography confirmed and delivered
- [ ] Patient Promise text confirmed with Dr. Ungureanu
- [ ] Doctor Introduction body text confirmed with Dr. Ungureanu
- [ ] Trust indicator figures confirmed — all 3
- [ ] 6 condition cards: names, descriptions, and URLs all confirmed
- [ ] /programari page live (minimum viable — can have placeholder location cards but page must exist)
- [ ] /conditii page live (conditions grid links to it)
- [ ] /despre page live (Doctor and Trust sections link to it)
- [ ] WordPress front page set to this page
- [ ] Skip-to-content link working in the header
- [ ] Page load time under 3 seconds on mobile (test with WebPageTest or Lighthouse)
- [ ] Lighthouse accessibility score ≥ 90

---

## Open Questions for Dr. Ungureanu

Before implementing:

1. **Hero headline:** Which of the 3 proposed directions resonates most? Or does he have a preferred formulation?
2. **Patient Promise text:** Please provide 2–3 sentences in first person about the philosophy of care. Rough draft is fine — the editorial team will refine.
3. **Doctor Introduction:** Please provide a 3–4 sentence human introduction (first person, motivations, patient care philosophy). This is Section 4.
4. **Trust figures:** Confirm exact figures for all 3 trust cards. If figures cannot be confirmed, specify which ones can be used.
5. **Condition list:** Confirm which 6 conditions appear on the homepage. Confirm condition names in Romanian plain language.
6. **Testimonials:** Are any patient testimonials currently available (with permission)? If so, provide first name, condition, year, and the testimonial text.
