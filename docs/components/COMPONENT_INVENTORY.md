# Component Inventory

## georgeungureanu.doctor — Complete Component Cross-Reference

**System:** Direction B+ — Warm Academic Medicine
**Active MVP components:** 63 (26 atoms + 17 molecules + 20 organisms)
**Total documented:** 66 (28 atoms + 17 molecules + 21 organisms)
**Deferred (future scope):** 3 — `atom-h5`, `atom-h6`, `organism-page-not-found`

**CTA routing (confirmed):** All primary buttons labeled "Programează o consultație" link to `/programari`. Secondary CTAs ("Contactați-ne") link to `/contact`. See `docs/project/WEBSITE_GOALS.md` §CTA Routing Decision.
**Status:** Documentation complete. Not yet implemented in Elementor.
**Prompt 03 output:** `docs/implementation/02_HOMEPAGE_TEMPLATE.md` — homepage section-by-section implementation guide.
**Prompt 04 output:** `docs/implementation/03_ELEMENTOR_QA_RULES.md` — master QA checklist, anti-pattern registry, export protocol, per-launch gate.
**Prompt 05 output:** `docs/prompts/05_THEME_BUILDER_GLOBALS.md` — complete header + footer implementation guide (60+ Elementor steps each).
**Prompt 06 output:** `docs/prompts/06_PROGRAMARI_PAGE_TEMPLATE.md` — complete /programari page implementation guide (4-section architecture, location card spec, launch states, open questions for Dr. Ungureanu).

---

## Master Component Table

| ID | Component | Level | Group | Status | Used In |
|----|-----------|-------|-------|--------|---------|
| A-01 | `atom-overline` | Atom | Typography | Defined | All section headers |
| A-02 | `atom-h1` | Atom | Typography | Defined | Every page hero |
| A-03 | `atom-h2` | Atom | Typography | Defined | All section headings |
| A-04 | `atom-h3` | Atom | Typography | Defined | Subsection headings, FAQ questions |
| A-05 | `atom-h4` | Atom | Typography | MVP | Card headlines |
| A-06 | `atom-h5` | Atom | Typography | Deferred | Use `atom-label` instead; H5 not part of active heading system |
| A-07 | `atom-h6` | Atom | Typography | Deferred | Use `atom-label` instead; H6 not part of active heading system |
| A-08 | `atom-body-lg` | Atom | Typography | Defined | Lead paragraphs in section headers |
| A-09 | `atom-body` | Atom | Typography | Defined | All body content |
| A-10 | `atom-body-sm` | Atom | Typography | Defined | Card descriptions, secondary info |
| A-11 | `atom-pull-quote` | Atom | Typography | Defined | Testimonials, doctor quotes |
| A-12 | `atom-caption` | Atom | Typography | Defined | Image captions, attributions |
| A-13 | `atom-label` | Atom | Typography | Defined | Form field labels |
| A-14 | `atom-button-primary` | Atom | Interactive | Defined | Primary CTAs |
| A-15 | `atom-button-secondary` | Atom | Interactive | Defined | Secondary CTAs |
| A-16 | `atom-button-ghost` | Atom | Interactive | Defined | Inline navigation, "read more" |
| A-17 | `atom-link-inline` | Atom | Interactive | Defined | Body text hyperlinks |
| A-18 | `atom-divider` | Atom | Structural | Defined | Content separation |
| A-19 | `atom-divider-strong` | Atom | Structural | Defined | Major section dividers |
| A-20 | `atom-icon` | Atom | Structural | Defined | Inline icons with text |
| A-21 | `atom-icon-box` | Atom | Structural | Defined | Icon containers in cards |
| A-22 | `atom-input` | Atom | Form | Defined | Text fields in contact form |
| A-23 | `atom-textarea` | Atom | Form | Defined | Message field in contact form |
| A-24 | `atom-select` | Atom | Form | Defined | Dropdowns in contact form |
| A-25 | `atom-checkbox` | Atom | Form | Defined | GDPR consent in contact form |
| A-26 | `atom-form-error` | Atom | Form | Defined | Validation messages |
| A-27 | `atom-image` | Atom | Media | Defined | Article images, condition images |
| A-28 | `atom-avatar` | Atom | Media | Defined | Doctor portrait |
| M-01 | `molecule-logo` | Molecule | Navigation | Defined | Site header, site footer |
| M-02 | `molecule-nav-item` | Molecule | Navigation | Defined | Site header desktop nav |
| M-03 | `molecule-breadcrumb` | Molecule | Navigation | Defined | Interior page heroes |
| M-04 | `molecule-section-header` | Molecule | Content | Defined | Every content organism |
| M-05 | `molecule-pull-quote` | Molecule | Content | Defined | Testimonials, biography |
| M-06 | `molecule-meta` | Molecule | Content | Defined | Footer, contact page, date/time labels |
| M-07 | `molecule-condition-tag` | Molecule | Content | Defined | Condition cards, article cards |
| M-08 | `molecule-card-condition` | Molecule | Cards | Defined | Conditions grid |
| M-09 | `molecule-card-article` | Molecule | Cards | Defined | Article grid |
| M-10 | `molecule-card-trust` | Molecule | Cards | MVP | Doctor credentials — trust indicators, not achievement stats |
| M-11 | `molecule-card-doctor-teaser` | Molecule | Cards | Defined | Homepage doctor section |
| M-12 | `molecule-form-field` | Molecule | Form | Defined | Contact form |
| M-13 | `molecule-form-submit` | Molecule | Form | Defined | Contact form |
| M-14 | `molecule-cta-inline` | Molecule | CTA | Defined | End of content sections |
| M-15 | `molecule-cta-button-group` | Molecule | CTA | Defined | Heroes, CTA banners |
| M-16 | `molecule-process-step` | Molecule | Process | MVP | How-it-works organism, patient-journey organism |
| M-17 | `molecule-location-card` | Molecule | Location | MVP | `/programari` — location-directory organism |
| O-01 | `organism-site-header` | Organism | Global | MVP | All pages (Theme Builder) — 6-item nav confirmed |
| O-02 | `organism-site-footer` | Organism | Global | MVP | All pages (Theme Builder) |
| O-03 | `organism-page-not-found` | Organism | Global | Deferred | 404 page — post-MVP; WordPress default suffices for launch |
| O-04 | `organism-hero-homepage` | Organism | Hero | MVP | Homepage |
| O-05 | `organism-hero-interior` | Organism | Hero | MVP | All interior pages |
| O-06 | `organism-hero-contact` | Organism | Hero | MVP | Contact page |
| O-07 | `organism-conditions-grid` | Organism | Content | MVP | Homepage (6 cards), Conditions page (full) |
| O-08 | `organism-how-it-works` | Organism | Content | MVP | Homepage, Contact page |
| O-09 | `organism-patient-journey` | Organism | Content | MVP | Patient page (/pacienti/), optional Contact page |
| O-10 | `organism-doctor-credentials` | Organism | Content | MVP | Homepage (compact), About page |
| O-11 | `organism-patient-testimonials` | Organism | Content | MVP | Homepage, About page |
| O-12 | `organism-faq` | Organism | Content | MVP | Conditions pages, Patient page |
| O-13 | `organism-article-grid` | Organism | Content | MVP | Homepage, Resources page |
| O-14 | `organism-location-directory` | Organism | Content | MVP | `/programari` (primary), linked from all primary CTAs |
| O-15 | `organism-contact-form` | Organism | Content | MVP | Contact page (/contact) |
| O-16 | `organism-cta-banner` | Organism | Content | MVP | Every page (once, near bottom) |
| O-17 | `organism-appointment-cta` | Organism | Content | MVP | Condition pages, article pages |
| O-18 | `organism-doctor-intro` | Organism | Doctor | MVP | About page |
| O-19 | `organism-credentials-list` | Organism | Doctor | MVP | About page |
| O-20 | `organism-philosophy-statement` | Organism | Doctor | MVP | About page |
| O-21 | `organism-emergency-notice` | Organism | Safety | MVP | Acute condition pages only |

---

## Page-to-Organism Usage Matrix

This matrix shows which organisms appear on which pages. Use this as a build sequence guide and to check for component reuse.

| Organism | Homepage | Conditions Page | Condition Page | About | /programari | Contact | Patient Page | Article | FAQ |
|----------|----------|-----------------|----------------|-------|------------|---------|-------------|---------|-----|
| `organism-site-header` | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| `organism-site-footer` | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ | ✓ |
| `organism-hero-homepage` | ✓ | | | | | | | | |
| `organism-hero-interior` | | ✓ | ✓ | ✓ | ✓ | | ✓ | ✓ | ✓ |
| `organism-hero-contact` | | | | | | ✓ | | | |
| `organism-emergency-notice` | | | Selected | | | | | | |
| `organism-conditions-grid` | ✓ (6) | ✓ (full) | | | | | | | |
| `organism-how-it-works` | ✓ | | | | ✓ (contextual variant) | ✓ (optional) | | | |
| `organism-patient-journey` | | | | | | ✓ (optional) | ✓ | | |
| `organism-location-directory` | | | | | ✓ (primary) | | | | |
| `organism-doctor-credentials` | ✓ (compact) | | | ✓ (full) | | | | | |
| `organism-doctor-intro` | | | | ✓ | | | | | |
| `organism-philosophy-statement` | | | | ✓ | | | | | |
| `organism-credentials-list` | | | | ✓ | | | | | |
| `organism-patient-testimonials` | ✓ | | | ✓ | | | | | |
| `organism-faq` | | | ✓ | | | | ✓ | | ✓ |
| `organism-article-grid` | ✓ (3) | | | | | | | | |
| `organism-contact-form` | | | | | | ✓ | | | |
| `organism-appointment-cta` | | | ✓ | | | | | ✓ | |
| `organism-cta-banner` | ✓ | ✓ | ✓ | ✓ | ✓ | | ✓ | ✓ | ✓ |

**Note on `/programari` page:** The `/programari` page is the destination of all primary CTAs. Its `organism-cta-banner` primary button links to `/contact` only — no secondary CTA, no /programari loop. Label: "Contactați-ne". Full page spec: `docs/prompts/06_PROGRAMARI_PAGE_TEMPLATE.md`.

**Note on how-it-works vs patient-journey:** `organism-how-it-works` and `organism-patient-journey` should not appear on the same page — they serve the same patient question at different depths. Use `how-it-works` for logistics-first contexts (homepage, contact); use `patient-journey` for experience-first contexts (patient page).

---

## Atom-to-Molecule Composition Map

Which atoms are used inside each molecule:

| Molecule | Atoms Composed |
|----------|---------------|
| `molecule-logo` | `atom-h4`, `atom-body-sm` |
| `molecule-nav-item` | `atom-link-inline`, `atom-icon` (optional) |
| `molecule-breadcrumb` | `atom-link-inline`, `atom-caption` |
| `molecule-section-header` | `atom-overline`, `atom-h2`, `atom-body-lg` |
| `molecule-pull-quote` | `atom-pull-quote`, `atom-caption` |
| `molecule-meta` | `atom-icon`, `atom-caption` |
| `molecule-condition-tag` | `atom-label` |
| `molecule-card-condition` | `atom-icon-box`, `atom-h4`, `atom-body-sm`, `atom-button-ghost` |
| `molecule-card-article` | `atom-image`, `atom-h4`, `atom-body-sm`, `molecule-meta`, `atom-button-ghost` |
| `molecule-card-trust` | Lora 700 display text (styled heading), `atom-body-sm` |
| `molecule-card-doctor-teaser` | `atom-avatar`, `atom-h3`, `atom-body-sm`, `atom-body`, `atom-button-ghost` |
| `molecule-form-field` | `atom-label`, `atom-input` / `atom-textarea` / `atom-select`, `atom-form-error` |
| `molecule-form-submit` | `atom-button-primary`, `atom-body-sm` |
| `molecule-cta-inline` | `atom-body`, `atom-button-primary` |
| `molecule-cta-button-group` | `atom-button-primary`, `atom-button-secondary` |
| `molecule-process-step` | Number container (styled div), `atom-h4`, `atom-body-sm` |
| `molecule-location-card` | Visit type badge (`atom-body-sm` styled as pill), `atom-h4` (name), `atom-body-sm` (address), `atom-divider`, `molecule-meta` ×2 (calendar + clock — required), `molecule-meta` (phone — required), `molecule-meta` (email — optional), `atom-body-sm` (booking method note — required), `molecule-meta` ×3 (patient notes + parking + accessibility — optional), `atom-button-ghost` (Maps link — required in footer) |

---

## Molecule-to-Organism Composition Map

Which molecules are used inside each organism:

| Organism | Molecules Composed |
|----------|--------------------|
| `organism-site-header` | `molecule-logo`, `molecule-nav-item` ×6, `atom-button-primary` |
| `organism-site-footer` | `molecule-logo`, `molecule-meta` ×4, ghost link lists |
| `organism-hero-homepage` | `atom-overline`, `atom-h1`, `atom-body-lg`, `molecule-cta-button-group`, `atom-image` |
| `organism-hero-interior` | `molecule-breadcrumb`, `atom-overline`, `atom-h1`, `atom-body-lg` |
| `organism-hero-contact` | `atom-overline`, `atom-h1`, `atom-body`, `molecule-meta` ×2 |
| `organism-conditions-grid` | `molecule-section-header`, `molecule-card-condition` ×6–12, `atom-button-ghost` |
| `organism-how-it-works` | `molecule-section-header`, `molecule-process-step` ×4 |
| `organism-patient-journey` | `molecule-section-header`, `atom-overline` + `atom-h3` + `atom-body` + `atom-body-sm` ×4 steps, `atom-divider` ×3, `molecule-pull-quote` (optional), `molecule-cta-inline` |
| `organism-doctor-credentials` | `molecule-section-header`, `molecule-card-trust` ×3, credential items |
| `organism-patient-testimonials` | `molecule-section-header`, `molecule-pull-quote` ×2–3, `atom-divider` |
| `organism-faq` | `molecule-section-header`, `atom-h3` + `atom-body` + `atom-divider` ×6–10 |
| `organism-article-grid` | `molecule-section-header`, `molecule-card-article` ×3, `atom-button-ghost` |
| `organism-location-directory` | `molecule-section-header`, `atom-overline` + `atom-h3` (city group headers), `molecule-location-card` ×N, `atom-divider`, `atom-body-sm` (closing note), `atom-button-ghost` |
| `organism-contact-form` | `molecule-section-header`, `molecule-form-field` ×4, `atom-checkbox`, `molecule-form-submit`, `molecule-meta` ×4 |
| `organism-cta-banner` | `atom-overline`, `atom-h2`, `atom-body`, `molecule-cta-button-group` |
| `organism-appointment-cta` | `atom-h2`, `atom-body`, `molecule-cta-button-group`, `molecule-meta` |
| `organism-doctor-intro` | `atom-avatar`, `atom-overline`, `atom-h2`, `atom-body-lg`, `atom-body`, `molecule-pull-quote`, `atom-button-primary` |
| `organism-credentials-list` | `molecule-section-header`, credential item groups |
| `organism-philosophy-statement` | `atom-overline`, `atom-h2`, `atom-body` (editorial), `molecule-pull-quote` |
| `organism-emergency-notice` | `atom-icon`, `atom-h3`, `atom-body`, `atom-button-primary` |
| *`organism-page-not-found`* | *`molecule-section-header` (H1), `molecule-cta-button-group` — deferred* |

---

## Build Sequence

The sequence in which components should be built in Elementor. Each stage depends on the previous stage being complete.

### Stage 1 — Global CSS Foundation
1. Paste `elementor/custom.css` into Elementor → Site Settings → Custom CSS
2. Verify CSS custom properties via browser console: `getComputedStyle(document.documentElement).getPropertyValue('--color-accent').trim()` → `#4D7A70`
3. Verify font loading: Lora and Inter visible in browser Dev Tools → Network → Fonts
4. Verify `prefers-reduced-motion` suppression via DevTools → Rendering → Emulate CSS media

### Stage 2 — Global Colors (Elementor)
Configure all 14 Global Colors in Elementor → Site Settings → Global Colors per `docs/implementation/01_DESIGN_SYSTEM_SETUP.md` §Step 3.

### Stage 3 — Global Typography (Elementor)
Configure all 15 Global Typography styles in Elementor → Site Settings → Global Fonts per `docs/implementation/01_DESIGN_SYSTEM_SETUP.md` §Step 4.

### Stage 4 — Atoms
Build and save as Global Widgets in this order:
1. Typography atoms (A-01 through A-05, A-08 through A-13) — configure as Text/Heading widgets with Global styles. **Note: A-06 (atom-h5) and A-07 (atom-h6) are deferred — do not configure.**
2. Interactive atoms (A-14 through A-17) — configure Button/Link widgets
3. Structural atoms (A-18 through A-21) — configure Divider/Icon widgets
4. Form atoms (A-22 through A-26) — configure Form widget fields
5. Media atoms (A-27 through A-28) — configure Image widget settings

### Stage 5 — Molecules
Build and save as Template Library entries in this order:
1. `molecule-logo` — needed for header
2. `molecule-nav-item` — needed for header
3. `molecule-breadcrumb` — needed for interior heroes
4. `molecule-section-header` — used by nearly every organism
5. `molecule-meta` — used by footer and contact
6. `molecule-form-field` + `molecule-form-submit` — form components
7. `molecule-cta-button-group` — used by heroes and CTAs
8. `molecule-card-condition` + `molecule-card-article` + `molecule-card-trust` + `molecule-card-doctor-teaser` — cards
9. `molecule-pull-quote` + `molecule-condition-tag` + `molecule-process-step` + `molecule-cta-inline` — remaining molecules
10. `molecule-location-card` — one instance per location (requires confirmed location data from Dr. Ungureanu before building)

### Stage 6 — Global Organisms (Theme Builder)
1. `organism-site-header` — Theme Builder → Header. Apply to All Pages.
2. `organism-site-footer` — Theme Builder → Footer. Apply to All Pages.
3. **`organism-page-not-found` — DEFERRED.** Do not build in MVP. WordPress default 404 is acceptable at launch.

### Stage 7 — Page Templates (Prompt 03) ✅ DOCUMENTED
Homepage template fully specified in `docs/implementation/02_HOMEPAGE_TEMPLATE.md`.

Build content organisms and assemble into page templates in this order:

**Homepage (build first):**
1. `organism-hero-homepage` → Section 1
2. Patient Promise section (centered statement — atoms/molecules, no formal organism) → Section 2
3. `organism-conditions-grid` → Section 3
4. Doctor Introduction section (molecule-card-doctor-teaser in full-width container) → Section 4
5. `organism-doctor-credentials` (homepage compact variant — 3 molecule-card-trust only) → Section 5
6. `organism-patient-testimonials` (add hidden — unhide when real testimonials available) → Section 6
7. `organism-how-it-works` → Section 7
8. `organism-article-grid` (add hidden — unhide when articles published) → Section 8
9. `organism-cta-banner` (dark, inverted buttons) → Section 9

**Before homepage can go live:**
- `/programari` page must exist (minimum viable spec in `02_HOMEPAGE_TEMPLATE.md`)
- `/conditii` page must exist (conditions grid links to it)
- `/despre` page must exist (doctor intro + trust sections link to it)
- Doctor photography must be available
- Trust indicator figures must be confirmed with Dr. Ungureanu

**Priority organisms for other pages:**
- `organism-location-directory` — top priority for the `/programari` page; requires confirmed location data (see Q13)
- `organism-patient-journey` — priority for the `/pacienti/` page
- All hero organisms (`organism-hero-homepage`, `organism-hero-interior`, `organism-hero-contact`)
- All content organisms in the page-to-organism matrix above

---

## Global Token Usage Map

Which Global Colors and Typography tokens each component uses:

### Global Colors used per component group:

| Color Token | Atoms | Molecules | Organisms |
|-------------|-------|-----------|-----------|
| `color-ink` | body, h1–h4, inputs | logo, form fields | all text-heavy sections |
| `color-ink-secondary` | caption, body-sm, placeholders | meta, nav-item | footer text |
| `color-surface` | button-primary text | all card backgrounds (light) | hero bg, page bg |
| `color-surface-warm` | — | — | doctor sections, footer |
| `color-surface-muted` | — | card-condition bg | FAQ bg, conditions grid |
| `color-accent` | button-primary bg, overline, link | condition-tag, icon-box | cta-banner buttons (inverted) |
| `color-accent-hover` | button-primary hover, link hover | — | — |
| `color-accent-subtle` | button-secondary hover, icon-box bg | condition-tag bg | appointment-cta bg |
| `color-border` | divider, input border | card border | footer border |
| `color-border-strong` | divider-strong | card hover border | — |
| `color-overlay` | — | — | hero with photo overlay (if used) |
| `color-success` | — | form success state | contact-form success |
| `color-warning` | — | — | emergency-notice bg tint |
| `color-error` | form-error text | form-field error state | — |

### Global Typography used per component group:

| Typography Token | Used by |
|-----------------|---------|
| H1 — Page Title | `atom-h1`, `organism-hero-homepage` |
| H2 — Section Headline | `atom-h2`, `molecule-section-header` |
| H3 — Subsection Headline | `atom-h3`, `organism-faq` questions |
| H4 — Card Headline | `atom-h4`, all card molecules |
| H5 | *Deferred — use `atom-label` for sidebar/metadata labels* |
| H6 | *Deferred — use `atom-label` for table column headers* |
| Body Large | `atom-body-lg`, `molecule-section-header` lead text |
| Body | `atom-body`, all content sections |
| Body Small | `atom-body-sm`, all card molecules, `organism-site-footer` |
| Pull Quote | `atom-pull-quote`, `molecule-pull-quote` |
| Overline | `atom-overline`, all section header molecules |
| Label | `atom-label`, `molecule-form-field` |
| Caption | `atom-caption`, `molecule-meta`, `molecule-breadcrumb` |
| CTA Button | `atom-button-primary`, `atom-button-secondary`, all CTA molecules |
| Navigation | `atom-link-inline` (nav context), `molecule-nav-item` |

---

## Accessibility Checklist by Component Type

### All atoms:
- [ ] Color contrast ≥ 4.5:1 for text, ≥ 3:1 for large text (18px+ regular or 14px+ bold)
- [ ] Focus state defined (`:focus-visible` ring from `custom.css` applies globally)
- [ ] Interactive atoms have hover states
- [ ] Interactive atoms have 44px minimum touch target on mobile

### All molecules:
- [ ] Semantic HTML structure within molecule (headings in correct order, lists for lists)
- [ ] Interactive molecules keyboard-navigable (Tab order follows visual order)
- [ ] No reliance on color alone to convey meaning
- [ ] Icon-only elements have `aria-label`

### All organisms:
- [ ] One H1 per page (verified at organism composition stage)
- [ ] Heading hierarchy is sequential (H1 → H2 → H3, never skipping levels)
- [ ] `<header>` and `<footer>` landmark roles present in global organisms
- [ ] `<nav aria-label>` wrapping all navigation regions
- [ ] Form organisms: all inputs labeled, all errors announced to screen readers
- [ ] No motion without `prefers-reduced-motion` respect (handled by `custom.css` globally)

---

## Anti-Pattern Registry

Components and patterns explicitly forbidden in this design system:

| Pattern | Why Forbidden | See Instead |
|---------|---------------|-------------|
| Carousel / Slider | Creates anxiety via timed content; fails keyboard users; prevents patient from controlling reading pace | Static `organism-patient-testimonials` with `atom-divider` between items |
| Tab system | Hides content from patients who do not discover all tabs; fails keyboard navigation | Full vertical content with H3 headings |
| Dropdown navigation | Adds complexity; difficult on touch devices; obscures site structure | Flat 4-item navigation in `organism-site-header` |
| Sticky/floating CTA button | Creates visual competition with page content; anxiety-inducing | Single `atom-button-primary` in header |
| Countdown timer / urgency pattern | Medically inappropriate; creates anxiety for patients | `molecule-cta-inline` with calm invitation |
| Modal / popup on entry | Prevents patient access to content they came to read | No modals except GDPR consent notice (system-level) |
| Parallax scrolling | Causes motion sickness in susceptible patients; fails `prefers-reduced-motion` | Static backgrounds, no scroll effects |
| Animation-triggered reveals | Elements appearing as patient scrolls may be missed; jarring | All content visible on page load |
| Multiple competing CTAs | Creates decision paralysis | One primary CTA per section via `molecule-cta-button-group` |
| Social media feed embed | Adds unpredictable third-party content; privacy concerns | No social media embeds |
| Chat widget / intercom popup | Intrudes on reading; adds visual weight | Contact form + phone number in footer |
| Stock photography of patients | Inauthentic; condescending to real patients | Real doctor photography only |

---

## Open Questions Before Page Templates Begin

Questions 1–14 documented below. Questions marked ✅ are resolved. Questions blocking implementation are marked **BLOCKING**.

### Content questions:

1. **Emergency notice scope**: Which specific condition pages should include `organism-emergency-notice`? Likely candidates: meningitis/encephalitis, acute stroke symptoms, severe TBI, sudden severe headache. Confirm list with Dr. Ungureanu.

2. **Testimonial sourcing**: The `organism-patient-testimonials` requires real patient testimonials (with permission) or public-source testimonials. Are testimonials available, or should placeholder content with GDPR-compliant fictional names be used temporarily?

3. **Trust indicators**: `molecule-card-trust` requires honest, verifiable figures — years of experience, years of specialization, institutional context. Volume metrics ("500+ surgeries") should not be used. Confirm specific figures with Dr. Ungureanu before building; the molecule must reflect only what can be stated accurately and explained plainly to a patient.

4. **Condition list**: How many conditions will be covered in Phase 1? The `organism-conditions-grid` requires at least 6 condition entries. Confirm the initial list of conditions to document.

5. **Appointment booking flow**: ✅ **Resolved.** All "Programează o consultație" CTAs route to `/programari` (the location directory hub). From `/programari`, the patient contacts the clinic via the form at `/contact` or by phone. No external booking software in Phase 1. See `docs/project/WEBSITE_GOALS.md` §CTA Routing Decision.

6. **Phone number / contact details**: Real phone number, email, and schedule needed before building any organism that includes `molecule-meta` with contact information. Note: the address field in the footer can link to `/programari` rather than a single address, since multiple locations exist.

**New (added with /programari decision):**

13. **Location data (blocking for /programari)**: The following must be confirmed with Dr. Ungureanu before `organism-location-directory` or any `molecule-location-card` instance can be built: clinic/hospital patient-facing names, full street addresses per location, visit types per location (consultations / surgeries / both), Dr. Ungureanu's specific schedule at each location, and the Google Maps URL per address. Without this data, `/programari` cannot go live. This is the single most important content dependency for the MVP.

14. ✅ **Resolved — /programari navigation placement**: Navigation confirmed as 6 items:
    Acasă / Condiții tratate / Programări / Resurse / Despre Dr. Ungureanu / Contact.
    Primary header CTA: "Programează o consultație" → /programari.
    `/programari` is now a first-class navigation destination (item 3).
    `organism-site-header` may now be built. See `03_ORGANISMS.md §organism-site-header` for confirmed nav spec.

**New (added with Theme Builder globals — Prompt 05):**

15. **[BLOCKING — header/footer] Phone number**: What patient-facing phone number appears in the footer and hero-contact? Required before footer Column 1 can be finalized and before organism-hero-contact can be completed. (Supersedes Q6 — documenting separately for clarity.)

16. **[BLOCKING — footer] Email address**: What email address appears in the footer and contact page? Required before footer Column 1. (Also supersedes Q6.)

17. **[BLOCKING — footer] Consultation schedule**: Is the schedule consistent across all locations, or does it vary? If it varies, footer Column 4 uses the redirect text ("Consultați pagina Programări") instead of specific hours. If consistent, provide the hours.

18. **[CONDITIONAL — footer] Social media accounts**: Does Dr. Ungureanu maintain official social accounts (Facebook, LinkedIn, YouTube, or other)? If yes: profile URLs + confirmation they are actively monitored for patient messages. If no: social links omitted from footer. See `docs/prompts/05_THEME_BUILDER_GLOBALS.md §Social media conditional`.

19. **[CONDITIONAL — footer] Logo mark**: Is the logo purely typographic (current spec), or is a graphic mark/symbol planned or commissioned? A graphic mark changes the header and footer logo implementation.

20. **[BLOCKING — legal] Privacy policy**: A privacy policy page is legally required under GDPR. Does a document exist? Who provides the text? The page must be at `/politica-de-confidentialitate/` before the footer goes live.

21. **[CONDITIONAL — legal] Cookie policy and analytics**: Is any tracking tool (Google Analytics, Hotjar, etc.) planned? If yes: a cookie consent mechanism and cookie policy page at `/cookies/` are legally required. If no: the Cookie-uri link in the footer legal strip is omitted.

22. **[CONDITIONAL — footer] Footer description text**: Confirm or amend: "Neurochirurg specializat în afecțiuni ale creierului, coloanei vertebrale și sistemului nervos. Consultații și intervenții în Cluj-Napoca și Baia Mare."

23. **[CONDITIONAL — legal] Medical disclaimer wording**: Confirm or amend: "Informațiile de pe acest site au caracter exclusiv informativ și nu constituie sfat medical sau recomandare terapeutică. Consultați medicul specialist."

### Design questions:

7. **Photography timing**: Doctor photography must be commissioned before the Homepage, About, and Doctor sections can be built. Is photography complete, scheduled, or deferred? The design system is built to accommodate real photography — placeholder images should not be used for the doctor's portrait.

8. **Language parity**: Will the site be bilingual (Romanian + English) or Romanian only in Phase 1? If bilingual, the navigation structure changes (language switcher needed), and several molecules need language-variant documentation.

9. **Article content readiness**: The `organism-article-grid` requires at least 3 published articles. Are patient education articles available for Phase 1, or should the article grid organism be deferred to a later phase?

### Technical questions:

10. **WordPress plugin choices**: The `organism-faq` is built with plain HTML (not Accordion widget). If Yoast SEO or RankMath is in use, FAQ Schema markup should be added to the FAQ organism. Confirm SEO plugin choice.

11. **Elementor Form email routing**: The `organism-contact-form` requires a form submission email address and an email notification template. Confirm the destination email and whether a CRM integration is needed.

12. **GDPR cookie consent**: The `atom-checkbox` handles form-level GDPR consent, but sitewide cookie consent is a separate concern (analytics, if any). Confirm whether Google Analytics or similar tracking is used, which determines cookie consent requirements.

---

*Component Inventory Version: 1.4 — Updated after Prompt 06 (/programari page template)*
*Documentation phase complete. Prompts 01–06 all documented.*
*Next: Build Stage 6 (global organisms: site-header + site-footer per docs/prompts/05_THEME_BUILDER_GLOBALS.md), then Stage 7 (homepage per docs/implementation/02_HOMEPAGE_TEMPLATE.md), then /programari (per docs/prompts/06_PROGRAMARI_PAGE_TEMPLATE.md)*
*QA reference: docs/implementation/03_ELEMENTOR_QA_RULES.md — apply before marking any template complete*
*Blocking before /programari can launch: location data from Dr. Ungureanu (Group A questions in Prompt 06)*
