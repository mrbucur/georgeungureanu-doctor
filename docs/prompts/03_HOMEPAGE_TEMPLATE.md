# Prompt 03: Homepage Template

## georgeungureanu.doctor — Elementor Pro Homepage

---

## Context for Claude Code

This is Prompt 03 in the implementation sequence for georgeungureanu.doctor.

**Prerequisites:**
- Prompt 01 implemented: Global Colors and Typography configured
- Prompt 02 implemented: Full component library in Elementor template library

Before using this prompt, read:
- `docs/content/HOMEPAGE_CONTENT_STRATEGY.md`
- `docs/content/CONTENT_TONE.md`
- `docs/project/PATIENT_CENTERED_MANIFESTO.md`
- `docs/design-system/ATOMIC_DESIGN_RULES.md`

---

## Objective

Generate the Elementor Pro homepage template JSON for georgeungureanu.doctor.

The homepage template assembles existing organisms from the component library (Prompt 02) into a complete, ready-to-populate page layout.

---

## Page Structure

The homepage uses this organism sequence:

```
organism-header              (global — already in library)
organism-hero-homepage
organism-intro-section       (variant: patient promise)
organism-condition-grid
organism-two-col-text-image  (variant: doctor introduction)
organism-stats-row
organism-testimonial-section (conditional — skip if no testimonials)
organism-appointment-prep    (variant of intro + icon list)
organism-article-grid
organism-cta-banner
organism-footer              (global — already in library)
```

---

## Section-by-Section Specifications

### Section 1: Hero

**Organism:** `organism-hero-homepage`

Layout: Full-width, full-viewport-height on desktop, 80vh on mobile.

Content slots:
- `[overline]` — Section label: e.g., "Neurochirurgie / Neurosurgery"
- `[headline]` — H1: Patient-facing headline (see content strategy)
- `[subheadline]` — Body-lg: 1–2 sentences on specialty and approach
- `[cta-primary]` — Button: "Programează o consultație" (Book a consultation)
- `[cta-secondary]` — Ghost button: "Condiții tratate" (Conditions we treat)
- `[background]` — Background image slot with dark overlay (`color-overlay`)

Typography:
- Headline: `type-h1`, white
- Subheadline: `type-body-lg`, white at 85% opacity
- Overline: `type-overline`, `color-accent` (or white with accent underline)

Spacing: `space-32` top padding desktop, `space-20` mobile

---

### Section 2: Patient Promise

**Organism:** `organism-intro-section` (centered variant)

Content slots:
- `[headline]` — H2: e.g., "Medicul care îți explică, nu doar tratează."
- `[body]` — 2–3 sentences on the philosophy of care
- No CTA in this section — it is a statement, not a prompt

Background: `color-surface-warm`
Spacing: `space-20` vertical padding

---

### Section 3: Conditions Grid

**Organism:** `organism-condition-grid`

Content slots:
- `[overline]` — "Ce tratăm"
- `[headline]` — H2: "Condiții în care ne specializăm"
- `[grid]` — 6 `molecule-card-condition` instances
- `[cta]` — Ghost button: "Vezi toate condițiile"

Grid: 3 columns desktop, 2 columns tablet, 1 column mobile
Background: `color-surface`
Spacing: `space-24` vertical padding

Condition card placeholder content (replace with real content):
1. Tumori cerebrale — Benign și malign
2. Hernie de disc — Coloana cervicală și lombară
3. Anevrism cerebral — Condiții cerebrovasculare
4. Hidrocefalie — Acumulare de lichid cefalorahidian
5. Nevralgie de trigemen — Durere facială severă
6. Stenoză spinală — Compresia canalului spinal

---

### Section 4: Doctor Introduction

**Organism:** `organism-two-col-text-image`

Layout: Image left, text right (desktop). Stacks image above text (mobile).

Content slots:
- `[image]` — Doctor portrait (warm, approachable)
- `[overline]` — "Despre Dr. Ungureanu"
- `[headline]` — H2: Doctor's name or a human-voice headline
- `[body]` — 3–4 sentences: who he is, what drives him, his patient philosophy
- `[cta]` — Link button: "Află mai multe despre Dr. Ungureanu"

Background: `color-surface-warm`
Spacing: `space-20` vertical padding

---

### Section 5: Stats Row

**Organism:** `organism-stats-row`

Layout: 4-column row desktop, 2×2 grid tablet, 2×2 mobile.

Content slots (4 stats):
- `[stat-1]` — Number + label: e.g., "15+ / Ani de experiență"
- `[stat-2]` — Number + label: e.g., "500+ / Proceduri efectuate"
- `[stat-3]` — Number + label: e.g., "20+ / Publicații academice"
- `[stat-4]` — Number + label: e.g., "3 / Spitale partenere"

Stat number: `type-h1` size, `color-accent`
Stat label: `type-body-sm`, `color-ink-secondary`

Background: `color-surface`
Spacing: `space-16` vertical padding

---

### Section 6: Patient Testimonials

**Organism:** `organism-testimonial-section`

**Note:** Include this section in the template as a conditionally hidden section. If real testimonials are not available at launch, this section is hidden via Elementor's responsive visibility control. Do not populate with placeholder testimonials.

Layout: 3-column grid of `molecule-pull-quote` (desktop), single column (mobile).

Content slots per testimonial:
- `[quote]` — Patient statement in first person
- `[attribution]` — First name + condition

Background: `color-accent-subtle`
Spacing: `space-20` vertical padding

---

### Section 7: Appointment Preparation

**Organism:** Custom organism using `molecule-section-header` + icon list

Layout: Centered header + 4-item horizontal icon list (desktop), vertical (mobile).

Content slots:
- `[overline]` — "Înainte de vizita ta"
- `[headline]` — H2: "Ce să te aștepți la prima consultație"
- `[item-1]` — Icon + short text: Contact form or phone
- `[item-2]` — Icon + short text: We confirm within 24 hours
- `[item-3]` — Icon + short text: Bring previous scans and records
- `[item-4]` — Icon + short text: First consultation: ~45 minutes
- `[cta]` — Link: "Informații complete pentru pacienți"

Background: `color-surface-warm`
Spacing: `space-20` vertical padding

---

### Section 8: Articles / Resources

**Organism:** `organism-article-grid`

Content slots:
- `[overline]` — "Resurse pentru pacienți"
- `[headline]` — H2: "Înțelege-ți condiția"
- `[grid]` — 3 `molecule-card-article` instances (latest posts query)
- `[cta]` — Ghost button: "Toate articolele"

Background: `color-surface`
Spacing: `space-24` vertical padding

---

### Section 9: Final CTA

**Organism:** `organism-cta-banner`

Content slots:
- `[headline]` — H2: "Pregătit să înțelegi opțiunile tale?"
- `[body]` — 1–2 sentences reassuring about what the next step means
- `[cta-primary]` — Button: "Programează o consultație"

Background: `color-accent-subtle`
Spacing: `space-20` vertical padding

---

## JSON File Output

The homepage template is exported as:

```
elementor-templates/pages/template-homepage.json
```

This is a full-page Elementor template importable via **Elementor → Templates → Import**.

---

## Content Notes

All content in the template JSON uses placeholder text in this format:
- `[PLACEHOLDER: hero-headline]` — indicates where real content goes
- `[PLACEHOLDER: doctor-portrait]` — indicates where an image is needed

Placeholder text is never Lorem Ipsum. Every placeholder is descriptive of what content is needed.

---

## Mobile Layout Requirements

On mobile (375px):
- Hero: Full width, reduced padding, stacked CTAs
- Conditions grid: 1 column, full-width cards
- Doctor intro: Image above text
- Stats: 2×2 grid
- Articles: 1 column
- All sections: `space-12` vertical padding (reduced from desktop)

---

## Accessibility Requirements

- Hero has proper H1 (only one per page)
- Headings in logical H1 → H2 → H3 sequence
- Images have descriptive alt text slots
- CTA buttons have descriptive text (not "Click here")
- Decorative elements have `aria-hidden="true"`
- Skip-to-content link exists in header

---

## Success Criteria

After implementing this prompt:
- Homepage template is importable in Elementor
- All 9 content sections are present in correct order
- All sections reference organisms from Prompt 02 (no new components built)
- All placeholder text is descriptive and actionable
- Template is fully responsive with mobile layout defined
- Template passes basic accessibility check (one H1, heading hierarchy, alt text slots)
