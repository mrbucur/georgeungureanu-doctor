# Implementation Guide 05: /programari Page

## georgeungureanu.doctor — Appointment Hub Build Reference

**Page URL:** `/programari`
**WordPress title:** "Programări"
**Navigation label:** "Programări" (position 3 in the 6-item primary navigation)
**SEO title:** "Programări — Dr. George Ungureanu, Neurochirurg"
**SEO description:** "Găsiți clinica sau spitalul unde Dr. Ungureanu consultă sau operează. Locații în Cluj-Napoca și Baia Mare. Solicitați o programare prin formularul de contact."

**Governing sources:**
- `docs/project/WEBSITE_GOALS.md` §CTA Routing Decision
- `docs/components/02_MOLECULES.md` §molecule-location-card
- `docs/components/03_ORGANISMS.md` §organism-location-directory
- `docs/implementation/03_ELEMENTOR_QA_RULES.md`
- `docs/implementation/04_THEME_BUILDER_GLOBALS.md`

**Required before starting:**
- Guides 01–04 complete: design system, component library, homepage, QA rules, header/footer
- `organism-site-header` and `organism-site-footer` live via Theme Builder
- WordPress page "Programări" created with slug `programari`
- `/contact` page live (every CTA on this page routes there)

**What this guide does not do:** Generate Elementor JSON. All sections are built by hand in Elementor following the instructions below.

---

## Why This Page Exists

Every primary CTA on the site sends the patient here. The patient must be able to answer four questions before they will commit to an appointment:

1. **Where?** — Which city, which clinic or hospital.
2. **Is it accessible?** — Can I get there, is there parking, is it accessible?
3. **When?** — Days and hours at this specific location.
4. **How?** — The exact next step to book.

A patient who cannot answer all four will close the tab. This page eliminates that outcome.

**The page does not book appointments.** It answers the four questions and routes the patient to `/contact`.

```
Any page → "Programează o consultație" → /programari → "Contactați-ne" → /contact
```

No CTA on this page routes back to `/programari`. That would create a loop with no exit.

---

## Page Architecture

| # | Section | Organism | Background | Notes |
|---|---------|----------|-----------|-------|
| 1 | Hero | `organism-hero-interior` | `color-surface-warm` | H1 + breadcrumb + lead |
| 2 | Location directory | `organism-location-directory` | `color-surface` | Primary content |
| 3 | How it works | `organism-how-it-works` (contextual variant) | `color-surface-warm` | Shortened — /programari-adapted |
| 4 | CTA banner | `organism-cta-banner` (/programari variant) | `color-ink` | Single CTA → /contact only |

**Background alternation:** warm → surface → warm → ink. No two adjacent sections share a background. ✓

Global organisms (`organism-site-header`, `organism-site-footer`) are applied via Theme Builder — they are not built on this page.

---

## Section 1 — Hero (`organism-hero-interior`)

**Background:** `color-surface-warm` (#F4EFE6)
**Padding:** 80px top/bottom desktop · 40px mobile
**CSS ID on section:** `main-content` (skip-to-content target from header)

### Content

```
[molecule-breadcrumb]
Text:  "Acasă → Programări"
Links: "Acasă" → /    |    "Programări" (current, aria-current="page")
Typography: Global "Caption" (Inter 400, 13px)
Color: Global "Ink Secondary" · "Accent" separator
nav element: aria-label="Breadcrumb"

[overline]
Text: "PROGRAMĂRI"
Typography: Global "Overline" (Inter 500, 12px, uppercase, 2px letter-spacing)
Color: Global "Accent"
CSS class: text-overline

[H1]
Text: "Unde îl puteți găsi pe Dr. George Ungureanu"
Typography: Global "H1 — Page Title" (Lora 700, 52px desktop / 36px mobile)
Color: Global "Ink"
Alignment: Left-aligned (interior heroes are never centered)
Note: This is the only H1 on the page.

[lead text — atom-body-lg]
Text: "Dr. Ungureanu consultă și desfășoară activitate chirurgicală în mai
multe centre medicale din Cluj-Napoca și Baia Mare. Găsiți mai jos locația
care vă este cel mai convenabilă și contactați-ne pentru a stabili data
consultației."
Typography: Global "Body Large" (Inter 400, 20px)
Color: Global "Ink"
CSS class: reading-column (max-width 700px)
```

**Content column max-width:** 800px (organism-hero-interior standard).

### Elementor Steps

1. Insert `organism-hero-interior` from Template Library.
2. Advanced → CSS ID: `main-content` (skip-to-content target).
3. Edit breadcrumb widget: links → `/` and current label "Programări".
4. Edit overline widget: "PROGRAMĂRI" · CSS class `text-overline`.
5. Edit H1: content per above.
6. Edit lead text: content per above · CSS class `reading-column`.
7. Section background: Global Color "Surface Warm".
8. Padding: 80px desktop / 40px mobile.

---

## Section 2 — Location Directory (`organism-location-directory`)

**Background:** `color-surface` (#FDFBF7)
**Padding:** 80px top/bottom desktop · 40px mobile
**CSS ID:** `organism-location-directory`

This is the primary content of the page. Everything else exists to support this section.

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
CSS class: reading-column
```

### City Group Structure

Locations are grouped by city. Each city group uses a consistent header pattern.

**Cluj-Napoca (primary — multiple locations):**

```
atom-overline: "CLUJ-NAPOCA"
  Color: Global "Ink Secondary"
  Typography: Global "Overline"
  Margin-top: 48px (space-12) above the group
  Margin-bottom: 24px (space-6) before the first card

atom-h3: "Locații în Cluj-Napoca"
  Typography: Global "H3 — Subsection Headline" (Lora 600, 26px)
  Color: Global "Ink"
  Margin-bottom: 8px
```

**Baia Mare (secondary — one location assumed):**

```
atom-overline: "BAIA MARE"
atom-h3: "Locație în Baia Mare"
```

If a third city is added later, it follows the same pattern with an `atom-divider` + `space-12` margin before the new group.

### Location Card Grid

| Setting | Desktop | Tablet | Mobile |
|---------|---------|--------|--------|
| Columns | 2 | 2 | 1 |
| Gap | 24px | 16px | 16px |

Grid container: `role="list"`. Each card wrapper: `role="listitem"`.

**Card ordering within a city group:**
1. Consultation-only (first visit most likely)
2. Consultation + surgery
3. Surgery-only

### `molecule-location-card` — Field Specification

#### Visual Structure

```
Card container (padding: 32px desktop · 24px mobile)
├── Visit type badge
│   Label: "Consultații" / "Intervenții chirurgicale" / "Consultații și intervenții"
│   Style: Inter 500 12px · color-accent text · color-accent-subtle bg · 4px/12px padding · 20px border-radius
│
├── H4: Patient-facing clinic or hospital name
│   Typography: Global "H4 — Card Headline" (Inter 600, 18px)
│   Color: Global "Ink"
│   Margin-top: 16px
│
├── atom-body-sm: Full address (street + number, then city on second line)
│   Typography: Global "Body Small" (Inter 400, 14px)
│   Color: Global "Ink"
│
├── atom-divider (1px, color-border, 8px margin top/bottom)
│
├── Schedule block [REQUIRED]
│   molecule-meta: calendar icon + days (e.g. "Luni, Miercuri, Vineri")
│   molecule-meta: clock icon + hours (e.g. "10:00 – 18:00")
│   Typography: Global "Body Small"
│
├── Contact block [REQUIRED]
│   molecule-meta: phone icon + number → tel: link
│   molecule-meta: email icon + address → mailto: link  [OPTIONAL — show only if confirmed]
│
├── Booking method note [REQUIRED]
│   atom-body-sm: "Programare: [exact method]"
│   Color: Global "Ink Secondary"
│   Examples:
│     "Programare prin formularul de contact de pe site"
│     "Programare telefonic la numărul de mai sus"
│     "Programare prin recepția clinicii: [number]"
│
├── Optional fields [SHOW ONLY WHEN DATA IS CONFIRMED]
│   molecule-meta: info icon + patient notes
│   molecule-meta: car icon + parking
│   molecule-meta: accessibility icon + accessibility info
│
└── Card footer (border-top 1px color-border · padding-top 16px)
    atom-button-ghost: "Cum ajungeți →"
      aria-label: "Direcții pentru [Location Name] în Google Maps"
      Link: confirmed Google Maps URL
      target="_blank" rel="noopener"
      External link icon: aria-hidden="true"
```

#### Required Fields (card cannot be published without all of these)

| Field | Placeholder if missing |
|-------|----------------------|
| Patient-facing name | Hide card |
| Full street address | Hide card |
| City | Known (Cluj-Napoca or Baia Mare) |
| Visit type | Hide card |
| Days present | Hide card |
| Hours | Hide card |
| Phone number | Hide card |
| Booking method | Hide card |

#### Optional Fields (omit widget entirely if data is not confirmed)

| Field | When to show |
|-------|-------------|
| Email | Only if location-specific email exists |
| Google Maps URL | Once address is confirmed — strongly recommended |
| Patient notes | When location has specific requirements |
| Parking | When situation is known |
| Accessibility | When features are confirmed |

#### Unconfirmed Cards — Placeholder Strategy

**Option A — Hidden card (recommended):** Elementor → Advanced → Responsive → Hide on all devices. Unhide when data is confirmed.

**Option B — Coming soon card (only if the location exists but details are pending):**

```
Visit type badge: [pending confirmation]
H4: "[CONFIRM CU DR. UNGUREANU — Denumirea clinicii]"
atom-body-sm: "Cluj-Napoca" (or confirmed city)
atom-divider
atom-body-sm (color-ink-secondary, italic):
  "Detaliile acestei locații sunt în curs de confirmare.
   Contactați-ne pentru informații."
atom-button-ghost: "Contactați-ne →" → /contact
```

Option B is not recommended for launch. A card that says "details coming soon" undermines patient trust. Prefer Option A.

#### Elementor Steps — Location Card

1. Insert `molecule-location-card` from Template Library.
2. Replace all placeholder text — every required field must be populated before the card is visible.
3. Add optional widgets (email, patient notes, parking, accessibility) only if data is confirmed. Remove the widget entirely if not.
4. Set Google Maps button link → confirmed URL. Set `aria-label` via Custom Attributes. Set `target="_blank"` and `rel="noopener"`.
5. Set Custom ID: `molecule-location-card-[location-slug]` (e.g., `molecule-location-card-cluj-clinica-name`).
6. For hidden cards: Advanced → Responsive → Hide on all devices.

### Closing Note and Contact Link

Below all location cards, outside the grid:

```
atom-body-sm (centered, color-ink-secondary):
  "Nu ați găsit o locație convenabilă? Suntem disponibili și pentru alte
   aranjamente. Contactați-ne și găsim împreună cea mai bună variantă pentru dvs."

atom-button-ghost (centered):
  "Contactați-ne →" → /contact
  Margin-top: 40px (space-10)
```

### Elementor Steps — Location Directory Section

1. Add full-width Flexbox Container → CSS ID `organism-location-directory` · background Global Color "Surface".
2. Padding: 80px desktop · 40px mobile.
3. Inner container: max-width 1200px · Flexbox Column · gap 48px.
4. Insert `molecule-section-header` → edit overline, H2, lead text per spec.
5. **Cluj-Napoca group:** Flexbox Column container → Text widget "CLUJ-NAPOCA" (CSS class `text-overline`, Global "Ink Secondary") → H3 Heading "Locații în Cluj-Napoca" → Grid Container (2 col, 24px gap, `role="list"`) → insert location card templates.
6. **City divider:** `atom-divider` (full-width, color-border) with 48px margin top/bottom.
7. **Baia Mare group:** Same structure. H3: "Locație în Baia Mare". 1-column grid unless 2+ locations confirmed.
8. **Closing note:** Flexbox Container centered (max-width 600px) → Text widget → ghost button → /contact.

---

## Section 3 — How It Works (Contextual Variant)

**Background:** `color-surface-warm` (#F4EFE6)
**Padding:** 64px top/bottom desktop · 32px mobile (reduced — reads as transitional, not emphatic)
**Max-width:** 760px (narrower than standard 800px)
**CSS ID:** `organism-how-it-works-programari`

On the /programari page the patient has just reviewed the location directory. Step 1 acknowledges this — its body text references what the patient just did.

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

[lead text — Body Small, kept very short]
Text: "Programul de mai jos se aplică indiferent de locația aleasă."
Typography: Global "Body Small"
Color: Global "Ink Secondary"

[Step 1 — molecule-process-step]
Number: 1
H4: "Alegeți locația potrivită"
Body-sm: "Ați găsit locația convenabilă în lista de mai sus.
          Dacă nu ați găsit-o, contactați-ne — găsim împreună soluția potrivită."
Note: Body-sm adapted to reference Section 2 — not generic.

[Step 2 — molecule-process-step]
Number: 2
H4: "Solicitați programarea"
Body-sm: "Completați formularul de contact sau sunați direct la locația aleasă.
          Vă confirmăm programarea în maximum 24 de ore."

[Step 3 — molecule-process-step]
Number: 3
H4: "Prima consultație"
Body-sm: "Consultația inițială durează aproximativ 45–60 de minute.
          Dr. Ungureanu ascultă, explică și răspunde la toate întrebările dvs., fără grabă."

[Step 4 — molecule-process-step]
Number: 4
H4: "Stabilim împreună planul terapeutic"
Body-sm: "Primiți o explicație clară a tuturor opțiunilor disponibile.
          Decizia finală vă aparține — niciodată nu vi se impune un traseu terapeutic."
```

**What makes this the "shortened" variant:**
- Reduced padding (64px vs. 80px)
- Narrower column (760px vs. 800px)
- Lead text uses Body Small, not Body
- Step 1 body text is adapted — no redundancy with Section 2
- No connector line between step circles (compact spacing makes it unnecessary)

### Elementor Steps

1. Add full-width Flexbox Container → CSS ID `organism-how-it-works-programari` · background Global Color "Surface Warm".
2. Padding: 64px desktop · 32px mobile.
3. Inner container: max-width 760px · centered · Flexbox Column · gap 32px.
4. Insert `molecule-section-header` → overline "CE URMEAZĂ" · H2 per spec.
5. Add Text widget → lead text per spec → Global "Body Small" → Global "Ink Secondary".
6. Insert 4 `molecule-process-step` templates → edit content per spec. Step 1 body text must be /programari-adapted (not the generic homepage version).
7. No connector line between steps.

---

## Section 4 — CTA Banner (`organism-cta-banner` — /programari variant)

**Background:** `color-ink` (#231E1A)
**Padding:** 96px top/bottom desktop · 48px mobile
**Text color:** `color-surface` (#FDFBF7)
**CSS ID:** `organism-cta-banner-programari`

**Critical difference from the standard CTA banner:**

> On the /programari page, the primary CTA links to /contact — not back to /programari.
> There is **no secondary CTA**. One action only: "Contactați-ne" → /contact.

The patient has found their location (or needs help finding one). Either way, the next step is contact — not returning to the location list.

### Content

```
[overline]
Text: "PASUL URMĂTOR"
Color: #E4EDEB (Global "Accent Subtle" — inverted for dark background)
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
Color: Global "Surface" at 85% opacity
Alignment: Center
CSS class: reading-column

[single primary CTA — inverted style]
Label: "Contactați-ne"
Link: /contact
Background: color-surface (#FDFBF7)
Text: color-ink (#231E1A)
Padding: 15px/32px · border-radius: 6px
Hover: background → color-surface-warm (#F4EFE6)

[NO secondary CTA]
```

### Elementor Steps

1. Add full-width Flexbox Container → CSS ID `organism-cta-banner-programari` · background Global Color "Ink".
2. Padding: 96px desktop · 48px mobile.
3. Inner container: max-width 800px · centered · Flexbox Column · align items center · text-align center · gap 24px.
4. Overline: Text widget → "PASUL URMĂTOR" · CSS class `text-overline` · color `#E4EDEB` (local color — permitted on dark background).
5. H2: Heading → content per spec · color Global "Surface" · text-align center.
6. Body: Text Editor → content per spec · Global "Body" · color Global "Surface" · text-align center · CSS class `reading-column`.
7. Button: "Contactați-ne" → /contact · Background Global "Surface" · Text Global "Ink" · 6px radius · 15px/32px padding.
8. Hover state: background `#F4EFE6` (Global "Surface Warm").
9. **Do not add a second button.** This is the only interactive element in this section.
10. Accessibility: verify the `:focus-visible` rule in `custom.css` renders a visible ring against `color-ink` background.

---

## Content Requirements — Location Data Inventory

Collect all Required fields before publishing any card. Optional fields can be added after launch.

| Field | Required / Optional | If missing |
|-------|--------------------|-----------:|
| Patient-facing name | **Required** | Hide card |
| Full street address | **Required** | Hide card |
| City | **Required** | Known |
| Visit type | **Required** | Hide card |
| Days present | **Required** | Hide card |
| Hours | **Required** | Hide card |
| Phone number | **Required** | Hide card |
| Booking method | **Required** | Hide card |
| Google Maps URL | Strongly recommended | Omit button |
| Email (location-specific) | Optional | Omit widget |
| Patient notes | Optional | Omit widget |
| Parking | Optional | Omit widget |
| Accessibility | Optional | Omit widget |

### Current Location Assumptions

All must be confirmed with Dr. Ungureanu before any card is published.

| Location | City | Assumed type | Status |
|----------|------|-------------|--------|
| [Clinic A — primary consultation] | Cluj-Napoca | Consultații | **CONFIRM CU DR. UNGUREANU** |
| [Clinic B or Hospital] | Cluj-Napoca | Consultații și intervenții | **CONFIRM CU DR. UNGUREANU** |
| [Hospital — surgical] | Cluj-Napoca | Intervenții chirurgicale | **CONFIRM CU DR. UNGUREANU** |
| [Clinic Baia Mare] | Baia Mare | Consultații | **CONFIRM CU DR. UNGUREANU** |

Do not invent clinic names, addresses, schedules, or phone numbers.

---

## Launch States

### State 1 — Full Launch (recommended)

All required fields for all location cards are confirmed and published.

### State 2 — Partial Launch (acceptable with conditions)

At least one complete card per city exists. Remaining cards are hidden (Option A). The closing note ("Nu ați găsit o locație convenabilă? Contactați-ne") covers the gap.

Do not use State 2 if the only published card is a surgery-only location and no consultation card is ready. A patient seeking a first consultation must find one.

### State 3 — Not Recommended (emergency only)

No location data confirmed but the page must exist. Publish hero + single sentence: "Locațiile unde Dr. Ungureanu consultă și operează sunt în curs de confirmare. Contactați-ne pentru a afla detaliile." + CTA → /contact. Remove the location directory entirely.

**Risk:** A patient who clicks the homepage CTA and finds no location information loses trust. If State 1 or State 2 is not achievable, keep the homepage CTA pointing to /contact temporarily instead of launching an empty /programari.

---

## Mobile Behavior

| Section | Mobile specification |
|---------|---------------------|
| Hero | Single column · H1: 36px · lead: 18px · padding: 40px |
| Location directory | 1-column card grid · city group headers remain visible · divider + 32px between cities · padding: 40px |
| How it works | Steps maintain number-circle-left layout · gap: 24px between steps · padding: 32px |
| CTA banner | Button full-width · text centered · padding: 48px |

**Location card mobile specifics:**
- Full-width (fills 1-column grid)
- Padding: 24px (vs. 32px desktop)
- Optional fields stack vertically below required fields
- Maps button: full-width
- Molecule-meta icons: 16px, maintained

---

## Accessibility Checklist

### Page-Level

```
[ ] One H1: "Unde îl puteți găsi pe Dr. George Ungureanu"
[ ] H2 for major sections: location directory · how it works · CTA banner
[ ] H3 for city group headers: "Locații în Cluj-Napoca" · "Locație în Baia Mare"
[ ] H4 for each location card name
[ ] No heading levels skipped (H1 → H2 → H3 → H4 in sequence)
[ ] #main-content ID on hero section
[ ] Breadcrumb <nav> has aria-label="Breadcrumb"
[ ] Breadcrumb current page item has aria-current="page"
```

### Location Directory

```
[ ] Card grid container has role="list"
[ ] Each card wrapper has role="listitem"
[ ] City H3 headings enable screen reader navigation
[ ] Each Maps button has aria-label="Direcții pentru [Location Name] în Google Maps"
[ ] Maps button opens in new tab — external icon present (aria-hidden="true")
[ ] Phone links: <a href="tel:+40...">
[ ] Email links: <a href="mailto:...">
[ ] All molecule-meta icons are aria-hidden="true"
[ ] Card is not itself a link — only Maps button and phone/email are interactive
[ ] Visit type badge is text, not icon-only
```

### How It Works

```
[ ] Step number circles are aria-hidden="true" (H4 carries semantic label)
[ ] No keyboard traps in step sequence
```

### CTA Banner

```
[ ] Button label is descriptive — "Contactați-ne", not "Click here"
[ ] Button focus ring visible on color-ink background (verify color-accent-subtle outline)
[ ] No second button competing with primary CTA
```

### Motion

```
[ ] No entrance animations on any section
[ ] No parallax or scroll-triggered effects
[ ] Card hover state (border + shadow) uses CSS transition ≤ 200ms — acceptable
[ ] Verify prefers-reduced-motion: Chrome DevTools → Rendering → Emulate → all transitions suppressed
```

---

## Performance Targets

**Page weight target:** ≤ 1.5MB (no hero image — primarily text and CSS)

| Item | Specification |
|------|--------------|
| Location card images | None — text, icons, meta only |
| Molecule-meta icons | Inline SVG (no additional HTTP requests) |
| Maps integration | Plain `<a>` links only — no Google Maps JS API |
| Grid layout | Pure CSS Grid — no JavaScript |
| Cards on initial load | All visible — no "show more" pagination |

**Lighthouse targets:**

```
[ ] Performance (mobile): 90+
[ ] Accessibility: 90+
[ ] LCP: ≤ 2.5s (no hero image — H1 text is likely LCP element)
[ ] CLS: ≤ 0.1 (no layout-shifting images)
[ ] Total page weight: ≤ 1.5MB
```

---

## Full Build Sequence

**Before starting:** Confirm global organisms (header + footer) are live. Confirm `/contact` page exists.

### Step 1 — Create the WordPress Page

1. WordPress admin → Pages → Add New.
2. Title: "Programări" · Slug: `programari` (verify permalink reads `/programari/`).
3. Page template: Elementor Full Width.
4. Do not use the block editor — Edit with Elementor.

### Step 2 — Build Section 1 (Hero)

5. Insert `organism-hero-interior` from Template Library.
6. Advanced → CSS ID: `main-content`.
7. Edit all content per §Section 1.
8. Background: Global Color "Surface Warm" · Padding: 80px desktop / 40px mobile.

### Step 3 — Build Section 2 (Location Directory)

9. Add full-width Flexbox Container → CSS ID `organism-location-directory` · background Global Color "Surface" · padding 80px/40px.
10. Inner container: max-width 1200px · column · gap 48px.
11. Insert `molecule-section-header` → edit overline, H2, lead text.
12. **Cluj-Napoca group:** Flexbox Column → city overline → H3 → Grid Container (2 col, 24px gap, `role="list"`) → location card templates.
13. Set all required fields on each card. Add confirmed optional fields. Set Maps button aria-label, target, rel. Set card CSS IDs.
14. Hide any card lacking required data (Advanced → Responsive → Hide on all devices).
15. Add `atom-divider` between cities.
16. **Baia Mare group:** Same structure. H3: "Locație în Baia Mare". 1-column grid.
17. Add closing note container (centered, max-width 600px) → text + ghost button → /contact.

### Step 4 — Build Section 3 (How It Works)

18. Add full-width Flexbox Container → CSS ID `organism-how-it-works-programari` · background Global Color "Surface Warm" · padding 64px/32px.
19. Inner container: max-width 760px · centered · column · gap 32px.
20. Insert `molecule-section-header` → overline "CE URMEAZĂ" · H2 per spec.
21. Add lead text widget → "Programul de mai jos se aplică indiferent de locația aleasă." → Body Small → Ink Secondary.
22. Insert 4 `molecule-process-step` templates → edit per spec. **Step 1 body must be /programari-adapted.**
23. No connector line between steps.

### Step 5 — Build Section 4 (CTA Banner)

24. Add full-width Flexbox Container → CSS ID `organism-cta-banner-programari` · background Global Color "Ink" · padding 96px/48px.
25. Inner container: max-width 800px · centered · column · align center · gap 24px.
26. Overline → "PASUL URMĂTOR" · local color `#E4EDEB` · CSS class `text-overline`.
27. H2 → content per spec · Global "Surface" · centered.
28. Body text → content per spec · Global "Surface" · CSS class `reading-column` · centered.
29. Button → "Contactați-ne" → /contact · inverted primary style (background Global "Surface", text Global "Ink").
30. **Verify: exactly one button. No secondary CTA.**

### Step 6 — Final Checks

31. Preview at desktop, tablet (768px), and mobile (375px).
32. Apply the Accessibility Checklist above.
33. Apply the QA Master Checklist from `docs/implementation/03_ELEMENTOR_QA_RULES.md`.
34. Verify all links: Maps buttons → correct addresses · phone links → working tel: · "Contactați-ne" → /contact.
35. Verify background alternation: warm → surface → warm → ink ✓.
36. Verify no CTA on this page routes to /programari.
37. Run Lighthouse audit (mobile, incognito tab).
38. Confirm Launch State (1 or 2) is met.
39. Have Dr. Ungureanu review all published location data.
40. Publish.

---

## Launch Checklist

### Must Be True Before Publishing

```
[ ] Page is in Launch State 1 or State 2 (at least one complete card per city)
[ ] All published cards have all required fields populated with confirmed data
[ ] No published card shows "[CONFIRM CU DR. UNGUREANU]" text in required fields
[ ] Incomplete cards are hidden via Elementor responsive settings
[ ] Every published card's Google Maps link verified to open the correct address
[ ] Every published card's phone number is a working tel: link
[ ] Closing note "Contactați-ne →" links to /contact ✓
[ ] CTA banner button links to /contact ✓
[ ] CTA banner has exactly ONE button (no secondary) ✓
[ ] No CTA on this page routes back to /programari ✓
[ ] /contact page is live
[ ] Page has exactly one H1
[ ] Breadcrumb: Acasă → Programări · correct links
[ ] Breadcrumb "Programări" has aria-current="page"
[ ] #main-content ID set on hero section
[ ] WordPress title: "Programări" · Slug: /programari/
[ ] Page added to "Navigare principală" menu at position 3
[ ] Lighthouse accessibility ≥ 90
[ ] Page loads ≤ 2.5s on mobile simulation
[ ] No horizontal scroll at 375px
```

### Must Be True Before Routing All Site CTAs Here

```
[ ] State 1 or State 2 is confirmed
[ ] All published location data reviewed and approved by Dr. Ungureanu
[ ] All phone numbers tested (dial tel: link on a mobile device)
[ ] All Maps links tested on mobile (opens correct pin)
[ ] Page tested on iOS Safari and Android Chrome
```

---

## Open Questions for Dr. Ungureanu

The following must be answered before any location card can be published.

### Group A — Blocking (required for every card)

For **each location**, provide:

1. **Patient-facing name.** The name patients use — not the legal entity. Example: "Clinica [Name]" or "Spitalul Județean [City]".
2. **Full street address.** Street + number + city + postal code.
3. **Visit type.** Consultations only / surgery only / both?
4. **Days present.** Which days of the week is Dr. Ungureanu at this location?
5. **Hours.** Dr. Ungureanu's specific hours at this location (not the clinic's general hours).
6. **Phone number.** Which number should a patient call to book? Direct line or clinic reception?
7. **Booking method.** Exact process per location — website form, direct phone call, clinic reception, or other?

### Group B — Strongly Recommended

8. **Google Maps URL per address.** Search the address → Share → copy link. Prevents the card from directing patients to the wrong building.
9. **Patient notes.** Documents to bring (RMN, CT, referral, ID). Entrance instructions. Any location-specific requirements.
10. **Parking.** Available? Free or paid? In the courtyard or street?
11. **Accessibility.** Wheelchair access? Lift? Ground-floor? Disabled parking?

### Group C — Optional (can be added post-launch)

12. **Location-specific email.** Is there a per-location email, or does all contact go through one address?
13. **Total Cluj-Napoca locations.** How many locations should appear on the page? (Current assumption: 2–3.)
14. **Baia Mare frequency.** Weekly / bi-weekly / periodic / by arrangement? Affects how the schedule is described on the card.

---

## Summary

### Page Structure

| # | Section | Organism | Background |
|---|---------|----------|-----------|
| 1 | Hero | `organism-hero-interior` | `color-surface-warm` |
| 2 | Location directory | `organism-location-directory` | `color-surface` |
| 3 | How it works (shortened) | `organism-how-it-works` (contextual) | `color-surface-warm` |
| 4 | CTA banner | `organism-cta-banner` (/programari variant) | `color-ink` |

Background alternation: warm → surface → warm → ink ✓

### What Can Be Built Before Dr. Ungureanu's Input

| Component | Status |
|-----------|--------|
| organism-hero-interior | Fully specced — build now |
| Location directory structure (grid, city headers, closing note) | Fully specced — build now |
| molecule-location-card instances | Blocked — requires confirmed data per location |
| organism-how-it-works (contextual variant) | Fully specced — build now |
| organism-cta-banner (/programari variant) | Fully specced — build now |

### Routing Rule (Non-Negotiable)

No CTA on this page routes to /programari. Every link to a page on this site routes to /contact.
The /programari → /contact direction is one-way. There is no loop.
