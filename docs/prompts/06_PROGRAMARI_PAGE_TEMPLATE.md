# Prompt 06: /programari Page Template

## georgeungureanu.doctor — Appointment Hub Implementation Guide

**Page URL:** `/programari`
**WordPress page title:** "Programări"
**Navigation label:** "Programări" (item 3 in confirmed 6-item navigation)
**SEO title:** "Programări — Dr. George Ungureanu, Neurochirurg"
**SEO description:** "Găsiți clinica sau spitalul unde Dr. Ungureanu consultă sau operează. Locații în Cluj-Napoca și Baia Mare. Solicitați o programare prin formularul de contact."

**Governing sources:**
- `docs/project/WEBSITE_GOALS.md` §CTA Routing Decision
- `docs/components/02_MOLECULES.md §molecule-location-card`
- `docs/components/03_ORGANISMS.md §organism-location-directory`
- `docs/implementation/03_ELEMENTOR_QA_RULES.md`
- `docs/prompts/05_THEME_BUILDER_GLOBALS.md`

**Prerequisites before building this page:**
- Prompts 01–05 complete: design system, components, homepage, QA rules, header/footer
- The `organism-site-header` and `organism-site-footer` must be live via Theme Builder
- `#main-content` ID must be added to the first content section of this page template

**What this document is:** A complete implementation guide for the `/programari` page — the destination of every "Programează o consultație" primary CTA on the site. This is the single most important destination page in the patient journey.

---

## Why This Page Exists

Every primary CTA on the site sends the patient here. Before a patient can commit to an appointment, they need to answer four questions:

1. **Where can I find this doctor?** — which city, which clinic or hospital
2. **Is this doctor accessible to me?** — can I get there, is there parking, is it accessible?
3. **When is the doctor there?** — days and hours at this specific location
4. **How do I actually book?** — what to do next, where to call or write

A patient who cannot answer all four questions will not book. They will close the tab. This page exists to eliminate that outcome.

The page does not book appointments. It answers the four questions above, then directs the patient to `/contact` as the single booking action. The routing chain is:

```
Any page → "Programează o consultație" → /programari → "Contactați-ne" → /contact
```

The `/programari` → `/contact` routing is non-negotiable. No primary CTA on this page should route back to `/programari` — that creates a loop with no exit.

---

## Page Architecture

| # | Section | Organism / Component | Background | Notes |
|---|---------|---------------------|-----------|-------|
| 1 | Hero | `organism-hero-interior` | `color-surface-warm` | H1 + breadcrumb + lead |
| 2 | Location directory | `organism-location-directory` | `color-surface` | Primary content of the page |
| 3 | How it works | `organism-how-it-works` (contextual) | `color-surface-warm` | Shortened, /programari-adapted |
| 4 | CTA banner | `organism-cta-banner` (/programari variant) | `color-ink` | → /contact only, no secondary CTA |

**Background alternation:** warm → surface → warm → ink. No two adjacent sections share a background. ✓

**Global organisms:** `organism-site-header` and `organism-site-footer` are applied via Theme Builder — they are not built on this page.

---

## Section 1 — Hero (`organism-hero-interior`)

**Background:** `color-surface-warm` (#F4EFE6)
**Padding:** 80px top/bottom desktop, 40px mobile

### Content

```
[breadcrumb — molecule-breadcrumb]
Text: "Acasă → Programări"
Links: "Acasă" → /    |    "Programări" (current, aria-current="page")
Typography: Global "Caption" (Inter 400, 13px)
Color: Global "Ink Secondary" with "Accent" separator

[overline]
Text: "PROGRAMĂRI"
Typography: Global "Overline" (Inter 500, 12px, uppercase, 2px letter-spacing)
Color: Global "Accent"
CSS class: text-overline

[H1]
Text: "Unde îl puteți găsi pe Dr. George Ungureanu"
Typography: Global "H1 — Page Title" (Lora 700, 52px desktop / 36px mobile)
Color: Global "Ink"
Note: Left-aligned. Interior heroes are never centered.
      This is the only H1 on the page.

[lead text — atom-body-lg]
Text: "Dr. Ungureanu consultă și desfășoară activitate chirurgicală în mai multe
centre medicale din Cluj-Napoca și Baia Mare. Găsiți mai jos locația care
vă este cel mai convenabilă și contactați-ne pentru a stabili data consultației."
Typography: Global "Body Large" (Inter 400, 20px)
Color: Global "Ink"
Max-width: 700px (reading-column class)
```

**Text alignment:** Left-aligned throughout — interior heroes are always left-aligned. Never centered.
**Max-width content column:** 800px (organism-hero-interior standard)

### Elementor Implementation

1. Insert `organism-hero-interior` template from Template Library
2. Set Custom ID: `organism-hero-interior-programari`
3. Set `id="main-content"` on this section (Advanced → CSS ID: `main-content`) — this is the skip-to-content target from the header
4. Edit breadcrumb: set links to / and current page label "Programări"
5. Edit overline widget: content "PROGRAMĂRI", CSS class `text-overline`
6. Edit H1 heading: content per above
7. Edit lead text: content per above, add CSS class `reading-column`
8. Background: Global Color "Surface Warm"
9. Padding: 80px top/bottom (desktop), 40px (mobile)

---

## Section 2 — Location Directory (`organism-location-directory`)

**Background:** `color-surface` (#FDFBF7)
**Padding:** 80px top/bottom desktop, 40px mobile

This is the primary content of the page. Everything else on the page exists to support this section.

### Section Header

```
[overline]
Text: "UNDE NE GĂSIȚI"
Typography: Global "Overline"
Color: Global "Accent"

[H2]
Text: "Clinici și spitale unde consultăm"
Typography: Global "H2 — Section Headline" (Lora 700, 38px)
Color: Global "Ink"

[lead text]
Text: "Dr. Ungureanu este prezent regulat în centrele medicale de mai jos.
Fiecare locație indică tipul de activitate (consultații sau intervenții
chirurgicale) și programul specific. Alegeți locația potrivită, apoi
contactați-ne pentru a stabili data."
Typography: Global "Body" (Inter 400, 17px)
Color: Global "Ink"
Max-width: 700px (reading-column)
```

### City Group Structure

The location directory organizes cards by city. Apply the following grouping logic:

**Cluj-Napoca (primary city — multiple locations assumed):**
Since 2+ locations are expected in Cluj-Napoca, use a city group header:

```
[city group header]
atom-overline: "CLUJ-NAPOCA"
  Color: Global "Ink Secondary"
  Typography: Global "Overline"
  Margin-top: 48px (space-12) above first city group
  Margin-bottom: 24px (space-6) before first card

atom-h3: "Locații în Cluj-Napoca"
  Typography: Global "H3 — Subsection Headline" (Lora 600, 26px)
  Color: Global "Ink"
  Margin-bottom: 8px
```

**Baia Mare (secondary city — one location assumed):**
Even with a single location, use a city group header. This helps patients scan the geographic distribution of all locations at a glance and confirms that this doctor is accessible from Baia Mare.

```
[city group header]
atom-overline: "BAIA MARE"
atom-h3: "Locație în Baia Mare"
```

**Adding new cities in the future:**
If a third city is added, it follows the same pattern. City group headers use `atom-overline` + `atom-h3`. Each new city group is preceded by `atom-divider` (color-border, full-width) and `space-12` (48px) margin.

### Location Card Grid

**Grid specifications:**
- Desktop: 2 columns, gap 24px (space-6)
- Tablet: 2 columns, gap 16px (space-4)
- Mobile: 1 column, gap 16px (space-4)
- Grid role: `role="list"` on the grid container; `role="listitem"` on each card wrapper

**Card ordering within a city group:**
1. Consultation-only locations (patients most likely need this for a first visit)
2. Combined (consultation + surgery) locations
3. Surgery-only locations

---

### `molecule-location-card` — Expanded Specification

Each card represents one physical location. The card is the most critical data element on this page — it must be accurate, complete for all required fields, and honest about what is not yet confirmed.

#### Card Visual Structure

```
Card container
├── Visit type badge (top of card)
│   └── atom-body-sm: "Consultații" / "Intervenții chirurgicale" / "Consultații și intervenții"
│       Style: Inter 500 12px, color-accent text, color-accent-subtle background,
│              4px/12px padding, 20px border-radius (pill shape)
│
├── H4: Clinic or hospital name (patient-facing name)
│   Typography: Global "H4 — Card Headline" (Inter 600, 18px)
│   Color: Global "Ink"
│   Margin-top: 16px (space-4)
│
├── atom-body-sm: Full address
│   Line 1: Street address + number
│   Line 2: City (bold or color-ink-secondary for visual separation)
│   Typography: Global "Body Small" (Inter 400, 14px)
│   Color: Global "Ink"
│
├── atom-divider (thin, color-border, 8px margin top/bottom)
│
├── Schedule block [REQUIRED]
│   molecule-meta (calendar icon + days): Days present — e.g., "Luni, Miercuri, Vineri"
│   molecule-meta (clock icon + hours): Hours — e.g., "10:00 – 18:00"
│   Typography: Global "Body Small"
│   Color: Global "Ink"
│
├── Contact block [REQUIRED]
│   molecule-meta (phone icon + number): Phone number → tel: link
│   [molecule-meta (email icon + address): Email → mailto: link — OPTIONAL]
│
├── Booking method note [REQUIRED]
│   atom-body-sm: "Programare: [method]"
│   Color: Global "Ink Secondary"
│   Style: italic or standard Body Small
│   Examples:
│     "Programare prin formularul de contact de pe site"
│     "Programare telefonic la numărul de mai sus"
│     "Programare prin recepția clinicii: [number]"
│
├── Optional fields block [SHOW ONLY WHEN DATA IS CONFIRMED]
│   [molecule-meta (info icon) + patient notes]
│   [molecule-meta (car icon) + parking information]
│   [molecule-meta (accessibility icon) + accessibility information]
│
└── Card footer (border-top, 1px color-border, padding-top 16px)
    └── atom-button-ghost: "Cum ajungeți →"
        aria-label: "Direcții pentru [Location Name] în Google Maps"
        Link: Google Maps URL for the specific address
        Opens in new tab: target="_blank" rel="noopener"
        External link indicator: small icon (aria-hidden="true")
```

#### Required Fields (Blocking — card cannot be published without these)

| Field | Content | Placeholder |
|---|---|---|
| Location name | Patient-facing clinic or hospital name | `[CONFIRM CU DR. UNGUREANU — Denumirea clinicii]` |
| City | Cluj-Napoca / Baia Mare | Known from assumption |
| Address | Street + number + city | `[CONFIRM CU DR. UNGUREANU — Adresa completă]` |
| Visit type | Consultații / Intervenții / Consultații și intervenții | `[CONFIRM CU DR. UNGUREANU]` |
| Days present | Which days Dr. Ungureanu is at this location | `[CONFIRM CU DR. UNGUREANU — Zilele]` |
| Hours | Specific hours at this location | `[CONFIRM CU DR. UNGUREANU — Orele]` |
| Phone number | Booking or contact number for this location | `[CONFIRM CU DR. UNGUREANU — Telefon]` |
| Booking method | How to book at this specific location | `[CONFIRM CU DR. UNGUREANU — Modalitate programare]` |

#### Optional Fields (Shown only when confirmed — otherwise omit the widget entirely)

| Field | Content | When to show |
|---|---|---|
| Email | Email address for this location | Only if a location-specific email exists |
| Google Maps link | Direct Maps URL to the address | Once address is confirmed — always include if possible |
| Patient notes | What to bring, entrance instructions, specific notes | When location has specific requirements |
| Parking | Parking availability and practical details | When parking situation is known |
| Accessibility | Wheelchair access, lift, ground-floor access | When accessibility features are confirmed |

#### Placeholder Card Template

Use this exact format when a card's data is not yet confirmed. Never use "TBD" or leave fields blank in a published card. Instead:

**Option A — Hidden card (recommended):** Do not show any card for an unconfirmed location. Hide the card via Elementor Advanced → Responsive → Hide on all devices until data is confirmed.

**Option B — Coming soon card (only if the location's existence is confirmed but details pending):**

```
Visit type badge: [type — confirm with Dr. Ungureanu]
H4: "[CONFIRM CU DR. UNGUREANU — Denumirea clinicii]"
atom-body-sm: "Cluj-Napoca" (or confirmed city)
atom-divider
atom-body-sm (full-width, color-ink-secondary, italic):
  "Detaliile acestei locații sunt în curs de confirmare.
   Contactați-ne pentru informații."
atom-button-ghost: "Contactați-ne →" → /contact
[No Maps button, no phone, no schedule — data not yet confirmed]
```

**Option B is not recommended for launch.** A card that says "details coming soon" undermines patient trust. Use Option A (hide) until data is confirmed.

#### Example of a Fully Populated Card

The following shows the correct format with fictional placeholder content. This is for implementer reference only — replace with confirmed data from Dr. Ungureanu.

```
[Badge] Consultații și intervenții chirurgicale

H4: Clinica [CONFIRM CU DR. UNGUREANU]

Strada [CONFIRM], nr. [CONFIRM]
Cluj-Napoca

───────────────────────

📅 Luni, Miercuri, Vineri
🕐 10:00 – 18:00
📞 [CONFIRM CU DR. UNGUREANU]

Programare: Sunați la numărul de mai sus sau scrieți prin formularul de contact.

ℹ️ Aduceți documentele medicale existente (RMN, CT, analize) și buletinul de identitate.
🚗 Parcare disponibilă în curtea clinicii.
♿ Acces cu scaun cu rotile · Lift disponibil.

[Cum ajungeți →]
```

#### Elementor Implementation — Location Card

1. Insert `molecule-location-card` template from Template Library
2. The template has placeholder text in all required field widgets — replace all placeholder text before publishing
3. Add/remove optional field widgets based on confirmed data:
   - Email widget: add if email is confirmed, remove if not
   - Patient notes widget: add if notes are available, remove if not
   - Parking widget: add if parking details are known, remove if not
   - Accessibility widget: add if accessibility details are confirmed, remove if not
4. Set the Google Maps button link: edit the ghost button → link → paste the confirmed Google Maps URL
5. Set aria-label on the Maps button: Custom Attributes → `aria-label` = "Direcții pentru [Location Name] în Google Maps"
6. Set target="_blank" and rel="noopener" on the Maps button for external link opening
7. Assign a Custom ID to each card: `molecule-location-card-[location-slug]`
   Example: `molecule-location-card-cluj-clinica-name`, `molecule-location-card-baia-mare`
8. For hidden cards: Advanced → Responsive → Hide on all devices (unhide when data is confirmed)

---

### Closing Note and Contact Link

Below all location cards, outside the grid:

```
atom-body-sm (centered, color-ink-secondary):
  "Nu ați găsit o locație convenabilă? Suntem disponibili și pentru alte
   aranjamente. Contactați-ne și găsim împreună cea mai bună variantă pentru dvs."

atom-button-ghost (centered):
  "Contactați-ne →"
  Link: /contact
  Typography: Global "Body Small", Global "Accent"
  Margin-top: space-10 (40px)
```

### Elementor Implementation — Location Directory Section

1. Add a full-width Flexbox Container, background Global Color "Surface"
2. Padding: 80px top/bottom (desktop), 40px (mobile)
3. Inner container: max-width 1200px, Flexbox Column, gap 48px (space-12)
4. Insert `molecule-section-header` template → edit overline, H2, lead text
5. **Cluj-Napoca group:**
   - Add a Flexbox Column container for the group
   - Add Text widget → "CLUJ-NAPOCA" → CSS class `text-overline` → Global "Ink Secondary"
   - Add H3 Heading widget → "Locații în Cluj-Napoca" → Global "H3 — Subsection Headline"
   - Add Grid Container (Elementor Grid, 2 columns, 24px gap, role="list")
   - Insert location card templates per Cluj-Napoca location, each with role="listitem" on wrapper
6. **Divider between cities:**
   - Add `atom-divider` (full-width, color-border) — margin: 48px top/bottom
7. **Baia Mare group:**
   - Same structure as Cluj-Napoca group
   - H3: "Locație în Baia Mare"
   - Grid: 1-column (only one location assumed; if 2+ are added later, switch to 2-column)
8. **Closing note:**
   - Add Flexbox Container, centered, max-width 600px
   - Text widget → closing text → Global "Body Small" → Global "Ink Secondary" → text-align center
   - Button (ghost) → "Contactați-ne →" → /contact → Global "Accent"
9. Custom ID: `organism-location-directory`

---

## Section 3 — How It Works (Contextual Variant)

**Background:** `color-surface-warm` (#F4EFE6)
**Padding:** 64px top/bottom desktop (space-16), 32px mobile (space-8) — reduced from standard 80px
**Max-width:** 760px (narrower than standard 800px for a more compact feel on this page)

This is a contextual variant of `organism-how-it-works`. On the /programari page:
- The patient has just reviewed the location directory (Section 2)
- Step 1 ("Alegeți locația potrivită") is what they just did — or are still doing
- This section confirms the complete process and reassures the patient about what comes next

The steps are the same as the confirmed global How-It-Works content. The difference is in framing — the section H2 and lead text are adapted for this page's context.

### Content

```
[overline]
Text: "CE URMEAZĂ"
Typography: Global "Overline"
Color: Global "Accent"

[H2]
Text: "Pașii următori după ce alegeți locația"
Typography: Global "H2 — Section Headline"
Color: Global "Ink"
Note: Adapted for /programari context — acknowledges the patient has just chosen (or is choosing) a location.

[lead text — optional, kept very short]
Text: "Programul de mai jos se aplică indiferent de locația aleasă."
Typography: Global "Body Small" (smaller than usual lead — keeps this section compact)
Color: Global "Ink Secondary"

[step 1 — molecule-process-step]
Number circle: 1
H4: "Alegeți locația potrivită"
Body-sm: "Ați găsit locația convenabilă în lista de mai sus.
           Dacă nu ați găsit-o, contactați-ne — găsim împreună soluția potrivită."
Note: On this page, Step 1 acknowledges the patient's current action.
      The body-sm text is adapted — it references what the patient just did in Section 2.

[step 2 — molecule-process-step]
Number circle: 2
H4: "Solicitați programarea"
Body-sm: "Completați formularul de contact sau sunați direct la locația aleasă.
           Vă confirmăm programarea în maximum 24 de ore."

[step 3 — molecule-process-step]
Number circle: 3
H4: "Prima consultație"
Body-sm: "Consultația inițială durează aproximativ 45–60 de minute.
           Dr. Ungureanu ascultă, explică și răspunde la toate întrebările dvs., fără grabă."

[step 4 — molecule-process-step]
Number circle: 4
H4: "Stabilim împreună planul terapeutic"
Body-sm: "Primiți o explicație clară a tuturor opțiunilor disponibile.
           Decizia finală vă aparține — niciodată nu vi se impune un traseu terapeutic."
```

**What makes this "shortened":**
- Reduced padding (64px instead of 80px — reads as less emphatic, more transitional)
- Narrower max-width column (760px instead of 800px)
- Shorter lead text (Body Small instead of Body)
- Step 1 body text is adapted to reference what the patient just did — no redundancy
- No optional decorative connector line between step circles (the compact spacing makes it unnecessary)

### Elementor Implementation

1. Add a full-width Flexbox Container, background Global Color "Surface Warm"
2. Padding: 64px top/bottom (desktop), 32px (mobile)
3. Inner container: max-width 760px, centered, Flexbox Column, gap 32px (space-8)
4. Add `molecule-section-header` → edit overline "CE URMEAZĂ", H2 "Pașii următori după ce alegeți locația"
5. Add short lead text: Text widget → "Programul de mai jos se aplică indiferent de locația aleasă." → Body Small → Ink Secondary
6. Add 4 `molecule-process-step` templates, edit content per above
7. No connector line between steps on this page — leave steps separated by gap only
8. Custom ID: `organism-how-it-works-programari`

---

## Section 4 — CTA Banner (`organism-cta-banner` — /programari variant)

**Background:** `color-ink` (#231E1A)
**Padding:** 96px top/bottom desktop, 48px mobile
**Text color:** `color-surface` (#FDFBF7)

This is the most important difference between the standard `organism-cta-banner` and the `/programari` variant:

> **On the /programari page, the primary CTA links to /contact — not back to /programari.**
> The standard CTA banner sends patients to /programari. On the /programari page itself, the next step is /contact.
> **There is no secondary CTA.** A single, clear action: "Contactați-ne" → /contact.

The reason is simple: the patient on this page has found their location (or needs help finding one). Either way, the next human action is contact — not returning to the location list.

### Content

```
[overline]
Text: "PASUL URMĂTOR"
Color: Global "Accent Subtle" (#E4EDEB) — inverted for dark background
Typography: Global "Overline"
CSS class: text-overline

[H2]
Text: "Sunteți gata să solicitați o programare?"
Typography: Global "H2 — Section Headline" (Lora 700)
Color: Global "Surface" (#FDFBF7)
Alignment: Center
Max-width: 700px

[body]
Text: "Completați formularul de contact sau sunați la locația aleasă.
Vă răspundem în cel mult 24 de ore."
Typography: Global "Body" (Inter 400, 17px)
Color: Global "Surface" at 85% opacity (softens the text slightly)
Alignment: Center
Max-width: 600px

[single primary CTA]
Label: "Contactați-ne"
Link: /contact
Style: Inverted primary button —
  Background: color-surface (#FDFBF7)
  Text: color-ink (#231E1A)
  Padding: 15px/32px
  Border-radius: 6px
  Hover: background → color-surface-warm (#F4EFE6)

[NO secondary CTA on this page]
```

**Why no secondary CTA:** On other pages, the secondary CTA "Contactați-ne" → /contact exists as an alternative to "Programează o consultație" → /programari. On /programari itself, there is no alternative — the patient has already arrived at the location hub. The only logical next step is contact. A second button would only add noise.

### Elementor Implementation

1. Add full-width Flexbox Container, background Global Color "Ink"
2. Padding: 96px top/bottom (desktop), 48px (mobile)
3. Inner container: max-width 800px, centered, Flexbox Column, align items center, text-align center, gap 24px (space-6)
4. Overline: Text widget → "PASUL URMĂTOR" → CSS class `text-overline` → color: #E4EDEB (local color permitted on dark background)
5. H2: Heading widget → content per above → color: Global "Surface" → text-align center
6. Body text: Text Editor → content per above → Global "Body" → color: Global "Surface" → text-align center → CSS class `reading-column`
7. Button: "Contactați-ne" → link /contact → Background: Global "Surface" → Text: Global "Ink" → 6px radius → 15px/32px padding
8. Hover state: Background: #F4EFE6 (Global "Surface Warm")
9. **Do not add a second button.** This is the only interactive element in this section.
10. Custom ID: `organism-cta-banner-programari`
11. Accessibility: button focus ring must be visible against dark background. In `custom.css`, the `:focus-visible` rule uses `color-accent-subtle` outline — verify this is visible against `color-ink` background.

---

## Content Requirements — Complete Data Inventory

### Data Required Per Location Card

The table below documents all information needed for each `molecule-location-card` instance. Collect all fields marked **Required** before publishing a card. **Optional** fields can be added after launch.

| Field | Required / Optional | Placeholder if missing | Notes |
|---|---|---|---|
| Patient-facing clinic/hospital name | **Required** | Hide card | Not the legal entity name |
| Full street address | **Required** | Hide card | Street + number + city |
| City | **Required** | Known (Cluj-Napoca or Baia Mare) | Always explicit on card |
| Visit type | **Required** | Hide card | Consultații / Intervenții / Ambele |
| Days present | **Required** | Hide card | Specific days, not "by appointment" alone |
| Hours | **Required** | Hide card | Specific hours at this location |
| Phone number | **Required** | Hide card | Booking/contact number for this location |
| Booking method | **Required** | Hide card | Exact process: form / phone / clinic reception |
| Google Maps URL | Strongly recommended | Omit button if missing | Verify URL opens the correct address |
| Email for this location | Optional | Omit widget | Only if location-specific email exists |
| Patient notes | Optional | Omit widget | Entrance instructions, documents to bring |
| Parking | Optional | Omit widget | Only add when parking situation is confirmed |
| Accessibility | Optional | Omit widget | Wheelchair, lift, etc. — when confirmed |

### Current Location Assumptions

These assumptions are based on available information. **All must be confirmed with Dr. Ungureanu before any card is published.**

| Location | City | Type (assumed) | Status |
|---|---|---|---|
| [Clinic A — primary consultation] | Cluj-Napoca | Consultații | [CONFIRM CU DR. UNGUREANU] |
| [Clinic B or Hospital] | Cluj-Napoca | Consultații și intervenții | [CONFIRM CU DR. UNGUREANU] |
| [Hospital — surgical] | Cluj-Napoca | Intervenții chirurgicale | [CONFIRM CU DR. UNGUREANU] |
| [Clinic Baia Mare] | Baia Mare | Consultații | [CONFIRM CU DR. UNGUREANU] |

Do not invent or assume clinic names, addresses, schedules, or phone numbers. Every field in every card must be confirmed by Dr. Ungureanu before appearing on the published page.

---

## Launch States — Can the Page Go Live Before All Data Is Confirmed?

The `/programari` page can go live in one of three states. Choose the state based on how much confirmed data is available.

### State 1 — Full Launch (recommended)
**Condition:** All required fields for all location cards are confirmed.
**Action:** Publish all location cards with complete data. The page is fully functional.

### State 2 — Partial Launch (acceptable with conditions)
**Condition:** At least one complete card per confirmed city is available. Remaining locations are hidden (Option A from placeholder strategy).
**Requirement:** At minimum, one complete Cluj-Napoca card and one complete Baia Mare card must be published.
**Action:** Publish the confirmed cards. Hide incomplete cards. The closing note below the grid ("Nu ați găsit o locație convenabilă? Contactați-ne") covers the gap.
**Caveat:** Do not publish a partial launch if the visible cards do not represent the geographically most accessible locations for the patient population. If the only confirmed card is a surgery-only location and no consultation card is ready, wait.

### State 3 — Not Recommended (emergency only)
**Condition:** No location data is confirmed, but the page must exist because homepage CTAs already route here.
**Action:** Publish the hero + a single sentence: "Locațiile unde Dr. Ungureanu consultă și operează sunt în curs de confirmare. Contactați-ne pentru a afla detaliile." + CTA → /contact. Remove the location directory section entirely until data is available.
**Risk:** A patient who clicks "Programează o consultație" and finds no location information will lose trust. Prefer keeping the homepage CTAs pointing to /contact temporarily over publishing an empty /programari.

> **Recommendation:** Do not launch the homepage until State 1 or State 2 is achievable for /programari. The two pages are functionally linked — the homepage CTA sends patients to /programari, and an empty /programari breaks the patient journey.

---

## Mobile Behavior

### Section 1 — Hero
- Content single column, full-width
- Breadcrumb remains visible
- H1: 36px mobile (Global Typography mobile setting)
- Lead text: 18px mobile
- Padding: 40px top/bottom

### Section 2 — Location Directory
- Location cards: 1-column grid (full-width)
- City group headers remain visible above card stack
- Between city groups: divider + 32px spacing
- Closing note: centered, full-width text block
- Section padding: 40px top/bottom

### Section 3 — How It Works
- Steps maintain their layout (number circle left, content right)
- Gap between steps: 24px (space-6)
- Section padding: 32px top/bottom
- Max-width is not constrained on mobile — full-width column

### Section 4 — CTA Banner
- Button: full-width on mobile
- Text: centered
- Padding: 48px top/bottom

### Location Card Mobile Specifics
- Card is full-width (fills the 1-column grid)
- Padding: 24px (space-6) on mobile vs 32px desktop
- The optional fields (parking, accessibility, patient notes) stack vertically below required fields
- Maps button: full-width on mobile
- Icon sizes: 16px (molecule-meta icons), maintained at mobile

---

## Accessibility Checklist

### Page-Level
```
[ ] One H1 on the page — "Unde îl puteți găsi pe Dr. George Ungureanu"
[ ] H2 for major sections: "Clinici și spitale unde consultăm", "Pașii următori după ce alegeți locația", "Sunteți gata să solicitați o programare?"
[ ] H3 for city group headers: "Locații în Cluj-Napoca", "Locație în Baia Mare"
[ ] H4 for location names within each card
[ ] No heading levels skipped (H1 → H2 → H3 → H4 in sequence)
[ ] #main-content ID set on the hero section (skip-to-content target from header)
[ ] Breadcrumb has aria-label="Breadcrumb" on the <nav> element
[ ] Breadcrumb current page item has aria-current="page"
```

### Location Directory
```
[ ] Location card grid container has role="list"
[ ] Each card wrapper has role="listitem"
[ ] City group H3 headings structure the page for screen reader navigation
[ ] Each card's Google Maps button has aria-label="Direcții pentru [Location Name] în Google Maps"
[ ] Maps button opens in new tab — indicated by external link icon (aria-hidden="true") and aria-label mentions "în Google Maps"
[ ] Phone number links use tel: links — <a href="tel:+40...">
[ ] Email links use mailto: links — <a href="mailto:...">
[ ] All optional molecule-meta icons are aria-hidden="true"
[ ] Card is not itself a link — only the Maps button and phone/email links are interactive
[ ] Visit type badge is text, not icon-only — readable without visual processing
```

### How It Works Section
```
[ ] Step number circles are aria-hidden="true" (decorative — H4 carries the semantic label)
[ ] No keyboard traps in the step sequence
```

### CTA Banner
```
[ ] "Contactați-ne" button has descriptive text — not "Click here"
[ ] Button focus ring is visible on dark background — verify color-accent-subtle outline renders correctly against color-ink
[ ] No second button competing with the primary CTA
```

### Motion and Animation
```
[ ] No entrance animations on any section
[ ] No parallax or scroll-triggered effects
[ ] Location cards: hover state (border + shadow) uses CSS transitions ≤ 200ms — acceptable and not suppressed by prefers-reduced-motion (hover is user-triggered)
[ ] Verify prefers-reduced-motion: Chrome DevTools → Rendering → Emulate: prefers-reduced-motion → all transitions suppressed
```

---

## Performance Considerations

**Page weight target:** ≤ 1.5MB (this page has no images beyond the possible header logo — primarily text and CSS)

**Location cards:**
- No images inside location cards — text, icons, and meta information only
- SVG icons (molecule-meta) should be inline SVG, not image files (faster, no additional HTTP request)
- Maps link opens an external URL — no map embed (iframes add significant weight and loading complexity)

**Grid layout:**
- The location card grid uses CSS Grid — no JavaScript required for the layout
- Cards render in full on initial load — no lazy expansion, no "show more" pagination (the full list should be scannable without interaction)

**City group dividers:**
- `atom-divider` elements are pure CSS — zero weight impact

**Maps URLs:**
- Each Google Maps link is a plain `<a>` element — no Google Maps JavaScript API loaded
- Verify that Maps URLs do not include unnecessary query parameters that reveal IP or tracking data

**Lighthouse targets for /programari:**
```
[ ] Performance: 90+ (mobile)
[ ] Accessibility: 90+
[ ] LCP: ≤ 2.5s (no hero image — LCP is likely the H1 text, which loads instantly)
[ ] CLS: ≤ 0.1 (no images to shift layout; stable grid)
[ ] Total page weight: ≤ 1.5MB
```

---

## Elementor Implementation — Full Build Sequence

**Before starting:** Confirm that global organisms (header + footer) are live. Confirm the `#main-content` ID convention is being used.

### Step 1 — Create the WordPress Page

1. WordPress admin → Pages → Add New
2. Title: "Programări"
3. Slug: `programari` (verify the permalink reads `/programari/`)
4. Do not use the WordPress block editor — click "Edit with Elementor"
5. Set page template: Elementor Full Width (no WordPress theme wrapping)

### Step 2 — Build Section 1 — Hero

6. Insert `organism-hero-interior` from Template Library
7. CSS ID on the section: `main-content` (Advanced → CSS ID)
8. Edit content per Section 1 spec above
9. Confirm background: Global Color "Surface Warm"

### Step 3 — Build Section 2 — Location Directory

10. Add full-width Flexbox Container → CSS ID: `organism-location-directory`
11. Background: Global Color "Surface"
12. Padding: 80px desktop, 40px mobile
13. Inner container: max-width 1200px, column, gap 48px
14. Add `molecule-section-header` → edit content per spec
15. Build Cluj-Napoca group: overline + H3 + 2-column grid + location card templates
16. Add location card templates — one per confirmed location. Edit all required fields. Add/remove optional fields based on confirmed data. Set all Maps button aria-labels. Set Maps button target="_blank" rel="noopener".
17. Add full-width divider (`atom-divider`)
18. Build Baia Mare group: overline + H3 + location card template(s)
19. Add closing note container: max-width 600px, centered, text + ghost button

### Step 4 — Build Section 3 — How It Works

20. Add full-width Flexbox Container → CSS ID: `organism-how-it-works-programari`
21. Background: Global Color "Surface Warm"
22. Padding: 64px desktop, 32px mobile
23. Inner container: max-width 760px, centered, column, gap 32px
24. Add `molecule-section-header` → edit overline "CE URMEAZĂ", H2 per spec
25. Add short lead text widget → Body Small → Ink Secondary
26. Add 4 `molecule-process-step` templates → edit content per spec (Step 1 text is /programari-adapted)

### Step 5 — Build Section 4 — CTA Banner

27. Add full-width Flexbox Container → CSS ID: `organism-cta-banner-programari`
28. Background: Global Color "Ink"
29. Padding: 96px desktop, 48px mobile
30. Inner container: max-width 800px, centered, column, align center, gap 24px
31. Add overline, H2, body text per spec → all colored Global "Surface"
32. Add **one** Button widget → "Contactați-ne" → /contact → inverted primary style
33. Verify: no second button is added

### Step 6 — Final Setup

34. Preview the full page at desktop, tablet (768px), and mobile (375px)
35. Apply the Accessibility Checklist above
36. Apply the QA Master Checklist from `docs/implementation/03_ELEMENTOR_QA_RULES.md`
37. Verify all CTA links: Maps buttons, phone links, email links, "Contactați-ne" → /contact
38. Verify background alternation: warm → surface → warm → ink ✓
39. Run Lighthouse audit (mobile, incognito)
40. Publish

---

## Launch Checklist

### Must Be True Before Publishing

```
[ ] Page is in Launch State 1 or State 2 (at least one complete location card per city)
[ ] All published location cards have all required fields populated with confirmed data
[ ] No card shows placeholder "[CONFIRM CU DR. UNGUREANU]" text in required fields
[ ] Incomplete location cards are hidden (display: none) via Elementor responsive settings
[ ] Every published card's Google Maps link is verified to open the correct address
[ ] Every published card's phone number is a working tel: link
[ ] The "Contactați-ne →" CTA at the bottom of Section 2 links to /contact ✓
[ ] The CTA banner primary button links to /contact ✓
[ ] The CTA banner has only ONE button (no secondary) ✓
[ ] /contact page is live (the CTA banner and closing note both link there)
[ ] The page H1 is unique — no other H1 on the page
[ ] The breadcrumb shows: Acasă → Programări with correct links
[ ] The breadcrumb "Programări" item has aria-current="page"
[ ] #main-content ID is set on the hero section
[ ] Page title in WordPress: "Programări"
[ ] Slug: /programari/ (no typos)
[ ] Page is added to the "Navigare principală" WordPress menu at position 3
[ ] Lighthouse accessibility ≥ 90
[ ] Page loads under 2.5s on mobile (Lighthouse mobile simulation)
[ ] No horizontal scroll at 375px
```

### Must Be True Before Routing All Site CTAs Here

```
[ ] At minimum, State 2 is achieved (one complete card per city)
[ ] The page has been reviewed by Dr. Ungureanu and all published location data is approved
[ ] All telephone numbers have been tested (dial the tel: link on a mobile device)
[ ] All Maps links have been tested (tap on mobile — opens correct Maps pin)
[ ] The page has been tested on iOS Safari and Android Chrome (in addition to desktop browsers)
```

---

## Open Questions for Dr. Ungureanu

The following questions must be answered before any location card can be published. Questions are grouped by blocking impact.

### Group A — Blocking for Every Location Card

For each location, provide:

1. **Patient-facing name of the clinic or hospital.** Not the legal entity name — the name patients use. Example: "Clinica [Name]" or "Spitalul Județean [City]".

2. **Full street address.** Street name + number + city + postal code. This is used for the card and for the Google Maps link.

3. **Visit type.** For this specific location, does Dr. Ungureanu:
   - Only see patients for consultations?
   - Only perform surgical procedures?
   - Do both consultations and surgery?

4. **Days present.** Which days of the week is Dr. Ungureanu at this location? (e.g., "Luni și Miercuri", "Luni, Miercuri, Vineri")

5. **Hours.** What are the consultation/activity hours at this specific location? (e.g., "10:00 – 18:00"). Note: these are Dr. Ungureanu's specific hours, not the clinic's general opening hours.

6. **Phone number for this location.** Which number should a patient call to book an appointment at this location? Is it a direct line, the clinic's reception, or the same number across all locations?

7. **Booking method.** How does a patient book an appointment at this location?
   - Through the website contact form (/contact)?
   - By calling the phone number on the card?
   - By calling the clinic's own reception?
   - Some other process?
   This must be specific per location — different locations may have different booking processes.

### Group B — Strongly Recommended (for complete cards)

8. **Google Maps URL.** For each address, confirm the Google Maps URL that opens the correct pin. The URL can be obtained by: searching the address in Google Maps → clicking "Share" → copying the link. This prevents the card from directing patients to the wrong building.

9. **Patient notes.** Is there anything patients should know before arriving at this location?
   - What documents to bring (RMN, CT, referral letter, ID, etc.)
   - Entrance instructions ("access through the main entrance, mention Dr. Ungureanu's name")
   - Any location-specific requirements

10. **Parking.** Is parking available near each location? Free or paid? In the clinic courtyard or on the street?

11. **Accessibility.** For each location: is there wheelchair access? A lift? Ground-floor access? Parking spaces for people with disabilities?

### Group C — Optional (can be added post-launch)

12. **Email address per location.** Is there a location-specific email address for booking, or does all email contact go through the same address?

13. **Number of Cluj-Napoca locations.** The current assumption is 2–3 locations in Cluj-Napoca. How many locations should appear on the page? This affects the grid layout and city group structure.

14. **Frequency of Baia Mare consultations.** Is the Baia Mare location a weekly/bi-weekly presence, or is it periodic/by-arrangement? This affects how the schedule is described on the card.

---

## Summary

### Final Page Structure

The `/programari` page has 4 sections in the following order:

1. **Hero** — Left-aligned, breadcrumb + overline + H1 ("Unde îl puteți găsi pe Dr. George Ungureanu") + lead text. `color-surface-warm`.

2. **Location directory** — The page's primary content. Section header → city group headers (Cluj-Napoca + Baia Mare) → grid of `molecule-location-card` instances → closing note + link to /contact. `color-surface`.

3. **How It Works** (shortened, contextual) — Same 4 confirmed steps. Step 1 body text adapted for the page context. Compact padding. `color-surface-warm`.

4. **CTA banner** — Single CTA only: "Contactați-ne" → /contact. No secondary CTA. `color-ink`. This prevents the /programari → /programari routing loop.

Background alternation: warm → surface → warm → ink ✓

### Required Information from Dr. Ungureanu

**Group A — Blocking (per location, cannot publish any card without these):**
- Patient-facing clinic/hospital name
- Full street address
- Visit type (consultations / surgery / both)
- Days present
- Hours
- Phone number
- Booking method (exact process)

**Group B — Strongly recommended:**
- Google Maps URL per address
- Patient notes
- Parking information
- Accessibility details

**Group C — Optional, post-launch:**
- Location-specific email address
- Confirmation of total number of Cluj-Napoca locations
- Baia Mare schedule frequency

### Which Parts Can Be Implemented With Placeholders

| Component | Can use placeholders? | Notes |
|---|---|---|
| organism-hero-interior | Yes — fully specced | Hero text confirmed in this document |
| organism-location-directory (structure) | Yes | Grid structure, city headers, closing note — all ready |
| molecule-location-card (individual cards) | Partial — see Launch States | Cards with confirmed data: publish. Cards with missing required fields: hide. |
| organism-how-it-works | Yes — fully specced | Steps confirmed from Prompt 04 |
| organism-cta-banner | Yes — fully specced | Links to /contact, no secondary CTA |

### Can the Page Go Live Before All Clinic Data Is Finalized?

**Yes — under specific conditions (Launch State 2):**
- At least one complete, confirmed location card must exist for each city (minimum: one Cluj-Napoca card, one Baia Mare card)
- Incomplete cards must be hidden — not published with placeholder text
- The closing note ("Nu ați găsit o locație convenabilă? Contactați-ne →") covers the gap for patients who don't find a convenient location

**The page structure, hero, how-it-works section, and CTA banner can all be built now** — they contain no location-specific data. Only the individual `molecule-location-card` instances require confirmed data from Dr. Ungureanu.

**Not recommended:** Launching the homepage before /programari is in State 1 or State 2. The homepage's primary CTA routes here — an incomplete /programari page breaks the most important patient journey on the site.
